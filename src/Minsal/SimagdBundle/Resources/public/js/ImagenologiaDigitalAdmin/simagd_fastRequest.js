/*
 * 
 * @param {type} param
 * ******************************************************************************
 * http://stackoverflow.com/questions/10030538/query-with-exists-for-doctrine-symfony2
 * ******************************************************************************
 */


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_prcEmrgRq     = jQuery('#crearSolicitudEstudioFormatoRapido-form');
    var $modal_prcEmrgRq    = jQuery('#crearSolicitudEstudioFormatoRapido-modal');

    /** Tabla de solicitudes */
    var $table_prc          = jQuery('#table-lista-solicitudes-estudio');

    /*
     ****************************************************************************
     * change event for areaServicioDiagnostico field
     ****************************************************************************
     */
    var $emrg_fieldMdly     = jQuery('select[id="formPrcEmergencyRequestIdAreaServicioDiagnostico"]');
    var $emrg_fieldPry      = jQuery('select[id="formPrcEmergencyRequestSolicitudEstudioProyeccion"]');

    /*
     * modality change event
     */
    $emrg_fieldMdly.change(function(e, a, b) {
        var field_mld_val   = jQuery(this).val();   // modality val
        var field_pry_val   = $.map($emrg_fieldPry.select2('val'), function(item) {
            return parseInt(item, 10);
        }); // proyections values, parse to integer

        $emrg_fieldPry.find('option').prop('disabled', true);        // disable all options first
        $emrg_fieldPry.select2('val', '').prop('disabled', true);    // remove selection
        /*
         * search in javascript object
         */
        var arr_pryResultValues = []; // array for values in cascade selection
        $.each(GROUP_DEPENDENT_ENTITIES, function(i, v) {
            if (i === 'm_expl') {
                $.each(v, function(x, y) {
                    if (y.id_m === parseInt(field_mld_val, 10)) {
                        arr_pryResultValues.push(y.id_expl); //push values here
                        $emrg_fieldPry.find('option[value=' + y.id_expl + ']').prop('disabled', false);  // disable if option value is in result
                    }
                });
            }
        });
        var $arr_pry_finalValues    = $.fn.get_arrayIntersect({a: field_pry_val, b: arr_pryResultValues});  // get selection filtered by result
        if ($arr_pry_finalValues.length !== 0)
        {
            $emrg_fieldPry
                    .select2('val', jQuery.unique($arr_pry_finalValues))
                    .prop('disabled', false);   // set selection and enable select2
        }
        if (jQuery.isEmptyObject(field_mld_val) === false)
        {
            $emrg_fieldPry.prop('disabled', false); // enable select2
        }
        $form_prcEmrgRq.formValidation('revalidateField', 'formPrcEmergencyRequestSolicitudEstudioProyeccion[]');   // revalidate select2
    });

    /*
     ****************************************************************************
     * change event for areaAtencion field
     ****************************************************************************
     */
    var $emrg_fieldArAtn    = jQuery('select[id="formPrcEmergencyRequestIdAreaAtencion"]');
    var $emrg_fieldAtn      = jQuery('select[id="formPrcEmergencyRequestIdAtencion"]');

    /*
     * area change event
     */
    $emrg_fieldArAtn.change(function(e, a, b) {
        var field_arAtn_val = jQuery(this).val();
	var field_atn_val   = $emrg_fieldAtn.val();

        $emrg_fieldAtn.find('option').prop('disabled', true);        // disable all options first
        $emrg_fieldAtn.select2('val', '').prop('disabled', true);    // remove selection
        /*
         * search in javascript object
         */
        $.each(GROUP_DEPENDENT_ENTITIES, function(i, v) {
            if (i === 'ar_atn') {
                $.each(v, function(x, y) {
                    if (y.id_ar === parseInt(field_arAtn_val, 10)) {
                        $emrg_fieldAtn.find('option[value=' + y.id_atn + ']').prop('disabled', false);  // disable if option value is in result
                        if (jQuery.isEmptyObject(field_atn_val) === false && parseInt(field_atn_val, 10) === y.id_atn)
                        {
                            $emrg_fieldAtn.select2('val', y.id_atn);    // set selected value
                        }
                    }
                });
            }
        });
        if (jQuery.isEmptyObject(field_arAtn_val) === false)
        {
            $emrg_fieldAtn.prop('disabled', false); // set selection and enable select2
        }
        $form_prcEmrgRq.formValidation('revalidateField', 'formPrcEmergencyRequestIdAtencion');   // revalidate select2
        $emrg_fieldAtn.trigger('change', [a, b]);   // trigger next cascade select2
        if (field_arAtn_val && !field_atn_val) {
            $emrg_fieldAtn.select2("search", "");   // search if empty
        }
        if (typeof a !== "undefined" && a !== false) {
            $form_prcEmrgRq.fv_resetValidationForm();   // --| resetForm
        }
    });

    /*
     ****************************************************************************
     * change event for atencion field
     ****************************************************************************
     */
    var $emrg_fieldEmp      = jQuery('select[id="formPrcEmergencyRequestIdEmpleado"]');

    /*
     * specialty change event
     */
    $emrg_fieldAtn.change(function(e, a, b) {
	var field_arAtn_val = $emrg_fieldArAtn.val();
        var field_atn_val   = jQuery(this).val();
	var field_emp_val   = $emrg_fieldEmp.val();

        $emrg_fieldEmp.find('option').prop('disabled', true);        // disable all options first
        $emrg_fieldEmp.select2('val', '').prop('disabled', true);    // remove selection
        /*
         * search in javascript object
         */
        $.each(GROUP_DEPENDENT_ENTITIES, function(i, v) {
            if (i === 'atn_emp') {
                $.each(v, function(x, y) {
                    if (y.id_ar === parseInt(field_arAtn_val, 10) && y.id_atn === parseInt(field_atn_val, 10)) {
                        $emrg_fieldEmp.find('option[value=' + y.id_emp + ']').prop('disabled', false);  // disable if option value is in result
                        if (jQuery.isEmptyObject(field_emp_val) === false && parseInt(field_emp_val, 10) === y.id_emp)
                        {
                            $emrg_fieldEmp.select2('val', y.id_emp);    // set selected value
                        }
                    }
                });
            }
        });
        if (jQuery.isEmptyObject(field_atn_val) === false)
        {
            $emrg_fieldEmp.prop('disabled', false); // set selection and enable select2
        }
        $form_prcEmrgRq.formValidation('revalidateField', 'formPrcEmergencyRequestIdEmpleado');   // revalidate select2
        $emrg_fieldEmp.trigger('change', [a, b]);   // trigger next cascade select2
        if (field_atn_val && !field_emp_val) {
            $emrg_fieldEmp.select2("search", "");   // search if empty
        }
        if (typeof a !== "undefined" && a !== false) {
            $form_prcEmrgRq.fv_resetValidationForm();   // --| resetForm
        }
    });
    
    
    /*
     * **************************************************************************
     * --| ASIGNAR NUEVO EXPEDIENTE
     * **************************************************************************
     */
    var $modal_assignNewRecord  = jQuery('#asignarNuevoExpediente-modal');
    var $btn_assignNewRecord    = jQuery('#btn_unknown_patient_assign_newRecord');
    
    $table_prc.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        $btn_assignNewRecord.prop('disabled', !$table_prc.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        ARR_PRC_SELECTIONS = getIdStudyRequestSelections();
        // push or splice the selections if you want to save all data selections
    });
    
    /*
     * bstable selections
     * @returns {Array}
     */
    function getIdStudyRequestSelections() {
        return $.map($table_prc.bootstrapTable('getSelections'), function (row) {
            return row.prc_id;
        });
    }

    $btn_assignNewRecord.click(function(e) {
//        e.preventDefault();
        
//        var $btn_this   = jQuery(this);
        
//        jQuery('#explocal_formAssignNewRegister-static-label').html(ARR_PRC_SELECTIONS.join(', '));
        
        $modal_assignNewRecord.modal(); // open dialog for change record

    });

});

/*
 * ******************************************************************************
 * handle selections for img_solicitud_estudio
 * ******************************************************************************
 */

function selectableRowFormatter(value, row, index) {
//    if (index === 2) {
//        return {
//            disabled: true
//        };
//    }
//    if (index === 5) {
//        return {
//            disabled: true,
//            checked: true
//        }
//    }
    return value;
}

(function ($) {
    /*
     *
     * @type Array
     * Global variables for plugin
     */
    window.ARR_PRC_SELECTIONS = [];   // --| build data collection

}(jQuery));
