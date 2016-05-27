<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\SimagdBundle\Entity\ImgDiagnostico;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class ImgDiagnosticoAdminController extends Controller
{
    /**
     * 
     * @return type
     */
    public function notaAction()  {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }
        
        $this->addFlash('sonata_flash_info', 'Agregue una nota al diagnóstico');

        return $this->redirect($this->generateUrl('simagd_nota_create', array('diagnostico' => $id)));
    }

    /**
     * Redirect the user depend on this choice
     *
     * @param object $object
     *
     * @return RedirectResponse
     */
    protected function redirectTo($object)
    {
        $url = false;

        if (null !== $this->get('request')->get('btn_update_and_list')) {
            $url = $this->admin->generateUrl('list');
        }
        if (null !== $this->get('request')->get('btn_create_and_list')) {
            $url = $this->admin->generateUrl('list');
        }

        if (null !== $this->get('request')->get('btn_create_and_create')) {
            $params = array();
            if ($this->admin->hasActiveSubClass()) {
                $params['subclass'] = $this->get('request')->get('subclass');
            }
            $url = $this->admin->generateUrl('create', $params);
        }

        if ($this->getRestMethod() == 'DELETE') {
            $url = $this->admin->generateUrl('list');
        }

        /** Crear/Actualizar y mostrar registro */
        if ((null !== $this->get('request')->get('btn_create_and_show')) ||
                                (null !== $this->get('request')->get('btn_edit_and_show'))) {
    		$url = $this->admin->generateObjectUrl('show', $object);
        }

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
    }
    
    public function agregarPendienteAction()
    {
        //Get parameter from lectura
        if (!$this->get('request')->request->get('__lct')) { $this->get('request')->request->set('__lct', null); }

        //Nueva instancia
        $diagnostico        = $this->admin->getNewInstance();
        
        //Cambio de estado de registro
        $em                 = $this->getDoctrine()->getManager();
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico', '1'); //Inicial
        $diagnostico->setIdEstadoDiagnostico($estadoReference);

        //Crear registro
        try {
            $diagnostico    = $this->admin->create($diagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response           = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    /**
     * Create action
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction()
    {
	//Acceso denegado
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

        return $this->render('MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_modal_support.html.twig', array(
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
    
    public function editAction($id = null) {
	//Acceso denegado
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
    
    public function showAction($id = null) {
	//Acceso denegado
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
    
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return $this->render($this->admin->getTemplate('list'));
    }
    
    public function listarDiagnosticosAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);
        
        $em                 = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->obtenerDiagnosticosV2($estabLocal->getId(), $BS_FILTERS_DECODE);

	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;
	$allowUserCod       = (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('MED', 'TRY'))) ? TRUE : FALSE;
        
        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgDiagnostico();

            $resultados[$key]['diag_fechaTranscrito']    = $resultado['diag_fechaTranscrito'] ? $resultado['diag_fechaTranscrito']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaCorregido']     = $resultado['diag_fechaCorregido'] ? $resultado['diag_fechaCorregido']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaAprobado']      = $resultado['diag_fechaAprobado'] ? $resultado['diag_fechaAprobado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaRegistro']      = $resultado['diag_fechaRegistro']->format('Y-m-d H:i:s A');
            $resultados[$key]['lct_fechaLectura']                   = $resultado['lct_fechaLectura']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['allowShow']                          = $isUser_allowShow;
            
            $resultados[$key]['allowEdit']                          = (false !== $isUser_allowEdit &&
                    ($resultado['diag_id_userReg'] == $sessionUser->getId() || ($resultado['diag_id_userMod'] == $sessionUser->getId()) ||
                    ($resultado['lct_id_usrRg'] == $sessionUser->getId()) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
            
            $resultados[$key]['allowNota']                          = ($this->admin->getRoutes()->has('nota') && in_array($resultado['diag_codEstado'], array('APR')) && (((false !== $allowUserCod) &&
                    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_EDIT'))) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function transcribirDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from diagnostico
        $lectura            = $request->request->get('formDiagIdLectura');
        $this->get('request')->request->set('__lct', $lectura ? $lectura : null);

        //Nueva instancia
        $diagnostico        = $this->admin->getNewInstance();
//        $diagnostico = new ImgDiagnostico();
        
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
            $diagnostico    = $this->admin->create($diagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response           = new Response();
        $response->setContent(json_encode(array()));
        return $response;
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
        
        $em                 = $this->getDoctrine()->getManager();
        
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
            $diagnostico    = $this->admin->update($diagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response           = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    public function getObjectVarsAsArrayAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from object
        $id = $request->request->get('id');
        
        //Objeto
        $object = $this->admin->getObject($id);
        
        $response = new Response();
        $response->setContent(json_encode(
                array('id' => $object->getId(),
                        'object' => $object->getObjectVarsAsArray()
//                        'url' => $this->admin->generateUrl('show', array('id' => $object->getId()))
                )));
        return $response;
    }
    
    public function aprobarDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $em                 = $this->getDoctrine()->getManager();
	
        //Get parameter from diagnostico
        $id                 = $request->request->get('id');
        
        //Objeto
        $diagnostico        = $this->admin->getObject($id);
        
        //Estado
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoDiagnostico', '6');
        $diagnostico->setIdEstadoDiagnostico($estadoReference);
        
        $diagnostico->setErrores('');
        
        //Actualizar registro
        try {
            $diagnostico    = $this->admin->update($diagnostico);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response           = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

}