 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
//Function encargada de hacer el request al action, y llenar el select con las atenciones regresadas, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.

jQuery(document).ready(function() {
    
    var $fieldAreaAtencion	= $("select[id='" + $token + "_idAreaAtencion']");
    
    $fieldAreaAtencion.change(function(e, a, b) {
        var field_arAtn_val 	= jQuery(this).val();
        var $fieldAtencion	= $("select[id='" + $token + "_idAtencion']");
	var field_atn_val	= $fieldAtencion.val();
	
	if (jQuery.isEmptyObject(field_arAtn_val) === false)
        {
            $fieldAtencion.find('option:gt(0)').prop('disabled', true);
            $fieldAtencion.select2('val', '').prop('disabled', true);

            var $getJSON_url	= 'simagd_solicitud_estudio_cargarDatosPorFiltro';  // --| url to get the sources
            /*
             * get sources from remote
             */
            $.getJSON(Routing.generate($getJSON_url), {
		param_filterA : field_arAtn_val,
		param_filterB : '-1',
		selector : 'atn'
            })
            .done(function(data) {
                if (data.status === 'OK')
                {
                    /*
                     * default event action
                     */
                    $fieldAtencion.prop('disabled', false);
                    /*
                     * enable options that matching data
                     */
                    $.each(data.resultados, function(i, r) {
                        $fieldAtencion.find('option[value=' + this.value + ']').prop('disabled', false);
			if (jQuery.isEmptyObject(field_atn_val) === false && parseInt(field_atn_val, 10) === this.value)
			{
			    $fieldAtencion.select2('val', this.value);
			}
                    });
		    
		    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idAtencion]');
		    $fieldAtencion.trigger('change', [a, b]);
		    if (field_arAtn_val && !field_atn_val) {
			$fieldAtencion.select2("search", "");
		    }
		    
		    if (typeof a !== "undefined" && a !== false) {
			jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
			console.log('resetForm on body load: _idAreaAtencion', a);
		    }
                }
            })
            .fail(function(jqxhr, textStatus, error) {
                console.log(error);
                console.log(textStatus);
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idAtencion]');
		
		if (typeof a !== "undefined" && a !== false) {
                    jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                    console.log('resetForm on body load: _idAreaAtencion', a);
		}
            });
        }
        else
        {
            $fieldAtencion.select2('val', '');
            $fieldAtencion.find('option:gt(0)').prop('disabled', true);
	    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idAtencion]');
	    $fieldAtencion.trigger('change', [a, b]);
	    
	    if (typeof a !== "undefined" && a !== false) {
                jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
		console.log('resetForm on body load: _idAreaAtencion', a);
	    }
        }
    });
    
    $fieldAreaAtencion.trigger('change', [true, false]);
    
});