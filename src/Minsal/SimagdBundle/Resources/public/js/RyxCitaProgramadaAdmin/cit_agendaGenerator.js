/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
    /*
     *
     * @type Array
     * Global variables for plugin
     */
    window.__FULL_CAL__ = {};   // --| build data collection
    
    /*
     * Collection of functions / fc options
     */
    __FULL_CAL__.functions = {
	    events: {
			url: Routing.generate('simagd_cita_getEvents'),
			type: 'POST',
			data: function() {
			    moment.locale('es');

			    var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element
			    var $last_view = $el_fc_calendar.fullCalendar('getView');
                var $type = jQuery('input[name=_fc_filter_search_type]:checked');
                var $type_val = $type.val();

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
	    drop: function(date, jsEvent, ui) {
			/** Hide popovers */
			$('.fc-event, .fc-bgevent, [data-toggle="popover"]').popover('hide');

			var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

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

			var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

			$el_fc_calendar.filter(':not([disabled]):visible')
				.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				.popover('hide');
	    },
	    eventDragStart: function(event, jsEvent, ui, view) {
			var $popover = jQuery(this);

			$popover.popover('hide');

			var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

		    $el_fc_calendar.filter(':not([disabled]):visible')
			    .find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				.popover('hide');
	    },
	    eventRender: function(event, element) {
	    	var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

            var fc_view = $el_fc_calendar.fullCalendar('getView');
            //////// << summary view mode >>
			if (event.hasOwnProperty('type') && event.type === 'summary' && fc_view.name === 'month') {
				element.find('.fc-time').hide();
				element.find('.fc-title').append('<br/>' + event.title_detail);
                return;
			}
			////////

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
						type: 'POST',
						dataType: 'json',
						url: Routing.generate('simagd_cita_confirmarCita'),
						data: {id: event.cit_id},
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
					generarVentanaEstudioPaciente(Routing.generate('simagd_cita_print', { id: event.cit_id }));
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
						type: 'POST',
						dataType: 'json',
						url: Routing.generate('simagd_bloqueo_agenda_removerBloqueo'),
						data: {id: event.blAgd_id},
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
		},
	    eventReceive: function(event) {
	    	var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

			/** Hide popovers */
			$('.fc-event, .fc-bgevent, [data-toggle="popover"]').popover('hide');

			$el_fc_calendar.filter(':not([disabled]):visible')
				.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				.popover('hide');

			$.ajax({
				type: 'POST',
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
	    	var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

			$.ajax({
				type: 'POST',
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
	    	var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

		    $.ajax({
				type: 'POST',
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
	    	var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

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

			if (view.name !== 'month') {
				return;
			}
			$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('gotoDate', date);
			$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('changeView', 'agendaDay');
	    },
	    eventClick: function(calEvent, jsEvent, view) {
	    	var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element

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
	    eventAfterRender: function(event, element, view) {
		    if (event._id === 'false_event_id' || event._id === 'bl_false_event_id') {
		    	var $el_fc_calendar = jQuery('#calendar');	//  --| calendar DOM element
				$el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('removeEvents', event._id);
		    }
	    },
	    loading: function(isLoading, view) {
			if (isLoading !== false) {
				var $fc_calendar_panel  = jQuery('[id="fc-calendar-panel"]');

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
	    	var $fc_calendar_panel  = jQuery('[id="fc-calendar-panel"]');

		    $fc_calendar_panel.find('.panel-title').html('AGENDA'/*function() {
				return [
				    // '<i class="fa fa-calendar"></i>',
				    // ' ',
				    // '<i class="fa fa-calendar-check-o"></i>',
				    'AGENDA'
				].join('');
		    }*/);
	    },
    };	// --| build function object

}(jQuery));