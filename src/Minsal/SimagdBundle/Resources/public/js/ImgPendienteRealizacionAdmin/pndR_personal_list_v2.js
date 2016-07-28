/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function pendienteRealizar_personal_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="realizar-personal-pendiente-realizar-action btn btn-primary-v2 btn-outline btn-xs" href="' + row.prz_editUrl + '" target="_blank" title="Realizar examen"' + (row.allowRealizar === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-edit"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="almacenar-personal-pendiente-realizar-action btn btn-element-v2 btn-outline btn-xs " href="javascript:void(0)" title="Actualizar estudio a almacenado en PACS"' + (row.allowActualizarAlmacenado === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-eye-open"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.pendienteRealizar_personal_actionEvents = {
    'click .almacenar-personal-pendiente-realizar-action': function (e, value, row, index) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: Routing.generate('simagd_realizado_actualizarEstudioAlmacenado'),
            data: {
		__prc   : row.prc_id,
		__cit   : row.cit_id,
		__cmpl  : row.solcmpl_id,
		__pndR  : row.pndR_id,
		__prz   : row.prz_id
            },
            success: function(response) {
			console.log('Elemento actualizado satisfactoriamente');
			jQuery('#table-lista-personal-pendientes-realizar').bootstrapTable('remove', {field: 'pndR_id', values: [row.pndR_id]});
			jQuery('#simagd-added-response-bs-alert').addFadeSlideEffect();
            }, error: function(e) {
			  console.log('Se ha producido un error al actualizar elemento');
			  console.log(e.error);
			  console.log(e.responseText);
			  jQuery('#simagd-error-response-bs-alert').addFadeSlideEffect();
            }
        });
    }
};

jQuery(document).ready(function() {
  
});