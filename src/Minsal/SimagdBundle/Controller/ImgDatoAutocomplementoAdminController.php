<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class ImgDatoAutocomplementoAdminController extends Controller
{
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
