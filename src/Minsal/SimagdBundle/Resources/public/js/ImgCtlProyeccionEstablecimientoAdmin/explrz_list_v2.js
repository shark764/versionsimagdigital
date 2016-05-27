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
		'<a class="show-exploracion-local-action btn btn-primary-v2 btn-xs" href="javascript:void(0)" title="Mostrar proyección detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a class="edit-exploracion-local-action btn btn-primary-v2 btn-xs " href="javascript:void(0)" title="Editar registro de proyección"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
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
        jQuery('#formExplrzLabel').removeClass('label-primary-v2')
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
        '<span class=\'label label-' + (row.explrz_habilitado === false ? 'danger' : 'success-v2') + '\'>',
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
	    placeholder: '',
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
	    type: 'post',
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
		    type: 'post',
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
		.addClass('label-primary-v2').text('Formulario para registro');
	
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