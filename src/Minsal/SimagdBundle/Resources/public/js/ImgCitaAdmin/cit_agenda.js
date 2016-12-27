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
	$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar({   //Onchange de modalidad filtra eventos refresh events, si radiologo no es seleccionado, mostrar todos
	    lazyFetching: false,
	    header: {                   //Para todas las modalidades, no solo ultrasonido, asi se puede filtrar solo de 1 tecnologo de TAC x ej.
		left: 'prev,next today',
		center: 'title',
		right: 'prevYear,nextYear month,agendaWeek,agendaDay' //Botón "agregar bloqueo en todas las modalidades", haria while de todas las modalidades en Action
	    },					//una vez teniendo el objeto creado, para crearlo para cada una
	    locale: 'es',
	    timezone: 'America/El_Salvador',
	    editable: true,
	    editExternalEvent: true,
	    defaultView: 'agendaWeek',
	    /*
	     * HIDE SATURDAYS (6) AND SUNDAYS (0)
	     */
	    hiddenDays: [6, 0],	// hide Saturdays (6) and Sundays (0)
	    nowIndicator: true,
        aspectRatio: 1.15,
	    events: {
		url: Routing.generate('simagd_cita_obtenerEventosCalendario'),
		type: 'POST',
		data: function() {
			    moment.locale('es');
			    var $last_view = $el_fc_calendar.fullCalendar('getView');
                var $type = jQuery('input[name=_fc_filter_search_type]:checked');
                var $type_val = $type.val();
			    // window.console.log(JSON.stringify($el_fc_calendar.fullCalendar('getView').intervalStart), JSON.stringify($el_fc_calendar.fullCalendar('getView').intervalEnd));
			    return {
			    	view: $last_view.name,
			    	type: $type_val,
					idAreaServicioDiagnostico: jQuery('select[id="navbar_field_cita_modalidad"]').val(),
					idTecnologo: jQuery('select[id="navbar_field_cita_tecnologo"]').val(),
					numeroExp: jQuery.trim(jQuery('input[id="navbar_filter_expNumero"]').val()),
					start : $last_view.intervalStart.format('YYYY-MM-DD HH:mm'),
					end: $last_view.intervalEnd.format('YYYY-MM-DD HH:mm'),
			    };
		},
		error: function() {
			    console.log('Ocurrió un error al desplegar el calendario');
			    $error_bsAlert.addFadeSlideEffect();
		},
		currentTimezone: 'America/El_Salvador'
	    },
    	// eventStartEditable: true,
	    droppable: true, // this allows things to be dropped onto the calendar
	    drop: function(date, jsEvent, ui) {
		      /** Hide popovers */
		      $('.fc-event, .fc-bgevent, [data-toggle="popover"]').popover('hide');

		      $el_fc_calendar.filter(':not([disabled]):visible')
			      .find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				  .popover('hide');

		      // is the "remove after drop" checkbox checked?
		      console.log(date, jsEvent, ui);
		      if (jQuery('#drop-remove').is(':checked') && jQuery(this).hasClass("fc-event")) {
			  // if so, remove the element from the "Draggable Events" list
			  jQuery(this).remove();
		      }
	    },
	    eventResizeStart: function(event, jsEvent, ui, view) {
				  var $popover = jQuery(this);

				  $popover.popover('hide');

    			    //   $el_fc_calendar.filter(':not([disabled]):visible')
    				   //    .find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
    					  // .popover('hide');
	    },
	    eventDragStart: function(event, jsEvent, ui, view) {
				var $popover = jQuery(this);

				$popover.popover('hide');

    			  //   $el_fc_calendar.filter(':not([disabled]):visible')
    				 //    .find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
    					// .popover('hide');
	    },
	    // defaultTimedEventDuration: '00:05:00',
	    defaultTimedEventDuration: $options.slot,
	    // slotDuration: '00:05:00',
	    slotDuration: $options.slot,
	    forceEventDuration: true,
	    slotEventOverlap: false,
	    //defaultAllDayEventDuration: '00:05:00',
	    //defaultAllDayEventDuration: $options.slot,
	    //allDaySlot: false,
	    eventRender: function(event, element) {//EVENT RECEIVE::::::: Si es en month view, buscar mejor espacio, usando la bd o buscando timeslot vacios
               // element.qtip({
               //     content: event.description,
               //     position : {
               //         my : 'right center',
               //         at : 'left center',
               //         adjust : {
               //             screen : true,
               //             scroll: false
               //         }
               //     }
               // });

                        var fc_view = $el_fc_calendar.fullCalendar('getView');
                        // window.console.log(fc_view, fc_view.name, fc_view.name === 'month');
    					if (event.hasOwnProperty('type') && event.type === 'summary' && fc_view.name === 'month') {
    						element.find('.fc-time').hide();
    						element.find('.fc-title').append('<br/>' + event.title_detail);
                            // continue;
                            return;
                            // return false;
    					}

			      element.popover({
				      html: true,
				      placement: 'top',
				      trigger: 'click',
				      title : event._id.indexOf('bl_') === -1 ? '<span class="text-info"><i class="fa fa-clock-o"></i></span> ' + jQuery.trim(event.tooltip_title) : '<span class="text-info"><i class="fa fa-lock"></i></span> ' + jQuery.trim(event.title),
				      container: '#calendar',
				      template: [
						    '<div class="popover popover-container-max-width popover-max-limit-width" role="tooltip">',
							'<div class="arrow">',
							'</div>',
							'<button type="button"    class="close" data-dismiss="popover" aria-hidden="true">&times;',
							'</button>',
							'<h3 class="popover-title">',
							'</h3>',
							'<div class="popover-content">',
							'</div>',
						    '</div>'
						].join(''),
				      content: function() {
						  if (event._id.indexOf('bl_') === -1) {
						      $('.cit_container_contentwrapper').setDataCitaPopoverContent({ object: event });
						      return $('.cit_container_contentwrapper').html();
						  } else {
						      $('.blAgd_container_contentwrapper').setDataBloqueoPopoverContent({ object: event });
						      return $('.blAgd_container_contentwrapper').html();
						  }
				      }
				  }).on('shown.bs.popover', function(e) {
				      var $popover = jQuery(this);

				      $is_blockAg = event._id.indexOf('bl_') !== -1 ? true : false;

				      if ($is_blockAg !== false) {
					  $el_fc_calendar.filter(':not([disabled]):visible')
					      .find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
						      .not($popover)
						      .popover('hide');
				      }

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .show-cita-popover-action').on('click', function(e) {
					  ___actionCitaSetterObjectModalData(event.cit_id, event, {});
					  jQuery('#citaFullData-showModalContainer').modal();
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .edit-cita-popover-action').on('click', function(e) {
					  ___setDataEditCitForm(e, event.cit_id, event, event.cit_id);
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .confirm-cita-popover-action').on('click', function(e) {
					  $.ajax({
					      type: 'post',
					      dataType: 'json',
					      url: Routing.generate('simagd_cita_confirmarCita'),
					      data: { id: event.cit_id },
					      success: function(response) {
							  console.log('Cita confirmada satisfactoriamente');
							  $popover.popover('hide');
							  $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('removeEvents', event.cit_id);

							  if (jQuery('#table-lista-citas').is(':visible')) {
							      jQuery('#table-lista-citas:visible').bootstrapTable('refresh');
							      $queued_bsAlert.addFadeSlideEffect();
							  }
					      },
					      error: function(e) {
							console.log('Se ha producido un error al confirmar cita');
							console.log(e.error);
							console.log(e.responseText);
							$error_bsAlert.addFadeSlideEffect();
					      }
					  });
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .cancel-cita-popover-action').on('click', function(e) {
					  ___setDataCancelCitForm(e, event.cit_id, event, event.cit_id);
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .print-cita-popover-action').on('click', function(e) {
					  generarVentanaEstudioPaciente(Routing.generate('simagd_cita_imprimirComprobante', { id: event.cit_id }));
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .close-cita-popover-action').on('click', function(e) {
					  $popover.popover('hide');
				      });


				      /** BLOCK action events */
				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .show-bloqueo-popover-action').on('click', function(e) {
					  ___actionBloqueoAgendaSetterObjectModalData(event.blAgd_id, event, {});
					  jQuery('#bloqueoAgendaFullData-showModalContainer').modal();
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .edit-bloqueo-popover-action').on('click', function(e) {
					  ___setDataEditBloqueoForm(e, event.blAgd_id, event, event.blAgd_id);
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .exclude-radx-bloqueo-popover-action').on('click', function(e) {
					    var $blAgd_excl_modal = jQuery('#excluirRadiologoBloqueo-modal');
					    $blAgd_excl_modal.fv_displayEditFormInModal({object: event});

					    jQuery('#formBlAgdExclRadxIdBloqueoAgenda-static-label').text(event.blAgd_titulo);
					    jQuery('#formBlAgdExclRadxIdExamenServicioDiagnostico-static-label').text(function(index) {
						var $mld_text = jQuery.trim(event.blAgd_modalidad);
						if (typeof $mld_text !== "undefined" && $mld_text !== null && $mld_text !== "") {
						    return $mld_text;
						} else {
						    return 'Todas las modalidades';
						}
					    });

					    $blAgd_excl_modal.modal();
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .remove-bloqueo-popover-action').on('click', function(e) {
					  $.ajax({
					      type: 'post',
					      dataType: 'json',
					      url: Routing.generate('simagd_bloqueo_agenda_removerBloqueo'),
					      data: { id: event.blAgd_id },
					      success: function(response) {
							  console.log('Bloqueo removido satisfactoriamente');
							  $popover.popover('hide');
							  $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('removeEvents', 'bl_' + event.blAgd_id);

							  if (jQuery('#table-lista-bloqueos').is(':visible')) {
							      jQuery('#table-lista-bloqueos:visible').bootstrapTable('remove', {field: 'blAgd_id', values: [event.blAgd_id]});
							  }
					      },
					      error: function(e) {
							console.log('Se ha producido un error al remover bloqueo');
							console.log(e.error);
							console.log(e.responseText);
							$error_bsAlert.addFadeSlideEffect();
					      }
					  });
				      });

				      $el_fc_calendar.filter(':not([disabled]):visible').find('div.popover .close-bloqueo-popover-action, [data-dismiss="popover"]').on('click', function(e) {
					  $popover.popover('hide');
				      });
				  });

			      if (event._id === 'false_event_id') {
				  $false_eventObject = jQuery.extend(true, {}, event);
			      }
			      if (event._id === 'bl_false_event_id') {
				  $false_blockObject = jQuery.extend(true, {}, event);
			      }
    			  // console.log(element);
    			  // window.console.log(event, element);
	    },
	    eventReceive: function(event) {
			      /** Hide popovers */
			      $('.fc-event, .fc-bgevent, [data-toggle="popover"]').popover('hide');

			      $el_fc_calendar.filter(':not([disabled]):visible')
				      .find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
					  .popover('hide');

			      $.ajax({
				    type: 'post',
				    dataType: 'json',
				    url: Routing.generate('simagd_cita_nuevaCita'),
				    data: {
					    type : 'new',
					    solicitud: event.prc_id,
					    title : event.title,
					    start : event.start.format('YYYY-MM-DD HH:mm'),
					    end: event.end.format('YYYY-MM-DD HH:mm'),
					    color: event.color,
					    idTecnologoProgramado: jQuery('select[id="navbar_field_cita_tecnologo"]').val()
				    },
				    success: function(response) {
						console.log('Evento agregado satisfactoriamente', event._id, response.cit_id);

						$el_fc_calendar.filter(':not([disabled]):visible')
							.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
							    .popover('hide');

						$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('removeEvents', event._id);
						$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('refetchEvents');
    					    // http://stackoverflow.com/questions/18141261/how-to-format-date-on-fullcalendar-on-that-way-when-i-click-on-event
				    },
				    error: function(e) {
					      console.log('Se ha producido un error al agregar nuevo evento');
					      console.log(e.error);
					      console.log(e.responseText);
					      $error_bsAlert.addFadeSlideEffect();
				    }
			      });
	    },
	    eventResize: function(event, delta, revertFunc) {
			      $.ajax({
				    type: 'post',
				    dataType: 'json',
				    url: Routing.generate('simagd_cita_actualizarCita'),
				    data: {
					    type : 'update',
					    id: event.id,
					    title : event.title,
					    start : event.start.format('YYYY-MM-DD HH:mm'),
					    end: event.end.format('YYYY-MM-DD HH:mm'),
				    },
				    success: function(response) {
						event.cit_fechaHoraInicioAnterior = event.cit_fechaHoraInicio;
						event.cit_fechaHoraFinAnterior = event.cit_fechaHoraFin;
						event.cit_fechaHoraInicio = event.start.format('YYYY-MM-DD h:mm:ss A');
						event.cit_fechaHoraFin = event.end.format('YYYY-MM-DD h:mm:ss A');

						event.cit_diaCompleto = event._allDay;

						event.cit_fechaReprogramacion = response.cit_fechaReprogramacion;
						event.cit_id_userMod = response.cit_id_userMod;
						event.cit_nombreUserMod = response.cit_nombreUserMod;
						event.cit_reprogramada = true;
						event.cit_usernameUserMod = response.cit_usernameUserMod;
						$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('updateEvent', event);

    					    // $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('refetchEvents');
						console.log('Hora de Evento actualizada satisfactoriamente');
				    },
				    error: function(e) {
					      revertFunc();
					      console.log('Se produjo un error al actualizar hora de evento');
					      console.log(e.error);
					      console.log(e.responseText);
					      $error_bsAlert.addFadeSlideEffect();
				    }
			      });

	      console.log(event);
	    },
	    eventDrop: function(event, delta, revertFunc) {
			    $.ajax({
				  type: 'post',
				  dataType: 'json',
				  url: Routing.generate('simagd_cita_actualizarCita'),
				  data: {
					  type : 'update',
					  id: event.id,
					  title : event.title,
					  start : event.start.format('YYYY-MM-DD HH:mm'),
					  end: event.end.format('YYYY-MM-DD HH:mm'),
				  },
				  success: function(response) {
					      event.cit_fechaHoraInicioAnterior = event.cit_fechaHoraInicio;
					      event.cit_fechaHoraFinAnterior = event.cit_fechaHoraFin;
					      event.cit_fechaHoraInicio = event.start.format('YYYY-MM-DD h:mm:ss A');
					      event.cit_fechaHoraFin = event.end.format('YYYY-MM-DD h:mm:ss A');

					      event.cit_diaCompleto = event._allDay;

					      event.cit_fechaReprogramacion = response.cit_fechaReprogramacion;
					      event.cit_id_userMod = response.cit_id_userMod;
					      event.cit_nombreUserMod = response.cit_nombreUserMod;
					      event.cit_reprogramada = true;
					      event.cit_usernameUserMod = response.cit_usernameUserMod;
					      $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('updateEvent', event);

    					  // $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('refetchEvents');
					      console.log('Fecha de Evento actualizada satisfactoriamente');
				  },
				  error: function(e) {
					    revertFunc();
					    console.log('Se produjo un error al actualizar fecha de evento');
					    console.log(e.error);
					    console.log(e.responseText);
					    $error_bsAlert.addFadeSlideEffect();
				  }
			    });
	    },
	    dayClick: function(date, jsEvent, view) {
    	    // console.log('Clicked on: ' + date.format());
    	    // console.log('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
    	    // console.log('Current view: ' + view.name);

			  // change the day's background color just for fun
    		      // jQuery(this).css('background-color', '#e7faff');
			  jQuery(this).addClass('simagd_ac_checked_date');
			  $('.fc-day').not(jQuery(this)).removeClass('simagd_ac_checked_date');

			  if (jsEvent.target.classList.contains('fc-bgevent')) {
			      console.log('Click Background Event Area');
			  }

			  if (view.name != 'month') {
			      return;
			  }
			  $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('gotoDate', date);
			  $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('changeView', 'agendaDay');
	    },
	    eventClick: function(calEvent, jsEvent, view) {
                // console.log(calEvent);

                //////// type = summary
                //////// no action
			    if (calEvent.hasOwnProperty('type') && calEvent.type === 'summary') {
                    jQuery(this).css('border-color', '#a0a0a0');
			    	return false;
			    }

			    jQuery(this).css('border-color', '#f5f2d4');

			    /* Nuevo evento en modal options y form-edit */
			    $current_eventObject = jQuery.extend(true, {}, calEvent);

			    jQuery('input[id="formConfirmCitId"]').val( calEvent._id);

			    window.console.log('%c' + 'YYYY-MM-DD h:mm:ss A => ' + calEvent.start.format('YYYY-MM-DD h:mm:ss A') + '\n'
				+ 'll => ' + calEvent.start.format('ll') + '\n'
				+ 'LL => ' + calEvent.start.format('LL') + '\n'
				+ 'lll => ' + calEvent.start.format('lll') + '\n'
				+ 'LLL => ' + calEvent.start.format('LLL') + '\n'
				+ 'llll => ' + calEvent.start.format('llll') + '\n'
				+ 'LLLL => ' + calEvent.start.format('LLLL') + '\n'
				+ 'dddd, MMMM Do YYYY, h:mm:ss a => ' + calEvent.start.format('dddd, MMMM Do YYYY, h:mm:ss a'), 'background: #16677d; color: #fc9');

			    $el_fc_calendar.filter(':not([disabled]):visible')
				.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				.not(this)
				.popover('hide');

			    return false;
	    },
	    slotLabelFormat: 'h:mm A',
	    timeFormat: 'H(:mm) A',
	    eventLimit: true, // for all non-agenda views
	    views: {
		agenda: {
		    eventLimit: 6 // adjust to 6 only for agendaWeek/agendaDay
		}
	    },
	    handleWindowResize: true,
	    eventAfterRender: function(event, element, view) {
				    if (event._id === 'false_event_id' || event._id === 'bl_false_event_id') {
					$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('removeEvents', event._id);
				    }
	    },
	    loading: function(isLoading, view) {
			if (isLoading !== false) {
			    $fc_calendar_panel.find('.panel-title').html(function() {
				return [
				    '<i class="fa fa-spinner icon-refresh-animate"></i>',
				    ' ',
				    ' Actualizando'
				].join('');
			    });
			}
	    },
	    eventAfterAllRender: function(view) {
				    $fc_calendar_panel.find('.panel-title').html(function() {
					return [
					    '<i class="fa fa-calendar"></i>',
					    ' ',
					    '<i class="fa fa-calendar-check-o"></i>',
					    ' Agenda'
					].join('');
				    });
	    },
	});
	console.log('%cfullCalendar is successfully initiated', 'background: #183f52; color: #fff');
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

    /*
     * **************************************************************************
     * --| call method to define fullCalendar
     * **************************************************************************
     */
    fn_init_fullCalendar_configurarion({slot: '00:15:00'});	// --| init plugin fullcalendar with slot in default = 5 minutes
    /*
     * --| END call method
     */

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
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * http://stackoverflow.com/questions/2644299/jquery-removeclass-wildcard
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * *********************************************************************************************************************
     * return to default agenda view
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
		$event	= $this.data('event').event_server_object;
	    var $result	= $html + [
		    '<br/>',
		    '<span style="font-weight: 900;">', $event.explocal_numero, '</span>',
		    '<br/>',
		    '<div class="pending-patient-request">',
		    	'<u>' + $event.prc_areaAtencion + ' - ' + $event.prc_atencion + '</u>',
		    	'<br/>',
		    	'<strong>', $event.prc_modalidad, '</strong>',
		    	'<br/>',
		    	'<strong>Solicitó</strong>&nbsp; ' + $event.prc_empleado,
			'<br/>',
		    	'<strong>Se solicitó</strong>&nbsp; ' + simagdDateTimeFormatter($event.prc_fechaCreacion, $event, $event.prc_id),
			'<br/>',
		    	'<strong>Próxima consulta</strong>&nbsp; ' + simagdDateFormatter($event.prc_fechaProximaConsulta, $event, $event.prc_id),
			'<br/>',
		    	'<strong>Prioridad</strong>&nbsp; ' + $event.prAtn_nombre,
		    '</div>',
		].join('');
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

    /*
     * Refresh fullCalendar options without rebuilt
     */


    /* http://fullcalendar.io/docs/event_data/events_function/ */

    //////////////////////////////////////////////////////////////////////////
    //////// go to date
    //////////////////////////////////////////////////////////////////////////
    var $el_fc_goToDate = jQuery('[id="navbar_field_cita_goToDate"]');	//  --| dtpicker DOM element
        $el_fc_goToDate.datetimepicker({
            locale          : 'es',
            format          : 'YYYY-MM-DD',
            showTodayButton : true,
            showClear       : true,
            showClose       : true,
            ignoreReadonly  : true
        }).on("dp.change", function (e) {
            jQuery(this).blur();
            console.log(e.date);
            var goToDpDate = (typeof e.date !== 'undefined' && e.date !== null && e.date !== false) ? e.date : moment();
            $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('gotoDate', goToDpDate);
        }).on("dp.hide", function (e) {
            jQuery(this).blur();
        });

    //////////////////////////////////////////////////////////////////////////
    //////// change content type - month (and height)
    //////////////////////////////////////////////////////////////////////////
    var $__DOM__type_ = jQuery('input[name=_fc_filter_search_type]');
    $__DOM__type_.on('ifClicked', function(e) {
    	var $__DOM__checked_ = jQuery('input[name=_fc_filter_search_type]:checked');
        var chk = $__DOM__checked_.val();
        var $last_view = $el_fc_calendar.fullCalendar('getView');
        if (chk !== this.value) {
	    	if (this.value === 'summary') {
	    		$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'height', 2650);
	    		// $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'contentHeight', 1650);
	    		// window.console.log (JSON.stringify($el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'height')));
	    	}
	    	else {
	    		$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'height', 'auto');
	    		// $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'contentHeight', 'auto');
	    		// window.console.log (JSON.stringify($el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('option', 'height')));
	    	}
	    }
    });

});

/** Set data in popover */
jQuery.fn.setDataCitaPopoverContent = function(options) {
    moment.locale('es');
    var $citObject = options.object;

    jQuery(this).find('[data-render-info="idEmpleado"]')
	    .html(jQuery.trim($citObject.cit_empleado));
    jQuery(this).find('[data-render-info="fechaCreacion"]')
	    .html(moment(jQuery.trim($citObject.cit_fechaCreacion), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A"));
    jQuery(this).find('[data-render-info="idEstablecimiento"]')
	    .html(jQuery.trim($citObject.prc_origen));
    jQuery(this).find('[data-render-info="idAreaAtencion"]')
	    .html(jQuery.trim($citObject.prc_areaAtencion));
    jQuery(this).find('[data-render-info="idAtencion"]')
	    .html(jQuery.trim($citObject.prc_atencion));
    jQuery(this).find('[data-render-info="idEmpleadoSolicitante"]')
	    .html(jQuery.trim($citObject.prc_solicitante));
    jQuery(this).find('[data-render-info="idAreaServicioDiagnostico"]')
	    .html(jQuery.trim($citObject.prc_modalidad));
    jQuery(this).find('[data-render-info="idPrioridadAtencion"]')
	    .html(jQuery.isEmptyObject($citObject.prAtn_nombre) === false ? simagdPrioridadAtencionFormatter($citObject.prAtn_nombre, $citObject, $citObject.prc_id) : '');
    jQuery(this).find('[data-render-info="fechaProximaConsulta"]')
	    .html(moment(jQuery.trim($citObject.prc_fechaProximaConsulta), "YYYY-MM-DD").format("dddd, MMMM D YYYY"));
    jQuery(this).find('[data-render-info="fechaCreacion"]')
	    .html(moment(jQuery.trim($citObject.prc_fechaCreacion), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A"));
    jQuery(this).find('[data-render-info="solicitudEstudioProyeccion"]')
	    .html(function() {
		var $arr_result = ['<ul>'];

		$.each($citObject.prc_solicitudEstudioProyeccion, function(i, y) {
		    $arr_result.push('<li>', '<strong><span class="text-info">', jQuery.trim(y.expl_codigo) + '</span></strong> ' + jQuery.trim(y.expl_nombre), '</li>');
		});

		$arr_result.push('</ul>');

                return $arr_result.join('');
            });
};

/** Set data in popover */
jQuery.fn.setDataBloqueoPopoverContent = function(options) {
    moment.locale('es');
    var $blAgdObject = options.object;

    jQuery(this).find('[data-render-info="idRadiologoBloqueo"]')
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_radiologo) === false ? jQuery.trim($blAgdObject.blAgd_radiologo) : '');
    jQuery(this).find('[data-render-info="idAreaServicioDiagnostico"]')
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_modalidad) === false ? jQuery.trim($blAgdObject.blAgd_modalidad) : '');
    jQuery(this).find('[data-render-info="fechaInicio"]')
	    .html(moment(jQuery.trim($blAgdObject.blAgd_fechaInicio), "YYYY-MM-DD").format("dddd, MMMM D YYYY"));
    jQuery(this).find('[data-render-info="horaInicio"]')
	    .html(moment(jQuery.trim($blAgdObject.blAgd_horaInicio), "HH:mm:ss").format("h:mm:ss A"));
    jQuery(this).find('[data-render-info="fechaFin"]')
	    .html(moment(jQuery.trim($blAgdObject.blAgd_fechaFin), "YYYY-MM-DD").format("dddd, MMMM D YYYY"));
    jQuery(this).find('[data-render-info="horaFin"]')
	    .html(moment(jQuery.trim($blAgdObject.blAgd_horaFin), "HH:mm:ss").format("h:mm:ss A"));
    jQuery(this).find('[data-render-info="idEmpleadoRegistra"]')
	    .html(jQuery.trim($blAgdObject.blAgd_empleado));
    jQuery(this).find('[data-render-info="fechaCreacion"]')
	    .html(moment(jQuery.trim($blAgdObject.blAgd_fechaCreacion), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A"));
};
