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
    $.fn.build_citDate_explocalExtraParamFilter = function(options)
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
         * set select2
         * @type @call;$
         */
        var $el_tcnl_prg                        = $('select[id="_setting_calendar_filters_radiologist"]');   //  --| select tcnl DOM element (default configuration)
        var $el_mod_prc                         = $('select[id="_setting_calendar_filters_modality"]');      //  --| select modalidad DOM element

        $el_tcnl_prg.change(function(e) {
            console.log(jQuery(this).attr('id'), jQuery(this).val());
            $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('refetchEvents');
        });
        $el_mod_prc.change(function(e) {
            console.log(jQuery(this).attr('id'), jQuery(this).val());
            $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('refetchEvents');
        });

        /** Set datetimepicker */
        var $el_fc_goToDate                     = $('[id="irHaciaFecha"]');             //  --| dtpicker DOM element
        $el_fc_goToDate.datetimepicker({
            locale          : 'es',
            format          : 'YYYY-MM-DD',
            showTodayButton : true,
            showClear       : true,
            showClose       : true,
            ignoreReadonly  : true
        }).on("dp.change", function (e) {
            jQuery(this).blur();
            console.log(e.date);
            var goToDpDate                      = (typeof e.date !== 'undefined' && e.date !== null && e.date !== false) ? e.date : moment();
            $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('gotoDate', goToDpDate);
        }).on("dp.hide", function (e) {
            jQuery(this).blur();
        });

        /*
         * get calendar element
         * @type @call;$
         */
        var $el_fc_calendar                     = jQuery('#calendar');   //  --| calendar DOM element

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
            typeahead_select_suggestion         = jQuery.extend(true, {}, suggestion); // set value null
            
            /*
             * search method
             */
            searchElementsBySuggestion();
            
            /*
             * fullCalendar refresh events
             */
            $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('refetchEvents');    // --| refresh events on calendar
            
            console.log('override typeahead:select', suggestion);
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
             * set current suggestion
             */
            typeahead_select_suggestion         = jQuery.extend(true, {}, {}); // set value null
            
            /*
             * fullCalendar refresh events
             */
            $el_fc_calendar.filter(':not([disabled]):visible').fullCalendar('refetchEvents');    // --| refresh events on calendar
            
            console.log('override clear:click');
        });

        /*
         * Buttons search click event
         */
        
        /*
         * --| NOT USED
         */
        $btn_search_explocal.filter(':not([disabled])').click(function(e) {
            e.preventDefault();
        });

        /*
         * *******************************************
         *          get elements by ttSuggestion
         * *******************************************
         * 
         * @returns {Boolean}
         */
        function searchElementsBySuggestion()
        {
            /*
             * 
             * @type @exp;$@call;trim
             */
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
            
            return false;
        }
        
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
                        .build_citDate_explocalExtraParamFilter();
    });
    /*
     * instances are builded with filters
     */
    
});

jQuery(document).ready(function() {

    /* initialize the external events
    -----------------------------------------------------------------*/
//     jQuery('#external-events .fc-event').each(function() {
//         // store data so the calendar knows to render an event upon drop
//         jQuery(this).data('event', {
//             solicitud: jQuery.trim(jQuery(this).data("solicitud")), // use the element's text as the event title
//             title: jQuery.trim(jQuery(this).text()), // use the element's text as the event title
// 	    start: '09:00',
//             stick: true, // maintain when user navigates (see docs on the renderEvent method)
//             color: jQuery.trim(jQuery(this).data("color")), // use the element's text as the event title
// 	    allDay: false,
//         });
// 
//         // make the event draggable using jQuery UI
//         jQuery(this).draggable({
// 	    scroll: false,
// 	    helper: 'clone',
//             zIndex: 999,
//             revert: true,      // will cause the event to go back to its
//             revertDuration: 0  //  original position after the drag
//         });
// 
//     });
    
});