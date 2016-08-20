/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_prcEmrgRq = 'edit';

function actionSolEstudioFormatter(value, row, index) {
    /*
     * 
     * @type String
     */
    var $BTN_ALLOW_SHOWPRC  = row.allowShow === false ? ' disabled="disabled"' : '';
    var $BTN_ALLOW_EDITPRC  = row.allowEdit === false ? ' disabled="disabled"' : '';
    var $BTN_ALLOW_SKIPDATE = row.allowSinCita === false ? ' disabled="disabled"' : '';
    var $BTN_ALLOW_ADDINDRX = row.allowIndRadx === false ? ' disabled="disabled"' : '';
    var $BTN_ALLOW_DIAGREQUEST  = row.allowSolDiag === false ? ' disabled="disabled"' : '';
//    href="' + row.prc_editUrl + '"
    
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-solicitud-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar solicitud detallada"' + $BTN_ALLOW_SHOWPRC + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-solicitud-action btn btn-primary-v2 btn-outline btn-xs " href="javascript:void(0)" target="_blank" title="Editar solicitud de estudio"' + $BTN_ALLOW_EDITPRC + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="sin-cita-solicitud-action btn btn-default btn-outline btn-xs " href="javascript:void(0)" title="Enviar a lista de trabajo"' + $BTN_ALLOW_SKIPDATE + '>',
		    '<i class="glyphicon glyphicon-tag"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="radx-ind-solicitud-action btn btn-primary-v2 btn-outline btn-xs " href="javascript:void(0)" title="Agregar indicaciones del Médico radiólogo"' + $BTN_ALLOW_ADDINDRX + '>',
		    '<i class="glyphicon glyphicon-log-in"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="sol-diag-solicitud-action btn btn-primary-v2 btn-outline btn-xs " href="javascript:void(0)" title="Solicitar diagnóstico"' + $BTN_ALLOW_DIAGREQUEST + '>',
		    '<i class="glyphicon glyphicon-book"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionSolEstudioEvents = {
    'click .show-solicitud-action': function (e, value, row, index) {
	console.log('display full', row, row.est[0]);
//	___actionPreinscripcionSetterObjectModalData(row.prc_id, row, {});
//        jQuery('#preinscripcionFullData-showModalContainer').modal();
        var $full_modal  = jQuery('#preinscripcionFullData-showModalContainer');
        $full_modal.fv_displayFullEntityInModal({id: row.prc_id, object: row, is_allow: {}});
        $full_modal.modal();
    },
    'click .sin-cita-solicitud-action': function (e, value, row, index) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: Routing.generate('simagd_solicitud_estudio_requiereCita'),
            data: { id: row.prc_id },
            success: function(response) {
                        var $table_prc  = jQuery('#table-lista-solicitudes-estudio');
			row['prc_requiereCita'] = false;
			row['allowSinCita'] = false;
			$table_prc.bootstrapTable('updateRow', {
			    index: index,
			    row: row
			});
			$table_prc.bootstrapTable('resetView');
			console.log('Elemento ingresado en lista sin cita satisfactoriamente');
//			jQuery('#table-lista-solicitudes-estudio').bootstrapTable('refresh');
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
    },
    'click .edit-solicitud-action': function (e, value, row, index) {
	moment.locale('es');
	
        jQuery('#btn_agregar_prcEmergencyRequest').hide();
        jQuery('#btn_editar_prcEmergencyRequest').show();
        
        jQuery('#formPrcEmergencyRequestTitle').html('Editar Solicitud de estudio - <span class="badge badge-element-v2" style="">Formato rápido</span>');
	var $is_unknown_exp = typeof row.explocal_numero !== "undefined" && row.explocal_numero !== null && row.explocal_numero !== "" ? false : true;

        jQuery('#formPrcEmergencyRequestLabel').removeClass('label-primary-v2')
		.addClass('label-element-v2').html(function() {
		    var $nombre	= $is_unknown_exp === false ? row.prc_paciente : row.unknExp_nombreFicticio;
		    var $numero	= $is_unknown_exp === false ? row.explocal_numero : row.unknExp_numero;
                    var $badge  = $is_unknown_exp === false ? 'badge-element-v2' : 'badge-danger';
		    return $nombre + ' <span class="badge ' + $badge + '" style="margin-left: 5px;">' + $numero + '</span>';
            });
        
        var $modal      = jQuery('#crearSolicitudEstudioFormatoRapido-modal'),
            $form       = jQuery('#crearSolicitudEstudioFormatoRapido-form');
        
        $modal.find('.modal-content').removeClass('panel-primary-v2').addClass('panel-element-v2');
        
	$form.find(':input').each(function () {
            if (typeof jQuery(this).attr('name') !== "undefined") {
                var $field      = jQuery(this),
                    $default    = $field.data('default'),
                    $server     = $field.data('alias-from-server'),
                    $svdata     = row[$server];
                    console.log('$field', $field.attr('name'), '$default', $default, '$server', $server, '$svdata', $svdata);
                if ($field.is('input:text') || $field.attr('type') === 'hidden' || $field.is('textarea')) {
                    if (typeof $svdata !== "undefined" && $svdata !== null && $svdata !== "") {
                        if ($field.hasClass('summernote')) {
                            $field.summernote('code', jQuery.trim($svdata));
                        } else {
                            $field.val(jQuery.trim($svdata));
                        }
                    }
                }
                if ($field.is('select')) {
                    $field.find('option').prop('disabled', false);
                    if (!$field.is('[multiple]')) {
                        if (typeof $svdata !== "undefined" && $svdata !== null && $svdata !== "") {
                            $field.select2('val', $svdata);
                        }
                    } else {
                        var arr_pryPrc = []; // create array here
                        $.each(row.prc_solicitudEstudioProyeccion, function (i, $pry) {
                            arr_pryPrc.push($pry.expl_id); //push values here
                        });
                        $field.select2('val', jQuery.unique(arr_pryPrc));
                    }
                }
            }
        });
        
	$form.find(':input').each(function () {
	    var $field      = jQuery(this),
                $trigger    = $field.data('trigger-on-display');
            if ($trigger === true || $trigger === 'true') {
                $field.trigger('change', [true, false]);
		console.log($field.attr('name'), '$trigger', $trigger);
            }
        });
        $modal.fv_resetFormInModal();
        $modal.modal();
    }
};

jQuery(document).ready(function() {
    
    jQuery('li.list-table-link-navbar').find("a:not([disabled])").off('click').on('click', function (e) {
        var $target_divContainer_bsTable = jQuery(this).data('divtabletarget');
	var $target = $('#' + $target_divContainer_bsTable);
	
	/** Hide popovers */
	$('.fc-event, .fc-bgevent, [data-toggle="popover"]').popover('hide');
	
 	/** Tablas bstable */
        var $target_bsTable                 = $target.find('table[data-toggle="table"]');               // --| get bstable
        var $target_bsTable_url             = $target_bsTable.bootstrapTable('getOptions').url;         // --| get Url
        var $target_bsTable_backupUrl       = $target_bsTable.bootstrapTable('getOptions').backupUrl;   // --| get backupUrl
        
        if (typeof $target_bsTable_url === "undefined" || $target_bsTable_url === null || $target_bsTable_url === "")
        {
            $target_bsTable_url             = jQuery.trim($target.data('refresh-url'));
        }
	console.log(jQuery.trim($target.data('refresh-url')), jQuery.trim($target_bsTable_backupUrl), jQuery.trim($target_bsTable_url));
        
        /*
         * refresh bootstrap table with new filters from BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION.param
         */
        $target_bsTable
                .bootstrapTable('refresh', {
                            url: $target_bsTable_url
                        });
	
 	/** fullCalendar */
	$target.find('#calendar:not([disabled])').fullCalendar('refetchEvents');
	
        $('.' + $pattern_bstable_container).hide();
        $target.show();
        $('li.list-table-link-navbar').removeClass('active')
                .parents("li.list-table-link-navbar-parent").removeClass('active');
        jQuery(this).parents("li").addClass("active");
    });

    /** local variable DOM objects */
    var $form_prcEmrgRq 	= jQuery('#crearSolicitudEstudioFormatoRapido-form');
    var $modal_prcEmrgRq 	= jQuery('#crearSolicitudEstudioFormatoRapido-modal');

//    jQuery('#crearSolicitudEstudioFormatoRapido-modal').modal();
//    jQuery('#formPrcEmergencyRequestSolicitudEstudioProyeccion').change(function () {
//        $modal_prcEmrgRq.modal('layout');
//    });

    /** Tabla de solicitudes */
    var $table_prc      = jQuery('#table-lista-solicitudes-estudio');

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
	    columns: $table_prcColumns,
	    url: jQuery.trim($table_prc.parents('div.' + $pattern_bstable_container).data('refresh-url'))
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
     * próxima consulta médica
     */
    $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.change", function (e) {
	jQuery(this).blur();
    }).on('dp.change dp.show', function(e) {
        $form_prcEmrgRq.formValidation('revalidateField', 'formPrcEmergencyRequestFechaProximaConsulta');
    }).prev().click(function(e) {
	e.preventDefault();
	jQuery(this).next().data("DateTimePicker").show();
	console.log(jQuery(this).next().attr('name') + ' displayed');
    });

    /*
     * field typeahead select event
     */
    $('.typeahead.explocal_navbar_typeahead')
            .filter(':not([disabled]):enabled:not([readonly])')
                    .on('myevt:ttsuggestion', function(e, ttevt, suggestion) {
                        e.stopImmediatePropagation();
                        
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
                        
                        var $tt_el = jQuery(this);
                        $tt_el.parents('.twitter-typeahead').find('a.tt-new-request-action').off('click').on('click', function (e) {
                            
                        });
                        
                        console.log('******************************** e ********************************', e, '\n\n\n\n\n\n ******************************** ttevt ********************************', ttevt, '\n\n\n\n\n\n ******************************** suggestion ********************************', suggestion, '\n\n\n\n\n\n ******************************** this ********************************', this, '\n\n\n\n\n\n ********************************jQuery(this) ********************************', jQuery(this));
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

    $('.typeahead.explocal_navbar_typeahead').filter(':not([disabled]):enabled:not([readonly])').on('typeahead:render', function(ev, suggestions, flag, dataset) {
        if (jQuery.isEmptyObject(suggestions) === false)
        {
            var $tt_el = jQuery(this);
            jQuery(this).parents('.twitter-typeahead').find('a.tt-new-request-action').off('click').on('click', function (e) {
                
                console.log('typeahead:render', 'suggestions', suggestions, 'e', e);
                
                e.stopImmediatePropagation();

                $tt_el.blur();

                var $btn_this   = jQuery(this);

                moment.locale('es');

                jQuery('#btn_agregar_prcEmergencyRequest').show();
                jQuery('#btn_editar_prcEmergencyRequest').hide();

//                    var $tt_expLocal    = null;
//                    $.each(suggestions, function (i, sgg) {
//                        if (sgg.exp_id == jQuery(this).data('exp-id')) {
//                            $tt_expLocal    = jQuery.extend(true, {}, sgg);
//                        }
//                    });

//                jQuery('#formPrcEmergencyRequestTitle').text('Registrar bloqueo en agenda');
                jQuery('#formPrcEmergencyRequestLabel').removeClass('label-element-v2')
                        .addClass('label-primary-v2').html($btn_this.closest('.tt-item-btn-group').data('pct-nombre') + ' <span class="badge badge-primary-v2" style="margin-left: 5px;">' + $btn_this.closest('.tt-item-btn-group').data('exp-numero') + '</span>');

                /*
                 * Emergencia
                 */
                $("input[id='formPrcEmergencyRequestEsEmergencia']").val(true);

                /*
                 * Expediente (local | ficticio)
                 */
                $("input[id='formPrcEmergencyRequestIdExpediente']").val($btn_this.closest('.tt-item-btn-group').data('exp-id'));
                /*
                 * Origen de la solicitud
                 */
                $("select[id='formPrcEmergencyRequestIdAreaAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdAreaAtencion']").data('default'));
                $("select[id='formPrcEmergencyRequestIdAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdAtencion']").data('default'));
                $("select[id='formPrcEmergencyRequestIdEmpleado']").select2('val', $("select[id='formPrcEmergencyRequestIdEmpleado']").data('default'));
                $("select[id='formPrcEmergencyRequestIdAreaAtencion']").trigger('change', [true, false]);    // --| Filtrar areaAtencion
                /*
                 * Estudio solicitado
                 */
                $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").select2('val', $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").data('default'));
                $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").trigger('change', [true, false]);    // --| Filtrar modalidad
                /*
                 * Requerimiento de prioridad
                 */
                $("select[id='formPrcEmergencyRequestIdPrioridadAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdPrioridadAtencion']").data('default'));
                $("select[id='formPrcEmergencyRequestSolicitudEstudioProyeccion']").select2('val', '');

                var $dt_proximaConsulta = moment().add(0, 'd');
                $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").val( $dt_proximaConsulta.format('YYYY-MM-DD'));
                $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").data("DateTimePicker").date($dt_proximaConsulta);

                $("textarea[id='formPrcEmergencyRequestDatosClinicos']").val('');
                $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestDatosClinicos', true, 'notEmpty');
                $("textarea[id='formPrcEmergencyRequestHipotesisDiagnostica']").val('');
                $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestHipotesisDiagnostica', true, 'notEmpty');
                $("textarea[id='formPrcEmergencyRequestInvestigando']").val('');
                $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestInvestigando', true, 'notEmpty');
                $("textarea[id='formPrcEmergencyRequestJustificacionMedica']").val('');
                $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestJustificacionMedica', true, 'notEmpty');

                $modal_prcEmrgRq.modal();

                /* Set the form no validated */
                $form_prcEmrgRq.data('formValidation').resetForm();

                $form_prcEmrgRq.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

                $modal_prcEmrgRq
                    .find(':submit')
                        .removeAttr('disabled')
                        .removeClass('disabled');
            });
            jQuery(this).parents('.twitter-typeahead').find('a.tt-new-full-request-action').off('click').on('click', function (e) {
                e.stopImmediatePropagation();

                $tt_el.blur();

                var $btn_this           = jQuery(this);

                /*
                 * Redirect page
                 * similar behavior as clicking on a link
                 */
                window.location.href    = Routing.generate('simagd_solicitud_estudio_create', { __exp: $btn_this.closest('.tt-item-btn-group').data('exp-id') });
            });
            jQuery(this).parents('.twitter-typeahead').find('a.tt-view-patient-studies-action').off('click').on('click', function (e) {
                e.stopImmediatePropagation();

                $tt_el.blur();

                var $btn_this   = jQuery(this);

                /*
                 * Redirect page
                 * similar behavior as clicking on a link
                 */
                window.location.href    = Routing.generate('simagd_estudio_list', { __exp: $btn_this.closest('.tt-item-btn-group').data('exp-id') });
            });
        }
    });
    $('.typeahead.explocal_navbar_typeahead').parents('.twitter-typeahead').find('.tt-menu').css('min-width', '640px');

    $form_prcEmrgRq
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
		$modal_prcEmrgRq
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_prcEmrgRq
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
		$modal_prcEmrgRq
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_prcEmrgRq
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

	    var url   = $action_prcEmrgRq == 'edit' ? 'simagd_solicitud_estudio_editarSolicitudEstudioFormatoRapido' : 'simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Solicitud' + ($action_prcEmrgRq == "edit" ? ' editada' : ' creada') + ' satisfactoriamente');
				$table_prc.filter(':visible').bootstrapTable('refresh');
				$modal_prcEmrgRq.modal('hide');
				$action_prcEmrgRq == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_prcEmrgRq == "edit" ? ' editar' : ' crear') + ' solicitud');
				console.log(e.error);
				console.log(e.responseText);
				$modal_prcEmrgRq.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });

    $modal_prcEmrgRq.on('hide', function() {
	jQuery(this).fv_hideFormInModal();
    });

    jQuery('#btn_agregar_prcEmergencyRequest:not([disabled])').click(function(e) {
        e.preventDefault();

	/** Validate form and submit by ajax */
	$action_prcEmrgRq = 'create';

	var $form = $form_prcEmrgRq;
        $form.submit();

    });

    jQuery('#btn_editar_prcEmergencyRequest:not([disabled])').click(function(e) {
        e.preventDefault();

	/** Validate form and submit by ajax */
	$action_prcEmrgRq = 'edit';

	var $form = $form_prcEmrgRq;
        $form.submit();

    });

    /*
     * unknown patient --| add to list
     */
    jQuery('#btn_unknown_patient_add_item').filter(':not([disabled])').click(function(e) {
        var $btn_this   = jQuery(this);

        moment.locale('es');

        jQuery('#btn_agregar_prcEmergencyRequest').show();
        jQuery('#btn_editar_prcEmergencyRequest').hide();

        jQuery('#formPrcEmergencyRequestLabel').removeClass('label-element-v2')
                .addClass('label-primary-v2').html('Paciente desconocido' + ' <span class="badge badge-primary-v2" style="margin-left: 5px;"> NI-####-## </span>');

        $("input[id='formPrcEmergencyRequestId']").val('');

        /*
         * Expediente (local | ficticio)
         */
        $("input[id='formPrcEmergencyRequestIdExpediente']").val('');

        /*
         * Emergencia
         */
        $("input[id='formPrcEmergencyRequestEsEmergencia']").val(true);

        /*
         * Origen de la solicitud
         */
        $("select[id='formPrcEmergencyRequestIdAreaAtencion']").select2('val', '2');
        $("select[id='formPrcEmergencyRequestIdAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdAtencion']").data('default'));
        $("select[id='formPrcEmergencyRequestIdEmpleado']").select2('val', $("select[id='formPrcEmergencyRequestIdEmpleado']").data('default'));
        $("select[id='formPrcEmergencyRequestIdAreaAtencion']").trigger('change', [true, false]);    // --| Filtrar areaAtencion
        /*
         * Estudio solicitado
         */
        $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").select2('val', $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").data('default'));
        $("select[id='formPrcEmergencyRequestIdAreaServicioDiagnostico']").trigger('change', [true, false]);    // --| Filtrar modalidad
        /*
         * Requerimiento de prioridad
         */
        $("select[id='formPrcEmergencyRequestIdPrioridadAtencion']").select2('val', $("select[id='formPrcEmergencyRequestIdPrioridadAtencion']").data('default'));
        $("select[id='formPrcEmergencyRequestSolicitudEstudioProyeccion']").select2('val', '');

        var $dt_proximaConsulta = moment().add(0, 'd');
        $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").val( $dt_proximaConsulta.format('YYYY-MM-DD'));
        $("input[id='formPrcEmergencyRequestFechaProximaConsulta']").data("DateTimePicker").date($dt_proximaConsulta);

        $("textarea[id='formPrcEmergencyRequestDatosClinicos']").val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestDatosClinicos', false, 'notEmpty');
        $("textarea[id='formPrcEmergencyRequestHipotesisDiagnostica']").val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestHipotesisDiagnostica', false, 'notEmpty');
        $("textarea[id='formPrcEmergencyRequestInvestigando']").val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestInvestigando', false, 'notEmpty');
        $("textarea[id='formPrcEmergencyRequestJustificacionMedica']").val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestJustificacionMedica', false, 'notEmpty');

        $modal_prcEmrgRq.modal();

        /* Set the form no validated */
        $form_prcEmrgRq.data('formValidation').resetForm();

        $form_prcEmrgRq.find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

        $modal_prcEmrgRq
            .find(':submit')
                .removeAttr('disabled')
                .removeClass('disabled');

    });
    
    /*
     * expand bstable view
     */
    jQuery('#panel_studyrequest_btn_expand_view').filter(':not([disabled])').click(function(e) {
        jQuery('#container_prc_column_bsform').hide('slide', {direction: 'left'}, 150, function() {
            jQuery('#container_prc_column_bstable').removeClass('col-lg-9 col-md-9 col-sm-9').addClass('col-lg-12 col-md-12 col-sm-12');
            jQuery(window).resize();
        });
        
        jQuery('#panel_studyrequest_btn_default_view').parents('li').show();
        jQuery(this).parents('li').hide();
    });
    /*
     * return to default bstable view
     */
    jQuery('#panel_studyrequest_btn_default_view').filter(':not([disabled])').click(function(e) {
        jQuery('#container_prc_column_bsform').show('slide', {direction: 'left'}, 150, function() {
            jQuery('#container_prc_column_bstable').removeClass('col-lg-12 col-md-12 col-sm-12').addClass('col-lg-9 col-md-9 col-sm-9');
            jQuery(window).resize();
        });
        
        jQuery('#panel_studyrequest_btn_expand_view').parents('li').show();
        jQuery(this).parents('li').hide();
    });

});

function getSearchExpedienteSourceTemplate(item) {
    /*
     * **************************************************************************
     * AQUI SE DEBE HACER UN PUSH A UN ARRAY U OBJECT, PARA DISTINGUIRLO
     * CON UN DATA-ID, ASI DETERMINAR EN EL TT:RENDER CUAL ES EL BTN CLICKED
     * **************************************************************************
     */
    
    var $edad   = jQuery.isEmptyObject(item.pct_edad) === false ? item.pct_edad.y + ' Años, ' + item.pct_edad.m + ' meses, ' + item.pct_edad.d + ' días' : 'desconocida';

    return [
        '<div class="expand-box tt-item-btn-group" style="" data-exp-id="' + item.exp_id + '" data-exp-numero="' + item.exp_numero + '" data-pct-id="' + item.pct_id + '" data-pct-nombre="' + item.pct_nombreCompleto + '">',
            '<span style="">',
                item.pct_nombreCompleto,
            '</span>',
            '<div class="btn-toolbar" role="toolbar" aria-label="..." style="float: right; margin-top: 1.2px;">',
                '<div class="btn-group" role="group">',
                    '<a   class="tt-new-request-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Solicitar estudio (Formato rápido)"' + ($isGranted_studyRequest === false ? ' disabled="disabled"' : '') + '>',
                        '<i class="glyphicon glyphicon-send"></i>',
                    '</a>',
                '</div>',
                '<div class="btn-group" role="group">',
                    '<a   class="tt-new-full-request-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Solicitar estudio (Formato detallado)"' + ($isGranted_studyRequest === false ? ' disabled="disabled"' : '') + '>',
                        '<i class="glyphicon glyphicon-edit"></i>',
                    '</a>',
                '</div>',
                '<div class="btn-group" role="group">',
                    '<a   class="tt-view-patient-studies-action btn btn-element-v2 btn-outline btn-xs" href="javascript:void(0)" title="Consulta de estudios de paciente"' + ($isGranted_studyView === false ? ' disabled="disabled"' : '') + '>',
                        '<i class="glyphicon glyphicon-eye-open"></i>',
                    '</a>',
                '</div>',
            '</div>',
            '<span class="label label-default-v2" style="float: right; margin-top: 5px; min-width: 175px; margin-right: 12px; text-align: left;">',
                '[Edad: ' + $edad + ']',
            '</span>',
            '<span class="label label-element-v2" style="float: right; margin-top: 5px; min-width: 72px; margin-right: 12px; text-align: left;">',
                '[' + item.exp_numero + ']',
            '</span>',
        '</div>'
    ].join('\n');
}

function createNewCompleteRequest($el, item) {
    console.log($el, item, 'background: #f00; color: #bada55', 'background: #31708f; color: #fff');
}