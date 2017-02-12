 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
//Function encargada de hacer el request al action, y llenar el select con los empleados regresados, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.

jQuery(document).ready(function() {
    
    var $fieldAtencion          = $("select[id='" + $token + "_idAtencion']");
    
    $fieldAtencion.change(function(e, a, b) {
        var $fieldAtenAreaEstab = $("input[id='" + $token + "_idAtenAreaModEstab']");
	
        var field_arAtn_val     = $("select[id='" + $token + "_idAreaAtencion']").val();
        var field_atn_val       = jQuery(this).val();
        var $fieldEmpleado      = $("select[id='" + $token + "_idEmpleado']");
	var field_emp_val       = $fieldEmpleado.val();
	
	if (jQuery.isEmptyObject(field_arAtn_val) === false && jQuery.isEmptyObject(field_atn_val) === false)
        {
            $fieldEmpleado.find('option:gt(0)').prop('disabled', true);
            $fieldEmpleado.select2('val', '').prop('disabled', true);

            var $getJSON_url	= 'simagd_solicitud_estudio_cargarDatosPorFiltro';  // --| url to get the sources
            /*
             * get sources from remote
             */
            $.getJSON(Routing.generate($getJSON_url), {
		param_filterA : field_atn_val,
		param_filterB : field_arAtn_val,
		selector : 'emp'
            })
            .done(function(data) {
                if (data.status === 'OK')
                {
                    /*
                     * default event action
                     */
                    $fieldEmpleado.prop('disabled', false);
                    /*
                     * enable options that matching data
                     */
                    $.each(data.results, function(i, r) {
                        $fieldEmpleado.find('option[value=' + this.value + ']').prop('disabled', false);
			if (jQuery.isEmptyObject(field_emp_val) === false && parseInt(field_emp_val, 10) === this.value)
			{
			    $fieldEmpleado.select2('val', this.value);
			}
                    });
		    
		    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEmpleado]');
		    $fieldEmpleado.trigger('change', [a, b]);
		    if (field_atn_val && !field_emp_val) {
			$fieldEmpleado.select2("search", "");
		    }

                    /** obtener AtenAreaModEstab*/
                    $fieldAtenAreaEstab.val(data.aamsId);

                    if (typeof a !== "undefined" && a !== false) {
                        jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                        console.log('resetForm on body load: _idAtencion', a);
                    }
                }
            })
            .fail(function(jqxhr, textStatus, error) {
                console.log(error);
                console.log(textStatus);
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEmpleado]');

                if (typeof a !== "undefined" && a !== false) {
                    jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                    console.log('resetForm on body load: _idAtencion', a);
                }
            });
        }
        else
        {
            $fieldEmpleado.select2('val', '');
            $fieldEmpleado.find('option:gt(0)').prop('disabled', true);
	    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEmpleado]');
	    $fieldEmpleado.trigger('change', [a, b]);
	    
	    $fieldAtenAreaEstab.val('');
	    
	    if (typeof a !== "undefined" && a !== false) {
                jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
		console.log('resetForm on body load: _idAtencion', a);
	    }
        }
    });
    
});