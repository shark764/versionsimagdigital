/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function procedimientoRealizado_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-procedimiento-realizado-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar examen detallado"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-procedimiento-realizado-action btn btn-primary-v2 btn-outline btn-xs " href="' + row.prz_editUrl + '" target="_blank" title="Editar registro de examen"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.procedimientoRealizado_actionEvents = {
    'click .show-procedimiento-realizado-action': function (e, value, row, index) {
	console.log(row);
	___actionProcedimientoRealizadoSetterObjectModalData(row.prz_id, row, {});
        jQuery('#procedimientoRealizadoFullData-showModalContainer').modal();
    }
};

jQuery(document).ready(function() {
    
    jQuery('li.list-table-link-navbar').find("a:not([disabled])").off('click').on('click', function (e) {
        var $target_divContainer_bsTable = jQuery(this).data('divtabletarget');
	var $target = $('#' + $target_divContainer_bsTable);
	
	/** Hide popovers */
	$('.fc-event, .fc-bgevent, [data-toggle="popover"]').popover('hide');
	
 	/** Tablas bstable */
        var $target_bsTable                 = $target.find('table[data-toggle="table"]');               // --| get bstable
        var $target_bsTable_url             = $target_bsTable.bootstrapTable('getOptions').url;         // --| get Url
        var $target_bsTable_backupUrl       = $target_bsTable.bootstrapTable('getOptions').backupUrl;   // --| get backupUrl
        
        if (typeof $target_bsTable_url === "undefined" || $target_bsTable_url === null || $target_bsTable_url === "")
        {
            $target_bsTable_url             = jQuery.trim($target.data('refresh-url'));
        }
	console.log(jQuery.trim($target.data('refresh-url')), jQuery.trim($target_bsTable_backupUrl), jQuery.trim($target_bsTable_url));
        
        /*
         * refresh bootstrap table with new filters from BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION.param
         */
        $target_bsTable
                .bootstrapTable('refresh', {
                            url: $target_bsTable_url
                        });
	
 	/** fullCalendar */
	$target.find('#calendar:not([disabled])').fullCalendar('refetchEvents');
	
        $('.' + $pattern_bstable_container).hide();
        $target.show();
        $('li.list-table-link-navbar').removeClass('active')
                .parents("li.list-table-link-navbar-parent").removeClass('active');
        jQuery(this).parents("li").addClass("active");
    });
    
});

function tecnologoAsignadoFormatter(value, row, index) {
    return jQuery.isEmptyObject(row.cit_id_tecnologo) !== false ? jQuery.trim(value) : [
        '<span class="text-primary-v2">',
	    jQuery.trim(value),
        '</span>'
    ].join('');
}