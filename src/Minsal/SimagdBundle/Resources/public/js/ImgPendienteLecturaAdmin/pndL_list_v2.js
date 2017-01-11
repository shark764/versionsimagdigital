/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function pendienteLectura_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="leer-pendiente-lectura-action btn btn-primary-v4 btn-outline btn-xs" href="' + row.lct_createUrl + '" target="_blank" title="Interpretar estudio"' + (row.allowInterpretar === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-eye-open"></i> Leer',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="agregar-pendiente-lectura-action btn btn-default btn-outline btn-xs " href="javascript:void(0)" title="Agregar en lista personal"' + (row.allowRegInicial === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-check"></i> Guardar',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.pendienteLectura_actionEvents = {
    'click .agregar-pendiente-lectura-action': function (e, value, row, index) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: Routing.generate('simagd_lectura_agregarPendiente'),
            data: {
		    __est: row.est_id,
		    __xrad: row.pndL_anexadoPorRadiologo,
		    __xradAnx: row.pndL_id_radiologoAnexa,
		    __estPdr: row.estPdr_id
	    },
            success: function(response) {
			console.log('Elemento ingresado en lista personal satisfactoriamente');
			jQuery('#table-lista-pendientes-lectura').bootstrapTable('remove', {field: 'pndL_id', values: [row.pndL_id]});
			jQuery('#simagd-added-response-bs-alert').addFadeSlideEffect();
            },
            error: function(e) {
		      console.log('Se ha producido un error al ingresar elemento');
		      console.log(e.error);
		      console.log(e.responseText);
		      jQuery('#simagd-error-response-bs-alert').addFadeSlideEffect();
            }
        });
    }
};

jQuery(document).ready(function() {
    /*
     * **************************************************************************
     * --| ASIGNAR REGISTROS A RADIOLOGO
     * **************************************************************************
     */
    var $modal_assignRadXWorklist   = jQuery('#asignarRadiologoListaTrabajo-modal');
    var $form_assignRadXWorklist    = jQuery('#asignarRadiologoListaTrabajo-form');
    var $btn_assignRadXWorklist     = jQuery('#btn_add_item_radx_worklist');
    var $field_idRadiologoAsignado  = jQuery('#formPndLWorkListIdRadiologoAsignado');
    /** Tabla de lecturas pendientes */
    var $table_pndL                 = jQuery('#table-lista-pendientes-lectura');

    $table_pndL.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        $btn_assignRadXWorklist.prop('disabled', !$table_pndL.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        ARR_PNDL_SELECTIONS = getIdPndLWorklistSelections();
        // push or splice the selections if you want to save all data selections
    });

    /*
     * bstable selections
     * @returns {Array}
     */
    function getIdPndLWorklistSelections() {
        return $.map($table_pndL.bootstrapTable('getSelections'), function (row) {
            return row.pndL_id;
        });
    }

    $btn_assignRadXWorklist.click(function(e) {
//        jQuery('#explocal_formAssignNewRegister-static-label').html(ARR_PNDL_SELECTIONS.join(', '));
        $field_idRadiologoAsignado.select2('val', $field_idRadiologoAsignado.data('default'));
        $modal_assignRadXWorklist.modal(); // open dialog for change records
    });

    $form_assignRadXWorklist.formValidation({
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
            $modal_assignRadXWorklist
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_assignRadXWorklist
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
            $modal_assignRadXWorklist
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_assignRadXWorklist
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

        var $pndLWorklist_params = {
            __radx: $field_idRadiologoAsignado.val(),
            __ar_rowsAffected: ARR_PNDL_SELECTIONS
        };
        console.log('$pndLWorklist_params', $pndLWorklist_params);

        // Use Ajax to submit form data
        $.ajax({
                type: 'POST',
                dataType: 'json',
                url: Routing.generate('simagd_sin_lectura_addToWorkList'),
                data: $pndLWorklist_params,
                success: function(response) {
                            console.log('Registros han sido asignados a Radiólogo satisfactoriamente');
                            $table_pndL.filter(':visible').bootstrapTable('refresh').bootstrapTable('uncheckAll');
                            $btn_assignRadXWorklist.prop('disabled', true);
                            $modal_assignRadXWorklist.modal('hide');
                            $radXRecord_bsAlert.addFadeSlideEffect();
                },
                error: function(e) {
                            console.log('Se ha producido un error al asignar registros a Radiólogo');
                            console.log(e.error);
                            console.log(e.responseText);
                            $modal_assignRadXWorklist.modal('hide');
                            $error_bsAlert.addFadeSlideEffect();
                }
        });
    });

    $modal_assignRadXWorklist.on('hide', function() {
	$form_assignRadXWorklist.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');

	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });

    jQuery('#btn_asignar_pndLWorkList:not([disabled])').click(function(e) {
        e.preventDefault();
        $form_assignRadXWorklist.submit();
    });

});

(function ($) {
    /*
     *
     * @type Array
     * Global variables for plugin
     */
    window.ARR_PNDL_SELECTIONS = [];   // --| build data collection

}(jQuery));

function postEstudioFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.pndL_solicitudPostEstudio === false ? 'primary-v4' : 'info') + '">',
        (row.pndL_solicitudPostEstudio === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

function anexadoPorRadXFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.pndL_anexadoPorRadiologo === false ? 'primary' : 'primary-v4') + '">',
        (row.pndL_anexadoPorRadiologo === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

function getPostEstudioSourceData(field) {
    return [
	{value: 1, text: 'Lectura solicitada Post estudio'},
    ];
}

//function getCountriesSourceData(field) {
//    return [
//	{id: 'gb', text: 'Great Britain'},
//	{id: 'us', text: 'United States'},
//	{id: 'ru', text: 'Russia'},
//	{id: 'es', text: 'El Salvador'},
//	{id: 'ch', text: 'Chile'},
//	{id: 'cr', text: 'Costa Rica'},
//	{id: 'rd', text: 'República Dominicana'},
//	{id: 'pr', text: 'Puerto Rico'},
//	{id: 'ec', text: 'Ecuador'},
//	{id: 'ag', text: 'Argentina'},
//	{id: 'vn', text: 'Venezuela'},
//	{id: 'mx', text: 'México'},
//	{id: 'hn', text: 'Honduras'},
//	{id: 'gt', text: 'Guatemala'}
//    ];
//}
//
//function getCountriesNumberSourceData(field) {
//    return [
//	{id: 1, text: 'Great Britain'},
//	{id: 2, text: 'United States'},
//	{id: 3, text: 'Russia'},
//	{id: 4, text: 'El Salvador'},
//	{id: 5, text: 'Chile'},
//	{id: 6, text: 'Costa Rica'},
//	{id: 7, text: 'República Dominicana'},
//	{id: 8, text: 'Puerto Rico'},
//	{id: 30, text: 'Ecuador'},
//	{id: 35, text: 'Argentina'},
//	{id: 11, text: 'Venezuela'},
//	{id: 12, text: 'México'},
//	{id: 33, text: 'Honduras'},
//	{id: 26, text: 'Guatemala'}
//    ];
//}