/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function actionSolEstudioFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-solicitud-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar solicitud detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-solicitud-action btn btn-primary-v2 btn-outline btn-xs " href="' + row.prc_editUrl + '" target="_blank" title="Editar solicitud de estudio"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="sin-cita-solicitud-action btn btn-default btn-outline btn-xs " href="javascript:void(0)" title="Enviar a lista de trabajo"' + (row.allowSinCita === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-tag"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="radx-ind-solicitud-action btn btn-primary-v2 btn-outline btn-xs " href="javascript:void(0)" title="Agregar indicaciones del Médico radiólogo"' + (row.allowIndRadx === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-log-in"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="sol-diag-solicitud-action btn btn-primary-v2 btn-outline btn-xs " href="javascript:void(0)" title="Solicitar diagnóstico"' + (row.allowSolDiag === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-book"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionSolEstudioEvents = {
    'click .show-solicitud-action': function (e, value, row, index) {
	console.log(row);
	console.log(row.est[0]);
	___actionPreinscripcionSetterObjectModalData(row.prc_id, row, {});
        jQuery('#preinscripcionFullData-showModalContainer').modal();
    },
    'click .sin-cita-solicitud-action': function (e, value, row, index) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: Routing.generate('simagd_solicitud_estudio_requiereCita'),
            data: { id: row.prc_id },
            success: function(response) {
			console.log('Elemento ingresado en lista sin cita satisfactoriamente');
			jQuery('#table-lista-pacientes-sin-cita').bootstrapTable('refresh');
            },
            error: function(e) {
		      console.log('Se ha producido un error al ingresar elemento');
		      console.log(e.error);
		      console.log(e.responseText);
		      jQuery('#simagd-error-response-bs-alert').addFadeSlideEffect();
            }
        });
    },
    'click .radx-ind-solicitud-action': function (e, value, row, index) {
	$("input[id='formIndRadxPrcId']").val(row.prc_id);
	
	$("select[id='formIndRadxPrcIdRadiologo']").select2('val', row.prc_id_radXInd);
        
	if (jQuery.isEmptyObject(jQuery.trim(row.prc_id_radXInd)) !== false) {
	    var $default_emp = $("select[id='formIndRadxPrcIdRadiologo']").data('default');
	    $("select[id='formIndRadxPrcIdRadiologo']").select2('val', $default_emp);
	}
	
	/** text-editor Recomendaciones */
	$("[id='formIndRadxPrcIndicaciones']").buildSummerNote({ newOptions: {
	    height: 200,  	// set editor height
	    maxHeight: 250,	// set maximum height of editor
            focus: false,       // set focus to editable area after initializing summernote
	}});
	if (jQuery.isEmptyObject(jQuery.trim(row.prc_id_radXInd)) === false) {
	    $("[id='formIndRadxPrcIndicaciones']").summernote('code', row.prc_indicacionesMedicoRadiologo);
	}
	/** -- summernote */
	
	jQuery('#agregarIndicacionesRadiologo-modal').modal();

	/* Set the form no validated */
	jQuery('#agregarIndicacionesRadiologoForm')
		.data('formValidation')
		    .resetForm();
	
	jQuery('#agregarIndicacionesRadiologoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#agregarIndicacionesRadiologo-modal')
		.find(':submit')
		    .removeAttr('disabled')
		    .removeClass('disabled');
    },
    'click .sol-diag-solicitud-action': function (e, value, row, index) {
	moment.locale('es');
	
        jQuery('#btn_agregar_soldiag').show();
        jQuery('#btn_editar_soldiag').hide();
        
        jQuery('#formSolicitudDiagTitle').text('Registrar Solicitud de Diagnóstico');
        jQuery('#formSolicitudDiagLabel').removeClass('label-element-v2')
		.addClass('label-primary-v2').text('Formulario para edición');
        
        $("input[id='formSolicitudDiagIdSolicitudEstudio']").val(row.prc_id);
        $("input[id='formSolicitudDiagIdEstudio']").val(row.est[0].est_id);
        
        var $default_emp = $("select[id='formSolicitudDiagIdEmpleado']").data('default');
        $("select[id='formSolicitudDiagIdEmpleado']").select2('val', $default_emp);
        $("input[id='formSolicitudDiagRemota']").iCheck('uncheck');
        var estabDefault = $("select[id='formSolicitudDiagIdEstablecimientoSolicitado']").data('default');
        $("select[id='formSolicitudDiagIdEstablecimientoSolicitado']").select2('val', estabDefault);
        
        $("textarea[id='formSolicitudDiagJustificacion']").val('');
        $("textarea[id='formSolicitudDiagObservaciones']").val('');
        
        var fechaProximaConsulta = moment().add(8, 'd');
        $("input[id='formSolicitudDiagFechaProximaConsulta']").val( fechaProximaConsulta.format('YYYY-MM-DD'));
        $("input[id='formSolicitudDiagFechaProximaConsulta']").data("DateTimePicker").date(fechaProximaConsulta);
	
	$('#btn_descargar_estudio_soldiag').attr('href', jQuery.trim(row.est[0].est_url));
        
        jQuery('#crearSolicitudDiag-modal').modal();
        
        /* Set the form no validated */
	jQuery('#crearSolicitudDiagForm').data('formValidation').resetForm();
	
	jQuery('#crearSolicitudDiagForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearSolicitudDiag-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};

jQuery(document).ready(function() {
  
    /** Tabla de solicitudes */
    var $table_prc = jQuery('#table-lista-pacientes-sin-cita');
	
    /** Editar prioridad de atención */
    var $table_prcColumns = $table_prc.bootstrapTable('getOptions').columns;
    var $prioridadOptions = {
	formatter: simagdPrioridadAtencionFormatter,
	editable: {
	    type: 'select2',
	    emptyclass: 'editable-empty-v2',
	    emptytext: '...',
	    defaultValue: '...',
	    title: 'Nueva prioridad',
	    placeholder: '',
	    allowClear: true,
	    dropdownAutoWidth : true,
	    inputclass: 'input-editable-width-v2',
	    source: $selectionsPriority,
	    display: function(value, response) {
		return false;   //disable this method
	    },
	    success: function(response, newValue) {
		var $prd = null;
		$.each($listPriority, function(i, v) {
		    if (v.text === jQuery.trim(newValue)) {
			$prd = jQuery.extend({}, {prAtn_id: v.id, prAtn_codigo: v.cod, prAtn_nombre: v.text, prAtn_estiloPresentacion: v.style});
		    }
		});
		jQuery(this).html(simagdPrioridadAtencionFormatter(newValue, $prd, null));
	    }
	}
    };
    
    $.each($table_prcColumns, function (i, column) {
	if (column.field == 'prAtn_nombre') {
	    jQuery.extend(true, $table_prcColumns[i], $prioridadOptions);
	}
    });

    /** Activar edición de prioridad si el usuario tiene permisos */
    if ($prc_is_granted_changePriority !== false) {
	$table_prc.bootstrapTable('destroy');
	$table_prc.bootstrapTable({
	    columns: $table_prcColumns
	});
    }
    
    $table_prc.on('editable-save.bs.table', function (e, field, row, oldValue, $object) {
	var $prc_id_prAtn = null;
	$.each($listPriority, function(i, v) {
	    if (v.text === jQuery.trim(row.prAtn_nombre)) {
		$prc_id_prAtn = jQuery.extend({}, {prAtn_id: v.id, prAtn_codigo: v.cod, prAtn_nombre: v.text, prAtn_estiloPresentacion: v.style});
	    }
	});
	$.ajax({
	    type: 'post',
	    dataType: 'json',
	    url: Routing.generate('simagd_solicitud_estudio_cambiarPrioridadAtencionSolicitud'),
            data: {
		id: row.prc_id,
		formPrcEditIdPrioridadAtencion: $prc_id_prAtn.prAtn_id
	    },
	    success: function(response) {
			row['prAtn_id']                 = $prc_id_prAtn.prAtn_id;
			row['prAtn_codigo']             = $prc_id_prAtn.prAtn_codigo;
			row['prAtn_estiloPresentacion'] = $prc_id_prAtn.prAtn_estiloPresentacion;
			$table_prc.bootstrapTable('updateRow', {
			    index: $object.parents('tr[data-index]').data('index'),
			    row: row
			});
			$table_prc.bootstrapTable('resetView');
			console.log('editable-save.bs.table');
			console.log('Prioridad \'' + jQuery.trim(oldValue) + '\' modificada a \'' + jQuery.trim(row.prAtn_nombre) + '\' satisfactoriamente');
	    },
	    error: function(e) {
		      console.log('Se ha producido un error al modificar prioridad de solicitud');
		      console.log(e.error);
		      console.log(e.responseText);
		      $error_bsAlert.addFadeSlideEffect();
	    }
	});
	
    });
    /** Fin de edición de prioridad de atención */
    
    /** Opción crear solicitud de diagnóstico */
    jQuery('#btn_agregar_soldiag:not([disabled])').click(function(e) {
        e.preventDefault();
	
	/** Validate form and submit by ajax */
	$action_soldiag = 'create';
	
	var $form = jQuery('#crearSolicitudDiagForm');
	$form.submit();

    });

    /*
     * field typeahead select event
     */
    $('.typeahead.explocal_navbar_typeahead')
            .filter(':not([disabled]):enabled:not([readonly])')
                    .on('myevt:ttsuggestion', function(e, ttevt, suggestion) {
                        jQuery('#btn_navbar_add_prc')
                            .attr('href', Routing.generate('simagd_solicitud_estudio_create',
                                    {
                                        __exp: jQuery.isEmptyObject(suggestion.exp_id) === false ? suggestion.exp_id : null
                                    }
                            ));

                        jQuery('#btn_navbar_add_prc').prop('disabled', false);
                        jQuery('#btn_navbar_add_prc')
                                .parents('li')
                                .removeClass('disabled');
                    })
                    .on('myevt:ttclear', function(e, ttevt, suggestion) {
                        jQuery('#btn_navbar_add_prc')
                            .attr('href', 'javascript:void(0)');

                        jQuery('#btn_navbar_add_prc').prop('disabled', true);
                        jQuery('#btn_navbar_add_prc')
                                .parents('li')
                                .addClass('disabled');
                    });
                    
        $('.typeahead.explocal_navbar_typeahead')
            .filter(':not([disabled]):enabled:not([readonly])')
                    .trigger('myevt:ttclear');
    
    /*
     * **************************************************************************
     *          --| EXPAND VIEW: pacientes sin cita --> bootstrapTable()
     * **************************************************************************
     */
    
    /*
     * fc-patient-panel, show refresh patient without date message
     * @type @call;$
     */
    var $fc_patient_panel  = $('[id="fc-patient-panel"]');
    
    /*
     * expand agenda view
     */
    jQuery('#panel_patient_btn_expand_view').filter(':not([disabled])').click(function(e) {
        /*
         * hide other elements
         */
        jQuery('#external-events, #container_fc_agenda_view').hide('slide', {direction: 'left'}, 100);
        /*
         * show bstable for patients
         */
        jQuery('#div-resultado-pacientes-sin-cita').show('slide', {direction: 'right'}, 100, function() {
            var $table_prc_url             = $table_prc.bootstrapTable('getOptions').url;         // --| get Url
            var $table_prc_backupUrl       = $table_prc.bootstrapTable('getOptions').backupUrl;   // --| get backupUrl

            if (typeof $table_prc_url === "undefined" || $table_prc_url === null || $table_prc_url === "")
            {
                $table_prc_url             = jQuery.trim($table_prc.parents('div.bstable-patiens-nodated').data('refresh-url'));
            }
            console.log('panel_patient_btn_expand_view', jQuery.trim($table_prc.parents('div.bstable-patiens-nodated').data('refresh-url')), jQuery.trim($table_prc_backupUrl), jQuery.trim($table_prc_url));

            /*
             * refresh bootstrap table with new filters from BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION.param
             */
            console.log('$table_prc_url', $table_prc_url, $table_prc.parents('div.bstable-patiens-nodated').attr('id'));
            $table_prc
                    .bootstrapTable('refresh', {
                                url: $table_prc_url
                            });
            jQuery(window).resize();
        });
    });
    /*
     * return to default agenda view
     */
    jQuery('#panel_patient_btn_default_view').filter(':not([disabled])').click(function(e) {
        /*
         * hide other elements
         */
        jQuery('#div-resultado-pacientes-sin-cita').hide('slide', {direction: 'left'}, 100);
        /*
         * show bstable for patients
         */
        jQuery('#container_fc_agenda_view').show('slide', {direction: 'right'}, 100, function() {
            jQuery('#calendar').filter(':not([disabled]):visible').fullCalendar('refetchEvents');
            jQuery(window).resize();
        });
        jQuery('#external-events').show('slide', {direction: 'right'}, 100, function() {
            $fc_patient_panel.filter(':not([disabled])')
                    .loadPacientesSinCita();
        });
    });
    
//    jQuery('#div-resultado-pacientes-sin-cita').hide();
    
});