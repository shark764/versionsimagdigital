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

	data.fv.disableSubmitButtons(false);
    })
    .on('success.field.fv', function(e, data) {
	// e, data parameters are the same as in err.field.fv event handler
	// Despite that the field is valid, by default, the submit button will be disabled if all the following conditions meet
	// - The submit button is clicked
	// - The form is invalid
	data.fv.disableSubmitButtons(false);
    });
        
});