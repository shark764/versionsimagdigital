/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Function encargada de hacer el request al action, y llenar el select con las modalidades regresadas, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.

jQuery(document).ready(function() {
    
    var $fieldModality 	= $("select[id='" + $token + "_idAreaServicioDiagnostico']");
    
    $fieldModality.change(function(e, a, b) {
        var field_stdref_val 	= $("select[id='" + $token + "_idEstablecimientoReferido']").val() || '-1';
        var field_exp_val 	= $("input[id='" + $token + "_idExpediente']").val() || '-1';
        var field_mld_val 	= jQuery(this).val();
        var field_atn_val 	= '97';
        var $fieldProyection 	= $("select[id='" + $token + "_solicitudEstudioProyeccion']");
	
	var $fieldDiagnostician	= $("select[id='" + $token + "_idEstablecimientoDiagnosticante']");
        
        var $filterObject 	= {"idReferido": field_stdref_val, "idExpediente": field_exp_val, "idAtencion": field_atn_val};
	
	var field_pry_val       = $.map($fieldProyection.select2('val'), function(item) {
            return parseInt(item, 10); 
        });
	
	if (jQuery.isEmptyObject(field_mld_val) === false && jQuery.isEmptyObject(field_stdref_val) === false)
        {
            $fieldProyection.find('option').prop('disabled', true);
            $fieldProyection.select2('val', '').prop('disabled', true);

            var $getJSON_url        = 'simagd_solicitud_estudio_cargarDatosPorFiltro';  // --| url to get the sources
            /*
             * get sources from remote
             */
            $.getJSON(Routing.generate($getJSON_url), {
		param_filterA : field_mld_val,
		param_filterB : JSON.stringify($filterObject),
		selector : 'expl'
            })
            .done(function(data) {
                if (data.status === 'OK')
                {
                    /*
                     * default event action
                     */
                    $fieldProyection.prop('disabled', false);
                    /*
                     * enable options that matching data
                     */
		    var arr_pryResultValues = []; // create array here
                    $.each(data.results, function(i, r) {
			arr_pryResultValues.push(this.value); //push values here
                        $fieldProyection.find('option[value=' + this.value + ']').prop('disabled', false);
                    });
                    var $arr_pry_finalValues    = $.fn.get_arrayIntersect({a: field_pry_val, b: arr_pryResultValues});
                    console.log('field_pry_val', field_pry_val, 'arr_pryResultValues', arr_pryResultValues, '$arr_pry_finalValues', $arr_pry_finalValues);
		    if ($arr_pry_finalValues.length !== 0)
		    {
			$fieldProyection.select2('val', jQuery.unique($arr_pry_finalValues));
		    }

                    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[solicitudEstudioProyeccion]');
                    
                    /** Filtro para estab diagnosticantes */
                    field_pry_val.length    = 0;
                    field_pry_val           = $.map($fieldProyection.select2('val'), function(item) {
                        return parseInt(item, 10); 
                    });
		    if (field_pry_val.length !== 0)
		    {
                        $fieldProyection.trigger('change', [a, b]);
                    }
                    else
                    {
                        $fieldDiagnostician.select2('val', '');
                        $fieldDiagnostician.find('option:gt(0)').prop('disabled', true);
                        jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idAreaServicioDiagnostico]');
                    }

                    if (typeof a !== "undefined" && a !== false) {
                        jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                        console.log('resetForm on body load: _idAreaServicioDiagnostico', a);
                    }
                }
            })
            .fail(function(jqxhr, textStatus, error) {
                console.log(error);
                console.log(textStatus);
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[solicitudEstudioProyeccion]');

                if (typeof a !== "undefined" && a !== false) {
                    jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                    console.log('resetForm on body load: _idAreaServicioDiagnostico', a);
                }
            });
        }
        else
        {
	    if ($("select[id='" + $token + "_idEstablecimientoReferido']").val()) {
		$fieldModality.select2("search", "");
	    }
            $fieldProyection.select2('val', '');
            $fieldProyection.find('option').prop('disabled', true);
	    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[solicitudEstudioProyeccion]');
	    $fieldProyection.trigger('change', [a, b]);
	    $isNewPry_added = false;
	    
	    if (typeof a !== "undefined" && a !== false) {
                jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
		console.log('resetForm on body load: _idAreaServicioDiagnostico', a);
	    }
        }
    });
    
});