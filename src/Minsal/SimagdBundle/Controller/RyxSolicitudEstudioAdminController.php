<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\SimagdBundle\Entity\RyxSolicitudEstudio;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sonata\AdminBundle\Exception\ModelManagerException;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxSolicitudEstudioListViewGenerator;

class RyxSolicitudEstudioAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $__REQUEST__emrg = $request->request->get('emrg', 0);

        // $em = $this->getDoctrine()->getManager();

        //////// --| builder entity
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxSolicitudEstudioListViewGenerator(
                $this->container,
                $this->admin->getRouteGenerator(),
                $this->admin->getClass(),
                $__REQUEST__type
        );
        //////// --|
        $ENTITY_LIST_VIEW_GENERATOR_->setIsEmergency(boolval($__REQUEST__emrg));
        $options = $ENTITY_LIST_VIEW_GENERATOR_->getTable();

        return $this->renderJson(array(
            'result'    => 'ok',
            'options'   => $options
        ));
    }

    /**
     * Encargado de filtrar los campos select
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cargarDatosPorFiltroAction(Request $request)
    {
        $request->isXmlHttpRequest();

    	$status = 'OK';

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $paramFilter        = $request->request->get('param_filterA');
        if (!$paramFilter) {
            $paramFilter    = $this->get('request')->query->get('param_filterA');
        }
        $paramFilterB       = $request->request->get('param_filterB');
        if (!$paramFilterB) {
            $paramFilterB   = $this->get('request')->query->get('param_filterB');
        }
        $selector           = $request->request->get('selector');
        if (!$selector) {
            $selector       = $this->get('request')->query->get('selector');
        }

        $em = $this->getDoctrine()->getManager();
        $entities           = null;
        $encodeR            = array();

        switch ($selector)  {
            case "rz":
                //Obtener las modalidades realizables y enviarlas al ajax
                try {
                    $entities   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->obtenerModalidadesRealizables($paramFilter, $paramFilterB);
                } catch (Exception $e) {
                    $status = 'failed';
                }
                break;
            case "atn":
                //Obtener las atenciones levantadas dentro del área
                try {
		    $entities   = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerAtenciones($estabLocal->getId(), $paramFilter);
                } catch (Exception $e) {
                    $status = 'failed';
                }
                break;
            case "emp":
                //Obtener los empleados que laboran dentro del servicio de atención
                try {
                    $entities   = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerEmpleados($estabLocal->getId(), $paramFilter, $paramFilterB);
                } catch (Exception $e) {
                    $status = 'failed';
                }
                //Retornar nuevo aams
                $aamsId         = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerAtencionAreaEstab($estabLocal->getId(), $paramFilterB, $paramFilter);
                $encodeR['aamsId']  = $aamsId ? $aamsId->getId() : '';
                break;
            case "exm":
                //Obtener los exámenes realizables dentro de la modalidad
                $entities   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->obtenerExamenes($estabLocal->getId(), $paramFilter, $paramFilterB);
                break;
            case "expl":
                //Obtener las proyecciones realizables dentro de la modalidad
                $paramFilterBJson   = json_decode($paramFilterB, true);
                $expediente         = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($paramFilterBJson['idExpediente']);
                $idSexo             = $expediente ? $expediente->getIdPaciente()->getIdSexo()->getId() : '-1';
                try {
                    $entities       = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')
                                                ->obtenerProyeccionesRealizables($paramFilterBJson['idReferido'], $paramFilter, $idSexo, $paramFilterBJson['idAtencion']);
                } catch (Exception $e) {
                    $status = 'failed';
                }
                break;
            case "stdiag":
                //Obtener los establecimientos diagnósticantes para las proyecciones seleccionadas
                try {
                    $entities   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->obtenerEstabDiagnosticantes($paramFilter, $paramFilterB);
                } catch (Exception $e) {
                    $status = 'failed';
                }
                break;
            case "explnrz":
                //Obtener las proyecciones no agregadas aun al catálogo
                $entities   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->obtenerProyeccionesNoAgregadas($estabLocal->getId(), $paramFilter, $paramFilterB);
                break;
            default:
                break;
        }

        $results = array();
        foreach ($entities as $entity)  {
            $r['value'] = $entity->getId();
            $r['text']  = $entity->__toString();
            $results[]  = $r;
        }

        $encodeR['results'] = $results;
        /*
         * status request
         */
        $encodeR['status']  = $status;

        return $this->renderJson($encodeR);

        // return $this->renderJson(array(
        //     'status'    => $status,
        //     'results'   => $results
        // ));
    }

    /**
     * Create action
     *
     * @return Response
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function createAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        //Get parameters
        if (!$this->get('request')->query->get('__exp')) {
            $this->get('request')->query->set('__exp', null);
        }
        if (!$this->get('request')->query->get('__hcl')) {
            $this->get('request')->query->set('__hcl', null);
        }
        if (!$this->get('request')->query->get('__prc')) {
            $this->get('request')->query->set('__prc', null);
        }

        $idExpRequest       = $this->get('request')->query->get('__exp');
        $idHsClRequest      = $this->get('request')->query->get('__hcl');

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();

        //validar parámetros
        if ($idExpRequest || $idHsClRequest) {
            $sessionUser   = $this->container->get('security.context')->getToken()->getUser();
            $imgFunciones   = new ImagenologiaDigitalFunciones($em);
            $validArray     = $imgFunciones->verificarCreacionPreinscripcion($idExpRequest, $idHsClRequest, $sessionUser);
            if (!$validArray[0]) {
                $this->addFlash('sonata_flash_error', $imgFunciones->obtenerMensajeError($validArray[1]));
                return new RedirectResponse($this->admin->generateUrl('list'));
            }
        }

        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        /** ***** CUSTOM CODE ***** */
        $id_prcRequest      = $this->get('request')->query->get('__prc'); 	/** Solicitud de la que parte la actual	*/
        $object_prcRequest  = $this->admin->getObject($id_prcRequest); 	/** if $object_prcRequest is not null 	*/

        if ($object_prcRequest)
        {
	    $object->setIdAtenAreaModEstab($object_prcRequest->getIdAtenAreaModEstab());
	    $object->setIdEmpleado($object_prcRequest->getIdEmpleado());

	    $object->setIdExpediente($object_prcRequest->getIdExpediente());

	    $object->setFechaProximaConsulta($object_prcRequest->getFechaProximaConsulta());
	    $object->setPacienteAmbulatorio($object_prcRequest->getPacienteAmbulatorio());
	    $object->setNumeroSala($object_prcRequest->getNumeroSala());
	    $object->setNumeroCama($object_prcRequest->getNumeroCama());
	    $object->setPacienteDesconocido($object_prcRequest->getPacienteDesconocido());

	    $object->setPesoActualLb($object_prcRequest->getPesoActualLb());
	    $object->setPesoActualKg($object_prcRequest->getPesoActualKg());
	    $object->setTallaPaciente($object_prcRequest->getTallaPaciente());
	    $object->setIdFormaContacto($object_prcRequest->getIdFormaContacto());
	    $object->setIdContactoPaciente($object_prcRequest->getIdContactoPaciente());
	    $object->setContacto($object_prcRequest->getContacto());
	    $object->setNombreContacto($object_prcRequest->getNombreContacto());

	    $object->setIdPrioridadAtencion($object_prcRequest->getIdPrioridadAtencion());

	    $object->setDatosClinicos($object_prcRequest->getDatosClinicos());
	    $object->setHipotesisDiagnostica($object_prcRequest->getHipotesisDiagnostica());
	    $object->setInvestigando($object_prcRequest->getInvestigando());
	    $object->setJustificacionMedica($object_prcRequest->getJustificacionMedica());
	    $object->setConsultaPor($object_prcRequest->getConsultaPor());
	    $object->setEstadoClinico($object_prcRequest->getEstadoClinico());
	    $object->setAntecedentesClinicosRelevantes($object_prcRequest->getAntecedentesClinicosRelevantes());

	    $object->setReferirPaciente($object_prcRequest->getReferirPaciente());
	    $object->setIdEstablecimientoReferido($object_prcRequest->getIdEstablecimientoReferido());
	    $object->setJustificacionReferencia($object_prcRequest->getJustificacionReferencia());

	    $object->setRequiereDiagnostico($object_prcRequest->getRequiereDiagnostico());
	    $object->setIdEstablecimientoDiagnosticante($object_prcRequest->getIdEstablecimientoDiagnosticante());
	    $object->setJustificacionDiagnostico($object_prcRequest->getJustificacionDiagnostico());
        }
        /** ***** END CUSTOM CODE ***** */

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);


        /** ***** CUSTOM CODE ***** */
        if ($object->getIdAtenAreaModEstab())
        {
	    $form->get('idAreaAtencion')->setData($object->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion());
	    $form->get('idAtencion')->setData($object->getIdAtenAreaModEstab()->getIdAtencion());
        }
        /** ***** END CUSTOM CODE ***** */


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
    	$patient        = $object->getIdExpediente() ? $object->getIdExpediente()->getIdPaciente() : null;
    	$localRecord    = $em->getRepository('MinsalSiapsBundle:MntExpediente')
						        ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
						                        'idPaciente' => $patient ? $patient->getId() : null
						                    ));

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
            'localRecord' => $localRecord,
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

        if (null !== $this->get('request')->get('btn_update_and_list')) {
            $url = $this->admin->generateUrl('list');
        }
        if (null !== $this->get('request')->get('btn_create_and_list')) {
            $url = $this->admin->generateUrl('list');
        }

        if (null !== $this->get('request')->get('btn_create_and_create')) {
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
      //   if ((null !== $this->get('request')->get('btn_create_and_show')) ||
      //                           (null !== $this->get('request')->get('btn_edit_and_show'))) {
    		// $url = $this->admin->generateObjectUrl('show', $object);
      //   }

        /** Crear/Actualizar y mostrar registro */
      //   if ((null !== $this->get('request')->get('btn_create_and_request')) ||
      //                           (null !== $this->get('request')->get('btn_edit_and_request'))) {
    		// $url = $this->admin->generateObjectUrl('show', $object);
      //   }

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
    }

    public function requiereCitaAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $id = $request->request->get('id');
        $preinscripcion = $this->admin->getObject($id);
        if (!$preinscripcion) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $em = $this->getDoctrine()->getManager();

        if ($em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->existeRegistroPorPreinscripcion($id, 'cit', 'RyxCitaProgramada')) {
            $status = 'notAllowed';
            return $this->renderJson(array());
        }

        //Desmarcar para programación de cita
        $preinscripcion->setRequiereCita(false);

        //Actualizar preinscripción
        try {
            /*$preinscripcion = */$this->admin->update($preinscripcion);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
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

        $em = $this->getDoctrine()->getManager();

        /** request object id */
        $id = $this->get('request')->get($this->admin->getIdParameter());

        //No existe el registro
  //       if (false === $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->existeRegistroPorId($id, 'RyxSolicitudEstudio', 'prc')) {
  //           return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
  //       }

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

  //       //No puede acceder al registro
  //       if (!((in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ARY', 'CRY', 'MRY', 'TRY', 'CIT', 'ACL')) && $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')
  //               ->obtenerAccesoEstabEdit($id, $estabLocal->getId(), 'prc', 'idEstablecimientoReferido')) ||
		// ($this->admin->isGranted('CREATE') && $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')
  //                               ->obtenerAccesoEstabEdit($id, $estabLocal->getId())))) {
  //           return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
  //       }

  //       //No está autorizado a editar el registro
  //       if (!($em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerAccesoPreinscripcion($id, $sessionUser->getId()) ||
  //               $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) {
  //           return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
  //       }

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

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        /** ***** CUSTOM CODE ***** */
        if ($object->getIdAtenAreaModEstab()) {
	    $form->get('idAreaAtencion')->setData($object->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion());
	    $form->get('idAtencion')->setData($object->getIdAtenAreaModEstab()->getIdAtencion());
        }
        /** ***** END CUSTOM CODE ***** */

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
    	$patient        = $object->getIdExpediente() ? $object->getIdExpediente()->getIdPaciente() : null;
    	$localRecord    = $em->getRepository('MinsalSiapsBundle:MntExpediente')
						        ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
						                        'idPaciente' => $patient ? $patient->getId() : null
						                    ));

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
            'localRecord' => $localRecord,
        ));
    }

    public function show2Action($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

        //No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->existeRegistroPorId($id, 'RyxSolicitudEstudio', 'prc')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        //No puede acceder al registro
        $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return parent::showAction($id);
    }

    public function listAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

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

        $prioridades            = $em->getRepository('MinsalSimagdBundle:RyxCtlPrioridadAtencionPaciente')->obtenerPrioridadesAtencionV2();

        $modalidades            = $em->getRepository('MinsalSimagdBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $examenes               = $em->getRepository('MinsalSimagdBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $proyecciones           = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->findAll();
        $sexos                  = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();

        $areasAtencion          = $em->getRepository('MinsalSiapsBundle:CtlAreaAtencion')->findAll();

        $tiposAtencion          = $em->getRepository('MinsalSiapsBundle:CtlTipoAtencion')->findAll();
        $atenciones             = $em->getRepository('MinsalSiapsBundle:CtlAtencion')->findAll();

        $collection_tiposEmpleado  = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();
        $collection_radiologos     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))->getQuery()->getResult();
        $collection_prioridades    = $em->getRepository('MinsalSimagdBundle:RyxCtlPrioridadAtencionPaciente')->obtenerPrioridadesAtencionV2();
        $collection_modalidades    = $em->getRepository('MinsalSimagdBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        $collection_examenes       = $em->getRepository('MinsalSimagdBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        $collection_proyecciones   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->findAll();
        $collection_sexos          = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();

        /*
         * GROUP_DEPENDENT_ENTITIES
         */
        $GROUP_DEPENDENT_ENTITIES   = array();
        try {
            $GROUP_DEPENDENT_ENTITIES['m_expl']   = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->getRadiologicalProceduresGrouped($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }
        try {
            $GROUP_DEPENDENT_ENTITIES['ar_atn']   = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerAtencionesAgrupadasV2($estabLocal->getId());
        } catch (Exception $e) {
            $status = 'failed';
        }
        try {
            $GROUP_DEPENDENT_ENTITIES['atn_emp']  = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerEmpleadosAgrupadosV2($estabLocal->getId());
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

    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');
        $__REQUEST__emrg = $this->get('request')->query->get('emrg', 0);

        $em = $this->getDoctrine()->getManager();

    	$securityContext 	= $this->container->get('security.context');
    	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->data($estabLocal->getId(), $BS_FILTERS_DECODE);

    	$isUser_allowShow       = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
    	$isUser_allowEdit       = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;
    	$allowChangePriority    = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('cambiarPrioridadAtencionSolicitud')) ? TRUE : FALSE;
    	$isUser_allowIndRadx    = (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') || $securityContext->isGranted('ROLE_ADMIN')) && $this->admin->getRoutes()->has('agregarIndicacionesRadiologo')) ? TRUE : FALSE;

        $slug = 'study_request';
        if ($__REQUEST__emrg === 1) {
            $slug = 'emergency_study_request';
        }

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio();

            if ($__REQUEST__type === 'compact')
            {
                $results[$key]['compact'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'' . $slug . '\', ' . $r['id'] . '); return false;">' .
                            '<div class="row">' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3>' .
                                    // '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                                    '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['triage'] . '</div></div>' .
                                '</div>' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' .
                                    '<div class=" " style="margin-top: 20px; margin-bottom: 10px;"><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" > Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div>' .
                                '</div>' .
                            '</div>' .
                        '</div>' .
                    '</div>';
                continue;
            }
            elseif ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'' . $slug . '\', ' . $r['id'] . '); return false;">' .
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
                                    '<p></p><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 data-box-row"> <div class="progress"> <div class="progress-bar progress-bar-striped active progress-bar-danger" role="progressbar" aria-valuenow="' . $r['progreso'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $r['progreso'] . '%;"> ' . $r['progreso'] . '% Completado </div> </div> </div></div>' .
                                '</div>' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['triage'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
                                    '<p></p><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 data-box-row"> <div class="progress"> <div class="progress-bar progress-bar-striped active progress-bar-primary-v4" role="progressbar" aria-valuenow="' . $r['progreso'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $r['progreso'] . '%;"> ' . $r['progreso'] . '% Completado </div> </div> </div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['atencion'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['medico'] . '</div></div>' .
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
                        '<a class=" studyrequest-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="studyrequest-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="studyrequest_show"><a class=" studyrequest_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="studyrequest_edit"><a class=" studyrequest_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="studyrequest_delete"><a class=" studyrequest_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li class="dropdown-header">HISTORIA CLÍNICA</li>' .
                            '<li data-item="studyrequest_checkmedicalhistory"><a class=" studyrequest_checkmedicalhistory_action "><span class="glyphicon glyphicon-list-alt"></span>Ver historia clínica...</a></li>' .
                            '<li data-item="studyrequest_showallrequest"><a class=" studyrequest_showallrequest_action "><span class="glyphicon glyphicon-list-alt"></span>Solicitudes del paciente...</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="studyrequest_studydownload"><a class=" studyrequest_studydownload_action "><span class="glyphicon glyphicon-eye-open"></span>Recuperar estudio(s)</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="studyrequest_create"><a class=" studyrequest_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                            '<li data-item="studyrequest_createtothispatient"><a class=" studyrequest_createtothispatient_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear para este paciente</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_solicitud']   = $formatter->dateFormatter($r['fecha_solicitud']);
            // $results[$key]['fecha_edicion']     = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" studyrequest-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            $results[$key]['prc_editUrl']                        = $this->generateUrl('simagd_solicitud_estudio_edit', array('id' => $r['prc_id']));
            // $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion']->format('Y-m-d H:i:s A');
            // $results[$key]['prc_fechaProximaConsulta']           = $r['prc_fechaProximaConsulta']->format('Y-m-d');

            // $results[$key]['allowShow']                          = $isUser_allowShow;

            // $results[$key]['allowEdit']                          = (false !== $isUser_allowEdit &&
            //         ((in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ARY', 'CRY', 'MRY', 'TRY', 'CIT', 'ACL')) && $estabLocal->getId() == $r['prc_id_referido']) ||
            //         ($estabLocal->getId() == $r['prc_id_origen'] && $this->admin->isGranted('CREATE'))) &&
            //         ($r['prc_id_userReg'] == $sessionUser->getId() || ($r['prc_id_userMod'] == $sessionUser->getId()) || ($r['prc_id_empleado'] == $sessionUser->getIdEmpleado()->getId()) ||
            //             $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            // $results[$key]['allowSinCita']                       = ($r['prc_requiereCita'] && $this->admin->getRoutes()->has('requiereCita') &&
            //         (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ARY', 'CRY', 'MRY', 'TRY', 'CIT', 'ACL')) || $securityContext->isGranted('ROLE_ADMIN')) && ($estabLocal->getId() == $r['prc_id_referido']) &&
            //         (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_EDIT') &&
            //             $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_EDIT')) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            // $results[$key]['allowChangePriority']                = (false !== $allowChangePriority &&
            //         ((in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ARY', 'CRY', 'MRY', 'TRY', 'CIT', 'ACL')) && $estabLocal->getId() == $r['prc_id_referido']) ||
            //         ($estabLocal->getId() == $r['prc_id_origen'] && $this->admin->isGranted('CREATE'))) &&
            //         ($r['prc_id_userReg'] == $sessionUser->getId() || ($r['prc_id_userMod'] == $sessionUser->getId()) ||
            //             $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            // $results[$key]['allowIndRadx']                       = $isUser_allowIndRadx;

            /** Solicitar Diagnóstico */
            // $rEst                                           = $em->getRepository('MinsalSimagdBundle:RyxEstudioPorImagenes')->obtenerEstudioSinSolicitudDiagV2($r['prc_id']);
            // $results[$key]['est']                                = $rEst;

            // $results[$key]['allowSolDiag']                       = (count($rEst) >= 1 && !$r['prc_requiereDiagnostico'] && $this->admin->getRoutes()->has('solicitarDiag') && ($estabLocal->getId() == $r['prc_id_origen']) &&
            //         ($r['prc_id_userReg'] == $sessionUser->getId() || ($r['prc_id_userMod'] == $sessionUser->getId()) || $securityContext->isGranted('ROLE_ADMIN')) &&
            //         (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_EDIT') &&
            //             $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_VIEW')) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            // $results[$key]['prc_solicitudEstudioProyeccion']     = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->obtenerProyeccionesSolicitudEstudio($r['prc_id']);
        }

        return $this->renderJson($results);
    }

    public function cambiarPrioridadAtencionSolicitudAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $id = $request->request->get('id');
        $preinscripcion     = $this->admin->getObject($id);

        $prioridadNv        = $request->request->get('formPrcEditIdPrioridadAtencion');

        $em = $this->getDoctrine()->getManager();

        //Cambio de prioridad requerida
        $prioridadReference = $em->getReference('Minsal\SimagdBundle\Entity\RyxCtlPrioridadAtencionPaciente', $prioridadNv);
        $preinscripcion->setIdPrioridadAtencion($prioridadReference);

        //Actualizar preinscripción
        try {
            /*$preinscripcion = */$this->admin->update($preinscripcion);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function agregarIndicacionesRadiologoAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $id                 = $request->request->get('formIndRadxPrcId');
        $preinscripcion     = $this->admin->getObject($id);

        $radiologo          = $request->request->get('formIndRadxPrcIdRadiologo');
        $indicaciones       = $request->request->get('formIndRadxPrcIndicaciones');

        $em = $this->getDoctrine()->getManager();

        //Radiólogo que agrega nuevas indicaciones
    	$radiologo_ref      = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $radiologo);
    	$preinscripcion->setIdRadiologoAgregaIndicaciones($radiologo_ref);

        //indicaciones adicionales
        $preinscripcion->setIndicacionesMedicoRadiologo($indicaciones);

        //Actualizar preinscripción
        try {
            /*$preinscripcion = */$this->admin->update($preinscripcion);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function obtenerPrioridadesAtencionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $results = $em->getRepository('MinsalSimagdBundle:RyxCtlPrioridadAtencionPaciente')->obtenerPrioridadesAtencionV2('scalar');

        return $this->renderJson($results);
    }

    /**
     * Redireccionar hacia nueva solicitud al paciente
     */
    public function showAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $em = $this->getDoctrine()->getManager();

        //contiene solicitud de estudio anterior
        //brinda facilidad para crear nueva solicitud a partir de anterior
        $object = $this->admin->getObject($id);

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        if (false === (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE')
			    && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_EDIT'))
		    || $securityContext->isGranted('ROLE_ADMIN'))) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        /*
         * **********************************************************************
         * local record for patient
         * **********************************************************************
         */
    	$patient        = $object->getIdExpediente() ? $object->getIdExpediente()->getIdPaciente() : null;
    	$localRecord    = $em->getRepository('MinsalSiapsBundle:MntExpediente')
						        ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
						                        'idPaciente' => $patient ? $patient->getId() : null
						                    ));

        return $this->render($this->admin->getTemplate('show'), array(
            'solicitud'	=> $object,
            'action' 	=> 'edit',
            'localRecord' => $localRecord,
        ));
    }

    public function pendingPatientsAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS             = $this->get('request')->query->get('filters');
        if (!$BS_FILTERS)
        {
            $BS_FILTERS         = $this->get('request')->request->get('filters');
        }
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');
        $__REQUEST__emrg = $this->get('request')->query->get('emrg', 0);

        $em = $this->getDoctrine()->getManager();

    	$securityContext 	= $this->container->get('security.context');
    	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->getPendingPatients($estabLocal->getId(), $BS_FILTERS_DECODE);

    	$isUser_allowShow       = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
    	$isUser_allowEdit       = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;
    	$allowChangePriority    = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('cambiarPrioridadAtencionSolicitud')) ? TRUE : FALSE;
    	$isUser_allowIndRadx    = (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') || $securityContext->isGranted('ROLE_ADMIN')) && $this->admin->getRoutes()->has('agregarIndicacionesRadiologo')) ? TRUE : FALSE;

        $slug = 'study_request';
        if ($__REQUEST__emrg === 1) {
            $slug = 'emergency_study_request';
        }

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\RyxSolicitudEstudio();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        // '<div class="box-body">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'' . $slug . '\', ' . $r['id'] . '); return false;">' .
                            '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                            '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>ORIGEN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['origen'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROCEDENCIA:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['area_atencion'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['atencion'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['medico'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['modalidad'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['triage'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROGRESO:</strong></div><div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' . $r['estado'] . '</div></div>' .
                            '<p></p><div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"> <div class="progress"> <div class="progress-bar progress-bar-striped active progress-bar-danger" role="progressbar" aria-valuenow="' . $r['progreso'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $r['progreso'] . '%;"> ' . $r['progreso'] . '% Completado </div> </div> </div></div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" studyrequest-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_registro']    = $formatter->dateFormatter($r['fecha_registro']);
            $results[$key]['fecha_edicion']     = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" studyrequest-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            $results[$key]['prc_editUrl']                        = $this->generateUrl('simagd_solicitud_estudio_edit', array('id' => $r['prc_id']));
            $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion']->format('Y-m-d H:i:s A');
            $results[$key]['prc_fechaProximaConsulta']           = $r['prc_fechaProximaConsulta']->format('Y-m-d');

            $results[$key]['allowShow']                          = $isUser_allowShow;

            $results[$key]['allowEdit']                          = (false !== $isUser_allowEdit &&
                    ((in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ARY', 'CRY', 'MRY', 'TRY', 'CIT', 'ACL')) && $estabLocal->getId() == $r['prc_id_referido']) ||
                    ($estabLocal->getId() == $r['prc_id_origen'] && $this->admin->isGranted('CREATE'))) &&
                    ($r['prc_id_userReg'] == $sessionUser->getId() || ($r['prc_id_userMod'] == $sessionUser->getId()) ||
			($r['prc_id_empleado'] == $sessionUser->getIdEmpleado()->getId()) ||
                        $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            $results[$key]['allowSinCita']                       = ($r['prc_requiereCita'] && $this->admin->getRoutes()->has('requiereCita') &&
                    (in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ARY', 'CRY', 'MRY', 'TRY', 'CIT', 'ACL')) || $securityContext->isGranted('ROLE_ADMIN')) && ($estabLocal->getId() == $r['prc_id_referido']) &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_EDIT') &&
                        $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_EDIT')) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            $results[$key]['allowChangePriority']                = (false !== $allowChangePriority &&
                    ((in_array($sessionUser->getIdEmpleado()->getIdTipoEmpleado()->getCodigo(), array('ARY', 'CRY', 'MRY', 'TRY', 'CIT', 'ACL')) && $estabLocal->getId() == $r['prc_id_referido']) ||
                    ($estabLocal->getId() == $r['prc_id_origen'] && $this->admin->isGranted('CREATE'))) &&
                    ($r['prc_id_userReg'] == $sessionUser->getId() || ($r['prc_id_userMod'] == $sessionUser->getId()) ||
                        $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            $results[$key]['allowIndRadx']                       = $isUser_allowIndRadx;

            /** Solicitar Diagnóstico */
            $rEst                                           = $em->getRepository('MinsalSimagdBundle:RyxEstudioPorImagenes')
                                                                            ->obtenerEstudioSinSolicitudDiagV2($r['prc_id']);
            $results[$key]['est']                                = $rEst;

            $results[$key]['allowSolDiag']                       = (count($rEst) >= 1 && !$r['prc_requiereDiagnostico'] && $this->admin->getRoutes()->has('solicitarDiag') && ($estabLocal->getId() == $r['prc_id_origen']) &&
                    ($r['prc_id_userReg'] == $sessionUser->getId() || ($r['prc_id_userMod'] == $sessionUser->getId()) || $securityContext->isGranted('ROLE_ADMIN')) &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_EDIT') &&
                        $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_VIEW')) || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

            $results[$key]['prc_solicitudEstudioProyeccion']     = $em->getRepository('MinsalSimagdBundle:RyxCtlProyeccionRadiologica')->obtenerProyeccionesSolicitudEstudio($r['prc_id']);
        }

        return $this->renderJson($results);
    }

    public function crearSolicitudEstudioFormatoRapidoAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        $request_emergencia         = $request->request->get('formPrcEmergencyRequestEsEmergencia') ? TRUE : FALSE;

        $request_expLocal           = $request->request->get('formPrcEmergencyRequestIdExpediente');
        $request_areaAtencion       = $request->request->get('formPrcEmergencyRequestIdAreaAtencion');
        $request_atencion           = $request->request->get('formPrcEmergencyRequestIdAtencion');
        $request_empleado           = $request->request->get('formPrcEmergencyRequestIdEmpleado');
        $request_modalidad          = $request->request->get('formPrcEmergencyRequestIdAreaServicioDiagnostico');
        $request_proyecciones       = $request->request->get('formPrcEmergencyRequestSolicitudEstudioProyeccion');
        $request_proximaConsulta    = $request->request->get('formPrcEmergencyRequestFechaProximaConsulta');
        $request_prioridad          = $request->request->get('formPrcEmergencyRequestIdPrioridadAtencion');
        $request_datosClinicos      = $request->request->get('formPrcEmergencyRequestDatosClinicos');
        $request_hipotesis          = $request->request->get('formPrcEmergencyRequestHipotesisDiagnostica');
        $request_investigando       = $request->request->get('formPrcEmergencyRequestInvestigando');
        $request_justificacion      = $request->request->get('formPrcEmergencyRequestJustificacionMedica');

        //Nueva instancia
        $new_studyRequest           = $this->admin->getNewInstance();

    	$securityContext            = $this->container->get('security.context');
    	$sessionUser               = $securityContext->getToken()->getUser();
        $estabLocal                 = $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();

        // $new_studyRequest = new RyxSolicitudEstudio();


        //Expediente --| Caso de paciente conocido y registrado
        if ($request_expLocal !== null && $request_expLocal !== "") {
            $ref_expLocal           = $em->getReference('Minsal\SiapsBundle\Entity\MntExpediente', $request_expLocal);
            $new_studyRequest->setIdExpediente($ref_expLocal);
        }
        /*
         * área | atención (mnt_aten_area_mod_estab)
         */
        $obj_especialidad           = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerAtencionAreaEstab($estabLocal->getId(), $request_areaAtencion, $request_atencion);
        $new_studyRequest->setIdAtenAreaModEstab($obj_especialidad);
        /*
         * Empleado
         */
        $ref_empleado               = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $request_empleado);
        $new_studyRequest->setIdEmpleado($ref_empleado);
        /*
         * Modalidad
         */
        $ref_modalidad              = $em->getReference('Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico', $request_modalidad);
        $new_studyRequest->setIdAreaServicioDiagnostico($ref_modalidad);
        /*
         * Proyecciones
         */
        foreach ($request_proyecciones as $request_proyeccion)  {
            $ref_proyeccion         = $em->getReference('Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica', $request_proyeccion);
            $new_studyRequest->addSolicitudEstudioProyeccion($ref_proyeccion);
        }
        /*
         * Cambio de prioridad requerida
         */
        $ref_prioridad              = $em->getReference('Minsal\SimagdBundle\Entity\RyxCtlPrioridadAtencionPaciente', $request_prioridad);
        $new_studyRequest->setIdPrioridadAtencion($ref_prioridad);
        /*
         * Generales
         */
        $new_studyRequest->setFechaProximaConsulta(\DateTime::createFromFormat('Y-m-d', $request_proximaConsulta));
        $new_studyRequest->setDatosClinicos(trim($request_datosClinicos));
        $new_studyRequest->setHipotesisDiagnostica(trim($request_hipotesis));
        $new_studyRequest->setInvestigando(trim($request_investigando));
        $new_studyRequest->setJustificacionMedica(trim($request_justificacion));

        /*
         * **********************************************************************
         * expediente ficticio --| caso de paciente desconocido
         * **********************************************************************
         */
        if ($request_emergencia !== false && !$request_expLocal)
        {
            $new_unknownExp         = new \Minsal\SimagdBundle\Entity\RyxExpedienteFicticio();
            $new_unknownExp->setFechaHoraReg(new \DateTime('now'));
            $new_unknownExp->setIdUserReg($sessionUser);
            $new_unknownExp->setIdEstablecimiento($estabLocal);
            $em->persist($new_unknownExp);
            $em->flush();

            $new_studyRequest->setIdExpedienteFicticio($new_unknownExp);
            /*
             * solicitudes de emergencia por defecto no tienen cita
             */
            $new_studyRequest->setRequiereCita(FALSE);
        }

        //Crear solicitud de estudio
        try {
            /*$new_studyRequest       = */$this->admin->create($new_studyRequest);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response = new Response();
        $response->setContent(json_encode(
                array(
                    'id' => $new_studyRequest->getId(),
                    'status' => $status,
                )));
        return $response;
    }

    public function editarSolicitudEstudioFormatoRapidoAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        $request_emergencia         = $request->request->get('formPrcEmergencyRequestEsEmergencia') ? TRUE : FALSE;

        $request_expLocal           = $request->request->get('formPrcEmergencyRequestIdExpediente');
        $request_areaAtencion       = $request->request->get('formPrcEmergencyRequestIdAreaAtencion');
        $request_atencion           = $request->request->get('formPrcEmergencyRequestIdAtencion');
        $request_empleado           = $request->request->get('formPrcEmergencyRequestIdEmpleado');
        $request_modalidad          = $request->request->get('formPrcEmergencyRequestIdAreaServicioDiagnostico');
        $request_proyecciones       = $request->request->get('formPrcEmergencyRequestSolicitudEstudioProyeccion');
        $request_proximaConsulta    = $request->request->get('formPrcEmergencyRequestFechaProximaConsulta');
        $request_prioridad          = $request->request->get('formPrcEmergencyRequestIdPrioridadAtencion');
        $request_datosClinicos      = $request->request->get('formPrcEmergencyRequestDatosClinicos');
        $request_hipotesis          = $request->request->get('formPrcEmergencyRequestHipotesisDiagnostica');
        $request_investigando       = $request->request->get('formPrcEmergencyRequestInvestigando');
        $request_justificacion      = $request->request->get('formPrcEmergencyRequestJustificacionMedica');

        $id                         = $request->request->get('formPrcEmergencyRequestId');
        $edit_studyRequest          = $this->admin->getObject($id);     // get object

    	$securityContext            = $this->container->get('security.context');
    	$sessionUser               = $securityContext->getToken()->getUser();
        $estabLocal                 = $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();

        // $edit_studyRequest          = new RyxSolicitudEstudio();


        //Expediente --| Caso de paciente conocido y registrado
        $ref_expLocal               = $em->getReference('Minsal\SiapsBundle\Entity\MntExpediente', $request_expLocal);
        $edit_studyRequest->setIdExpediente($ref_expLocal);
        /*
         * área | atención (mnt_aten_area_mod_estab)
         */
        $obj_especialidad           = $em->getRepository('MinsalSimagdBundle:RyxSolicitudEstudio')->obtenerAtencionAreaEstab($estabLocal->getId(), $request_areaAtencion, $request_atencion);
        $edit_studyRequest->setIdAtenAreaModEstab($obj_especialidad);
        /*
         * Empleado
         */
        $ref_empleado               = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $request_empleado);
        $edit_studyRequest->setIdEmpleado($ref_empleado);
        /*
         * Modalidad
         */
        $ref_modalidad              = $em->getReference('Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico', $request_modalidad);
        $edit_studyRequest->setIdAreaServicioDiagnostico($ref_modalidad);
        /*
         * Proyecciones
         */
        $arr_pryAdded               = array();
        foreach ($edit_studyRequest->getSolicitudEstudioProyeccion() as $collection_proyeccion)  {
            $arr_pryAdded[]         = $collection_proyeccion->getId();
            if (!in_array($collection_proyeccion->getId(), $request_proyecciones)) {
                $edit_studyRequest->removeSolicitudEstudioProyeccion($collection_proyeccion);    // --| remove from collection if is not in request
            }
        }
        foreach ($request_proyecciones as $request_proyeccion)  {
            if (!in_array($request_proyeccion, $arr_pryAdded)) {
                $ref_proyeccion     = $em->getReference('Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica', $request_proyeccion);
                $edit_studyRequest->addSolicitudEstudioProyeccion($ref_proyeccion);              // --| add to collection if is not in, but is in request
            }
        }
        /*
         * Cambio de prioridad requerida
         */
        $ref_prioridad              = $em->getReference('Minsal\SimagdBundle\Entity\RyxCtlPrioridadAtencionPaciente', $request_prioridad);
        $edit_studyRequest->setIdPrioridadAtencion($ref_prioridad);
        /*
         * Generales
         */
        $edit_studyRequest->setFechaProximaConsulta(\DateTime::createFromFormat('Y-m-d', $request_proximaConsulta));
        $edit_studyRequest->setDatosClinicos(trim($request_datosClinicos));
        $edit_studyRequest->setHipotesisDiagnostica(trim($request_hipotesis));
        $edit_studyRequest->setInvestigando(trim($request_investigando));
        $edit_studyRequest->setJustificacionMedica(trim($request_justificacion));

        //Actualizar solicitud de estudio
        try {
            /*$edit_studyRequest      = */$this->admin->update($edit_studyRequest);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response = new Response();
        $response->setContent(json_encode(
                array(
                    'id' => $edit_studyRequest->getId(),
                    'status' => $status,
                )));
        return $response;
    }

    public function desarrolloSolicitudEstudioAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        $id	= $request->request->get('formPrcEmergencyRequestId');
        $object	= $this->admin->getObject($id);     // get object

        $em	= $this->getDoctrine()->getManager();

        if (!$object) {
	    $status 	= 'object_not_found';
	    $response 	= new Response();
	    $response->setContent(json_encode(array('status' => $status)));
	    return $response;
        }

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $citas	= $object->getSolicitudEstudioCitas();
        $examenes	= $object->getSolicitudEstudioProcedimientosRealizados();
    }

}