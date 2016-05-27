/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/** action in form for submit */
var $action_bl = 'edit';

jQuery(document).ready(function() {
    
    /** DOM elements */
    var $form_blAgd 	= jQuery('#crearBloqueoForm');
    var $modal_blAgd 	= jQuery('#crearBloqueo-modal');
    
    $form_blAgd.formValidation({
            excluded: [':disabled'],
	    locale: 'es_ES'
        })
        // Called when a field is invalid
        .on('err.field.fv', function(e, data) {
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
                tabId    = $tabPane.attr('id');

            $('a[href="#' + tabId + '"][data-toggle="pill"]')
                .parent()
                .find('i')
                .removeClass('fa-check')
                .addClass('fa-times');
            
            if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
		$modal_blAgd
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_blAgd
		    .find(':submit')
                        .removeAttr('disabled')
                        .removeClass('disabled');
	    }
        
            /*console.log('err.field.fv');*/
        })
        // Called when a field is valid
        .on('success.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.element --> The field element
            // The success.field.fv is triggered when a field is valid
            // data.field ---> the field name
            // data.fv    ---> the plugin instance which you can call some APIs on

            if (data.field === 'formBlAgdFechaInicio' && !data.fv.isValidField('formBlAgdFechaFin')) {
                // We need to revalidate the end date
                data.fv.revalidateField('formBlAgdFechaFin');
            }

            // Do the same check for the end date
            if (data.field === 'formBlAgdFechaFin' && !data.fv.isValidField('formBlAgdFechaInicio')) {
                // We need to revalidate the start date
                data.fv.revalidateField('formBlAgdFechaInicio');
            }

            var $tabPane = data.element.parents('.tab-pane'),
                tabId    = $tabPane.attr('id'),
                $icon    = $('a[href="#' + tabId + '"][data-toggle="pill"]')
                            .parent()
                            .find('i')
                            .removeClass('fa-check fa-times');

            // Check if all fields in tab are valid
            var isValidTab = data.fv.isValidContainer($tabPane);
            if (isValidTab !== null) {
                $icon.addClass(isValidTab ? 'fa-check' : 'fa-times');
            }
            
            if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
		$modal_blAgd
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_blAgd
		    .find(':submit')
                        .removeAttr('disabled')
                        .removeClass('disabled');
	    }
        
            /*console.log('success.field.fv');*/
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $form.data('formValidation');
		
	    var url   = $action_bl == 'edit' ? 'simagd_bloqueo_agenda_actualizarBloqueo' : 'simagd_bloqueo_agenda_nuevoBloqueo';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Bloqueo' + ($action_bl == "edit" ? ' actualizado' : ' agregado') + ' satisfactoriamente');
				jQuery('#calendar:not([disabled])')
					.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
					    .popover('hide');
				jQuery('#calendar:not([disabled])').fullCalendar('refetchEvents');
				jQuery('#table-lista-bloqueos:visible').bootstrapTable('refresh');
				$modal_blAgd.modal('hide');
				$action_bl == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_bl == "edit" ? ' actualizar' : ' agregar') + ' bloqueo');
				console.log(e.error);
				console.log(e.responseText);
				$modal_blAgd.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_blAgd.on('hide', function() {
	$form_blAgd.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#formBlAgdColor').colorpicker({
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
        $form_blAgd.formValidation('revalidateField', 'formBlAgdColor');
    });

    jQuery('#formBlAgdFechaInicio, #formBlAgdFechaFin').datetimepicker({
	locale: 'es',
	format: 'YYYY-MM-DD',
	showTodayButton: true,
	showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.change", function (e) {
        jQuery(this).blur();
    }).on('dp.change dp.show', function(e) {
        $form_blAgd.formValidation('revalidateField', jQuery(this).attr('name'));
    });

    jQuery('#formBlAgdHoraInicio, #formBlAgdHoraFin').datetimepicker({
	locale: 'es',
	format: 'HH:mm',
//	showTodayButton: true,
	showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.hide", function (e) {
        jQuery(this).blur();
    }).on('dp.change dp.hide dp.show', function(e) {
        $form_blAgd.formValidation('revalidateField', jQuery(this).attr('name'));
    });
    
    /** range DOM */
    var $allDay_field	= $("input:checkbox[id='formBlAgdDiaCompleto']"),
	$timeIni_field 	= $("[id='formBlAgdHoraInicio']"),
	$timeFin_field 	= $("[id='formBlAgdHoraFin']");
    
    $allDay_field.on('ifChanged', function(e) {
        
        if (jQuery(this).is(':checked')) {
	    var $allDay_timeFormat = moment("00:00:00", "HH:mm:ss");
	    
	    $timeIni_field.val($allDay_timeFormat.format('HH:mm'));
	    $timeIni_field.data("DateTimePicker").date($allDay_timeFormat);
	    
	    $timeFin_field.val($allDay_timeFormat.format('HH:mm'));
	    $timeFin_field.data("DateTimePicker").date($allDay_timeFormat);
        } else {
	    var $default_timeFormat = moment("06:00:00", "HH:mm:ss");
	    
	    $timeIni_field.val($default_timeFormat.format('HH:mm'));
	    $timeIni_field.data("DateTimePicker").date($default_timeFormat);
	    
	    $timeFin_field.val($default_timeFormat.add(12, 'hours').format('HH:mm'));
	    $timeFin_field.data("DateTimePicker").date($default_timeFormat);
        }
	
	$form_blAgd.formValidation('resetField', 'formBlAgdHoraInicio');
	$form_blAgd.formValidation('resetField', 'formBlAgdHoraFin');
        
    });
    
    jQuery('#btn_agregar_blAgd:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_bl = 'create';
	
	var $form = $form_blAgd;
        $form.submit();
        
    });
    
    jQuery('#navbar_btn_crearBloqueo:not([disabled])').click(function(e) {
        jQuery('#btn_agregar_blAgd').show();
        jQuery('#btn_editar_blAgd').hide();

        jQuery('#formBlAgdTitle').text('Registrar bloqueo en agenda');
        jQuery('#formBlAgdLabel').removeClass('label-element-v2')
		.addClass('label-primary-v2').text('Formulario para registro');

        $("input[id='formBlAgdId']").val('');
        $("input[id='formBlAgdTitulo']").val('');
        $("select[id='formBlAgdIdAreaServicioDiagnostico']").select2('val', '');
        $("select[id='formBlAgdIdRadiologoBloqueo']").select2('val', '');

        $("input[id='formBlAgdFechaInicio']").val('');
        $("input[id='formBlAgdFechaInicio']").data("DateTimePicker").clear();

        $("input[id='formBlAgdFechaFin']").val('');
        $("input[id='formBlAgdFechaFin']").data("DateTimePicker").clear();

        $("input[id='formBlAgdHoraInicio']").val('');
        $("input[id='formBlAgdHoraInicio']").data("DateTimePicker").clear();

        $("input[id='formBlAgdHoraFin']").val('');
        $("input[id='formBlAgdHoraFin']").data("DateTimePicker").clear();

        $("input[id='formBlAgdDiaCompleto']").iCheck('uncheck');
        $("input[id='formBlAgdColor']").val('');
        $("input[id='formBlAgdColor']").colorpicker('setValue', '#ffffff');
        $("textarea[id='formBlAgdDescripcion']").val('');

        $modal_blAgd.modal();

        /* Set the form no validated */
	$form_blAgd.data('formValidation').resetForm();
	
	$form_blAgd.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	$modal_blAgd
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_editar_blAgd:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_bl = 'edit';
	
	var $form = $form_blAgd;
        $form.submit();
        
    });
    
});

var TIME_PATTERN = /^(0?[0-9]|1[0-9]|2[0-3])(:[0-5]\d)$/;

function checkHoraInicio(value, validator, $field) {
    var endTime = validator.getFieldElements('formBlAgdHoraFin').val();
    if (endTime === '' || !TIME_PATTERN.test(endTime)) {
        return true;
    }
    
    var $chk_allDay_field	= $("[id='formBlAgdDiaCompleto']");
    
    if ($chk_allDay_field.is(':checked')) {
	return null;
    }
    
    var startHour    = parseInt(value.split(':')[0], 10),
        startMinutes = parseInt(value.split(':')[1], 10),
        endHour      = parseInt(endTime.split(':')[0], 10),
        endMinutes   = parseInt(endTime.split(':')[1], 10);

    if (startHour < endHour || (startHour == endHour && startMinutes < endMinutes)) {
        // The end time is also valid
        // So, we need to update its status
        validator.updateStatus('formBlAgdHoraFin', validator.STATUS_VALID, 'callback');
        return true;
    }

    return false;
}

function checkHoraFin(value, validator, $field) {
    var startTime = validator.getFieldElements('formBlAgdHoraInicio').val();
    if (startTime == '' || !TIME_PATTERN.test(startTime)) {
        return true;
    }
    
    var $chk_allDay_field	= $("[id='formBlAgdDiaCompleto']");
    
    if ($chk_allDay_field.is(':checked')) {
	return null;
    }
    
    var startHour    = parseInt(startTime.split(':')[0], 10),
        startMinutes = parseInt(startTime.split(':')[1], 10),
        endHour      = parseInt(value.split(':')[0], 10),
        endMinutes   = parseInt(value.split(':')[1], 10);

    if (endHour > startHour || (endHour == startHour && endMinutes > startMinutes)) {
        // The start time is also valid
        // So, we need to update its status
        validator.updateStatus('formBlAgdHoraInicio', validator.STATUS_VALID, 'callback');
        return true;
    }

    return false;
}