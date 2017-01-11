<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Admin\BaseFieldDescription;
use Sonata\AdminBundle\Util\AdminObjectAclData;
use Sonata\AdminBundle\Admin\AdminInterface;
use Minsal\SimagdBundle\Entity\ImgCita;
use Doctrine\ORM\EntityRepository;

class ImgBloqueoAgendaAdminController extends Controller
{
    public function nuevoBloqueoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        $titulo         = $request->request->get('formBlAgdTitulo');
        $descripcion    = $request->request->get('formBlAgdDescripcion');
        $diaCompleto    = $request->request->get('formBlAgdDiaCompleto') ? TRUE : FALSE;
        $fechaInicio    = $request->request->get('formBlAgdFechaInicio');
        $fechaFin       = $request->request->get('formBlAgdFechaFin');
        $horaInicio     = $request->request->get('formBlAgdHoraInicio');
        $horaFin        = $request->request->get('formBlAgdHoraFin');
        $color          = $request->request->get('formBlAgdColor');
        
        $idAreaServicioDiagnostico    = $request->request->get('formBlAgdIdAreaServicioDiagnostico') ? $request->request->get('formBlAgdIdAreaServicioDiagnostico') : null;
        $idRadiologoBloqueo = $request->request->get('formBlAgdIdRadiologoBloqueo') ? $request->request->get('formBlAgdIdRadiologoBloqueo') : null;

        //Nueva instancia
        $nuevoBloqueo   = $this->admin->getNewInstance();
        
        //Cambio de estado de registro
        $em             = $this->getDoctrine()->getManager();
        
        $nuevoBloqueo->setTitulo($titulo);
        $nuevoBloqueo->setDescripcion($descripcion);
        $nuevoBloqueo->setDiaCompleto($diaCompleto);
        $nuevoBloqueo->setFechaInicio(\DateTime::createFromFormat('Y-m-d', $fechaInicio));
        $nuevoBloqueo->setFechaFin(\DateTime::createFromFormat('Y-m-d', $fechaFin));
        $nuevoBloqueo->setHoraInicio(\DateTime::createFromFormat('H:i', $horaInicio));
        $nuevoBloqueo->setHoraFin(\DateTime::createFromFormat('H:i', $horaFin));
        $nuevoBloqueo->setColor($color);
        
        //Modalidad en caso de ser enviada
        if ($idAreaServicioDiagnostico) {
            $modalidadReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $idAreaServicioDiagnostico);
            $nuevoBloqueo->setIdAreaServicioDiagnostico($modalidadReference);
        }
        
        //Radiólogo en caso de ser enviado
        if ($idRadiologoBloqueo) {
            $radiologoReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $idRadiologoBloqueo);
            $nuevoBloqueo->setIdRadiologoBloqueo($radiologoReference);
        }
        
        //Crear registro
        try {
            /*$nuevoBloqueo = */$this->admin->create($nuevoBloqueo);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(
                array('id' => $nuevoBloqueo->getId(),
//                    'description' => $this->crearDescripcionEvento($nuevoBloqueo),
//                    'url' => $this->admin->generateUrl('show', array('id' => $nuevoBloqueo->getId()))
                )));
        return $response;
    }
    
    public function actualizarBloqueoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        $id             = $request->request->get('formBlAgdId');
	
        $titulo         = $request->request->get('formBlAgdTitulo');
        $descripcion    = $request->request->get('formBlAgdDescripcion');
        $diaCompleto    = $request->request->get('formBlAgdDiaCompleto') ? TRUE : FALSE;
        $fechaInicio    = $request->request->get('formBlAgdFechaInicio');
        $fechaFin       = $request->request->get('formBlAgdFechaFin');
        $horaInicio     = $request->request->get('formBlAgdHoraInicio');
        $horaFin        = $request->request->get('formBlAgdHoraFin');
        $color          = $request->request->get('formBlAgdColor');
        
        $idAreaServicioDiagnostico    = $request->request->get('formBlAgdIdAreaServicioDiagnostico') ? $request->request->get('formBlAgdIdAreaServicioDiagnostico') : null;
        $idRadiologoBloqueo = $request->request->get('formBlAgdIdRadiologoBloqueo') ? $request->request->get('formBlAgdIdRadiologoBloqueo') : null;
        
        //Objeto
        $editBloqueo    = $this->admin->getObject($id);
        
        //Cambio de estado de registro
        $em             = $this->getDoctrine()->getManager();
        
        $editBloqueo->setTitulo($titulo);
        $editBloqueo->setDescripcion($descripcion);
        $editBloqueo->setDiaCompleto($diaCompleto);
        $editBloqueo->setFechaInicio(\DateTime::createFromFormat('Y-m-d', $fechaInicio));
        $editBloqueo->setFechaFin(\DateTime::createFromFormat('Y-m-d', $fechaFin));
        $editBloqueo->setHoraInicio(\DateTime::createFromFormat('H:i', $horaInicio));
        $editBloqueo->setHoraFin(\DateTime::createFromFormat('H:i', $horaFin));
        $editBloqueo->setColor($color);
        
        //Modalidad en caso de ser enviada
        if ($idAreaServicioDiagnostico) {
            $modalidadReference = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $idAreaServicioDiagnostico);
            $editBloqueo->setIdAreaServicioDiagnostico($modalidadReference);
        } else {
            $editBloqueo->setIdAreaServicioDiagnostico($idAreaServicioDiagnostico);
        }
        
        //Radiólogo en caso de ser enviado
        if ($idRadiologoBloqueo) {
            $radiologoReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $idRadiologoBloqueo);
            $editBloqueo->setIdRadiologoBloqueo($radiologoReference);
        } else {
            $editBloqueo->setIdRadiologoBloqueo($idRadiologoBloqueo);
        }
        
        //Actualizar registro
        try {
            /*$editBloqueo = */$this->admin->update($editBloqueo);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }
    
    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS             = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);
        
        $em                     = $this->getDoctrine()->getManager();
        
        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();
        
        $resultados             = $em->getRepository('MinsalSimagdBundle:ImgBloqueoAgenda')->obtenerBloqueosAgendaV2($estabLocal->getId(), $BS_FILTERS_DECODE);
        
        $isUser_allowShow       = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit       = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('actualizarBloqueo')) ? TRUE : FALSE;
        $isUser_allowRemove     = ($this->admin->isGranted('DELETE') && $this->admin->getRoutes()->has('removerBloqueo')) ? TRUE : FALSE;
        
        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgBloqueoAgenda();
            
            $resultados[$key]['blAgd_fechaCreacion']        = $resultado['blAgd_fechaCreacion']->format('Y-m-d H:i:s A');
            $resultados[$key]['blAgd_fechaUltimaEdicion']   = $resultado['blAgd_fechaUltimaEdicion'] ? $resultado['blAgd_fechaUltimaEdicion']->format('Y-m-d H:i:s A') : '';

            $resultados[$key]['blAgd_fechaInicio']	= $resultado['blAgd_fechaInicio']->format('Y-m-d');
            $resultados[$key]['blAgd_fechaFin']		= $resultado['blAgd_fechaFin']->format('Y-m-d');
            $resultados[$key]['blAgd_horaInicio']	= $resultado['blAgd_horaInicio']->format('H:i:s A');
            $resultados[$key]['blAgd_horaFin']      	= $resultado['blAgd_horaFin']->format('H:i:s A');
            
            $resultados[$key]['allowShow']	= $isUser_allowShow;
            
            $resultados[$key]['allowEdit']	= $isUser_allowEdit;
            
            $resultados[$key]['allowRemove']	= $isUser_allowRemove;
            
            $resultados[$key]['blAgd_bloqueoExclusionesBloqueo']	= $em->getRepository('MinsalSimagdBundle:ImgBloqueoAgenda')->obtenerExclusionesBloqueo($resultado['blAgd_id']);
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function removerBloqueoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        $id             = $request->request->get('id');
        
        //Objeto
        $removeBloqueo  = $this->admin->getObject($id);
        
        //Actualizar registro
        try {
            $this->admin->delete($removeBloqueo);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

    public function excluirRadiologoBloqueoAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $status = 'OK';
        
        $id                 = $request->request->get('formBlAgdExclRadxIdBloqueoAgenda');
        $object_blAgd       = $this->admin->getObject($id);     // get object
        $request_radiologos = $request->request->get('formBlAgdExclRadxIdRadiologoExcluido');	// array []
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $em                 = $this->getDoctrine()->getManager();
        
//         $object_blAgd       = new \Minsal\SimagdBundle\Entity\ImgBloqueoAgenda();
        
        /*
         * Radiólogos excluidos
         */
        $arr_radxExcluded   = array();
        foreach ($object_blAgd->getBloqueoExclusionesBloqueo() as $collection_radiologo)  {
            $arr_radxExcluded[] = $collection_radiologo->getIdRadiologoExcluido()->getId();
            if (!in_array($collection_radiologo->getIdRadiologoExcluido()->getId(), $request_radiologos)) {
                $object_blAgd->removeBloqueoExclusionesBloqueo($collection_radiologo);    // --| remove from collection if is not in request
            }
        }
        foreach ($request_radiologos as $request_radiologo)  {
            if (!in_array($request_radiologo, $arr_radxExcluded)) {
		$new_exclBlAgd	= new \Minsal\SimagdBundle\Entity\ImgExclusionBloqueo();
		$new_exclBlAgd->setIdBloqueoAgenda($object_blAgd);
                $ref_excludedRadx = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $request_radiologo);
		$new_exclBlAgd->setIdRadiologoExcluido($ref_excludedRadx);
                $object_blAgd->addBloqueoExclusionesBloqueo($new_exclBlAgd);              // --| add to collection if is not in, but is in request
            }
        }
        
        //Actualizar registro
        try {
            /*$object_blAgd = */$this->admin->update($object_blAgd);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(
                array(
                    'id' => $object_blAgd->getId(),
                    'status' => $status,
                )));
        return $response;
    }


//    http://www.ubuntu-es.org/node/156275#.VXHDGM2UcW0
//    http://stackoverflow.com/questions/5575935/how-to-load-different-event-source-json-for-each-view
//    http://forums.asp.net/t/1717483.aspx?FullCalendar+prevent+Drag+Resize+on+Condition
//    http://fullcalendar.io/js/fullcalendar-2.3.2/demos/basic-views.html
//    https://www.google.com.sv/search?q=fullcalendar+event+all+days&oq=fullcalendar+event+all+days&aqs=chrome..69i57.16959j0j1&sourceid=chrome&es_sm=122&ie=UTF-8#q=full+calendar+event+every+monday
//    http://iamceege.github.io/tooltipster/

}
