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
     * @var array
     */
    protected $options = array(
        'lazyFetching' => false,    // prevent lazy events fetch
        'header' => array(
            'left' => 'prev,next today',
            'center' => 'title',
            'right' => 'prevYear,nextYear month,agendaWeek,agendaDay',
        ),
        'locale' => 'es',
        'timezone' => 'America/El_Salvador',
        'editable' => true,
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
        'eventLimit' => true,
        'views' => array(
            'agenda' => array('eventLimit' => 6,),
        ),
        'handleWindowResize' => true,
        'events' => array(
            'url' => 'Routing.generate(\'simagd_cita_obtenerEventosCalendario\')',
            'type' => 'POST',
            'data' => 'window.__FULL_CAL__.events.data',
            // 'error' => 'window.__FULL_CAL__.events.error',
            'error' => 'function() { console.log(\'Ocurrió un error al desplegar el calendario\'); },',
            'currentTimezone' => 'America/El_Salvador',
        ),
        'drop' => 'drop',
        'eventResizeStart' => 'eventResizeStart',
        'eventDragStart' => 'eventDragStart',
        'eventRender' => 'eventRender',
        'eventReceive' => 'eventReceive',
        'eventResize' => 'eventResize',
        'eventDrop' => 'eventDrop',
        'dayClick' => 'dayClick',
        'eventClick' => 'eventClick',
        'eventAfterRender' => 'eventAfterRender',
        'loading' => 'loading',
        'eventAfterAllRender' => 'eventAfterAllRender',
    );

    /**
     * Constructor
     */
    public function __construct()
    {
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