/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function actionBloqueoFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-bloqueo-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar bloqueo detallado"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-bloqueo-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Editar bloqueo de agenda"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="exclude-radx-bloqueo-action btn btn-element-v2 btn-outline btn-xs " href="javascript:void(0)" title="Excluir Radiólogos de bloqueo de agenda"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-user"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="remove-bloqueo-action btn btn-danger btn-outline btn-xs " href="javascript:void(0)" title="Remover bloqueo de agenda"' + (row.allowRemove === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-trash"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionBloqueoEvents = {
    'click .show-bloqueo-action': function (e, value, row, index) {
	console.log(row);
	___actionBloqueoAgendaSetterObjectModalData(row.blAgd_id, row, {});
        jQuery('#bloqueoAgendaFullData-showModalContainer').modal();
    },
    'click .edit-bloqueo-action': function (e, value, row, index) {
	/** call method for setting data in form */
	___setDataEditBloqueoForm(e, value, row, index);
    },
    'click .exclude-radx-bloqueo-action': function (e, value, row, index) {
	/**  */
	var $blAgd_excl_modal = jQuery('#excluirRadiologoBloqueo-modal');
	$blAgd_excl_modal.fv_displayEditFormInModal({object: row});
	
	jQuery('#formBlAgdExclRadxIdBloqueoAgenda-static-label').text(row.blAgd_titulo);
	jQuery('#formBlAgdExclRadxIdExamenServicioDiagnostico-static-label').text(function(index) {
	    var $mld_text = jQuery.trim(row.blAgd_modalidad);
	    if (typeof $mld_text !== "undefined" && $mld_text !== null && $mld_text !== "") {
		return $mld_text;
	    } else {
		return 'Todas las modalidades';
	    }
	});
	
	$blAgd_excl_modal.modal();
    },
    'click .remove-bloqueo-action': function (e, value, row, index) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: Routing.generate('simagd_bloqueo_agenda_removerBloqueo'),
            data: { id: row.blAgd_id },
            success: function(response) {
			console.log('Bloqueo removido satisfactoriamente');
			jQuery('#calendar:not([disabled])')
				.find('.fc-event, .fc-bgevent, [data-toggle="popover"]')
				    .popover('hide');
			jQuery('#calendar:not([disabled])').fullCalendar('removeEvents', 'bl_' + row.blAgd_id);
			jQuery('#table-lista-bloqueos').bootstrapTable('remove', {field: 'blAgd_id', values: [row.blAgd_id]});
            },
            error: function(e) {
		      console.log('Se ha producido un error al remover bloqueo');
		      console.log(e.error);
		      console.log(e.responseText);
		      jQuery('#simagd-error-response-bs-alert').addFadeSlideEffect();
            }
        });
    }
};

function colorBloqueoFormatter(value, row, index) {
    return [
        '<div class="bloqueo-div-color" title="Color de fondo: ' + row.blAgd_color + '" style="background-color: ' + row.blAgd_color + '">',
        '&nbsp;',
//        '<i class="glyphicon glyphicon-repeat"></i>',
        '</div>'
    ].join('');
}

function diaCompletoBloqueoFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.blAgd_diaCompleto === false ? 'success-v3' : 'warning') + '">',
        (row.blAgd_diaCompleto === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

function getDiaCompletoSourceData(field) {
    return [
	{value: 1, text: 'Abarca día completo'},
    ];
}

jQuery(document).ready(function() {
    
});