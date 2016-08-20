/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Function encargada de hacer el request al action, y filtra las proyecciones pertenecientes a la modalidad, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.

var $isNewPry_added = false;

jQuery(document).ready(function() {

    /** Bloqueo de empleado */
    if ($is_admin === false) {
	$("select[id='" + $token + "_idRadiologoSolicita2']").select2()
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
	$form.find('.summernote:enabled:not([readonly])').each(function() {
	    jQuery(this).val(jQuery(this).summernote('code'));
	    console.log(jQuery(this).attr('name'), ':enabled:not([readonly])');
	});

	// Then submit the form as usual
	fv.defaultSubmit();
    });

    
    /*
     * SUMMERNOTE for indicaciones del estudio
     */
    var $tx_indicaciones_field	= $("[id='" + $token + "_indicacionesEstudio']");
    var $_indicaciones 		= $tx_indicaciones_field.val();
    $tx_indicaciones_field.buildSummerNote({ newOptions: {
	height: 150, 	// set editor height
	maxHeight: 200,	// set maximum height of editor
	focus: false, 	// set focus to editable area after initializing summernote
        ___toolbar  : 'expand', // toolbar
        ___speech   : true,     // active speech recognition
    }});
    if (jQuery.isEmptyObject(jQuery.trim($_indicaciones)) === false) {
	$tx_indicaciones_field.summernote('code', $_indicaciones);
    }
    
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

function checkSolcmplParentData(value, validator, $field) {
    /** begin callback function */
    var $estSettedVal = $("[id='" + $token + "_idEstudioPadre']").val();
    var $prcSettedVal = $("[id='" + $token + "_idSolicitudEstudio']").val();
    var $stdSettedVal = $("[id='" + $token + "_idEstablecimientoSolicitado']").val();

    // Estudio solicitado
    if (!$estSettedVal) {
	return {
	    valid: false,
	    message: 'Estudio que desea complementar no ha sido especificado'
	};
    }

    // Solicitud de estudio padre
    if (!$prcSettedVal) {
	return {
	    valid: false,
	    message: 'Debe existir una solicitud de estudio padre'
	};
    }

    // Establecimiento solicitado
    if (!$stdSettedVal) {
	return {
	    valid: false,
	    message: 'Establecimiento al que solicita no ha sido especificado'
	};
    }
    
    return true;
    /** end callback function */
}

function checkProyeccionesModalidad(value, validator, $field) {
    /** begin callback function */
    var options = validator.getFieldElements($token + '[solicitudEstudioComplementarioProyeccion][]').val();   // Get the selected options
    return (options != null && options.length >= 1);
    /** end callback function */
}