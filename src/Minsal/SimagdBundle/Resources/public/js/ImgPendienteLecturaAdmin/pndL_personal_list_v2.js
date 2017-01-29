/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function pendienteLectura_personal_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="leer-personal-pendiente-lectura-action btn btn-primary-v4 btn-outline btn-xs" href="' + row.lct_editUrl + '" target="_blank" title="Interpretar estudio"' + (row.allowInterpretar === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-eye-open"></i> Editar',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

jQuery(document).ready(function() {
  
});