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

// use Minsal\SimagdBundle\Entity\RyxCtlProyeccionEstablecimiento;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * RyxCtlProyeccionEstablecimientoListViewGenerator
 *
 * @author farid
 */
class RyxCtlProyeccionEstablecimientoListViewGenerator extends RyxEntityListViewGenerator
{
    /**
     * @var array
     */
    protected $entityOptions = array();

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
                    'field' => 'modalidad',
                    'sortable' => true,
                    'title' => 'Modalidad',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'codigo_modalidad',
                    'sortable' => true,
                    'title' => 'Código (Modalidad)',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'examen',
                    'sortable' => true,
                    'title' => 'Examen / Grupo',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'codigo_examen',
                    'sortable' => true,
                    'title' => 'Código (Examen)',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'nombre',
                    'sortable' => true,
                    'title' => 'Proyección',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'codigo',
                    'sortable' => true,
                    'title' => 'Código (Proyección)',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'habilitada',
                    'sortable' => true,
                    'title' => 'Habilitado',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'fecha_registro',
                    'sortable' => true,
                    'title' => 'Fecha (Registro)',
                    'visible' => false,
                    // 'formatter' => 'simagdDateTimeFormatter',
                ),
                array(
                    'field' => 'fecha_edicion',
                    'sortable' => true,
                    'title' => 'Fecha (Edición)',
                    'visible' => false,
                    // 'formatter' => 'simagdDateTimeFormatter',
                ),
                array(
                    'field' => 'action',
                    'sortable' => false,
                    'title' => '<span class="glyphicon glyphicon-cog"></span>',
                    'formatter' => 'proyeccion_actionFormatter',
                    'events' => 'proyeccion_actionEvents',
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
        //     $results[$key]['fecha_registro']    = $result['fecha_examen']->format('Y-m-d H:i:s A');
        //     $results[$key]['fecha_edicion']     = $result['fecha_edicion'] ? $result['fecha_edicion']->format('Y-m-d H:i:s A') : '';
        // }

        ////////
        $this->data = $results;
        ////////

        // return $this->data;
    }

}