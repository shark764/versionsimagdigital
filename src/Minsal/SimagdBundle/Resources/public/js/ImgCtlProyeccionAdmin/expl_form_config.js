/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_expl = 'edit';

jQuery(document).ready(function() {
    
    /** DOM elements */
    var $form_expl 	= jQuery('#crearProyeccionForm');
    var $modal_expl 	= jQuery('#crearProyeccion-modal');
    var $form_explRz 	= jQuery('#agregarEnLocalForm');
    var $modal_explRz	= jQuery('#agregar-en-catalogo-modal');
    
    /** Nueva proyección */
    $form_expl.formValidation({
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
		$modal_expl
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_expl
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
		$modal_expl
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_expl
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
		
	    var url   = $action_expl == 'edit' ? 'simagd_proyeccion_editarProyeccion' : 'simagd_proyeccion_crearProyeccion';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Proyección' + ($action_expl == "edit" ? ' editada' : ' creada') + ' satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_expl.modal('hide');
				$action_expl == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_expl == "edit" ? ' editar' : ' crear') + ' proyección');
				console.log(e.error);
				console.log(e.responseText);
				$modal_expl.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_expl.on('hide', function() {
	$form_expl.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    /** Agregar a local */
    $form_explRz.formValidation({
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
		$modal_explRz
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_explRz
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
		$modal_explRz
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_explRz
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

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate('simagd_proyeccion_establecimiento_agregarProyeccionEnLocal'),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Proyección agregada en local satisfactoriamente');
				jQuery('#table-lista-proyecciones').bootstrapTable('refresh');
				$modal_explRz.modal('hide');
				$success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al agregar proyección a local');
				console.log(e.error);
				console.log(e.responseText);
				$modal_explRz.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_explRz.on('hide', function() {
	$form_explRz.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_agregar_explrz:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_expl = 'local';
	
	var $form = $form_explRz;
        $form.submit();
        
    });
    
    jQuery('#nuevaProyeccionBtn:not([disabled])').click(function(e) {
        jQuery('#btn_agregar_expl').show();
        jQuery('#btn_editar_expl').hide();

        jQuery('#formExplTitle').text('Registrar Proyección');
        jQuery('#formExplLabel').removeClass('label-element-v2')
		.addClass('label-primary-v4').text('Formulario para registro');
        
        $("input[id='formExplNombre']").val('');
        $("input[id='formExplCodigo']").val('');
	
        $("textarea[id='formExplDescripcion']").val('');
        $("textarea[id='formExplObservaciones']").val('');
	
        $("input[id='formExplProyeccionRealizable']").iCheck('enable').iCheck('uncheck');
	$("input:checkbox[id='formExplProyeccionRealizable']").trigger('ifChanged');
	
        var default_exmRx = $("select[id='formExplIdExamenServicioDiagnostico']").data('default');
        $("select[id='formExplIdExamenServicioDiagnostico']").select2('val', default_exmRx);
	
        var tiempoOcupacionSalaDefault = $("input[id='formExplTiempoOcupacionSala']").data('default');
        $("input[id='formExplTiempoOcupacionSala']").val(tiempoOcupacionSalaDefault);
	
        var tiempoMedicoDefault = $("input[id='formExplTiempoMedico']").data('default');
        $("input[id='formExplTiempoMedico']").val(tiempoMedicoDefault);
	
        $modal_expl.modal();
        
        /* Set the form no validated */
	$form_expl.data('formValidation').resetForm();
	
	$form_expl.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	$modal_expl
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_agregar_expl:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_expl = 'create';
	
	var $form = $form_expl;
        $form.submit();
        
    });
    
    jQuery('#btn_editar_expl:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_expl = 'edit';
	
	var $form = $form_expl;
        $form.submit();
        
    });
    
    $(document).on('ifChanged', "input:checkbox[id='formExplProyeccionRealizable']", function(e) {
        var $areaServicioApoyo = $("select[id='formExplIdAreaServicioDiagnostico']");
	var $default_mldRx = $areaServicioApoyo.data('default');
	var $habilitado = $("input[id='formExplHabilitadoLocal']");
	var $observaciones = $("textarea[id='formExplObservacionesLocal']");
        
        if (!jQuery(this).is(':checked')) {
            //Bloquear fields
	    $form_expl.data('formValidation')
		    .updateStatus('formExplIdAreaServicioDiagnostico', 'NOT_VALIDATED');
            $habilitado.iCheck('uncheck').iCheck('disable');
            $observaciones.prop('readonly', true).val('');
        }
        else {
            //Desbloquear fields
            $areaServicioApoyo.prop("disabled", false).select2('val', $default_mldRx);
            $habilitado.iCheck('enable').iCheck('uncheck');
            $observaciones.prop('readonly', false).val('');
        }
        
        $form_expl.data('formValidation')
		.updateStatus('formExplIdAreaServicioDiagnostico', 'NOT_VALIDATED');
        $form_expl.data('formValidation')
		.updateStatus('formExplHabilitadoLocal', 'NOT_VALIDATED');
        $form_expl.data('formValidation')
		.updateStatus('formExplObservacionesLocal', 'NOT_VALIDATED');
//         $areaServicioApoyo.blur();
        
        if (!jQuery(this).is(':checked')) {
            //Bloquear fields
            $areaServicioApoyo.prop("disabled", true).select2('val', '');
        }
        
	$modal_expl
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
        
    });
    $("input:checkbox[id='formExplProyeccionRealizable']").trigger('ifChanged');
    
});