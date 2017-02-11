<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\SimagdBundle\Entity\ImgDiagnostico;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxDiagnosticoRadiologicoListViewGenerator;

class ImgDiagnosticoAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxDiagnosticoRadiologicoListViewGenerator(
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

    /**
     * 
     * @return type
     */
    public function notaAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }
        
        $this->addFlash('sonata_flash_info', 'Agregue una nota al diagnóstico');

        return $this->redirect($this->generateUrl('simagd_segunda_opinion_medica_create', array('diagnostico' => $id)));
    }
    
    public function addPendingToWorkListAction()
    {
        //Get parameter from lectura
        if (!$this->get('request')->request->get('__lct')) { $this->get('request')->request->set('__lct', null); }

        //Nueva instancia
        $diagnostico        = $this->admin->getNewInstance();
        
        //Cambio de estado de registro
        $em = $this->getDoctrine()->getManager();
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico', '1'); //Inicial
        $diagnostico->setIdEstadoDiagnostico($estadoReference);

        //Crear registro
        try {
            /*$diagnostico    = */$this->admin->create($diagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
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
        
        //Get parameter from lectura
        if (!$this->get('request')->query->get('__lct')) { $this->get('request')->query->set('__lct', null); }

        $idLct = $this->get('request')->query->get('__lct');
        
        $em = $this->getDoctrine()->getManager();

        //validar parámetro
        if ($idLct) {
            $sessionUser = $this->container->get('security.context')->getToken()->getUser();
            $imgFunciones = new ImagenologiaDigitalFunciones($em);
            $validArray = $imgFunciones->verificarCreacionDiagnostico($idLct, $sessionUser);
            if (!$validArray[0]) {
                $this->addFlash('sonata_flash_error', $imgFunciones->obtenerMensajeError($validArray[1]));
                return new RedirectResponse($this->admin->generateUrl('list'));
            }
        }

        $diagnostico = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->findOneBy(array('idLectura' => $idLct));
        if ($diagnostico) {
            $this->addFlash('sonata_flash_error', 'Ya existe un registro de Diagnostico creado para esta Lectura');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }
        
        return parent::createAction();
    }
    
    public function mostrarInformacionModalAction($idLecturaPadre, $id)
    {
        //Obtener entidad lectura
        $em = $this->getDoctrine()->getManager();
        $entityLct = $em->getRepository('MinsalSimagdBundle:ImgLectura')->find($idLecturaPadre);
    	if (!$entityLct) {
                return $this->render('MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_modal_support_default.html.twig', array());
    	}
        
        //Establecimiento local
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        //Estudio
        $entityEst = $entityLct->getIdEstudio();
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
        $entityNotaDiag = $em->getRepository('MinsalSimagdBundle:ImgNotaDiagnostico')->findBy(array('idDiagnostico' => $id));

        //Historial clínico y tablas asociadas
        $entityHcl = $entityPrc->getIdSolicitudestudios()->getIdHistorialClinico();
        $entityExmFsc = $em->getRepository('MinsalSeguimientoBundle:SecSignosVitales')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));
        $entityHojaCnt =  $em->getRepository('MinsalSeguimientoBundle:SecMotivoConsulta')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));

        return $this->render('MinsalSimagdBundle:RyxDiagnosticoRadiologicoAdmin:diag_modal_support.html.twig', array(
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
            'lecturaInfo' => $entityLct,
            'notaDiagInfo' => $entityNotaDiag
        ));
    }
    
    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();

        //No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgDiagnostico', 'diag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

    	//No puede acceder al registro
    	$securityContext 	= $this->container->get('security.context');
    	$sessionUser 		= $securityContext->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        //No está autorizado a editar el registro
        if (!($em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->obtenerAccesoDiagnostico($id, $sessionUser->getId()) ||
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

        //No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgDiagnostico', 'diag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

    	//No puede acceder al registro
    	$sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
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

        $results = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->data($estabLocal->getId(), $BS_FILTERS_DECODE);

    	// $isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
    	// $isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;
    	// $allowUserCod       = (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgDiagnostico();

            $results[$key]['menu_code'] = 'transcribeddiagnosis';

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
                        '<a class=" transcribeddiagnosis-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="transcribeddiagnosis-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="transcribeddiagnosis_show"><a class=" transcribeddiagnosis_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="transcribeddiagnosis_edit"><a class=" transcribeddiagnosis_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="transcribeddiagnosis_delete"><a class=" transcribeddiagnosis_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li class="dropdown-header">LISTA DE TRABAJO</li>' .
                            '<li data-item="transcribeddiagnosis_goto"><a class=" transcribeddiagnosis_goto_action "><span class="glyphicon glyphicon-list-alt"></span>Ver lista de trabajo...</a></li>' .
                            '<li data-item="transcribeddiagnosis_approve"><a class=" transcribeddiagnosis_approve_action "><span class="glyphicon glyphicon-ok-sign"></span>Aprobar</a></li>' .
                            '<li data-item="transcribeddiagnosis_reprobate"><a class=" transcribeddiagnosis_reprobate_action "><span class="glyphicon glyphicon-remove-sign"></span>Impugnar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="transcribeddiagnosis_studydownload"><a class=" transcribeddiagnosis_studydownload_action "><span class="glyphicon glyphicon-eye-open"></span>Recuperar estudio(s)</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="transcribeddiagnosis_create"><a class=" transcribeddiagnosis_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_diagnostico'] = $formatter->dateFormatter($r['fecha_diagnostico']);
            $results[$key]['fecha_transcrito']  = $r['fecha_transcrito'] ? $formatter->dateFormatter($r['fecha_transcrito']) : null;
            $results[$key]['fecha_aprobado']    = $r['fecha_aprobado'] ? $formatter->dateFormatter($r['fecha_aprobado']) : null;
            // $results[$key]['fecha_registro']    = $formatter->dateFormatter($r['fecha_registro']);
            // $results[$key]['fecha_edicion']     = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" transcribeddiagnosis-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
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
            
            // $results[$key]['allowShow']                          = $isUser_allowShow;
            
            // $results[$key]['allowEdit']                          = (false !== $isUser_allowEdit &&
            //         ($r['diag_id_userReg'] == $sessionUser->getId() || ($r['diag_id_userMod'] == $sessionUser->getId()) ||
            //         ($r['lct_id_usrRg'] == $sessionUser->getId()) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
            
            // $results[$key]['allowNota']                          = ($this->admin->getRoutes()->has('nota') && in_array($r['diag_codEstado'], array('APR')) && (((false !== $allowUserCod) &&
            //         ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_EDIT'))) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            $results[$key]['table_dbl_click_url'] = $this->generateUrl('simagd_lectura_show', array('id' => $r['lct_id']));
        }
        
        return $this->renderJson($results);
    }
    
    public function transcribirDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from diagnostico
        $lectura            = $request->request->get('formDiagIdLectura');
        $this->get('request')->request->set('__lct', $lectura ? $lectura : null);

        //Nueva instancia
        $diagnostico        = $this->admin->getNewInstance();
        // $diagnostico = new ImgDiagnostico();
        
        $empleado           = $request->request->get('formDiagIdEmpleado');
        $estado             = $request->request->get('formDiagIdEstado');
        $patron             = $request->request->get('formDiagIdPatronAplicado');
        $hallazgos          = $request->request->get('formDiagHallazgos');
        $conclusion         = $request->request->get('formDiagConclusion');
        $recomendaciones    = $request->request->get('formDiagRecomendaciones');
        $incidencias        = $request->request->get('formDiagIncidencias');
        $observaciones      = $request->request->get('formDiagObservaciones');
        $errores            = $request->request->get('formDiagErrores');
        
        $em = $this->getDoctrine()->getManager();
        
        //Empleado
        $empleadoReference  = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $diagnostico->setIdEmpleado($empleadoReference);
        //Estado
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico', $estado);
        $diagnostico->setIdEstadoDiagnostico($estadoReference);
        if ($patron)
        {
	    //Patrón
	    $patronReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico', $patron);
	    $diagnostico->setIdPatronAplicado($patronReference);
        }
        
        $diagnostico->setHallazgos($hallazgos);
        $diagnostico->setConclusion($conclusion);
        $diagnostico->setRecomendaciones($recomendaciones);
        $diagnostico->setIncidencias($incidencias);
        $diagnostico->setIncidencias($observaciones);
        $diagnostico->setErrores($errores);

        //Crear registro
        try {
            /*$diagnostico    = */$this->admin->create($diagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
    }
    
    public function editarDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from diagnostico
        $id                 = $request->request->get('formDiagId');
        
        //Objeto
        $diagnostico        = $this->admin->getObject($id);
        
        $empleado           = $request->request->get('formDiagIdEmpleado');
        $estado             = $request->request->get('formDiagIdEstado');
        $patron             = $request->request->get('formDiagIdPatronAplicado');
        $hallazgos          = $request->request->get('formDiagHallazgos');
        $conclusion         = $request->request->get('formDiagConclusion');
        $recomendaciones    = $request->request->get('formDiagRecomendaciones');
        $incidencias        = $request->request->get('formDiagIncidencias');
        $observaciones      = $request->request->get('formDiagObservaciones');
        $errores            = $request->request->get('formDiagErrores');
        
        $em = $this->getDoctrine()->getManager();
        
        //Empleado
        $empleadoReference  = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $diagnostico->setIdEmpleado($empleadoReference);
        //Estado
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico', $estado);
        $diagnostico->setIdEstadoDiagnostico($estadoReference);
        if ($patron)
        {
	    //Patrón
	    $patronReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPatronDiagnostico', $patron);
	    $diagnostico->setIdPatronAplicado($patronReference);
        }
        
        $diagnostico->setHallazgos($hallazgos);
        $diagnostico->setConclusion($conclusion);
        $diagnostico->setRecomendaciones($recomendaciones);
        $diagnostico->setIncidencias($incidencias);
        $diagnostico->setIncidencias($observaciones);
        $diagnostico->setErrores($errores);
        
        //Actualizar registro
        try {
            /*$diagnostico    = */$this->admin->update($diagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
    }
    
    public function approveTranscribedDiagnosisAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $em = $this->getDoctrine()->getManager();
	
        //Get parameter from diagnostico
        $id = $request->request->get('id');
        
        //Objeto
        $diagnostico        = $this->admin->getObject($id);
        
        //Estado
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico', '6');
        $diagnostico->setIdEstadoDiagnostico($estadoReference);
        
        $diagnostico->setErrores('');
        
        //Actualizar registro
        try {
            /*$diagnostico    = */$this->admin->update($diagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
    }

}