/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {
    
//    alert('Ejemplo de collapse con carret: \n http://siap.hsanrafael.simagdigital/app_dev.php/admin/rayos-x-solicitud-estudio/consultar?id=293848');

    $("input[id='" + $token + "_correlativo']")
	    .wrap("<div class='input-group primary-v4'></div>");
    $("input[id='" + $token + "_correlativo']")
	    .before(" <span class='input-group-addon'><i class='glyphicon glyphicon-bookmark'></i></span>");
	    
    
    /** off click for label in estudios */
    $('label[data-prevent-label-for="toggle"]:not([disabled])').off('click').on('click', function (e) {
//         e.stopImmediatePropagation();
	console.log('%c REMOVIDO PARA COLLAPSE PANELS', 'background: #000; color: #fff');
    });
    
    
    /** popover para muestra de datos de proyecciones */
    $('[data-toggle="popover"]').popover({
	html: true,
	/*placement: 'top',*/
	template: [
                    '<div class="popover popover-container-bigger-width" role="tooltip">',
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
		    return $(jQuery(this).data('contentwrapper')).html();
	}
    }).on('shown.bs.popover', function(e) {
	var $popover = jQuery(this);

	jQuery(this).parent().find('div.popover .show-estudio-padre-popover-action').on('click', function(e) {
	    ___actionProcedimientoRealizadoSetterObjectModalData($prc_object_data.prc_id, $prc_object_data, {});
	    jQuery('#procedimientoRealizadoFullData-showModalContainer').modal();
	    
	    return false;
	});

	jQuery(this).parent().find('div.popover .close-estudio-padre-popover-action, [data-dismiss="popover"]').on('click', function(e) {
	    $popover.popover('hide');
	    
	    return false;
	});
    })
    .click(function() {
	$('[data-toggle="popover"]')
	    .not(this)
		.popover('hide');
		
	return false;
    });

    /** Bloqueo de empleado */
    if ($is_admin === false) {
	$("select[id='" + $token + "_idEmpleado2']").select2()
		.on('select2-selecting', function(e) {
		    e.preventDefault();
		});
    }

    /** Bloqueo Estado */
    if ($("input[id='" + $token + "_setLockEstado']").val()) {
	$("select[id='" + $token + "_idEstadoLectura2']").select2()
		.on('select2-selecting', function(e) {
		    e.preventDefault();
		});
    }
    

    /** Validación de formulario de inserción/actualización */
    jQuery('#simagd_entity_full_admin_form').formValidation({
	framework: 'bootstrap',
	excluded: [':disabled'],
	icon: {
	    valid: 'glyphicon glyphicon-ok',
	    invalid: 'glyphicon glyphicon-remove',
	    validating: 'glyphicon glyphicon-refresh'
	},
	locale: 'es_ES',
	live: 'enabled',
	message: 'Valor introducido no es válido'
    })
    .on('err.field.fv', function(e, data) {
	// $(e.target)  --> The field element
	// data.fv      --> The FormValidation instance
	// data.field   --> The field name
	// data.element --> The field element

	var $tabPane = data.element.parents('.tab-pane'),
	    tabId    = $tabPane.attr('id');

	$('a[href="#' + tabId + '"][data-toggle="pill"]')
	    .parent()
	    .find('i')
	    .removeClass('fa-check')
	    .addClass('fa-times');

	/*console.log('err.field.fv');*/

	data.fv.disableSubmitButtons(false);
    })
    .on('success.field.fv', function(e, data) {
	// e, data parameters are the same as in err.field.fv event handler
	// Despite that the field is valid, by default, the submit button will be disabled if all the following conditions meet
	// - The submit button is clicked
	// - The form is invalid

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

	/*console.log('success.field.fv');*/
	
	data.fv.disableSubmitButtons(false);
    })
    .on('success.form.fv', function(e) {
	// Prevent form submission
	e.preventDefault();

	var $form = $(e.target),
	    fv    = $(e.target).data('formValidation');

	// Do whatever you want here ...
	/** before serializing form data */
	if ($("[id='" + $token + "_activarTranscripcion']").is(':checked'))
	{
	    $form.find('.summernote:enabled:not([readonly])').each(function() {
		jQuery(this).val(jQuery(this).summernote('code'));
		console.log(jQuery(this).attr('name'), ':enabled:not([readonly])');
// 		Submit no es permitido por summernote en LCT_EDIT
// 		Summernote con varios textarea genera error en submit en todos
// 		En submit aun si estan destruidos los summernote siguen dando problema, condicionar el success.form.fv
	    });
	}

	// Then submit the form as usual
	fv.defaultSubmit();
    });
    
	
    /** Validación para estado de lectura */
    $("select[id='" + $token + "_idEstadoLectura']").change(function() {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[observaciones]');
    });
    $(document).on('keyup change blur', "textarea[id='" + $token + "_observaciones']", function(e) {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstadoLectura]');
    });

});

function checkEstadoLectura(value, validator, $field) {
    /** begin callback function */
    var $textObsVal = jQuery.trim(value);
    var $optionEstadoVal = validator.getFieldElements($token + '[idEstadoLectura]').val();
    
    if ($optionEstadoVal == 5 || $optionEstadoVal == 6) {
	if ($textObsVal != null && $textObsVal.length >= 1) {
	    return true;
	}
	else {
	    return {
		valid: false,
		message: 'Estado seleccionado requiere descripción, por favor utilice este campo'
	    };
	}
    }
    else {
	return true;
    }
    /** end callback function */
}

/*
 * ******************************************************************************
 * form --| add new aditional study request
 * ******************************************************************************
 * @type String|String|String
 * ******************************************************************************
 */

/** action in form for submit */
var $action_solcmplFastRq = 'edit';

jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_solcmplFastRq 	= jQuery('#crearSolicitudEstudioComplementarioFastFormat-form');
    var $modal_solcmplFastRq 	= jQuery('#crearSolicitudEstudioComplementarioFastFormat-modal');
    
    jQuery('#formSolcmplFastRequestSolicitudEstudioProyeccion').change(function () {
        $modal_solcmplFastRq.modal('layout');
    });
  
    /** Tabla de solicitudes */
    var $table_solcmpl = jQuery('#table-lista-solicitudes-estudio-compl');

    $form_solcmplFastRq.formValidation({
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
		$modal_solcmplFastRq
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_solcmplFastRq
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
		$modal_solcmplFastRq
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_solcmplFastRq
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

	    var url   = $action_solcmplFastRq == 'edit' ? 'simagd_solicitud_estudio_complementario_editarSolicitudEstudioComplementarioFastFormat' : 'simagd_solicitud_estudio_complementario_crearSolicitudEstudioComplementarioFastFormat';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Solicitud' + ($action_solcmplFastRq == "edit" ? ' editada' : ' creada') + ' satisfactoriamente');
				$table_solcmpl.filter(':visible').bootstrapTable('refresh');
				$modal_solcmplFastRq.modal('hide');
				$action_solcmplFastRq == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_solcmplFastRq == "edit" ? ' editar' : ' crear') + ' solicitud');
				console.log(e.error);
				console.log(e.responseText);
				$modal_solcmplFastRq.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });

    $modal_solcmplFastRq.on('hide', function() {
        jQuery(this).fv_resetFormInModal();
    });

    jQuery('#btn_agregar_solcmplFastRequest:not([disabled])').click(function(e) {
        e.preventDefault();
	/** Validate form and submit by ajax */
	$action_solcmplFastRq = 'create';
	$form_solcmplFastRq.submit();
    });

    jQuery('#btn_editar_solcmplFastRequest:not([disabled])').click(function(e) {
        e.preventDefault();
	/** Validate form and submit by ajax */
	$action_solcmplFastRq = 'edit';
	$form_solcmplFastRq.submit();
    });

    /*
     ****************************************************************************
     * change event for areaServicioDiagnostico field
     ****************************************************************************
     */
    var $solcmplFastRq_fieldMdly    = jQuery('select[id="formSolcmplFastRequestIdAreaServicioDiagnostico"]');
    var $solcmplFastRq_fieldPry     = jQuery('select[id="formSolcmplFastRequestSolicitudEstudioProyeccion"]');

    /*
     * modality change event
     */
    $solcmplFastRq_fieldMdly.change(function(e, a, b) {
        var field_mld_val   = jQuery(this).val();   // modality val
        var field_pry_val   = $.map($solcmplFastRq_fieldPry.select2('val'), function(item) {
            return parseInt(item, 10);
        }); // proyections values, parse to integer

        $solcmplFastRq_fieldPry.find('option').prop('disabled', true);        // disable all options first
        $solcmplFastRq_fieldPry.select2('val', '').prop('disabled', true);    // remove selection
        /*
         * search in javascript object
         */
        var arr_pryResultValues = []; // array for values in cascade selection
        $.each(GROUP_DEPENDENT_ENTITIES, function(i, v) {
            if (i === 'm_expl') {
                $.each(v, function(x, y) {
                    if (y.id_m === parseInt(field_mld_val, 10)) {
                        arr_pryResultValues.push(y.id_expl); //push values here
                        $solcmplFastRq_fieldPry.find('option[value=' + y.id_expl + ']').prop('disabled', false);  // disable if option value is in result
                    }
                });
            }
        });
        var $arr_pry_finalValues    = $.fn.get_arrayIntersect({a: field_pry_val, b: arr_pryResultValues});  // get selection filtered by result
        if ($arr_pry_finalValues.length !== 0)
        {
            $solcmplFastRq_fieldPry
                    .select2('val', jQuery.unique($arr_pry_finalValues))
                    .prop('disabled', false);   // set selection and enable select2
        }
        if (jQuery.isEmptyObject(field_mld_val) === false)
        {
            $solcmplFastRq_fieldPry.prop('disabled', false); // enable select2
        }
        $form_solcmplFastRq.formValidation('revalidateField', 'formSolcmplFastRequestSolicitudEstudioProyeccion[]');   // revalidate select2
    });
    
    
    /*
     * **************************************************************************
     * aditional study request
     * **************************************************************************
     */
    jQuery('[data-add-new-request-for-study="true"]:not([disabled])').off('click').on('click', function (e) {
        e.stopImmediatePropagation();
        var $this       = jQuery(this),
            $study_rq_id    = $this.data('study-rq-id'),
            $study_id   = $this.data('study-id'),
            $study_url  = $this.data('study-url');
        var $modal      = jQuery('#crearSolicitudEstudioComplementarioFastFormat-modal'),
            $form       = jQuery('#crearSolicitudEstudioComplementarioFastFormat-form');
            console.log('%c no estan agregados los alert aqui', 'background: #576; color: #bada55');

        jQuery('#btn_descargar_estudio_solcmpl').attr('href', $study_url);
	$form.find(':input').each(function () {
	    var $field      = jQuery(this),
                $default    = $field.data('default');
            if (typeof $default !== "undefined" && $default !== null && $default !== "") {
                if ($field.is('input:text') || $field.is('textarea')) {
                    $field.val(jQuery.trim($default));
                }
                if ($field.is('select')) {
                    $field.select2('val', $default);
                    $field.trigger('change', [true, false]);    // --| Filtrar modalidad
                }
            }
            if ($field.attr('id') === 'formSolcmplFastRequestIdSolicitudEstudio') {
                $field.val($study_rq_id);
            }
            if ($field.attr('id') === 'formSolcmplFastRequestIdEstudioPadre') {
                $field.val($study_id);
            }
        });
        $modal.fv_resetFormInModal();
        $modal.modal();
    });
    
});