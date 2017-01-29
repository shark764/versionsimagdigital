/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {

    /*
     * 
     * @type type
     * Global variables for plugin
     */
    window.typeahead_select_suggestion  = null;   // --| filter, typeahead suggestion on select event
    
    /*
     * *********************************************************************
     * EXTRA PARAM for filters in bootstrapFilterTable()
     * *********************************************************************
     */
    $.fn.build_study_explocalExtraParamFilter = function(options)
    {
        /*
         * **********************************************************************
         *                      TYPEAHEAD for num_expediente
         * **********************************************************************
         */
        
        /*
         * 
         * @type @call;$
         * 
         * Get this Tables with bootstrapTable()
         */
        var $tt_elem_explocal           = jQuery(this);                       // --| get THIS Table DOM
        var $tt_elem_explocal_id        = $tt_elem_explocal.attr('id');  // --| get THIS Table unique id
        
        
        /*
         * **********************************************************************
         * --|Set the Options for "Bloodhound" Engine
         * **********************************************************************
         */
        
        /*
         * 
         * @type @new;Bloodhound
         */
        var $explocal_filter_sggClass   = new Bloodhound({
            limit: Infinity,
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: Routing.generate('simagd_estudio_getPatients') + '?query=%QUERY',
                wildcard: '%QUERY'
            },
        }); // --| suggestion class, bloodhound mode

        $explocal_filter_sggClass.initialize(); // --| initialize the Suggestion Engine
        
        /*
         * build typeahead
         */
        $tt_elem_explocal.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'value',
            displayKey: 'exp_numero',
            source: $explocal_filter_sggClass.ttAdapter(),
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

        /*
         * **********************************************************************
         * --| add custom DOM elements
         * **********************************************************************
         */
        
        /*
         * get table of active container
         * @type @call;$@call;find@call;data
         */
        var $target_bstable                     = $('table[id="table-resultado-busqueda"]'),            //  --| table for studies
            $search_container                   = $('div[id="container_resultado_busquedaEstudio"]'),   //  --| container for table for studies
            $av_container_form                  = $('div[id="container_form_busquedaEstudio"]'),        //  --| container for table for form
            $search_advance_form                = $("form[id='formBusquedaEstudio']");                  //  --| form for studies search

        /*
         * **********************************************************************
         * --| add buttons events
         * **********************************************************************
         */
        
        /*
         * search button
         * @type @call;$
         */
        var $btn_search_explocal                = $("button[id='btn_search_filter_expNumero']"),
            $btn_clear_explocal                 = $("i[id='clear-typeahead-filter-exp']");

        /*
         * field typeahead select event
         */
        $tt_elem_explocal.filter(':not([disabled]):enabled:not([readonly])').on('typeahead:select', function(e, suggestion) {
            /*
             * set current suggestion
             */
            typeahead_select_suggestion         = suggestion;
            
            /** trigger event of search button */
            console.log('event', e, 'suggestion', suggestion);
            if (!$av_container_form.is(':visible')) {
                $btn_search_explocal.trigger("click");
            }
            console.log('override typeahead:select', suggestion);
        });

        /*
         * clear icon click event
         */
        $btn_clear_explocal.filter(':not([disabled])').click(function(e) {
            /*
             * set current suggestion
             */
            typeahead_select_suggestion         = null;
            
            $tt_elem_explocal.typeahead('val', '');
        
            /** Refresh table with new empty parameter */
            $target_bstable.filter(':visible').add_extraParametersFilter({
                xparam : {
                    explocal_numero: {
                        type    : 'text',
                        target  : 'explocal_numero',
                        value   : null
                    }
                }
            });

            if (!$av_container_form.is(':visible')) {
                /** Fade out table */
                $search_container.fadeOut("fast");
            }
            console.log('override clear:click');
        });

        /*
         * Buttons search click event
         */
    
        $btn_search_explocal.filter(':not([disabled])').click(function(e) {
            e.preventDefault();

            var $explocalVal                    = jQuery.trim($tt_elem_explocal.val());

            /** Fade in table */
            if (jQuery.isEmptyObject($explocalVal) === false) {
                $search_container.fadeIn("fast");
            }

            /** Refresh table with new parameters */
            $target_bstable.filter(':visible').add_extraParametersFilter({
                xparam : {
                    explocal_numero: {
                        type    : 'text',
                        target  : 'explocal_numero',
                        value   : jQuery.isEmptyObject($explocalVal) === false ? $explocalVal : null
                    }
                }
            });
            
            if (!$explocalVal)
            {
                $tt_elem_explocal.typeahead('val', ''); // --| set empty input
            }
            console.log('override search:click', $explocalVal);
        });

        /*
         * **********************************************************************
         * --| add custom navbar buttons events (MORE/LESS OPTIONS)
         * **********************************************************************
         */

        /*
         * 
         * @type @call;$
         */
        var $btn_min_search         = $('button[id="btn_search_minus_est"]'),
            $btn_more_search        = $('button[id="btn_search_plus_est"]');

        $btn_more_search.filter(':not([disabled])').click(function(e) {
            e.preventDefault();

            /** hide plus search button */
            jQuery(this).hide();
            $btn_min_search.show();
            /** clean form */
            $("button[id='limpiar-form']").trigger("click");

            var $exp_av_formField   = jQuery('#numeroExp');
            var $expVal             = jQuery.trim($tt_elem_explocal.val());

            if (!$expVal) {
                $tt_elem_explocal.typeahead('val', '');
            } else {
                $exp_av_formField.val($expVal);
                /** Refresh table with none parameters */
                $target_bstable.filter(':visible').bootstrapTable('refresh');
            }

            /*
             * set datetime [range]
             */
            moment.locale('es');
            var $moment_now         = moment();
            $("input[id='fechaHasta']")
                    .val($moment_now.format('YYYY-MM-DD hh:mm A'))
                    .data("DateTimePicker").date($moment_now);
            $("input[id='fechaDesde']")
                    .val($moment_now.dayOfYear(1).format('YYYY-MM-DD hh:mm A'))
                    .data("DateTimePicker").date($moment_now.dayOfYear(1));
            
            /*
             * set data in form --| from suggestion
             */
            if (jQuery.isEmptyObject(typeahead_select_suggestion) === false) {
                if ($expVal === typeahead_select_suggestion.exp_numero || $expVal.toString() === typeahead_select_suggestion.exp_numero.toString()) {
                    $.each(typeahead_select_suggestion, function(i, v) {
                        $search_advance_form
                                .find(':input[data-filter-bstable-by="' + i.toString() + '"]')
                                .val(function(j, w) {
                                    return jQuery.isEmptyObject(jQuery.trim(v)) === false ? jQuery.trim(v) : '';
                                });;
                    });
                }
            }
            $search_advance_form.data('formValidation').resetForm();    // reset form

            /** fade in complete search form */
            $av_container_form.fadeIn("fast");
        });

        $btn_min_search.filter(':not([disabled])').click(function(e) {
            e.preventDefault();

            /** hide minus search button */
            jQuery(this).hide();
            $btn_more_search.show();
            /** clean form */
            $("button[id='limpiar-form']").trigger("click");

            /** fade out complete search form */
            $av_container_form.fadeOut("fast");
            $btn_search_explocal.trigger("click");
        });
        
    };

}(jQuery));

jQuery(document).ready(function() {
    
    /*
     * **************************************************************************
     * build extra expediente local for all Instances of custom
     * filter of bootstrapFilterTable()
     * **************************************************************************
     */

    /*
     * 
     * @type @call;$
     */
    var $tt_elem_explocal   = $('.typeahead.explocal_navbar_typeahead');    // --| typeahead input field element
    
    $tt_elem_explocal.each(function(i) {
        jQuery(this)
            .filter(':not([disabled]):enabled:not([readonly])')
            .filter('[data-xparam-filter="false"]')
                        .build_study_explocalExtraParamFilter();
    });
    /*
     * instances are builded with filters
     */
    
    /*
     * Initial value from request
     */
    var $explocalVal            = jQuery.trim($tt_elem_explocal.val()),
        $btn_search_explocal    = jQuery('#btn_search_filter_expNumero');
    if (jQuery.isEmptyObject($explocalVal) === false)
    {
        $btn_search_explocal.trigger('click');
    }
    
});