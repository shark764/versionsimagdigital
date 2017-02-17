/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Objeto que guarda el evento consultado
var $current_eventObject 	= null;

// Evento falso de prueba, asi evitar el refresh en event_receive
var $false_eventObject 		= null;
// Bloqueo falso de prueba, asi evitar el refresh en event_"create"
var $false_blockObject 		= null;

jQuery(document).ready(function() {

    console.log('%cAl presionar un event pendiente patient, entonces transformar el calendar, para q aparezca bloqueado donde no puede ponerlo\nIgual para cuando es eventResize y eventDrop\nY que no sea en refetch, sino que en cliente', 'background: #183f52; color: #fff');

    console.log('%cCambiar color de la franja azul en los dropdown list y en tt-menu list', 'background: #183f52; color: #fff');

    console.log('%c http://fullcalendar.io/ \n http://fullcalendar.io/docs/display/customButtons/ \n http://fullcalendar.io/docs/display/header/ \n http://fullcalendar.io/docs/dropping/eventReceive/ --> para evitar en proxima consulta \n http://fullcalendar.io/docs/dropping/drop/ <-- para lo mismo \n http://fullcalendar.io/docs/event_ui/dragRevertDuration/ \n draggable tiene tambien revertDuration \n http://fullcalendar.io/docs/event_ui/dragOpacity/ \n http://fullcalendar.io/docs/event_ui/eventOverlap/ \n http://fullcalendar.io/docs/display/weekends/ \n http://fullcalendar.io/docs/display/hiddenDays/', 'background: #183f52; color: #fff');

    /*
     * fc-calendar-panel, show refresh calendar message
     * @type @call;$
     */
    var $fc_calendar_panel  = jQuery('[id="fc-calendar-panel"]');

    /*
     * get calendar element
     * @type @call;$
     */
    var $el_fc_calendar     = jQuery('#calendar');   //  --| calendar DOM element

    /*
     * **************************************************************************
     * --| define fullCalendar
     * **************************************************************************
     */
    function fn_init_fullCalendar_configurarion ($options)
    {
       /*
		* set calendar configuration
		*/
		$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar({
	    	// eventStartEditable: true,
		    defaultTimedEventDuration: $options.slot,
		    slotDuration: $options.slot,
		    //defaultAllDayEventDuration: $options.slot,
		    //allDaySlot: false,
		    //EVENT RECEIVE ::::::: SI ES EN MONTH VIEW, BUSCAR MEJOR ESPACIO, USANDO LA BD O BUSCANDO TIMESLOT VACIOS
		});
    }
    /*
     * **************************************************************************
     * --| reset configurarion of fullCalendar
     * **************************************************************************
     */
    function fn_reset_fullCalendar_configurarion ($options)
    {
		if ($el_fc_calendar.is(':visible')) {
		    var $last_view	= $el_fc_calendar.fullCalendar('getView');
		    var $last_date	= $el_fc_calendar.fullCalendar('getDate');

		    $el_fc_calendar
			.filter(':not([disabled]):visible')
				.fullCalendar('destroy');	// --| destroy calendar
		    fn_init_fullCalendar_configurarion($options);	// --| rebuild calendar with new options

		    $el_fc_calendar
			.filter(':not([disabled]):visible')
				.fullCalendar('changeView', $last_view.name);
		    $el_fc_calendar
			.filter(':not([disabled]):visible')
				.fullCalendar('gotoDate', $last_date);
		}
    }

    $('[data-toggle="popover"]').popover();

    /*
     * expand agenda view
     */
    jQuery('#panel_agenda_btn_expand_view').filter(':not([disabled])').click(function(e) {
        jQuery('#panel_agenda_btn_default_view').parents('li').show();
        jQuery(this).parents('li').hide();

        jQuery('#external-events').hide('slide', {direction: 'left'}, 100, function() {
            jQuery('#container_fc_agenda_view').removeClass (function (index, css) {
		    return (css.match (/(^|\s)col-lg-\S+/g) || css.match (/(^|\s)col-md-\S+/g) || css.match (/(^|\s)col-sm-\S+/g) || []).join(' ');
		})/*.removeClass('col-lg-9 col-md-9 col-sm-9')*/.addClass('col-lg-12 col-md-12 col-sm-12');
            jQuery(window).resize();
        });
    });
    /*
     * Return to default agenda view
     */
    jQuery('#panel_agenda_btn_default_view').filter(':not([disabled])').click(function(e) {
        jQuery('#external-events').show('slide', {direction: 'right'}, 100, function() {
            jQuery('#container_fc_agenda_view').removeClass (function (index, css) {
		    return (css.match (/(^|\s)col-lg-\S+/g) || css.match (/(^|\s)col-md-\S+/g) || css.match (/(^|\s)col-sm-\S+/g) || []).join(' ');
		})/*.removeClass('col-lg-12 col-md-12 col-sm-12')*/.addClass('col-lg-9 col-md-9 col-sm-9');
            jQuery(window).resize();
        });

        jQuery('#panel_agenda_btn_expand_view').parents('li').show();
        jQuery(this).parents('li').hide();
    });

    /*
     * Detail for study request pending
     */
    jQuery('#panel_patient_btn_show_request_detail').filter(':not([disabled])').click(function(e) {
		/*
		 * Add detail for study request
		 */
		jQuery('#external-events').find('.fc-event').html(function($i, $html) {
		    var $this	= jQuery(this),
			var $event	= $this.data('event').event_server_object;
		    // var $result	= $html + [
			//     '<br/>',
			//     '<span style="font-weight: 900;">', $event.explocal_numero, '</span>',
			//     '<br/>',
			//     '<div class="pending-patient-request">',
			//     	'<u>' + $event.prc_areaAtencion + ' - ' + $event.prc_atencion + '</u>',
			//     	'<br/>',
			//     	'<strong>', $event.prc_modalidad, '</strong>',
			//     	'<br/>',
			//     	'<strong>Solicitó</strong>&nbsp; ' + $event.prc_empleado,
			// 	'<br/>',
			//     	'<strong>Se solicitó</strong>&nbsp; ' + simagdDateTimeFormatter($event.prc_fechaCreacion, $event, $event.prc_id),
			// 	'<br/>',
			//     	'<strong>Próxima consulta</strong>&nbsp; ' + simagdDateFormatter($event.prc_fechaProximaConsulta, $event, $event.prc_id),
			// 	'<br/>',
			//     	'<strong>Prioridad</strong>&nbsp; ' + $event.prAtn_nombre,
			//     '</div>',
			// ].join('');
			var $result	= $html + $event.event_detail;
		    return $result;
		});

        jQuery('#panel_patient_btn_hide_request_detail').parents('li').show();
        jQuery(this).parents('li').hide();

		/*
		 * Detail for study request
		 */
		NODATED_REQUEST_VIEW_DETAIL_FORMAT = true;   // --| change detail format
    });
    jQuery('#panel_patient_btn_hide_request_detail').filter(':not([disabled])').click(function(e) {
		jQuery('#external-events').find('.fc-event').html(function($i, $html) {
		    return jQuery(this).data('event').preferred_title;
		});

        jQuery('#panel_patient_btn_show_request_detail').parents('li').show();
        jQuery(this).parents('li').hide();

		/*
		 * Detail for study request
		 */
		NODATED_REQUEST_VIEW_DETAIL_FORMAT = false;   // --| change detail format
    });

    /*
     * Change default slot for time
     */
    jQuery('#fullcalendar_slotDuration')
	    .filter(':not([disabled])')
		    .change(function(e) {
				var $new_slot 	= parseInt(jQuery(this).val(), 10);
				$time_slot	= isNaN($new_slot) ? '00:05:00'
						      : ($new_slot === 60 || $new_slot === '60' ? '01:00:00'
							      : '00:' + ($new_slot < 10 ? '0' : '') + $new_slot.toString() + ':00');
				console.log('$new_slot', $new_slot, '$time_slot', $time_slot);
				fn_reset_fullCalendar_configurarion({slot: $time_slot});	// --| default to 5 minutes between dates
		    });

    /*
     * Refresh events in calendar
     */
    jQuery('#panel_agenda_btn_refresh_calendar')
	    .filter(':not([disabled])')
		    .click(function(e) {
				/*
				* fullCalendar
				*/
				$el_fc_calendar
					.filter(':not([disabled]):visible')
					.fullCalendar('refetchEvents');	// --| refresh the view
		    });

    //////////////////////////////////////////////////////////////////////////
    //////// go to date
    //////////////////////////////////////////////////////////////////////////
    // var $el_fc_goToDate = jQuery('[id="navbar_field_cita_goToDate"]');	//  --| dtpicker DOM element
    //     $el_fc_goToDate.datetimepicker({
    //         locale          : 'es',
    //         format          : 'YYYY-MM-DD',
    //         showTodayButton : true,
    //         showClear       : true,
    //         showClose       : true,
    //         ignoreReadonly  : true
    //     }).on("dp.change", function (e) {
    //         jQuery(this).blur();
    //         console.log(e.date);
    //         var goToDpDate = (typeof e.date !== 'undefined' && e.date !== null && e.date !== false) ? e.date : moment();
    //         $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('gotoDate', goToDpDate);
    //     }).on("dp.hide", function (e) {
    //         jQuery(this).blur();
    //     });

    //////////////////////////////////////////////////////////////////////////
    //////// change content type - month (and height)
    //////////////////////////////////////////////////////////////////////////
    var __DOM__filter_search_type = jQuery('input[name=_fc_filter_search_type]');

    __DOM__filter_search_type.on('ifChecked', function(e) {
        /*
         * fullCalendar
         */
        var $last_view = $el_fc_calendar.fullCalendar('getView');
        if ($last_view.name !== 'month') {
            return;
        }

        var aspectRatio = 0.75;
    	if (this.value === 'summary') {
            aspectRatio = 1;
    	}
        $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'aspectRatio', aspectRatio);
        $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('refetchEvents');	// --| refresh the view
		// $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'height', 2650);
		// $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'contentHeight', 1650);
    });

});