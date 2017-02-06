<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxCtlConexionPacsEstablecimientoListViewGenerator;

class ImgCtlPacsEstablecimientoAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new RyxCtlConexionPacsEstablecimientoListViewGenerator(
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

    public function editAction($id = null)
    {
        // Acceso denegado
        if (false === $this->admin->isGranted('EDIT')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_accesoDenegado'));
        }

        /** request object id */
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $em = $this->getDoctrine()->getManager();

        // No existe el registro
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlPacsEstablecimiento', 'pacs')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
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
        if (false === $em->getRepository('MinsalSimagdBundle:ImgSolicitudEstudio')->existeRegistroPorId($id, 'ImgCtlPacsEstablecimiento', 'pacs')) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        return parent::showAction($id);
    }

    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em = $this->getDoctrine()->getManager();

        $securityContext 	= $this->container->get('security.context');
        $sessionUser 		= $securityContext->getToken()->getUser();
        $estabLocal 		= $sessionUser->getIdEstablecimiento();

        $results = $em->getRepository('MinsalSimagdBundle:ImgCtlPacsEstablecimiento')->data($BS_FILTERS_DECODE);

        $isUser_allowShow       = ($this->admin->isGranted('VIEW') && $this->admin->getRoutes()->has('show')) ? TRUE : FALSE;
        $isUser_allowEdit       = ($this->admin->isGranted('EDIT') && $this->admin->getRoutes()->has('edit')) ? TRUE : FALSE;

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\ImgCtlPacsEstablecimiento();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CONEXIÓN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['conexion'] . '</div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" >' . /*<span class="glyphicon glyphicon-check"></span>*/ 'Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>IP:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['ip'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>USUARIO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['usuario'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>PUERTO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['puerto'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>HOST:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['host'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>DURACIÓN ESTUDIO EN PACS (MESES):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['duracion_estudio'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>BASE DE DATOS:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['base_datos'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>MOTOR (BD):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $r['motor'] . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->dateFormatter($r['fecha_registro']) . '</div></div>' .
                            '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>HABILITADO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row">' . $formatter->booleanFormatter($r['habilitado']) . '</div></div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" pacsserverconnections-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="pacsserverconnections-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="pacsserverconnections_show"><a class=" pacsserverconnections_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="pacsserverconnections_edit"><a class=" pacsserverconnections_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="pacsserverconnections_delete"><a class=" pacsserverconnections_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="pacsserverconnections_create"><a class=" pacsserverconnections_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                            '<li data-item="pacsserverconnections_testconnection"><a class=" pacsserverconnections_testconnection_action "><span class="glyphicon glyphicon-signal"></span>Probar conexión</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';
            // $results[$key]['context_menu'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
            //         '<div class="btn-group" role="group">' .
            //             '<a class=" pacsserverconnections-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
            //                 // 'OP.' .
            //                 '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
            //             '</a>' .
            //         '</div>' .
            //     '</div>';

            $results[$key]['habilitado'] = $formatter->booleanFormatter($r['habilitado']);

            $results[$key]['pacs_fechaHoraReg']  = $r['pacs_fechaHoraReg']->format('Y-m-d H:i:s A');
            $results[$key]['pacs_fechaHoraMod']  = $r['pacs_fechaHoraMod'] ? $r['pacs_fechaHoraMod']->format('Y-m-d H:i:s A') : '';

            $results[$key]['pacs_editUrl']       = $this->generateUrl('simagd_pacs_edit', array('id' => $r['pacs_id']));

            $results[$key]['allowShow']          = $isUser_allowShow;

            $results[$key]['allowEdit']          = (false !== $isUser_allowEdit && ($estabLocal->getId() == $r['pacs_id_establecimiento'])) ? TRUE : FALSE;
        }

        return $this->renderJson($results);
    }

    public function habilitarPacsAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $id = $request->request->get('id');
        $pacs = $this->admin->getObject($id);

        $habilitado = $request->request->get('formPacsHabilitado');

        $em = $this->getDoctrine()->getManager();

        //Habilitar
        $pacs->setHabilitado($habilitado);

        //Actualizar Proyección
        try {
            /*$pacs = */$this->admin->update($pacs);
        } catch (Exception $e) {
            $status = 'failed';
        }

        return $this->renderJson(array());
    }

}