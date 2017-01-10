<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\ImgPendienteTranscripcion;

use Minsal\SimagdBundle\Generator\ListViewGenerator\RyxLecturaPendienteTranscripcionListViewGenerator;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class ImgPendienteTranscripcionAdminController extends Controller
{
    public function transcribirAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $lectura = $object->getIdLectura()->getId();

        $em = $this->getDoctrine()->getManager();

        $diagnostico = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->findOneBy(array('idLectura' => $lectura));
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

        return $this->redirect($this->generateUrl('simagd_diagnostico_agregarPendiente', array('lectura' => $lectura)));
    }

    public function listAction() {
	   //Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em                 = $this->getDoctrine()->getManager();

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

        $tipos              = $em->getRepository('MinsalSimagdBundle:ImgCtlTipoNotaDiagnostico')->findAll();
        $estadosDiag        = $em->getRepository('MinsalSimagdBundle:ImgCtlEstadoDiagnostico')->findAll();

        $modalidades        = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->findBy(array('idAtencion' => '97'));

        /** Patrones para diagnóstico */
        $patronesDiag       = $em->getRepository('MinsalSimagdBundle:ImgCtlPatronDiagnostico')
                                        ->obtenerPatronesDiagnosticoUtilizablesV2($estabLocal->getId())
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

    public function listarPendientesTranscripcionAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS                 = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE          = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em                         = $this->getDoctrine()->getManager();

    	$securityContext            = $this->container->get('security.context');
    	$sessionUser               = $securityContext->getToken()->getUser();
        $estabLocal                 = $sessionUser->getIdEstablecimiento();

        $results                 = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->obtenerPendientesTranscripcionV2($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowTranscribir    = ($this->admin->getRoutes()->has('transcribir') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
	   $isUser_allowRegInicial     = ($this->admin->getRoutes()->has('registrarEnMiLista') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        foreach ($results as $key => $r)
        {
            //    $r = new \Minsal\SimagdBundle\Entity\ImgPendienteTranscripcion();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'non_transcribed_results\', ' . $r['id'] . '); return false;">' .
                            // '<div class="container">' .
                            // '<div class=" col-lg-12 col-md-12 col-sm-12">' .
                                '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                                '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>ORIGEN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['origen'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROCEDENCIA:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['area_atencion'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['atencion'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['medico'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['triage'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>RADIÓLOGO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['radiologo'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>DIAGNÓSTICO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['conclusion'] . '</div></div>' .
                            // '</div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-show-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Ver detalle..." >' .
                        // '<a class=" worklist-show-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Ver detalle..." >' .
                            // 'Ver' .
                            '<i class="glyphicon glyphicon-chevron-down"></i>' .
                        '</a>' .
                    '</div>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-form-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Abrir formulario..." >' .
                        // '<a class=" worklist-save-form-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Abrir formulario..." >' .
                            // 'Formulario' .
                            '<i class="glyphicon glyphicon-edit"></i>' .
                        '</a>' .
                    '</div>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-and-pacs-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Guardar y asociar..." >' .
                        // '<a class=" worklist-save-and-pacs-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Guardar y asociar..." >' .
                            // 'Guardar y asociar' .
                            // '<i class="glyphicon glyphicon-check"></i>' .
                            '<i class="glyphicon glyphicon-link"></i>' .
                        '</a>' .
                    '</div>' .
                    // '<span class="bs-btn-separator-toolbar"></span>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-action btn-link btn-link-emergency " href="javascript:void(0)" title="Guardar sin asociar..." >' .
                        // '<a class=" worklist-save-action btn btn-emergency btn-outline btn-xs " href="javascript:void(0)" title="Guardar sin asociar..." >' .
                            // 'Guardar' .
                            '<i class="glyphicon glyphicon-check"></i>' .
                        '</a>' .
                    '</div>' .
                '</div>';

            $results[$key]['lct_fechaLectura']       = $r['lct_fechaLectura']->format('Y-m-d H:i:s A');
            $results[$key]['pndT_fechaIngresoLista'] = $r['pndT_fechaIngresoLista']->format('Y-m-d H:i:s A');

            $results[$key]['allowTranscribir']       = $isUser_allowTranscribir;

            $results[$key]['allowRegInicial']        = $isUser_allowRegInicial;
        }

        $response = new Response();
        $response->setContent(json_encode($results));
        return $response;
    }

    public function asignarElementoListaTrabajoAction(Request $request)
    {
        $request->isXmlHttpRequest();

	   $status     = 'OK';

        /*
         * request
         */
        $id_trcX    = $request->request->get('__trcx');
        $pndT_rows  = $request->request->get('__ar_rowsAffected');

        $em         = $this->getDoctrine()->getManager();

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:ImgPendienteTranscripcion')
                            ->asignarElementoListaTrabajo($estabLocal->getId(), $id_trcX, $sessionUser->getIdEmpleado()->getId(), $pndT_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response   = new Response();
        $response->setContent(json_encode(array('update' => $status)));
        return $response;
    }

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

        $em = $this->getDoctrine()->getManager();

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

}