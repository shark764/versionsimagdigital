<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Minsal\SimagdBundle\Generator\AgendaGenerator;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;

/**
 * AgendaGenerator
 *
 * @author farid
 */
class AgendaGenerator
{
    /**
     * @var ContainerInterface
     *
     * @api
     */
    protected $container;

    /**
     * The router instance
     *
     * @var RouteGeneratorInterface
     */
    protected $routeGenerator;

    /**
     * @var \EntityManager
     */
    protected $entityManager;

    /**
     * The class name managed by the generator
     *
     * @var string
     */
    protected $class;

    /**
     * @var array
     */
    protected $options = array(
        'lazyFetching' => false,    // prevent lazy events fetch
        // 'customButtons' => array(
        //     // 'reload' => '__FULL_CAL__.functions.reload',
        //     'reload' => array(
        //         'text' => 'recargar',
        //         // 'icon' => 'arrowrefresh-1-s',
        //         // 'themeIcon' => '',
        //         'click' => '__FULL_CAL__.functions.customButtons.reload',
        //     ),  // add refresh button
        // ),
        'customButtons' => '__FULL_CAL__.functions.customButtons',
        'header' => array(
            'left' => 'reload prev,next today',
            'center' => 'title',
            'right' => 'prevYear,nextYear month,agendaWeek,agendaDay',
        ),
        'locale' => 'es',
        'timezone' => 'America/El_Salvador',
        'editable' => true,
        'selectable' => true,
        'editExternalEvent' => true,
        'defaultView' => 'agendaWeek',
        'hiddenDays' => array(6, 0),    // hide saturdays (6) and sundays (0)
        'nowIndicator' => true,
        // 'aspectRatio' => 1.15,
        'aspectRatio' => 1,
        'droppable' => true,
        // 'defaultTimedEventDuration' => '00:05:00',
        'defaultTimedEventDuration' => '00:15:00',
        // 'slotDuration' => '00:05:00',
        'slotDuration' => '00:15:00',
        'forceEventDuration' => true,
        'slotEventOverlap' => false,
        'slotLabelFormat' => 'h:mm A',
        'timeFormat' => 'H(:mm) A',
        'eventLimit' => true,   // for all non-agenda views
        'views' => array(
            'agenda' => array('eventLimit' => 6,),  // adjust to 6 only for agendaWeek/agendaDay
        ),
        'handleWindowResize' => true,
        'events' => '__FULL_CAL__.functions.events',
        // 'events' => array(
        //     'type' => 'POST',
        //     'data' => '__FULL_CAL__.functions.data',
        //     'error' => '__FULL_CAL__.functions.error',
        //     'currentTimezone' => 'America/El_Salvador',
        // ),
        'select' => '__FULL_CAL__.functions.select',
        'drop' => '__FULL_CAL__.functions.drop',
        'eventResizeStart' => '__FULL_CAL__.functions.eventResizeStart',
        'eventDragStart' => '__FULL_CAL__.functions.eventDragStart',
        'eventRender' => '__FULL_CAL__.functions.eventRender',
        'eventReceive' => '__FULL_CAL__.functions.eventReceive',
        'eventResize' => '__FULL_CAL__.functions.eventResize',
        'eventDrop' => '__FULL_CAL__.functions.eventDrop',
        'dayClick' => '__FULL_CAL__.functions.dayClick',
        'eventClick' => '__FULL_CAL__.functions.eventClick',
        'eventAfterRender' => '__FULL_CAL__.functions.eventAfterRender',
        'loading' => '__FULL_CAL__.functions.loading',
        'eventAfterAllRender' => '__FULL_CAL__.functions.eventAfterAllRender',
    );

    /**
     * Constructor
     */
    public function __construct(ContainerInterface $container, RouteGeneratorInterface $routeGenerator, $class)
    {
        $this->class            = $class;
        $this->container        = $container;
        $this->routeGenerator   = $routeGenerator;
        $this->entityManager    = $this->container->get('doctrine')->getManager();

        // $this->options['events']['url'] = $this->routeGenerator->generate('simagd_cita_getEvents');
    }

    /**
     * Sets the Container associated with this Controller.
     *
     * @param ContainerInterface $container A ContainerInterface instance
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Sets the RouteGenerator associated with this Controller.
     *
     * @param RouteGeneratorInterface $routeGenerator A RouteGeneratorInterface instance
     *
     * @api
     */
    public function setRouteGenerator(RouteGeneratorInterface $routeGenerator)
    {
        $this->routeGenerator = $routeGenerator;
    }

    /**
     * Sets the EntityManager.
     *
     * @param EntityManager $entityManager An EntityManager instance
     *
     * @api
     */
    public function setEntityManager(EntityManager $entityManager = null)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Sets the array.
     *
     * @param array $options An array instance
     *
     * @api
     */
    public function setOptions(array $options = array())
    {
        if (is_array($options) && count($options) > 0) {
            $this->options = $options;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the array.
     *
     * @param array $options An array instance
     *
     * @api
     */
    public function addOwnOptions(array $options = array())
    {
        if (is_array($options) && count($options) > 0) {
            $this->options = array_merge($this->options, $options);
        }
    }

}