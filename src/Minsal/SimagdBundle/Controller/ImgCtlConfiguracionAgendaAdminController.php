<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class ImgCtlConfiguracionAgendaAdminController extends MinsalSimagdBundleGeneralAdminController
{Application\Sonata\UserBundle\Entity\User
    
    public function createAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
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

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlConfiguracionAgenda', 'prmCit')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        // No puede acceder al registro
        $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgCtlConfiguracionAgenda')->obtenerAccesoEstabParamCit($id, $sessionUser->getIdEstablecimiento()->getId())) {
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

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlConfiguracionAgenda', 'prmCit')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        // No puede acceder al registro
        $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgCtlConfiguracionAgenda')->obtenerAccesoEstabParamCit($id, $sessionUser->getIdEstablecimiento()->getId())) {
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
        
        return parent::listAction();
    }

}