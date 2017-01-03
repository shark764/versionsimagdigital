/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {

    /*
     * **************************************************************************
     * @type @call;$
     */
//    var $filter_array           = typeof $table_lct.bootstrapTable('getOptions').filterSourceList === 'string' ?
//                                            $table_lct.bootstrapTable('getOptions').filterSourceList.replace('[', '').replace(']', '').replace(/ /g, '').replace('\'', '').toLowerCase().split(',') :
//                                            $table_lct.bootstrapTable('getOptions').filterSourceList;
    /*
     * **************************************************************************
     * @type @call;$
     */

    /*
     *
     * @type @call;$
     */

//    http://stackoverflow.com/questions/17611174/grouping-results-in-select2
//
//    http://stackoverflow.com/questions/18346518/dynamically-adding-options-and-optgroups-in-select2
//
//    http://select2.github.io/select2/
//
//    http://stackoverflow.com/questions/28498599/how-to-pre-load-an-array-via-ajax-and-use-it-for-select2
//
//    https://groups.google.com/forum/#!topic/select2/LxjeOs-XdfE
//
//    https://scontent-lga1-1.xx.fbcdn.net/hphotos-xpt1/t31.0-8/s960x960/12006470_920358581370937_3642242769472937838_o.jpg

    /** **************** M.I.T ****************** */
    /** http://ocw.mit.edu/courses/index.htm#electrical-engineering-and-computer-science */
    /*
     *
     * @type @call;$
     */


    /** stdiag DOM */
    var $chkDiag_field 			= $("[id='" + $token + "_activarTranscripcion']"),
	$patternAsc_field 		= $("select[id='" + $token + "_idPatronAsociado']"),
	$patternApl_field		= $("select[id='" + $token + "_idPatronAplicado']");

    var $tx_hallazgos_field 		= $("[id='" + $token + "_hallazgos']"),
	$tx_conclusion_field 		= $("[id='" + $token + "_conclusion']"),
	$tx_recomendaciones_field	= $("[id='" + $token + "_recomendaciones']")
	$tx_diagnostico_field	= $("[id='" + $token + "_diagnostico']");

    /*
     * BOOTSTRAPSWITCH Activar transcripción inmediata de resultados
     */
    /** Activar bootstrapSwitch en check para bloqueo de transcripción */
//     $chkDiag_field.iCheck('destroy').bootstrapSwitch();
//     $chkDiag_field.iCheck('destroy').wrap('<div id="label-switch" class="make-switch" data-on-label="SI" data-off-label="NO">').parent().bootstrapSwitch();
//     $chkDiag_field.bootstrapSwitch('setOnLabel', 'I');
//     $chkDiag_field.bootstrapSwitch('setOffLabel', 'O');

    /** Utilización de plantilla */
    $patternAsc_field.change(function() {
	/** Plantilla será aplicada si se encuentra checkeado */
	if ($chkDiag_field.is(':checked'))
	{
	    $patternApl_field.select2('val', jQuery(this).val());
	    $patternApl_field.trigger("change");
	}
    });

    /*
     * Aplicación de plantilla --> SUMMERNOTE
     */
    $patternApl_field.change(function() {
	/*
	 * Plantilla será aplicada si se encuentra checkeado
	 */
	if ($chkDiag_field.is(':checked'))
	{
	    var $patterVal  = jQuery(this).val();

	    $.each($DIAGNOSTIC_PATTERN_LIST, function(i, v) {
		if (v.ptrDiag_id === parseInt($patterVal)) {
		    $tx_hallazgos_field.summernote('code', v.ptrDiag_hallazgos);
		    $tx_conclusion_field.summernote('code', v.ptrDiag_conclusion);
		    $tx_recomendaciones_field.summernote('code', v.ptrDiag_recomendaciones);
		    $tx_diagnostico_field.summernote('code', v.ptrDiag_hallazgos + '<p></p><p></p>' + v.ptrDiag_conclusion + '<p></p><p></p>' + v.ptrDiag_recomendaciones);
		}
	    });
	    if (!$patterVal) {
		$tx_hallazgos_field.summernote('reset');
		$tx_conclusion_field.summernote('reset');
		$tx_recomendaciones_field.summernote('reset');
	    } else {
		if (!$patternAsc_field.val() || $patternAsc_field.val() !== $patterVal) {
		    $patternAsc_field.select2('val', $patterVal);
		}
	    }
	}
    });
    /*
     * change event --> SUMMERNOTE
     */

    /*
     * **************************************************************************
     * Fin - Activar Transcripción inmediata --> BOOTSTRAPSWITCH
     * **************************************************************************
     */

    $chkDiag_field.on('switchChange.bootstrapSwitch', function(e, state) {
        if (state === false || (typeof state === "undefined" || state === null || state === "")) { // true | false
            if ($diagExists === 0)
            {
                $patternApl_field.select2('val', '');
            }
            //Desactivar formValidation
            $('[data-add-validation="formValidation"]').each(function () {
                var $field_attrName = jQuery(this).attr('name');
                if (typeof $field_attrName  !== "undefined") {
                    jQuery('#simagd_entity_full_admin_form').formValidation('resetField', $field_attrName).formValidation('enableFieldValidators', $field_attrName, false);
                }
            });

            /*
             * disabled in menu
             */
            jQuery('#panel_box_diag_btn_add_this_to_pattern_catalogue').parents('li').addClass('disabled');
        }
        else {
            //Reactivar formValidation
	    $('[data-add-validation="formValidation"]').each(function () {
		var $field_attrName = jQuery(this).attr('name');
		if (typeof $field_attrName  !== "undefined") {
		    jQuery('#simagd_entity_full_admin_form').formValidation('enableFieldValidators', $field_attrName, true);
		}
	    });

            if ($patternAsc_field.val() && !$patternApl_field.val() && $diagExists === 0) {	/** No reescribir si existe diagnóstico */
                $patternApl_field.select2('val', $patternAsc_field.val());
		$patternApl_field.trigger("change");
            }

            /*
             * enable in menu
             */
            jQuery('#panel_box_diag_btn_add_this_to_pattern_catalogue').parents('li').removeClass('disabled');
        }
        console.log('-- diagnóstico inmediato ha sido alternado');

    });
    if ($diagExists === 0)
    {
	/** Activar switchChange.bootstrapSwitch event solo si no existen diagnósticos ya ingresados */
	$chkDiag_field.bootstrapSwitch('state', false).trigger('switchChange.bootstrapSwitch');
    }

//     window.alert('https://github.com/Daniel-Hug/speech-input \nhttp://stackoverflow.com/questions/23188951/x-webkit-speech-is-deprectated-a-js-replacement-for-simple-speech-input-for-in \nhttp://mindmup.github.io/bootstrap-wysiwyg/ \nhttp://shapeshed.com/html5-speech-recognition-api/');
//     generarVentanaEstudioPaciente(Routing.generate('simagd_solicitud_estudio_create'));


    /** Formato para patrones + radiólogo al cual pertenece */
    function patternDiagFormat(state)
    {
	if (!state.id)
	{
	    return state.text; // optgroup
	}
	var $arrText = state.text.split('[');

	return typeof $arrText[1] === "undefined" ?
	    state.text :
		$arrText[0] +
		'<span class="label label-primary-v4" style="text-align: right; vertical-align: inherit; font-weight: normal;"> [' +
                    $arrText[1] +
		' </span>';
    }
    $("select[id='" + $token + "_idPatronAsociado2'], select[id='" + $token + "_idPatronAplicado2']")
	    .select2({
			placeholder: '',
			allowClear: true,
			dropdownAutoWidth : true,
			formatResult: patternDiagFormat,
			formatSelection: patternDiagFormat,
			escapeMarkup: function(m) {
					  return m;
				      }
		    });


    /** --> SUMMERNOTE text-editor Diagnóstico */
    var $_hallazgos 		= $tx_hallazgos_field.val(),
	$_conclusion 		= $tx_conclusion_field.val(),
	$_recomendaciones 	= $tx_recomendaciones_field.val();

    /**
     * Iniciar buildSummerNote
     */
    /** text-editor Hallazgos */
    $tx_hallazgos_field.buildSummerNote({ newOptions: jQuery.extend({
	focus: false,      	// set focus to editable area after initializing summernote
        ___toolbar  : 'expand', // toolbar
        ___speech   : true,     // active speech recognition
    }, {})});
    if (jQuery.isEmptyObject(jQuery.trim($_hallazgos)) === false) {
	$tx_hallazgos_field.summernote('code', $_hallazgos);
    }
    /** text-editor Conclusion */
    $tx_conclusion_field.buildSummerNote({ newOptions: jQuery.extend({
	height: 75,        	// set editor height
	maxHeight: 100,    	// set maximum height of editor
	focus: false,      	// set focus to editable area after initializing summernote
        ___toolbar  : 'expand', // toolbar
        ___speech   : true,     // active speech recognition
    }, {})});
    if (jQuery.isEmptyObject(jQuery.trim($_conclusion)) === false) {
	$tx_conclusion_field.summernote('code', $_conclusion);
    }
    /** text-editor Recomendaciones */
    $tx_recomendaciones_field.buildSummerNote({ newOptions: jQuery.extend({
	height: 90,        	// set editor height
	maxHeight: 125,    	// set maximum height of editor
	focus: false,      	// set focus to editable area after initializing summernote
        ___toolbar  : 'expand', // toolbar
        ___speech   : true,     // active speech recognition
    }, {})});
    if (jQuery.isEmptyObject(jQuery.trim($_recomendaciones)) === false) {
	$tx_recomendaciones_field.summernote('code', $_recomendaciones);
    }


    /** text-editor Recomendaciones */
    $tx_diagnostico_field.buildSummerNote({ newOptions: jQuery.extend({
	height: 750,        	// set editor height
	maxHeight: 850,    	// set maximum height of editor
	focus: false,      	// set focus to editable area after initializing summernote
        ___toolbar  : 'expand', // toolbar
        ___speech   : true,     // active speech recognition
    }, {})});
    /** -- summernote */
    $tx_diagnostico_field.summernote('code', $_hallazgos + '<p></p><p></p>' + $_conclusion + '<p></p><p></p>' + $_recomendaciones);


    /*
     * tab --> box expand on Transcription
     */
    jQuery('.add-dropdown-menu-diagnosis')
            .find('.box.box-primary-v4')
            .find('.box-header')
                .append(function(i, html) {
                    return ['<div class="dropdown pull-right" style="margin-right: 10px; margin-top: 5px;">',
                                '<a   href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog"></i> <b class="caret"></b></a>',
                                '<ul class="dropdown-menu" role="menu">',
                                    '<li >',
                                        '<a   href="javascript:void(0)" id="panel_box_diag_btn_expand_view" >',
                                            '<span class="glyphicon glyphicon-resize-full "></span> Vista completa',
                                        '</a>',
                                    '</li>',
                                    '<li style="display: none;" >',
                                        '<a   href="javascript:void(0)" id="panel_box_diag_btn_default_view" >',
                                            '<span class="glyphicon glyphicon-resize-small "></span> Vista predeterminada',
                                        '</a>',
                                    '</li>',
                                    '<li class="divider"></li>',
                                    '<li class="disabled">',
                                        '<a   href="javascript:void(0)" id="panel_box_diag_btn_add_this_to_pattern_catalogue" >',
                                            '<span class="glyphicon glyphicon-floppy-saved "></span> Agregar como patrón',
                                        '</a>',
                                    '</li>',
                                '</ul>',
                            '</div>'
                    ].join('');
                });

    /*
     * expand transcript view
     */
    jQuery('#panel_box_diag_btn_expand_view').filter(':not([disabled])').click(function(e) {
        jQuery('#panel_box_diag_btn_default_view').parents('li').show();
        jQuery(this).parents('li').hide();

        jQuery('.nav-tabs-custom .nav-pills').hide('slide', {direction: 'left'}, 100, function() {
            jQuery('.nav-tabs-custom .tab-content').removeClass('col-lg-9 col-md-9 col-sm-9 col-xs-9').addClass('col-lg-12 col-md-12 col-sm-12 col-xs-12');
            jQuery(window).resize();
        });
    });
    /*
     * return to default transcript view
     */
    jQuery('#panel_box_diag_btn_default_view').filter(':not([disabled])').click(function(e) {
        jQuery('.nav-tabs-custom .nav-pills').show('slide', {direction: 'right'}, 100, function() {
            jQuery('.nav-tabs-custom .tab-content').removeClass('col-lg-12 col-md-12 col-sm-12 col-xs-12').addClass('col-lg-9 col-md-9 col-sm-9 col-xs-9');
            jQuery(window).resize();
        });

        jQuery('#panel_box_diag_btn_expand_view').parents('li').show();
        jQuery(this).parents('li').hide();
    });

    /*
     * add this diagnosis as pattern
     */
    var $bsform_DOM_addThisAsPattern    = jQuery('#bsform_addDiagnosisAsPattern-form'),
        $bsmodal_DOM_addThisAsPattern   = jQuery('#bsmodal_addDiagnosisAsPattern-modal');

    /*
     * add as diagnosis pattern
     */
    jQuery('#panel_box_diag_btn_add_this_to_pattern_catalogue').filter(':not([disabled])').click(function(e) {
	if (!$chkDiag_field.is(':checked'))
	{
            e.preventDefault();
        } else {
            var $this_modal = $bsmodal_DOM_addThisAsPattern;

            $this_modal.fv_prepare_formatToFormInModal({});

            jQuery('input[id="form_diagAsPattern_nombre"]').val(jQuery.trim($FORM_MAIN_STUDY_DESCRIPTION));

            jQuery('select[id="form_diagAsPattern_idAreaServicioDiagnostico"]').select2('val', $FORM_MAIN_STUDY_MODALITY);

            var $tpResult_diagnosis = jQuery('select[id="' + $token /*$ADMIN_UNIQID_TOKEN*/ + '_idTipoResultado"]').val();
            jQuery('select[id="form_diagAsPattern_idTipoResultado"]').select2('val', !$tpResult_diagnosis ? $FORM_MAIN_DIAGNOSIS_RESULT_TYPE : $tpResult_diagnosis);

            jQuery('#form_diagAsPattern_hallazgos-static-label').html(simagdDescriptionAdvanceNoScrollFormatter($tx_hallazgos_field.summernote('code'), {}, null));
            jQuery('#form_diagAsPattern_conclusion-static-label').html(simagdDescriptionAdvanceNoScrollFormatter($tx_conclusion_field.summernote('code'), {}, null));
            jQuery('#form_diagAsPattern_recomendaciones-static-label').html(simagdDescriptionAdvanceNoScrollFormatter($tx_recomendaciones_field.summernote('code'), {}, null));

            $this_modal.modal();

            jQuery(window).resize();
        }
    });

    $bsform_DOM_addThisAsPattern
        .formValidation({
            excluded: [':disabled'],
	    locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $form.data('formValidation');

            var $ajaxPOST_url    = 'simagd_patron_diagnostico_addDiagnosisAsPattern';  // --| url to get the sources
            /*
             * set form to remote
             */
            $.post(Routing.generate($ajaxPOST_url), jQuery.extend(true, $form.formParams(), {
                form_diagAsPattern_hallazgos : $tx_hallazgos_field.summernote('code'),
                form_diagAsPattern_conclusion : $tx_conclusion_field.summernote('code'),
                form_diagAsPattern_recomendaciones : $tx_recomendaciones_field.summernote('code')
            }))
            .done(function(data, textStatus, jqXHR) {
                if (data.status === 'OK')
                {
                    /*
                     * default event action
                     */
                    console.log('Transcripción ha sido agregada como patrón satisfactoriamente');
                    $bsmodal_DOM_addThisAsPattern.modal('hide');
                    $success_bsAlert.addFadeSlideEffect();
                } else {
                    console.log('data', data, 'textStatus', textStatus, 'jqXHR', jqXHR, data.status === 'OK', data.status === "OK");
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log('jqXHR: -------------------', jqXHR);
                console.log('errorThrown: -------------', errorThrown);
                console.log('textStatus: --------------', textStatus);
                console.log('Ocurrió un error durante la operación');
                $bsmodal_DOM_addThisAsPattern.modal('hide');
                $error_bsAlert.addFadeSlideEffect();
            });
        });

    $bsmodal_DOM_addThisAsPattern.on('hide', function() {
        jQuery(this).fv_resetFormInModal();
    });

    /*
     * remove disable from menu if is checked
     */
    if ($chkDiag_field.is(':checked'))
    {
        jQuery('#panel_box_diag_btn_add_this_to_pattern_catalogue').parents('li').removeClass('disabled');
    }

    /*
     * PLUG-IN --| fv_prepare_formatToFormInModal
     * @param {type} options
     * @returns {undefined}
     */
    $.fn.fv_prepare_formatToFormInModal = function(options)
    {
	var $this       = jQuery(this),
            $data_id    = $this.attr('id'),
            $data_name  = $this.attr('name'),
            $form       = $this.find('form');
	var $action_form    = options.action;
	var $hide_action    = $action_form === 'create' ? 'edit' : 'create';

        /*
         * Actions for Custom ACTION Buttons in footer modal
         */
        $this
	    .find(':submit')
                    .off('click')
                    .on('click', function (e) {
                        e.stopImmediatePropagation();
                        var $submit = jQuery(this).data('submit');
                        $form.data('current-action', $submit);
                        $form.submit();
                    });
    };

});