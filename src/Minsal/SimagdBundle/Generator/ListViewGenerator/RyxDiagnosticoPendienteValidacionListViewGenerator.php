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

// use Minsal\SimagdBundle\Entity\RyxDiagnosticoPendienteValidacion;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * RyxDiagnosticoPendienteValidacionListViewGenerator
 *
 * @author farid
 */
class RyxDiagnosticoPendienteValidacionListViewGenerator extends RyxEntityListViewGenerator
{
    /**
     * @var array
     */
    protected $entityOptions = array(
        // 'url'   => $this->routeGenerator->generate('simagd_lectura_datos'),
    );

    /**
     * Constructor
     */
    public function __construct(ContainerInterface $container, RouteGeneratorInterface $routeGenerator, $class)
    {
        parent::__construct($container, $routeGenerator, $class);
    }

    /**
     * Sets the array.
     *
     * @param array $columns An array instance
     *
     * @api
     */
    public function defineColumns()
    {
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
                    'title' => 'Origen',
                    'visible' => false,
                    // 'formatter' => 'simagdOrigenFormatter',
                ),
                array(
                    'field' => 'paciente',
                    'sortable' => true,
                    'title' => 'Paciente',
                    'switchable' => false,
                    // 'formatter' => 'simagdPacienteFormatter',
                ),
                array(
                    'field' => 'numero_expediente',
                    'sortable' => true,
                    'title' => 'Registro',
                    'switchable' => false,
                    // 'formatter' => 'simagdPacienteFormatter',
                ),
                array(
                    'field' => 'medico',
                    'sortable' => true,
                    'title' => 'Médico',
                    // 'switchable' => false,
                ),
                array(
                    'field' => 'area_atencion',
                    'sortable' => true,
                    'title' => 'Procedencia',
                ),
                array(
                    'field' => 'atencion',
                    'sortable' => true,
                    'title' => 'Servicio',
                ),
                array(
                    'field' => 'modalidad',
                    'sortable' => true,
                    'title' => 'Modalidad',
                ),
                array(
                    'field' => 'tecnologo',
                    'sortable' => true,
                    'title' => 'Téc. / Lic. / Rdlg.',
                    'visible' => false,
                    // 'switchable' => false,
                ),
                array(
                    'field' => 'estado',
                    'sortable' => true,
                    'title' => 'Estado',
                    // 'switchable' => false,
                ),
                array(
                    'field' => 'fecha_examen',
                    'sortable' => true,
                    'title' => 'Fecha (Examen)',
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
                    // 'visible' => true,
                ),
                array(
                    'field' => 'fecha_lectura',
                    'sortable' => true,
                    'title' => 'Fecha (Lectura)',
                    'visible' => false,
                    // 'formatter' => 'simagdDateTimeFormatter',
                ),
                array(
                    'field' => 'action',
                    'sortable' => false,
                    'title' => '<span class="glyphicon glyphicon-cog"></span>',
                    'formatter' => 'lectura_actionFormatter',
                    'events' => 'lectura_actionEvents',
                )
        );
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

}