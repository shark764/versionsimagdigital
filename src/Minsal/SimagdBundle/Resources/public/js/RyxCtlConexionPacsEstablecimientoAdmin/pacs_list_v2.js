/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-pacs-establecimiento-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar información de pacs detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-pacs-establecimiento-action btn btn-primary-v4 btn-outline btn-xs " href="' + row.pacs_editUrl + '" target="_blank" title="Editar registro de pacs"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionEvents = {
    'click .show-pacs-establecimiento-action': function (e, value, row, index) {
	console.log(row);
	actionPacsSetterObjectModalData(row.pacs_id, row, {});
        jQuery('#pacsFullData-showModalContainer').modal();
    }
};

function habilitadoFormatter(value, row, index) {
    return [
        '<span class=\'label label-' + (row.pacs_habilitado === false ? 'danger' : 'primary-v4') + '\'>',
        (row.pacs_habilitado === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

function duracionEstudioFormatter(value, row, index) {
    var meses = parseFloat(value);
    return meses + ' Meses => <strong>' + (meses/12).toFixed(2) + ' Años</strong>';
}

jQuery(document).ready(function() {
  
    /** Tabla de pacs */
    var $table_pacs = jQuery('#table-lista-pacs-establecimiento');
	
    /** Editar pacs */
    var $table_pacsColumns = $table_pacs.bootstrapTable('getOptions').columns;
    var $habilitadoOptions = {
	formatter: habilitadoFormatter,
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
		jQuery(this).html(habilitadoFormatter(newValue, { pacs_habilitado: $chk }, null));
	    }
	}
    };
    
    $.each($table_pacsColumns, function (i, column) {
	if (column.field == 'pacs_habilitado') {
	    jQuery.extend(true, $table_pacsColumns[i], $habilitadoOptions);
	}
    });

    /** Activar edición de estado si el usuario tiene permisos */
    if ($pacs_is_granted_changeStatus !== false) {
	$table_pacs.bootstrapTable('destroy');
	$table_pacs.bootstrapTable({
	    columns: $table_pacsColumns,
	    url: jQuery.trim($table_pacs.parents('div').data('refresh-url'))
	});
    }
    
    $table_pacs.on('editable-save.bs.table', function (e, field, row, oldValue, $object) {
	var $chkHbl = false;
	if ('sí' === jQuery.trim(row.pacs_habilitado)) {
	    $chkHbl = true;
	} else {
	    $chkHbl = false;
	}
	$.ajax({
	    type: 'POST',
	    dataType: 'json',
	    url: Routing.generate('simagd_pacs_habilitarPacs'),
            data: {
		id: row.pacs_id,
		formPacsHabilitado: $chkHbl
	    },
	    success: function(response) {
			row['pacs_habilitado'] = $chkHbl;
			$table_pacs.bootstrapTable('updateRow', {
			    index: $object.parents('tr[data-index]').data('index'),
			    row: row
			});
			$table_pacs.bootstrapTable('resetView');
			console.log('editable-save.bs.table');
			console.log('Pacs habilitado de: \'' + oldValue + '\' a \'' + $chkHbl + '\' satisfactoriamente');
	    },
	    error: function(e) {
		      console.log('Se ha producido un error al habilitar pacs');
		      console.log(e.error);
		      console.log(e.responseText);
		      $error_bsAlert.addFadeSlideEffect();
	    }
	});
	
    });
    /** Fin de edición de pacs */
    
});