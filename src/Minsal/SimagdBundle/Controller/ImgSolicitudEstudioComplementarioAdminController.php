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
use Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Generator\ListViewGenerator\RyxSolicitudEstudioComplementarioListViewGenerator;

class ImgSolicitudEstudioComplementarioAdminController extends Controller
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

        $em = $this->getDoctrine()->getManager();

        //////// --| builder entity
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxSolicitudEstudioComplementarioListViewGenerator(
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

    public function listAction() {
        //Acceso denegado
        if (false === $this->admin->isGranted('LIST')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        return $this->render($this->admin->getTemplate('list'));
    }
    
    public function listarSolicitudesEstudioComplementarioAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');
        $__REQUEST__emrg = $this->get('request')->query->get('emrg', 0);
        
        $em                 = $this->getDoctrine()->getManager();

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $results         = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudioComplementario')
                                        ->obtenerSolicitudesEstudioComplementarioV2($estabLocal->getId(), $BS_FILTERS_DECODE);
                                        
    	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
    	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;
        
        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudioComplementario();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'further_study_request\', ' . $r['id'] . '); return false;">' .
                            // '<div class="container">' .
                            // '<div class=" col-lg-12 col-md-12 col-sm-12">' .
                                '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['paciente'] . '</h3></div></div>' .
                                '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['numero_expediente'] . '</span></div></div><p></p>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>ORIGEN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['origen'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROCEDENCIA:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['area_atencion'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>SERVICIO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['atencion'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MÉDICO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['medico'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MODALIDAD:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['modalidad'] . '</div></div>' .
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>TRIAGE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['triage'] . '</div></div>' .
                                // '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>RADIÓLOGO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['radiologo'] . '</div></div>' .
                            // '</div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-show-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Ver detalle..." >' .
                        // '<a class=" worklist-show-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Ver detalle..." >' .
                            // 'Ver' .
                            '<i class="glyphicon glyphicon-chevron-down"></i>' .
                        '</a>' .
                    '</div>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-form-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Abrir formulario..." >' .
                        // '<a class=" worklist-save-form-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Abrir formulario..." >' .
                            // 'Formulario' .
                            '<i class="glyphicon glyphicon-edit"></i>' .
                        '</a>' .
                    '</div>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-and-pacs-action btn-link btn-link-black-thrash " href="javascript:void(0)" title="Guardar y asociar..." >' .
                        // '<a class=" worklist-save-and-pacs-action btn btn-black-thrash btn-outline btn-xs " href="javascript:void(0)" title="Guardar y asociar..." >' .
                            // 'Guardar y asociar' .
                            // '<i class="glyphicon glyphicon-check"></i>' .
                            '<i class="glyphicon glyphicon-link"></i>' .
                        '</a>' .
                    '</div>' .
                    // '<span class="bs-btn-separator-toolbar"></span>' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" worklist-save-action btn-link btn-link-emergency " href="javascript:void(0)" title="Guardar sin asociar..." >' .
                        // '<a class=" worklist-save-action btn btn-emergency btn-outline btn-xs " href="javascript:void(0)" title="Guardar sin asociar..." >' .
                            // 'Guardar' .
                            '<i class="glyphicon glyphicon-check"></i>' .
                        '</a>' .
                    '</div>' .
                '</div>';

            $results[$key]['est_fechaEstudio']       = $r['est_fechaEstudio']->format('Y-m-d H:i:s A');
            $results[$key]['solcmpl_fechaSolicitud'] = $r['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A');
            
            $results[$key]['solcmpl_editUrl']        = $this->generateUrl('simagd_solicitud_estudio_complementario_edit', array('id' => $r['solcmpl_id']));
            
            $results[$key]['allowShow']              = $isUser_allowShow;
            
            $results[$key]['allowEdit']              = (false !== $isUser_allowEdit && ($estabLocal->getId() == $r['solcmpl_id_solicitado']) &&
                    ($r['solcmpl_id_userReg'] == $sessionUser->getId() || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
            
            $results[$key]['solcmpl_solicitudEstudioComplementarioProyeccion']   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerProyeccionesSolicitudEstudioComplementario($r['solcmpl_id']);
        }
        
        $response           = new Response();
        $response->setContent(json_encode($results));
        return $response;
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
        if (!$this->get('request')->query->get('__prc')) {
            $this->get('request')->query->set('__prc', null);
        }
        if (!$this->get('request')->query->get('__est')) {
            $this->get('request')->query->set('__est', null);
        }
        if (!$this->get('request')->query->get('__cmpl')) {
            $this->get('request')->query->set('__cmpl', null);
        }
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $em                 = $this->getDoctrine()->getManager();

        // $idPrcRequest = $this->get('request')->query->get('__prc');
        // $idEstPadreRequest = $this->get('request')->query->get('__est');
//        
        // $em = $this->getDoctrine()->getManager();
//
//        //validar parámetros
//        if ($idPrcRequest || $idEstPadreRequest) {
//            $sessionUser = $this->container->get('security.context')->getToken()->getUser();
//            $imgFunciones = new ImagenologiaDigitalFunciones($em);
//            $validArray = $imgFunciones->verificarCreacionPreinscripcion($idPrcRequest, $idEstPadreRequest, $sessionUser);
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
        
        /** ***** CUSTOM CODE ***** */
        $id_cmplRequest     = $this->get('request')->query->get('__cmpl');      /** Solicitud de la que parte la actual	*/
        $object_cmplRequest = $this->admin->getObject($id_cmplRequest);     /** if $object_cmplRequest is not null 	*/
        
        if ($object_cmplRequest)
        {
	    $object->setIdRadiologoSolicita($object_cmplRequest->getIdRadiologoSolicita());
	    $object->setIdEstablecimientoSolicitado($object_cmplRequest->getIdEstablecimientoSolicitado());
            
	    $object->setIdEstudioPadre($object_cmplRequest->getIdEstudioPadre());
	    $object->setIdSolicitudEstudio($object_cmplRequest->getIdSolicitudEstudio() ? $object_cmplRequest->getIdSolicitudEstudio() : $object->getIdSolicitudEstudio());
            
	    $object->setJustificacion($object_cmplRequest->getJustificacion());
	    $object->setIndicacionesEstudio($object_cmplRequest->getIndicacionesEstudio());
	    
	    $object->setIdPrioridadAtencion($object_cmplRequest->getIdPrioridadAtencion());
        }
        /** ***** END CUSTOM CODE ***** */

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);
        
        
        /** ***** CUSTOM CODE ***** */
//        if ($object->getIdAtenAreaModEstab())
//        {
//	    $form->get('idAreaAtencion')->setData($object->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion());
//	    $form->get('idAtencion')->setData($object->getIdAtenAreaModEstab()->getIdAtencion());
//        }
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
	$patient        = $object->getIdEstudioPadre()->getIdExpediente() ? $object->getIdEstudioPadre()->getIdExpediente()->getIdPaciente() : null;
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
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $em                 = $this->getDoctrine()->getManager();
        
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
	$patient        = $object->getIdEstudioPadre()->getIdExpediente() ? $object->getIdEstudioPadre()->getIdExpediente()->getIdPaciente() : null;
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

    public function cambiarPrioridadAtencionSolicitudAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $id                 = $request->request->get('id');
        $solEstudioCmpl     = $this->admin->getObject($id);

        $prioridadNv        = $request->request->get('formSolcmplEditIdPrioridadAtencion');

        $em                 = $this->getDoctrine()->getManager();

        //Cambio de prioridad requerida
        $prioridadReference = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', $prioridadNv);
        $solEstudioCmpl->setIdPrioridadAtencion($prioridadReference);

        //Actualizar solicitud
        try {
            /*$solEstudioCmpl = */$this->admin->update($solEstudioCmpl);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response           = new Response();
        $response->setContent(json_encode(array()));
        return $response;
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
        $id                 = $this->get('request')->get($this->admin->getIdParameter());
        //contiene solicitud de estudio complementario anterior
	//brinda facilidad para crear nueva solicitud a partir de anterior
        $object             = $this->admin->getObject($id);
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        if (false === (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE')
			    && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_EDIT'))
		    || $securityContext->isGranted('ROLE_ADMIN'))) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        return $this->render($this->admin->getTemplate('show'), array(
            'solicitud'	=> $object,
            'action' 	=> 'edit',
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
        if ((null !== $this->get('request')->get('btn_create_and_show')) ||
                                (null !== $this->get('request')->get('btn_edit_and_show'))) {
    		$url = $this->admin->generateObjectUrl('show', $object);
        }

        /** Crear/Actualizar y mostrar registro */
        if ((null !== $this->get('request')->get('btn_create_and_request')) ||
                                (null !== $this->get('request')->get('btn_edit_and_request'))) {
    		$url = $this->admin->generateObjectUrl('show', $object);
        }

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
    }

    public function crearSolicitudEstudioComplementarioFastFormatAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $status = 'OK';
        
        $request_solicitudPadre = $request->request->get('formSolcmplFastRequestIdSolicitudEstudio');
        $request_estudioPadre   = $request->request->get('formSolcmplFastRequestIdEstudioPadre');
        $request_radiologo      = $request->request->get('formSolcmplFastRequestIdRadiologo');
        $request_modalidad      = $request->request->get('formSolcmplFastRequestIdAreaServicioDiagnostico');
        $request_proyecciones   = $request->request->get('formSolcmplFastRequestSolicitudEstudioProyeccion');
        $request_prioridad      = $request->request->get('formSolcmplFastRequestIdPrioridadAtencion');
        $request_justificacion  = $request->request->get('formSolcmplFastRequestJustificacion');
        $request_indicaciones   = $request->request->get('formSolcmplFastRequestIndicaciones');

        //Nueva instancia
        $new_studyRequest   = $this->admin->getNewInstance();
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $em = $this->getDoctrine()->getManager();
        
        // $new_studyRequest = new ImgSolicitudEstudioComplementario();
        
        /*
         * Registros padres
         */
        $ref_solicitudPadre  = $em->getReference('Minsal\SimagdBundle\Entity\ImgSolicitudEstudio', $request_solicitudPadre);
        $new_studyRequest->setIdSolicitudEstudio($ref_solicitudPadre);
        $ref_estudioPadre  = $em->getReference('Minsal\SimagdBundle\Entity\ImgEstudioPaciente', $request_estudioPadre);
        $new_studyRequest->setIdEstudioPadre($ref_estudioPadre);
        
        /*
         * Radiólogo
         */
        $ref_radiologo  = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $request_radiologo);
        $new_studyRequest->setIdRadiologoSolicita($ref_radiologo);
        /*
         * Modalidad
         */
        $ref_modalidad  = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $request_modalidad);
        $new_studyRequest->setIdAreaServicioDiagnostico($ref_modalidad);
        /*
         * Proyecciones
         */
        foreach ($request_proyecciones as $request_proyeccion)  {
            $ref_proyeccion = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlProyeccion', $request_proyeccion);
            $new_studyRequest->addSolicitudEstudioComplementarioProyeccion($ref_proyeccion);
        }
        /*
         * Cambio de prioridad requerida
         */
        $ref_prioridad  = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', $request_prioridad);
        $new_studyRequest->setIdPrioridadAtencion($ref_prioridad);
        /*
         * Generales
         */
        $new_studyRequest->setJustificacion(trim($request_justificacion));
        $new_studyRequest->setIndicacionesEstudio(trim($request_indicaciones));

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

    public function editarSolicitudEstudioComplementarioFastFormatAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $status = 'OK';
        
        $request_solicitudPadre = $request->request->get('formSolcmplFastRequestIdSolicitudEstudio');
        $request_estudioPadre   = $request->request->get('formSolcmplFastRequestIdEstudioPadre');
        $request_radiologo      = $request->request->get('formSolcmplFastRequestIdRadiologo');
        $request_modalidad      = $request->request->get('formSolcmplFastRequestIdAreaServicioDiagnostico');
        $request_proyecciones   = $request->request->get('formSolcmplFastRequestSolicitudEstudioProyeccion');
        $request_prioridad      = $request->request->get('formSolcmplFastRequestIdPrioridadAtencion');
        $request_justificacion  = $request->request->get('formSolcmplFastRequestJustificacion');
        $request_indicaciones   = $request->request->get('formSolcmplFastRequestIndicaciones');
        
        $id = $request->request->get('formSolcmplFastRequestId');
        $edit_studyRequest  = $this->admin->getObject($id);     // get object
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $em = $this->getDoctrine()->getManager();
        
        // $edit_studyRequest = new ImgSolicitudEstudioComplementario();
        
        /*
         * Radiólogo
         */
        $ref_radiologo  = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $request_radiologo);
        $edit_studyRequest->setIdRadiologoSolicita($ref_radiologo);
        /*
         * Modalidad
         */
        $ref_modalidad  = $em->getReference('Minsal\SiapsBundle\Entity\CtlAreaServicioDiagnostico', $request_modalidad);
        $edit_studyRequest->setIdAreaServicioDiagnostico($ref_modalidad);
        /*
         * Proyecciones
         */
        $arr_pryAdded   = array();
        foreach ($edit_studyRequest->getSolicitudEstudioComplementarioProyeccion() as $collection_proyeccion)  {
            $arr_pryAdded[] = $collection_proyeccion->getId();
            if (!in_array($collection_proyeccion->getId(), $request_proyecciones)) {
                $edit_studyRequest->removeSolicitudEstudioComplementarioProyeccion($collection_proyeccion);    // --| remove from collection if is not in request
            }
        }
        foreach ($request_proyecciones as $request_proyeccion)  {
            if (!in_array($request_proyeccion, $arr_pryAdded)) {
                $ref_proyeccion = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlProyeccion', $request_proyeccion);
                $edit_studyRequest->addSolicitudEstudioComplementarioProyeccion($ref_proyeccion);              // --| add to collection if is not in, but is in request
            }
        }
        /*
         * Cambio de prioridad requerida
         */
        $ref_prioridad  = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlPrioridadAtencion', $request_prioridad);
        $edit_studyRequest->setIdPrioridadAtencion($ref_prioridad);
        /*
         * Generales
         */
        $edit_studyRequest->setJustificacion(trim($request_justificacion));
        $edit_studyRequest->setIndicacionesEstudio(trim($request_indicaciones));

        //Actualizar solicitud de estudio
        try {
            /*$edit_studyRequest  = */$this->admin->update($edit_studyRequest);
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

}