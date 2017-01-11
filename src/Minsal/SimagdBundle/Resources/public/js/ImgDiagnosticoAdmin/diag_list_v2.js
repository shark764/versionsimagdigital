/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_diag = 'edit';

function diagnostico_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-diagnostico-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar diagnóstico detallado"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-diagnostico-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Editar registro de diagnóstico"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="nota-diagnostico-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Emitir nota al diagnóstico"' + (row.allowNota === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-comment"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.diagnostico_actionEvents = {
    'click .show-diagnostico-action': function (e, value, row, index) {
	console.log(row);
	___actionDiagnosticoSetterObjectModalData(row.diag_id, row, {});
        jQuery('#diagnosticoFullData-showModalContainer').modal();
    },
    'click .nota-diagnostico-action': function (e, value, row, index) {
        jQuery('#btn_agregar_notdiag').show();
        jQuery('#btn_editar_notdiag').hide();

        jQuery('#formNotaTitle').text('Registrar Nota al diagnóstico');
        jQuery('#formNotaLabel').removeClass('label-element-v2')
		.addClass('label-primary-v4').text('Formulario para registro');
        
        $("input[id='formNotaIdDiagnostico']").val(row.diag_id);
        
        var empDefault = $("select[id='formNotaIdEmpleado']").data('default');
        $("select[id='formNotaIdEmpleado']").select2('val', empDefault);
        var tipoDefault = $("select[id='formNotaIdTipoNotaDiagnostico']").data('default');
        $("select[id='formNotaIdTipoNotaDiagnostico']").select2('val', tipoDefault);
	
	/** text-editor Nota */
	$("[id='formNotaContenido']").buildSummerNote({ newOptions: {
	    height: 250,      	// set editor height
	    maxHeight: 300,	// set maximum height of editor
            focus: false,       // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
	/** -- summernote */
	
        $("textarea[id='formNotaObservaciones']").val('');
        
        jQuery('#crearNota-modal').modal();
	
	/* Set the form no validated */
	jQuery('#crearNotaForm').data('formValidation').resetForm();
	
	jQuery('#crearNotaForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearNota-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
        
        jQuery(window).resize();
    },
    'click .edit-diagnostico-action': function (e, value, row, index) {
        jQuery('#btn_agregar_diag').hide();
        jQuery('#btn_editar_diag').show();
        
        jQuery('#formDiagTitle').text('Editar diagnóstico');
        jQuery('#formDiagLabel').removeClass('label-primary-v4')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formDiagId']").val(row.diag_id);
        
        $("select[id='formDiagIdEmpleado']").select2('val', row.diag_id_transcriptor);
        $("select[id='formDiagIdEstado']").select2('val', row.diag_id_estado);
	
	/** Patrón definido en lectura */
        $("select[id='formDiagIdPatronAplicado']").select2('val', row.ptrApl_id);
	
	/** text-editor Hallazgos */
	$("[id='formDiagHallazgos']").buildSummerNote({ newOptions: {
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
        $("[id='formDiagHallazgos']").summernote('code', row.diag_hallazgos);
	/** text-editor Conclusion */
	$("[id='formDiagConclusion']").buildSummerNote({ newOptions: {
	    height: 75,                 // set editor height
	    maxHeight: 100,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
        $("[id='formDiagConclusion']").summernote('code', row.diag_conclusion);
	/** text-editor Recomendaciones */
	$("[id='formDiagRecomendaciones']").buildSummerNote({ newOptions: {
	    height: 90,                 // set editor height
	    maxHeight: 125,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
        $("[id='formDiagRecomendaciones']").summernote('code', row.diag_recomendaciones);
	/** -- summernote */
	
        $("textarea[id='formDiagIncidencias']").val(jQuery.trim(row.diag_incidencias));
        $("textarea[id='formDiagObservaciones']").val(jQuery.trim(row.diag_observaciones));
        $("textarea[id='formDiagErrores']").val(jQuery.trim(row.diag_errores));
        
        jQuery('#transcribirDiagnostico-modal').modal();
	
	/* Set the form no validated */
	jQuery('#transcribirDiagnosticoForm').data('formValidation').resetForm();
	
	jQuery('#transcribirDiagnosticoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#transcribirDiagnostico-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
        
        jQuery(window).resize();
    }
};

jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_diag 	= jQuery('#transcribirDiagnosticoForm');
    var $modal_diag 	= jQuery('#transcribirDiagnostico-modal');
  
    /** Tabla de diagnósticos */
    var $table_diag 	= jQuery('#table-lista-diagnosticos');
    
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
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_diag.modal('hide');
				$action_diag == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_diag == "edit" ? ' editar' : ' transcribir') + ' diagnóstico');
				console.log(e.error);
				console.log(e.responseText);
				$modal_diag.modal('hide');
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
    
    $table_diag.on('load-success.bs.table', function (e, data) {
//        $table_diag.find('td').effect( "highlight", { color:"#e0533d" }, 3000 );
    });
    
    jQuery('#btn_agregar_diag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_diag = 'create';
	
	var $form = $form_diag;
        $form.submit();

    });
	
    jQuery('#btn_editar_diag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_diag = 'edit';
	
	var $form = $form_diag;
        $form.submit();

    });
    
    jQuery('#btn_agregar_notdiag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_notdiag = 'create';
	
	var $form = jQuery('#crearNotaForm');
        $form.submit();

    });
    
    jQuery('#btn_filtrar_datos_diag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	var $form = jQuery('#diagFiltrarDatosForm');
	
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: Routing.generate('simagd_diagnostico_generateData'),
		data: $form.formParams(),
		success: function(response) {
			    console.log(response);
		},
		error: function(e) {
			    console.log(e.error);
			    console.log(e.responseText);
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
    
    /*
     * Aplicación de plantilla --> SUMMERNOTE
     */
    $fieldPatronApl.change(function() {
	var $patterVal  = jQuery(this).val();
	
	$.each($DIAGNOSTIC_PATTERN_LIST, function(i, v) {
	    if (v.ptrDiag_id === parseInt($patterVal)) {
		$fieldHallazgos.summernote('code', v.ptrDiag_hallazgos);
		$fieldConclusion.summernote('code', v.ptrDiag_conclusion);
		$fieldRecomendaciones.summernote('code', v.ptrDiag_recomendaciones);
	    }
	});
	if (!$patterVal) {
	    $fieldHallazgos.summernote('reset');
	    $fieldConclusion.summernote('reset');
	    $fieldRecomendaciones.summernote('reset');
	}
    });
    /*
     * change event --> SUMMERNOTE
     */
        
});