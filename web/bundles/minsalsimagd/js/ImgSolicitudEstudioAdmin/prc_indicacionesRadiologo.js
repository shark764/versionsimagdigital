/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {

    /*
     * SUMMERNOTE Text-Editor for Indicaciones
     * DOM elements
     */
    var $field_indRadx 	= $("[id='formIndRadxPrcIndicaciones']");
    
    /** DOM elements */
    var $form_indRadx 	= jQuery('#agregarIndicacionesRadiologoForm');
    var $modal_indRadx	= $("#agregarIndicacionesRadiologo-modal");
    
    $form_indRadx.formValidation({
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
		$modal_indRadx
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_indRadx
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
		$modal_indRadx
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_indRadx
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
	
	    /** before serializing form data */
	    $form.find('.summernote').each(function() {
		jQuery(this).val(jQuery(this).code());
	    });

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate('simagd_solicitud_estudio_agregarIndicacionesRadiologo'),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Indicaciones han sido agregadas satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_indRadx.modal('hide');
				$edited_bsAlert.addFadeSlideEffect();
				jQuery('#fc-patient-panel:not([disabled]):visible').loadPacientesSinCita();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al intentar ingresar Indicaciones');
				console.log(e.error);
				console.log(e.responseText);
				$modal_indRadx.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_indRadx.on('hide', function(e, a, b) {
	/** destroy summernote */
	$field_indRadx.destroySummerNote();
	/** summernote */
	
	$form_indRadx.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    jQuery('#btn_agregarIndRadx_prc:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	var $form = $form_indRadx;
        $form.submit();

    });
    
});