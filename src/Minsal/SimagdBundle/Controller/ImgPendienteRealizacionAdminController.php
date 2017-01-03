<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\ImgPendienteRealizacion;

use Minsal\SimagdBundle\Generator\ListViewGenerator\RyxExamenPendienteRealizacionListViewGenerator;

class ImgPendienteRealizacionAdminController extends Controller
{
    public function realizarAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }
        
        $preinscripcion = $object->getIdSolicitudEstudio()->getId();
        
        $em = $this->getDoctrine()->getManager();
        $realizado = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')->findOneBy(array('idSolicitudEstudio' => $preinscripcion));
        if (!is_null($realizado)) {
            $this->addFlash('sonata_flash_info', 'Información post-examen registrada para preinscripción de: <br/> <strong>' .
						$object->getIdSolicitudEstudio()->getIdExpediente()->getIdPaciente() . '</strong>');
            return $this->redirect($this->generateUrl('simagd_realizado_edit', array('id' => $realizado->getId())));
        }
        
        $this->addFlash('sonata_flash_success', 'Información post-examen para estudio preinscrito');
        $citaAsociada = $em->getRepository('MinsalSimagdBundle:ImgCita')->findOneBy(array('idSolicitudEstudio' => $preinscripcion));
        return $this->redirect($this->generateUrl('simagd_realizado_create',
					array('__prc' => $preinscripcion, '__cit' => $citaAsociada ? $citaAsociada->getId() : null)));
    }
    
    public function registrarEnMiListaAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $pndR           = $this->admin->getObject($id);
        if (!$pndR) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }
        
        $preinscripcion = $pndR->getIdSolicitudEstudio()->getId();

        $em             = $this->getDoctrine()->getManager();
        $citaAsociada   = $em->getRepository('MinsalSimagdBundle:ImgCita')->findOneBy(array('idSolicitudEstudio' => $preinscripcion));

        return $this->redirect($this->generateUrl('simagd_realizado_agregarPendiente',
                        array('__prc' => $preinscripcion,
                                '__cit' => $citaAsociada ? $citaAsociada->getId() : null,
                                '__pndR' => $id
                            )));
    }
    
    public function listAction() {
	   //Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em                     = $this->getDoctrine()->getManager();
        
    	$securityContext 	= $this->container->get('security.context');
    	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();
        
        $default_areaAtn        = 2;
        $default_atn            = 1;
        $sessionSpecialty       = $this->container->get('session')->get('_idEmpEspecialidadEstab');
        if ($sessionSpecialty)
        {
            //Valores para area, atencion y empleado desde session
            $specialtyObject    = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($sessionSpecialty);
            if ($specialtyObject)
            {
                $default_areaAtn    = $specialtyObject->getIdAreaModEstab()->getIdAreaAtencion()->getId();
                $default_atn        = $specialtyObject->getIdAtencion()->getId();
                
            }
        }
        
        $tiposEmpleado          = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        
        $medicos                = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                        ->obtenerEmpleadosPorTipoOperaciones($estabLocal->getId(), array(1, 2, 4))
                                                ->getQuery()->getResult();
        
        $radiologos             = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                        ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))
                                                ->getQuery()->getResult();
        
        $tiposEstab             = $em->getRepository('MinsalSiapsBundle:CtlTipoEstablecimiento')->findAll();
        
        $establecimientos       = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')
                                        ->obtenerEstabParaRefDiag('idEstablecimientoDiagnosticante')
                                                ->getQuery()->getResult();
        
        $prioridades            = $em->getRepository('MinsalSimagdBundle:ImgCtlPrioridadAtencion')->obtenerPrioridadesAtencionV2();
        
        $modalidades            = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $examenes               = $em->getRepository('MinsalSiapsBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $proyecciones           = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->findAll();
        $sexos                  = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();
        
        $areasAtencion          = $em->getRepository('MinsalSiapsBundle:CtlAreaAtencion')->findAll();
        
        $tiposAtencion          = $em->getRepository('MinsalSiapsBundle:CtlTipoAtencion')->findAll();
        $atenciones             = $em->getRepository('MinsalSiapsBundle:CtlAtencion')->findAll();
        
        /*
         * GROUP_DEPENDENT_ENTITIES
         */
        $GROUP_DEPENDENT_ENTITIES   = array();
        try {
            $GROUP_DEPENDENT_ENTITIES['m_expl']   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerProyeccionesAgrupadasV2($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }
        try {
            $GROUP_DEPENDENT_ENTITIES['ar_atn']   = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->obtenerAtencionesAgrupadasV2($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }
        try {
            $GROUP_DEPENDENT_ENTITIES['atn_emp']  = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->obtenerEmpleadosAgrupadosV2($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'           => $tiposEmpleado,
                        'medicos'               => $medicos,
                        'tiposEstab'            => $tiposEstab,
                        'establecimientos'      => $establecimientos,
			'radiologos'            => $radiologos,
			'default_empLogged'     => $sessionUser->getIdEmpleado(),
                        'defaultEstab'          => $estabLocal,
                        'prioridades'           => $prioridades,
                        'modalidades'           => $modalidades,
                        'sexos'                 => $sexos,
                        'examenes'              => $examenes,
                        'areasAtencion'         => $areasAtencion,
                        'tiposAtencion'         => $tiposAtencion,
                        'atenciones'            => $atenciones,
                        'proyecciones'          => $proyecciones,
                        'default_exmRx'         => 27,
                        'default_mldRx'         => 13,
                        'default_areaAtn'       => $default_areaAtn,
                        'default_atn'           => $default_atn,
                        'default_prAtn'         => 3,
                        'GROUP_DEPENDENT_ENTITIES'  => $GROUP_DEPENDENT_ENTITIES,
                    ));
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

        $resultados                         = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')->obtenerPendientesRealizarV2($estabLocal->getId(), $BS_FILTERS_DECODE);
        
        $isUser_allowRealizar               = ($this->admin->getRoutes()->has('realizar') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
	               $isUser_allowRegInicial             = ($this->admin->getRoutes()->has('registrarEnMiLista') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
	       $isUser_allowRegistrarAlmacenado    = ($this->admin->getRoutes()->has('registrarEstudioAlmacenado') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        
        foreach ($resultados as $key => $resultado) {
           // $resultado = new \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion;

            $resultados[$key]['pndR_fechaIngresoLista']             = $resultado['pndR_fechaIngresoLista']->format('Y-m-d H:i:s A');
            
            $resultados[$key]['prc_fechaCreacion']    = $resultado['prc_fechaCreacion'] ? $resultado['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['prc_fechaProximaConsulta']           = $resultado['prc_fechaProximaConsulta'] ? $resultado['prc_fechaProximaConsulta']->format('Y-m-d') : '';
            
            $resultados[$key]['cit_fechaCreacion']              = $resultado['cit_fechaCreacion'] ? $resultado['cit_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaConfirmacion']          = $resultado['cit_fechaConfirmacion'] ? $resultado['cit_fechaConfirmacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaReprogramacion']        = $resultado['cit_fechaReprogramacion'] ? $resultado['cit_fechaReprogramacion']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaHoraInicio']                = $resultado['cit_fechaHoraInicio'] ? $resultado['cit_fechaHoraInicio']->format('Y-m-d H:i:s A') : '';
            $resultados[$key]['cit_fechaHoraFin']                   = $resultado['cit_fechaHoraFin'] ? $resultado['cit_fechaHoraFin']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['solcmpl_fechaSolicitud']             = $resultado['solcmpl_fechaSolicitud'] ? $resultado['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';
            
            $resultados[$key]['prz_createUrl']                      = $this->generateUrl('simagd_realizado_create',
                                                                                array('__prc' => $resultado['prc_id'],
                                                                                      '__cit' => $resultado['cit_id'],
                                                                                      '__cmpl' => $resultado['solcmpl_id'],
                                                                                      '__pndR' => $resultado['pndR_id'],
                                                                                      /** 'iniciado' => $resultado['prz_id'] Pueden haber varios, iniciado diferencia cuál se editará */
                                                                                ));
            
            $resultados[$key]['allowRealizar']                      = $isUser_allowRealizar;
            
            $resultados[$key]['allowRegInicial']                    = $isUser_allowRegInicial;
            
            $resultados[$key]['allowRegistrarAlmacenado']           = $isUser_allowRegistrarAlmacenado;
        }
        
        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }
    
    public function agregarEmergenciaAction(Request $request)
    {
        $request->isXmlHttpRequest();

    	$securityContext        = $this->container->get('security.context');
    	$sessionUser           = $securityContext->getToken()->getUser();
        $estabLocal             = $sessionUser->getIdEstablecimiento();
        
        //Nueva instancia
        $pndRealizar        = $this->admin->getNewInstance();
        
       // $pndRealizar->setEsEmergencia(TRUE);
       // $pndRealizar->setIdRegistraEmergencia($sessionUser->getIdEmpleado());

        //Crear registro
        try {
            /*$pndRealizar    = */$this->admin->create($pndRealizar);
        } catch (Exception $e) {
            $status         = 'failed';
        }
        
        $response           = new Response();
        $response->setContent(json_encode(array()));
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

        $__REQUEST__slug = $request->request->get('slug');
        $__REQUEST__type = $request->request->get('type');
        
        $em = $this->getDoctrine()->getManager();

        //////// --| builder entity
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxExamenPendienteRealizacionListViewGenerator(
                $this->container,
                $this->admin->getRouteGenerator(),
                $this->admin->getClass()
                // new RyxExamenPendienteRealizacion()
        );
        //////// --|
        if ($__REQUEST__type === 'detail') {
            $ENTITY_LIST_VIEW_GENERATOR_->setType($__REQUEST__type);
            $ENTITY_LIST_VIEW_GENERATOR_->setColumns(array(
                    'field' => 'detail',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-zoom-in"></span> DETALLE',
                    'switchable' => false,
                    'formatter' => '__fnc_worklistDetailFormatter',
                ));
        }
        $options = $ENTITY_LIST_VIEW_GENERATOR_->getTable();
        
        return $this->renderJson(array(
            'result'    => 'ok',
            'options'   => $options,
            'slug'      => $__REQUEST__slug,
            'type'      => $__REQUEST__type
        ));
    }
    
}