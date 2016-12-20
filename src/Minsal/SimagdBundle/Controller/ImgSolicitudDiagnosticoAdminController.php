<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Admin\BaseFieldDescription;
use Sonata\AdminBundle\Util\AdminObjectAclData;
use Sonata\AdminBundle\Admin\AdminInterface;
use Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class ImgSolicitudDiagnosticoAdminController extends Controller
{
    /**
     * Create action
     * 
     * @return \Minsal\SimagdBundle\Controller\RedirectResponse
     */
    public function createAction()
    {
	//Acceso denegado
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        //Get parameter from Preinscripcion, Estudio
        if (!$this->get('request')->query->get('preinscripcion')) { $this->get('request')->query->set('preinscripcion', null); }
        if (!$this->get('request')->query->get('estudio')) { $this->get('request')->query->set('estudio', null); }
        
        //Set the parameters
        $idPrcRequest = $this->get('request')->query->get('preinscripcion');
        $idEstRequest = $this->get('request')->query->get('estudio');
        
        $em = $this->getDoctrine()->getManager();

        //validar parámetros
        if ($idPrcRequest || $idEstRequest) {
            $sessionUser = $this->container->get('security.context')->getToken()->getUser();
            $imgFunciones = new ImagenologiaDigitalFunciones($em);
            $validArray = $imgFunciones->verificarCreacionSolicitudDiagnostico($idPrcRequest, $idEstRequest, $sessionUser);
            if (!$validArray[0]) {
                $this->addFlash('sonata_flash_error', $imgFunciones->obtenerMensajeError($validArray[1]));
                return new RedirectResponse($this->admin->generateUrl('list'));
            }
        }

        $solDiag = $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')
						->findOneBy(array('idSolicitudEstudio' => $idPrcRequest, 'idEstudio' => $idEstRequest));
        if ($solDiag) {
            $this->addFlash('sonata_flash_error', 'Ya existe un registro de Solicitud de Diagnostico creado para este Estudio');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }
        
        return parent::createAction();
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
    
    public function mostrarInformacionModalAction($idSolicitudEstudioPadre, $idEstudioPadre, $id)
    {
        //Obtener entidad estudio
        $em = $this->getDoctrine()->getManager();
        $entityEst = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->find($idEstudioPadre);
	if (!$entityEst) {
            return $this->render('MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_modal_support_default.html.twig', array());
	}
        
        //Establecimiento local
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        //Expediente local e información del paciente
	$entityExp = $em->getRepository('MinsalSiapsBundle:MntExpediente')
		                        ->findOneBy(array('idEstablecimiento' => $estabLocal,
		                                        'idPaciente' => $entityEst->getIdExpediente()->getIdPaciente()->getId()
		                                    ));
        //Solicitud de estudio
        $entityPrc = $entityEst->getIdProcedimientoRealizado()->getIdSolicitudEstudio();

        //Lectura, si esta existe
        $entityLct = $em->getRepository('MinsalSimagdBundle:ImgLectura')->findOneBy(array('idEstudio' => $entityEst->getId()));
        $entityDiag = $entityLct ? $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')
                                        ->findOneBy(array('idLectura' => $entityLct->getId())) : null;

        //Historial clínico y tablas asociadas
        $entityHcl = $entityPrc->getIdSolicitudestudios()->getIdHistorialClinico();
        $entityExmFsc = $em->getRepository('MinsalSeguimientoBundle:SecSignosVitales')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));
        $entityHojaCnt =  $em->getRepository('MinsalSeguimientoBundle:SecMotivoConsulta')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));

        return $this->render('MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_modal_support.html.twig', array(
            'expedienteInfo' => $entityExp,
            'pacienteInfo' => $entityPrc->getIdExpediente()->getIdPaciente(),
            'historiaClinicaInfo' => $entityHcl,
            'examenFisicoInfo' => $entityExmFsc,
            'hojaContinuacionInfo' => $entityHojaCnt,
            'preinscripcionInfo' => $entityPrc,
            'citaInfo' => $entityEst->getIdProcedimientoRealizado()->getIdCitaProgramada(),
            'procedimientoRealizadoInfo' => $entityEst->getIdProcedimientoRealizado(),
            'estudioPacienteInfo' => $entityEst,
            'lecturaInfo' => $entityLct,
            'diagnosticoInfo' => $entityDiag,
        ));
    }
    
    public function editAction($id = null) {
	//Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();

	//No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgSolicitudDiagnostico', 'soldiag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

	//No está autorizado a editar el registro
	$securityContext 	= $this->container->get('security.context');
	$sessionUser 		= $securityContext->getToken()->getUser();
        if (!(($em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')->obtenerAccesoSolDiag($id, $sessionUser->getId()) ||
                $securityContext->isGranted('ROLE_ADMIN')) && $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')
                                ->obtenerAccesoSolDiagEstabEdit($id, $sessionUser->getIdEstablecimiento()->getId()))) {
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
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgSolicitudDiagnostico', 'soldiag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

	//No puede acceder al registro
	$sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')->obtenerAccesoSolDiagEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
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
    
    public function listarSolicitudesDiagnosticoAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);
        
        $em                 = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')->obtenerSolicitudesDiagnosticoV2($estabLocal->getId(), $BS_FILTERS_DECODE);
                                        
	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;
        
        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico();
            
            $resultados[$key]['soldiag_fechaCreacion'] = $resultado['soldiag_fechaCreacion']->format('Y-m-d H:i:s A');
            $resultados[$key]['soldiag_fechaProximaConsulta']   = $resultado['soldiag_fechaProximaConsulta']->format('Y-m-d');
            
            $resultados[$key]['allowShow']                      = $isUser_allowShow;
            
            $resultados[$key]['allowEdit']                      = (false !== $isUser_allowEdit && ($estabLocal->getId() == $resultado['prc_id_origen']) &&
                    ($resultado['soldiag_id_userReg'] == $sessionUser->getId() || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function crearSolicitudDiagAction(Request $request)
    {
        $request->isXmlHttpRequest();
        $status                 = 'OK';
	
        //Get parameter from form
        $preinscripcion         = $request->request->get('formSolicitudDiagIdSolicitudEstudio');
        $this->get('request')->request->set('preinscripcion', $preinscripcion ? $preinscripcion : null);
        $estudio                = $request->request->get('formSolicitudDiagIdEstudio');
        $this->get('request')->request->set('estudio', $estudio ? $estudio : null);
        
        $empleado               = $request->request->get('formSolicitudDiagIdEmpleado');
        $remota                 = $request->request->get('formSolicitudDiagRemota') ? TRUE : FALSE;
        $solicitado             = $request->request->get('formSolicitudDiagIdEstablecimientoSolicitado');
        $justificacion = $request->request->get('formSolicitudDiagJustificacion');
        $observaciones          = $request->request->get('formSolicitudDiagObservaciones');
        $fechaProximaConsulta   = $request->request->get('formSolicitudDiagFechaProximaConsulta');

        //Nueva instancia
        $solicitudDiag          = $this->admin->getNewInstance();
//        $solicitudDiag = new ImgSolicitudDiagnostico();
        
        $em                     = $this->getDoctrine()->getManager();
        
        /** */
        $solicitudDiag->setFechaProximaConsulta(\DateTime::createFromFormat('Y-m-d', $fechaProximaConsulta));
        $solicitudDiag->setJustificacion($justificacion);
        $solicitudDiag->setObservaciones($observaciones);
        $solicitudDiag->setSolicitudRemota($remota);
        /** */
        
        //Empleado
        $empleadoReference      = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $solicitudDiag->setIdEmpleado($empleadoReference);
        //Estado
        $estabReference         = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $solicitado);
        $solicitudDiag->setIdEstablecimientoSolicitado($estabReference);

        //Crear registro
        try {
            /*$solicitudDiag      = */$this->admin->create($solicitudDiag);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response               = new Response();
        $response->setContent(json_encode(
                array('id' => $solicitudDiag->getId(),
                    'status' => $status,
//                    'url' => $this->admin->generateUrl('show', array('id' => $nuevoBloqueo->getId()))
                )));
        return $response;
    }
    
    public function editarSolicitudDiagAction(Request $request)
    {
        $request->isXmlHttpRequest();
        $status                 = 'OK';
	
        //Get parameter from Solicitud diagnostico
        $id                     = $request->request->get('formSolicitudDiagId');
        
        $empleado               = $request->request->get('formSolicitudDiagIdEmpleado');
        $remota                 = $request->request->get('formSolicitudDiagRemota') ? TRUE : FALSE;
        $solicitado             = $request->request->get('formSolicitudDiagIdEstablecimientoSolicitado');
        $justificacion = $request->request->get('formSolicitudDiagJustificacion');
        $observaciones          = $request->request->get('formSolicitudDiagObservaciones');
        $fechaProximaConsulta   = $request->request->get('formSolicitudDiagFechaProximaConsulta');
        
        //Objeto
        $solicitudDiag          = $this->admin->getObject($id);
//        $solicitudDiag = new ImgSolicitudDiagnostico();
        
        $em                     = $this->getDoctrine()->getManager();
        
        /** */
        $solicitudDiag->setFechaProximaConsulta(\DateTime::createFromFormat('Y-m-d', $fechaProximaConsulta));
        $solicitudDiag->setJustificacion($justificacion);
        $solicitudDiag->setObservaciones($observaciones);
        $solicitudDiag->setSolicitudRemota($remota);
        /** */
        
        //Empleado
        $empleadoReference      = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $solicitudDiag->setIdEmpleado($empleadoReference);
        //Estado
        $estabReference         = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $solicitado);
        $solicitudDiag->setIdEstablecimientoSolicitado($estabReference);
        
        //Actualizar registro
        try {
            /*$solicitudDiag      = */$this->admin->update($solicitudDiag);
        } catch (Exception $e) {
            $status             = 'failed';
        }
        
        $response               = new Response();
        $response->setContent(json_encode(
                array('id' => $solicitudDiag->getId(),
                    'status' => $status,
//                    'url' => $this->admin->generateUrl('show', array('id' => $nuevoBloqueo->getId()))
                )));
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