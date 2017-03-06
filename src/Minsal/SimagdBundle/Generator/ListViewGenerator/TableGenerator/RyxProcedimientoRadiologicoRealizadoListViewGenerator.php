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

// use Minsal\SimagdBundle\Entity\RyxProcedimientoRadiologicoRealizado;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * RyxProcedimientoRadiologicoRealizadoListViewGenerator
 *
 * @author farid
 */
class RyxProcedimientoRadiologicoRealizadoListViewGenerator extends RyxEntityListViewGenerator
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
        if ($this->type === 'compact')
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
                        'field' => 'compact',
                        'title' => 'MODO DE VISTA COMPACTO &nbsp; <span class="glyphicon glyphicon-collapse-down"></span>',
                        'switchable' => false,
                        'align' => 'center',
                        'halign' => 'left',
                        // 'formatter' => '__fnc_worklistDetailFormatter',
                        'events' => 'operateEvents',
                    )
            );
        }
        elseif ($this->type === 'detail')
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
                        'title' => 'MODO DE VISTA DETALLADA &nbsp; <span class="glyphicon glyphicon-collapse-down"></span>',
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
                        'field' => 'origen',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-home"></span>'*/ 'Origen',
                        'visible' => false,
                        // 'formatter' => 'simagdOrigenFormatter',
                    ),
                    array(
                        'field' => 'paciente',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-user"></span>'*/ 'Paciente',
                        'switchable' => false,
                        // 'formatter' => 'simagdPacienteFormatter',
                    ),
                    array(
                        'field' => 'numero_expediente',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-tag"></span>'*/ 'Reg.',
                        'switchable' => false,
                        'class' => 'bstable-column-highlighted',
                        // 'formatter' => 'simagdPacienteFormatter',
                    ),
                    array(
                        'field' => 'area_atencion',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-paperclip"></span>'*/ 'Procedencia',
                    ),
                    array(
                        'field' => 'atencion',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-paperclip"></span>'*/ 'Servicio',
                    ),
                    array(
                        'field' => 'medico',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-user"></span>'*/ 'Médico',
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'modalidad',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-list-alt"></span>'*/ 'Modalidad',
                    ),
                    array(
                        'field' => 'triage',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-tag"></span>'*/ 'TRIAGE',
                        'class' => 'bstable-column-highlighted',
                        // 'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'tecnologo',
                        'sortable' => true,
                        'title' => 'Téc. / Lic. / Rdlg.',
                        'class' => 'bstable-column-highlighted',
                        'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'estado',
                        'sortable' => true,
                        'title' => 'Estado',
                        'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'fecha_examen',
                        'sortable' => true,
                        'title' => 'Fecha (Exm.)',
                        'visible' => false,
                        // 'formatter' => 'simagdDateTimeFormatter',
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
                        'events' => '__XRAYPROCEDURESPERFORMED_MENU_ACTIONEVENTS__',
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
        $this->entityOptions['url']         = $this->routeGenerator->generate('simagd_realizado_generateData', array('type' => $this->type));
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-darkblue-head';
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-black-head';
        $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-xray-supreme-head';
        $this->entityOptions['buttonsClass']   = 'primary-v4';
        $this->entityOptions['pageSize']    = '50';
        if ($this->type === 'detail' || $this->type === 'compact') {
            $this->entityOptions['showToggle']  = false;
            $this->entityOptions['showColumns'] = false;
            $this->entityOptions['pageSize']    = '15';
        }
        // $this->entityOptions['height']      = '1268';

        // $this->entityOptions['contextMenu']         = '#xrayproceduresperformed-context-menu';
        // $this->entityOptions['contextMenuButton']   = '.xrayproceduresperformed-button';
        // $this->entityOptions['contextMenuTrigger']  = 'both';
        // $this->entityOptions['onContextMenuItem']   = '__FUNCTIONS_CALL__.functions.onContextMenuItem';
        ////////
    }

}