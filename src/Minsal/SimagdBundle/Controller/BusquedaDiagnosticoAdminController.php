<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class BusquedaDiagnosticoAdminController extends MinsalSimagdBundleGeneralAdminController
{
    public function notaAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        
        return $this->redirect($this->generateUrl('simagd_nota_create', array('diagnostico' => $id)));
    }
    
    public function showAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgDiagnostico', 'diag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
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
