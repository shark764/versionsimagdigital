/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {
    
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
	    jQuery(this).val(jQuery(this).code());
	});

	// Then submit the form as usual
	fv.defaultSubmit();
    });
		
        
    /** Bootstrap DATETIMEPICKER */
    var $datePrxCsltField = $("input[id='" + $token + "_fechaProximaConsulta']");
    
    $datePrxCsltField.wrap("<div class='input-group'></div>");
    $datePrxCsltField
	    .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-large' id='showDateTimePicker'> <i class='glyphicon glyphicon-calendar'></i> </button> </span>");
	    
    $datePrxCsltField.datetimepicker({
	locale: 'es',
	format: 'YYYY-MM-DD',
	showTodayButton: true,
	showClear: true,
	showClose: true,
	ignoreReadonly: true/*,
	minDate: moment()*/
    }).on("dp.change", function (e) {
	jQuery(this).blur();
    }).on('dp.change dp.show', function(e) {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', jQuery(this).attr('name'));
    }).prev().click(function(e) {
	e.preventDefault();
	jQuery(this).next().data("DateTimePicker").show();
    });
    
    if ($prc_dateCreation !== false) {
	/** Asignar fecha mínima -> fecha de solicitud */
	var $prcYearCreation 	= $prc_dateCreation.getFullYear();
	var $prcMonthCreation 	= $prc_dateCreation.getMonth();
	var $prcDayCreation 	= $prc_dateCreation.getDate();
	
	$datePrxCsltField.data('DateTimePicker').minDate(new Date($prcYearCreation, $prcMonthCreation, $prcDayCreation));
    } else {
	$datePrxCsltField.data('DateTimePicker').minDate(moment());
    }

    
    /*
     * SUMMERNOTE for antecedentes clínicos
     */
    var $tx_antecedentes_field	= $("[id='" + $token + "_antecedentesClinicosRelevantes']");
    var $_antecedentes 		= $tx_antecedentes_field.val();
    $tx_antecedentes_field.buildSummerNote({ newOptions: {
	height: 150, 	// set editor height
	maxHeight: 200,	// set maximum height of editor
	focus: false, 	// set focus to editable area after initializing summernote
        ___toolbar  : 'expand', // toolbar
        ___speech   : true,     // active speech recognition
    }});
    if (jQuery.isEmptyObject(jQuery.trim($_antecedentes)) === false) {
	$tx_antecedentes_field.code($_antecedentes);
    }

    
    /*
     * SUMMERNOTE for indicaciones del estudio
     */
    var $tx_indicaciones_field	= $("[id='" + $token + "_indicacionesMedicoRadiologo']");
    var $_indicaciones 		= $tx_indicaciones_field.val();
    $tx_indicaciones_field.buildSummerNote({ newOptions: {
	height: 150, 	// set editor height
	maxHeight: 200,	// set maximum height of editor
	focus: false, 	// set focus to editable area after initializing summernote
        ___toolbar  : 'expand', // toolbar
        ___speech   : true,     // active speech recognition
    }});
    if (jQuery.isEmptyObject(jQuery.trim($_indicaciones)) === false) {
	$tx_indicaciones_field.code($_indicaciones);
    }


    /** Nombre del contacto */
    if ($id_exp !== false) {
	/** Nombre de la persona responsable */
	$("select[id='" + $token + "_idContactoPaciente']").change(function(e, a, b) {
	    if (jQuery(this).val() == 13) {  //El paciente
		$("input[id='" + $token + "_nombreContacto']").val($name_pct);
	    }
	});
    }
    
    /** Validación para información de contacto */
    $(document).on('change', "select[id='" + $token + "_idContactoPaciente']", function(e, a, b) {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[nombreContacto]');
    });
    $(document).on('change', "select[id='" + $token + "_idFormaContacto']", function(e, a, b) {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[contacto]');
    });
    
});

function checkValidReferido(value, validator, $field) {
    /** begin callback function */
    var $optStdrefVal	= validator.getFieldElements($token + '[idEstablecimientoReferido]').val();
    var $chkReqRef	= $("[id='" + $token + "_referirPaciente']");
    var $textJstfVal 	= jQuery.trim(validator.getFieldElements($token + '[justificacionReferencia]').val());
    
    if ($optStdrefVal != null && $optStdrefVal.length >= 1 && ($id_userEstab != value )) {
	if ($chkReqRef.is(':checked') && ($textJstfVal != null && $textJstfVal.length >= 1)) {
	    return true;
	}
	else {
	    return false;
	}
    }
    else {
	if ($chkReqRef.is(':checked') || ($textJstfVal != null && $textJstfVal.length >= 1)) {
	    return false;
	}
	else {
	    return true;
	}
    }
    /** end callback function */
}

function checkProyeccionesModalidad(value, validator, $field) {
    /** begin callback function */
    var options = validator.getFieldElements($token + '[solicitudEstudioProyeccion][]').val();   // Get the selected options
    return (options != null && options.length >= 1);
    /** end callback function */
}

function checkValidDiagnosticante(value, validator, $field) {
    /** begin callback function */
    var $optStdiagVal	= validator.getFieldElements($token + '[idEstablecimientoDiagnosticante]').val();
    var $chkReqDiag	= $("[id='" + $token + "_requiereDiagnostico']");
    var $textJstfVal 	= jQuery.trim(validator.getFieldElements($token + '[justificacionDiagnostico]').val());
    
    if ($optStdiagVal != null && $optStdiagVal.length >= 1) {
	if ($chkReqDiag.is(':checked') && ($textJstfVal != null && $textJstfVal.length >= 1)) {
	    return true;
	}
	else {
	    return false;
	}
    }
    else {
	if ($chkReqDiag.is(':checked') || ($textJstfVal != null && $textJstfVal.length >= 1)) {
	    return false;
	}
	else {
	    return true;
	}
    }
    /** end callback function */
}

function checkValidInfoContacto(value, validator, $field) {
    /** begin callback function */
    if (jQuery.trim(value) === '') { return true; }

    var $formaContVal = $("[id='" + $token + "_idFormaContacto']").val();

    var $regexEmailPattern = /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/;
    if ($formaContVal == 3 && !$regexEmailPattern.test(value)) {
	return {
	    valid: false,
	    message: 'No es una dirección de correo electrónico válida'
	};
    }

    var $regexPhonePattern = /\d{1}-{0,1}\d{3}-{0,1}\d{4}-{0,1}/;
    if (($formaContVal == 1 || $formaContVal == 2 ) && !$regexPhonePattern.test(value)) {
	return {
	    valid: false,
	    message: 'Número de teléfono no es válido'
	};
    }

    return true;
    /** end callback function */
}