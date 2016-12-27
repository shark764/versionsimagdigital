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
    window.typeahead_select_suggestion_newRecord  = null;   // --| filter, typeahead suggestion on select event
    
    /*
     * *********************************************************************
     * EXTRA PARAM for filters in bootstrapFilterTable()
     * *********************************************************************
     */
    $.fn.build_patient_assignNewRecord = function(options)
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
        var $tt_elem_newRecord           = jQuery(this);                       // --| get THIS Table DOM
        var $tt_elem_newRecord_id        = $tt_elem_newRecord.attr('id');  // --| get THIS Table unique id
        
        
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
        $tt_elem_newRecord.typeahead({
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
                    var $sggt_template_function	= $tt_elem_newRecord.data('template-source');
                    
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
         * **********************************************************************
         * --| add buttons events
         * **********************************************************************
         */
        
        /*
         * search button
         * @type @call;$
         */
        var $btn_submit_newRecordForm   = $("button[id='btn_asignar_newPatientRecord']"),
            $btn_clear_newRecord        = $("i[id='clear-typeahead-formAssignNewRegister']");

        /*
         * field typeahead select event
         */
        $tt_elem_newRecord.filter(':not([disabled]):enabled:not([readonly])').on('typeahead:select', function(e, suggestion) {
            /*
             * set current suggestion
             */
            typeahead_select_suggestion_newRecord   = suggestion;
            $tt_elem_newRecord.closest('form').submit();
            
            /** trigger event of search button */
            console.log('event', e, 'suggestion', suggestion);
        });

        /*
         * clear icon click event
         */
        $btn_clear_newRecord.filter(':not([disabled])').click(function(e) {
            /*
             * set current suggestion
             */
            typeahead_select_suggestion_newRecord   = null;
            
            $tt_elem_newRecord.typeahead('val', '');
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
    var $tt_elem_newRecord   = $('.typeahead.explocal_formAssignNewRegister_typeahead');    // --| typeahead input field element
    
    $tt_elem_newRecord.each(function(i) {
        jQuery(this)
            .filter(':not([disabled]):enabled:not([readonly])')
                        .build_patient_assignNewRecord();
    });
    /*
     * instances are builded with filters
     */

     /*
      * 
      */
    var $modal_assignNewRecord  = jQuery('#asignarNuevoExpediente-modal');
    var $form_assignNewRecord   = jQuery('#asignarNuevoExpedienteForm');

    /** Tabla de solicitudes */
    var $table_prc              = jQuery('#table-lista-solicitudes-estudio');
    
    $form_assignNewRecord
        // IMPORTANT: You must declare .on('init.field.fv')
        // before calling .formValidation(options)
        .on('init.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

            // You can retrieve the icon element by
            // $icon = data.element.data('fv.icon');

            $icon.on('click.clearing', function() {
                // Check if the field is valid or not via the icon class
                if ($icon.hasClass('glyphicon-remove')) {
                    // Clear the field
                    data.fv.resetField(data.element);
                }
            });
        })
    .formValidation({
        excluded: [':disabled'],
        locale: 'es_ES'
    })
    // Called when a field is invalid
    .on('err.field.fv', function(e, data) {
        // data.element --> The field element

        var $tabPane = data.element.parents('.tab-pane'),
            tabId    = $tabPane.attr('id');

        $('a[href="#' + tabId + '"][data-toggle="pill"]')
            .parent()
            .find('i')
            .removeClass('fa-check')
            .addClass('fa-times');

        if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
            $modal_assignNewRecord
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_assignNewRecord
                .find(':submit')
                    .removeAttr('disabled')
                    .removeClass('disabled');
        }

        /*console.log('err.field.fv');*/
    })
    // Called when a field is valid
    .on('success.field.fv', function(e, data) {
        // data.fv      --> The FormValidation instance
        // data.element --> The field element

        var $tabPane = data.element.parents('.tab-pane'),
            tabId    = $tabPane.attr('id'),
            $icon    = $('a[href="#' + tabId + '"][data-toggle="pill"]')
                        .parent()
                        .find('i')
                        .removeClass('fa-check fa-times');

        // Check if all fields in tab are valid
        var isValidTab = data.fv.isValidContainer($tabPane);
        if (isValidTab !== null) {
            $icon.addClass(isValidTab ? 'fa-check' : 'fa-times');
        }

        if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
            $modal_assignNewRecord
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_assignNewRecord
                .find(':submit')
                    .removeAttr('disabled')
                    .removeClass('disabled');
        }

        /*console.log('success.field.fv');*/
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        e.preventDefault();

        var $form = $(e.target),
            fv    = $form.data('formValidation');
            
        var $newRecord_params = {
//            __tt_newRecord: jQuery.trim($tt_elem_newRecord.val()),
            __tt_newRecord: typeahead_select_suggestion_newRecord.exp_id,
            __ar_rowsAffected: ARR_PRC_SELECTIONS
        };
        console.log('$newRecord_params', $newRecord_params);

        // Use Ajax to submit form data
        $.ajax({
                type: 'post',
                dataType: 'json',
                url: Routing.generate('simagd_imagenologia_digital_asignarNuevoExpediente'),
                data: $newRecord_params,
                success: function(response) {
                            console.log('Registros han sido migrados a nuevo expediente satisfactoriamente');
                            $table_prc.filter(':visible').bootstrapTable('refresh');
                            $modal_assignNewRecord.modal('hide');
                            $newRecord_bsAlert.addFadeSlideEffect();
                },
                error: function(e) {
                            console.log('Se ha producido un error al migrar registros a nuevo expediente');
                            console.log(e.error);
                            console.log(e.responseText);
                            $modal_assignNewRecord.modal('hide');
                            $error_bsAlert.addFadeSlideEffect();
                }
        });
    });

    jQuery('#btn_asignar_newPatientRecord:not([disabled])').click(function(e) {
        e.preventDefault();
        $form_assignNewRecord.submit();
    });
    
});