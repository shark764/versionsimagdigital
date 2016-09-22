/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_soldiag = 'edit';

function actionSolDiagFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-solicitud-diagnostico-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar solicitud de diagnóstico detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-solicitud-diagnostico-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Editar registro de solicitud de diagnóstico"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

function remotaFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.soldiag_solicitudRemota === false ? 'primary-v4' : 'info') + '">',
        (row.soldiag_solicitudRemota === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

window.actionSolDiagEvents = {
    'click .show-solicitud-diagnostico-action': function (e, value, row, index) {
	console.log(row);
	___actionSolicitudDiagnosticoSetterObjectModalData(row.soldiag_id, row, {});
        jQuery('#solicitudDiagnosticoFullData-showModalContainer').modal();
    },
    'click .edit-solicitud-diagnostico-action': function (e, value, row, index) {
	moment.locale('es');
	
        jQuery('#btn_agregar_soldiag').hide();
        jQuery('#btn_editar_soldiag').show();
        
        jQuery('#formSolicitudDiagTitle').text('Editar Solicitud de Diagnóstico');
        jQuery('#formSolicitudDiagLabel').removeClass('label-primary-v4')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formSolicitudDiagId']").val(row.soldiag_id);
        
        $("input[id='formSolicitudDiagRemota']").iCheck(row.soldiag_solicitudRemota === false ? 'uncheck' : 'check');
        
        $("select[id='formSolicitudDiagIdEmpleado']").select2('val', row.soldiag_id_solicitante);
        $("select[id='formSolicitudDiagIdEstablecimientoSolicitado']").select2('val', row.soldiag_id_solicitado);
        
        $("textarea[id='formSolicitudDiagJustificacion']").val(jQuery.trim(row.soldiag_justificacion));
        $("textarea[id='formSolicitudDiagObservaciones']").val(jQuery.trim(row.soldiag_observaciones));
        
        var rowFechaProximaConsulta = moment(row.soldiag_fechaProximaConsulta, "YYYY-MM-DD");
        $("input[id='formSolicitudDiagFechaProximaConsulta']").val(rowFechaProximaConsulta.format('YYYY-MM-DD'));
        $("input[id='formSolicitudDiagFechaProximaConsulta']").data("DateTimePicker").date(rowFechaProximaConsulta);
	
	$('#btn_descargar_estudio_soldiag').attr('href', jQuery.trim(row.est_url));
        
        jQuery('#crearSolicitudDiag-modal').modal();
        
        /* Set the form no validated */
	jQuery('#crearSolicitudDiagForm').data('formValidation').resetForm();
	
	jQuery('#crearSolicitudDiagForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearSolicitudDiag-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');

        console.log(row);
    }
};

jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_soldiag = jQuery('#crearSolicitudDiagForm');
    var $modal_soldiag = jQuery('#crearSolicitudDiag-modal');
  
    /** Tabla de solicitudes */
    var $table_soldiag = jQuery('#table-lista-solicitudes-diagnostico');
    
    $form_soldiag.formValidation({
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
		$modal_soldiag
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_soldiag
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
		$modal_soldiag
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_soldiag
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
		
	    var url   = $action_soldiag == 'edit' ? 'simagd_solicitud_diagnostico_editarSolicitudDiag' : 'simagd_solicitud_diagnostico_crearSolicitudDiag';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Solicitud de diagnóstico' + ($action_soldiag == "edit" ? ' editada' : ' creada') + ' satisfactoriamente');
				var $target_divContainer_bsTable = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
				jQuery('#' + $target_divContainer_bsTable).find("table:visible").bootstrapTable('refresh');
				$modal_soldiag.modal('hide');
				$action_soldiag == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_soldiag == "edit" ? ' editar' : ' crear') + ' solicitud de diagnóstico');
				console.log(e.error);
				console.log(e.responseText);
				$modal_soldiag.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });
    
    $modal_soldiag.on('hide', function() {
	$form_soldiag.data('formValidation').resetForm();
	jQuery(this).find('.nav-pills a:first').tab('show');
	
	jQuery(this).find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery(this)
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    });
    
    $("input[id='formSolicitudDiagFechaProximaConsulta']").datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.change", function (e) {
	jQuery(this).blur();
    }).on('dp.change dp.show', function(e) {
        $form_soldiag.formValidation('revalidateField', 'formSolicitudDiagFechaProximaConsulta');
    }).prev().click(function(e) {
	e.preventDefault();
	jQuery(this).next().data("DateTimePicker").show();
	console.log(jQuery(this).next().attr('name') + ' displayed');
    });
    
    jQuery('#btn_editar_soldiag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_soldiag = 'edit';
	
	$form_soldiag.submit();

    });
    
});