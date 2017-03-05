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
use Minsal\SimagdBundle\Entity\RyxCitaProgramada;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxBloqueoAgendaListViewGenerator;

class RyxBloqueoAgendaAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxBloqueoAgendaListViewGenerator(
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
    
    public function nuevoBloqueoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        $titulo         = $request->request->get('formBlAgdTitulo');
        $descripcion    = $request->request->get('formBlAgdDescripcion');
        $diaCompleto    = $request->request->get('formBlAgdDiaCompleto') ? TRUE : FALSE;
        $fechaInicio    = $request->request->get('formBlAgdFechaInicio');
        $fechaFin       = $request->request->get('formBlAgdFechaFin');
        $horaInicio     = $request->request->get('formBlAgdHoraInicio');
        $horaFin        = $request->request->get('formBlAgdHoraFin');
        $color          = $request->request->get('formBlAgdColor');
        
        $idAreaServicioDiagnostico    = $request->request->get('formBlAgdIdAreaServicioDiagnostico') ? $request->request->get('formBlAgdIdAreaServicioDiagnostico') : null;
        $idRadiologoBloqueo = $request->request->get('formBlAgdIdRadiologoBloqueo') ? $request->request->get('formBlAgdIdRadiologoBloqueo') : null;

        //Nueva instancia
        $nuevoBloqueo   = $this->admin->getNewInstance();
        
        //Cambio de estado de registro
        $em = $this->getDoctrine()->getManager();
        
        $nuevoBloqueo->setTitulo($titulo);
        $nuevoBloqueo->setDescripcion($descripcion);
        $nuevoBloqueo->setDiaCompleto($diaCompleto);
        $nuevoBloqueo->setFechaInicio(\DateTime::createFromFormat('Y-m-d', $fechaInicio));
        $nuevoBloqueo->setFechaFin(\DateTime::createFromFormat('Y-m-d', $fechaFin));
        $nuevoBloqueo->setHoraInicio(\DateTime::createFromFormat('H:i', $horaInicio));
        $nuevoBloqueo->setHoraFin(\DateTime::createFromFormat('H:i', $horaFin));
        $nuevoBloqueo->setColor($color);
        
        //Modalidad en caso de ser enviada
        if ($idAreaServicioDiagnostico) {
            $modalidadReference = $em->getReference('Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico', $idAreaServicioDiagnostico);
            $nuevoBloqueo->setIdAreaServicioDiagnostico($modalidadReference);
        }
        
        //Radiólogo en caso de ser enviado
        if ($idRadiologoBloqueo) {
            $radiologoReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $idRadiologoBloqueo);
            $nuevoBloqueo->setIdRadiologoBloqueo($radiologoReference);
        }
        
        //Crear registro
        try {
            /*$nuevoBloqueo = */$this->admin->create($nuevoBloqueo);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(
                array('id' => $nuevoBloqueo->getId(),
                   // 'description' => $this->crearDescripcionEvento($nuevoBloqueo),
                   // 'url' => $this->admin->generateUrl('show', array('id' => $nuevoBloqueo->getId()))
                )));
        return $response;
    }
    
    public function actualizarBloqueoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        $id             = $request->request->get('formBlAgdId');
	
        $titulo         = $request->request->get('formBlAgdTitulo');
        $descripcion    = $request->request->get('formBlAgdDescripcion');
        $diaCompleto    = $request->request->get('formBlAgdDiaCompleto') ? TRUE : FALSE;
        $fechaInicio    = $request->request->get('formBlAgdFechaInicio');
        $fechaFin       = $request->request->get('formBlAgdFechaFin');
        $horaInicio     = $request->request->get('formBlAgdHoraInicio');
        $horaFin        = $request->request->get('formBlAgdHoraFin');
        $color          = $request->request->get('formBlAgdColor');
        
        $idAreaServicioDiagnostico    = $request->request->get('formBlAgdIdAreaServicioDiagnostico') ? $request->request->get('formBlAgdIdAreaServicioDiagnostico') : null;
        $idRadiologoBloqueo = $request->request->get('formBlAgdIdRadiologoBloqueo') ? $request->request->get('formBlAgdIdRadiologoBloqueo') : null;
        
        //Objeto
        $editBloqueo    = $this->admin->getObject($id);
        
        //Cambio de estado de registro
        $em = $this->getDoctrine()->getManager();
        
        $editBloqueo->setTitulo($titulo);
        $editBloqueo->setDescripcion($descripcion);
        $editBloqueo->setDiaCompleto($diaCompleto);
        $editBloqueo->setFechaInicio(\DateTime::createFromFormat('Y-m-d', $fechaInicio));
        $editBloqueo->setFechaFin(\DateTime::createFromFormat('Y-m-d', $fechaFin));
        $editBloqueo->setHoraInicio(\DateTime::createFromFormat('H:i', $horaInicio));
        $editBloqueo->setHoraFin(\DateTime::createFromFormat('H:i', $horaFin));
        $editBloqueo->setColor($color);
        
        //Modalidad en caso de ser enviada
        if ($idAreaServicioDiagnostico) {
            $modalidadReference = $em->getReference('Minsal\SimagdBundle\Entity\CtlAreaServicioDiagnostico', $idAreaServicioDiagnostico);
            $editBloqueo->setIdAreaServicioDiagnostico($modalidadReference);
        } else {
            $editBloqueo->setIdAreaServicioDiagnostico($idAreaServicioDiagnostico);
        }
        
        //Radiólogo en caso de ser enviado
        if ($idRadiologoBloqueo) {
            $radiologoReference = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $idRadiologoBloqueo);
            $editBloqueo->setIdRadiologoBloqueo($radiologoReference);
        } else {
            $editBloqueo->setIdRadiologoBloqueo($idRadiologoBloqueo);
        }
        
        //Actualizar registro
        try {
            /*$editBloqueo = */$this->admin->update($editBloqueo);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
    }
    
    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $BS_FILTERS             = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE      = json_decode($BS_FILTERS, true);

        $__REQUEST__type    = $this->get('request')->query->get('type', 'list');
        
        $em = $this->getDoctrine()->getManager();
        
        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();
        
        $results = $em->getRepository('MinsalSimagdBundle:RyxBloqueoAgenda')->data($estabLocal->getId(), $BS_FILTERS_DECODE);
        
        $isUser_allowShow       = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit       = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('actualizarBloqueo')) ? TRUE : FALSE;
        $isUser_allowRemove     = ($this->admin->isGranted('DELETE') && $this->admin->getRoutes()->has('removerBloqueo')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\RyxBloqueoAgenda();

            if ($__REQUEST__type === 'detail')
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
                                    '<div class=" " style="margin-top: 20px; margin-bottom: 10px;"><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" > Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div>' .
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
                            '<li data-item="blockeddaysandfestivities_show"><a href="javascript:void(0)" class=" blockeddaysandfestivities_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="blockeddaysandfestivities_edit"><a href="javascript:void(0)" class=" blockeddaysandfestivities_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="blockeddaysandfestivities_delete"><a href="javascript:void(0)" class=" blockeddaysandfestivities_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="blockeddaysandfestivities_create"><a href="javascript:void(0)" class=" blockeddaysandfestivities_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_inicio']      = $formatter->dateFormatter($r['fecha_inicio'], 'date');
            $results[$key]['fecha_fin']         = $formatter->dateFormatter($r['fecha_fin'], 'date');
            $results[$key]['hora_inicio']       = $formatter->dateFormatter($r['hora_inicio'], 'time');
            $results[$key]['hora_fin']          = $formatter->dateFormatter($r['hora_fin'], 'time');
            $results[$key]['fecha_registro']    = $formatter->dateFormatter($r['fecha_registro']);
            $results[$key]['fecha_edicion']     = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion']) : null;
            $results[$key]['color']             = $r['color'] ? $formatter->colorFormatter($r['color']) : null;

            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" unrealizedproceduresworklist-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            $results[$key][$key]['blAgd_fechaCreacion']        = $r['blAgd_fechaCreacion']->format('Y-m-d H:i:s A');
            $results[$key]['blAgd_fechaUltimaEdicion']   = $r['blAgd_fechaUltimaEdicion'] ? $r['blAgd_fechaUltimaEdicion']->format('Y-m-d H:i:s A') : '';

            $results[$key]['blAgd_fechaInicio']	= $r['blAgd_fechaInicio']->format('Y-m-d');
            $results[$key]['blAgd_fechaFin']		= $r['blAgd_fechaFin']->format('Y-m-d');
            $results[$key]['blAgd_horaInicio']	= $r['blAgd_horaInicio']->format('H:i:s A');
            $results[$key]['blAgd_horaFin']      	= $r['blAgd_horaFin']->format('H:i:s A');
            
            $results[$key]['allowShow']	= $isUser_allowShow;
            
            $results[$key]['allowEdit']	= $isUser_allowEdit;
            
            $results[$key]['allowRemove']	= $isUser_allowRemove;
            
            $results[$key]['blAgd_bloqueoExclusionesBloqueo']	= $em->getRepository('MinsalSimagdBundle:RyxBloqueoAgenda')->obtenerExclusionesBloqueo($r['blAgd_id']);
        }
        
        return $this->renderJson($results);
    }
    
    public function removerBloqueoAction(Request $request)
    {
        $request->isXmlHttpRequest();
	
        $id = $request->request->get('id');
        
        //Objeto
        $removeBloqueo  = $this->admin->getObject($id);
        
        //Actualizar registro
        try {
            $this->admin->delete($removeBloqueo);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        return $this->renderJson(array());
    }

    public function excluirRadiologoBloqueoAction(Request $request)
    {
        $request->isXmlHttpRequest();
        
        $status = 'OK';
        
        $id                 = $request->request->get('formBlAgdExclRadxIdBloqueoAgenda');
        $object_blAgd       = $this->admin->getObject($id);     // get object
        $request_radiologos = $request->request->get('formBlAgdExclRadxIdRadiologoExcluido');	// array []
        
        $securityContext    = $this->container->get('security.context');
        $sessionUser        = $securityContext->getToken()->getUser();
        $estabLocal         = $sessionUser->getIdEstablecimiento();

        $em = $this->getDoctrine()->getManager();
        
//         $object_blAgd       = new \Minsal\SimagdBundle\Entity\RyxBloqueoAgenda();
        
        /*
         * Radiólogos excluidos
         */
        $arr_radxExcluded   = array();
        foreach ($object_blAgd->getBloqueoExclusionesBloqueo() as $collection_radiologo)  {
            $arr_radxExcluded[] = $collection_radiologo->getIdRadiologoExcluido()->getId();
            if (!in_array($collection_radiologo->getIdRadiologoExcluido()->getId(), $request_radiologos)) {
                $object_blAgd->removeBloqueoExclusionesBloqueo($collection_radiologo);    // --| remove from collection if is not in request
            }
        }
        foreach ($request_radiologos as $request_radiologo)  {
            if (!in_array($request_radiologo, $arr_radxExcluded)) {
		$new_exclBlAgd	= new \Minsal\SimagdBundle\Entity\RyxExclusionBloqueo();
		$new_exclBlAgd->setIdBloqueoAgenda($object_blAgd);
                $ref_excludedRadx = $em->getReference('Minsal\SiapsBundle\Entity\MntEmpleado', $request_radiologo);
		$new_exclBlAgd->setIdRadiologoExcluido($ref_excludedRadx);
                $object_blAgd->addBloqueoExclusionesBloqueo($new_exclBlAgd);              // --| add to collection if is not in, but is in request
            }
        }
        
        //Actualizar registro
        try {
            /*$object_blAgd = */$this->admin->update($object_blAgd);
        } catch (Exception $e) {
            $status = 'failed';
        }
        
        $response = new Response();
        $response->setContent(json_encode(
                array(
                    'id' => $object_blAgd->getId(),
                    'status' => $status,
                )));
        return $response;
    }


//    http://www.ubuntu-es.org/node/156275#.VXHDGM2UcW0
//    http://stackoverflow.com/questions/5575935/how-to-load-different-event-source-json-for-each-view
//    http://forums.asp.net/t/1717483.aspx?FullCalendar+prevent+Drag+Resize+on+Condition
//    http://fullcalendar.io/js/fullcalendar-2.3.2/demos/basic-views.html
//    https://www.google.com.sv/search?q=fullcalendar+event+all+days&oq=fullcalendar+event+all+days&aqs=chrome..69i57.16959j0j1&sourceid=chrome&es_sm=122&ie=UTF-8#q=full+calendar+event+every+monday
//    http://iamceege.github.io/tooltipster/

}
