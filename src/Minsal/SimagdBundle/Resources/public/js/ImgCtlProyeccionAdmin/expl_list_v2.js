/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function actionFormatter (value, row, index)
{
    /* btn-xs */
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a class="show-exploracion-action btn btn-default btn-xs" href="javascript:void(0)" title="Mostrar proyección detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>  Consultar',
		'</a>',
		'<a class="edit-exploracion-action btn btn-default btn-xs" href="javascript:void(0)" title="Editar registro de proyección"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>  Editar',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a class="catalogo-exploracion-action btn btn-default btn-xs" href="javascript:void(0)" title="Agregar proyección en Catálogo local"' + (row.allowAgregarLc === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-plus-sign"></i>  Catálogo',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
    
//     var $arr_result = [];
//     
//     $arr_result.push('<div class="btn-toolbar" role="toolbar" aria-label="...">');
//     
//     if (row.allowShow !== false || row.allowEdit !== false)
//     {
// 	$arr_result.push(
// 	    '<div class="btn-group" role="group">'
// 	);
//     }
//     
//     if (row.allowShow !== false)
//     {
// 	$arr_result.push(
// 	    '<a class="show-exploracion-action btn btn-default btn-xs" href="javascript:void(0)" title="Mostrar proyección detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
// 		'<i class="glyphicon glyphicon-info-sign"></i>  Consultar',
// 	    '</a>'
// 	);
//     }
//     
//     if (row.allowEdit !== false)
//     {
// 	$arr_result.push(
// 	    '<a class="edit-exploracion-action btn btn-default btn-xs" href="javascript:void(0)" title="Editar registro de proyección"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
// 		'<i class="glyphicon glyphicon-repeat"></i>  Editar',
// 	    '</a>'
// 	);
//     }
//     
//     if (row.allowShow !== false || row.allowEdit !== false)
//     {
// 	$arr_result.push(
// 	    '</div>'
// 	);
//     }
//     
//     if (row.allowAgregarLc !== false)
//     {
// 	$arr_result.push(
// 	    '<div class="btn-group" role="group">',
// 		'<a class="catalogo-exploracion-action btn btn-default btn-xs" href="javascript:void(0)" title="Agregar proyección en Catálogo local"' + (row.allowAgregarLc === false ? ' disabled="disabled"' : '') + '>',
// 		    '<i class="glyphicon glyphicon-plus-sign"></i>  Catálogo',
// 		'</a>',
// 	    '</div>'
// 	);
//     }
//     
//     $arr_result.push('</div>');
//     
//     return $arr_result.join('');
}

window.actionEvents = {
    'click .show-exploracion-action': function (e, value, row, index) {
	console.log(row);
	actionProyeccionSetterObjectModalData(row.expl_id, row, {});
        jQuery('#exploracionFullData-showModalContainer').modal();
    },
    'click .catalogo-exploracion-action': function (e, value, row, index) {
        
        jQuery('#formExplExplrzIdProyeccion-static-label').text(row.expl_nombre);
        jQuery('#formExplExplrzIdExamenServicioDiagnostico-static-label').text(row.exm_descripcion);
        
        $("input[id='formExplExplrzIdProyeccion']").val(row.expl_id);

        var areaSvApyDefault = $("select[id='formExplExplrzIdAreaServicioDiagnostico']").data('default');
        $("select[id='formExplExplrzIdAreaServicioDiagnostico']").select2('val', areaSvApyDefault);
	
        $("input[id='formExplExplrzIdExamenServicioDiagnostico']").val(row.exm_id);/* Necesita un best guess, es decir retornar el area con el q ese examen en este estab tiene un areaExmEst */
        $("textarea[id='formExplExplrzObservaciones']").val('');
        
        $("input[id='formExplExplrzHabilitado']").iCheck('uncheck');
        
        jQuery('#agregar-en-catalogo-modal').modal();
        
        /* Set the form no validated */
	jQuery('#agregarEnLocalForm').data('formValidation').resetForm();
	
	jQuery('#agregarEnLocalForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#agregar-en-catalogo-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    },
    'click .edit-exploracion-action': function (e, value, row, index) {
        jQuery('#btn_agregar_expl').hide();
        jQuery('#btn_editar_expl').show();
        
        jQuery('#formExplTitle').text('Editar Proyección');
        jQuery('#formExplLabel').removeClass('label-primary-v2')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formExplId']").val(row.expl_id);
        
        $("select[id='formExplIdExamenServicioDiagnostico']").select2('val', row.exm_id);
        
        $("input[id='formExplNombre']").val(jQuery.trim(row.expl_nombre));
        $("input[id='formExplCodigo']").val(jQuery.trim(row.expl_codigo));
        $("input[id='formExplTiempoOcupacionSala']").val(jQuery.trim(row.expl_tiempoOcupacionSala));
        $("input[id='formExplTiempoMedico']").val(jQuery.trim(row.expl_tiempoMedico));
        $("textarea[id='formExplDescripcion']").val(jQuery.trim(row.expl_descripcion));
        $("textarea[id='formExplObservaciones']").val(jQuery.trim(row.expl_observaciones));
	
        $("input[id='formExplProyeccionRealizable']").iCheck('uncheck').iCheck('disable');
        $("select[id='formExplIdAreaServicioDiagnostico']").prop("disabled", true).select2('val', '');
        $("input[id='formExplHabilitadoLocal']").iCheck('uncheck').iCheck('disable');
        $("textarea[id='formExplObservacionesLocal']").prop('readonly', true).val('');
        
        jQuery('#crearProyeccion-modal').modal();
        
        /* Set the form no validated */
	jQuery('#crearProyeccionForm').data('formValidation').resetForm();
	
	jQuery('#crearProyeccionForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearProyeccion-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};

/*
 * VALUE IN MINUTES
 */
function simagdValueInMinutesFormatter (value, row, index)
{
    return isValueInteger (value) !== false ? value.toString() + ' Min' : value;
}
function isValueInteger (value)
{
  var x;
  return isNaN(value) ? !1 : (x = parseFloat(value), (0 | x) === x);
}
function simagdTiempoMedicoFormatter (value, row, index)
{
    return jQuery.isEmptyObject(value) === false ? value.toString() + ' Min' : value;
}
function simagdTiempoSalaFormatter (value, row, index)
{
    return jQuery.isEmptyObject(value) === false ? value.toString() + ' Min' : value;
}

function getProyeccionHabilitadaSourceData (field) {
    return [
	{value: 1, text: 'Habilitada'},
    ];
}

function __pryX_selectableRowFormatter (value, row, index) {
    if (row.allowAgregarLc === false) {
        return {
            disabled: true,
            checked: false
        }
    }
    return value;
}

jQuery(document).ready(function() {
    /*
     * **************************************************************************
     * --| AGREGAR REGISTROS A LISTA LOCAL
     * **************************************************************************
     */
    var $modal_addPryXLocalList   = jQuery('#asignarProyeccionListaLocal-modal');
    var $form_addPryXLocalList    = jQuery('#asignarProyeccionListaLocal-form');
    var $btn_addPryXLocalList     = jQuery('#btn_add_pry_locallist');
    var $field_idAreaSrvApyLocalList  = jQuery('#formPryLocalListIdAreaServicioApoyo');
    /** Tabla de lecturas pendientes */
    var $table_pryX                 = jQuery('#table-lista-proyecciones');

    $table_pryX.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        $btn_addPryXLocalList.prop('disabled', !$table_pryX.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        ARR_PRYX_SELECTIONS = getIdPryXLocalListSelections();
        // push or splice the selections if you want to save all data selections
    });

    /*
     * bstable selections
     * @returns {Array}
     */
    function getIdPryXLocalListSelections() {
        return $.map($table_pryX.bootstrapTable('getSelections'), function (row) {
            return row.expl_id;
        });
    }

    $btn_addPryXLocalList.click(function(e) {
//        jQuery('#explocal_formAssignNewRegister-static-label').html(ARR_PRYX_SELECTIONS.join(', '));
        $field_idAreaSrvApyLocalList.select2('val', $field_idAreaSrvApyLocalList.data('default'));
        $modal_addPryXLocalList.modal(); // open dialog for change records
    });

    $form_addPryXLocalList.formValidation({
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
            $modal_addPryXLocalList
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_addPryXLocalList
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
            $modal_addPryXLocalList
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_addPryXLocalList
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

        var $pryXLocalList_params = {
            __mldx: $field_idAreaSrvApyLocalList.val(),
            __ar_rowsAffected: ARR_PRYX_SELECTIONS
        };
        console.log('$pryXLocalList_params', $pryXLocalList_params);

        // Use Ajax to submit form data
        $.ajax({
                type: 'post',
                dataType: 'json',
                url: Routing.generate('simagd_proyeccion_asignarElementoListaLocal'),
                data: $pryXLocalList_params,
                success: function(response) {
                            console.log('Registros han sido agregadps a lista local satisfactoriamente');
                            $table_pryX.filter(':visible').bootstrapTable('refresh').bootstrapTable('uncheckAll');
                            $btn_addPryXLocalList.prop('disabled', true);
                            $modal_addPryXLocalList.modal('hide');
                            $pryListLocalXRecord_bsAlert.addFadeSlideEffect();
                },
                error: function(e) {
                            console.log('Se ha producido un error al agregar registros a lista local');
                            console.log(e.error);
                            console.log(e.responseText);
                            $modal_addPryXLocalList.modal('hide');
                            $error_bsAlert.addFadeSlideEffect();
                }
        });
    });

    $modal_addPryXLocalList.on('hide', function() {
	$form_addPryXLocalList.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');

	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });

    jQuery('#btn_agregar_pryXLocalList:not([disabled])').click(function(e) {
        e.preventDefault();
        $form_addPryXLocalList.submit();
    });

});

(function ($) {
    /*
     *
     * @type Array
     * Global variables for plugin
     */
    window.ARR_PRYX_SELECTIONS = [];   // --| build data collection

}(jQuery));