/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Function encargada de hacer el request al action, y llenar el select con las modalidades regresadas, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.

var $isForm_notValidated    = true;
var $isNewPry_added         = false;

jQuery(document).ready(function() {
    
    /** stdref DOM */
    var $stdrefField            = $("select[id='" + $token + "_idEstablecimientoReferido']");
    
    /*
     * referido change event
     */
    $stdrefField.change(function(e, a, b) {
        var field_stdref_val    = jQuery(this).val();
        var field_atn_val       = '97';
        var $fieldModality      = $("select[id='" + $token + "_idAreaServicioDiagnostico']");
	var field_mld_val       = $fieldModality.val();
	
	if (jQuery.isEmptyObject(field_stdref_val) === false)
        {
            $fieldModality.find('option:gt(0)').prop('disabled', true);
            $fieldModality.select2('val', '').prop('disabled', true);

            var $getJSON_url        = 'simagd_solicitud_estudio_cargarDatosPorFiltro';  // --| url to get the sources
            /*
             * get sources from remote
             */
            $.getJSON(Routing.generate($getJSON_url), {
                param_filterA : field_stdref_val,
                param_filterB : field_atn_val,
                selector : 'rz',
            })
            .done(function(data) {
                if (data.status === 'OK')
                {
                    /*
                     * default event action
                     */
                    $fieldModality.prop('disabled', false);
                    /*
                     * enable options that matching data
                     */
                    $.each(data.results, function(i, r) {
                        $fieldModality.find('option[value=' + this.value + ']').prop('disabled', false);
			if (jQuery.isEmptyObject(field_mld_val) === false && parseInt(field_mld_val, 10) === this.value)
			{
			    $fieldModality.select2('val', this.value);
			}
                    });

                    var $fieldDiagnosticante = $("select[id='" + $token + "_idEstablecimientoDiagnosticante']");
                    if (!$fieldDiagnosticante.val() && $("input:checkbox[id='" + $token + "_requiereDiagnostico']").is(':checked')) {
                        $fieldDiagnosticante.select2('val', field_stdref_val);
                    }

                    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idAreaServicioDiagnostico]');
                    $fieldModality.trigger('change', [a, b]);

                    if (typeof a !== "undefined" && a !== false) {
                        jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                        console.log('resetForm on body load: _idEstablecimientoReferido', a);
                    }
                }
            })
            .fail(function(jqxhr, textStatus, error) {
                console.log(error);
                console.log(textStatus);
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idAreaServicioDiagnostico]');

                if (typeof a !== "undefined" && a !== false) {
                    jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                    console.log('resetForm on body load: _idEstablecimientoReferido', a);
                }
            });
        }
        else
        {
            $fieldModality.select2('val', '');
            $fieldModality.find('option:gt(0)').prop('disabled', true);
	    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idAreaServicioDiagnostico]');
	    $fieldModality.trigger('change', [a, b]);
	    
	    if (typeof a !== "undefined" && a !== false) {
                jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
		console.log('resetForm on body load: _idEstablecimientoReferido', a);
	    }
        }
    });
    
    
    /** Obtener check para establecimiento local/externo */
    var $refExtChkField 	= $("input:checkbox[id='" + $token + "_referirPaciente']");
    var $txtJstfRefExtField 	= $("textarea[id='" + $token + "_justificacionReferencia']");
    
    /*
     * ifChanged event on iCheck
     */
    $refExtChkField.on('ifChanged', function(e, a, b) {
	if (!jQuery(this).is(':checked')) {
	    //Asignar el establecimiento por defecto
	    $stdrefField.select2('val', $id_userEstab);
	    $stdrefField.find('option:gt(0):not(:selected)').prop('disabled', true);
	    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstablecimientoReferido]');
	    $stdrefField.trigger('change', [a, b]);
	}
	else {
	    $stdrefField.find('option').prop('disabled', false);
	    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstablecimientoReferido]');
	    $stdrefField.trigger('change', [a, b]);

	    if (!$stdrefField.val() || $stdrefField.val() == $id_userEstab) {
		$stdrefField.select2("search", "");
	    }
	}
	
	if (typeof a !== "undefined" && a !== false) {
            jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
	    console.log('resetForm on body load: _referirPaciente', a);
	}
    });
    $refExtChkField.trigger('ifChanged', [true, false]);	/** formValidation resetForm on body load */
    
    /** Validación para referencia de paciente */
    $txtJstfRefExtField.on('keyup change blur', function(e, a, b) {
	jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstablecimientoReferido]');
    });
    
});