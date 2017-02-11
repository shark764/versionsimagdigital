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
use Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxSolicitudDiagnosticoPostEstudioListViewGenerator;

class ImgSolicitudDiagnosticoAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxSolicitudDiagnosticoPostEstudioListViewGenerator(
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
        
        //Get parameter from Preinscripcion, Estudio
        if (!$this->get('request')->query->get('preinscripcion')) { $this->get('request')->query->set('preinscripcion', null); }
        if (!$this->get('request')->query->get('estudio')) { $this->get('request')->query->set('estudio', null); }
        
        //Set the parameters
        $idPrcRequest = $this->get('request')->query->get('preinscripcion');
        $idEstRequest = $this->get('request')->query->get('estudio');
        
        $em = $this->getDoctrine()->getManager();

        //validar parámetros
        if ($idPrcRequest || $idEstRequest) {
            $sessionUser = $this->container->get('security.context')->getToken()->getUser();
            $imgFunciones = new ImagenologiaDigitalFunciones($em);
            $validArray = $imgFunciones->verificarCreacionSolicitudDiagnostico($idPrcRequest, $idEstRequest, $sessionUser);
            if (!$validArray[0]) {
                $this->addFlash('sonata_flash_error', $imgFunciones->obtenerMensajeError($validArray[1]));
                return new RedirectResponse($this->admin->generateUrl('list'));
            }
        }

        $solDiag = $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')
						->findOneBy(array('idSolicitudEstudio' => $idPrcRequest, 'idEstudio' => $idEstRequest));
        if ($solDiag) {
            $this->addFlash('sonata_flash_error', 'Ya existe un registro de Solicitud de Diagnostico creado para este Estudio');
            return new RedirectResponse($this->admin->generateUrl('list'));
        }
        
        return parent::createAction();
    }
    
    public function mostrarInformacionModalAction($idSolicitudEstudioPadre, $idEstudioPadre, $id)
    {
        //Obtener entidad estudio
        $em = $this->getDoctrine()->getManager();
        $entityEst = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')->find($idEstudioPadre);
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

        //Lectura, si esta existe
        $entityLct = $em->getRepository('MinsalSimagdBundle:ImgLectura')->findOneBy(array('idEstudio' => $entityEst->getId()));
        $entityDiag = $entityLct ? $em->getRepository('MinsalSimagdBundle:ImgDiagnostico')
                                        ->findOneBy(array('idLectura' => $entityLct->getId())) : null;

        //Historial clínico y tablas asociadas
        $entityHcl = $entityPrc->getIdSolicitudestudios()->getIdHistorialClinico();
        $entityExmFsc = $em->getRepository('MinsalSeguimientoBundle:SecSignosVitales')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));
        $entityHojaCnt =  $em->getRepository('MinsalSeguimientoBundle:SecMotivoConsulta')->findOneBy(array('idhistorialclinico' => $entityHcl->getId()));

        return $this->render('MinsalSimagdBundle:RyxSolicitudDiagnosticoPostEstudioAdmin:soldiag_modal_support.html.twig', array(
            'expedienteInfo' => $entityExp,
            'pacienteInfo' => $entityPrc->getIdExpediente()->getIdPaciente(),
            'historiaClinicaInfo' => $entityHcl,
            'examenFisicoInfo' => $entityExmFsc,
            'hojaContinuacionInfo' => $entityHojaCnt,
            'preinscripcionInfo' => $entityPrc,
            'citaInfo' => $entityEst->getIdProcedimientoRealizado()->getIdCitaProgramada(),
            'procedimientoRealizadoInfo' => $entityEst->getIdProcedimientoRealizado(),
            'estudioPacienteInfo' => $entityEst,
            'lecturaInfo' => $entityLct,
            'diagnosticoInfo' => $entityDiag,
        ));
    }
    
    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();

        //No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgSolicitudDiagnostico', 'soldiag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

    	//No está autorizado a editar el registro
    	$securityContext 	= $this->container->get('security.context');
    	$sessionUser 		= $securityContext->getToken()->getUser();
        if (!(($em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')->obtenerAccesoSolDiag($id, $sessionUser->getId()) ||
                $securityContext->isGranted('ROLE_ADMIN')) && $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')
                                ->obtenerAccesoSolDiagEstabEdit($id, $sessionUser->getIdEstablecimiento()->getId()))) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        return parent::editAction($id);
    }
    
    public function showAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }
        
        $em = $this->getDoctrine()->getManager();

        //No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgSolicitudDiagnostico', 'soldiag')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

    	//No puede acceder al registro
    	$sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')->obtenerAccesoSolDiagEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
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

        return $this->render($this->admin->getTemplate('list'));
    }
    
    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');
        $__REQUEST__emrg = $this->get('request')->query->get('emrg', 0);
        
        $em = $this->getDoctrine()->getManager();
        
    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();
        
        $results = $em->getRepository('MinsalSimagdBundle:ImgSolicitudDiagnostico')->data($estabLocal->getId(), $BS_FILTERS_DECODE);
                                        
    	$isUser_allowShow   = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
    	$isUser_allowEdit   = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgSolicitudDiagnostico();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'diagnostic_request\', ' . $r['id'] . '); return false;">' .
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

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" unrealizedproceduresworklist-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="diagnosticrequest-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="diagnosticrequest_show"><a class=" diagnosticrequest_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="diagnosticrequest_edit"><a class=" diagnosticrequest_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="diagnosticrequest_delete"><a class=" diagnosticrequest_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="diagnosticrequest_studydownload"><a class=" diagnosticrequest_studydownload_action "><span class="glyphicon glyphicon-eye-open"></span>Recuperar estudio(s)</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="diagnosticrequest_create"><a class=" diagnosticrequest_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                            '<li data-item="diagnosticrequest_addtothis"><a class=" diagnosticrequest_addtothis "><span class="glyphicon glyphicon-plus-sign"></span>Crear para este diagnóstico</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_registro']    = $formatter->dateFormatter($r['fecha_registro']);
            $results[$key]['fecha_edicion']     = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" diagnosticrequest-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            $results[$key]['soldiag_fechaCreacion'] = $r['soldiag_fechaCreacion']->format('Y-m-d H:i:s A');
            $results[$key]['soldiag_fechaProximaConsulta']   = $r['soldiag_fechaProximaConsulta']->format('Y-m-d');
            
            $results[$key]['allowShow']                      = $isUser_allowShow;
            
            $results[$key]['allowEdit']                      = (false !== $isUser_allowEdit && ($estabLocal->getId() == $r['prc_id_origen']) &&
                    ($r['soldiag_id_userReg'] == $sessionUser->getId() || $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
        }
        
        return $this->renderJson($results);
    }
    
    public function crearSolicitudDiagAction(Request $request)
    {
        $request->isXmlHttpRequest();
        $status                 = 'OK';
	
        //Get parameter from form
        $preinscripcion         = $request->request->get('formSolicitudDiagIdSolicitudEstudio');
        $this->get('request')->request->set('preinscripcion', $preinscripcion ? $preinscripcion : null);
        $estudio                = $request->request->get('formSolicitudDiagIdEstudio');
        $this->get('request')->request->set('estudio', $estudio ? $estudio : null);
        
        $empleado               = $request->request->get('formSolicitudDiagIdEmpleado');
        $remota                 = $request->request->get('formSolicitudDiagRemota') ? TRUE : FALSE;
        $solicitado             = $request->request->get('formSolicitudDiagIdEstablecimientoSolicitado');
        $justificacion = $request->request->get('formSolicitudDiagJustificacion');
        $observaciones          = $request->request->get('formSolicitudDiagObservaciones');
        $fechaProximaConsulta   = $request->request->get('formSolicitudDiagFechaProximaConsulta');

        //Nueva instancia
        $solicitudDiag          = $this->admin->getNewInstance();
        // $solicitudDiag = new ImgSolicitudDiagnostico();
        
        $em = $this->getDoctrine()->getManager();
        
        /** */
        $solicitudDiag->setFechaProximaConsulta(\DateTime::createFromFormat('Y-m-d', $fechaProximaConsulta));
        $solicitudDiag->setJustificacion($justificacion);
        $solicitudDiag->setObservaciones($observaciones);
        $solicitudDiag->setSolicitudRemota($remota);
        /** */
        
        //Empleado
        $empleadoReference      = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $solicitudDiag->setIdEmpleado($empleadoReference);
        //Estado
        $estabReference         = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $solicitado);
        $solicitudDiag->setIdEstablecimientoSolicitado($estabReference);

        //Crear registro
        try {
            /*$solicitudDiag      = */$this->admin->create($solicitudDiag);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(
                array('id' => $solicitudDiag->getId(),
                    'status' => $status,
                    // 'url' => $this->admin->generateUrl('show', array('id' => $nuevoBloqueo->getId()))
                )));
        return $response;
    }
    
    public function editarSolicitudDiagAction(Request $request)
    {
        $request->isXmlHttpRequest();
        $status                 = 'OK';
	
        //Get parameter from Solicitud diagnostico
        $id                     = $request->request->get('formSolicitudDiagId');
        
        $empleado               = $request->request->get('formSolicitudDiagIdEmpleado');
        $remota                 = $request->request->get('formSolicitudDiagRemota') ? TRUE : FALSE;
        $solicitado             = $request->request->get('formSolicitudDiagIdEstablecimientoSolicitado');
        $justificacion = $request->request->get('formSolicitudDiagJustificacion');
        $observaciones          = $request->request->get('formSolicitudDiagObservaciones');
        $fechaProximaConsulta   = $request->request->get('formSolicitudDiagFechaProximaConsulta');
        
        //Objeto
        $solicitudDiag          = $this->admin->getObject($id);
        // $solicitudDiag = new ImgSolicitudDiagnostico();
        
        $em = $this->getDoctrine()->getManager();
        
        /** */
        $solicitudDiag->setFechaProximaConsulta(\DateTime::createFromFormat('Y-m-d', $fechaProximaConsulta));
        $solicitudDiag->setJustificacion($justificacion);
        $solicitudDiag->setObservaciones($observaciones);
        $solicitudDiag->setSolicitudRemota($remota);
        /** */
        
        //Empleado
        $empleadoReference      = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $empleado);
        $solicitudDiag->setIdEmpleado($empleadoReference);
        //Estado
        $estabReference         = $em->getReference('Minsal\SiapsBundle\Entity\CtlEstablecimiento', $solicitado);
        $solicitudDiag->setIdEstablecimientoSolicitado($estabReference);
        
        //Actualizar registro
        try {
            /*$solicitudDiag      = */$this->admin->update($solicitudDiag);
        } catch (Exception $e) {
            $status             = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(
                array('id' => $solicitudDiag->getId(),
                    'status' => $status,
                    // 'url' => $this->admin->generateUrl('show', array('id' => $nuevoBloqueo->getId()))
                )));
        return $response;
    }

}