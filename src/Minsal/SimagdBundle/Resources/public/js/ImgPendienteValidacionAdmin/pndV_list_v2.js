/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var $current_diagRowForm = null;

/** action in form for submit */
var $action_diag = 'edit';

function pendienteValidacion_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="validar-pendiente-validar-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Verificar transcripción de resultados"' + (row.allowValidate === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-ok"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.pendienteValidacion_actionEvents = {
    'click .validar-pendiente-validar-action': function (e, value, row, index) {
	console.log(row);
	___actionDiagnosticoSetterObjectModalData(row.diag_id, row, {});
	    
	/* modal form-edit */
	$current_diagRowForm = jQuery.extend(true, {}, row);
	
	/** show and aprove */
        jQuery('#btn_aprobar_diag').show();
	/** show and edit */
        jQuery('#btn_diag_show_and_edit').show();
	
	/** show modal */
        jQuery('#diagnosticoFullData-showModalContainer').modal();
    }
};

function corregidoFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.pndV_fueCorregido === false ? 'primary-v4' : 'success-v3') + '">',
        (row.pndV_fueCorregido === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_diag 	= jQuery('#transcribirDiagnosticoForm');
    var $modal_diag 	= jQuery('#transcribirDiagnostico-modal');
    var $detail_diag 	= jQuery('#diagnosticoFullData-showModalContainer');
  
    /** Tabla de diagnósticos sin verificar */
    var $table_pndV 	= jQuery('#table-lista-pendientes-validacion');
    
    $form_diag.formValidation({
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
		$modal_diag
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_diag
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
		$modal_diag
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_diag
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
		
	    var url   = $action_diag == 'edit' ? 'simagd_diagnostico_editarDiagnostico' : 'simagd_diagnostico_transcribirDiagnostico';
	
	    /** before serializing form data */
	    $form.find('.summernote').each(function() {
		jQuery(this).val(jQuery(this).summernote('code'));
	    });

            // Use Ajax to submit form data
            $.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Diagnóstico' + ($action_diag == "edit" ? ' editado' : ' transcrito') + ' satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table").bootstrapTable('refresh');
	// 			$table_pndV.bootstrapTable('refresh');
				$modal_diag.modal('hide');
				$detail_diag.modal('hide');
				$action_diag == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_diag == "edit" ? ' editar' : ' transcribir') + ' diagnóstico');
				console.log(e.error);
				console.log(e.responseText);
				$modal_diag.modal('hide');
				$detail_diag.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_diag.on('hide', function() {
	/** destroy summernote */
	$fieldHallazgos.destroySummerNote();
	$fieldConclusion.destroySummerNote();
	$fieldRecomendaciones.destroySummerNote();
	/** summernote */
	
	$form_diag.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_diag_show_and_edit:not([disabled])').click(function(e) {
        jQuery('#btn_agregar_diag').hide();
        jQuery('#btn_editar_diag').show();
        
        jQuery('#formDiagTitle').text('Verificar transcripción de diagnóstico');
        jQuery('#formDiagLabel').removeClass('label-primary-v4 label-success-v3')
		.addClass('label-warning').text('Formulario para edición');
	
        $("input[id='formDiagId']").val($current_diagRowForm.diag_id);
        
        $("select[id='formDiagIdEmpleado']").select2('val', $current_diagRowForm.diag_id_transcriptor);
        $("select[id='formDiagIdEstado']").select2('val', $current_diagRowForm.diag_id_estado);
	
	/** Patrón definido en lectura */
        $("select[id='formDiagIdPatronAplicado']").select2('val', $current_diagRowForm.ptrApl_id);
	
	/** text-editor Hallazgos */
	$("[id='formDiagHallazgos']").buildSummerNote({ newOptions: {
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
        }});
        $("[id='formDiagHallazgos']").summernote('code', $current_diagRowForm.diag_hallazgos);
	/** text-editor Conclusion */
	$("[id='formDiagConclusion']").buildSummerNote({ newOptions: {
	    height: 75,                 // set editor height
	    maxHeight: 100,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
        $("[id='formDiagConclusion']").summernote('code', $current_diagRowForm.diag_conclusion);
	/** text-editor Recomendaciones */
	$("[id='formDiagRecomendaciones']").buildSummerNote({ newOptions: {
	    height: 90,                 // set editor height
	    maxHeight: 125,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
        $("[id='formDiagRecomendaciones']").summernote('code', $current_diagRowForm.diag_recomendaciones);
	/** -- summernote */
	
        $("textarea[id='formDiagIncidencias']").val(jQuery.trim($current_diagRowForm.diag_incidencias));
        $("textarea[id='formDiagObservaciones']").val(jQuery.trim($current_diagRowForm.diag_observaciones));
        $("textarea[id='formDiagErrores']").val(jQuery.trim($current_diagRowForm.diag_errores));
        
        $modal_diag.modal();
	
	/* Set the form no validated */
	$form_diag.data('formValidation').resetForm();
	
	$form_diag.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	$modal_diag
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });

    jQuery('#btn_editar_diag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_diag = 'edit';
	
	var $form = $form_diag;
        $form.submit();

    });

    jQuery('#btn_aprobar_diag:not([disabled])').click(function(e) {
	e.preventDefault();

	$.ajax({
	    type: 'POST',
	    dataType: 'json',
	    url: Routing.generate('simagd_diagnostico_aprobarDiagnostico'),
	    data: { id: $current_diagRowForm.diag_id },
	    success: function(response) {
			console.log('Diagnóstico aprobado satisfactoriamente');
			var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
			jQuery('#' + $target_divContainer_bsTable).find("table").bootstrapTable('remove', {field: 'pndV_id', values: [$current_diagRowForm.pndV_id]});
	    //            $table_pndV.bootstrapTable('remove', {field: 'pndV_id', values: [$current_diagRowForm.pndV_id]});
			$modal_diag.modal('hide');
			$detail_diag.modal('hide');
			$valid_bsAlert.addFadeSlideEffect();
	    },
	    error: function(e) {
		      console.log('Se ha producido un error al aprobar diagnóstico');
		      console.log(e.error);
		      console.log(e.responseText);
		      $modal_diag.modal('hide');
		      $detail_diag.modal('hide');
		      $error_bsAlert.addFadeSlideEffect();
	    }
	});
    });
    

    /*
     * SUMMERNOTE Text-Editor for Diagnóstico
     * DOM elements
     */
    var $fieldPatronApl 	= $("[id='formDiagIdPatronAplicado']");
    
    var $fieldHallazgos 	= $("[id='formDiagHallazgos']");
    var $fieldConclusion 	= $("[id='formDiagConclusion']");
    var $fieldRecomendaciones 	= $("[id='formDiagRecomendaciones']");
    
    /**
     * Aplicación de plantilla --> SUMMERNOTE
     */
//    $fieldPatronApl.change(function() {
//	var $patterVal  = jQuery(this).val();
//	
//	$.each($DIAGNOSTIC_PATTERN_LIST, function(i, v) {
//	    console.log(v.ptrDiag_id, $patterVal, v.ptrDiag_id === $patterVal);
//	    if (v.ptrDiag_id == $patterVal) {
//		$fieldHallazgos.summernote('code', v.ptrDiag_hallazgos);
//		$fieldConclusion.summernote('code', v.ptrDiag_conclusion);
//		$fieldRecomendaciones.summernote('code', v.ptrDiag_recomendaciones);
//	    }
//        });
//	if (!$patterVal) {
//	    $fieldHallazgos.summernote('reset');
//	    $fieldConclusion.summernote('reset');
//	    $fieldRecomendaciones.summernote('reset');
//	}
//    });
    /*
     * change event --> SUMMERNOTE
     */
    
    /*
     * Formato PATRÓN DIAGNÓSTICO
     */  
    function patternDiagFormat(state)
    {
	if (!state.id)
	{
	    return state.text; // optgroup
	}
	var $arrText = state.text.split('[');
	
	return typeof $arrText[1] === "undefined" ?
	    state.text :
		$arrText[0] +
		'<span class="label label-primary-v4" style="text-align: right; vertical-align: inherit; font-weight: normal;"> [' +
		$arrText[1] +
		' </span>';
    }
    $fieldPatronApl.select2({
	    placeholder: '',
	    allowClear: true,
	    dropdownAutoWidth : true,
	    formatResult: patternDiagFormat,
	    formatSelection: patternDiagFormat,
	    escapeMarkup: function(m) {
			      return m;
			  }
	});
    
});

jQuery(document).ready(function() {
    /*
     * **************************************************************************
     * --| ASIGNAR REGISTROS A RADIOLOGO
     * **************************************************************************
     */
    var $modal_assignRadXValidationWorklist   = jQuery('#asignarRadiologoValidadorListaTrabajo-modal');
    var $form_assignRadXValidationWorklist    = jQuery('#asignarRadiologoValidadorListaTrabajo-form');
    var $btn_assignRadXValidationWorklist     = jQuery('#btn_add_item_radx_validation_worklist');
    var $field_idRadiologoAsignadoValidacion  = jQuery('#formPndVWorkListIdRadiologoAsignado');
    /** Tabla de lecturas pendientes */
    var $table_pndV                 = jQuery('#table-lista-pendientes-validacion');

    $table_pndV.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        $btn_assignRadXValidationWorklist.prop('disabled', !$table_pndV.bootstrapTable('getSelections').length);
        // save your data, here just save the current page
        ARR_PNDV_SELECTIONS = getIdPndVWorklistSelections();
        // push or splice the selections if you want to save all data selections
    });

    /*
     * bstable selections
     * @returns {Array}
     */
    function getIdPndVWorklistSelections() {
        return $.map($table_pndV.bootstrapTable('getSelections'), function (row) {
            return row.pndV_id;
        });
    }

    $btn_assignRadXValidationWorklist.click(function(e) {
//        jQuery('#explocal_formAssignNewRegister-static-label').html(ARR_PNDV_SELECTIONS.join(', '));
        $field_idRadiologoAsignadoValidacion.select2('val', $field_idRadiologoAsignadoValidacion.data('default'));
        $modal_assignRadXValidationWorklist.modal(); // open dialog for change records
    });

    $form_assignRadXValidationWorklist.formValidation({
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
            $modal_assignRadXValidationWorklist
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_assignRadXValidationWorklist
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
            $modal_assignRadXValidationWorklist
                .find(':submit')
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
        } else {
            $modal_assignRadXValidationWorklist
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

        var $pndVWorklist_params = {
            __radx: $field_idRadiologoAsignadoValidacion.val(),
            __ar_rowsAffected: ARR_PNDV_SELECTIONS
        };
        console.log('$pndVWorklist_params', $pndVWorklist_params);

        // Use Ajax to submit form data
        $.ajax({
                type: 'POST',
                dataType: 'json',
                url: Routing.generate('simagd_sin_validar_asignarElementoListaTrabajo'),
                data: $pndVWorklist_params,
                success: function(response) {
                            console.log('Registros han sido asignados a Radiólogo satisfactoriamente');
                            $table_pndV.filter(':visible').bootstrapTable('refresh').bootstrapTable('uncheckAll');
                            $btn_assignRadXValidationWorklist.prop('disabled', true);
                            $modal_assignRadXValidationWorklist.modal('hide');
                            $radXValidationRecord_bsAlert.addFadeSlideEffect();
                },
                error: function(e) {
                            console.log('Se ha producido un error al asignar registros a Radiólogo');
                            console.log(e.error);
                            console.log(e.responseText);
                            $modal_assignRadXValidationWorklist.modal('hide');
                            $error_bsAlert.addFadeSlideEffect();
                }
        });
    });

    $modal_assignRadXValidationWorklist.on('hide', function() {
	$form_assignRadXValidationWorklist.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');

	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });

    jQuery('#btn_asignar_pndVWorkList:not([disabled])').click(function(e) {
        e.preventDefault();
        $form_assignRadXValidationWorklist.submit();
    });

});

(function ($) {
    /*
     *
     * @type Array
     * Global variables for plugin
     */
    window.ARR_PNDV_SELECTIONS = [];   // --| build data collection

}(jQuery));