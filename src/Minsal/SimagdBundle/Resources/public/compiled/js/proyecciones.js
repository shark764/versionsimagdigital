/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"
    
/** Hide and show alerts */
var $pryListLocalXRecord_bsAlert = null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $pryListLocalXRecord_bsAlert = jQuery('#simagd-add-pry-locallist-response-bs-alert');
    
    /** Clone alerts */
    $pryListLocalXRecord_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$pryListLocalXRecord_bsAlert = $pryListLocalXRecord_cloned.clone(true, true);
	$pryListLocalXRecord_bsAlert.insertAfter(jQuery(this));
	console.log('clone pryListLocalXRecord alert');
    });
    var $pryListLocalXRecord_cloned  = $pryListLocalXRecord_bsAlert.clone(true, true);
    
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_expl = 'edit';

jQuery(document).ready(function() {
    
    /** DOM elements */
    var $form_expl 	= jQuery('#crearProyeccionForm');
    var $modal_expl 	= jQuery('#crearProyeccion-modal');
    var $form_explRz 	= jQuery('#agregarEnLocalForm');
    var $modal_explRz	= jQuery('#agregar-en-catalogo-modal');
    
    /** Nueva proyección */
    $form_expl.formValidation({
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
		$modal_expl
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_expl
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
		$modal_expl
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_expl
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
		
	    var url   = $action_expl == 'edit' ? 'simagd_proyeccion_editarProyeccion' : 'simagd_proyeccion_crearProyeccion';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Proyección' + ($action_expl == "edit" ? ' editada' : ' creada') + ' satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_expl.modal('hide');
				$action_expl == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_expl == "edit" ? ' editar' : ' crear') + ' proyección');
				console.log(e.error);
				console.log(e.responseText);
				$modal_expl.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_expl.on('hide', function() {
	$form_expl.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    /** Agregar a local */
    $form_explRz.formValidation({
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
		$modal_explRz
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_explRz
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
		$modal_explRz
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_explRz
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

            // Use Ajax to submit form data
            $.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: Routing.generate('simagd_proyeccion_establecimiento_agregarProyeccionEnLocal'),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Proyección agregada en local satisfactoriamente');
				jQuery('#table-lista-proyecciones').bootstrapTable('refresh');
				$modal_explRz.modal('hide');
				$success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al agregar proyección a local');
				console.log(e.error);
				console.log(e.responseText);
				$modal_explRz.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_explRz.on('hide', function() {
	$form_explRz.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_agregar_explrz:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_expl = 'local';
	
	var $form = $form_explRz;
        $form.submit();
        
    });
    
    jQuery('#nuevaProyeccionBtn:not([disabled])').click(function(e) {
        jQuery('#btn_agregar_expl').show();
        jQuery('#btn_editar_expl').hide();

        jQuery('#formExplTitle').text('Registrar Proyección');
        jQuery('#formExplLabel').removeClass('label-element-v2')
		.addClass('label-primary-v4').text('Formulario para registro');
        
        $("input[id='formExplNombre']").val('');
        $("input[id='formExplCodigo']").val('');
	
        $("textarea[id='formExplDescripcion']").val('');
        $("textarea[id='formExplObservaciones']").val('');
	
        $("input[id='formExplProyeccionRealizable']").iCheck('enable').iCheck('uncheck');
	$("input:checkbox[id='formExplProyeccionRealizable']").trigger('ifChanged');
	
        var default_exmRx = $("select[id='formExplIdExamenServicioDiagnostico']").data('default');
        $("select[id='formExplIdExamenServicioDiagnostico']").select2('val', default_exmRx);
	
        var tiempoOcupacionSalaDefault = $("input[id='formExplTiempoOcupacionSala']").data('default');
        $("input[id='formExplTiempoOcupacionSala']").val(tiempoOcupacionSalaDefault);
	
        var tiempoMedicoDefault = $("input[id='formExplTiempoMedico']").data('default');
        $("input[id='formExplTiempoMedico']").val(tiempoMedicoDefault);
	
        $modal_expl.modal();
        
        /* Set the form no validated */
	$form_expl.data('formValidation').resetForm();
	
	$form_expl.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	$modal_expl
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_agregar_expl:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_expl = 'create';
	
	var $form = $form_expl;
        $form.submit();
        
    });
    
    jQuery('#btn_editar_expl:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_expl = 'edit';
	
	var $form = $form_expl;
        $form.submit();
        
    });
    
    $(document).on('ifChanged', "input:checkbox[id='formExplProyeccionRealizable']", function(e) {
        var $areaServicioApoyo = $("select[id='formExplIdAreaServicioDiagnostico']");
	var $default_mldRx = $areaServicioApoyo.data('default');
	var $habilitado = $("input[id='formExplHabilitadoLocal']");
	var $observaciones = $("textarea[id='formExplObservacionesLocal']");
        
        if (!jQuery(this).is(':checked')) {
            //Bloquear fields
	    $form_expl.data('formValidation')
		    .updateStatus('formExplIdAreaServicioDiagnostico', 'NOT_VALIDATED');
            $habilitado.iCheck('uncheck').iCheck('disable');
            $observaciones.prop('readonly', true).val('');
        }
        else {
            //Desbloquear fields
            $areaServicioApoyo.prop("disabled", false).select2('val', $default_mldRx);
            $habilitado.iCheck('enable').iCheck('uncheck');
            $observaciones.prop('readonly', false).val('');
        }
        
        $form_expl.data('formValidation')
		.updateStatus('formExplIdAreaServicioDiagnostico', 'NOT_VALIDATED');
        $form_expl.data('formValidation')
		.updateStatus('formExplHabilitadoLocal', 'NOT_VALIDATED');
        $form_expl.data('formValidation')
		.updateStatus('formExplObservacionesLocal', 'NOT_VALIDATED');
//         $areaServicioApoyo.blur();
        
        if (!jQuery(this).is(':checked')) {
            //Bloquear fields
            $areaServicioApoyo.prop("disabled", true).select2('val', '');
        }
        
	$modal_expl
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
        
    });
    $("input:checkbox[id='formExplProyeccionRealizable']").trigger('ifChanged');
    
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

console.log('%cSOLO PUEDEN SUPRIMIRSE COLUMNAS O HACER TOOGLE EN MODO DESAGRUPADO\nASI DEBE QUEDAR PARA TODAS LAS TABLAS, SE DEBE HACER BTN-PRIMARY-V3 BTN-OUTLINE\nREPORTES SERAN EN ROJO', 'background: black; color: white;');

// $("html, body").animate({ scrollTop: 5000 }, 2000);
// jQuery(window).load(function () {
// //    window.scrollTo(0, 5000);
//     jQuery("html, body").animate({ scrollTop: 2000 }, 100);
// });

function actionFormatter (value, row, index)
{
    /* btn-xs */
//     return [
// 	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
// 	    '<div class="btn-group" role="group">',
// 		'<a   class="show-exploracion-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar proyección detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
// 		    '<i class="glyphicon glyphicon-info-sign"></i> &nbsp;Ver',
// 		'</a>',
// 		'<a   class="edit-exploracion-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Editar registro de proyección"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
// 		    '<i class="glyphicon glyphicon-repeat"></i> &nbsp;Editar',
// 		'</a>',
// 	    '</div>',
// 	    '<div class="btn-group" role="group">',
// 		'<a   class="catalogo-exploracion-action btn btn-success-v3 btn-outline btn-xs" href="javascript:void(0)" title="Agregar proyección en Catálogo local"' + (row.allowAgregarLc === false ? ' disabled="disabled"' : '') + '>',
// 		    '<i class="glyphicon glyphicon-list-alt"></i> &nbsp;Catálogo',
// 		'</a>',
// 	    '</div>',
// 	'</div>'
//     ].join('');
    
    var $arr_result = [];
    
    $arr_result.push('<div class="btn-toolbar" role="toolbar" aria-label="...">');
    
    if (row.allowShow !== false || row.allowEdit !== false)
    {
	$arr_result.push(
	    '<div class="btn-group" role="group">'
	);
    }
    
    if (row.allowShow !== false)
    {
	$arr_result.push(
	    '<a   class="show-exploracion-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar proyección detallada">',
		'<i class="glyphicon glyphicon-info-sign"></i> &nbsp;Ver',
	    '</a>'
	);
    }
    
    if (row.allowEdit !== false)
    {
	$arr_result.push(
	    '<a   class="edit-exploracion-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Editar registro de proyección">',
		'<i class="glyphicon glyphicon-repeat"></i> &nbsp;Editar',
	    '</a>'
	);
    }
    
    if (row.allowShow !== false || row.allowEdit !== false)
    {
	$arr_result.push(
	    '</div>'
	);
    }
    
    if (row.allowAgregarLc !== false)
    {
	$arr_result.push(
	    '<div class="btn-group" role="group">',
		'<a   class="catalogo-exploracion-action btn btn-success-v3 btn-outline btn-xs" href="javascript:void(0)" title="Agregar proyección en Catálogo local">',
		    '<i class="glyphicon glyphicon-list-alt"></i> &nbsp;Catálogo',
		'</a>',
	    '</div>'
	);
    }
    
    $arr_result.push('</div>');
    
    return $arr_result.join('');
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
        jQuery('#formExplLabel').removeClass('label-primary-v4')
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
                type: 'POST',
                dataType: 'json',
                url: Routing.generate('simagd_proyeccion_addToLocalCatalogue'),
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

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Function encargada de hacer el request al action, y llenar el select con los exámenes regresados, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.

jQuery(document).ready(function() {
    
    $("select[id='formExplrzIdAreaServicioDiagnostico']").change(function() {
        var fieldAreaServicioApoyoVal = jQuery(this).val();
        var $fieldExamenServicioApoyo = $("select[id='formExplrzIdExamenServicioDiagnostico']");
	var fieldExamenServicioApoyoVal = $fieldExamenServicioApoyo.val();
	var imgAtencionVal = '97';
	
	if (fieldAreaServicioApoyoVal) {
            $.ajax({
		type: 'POST',
		dataType: 'json',
		url: Routing.generate('simagd_solicitud_estudio_cargarDatosPorFiltro'),
                data: {
                    param_filterA : fieldAreaServicioApoyoVal,
                    param_filterB : imgAtencionVal,
                    selector : 'exm'
                },
                beforeSend: function() {
				$fieldExamenServicioApoyo.select2('val', '');
				$fieldExamenServicioApoyo.attr('disabled', true);
				$fieldExamenServicioApoyo.find('option:gt(0)').prop('disabled', true);
                },
                success: function(data) {
			    $.each(data.resultados, function(i) {
				$fieldExamenServicioApoyo.append($("<option></option>").attr("value", this.value).text(this.text));
			    });
			    $fieldExamenServicioApoyo.attr('disabled', false);
			    
			    $fieldExamenServicioApoyo
				.select2('val', $initFormNoValidated !== false ?
					    $currentProyeccion.exm_id : fieldExamenServicioApoyoVal);
			    
			    if (fieldAreaServicioApoyoVal && !fieldExamenServicioApoyoVal) {
				$fieldExamenServicioApoyo.select2("search", "");
			    }
			    $fieldExamenServicioApoyo.trigger("change");
                },
                error: function (data) {
			  console.log(data.error);
			  console.log(data.responseText);
                }
            });
        } else  {
            $fieldExamenServicioApoyo.select2('val', '');
            $fieldExamenServicioApoyo.find('option:gt(0)').prop('disabled', true);
	    $fieldExamenServicioApoyo.trigger("change");
        }
    });
    
    $("select[id='formExplrzIdExamenServicioDiagnostico']").change(function() {
        var fieldAreaServicioApoyoVal = $("select[id='formExplrzIdAreaServicioDiagnostico']").val();
        var fieldExamenServicioApoyoVal = jQuery(this).val();
        var $fieldProyeccion = $("select[id='formExplrzIdProyeccion']");
	var fieldProyeccionVal = $fieldProyeccion.val();
	
	if (fieldAreaServicioApoyoVal && fieldExamenServicioApoyoVal) {
            $.ajax({
		type: 'POST',
		dataType: 'json',
		url: Routing.generate('simagd_solicitud_estudio_cargarDatosPorFiltro'),
                data: {
                    param_filterA : fieldAreaServicioApoyoVal,
                    param_filterB : fieldExamenServicioApoyoVal,
                    selector : 'explnrz'
                },
                beforeSend: function() {
				$fieldProyeccion.select2('val', '');
				$fieldProyeccion.attr('disabled', true);
				$fieldProyeccion.find('option:gt(0)').prop('disabled', true);
                },
                success: function(data) {
			    $.each(data.resultados, function(i) {
				$fieldProyeccion.append($("<option></option>").attr("value", this.value).text(this.text));
			    });
			    $fieldProyeccion.attr('disabled', false);
			    
			    /** Proyección ya insertada */
			    if ($currentProyeccion.m_id == fieldAreaServicioApoyoVal && $currentProyeccion.exm_id == fieldExamenServicioApoyoVal) {
				$fieldProyeccion.find('optgroup[label="Proyección insertada"]')
						.append($("<option></option>")
							  .attr("value", $currentProyeccion.expl_id)
							  .text($currentProyeccion.expl_nombre));
			    }
			    
			    $fieldProyeccion
				.select2('val', $initFormNoValidated !== false ?
					    $currentProyeccion.expl_id : fieldProyeccionVal);
			    
			    if (fieldExamenServicioApoyoVal && !fieldProyeccionVal) {
				$fieldProyeccion.select2("search", "");
			    }
			    $fieldProyeccion.trigger("change");
			    
			    if ($initFormNoValidated !== false) {
				jQuery('#crearProyeccionLocalForm').data('formValidation').resetForm();
				jQuery('#crearProyeccionLocal-modal').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
			    }
			    $initFormNoValidated = false;
                },
                error: function (data) {
			  console.log(data.error);
			  console.log(data.responseText);
                }
            });
        } else  {
            $fieldProyeccion.select2('val', '');
            $fieldProyeccion.find('option:gt(0)').prop('disabled', true);
	    $fieldProyeccion.trigger("change");
	    
	    $initFormNoValidated = false;
        }
    });
    
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** Insertada para efectos de edición */
var $currentProyeccion = null;
var $initFormNoValidated = true;

/** action in form for submit */
var $action_expLc = 'edit';

function actionLocalesFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-exploracion-local-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar proyección detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-exploracion-local-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Editar registro de proyección"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionLocalesEvents = {
    'click .show-exploracion-local-action': function (e, value, row, index) {
	console.log(row);
	actionProyeccionLocalSetterObjectModalData(row.explrz_id, row, {});
        jQuery('#exploracionLocalFullData-showModalContainer').modal();
    },
    'click .edit-exploracion-local-action': function (e, value, row, index) {
        jQuery('#btn_crear_explrz').hide();
        jQuery('#btn_editar_explrz').show();
        
        jQuery('#formExplrzTitle').text('Editar Proyección local');
        jQuery('#formExplrzLabel').removeClass('label-primary-v4')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formExplrzId']").val(row.explrz_id);
        $("input[id='formExplrzIdProyeccionInsertada']").val(jQuery.trim(row.expl_id));
        $("input[id='formExplrzNombreInsertada']").val(jQuery.trim(row.expl_nombre));
        
        $("textarea[id='formExplrzObservaciones']").val(jQuery.trim(row.explrz_observaciones));
        
        $("input[id='formExplrzHabilitado']").iCheck(row.explrz_habilitado === false ? 'uncheck' : 'check');
        
        $("select[id='formExplrzIdAreaServicioDiagnostico']").select2('val', row.m_id);
        $("select[id='formExplrzIdExamenServicioDiagnostico']").select2('val', row.exm_id);
        $("select[id='formExplrzIdProyeccion']").select2('val', row.expl_id);
	
	$currentProyeccion = jQuery.extend(true, {},
				      { m_id: row.m_id,
					m_nombrearea: row.m_nombrearea,
					exm_id: row.exm_id,
					exm_descripcion: row.exm_descripcion,
					expl_id: row.expl_id,
					expl_nombre: row.expl_nombre
				      });
	$initFormNoValidated = true;
        
        $("select[id='formExplrzIdAreaServicioDiagnostico']").trigger("change");
        console.log($currentProyeccion);
	
        jQuery('#crearProyeccionLocal-modal').modal();
        
        /* Set the form no validated */
	jQuery('#crearProyeccionLocalForm').data('formValidation').resetForm();
	
	jQuery('#crearProyeccionLocalForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearProyeccionLocal-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};

function habilitadaFormatter(value, row, index) {
    return [
        '<span class=\'label label-' + (row.explrz_habilitado === false ? 'danger' : 'success-v3') + '\'>',
        (row.explrz_habilitado === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}
    
jQuery(document).ready(function() {

    /** DOM elements */
    var $form_expLc 	= jQuery('#crearProyeccionLocalForm');
    var $modal_expLc 	= jQuery('#crearProyeccionLocal-modal');
  
    /** Tabla de locales */
    var $table_explrz = jQuery('#table-lista-proyecciones-locales');
	
    /** Editar proyección local */
    var $table_explrzColumns = $table_explrz.bootstrapTable('getOptions').columns;
    var $habilitadaOptions = {
	formatter: habilitadaFormatter,
	editable: {
	    type: 'select2',
	    emptyclass: 'editable-empty-v2',
	    emptytext: '...',
	    defaultValue: '...',
	    title: 'Habilitar',
	    placeholder: 'click para seleccionar...',
	    allowClear: true,
	    dropdownAutoWidth : true,
	    inputclass: 'input-editable-width-v2',
	    source: [{ id: 'sí', text: 'sí' }, { id: 'no', text: 'no' }],
	    display: function(value, response) {
		return false;   //disable this method
	    },
	    success: function(response, newValue) {
		var $chk = false;
		if ('sí' === jQuery.trim(newValue)) {
		    $chk = true;
		} else {
		    $chk = false;
		}
		jQuery(this).html(habilitadaFormatter(newValue, { explrz_habilitado: $chk }, null));
	    }
	}
    };
    
    $.each($table_explrzColumns, function (i, column) {
	if (column.field == 'explrz_habilitado') {
	    jQuery.extend(true, $table_explrzColumns[i], $habilitadaOptions);
	}
    });

    /** Activar edición de estado si el usuario tiene permisos */
    if ($explrz_is_granted_changeStatus !== false) {
	$table_explrz.bootstrapTable('destroy');
	$table_explrz.bootstrapTable({
	    columns: $table_explrzColumns
	});
    }
    
    $table_explrz.on('editable-save.bs.table', function (e, field, row, oldValue, $object) {
	var $chkHbl = false;
	if ('sí' === jQuery.trim(row.explrz_habilitado)) {
	    $chkHbl = true;
	} else {
	    $chkHbl = false;
	}
	$.ajax({
	    type: 'POST',
	    dataType: 'json',
	    url: Routing.generate('simagd_proyeccion_establecimiento_habilitarLocal'),
            data: {
		id: row.explrz_id,
		formExplrzHabilitado: $chkHbl
	    },
	    success: function(response) {
			row['explrz_habilitado'] = $chkHbl;
			$table_explrz.bootstrapTable('updateRow', {
			    index: $object.parents('tr[data-index]').data('index'),
			    row: row
			});
			$table_explrz.bootstrapTable('resetView');
			console.log('editable-save.bs.table');
			console.log('Proyección habilitada de: \'' + oldValue + '\' a \'' + $chkHbl + '\' satisfactoriamente');
	    },
	    error: function(e) {
		      console.log('Se ha producido un error al habilitar proyección');
		      console.log(e.error);
		      console.log(e.responseText);
		      $error_bsAlert.addFadeSlideEffect();
	    }
	});
	
    });
    /** Fin de edición de proyección local */
    
    /** Nueva en local */
    $form_expLc.formValidation({
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
		$modal_expLc
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_expLc
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
		$modal_expLc
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_expLc
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
		
	    var url   = $action_expLc == 'edit' ? 'simagd_proyeccion_establecimiento_editarProyeccionLocal' : 'simagd_proyeccion_establecimiento_crearProyeccionLocal';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Proyección de local' + ($action_expLc == "edit" ? ' editada' : ' creada') + ' satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_expLc.modal('hide');
				$action_expLc == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_expLc == "edit" ? ' editar' : ' crear') + ' proyección de local');
				console.log(e.error);
				console.log(e.responseText);
				$modal_expLc.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_expLc.on('hide', function() {
	$form_expLc.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_crear_explrz:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_expLc = 'create';
	
	var $form = $form_expLc;
        $form.submit();
        
    });
    
    jQuery('#btn_editar_explrz:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_expLc = 'edit';
	
	var $form = $form_expLc;
        $form.submit();
        
    });
    
    jQuery('#navbar_btn_crearExplEnLocal:not([disabled])').click(function(e) {
        jQuery('#btn_crear_explrz').show();
        jQuery('#btn_editar_explrz').hide();

        jQuery('#formExplrzTitle').text('Registrar Proyección en local');
        jQuery('#formExplrzLabel').removeClass('label-element-v2')
		.addClass('label-primary-v4').text('Formulario para registro');
	
        $("select[id='formExplrzIdAreaServicioDiagnostico']").select2('val', '');
        $("select[id='formExplrzIdExamenServicioDiagnostico']").select2('val', '');
        $("select[id='formExplrzIdProyeccion']").select2('val', '');
        
        $("textarea[id='formExplrzObservaciones']").val('');
        
        $("input[id='formExplrzHabilitado']").iCheck('uncheck');
	
	$currentProyeccion = jQuery.extend(true, {}, {});
	$initFormNoValidated = true;
//         
        $("select[id='formExplrzIdAreaServicioDiagnostico']").trigger("change");
//         console.log($currentProyeccion);
	
        $modal_expLc.modal();
        
        /* Set the form no validated */
	$form_expLc.data('formValidation').resetForm();
	
	$form_expLc.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	$modal_expLc
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
});