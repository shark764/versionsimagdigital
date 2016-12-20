/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_mtrl = 'edit';

jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_mtrl 		= jQuery('#crearMaterialForm');
    var $modal_mtrl 		= jQuery('#crearMaterial-modal');
    var $form_mtrlMtrLc		= jQuery('#agregarEnLocalForm');
    var $modal_mtrlMtrLc 	= jQuery('#agregar-en-catalogo-modal');
  
    /** Tabla de materiales */
    var $table_mtrl 		= jQuery('#table-lista-materiales');
    
    /** Nuevo material */
    $form_mtrl.formValidation({
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
		$modal_mtrl
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_mtrl
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
		$modal_mtrl
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_mtrl
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
		
	    var url   = $action_mtrl == 'edit' ? 'simagd_material_editarMaterial' : 'simagd_material_crearMaterial';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Material' + ($action_mtrl == "edit" ? ' editado' : ' creado') + ' satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_mtrl.modal('hide');
				$action_mtrl == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_mtrl == "edit" ? ' editar' : ' crear') + ' material');
				console.log(e.error);
				console.log(e.responseText);
				$modal_mtrl.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_mtrl.on('hide', function() {
	$form_mtrl.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    /** Agregar a local */
    $form_mtrlMtrLc.formValidation({
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
		$modal_mtrlMtrLc
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_mtrlMtrLc
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
		$modal_mtrlMtrLc
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_mtrlMtrLc
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
		    url: Routing.generate('simagd_material_local_agregarMaterialEnLocal'),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Material agregado en local satisfactoriamente');
				$table_mtrl.bootstrapTable('refresh');
				$modal_mtrlMtrLc.modal('hide');
				$success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al agregar material');
				console.log(e.error);
				console.log(e.responseText);
				$modal_mtrlMtrLc.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_mtrlMtrLc.on('hide', function() {
	$form_mtrlMtrLc.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_nuevoMaterial:not([disabled])').click(function(e) {
        jQuery('#btn_agregar_mtrl').show();
        jQuery('#btn_editar_mtrl').hide();

        jQuery('#formMtrlTitle').text('Registrar Material');
        jQuery('#formMtrlLabel').removeClass('label-element-v2')
		.addClass('label-primary-v4').text('Formulario para registro');
        
        $("input[id='formMtrlNombre']").val('');
        $("input[id='formMtrlCodigo']").val('');
	
        $("textarea[id='formMtrlDescripcion']").val('');
	
        $("input[id='formMtrlAgregarEnLocal']").iCheck('enable').iCheck('uncheck');
	$("input:checkbox[id='formMtrlAgregarEnLocal']").trigger('ifChanged');
        
	/** *****************************************
        $("input[id='habilitado']").iCheck('uncheck');
        ****************************************** */
	
        $modal_mtrl.modal();
        
        /* Set the form no validated */
	$form_mtrl.data('formValidation').resetForm();
	
	$form_mtrl.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	$modal_mtrl
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_agregar_mtrl:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_mtrl = 'create';
	
	var $form = $form_mtrl;
        $form.submit();
        
    });
    
    jQuery('#btn_editar_mtrl:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_mtrl = 'edit';
	
	var $form = $form_mtrl;
        $form.submit();
        
    });
    
    jQuery('#btn_agregar_mtrlMtrLc:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_mtrl = 'local';
	
	var $form = $form_mtrlMtrLc;
        $form.submit();
        
    });
    
    $(document).on('ifChanged', "input:checkbox[id='formMtrlAgregarEnLocal']", function(e) {
        var $cantidadDisponible = $("input[id='formMtrlCantidadDisponibleLocal']");
	var $cantDefault = $cantidadDisponible.data('default');
	var $habilitado = $("input[id='formMtrlHabilitadoLocal']");
	var $descripcion = $("textarea[id='formMtrlDescripcionLocal']");
        
        if (!jQuery(this).is(':checked')) {
            //Bloquear fields
            $cantidadDisponible.prop('readonly', true).val($cantDefault);
            $habilitado.iCheck('uncheck').iCheck('disable');
            $descripcion.prop('readonly', true).val('');
        }
        else {
            //Desbloquear fields
            $cantidadDisponible.prop('readonly', false).val($cantDefault);
            $habilitado.iCheck('enable').iCheck('uncheck');
            $descripcion.prop('readonly', false).val('');
        }
        $form_mtrl.data('formValidation')
		.updateStatus('formMtrlCantidadDisponibleLocal', 'NOT_VALIDATED');
// 		.validateField('formMtrlCantidadDisponibleLocal');
        $form_mtrl.data('formValidation')
		.updateStatus('formMtrlHabilitadoLocal', 'NOT_VALIDATED');
        $form_mtrl.data('formValidation')
		.updateStatus('formMtrlDescripcionLocal', 'NOT_VALIDATED');
// 		.validateField('formMtrlDescripcionLocal');
	$modal_mtrl
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
        
    });
    $("input:checkbox[id='formMtrlAgregarEnLocal']").trigger('ifChanged');
    
});