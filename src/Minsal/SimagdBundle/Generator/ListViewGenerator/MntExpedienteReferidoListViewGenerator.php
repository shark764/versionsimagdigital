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

// use Minsal\SimagdBundle\Entity\MntExpedienteReferido;

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
// http://stackoverflow.com/questions/6956258/adding-onclick-event-to-dynamically-added-button
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

/**
 * MntExpedienteReferidoListViewGenerator
 *
 * @author farid
 */
class MntExpedienteReferidoListViewGenerator extends RyxEntityListViewGenerator
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
        array_push($this->columns,
                array(
                    'field' => 'id',
                    'sortable' => true,
                    'title' => 'ID',
                    'switchable' => false,
                ),
                array(
                    'field' => 'paciente',
                    'sortable' => true,
                    'title' => 'Paciente',
                    'switchable' => false,
                    // 'formatter' => 'simagdPacienteFormatter',
                ),
                array(
                    'field' => 'numero',
                    'sortable' => true,
                    'title' => 'Registro',
                    'switchable' => false,
                    // 'formatter' => 'simagdPacienteFormatter',
                ),
                array(
                    'field' => 'fecha_nacimiento',
                    'sortable' => true,
                    'title' => 'Fecha (Naciemiento)',
                    // 'switchable' => false,
                    // 'formatter' => 'simagdPacienteFormatter',
                ),
                array(
                    'field' => 'numero_afiliacion',
                    'sortable' => true,
                    'title' => 'Número (Afiliación)',
                    // 'switchable' => false,
                    // 'formatter' => 'simagdPacienteFormatter',
                ),
                array(
                    'field' => 'origen',
                    'sortable' => true,
                    'title' => 'Origen',
                    // 'visible' => false,
                    // 'formatter' => 'simagdOrigenFormatter',
                ),
                array(
                    'field' => 'action',
                    'sortable' => false,
                    'align' => 'center',
                    'halign' => 'center',
                    'title' => '<span class="glyphicon glyphicon-cog"></span> Operaciones',
                    'formatter' => 'operateFormatter',
                    'events' => 'operateEvents',
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
        //     $results[$key]['fecha_solicitud']  = $result['fecha_solicitud']->format('Y-m-d H:i:s A');
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
    }

}