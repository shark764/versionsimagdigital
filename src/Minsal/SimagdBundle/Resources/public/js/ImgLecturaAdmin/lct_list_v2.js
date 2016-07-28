/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Declare an empty array using literal notation:
var lecturaCacheShowView = [];
var lecturaCacheShowViewObject = [];

function lectura_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-lectura-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar lectura detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-lectura-action btn btn-primary-v2 btn-outline btn-xs " href="' + row.lct_editUrl + '" target="_blank" title="Editar registro de lectura"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="transcribir-lectura-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Transcribir lectura radiológica"' + (row.allowTranscribir === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-edit"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.lectura_actionEvents = {
    'click .show-lectura-action': function (e, value, row, index) {
	console.log(row);
	___actionLecturaSetterObjectModalData(row.lct_id, row, {});
        jQuery('#lecturaFullData-showModalContainer').modal();
// 	if (jQuery.inArray(row.id, lecturaCacheShowView ) === -1) {
//             $.ajax({ type: 'post', dataType: 'json', url: Routing.generate('simagd_lectura_getObjectVarsAsArray'), data: { id: row.id },
//                 success: function(response) {
//                             console.log(response);
//                             ___actionLecturaSetterObjectModalData(response.id, response.object, {});
//                             lecturaCacheShowView.push(row.id);
//                             lecturaCacheShowViewObject.push({ 'id' : row.id, 'object' : response.object });
//                             console.log('added');
//                 },
//                 error: function(e) {
//                             console.log('Se ha producido un error al recuperar objeto');
//                             console.log(e.error);
//                             console.log(e.responseText);
//                 }
//             });
// 	} else {
// 	    $.each(lecturaCacheShowViewObject, function(indexCache, valueCache) {
// 		if (valueCache.id === row.id) {
//                     console.log(valueCache); /* Solo regresar el id de los incrustados, hacer jQuery.extend(valueCache.object, route getVarsArray()) cada vez q se consulte algo */
//                     ___actionLecturaSetterObjectModalData(valueCache.id, valueCache.object, {});
//                     console.log('is here');
// 		}
// 	    });
// 	}
    },
    'click .transcribir-lectura-action': function (e, value, row, index) {
        jQuery('#btn_agregar_diag').show();
        jQuery('#btn_editar_diag').hide();

        jQuery('#formDiagTitle').text('Registrar diagnóstico');
        jQuery('#formDiagLabel').removeClass('label-success-v2 label-warning')
		.addClass('label-primary-v2').text('Formulario para registro');
        
        $("input[id='formDiagIdLectura']").val(row.lct_id);
        
        var empDefault = $("select[id='formDiagIdEmpleado']").data('default');
        $("select[id='formDiagIdEmpleado']").select2('val', empDefault);
        var estadoDefault = $("select[id='formDiagIdEstado']").data('default');
        $("select[id='formDiagIdEstado']").select2('val', estadoDefault);
	
	/** text-editor Hallazgos */
	$("[id='formDiagHallazgos']").buildSummerNote({ newOptions: {
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
	/** text-editor Conclusion */
	$("[id='formDiagConclusion']").buildSummerNote({ newOptions: {
	    height: 75,                 // set editor height
	    maxHeight: 100,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
	/** text-editor Recomendaciones */
	$("[id='formDiagRecomendaciones']").buildSummerNote({ newOptions: {
	    height: 90,                 // set editor height
	    maxHeight: 125,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
	/** -- summernote */
	
	/** Patrón definido en lectura */
        $("select[id='formDiagIdPatronAplicado']").select2('val', row.ptrAsc_id);
        $("select[id='formDiagIdPatronAplicado']").trigger('change');
	
        $("textarea[id='formDiagIncidencias']").val('');
        $("textarea[id='formDiagObservaciones']").val('');
        $("textarea[id='formDiagErrores']").val('');
        
        jQuery('#transcribirDiagnostico-modal').modal();
	
	/* Set the form no validated */
	jQuery('#transcribirDiagnosticoForm').data('formValidation').resetForm();
	
	jQuery('#transcribirDiagnosticoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#transcribirDiagnostico-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};

function remotaFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.lct_lecturaRemota === false ? 'primary-v2' : 'info') + '">',
        (row.lct_lecturaRemota === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

function solicitadaPorRadiologoFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.lct_solicitadaPorRadiologo === false ? 'primary' : 'primary-v2') + '">',
        (row.lct_solicitadaPorRadiologo === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

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
            $target_bsTable_url             = $.trim($target.data('refresh-url'));
        }
	console.log($.trim($target.data('refresh-url')), $.trim($target_bsTable_backupUrl), $.trim($target_bsTable_url));
        
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
  
    /** Tabla de lecturas */
    var $table_lct          = jQuery('#table-lista-lecturas');
    
    $table_lct.on('load-success.bs.table', function (e, data) {
	lecturaCacheShowView.length = 0;
	lecturaCacheShowViewObject.length = 0;
    });
    
});

function getCountriesNumberSourceData(field) {
    return [
	{id: 1, text: 'Great Britain'},
	{id: 2, text: 'United States'},
	{id: 3, text: 'Russia'},
	{id: 4, text: 'El Salvador'},
	{id: 5, text: 'Chile'},
	{id: 6, text: 'Costa Rica'},
	{id: 7, text: 'República Dominicana'},
	{id: 8, text: 'Puerto Rico'},
	{id: 30, text: 'Ecuador'},
	{id: 35, text: 'Argentina'},
	{id: 11, text: 'Venezuela'},
	{id: 12, text: 'México'},
	{id: 33, text: 'Honduras'},
	{id: 26, text: 'Guatemala'}
    ];
}