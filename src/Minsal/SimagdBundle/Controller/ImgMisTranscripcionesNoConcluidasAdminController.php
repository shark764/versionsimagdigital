<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class ImgMisTranscripcionesNoConcluidasAdminController extends MinsalSimagdBundleGeneralAdminController
{
    public function transcribirAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        
        $this->addFlash('sonata_flash_success', 'Registro extraido de mi lista de transcripciones no concluidas.');
        return $this->redirect($this->generateUrl('simagd_sin_transcribir_transcribir', array('id' => $id)));
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
        
        $BS_FILTERS             = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);
        
        $em = $this->getDoctrine()->getManager();

        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $resultados = $em->getRepository('MinsalSimagdBundle:RyxLecturaPendienteTranscripcion')->assignedWorkList($estabLocal->getId(), $sessionUser->getId(), $BS_FILTERS_DECODE);
        
        $isUser_allowTranscribir = ($this->admin->getRoutes()->has('transcribir') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\RyxLecturaPendienteTranscripcion();

            $resultados[$key]['diag_fechaTranscrito'] = $resultado['diag_fechaTranscrito'] ? $resultado['diag_fechaTranscrito']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaCorregido'] = $resultado['diag_fechaCorregido'] ? $resultado['diag_fechaCorregido']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaAprobado'] = $resultado['diag_fechaAprobado'] ? $resultado['diag_fechaAprobado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['lct_fechaLectura'] = $resultado['lct_fechaLectura']->format('Y-m-d H:i:s A');
            $resultados[$key]['pndT_fechaIngresoLista'] = $resultado['pndT_fechaIngresoLista']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['allowTranscribir'] = $isUser_allowTranscribir;
        }
        
        return $this->renderJson($results);
    }

}