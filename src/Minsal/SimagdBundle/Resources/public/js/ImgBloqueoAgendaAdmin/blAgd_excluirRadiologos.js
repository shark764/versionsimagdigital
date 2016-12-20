/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_blAgdExcludeRx 	= jQuery('#excluirRadiologoBloqueo-form');
    var $modal_blAgdExcludeRx   = jQuery('#excluirRadiologoBloqueo-modal');
    
    /*
     * resize modal for multiple combobox change
     */
    $form_blAgdExcludeRx.find('select[multiple]').on('change', function(e) {
        $modal_blAgdExcludeRx.modal('layout');
    });

//    jQuery('#excluirRadiologoBloqueo-modal').modal();
//    jQuery('#formPrcEmergencyRequestSolicitudEstudioProyeccion').change(function () {
//        $modal_blAgdExcludeRx.modal('layout');
//    });

    /** Tabla de solicitudes */
    var $table_blAgdExcludeRx   = jQuery('#table-lista-bloqueos');
    
    $form_blAgdExcludeRx
        // IMPORTANT: You must declare .on('init.field.fv')
        // before calling .formValidation(options)
        .on('init.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

            // You can retrieve the icon element by
            // $icon = data.element.data('fv.icon');

            $icon.on('click.clearing', function() {
                // Check if the field is valid or not via the icon class
                if ($icon.hasClass('glyphicon-remove')) {
                    // Clear the field
                    data.fv.resetField(data.element);
                }
            });
        })
        .formValidation({
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
		$modal_blAgdExcludeRx
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_blAgdExcludeRx
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
		$modal_blAgdExcludeRx
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_blAgdExcludeRx
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
		    url: Routing.generate('simagd_bloqueo_agenda_excluirRadiologoBloqueo'),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Radiólogos excluidos de bloqueo satisfactoriamente');
				$table_blAgdExcludeRx.filter(':visible').bootstrapTable('refresh');
				$modal_blAgdExcludeRx.modal('hide');
				$success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al excluir Radiólogos del bloqueo');
				console.log(e.error);
				console.log(e.responseText);
				$modal_blAgdExcludeRx.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });

    $modal_blAgdExcludeRx.on('hide', function() {
        jQuery(this).fv_hideFormInModal();
    });

    jQuery('#btn_excluirRadx_blAgd:not([disabled])').click(function(e) {
        e.preventDefault();
        $form_blAgdExcludeRx.submit();
    });

    /*
     * unknown patient --| add to list
     */
    jQuery('#btn_unknown_patient_add_item').filter(':not([disabled])').click(function(e) {
        var $btn_this   = jQuery(this);

        /*
         * Expediente (local | ficticio)
         */
        $("input[id='formPrcEmergencyRequestIdExpediente']").val('');
        var arr_pryPrc = []; // create array here
        $.each(row.prc_solicitudEstudioProyeccion, function (i, $pry) {
            arr_pryPrc.push($pry.expl_id); //push values here
        });
        $field.select2('val', jQuery.unique(arr_pryPrc));

        $modal_blAgdExcludeRx.modal();

        /* Set the form no validated */
        $form_blAgdExcludeRx.data('formValidation').resetForm();

        $form_blAgdExcludeRx.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

        $modal_blAgdExcludeRx
            .find(':submit')
                .removeAttr('disabled')
                .removeClass('disabled');

    });

});