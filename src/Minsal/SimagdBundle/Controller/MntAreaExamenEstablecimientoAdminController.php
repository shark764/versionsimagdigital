<?php

namespace Minsal\SimagdBundle\Controller;

use Minsal\SimagdBundle\Controller\MinsalSimagdBundleGeneralAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityRepository;

use Minsal\SimagdBundle\Generator\ListViewGenerator\Formatter\Formatter;
use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\MntAreaExamenEstablecimientoListViewGenerator;

class MntAreaExamenEstablecimientoAdminController extends MinsalSimagdBundleGeneralAdminController
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
        $ENTITY_LIST_VIEW_GENERATOR_ = new MntAreaExamenEstablecimientoListViewGenerator(
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

    public function generateDataAction(Request $request)
    {
        $request->isXmlHttpRequest();

        $BS_FILTERS         = $this->get('request')->query->get('filters');
        $BS_FILTERS_DECODE  = json_decode($BS_FILTERS, true);

        $__REQUEST__type = $this->get('request')->query->get('type', 'list');

        $em = $this->getDoctrine()->getManager();

        //////// --| << prepare >>
        $this->admin->prepareAdminInstance();
        ////////

        $results = $em->getRepository('MinsalSimagdBundle:MntAreaExamenEstablecimiento')->data($this->admin->getSessionSystemUserLoggedLocation()->getId(), $BS_FILTERS_DECODE);

        $formatter = new Formatter();

        foreach ($results as $key => $r)
        {
            // $r = new \Minsal\SimagdBundle\Entity\MntAreaExamenEstablecimiento();

            if ($__REQUEST__type === 'detail')
            {
                $results[$key]['detail'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
                        '<div class="box-body" ondblclick="_fn_show_object_detail(this, \'undiagnosed_studies\', ' . $r['id'] . '); return false;">' .
                            '<div class="row">' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['modalidad'] . '</h3>' .
                                    // '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6 data-box-row"><h3>' . $r['nombre'] . '</h3></div></div>' .
                                    '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 data-box-row"><span class="badge badge-emergency badge-inverse" style="font-size: 14px;">' . $r['codigo_modalidad'] . '</span></div></div><p></p>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>EXAMEN:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['examen'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (EXM.):</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $r['codigo_examen'] . '</div></div>' .
                                    '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>ACTIVO:</strong></div><div class="col-lg-9 col-md-9 col-sm-9 data-box-row">' . $formatter->booleanFormatter($r['habilitado']) . '</div></div>' .
                                '</div>' .
                                '<div class="col-lg-6 col-md-6 col-sm-6 data-box-row">' .
                                    '<div class=" " style="margin-top: 20px; margin-bottom: 10px;"><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" > Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div>' .
                                '</div>' .
                            '</div>' .
                        '</div>' .
                    '</div>';
                continue;
            }

            $results[$key]['action'] = '<div class="btn-toolbar" role="toolbar" aria-label="...">' .
                    '<div class="btn-group" role="group">' .
                        '<a class=" materials-button material-btn-list-op btn-link btn-link-black-thrash dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" cursor: context-menu; " role="button" href="javascript:void(0)" title="Operaciones..." >' .
                            // 'OP.' .
                            '<span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <span class="sr-only">Operaciones</span>' .
                        '</a>' .
                        '<ul id="materials-context-menu" class="dropdown-menu highlight-success-dropdown-menu" style="right: 0; left: auto;" role="menu">' .
                            '<li class="dropdown-header">MENÚ</li>' .
                            '<li data-item="localdiagnosticserviceexamsbymodality_show"><a class=" localdiagnosticserviceexamsbymodality_show_action "><span class="glyphicon glyphicon-folder-open"></span>Consultar</a></li>' .
                            '<li data-item="localdiagnosticserviceexamsbymodality_edit"><a class=" localdiagnosticserviceexamsbymodality_edit_action "><span class="glyphicon glyphicon-edit"></span>Editar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="localdiagnosticserviceexamsbymodality_delete"><a class=" localdiagnosticserviceexamsbymodality_delete_action "><span class="glyphicon glyphicon-trash"></span>Borrar</a></li>' .
                            '<li class="divider"></li>' .
                            '<li data-item="localdiagnosticserviceexamsbymodality_create"><a class=" localdiagnosticserviceexamsbymodality_create_action "><span class="glyphicon glyphicon-plus-sign"></span>Crear nuevo</a></li>' .
                        '</ul>' .
                    '</div>' .
                '</div>';

            $results[$key]['fecha_registro']    = $r['fecha_registro'] ? $formatter->dateFormatter($r['fecha_registro'], 'date') : null;
            $results[$key]['fecha_edicion']     = $r['fecha_edicion'] ? $formatter->dateFormatter($r['fecha_edicion'], 'date') : null;
            $results[$key]['habilitado']		= $formatter->booleanFormatter($r['habilitado']);
        }

        return $this->renderJson($results);
    }

}