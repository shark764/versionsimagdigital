/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** action in form for submit */
var $action_solcmplFastRq = 'edit';

function actionFormatter(value, row, index) {
    /*
     * 
     * @type String
     */
    var $BTN_ALLOW_SHOWSTUDY    = row.allowShow === false ? ' disabled="disabled"' : '';
    var $BTN_ALLOW_DOWNLOADSTUDY    = row.allowDownload === false ? ' disabled="disabled"' : '';
    var $BTN_ALLOW_CMPLREQUEST  = row.allowSolCmpl === false ? ' disabled="disabled"' : '';
    var $BTN_ALLOW_ADDWORKLIST  = row.allowAnexarPndL === false ? ' disabled="disabled"' : '';
    
    var $study_url_weasis  = jQuery.trim(row.est_url_weasis) || 'javascript:void(0)';
    var $study_url_oviyam2 = jQuery.trim(row.est_url_oviyam2) || 'javascript:void(0)';
    
    var $study_url_diagnosis    = jQuery.trim(row.study_url_diagnosis) || 'javascript:void(0)';
//    href="' + row.solcmpl_createUrl + '"
    
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-estudio-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar información de  detallada"' + $BTN_ALLOW_SHOWSTUDY + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<button type="button"    class="btn btn-primary-v2 btn-outline btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Visualizar estudio"' + $BTN_ALLOW_DOWNLOADSTUDY + '>',
		    '<i class="glyphicon glyphicon-eye-open"></i>', ' ',
		    '<span class="caret"></span>',
		'</button>',
		'<ul class="dropdown-menu" style="right: 0; left: auto;" >',
		    '<li>',
			'<a   href="' + $study_url_weasis + '" target="_blank" title="Descargar estudio"' + $BTN_ALLOW_DOWNLOADSTUDY + '>',
			    '<i class="glyphicon glyphicon-save"></i>', ' Weasis',
			'</a>',
		    '</li>',
		    '<li>',
			'<a   href="' + $study_url_oviyam2 + '" target="_blank" title="Visualizar estudio en web"' + $BTN_ALLOW_DOWNLOADSTUDY + '>',
			    '<i class="glyphicon glyphicon-play-circle"></i>', ' Oviyam2',
			'</a>',
		    '</li>',
		'</ul>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="complementario-estudio-action btn btn-element-v2 btn-outline btn-xs " href="javascript:void(0)" target="_blank" title="Solicitar estudio complementario"' + $BTN_ALLOW_CMPLREQUEST + '>',
		    '<i class="glyphicon glyphicon-random"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<button type="button"    class="btn btn-primary-v2 btn-outline btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Anexar en listado de lecturas pendientes"' + $BTN_ALLOW_ADDWORKLIST + '>',
		    '<i class="glyphicon glyphicon-share-alt"></i>', ' ',
		    '<span class="caret"></span>',
		'</button>',
		'<ul class="dropdown-menu" style="right: 0; left: auto;" >',
		    '<li>',
			'<a   class="anexar-lista-lectura-estudio-action " href="javascript:void(0)" target="_blank" title="Anexar en listado de lecturas pendientes"' + $BTN_ALLOW_ADDWORKLIST + '>',
			    '<i class="glyphicon glyphicon-list"></i>', ' Agregar a lista de trabajo',
			'</a>',
		    '</li>',
		    '<li>',
			'<a   href="' + $study_url_diagnosis + '" target="_blank" title="Registrar lectura para este estudio"' + $BTN_ALLOW_ADDWORKLIST + '>',
			    '<i class="glyphicon glyphicon-adjust"></i>', ' Registrar lectura',
			'</a>',
		    '</li>',
		'</ul>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="anexar-lista-lectura-estudio-v2-action btn btn-primary-v2 btn-outline btn-xs " href="javascript:void(0)" title="Anexar en listado de lecturas pendientes"' + $BTN_ALLOW_ADDWORKLIST + '>',
		    '<i class="glyphicon glyphicon-share-alt"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionEvents = {
    'click .show-estudio-action': function (e, value, row, index) {
	console.log(row);
	actionEstudioSetterObjectModalData(row.est_id, row, {});
        jQuery('#estudioFullData-showModalContainer').modal();
//         jQuery('#table-lista-preinscripciones-paciente').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_listarSolicitudesEstudioPaciente', { expediente: row.id }) });
//         jQuery('#table-lista-citas-paciente').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_listarCitasPaciente', { expediente: row.id }) });
//         jQuery('#table-lista-estudios-paciente').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_listarExamenesPaciente', { expediente: row.id }) });
//         jQuery('#table-lista-diagnosticos-paciente').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_listarDiagnosticosPaciente', { expediente: row.id }) });
//         
//         $("div[id='div-resultado-informacion-paciente']").empty()
//                 .load(Routing.generate('simagd_imagenologia_digital_listarDatosPaciente', { expediente: row.id }));
//         
//         $("div[id='container_resultado_busquedaPaciente']").fadeOut("fast");
//         $("div[id='container_menu_historiaImagenologica']").fadeIn("fast");
	console.log(row);
    },
    'click .anexar-lista-lectura-estudio-action': function (e, value, row, index) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: Routing.generate('simagd_sin_lectura_anexarEstudioEnListaSinLectura'),
            data: {
                __est: row.est_id,
                __estPdr: row.estPdr_id
	    },
            success: function(response) {
                        var $table_search_studies  = jQuery('#table-resultado-busqueda');
			row['allowAnexarPndL'] = false;
			$table_search_studies.bootstrapTable('updateRow', {
			    index: index,
			    row: row
			});
			$table_search_studies.bootstrapTable('resetView');
			console.log('Elemento ingresado en lista satisfactoriamente');
//			jQuery('#table-resultado-busqueda').bootstrapTable('refresh');
            },
            error: function(e) {
		      console.log('Se ha producido un error al ingresar elemento');
		      console.log(e.error);
		      console.log(e.responseText);
            }
        });
    },
    'click .complementario-estudio-action': function (e, value, row, index) {
        jQuery('#btn_agregar_solcmplFastRequest').show();
        jQuery('#btn_editar_solcmplFastRequest').hide();

        jQuery('#formSolcmplFastRequestTitle').text('Registrar solicitud de estudio complementario');
        jQuery('#formSolcmplFastRequestLabel').removeClass('label-success-v2 label-warning')
		.addClass('label-primary-v2').text('Formulario para registro');
        
        $('input[id="formSolcmplFastRequestIdSolicitudEstudio"]').val(row.prc_id);
        $('input[id="formSolcmplFastRequestIdEstudioPadre"]').val(row.est_id);

        $('select[id="formSolcmplFastRequestIdRadiologo"]').select2('val', $('select[id="formSolcmplFastRequestIdRadiologo"]').data('default'));

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
         * Estudio solicitado
         */
        $('select[id="formSolcmplFastRequestIdAreaServicioDiagnostico"]').select2('val', $('select[id="formSolcmplFastRequestIdAreaServicioDiagnostico"]').data('default'));
        $('select[id="formSolcmplFastRequestIdAreaServicioDiagnostico"]').trigger('change', [true, false]);    // --| Filtrar modalidad
        $('select[id="formSolcmplFastRequestSolicitudEstudioProyeccion"]').select2('val', '');
        /*
         * Requerimiento de prioridad
         */
        $('select[id="formSolcmplFastRequestIdPrioridadAtencion"]').select2('val', $('select[id="formSolcmplFastRequestIdPrioridadAtencion"]').data('default'));

        $('textarea[id="formSolcmplFastRequestJustificacion"]').val('');
        $('textarea[id="formSolcmplFastRequestIndicaciones"]').val('');

        jQuery('#crearSolicitudEstudioComplementarioFastFormat-modal').modal();
	
	/* Set the form no validated */
	jQuery('#crearSolicitudEstudioComplementarioFastFormat-form').data('formValidation').resetForm();
	
	jQuery('#crearSolicitudEstudioComplementarioFastFormat-form').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearSolicitudEstudioComplementarioFastFormat-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
        
//        window.alert('https://www.researchgate.net/publication/260311067_Una_solucion_de_bajo_costo_para_la_digitalizacion_de_centros_radiologicos_de_pequenamediana_escala');
    }
};

jQuery(document).ready(function() {

    /** local variable DOM objects */
    var $form_solcmplFastRq 	= jQuery('#crearSolicitudEstudioComplementarioFastFormat-form');
    var $modal_solcmplFastRq 	= jQuery('#crearSolicitudEstudioComplementarioFastFormat-modal');
    
    jQuery('#formSolcmplFastRequestSolicitudEstudioProyeccion').change(function () {
        $modal_solcmplFastRq.modal('layout');
    });

    /** Tabla de solicitudes */
    var $table_study    = jQuery('#table-resultado-busqueda');

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
				$table_study.filter(':visible').bootstrapTable('refresh');
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
        jQuery(this).fv_resetFormInModal();
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

function eliminadoEnPacsFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.est_eliminadoEnPacs === false ? 'success-v2' : 'warning') + '">',
        (row.est_eliminadoEnPacs === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}