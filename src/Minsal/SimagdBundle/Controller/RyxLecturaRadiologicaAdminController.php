<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Entity\RyxEstudioPendienteLectura; // --| Lista de trabajo

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxLecturaRadiologicaListViewGenerator;

class RyxLecturaRadiologicaAdminController extends MinsalSimagdBundleGeneralAdminController
{
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
        $__REQUEST__type = $request->request->get('type', 'list');

        // $em = $this->getDoctrine()->getManager();

        //////// --| builder entity
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxLecturaRadiologicaListViewGenerator(
                $this->container,
                $this->admin->getRouteGenerator(),
                $this->admin->getClass(),
                $__REQUEST__type
        );
        //////// --|
        $options = $ENTITY_LIST_VIEW_GENERATOR_->getTable();

        return $this->renderJson(array(
            'result'    => 'ok',
            'options'   => $options
        ));
    }

    /**
     * Redirect the user depend on this choice
     *
     * @param object $object
     *
     * @return RedirectResponse
     */
    protected function redirectTo($object)
    {
        $url = false;

        if (NULL !== $this->get('request')->get('btn_update_and_list')) {
            $url = $this->admin->generateUrl('list');
        }
        if (NULL !== $this->get('request')->get('btn_create_and_list')) {
            $url = $this->admin->generateUrl('list');
        }

        if (NULL !== $this->get('request')->get('btn_create_and_create')) {
            $params = array();
            if ($this->admin->hasActiveSubClass()) {
                $params['subclass'] = $this->get('request')->get('subclass');
            }
            $url = $this->admin->generateUrl('create', $params);
        }

        if ($this->getRestMethod() == 'DELETE') {
            $url = $this->admin->generateUrl('list');
        }

        /** Crear/Actualizar y mostrar registro */
        if ((NULL !== $this->get('request')->get('btn_create_and_show')) ||
                                (NULL !== $this->get('request')->get('btn_edit_and_show'))) {
    		$url = $this->admin->generateObjectUrl('show', $object);
        }

        /** Crear lectura y abrir transcripcion */
        if ((NULL !== $this->get('request')->get('btn_create_and_transcribir')) ||
                                (NULL !== $this->get('request')->get('btn_edit_and_transcribir'))) {
	    $lectura = $object->getId();
            $url = $this->generateUrl('simagd_diagnostico_create', array('lectura' => $lectura));
        }

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
    }
    
    public function addPendingToWorkListAction()
    {
        //Get parameter from estudio
        if (!$this->get('request')->request->get('__est')) {
            $this->get('request')->request->set('__est', NULL);
        }
        if (!$this->get('request')->request->get('__xrad')) {
            $this->get('request')->request->set('__xrad', NULL);
        }
        if (!$this->get('request')->request->get('__xradAnx')) {
            $this->get('request')->request->set('__xradAnx', NULL);
        }
        if (!$this->get('request')->request->get('__estPdr')) {
            $this->get('request')->request->set('__estPdr', NULL);
        }

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $em = $this->getDoctrine()->getManager();
        
    	$estudioPdr         = $this->get('request')->query->get('__estPdr');
    	if ($estudioPdr) {
    	    $lectura        = $em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')
                                            ->findOneBy(array(
    							'idEstudio' => $estudioPdr,
    							'idEstablecimiento' => $estabLocal->getId()
    						    ));
    	    if ($lectura) {
    		$estudio    = $this->get('request')->query->get('__est');
    		if ($estudio) {
    		    $estudioReference   = $em->getReference('Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes', $estudio); //Inicial
    		    $lectura->addEstudiosLectura($estudioReference);

    		    //Actualizar registro
    		    try {
    			/*$lectura        = */$this->admin->update($lectura);
    		    } catch (Exception $e) {
    			$status = 'failed';
    		    }

    		    $response = new Response();
    		    $response->setContent(json_encode(array()));
    		    return $response;
    		}
    	    }
    	}

        //Nueva instancia
        $lectura            = $this->admin->getNewInstance();
        
        //Cambio de estado de registro
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\RyxCtlEstadoLectura', '1'); //Inicial
        $lectura->setIdEstadoLectura($estadoReference);

        //Crear registro
        try {
            /*$lectura        = */$this->admin->create($lectura);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
    }
    
    /**
     * Create action
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        //Get parameter from estudio
        if (!$this->get('request')->query->get('__est')) {
            $this->get('request')->query->set('__est', NULL);
        }
        if (!$this->get('request')->query->get('__xrad')) {
            $this->get('request')->query->set('__xrad', NULL);
        }
        if (!$this->get('request')->query->get('__xradAnx')) {
            $this->get('request')->query->set('__xradAnx', NULL);
        }
        if (!$this->get('request')->query->get('__estPdr')) {
            $this->get('request')->query->set('__estPdr', NULL);
        }
        if (!$this->get('request')->query->get('__przLct')) {
            $this->get('request')->query->set('__przLct', NULL);
        }

        $idEst              = $this->get('request')->query->get('__est');
        
    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $em = $this->getDoctrine()->getManager();
        

        // //validar parámetro
        // if ($idEst) {
        //    $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        //    $imgFunciones = new ImagenologiaDigitalFunciones($em);
        //    $validArray = $imgFunciones->verificarCreacionLectura($idEst, $sessionUser);
        //    if (!$validArray[0]) {
        //        $this->addFlash('sonata_flash_error', $imgFunciones->obtenerMensajeError($validArray[1]));
        //        return new RedirectResponse($this->admin->generateUrl('list'));
        //    }
        // }

        // $lectura = $em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')->findOneBy(array('idEstudio' => $idEst));
        // if ($lectura) {
        //    $this->addFlash('sonata_flash_error', 'Ya existe un registro de Lectura creado para este Estudio');
        //    return new RedirectResponse($this->admin->generateUrl('list'));
        // }

        // return parent::createAction();

        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();
        
        /*
         * CUSTOM CODE --|
         * Asegurar item en Lista de trabajo | Examen --> Lectura
         */
        if  ($object->getIdEstudio() && $this->get('request')->query->get('__przLct')) {
            $count_estPndL      = $object->getIdEstudio()->getEstudioPendienteLectura()->count();
            if  ($count_estPndL === 0) {
                $item_lista     = new RyxEstudioPendienteLectura();
                $item_lista->setAnexadoPorRadiologo(TRUE);
                $item_lista->setIdEstablecimiento($estabLocal);
                $item_lista->setIdEstudio($object->getIdEstudio());
                $item_lista->setFechaIngresoLista(new \DateTime('now'));
                $item_lista->setIdRadiologoAnexa($sessionUser->getIdEmpleado());
                $item_lista->setSolicitudPostEstudio(TRUE);

                $em->persist($item_lista);
                $em->flush();
                
                /** Asignar item en lista de trabajo */
                $object->getIdEstudio()->addEstudioPendienteLectura($item_lista);
            }
        }
        /*
         * END --| CUSTOM CODE
         */

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod()== 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {

                if (false === $this->admin->isGranted('CREATE', $object)) {
                    throw new AccessDeniedException();
                }

                $this->admin->create($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                        'result' => 'ok',
                        'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

                // redirect to edit mode
                return $this->redirectTo($object);
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', $this->admin->trans('flash_create_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());
        
        /*
         * **********************************************************************
         * local record for patient
         * **********************************************************************
         */
    	$patient        = $object->getIdEstudio() && $object->getIdEstudio()->getIdExpediente() ? $object->getIdEstudio()->getIdExpediente()->getIdPaciente() : null;
    	$localRecord    = $em->getRepository('MinsalSiapsBundle:MntExpediente')
						        ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
						                        'idPaciente' => $patient ? $patient->getId() : null
						                    ));

        $collection_tiposEmpleado  = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        $collection_radiologos     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))->getQuery()->getResult();
        $collection_prioridades    = $em->getRepository('MinsalSimagdBundle:RyxCtlPrioridadAtencionPaciente')->obtenerPrioridadesAtencionV2();
        $collection_modalidades    = $em->getRepository('MinsalSimagdBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $collection_examenes       = $em->getRepository('MinsalSimagdBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $collection_proyecciones   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->findAll();
        $collection_sexos          = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();
        $collection_tiposResultado  = $em->getRepository('MinsalSimagdBundle:RyxCtlTipoRespuestaRadiologica')->findAll();

        /*
         * Patrones para diagnóstico
         */
        $query_diagnostic_pattern_list  = $em->getRepository('MinsalSimagdBundle:RyxCtlPatronDiagnostico')->getUsableDiagnosticPatterns($estabLocal->getId())->getQuery();
        $DIAGNOSTIC_PATTERN_LIST    = $query_diagnostic_pattern_list->getScalarResult();
        /*
         * Fin --- Patrones para diagnóstico
         */
        
        /*
         * GROUP_DEPENDENT_ENTITIES
         */
        $GROUP_DEPENDENT_ENTITIES   = array();
        try {
            $GROUP_DEPENDENT_ENTITIES['m_expl']   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->getRadiologicalProceduresGrouped($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
            'localRecord' => $localRecord,
            'collection_tiposEmpleado'     => $collection_tiposEmpleado,
            'collection_radiologos'        => $collection_radiologos,
            'collection_default_empLogged' => $sessionUser->getIdEmpleado(),
            'collection_prioridades'       => $collection_prioridades,
            'collection_modalidades'       => $collection_modalidades,
            'collection_tiposResultado' => $collection_tiposResultado,
            'collection_sexos'             => $collection_sexos,
            'collection_examenes'          => $collection_examenes,
            'collection_proyecciones'      => $collection_proyecciones,
            'collection_default_exmRx'     => 27,
            'collection_default_mldRx'     => 13,
            'collection_default_prAtn'     => 3,
            'GROUP_DEPENDENT_ENTITIES'  => $GROUP_DEPENDENT_ENTITIES,
            'DIAGNOSTIC_PATTERN_LIST'   => $DIAGNOSTIC_PATTERN_LIST,
        ));
    }
    
    public function mostrarInformacionModalAction($idEstudioPadre, $id)
    {
        //Obtener entidad estudio
        $em = $this->getDoctrine()->getManager();
        $entityEst = $em->getRepository('MinsalSimagdBundle:RyxEstudioPorImagenes')->find($idEstudioPadre);
    	if (!$entityEst) {
                return $this->render('MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_modal_support_default.html.twig', array());
    	}
        
        //Establecimiento local
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        //Expediente local e información del paciente
        $entityExp = $em->getRepository('MinsalSiapsBundle:MntExpediente')
		                        ->findOneBy(array('idEstablecimiento' => $estabLocal,
		                                        'idPaciente' => $entityEst->getIdExpediente()->getIdPaciente()->getId()
		                                    ));
        //Solicitud de estudio
        $entityPrc = $entityEst->getIdProcedimientoRealizado()->getIdSolicitudEstudio();
        //Solicitud de diagnóstico, si esta existe
        $entitySolDiag = $em->getRepository('MinsalSimagdBundle:RyxSolicitudDiagnosticoPostEstudio')
                                        ->findOneBy(array('idEstudio' => $idEstudioPadre,
                                                            'idSolicitudEstudio' => $entityPrc->getId()
                                                        ));
        //Diagnóstico, si este existe
        $entityDiag = $em->getRepository('MinsalSimagdBundle:RyxDiagnosticoRadiologico')->findOneBy(array('idLectura' => $id));
        $entityNotaDiag = $entityDiag ? $em->getRepository('MinsalSimagdBundle:RyxDiagnosticoSegundaOpinionMedica')
                                        ->findBy(array('idDiagnostico' => $entityDiag->getId())) : NULL;

        //Historial clínico y tablas asociadas
        $entityHcl = $entityPrc->getIdSolicitudestudios()->getIdHistorialClinico();
        $entityExmFsc = $em->getRepository('MinsalSeguimientoBundle:SecSignosVitales')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));
        $entityHojaCnt =  $em->getRepository('MinsalSeguimientoBundle:SecMotivoConsulta')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));

        return $this->render('MinsalSimagdBundle:RyxLecturaRadiologicaAdmin:lct_modal_support.html.twig', array(
            'expedienteInfo' => $entityExp,
            'pacienteInfo' => $entityEst->getIdExpediente()->getIdPaciente(),
            'historiaClinicaInfo' => $entityHcl,
            'examenFisicoInfo' => $entityExmFsc,
            'hojaContinuacionInfo' => $entityHojaCnt,
            'preinscripcionInfo' => $entityPrc,
            'citaInfo' => $entityEst->getIdProcedimientoRealizado()->getIdCitaProgramada(),
            'procedimientoRealizadoInfo' => $entityEst->getIdProcedimientoRealizado(),
            'estudioPacienteInfo' => $entityEst,
            'solicitudDiagnosticoInfo' => $entitySolDiag,
            'diagnosticoInfo' => $entityDiag,
            'notaDiagInfo' => $entityNotaDiag
        ));
    }
    
    public function proximaConsultaAction($idEstudioPadre, $warningRow, $dangerRow, $proximaConsulta = NULL, $id = NULL)
    {
        //Extraer solicitud de diagnóstico
        $em = $this->getDoctrine()->getManager();
        $entitySolDiag = $em->getRepository('MinsalSimagdBundle:RyxSolicitudDiagnosticoPostEstudio')
                                        ->findOneBy(array('idEstudio' => $idEstudioPadre,));

        return $this->render('MinsalSimagdBundle:RyxLecturaRadiologicaAdmin:lct_rowProximaConsulta.html.twig', array(
            'soldiagProximaConsulta' => $entitySolDiag->getFechaProximaConsulta(),
            'warningRow' => $warningRow,
            'dangerRow' => $dangerRow,
        ));
    }

    /**
     * Edit action
     *
     * @param int|string|null $id
     *
     * @return Response|RedirectResponse
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        if (!$this->get('request')->query->get('__est')) {
            $this->get('request')->query->set('__est', NULL);
        }
        if (!$this->get('request')->query->get('__estPdr')) {
            $this->get('request')->query->set('__estPdr', NULL);
        }
        
    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $em = $this->getDoctrine()->getManager();

        /** request object id */
        $id = $this->get('request')->get($this->admin->getIdParameter());

        //No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->existeRegistroPorId($id, 'RyxLecturaRadiologica', 'lct')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        //No puede acceder al registro
        if (false === $em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        //No está autorizado a editar el registro
        if (!($em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')->obtenerAccesoLectura($id, $sessionUser->getId()) ||
			$securityContext->isGranted('ROLE_ADMIN'))) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        // return parent::editAction($id);
        // the key used to lookup the template
        $templateKey = 'edit';

        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            throw new AccessDeniedException();
        }

    	$estudio            = $this->get('request')->query->get('__est');
    	$estudioPdr         = $this->get('request')->query->get('__estPdr');
    	if ($estudioPdr && $estudio) {
    	    $estudioReference = $em->getReference('Minsal\SimagdBundle\Entity\RyxEstudioPorImagenes', $estudio); //Inicial
    	    $object->addEstudiosLectura($estudioReference);
    	}

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);
        
        /** ***** TRANSCRIPCIÓN INMEDIATA ***** */
        foreach ($object->getLecturaDiagnostico() as $diagAdded)
        {
	    $form->get('idPatronAplicado')->setData($diagAdded->getIdPatronAplicado());
	    
	    $form->get('idEstadoDiagnostico')->setData($diagAdded->getIdEstadoDiagnostico());
	    
	    $form->get('hallazgos')->setData($diagAdded->getHallazgos());
	    $form->get('conclusion')->setData($diagAdded->getConclusion());
	    $form->get('recomendaciones')->setData($diagAdded->getRecomendaciones());
	    
	    $form->get('incidencias')->setData($diagAdded->getIncidencias());
	    $form->get('observaciones')->setData($diagAdded->getIncidencias());
	    
	    /** Activar transcripción */
	    $form->get('activarTranscripcion')->setData(TRUE);
        }
        /** ***** END TRANSCRIPCIÓN INMEDIATA ***** */

        if ($this->getRestMethod() == 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                $this->admin->update($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                        'result'    => 'ok',
                        'objectId'  => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->addFlash('sonata_flash_success', $this->admin->trans('flash_edit_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

                // redirect to edit mode
                return $this->redirectTo($object);
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', $this->admin->trans('flash_edit_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                }
            } elseif ($this->isPreviewRequested()) {
                // enable the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());
        
        /*
         * **********************************************************************
         * local record for patient
         * **********************************************************************
         */
    	$patient        = $object->getIdEstudio() && $object->getIdEstudio()->getIdExpediente() ? $object->getIdEstudio()->getIdExpediente()->getIdPaciente() : null;
    	$localRecord    = $em->getRepository('MinsalSiapsBundle:MntExpediente')
						        ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
						                        'idPaciente' => $patient ? $patient->getId() : null
						                    ));

        $collection_tiposEmpleado  = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        $collection_radiologos     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))->getQuery()->getResult();
        $collection_prioridades    = $em->getRepository('MinsalSimagdBundle:RyxCtlPrioridadAtencionPaciente')->obtenerPrioridadesAtencionV2();
        $collection_modalidades    = $em->getRepository('MinsalSimagdBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $collection_examenes       = $em->getRepository('MinsalSimagdBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $collection_proyecciones   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->findAll();
        $collection_sexos          = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();
        $collection_tiposResultado  = $em->getRepository('MinsalSimagdBundle:RyxCtlTipoRespuestaRadiologica')->findAll();

        /*
         * Patrones para diagnóstico
         */
        $query_diagnostic_pattern_list  = $em->getRepository('MinsalSimagdBundle:RyxCtlPatronDiagnostico')->getUsableDiagnosticPatterns($estabLocal->getId())->getQuery();
        $DIAGNOSTIC_PATTERN_LIST    = $query_diagnostic_pattern_list->getScalarResult();
        /*
         * Fin --- Patrones para diagnóstico
         */
        
        /*
         * GROUP_DEPENDENT_ENTITIES
         */
        $GROUP_DEPENDENT_ENTITIES   = array();
        try {
            $GROUP_DEPENDENT_ENTITIES['m_expl']   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->getRadiologicalProceduresGrouped($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
            'localRecord' => $localRecord,
            'collection_tiposEmpleado'     => $collection_tiposEmpleado,
            'collection_radiologos'        => $collection_radiologos,
            'collection_default_empLogged' => $sessionUser->getIdEmpleado(),
            'collection_prioridades'       => $collection_prioridades,
            'collection_modalidades'       => $collection_modalidades,
            'collection_tiposResultado' => $collection_tiposResultado,
            'collection_sexos'             => $collection_sexos,
            'collection_examenes'          => $collection_examenes,
            'collection_proyecciones'      => $collection_proyecciones,
            'collection_default_exmRx'     => 27,
            'collection_default_mldRx'     => 13,
            'collection_default_prAtn'     => 3,
            'GROUP_DEPENDENT_ENTITIES'  => $GROUP_DEPENDENT_ENTITIES,
            'DIAGNOSTIC_PATTERN_LIST'   => $DIAGNOSTIC_PATTERN_LIST,
        ));
    }
    
    public function showAction($id = NULL)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        // $em = $this->getDoctrine()->getManager();

        // //No existe el registro
        // if (false === $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->existeRegistroPorId($id, 'RyxLecturaRadiologica', 'lct')) {
        //     return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        // }

        // //No puede acceder al registro
        // $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        // if (false === $em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
        //     return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        // }
        
        return parent::showAction($id);
    }
    
    public function listAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();
        
    	$securityContext        = $this->container->get('security.context');
    	$sessionUser           = $securityContext->getToken()->getUser();
        $estabLocal             = $sessionUser->getIdEstablecimiento();
        
        $tiposEmpleado          = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        
        $radiologos             = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                            ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))
                                            ->getQuery()->getResult();
        $transcriptores         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                            ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(1, 4, 5))
                                            ->getQuery()->getResult();
        
        $tipos                  = $em->getRepository('MinsalSimagdBundle:RyxCtlTipoOpinionMedicaDiagnostico')->findAll();
        $estadosDiag            = $em->getRepository('MinsalSimagdBundle:RyxCtlEstadoDiagnostico')->findAll();
        
        $tiposEstab   = $em->getRepository('MinsalSiapsBundle:CtlTipoEstablecimiento')->findAll();
        
        $establecimientos       = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findBy(array('idTipoEstablecimiento' => '14'));
        
        $solicitantes           = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                            ->obtenerEmpleadosPorTipoOperaciones($estabLocal->getId(), array(1, 2, 4))
                                            ->getQuery()->getResult();
        
        $areasAtencion          = $em->getRepository('MinsalSiapsBundle:CtlAreaAtencion')->findAll();
        
        $atenciones             = $em->getRepository('MinsalSiapsBundle:CtlAtencion')->findAll();
        
        $modalidades            = $em->getRepository('MinsalSimagdBundle:CtlAreaServicioDiagnostico')->findBy(array('idAtencion' => '97'));
        
        $collection_tiposResultado  = $em->getRepository('MinsalSimagdBundle:RyxCtlTipoRespuestaRadiologica')->findAll();
        
        // $pacientes              = $em->getRepository('MinsalSiapsBundle:MntPaciente')->findAll();

        /** Patrones para diagnóstico */
        $query_diagnostic_pattern_list  = $em->getRepository('MinsalSimagdBundle:RyxCtlPatronDiagnostico')->getUsableDiagnosticPatterns($estabLocal->getId())->getQuery();
        $patronesDiag   = $query_diagnostic_pattern_list->getResult();
        $DIAGNOSTIC_PATTERN_LIST    = $query_diagnostic_pattern_list->getScalarResult();
        /** Fin --- Patrones para diagnóstico */

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'          => $tiposEmpleado,
                        'tecnologos'            => $radiologos,
                        'radiologos'            => $radiologos,
                        'tiposNota'             => $tipos,
                        'default_empLogged'            => $sessionUser->getIdEmpleado(),
                        'tipoNotaDefault'       => 1,
                        'transcriptores'        => $transcriptores,
                        'estados'               => $estadosDiag,
                        'estadosDiag'           => $estadosDiag,
                        'estadoDiagDefault'     => 2,
                        'tiposEstab'  => $tiposEstab,
                        'establecimientos'      => $establecimientos,
                        'solicitantes'          => $solicitantes,
                        'areasAtencion'         => $areasAtencion,
                        'atenciones'            => $atenciones,
                        'modalidades'           => $modalidades,
                        // 'pacientes'             => $pacientes,
                        'collection_modalidades'    => $modalidades,
                        'collection_tiposResultado' => $collection_tiposResultado,
            			'patronesDiag'          => $patronesDiag,
            			'DIAGNOSTIC_PATTERN_LIST'   => $DIAGNOSTIC_PATTERN_LIST,
                    ));
    }
    
    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');
        
        $em = $this->getDoctrine()->getManager();
        
    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $results = $em->getRepository('MinsalSimagdBundle:RyxLecturaRadiologica')->data($estabLocal->getId(), $BS_FILTERS_DECODE);

    	// $isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
    	// $isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;
        // $isUser_allowTranscribir   = ($this->admin->getRoutes()->has('edit') &&
                    // (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT')) ||
                    // $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\RyxLecturaRadiologica();

            $results[$key]['menu_code'] = 'radiologicalresult';

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
                            '<div class="row">' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3>' .
                                    // '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                                    '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>ORIGEN:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['origen'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROCEDENCIA:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['area_atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['triage'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>RADIÓLOGO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['radiologo'] . '</div></div>' .
                                '</div>' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' .
                                    '<div class=" " style="margin-top: 20px; margin-bottom: 10px;"><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" > Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['triage'] . '</div></div>' .
                                '</div>' .
                            '</div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" radiologicalresult-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="radiologicalresult-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="radiologicalresult_show"><a class=" radiologicalresult_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="radiologicalresult_edit"><a class=" radiologicalresult_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="radiologicalresult_delete"><a class=" radiologicalresult_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li class="dropdown-header">LISTA DE TRABAJO</li>' .
                            '<li data-item="radiologicalresult_goto"><a class=" radiologicalresult_goto_action "><span class="glyphicon glyphicon-list-alt"></span>Ver lista de trabajo...</a></li>' .
                            '<li data-item="radiologicalresult_checktranscript"><a class=" radiologicalresult_checktranscript_action "><span class="glyphicon glyphicon-list-alt"></span>Revisar progreso de transcripción...</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="radiologicalresult_studydownload"><a class=" radiologicalresult_studydownload_action "><span class="glyphicon glyphicon-eye-open"></span>Recuperar estudio(s)</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="radiologicalresult_create"><a class=" radiologicalresult_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_lectura']     = $formatter->dateFormatter($r['fecha_lectura']);
            // $results[$key]['fecha_registro']    = $formatter->dateFormatter($r['fecha_registro']);
            // $results[$key]['fecha_edicion']     = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" radiologicalresult-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            // $results[$key]['lct_fechaLectura']   = $r['lct_fechaLectura']->format('Y-m-d H:i:s A');
            // $results[$key]['est_fechaEstudio']   = $r['est_fechaEstudio'] ? $r['est_fechaEstudio']->format('Y-m-d H:i:s A') : '';
            
            $results[$key]['lct_editUrl']        = $this->generateUrl('simagd_lectura_edit', array('id' => $r['lct_id']));

            $results[$key]['table_dbl_click_url'] = $this->generateUrl('simagd_lectura_show', array('id' => $r['id']));
            
            // $results[$key]['allowShow']          = $isUser_allowShow;
            
            // $results[$key]['allowEdit']          = (false !== $isUser_allowEdit &&
                    // ($r['lct_id_userReg'] == $sessionUser->getId() || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
		    
    	    // /** Transcribir por radiólogo/transcriptor */
    	    // $countDiag                              = $em->getRepository('MinsalSimagdBundle:RyxDiagnosticoRadiologico')->countDiagnosticoTranscritoParaLectura($r['lct_id']);
            
            // $results[$key]['allowTranscribir']   = ($countDiag['numDiag'] === 0 && false !== $isUser_allowTranscribir && in_array($r['lct_codEstado'], array('LDO'))) ? TRUE : FALSE;
        }
        
        return $this->renderJson($results);
    }
    
    public function getObjectVarsAsArrayAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $em = $this->getDoctrine()->getManager();
        
    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
	
        //Get parameter from object
        $id = $request->request->get('id');
        $pct                = $request->request->get('pct');
        
        //Objeto
        $object = $this->admin->getObject($id);

        //Expediente local e información del paciente
        $expediente         = $em->getRepository('MinsalSiapsBundle:MntExpediente')->getObjectVarsAsArray($estabLocal->getId(), $pct);
        
        /**
         * AQUI SE DEBERIA HACER EL FOREACH DE LOS INCRUSTADOS, getSimpleObjectPropertiesAsArray retorna todo de la entity y los id de los incrustados
         * Para un solo consultado, en listarAction se consulta getSimpleObjectPropertiesAsArray y se rellena con lo faltante, paciente, origen, permisos, etc
         * Para consultar un solo objeto se saca la info de row.object con todo lo extraido de getSimpleObjectPropertiesAsArray
         * Caso especial LCT y PRZ que necesitan los estudios, tambien se necesita getSimpleObjectPropertiesAsArray de los estudios incrustados.
         */
        
        $response = new Response();
        $response->setContent(json_encode(
                array('id' => $object->getId(),
                        'object' => $object->getObjectPropertiesAsArray(),
                        'expediente' => $expediente
                        // 'url' => $this->admin->generateUrl('show', array('id' => $object->getId()))
                ), JSON_FORCE_OBJECT));
        return $response;
    }

}