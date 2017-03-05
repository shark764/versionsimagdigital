<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\RyxLecturaPendienteTranscripcion;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxLecturaPendienteTranscripcionListViewGenerator;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class RyxLecturaPendienteTranscripcionAdminController extends MinsalSimagdBundleGeneralAdminController
{
    /**
     * TABLE GENERATOR
     *
     * @param Request $request
     *
     * @return Response
     */
    public function generateTableAction(Request $request)
    {
        $request->isXmlHttpRequest();
        $__REQUEST__type = $request->request->get('type', 'list');

        // $em = $this->getDoctrine()->getManager();

        //////// --| builder entity
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxLecturaPendienteTranscripcionListViewGenerator(
                $this->container,
                $this->admin->getRouteGenerator(),
                $this->admin->getClass(),
                $__REQUEST__type
        );
        //////// --|
        $options = $ENTITY_LIST_VIEW_GENERATOR_->getTable();

        return $this->renderJson(array(
            'result'    => 'ok',
            'options'   => $options
        ));
    }

    public function transcribirAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $lectura = $object->getIdLectura()->getId();

        $em = $this->getDoctrine()->getManager();

        $diagnostico = $em->getRepository('MinsalSimagdBundle:RyxDiagnosticoRadiologico')->findOneBy(array('idLectura' => $lectura));
        if ($diagnostico) {
            $paciente = $diagnostico->getIdLectura()->getIdEstudio()->getIdExpediente()->getIdPaciente();
            if ($object->getFueImpugnado()) { $this->addFlash('sonata_flash_error', 'Transcripción ha sido impugnada para lectura de: <br/> <strong>' . $paciente . '</strong>'); }
            else { $this->addFlash('sonata_flash_info', 'Transcripción registrada para lectura de: <br/> <strong>' . $paciente . '</strong>'); }
            return $this->redirect($this->generateUrl('simagd_diagnostico_edit', array('id' => $diagnostico->getId())));
        }

        $this->addFlash('sonata_flash_success', 'Transcripción no iniciada para lectura imagenológica');
        return $this->redirect($this->generateUrl('simagd_diagnostico_create', array('lectura' => $lectura)));
    }

    public function registrarEnMiListaAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $pndT = $this->admin->getObject($id);
        if (!$pndT) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $lectura = $pndT->getIdLectura()->getId();

        return $this->redirect($this->generateUrl('simagd_diagnostico_addPendingToWorkList', array('lectura' => $lectura)));
    }

    public function listAction()
    {
	   //Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $tiposEmpleado      = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();

        $radiologos         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                        ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))
                                        ->getQuery()->getResult();
        $transcriptores     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                        ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 4, 5, 6))
                                        ->getQuery()->getResult();

        $tipos              = $em->getRepository('MinsalSimagdBundle:RyxCtlTipoOpinionMedicaDiagnostico')->findAll();
        $estadosDiag        = $em->getRepository('MinsalSimagdBundle:RyxCtlEstadoDiagnostico')->findAll();

        $modalidades        = $em->getRepository('MinsalSimagdBundle:CtlAreaServicioDiagnostico')->findBy(array('idAtencion' => '97'));

        /** Patrones para diagnóstico */
        $patronesDiag       = $em->getRepository('MinsalSimagdBundle:RyxCtlPatronDiagnostico')
                                        ->getUsableDiagnosticPatterns($estabLocal->getId())
                                        ->getQuery()->getResult();
        /** Fin --- Patrones para diagnóstico */

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'      => $tiposEmpleado,
                        'radiologos'        => $radiologos,
                        'tiposNota'         => $tipos,
                        'default_empLogged'        => $sessionUser->getIdEmpleado(),
                        'tipoNotaDefault'   => 1,
                        'transcriptores'    => $transcriptores,
                        'estadosDiag'       => $estadosDiag,
                        'estadoDiagDefault' => 2,
                        'modalidades'       => $modalidades,
			'patronesDiag'      => $patronesDiag,
                    ));
    }

    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em = $this->getDoctrine()->getManager();

    	$securityContext            = $this->container->get('security.context');
    	$sessionUser               = $securityContext->getToken()->getUser();
        $estabLocal                 = $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:RyxLecturaPendienteTranscripcion')->getWorkList($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowTranscribir    = ($this->admin->getRoutes()->has('transcribir') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
	   $isUser_allowRegInicial     = ($this->admin->getRoutes()->has('registrarEnMiLista') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\RyxLecturaPendienteTranscripcion();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'unrealized_procedures\', ' . $r['id'] . '); return false;">' .
                            '<div class="row">' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3>' .
                                    // '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                                    '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>ORIGEN:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['origen'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROCEDENCIA:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['area_atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['triage'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>RADIÓLOGO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['radiologo'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>DIAGNÓSTICO (RX):</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['conclusion'] . '</div></div>' .
                                '</div>' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' .
                                    '<div class=" " style="margin-top: 20px; margin-bottom: 10px;"><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" > Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['triage'] . '</div></div>' .
                                '</div>' .
                            '</div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" nontranscribedresultsworklist-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="nontranscribedresultsworklist-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="nontranscribedresultsworklist_show"><a><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="nontranscribedresultsworklist_edit"><a href="javascript:void(0)" class=" nontranscribedresultsworklist_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="nontranscribedresultsworklist_delete"><a href="javascript:void(0)" class=" nontranscribedresultsworklist_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li class="dropdown-header">LISTA DE TRABAJO</li>' .
                            '<li data-item="nontranscribedresultsworklist_save"><a href="javascript:void(0)" class=" nontranscribedresultsworklist_save_action "><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</a></li>' .
                            '<li data-item="nontranscribedresultsworklist_saveandclose"><a href="javascript:void(0)" class=" nontranscribedresultsworklist_saveandclose_action "><span class="glyphicon glyphicon-floppy-saved"></span>Guardar (transcripción finalizada)</a></li>' .
                            '<li data-item="nontranscribedresultsworklist_goto"><a href="javascript:void(0)" class=" nontranscribedresultsworklist_goto_action "><span class="glyphicon glyphicon-edit"></span>Acceder</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="nontranscribedresultsworklist_studydownload"><a href="javascript:void(0)" class=" nontranscribedresultsworklist_studydownload_action "><span class="glyphicon glyphicon-eye-open"></span>Recuperar estudio(s)</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="nontranscribedresultsworklist_create"><a href="javascript:void(0)" class=" nontranscribedresultsworklist_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_ingreso'] = $formatter->dateFormatter($r['fecha_ingreso']);
            // $results[$key]['fecha_edicion'] = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" nontranscribedresultsworklist-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            // $results[$key]['lct_fechaLectura']       = $r['lct_fechaLectura']->format('Y-m-d H:i:s A');
            // $results[$key]['pndT_fechaIngresoLista'] = $r['pndT_fechaIngresoLista']->format('Y-m-d H:i:s A');

            // $results[$key]['allowTranscribir']       = $isUser_allowTranscribir;

            // $results[$key]['allowRegInicial']        = $isUser_allowRegInicial;
            
            $results[$key]['show_url']      = $this->generateUrl('simagd_sin_transcribir_show', array('id' => $r['id'], 'mode' => 'standard'));
            $results[$key]['edit_url']      = $this->generateUrl('simagd_sin_transcribir_edit', array('id' => $r['id'], 'mode' => 'standard'));
            $results[$key]['delete_url']    = $this->generateUrl('simagd_sin_transcribir_delete', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['save_url']      = $this->generateUrl('simagd_sin_transcribir_save', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['saveandclose_url']  = $this->generateUrl('simagd_sin_transcribir_saveandclose', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['goto_url']      = $this->generateUrl('simagd_diagnostico_edit', array('id' => $r['diag_id'], 'worklist_id' => $r['id'], 'mode' => 'standard'));
            $results[$key]['create_url']    = $this->generateUrl('simagd_sin_transcribir_create', array('id' => $r['id'], 'mode' => 'standard'));
        }

        return $this->renderJson($results);
    }

    public function addToWorkListAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        /*
         * request
         */
        $id_trcX    = $request->request->get('__trcx');
        $pndT_rows  = $request->request->get('__ar_rowsAffected');

        $em = $this->getDoctrine()->getManager();

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:RyxLecturaPendienteTranscripcion')
                            ->addToWorkList($estabLocal->getId(), $id_trcX, $sessionUser->getIdEmpleado()->getId(), $pndT_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array('update' => $status));
    }

}