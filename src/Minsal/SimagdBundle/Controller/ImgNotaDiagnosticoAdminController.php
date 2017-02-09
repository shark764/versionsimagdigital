<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\SimagdBundle\Entity\ImgNotaDiagnostico;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxDiagnosticoSegundaOpinionMedicaListViewGenerator;

class ImgNotaDiagnosticoAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxDiagnosticoSegundaOpinionMedicaListViewGenerator(
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
    
    public function mostrarInformacionModalAction($idDiagnosticoPadre, $id)
    {
        //Obtener entidad diagnostico
        $em = $this->getDoctrine()->getManager();
        $entityDiag = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->find($idDiagnosticoPadre);
    	if (!$entityDiag) {
                return $this->render('MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_modal_support_default.html.twig', array());
    	}
        
        //Establecimiento local
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        //Estudio
        $entityEst = $entityDiag->getIdLectura()->getIdEstudio();
        //Solicitud de estudio
        $entityPrc = $entityEst->getIdProcedimientoRealizado()->getIdSolicitudEstudio();

        //Expediente local e información del paciente
        $entityExp = $em->getRepository('MinsalSiapsBundle:MntExpediente')
		                        ->findOneBy(array('idEstablecimiento' => $estabLocal,
		                                        'idPaciente' => $entityEst->getIdExpediente()->getIdPaciente()->getId()
		                                    ));

        //Solicitud de diagnóstico, si este existe
        $entitySolDiag = $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')
                                        ->findOneBy(array('idEstudio' => $entityEst->getId(),
                                                            'idSolicitudEstudio' => $entityPrc->getId()
                                                        ));

        //Notas al diagnóstico
        $entityNotaDiag = $em->getRepository('MinsalSimagdBundle:ImgNotaDiagnostico')->findBy(array('idDiagnostico' => $entityDiag->getId()));

        //Historial clínico y tablas asociadas
        $entityHcl = $entityPrc->getIdSolicitudestudios()->getIdHistorialClinico();
        $entityExmFsc = $em->getRepository('MinsalSeguimientoBundle:SecSignosVitales')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));
        $entityHojaCnt =  $em->getRepository('MinsalSeguimientoBundle:SecMotivoConsulta')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));

        return $this->render('MinsalSimagdBundle:ImgNotaDiagnosticoAdmin:notdiag_modal_support.html.twig', array(
            'expedienteInfo' => $entityExp,
            'pacienteInfo' => $entityEst->getIdExpediente()->getIdPaciente(),
            'historiaClinicaInfo' => $entityHcl,
            'examenFisicoInfo' => $entityExmFsc,
            'hojaContinuacionInfo' => $entityHojaCnt,
            'preinscripcionInfo' => $entityPrc,
            'citaInfo' => $entityEst->getIdProcedimientoRealizado()->getIdCitaProgramada(),
            'procedimientoRealizadoInfo' => $entityEst->getIdProcedimientoRealizado(),
            'estudioPacienteInfo' => $entityEst,
            'solicitudDiagnosticoInfo' => $entitySolDiag,
            'lecturaInfo' => $entityDiag->getIdLectura(),
            'diagnosticoInfo' => $entityDiag,
            'notaDiagInfo' => $entityNotaDiag
        ));
    }
    
    /**
     * Create action
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        //Get parameter from diagnostico
        if (!$this->get('request')->query->get('diagnostico')) { $this->get('request')->query->set('diagnostico', null); }

        $idDiag = $this->get('request')->query->get('diagnostico');
        
        $em = $this->getDoctrine()->getManager();

        //validar parámetro
        if ($idDiag) {
            $sessionUser = $this->container->get('security.context')->getToken()->getUser();
            $imgFunciones = new ImagenologiaDigitalFunciones($em);
            $validArray = $imgFunciones->verificarCreacionNotaDiagnostico($idDiag, $sessionUser);
            if (!$validArray[0]) {
                $this->addFlash('sonata_flash_error', $imgFunciones->obtenerMensajeError($validArray[1]));
                return new RedirectResponse($this->admin->generateUrl('list'));
            }
        }
        
        return parent::createAction();
    }
    
    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();

        //No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgNotaDiagnostico', 'notdiag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

    	//No puede acceder al registro
    	$securityContext 	= $this->container->get('security.context');
    	$sessionUser 		= $securityContext->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgNotaDiagnostico')->obtenerAccesoNotDiagEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        //No está autorizado a editar el registro
        if (!($em->getRepository('MinsalSimagdBundle:ImgNotaDiagnostico')->obtenerAccesoNotDiag($id, $sessionUser->getId()) ||
			$securityContext->isGranted('ROLE_ADMIN'))) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        return parent::editAction($id);
    }
    
    public function showAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();

     //    //No existe el registro
     //    if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgNotaDiagnostico', 'notdiag')) {
     //        return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
     //    }

    	// //No puede acceder al registro
    	// $sessionUser = $this->container->get('security.context')->getToken()->getUser();
     //    if (false === $em->getRepository('MinsalSimagdBundle:ImgNotaDiagnostico')->obtenerAccesoNotDiagEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
     //        return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
     //    }
        
        return parent::showAction($id);
    }
    
    public function listAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return $this->render($this->admin->getTemplate('list'));
    }
    
    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');
        
        $em = $this->getDoctrine()->getManager();

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:ImgNotaDiagnostico')->data($estabLocal->getId(), $BS_FILTERS_DECODE);

    	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
    	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgNotaDiagnostico();

            $results[$key]['menu_code'] = 'secondmedicalopinions';

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
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
                        '<a class=" secondmedicalopinions-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="secondmedicalopinions-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="secondmedicalopinions_show"><a class=" secondmedicalopinions_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="secondmedicalopinions_edit"><a class=" secondmedicalopinions_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="secondmedicalopinions_delete"><a class=" secondmedicalopinions_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="secondmedicalopinions_studydownload"><a class=" secondmedicalopinions_studydownload_action "><span class="glyphicon glyphicon-eye-open"></span>Recuperar estudio(s)</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="secondmedicalopinions_create"><a class=" secondmedicalopinions_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                            '<li data-item="secondmedicalopinions_addtothis"><a class=" secondmedicalopinions_addtothis_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear para este diagnóstico</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';
            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" secondmedicalopinions-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            // $results[$key]['diag_fechaTranscrito']    = $r['diag_fechaTranscrito'] ? $r['diag_fechaTranscrito']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['diag_fechaCorregido']     = $r['diag_fechaCorregido'] ? $r['diag_fechaCorregido']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['diag_fechaAprobado']      = $r['diag_fechaAprobado'] ? $r['diag_fechaAprobado']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['diag_fechaRegistro']      = $r['diag_fechaRegistro']->format('Y-m-d H:i:s A');
            // $results[$key]['lct_fechaLectura']                   = $r['lct_fechaLectura']->format('Y-m-d H:i:s A');
            // $results[$key]['notdiag_fechaEmision']       = $r['notdiag_fechaEmision']->format('Y-m-d H:i:s A');
            
            // $results[$key]['allowShow']                          = $isUser_allowShow;
            
            // $results[$key]['allowEdit']                          = (false !== $isUser_allowEdit &&
            //         ($r['notdiag_id_userReg'] == $sessionUser->getId() || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            $results[$key]['table_dbl_click_url'] = $this->generateUrl('simagd_segunda_opinion_medica_show', array('id' => $r['id']));
        }
        
        return $this->renderJson($results);
    }
    
    public function crearNotaAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from diagnostico
        $diagnostico        = $request->request->get('formNotaIdDiagnostico');
        $this->get('request')->request->set('diagnostico', $diagnostico ? $diagnostico : null);

        //Nueva instancia
        $nota               = $this->admin->getNewInstance();
        // $nota = new ImgNotaDiagnostico();
        
        $empleado           = $request->request->get('formNotaIdEmpleado');
        $tipo               = $request->request->get('formNotaIdTipoNotaDiagnostico');
        $notaDiag           = $request->request->get('formNotaContenido');
        $observaciones      = $request->request->get('formNotaObservaciones');
        
        $em = $this->getDoctrine()->getManager();
        
        //Empleado
        $empleadoReference  = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $nota->setIdEmpleado($empleadoReference);
        //Tipo
        $tipoReference      = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlTipoNotaDiagnostico', $tipo);
        $nota->setIdTipoNotaDiagnostico($tipoReference);
        
        $nota->setContenido($notaDiag);
        $nota->setObservaciones($observaciones);

        //Crear registro
        try {
            /*$nota = */$this->admin->create($nota);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
    }
    
    public function editarNotaAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from nota
        $id                 = $request->request->get('formNotaId');
        
        //Objeto
        $nota               = $this->admin->getObject($id);
        
        $empleado           = $request->request->get('formNotaIdEmpleado');
        $tipo               = $request->request->get('formNotaIdTipoNotaDiagnostico');
        $notaDiag           = $request->request->get('formNotaContenido');
        $observaciones      = $request->request->get('formNotaObservaciones');
        
        $em = $this->getDoctrine()->getManager();
        
        //Empleado
        $empleadoReference  = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $nota->setIdEmpleado($empleadoReference);
        //Tipo
        $tipoReference      = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlTipoNotaDiagnostico', $tipo);
        $nota->setIdTipoNotaDiagnostico($tipoReference);
        
        $nota->setContenido($notaDiag);
        $nota->setObservaciones($observaciones);
        
        //Actualizar registro
        try {
            /*$nota           = */$this->admin->update($nota);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
    }
    
}