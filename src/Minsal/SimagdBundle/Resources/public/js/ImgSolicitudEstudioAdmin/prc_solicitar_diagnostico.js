/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*(function($) {
    $.fn.checking = function() {
        if ($(":checkbox[id$='_referirPaciente']").prop('checked') === true) {  alert('yeah check'); }
        else { alert('yeah no check'); }
    };
})(jQuery);

jQuery(document).ready(function() {
    $("input:checkbox[id='" + $token + "_referirPaciente']").bind('click', function(e, a, b) {
        jQuery(this).checking();        
        //var $stdiagField = $("select[id='" + $token + "_idEstablecimientoDiagnosticante']");
        //(jQuery(this).val() == 1) ? $stdiagField.attr('disabled', false) : $stdiagField.attr('disabled', true);
    });
});
*/
//https://github.com/fronteed/iCheck/issues/68
//http://stackoverflow.com/questions/17820080/function-select-all-and-icheck

jQuery(document).ready(function() {
    /** stdiag DOM */
    var $stdiagField 		= $("select[id='" + $token + "_idEstablecimientoDiagnosticante']");
    var $chkReqDiagField 	= $("input:checkbox[id='" + $token + "_requiereDiagnostico']");
    var $txtJstfDiagField 	= $("textarea[id='" + $token + "_justificacionDiagnostico']");
    
    $chkReqDiagField.on('ifChanged', function(e, a, b) {
        
        if (!jQuery(this).is(':checked')) {
            //Bloquear establecimientos
            $stdiagField.find('option').prop('disabled', true);
            $stdiagField.select2('val', '');
        }
        else {
            $stdiagField.find('option').prop('disabled', false);
            
            if (!$stdiagField.val()) {
                $stdiagField.select2("search", "");
            }
        }
        jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstablecimientoDiagnosticante]');
	
	if (typeof a !== "undefined" && a !== false) {
            jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
	    console.log('resetForm on body load: _requiereDiagnostico', a);
	}
        
    });
    $chkReqDiagField.trigger('ifChanged', [true, false]);
    
    
    /** Validación para solicitar modalidad */
    $stdiagField.on('change', function(e, a, b) {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idAreaServicioDiagnostico]');
	
	if (typeof a !== "undefined" && a !== false) {
            jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
	    console.log('resetForm on body load: _idEstablecimientoDiagnosticante', a);
	}
    });
    
    /** Validación para requerir diagnóstico */
    $txtJstfDiagField.on('keyup change blur', function(e, a, b) {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstablecimientoDiagnosticante]');
    });
    
});

/**
 * obtener especialidad_estab de sesion
 *  ServicioMedicoEstablecimiento twig
 *  MntAtenAreaModEstabAdminController
 *  GeneralesController
 */