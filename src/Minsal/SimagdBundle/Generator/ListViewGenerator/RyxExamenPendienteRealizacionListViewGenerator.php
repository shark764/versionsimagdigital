<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SimagdBundle\Generator\ListViewGenerator;

use Minsal\SimagdBundle\Generator\ListViewGenerator\RyxEntityListViewGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
// use Minsal\SimagdBundle\Entity\EntityInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;

// use Minsal\SimagdBundle\Entity\RyxExamenPendienteRealizacion;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * RyxExamenPendienteRealizacionListViewGenerator
 *
 * @author farid
 */
class RyxExamenPendienteRealizacionListViewGenerator extends RyxEntityListViewGenerator
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
        if ($this->getType() === 'detail')
        {
            array_push($this->columns,
                    array(
                        'field' => 'detail',
                        'title' => '<span class="glyphicon glyphicon-zoom-in"></span> DETALLE',
                        'switchable' => false,
                        'align' => 'center',
                        'halign' => 'center',
                        'formatter' => '__fnc_worklistDetailFormatter',
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
                    'switchable' => false,
                ),
                array(
                    'field' => 'origen',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-home"></span> ORIGEN',
                    'visible' => false,
                    // 'formatter' => 'simagdOrigenFormatter',
                ),
                array(
                    'field' => 'paciente',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-user"></span> PACIENTE',
                    'switchable' => false,
                    // 'formatter' => 'simagdPacienteFormatter',
                ),
                array(
                    'field' => 'numero_expediente',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-tag"></span> REG.',
                    'switchable' => false,
                    // 'formatter' => 'simagdPacienteFormatter',
                ),
                array(
                    'field' => 'area_atencion',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-paperclip"></span> PROCEDENCIA',
                ),
                array(
                    'field' => 'atencion',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-paperclip"></span> SERVICIO',
                ),
                array(
                    'field' => 'medico',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-user"></span> MÉDICO',
                    // 'switchable' => false,
                ),
                array(
                    'field' => 'modalidad',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-list-alt"></span> MODALIDAD',
                ),
                array(
                    'field' => 'triage',
                    'sortable' => true,
                    'title' => '<span class="glyphicon glyphicon-tag"></span> TRIAGE',
                    // 'visible' => false,
                    // 'switchable' => false,
                ),
                array(
                    'field' => 'tecnologo',
                    'sortable' => true,
                    'title' => 'TÉC. / LIC. / RDLG.',
                    'visible' => false,
                    // 'switchable' => false,
                ),
                array(
                    'field' => 'estado',
                    'sortable' => true,
                    'title' => 'ESTADO',
                    'visible' => false,
                    // 'switchable' => false,
                ),
                array(
                    'field' => 'fecha_examen',
                    'sortable' => true,
                    'title' => 'FECHA (EXM.)',
                    'visible' => false,
                    // 'formatter' => 'simagdDateTimeFormatter',
                ),
                array(
                    'field' => 'action',
                    'sortable' => false,
                    'align' => 'center',
                    'halign' => 'center',
                    'title' => '<span class="glyphicon glyphicon-cog"></span> OP.',
                    'formatter' => 'operateFormatter',
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
        //     $results[$key]['fecha_examen']  = $result['fecha_examen']->format('Y-m-d H:i:s A');
        //     $results[$key]['fecha_lectura'] = $result['fecha_lectura']->format('Y-m-d H:i:s A');
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
        $this->entityOptions['url']     = $this->routeGenerator->generate('simagd_sin_realizar_listarPendientesRealizar');
        $this->entityOptions['classes'] = 'table table-hover table-condensed table-striped table-darkblue-head';
        $this->entityOptions['pageSize']  = '25';
        // $this->entityOptions['height']  = '1268';
        ////////
    }

}