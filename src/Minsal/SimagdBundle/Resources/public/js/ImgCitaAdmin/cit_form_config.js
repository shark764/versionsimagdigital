/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/** action in form for submit */
var $action_cit = 'edit';

jQuery(document).ready(function() {
    
    /** DOM elements */
    var $form_cit 	= jQuery('#editarCitaForm');
    var $modal_cit 	= jQuery('#editarCita-modal');
    var $form_citCl 	= jQuery('#cancelarCitaForm');
    var $modal_citCl	= jQuery('#cancelarCita-modal');
    var $modal_citOpc	= jQuery('#opcionesCita-modal');
    
    $form_cit.formValidation({
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
		$modal_cit
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_cit
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

            if (data.field === 'formCitFechaHoraInicio' && !data.fv.isValidField('formCitFechaHoraFin')) {
                // We need to revalidate the end date
                data.fv.revalidateField('formCitFechaHoraFin');
            }

            if (data.field === 'formCitFechaHoraFin' && !data.fv.isValidField('formCitFechaHoraInicio')) {
                // We need to revalidate the start date
                data.fv.revalidateField('formCitFechaHoraInicio');
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
		$modal_cit
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_cit
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
		
	    var url   = $action_cit == 'edit' ? 'simagd_cita_editarCita' : 'simagd_cita_insertarCita';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Cita' + ($action_cit == "edit" ? ' editada' : ' insertada') + ' satisfactoriamente');
		    // 		jQuery('#calendar:not([disabled])').fullCalendar('removeEvents', event_id);
				jQuery('#calendar:not([disabled])')
					.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
					    .popover('hide');
				jQuery('#calendar:not([disabled])').fullCalendar('refetchEvents');
				$modal_cit.modal('hide');
				$modal_citOpc.modal('hide');
				jQuery('#table-lista-citas:visible').bootstrapTable('refresh');
				$action_cit == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_cit == "edit" ? ' editar' : ' insertar') + ' cita');
				console.log(e.error);
				console.log(e.responseText);
				$modal_cit.modal('hide');
				$modal_citOpc.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_cit.on('hide', function() {
	$form_cit.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_detalle_cit_modal:not([disabled])').click(function(e) {
	console.log('modal show cita show -> $current_eventObject');
	console.log($current_eventObject);
	/** full dataset and show modal */
	___actionCitaSetterObjectModalData($current_eventObject.cit_id, $current_eventObject, {});
        jQuery('#citaFullData-showModalContainer').modal();
    });
    
    jQuery('#btn_editar_cit_modal:not([disabled])').click(function(e) {
	console.log('modal edit cita show -> $current_eventObject');
	console.log($current_eventObject);
	___setDataEditCitForm(e, $current_eventObject.cit_id, $current_eventObject, $current_eventObject.cit_id);
    });
    
    $modal_citCl.on('hide', function() {
	$form_citCl.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_cancelar_cit_modal:not([disabled])').click(function(e) {
	console.log('modal cancel cita show -> $current_eventObject');
	console.log($current_eventObject);
	___setDataCancelCitForm(e, $current_eventObject.cit_id, $current_eventObject, $current_eventObject.cit_id);
    });
    
    $form_citCl.formValidation({
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
		$modal_citCl
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_citCl
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
		$modal_citCl
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_citCl
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
		
	    var event_id = $("#formCancelCitId").val();

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate('simagd_cita_cancelarCita'),
		    data: $form_citCl.formParams(),
		    success: function(response) {
				console.log('Cita cancelada satisfactoriamente');
				$modal_citCl.modal('hide');
				$modal_citOpc.modal('hide');
				jQuery('#calendar:not([disabled])')
					.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
					    .popover('hide');
				jQuery('#calendar:not([disabled])').fullCalendar('removeEvents', event_id);
		//                 jQuery('#calendar:not([disabled])').fullCalendar('refetchEvents');
				jQuery('#table-lista-citas:visible').bootstrapTable('refresh');
				if (jQuery('#table-lista-citas').is(':visible')) {
				    $edited_bsAlert.addFadeSlideEffect();
				}
		    },
		    error: function(e) {
				console.log('Se ha producido un error al cancelar cita');
				console.log(e.error);
				console.log(e.responseText);
				$modal_citCl.modal('hide');
				$modal_citOpc.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    jQuery('#formCitIdEstadoCita').change(function() {
        var $razonAnulacion = jQuery('#divformCitRazonAnulada');
        var codEstado = jQuery.trim(jQuery(this).find(':selected').data('codigo'));
        var $field = $("textarea[id='formCitRazonAnulada']");
        
        if (jQuery.inArray(codEstado, ["CNL", "ANL"]) !== -1) {
            $field.prop('readonly', false);
            if (!jQuery.trim($field.val())) {
                $field.val(jQuery.trim($razonAnulacion.data("razon-previa")));
            }
        } else {
            $field.prop('readonly', true);
            $field.val('');
        }
        /** Reiniciar validator */
        $form_cit.data('formValidation').updateStatus('formCitRazonAnulada', 'NOT_VALIDATED');
	
	$modal_cit
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    jQuery('#formCitIdEstadoCita').trigger("change");
    
});

//http://eonasdan.github.io/bootstrap-datetimepicker/Functions/#minmaxdate
//http://formvalidation.io/validators/date/#custom-format-example
//http://formvalidation.io/validators/date/
//http://formvalidation.io/settings/#dynamic-option
//http://formvalidation.io/examples/validating-fields-depend-each-other/
//http://formvalidation.io/examples/validating-start-end-datetimes/