<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\SimagdBundle\Entity\ImgNotaDiagnostico;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class ImgNotaDiagnosticoAdminController extends Controller
{

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
	//Acceso denegado
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
    
    public function editAction($id = null) {
	//Acceso denegado
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
    
    public function showAction($id = null) {
	//Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();

	//No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgNotaDiagnostico', 'notdiag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

	//No puede acceder al registro
	$sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgNotaDiagnostico')->obtenerAccesoNotDiagEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
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
    
    public function listarNotasDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);
        
        $em                 = $this->getDoctrine()->getManager();

	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgNotaDiagnostico')->obtenerNotasDiagnosticoV2($estabLocal->getId(), $BS_FILTERS_DECODE);

	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgNotaDiagnostico();

            $resultados[$key]['diag_fechaTranscrito']    = $resultado['diag_fechaTranscrito'] ? $resultado['diag_fechaTranscrito']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaCorregido']     = $resultado['diag_fechaCorregido'] ? $resultado['diag_fechaCorregido']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaAprobado']      = $resultado['diag_fechaAprobado'] ? $resultado['diag_fechaAprobado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaRegistro']      = $resultado['diag_fechaRegistro']->format('Y-m-d H:i:s A');
            $resultados[$key]['lct_fechaLectura']                   = $resultado['lct_fechaLectura']->format('Y-m-d H:i:s A');
            $resultados[$key]['notdiag_fechaEmision']       = $resultado['notdiag_fechaEmision']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['allowShow']                          = $isUser_allowShow;
            
            $resultados[$key]['allowEdit']                          = (false !== $isUser_allowEdit &&
                    ($resultado['notdiag_id_userReg'] == $sessionUser->getId() || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        }
        
        $response           = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function crearNotaAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        //Get parameter from diagnostico
        $diagnostico        = $request->request->get('formNotaIdDiagnostico');
        $this->get('request')->request->set('diagnostico', $diagnostico ? $diagnostico : null);

        //Nueva instancia
        $nota               = $this->admin->getNewInstance();
//        $nota = new ImgNotaDiagnostico();
        
        $empleado           = $request->request->get('formNotaIdEmpleado');
        $tipo               = $request->request->get('formNotaIdTipoNotaDiagnostico');
        $notaDiag           = $request->request->get('formNotaContenido');
        $observaciones      = $request->request->get('formNotaObservaciones');
        
        $em                 = $this->getDoctrine()->getManager();
        
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
            $nota           = $this->admin->create($nota);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response           = new Response();
        $response->setContent(json_encode(array()));
        return $response;
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
        
        $em                 = $this->getDoctrine()->getManager();
        
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
            $nota           = $this->admin->update($nota);
        } catch (Exception $e) {
            $status         = 'failed';
        }
        
        $response = new Response();
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
    
}