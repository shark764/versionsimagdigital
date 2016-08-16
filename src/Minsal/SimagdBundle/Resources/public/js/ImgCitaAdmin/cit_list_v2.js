/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function actionCitaFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-cita-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar cita detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-cita-action btn btn-primary-v2 btn-outline btn-xs " href="javascript:void(0)" target="_blank" title="Editar registro de cita"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="confirm-cita-action btn btn-element-v2 btn-outline btn-xs " href="javascript:void(0)" target="_blank" title="Confirmar cita"' + (row.allowConfirm === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-ok"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="radx-ind-solicitud-cita-action btn btn-primary-v2 btn-outline btn-xs " href="javascript:void(0)" title="Agregar indicaciones del Médico radiólogo"' + (row.allowIndRadx === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-log-in"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="cancel-cita-action btn btn-danger btn-outline btn-xs " href="javascript:void(0)" target="_blank" title="Cancelar cita"' + (row.allowCancel === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-trash"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionCitaEvents = {
    'click .show-cita-action': function (e, value, row, index) {
	console.log(row);
	___actionCitaSetterObjectModalData(row.cit_id, row, {});
        jQuery('#citaFullData-showModalContainer').modal();
    },
    'click .edit-cita-action': function (e, value, row, index) {
	/** call method for setting data in form */
	___setDataEditCitForm(e, value, row, index);
    },
    'click .confirm-cita-action': function (e, value, row, index) {
	/** Función ajax */
	___confirmarCitaAction(row.cit_id);
    },
    'click .radx-ind-solicitud-cita-action': function (e, value, row, index) {
	$("input[id='formIndRadxPrcId']").val(row.prc_id);
	
	$("select[id='formIndRadxPrcIdRadiologo']").select2('val', row.prc_id_radXInd);
        
	if (jQuery.isEmptyObject(jQuery.trim(row.prc_id_radXInd)) !== false) {
	    var $default_emp = $("select[id='formIndRadxPrcIdRadiologo']").data('default');
	    $("select[id='formIndRadxPrcIdRadiologo']").select2('val', $default_emp);
	}
	
	/** text-editor Recomendaciones */
	$("[id='formIndRadxPrcIndicaciones']").buildSummerNote({ newOptions: {
	    height: 200,  	// set editor height
	    maxHeight: 250,	// set maximum height of editor
            focus: false,       // set focus to editable area after initializing summernote
	}});
	if (jQuery.isEmptyObject(jQuery.trim(row.prc_id_radXInd)) === false) {
	    $("[id='formIndRadxPrcIndicaciones']").code(row.prc_indicacionesMedicoRadiologo);
	}
	/** -- summernote */
	
	jQuery('#agregarIndicacionesRadiologo-modal').modal();

	/* Set the form no validated */
	jQuery('#agregarIndicacionesRadiologoForm')
		.data('formValidation')
		    .resetForm();
	
	jQuery('#agregarIndicacionesRadiologoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#agregarIndicacionesRadiologo-modal')
		.find(':submit')
		    .removeAttr('disabled')
		    .removeClass('disabled');
    },
    'click .cancel-cita-action': function (e, value, row, index) {
	/** call method for setting data in form */
	___setDataCancelCitForm(e, value, row, index);
    }
};

function reprogramadaFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.cit_reprogramada === false ? 'primary-v2' : 'warning') + '">',
        (row.cit_reprogramada === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

function diaCompletoCitaFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.cit_diaCompleto === false ? 'success-v2' : 'info') + '">',
        (row.cit_diaCompleto === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

function colorCitaFormatter(value, row, index) {
    return [
        '<div class="bloqueo-div-color" title="Color de formato: ' + row.cit_color + '" style="background-color: ' + row.cit_color + '">',
        '&nbsp;',
//        '<i class="glyphicon glyphicon-repeat"></i>',
        '</div>'
    ].join('');
}

function getReprogramadaSourceData(field) {
    return [
	{value: 1, text: 'Ha sido reprogramada'},
    ];
}

jQuery(document).ready(function() {
    
    $('li.list-table-link-navbar').find("a:not([disabled])").off('click').on('click', function (e) {
        var $target_divContainer_bsTable = jQuery(this).data('divtabletarget');
	var $target = jQuery('#' + $target_divContainer_bsTable);
	
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

    var $table_patientdates_list	= jQuery('#table-lista-citas'),
        $btn_toolbar_insert_date	= jQuery('#btn_toolbar_insert_date');

    $(function () {
        $btn_toolbar_insert_date.click(function () {
        	/*
        	 * insert row with filters
        	 */
            $table_patientdates_list.bootstrapTable('insertRow', {
                index: 0,
                row: {
                    cit_tecnologo: '<input type="text" class="form-control input-sm">',
                    prc_modalidad: '<select class="form-control input-sm"><option value=""></option><option value="TOMOGRAFÍA AXIAL COMPUTARIZADA">TOMOGRAFÍA AXIAL COMPUTARIZADA</option></select>',
                    cit_fechaHoraInicio: null,
                    cit_fechaHoraFin: null,
                    cit_estado: null,
                    cit_color: null,
                    prc_paciente: null,
                }
            });
            Admin.setup_select2($table_patientdates_list);
        });

	    $table_patientdates_list.on('column-switch.bs.table', function (e, field, checked) {
	        Admin.setup_select2(jQuery(this));
	    });
    });
    
});


//http://www.suicidegirlssets.com/bae-kitchen-heat/
//http://www.suicidegirlssets.com/tifereth-and-then-comes-the-sun/