<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
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
use Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado;
use Minsal\SimagdBundle\Entity\ImgMaterialUtilizado;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxProcedimientoRadiologicoRealizadoListViewGenerator;

class ImgProcedimientoRealizadoAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxProcedimientoRadiologicoRealizadoListViewGenerator(
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
     * Create action
     *
     * @return \Minsal\SimagdBundle\Controller\RedirectResponse
     */
    public function createAction()
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        //Get parameter from Preinscripcion
        if (!$this->get('request')->query->get('__prc')) {
            $this->get('request')->query->set('__prc', null);
        }
        if (!$this->get('request')->query->get('__cit')) {
            $this->get('request')->query->set('__cit', null);
        }
        if (!$this->get('request')->query->get('__cmpl')) {
            $this->get('request')->query->set('__cmpl', null);
        }
        if (!$this->get('request')->query->get('__pndR')) {
            $this->get('request')->query->set('__pndR', null);
        }

        $idPrc  = $this->get('request')->query->get('__prc');
        $idCit  = $this->get('request')->query->get('__cit');
        $idCmpl = $this->get('request')->query->get('__cmpl');

//         $em = $this->getDoctrine()->getManager();
//
//         //validar parámetros
//         if ($idPrc || $idCit) {
//             $sessionUser = $this->container->get('security.context')->getToken()->getUser();
//             $imgFunciones = new ImagenologiaDigitalFunciones($em);
//             $validArray = $imgFunciones->verificarCreacionProcedimientoRealizado($idPrc, $idCit, $sessionUser);
//             if (!$validArray[0]) {
//                 $this->addFlash('sonata_flash_error', $imgFunciones->obtenerMensajeError($validArray[1]));
//                 return new RedirectResponse($this->admin->generateUrl('list'));
//             }
//         }
//
//         $realizado = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')->findOneBy(array('idSolicitudEstudio' => $idPrc));
//         if ($realizado) {
//             $this->addFlash('sonata_flash_error', 'Ya existe un registro de información post-examen creado para esta preinscripción');
//             return new RedirectResponse($this->admin->generateUrl('list'));
//         }

//        return parent::createAction();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();

        //validar parámetros
//        if ($idExpRequest || $idHsClRequest) {
//            $sessionUser   = $this->container->get('security.context')->getToken()->getUser();
//            $imgFunciones   = new ImagenologiaDigitalFunciones($em);
//            $validArray     = $imgFunciones->verificarCreacionPreinscripcion($idExpRequest, $idHsClRequest, $sessionUser);
//            if (!$validArray[0]) {
//                $this->addFlash('sonata_flash_error', $imgFunciones->obtenerMensajeError($validArray[1]));
//                return new RedirectResponse($this->admin->generateUrl('list'));
//            }
//        }

        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        /*
         * **********************************************************************
         * --| CUSTOM CODE
         * **********************************************************************
         * **********************************************************************
         * Asegurar al menos 5 item en lista de materiales | COLLECTION
         * **********************************************************************
         */
        $num_materiales_to_add  = 5;
        for ($x = 0; $x < $num_materiales_to_add; $x++) {
            $new_added_materialUtilizado    = new ImgMaterialUtilizado();
            $new_added_materialUtilizado->setIdProcedimientoRealizado($object);
            $object->addMaterialUtilizadoV2($new_added_materialUtilizado);
        }
        $this->addFlash('sonata_flash_success', 'DEBE TENERSE UNA LISTA DE MATERIALES A LA IZQUIERDA, AL ESCOGERLOS SE AGREGUE UNA NUEVA LINEA EN COLLECTION');
        $this->addFlash('sonata_flash_success', 'MATERIALES EN EDIT, SI SE ACABA INVENTARIO, NO APARECEN EN LOS YA REGISTRADOS');
        /*
         * **********************************************************************
         * END |-- CUSTOM CODE
         * **********************************************************************
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
	$patient        = $object->getIdSolicitudEstudio()->getIdExpediente() ? $object->getIdSolicitudEstudio()->getIdExpediente()->getIdPaciente() : null;
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
      //   if ((null !== $this->get('request')->get('btn_create_and_diagnosticate')) ||
      //                           (null !== $this->get('request')->get('btn_edit_and_diagnosticate'))) {
    		// $url = $this->admin->generateObjectUrl('diagnostico', $object);
      //   }

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
    }

    public function addPendingToWorkListAction()
    {
        //Get parameter from Preinscripcion, Cita, Solcmpl, pndR
        if (!$this->get('request')->request->get('__prc')) {
            $this->get('request')->request->set('__prc', null);
        }
        if (!$this->get('request')->request->get('__cit')) {
            $this->get('request')->request->set('__cit', null);
        }
        if (!$this->get('request')->request->get('__cmpl')) {
            $this->get('request')->request->set('__cmpl', null);
        }
        if (!$this->get('request')->request->get('__pndR')) {
            $this->get('request')->request->set('__pndR', null);
        }

        //Nueva instancia
        $realizado          = $this->admin->getNewInstance();

        //Cambio de estado de registro
        $em = $this->getDoctrine()->getManager();
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoProcedimientoRealizado', '1'); //Inicial
        $realizado->setIdEstadoProcedimientoRealizado($estadoReference);

        //Crear registro
        try {
            /*$realizado      = */$this->admin->create($realizado);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function mostrarInformacionModalAction($idSolicitudEstudioPadre, $idCitaProgramada, $id)
    {
        //Obtener entidad preinscripcion
        $em = $this->getDoctrine()->getManager();
        $entityPrc = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->find($idSolicitudEstudioPadre);
	if (!$entityPrc) {
            return $this->render('MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_modal_support_default.html.twig', array());
	}

        //Establecimiento local
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        //Expediente local e información del paciente
	$entityExp = $em->getRepository('MinsalSiapsBundle:MntExpediente')
		                        ->findOneBy(array('idEstablecimiento' => $estabLocal,
		                                        'idPaciente' => $entityPrc->getIdExpediente()->getIdPaciente()->getId()
		                                    ));
        //Estudio de paciente, si este existe
        $entityEst = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->findOneBy(array('idProcedimientoRealizado' => $id));

        //Solicitud de estudio
        $entitySolEst = $entityPrc->getIdSolicitudestudios();
        //Detalles de solicitud de estudio
        $entityDetSolEst = $entitySolEst ? $em->getRepository('MinsalSeguimientoBundle:SecDetallesolicitudestudios')
                                        ->findBy(array('idsolicitudestudio' => $entitySolEst->getId())) : null;

        //Historial clínico y tablas asociadas
        $entityHcl = $entitySolEst->getIdHistorialClinico();
        $entityExmFsc = $em->getRepository('MinsalSeguimientoBundle:SecSignosVitales')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));
        $entityHojaCnt =  $em->getRepository('MinsalSeguimientoBundle:SecMotivoConsulta')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));

        //Cita programada, si existe
        $entityCit = $em->getRepository('MinsalSimagdBundle:ImgCita')->find($idCitaProgramada);

        return $this->render('MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_modal_support.html.twig', array(
            'expedienteInfo' => $entityExp,
            'pacienteInfo' => $entityPrc->getIdExpediente()->getIdPaciente(),
            'historiaClinicaInfo' => $entityHcl,
            'solicitudEstInfo' => $entitySolEst,
            'detalleSolEstInfo' => $entityDetSolEst,
            'examenFisicoInfo' => $entityExmFsc,
            'hojaContinuacionInfo' => $entityHojaCnt,
            'preinscripcionInfo' => $entityPrc,
            'citaInfo' => $entityCit,
            'estudioPacienteInfo' => $entityEst,
        ));
    }

    public function obtenerEstudioRealizadoAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();

        //Estudio de paciente, si este existe
        $entityEst = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')
				->findOneBy(array('idProcedimientoRealizado' => $id));

        return $this->render('MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_recuperarEstudio.html.twig', array(
            'estudioPacienteObject' => $entityEst,
        ));
    }

    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        /** request object id */
        $id             = $this->get('request')->get($this->admin->getIdParameter());

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgProcedimientoRealizado', 'prz')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

	//No puede acceder al registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

//        return parent::editAction($id);

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
	$patient        = $object->getIdSolicitudEstudio()->getIdExpediente() ? $object->getIdSolicitudEstudio()->getIdExpediente()->getIdPaciente() : null;
	$localRecord    = $em->getRepository('MinsalSiapsBundle:MntExpediente')
						        ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
						                        'idPaciente' => $patient ? $patient->getId() : null
						                    ));
        $this->addFlash('sonata_flash_success', 'DEBE TENERSE UNA LISTA DE MATERIALES A LA IZQUIERDA, AL ESCOGERLOS SE AGREGUE UNA NUEVA LINEA EN COLLECTION');
        $this->addFlash('sonata_flash_success', 'MATERIALES EN EDIT, SI SE ACABA INVENTARIO, NO APARECEN EN LOS YA REGISTRADOS');

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
            'localRecord' => $localRecord,
        ));
    }

    public function showAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgProcedimientoRealizado', 'prz')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        // No puede acceder al registro
        $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
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
            $GROUP_DEPENDENT_ENTITIES['m_expl']   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->getRadiologicalProceduresGrouped($estabLocal->getId());
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

        $results = $em->getRepository('MinsalSimagdBundle:ImgProcedimientoRealizado')->data($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgProcedimientoRealizado();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
                            '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                            '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>ORIGEN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['origen'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROCEDENCIA:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['area_atencion'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['atencion'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['medico'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['modalidad'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['triage'] . '</div></div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            // $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" worklist-show-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Ver detalle..." >' .
            //             // '<a class=" worklist-show-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Ver detalle..." >' .
            //                 // 'Ver' .
            //                 '<i class="glyphicon glyphicon-chevron-down"></i>' .
            //             '</a>' .
            //         '</div>' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" worklist-save-form-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Abrir formulario..." >' .
            //             // '<a class=" worklist-save-form-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Abrir formulario..." >' .
            //                 // 'Formulario' .
            //                 '<i class="glyphicon glyphicon-edit"></i>' .
            //             '</a>' .
            //         '</div>' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" worklist-save-and-pacs-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Guardar y asociar..." >' .
            //             // '<a class=" worklist-save-and-pacs-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Guardar y asociar..." >' .
            //                 // 'Guardar y asociar' .
            //                 // '<i class="glyphicon glyphicon-check"></i>' .
            //                 '<i class="glyphicon glyphicon-link"></i>' .
            //             '</a>' .
            //         '</div>' .
            //         // '<span class="bs-btn-separator-toolbar"></span>' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" worklist-save-action btn-link btn-link-emergency " href="javascript:void(0)" title="Guardar sin asociar..." >' .
            //             // '<a class=" worklist-save-action btn btn-emergency btn-outline btn-xs " href="javascript:void(0)" title="Guardar sin asociar..." >' .
            //                 // 'Guardar' .
            //                 '<i class="glyphicon glyphicon-check"></i>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';
            $results[$key]['action'] = '<div class="btn-group btn-group-xs"> <button type="button" class="btn btn-link btn-link-emergency dropdown-toggle material-btn-list-op" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: #e45315; cursor: context-menu; "> <span class="glyphicon glyphicon-cog"></span> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> </div>';

            $results[$key]['prz_fechaRegistro']            = $r['prz_fechaRegistro']->format('Y-m-d H:i:s A');
            $results[$key]['prz_fechaAtendido']                  = $r['prz_fechaAtendido'] ? $r['prz_fechaAtendido']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaRealizado']                 = $r['prz_fechaRealizado'] ? $r['prz_fechaRealizado']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaProcesado']                 = $r['prz_fechaProcesado'] ? $r['prz_fechaProcesado']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prz_fechaAlmacenado']                = $r['prz_fechaAlmacenado'] ? $r['prz_fechaAlmacenado']->format('Y-m-d H:i:s A') : '';

            $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion'] ? $r['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prc_fechaProximaConsulta']           = $r['prc_fechaProximaConsulta'] ? $r['prc_fechaProximaConsulta']->format('Y-m-d') : '';

            $results[$key]['cit_fechaCreacion']              = $r['cit_fechaCreacion'] ? $r['cit_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaConfirmacion']          = $r['cit_fechaConfirmacion'] ? $r['cit_fechaConfirmacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaReprogramacion']        = $r['cit_fechaReprogramacion'] ? $r['cit_fechaReprogramacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaHoraInicio']                = $r['cit_fechaHoraInicio'] ? $r['cit_fechaHoraInicio']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaHoraFin']                   = $r['cit_fechaHoraFin'] ? $r['cit_fechaHoraFin']->format('Y-m-d H:i:s A') : '';

            $results[$key]['solcmpl_fechaSolicitud']             = $r['solcmpl_fechaSolicitud'] ? $r['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';

            $results[$key]['prz_editUrl']                        = $this->generateUrl('simagd_realizado_edit', array('id' => $r['prz_id']));

            $results[$key]['allowShow']                          = $isUser_allowShow;

            $results[$key]['allowEdit']                          = $isUser_allowEdit;
        }

        return $this->renderJson($results);
    }

    /**
     * Redireccionar hacia transcripción de resultados
     */
    public function diagnosticoAction($id = null)
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        //contiene estudio almacenado en PACS
	//producto de este procedimiento realizado al paciente
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

        if (false === (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE')
			    && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE'))
		    || $securityContext->isGranted('ROLE_ADMIN'))) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return $this->render($this->admin->getTemplate('diagnostico'), array(
            'examen'    => $object,
            'action' 	=> 'edit',
        ));
    }

    public function registrarEstudioAlmacenadoAction()
    {
        //Get parameter from Preinscripcion, Cita, Solcmpl, pndR
        if (!$this->get('request')->request->get('__prc')) {
            $this->get('request')->request->set('__prc', null);
        }
        if (!$this->get('request')->request->get('__cit')) {
            $this->get('request')->request->set('__cit', null);
        }
        if (!$this->get('request')->request->get('__cmpl')) {
            $this->get('request')->request->set('__cmpl', null);
        }
        if (!$this->get('request')->request->get('__pndR')) {
            $this->get('request')->request->set('__pndR', null);
        }

        //Nueva instancia
        $realizado          = $this->admin->getNewInstance();

        $em = $this->getDoctrine()->getManager();

        //Cambio de estado de registro
        $statusAlmc         = $em->getRepository('MinsalSimagdBundle:ImgCtlEstadoProcedimientoRealizado')->findOneBy(array('codigo' => 'ALM'));
        $realizado->setIdEstadoProcedimientoRealizado($statusAlmc); // --| Almacenado

        /*
         ************************************************************************
         * ASOCIAR ESTUDIO
         ************************************************************************
         */
        // $realizado = new ImgProcedimientoRealizado();
        $associated_study = $this->admin->getAssociatedStudy($realizado);
        $realizado->addExamenEstudio($associated_study);

        //Crear registro
        try {
            throw new \Exception('AQUÍ SE DEBE CAMBIAR LA VARIABLE STATUS, PARA PODER MOSTRAR EL ALERT CORRECTO "No se asoció ningún estudio al Expediente"');
            /*$realizado      = */$this->admin->create($realizado);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function actualizarEstudioAlmacenadoAction()
    {
        //Get parameter from Preinscripcion, Cita, Solcmpl, pndR, prz --> id
        if (!$this->get('request')->request->get('__prc')) {
            $this->get('request')->request->set('__prc', null);
        }
        if (!$this->get('request')->request->get('__cit')) {
            $this->get('request')->request->set('__cit', null);
        }
        if (!$this->get('request')->request->get('__cmpl')) {
            $this->get('request')->request->set('__cmpl', null);
        }
        if (!$this->get('request')->request->get('__pndR')) {
            $this->get('request')->request->set('__pndR', null);
        }
        if (!$this->get('request')->request->get('__prz')) {
            $this->get('request')->request->set('__prz', null);
        }

        $id                 = $this->get('request')->request->get('__prz');
        //Nueva instancia
        $realizado          = $this->admin->getObject($id);

        $em = $this->getDoctrine()->getManager();

        //Cambio de estado de registro
        $statusAlmc         = $em->getRepository('MinsalSimagdBundle:ImgCtlEstadoProcedimientoRealizado')->findOneBy(array('codigo' => 'ALM'));
        $realizado->setIdEstadoProcedimientoRealizado($statusAlmc); // --| Almacenado

        //Crear registro
        try {
            /*$realizado      = */$this->admin->update($realizado);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function enlazarEstudio($new_przObject = null)
    {
        $new_przObject = new ImgProcedimientoRealizado();
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();

        $new_studyObject    = new \Minsal\SimagdBundle\Entity\ImgEstudioPaciente();
        $new_studyObject->setFechaEstudio(new \DateTime('now'));
        $new_studyObject->setIdProcedimientoRealizado($new_przObject);
        $new_studyObject->setIdEstablecimiento($estabLocal);
        if ($new_przObject->getIdSolicitudEstudio()->getIdExpediente()) {
            $explocalObject = $em->getRepository('MinsalSiapsBundle:MntExpediente')
                                                    ->findOneBy(array('idEstablecimiento' => $estabLocal->getId(),
                                                                        'idPaciente' => $new_przObject->getIdSolicitudEstudio()->getIdExpediente()->getIdPaciente()->getId()
                            ));
            $new_studyObject->setIdExpediente($explocalObject);
        } elseif ($new_przObject->getIdSolicitudEstudio()->getIdExpedienteFicticio()) {
            $new_studyObject->setIdExpedienteFicticio($new_przObject->getIdSolicitudEstudio()->getIdExpedienteFicticio());
        }
        if ($new_przObject->getEsComplementario()) {
            $new_studyObject->setIdEstudioPadre($new_przObject->getIdSolicitudEstudioComplementario()->getIdEstudioPadre());
        }
        $new_studyObject->setEstudioUid();
    }

}