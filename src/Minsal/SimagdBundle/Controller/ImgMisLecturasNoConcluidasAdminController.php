<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class ImgMisLecturasNoConcluidasAdminController extends MinsalSimagdBundleGeneralAdminController
{
    public function leerAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        
        $this->addFlash('sonata_flash_success', 'Registro extraido de mi lista de estudios no leidos.');
        return $this->redirect($this->generateUrl('simagd_sin_lectura_leer', array('id' => $id)));
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

        $resultados = $em->getRepository('MinsalSimagdBundle:ImgPendienteLectura')->assignedWorkList($estabLocal->getId(), $sessionUser->getId(), $BS_FILTERS_DECODE);

        $isUser_allowInterpretar = ($this->admin->getRoutes()->has('leer') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgPendienteLectura();

            $resultados[$key]['pndL_fechaIngresoLista'] = $resultado['pndL_fechaIngresoLista']->format('Y-m-d H:i:s A');
            $resultados[$key]['est_fechaEstudio'] = $resultado['est_fechaEstudio']->format('Y-m-d H:i:s A');
            $resultados[$key]['lct_fechaLectura'] = $resultado['lct_fechaLectura']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['prz_fechaAtendido'] = $resultado['prz_fechaAtendido'] ? $resultado['prz_fechaAtendido']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaRealizado'] = $resultado['prz_fechaRealizado'] ? $resultado['prz_fechaRealizado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaProcesado'] = $resultado['prz_fechaProcesado'] ? $resultado['prz_fechaProcesado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaAlmacenado'] = $resultado['prz_fechaAlmacenado'] ? $resultado['prz_fechaAlmacenado']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['prc_fechaCreacion'] = $resultado['prc_fechaCreacion'] ? $resultado['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['solcmpl_fechaSolicitud'] = $resultado['solcmpl_fechaSolicitud'] ? $resultado['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';

            $resultados[$key]['lct_editUrl'] = $this->generateUrl('simagd_lectura_edit', array('id' => $resultado['lct_id'], '__est' => $resultado['est_id'], '__estPdr' => $resultado['estPdr_id']));

            $resultados[$key]['allowInterpretar'] = $isUser_allowInterpretar;
        }

        return $this->renderJson($results);
    }

}