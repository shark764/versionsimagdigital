<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\ImgPendienteValidacion;

class ImgPendienteValidacionAdminController extends Controller
{
    public function validarAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }
        
        if ($object->getFueCorregido()) {   $this->addFlash('sonata_flash_info', 'Transcripción ha sido corregida'); }
        else {  $this->addFlash('sonata_flash_success', 'Transcripción ha sido concluida'); }
                
        return $this->redirect($this->generateUrl('simagd_diagnostico_edit', array('id' => $object->getIdDiagnostico()->getId())));
    }
    
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return $this->render($this->admin->getTemplate('list'));
    }
    
    public function listarPendientesValidacionAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS             = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);
        
        $em                     = $this->getDoctrine()->getManager();

	$securityContext        = $this->container->get('security.context');
	$sessionUser           = $securityContext->getToken()->getUser();
        $estabLocal             = $sessionUser->getIdEstablecimiento();

        $resultados             = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->obtenerPendientesValidacionV2($estabLocal->getId(), $sessionUser/*->getId()*/, $BS_FILTERS_DECODE);
        
        $isUser_allowValidate   = ($this->admin->getRoutes()->has('validar') &&
                    ((($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT')) &&
                    ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT'))) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        
        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SimagdBundle\Entity\ImgPendienteValidacion;

            $resultados[$key]['diag_fechaTranscrito']    = $resultado['diag_fechaTranscrito'] ? $resultado['diag_fechaTranscrito']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaCorregido']     = $resultado['diag_fechaCorregido'] ? $resultado['diag_fechaCorregido']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['diag_fechaAprobado']      = $resultado['diag_fechaAprobado'] ? $resultado['diag_fechaAprobado']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['lct_fechaLectura']                   = $resultado['lct_fechaLectura']->format('Y-m-d H:i:s A');
            $resultados[$key]['pndV_fechaIngresoLista']             = $resultado['pndV_fechaIngresoLista']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['allowValidate']                      = $isUser_allowValidate;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function asignarElementoListaTrabajoAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
	$status     = 'OK';
        
        /*
         * request
         */
        $id_radX    = $request->request->get('__radx');
        $pndV_rows  = $request->request->get('__ar_rowsAffected');
        
        $em         = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:ImgPendienteValidacion')
                        ->asignarElementoListaTrabajo($estabLocal->getId(), $id_radX, $sessionUser->getIdEmpleado()->getId(), $pndV_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response   = new Response();
        $response->setContent(json_encode(array('update' => $status)));
        return $response;
    }
    
}