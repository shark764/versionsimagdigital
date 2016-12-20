<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class BusquedaDiagnosticoAdminController extends Controller
{
    public function notaAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        
        return $this->redirect($this->generateUrl('simagd_nota_create', array('diagnostico' => $id)));
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
        
        return parent::showAction($id);
    }
    
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        return parent::listAction();
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

