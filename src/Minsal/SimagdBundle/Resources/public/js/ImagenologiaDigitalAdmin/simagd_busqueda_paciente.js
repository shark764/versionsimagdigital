/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {
    
    console.log('%c ADD BOTÓN PARA PODER VER TODAS LAS PROYECCIONES AL MOMENTO DE ELEGIR EN UNA SOLICITUD, EN UN MODAL', 'background: #000; color: #ff0922');

    /** local variable DOM objects */
    var $form_prcEmrgRq     = jQuery('#crearSolicitudEstudioFormatoRapido-form');
    var $modal_prcEmrgRq    = jQuery('#crearSolicitudEstudioFormatoRapido-modal');
  
    /** Tabla de exámenes pendientes */
    var $table_pndR         = jQuery('#table-lista-pendientes-realizar');
    
//    jQuery('#crearSolicitudEstudioFormatoRapido-modal').modal();
    jQuery('#formPrcEmergencyRequestSolicitudEstudioProyeccion').change(function () {
        $modal_prcEmrgRq.modal('layout');
    });
    
    /*
     * próxima consulta médica
     */
    $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.change", function (e) {
	jQuery(this).blur();
    }).on('dp.change dp.show', function(e) {
        $form_prcEmrgRq.formValidation('revalidateField', 'formPrcEmergencyRequestFechaProximaConsulta');
    }).prev().click(function(e) {
	e.preventDefault();
	jQuery(this).next().data("DateTimePicker").show();
	console.log(jQuery(this).next().attr('name') + ' displayed');
    });

    /*
     * field typeahead select event
     */
    $('.typeahead.explocal_navbar_typeahead')
            .filter(':not([disabled]):enabled:not([readonly])')
                    .on('myevt:ttsuggestion', function(e, ttevt, suggestion) {
                        jQuery('#btn_navbar_add_prc')
                            .attr('href', Routing.generate('simagd_solicitud_estudio_create',
                                    {
                                        __exp: jQuery.isEmptyObject(suggestion.exp_id) === false ? suggestion.exp_id : null
                                    }
                            ));

                        jQuery('#btn_navbar_add_prc').prop('disabled', false);
                        jQuery('#btn_navbar_add_prc')
                                .parents('li')
                                .removeClass('disabled');
                    })
                    .on('myevt:ttclear', function(e, ttevt, suggestion) {
                        jQuery('#btn_navbar_add_prc')
                            .attr('href', 'javascript:void(0)');

                        jQuery('#btn_navbar_add_prc').prop('disabled', true);
                        jQuery('#btn_navbar_add_prc')
                                .parents('li')
                                .addClass('disabled');
                    });

    $('.typeahead.explocal_navbar_typeahead')
        .filter(':not([disabled]):enabled:not([readonly])')
                .trigger('myevt:ttclear');

    $('.typeahead.explocal_navbar_typeahead').filter(':not([disabled]):enabled:not([readonly])').on('typeahead:render', function(ev, suggestions, flag, dataset) {
        if (jQuery.isEmptyObject(suggestions) === false)
        {
            var $tt_el = jQuery(this);
            jQuery(this).parents('.twitter-typeahead').find('a.tt-new-request-action').off('click').on('click', function (e) {
                e.stopImmediatePropagation();

                $tt_el.blur();

                var $btn_this   = jQuery(this);
        
                moment.locale('es');

                jQuery('#btn_agregar_prcEmergencyRequest').show();
                jQuery('#btn_editar_prcEmergencyRequest').hide();

//                    var $tt_expLocal    = null;
//                    $.each(suggestions, function (i, sgg) {
//                        if (sgg.exp_id == jQuery(this).data('exp-id')) {
//                            $tt_expLocal    = jQuery.extend(true, {}, sgg);
//                        }
//                    });

//                jQuery('#formPrcEmergencyRequestTitle').text('Registrar bloqueo en agenda');
                jQuery('#formPrcEmergencyRequestLabel').removeClass('label-element-v2')
                        .addClass('label-primary-v4').html($btn_this.closest('.tt-item-btn-group').data('pct-nombre') + ' <span class="badge badge-primary-v4" style="margin-left: 5px;">' + $btn_this.closest('.tt-item-btn-group').data('exp-numero') + '</span>');

                /*
                 * Emergencia
                 */
                $("input[id='formPrcEmergencyRequestEsEmergencia']").val(true);

                /*
                 * Expediente (local | ficticio)
                 */
                $("input[id='formPrcEmergencyRequestIdExpediente']").val($btn_this.closest('.tt-item-btn-group').data('exp-id'));
                /*
                 * Origen de la solicitud
                 */
                $("select[id='formPrcEmergencyRequestIdAreaAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdAreaAtencion']").data('default'));
                $("select[id='formPrcEmergencyRequestIdAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdAtencion']").data('default'));
                $("select[id='formPrcEmergencyRequestIdEmpleado']").select2('val', $("select[id='formPrcEmergencyRequestIdEmpleado']").data('default'));
                $("select[id='formPrcEmergencyRequestIdAreaAtencion']").trigger('change', [true, false]);    // --| Filtrar areaAtencion
                /*
                 * Estudio solicitado
                 */
                $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").select2('val', $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").data('default'));
                $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").trigger('change', [true, false]);    // --| Filtrar modalidad
                /*
                 * Requerimiento de prioridad
                 */
                $("select[id='formPrcEmergencyRequestIdPrioridadAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdPrioridadAtencion']").data('default'));
                $("select[id='formPrcEmergencyRequestSolicitudEstudioProyeccion']").select2('val', '');

                var $dt_proximaConsulta = moment().add(0, 'd');
                $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").val( $dt_proximaConsulta.format('YYYY-MM-DD'));
                $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").data("DateTimePicker").date($dt_proximaConsulta);

                $("textarea[id='formPrcEmergencyRequestDatosClinicos']").val('');
                $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestDatosClinicos', true, 'notEmpty');
                $("textarea[id='formPrcEmergencyRequestHipotesisDiagnostica']").val('');
                $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestHipotesisDiagnostica', true, 'notEmpty');
                $("textarea[id='formPrcEmergencyRequestInvestigando']").val('');
                $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestInvestigando', true, 'notEmpty');
                $("textarea[id='formPrcEmergencyRequestJustificacionMedica']").val('');
                $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestJustificacionMedica', true, 'notEmpty');

                $modal_prcEmrgRq.modal();

                /* Set the form no validated */
                $form_prcEmrgRq.data('formValidation').resetForm();

                $form_prcEmrgRq.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

                $modal_prcEmrgRq
                    .find(':submit')
                        .removeAttr('disabled')
                        .removeClass('disabled');
            });
            jQuery(this).parents('.twitter-typeahead').find('a.tt-new-full-request-action').off('click').on('click', function (e) {
                e.stopImmediatePropagation();

                $tt_el.blur();

                var $btn_this           = jQuery(this);
                
                /*
                 * Redirect page
                 * similar behavior as clicking on a link
                 */
                window.location.href    = Routing.generate('simagd_solicitud_estudio_create', { __exp: $btn_this.closest('.tt-item-btn-group').data('exp-id') });
            });
            jQuery(this).parents('.twitter-typeahead').find('a.tt-view-patient-studies-action').off('click').on('click', function (e) {
                e.stopImmediatePropagation();

                $tt_el.blur();

                var $btn_this   = jQuery(this);
                
                /*
                 * Redirect page
                 * similar behavior as clicking on a link
                 */
                window.location.href    = Routing.generate('simagd_estudio_list', { __exp: $btn_this.closest('.tt-item-btn-group').data('exp-id') });
            });
        }
    });
    $('.typeahead.explocal_navbar_typeahead').parents('.twitter-typeahead').find('.tt-menu').css('min-width', '640px');

    $form_prcEmrgRq
        // IMPORTANT: You must declare .on('init.field.fv')
        // before calling .formValidation(options)
        .on('init.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

            // You can retrieve the icon element by
            // $icon = data.element.data('fv.icon');

            $icon.on('click.clearing', function() {
                // Check if the field is valid or not via the icon class
                if ($icon.hasClass('glyphicon-remove')) {
                    // Clear the field
                    data.fv.resetField(data.element);
                }
            });
        })
        .formValidation({
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
		$modal_prcEmrgRq
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_prcEmrgRq
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
		$modal_prcEmrgRq
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_prcEmrgRq
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
		
	    var url   = $action_prcEmrgRq == 'edit' ? 'simagd_solicitud_estudio_editarSolicitudEstudioFormatoRapido' : 'simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Solicitud' + ($action_prcEmrgRq == "edit" ? ' editada' : ' creada') + ' satisfactoriamente');
				$table_pndR.filter(':visible').bootstrapTable('refresh');
				$modal_prcEmrgRq.modal('hide');
				$action_prcEmrgRq == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_prcEmrgRq == "edit" ? ' editar' : ' crear') + ' solicitud');
				console.log(e.error);
				console.log(e.responseText);
				$modal_prcEmrgRq.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });

    $modal_prcEmrgRq.on('hide', function() {
        jQuery(this).fv_hideFormInModal();
    });
    
    jQuery('#btn_agregar_prcEmergencyRequest:not([disabled])').click(function(e) {
        e.preventDefault();
	/** Validate form and submit by ajax */
	$action_prcEmrgRq = 'create';
	$form_prcEmrgRq.submit();
    });
	
    jQuery('#btn_editar_prcEmergencyRequest:not([disabled])').click(function(e) {
        e.preventDefault();
	/** Validate form and submit by ajax */
	$action_prcEmrgRq = 'edit';
	$form_prcEmrgRq.submit();
    });

    /*
     * unknown patient --| add to list
     */
    jQuery('#btn_unknown_patient_add_item').filter(':not([disabled])').click(function(e) {
        var $btn_this   = jQuery(this);

        moment.locale('es');

        jQuery('#btn_agregar_prcEmergencyRequest').show();
        jQuery('#btn_editar_prcEmergencyRequest').hide();

        jQuery('#formPrcEmergencyRequestLabel').removeClass('label-element-v2')
                .addClass('label-primary-v4').html('Paciente desconocido' + ' <span class="badge badge-primary-v4" style="margin-left: 5px;"> NI-####-## </span>');

        $("input[id='formPrcEmergencyRequestId']").val('');

        /*
         * Expediente (local | ficticio)
         */
        $("input[id='formPrcEmergencyRequestIdExpediente']").val('');

        /*
         * Emergencia
         */
        $("input[id='formPrcEmergencyRequestEsEmergencia']").val(true);

        /*
         * Origen de la solicitud
         */
        $("select[id='formPrcEmergencyRequestIdAreaAtencion']").select2('val', '2');
        $("select[id='formPrcEmergencyRequestIdAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdAtencion']").data('default'));
        $("select[id='formPrcEmergencyRequestIdEmpleado']").select2('val', $("select[id='formPrcEmergencyRequestIdEmpleado']").data('default'));
        $("select[id='formPrcEmergencyRequestIdAreaAtencion']").trigger('change', [true, false]);    // --| Filtrar areaAtencion
        /*
         * Estudio solicitado
         */
        $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").select2('val', $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").data('default'));
        $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").trigger('change', [true, false]);    // --| Filtrar modalidad
        /*
         * Requerimiento de prioridad
         */
        $("select[id='formPrcEmergencyRequestIdPrioridadAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdPrioridadAtencion']").data('default'));
        $("select[id='formPrcEmergencyRequestSolicitudEstudioProyeccion']").select2('val', '');

        var $dt_proximaConsulta = moment().add(0, 'd');
        $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").val( $dt_proximaConsulta.format('YYYY-MM-DD'));
        $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").data("DateTimePicker").date($dt_proximaConsulta);

        $("textarea[id='formPrcEmergencyRequestDatosClinicos']").val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestDatosClinicos', false, 'notEmpty');
        $("textarea[id='formPrcEmergencyRequestHipotesisDiagnostica']").val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestHipotesisDiagnostica', false, 'notEmpty');
        $("textarea[id='formPrcEmergencyRequestInvestigando']").val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestInvestigando', false, 'notEmpty');
        $("textarea[id='formPrcEmergencyRequestJustificacionMedica']").val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestJustificacionMedica', false, 'notEmpty');

        $modal_prcEmrgRq.modal();

        /* Set the form no validated */
        $form_prcEmrgRq.data('formValidation').resetForm();

        $form_prcEmrgRq.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

        $modal_prcEmrgRq
            .find(':submit')
                .removeAttr('disabled')
                .removeClass('disabled');

    });

    $("#limitarResultados").select2({
        maximumSelectionSize: 1
    });
    
    $("#fechaNacimiento").datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.change", function (e) {
        jQuery(this).blur();
    }).on('dp.change dp.show', function(e) {
        jQuery('#formBusquedaPaciente').formValidation('revalidateField', 'fechaNacimiento');
    }).prev().click(function(e) {
        e.preventDefault();
        jQuery(this).next().data("DateTimePicker").show();
        console.log(jQuery(this).next().attr('name') + ' displayed');
    });
        
    $("button[id='limpiar-form']").click(function() {
        $("form[id='formBusquedaPaciente']").data('formValidation').resetForm();
        $("form[id='formBusquedaPaciente']").get(0).reset();
        $("select[id='limitarResultados']").select2('val', '');
    });
    
    $("button[id='limpiar-resultados']").click(function() {
        $("div[id='container_resultado_busquedaPaciente']").fadeOut("fast");
        $("div[id='container_menu_historiaImagenologica']").fadeOut("fast");
    });
    
    $(document).on('click', "a[id='volver-resultado-busqueda']", function(e) {
        e.preventDefault();
        
        $("div[id='container_resultado_busquedaPaciente']").fadeIn("fast");
        $("div[id='container_menu_historiaImagenologica']").fadeOut("fast");
    });
    
    jQuery('#formBusquedaPaciente').formValidation({
            excluded: [':disabled'],
	    locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Some instances you can use are
            var $form = $(e.target),        // The form instance
                fv    = $(e.target).data('formValidation'); // FormValidation instance
                
	    var $formParam_object = $form.formParams();
	    console.log($formParam_object);
	    
	    if (!$form.checkIfEmptyForm()) {
		$("div[id='container_resultado_busquedaPaciente']").fadeIn("fast");
                $("div[id='container_menu_historiaImagenologica']").fadeOut("fast");
		jQuery('#table-resultado-busqueda').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_resultadosBusquedaPaciente', $formParam_object) });
		
		generarMensajeToast('notice', 'Espere mientras se cargan los resultados.', 'Su búsqueda ha finalizado:');
	    } else {
		generarMensajeToast('error', 'Formulario vacío.', 'Error en la búsqueda:');
	    }
        })
        /*
         * apply mask
         */
        .find('[id="dui"]').mask('99999999-9', {placeholder: "________-_"});
    
});

function checkValidDUI(value, validator, $field) {
    /** begin callback function */
    if (value === '') { return true; }
                                    
    return $field.isValidDUI() ? true : false;
}

function getSearchExpedienteSourceTemplate(item) {
    var $edad   = jQuery.isEmptyObject(item.pct_edad) === false ? item.pct_edad.y + ' Años, ' + item.pct_edad.m + ' meses, ' + item.pct_edad.d + ' días' : 'desconocida';
    
    return [
        '<div class="expand-box tt-item-btn-group" style="" data-exp-id="' + item.exp_id + '" data-exp-numero="' + item.exp_numero + '" data-pct-id="' + item.pct_id + '" data-pct-nombre="' + item.pct_nombreCompleto + '">',
            '<span style="">',
                item.pct_nombreCompleto,
            '</span>',
            '<div class="btn-toolbar" role="toolbar" aria-label="..." style="float: right; margin-top: 1.2px;">',
                '<div class="btn-group" role="group">',
                    '<a   class="tt-new-request-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Solicitar estudio (Formato rápido)"' + ($isGranted_studyRequest === false ? ' disabled="disabled"' : '') + '>',
                        '<i class="glyphicon glyphicon-send"></i>',
                    '</a>',
                '</div>',
                '<div class="btn-group" role="group">',
                    '<a   class="tt-new-full-request-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Solicitar estudio (Formato detallado)"' + ($isGranted_studyRequest === false ? ' disabled="disabled"' : '') + '>',
                        '<i class="glyphicon glyphicon-edit"></i>',
                    '</a>',
                '</div>',
                '<div class="btn-group" role="group">',
                    '<a   class="tt-view-patient-studies-action btn btn-element-v2 btn-outline btn-xs" href="javascript:void(0)" title="Consulta de estudios de paciente"' + ($isGranted_studyView === false ? ' disabled="disabled"' : '') + '>',
                        '<i class="glyphicon glyphicon-eye-open"></i>',
                    '</a>',
                '</div>',
            '</div>',
            '<span class="label label-default-v2" style="float: right; margin-top: 5px; min-width: 175px; margin-right: 12px; text-align: left;">',
                '[Edad: ' + $edad + ']',
            '</span>',
            '<span class="label label-element-v2" style="float: right; margin-top: 5px; min-width: 72px; margin-right: 12px; text-align: left;">',
                '[' + item.exp_numero + ']',
            '</span>',
        '</div>'
    ].join('\n');
}