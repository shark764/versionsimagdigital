/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



jQuery(document).ready(function() {
    
    jQuery('#formCitColor').colorpicker({
        customClass: 'colorpicker-2x',
        sliders: {
            saturation: {
                maxLeft: 200,
                maxTop: 200
            },
            hue: {
                maxTop: 200
            },
            alpha: {
                maxTop: 200
            }
        }
//     }).on("hidePicker.colorpicker", function (e) {
//         jQuery(this).blur();
    }).on('showPicker.colorpicker hidePicker.colorpicker changeColor.colorpicker', function(e) {
        jQuery('#editarCitaForm').formValidation('revalidateField', 'formCitColor');
    });

    jQuery('#formCitFechaHoraInicio, #formCitFechaHoraFin').datetimepicker({
	locale: 'es',
	format: 'YYYY-MM-DD hh:mm A',
	showTodayButton: true,
	showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.hide", function (e) {
        jQuery(this).blur();
    }).on('dp.change dp.hide dp.show', function(e) {
        jQuery('#editarCitaForm').formValidation('revalidateField', jQuery(this).attr('name'));
    });
//    .mask('9999-99-99');
    
    jQuery('#btn_editar_cit:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_cit = 'edit';
	
	var $form = jQuery('#editarCitaForm');
        $form.submit();
	
	/** Función ajax */
// 	___editarCitaAction();
// 	var event_id = $("input[id='formCitId']").val();
    });
    
    jQuery('#btn_cancel_cita:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_cit = 'cancel';
	
	var $form = jQuery('#cancelarCitaForm');
        $form.submit();
	
	/** Función ajax */
// 	___cancelarCitaAction(event_id);
    });
    
    jQuery('#btn_confirmar_cit_modal:not([disabled])').click(function(e) {
        e.preventDefault();
	
	var event_id = $("#formConfirmCitId").val();
	/** Función ajax */
	___confirmarCitaAction(event_id);
    });
    
});

function ___editarCitaAction() {
    $.ajax({
	    type: 'post',
	    dataType: 'json',
	    url: Routing.generate('simagd_cita_editarCita'),
	    data: jQuery('#editarCitaForm').formParams(),
	    success: function(response) {
			console.log('Cita editada satisfactoriamente');
	    // 		jQuery('#calendar:not([disabled])').fullCalendar('removeEvents', event_id);
			jQuery('#calendar:not([disabled])')
				.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				    .popover('hide');
			jQuery('#calendar:not([disabled])').fullCalendar('refetchEvents');
			jQuery('#editarCita-modal').modal('hide');
			jQuery('#opcionesCita-modal').modal('hide');
			jQuery('#table-lista-citas:visible').bootstrapTable('refresh');
			jQuery('#simagd-edited-response-bs-alert').addFadeSlideEffect();
	    },
	    error: function(e) {
			console.log('Se ha producido un error al editar cita');
			console.log(e.error);
			console.log(e.responseText);
			jQuery('#editarCita-modal').modal('hide');
			jQuery('#opcionesCita-modal').modal('hide');
			jQuery('#simagd-error-response-bs-alert').addFadeSlideEffect();
	    }
    });
    
    return false;
}

function ___cancelarCitaAction(event_id) {
    $.ajax({
            type: 'post',
            dataType: 'json',
            url: Routing.generate('simagd_cita_cancelarCita'),
            data: jQuery('#cancelarCitaForm').formParams(),
            success: function(response) {
			console.log('Cita cancelada satisfactoriamente');
			jQuery('#calendar:not([disabled])')
				.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				    .popover('hide');
			jQuery('#cancelarCita-modal').modal('hide');
			jQuery('#opcionesCita-modal').modal('hide');
			jQuery('#calendar:not([disabled])').fullCalendar('removeEvents', event_id);
	//                 jQuery('#calendar:not([disabled])').fullCalendar('refetchEvents');
			jQuery('#table-lista-citas:visible').bootstrapTable('refresh');
			if (jQuery('#table-lista-citas').is(':visible')) {
			    jQuery('#simagd-edited-response-bs-alert').addFadeSlideEffect();
			}
            },
            error: function(e) {
			console.log('Se ha producido un error al cancelar cita');
			console.log(e.error);
			console.log(e.responseText);
			jQuery('#cancelarCita-modal').modal('hide');
			jQuery('#opcionesCita-modal').modal('hide');
			jQuery('#simagd-error-response-bs-alert').addFadeSlideEffect();
            }
    });
    
    return false;
}

function ___confirmarCitaAction(event_id) {
    $.ajax({
            type: 'post',
            dataType: 'json',
            url: Routing.generate('simagd_cita_confirmarCita'),
            data: { id: event_id },
            success: function(response) {
			console.log('Cita confirmada satisfactoriamente');
			jQuery('#calendar:not([disabled])')
				.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				    .popover('hide');
			jQuery('#opcionesCita-modal').modal('hide');
			jQuery('#calendar:not([disabled])').fullCalendar('removeEvents', event_id);
	//                 jQuery('#calendar:not([disabled])').fullCalendar('refetchEvents');
			jQuery('#table-lista-citas:visible').bootstrapTable('refresh');
			if (jQuery('#table-lista-citas').is(':visible')) {
			    jQuery('#simagd-edited-response-bs-alert').addFadeSlideEffect();
			}
            },
            error: function(e) {
			console.log('Se ha producido un error al confirmar cita');
			console.log(e.error);
			console.log(e.responseText);
			jQuery('#opcionesCita-modal').modal('hide');
			jQuery('#simagd-error-response-bs-alert').addFadeSlideEffect();
            }
    });
    
    return false;
}

function checkValidFechaHora(value, validator, $field) {
    // ... Do your logic checking
    moment.locale('es');
    
    console.log('value: ' + value);
    
    var $maxDate = moment(jQuery.trim($("#formCitFechaProximaConsulta").val()), "YYYY-MM-DD");
    var $dpDate = moment(jQuery.trim(value), 'YYYY-MM-DD HH:mm:ss');
    console.log('$maxDate: ' + $maxDate.format('YYYY-MM-DD'), '$dpDate: ' + $dpDate.format('YYYY-MM-DD'));
    
    if ($dpDate.format('YYYY-MM-DD') >= $maxDate.format('YYYY-MM-DD')) {
        return {
            valid: false,    // or false
            message: 'Excede próxima consulta'
        }
    }

    return true;
}