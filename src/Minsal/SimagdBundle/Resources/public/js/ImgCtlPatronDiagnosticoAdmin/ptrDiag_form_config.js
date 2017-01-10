/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_ptrDiag = 'edit';

jQuery(document).ready(function() {
    
    /** DOM elements */
    var $form_ptrDiag 	= jQuery('#crearPatronDiagnosticoForm');
    var $modal_ptrDiag 	= jQuery('#crearPatronDiagnostico-modal');
    
    /** Nuevo patron para diagnóstico */
    $form_ptrDiag.formValidation({
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
		$modal_ptrDiag
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_ptrDiag
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
		$modal_ptrDiag
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_ptrDiag
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
		
	    var url   = $action_ptrDiag == 'edit' ? 'simagd_patron_diagnostico_editarPatronDiagnostico' : 'simagd_patron_diagnostico_crearPatronDiagnostico';
	
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
				console.log('Patron para diagnóstico' + ($action_ptrDiag == "edit" ? ' editado' : ' creado') + ' satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_ptrDiag.modal('hide');
				$action_ptrDiag == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_ptrDiag == "edit" ? ' editar' : ' crear') + ' patron para diagnóstico');
				console.log(e.error);
				console.log(e.responseText);
				$modal_ptrDiag.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_ptrDiag.on('hide', function() {
	/** destroy summernote */
	$fieldHallazgos.destroySummerNote();
	$fieldConclusion.destroySummerNote();
	$fieldRecomendaciones.destroySummerNote();
	/** summernote */
	
	$form_ptrDiag.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#navbar_btn_nuevoPatron:not([disabled])').click(function(e) {
        jQuery('#btn_agregar_ptrDiag').show();
        jQuery('#btn_editar_ptrDiag').hide();

        jQuery('#formPtrDiagTitle').text('Crear patrón para diagnóstico');
        jQuery('#formPtrDiagLabel').removeClass('label-element-v2')
		.addClass('label-primary-v4').text('Formulario para registro');
        
        $("input[id='formPtrDiagNombre']").val('');
        $("input[id='formPtrDiagCodigo']").val('');
	
	/** text-editor Hallazgos */
	$fieldHallazgos.buildSummerNote({ newOptions: {
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand',     // toolbar
            ___speech   : true,         // active speech recognition
        }});
	/** text-editor Conclusion */
	$fieldConclusion.buildSummerNote({ newOptions: {
	    height: 75,                 // set editor height
	    maxHeight: 100,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand',     // toolbar
            ___speech   : true,         // active speech recognition
	}});
	/** text-editor Recomendaciones */
	$fieldRecomendaciones.buildSummerNote({ newOptions: {
	    height: 90,                 // set editor height
	    maxHeight: 125,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand',     // toolbar
            ___speech   : true,         // active speech recognition
	}});
	/** -- summernote */
	
        $("textarea[id='formPtrDiagIndicacionesGenerales']").val('');
        $("textarea[id='formPtrDiagObservaciones']").val('');
        
        var empDefault = $("select[id='formPtrDiagIdEmpleado']").data('default');
        $("select[id='formPtrDiagIdEmpleado']").select2('val', empDefault);
	
        var modRxDefault = $("select[id='formPtrDiagIdAreaServicioDiagnostico']").data('default');
        $("select[id='formPtrDiagIdAreaServicioDiagnostico']").select2('val', modRxDefault);
        
	if ($is_radX !== false)
	{
	    var radXDefault = $("select[id='formPtrDiagIdRadiologoDefine']").data('default');
	    $("select[id='formPtrDiagIdRadiologoDefine']").select2('val', radXDefault);
	}
	
        var tipoResultDefault = $("select[id='formPtrDiagIdTipoResultado']").data('default');
        $("select[id='formPtrDiagIdTipoResultado']").select2('val', tipoResultDefault);
	
        $modal_ptrDiag.modal();
        
        /* Set the form no validated */
	$form_ptrDiag.data('formValidation').resetForm();
	
	$form_ptrDiag.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	$modal_ptrDiag
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_agregar_ptrDiag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_ptrDiag = 'create';
	
	var $form = $form_ptrDiag;
        $form.submit();
        
    });
    
    jQuery('#btn_editar_ptrDiag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_ptrDiag = 'edit';
	
	var $form = $form_ptrDiag;
        $form.submit();
        
    });
    

    /*
     * SUMMERNOTE Text-Editor for Diagnóstico
     * DOM elements
     */
    var $fieldHallazgos 	= $("[id='formPtrDiagHallazgos']");
    var $fieldConclusion 	= $("[id='formPtrDiagConclusion']");
    var $fieldRecomendaciones 	= $("[id='formPtrDiagRecomendaciones']");
    
});