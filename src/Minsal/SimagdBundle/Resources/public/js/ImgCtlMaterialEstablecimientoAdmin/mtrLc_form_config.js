/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_mtrLc = 'edit';
    
jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_mtrLc 	= jQuery('#crearMaterialLocalForm');
    var $modal_mtrLc 	= jQuery('#crearMaterialLocal-modal');
  
    /** Tabla de materiales locales */
    var $table_mtrLc 	= jQuery('#table-lista-materiales-locales');
    
    /** Nuevo material */
    $form_mtrLc.formValidation({
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
		$modal_mtrLc
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_mtrLc
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
		$modal_mtrLc
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_mtrLc
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
		
	    var url   = $action_mtrLc == 'edit' ? 'simagd_material_local_editarMaterialLocal' : 'simagd_material_local_crearMaterialLocal';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Material' + ($action_mtrLc == "edit" ? ' editado' : ' creado') + ' en local satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_mtrLc.modal('hide');
				$action_mtrLc == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_mtrLc == "edit" ? ' editar' : ' crear') + ' material en local');
				console.log(e.error);
				console.log(e.responseText);
				$modal_mtrl.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_mtrLc.on('hide', function() {
	$form_mtrLc.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_agregar_mtrLc:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_mtrLc = 'create';
	
	var $form = $form_mtrLc;
        $form.submit();
        
    });
    
    jQuery('#btn_editar_mtrLc:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_mtrLc = 'edit';
	
	var $form = $form_mtrLc;
        $form.submit();
        
    });
    
    jQuery('#btn_nuevoMaterialLocal:not([disabled])').click(function(e) {
        jQuery('#btn_agregar_mtrLc').show();
        jQuery('#btn_editar_mtrLc').hide();

        jQuery('#formMtrLcTitle').text('Registrar Material en local');
        jQuery('#formMtrLcLabel').removeClass('label-element-v2')
		.addClass('label-primary-v4').text('Formulario para registro');
	
	var $cantidadDisponible = $("input[id='formMtrLcCantidadDisponible']");
        $cantidadDisponible.val($cantidadDisponible.data('default'));
        
        $("input[id='formMtrLcHabilitado']").iCheck('uncheck');
	
        $("textarea[id='formMtrLcDescripcion']").val('');
	
	var $fieldIdMaterial = $("select[id='formMtrLcIdMaterial']");
	
	$.ajax({
	    type: 'post',
	    dataType: 'json',
	    url: Routing.generate('simagd_material_local_obtenerMaterialesNoAgregados'),
	    beforeSend: function() {
			    $fieldIdMaterial.select2('val', '');
			    $fieldIdMaterial.attr('disabled', true);
			    $fieldIdMaterial.find('option:gt(0)').prop('disabled', true);
	    },
	    success: function(data) {
			$.each(data, function(i) {
			    $fieldIdMaterial.find('optgroup[label="Materiales no agregados"]')
				    .append($("<option></option>").attr("value", this.mtrl_id).text(this.mtrl_nombre));
			});
			$fieldIdMaterial.attr('disabled', false);
	
			$fieldIdMaterial.select2('val', '');
			
			/* Set the form no validated */
			$form_mtrLc.data('formValidation').resetForm();
	
			$form_mtrLc.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
			
			$modal_mtrLc
			    .find(':submit')
				.removeAttr('disabled')
				.removeClass('disabled');
	    },
	    error: function (data) {
		      console.log(data.error);
		      console.log(data.responseText);
	    }
	});
        
	/** *****************************************
        $("input[id='habilitado']").iCheck('uncheck');
        ****************************************** */
        
        $modal_mtrLc.modal();
        
        /* Set the form no validated */
	$form_mtrLc.data('formValidation').resetForm();
	
	$form_mtrLc.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	$modal_mtrLc
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
});