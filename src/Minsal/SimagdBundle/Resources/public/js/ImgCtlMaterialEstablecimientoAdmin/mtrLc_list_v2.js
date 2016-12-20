/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var $currentMaterialNoLocal = null;

function actionLocalFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-material-local-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar material detallado"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-material-local-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Editar registro de material"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionLocalEvents = {
    'click .show-material-local-action': function (e, value, row, index) {
	console.log(row);
	actionMaterialLocalSetterObjectModalData(row.mtrLc_id, row, {});
//         jQuery('#materialFullData-showModalContainer').modal();
    },
    'click .edit-material-local-action': function (e, value, row, index) {
        jQuery('#btn_agregar_mtrLc').hide();
        jQuery('#btn_editar_mtrLc').show();
        
        jQuery('#formMtrLcTitle').text('Editar Material local');
        jQuery('#formMtrLcLabel').removeClass('label-primary-v4')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formMtrLcIdMaterialEstablecimiento']").val(row.mtrLc_id);
	
        $("input[id='formMtrLcCantidadDisponible']").val(jQuery.trim(row.mtrLc_cantidadDisponible));
        $("input[id='formMtrLcHabilitado']").iCheck(row.mtrLc_habilitado === false ? 'uncheck' : 'check');
        $("textarea[id='formMtrLcDescripcion']").val(jQuery.trim(row.mtrLc_descripcion));
	
	var $fieldIdMaterial = $("select[id='formMtrLcIdMaterial']");
	
	$.ajax({
	    type: 'post',
	    dataType: 'json',
	    url: Routing.generate('simagd_material_local_obtenerMaterialesNoAgregados'),
	    beforeSend: function() {
			    $fieldIdMaterial.select2('val', '');
			    $fieldIdMaterial.attr('disabled', true);
			    $fieldIdMaterial.find('option:gt(0)').prop('disabled', true);
	    },
	    success: function(data) {
			$.each(data, function(i) {
			    $fieldIdMaterial.find('optgroup[label="Materiales no agregados"]')
				    .append($("<option></option>").attr("value", this.mtrl_id).text(this.mtrl_nombre));
			});
			$fieldIdMaterial.attr('disabled', false);
			
			$fieldIdMaterial.find('optgroup[label="Material agregado"]')
				.append($("<option></option>").attr("value", row.mtrl_id).text(row.mtrl_nombre));
	
			$fieldIdMaterial.select2('val', row.mtrl_id);
			
			/* Set the form no validated */
			jQuery('#crearMaterialLocalForm').data('formValidation').resetForm();
	
			jQuery('#crearMaterialLocalForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
			
			jQuery('#crearMaterialLocal-modal')
			    .find(':submit')
				.removeAttr('disabled')
				.removeClass('disabled');
	    },
	    error: function (data) {
		      console.log(data.error);
		      console.log(data.responseText);
	    }
	});
        
	/** *****************************************
        $("input[id='habilitado']").iCheck('uncheck');
        ****************************************** */
        
        jQuery('#crearMaterialLocal-modal').modal();
        
        /* Set the form no validated */
	jQuery('#crearMaterialLocalForm').data('formValidation').resetForm();
	
	jQuery('#crearMaterialLocalForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearMaterialLocal-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};
    
jQuery(document).ready(function() {
  
    /** Tabla de material local */
    var $table_mtrLc = jQuery('#table-lista-materiales-locales');
	
    /** Editar material local */
    var $table_mtrLcColumns = $table_mtrLc.bootstrapTable('getOptions').columns;
    var $habilitadoOptions = {
	formatter: habilitadoFormatter,
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
		jQuery(this).html(habilitadoFormatter(newValue, { mtrLc_habilitado: $chk }, null));
		console.log(jQuery(this));
	    }
	}
    };
    
    $.each($table_mtrLcColumns, function (i, column) {
	if (column.field == 'mtrLc_habilitado') {
	    jQuery.extend(true, $table_mtrLcColumns[i], $habilitadoOptions);
	}
    });

    /** Activar edición de estado si el usuario tiene permisos */
    if ($mtrLc_is_granted_changeStatus !== false) {
	$table_mtrLc.bootstrapTable('destroy');
	$table_mtrLc.bootstrapTable({
	    columns: $table_mtrLcColumns
	});
    }
    
    $table_mtrLc.on('editable-save.bs.table', function (e, field, row, oldValue, $object) {
	var $chkHbl = false;
	if ('sí' === jQuery.trim(row.mtrLc_habilitado)) {
	    $chkHbl = true;
	} else {
	    $chkHbl = false;
	}
	$.ajax({
	    type: 'post',
	    dataType: 'json',
	    url: Routing.generate('simagd_material_local_habilitarMaterial'),
            data: {
		id: row.mtrLc_id,
		formMtrLcHabilitado: $chkHbl
	    },
	    success: function(response) {
			row['mtrLc_habilitado'] = $chkHbl;
			$table_mtrLc.bootstrapTable('updateRow', {
			    index: $object.parents('tr[data-index]').data('index'),
			    row: row
			});
			$table_mtrLc.bootstrapTable('resetView');
			console.log('editable-save.bs.table');
			console.log('Material habilitado de: \'' + oldValue + '\' a \'' + $chkHbl + '\' satisfactoriamente');
	    },
	    error: function(e) {
		      console.log('Se ha producido un error al habilitar material local');
		      console.log(e.error);
		      console.log(e.responseText);
		      $error_bsAlert.addFadeSlideEffect();
	    }
	});
	
    });
    /** Fin de edición de material local */
    
});

function habilitadoFormatter(value, row, index) {
    return [
        '<span class=\'label label-' + (row.mtrLc_habilitado === false ? 'warning' : 'success-v3') + '\'>',
        (row.mtrLc_habilitado === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}