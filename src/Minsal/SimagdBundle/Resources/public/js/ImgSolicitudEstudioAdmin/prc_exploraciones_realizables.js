/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Function encargada de hacer el request al action, y filtra las proyecciones pertenecientes a la modalidad, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.

jQuery(document).ready(function() {
    
    /** stdref DOM */
    var $pryStudyField  = jQuery('#' + $token + '_solicitudEstudioProyeccion');
    
    /*
     * proyección change event
     */
    $pryStudyField.change(function(e, a, b) {
        var field_mld_val       = $("select[id='" + $token + "_idAreaServicioDiagnostico']").val();
        var $fieldDiagnostician = $("select[id='" + $token + "_idEstablecimientoDiagnosticante']");
	var field_stdiag_val 	= $fieldDiagnostician.val();
        
        /*
         * array [proyecciones]
         * @type @call;jQuery@call;select2
         */
        var field_pry_val      = jQuery(this).select2('val');
	
	if (jQuery.isEmptyObject(field_mld_val) === false && field_pry_val.length !== 0)
        {
            $fieldDiagnostician.find('option').prop('disabled', true);
            $fieldDiagnostician.select2('val', '').prop('disabled', true);

            var $getJSON_url        = 'simagd_solicitud_estudio_cargarDatosPorFiltro';  // --| url to get the sources
            /*
             * get sources from remote
             */
            $.getJSON(Routing.generate($getJSON_url), {
                param_filterA : field_mld_val,
                param_filterB : jQuery.unique(field_pry_val),
                selector : 'stdiag',
            })
            .done(function(data) {
                if (data.status === 'OK')
                {
                    /*
                     * default event action
                     */
                    $fieldDiagnostician.prop('disabled', false);
                    /*
                     * enable options that matching data
                     */
                    $.each(data.resultados, function(i, r) {
                        $fieldDiagnostician.find('option[value=' + this.value + ']').prop('disabled', false);
			if (jQuery.isEmptyObject(field_stdiag_val) === false && parseInt(field_stdiag_val, 10) === this.value)
			{
			    $fieldDiagnostician.select2('val', this.value);
			}
                    });

                    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstablecimientoDiagnosticante]');
                    $fieldDiagnostician.trigger('change', [a, b]);
                    if (field_mld_val && !field_stdiag_val) {
                        $fieldDiagnostician.select2("search", "");
                    }

                    if (typeof a !== "undefined" && a !== false) {
                        jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                        console.log('resetForm on body load: _solicitudEstudioProyeccion', a);
                    }
                }
            })
            .fail(function(jqxhr, textStatus, error) {
                console.log(error);
                console.log(textStatus);
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstablecimientoDiagnosticante]');

                if (typeof a !== "undefined" && a !== false) {
                    jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
                    console.log('resetForm on body load: _solicitudEstudioProyeccion', a);
                }
            });
        }
        else
        {
            $fieldDiagnostician.select2('val', '');
            $fieldDiagnostician.find('option:gt(0)').prop('disabled', true);
	    jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', $token + '[idEstablecimientoDiagnosticante]');
	    $fieldDiagnostician.trigger('change', [a, b]);
	    
	    if (typeof a !== "undefined" && a !== false) {
                jQuery('#simagd_entity_full_admin_form').fv_resetValidationForm();     // --| resetForm
		console.log('resetForm on body load: _solicitudEstudioProyeccion', a);
	    }
        }
    });
    
});

//http://stackoverflow.com/questions/16107267/getting-access-to-a-jquery-element-that-was-just-appended-to-the-dom
//http://bootstrapvalidator.com/examples/adding-dynamic-field/
//http://bootstrapvalidator.com/examples/ckeditor/
//http://www.tequilafish.com/2007/12/04/jquery-how-to-get-the-id-of-your-current-object/
//http://stackoverflow.com/questions/2398947/jquery-how-to-get-to-a-particular-child-of-a-parent
//http://stackoverflow.com/questions/7036095/how-to-add-an-element-always-as-last-element-using-jquery

//http://stackoverflow.com/questions/4718409/jquery-find-parent
//http://stackoverflow.com/questions/7954436/how-do-i-use-jquery-each-to-find-a-childs-children
//http://stackoverflow.com/questions/12862601/jquery-get-all-form-elements-input-textarea-select
//http://stackoverflow.com/questions/9116694/jquery-find-input-type-but-also-for-select
//http://ivaynberg.github.io/select2/
//http://jqueryui.com/themeroller/#!zThemeParams=5d000001001506000000000000003d8888d844329a8dfe02723de3e570162cf18d27450c454aa2f2e374d1d127fabb9ebc66c3ee5a70fb154870371702db6720bcd83f0ecbb2131337f10a086e219c538a2003e4a05b37f637b91dbf9e5ea1a30eee0ffb74635c67587b16e39b844855d43f178d7223e5844a27feed562a919e51a896a2b947ea0fe5769740cad2f353f43f6a6badb4f9f158f439cd0ec77f1c39bf311c9c328e70d7c078862964f803cfeb841e8f7d5c944dbec24d93e6f8096a02b769b976b7c435f6ee6b8cc66444023920a41270f305b7e9d576789ae017b7f8a16eaf3fddede704785a409c4fbbbe7481fb749e2ae44e8ec018139c9bdaad1ff148a94614b8bed98e577f2a12f376997fd9e196c9c2c4e8ade8e18f17a54d27413cfc22eb103a061cb0ace641d769abc84778c949297f6f00a2f8f502cbad9d937aace60187dbe5719bd8904bf7ad27999098ff61920ef5fc2ce8fc28088bfe4f049af0fad1091984f7cc7c512a75c11b0d0a81a1fd4a9aee0b0ef437e5370a72a1568ba3e12b2912e0c16c95f0a7db121b89833319b9b3d4d8508bce99ed91cf922da9c78511a24190d7a54d45882fc347df992d44a5223515862e741257e6920e3b32e5fe9c19f11f086f26e66f1e9ec94da3cb5f2dcc8be91cb5dc08236c670e97128b7e9dcf8dafebcda7ac193a3251395116da73002ca7756c07fbe44bbe5ebf232ca9146b55f92ec226878e01a55ccffba986c3