/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function pendienteTranscripcion_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="transcribir-pendiente-transcribir-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Transcribir lectura radiológica"' + (row.allowTranscribir === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-edit"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="agregar-pendiente-transcribir-action btn btn-success-v3 btn-outline btn-xs " href="javascript:void(0)" title="Agregar en lista personal"' + (row.allowRegInicial === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-check"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.pendienteTranscripcion_actionEvents = {
    'click .agregar-pendiente-transcribir-action': function (e, value, row, index) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: Routing.generate('simagd_diagnostico_agregarPendiente'),
            data: { __lct: row.lct_id },
            success: function(response) {
			console.log('Elemento ingresado en lista personal satisfactoriamente');
			jQuery('#table-lista-pendientes-transcripcion').bootstrapTable('remove', {field: 'pndT_id', values: [row.pndT_id]});
			jQuery('#simagd-added-response-bs-alert').addFadeSlideEffect();
            },
            error: function(e) {
		      console.log('Se ha producido un error al ingresar elemento');
		      console.log(e.error);
		      console.log(e.responseText);
		      jQuery('#simagd-error-response-bs-alert').addFadeSlideEffect();
            }
        });
    },
    'click .transcribir-pendiente-transcribir-action': function (e, value, row, index) {
        jQuery('#btn_agregar_diag').show();
        jQuery('#btn_editar_diag').hide();

        jQuery('#formDiagTitle').text('Registrar diagnóstico');
        jQuery('#formDiagLabel').removeClass('label-success-v3 label-warning')
		.addClass('label-primary-v4').text('Formulario para registro');
        
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
	
        $("textarea[id='formDiagIncidencias']").val('');
        $("textarea[id='formDiagObservaciones']").val('');
        $("textarea[id='formDiagErrores']").val('');

        $("select[id='formDiagIdPatronAplicado']").select2('val', row.ptrAsc_id);
        $("select[id='formDiagIdPatronAplicado']").trigger("change");
        
        jQuery('#transcribirDiagnostico-modal').modal();
	
	/* Set the form no validated */
	jQuery('#transcribirDiagnosticoForm').data('formValidation').resetForm();
	
	jQuery('#transcribirDiagnosticoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#transcribirDiagnostico-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
		
		console.log(row);
    }
};

jQuery(document).ready(function() {
//    alert('SOLO PUEDE ASIGNARSE SI RADIOLOGO === $id_userEmpLogged');
    /*
     * Registrar diagnóstico --| lista de transcripción|validación
     */
    jQuery('#btn_agregar_diag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_diag = 'create';
	
	var $form = jQuery('#transcribirDiagnosticoForm');
        $form.submit();

    });
    
    
    /*
     * **************************************************************************
     * --| ASIGNAR REGISTROS A TRANSCRIPTOR
     * **************************************************************************
     */
    var $modal_assignTrcXWorklist   = jQuery('#asignarTranscriptorListaTrabajo-modal');
    var $form_assignTrcXWorklist    = jQuery('#asignarTranscriptorListaTrabajo-form');
    var $btn_assignTrcXWorklist     = jQuery('#btn_add_item_trcx_worklist');
    var $field_idTranscriptorAsignado  = jQuery('#formPndTWorkListIdTranscriptorAsignado');
    /** Tabla de lecturas pendientes */
    var $table_pndT                 = jQuery('#table-lista-pendientes-transcripcion');

    $table_pndT.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        $btn_assignTrcXWorklist.prop('disabled', !$table_pndT.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        ARR_PNDT_SELECTIONS = getIdPndTWorklistSelections();
        // push or splice the selections if you want to save all data selections
    });

    /*
     * bstable selections
     * @returns {Array}
     */
    function getIdPndTWorklistSelections() {
        return $.map($table_pndT.bootstrapTable('getSelections'), function (row) {
            return row.pndT_id;
        });
    }

    $btn_assignTrcXWorklist.click(function(e) {
//        jQuery('#explocal_formAssignNewRegister-static-label').html(ARR_PNDT_SELECTIONS.join(', '));
        $field_idTranscriptorAsignado.select2('val', $field_idTranscriptorAsignado.data('default'));
        $modal_assignTrcXWorklist.modal(); // open dialog for change records
    });

    $form_assignTrcXWorklist.formValidation({
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
            $modal_assignTrcXWorklist
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_assignTrcXWorklist
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
            $modal_assignTrcXWorklist
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_assignTrcXWorklist
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

        var $pndTWorklist_params = {
            __trcx: $field_idTranscriptorAsignado.val(),
            __ar_rowsAffected: ARR_PNDT_SELECTIONS
        };
        console.log('$pndTWorklist_params', $pndTWorklist_params);

        // Use Ajax to submit form data
        $.ajax({
                type: 'post',
                dataType: 'json',
                url: Routing.generate('simagd_sin_transcribir_asignarElementoListaTrabajo'),
                data: $pndTWorklist_params,
                success: function(response) {
                            console.log('Registros han sido asignados a Transcriptor satisfactoriamente');
                            $table_pndT.filter(':visible').bootstrapTable('refresh').bootstrapTable('uncheckAll');
                            $btn_assignTrcXWorklist.prop('disabled', true);
                            $modal_assignTrcXWorklist.modal('hide');
                            $trcXRecord_bsAlert.addFadeSlideEffect();
                },
                error: function(e) {
                            console.log('Se ha producido un error al asignar registros a Transcriptor');
                            console.log(e.error);
                            console.log(e.responseText);
                            $modal_assignTrcXWorklist.modal('hide');
                            $error_bsAlert.addFadeSlideEffect();
                }
        });
    });

    $modal_assignTrcXWorklist.on('hide', function() {
	$form_assignTrcXWorklist.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');

	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });

    jQuery('#btn_asignar_pndTWorkList:not([disabled])').click(function(e) {
        e.preventDefault();
        $form_assignTrcXWorklist.submit();
    });

});

(function ($) {
    /*
     *
     * @type Array
     * Global variables for plugin
     */
    window.ARR_PNDT_SELECTIONS = [];   // --| build data collection

}(jQuery));

function impugnadoFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.pndT_fueImpugnado === false ? 'primary-v4' : 'danger') + '">',
        (row.pndT_fueImpugnado === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}