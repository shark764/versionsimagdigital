/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {

    /** Bloqueo de empleado */
    if ($is_admin === false && $current_action_form == "edit") {
	$("select[id='" + $token + "_idTecnologoRealiza2']").select2()
		.on('select2-selecting', function(e) {
		    e.preventDefault();
		});
    }

    /** Bloqueo Estado */
//     if ($("input[id='" + $token + "_setLockEstado']").val()) {
// 	$("select[id='" + $token + "_idEstadoProcedimientoRealizado']").select2()
// 		.on('select2-selecting', function(e) {
// 		    e.preventDefault();
// 		});
//     }
    

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
    });
    
	
    /** Validación para estado de procedimiento realizado */
    $("select[id='" + $token + "_idEstadoProcedimientoRealizado']").change(function() {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[incidencias]');
    });
    $(document).on('keyup change blur', "textarea[id='" + $token + "_incidencias']", function(e) {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstadoProcedimientoRealizado]');
    });
        
        
    /** Add event de los materiales */
    $(document).on('sonata.add_element', "[id^='field_container_'][id$='_materialUtilizadoV2']", function() {
	/** Table no bordered */
	$(document).find("[id^='field_container_'][id$='_materialUtilizadoV2']").find('table')
		.removeClass("table-bordered table-striped").addClass("table-hover table-condensed table-responsive");

	$("input:checkbox[id$='__delete']").addConfigICheck();

	$("select[id$='_idMaterial']").addConfigSelect2();

	jQuery(this).find(':input').each(function () {
	    var fieldName = jQuery(this).attr('name');
	    if (typeof fieldName  !== "undefined") {
		jQuery('#simagd_entity_full_admin_form').formValidation('addField', fieldName);
		console.log(fieldName);
	    }
	});

	$("select[id$='_idMaterial']").last().select2("search", "");
    });

    /** Borrar un material de la lista */
    $(document).on('ifChanged', "input:checkbox[id$='__delete']", function(e) {
	if (jQuery(this).is(':checked')) {
	    jQuery(this).parents("tr").find(':input').each(function () {
		var fieldName = jQuery(this).attr('name');
		if (typeof fieldName  !== "undefined") {
		    jQuery('#simagd_entity_full_admin_form').formValidation('resetField', fieldName).formValidation('removeField', fieldName);
		    console.log(fieldName);
		}
	    });

	    jQuery(this).parents("tr").remove();
	}
    });

    $.fn.addConfigICheck = function() {
	this.iCheck({
	    checkboxClass: 'icheckbox_minimal-red',
	    radioClass: 'iradio_minimal-red',
	});
    };

    $.fn.addConfigSelect2 = function() {
	this.select2({
	    placeholder: 'click para seleccionar...',
	    allowClear: true,
	    width: '225px',
	    dropdownAutoWidth : true
	});
    };

    $("input:checkbox[id$='__delete']").addConfigICheck();

    $("select[id$='_idMaterial']").addConfigSelect2();
    
    
    /** Table no bordered */
    $(document).find("[id^='field_container_'][id$='_materialUtilizadoV2']").find('table')
	    .removeClass("table-bordered table-striped").addClass("table-hover table-condensed table-responsive");
    
    /** Change event de los materiales seleccionados */
    $(document).on('change', "select[id$='_idMaterial']", function() {
	var fieldMaterialName = jQuery(this).attr('name');
	
	var $mtrlValuesArray = new Array();
	$mtrlValuesArray = jQuery(this).eachValuesArray({selector : "select[id$='_idMaterial']"});
	console.log($mtrlValuesArray);

	/** Evitar que pueda seleccionarse un material mas de una vez */
	var targetValue = jQuery(this).val() || '-1';
	var numOccurences = $.grep($mtrlValuesArray, function (elem) {
	    return elem === targetValue;
	}).length; // Returns num of ocurrences

	if (numOccurences > 1) {
	    jQuery(this).select2('val', '');

	    generarMensajeToast('error', 'Este material ya se encuentra seleccionado.', 'Error:');
	    
	    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', fieldMaterialName);
	    console.log(fieldMaterialName);
	}
	console.log($mtrlValuesArray, numOccurences);
    });
    
    
    /** popover para muestra de datos de proyecciones */
    $('[data-toggle="popover"]').popover({
	html: true,
	placement: 'top',
	template: [
		      '<div class="popover popover-container-bigger-width" role="tooltip">',
			  '<div class="arrow">',
			  '</div>',
			  '<h3 class="popover-title">',
			  '</h3>',
			  '<div class="popover-content">',
			  '</div>',
		      '</div>'
		  ].join(''),
	content: function() {
		    return $(jQuery(this).data('contentwrapper')).html();
	}
    })
    .click(function() {
	$('[data-toggle="popover"]')
	    .not(this)
		.popover('hide');
		
	return false;
    });
    
});

function checkEstadoProcedimientoRealizado(value, validator, $field) {
    /** begin callback function */
    var $textIncdsVal = jQuery.trim(value);
    var $optionEstadoVal = validator.getFieldElements($token + '[idEstadoProcedimientoRealizado]').val();
    
    if ($optionEstadoVal >= 6 && $optionEstadoVal <= 9) {
	if ($textIncdsVal != null && $textIncdsVal.length >= 1) {
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

function checkParentsProcedimientoRealizado(value, validator, $field) {
    /** begin callback function */
    var $prcSettedVal = $("[id='" + $token + "_idSolicitudEstudio']").val();
    var $solcmplSettedVal = $("[id='" + $token + "_idSolicitudEstudioComplementario']").val();

    // Solicitud de estudio padre
    if (!$prcSettedVal) {
	if ($solcmplSettedVal) {
	    return {
		valid: false,
		message: 'Debe existir una solicitud de estudio padre'
	    };
	}
	else {
	    return {
		valid: false,
		message: 'Debe existir una solicitud de estudio'
	    };
	}
    }
    
    return true;
    /** end callback function */
}