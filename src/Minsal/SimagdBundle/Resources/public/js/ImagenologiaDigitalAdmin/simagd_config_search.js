/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {

    /** Set the Options for "Bloodhound" Engine */
    var my_Suggestion_class = new Bloodhound({
        limit: Infinity,
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: Routing.generate('simagd_estudio_getPatients') + '?query=%QUERY',
            wildcard: '%QUERY'
        },
    });

    //Initialize the Suggestion Engine
    my_Suggestion_class.initialize();

    var $tt_elem_explocal   = $('.typeahead.explocal_navbar_typeahead');    // --| typeahead input field element
    $tt_elem_explocal.typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'value',
        displayKey: 'exp_numero',
        source: my_Suggestion_class.ttAdapter(),
        limit: Infinity,
        templates: {
            empty: [
                '<div class="no-items">',
                    'Sin Resultados',
                '</div>'
            ].join('\n'),
            suggestion: function(item) {
                var $sggt_template_function	= $tt_elem_explocal.data('template-source');

                var $edad   = jQuery.isEmptyObject(item.pct_edad) === false ? item.pct_edad.y + ' Años, ' + item.pct_edad.m + ' meses, ' + item.pct_edad.d + ' días' : 'desconocida';

                return typeof window[$sggt_template_function] === 'function' ?
                    window[$sggt_template_function](item) : [
                        '<div class="expand-box">',
                            '<span style="">',
                                item.pct_nombreCompleto,
                            '</span>',
                            '<span class="label label-default-v2" style="float: right; margin-top: 5px; min-width: 175px; text-align: left;">',
                                '[Edad: ' + $edad + ']',
                            '</span>',
                            '<span class="label label-element-v2" style="float: right; margin-top: 5px; min-width: 72px; margin-right: 12px; text-align: left;">',
                                '[' + item.exp_numero + ']',
                            '</span>',
                        '</div>'
                ].join('\n');
            },
            footer: function(query) {
                return [
                    '<div style="text-align: center !important; opacity: 0.5 !important;">',
                        '<span class="text-element-v2">',
                            'Búsqueda: "' + query.query + '"',
                        '</span>',
                    '</div>'
                ].join('\n');
            }
        }
    });
    
    jQuery('#navbar_filter_expNumero').on('typeahead:select', function(ev, suggestion) {
//        console.log('Selection: ' + suggestion);
	/** trigger event of search button */
	if (!$("div[id='container_form_busquedaPaciente']").is(':visible')) {
	    /** Fade out table */
	    $("button[id='btn_search_pct']").trigger("click");
	}
    });
    
    $("i[id='clear-typeahead-exp']").click(function() {
        jQuery('#navbar_filter_expNumero').typeahead('val', '');
						      
	if (!$("div[id='container_form_busquedaPaciente']").is(':visible')) {
	    /** Fade out table */
	    $("div[id='container_resultado_busquedaPaciente']").fadeOut("fast");
	}
    });
    
    /** Buttons search */
    $("button[id='btn_search_pct']:not([disabled])").click(function(e) {
        e.preventDefault();
	
	var $expNavBarField = jQuery('#navbar_filter_expNumero');
	
	var $expVal = jQuery.trim($expNavBarField.val());
	
	if (!$expVal) {
	    $expNavBarField.typeahead('val', '');
	} else {
	    /** Fade in table */
	    $("div[id='container_resultado_busquedaPaciente']").fadeIn("fast");
	    /** Refresh table with new parameters */
	    jQuery('#table-resultado-busqueda').bootstrapTable('refresh',
		{
		    url: Routing.generate('simagd_imagenologia_digital_resultadosBusquedaPaciente',
			    {
				min_numeroExp: $expVal
			    })
		});
	}
    });
    
    $("button[id='btn_search_plus_pct']:not([disabled])").click(function(e) {
        e.preventDefault();
	
	/** hide plus search button */
	jQuery(this).hide();
	$("button[id='btn_search_minus_pct']").show();
	/** clean form */
	$("button[id='limpiar-form']").trigger("click");
	
	var $expNavBarField 	= jQuery('#navbar_filter_expNumero');
	var $expFormField 	= jQuery('#numeroExp');
	var $expVal 		= jQuery.trim($expNavBarField.val());
	if (!$expVal) {
	    $expNavBarField.typeahead('val', '');
	} else {
	    $expFormField.val($expVal);
	    /** Refresh table with none parameters */
	    jQuery('#table-resultado-busqueda:visible').bootstrapTable('refresh');
	}
	/** fade in complete search form */
	$("div[id='container_form_busquedaPaciente']").fadeIn("fast");
    });
    
    $("button[id='btn_search_minus_pct']:not([disabled])").click(function(e) {
        e.preventDefault();
	
	/** hide minus search button */
	jQuery(this).hide();
	$("button[id='btn_search_plus_pct']").show();
	/** clean form */
	$("button[id='limpiar-form']").trigger("click");
	
	/** fade out complete search form */
	$("div[id='container_form_busquedaPaciente']").fadeOut("fast");
	$("button[id='btn_search_pct']").trigger("click");
    });
    
});
