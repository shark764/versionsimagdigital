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
    window.TT_CURRENT_SUGGESTION        = null;   // --| current suggestion
    
    /*
     * *********************************************************************
     * EXTRA PARAM for filters in bootstrapFilterTable()
     * *********************************************************************
     */
    $.fn.build_explocalExtraParamFilter = function(options)
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
                url: Routing.generate('simagd_estudio_obtenerExpedientesEstab') + '?query=%QUERY',
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
            /** trigger event of search button */
            console.log('event', e, 'suggestion', suggestion);
            $btn_search_explocal.trigger("click");
            
            /*
             * trigger custom event
             */
            TT_CURRENT_SUGGESTION               = jQuery.extend(true,
                                                        {},
                                                        suggestion
                                                ); // set value for suggestion
            jQuery(this).trigger('myevt:ttsuggestion', [e, suggestion]);
        });

        /*
         * clear icon click event
         */
        $btn_clear_explocal.filter(':not([disabled])').click(function(e) {
            $tt_elem_explocal.typeahead('val', '');

            /*
             * get table of active container
             * @type @call;$@call;find@call;data
             */
            var $target_divContainer_bsTable    = $('li.list-table-link-navbar.active')
                                                            .find("a")
                                                                    .data('divtabletarget'),
                $target_bstable                 = jQuery('#' + $target_divContainer_bsTable)
                                                            .find('table[data-toggle="table"]:visible');

            /** Refresh table with new empty parameter */
            $target_bstable.add_extraParametersFilter({
                xparam : {
                    explocal_numero: {
                        type    : 'text',
                        target  : 'explocal_numero',
                        value   : null
                    }
                }
            });
            
            /*
             * trigger custom event
             */
            TT_CURRENT_SUGGESTION               = jQuery.extend(true, {}, {}); // set value null
            $tt_elem_explocal.trigger('myevt:ttclear', [e, null]);
        });

        /*
         * Buttons search click event
         */
    
        $btn_search_explocal.filter(':not([disabled])').click(function(e) {
            e.preventDefault();

            var $explocalVal                    = jQuery.trim($tt_elem_explocal.val());

            /*
             * get table of active container
             * @type @call;$@call;find@call;data
             */
            var $target_divContainer_bsTable    = $('li.list-table-link-navbar.active')
                                                            .find("a")
                                                                    .data('divtabletarget'),
                $target_bstable                 = jQuery('#' + $target_divContainer_bsTable)
                                                            .find('table[data-toggle="table"]:visible');

            /** Refresh table with new parameters */
            $target_bstable.add_extraParametersFilter({
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
            .filter('[data-xparam-filter="true"]')
                        .build_explocalExtraParamFilter();
    });
    /*
     * instances are builded with filters
     */
    
});