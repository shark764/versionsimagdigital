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

// use Minsal\SimagdBundle\Entity\RyxCtlPatronDiagnostico;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * RyxCtlPatronDiagnosticoListViewGenerator
 *
 * @author farid
 */
class RyxCtlPatronDiagnosticoListViewGenerator extends RyxEntityListViewGenerator
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
                        'field' => 'codigo',
                        'sortable' => true,
                        'title' => 'Código',
                    ),
                    array(
                        'field' => 'nombre',
                        'sortable' => true,
                        'title' => 'Patrón',
                    ),
                    array(
                        'field' => 'modalidad',
                        'sortable' => true,
                        'title' => 'Modalidad',
                    ),
                    array(
                        'field' => 'radiologo',
                        'sortable' => true,
                        'title' => 'Radiólogo',
                        'class' => 'bstable-column-radiology',
                    ),
                    array(
                        'field' => 'tipo_resultado',
                        'sortable' => true,
                        'title' => 'Tipo (Rtdo.)',
                    ),
                    array(
                        'field' => 'conclusion',
                        'sortable' => false,
                        'title' => 'Diagnóstico',
                        'class' => 'justify-table-large-row',
                        // 'formatter' => 'simagdDescriptionAdvanceFormatter',
                    ),
                    array(
                        'field' => 'habilitado',
                        'sortable' => true,
                        'title' => '¿Act.?',
                        'align' => 'center',
                        // 'visible' => false,
                        // 'formatter' => 'habilitadoFormatter',
                    ),
                    array(
                        'field' => 'fecha_registro',
                        'sortable' => true,
                        'title' => 'Fecha (Reg.)',
                        'visible' => false,
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
                        'field' => 'empleado',
                        'sortable' => true,
                        'title' => 'Registró',
                        'visible' => false,
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
                        'events' => '__RADIOLOGICALDIAGNOSTICPATTERNS_MENU_ACTIONEVENTS__',
                    ),
                    array(
                        'field' => 'action2',
                        'sortable' => false,
                        'align' => 'center',
                        'halign' => 'center',
                        'title' => '<span class="glyphicon glyphicon-cog"></span> OP2.',
                        // 'formatter' => 'operateFormatter',
                        'events' => 'operateEvents',
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
        $this->entityOptions['url']         = $this->routeGenerator->generate('simagd_patron_diagnostico_generateData', array('type' => $this->type));
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-darkblue-head';
        $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-black-head';
        $this->entityOptions['pageSize']    = '50';
        $this->entityOptions['searchAlign'] = 'right';
        $this->entityOptions['buttonsAlign']    = 'right';
        $this->entityOptions['toolbarAlign']    = 'right';
        // $this->entityOptions['sortName']    = 'undefined';
        if ($this->type === 'detail') {
            $this->entityOptions['showToggle']  = false;
            $this->entityOptions['showColumns'] = false;
            $this->entityOptions['pageSize']    = '5';
        }
        // $this->entityOptions['height']      = '1268';

        // $this->entityOptions['contextMenu']         = '#radiologicaldiagnosticpatterns-context-menu';
        // $this->entityOptions['contextMenuButton']   = '.radiologicaldiagnosticpatterns-button';
        // $this->entityOptions['contextMenuTrigger']  = 'both';
        // $this->entityOptions['onContextMenuItem']   = '__FUNCTIONS_CALL__.functions.onContextMenuItem';
        ////////
    }

}