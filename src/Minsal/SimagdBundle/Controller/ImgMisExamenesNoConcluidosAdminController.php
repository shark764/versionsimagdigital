<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

class ImgMisExamenesNoConcluidosAdminController extends Controller
{
    public function realizarAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        
        $this->addFlash('sonata_flash_success', 'Registro extraido de mi lista de exámenes no concluidos.');
        return $this->redirect($this->generateUrl('simagd_sin_realizar_realizar', array('id' => $id)));
    }
    
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return $this->render($this->admin->getTemplate('list'));
    }
    
    public function listarPendientesRealizarAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS                         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE                  = json_decode($BS_FILTERS, true);
        
        $em                                 = $this->getDoctrine()->getManager();

	$securityContext                    = $this->container->get('security.context');
	$sessionUser                       = $securityContext->getToken()->getUser();
        $estabLocal                         = $sessionUser->getIdEstablecimiento();

        $resultados                         = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')->obtenerPendientesRealizarPersonalV2($estabLocal->getId(), $sessionUser->getId(), $BS_FILTERS_DECODE);
        
        $isUser_allowRealizar               = ($this->admin->getRoutes()->has('realizar') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
	$isUser_allowActualizarAlmacenado   = ($this->admin->getRoutes()->has('actualizarEstudioAlmacenado') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        
        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion;

            $resultados[$key]['pndR_fechaIngresoLista']             = $resultado['pndR_fechaIngresoLista']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['prc_fechaCreacion']    = $resultado['prc_fechaCreacion'] ? $resultado['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prc_fechaProximaConsulta']           = $resultado['prc_fechaProximaConsulta'] ? $resultado['prc_fechaProximaConsulta']->format('Y-m-d') : '';
            
            $resultados[$key]['cit_fechaCreacion']              = $resultado['cit_fechaCreacion'] ? $resultado['cit_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaConfirmacion']          = $resultado['cit_fechaConfirmacion'] ? $resultado['cit_fechaConfirmacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaReprogramacion']        = $resultado['cit_fechaReprogramacion'] ? $resultado['cit_fechaReprogramacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaHoraInicio']                = $resultado['cit_fechaHoraInicio'] ? $resultado['cit_fechaHoraInicio']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaHoraFin']                   = $resultado['cit_fechaHoraFin'] ? $resultado['cit_fechaHoraFin']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['solcmpl_fechaSolicitud']             = $resultado['solcmpl_fechaSolicitud'] ? $resultado['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['prz_fechaAtendido']                  = $resultado['prz_fechaAtendido'] ? $resultado['prz_fechaAtendido']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaRealizado']                 = $resultado['prz_fechaRealizado'] ? $resultado['prz_fechaRealizado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaProcesado']                 = $resultado['prz_fechaProcesado'] ? $resultado['prz_fechaProcesado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prz_fechaAlmacenado']                = $resultado['prz_fechaAlmacenado'] ? $resultado['prz_fechaAlmacenado']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['prz_editUrl']                        = $this->generateUrl('simagd_realizado_edit', array('id' => $resultado['prz_id']));
            
            $resultados[$key]['allowRealizar']                      = $isUser_allowRealizar;
            
            $resultados[$key]['allowActualizarAlmacenado']          = false !== $isUser_allowActualizarAlmacenado && 'ALM' !== $resultado['prz_codEstado'];
        }
        
        $response   = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
}
