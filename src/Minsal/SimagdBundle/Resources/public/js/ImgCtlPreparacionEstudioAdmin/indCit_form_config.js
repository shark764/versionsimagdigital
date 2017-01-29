/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_indCit = 'edit';

jQuery(document).ready(function() {

    /** DOM elements */
    var $form_indCit 	= jQuery('#crearIndicacionCitaForm');
    var $modal_indCit 	= jQuery('#crearIndicacionCita-modal');

    /** Reset view of bootstrap table on resize window */
    jQuery(window).resize(function () {
	var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
	jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('resetView').bootstrapTable('resetWidth');
	console.log('resetView');
    });

    /** Nuevas indicaciones para citar pacientes */
    $form_indCit.formValidation({
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
		$modal_indCit
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_indCit
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
		$modal_indCit
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_indCit
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

	    var url   = $action_indCit == 'edit' ? 'simagd_preparacion_estudio_editarIndicacionCita' : 'simagd_preparacion_estudio_crearIndicacionCita';
	
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
				console.log('Indicaciones para citar pacientes' + ($action_indCit == "edit" ? ' editadas' : ' creadas') + ' satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_indCit.modal('hide');
				$action_indCit == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_indCit == "edit" ? ' editar' : ' crear') + ' indicaciones para citar pacientes');
				console.log(e.error);
				console.log(e.responseText);
				$modal_indCit.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });

    $modal_indCit.on('hide', function() {
	/** destroy summernote */
	$fieldIndcg.destroySummerNote();
	$fieldRecmd.destroySummerNote();
	/** summernote */
	
	$form_indCit.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');

	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });

    jQuery('#navbar_btn_nuevaIndicacionCita:not([disabled])').click(function(e) {
        jQuery('#btn_agregar_indCit').show();
        jQuery('#btn_editar_indCit').hide();

        jQuery('#formIndCitTitle').text('Registrar Indicaciones para citar pacientes');
        jQuery('#formIndCitLabel').removeClass('label-element-v2')
		.addClass('label-primary-v4').text('Formulario para registro');
	
	/** text-editor Hallazgos */
	$fieldIndcg.buildSummerNote({ newOptions: {}});
	/** text-editor Recomendaciones */
	$fieldRecmd.buildSummerNote({ newOptions: {
	    height: 90,                 // set editor height
	    maxHeight: 125,             // set maximum height of editor
	}});
	/** -- summernote */
	
        $("textarea[id='formIndCitObservaciones']").val('');

        var empDefault = $("select[id='formIndCitIdEmpleado']").data('default');
        $("select[id='formIndCitIdEmpleado']").select2('val', empDefault);

        var modRxDefault = $("select[id='formIndCitIdAreaServicioDiagnosticoAplica']").data('default');
        $("select[id='formIndCitIdAreaServicioDiagnosticoAplica']").select2('val', modRxDefault);

        $modal_indCit.modal();

        /* Set the form no validated */
	$form_indCit.data('formValidation').resetForm();

	$form_indCit.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

	$modal_indCit
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });

    jQuery('#btn_agregar_indCit:not([disabled])').click(function(e) {
        e.preventDefault();

	/** Validate form and submit by ajax */
	$action_indCit = 'create';

	var $form = $form_indCit;
        $form.submit();

    });

    jQuery('#btn_editar_indCit:not([disabled])').click(function(e) {
        e.preventDefault();

	/** Validate form and submit by ajax */
	$action_indCit = 'edit';

	var $form = $form_indCit;
        $form.submit();

    });
    

    /*
     * SUMMERNOTE Text-Editor for Indicaciones Cita
     * DOM elements
     */
    var $fieldIndcg	= $("[id='formIndCitPreparacionEstudio']");
    var $fieldRecmd 	= $("[id='formIndCitRecomendaciones']");

});