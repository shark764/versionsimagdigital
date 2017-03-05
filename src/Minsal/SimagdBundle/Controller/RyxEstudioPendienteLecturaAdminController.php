<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\RyxEstudioPendienteLectura;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxEstudioPendienteLecturaListViewGenerator;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class RyxEstudioPendienteLecturaAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxEstudioPendienteLecturaListViewGenerator(
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

    public function leerAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $estudio = $object->getIdEstudio()->getId();

        $em = $this->getDoctrine()->getManager();

        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        $lectura = $em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')->findOneBy(array(
                                                    'idEstudio' => $estudio,
                                                    'idEstablecimiento' => $estabLocal));
        if ($lectura) {
            $this->addFlash('sonata_flash_success', 'Lectura registrada para: <br/> <strong>' .
						$lectura->getIdEstudio()->getIdExpediente()->getIdPaciente() . '</strong>');
            return $this->redirect($this->generateUrl('simagd_lectura_edit', array('id' => $lectura->getId())));
        }

        $this->addFlash('sonata_flash_success', 'Lectura no iniciada para estudio imagenológico');
        return $this->redirect($this->generateUrl('simagd_lectura_create', array('__est' => $estudio)));
    }

    public function registrarEnMiListaAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $pndL = $this->admin->getObject($id);
        if (!$pndL) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $estudio = $pndL->getIdEstudio()->getId();

        return $this->redirect($this->generateUrl('simagd_lectura_addPendingToWorkList', array('__est' => $estudio)));
    }

    public function listAction()
    {
        // Acceso denegado
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
                                    ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 4, 5))
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

        $results = $em->getRepository('MinsalSimagdBundle:RyxEstudioPendienteLectura')->getWorkList($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowInterpretar    = ($this->admin->getRoutes()->has('leer') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        $isUser_allowRegInicial     = ($this->admin->getRoutes()->has('registrarEnMiLista') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\RyxEstudioPendienteLectura();

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
                                '</div>' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' .
                                    '<div class="row" style="margin-top: 20px; "><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['triage'] . '</div></div>' .
                                    '<div class=" " style="margin-top: 10px; margin-bottom: 10px;"><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" > Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div>' .
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
                        '<a class=" undiagnosedstudiesworklist-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="undiagnosedstudiesworklist-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="undiagnosedstudiesworklist_show"><a href="javascript:void(0)" class=" undiagnosedstudiesworklist_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="undiagnosedstudiesworklist_edit"><a href="javascript:void(0)" class=" undiagnosedstudiesworklist_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="undiagnosedstudiesworklist_delete"><a href="javascript:void(0)" class=" undiagnosedstudiesworklist_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li class="dropdown-header">LISTA DE TRABAJO</li>' .
                            '<li data-item="undiagnosedstudiesworklist_save"><a href="javascript:void(0)" class=" undiagnosedstudiesworklist_save_action "><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</a></li>' .
                            '<li data-item="undiagnosedstudiesworklist_saveandclose"><a href="javascript:void(0)" class=" undiagnosedstudiesworklist_saveandclose_action "><span class="glyphicon glyphicon-floppy-saved"></span>Guardar (lectura finalizada)</a></li>' .
                            '<li data-item="undiagnosedstudiesworklist_goto"><a href="javascript:void(0)" class=" undiagnosedstudiesworklist_goto "><span class="glyphicon glyphicon-adjust"></span>Acceder</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="undiagnosedstudiesworklist_studydownload"><a href="javascript:void(0)" class=" undiagnosedstudiesworklist_studydownload_action "><span class="glyphicon glyphicon-eye-open"></span>Recuperar estudio(s)</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="undiagnosedstudiesworklist_create"><a href="javascript:void(0)" class=" undiagnosedstudiesworklist_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_ingreso'] = $formatter->dateFormatter($r['fecha_ingreso']);
            // $results[$key]['fecha_edicion'] = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" undiagnosedstudiesworklist-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            // $results[$key]['pndL_fechaIngresoLista']             = $r['pndL_fechaIngresoLista']->format('Y-m-d H:i:s A');
            // $results[$key]['est_fechaEstudio']                   = $r['est_fechaEstudio']->format('Y-m-d H:i:s A');

            // $results[$key]['prz_fechaAtendido']                  = $r['prz_fechaAtendido'] ? $r['prz_fechaAtendido']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['prz_fechaRealizado']                 = $r['prz_fechaRealizado'] ? $r['prz_fechaRealizado']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['prz_fechaProcesado']                 = $r['prz_fechaProcesado'] ? $r['prz_fechaProcesado']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['prz_fechaAlmacenado']                = $r['prz_fechaAlmacenado'] ? $r['prz_fechaAlmacenado']->format('Y-m-d H:i:s A') : '';

            // $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion'] ? $r['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['solcmpl_fechaSolicitud']             = $r['solcmpl_fechaSolicitud'] ? $r['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';

            $results[$key]['lct_createUrl'] = $r['lctPdr_id'] ?
                    $this->generateUrl('simagd_lectura_edit', array('id' => $r['lctPdr_id'], '__est' => $r['est_id'], '__estPdr' => $r['estPdr_id'])) :
                        $this->generateUrl('simagd_lectura_create', array('__est' => $r['est_id'], '__xrad' => $r['pndL_anexadoPorRadiologo'] ? TRUE : NULL, '__xradAnx' => $r['pndL_id_radiologoAnexa'], '__estPdr' => $r['estPdr_id']));
            
            $results[$key]['show_url']      = $this->generateUrl('simagd_sin_lectura_show', array('id' => $r['id'], 'mode' => 'standard'));
            $results[$key]['edit_url']      = $this->generateUrl('simagd_sin_lectura_edit', array('id' => $r['id'], 'mode' => 'standard'));
            $results[$key]['delete_url']    = $this->generateUrl('simagd_sin_lectura_delete', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['save_url']      = $this->generateUrl('simagd_sin_lectura_save', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['saveandclose_url']  = $this->generateUrl('simagd_sin_lectura_saveandclose', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['goto_url']      = $this->generateUrl('simagd_lectura_create', array('__est' => $r['est_id'], '__xrad' => $r['pndL_anexadoPorRadiologo'] ? true : null, '__xradAnx' => $r['pndL_id_radiologoAnexa'], '__estPdr' => $r['estPdr_id'],));
            $results[$key]['create_url']    = $this->generateUrl('simagd_sin_lectura_create', array('id' => $r['id'], 'mode' => 'standard'));

            // $results[$key]['allowInterpretar']                   = $isUser_allowInterpretar;

            // $results[$key]['allowRegInicial']                    = $isUser_allowRegInicial;
        }

        return $this->renderJson($results);
    }

    public function addToUndiagnosedStudiesListAction(Request $request)
    {
        $request->isXmlHttpRequest();

        //Get parameter from estudio
        $estudio        = $request->request->get('__est');
        $this->get('request')->request->set('__est', $estudio ? $estudio : NULL);

        //Get parameter from estudio padre (en caso de ser complementario)
        $estudioPdr     = $request->request->get('__estPdr');
        $this->get('request')->request->set('__estPdr', $estudioPdr ? $estudioPdr : NULL);

        $this->get('request')->request->set('__xrad', TRUE);

        //Nueva instancia
        $pndLectura     = $this->admin->getNewInstance();

        //Crear registro
        try {
            /*$pndLectura = */$this->admin->create($pndLectura);
        } catch (Exception $e) {
            $status     = 'failed';
        }

        return $this->renderJson(array());
    }

    public function addToWorkListAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        /*
         * request
         */
        $id_radX    = $request->request->get('__radx');
        $pndL_rows  = $request->request->get('__ar_rowsAffected');

        $em = $this->getDoctrine()->getManager();

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //    $start      = $request->request->get('start');
        //    $end        = $request->request->get('end');
        //
        //    $cita->setFechaHoraInicio(\DateTime::createFromFormat('Y-m-d H:i', $start));

        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:RyxEstudioPendienteLectura')
                        ->addToWorkList($estabLocal->getId(), $id_radX, $sessionUser->getIdEmpleado()->getId(), $pndL_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array('update' => $status));
    }

}