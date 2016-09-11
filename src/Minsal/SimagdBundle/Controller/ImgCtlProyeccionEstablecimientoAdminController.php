<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SiapsBundle\Entity\MntAreaExamenEstablecimiento;

class ImgCtlProyeccionEstablecimientoAdminController extends Controller
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
    
    public function createAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
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
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccionEstablecimiento', 'explrz')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

	//No puede acceder al registro
	$sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
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
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccionEstablecimiento', 'explrz')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

	//No puede acceder al registro
	$sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
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
    
    public function listarProyeccionesLocalesAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);
        
        $em                 = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerProyeccionesLocalesV2($estabLocal->getId(), $BS_FILTERS_DECODE);

	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento();

            $resultados[$key]['expl_fechaHoraReg']      = $resultado['expl_fechaHoraReg']->format('Y-m-d H:i:s A');
            $resultados[$key]['explrz_fechaHoraReg']    = $resultado['explrz_fechaHoraReg']->format('Y-m-d H:i:s A');
            $resultados[$key]['explrz_fechaHoraMod']    = $resultado['explrz_fechaHoraMod'] ? $resultado['explrz_fechaHoraMod']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['allowShow']              = $isUser_allowShow;
            
            $resultados[$key]['allowEdit']              = $isUser_allowEdit;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function agregarProyeccionEnLocalAction()
    {
        $proyeccion        = $this->get('request')->request->get('formExplExplrzIdProyeccion');

        $observaciones      = $this->get('request')->request->get('formExplExplrzObservaciones');
        $habilitado         = $this->get('request')->request->get('formExplExplrzHabilitado') ? TRUE : FALSE;
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        /** CtlAreaServicioDiagnostico */
        $areaSrvApy         = $this->get('request')->request->get('formExplExplrzIdAreaServicioDiagnostico');
        /** CtlExamenServicioDiagnostico */
        $exmSrvApy          = $this->get('request')->request->get('formExplExplrzIdExamenServicioDiagnostico');

        //Nueva instancia
        $proyeccionRz      = $this->admin->getNewInstance();

        //Proyección
        $em                 = $this->getDoctrine()->getManager();
        $proyeccionRef     = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlProyeccion', $proyeccion);
        $proyeccionRz->setIdProyeccion($proyeccionRef);

        //Observaciones
        $proyeccionRz->setObservaciones($observaciones);
        //Habilitado
        $proyeccionRz->setHabilitado($habilitado);

        $areaExmEstab       = $em->getRepository('MinsalSiapsBundle:MntAreaExamenEstablecimiento')
                                        ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(), 'idAreaServicioDiagnostico' => $areaSrvApy, 'idExamenServicioDiagnostico' => $exmSrvApy));

        if (!$areaExmEstab) {
            /** CtlAreaServicioDiagnostico */
            $areaSrvApyRef      = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $areaSrvApy);
            /** CtlExamenServicioDiagnostico */
            $exmSrvApyRef       = $em->getReference('Minsal\SiapsBundle\Entity\CtlExamenServicioDiagnostico', $exmSrvApy);

            /** MntAreaExamenEstablecimiento */
            $areaExamenEstab    = new MntAreaExamenEstablecimiento();
            $areaExamenEstab->setIdAreaServicioDiagnostico($areaSrvApyRef);
            $areaExamenEstab->setIdExamenServicioDiagnostico($exmSrvApyRef);
            $areaExamenEstab->setIdEstablecimiento($sessionUser->getIdEstablecimiento());
            $areaExamenEstab->setIdUsuarioReg($sessionUser);
            $areaExamenEstab->setFechaHoraReg(new \DateTime('now'));
            $em->persist($areaExamenEstab);
            $em->flush();

            $proyeccionRz->setIdAreaExamenEstab($areaExamenEstab);
        } else {
            //Area Examen Estab
            $proyeccionRz->setIdAreaExamenEstab($areaExmEstab);
        }

        //Crear registro
        try {
            /*$proyeccionRz      = */$this->admin->create($proyeccionRz);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    public function crearProyeccionLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $securityContext        = $this->container->get('security.context');
        $sessionUser           = $securityContext->getToken()->getUser();
        $estabLocal             = $sessionUser->getIdEstablecimiento();

        //Nueva instancia
        $proyeccionRz          = $this->admin->getNewInstance();
//        $proyeccionRz = new \Minsal\SimagdBundle\Entity\ImgCtlProyeccionEstablecimiento();
        
        $habilitado             = $request->request->get('formExplrzHabilitado') ? TRUE : FALSE;
        $observaciones          = $request->request->get('formExplrzObservaciones');
        
        $area                   = $request->request->get('formExplrzIdAreaServicioDiagnostico');
        $examen                 = $request->request->get('formExplrzIdExamenServicioDiagnostico');
        $proyeccion            = $request->request->get('formExplrzIdProyeccion');
        
        $em                     = $this->getDoctrine()->getManager();
        
        //Proyeccion
        $proyeccionReference   = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlProyeccion', $proyeccion);
        $proyeccionRz->setIdProyeccion($proyeccionReference);
        
        $proyeccionRz->setObservaciones($observaciones);
        $proyeccionRz->setHabilitado($habilitado);
            
        $areaExmEstab           = $em->getRepository('MinsalSiapsBundle:MntAreaExamenEstablecimiento')
                                            ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
                                                                'idAreaServicioDiagnostico' => $area,
                                                                'idExamenServicioDiagnostico' => $examen
                                                ));
        $proyeccionRz->setIdAreaExamenEstab($areaExmEstab);

        //Crear registro
        try {
            /*$proyeccionRz      = */$this->admin->create($proyeccionRz);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    public function editarProyeccionLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $securityContext        = $this->container->get('security.context');
        $sessionUser           = $securityContext->getToken()->getUser();
        $estabLocal             = $sessionUser->getIdEstablecimiento();
	
        //Get parameter from proyección
        $id                     = $request->request->get('formExplrzId');
        
        //Objeto
        $proyeccionRz          = $this->admin->getObject($id);
        
        $habilitado             = $request->request->get('formExplrzHabilitado') ? TRUE : FALSE;
        $observaciones          = $request->request->get('formExplrzObservaciones');
        
        $area                   = $request->request->get('formExplrzIdAreaServicioDiagnostico');
        $examen                 = $request->request->get('formExplrzIdExamenServicioDiagnostico');
        $proyeccion            = $request->request->get('formExplrzIdProyeccion');
        
        $em                     = $this->getDoctrine()->getManager();
        
        //Proyeccion
        $proyeccionReference   = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlProyeccion', $proyeccion);
        $proyeccionRz->setIdProyeccion($proyeccionReference);
        
        $proyeccionRz->setObservaciones($observaciones);
        $proyeccionRz->setHabilitado($habilitado);
            
        $areaExmEstab           = $em->getRepository('MinsalSiapsBundle:MntAreaExamenEstablecimiento')
                                            ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
                                                                'idAreaServicioDiagnostico' => $area,
                                                                'idExamenServicioDiagnostico' => $examen
                                                    ));
        $proyeccionRz->setIdAreaExamenEstab($areaExmEstab);
        
        //Actualizar registro
        try {
            /*$proyeccionRz      = */$this->admin->update($proyeccionRz);
        } catch (Exception $e) {
            $status = 'failed';
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

    public function habilitarLocalAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $id             = $request->request->get('id');
        $proyeccionRz  = $this->admin->getObject($id);

        $habilitado     = $request->request->get('formExplrzHabilitado');

        $em             = $this->getDoctrine()->getManager();

        //Habilitar
        $proyeccionRz->setHabilitado($habilitado);

        //Actualizar Proyección
        try {
            /*$proyeccionRz = */$this->admin->update($proyeccionRz);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

}
