/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_solcmplFastRq = 'edit';

function actionSolEstudioCmplFormatter(value, row, index) {
//    href="' + row.solcmpl_editUrl + '"
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a class="show-solicitud-estudio-compl-action btn btn-primary-v2 btn-xs" href="javascript:void(0)" title="Mostrar solicitud de estudio complementario detallado"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a class="edit-solicitud-estudio-compl-action btn btn-primary-v2 btn-xs " href="javascript:void(0)" target="_blank" title="Editar registro de solicitud de estudio complementario"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionSolEstudioCmplEvents = {
    'click .show-solicitud-estudio-compl-action': function (e, value, row, index) {
	console.log(row);
	___actionSolicitudEstudioComplementarioSetterObjectModalData(row.solcmpl_id, row, {});
        jQuery('#solicitudEstudioComplementarioFullData-showModalContainer').modal();
    },
    'click .edit-solicitud-estudio-compl-action': function (e, value, row, index) {
        jQuery('#btn_editar_solcmplFastRequest').show();
        jQuery('#btn_agregar_solcmplFastRequest').hide();

        jQuery('#formSolcmplFastRequestTitle').text('Editar solicitud de estudio complementario');
        jQuery('#formSolcmplFastRequestLabel').removeClass('label-primary-v2')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $('input[id="formSolcmplFastRequestId"]').val(row.solcmpl_id);

        $('select[id="formSolcmplFastRequestIdRadiologo"]').select2('val', row.solcmpl_id_solicitante);

	/** text-editor Recomendaciones */
//	$("[id='formDiagRecomendaciones"]').buildSummerNote({ newOptions: {
//	    height: 90,                 // set editor height
//	    maxHeight: 125,             // set maximum height of editor
//            focus: false,               // set focus to editable area after initializing summernote
//            ___toolbar  : 'expand', // toolbar
//            ___speech   : true,     // active speech recognition
//	}});
	/** -- summernote */

        /*
         * modalidad solicitada
         */
        $('select[id="formSolcmplFastRequestIdAreaServicioDiagnostico"]').select2('val', row.solcmpl_id_modalidad);
        $('select[id="formSolcmplFastRequestIdAreaServicioDiagnostico"]').trigger('change', [true, false]);    // --| Filtrar modalidad
        /*
         * proyecciones
         */
        var arr_prySolcmpl = []; // create array here
        $.each(row.solcmpl_solicitudEstudioComplementarioProyeccion, function (i, $pry) {
            arr_prySolcmpl.push($pry.expl_id); //push values here
        });
        $('select[id="formSolcmplFastRequestSolicitudEstudioProyeccion"]').select2('val', jQuery.unique(arr_prySolcmpl));
        /*
         * Requerimiento de prioridad
         */
        $('select[id="formSolcmplFastRequestIdPrioridadAtencion"]').select2('val', row.solcmpl_id_prioridad);

        $('textarea[id="formSolcmplFastRequestJustificacion"]').val(jQuery.trim(row.solcmpl_justificacion));
        $('textarea[id="formSolcmplFastRequestIndicaciones"]').val(jQuery.trim(row.solcmpl_indicacionesEstudio));
	
	$('#btn_descargar_estudio_solcmpl').attr('href', jQuery.trim(row.est_url));

        jQuery('#crearSolicitudEstudioComplementarioFastFormat-modal').modal();
	
	/* Set the form no validated */
	jQuery('#crearSolicitudEstudioComplementarioFastFormat-form').data('formValidation').resetForm();
	
	jQuery('#crearSolicitudEstudioComplementarioFastFormat-form').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearSolicitudEstudioComplementarioFastFormat-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};

jQuery(document).ready(function() {
  
    /** Tabla de solicitudes */
    var $table_solcmpl = jQuery('#table-lista-solicitudes-estudio-compl');
	
    /** Editar prioridad de atención */
    var $table_solcmplColumns = $table_solcmpl.bootstrapTable('getOptions').columns;
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
    
    $.each($table_solcmplColumns, function (i, column) {
	if (column.field == 'prAtn_nombre') {
	    jQuery.extend(true, $table_solcmplColumns[i], $prioridadOptions);
	}
    });

    /** Activar edición de prioridad si el usuario tiene permisos */
    if ($solcmpl_is_granted_changePriority !== false) {
	$table_solcmpl.bootstrapTable('destroy');
	$table_solcmpl.bootstrapTable({
	    columns: $table_solcmplColumns
	});
    }
    
    $table_solcmpl.on('editable-save.bs.table', function (e, field, row, oldValue, $object) {
	var $solcmpl_id_prAtn = null;
	$.each($listPriority, function(i, v) {
	    if (v.text === jQuery.trim(row.prAtn_nombre)) {
		$solcmpl_id_prAtn = jQuery.extend({}, {prAtn_id: v.id, prAtn_codigo: v.cod, prAtn_nombre: v.text, prAtn_estiloPresentacion: v.style});
	    }
	});
	$.ajax({
	    type: 'post',
	    dataType: 'json',
	    url: Routing.generate('simagd_solicitud_estudio_complementario_cambiarPrioridadAtencionSolicitud'),
            data: {
		id: row.solcmpl_id,
		formSolcmplEditIdPrioridadAtencion: $solcmpl_id_prAtn.prAtn_id
	    },
	    success: function(response) {
			row['prAtn_id']                 = $solcmpl_id_prAtn.prAtn_id;
			row['prAtn_codigo']             = $solcmpl_id_prAtn.prAtn_codigo;
			row['prAtn_estiloPresentacion'] = $solcmpl_id_prAtn.prAtn_estiloPresentacion;
			$table_solcmpl.bootstrapTable('updateRow', {
			    index: $object.parents('tr[data-index]').data('index'),
			    row: row
			});
			$table_solcmpl.bootstrapTable('resetView');
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
    
    $table_solcmpl.on('load-success.bs.table', function (e, data) {
	console.log('load-success.bs.table', 'solcmpl', data);
    });
    
});

jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_solcmplFastRq 	= jQuery('#crearSolicitudEstudioComplementarioFastFormat-form');
    var $modal_solcmplFastRq 	= jQuery('#crearSolicitudEstudioComplementarioFastFormat-modal');
    
    jQuery('#formSolcmplFastRequestSolicitudEstudioProyeccion').change(function () {
        $modal_solcmplFastRq.modal('layout');
    });
  
    /** Tabla de solicitudes */
    var $table_solcmpl = jQuery('#table-lista-solicitudes-estudio-compl');

    $form_solcmplFastRq.formValidation({
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
		$modal_solcmplFastRq
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_solcmplFastRq
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
		$modal_solcmplFastRq
		    .find(':submit')
			.attr('disabled', 'disabled')
			.addClass('disabled');
	    } else {
		$modal_solcmplFastRq
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

	    var url   = $action_solcmplFastRq == 'edit' ? 'simagd_solicitud_estudio_complementario_editarSolicitudEstudioComplementarioFastFormat' : 'simagd_solicitud_estudio_complementario_crearSolicitudEstudioComplementarioFastFormat';

            // Use Ajax to submit form data
            $.ajax({
		    type: 'post',
		    dataType: 'json',
		    url: Routing.generate(url),
		    data: $form.formParams(),
		    success: function(response) {
				console.log('Solicitud' + ($action_solcmplFastRq == "edit" ? ' editada' : ' creada') + ' satisfactoriamente');
				$table_solcmpl.filter(':visible').bootstrapTable('refresh');
				$modal_solcmplFastRq.modal('hide');
				$action_solcmplFastRq == "edit" ? $edited_bsAlert.addFadeSlideEffect() : $success_bsAlert.addFadeSlideEffect();
		    },
		    error: function(e) {
				console.log('Se ha producido un error al' + ($action_solcmplFastRq == "edit" ? ' editar' : ' crear') + ' solicitud');
				console.log(e.error);
				console.log(e.responseText);
				$modal_solcmplFastRq.modal('hide');
				$error_bsAlert.addFadeSlideEffect();
		    }
	    });
        });

    $modal_solcmplFastRq.on('hide', function() {
        jQuery(this).fv_hideFormInModal();
    });

    jQuery('#btn_agregar_solcmplFastRequest:not([disabled])').click(function(e) {
        e.preventDefault();
	/** Validate form and submit by ajax */
	$action_solcmplFastRq = 'create';
	$form_solcmplFastRq.submit();
    });

    jQuery('#btn_editar_solcmplFastRequest:not([disabled])').click(function(e) {
        e.preventDefault();
	/** Validate form and submit by ajax */
	$action_solcmplFastRq = 'edit';
	$form_solcmplFastRq.submit();
    });

    /*
     ****************************************************************************
     * change event for areaServicioDiagnostico field
     ****************************************************************************
     */
    var $solcmplFastRq_fieldMdly    = jQuery('select[id="formSolcmplFastRequestIdAreaServicioDiagnostico"]');
    var $solcmplFastRq_fieldPry     = jQuery('select[id="formSolcmplFastRequestSolicitudEstudioProyeccion"]');

    /*
     * modality change event
     */
    $solcmplFastRq_fieldMdly.change(function(e, a, b) {
        var field_mld_val   = jQuery(this).val();   // modality val
        var field_pry_val   = $.map($solcmplFastRq_fieldPry.select2('val'), function(item) {
            return parseInt(item, 10);
        }); // proyections values, parse to integer

        $solcmplFastRq_fieldPry.find('option').prop('disabled', true);        // disable all options first
        $solcmplFastRq_fieldPry.select2('val', '').prop('disabled', true);    // remove selection
        /*
         * search in javascript object
         */
        var arr_pryResultValues = []; // array for values in cascade selection
        $.each(GROUP_DEPENDENT_ENTITIES, function(i, v) {
            if (i === 'm_expl') {
                $.each(v, function(x, y) {
                    if (y.id_m === parseInt(field_mld_val, 10)) {
                        arr_pryResultValues.push(y.id_expl); //push values here
                        $solcmplFastRq_fieldPry.find('option[value=' + y.id_expl + ']').prop('disabled', false);  // disable if option value is in result
                    }
                });
            }
        });
        var $arr_pry_finalValues    = $.fn.get_arrayIntersect({a: field_pry_val, b: arr_pryResultValues});  // get selection filtered by result
        if ($arr_pry_finalValues.length !== 0)
        {
            $solcmplFastRq_fieldPry
                    .select2('val', jQuery.unique($arr_pry_finalValues))
                    .prop('disabled', false);   // set selection and enable select2
        }
        if (jQuery.isEmptyObject(field_mld_val) === false)
        {
            $solcmplFastRq_fieldPry.prop('disabled', false); // enable select2
        }
        $form_solcmplFastRq.formValidation('revalidateField', 'formSolcmplFastRequestSolicitudEstudioProyeccion[]');   // revalidate select2
    });
    
});