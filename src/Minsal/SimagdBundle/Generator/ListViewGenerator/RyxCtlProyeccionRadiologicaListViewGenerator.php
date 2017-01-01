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
                    'field' => 'grupo',
                    'sortable' => true,
                    'title' => 'Grupo',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'codigo_grupo',
                    'sortable' => true,
                    'title' => 'Código (Grupo)',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'subgrupo',
                    'sortable' => true,
                    'title' => 'Subgrupo',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'codigo_subgrupo',
                    'sortable' => true,
                    'title' => 'Código (Subgrupo)',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'nombre',
                    'sortable' => true,
                    'title' => 'Material',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'codigo',
                    'sortable' => true,
                    'title' => 'Código (Material)',
                    // 'visible' => true,
                ),
                array(
                    'field' => 'descripcion',
                    'sortable' => false,
                    'title' => 'Descripción',
                    'class' => 'justify-table-large-row',
                    'formatter' => 'simagdDescriptionAdvanceFormatter',
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