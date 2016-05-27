<?php

namespace Minsal\SimagdBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\SimagdBundle\Entity\ImgSolicitudEstudio;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sonata\AdminBundle\Exception\ModelManagerException;

class ImagenologiaDigitalAdminController extends Controller
{
    /**
     * Redirigir inmediatamente hacia la busqueda de paciente
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function listAction() {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return new RedirectResponse($this->admin->generateUrl('busquedaPaciente'));
    }

    /**
     *
     * @return type
     */
    public function busquedaPacienteAction()
    {
	//Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        //Get parameters
        if (!$this->get('request')->query->get('__exp')) {
            $this->get('request')->query->set('__exp', null);
        }

        $id_expRequest      = $this->get('request')->query->get('__exp');

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

        $tiposAtencion   = $em->getRepository('MinsalSiapsBundle:CtlTipoAtencion')->findAll();
        $atenciones             = $em->getRepository('MinsalSiapsBundle:CtlAtencion')->findAll();

        $expRequest         = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($id_expRequest ? $id_expRequest : '-1');
        
        $collection_tiposEmpleado  = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        $collection_radiologos     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))->getQuery()->getResult();
        $collection_prioridades    = $em->getRepository('MinsalSimagdBundle:ImgCtlPrioridadAtencion')->obtenerPrioridadesAtencionV2();
        $collection_modalidades    = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $collection_examenes       = $em->getRepository('MinsalSiapsBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $collection_proyecciones   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->findAll();
        $collection_sexos          = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();
        
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

        return $this->render($this->admin->getTemplate('busquedaPaciente'),
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
                        'expRequest'    => $expRequest,
                        'GROUP_DEPENDENT_ENTITIES'  => $GROUP_DEPENDENT_ENTITIES,
                        'collection_tiposEmpleado'  => $collection_tiposEmpleado,
                        'collection_radiologos'     => $collection_radiologos,
                        'collection_default_empLogged'  => $sessionUser->getIdEmpleado(),
                        'collection_prioridades'    => $collection_prioridades,
                        'collection_modalidades'    => $collection_modalidades,
                        'collection_sexos'          => $collection_sexos,
                        'collection_examenes'       => $collection_examenes,
                        'collection_proyecciones'   => $collection_proyecciones,
                        'collection_default_exmRx'  => 27,
                        'collection_default_mldRx'  => 13,
                        'collection_default_prAtn'  => 3,
                    ));
    }

    /**
     *
     * @return type
     */
    public function resultadosBusquedaPacienteAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS             = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);

	$securityContext 	= $this->container->get('security.context');
	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        /*
	* NUM. de Expediente en búsqueda mínima.
	*/
        $min_numeroExp          = $this->get('request')->query->get('min_numeroExp') ? $this->get('request')->query->get('min_numeroExp') : null;
        /*
        * NUM. de Expediente en búsqueda mínima.
        */

        $em                     = $this->getDoctrine()->getManager();

        $resultados             = null;

        if (!$min_numeroExp)
        {
	    $limiteResultados   = $this->get('request')->query->get('limitarResultados') ?
		    $this->get('request')->query->get('limitarResultados') : 100;

	    $numeroExp          = $this->get('request')->query->get('numeroExp');
	    $dui                = $this->get('request')->query->get('dui');

	    $primerNombre       = $this->get('request')->query->get('primerNombre');
	    $segundoNombre      = $this->get('request')->query->get('segundoNombre');
	    $tercerNombre       = $this->get('request')->query->get('tercerNombre');
	    $primerApellido     = $this->get('request')->query->get('primerApellido');
	    $segundoApellido    = $this->get('request')->query->get('segundoApellido');

	    $fechaNacimiento    = $this->get('request')->query->get('fechaNacimiento') ?
					\DateTime::createFromFormat('Y-m-d', $this->get('request')->query->get('fechaNacimiento')) : null;

	    $criteria           = array();
	    if ($primerNombre) {
                $criteria['primerNombre']       = trim($primerNombre);
            }
	    if ($segundoNombre) {
                $criteria['segundoNombre']      = trim($segundoNombre);
            }
	    if ($tercerNombre) {
                $criteria['tercerNombre']       = trim($tercerNombre);
            }
	    if ($primerApellido) {
                $criteria['primerApellido']     = trim($primerApellido);
            }
	    if ($segundoApellido) {
                $criteria['segundoApellido']    = trim($segundoApellido);
            }

	    $resultados     = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
				    ->obtenerPacientesV2($estabLocal->getId(), $numeroExp, $criteria, $fechaNacimiento, $dui, $limiteResultados, $BS_FILTERS_DECODE);
	} else {
	    /** ********* Obtención de resultados de búsqueda Mínima *** */
	    /**
	    *NUM Expediente como criterio
	    */
	    $resultados     = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
			  ->obtenerPacientesV2($estabLocal->getId(), null, array(), null, null, 100, $min_numeroExp, $BS_FILTERS_DECODE);
	}

	$allowPreinscribir  = ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE') ||
                    $securityContext->isGranted('ROLE_ADMIN')) ? TRUE : FALSE;

        foreach ($resultados as $key => $resultado) {
//            $resultado = new \Minsal\SiapsBundle\Entity\MntExpediente();

            $resultados[$key]['pct_fechaNacimiento']    = $resultado['pct_fechaNacimiento'] ? $resultado['pct_fechaNacimiento']->format('Y-m-d') : '';
            $resultados[$key]['pct_horaNacimiento']     = $resultado['pct_horaNacimiento'] ? $resultado['pct_horaNacimiento']->format('H:i:s A') : '';
            $resultados[$key]['prc_createUrl']          = $this->generateUrl('simagd_solicitud_estudio_create', array('__exp' => $resultado['exp_id']));

            $resultados[$key]['allowShow']              = TRUE;

            $resultados[$key]['allowPreinscribir']      = $allowPreinscribir;
        }

        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

    /**
     *
     * @return type
     */
    public function accesoDenegadoAction()
    {
        return $this->render($this->admin->getTemplate('accesoDenegado'));
    }

    /**
     *
     * @return type
     */
    public function registroNoEncontradoAction()
    {
        return $this->render($this->admin->getTemplate('registroNoEncontrado'));
    }

    /**
     *
     * @return type
     */
    public function historialImagenologiaPacienteAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $idExpediente = $this->get('request')->query->get('idExpediente');

        $idEstablecimiento = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        $em = $this->getDoctrine()->getManager();

        //Expediente local e información del paciente
	$entityExp = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($idExpediente);

	$preinscripcionesPctReg = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
					->obtenerPreinscripcionesEstabPorPaciente($idExpediente, $idEstablecimiento);
	$citasPctReg = $em->getRepository('MinsalSimagdBundle:ImgCita')
					->obtenerCitasEstabPorPaciente($idExpediente, $idEstablecimiento);
	$procedimientosRealizadosPctReg = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')
					->obtenerExamenesRealizadosEstabPorPaciente($idExpediente, $idEstablecimiento);
	$diagnosticosPctReg = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')
					->obtenerDiagnosticosEstabPorPaciente($idExpediente, $idEstablecimiento);

        return $this->render($this->admin->getTemplate('historialImagenologiaPaciente'),
			array('idExpediente' => $idExpediente,
				'expedienteInfo' => $entityExp,
				'pacienteInfo' => $entityExp->getIdPaciente(),
				'preinscripcionesPctReg' => $preinscripcionesPctReg,
				'citasPctReg' => $citasPctReg,
				'procedimientosRealizadosPctReg' => $procedimientosRealizadosPctReg,
				'diagnosticosPctReg' => $diagnosticosPctReg,
			));
    }

    public function listarSolicitudesEstudioPacienteAction()
    {
        $em = $this->getDoctrine()->getManager();

	$securityContext 	= $this->container->get('security.context');
	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $expediente = $this->get('request')->query->get('__exp');

        $solicitudes = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
					->obtenerPreinscripcionesEstabPorPaciente($expediente, $estabLocal->getId());

        $resultados = array();
        foreach ($solicitudes as $solicitud)  {
//            $solicitud = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio();

            $resultado['id'] = $solicitud->getId();
            $resultado['origen'] = $solicitud->getIdAtenAreaModEstab()->getIdEstablecimiento()->getNombre();
            $resultado['empleado'] = $solicitud->getIdEmpleado()->getApellido() . ', ' . $solicitud->getIdEmpleado()->getNombre();
            $resultado['areaAtencion'] = $solicitud->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion()->getNombre();
            $resultado['atencion'] = $solicitud->getIdAtenAreaModEstab()->getIdAtencion()->getNombre();
            $resultado['referido'] = $solicitud->getIdEstablecimientoReferido()->getNombre();
            $resultado['modalidad'] = $solicitud->getIdAreaServicioDiagnostico()->getNombrearea();
            $resultado['diagnosticante'] = $solicitud->getIdEstablecimientoDiagnosticante() ? $solicitud->getIdEstablecimientoDiagnosticante()->getNombre() : '';
            $resultado['fechaCreacion'] = $solicitud->getFechaCreacion()->format('Y-m-d H:i:s A');
            $resultado['fechaProximaConsulta'] = $solicitud->getFechaProximaConsulta()->format('Y-m-d');

            $resultados[] = $resultado;
        }

        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

    public function listarCitasPacienteAction()
    {
        $em = $this->getDoctrine()->getManager();

	$securityContext 	= $this->container->get('security.context');
	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $expediente = $this->get('request')->query->get('__exp');

        $citas = $em->getRepository('MinsalSimagdBundle:ImgCita')
					->obtenerCitasEstabPorPaciente($expediente, $estabLocal->getId());

        $resultados = array();
        foreach ($citas as $cita)  {
//            $cita = new \Minsal\SimagdBundle\Entity\ImgCita();

            $solicitud = $cita->getIdSolicitudEstudio();

            $resultado['id'] = $cita->getId();
            $resultado['origen'] = $solicitud->getIdAtenAreaModEstab()->getIdEstablecimiento()->getNombre();
            $resultado['solicitante'] = $solicitud->getIdEmpleado()->getApellido() . ', ' . $solicitud->getIdEmpleado()->getNombre();
            $resultado['areaAtencion'] = $solicitud->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion()->getNombre();
            $resultado['atencion'] = $solicitud->getIdAtenAreaModEstab()->getIdAtencion()->getNombre();
            $resultado['modalidad'] = $solicitud->getIdAreaServicioDiagnostico()->getNombrearea();
            $resultado['diagnosticante'] = $solicitud->getIdEstablecimientoDiagnosticante() ? $solicitud->getIdEstablecimientoDiagnosticante()->getNombre() : '';
            $resultado['solicitada'] = $solicitud->getFechaCreacion()->format('Y-m-d H:i:s A');
            $resultado['fechaProximaConsulta'] = $solicitud->getFechaProximaConsulta()->format('Y-m-d');
            $resultado['empleado'] = $cita->getIdEmpleado()->getApellido() . ', ' . $cita->getIdEmpleado()->getNombre();
            $resultado['estado'] = $cita->getIdEstadoCita()->getNombreEstado();
            $resultado['fechaCreacion'] = $cita->getFechaCreacion()->format('Y-m-d H:i:s A');
            $resultado['inicio'] = $cita->getFechaHoraInicio()->format('Y-m-d H:i:s A');
            $resultado['fin'] = $cita->getFechaHoraFin()->format('Y-m-d H:i:s A');
            $resultado['confirmada'] = $cita->getFechaConfirmacion() ? $cita->getFechaConfirmacion()->format('Y-m-d H:i:s A') : '';
            $resultado['reprogramada'] = $cita->getReprogramada();

            $resultados[] = $resultado;
        }

        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

    public function listarExamenesPacienteAction()
    {
        $em = $this->getDoctrine()->getManager();

	$securityContext 	= $this->container->get('security.context');
	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $expediente = $this->get('request')->query->get('__exp');

        $examenes = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')
					->obtenerExamenesRealizadosEstabPorPaciente($expediente, $estabLocal->getId());

        $resultados = array();
        foreach ($examenes as $examen)  {
//            $examen = new \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado();

            $resultado['id'] = $examen->getId();
            $resultado['origen'] = $examen->getIdSolicitudEstudio()->getIdAtenAreaModEstab()->getIdEstablecimiento()->getNombre();
            $resultado['solicitante'] = $examen->getIdSolicitudEstudio()->getIdEmpleado()->getApellido() . ', ' . $examen->getIdSolicitudEstudio()->getIdEmpleado()->getNombre();
            $resultado['areaAtencion'] = $examen->getIdSolicitudEstudio()->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion()->getNombre();
            $resultado['atencion'] = $examen->getIdSolicitudEstudio()->getIdAtenAreaModEstab()->getIdAtencion()->getNombre();
            $resultado['modalidad'] = $examen->getIdSolicitudEstudio()->getIdAreaServicioDiagnostico()->getNombrearea();
            $resultado['tecnologo'] = $examen->getIdTecnologoRealiza()->getApellido() . ', ' . $examen->getIdTecnologoRealiza()->getNombre();
            $resultado['estado'] = $examen->getIdEstadoProcedimientoRealizado()->getNombreEstado();
            $resultado['realizado'] = $examen->getFechaRealizado() ? $examen->getFechaRealizado()->format('Y-m-d H:i:s A') : '';
            $resultado['procesado'] = $examen->getFechaProcesado() ? $examen->getFechaProcesado()->format('Y-m-d H:i:s A') : '';
            $resultado['almacenado'] = $examen->getFechaAlmacenado() ? $examen->getFechaAlmacenado()->format('Y-m-d H:i:s A') : '';

            $resultados[] = $resultado;
        }

        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

    public function listarDiagnosticosPacienteAction()
    {
        $em = $this->getDoctrine()->getManager();

	$securityContext 	= $this->container->get('security.context');
	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $expediente = $this->get('request')->query->get('__exp');

        $diagnosticos = $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')
					->obtenerDiagnosticosEstabPorPaciente($expediente, $estabLocal->getId());

        $resultados = array();
        foreach ($diagnosticos as $diagnostico)  {
//            $diagnostico = new \Minsal\SimagdBundle\Entity\ImgDiagnostico();

            $examen = $diagnostico->getIdLectura()->getIdEstudio()->getIdProcedimientoRealizado();
            $solicitud = $examen->getIdSolicitudEstudio();

            $resultado['id'] = $diagnostico->getId();
            $resultado['origen'] = $solicitud->getIdAtenAreaModEstab()->getIdEstablecimiento()->getNombre();
            $resultado['solicitante'] = $solicitud->getIdEmpleado()->getApellido() . ', ' . $solicitud->getIdEmpleado()->getNombre();
            $resultado['areaAtencion'] = $solicitud->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion()->getNombre();
            $resultado['atencion'] = $solicitud->getIdAtenAreaModEstab()->getIdAtencion()->getNombre();
            $resultado['modalidad'] = $solicitud->getIdAreaServicioDiagnostico()->getNombrearea();
            $resultado['tecnologo'] = $examen->getIdTecnologoRealiza()->getApellido() . ', ' . $examen->getIdTecnologoRealiza()->getNombre();
            $resultado['estado'] = $diagnostico->getIdEstadoDiagnostico()->getNombreEstado();
            $resultado['transcriptor'] = $diagnostico->getIdEmpleado()->getApellido() . ', ' . $diagnostico->getIdEmpleado()->getNombre();
            $resultado['transcrito'] = $diagnostico->getFechaTranscrito() ? $diagnostico->getFechaTranscrito()->format('Y-m-d H:i:s A') : '';
            $resultado['radiologo'] = $diagnostico->getIdLectura()->getIdEmpleado()->getApellido() . ', ' . $diagnostico->getIdLectura()->getIdEmpleado()->getNombre();
            $resultado['aprobado'] = $diagnostico->getFechaAprobado() ? $diagnostico->getFechaAprobado()->format('Y-m-d H:i:s A') : '';
            $resultado['correlativo'] = $diagnostico->getIdLectura()->getCorrelativo();
            $resultado['interpretado'] = $diagnostico->getIdLectura()->getFechaLectura()->format('Y-m-d H:i:s A');

            $resultados[] = $resultado;
        }

        $response = new Response();
        $response->setContent(json_encode($resultados));
        return $response;
    }

    /**
     *
     * @return type
     */
    public function listarDatosPacienteAction()
    {
        $em = $this->getDoctrine()->getManager();

//	$securityContext 	= $this->container->get('security.context');
//	$sessionUser 		= $securityContext->getToken()->getUser();
//        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $expediente = $this->get('request')->query->get('__exp');

        //Expediente local e información del paciente
	$entityExp = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($expediente);

        return $this->render($this->admin->getTemplate('listarDatosPaciente'),
			array(
				'expedienteInfo' => $entityExp,
				'pacienteInfo' => $entityExp->getIdPaciente()
			));
    }

    /*
     * getJsonFiltersForBsTables
     */
    public function getJsonFiltersForBsTablesAction(Request $request)
    {
        $request->isXmlHttpRequest();

	$status             = 'OK';

        $BS_SOURCES         = $this->get('request')->query->get('sources');
        $BS_SOURCES_DECODE  = json_decode($BS_SOURCES, true);

        $em                 = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $resultados         = array();
        /** Coincidencias en campos de texto */
        if (in_array('stdroot', $BS_SOURCES_DECODE) || in_array('stdlct', $BS_SOURCES_DECODE) || in_array('stdref', $BS_SOURCES_DECODE) || in_array('stdiag', $BS_SOURCES_DECODE) || in_array('stdsol', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['stdroot']      = $resultados['stdlct']
                                            = $resultados['stdref']
                                            = $resultados['stdiag']
                                            = $resultados['stdsol']
                                            = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')
                                                    ->getSourceDataOrigen($estabLocal->getId());
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('ar', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['ar']           = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                    ->getSourceDataAreaAtencion($estabLocal->getId());
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('atn', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['atn']          = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
                                                    ->getSourceDataAtencion($estabLocal->getId());
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('m', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['m']            = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')
                                                    ->getSourceDataModalidad($estabLocal->getId());
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('empprc', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['empprc']       = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                                    ->getSourceDataSolicitante($estabLocal->getId(), array(1, 2, 4));
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('empcit', $BS_SOURCES_DECODE) || in_array('empblAgd', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['empcit']       = $resultados['empblAgd']
                                            = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                                    ->getSourceDataAdministrativo($estabLocal->getId(), array(1, 2, 6, 7));
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('tcnlcit', $BS_SOURCES_DECODE) || in_array('tcnlprz', $BS_SOURCES_DECODE) || in_array('emplct', $BS_SOURCES_DECODE) || in_array('empdiag', $BS_SOURCES_DECODE) || in_array('radx', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['tcnlcit']      = $resultados['tcnlprz']
                                            = $resultados['emplct']
                                            = $resultados['empdiag']
                                            = $resultados['radx']
                                            = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                                    ->getSourceDataRadiologo($estabLocal->getId(), array(4, 5));
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('statuscit', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['statuscit']    = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')
                                                    ->getSourceDataEstado($estabLocal->getId(), 'cit');
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('statusprz', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['statusprz']    = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')
                                                    ->getSourceDataEstado($estabLocal->getId(), 'prz');
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('statuslct', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['statuslct']    = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')
                                                    ->getSourceDataEstado($estabLocal->getId(), 'lct');
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('statusdiag', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['statusdiag']   = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')
                                                    ->getSourceDataEstado($estabLocal->getId(), 'diag');
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('tipoR', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['tipoR']        = $em->getRepository('MinsalSimagdBundle:ImgLectura')
                                                    ->getSourceDataTipo($estabLocal->getId(), 'tipoR');
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('tipoN', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['tipoN']        = $em->getRepository('MinsalSimagdBundle:ImgLectura')
                                                    ->getSourceDataTipo($estabLocal->getId(), 'tipoN');
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('prAtn', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['prAtn']        = $em->getRepository('MinsalSimagdBundle:ImgCtlPrioridadAtencion')
                                                    ->obtenerPrioridadesAtencionV2('scalar');
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('expl', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['expl']         = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')
                                                    ->obtenerProyeccionesScalarV2();
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }
        if (in_array('mtrl', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['mtrl']         = $em->getRepository('MinsalSimagdBundle:ImgCtlMaterial')
                                                    ->obtenerMaterialesScalarV2();
            } catch (Exception $e) {
                $status                     = 'failed';
            }
        }

        $response           = new Response();
        $response->setContent(json_encode(
                array(
                    'status'    => $status,
                    'sources'   => $resultados
                )
       ));
        return $response;
    }

    /*
     * getJsonFiltersForBsTables
     */
    public function getJsonGroupDependentEntitiesAction(Request $request)
    {
        $request->isXmlHttpRequest();

	$status             = 'OK';

        $BS_SOURCES         = $this->get('request')->query->get('sources');
        $BS_SOURCES_DECODE  = json_decode($BS_SOURCES, true);

        $em                 = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $resultados         = array();
        /** Coincidencias en campos de texto */
        if (in_array('m_expl', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['m_expl']   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerProyeccionesAgrupadasV2($estabLocal->getId());
            } catch (Exception $e) {
                $status                 = 'failed';
            }
        }
        if (in_array('ar_atn', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['ar_atn']   = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->obtenerAtencionesAgrupadasV2($estabLocal->getId());
            } catch (Exception $e) {
                $status                 = 'failed';
            }
        }
        if (in_array('atn_emp', $BS_SOURCES_DECODE))
        {
            try {
                $resultados['atn_emp']  = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->obtenerEmpleadosAgrupadosV2($estabLocal->getId());
            } catch (Exception $e) {
                $status                 = 'failed';
            }
        }

        $response           = new Response();
        $response->setContent(json_encode(
                array(
                    'status'    => $status,
                    'sources'   => $resultados
                )
       ));
        return $response;
    }
    
    public function asignarNuevoExpedienteAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
	$status     = 'OK';
        
        /*
         * request
         */
        $id_expLocal    = $request->request->get('__tt_newRecord');
        $prc_rows  = $request->request->get('__ar_rowsAffected');
        
        $em         = $this->getDoctrine()->getManager();
        
	$securityContext    = $this->container->get('security.context');
	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        //Actualizar registros
        try {
            $result = $em->getRepository('MinsalSimagdBundle:ImgExpedienteFicticio')
                        ->cambiarExpediente($estabLocal->getId(), $id_expLocal, $sessionUser->getId(), $prc_rows);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response   = new Response();
        $response->setContent(json_encode(array('update' => $status)));
        return $response;
    }

}
