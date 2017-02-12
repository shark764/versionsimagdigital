<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator;

use Minsal\SimagdBundle\Generator\ListViewGenerator\TableGenerator\RyxEntityListViewGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
// use Minsal\SimagdBundle\Entity\EntityInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;

// use Minsal\SimagdBundle\Entity\RyxCtlProyeccionRadiologica;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * RyxCtlProyeccionRadiologicaListViewGenerator
 *
 * @author farid
 */
class RyxCtlProyeccionRadiologicaListViewGenerator extends RyxEntityListViewGenerator
{
    /**
     * Sets the array.
     *
     * @param array $columns An array instance
     *
     * @api
     */
    public function defineColumns()
    {
        if ($this->type === 'detail')
        {
            array_push($this->columns,
                    array(
                        'field' => 'id',
                        'sortable' => true,
                        'title' => 'ID',
                        'visible' => false,
                        'switchable' => false,
                    ),
                    array(
                        'field' => 'detail',
                        'title' => 'VISTA EN DETALLE &nbsp; <span class="glyphicon glyphicon-collapse-down"></span>',
                        'switchable' => false,
                        'align' => 'center',
                        'halign' => 'left',
                        // 'formatter' => '__fnc_worklistDetailFormatter',
                        'events' => 'operateEvents',
                    )
            );
        }
        else {
            array_push($this->columns,
                    array(
                        'field' => 'id',
                        'sortable' => true,
                        'title' => 'ID',
                        'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'codigo_modalidad',
                        'sortable' => true,
                        'title' => 'Cód. (Modalidad)',
                    ),
                    array(
                        'field' => 'modalidad',
                        'sortable' => true,
                        'title' => 'Modalidad',
                    ),
                    array(
                        'field' => 'codigo_examen',
                        'sortable' => true,
                        'title' => 'Cód. (Exam.)',
                    ),
                    array(
                        'field' => 'examen',
                        'sortable' => true,
                        'title' => 'Exam. / Gpo.',
                    ),
                    array(
                        'field' => 'codigo',
                        'sortable' => true,
                        'title' => 'Cód. (Proyec.)',
                    ),
                    array(
                        'field' => 'nombre',
                        'sortable' => true,
                        'title' => 'Proyec.',
                    ),
                    array(
                        'field' => 'localizacion',
                        'sortable' => true,
                        'title' => 'Región',
                    ),
                    array(
                        'field' => 'fecha_registro',
                        'sortable' => true,
                        'title' => 'Fecha (Reg.)',
                        // 'visible' => false,
                        // 'formatter' => 'simagdDateTimeFormatter',
                    ),
                    array(
                        'field' => 'fecha_edicion',
                        'sortable' => true,
                        'title' => 'Fecha (Ed.)',
                        'visible' => false,
                        // 'formatter' => 'simagdDateTimeFormatter',
                    ),
                    array(
                        'field' => 'descripcion',
                        'sortable' => false,
                        'title' => 'Descrip.',
                        'visible' => false,
                        'class' => 'justify-table-large-row',
                        // 'formatter' => 'simagdDescriptionAdvanceFormatter',
                    ),
                    // array(
                    //     'field' => 'context_menu',
                    //     'sortable' => false,
                    //     'align' => 'center',
                    //     'halign' => 'center',
                    //     'title' => '<span class="glyphicon glyphicon-cog"></span> OP.',
                    //     // 'formatter' => 'operateFormatter',
                    //     // 'events' => 'operateEvents',
                    // ),
                    array(
                        'field' => 'action',
                        'sortable' => false,
                        'align' => 'center',
                        'halign' => 'center',
                        'title' => '<span class="glyphicon glyphicon-cog"></span> OP.',
                        // 'formatter' => 'operateFormatter',
                        'events' => '__RADIOLOGICALEXAMINATIONS_MENU_ACTIONEVENTS__',
                    )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildData()
    {
        //////// --| entity manager
        $em = $this->entityManager;
        //////// --|

        ////////
        $results = $em->getRepository($this->class)->datos();
        ////////

        // foreach ($results as $key => $result)
        // {
        //     $results[$key]['fecha'] = $result['fecha']->format('Y-m-d H:i:s A');
        // }

        ////////
        $this->data = $results;
        ////////

        // return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this->setEntityOptions();
        $this->defineColumns();
        // $this->buildData();
        // $this->generateData();
    }

    /**
     * {@inheritdoc}
     */
    public function defineEntityOptions()
    {
        ////////
        $this->entityOptions['url']         = $this->routeGenerator->generate('simagd_proyeccion_generateData', array('type' => $this->type));
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-darkblue-head';
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-black-head';
        $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-xray-supreme-head';
        $this->entityOptions['buttonsClass']   = 'primary-v4';
        $this->entityOptions['pageSize']    = '50';
        // $this->entityOptions['sortName']    = 'undefined';
        if ($this->type === 'detail') {
            $this->entityOptions['showToggle']  = false;
            $this->entityOptions['showColumns'] = false;
            $this->entityOptions['pageSize']    = '5';
        } elseif ($this->type === 'list') {
            $this->entityOptions['detailView']  = true;
            $this->entityOptions['detailFormatter'] = '__FUNCTIONS_CALL__.functions.detailFormatter';

            // $this->entityOptions['detailFormatter'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;"><div class="box-body">__FUNCTIONS_CALL__.functions.detailFormatter</div></div>';
            
            // $this->entityOptions['detailFormatter'] = '<div class="box box-drop-outside-shadow box-primary-v4" style="margin-top: 5px;">' .
            //         '<div class="box-body" ondblclick="_fn_show_object_detail(this); return false;">' .
            //             '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>NOMBRE:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row"> </div><div class="col-lg-6 col-md-6 col-sm-6 "><div class="btn-toolbar" role="toolbar" aria-label="..."><div class="btn-group" role="group"><a class="btn btn-primary-v4 worklist-send-pacs" href="javascript:void(0)" > Guardar y asociar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-send" href="javascript:void(0)" ><span class="glyphicon glyphicon-check"></span> Guardar</a></div><div class="btn-group" role="group"><a class="btn btn-emergency worklist-new-external-patient" href="javascript:void(0)" ><span class="glyphicon glyphicon-plus-sign"></span> Crear externo</a></div></div></div></div>' .
            //             '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row"> </div></div>' .
            //             '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>EXAMEN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row"> </div></div>' .
            //             '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>CÓDIGO (EXM):</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row"> </div></div>' .
            //             '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>FECHA REGISTRO:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row"> </div></div>' .
            //             '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 data-box-row"><strong>DESCRIPCIÓN:</strong></div><div class="col-lg-4 col-md-4 col-sm-4 data-box-row"> </div></div>' .
            //         '</div>' .
            //     '</div>';

            // $this->entityOptions['icons']   = array(
            //         'paginationSwitchDown'  => 'glyphicon-collapse-down icon-chevron-down',
            //         'paginationSwitchUp'    => 'glyphicon-collapse-up icon-chevron-up',
            //         'refresh'       => 'glyphicon-repeat icon-repeat',
            //         'toggle'        => 'glyphicon-list-alt icon-list-alt',
            //         'columns'       => 'glyphicon-th icon-th',
            //         'detailOpen'    => 'glyphicon-download icon-chevron-down',
            //         'detailClose'   => 'glyphicon-upload icon-chevron-up',
            //     );
        }
        // $this->entityOptions['height']      = '1268';

        // $this->entityOptions['contextMenu']         = '#radiologicalexaminations-context-menu';
        // $this->entityOptions['contextMenuButton']   = '.radiologicalexaminations-button';
        // $this->entityOptions['contextMenuTrigger']  = 'both';
        // $this->entityOptions['onContextMenuItem']   = '__FUNCTIONS_CALL__.functions.onContextMenuItem';
        ////////
    }

}