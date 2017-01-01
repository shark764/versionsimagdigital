<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\ImgPendienteTranscripcion;

use Minsal\SimagdBundle\Generator\ListViewGenerator\RyxLecturaPendienteTranscripcionListViewGenerator;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

class ImgPendienteTranscripcionAdminController extends Controller
{
    public function transcribirAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $lectura = $object->getIdLectura()->getId();
        
        $em = $this->getDoctrine()->getManager();
        
        $diagnostico = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->findOneBy(array('idLectura' => $lectura));
        if ($diagnostico) {
            $paciente = $diagnostico->getIdLectura()->getIdEstudio()->getIdExpediente()->getIdPaciente();
            if ($object->getFueImpugnado()) { $this->addFlash('sonata_flash_error', 'Transcripción ha sido impugnada para lectura de: <br/> <strong>' . $paciente . '</strong>'); }
            else { $this->addFlash('sonata_flash_info', 'Transcripción registrada para lectura de: <br/> <strong>' . $paciente . '</strong>'); }
            return $this->redirect($this->generateUrl('simagd_diagnostico_edit', array('id' => $diagnostico->getId())));
        }
        
        $this->addFlash('sonata_flash_success', 'Transcripción no iniciada para lectura imagenológica');
        return $this->redirect($this->generateUrl('simagd_diagnostico_create', array('lectura' => $lectura)));
    }
    
    public function registrarEnMiListaAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $pndT = $this->admin->getObject($id);
        if (!$pndT) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }
        
        $lectura = $pndT->getIdLectura()->getId();

        return $this->redirect($this->generateUrl('simagd_diagnostico_agregarPendiente', array('lectura' => $lectura)));
    }
    
    public function listAction() {
	   //Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em                 = $this->getDoctrine()->getManager();
        
    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $tiposEmpleado      = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        
        $radiologos         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                        ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))
                                        ->getQuery()->getResult();
        $transcriptores     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                        ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 4, 5, 6))
                                        ->getQuery()->getResult();
        
        $tipos              = $em->getRepository('MinsalSimagdBundle:ImgCtlTipoNotaDiagnostico')->findAll();
        $estadosDiag        = $em->getRepository('MinsalSimagdBundle:ImgCtlEstadoDiagnostico')->findAll();
        
        $modalidades        = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->findBy(array('idAtencion' => '97'));

        /** Patrones para diagnóstico */
        $patronesDiag       = $em->getRepository('MinsalSimagdBundle:ImgCtlPatronDiagnostico')
                                        ->obtenerPatronesDiagnosticoUtilizablesV2($estabLocal->getId())
                                        ->getQuery()->getResult();
        /** Fin --- Patrones para diagnóstico */

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'      => $tiposEmpleado,
                        'radiologos'        => $radiologos,
                        'tiposNota'         => $tipos,
                        'default_empLogged'        => $sessionUser->getIdEmpleado(),
                        'tipoNotaDefault'   => 1,
                        'transcriptores'    => $transcriptores,
                        'estadosDiag'       => $estadosDiag,
                        'estadoDiagDefault' => 2,
                        'modalidades'       => $modalidades,
			'patronesDiag'      => $patronesDiag,
                    ));
    }
    
    public function listarPendientesTranscripcionAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS                 = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE          = json_decode($BS_FILTERS, true);
        
        $em                         = $this->getDoctrine()->getManager();

    	$securityContext            = $this->container->get('security.context');
    	$sessionUser               = $securityContext->getToken()->getUser();
        $estabLocal                 = $sessionUser->getIdEstablecimiento();

        $resultados                 = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')->obtenerPendientesTranscripcionV2($estabLocal->getId(), $BS_FILTERS_DECODE);
        
        $isUser_allowTranscribir    = ($this->admin->getRoutes()->has('transcribir') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
	   $isUser_allowRegInicial     = ($this->admin->getRoutes()->has('registrarEnMiLista') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        
        foreach ($resultados as $key => $resultado) {
           // $resultado = new \Minsal\SimagdBundle\Entity\ImgPendienteTranscripcion();

            $resultados[$key]['lct_fechaLectura']       = $resultado['lct_fechaLectura']->format('Y-m-d H:i:s A');
            $resultados[$key]['pndT_fechaIngresoLista'] = $resultado['pndT_fechaIngresoLista']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['allowTranscribir']       = $isUser_allowTranscribir;
            
            $resultados[$key]['allowRegInicial']        = $isUser_allowRegInicial;
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
        $id_trcX    = $request->request->get('__trcx');
        $pndT_rows  = $request->request->get('__ar_rowsAffected');
        
        $em         = $this->getDoctrine()->getManager();
        
    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:ImgPendienteTranscripcion')
                            ->asignarElementoListaTrabajo($estabLocal->getId(), $id_trcX, $sessionUser->getIdEmpleado()->getId(), $pndT_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response   = new Response();
        $response->setContent(json_encode(array('update' => $status)));
        return $response;
    }

    /**
     * TABLE GENERATOR
     *
     * @param Request $request
     *
     * @return Response
     */
    public function generateTableAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $em = $this->getDoctrine()->getManager();

        //////// --| builder entity
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxLecturaPendienteTranscripcionListViewGenerator(
                $this->container,
                $this->admin->getRouteGenerator(),
                $this->admin->getClass(),
                // new RyxLecturaPendienteTranscripcion()
        );
        //////// --|
        $options = $ENTITY_LIST_VIEW_GENERATOR_->getTable();
        
        return $this->renderJson(array(
            'result'    => 'ok',
            'options'   => $options
        ));
    }

}