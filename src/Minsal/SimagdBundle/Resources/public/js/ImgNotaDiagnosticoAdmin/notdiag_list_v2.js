/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_notdiag = 'edit';

function notadiagnostico_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-nota-diagnostico-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar nota al diagnóstico detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-nota-diagnostico-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Editar registro de nota al diagnóstico"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.notadiagnostico_actionEvents = {
    'click .show-nota-diagnostico-action': function (e, value, row, index) {
	console.log(row);
	___actionNotaDiagnosticoSetterObjectModalData(row.notdiag_id, row, {});
        jQuery('#contenidoFullData-showModalContainer').modal();
    },
    'click .edit-nota-diagnostico-action': function (e, value, row, index) {
        jQuery('#btn_agregar_notdiag').hide();
        jQuery('#btn_editar_notdiag').show();
        
        jQuery('#formNotaTitle').text('Editar Nota al diagnóstico');
        jQuery('#formNotaLabel').removeClass('label-primary-v4')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formNotaId']").val(row.notdiag_id);
        
        $("select[id='formNotaIdEmpleado']").select2('val', row.notdiag_id_emisorNota);
        $("select[id='formNotaIdTipoNotaDiagnostico']").select2('val', row.notdiag_id_tipoNota);
	
	/** text-editor Nota */
	$("[id='formNotaContenido']").buildSummerNote({ newOptions: {
	    height: 250,      	// set editor height
	    maxHeight: 300,	// set maximum height of editor
            focus: false,       // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
        $("[id='formNotaContenido']").summernote('code', row.notdiag_contenido);
	/** -- summernote */
	
        $("textarea[id='formNotaObservaciones']").val(jQuery.trim(row.notdiag_observaciones));
        
        jQuery('#crearNota-modal').modal();
	
	/* Set the form no validated */
	jQuery('#crearNotaForm').data('formValidation').resetForm();
	
	jQuery('#crearNotaForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearNota-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
        
        jQuery(window).resize();
    }
};

jQuery(document).ready(function() {

//     alert('http://formvalidation.io/examples/summernote/');

    /** local variable DOM objects */
    var $form_notdiag 	= jQuery('#crearNotaForm');
    var $modal_notdiag 	= jQuery('#crearNota-modal');
  
    /** Tabla de notas a diagnósticos */
    var $table_notdiag 	= jQuery('#table-lista-notas-diagnostico');
    
    $form_notdiag.formValidation({
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
		$modal_notdiag
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_notdiag
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
		$modal_notdiag
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_notdiag
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
		
	    var url   = $action_notdiag == 'edit' ? 'simagd_nota_editarNota' : 'simagd_nota_crearNota';
	
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
				console.log('Nota al diagnóstico' + ($action_notdiag == "edit" ? ' editada' : ' agregada') + ' satisfactoriamente');
				jQuery('#table-lista-notas-diagnostico:visible').bootstrapTable('refresh');
				$modal_notdiag.modal('hide');
				$action_notdiag == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_notdiag == "edit" ? ' editar' : ' agregar') + ' nota al diagnóstico');
				console.log(e.error);
				console.log(e.responseText);
				$modal_notdiag.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_notdiag.on('hide', function() {
	/** destroy summernote */
	$fieldNota.destroySummerNote();
	/** summernote */
	
	$form_notdiag.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_editar_notdiag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_notdiag = 'edit';
	
	var $form = $form_notdiag;
        $form.submit();

    });
    

    /*
     * SUMMERNOTE Text-Editor for Nota de Diagnóstico
     * DOM elements
     */
    var $fieldNota 	= $("[id='formNotaContenido']");
    
});

function check_contenidoNotaDiagnostico(value, validator, $field) {
    /** begin callback function */
    
    var code = $('[name="formNotaContenido"]').summernote('code');
    // <p><br></p> is code generated by Summernote for empty content
    return (code !== '' && code !== '<p><br></p>');
    
    /** end callback function */
}