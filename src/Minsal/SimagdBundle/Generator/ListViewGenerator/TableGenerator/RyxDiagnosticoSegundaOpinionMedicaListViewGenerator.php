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

// use Minsal\SimagdBundle\Entity\RyxDiagnosticoSegundaOpinionMedica;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * RyxDiagnosticoSegundaOpinionMedicaListViewGenerator
 *
 * @author farid
 */
class RyxDiagnosticoSegundaOpinionMedicaListViewGenerator extends RyxEntityListViewGenerator
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
                        'visible' => false,
                    ),
                    array(
                        'field' => 'medico',
                        'sortable' => true,
                        'title' => /*'<span class="glyphicon glyphicon-user"></span>'*/ 'Médico',
                        // 'switchable' => false,
                        'visible' => false,
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
                        'class' => 'bstable-column-emergency',
                        // 'visible' => false,
                        // 'switchable' => false,
                    ),
                    array(
                        'field' => 'tecnologo',
                        'sortable' => true,
                        'title' => 'Téc. / Lic. / Rdlg.',
                        'class' => 'bstable-column-darkmedicine',
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
                    array(
                        'field' => 'transcriptor',
                        'sortable' => true,
                        'title' => 'Transcriptor',
                        'visible' => false,
                    ),
                    array(
                        'field' => 'fecha_transcrito',
                        'sortable' => true,
                        'title' => 'Registrada',
                        'visible' => false,
                        // 'formatter' => 'simagdDateTimeFormatter',
                    ),
                    array(
                        'field' => 'fecha_aprobado',
                        'sortable' => true,
                        'title' => 'Fecha (Aprobación)',
                        'visible' => false,
                        // 'formatter' => 'simagdDateTimeFormatter',
                    ),
                    array(
                        'field' => 'correlativo',
                        'sortable' => true,
                        'title' => 'Etiqueta',
                        'visible' => false,
                    ),
                    array(
                        'field' => 'radiologo',
                        'sortable' => true,
                        'title' => 'Radiólogo',
                        'class' => 'bstable-column-radiology',
                    ),
                    array(
                        'field' => 'fecha_lectura',
                        'sortable' => true,
                        'title' => 'Fecha (Lctr.)',
                        'visible' => false,
                        // 'formatter' => 'simagdDateTimeFormatter',
                    ),
                    array(
                        'field' => 'fecha_diagnostico',
                        'sortable' => true,
                        'title' => 'Fecha (Dx)',
                        // 'formatter' => 'simagdDateTimeFormatter',
                    ),
                    array(
                        'field' => 'conclusion',
                        'sortable' => false,
                        'title' => 'Resultado',
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
                        'events' => '__SECONDMEDICALOPINIONS_MENU_ACTIONEVENTS__',
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
        $this->entityOptions['url']         = $this->routeGenerator->generate('simagd_segunda_opinion_medica_generateData', array('type' => $this->type));
        // $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-darkblue-head';
        $this->entityOptions['classes']     = 'table table-hover table-condensed table-striped table-black-head';
        $this->entityOptions['pageSize']    = '50';
        // $this->entityOptions['sortName']    = 'undefined';
        if ($this->type === 'detail') {
            $this->entityOptions['showToggle']  = false;
            $this->entityOptions['showColumns'] = false;
            $this->entityOptions['pageSize']    = '5';
        }
        // $this->entityOptions['height']      = '1268';

        // $this->entityOptions['contextMenu']         = '#secondmedicalopinions-context-menu';
        // $this->entityOptions['contextMenuButton']   = '.secondmedicalopinions-button';
        // $this->entityOptions['contextMenuTrigger']  = 'both';
        // $this->entityOptions['onContextMenuItem']   = '__FUNCTIONS_CALL__.functions.onContextMenuItem';
        ////////
    }

}