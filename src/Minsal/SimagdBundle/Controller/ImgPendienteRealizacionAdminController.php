<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;
use Minsal\SimagdBundle\Entity\ImgPendienteRealizacion;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxExamenPendienteRealizacionListViewGenerator;

class ImgPendienteRealizacionAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxExamenPendienteRealizacionListViewGenerator(
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
    
    public function realizarAction()
    {
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

        $em = $this->getDoctrine()->getManager();
        $citaAsociada   = $em->getRepository('MinsalSimagdBundle:ImgCita')->findOneBy(array('idSolicitudEstudio' => $preinscripcion));

        return $this->redirect($this->generateUrl('simagd_realizado_addPendingToWorkList',
                        array('__prc' => $preinscripcion,
                                '__cit' => $citaAsociada ? $citaAsociada->getId() : null,
                                '__pndR' => $id
                            )));
    }

    public function listAction()
    {
	   //Acceso denegado
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

    	$securityContext	= $this->container->get('security.context');
    	$sessionUser		= $securityContext->getToken()->getUser();
        $estabLocal      	= $sessionUser->getIdEstablecimiento();

        if ($__REQUEST__type === 'agenda')
        {
            //////////////////////////////////////////////////////////////////////
            $start  = $request->request->get('start');
            $end    = $request->request->get('end');
            $type   = $request->request->get('type_agenda', 'summary');
            $view   = $request->request->get('view', 'month');
            //////////////////////////////////////////////////////////////////////

            //////////////////////////////////////////////////////////////////////
            if ($type === 'summary' && $view === 'month')
            {
                $p = array(
                    'type'          => $type,
                    'view'          => $view,
                    'start'         => $start,
                    'end'           => $end,
                    'locale'        => $estabLocal->getId(),
                    // 'record'        => $numeroExp,
                    // 'modality'      => intval($idAreaServicioDiagnostico),
                    // 'technologist'  => $idTecnologo,
                );

                $results = $em->getRepository('MinsalSimagdBundle:ImgPendienteRealizacion')->getWorkListSummaryAgenda($p, $BS_FILTERS_DECODE);

                foreach ($results as $k => $r)
                {
                    $date_truncated         = \DateTime::createFromFormat('Y-m-d H:i:s', $r['fecha']);
                    $results[$k]['id']      = 'fc_ev_' . $date_truncated->format('Y-m-d');
                    $results[$k]['title']   = $date_truncated->format('Y-m-d');
                    $results[$k]['title_detail']    = '<div style="float: left; width: 68%; padding-top: 5px; padding-botton: 5px;">' .
                                                            '<table class="fc-table-title-detail" style="">' .
                                                                '<tr><th>En espera:</th><td class="col-md-2">' . $r['esp'] . '</td></tr>' .
                                                                '<tr><th>Confirmados:</th><td class="col-md-2">' . $r['cnf'] . '</td></tr>' .
                                                                '<tr><th>Atendidos:</th><td class="col-md-2">' . $r['atn'] . '</td></tr>' .
                                                                '<tr><th>Reprogramados:</th><td class="col-md-2">' . $r['rpg'] . '</td></tr>' .
                                                                '<tr><th>Cancelados:</th><td class="col-md-2">' . $r['cnl'] . '</td></tr>' .
                                                            '</table>' .
                                                        '</div>' .
                                                        '<div style="float: right; margin-left: 5px; margin-right: 10px; text-align: center;">' .
                                                            '<h6>TOTAL<br/><small>' . $r['total'] . '</small></h6>' .
                                                        '</div>';
                    $results[$k]['start']   = $date_truncated->format('Y-m-d\TH:i:s');
                    $results[$k]['end']     = $date_truncated->modify('+23 hours 59 minutes')->format('Y-m-d\TH:i:s');
                }

                return $this->renderJson($results);
            }

            //////////////////////////////////////////////////////////////////////
            if ($type === 'summary' && ($view === 'agendaWeek' || $view === 'agendaDay'))
            {
                $p = array(
                    'type'          => $type,
                    'view'          => $view,
                    'start'         => $start,
                    'end'           => $end,
                    'locale'        => $estabLocal->getId(),
                    // 'record'        => $numeroExp,
                    // 'modality'      => intval($idAreaServicioDiagnostico),
                    // 'technologist'  => $idTecnologo,
                );
                
                $results = $em->getRepository('MinsalSimagdBundle:ImgPendienteRealizacion')->getWorkListEventsAgenda($p, $BS_FILTERS_DECODE);

                return $this->renderJson($results);
            }
        }

        $results = $em->getRepository('MinsalSimagdBundle:ImgPendienteRealizacion')->getWorkList($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowRealizar               = ($this->admin->getRoutes()->has('realizar') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
	               $isUser_allowRegInicial             = ($this->admin->getRoutes()->has('registrarEnMiLista') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;
	       $isUser_allowRegistrarAlmacenado    = ($this->admin->getRoutes()->has('registrarEstudioAlmacenado') &&
                    (($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE') && $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT')) ||
                    $securityContext->isGranted('ROLE_ADMIN'))) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgPendienteRealizacion;

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'unrealized_procedures\', ' . $r['id'] . '); return false;">' .
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
                        '<a class=" unrealizedproceduresworklist-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="unrealizedproceduresworklist-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="unrealizedproceduresworklist_show"><a href="javascript:void(0)" class=" unrealizedproceduresworklist_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="unrealizedproceduresworklist_edit"><a href="javascript:void(0)" class=" unrealizedproceduresworklist_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="unrealizedproceduresworklist_delete"><a href="javascript:void(0)" class=" unrealizedproceduresworklist_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li class="dropdown-header">LISTA DE TRABAJO</li>' .
                            '<li data-item="unrealizedproceduresworklist_save"><a href="javascript:void(0)" class=" unrealizedproceduresworklist_save_action "><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</a></li>' .
                            '<li data-item="unrealizedproceduresworklist_saveandsearchinpacs"><a href="javascript:void(0)" class=" unrealizedproceduresworklist_saveandsearchinpacs_action "><span class="glyphicon glyphicon-link"></span>Guardar y enlazar a PACS</a></li>' .
                            '<li data-item="unrealizedproceduresworklist_goto"><a href="javascript:void(0)" class=" unrealizedproceduresworklist_goto_action "><span class="glyphicon glyphicon-edit"></span>Acceder</a></li>' .
                            '<li class="divider"></li>' .
                            // '<li data-item="unrealizedproceduresworklist_studydownload"><a href="javascript:void(0)" class=" unrealizedproceduresworklist_studydownload_action "><span class="glyphicon glyphicon-eye-open"></span>Recuperar estudio(s)</a></li>' .
                            // '<li class="divider"></li>' .
                            '<li data-item="unrealizedproceduresworklist_create"><a href="javascript:void(0)" class=" unrealizedproceduresworklist_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_registro']    = $formatter->dateFormatter($r['fecha_registro']);
            $results[$key]['fecha_edicion']     = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" unrealizedproceduresworklist-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            // $results[$key]['pndR_fechaIngresoLista']             = $r['pndR_fechaIngresoLista']->format('Y-m-d H:i:s A');

            // $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion'] ? $r['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['prc_fechaProximaConsulta']           = $r['prc_fechaProximaConsulta'] ? $r['prc_fechaProximaConsulta']->format('Y-m-d') : '';

            // $results[$key]['cit_fechaCreacion']              = $r['cit_fechaCreacion'] ? $r['cit_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['cit_fechaConfirmacion']          = $r['cit_fechaConfirmacion'] ? $r['cit_fechaConfirmacion']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['cit_fechaReprogramacion']        = $r['cit_fechaReprogramacion'] ? $r['cit_fechaReprogramacion']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['cit_fechaHoraInicio']                = $r['cit_fechaHoraInicio'] ? $r['cit_fechaHoraInicio']->format('Y-m-d H:i:s A') : '';
            // $results[$key]['cit_fechaHoraFin']                   = $r['cit_fechaHoraFin'] ? $r['cit_fechaHoraFin']->format('Y-m-d H:i:s A') : '';

            // $results[$key]['solcmpl_fechaSolicitud']             = $r['solcmpl_fechaSolicitud'] ? $r['solcmpl_fechaSolicitud']->format('Y-m-d H:i:s A') : '';

            $results[$key]['prz_createUrl'] = $this->generateUrl('simagd_realizado_create', array('__prc' => $r['prc_id'], '__cit' => $r['cit_id'], '__cmpl' => $r['solcmpl_id'], '__pndR' => $r['pndR_id'], /** 'iniciado' => $r['prz_id'] Pueden haber varios, iniciado diferencia cuál se editará */));
            
            $results[$key]['show_url']      = $this->generateUrl('simagd_sin_realizar_show', array('id' => $r['id'], 'mode' => 'standard'));
            $results[$key]['edit_url']      = $this->generateUrl('simagd_sin_realizar_edit', array('id' => $r['id'], 'mode' => 'standard'));
            $results[$key]['delete_url']    = $this->generateUrl('simagd_sin_realizar_delete', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['save_url']      = $this->generateUrl('simagd_sin_realizar_save', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['saveandsearchinpacs_url']   = $this->generateUrl('simagd_sin_realizar_saveandsearchinpacs', array('id' => $r['id'], 'mode' => 'ajax', 'confirmation' => false));
            $results[$key]['goto_url']      = $this->generateUrl('simagd_realizado_create', array('__prc' => $r['prc_id'], '__cit' => $r['cit_id'], '__cmpl' => $r['solcmpl_id'], '__pndR' => $r['pndR_id'],));
            $results[$key]['create_url']    = $this->generateUrl('simagd_sin_realizar_create', array('id' => $r['id'], 'mode' => 'standard'));

            // $results[$key]['allowRealizar']                      = $isUser_allowRealizar;

            // $results[$key]['allowRegInicial']                    = $isUser_allowRegInicial;

            // $results[$key]['allowRegistrarAlmacenado']           = $isUser_allowRegistrarAlmacenado;
        }

        return $this->renderJson($results);
    }

    public function addEmergencyAction(Request $request)
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
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

}