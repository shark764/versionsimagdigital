<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Entity\ImgCtlMaterialEstablecimiento;

class ImgCtlMaterialAdminController extends Controller
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
        
//        $em = $this->getDoctrine()->getManager();
//
//	//No existe el registro
//        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccion', 'expl')) {
//            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
//        }
        
        return parent::editAction($id);
    }
    
    public function showAction($id = null) {
	//Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
//        $em = $this->getDoctrine()->getManager();
//
//	//No existe el registro
//        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlProyeccion', 'expl')) {
//            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
//        }
        
        return parent::showAction($id);
    }
    
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return $this->render($this->admin->getTemplate('list'));
    }
    
    public function listarMaterialesAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);
        
        $em                 = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $resultados         = $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')->obtenerMaterialesV2($BS_FILTERS_DECODE);

	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgCtlMaterial();

            $resultados[$key]['mtrl_fechaHoraReg']  = $resultado['mtrl_fechaHoraReg']->format('Y-m-d H:i:s A');
            $resultados[$key]['mtrl_fechaHoraMod']  = $resultado['mtrl_fechaHoraMod'] ? $resultado['mtrl_fechaHoraMod']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['allowShow']          = $isUser_allowShow;
            
            $resultados[$key]['allowEdit']          = $isUser_allowEdit;
            
            $resultados[$key]['allowAgregarLc']     = ($this->admin->getRoutes()->has('agregarEnMiCatalogo') &&
                    false === $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')->existeMaterialEnLocalV2($estabLocal->getId(), $resultado['mtrl_id']) &&
                    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_MATERIAL_ESTABLECIMIENTO_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function crearMaterialAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $em                 = $this->getDoctrine()->getManager();
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Nueva instancia
        $material           = $this->admin->getNewInstance();
//        $material = new \Minsal\SimagdBundle\Entity\ImgCtlMaterial();
        
        $nombre             = $request->request->get('formMtrlNombre');
        $codigo             = $request->request->get('formMtrlCodigo');
        $descripcion        = $request->request->get('formMtrlDescripcion');
        
        $material->setNombre($nombre);
        $material->setCodigo($codigo);
        $material->setDescripcion($descripcion);

        //Crear registro
        try {
            /*$material       = */$this->admin->create($material);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $cantidadDisponible = $request->request->get('formMtrlCantidadDisponibleLocal');
        $habilitado         = $this->get('request')->request->get('formMtrlHabilitadoLocal') ? TRUE : FALSE;
        $descripcionLocal   = $request->request->get('formMtrlDescripcionLocal');
        $local              = $request->request->get('formMtrlAgregarEnLocal') ? TRUE : FALSE;

        if ($local) {
            /** ImgCtlMaterialEstablecimiento */
            $mtrLocal       = new ImgCtlMaterialEstablecimiento();
            $mtrLocal->setIdMaterial($material);
            $mtrLocal->setIdEstablecimiento($estabLocal);
            if ($cantidadDisponible) {
		$mtrLocal->setCantidadDisponible($cantidadDisponible);
            }
            $mtrLocal->setHabilitado($habilitado);
            $mtrLocal->setDescripcion($descripcionLocal);
            $mtrLocal->setIdUserReg($sessionUser);
            $mtrLocal->setFechaHoraReg(new \DateTime('now'));

	    //Crear registro
	    try {
		$em->persist($mtrLocal);
		$em->flush();
	    } catch (Exception $e) {
		$status = 'failed';
	    }
        }
        
        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    public function editarMaterialAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $em             = $this->getDoctrine()->getManager();
	
        //Get parameter from diagnostico
        $id             = $request->request->get('formMtrlId');
        
        //Objeto
        $material       = $this->admin->getObject($id);
//        $material = new \Minsal\SimagdBundle\Entity\ImgCtlMaterial();
        
        $nombre         = $request->request->get('formMtrlNombre');
        $codigo         = $request->request->get('formMtrlCodigo');
        $descripcion    = $request->request->get('formMtrlDescripcion');
        
        $material->setNombre($nombre);
        $material->setCodigo($codigo);
        $material->setDescripcion($descripcion);
        
        //Actualizar registro
        try {
            /*$material       = */$this->admin->update($material);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

}
