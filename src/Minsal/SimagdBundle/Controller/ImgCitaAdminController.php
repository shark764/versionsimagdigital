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
use DateInterval;

use Minsal\SimagdBundle\Funciones\ImagenologiaDigitalFunciones;

use Minsal\SimagdBundle\Generator\AgendaGenerator\AgendaGenerator;
use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxRyxCitaProgramadaListViewGenerator;

class ImgCitaAdminController extends Controller
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxRyxCitaProgramadaListViewGenerator(
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

    public function createDateRangeArray($from, $to)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        $range = array();

        $i_from = mktime(1, 0, 0, substr($from, 5, 2), substr($from, 8, 2), substr($from, 0, 4));
        $i_to   = mktime(1, 0, 0, substr($to, 5, 2), substr($to, 8, 2), substr($to, 0, 4));

        if ($i_to >= $i_from) {
            array_push($range, date('Y-m-d', $i_from)); // first entry

            while ($i_from < $i_to) {
                $i_from += 86400; // add 24 hours
                array_push($range, date('Y-m-d', $i_from));
            }
        }
        return $range;
    }

    public function generateCalendarAction(Request $request)
    {
        $AGENDA_GENERATOR_ = new AgendaGenerator(
            $this->container,
            $this->admin->getRouteGenerator(),
            $this->admin->getClass()
        );
        $options = $AGENDA_GENERATOR_->getOptions();

        return $this->renderJson(array(
            'result'    => 'ok',
            'options'   => $options,
        ));
    }

    public function getEventsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

    	$securityContext    = $this->container->get('security.context');
    	$sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $idAreaServicioDiagnostico  = $request->request->get('idAreaServicioDiagnostico') ? $request->request->get('idAreaServicioDiagnostico') : 0;
        $idTecnologo    = $request->request->get('idTecnologo') ? $request->request->get('idTecnologo') : 0;
        $numeroExp      = $request->request->get('numeroExp');
        $start          = $request->request->get('start');
        $end            = $request->request->get('end');

        //////////////////////////////////////////////////////////////////////
        $view           = $request->request->get('view');
        $type           = $request->request->get('type');
        //////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////
        if ($type === 'summary' && $view === 'month')
        {
            //////////////////////////////////////////////////////////////////////
            //////// range
            //////////////////////////////////////////////////////////////////////
            // $range = array();
            // $range = $this->createDateRangeArray($start, $end);

            $p = array(
                'type'          => $type,
                'view'          => $view,
                'start'         => $start,
                'end'           => $end,
                'locale'        => $estabLocal->getId(),
                'record'        => $numeroExp,
                'modality'      => intval($idAreaServicioDiagnostico),
                'technologist'  => $idTecnologo,
            );

            $results = $em->getRepository('MinsalSimagdBundle:ImgCita')->events($p);

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

        $results = $em->getRepository('MinsalSimagdBundle:ImgCita')
                                        ->pendingEvents($estabLocal, $start, $end, $idAreaServicioDiagnostico, $idTecnologo, $numeroExp);

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCita();

            $results[$key]['tooltip_title']  = ($r['explocal_numero'] ? '<span class="label label-primary-v4" style="margin-left: 5px; padding: .4em .6em;"><span class="badge badge-primary-v4">' . $r['explocal_numero'] . '</span></span> &nbsp;' : '') . $r['title'];

            $results[$key]['start']  = $r['cit_fechaHoraInicio']->format('Y-m-d\TH:i:s');
            $results[$key]['end']    = $r['cit_fechaHoraFin']->format('Y-m-d\TH:i:s');

            $results[$key]['cit_fechaCreacion']          = $r['cit_fechaCreacion']->format('Y-m-d H:i:s A');
            $results[$key]['cit_fechaHoraInicio']            = $r['cit_fechaHoraInicio']->format('Y-m-d H:i:s A');
            $results[$key]['cit_fechaHoraFin']               = $r['cit_fechaHoraFin']->format('Y-m-d H:i:s A');
            $results[$key]['cit_fechaHoraInicioAnterior']    = $r['cit_fechaHoraInicioAnterior'] ? $r['cit_fechaHoraInicioAnterior']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaHoraFinAnterior']       = $r['cit_fechaHoraFinAnterior'] ? $r['cit_fechaHoraFinAnterior']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaConfirmacion']      = $r['cit_fechaConfirmacion'] ? $r['cit_fechaConfirmacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaReprogramacion']    = $r['cit_fechaReprogramacion'] ? $r['cit_fechaReprogramacion']->format('Y-m-d H:i:s A') : '';

            $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion'] ? $r['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['prc_fechaProximaConsulta']           = $r['prc_fechaProximaConsulta'] ? $r['prc_fechaProximaConsulta']->format('Y-m-d') : '';

            $results[$key]['prc_solicitudEstudioProyeccion']  = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerProyeccionesSolicitudEstudio($r['prc_id']);

            $results[$key]['url']    = $this->admin->generateUrl('show', array('id' => $r['cit_id']));
        }

        /* Creación de evento falso */
        $falseEvent['id']                       = 'false_event_id';
        $falseEvent['title']                    = 'false_event_title';
        $falseEvent['start']                    = (new \DateTime('now'))->format('Y-m-d\TH:i:s');
        $falseEvent['end']                      = (new \DateTime('now'))->format('Y-m-d\TH:i:s');
        $falseEvent['url']                      = $this->admin->generateUrl('show', array('id' => 0));
        $falseEvent['allDay']                   = false;
        $falseEvent['color']                    = '#183f52';
        $falseEvent['idTecnologoProgramado']    = NULL;
        $falseEvent['idEstadoCita']             = 1;
        $falseEvent['razonAnulada']             = NULL;
        $falseEvent['incidencias']          = NULL;
        $falseEvent['observaciones']        = NULL;
        $falseEvent['description']              = NULL;
        $falseEvent['prxConsulta']              = (new \DateTime('now'))->format('Y-m-d');
        $falseEvent['range']  = $this->createDateRangeArray($start, $end);
        $results[]                           = $falseEvent;

        /* Agregar bloqueos */
        $results     = $this->addCalendarLocks($estabLocal, $start, $end, $results, $idAreaServicioDiagnostico, $idTecnologo);
        // $this->addCalendarLocks($estabLocal, $start, $end, $results, $idAreaServicioDiagnostico, $idTecnologo);

        return $this->renderJson($results);
    }

    public function addCalendarLocks($idEstablecimiento, $start, $end, $results = array(), $idAreaServicioDiagnostico = null, $idTecnologo = null)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('MinsalSimagdBundle:ImgBloqueoAgenda')
                                ->getCalendarLocks($idEstablecimiento, $start, $end, $idAreaServicioDiagnostico, $idTecnologo);
        // var_dump($events);

        foreach ($events as $key => $r)
        {
            // $events[$key]['overlap']                    = false;

            $events[$key]['blAgd_fechaCreacion']        = $r['blAgd_fechaCreacion']->format('Y-m-d H:i:s A');
            $events[$key]['blAgd_fechaUltimaEdicion']   = $r['blAgd_fechaUltimaEdicion'] ? $r['blAgd_fechaUltimaEdicion']->format('Y-m-d H:i:s A') : '';

            $events[$key]['blAgd_fechaInicio']          = $r['blAgd_fechaInicio']->format('Y-m-d');
            $events[$key]['blAgd_fechaFin']             = $r['blAgd_fechaFin']->format('Y-m-d');
            $events[$key]['blAgd_horaInicio']           = $r['blAgd_horaInicio']->format('H:i:s A');
            $events[$key]['blAgd_horaFin']              = $r['blAgd_horaFin']->format('H:i:s A');

            $events[$key]['blAgd_bloqueoExclusionesBloqueo']	= $em->getRepository('MinsalSimagdBundle:ImgBloqueoAgenda')->obtenerExclusionesBloqueo($r['blAgd_id']);

            $iv     = $r['blAgd_fechaInicio']->diff($r['blAgd_fechaFin'])->days;
            $i      = 0;

            while ($i <= $iv)
            {
                $cloneIni = clone $r['blAgd_fechaInicio'];

                $ini                        = \DateTime::createFromFormat('Y-m-d H:i',
                                                    $cloneIni->add(new DateInterval('P' . $i . 'D'))->format('Y-m-d') . ' ' . $r['blAgd_horaInicio']->format('H:i'));
                $events[$key]['start']  = $ini->format('Y-m-d\TH:i:s');

                $fin                        = \DateTime::createFromFormat('Y-m-d H:i',
                                                    $cloneIni->format('Y-m-d') . ' ' . $r['blAgd_horaFin']->format('H:i'));
                $events[$key]['end']    = $fin->format('Y-m-d\TH:i:s');
                $results[]                  = $events[$key];

                $i++;
            }

        }

        $falseEvent['id']           = 'bl_false_event_id';
        $falseEvent['title']        = 'bl_false_event_title';
        $falseEvent['allDay']       = false;
        $falseEvent['color']        = 'yellow';
        $falseEvent['description']  = NULL;
        $falseEvent['overlap']      = false;
        $falseEvent['rendering']    = 'background';
        $falseEvent['start']        = (new \DateTime('now'))->format('Y-m-d\TH:i:s');
        $falseEvent['end']          = (new \DateTime('now'))->format('Y-m-d\TH:i:s');
        $results[]                  = $falseEvent;

        return $results;
    }


    /**
     *
     * @return type
     */
    public function espaciosReservadosAction()
    {
        $idEstablecimiento = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();

        $idSolicitudEstudioPadre = $this->get('request')->query->get('idSolicitudEstudioPadre');
        $idParamCitacion = $this->get('request')->query->get('idParamCitacion');

	    /*
         * obtener los espacios reservados agrupados por fecha y hora
         */
        $em = $this->getDoctrine()->getManager();

        $preinscripcionPadre = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->find($idSolicitudEstudioPadre);

        $paramCitacion = $em->getRepository('MinsalSimagdBundle:ImgCtlConfiguracionAgenda')->find($idParamCitacion);

        $reservas = $em->getRepository('MinsalSimagdBundle:ImgCita')
                ->obtenerReservados($idEstablecimiento,
                                    $preinscripcionPadre ? $preinscripcionPadre->getIdAreaServicioDiagnostico()->getId() : '-1',
                                    $preinscripcionPadre ? $preinscripcionPadre->getFechaProximaConsulta() : null);

        return $this->render('MinsalSimagdBundle:ImgCitaAdmin:cit_espacios_reservados.html.twig', array('reservasCita' => $reservas, 'paramCitacion' => $paramCitacion));
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

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
    }

    public function confirmarCitaAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        // $title = $request->request->get('title');
        $id     = $request->request->get('id');
        $cita = $this->admin->getObject($id);

        //Cambio de estado de cita
        $em = $this->getDoctrine()->getManager();
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoCita', '2');
        $cita->setIdEstadoCita($estadoReference);
        //Fecha de confirmación
        $cita->setFechaConfirmacion(new \DateTime('now'));

        //Borrar razón de cancelación si existe
        $cita->setRazonAnulada('');

        //Actualizar registro
        try {
            /*$cita = */$this->admin->update($cita);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function cancelarCitaAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        // $title = $request->request->get('title');
        $id     = $request->request->get('formCancelCitId');
        $cita = $this->admin->getObject($id);

        $em     = $this->getDoctrine()->getManager();
        // if ($em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')
        //                    ->existeRegistroPorPreinscripcion($cita->getIdSolicitudEstudio()->getId(), 'prz', 'ImgProcedimientoRealizado')) {
        //    $this->addFlash('sonata_flash_error', 'El procedimiento preinscrito ya fué realizado al paciente');
        //    return new RedirectResponse($this->admin->generateUrl('list'));
        // }

        $IdEstadoCita       = $request->request->get('formCancelCitIdEstadoCita');
        $razonAnuladaCita   = $request->request->get('formCancelCitRazonAnulada');
        $incidencias        = $request->request->get('formCancelCitIncidencias');
        $observaciones      = $request->request->get('formCancelCitObservaciones');

        //Cambio de estado de cita
        $estadoReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoCita', $IdEstadoCita);
        $cita->setIdEstadoCita($estadoReference);

        //Razón de cancelación
        $cita->setRazonAnulada($razonAnuladaCita);
        $cita->setIncidencias($incidencias);
        $cita->setObservaciones($observaciones);

        //Actualizar registro
        try {
            /*$cita = */$this->admin->update($cita);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        $em = $this->getDoctrine()->getManager();

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCita', 'cit')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        // No puede acceder al registro
        $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgCita')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
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

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCita', 'cit')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        // No puede acceder al registro
        $sessionUser = $this->container->get('security.context')->getToken()->getUser();
        if (false === $em->getRepository('MinsalSimagdBundle:ImgCita')->obtenerAccesoEstab($id, $sessionUser->getIdEstablecimiento()->getId())) {
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

        // $default_areaAtn        = 2;
        // $default_atn            = 1;
        // $sessionSpecialty       = $this->container->get('session')->get('_idEmpEspecialidadEstab');
        // if ($sessionSpecialty)
        // {
        //     //Valores para area, atencion y empleado desde session
        //     $specialtyObject    = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($sessionSpecialty);
        //     if ($specialtyObject)
        //     {
        //         $default_areaAtn    = $specialtyObject->getIdAreaModEstab()->getIdAreaAtencion()->getId();
        //         $default_atn        = $specialtyObject->getIdAtencion()->getId();

        //     }
        // }

        $tiposEmpleado          = $em->getRepository('MinsalSiapsBundle:MntTipoEmpleado')->findAll();

        // $medicos                = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
        //                                 ->obtenerEmpleadosPorTipoOperaciones($estabLocal->getId(), array(1, 2, 4))
        //                                         ->getQuery()->getResult();

        $radiologos             = $em->getRepository('MinsalSiapsBundle:MntEmpleado')
                                        ->obtenerEmpleadosRayosXCargoV2($estabLocal->getId(), array(4, 5))
                                                ->getQuery()->getResult();

        // $tiposEstab             = $em->getRepository('MinsalSiapsBundle:CtlTipoEstablecimiento')->findAll();

        // $establecimientos       = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')
        //                                 ->obtenerEstabParaRefDiag('idEstablecimientoDiagnosticante')
        //                                         ->getQuery()->getResult();

        // $estados                = $em->getRepository('MinsalSimagdBundle:ImgCtlEstadoCita')->findAll();

        // $prioridades            = $em->getRepository('MinsalSimagdBundle:ImgCtlPrioridadAtencion')->obtenerPrioridadesAtencionV2();

        $modalidades            = $em->getRepository('MinsalSiapsBundle:CtlAreaServicioDiagnostico')->obtenerModalidadesRealizablesLocalV2($estabLocal->getId(), '97');
        // $examenes               = $em->getRepository('MinsalSiapsBundle:CtlExamenServicioDiagnostico')->obtenerExamenesRealizablesLocal($estabLocal->getId(), '97');
        // $proyecciones           = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->findAll();
        // $sexos                  = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findAll();

        // $areasAtencion          = $em->getRepository('MinsalSiapsBundle:CtlAreaAtencion')->findAll();

        // $tiposAtencion          = $em->getRepository('MinsalSiapsBundle:CtlTipoAtencion')->findAll();
        // $atenciones             = $em->getRepository('MinsalSiapsBundle:CtlAtencion')->findAll();

        /*
         * GROUP_DEPENDENT_ENTITIES
         */
        // $GROUP_DEPENDENT_ENTITIES   = array();
        // try {
        //     $GROUP_DEPENDENT_ENTITIES['m_expl']   = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->getRadiologicalProceduresGrouped($estabLocal->getId());
        // } catch (Exception $e) {
        //     $status = 'failed';
        // }
        // try {
        //     $GROUP_DEPENDENT_ENTITIES['ar_atn']   = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->obtenerAtencionesAgrupadasV2($estabLocal->getId());
        // } catch (Exception $e) {
        //     $status = 'failed';
        // }
        // try {
        //     $GROUP_DEPENDENT_ENTITIES['atn_emp']  = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->obtenerEmpleadosAgrupadosV2($estabLocal->getId());
        // } catch (Exception $e) {
        //     $status = 'failed';
        // }
        $AGENDA_GENERATOR_ = new AgendaGenerator(
            $this->container,
            $this->admin->getRouteGenerator(),
            $this->admin->getClass()
        );
        $options = $AGENDA_GENERATOR_->getOptions();

        // return $this->renderJson(array(
        //     'result'    => 'ok',
        //     'options'   => $options,
        // ));

        return $this->render($this->admin->getTemplate('list'),
                array('tiposEmpleado'           => $tiposEmpleado,
                        // 'medicos'               => $medicos,
                        // 'tiposEstab'            => $tiposEstab,
                        // 'establecimientos'      => $establecimientos,
            			'radiologos'            => $radiologos,
            			// 'default_empLogged'     => $sessionUser->getIdEmpleado(),
               //          'estados'               => $estados,
               //          'default_statusCit'     => 1,
               //          'default_statusCancelCit'   => 6,
               //          'defaultEstab'          => $estabLocal,
               //          'prioridades'           => $prioridades,
                        'modalidades'           => $modalidades,
               //          'sexos'                 => $sexos,
               //          'examenes'              => $examenes,
               //          'areasAtencion'         => $areasAtencion,
               //          'tiposAtencion'         => $tiposAtencion,
               //          'atenciones'            => $atenciones,
               //          'proyecciones'          => $proyecciones,
               //          'default_exmRx'         => 27,
               //          'default_mldRx'         => 13,
               //          'default_areaAtn'       => $default_areaAtn,
               //          'default_atn'           => $default_atn,
               //          'default_prAtn'         => 3,
               //          'GROUP_DEPENDENT_ENTITIES'  => $GROUP_DEPENDENT_ENTITIES,
                        'FC_OPTIONS'   => $options,
                    ));
    }

    public function nuevaCitaAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status                     = 'OK';

        $idTecnologoProgramado      = $request->request->get('idTecnologoProgramado') ? $request->request->get('idTecnologoProgramado') : null;
        $solicitud                  = $request->request->get('solicitud');
        $start                      = $request->request->get('start');
        $end                        = $request->request->get('end');
        $color                      = $request->request->get('color');

        //Nueva instancia
        $cita                       = $this->admin->getNewInstance();

        //Cambio de estado de registro
        $em                         = $this->getDoctrine()->getManager();

        //solicitud
        $preinscripcionReference    = $em->getReference('Minsal\SimagdBundle\Entity\ImgSolicitudEstudio', $solicitud);
        $cita->setIdSolicitudEstudio($preinscripcionReference);

        // $cita->setIdSolicitudEstudio($em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->find($solicitud));
        $cita->setFechaHoraInicio(\DateTime::createFromFormat('Y-m-d H:i', $start));
        $cita->setFechaHoraFin(\DateTime::createFromFormat('Y-m-d H:i', $end));
        // $cita->setIdParametroCitacion($em->getRepository('MinsalSimagdBundle:ImgCtlConfiguracionAgenda')->find(9));
        $cita->setColor($color);

        //Asignación de tecnólogo en caso de ser enviado
        if ($idTecnologoProgramado) {
	    $tecnologoReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $idTecnologoProgramado);
	    $cita->setIdTecnologoProgramado($tecnologoReference);
        }

        //Crear registro
        try {
            /*$cita = */$this->admin->create($cita);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $userPrg    = $cita->getIdUserPrg();

        $response = new Response();
        $response->setContent(
	    json_encode($status == 'OK' ?
		array(
		    'create' => $status,
		    'cit_id' => $cita->getId(),
		    // 'cit_codEstado' => $cita->getIdEstadoCita()->getCodigo(),
		    // 'cit_empleado' => $cita->getIdEmpleado()->getApellido() . ', ' . $cita->getIdEmpleado()->getNombre(),
		    // 'cit_estado' => $cita->getIdEstadoCita()->getNombreEstado(),
		    // 'cit_fechaCreacion' => $cita->getFechaCreacion()->format('Y-m-d H:i:s A'),
		    // 'cit_id_estado' => $cita->getIdEstadoCita()->getId(),
		    // 'cit_id_tecnologo' => $cita->getIdTecnologoProgramado() ? $cita->getIdTecnologoProgramado()->getId() : NULL,
		    // 'cit_id_userReg' => $userPrg->getId(),
		    // 'cit_nombreUserReg' => $userPrg->getIdEmpleado()->getApellido() . ', ' . $userPrg->getIdEmpleado()->getNombre(),
		    // 'cit_tecnologo' => $cita->getIdTecnologoProgramado() ?
			   //  $cita->getIdTecnologoProgramado()->getApellido() . ', ' . $cita->getIdTecnologoProgramado()->getNombre() : NULL,
		    // 'cit_tipoEmpleado' => $cita->getIdEmpleado()->getIdTipoEmpleado()->getTipo(),
		    // 'cit_usernameUserReg' => $userPrg->getUsername(),
		    // 'url' => $this->admin->generateUrl('show', array('id' => $cita->getId())),
		) : array('create' => $status)
	    ));
        return $response;
    }

    public function actualizarCitaAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        // $title = $request->request->get('title');
        $id         = $request->request->get('id');

        //Objeto
        $cita       = $this->admin->getObject($id);

        $start      = $request->request->get('start');
        $end        = $request->request->get('end');

        $cita->setFechaHoraInicio(\DateTime::createFromFormat('Y-m-d H:i', $start));
        $cita->setFechaHoraFin(\DateTime::createFromFormat('Y-m-d H:i', $end));

        //Actualizar registro
        try {
            /*$cita = */$this->admin->update($cita);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $userRePrg  = $cita->getIdUserReprg();

        $response = new Response();
        $response->setContent(
	    json_encode($status == 'OK' ?
    		array(
    		    'update'                        => $status,
    		    'cit_fechaReprogramacion'   => $cita->getFechaReprogramacion()->format('Y-m-d H:i:s A'),
    		    'cit_id_userMod'                => $userRePrg->getId(),
    		    'cit_nombreUserMod'             => $userRePrg->getIdEmpleado()->getApellido() . ', ' . $userRePrg->getIdEmpleado()->getNombre(),
    		    'cit_usernameUserMod'           => $userRePrg->getUsername(),
    		) : array('update' => $status)
	    ));
        return $response;
    }

    public function editarCitaAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $status = 'OK';

        $id     = $request->request->get('formCitId');

        //Objeto
        $cita = $this->admin->getObject($id);

        $idTecnologoProgramado  = $request->request->get('formCitIdTecnologoProgramado') ? $request->request->get('formCitIdTecnologoProgramado') : null;
        $diaCompleto            = $request->request->get('formCitDiaCompleto') ? TRUE : FALSE;
        $idEstado               = $request->request->get('formCitIdEstadoCita');
        $razonAnulada           = $request->request->get('formCitRazonAnulada');
        $color                  = $request->request->get('formCitColor');
        $incidencias            = $request->request->get('formCitIncidencias');
        $observaciones          = $request->request->get('formCitObservaciones');

        $fechaHoraInicio        = $request->request->get('formCitFechaHoraInicio');
        $fechaHoraFin           = $request->request->get('formCitFechaHoraFin');

        $cita->setDiaCompleto($diaCompleto);
        $cita->setRazonAnulada($razonAnulada);
        $cita->setColor($color);
        $cita->setIncidencias($incidencias);
        $cita->setObservaciones($observaciones);

        $em = $this->getDoctrine()->getManager();

        //Cambio de estado de cita
        $estadoReference        = $em->getReference('Minsal\SimagdBundle\Entity\ImgCtlEstadoCita', $idEstado);
        $cita->setIdEstadoCita($estadoReference);
        //Asignación de tecnólogo en caso de ser enviado
        if ($idTecnologoProgramado) {
	    $tecnologoReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $idTecnologoProgramado);
	    $cita->setIdTecnologoProgramado($tecnologoReference);
        } else {
            $cita->setIdTecnologoProgramado(null);
        }

        $cita->setFechaHoraInicio(\DateTime::createFromFormat('Y-m-d H:i A', $fechaHoraInicio));
        $cita->setFechaHoraFin(\DateTime::createFromFormat('Y-m-d H:i A', $fechaHoraFin));

        //Actualizar registro
        try {
            /*$cita = */$this->admin->update($cita);
        } catch (Exception $e) {
            $status = 'failed';
        }

        $response = new Response();
        $response->setContent(json_encode(array()));
        return $response;
    }

    public function loadPendingPatientsAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS             = $this->get('request')->query->get('filters');
        if (!$BS_FILTERS)
        {
            $BS_FILTERS         = $this->get('request')->request->get('filters');
        }
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);

        $__REQUEST__type    = $this->get('request')->query->get('type', 'list');
        $__REQUEST__emrg    = $this->get('request')->query->get('emrg', 0);
        $__REQUEST__foreign = $this->get('request')->query->get('foreign', 0);
        $__REQUEST__record  = $this->get('request')->query->get('record', NULL);

        $em = $this->getDoctrine()->getManager();

        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->getPendingPatients($estabLocal->getId(), $BS_FILTERS_DECODE);

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgSolicitudEstudio();

            $results[$key]['tooltip_title']  = ($r['explocal_numero'] ? '<span class="label label-primary-v4" style="margin-left: 5px; padding: .4em .6em .3em;"><span class="badge badge-primary-v4">' . $r['explocal_numero'] . '</span></span> &nbsp;' : '') . $r['prc_paciente'];

            $results[$key]['prc_editUrl']                        = $this->generateUrl('simagd_solicitud_estudio_edit', array('id' => $r['prc_id']));
            $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion']->format('Y-m-d H:i:s A');
            $results[$key]['prc_fechaProximaConsulta']           = $r['prc_fechaProximaConsulta']->format('Y-m-d');

            $results[$key]['color']                              = $r['prc_id_areaAtencion'] == 2 ? '#e0533d' : ($r['prc_id_areaAtencion'] == 3 ? '#16677d' : '#183f52');

            $results[$key]['prc_solicitudEstudioProyeccion']      = $em->getRepository('MinsalSimagdBundle:ImgCtlProyeccion')->obtenerProyeccionesSolicitudEstudio($r['prc_id']);
        }

        return $this->renderJson($results);
    }

    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS             = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);

        $__REQUEST__type    = $this->get('request')->query->get('type', 'list');
        $__REQUEST__emrg    = $this->get('request')->query->get('emrg', 0);
        $__REQUEST__foreign = $this->get('request')->query->get('foreign', 0);

        $em = $this->getDoctrine()->getManager();

    	$securityContext	= $this->container->get('security.context');
    	$sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:ImgCita')->data($estabLocal->getId(), $BS_FILTERS_DECODE);

        $isUser_allowShow 	= ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit 	= ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('editarCita')) ? TRUE : FALSE;
        $isUser_allowConfirm 	= ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('confirmarCita')) ? TRUE : FALSE;
        $isUser_allowCancel 	= ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('cancelarCita')) ? TRUE : FALSE;
    	$isUser_allowIndRadx	= ($securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') || $securityContext->isGranted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE') || $securityContext->isGranted('ROLE_ADMIN')) ? TRUE : FALSE;

        $slug = 'study_request';
        if ($__REQUEST__emrg === 1) {
            $slug = 'emergency_study_request';
        }

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCita();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        // '<div class="box-body">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'' . $slug . '\', ' . $r['id'] . '); return false;">' .
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
                                '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PROGRESO:</strong></div><div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' . $r['estado'] . '</div></div>' .
                                // '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' . $r['progreso'] . '</div></div>' .
                                '<p></p><div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"> <div class="progress"> <div class="progress-bar progress-bar-striped active progress-bar-danger" role="progressbar" aria-valuenow="' . $r['progreso'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $r['progreso'] . '%;"> ' . $r['progreso'] . '% Completado </div> </div> </div></div>' .
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

            $results[$key]['cit_fechaCreacion']              = $r['cit_fechaCreacion']->format('Y-m-d H:i:s A');
            $results[$key]['cit_fechaHoraInicio']                = $r['cit_fechaHoraInicio']->format('Y-m-d H:i:s A');
            $results[$key]['cit_fechaHoraFin']                   = $r['cit_fechaHoraFin']->format('Y-m-d H:i:s A');
            $results[$key]['cit_fechaHoraInicioAnterior']        = $r['cit_fechaHoraInicioAnterior'] ? $r['cit_fechaHoraInicioAnterior']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaHoraFinAnterior']           = $r['cit_fechaHoraFinAnterior'] ? $r['cit_fechaHoraFinAnterior']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaConfirmacion']          = $r['cit_fechaConfirmacion'] ? $r['cit_fechaConfirmacion']->format('Y-m-d H:i:s A') : '';
            $results[$key]['cit_fechaReprogramacion']        = $r['cit_fechaReprogramacion'] ? $r['cit_fechaReprogramacion']->format('Y-m-d H:i:s A') : '';

            $results[$key]['prc_fechaProximaConsulta']           = $r['prc_fechaProximaConsulta'] ? $r['prc_fechaProximaConsulta']->format('Y-m-d') : '';
            $results[$key]['prc_fechaCreacion']    = $r['prc_fechaCreacion'] ? $r['prc_fechaCreacion']->format('Y-m-d H:i:s A') : '';

            $results[$key]['allowShow'] 	= $isUser_allowShow; /** Permiso compartido */

            $results[$key]['allowEdit'] 	= $isUser_allowEdit; /** Permiso compartido */

            $results[$key]['allowConfirm'] 	= (false !== $isUser_allowConfirm &&
		    !in_array($r['cit_codEstado'], array('CNF'))) ? TRUE : FALSE;

            $results[$key]['allowCancel'] 	= (false !== $isUser_allowCancel &&
		    !in_array($r['cit_codEstado'], array('CNL', 'ANL'))) ? TRUE : FALSE;

            $results[$key]['allowIndRadx'] 	= $isUser_allowIndRadx;
        }

        return $this->renderJson($results);
    }

    public function printAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $em = $this->getDoctrine()->getManager();

        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        //Get parameter from object
        $id                 = $this->get('request')->query->get('id');

        //Objeto
        $object = $this->admin->getObject($id);

        $solicitud          = $object->getIdSolicitudEstudio();

        //Expediente local e información del paciente
        $expediente         = $em->getRepository('MinsalSiapsBundle:MntExpediente')
                                    ->findOneBy(
                                            array('idEstablecimiento' => $estabLocal->getId(),
                                                    'idPaciente' => $solicitud->getIdExpediente()->getIdPaciente()->getId()
                                        ));

        $indicaciones       = $em->getRepository('MinsalSimagdBundle:ImgCtlPreparacionEstudio')->findBy(array(
                                                            'idAreaServicioDiagnosticoAplica' => $solicitud->getIdAreaServicioDiagnostico()->getId()
                                                        ));

        return $this->render($this->admin->getTemplate('print'), array(
            'action'        => 'print',
            'object'        => $object,
            'expediente'    => $expediente,
            'indicaciones'  => $indicaciones,
        ));
    }

}