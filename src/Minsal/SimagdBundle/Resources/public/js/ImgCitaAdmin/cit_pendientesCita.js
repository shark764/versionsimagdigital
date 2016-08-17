/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// http://api.jquery.com/after/
// http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/bootstrap-popovers.php
// http://getbootstrap.com/javascript/#popovers
// http://stackoverflow.com/questions/10126395/how-to-jquery-clone-and-change-id
// http://jsbin.com/IDUYafu/6/edit?html,js,output
// https://vitalets.github.io/x-editable/
// https://vitalets.github.io/x-editable/docs.html
// http://jsfiddle.net/BcczZ/157/
// http://getbootstrap.com/javascript/#popovers-events
// http://www.htmlgoodies.com/beyond/javascript/article.php/3471121


(function ($) {
    /*
     *
     * @type Array
     * Global variables for plugin
     */
    window.PENDING_REQUESTS_COLLECTION = {};   // --| build data collection

    /*
     *
     * @type Boolean
     * Global variables for plugin
     */
    window.NODATED_REQUEST_VIEW_DETAIL_FORMAT = false;   // --| build data collection
}(jQuery));


jQuery.fn.loadPacientesSinCita = function() {
    var $div_load   = this.find('.panel-body');
    var $field      = $('input[id="filter_patientsNoDated"]').filter(':not([disabled]):enabled:not([readonly])');
    
    jQuery(this).find('.panel-title').html(function() {
        return [
            '<i class="fa fa-spinner icon-refresh-animate"></i>',
            ' ',
            ' Actualizando'
        ].join('');
    });
    
    $('[data-toggle="popover"]').popover('hide');

    $div_load.find('div.fc-event').remove();
            
    var $patient_filters_sendToServer   = {
        xparam : {
            navbar_search_modalidad: {
                type    : 'undefined',
                target  : 'm_id',
                value   : jQuery('select[id="navbar_field_cita_modalidad"]').val()
            },
            navbar_search_expediente: {
                type    : 'undefined',
                target  : 'explocal_numero',
                value   : null
            }
        }
    };

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: Routing.generate('simagd_cita_cargarPacientesSinCita'),
        data: {
            filters: JSON.stringify($patient_filters_sendToServer)
        },
        success: function(data) {
            $.each(data, function(i) {
		var $prc_object_data = this;
                $div_load.append($('<div>')
				      .addClass('fc-event')
				      .css({ 'background-color' : this.color, 'border' : '1px double ' + this.color, 'padding-left' : '2px', 'padding-right' : '2px' })
				      .attr({ 'data-solicitud' : this.prc_id,
					      'data-numero' : this.exp_numero,
					      'data-color' : this.color,
					      'data-toggle' : 'popover',
					      'data-contentwrapper' : '.prc_container_contentwrapper'
					  })
				      .html(function() {
					  var $result	= jQuery.isEmptyObject($prc_object_data.prc_paciente) === false ?
                                                            $prc_object_data.prc_paciente : (jQuery.isEmptyObject($prc_object_data.unknExp_nombreFicticio) === false ?
                                                                $prc_object_data.unknExp_nombreFicticio : 'Sin datos');

					  return $result;
				      })
//				      .text(this.prc_paciente)
				      .data('event', {
					  prc_id: this.prc_id, // use the element's text as the event title
					  prc_fechaProximaConsulta: this.prc_fechaProximaConsulta,
					  title: jQuery.trim(this.prc_paciente), // use the element's text as the event title
					  start: '06:00',
					  stick: true, // maintain when user navigates (see docs on the renderEvent method)
					  color: jQuery.trim(this.color), // use the element's text as the event title
					  allDay: false,
					  event_server_object: this,
					  preferred_title: jQuery.trim(this.prc_paciente), // use the element's text as the event title
				      })
				      .draggable({
					  scroll: false,
					  helper: 'clone',
					  zIndex: 999,
					  revert: true,      // will cause the event to go back to its
					  revertDuration: 0  //  original position after the drag
				      })
				      .popover({
					  html: true,
					  placement: 'right',
					  trigger: 'click',
					  title : '<span class="text-info"><i class="fa fa-wheelchair"></i></span> ' + jQuery.trim(this.tooltip_title),
// 					  container: 'body',
					  template: [
							'<div class="popover popover-container-max-width" role="tooltip">',
							    '<div class="arrow">',
							    '</div>',
                                                            '<button type="button"    class="close" data-dismiss="popover" aria-hidden="true">&times;',
							    '</button>',
							    '<h3 class="popover-title">',
							    '</h3>',
							    '<div class="popover-content">',
							    '</div>',
							'</div>'
						    ].join(''),
					  content: function() {
						      $(jQuery(this).data('contentwrapper')).setDataSolicitudSinCitaContent({ object: $prc_object_data });
						      return $(jQuery(this).data('contentwrapper')).html();
					  }
				      }).on('shown.bs.popover', function(e) {
					  var $popover = jQuery(this);

					  /*
					  * prioridad X-editable
					  */
					  jQuery(this).parent().find('div.popover a[data-name="prAtn_nombre"]').editable({
					      source: $selectionsPriority,
					      inputclass: 'input-editable-width-v2',
					      select2: {
						  placeholder: '',
						  allowClear: true,
						  escape: false,
						  dropdownAutoWidth : true,
					      },
					      display: function(value, response) {
						  return false;   //disable this method
					      },
					      success: function(response, newValue) {
						  var $el = jQuery(this);
						  var $prd = null;
						  $.each($listPriority, function(i, v) {
						      if (v.text === jQuery.trim(newValue)) {
							  $prd = jQuery.extend({}, {prAtn_id: v.id, prAtn_codigo: v.cod, prAtn_nombre: v.text, prAtn_estiloPresentacion: v.style});
						      }
						  });
						  $.ajax({
						      type: 'post',
						      dataType: 'json',
						      url: Routing.generate('simagd_solicitud_estudio_cambiarPrioridadAtencionSolicitud'),
						      data: {
							  id: $prc_object_data.prc_id,
							  formPrcEditIdPrioridadAtencion: $prd.prAtn_id
						      },
						      success: function(response) {
								  console.log('Prioridad \'' + jQuery.trim($prc_object_data.prAtn_nombre) + '\' modificada a \'' + newValue + '\' satisfactoriamente');
								  jQuery.extend($prc_object_data, {prAtn_id: $prd.prAtn_id, prAtn_codigo: $prd.prAtn_codigo, prAtn_nombre: $prd.prAtn_nombre, prAtn_estiloPresentacion: $prd.prAtn_estiloPresentacion});
								  $el.html(simagdPrioridadAtencionFormatter(newValue, $prd, null));
						      },
						      error: function(e) {
								console.log('Se ha producido un error al modificar prioridad de solicitud');
								console.log(e.error);
								console.log(e.responseText);
								$el.html(simagdPrioridadAtencionFormatter($prc_object_data.prAtn_nombre, $prc_object_data, $prc_object_data.prc_id));
								$error_bsAlert.addFadeSlideEffect();
						      }
						  });
					      }
					  });

					  jQuery(this).parent().find('div.popover .show-solicitud-action').on('click', function(e) {
					      ___actionPreinscripcionSetterObjectModalData($prc_object_data.prc_id, $prc_object_data, {});
					      jQuery('#preinscripcionFullData-showModalContainer').modal();
					  });

					  jQuery(this).parent().find('div.popover .radx-ind-solicitud-action').on('click', function(e) {
					      jQuery('#formIndRadxPrcTitle').text('Agregar indicaciones de Médico Radiólogo');
					      jQuery('#formIndRadxPrcLabel').removeClass('label-success-v2 label-warning')
						      .addClass('label-primary-v2').text('Formulario para registro');
					      
					      jQuery('input[id="formIndRadxPrcId"]').val($prc_object_data.prc_id);
					      
					      jQuery('select[id="formIndRadxPrcIdRadiologo"]').select2('val', $prc_object_data.prc_id_radXInd);
        
					      if (jQuery.isEmptyObject(jQuery.trim($prc_object_data.prc_id_radXInd)) !== false) {
						  var $default_emp = jQuery('select[id="formIndRadxPrcIdRadiologo"]').data('default');
						  jQuery('select[id="formIndRadxPrcIdRadiologo"]').select2('val', $default_emp);
					      }
					      
					      /** text-editor Recomendaciones */
					      jQuery('[id="formIndRadxPrcIndicaciones"]').buildSummerNote({ newOptions: {
						  height: 200,  	// set editor height
						  maxHeight: 250,	// set maximum height of editor
					      }});
					      if (jQuery.isEmptyObject(jQuery.trim($prc_object_data.prc_id_radXInd)) === false) {
						  jQuery('[id="formIndRadxPrcIndicaciones"]').code($prc_object_data.prc_indicacionesMedicoRadiologo);
					      }
					      /** -- summernote */
					      
					      jQuery('#agregarIndicacionesRadiologo-modal').modal();

					      /* Set the form no validated */
					      jQuery('#agregarIndicacionesRadiologoForm').data('formValidation').resetForm();
					      
					      jQuery('#agregarIndicacionesRadiologoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
					      
					      jQuery('#agregarIndicacionesRadiologo-modal')
						  .find(':submit')
						      .removeAttr('disabled')
						      .removeClass('disabled');
					  });

					  jQuery(this).parent().find('div.popover .edit-solicitud-action').attr("href", $prc_object_data.prc_editUrl);

					  jQuery(this).parent().find('div.popover .sin-cita-solicitud-action').on('click', function(e) {
					      $.ajax({
						  type: 'post',
						  dataType: 'json',
						  url: Routing.generate('simagd_solicitud_estudio_requiereCita'),
						  data: { id: $prc_object_data.prc_id },
						  success: function(response) {
							      console.log('Elemento ingresado en lista sin cita satisfactoriamente');
							      $popover.popover('hide');
							      $('[id="fc-patient-panel"]').filter(':not([disabled]):visible').loadPacientesSinCita();
						  },
						  error: function(e) {
							    console.log('Se ha producido un error al ingresar elemento');
							    console.log(e.error);
							    console.log(e.responseText);
							    $error_bsAlert.addFadeSlideEffect();
						  }
					      });
					  });

					  jQuery(this).parent().find('div.popover .close-solicitud-action, [data-dismiss="popover"]').on('click', function(e) {
					      $popover.popover('hide');
					  });
				      })
				      .click(function() {
					  $('[data-toggle="popover"]').not(this).popover('hide');
// 					  console.log('hizo click aqui');
					  console.log($prc_object_data);
				      })
                               );
            });
	    jQuery.trim($field.val()) ? $field.trigger("typeahead:select") : $field.mostrarPacientesSinCita();
	    if (NODATED_REQUEST_VIEW_DETAIL_FORMAT !== false) {
		jQuery('#panel_patient_btn_show_request_detail')
			.filter(':not([disabled])')
			.triggerHandler('click');	// --| trigger btn handler, to display request in correct format
	    }
	    console.log('Pacientes se cargaron con éxito');
            $('[id="fc-patient-panel"]').find('.panel-title').html(function() {
                return [
                    '<i class="fa fa-wheelchair"></i>',
                    ' Pacientes sin cita'
                ].join('');
            });
	    jQuery.extend(true,
		    PENDING_REQUESTS_COLLECTION,
		    jQuery.isEmptyObject(data) === false ? data : {}
	    ); // set value for collection
        },
        error: function(e) {
            console.log('Se produjo un error al recargar pacientes sin cita');
            console.log(e.error);
            console.log(e.responseText);
        }
    });

};
    
jQuery.fn.filterPacientesSinCita = function() {
    var $div_load = this.find('.panel-body');
    var filterDiv = jQuery.trim($('input[id="filter_patientsNoDated"]').filter(':not([disabled]):enabled:not([readonly])').val());
    
    $('[data-toggle="popover"]').popover('hide');
    
    $div_load.find('div.fc-event').each(function () {
        jQuery.trim(jQuery(this).data("numero")) !== filterDiv ? jQuery(this).fadeOut() : jQuery(this).fadeIn();
    });

};
    
jQuery.fn.mostrarPacientesSinCita = function() {
    var $div_load = this.find('.panel-body');
    
    $('[data-toggle="popover"]').popover('hide');
    
    $div_load.find('div.fc-event').fadeIn();

};

/** Set data in popover */
jQuery.fn.setDataSolicitudSinCitaContent = function(options) {
    moment.locale('es');
    var $prcObject = options.object;

    jQuery(this).find('[data-render-info="idEstablecimiento"]')
	    .html(jQuery.trim($prcObject.prc_origen));
    jQuery(this).find('[data-render-info="idAreaAtencion"]')
	    .html(simagdAreaAtencionFormatter($prcObject.prc_areaAtencion, $prcObject, $prcObject.prc_id));
    jQuery(this).find('[data-render-info="idAtencion"]')
	    .html(jQuery.trim($prcObject.prc_atencion));
    jQuery(this).find('[data-render-info="idEmpleado"]')
	    .html(jQuery.trim($prcObject.prc_empleado));
    jQuery(this).find('[data-render-info="idAreaServicioDiagnostico"]')
	    .html(function() {
                return ['<span class="label label-element-v2">',
                        jQuery.trim($prcObject.prc_modalidad),
                    '</span>'
                ].join('');
            });
    jQuery(this).find('[data-render-info="idPrioridadAtencion"]')
	    .html(function() {
                var $result = simagdPrioridadAtencionFormatter($prcObject.prAtn_nombre, $prcObject, $prcObject.prc_id);

                return ['<a   href="javascript:void(0)"',
                    ' data-type="select2"',
                    ' data-name="prAtn_nombre"',
                    ' data-title="Nueva prioridad"',
                    ' data-pk="' + $prcObject.prc_id + '"',
                    ' data-value="' + jQuery.trim($prcObject.prAtn_nombre) + '"',
                    '>' + $result + '</a>'
                ].join('');
            });
    jQuery(this).find('[data-render-info="solicitudEstudioProyeccion"]')
	    .html(function() {
		var $arr_result = ['<ul>'];
		
		$.each($prcObject.prc_solicitudEstudioProyeccion, function(i, y) {
		    $arr_result.push('<li>', '<strong><span class="text-info">', jQuery.trim(y.expl_codigo) + '</span></strong> ' + jQuery.trim(y.expl_nombre), '</li>');
		});
		
		$arr_result.push('</ul>');

                return $arr_result.join('');
            });
    jQuery(this).find('[data-render-info="fechaProximaConsulta"]')
	    .html(moment(jQuery.trim($prcObject.prc_fechaProximaConsulta), "YYYY-MM-DD").format("dddd, MMMM D YYYY"));
    jQuery(this).find('[data-render-info="fechaCreacion"]')
	    .html(moment(jQuery.trim($prcObject.prc_fechaCreacion), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A"));
};


jQuery(document).ready(function() {
    /*
     * drop after render --| iCheck
     */
    jQuery('#drop-remove').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue',
    });
    
    /*
     * 
     * @type @call;$|@call;$
     */
    var $tt_elem_patientLc  = $('input[id="filter_patientsNoDated"]');
    
    var $tt_elem_clear      = $('i[id="clear-typeahead-filter-patient-exp"]');
    
    /*
     * --| add animated icon for typeahead
     */
    $tt_elem_patientLc.on('keyup', function() {
        var $tt_val = jQuery.trim(jQuery(this).val());
        if ($tt_val !== null && $tt_val !== "") {
            $tt_elem_clear.removeClass('glyphicon-remove-circle').addClass('glyphicon-repeat glyphicon-refresh-animate');
        } else {
            $tt_elem_clear.removeClass('glyphicon-repeat glyphicon-refresh-animate').addClass('glyphicon-remove-circle');
        }
    });
    $tt_elem_patientLc.filter(':not([disabled]):enabled:not([readonly])').on('typeahead:render typeahead:active typeahead:open typeahead:close typeahead:idle', function(ev, suggestion, flag, dataset) {
    	$tt_elem_clear.removeClass('glyphicon-repeat glyphicon-refresh-animate').addClass('glyphicon-remove-circle');
    });
    
    /*
     * **********************************************************************
     * --|Set the Options for "Bloodhound" Engine
     * **********************************************************************
     */

    /*
     * 
     * @type @new;Bloodhound
     */
    var $explocal_filter_sggClass   = new Bloodhound({
        limit: Infinity,
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: Routing.generate('simagd_estudio_obtenerExpedientesEstab') + '?query=%QUERY',
            wildcard: '%QUERY'
        },
    }); // --| suggestion class, bloodhound mode

    $explocal_filter_sggClass.initialize(); // --| initialize the Suggestion Engine

    /*
     * build typeahead
     */
    $tt_elem_patientLc.typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'value',
        displayKey: 'exp_numero',
        source: $explocal_filter_sggClass.ttAdapter(),
        limit: Infinity,
        templates: {
            empty: [
                '<div class="no-items">',
                    'Sin Resultados',
                '</div>'
            ].join('\n'),
            suggestion: function(item) {
                var $sggt_template_function	= $tt_elem_patientLc.data('template-source');

                var $edad   = jQuery.isEmptyObject(item.pct_edad) === false ? item.pct_edad.y + ' Años, ' + item.pct_edad.m + ' meses, ' + item.pct_edad.d + ' días' : 'desconocida';

                return typeof window[$sggt_template_function] === 'function' ?
                    window[$sggt_template_function](item) : [
                        '<div class="expand-box" style="z-index: 1000;">',
                            '<span style="">',
                                item.pct_nombreCompleto,
                            '</span>',
                            '<div style="min-width: 100%; text-align: left;">',
                                '<span class="label label-default-v2" style="float: none; margin-top: 0px; text-align: left;">',
                                    '[Edad: ' + $edad + ']',
                                '</span>',
                            '</div>',
                            '<div style="min-width: 100%; text-align: left;">',
                                '<span class="label label-element-v2" style="float: none; margin-top: 0px; margin-right: 0px; text-align: left;">',
                                    '[' + item.exp_numero + ']',
                                '</span>',
                            '</div>',
                        '</div>'
                ].join('\n');
            },
            footer: function(query) {
                return [
                    '<div style="text-align: center !important; opacity: 0.5 !important;">',
                        '<span class="text-element-v2">',
                            'Búsqueda: "' + query.query + '"',
                        '</span>',
                    '</div>'
                ].join('\n');
            }
        }
    });
    
    /*
     * fc-patient-panel, show refresh patient without date message
     * @type @call;$
     */
    var $fc_patient_panel   = $('[id="fc-patient-panel"]');
    
    $fc_patient_panel.filter(':not([disabled]):visible')
	.loadPacientesSinCita();
    
    jQuery('button[id="reload-pct-sin-cita"]').click(function() {
        $fc_patient_panel.filter(':not([disabled]):visible')
	    .loadPacientesSinCita();
    });
    
    jQuery('select[id="navbar_field_cita_modalidad"]').change(function() {
        $fc_patient_panel.filter(':not([disabled]):visible')
	    .loadPacientesSinCita();
	    console.log('%c.tt-highlight en search no puede verse ahora que se cambió el label-default-v2', 'background: #31708f; color: #fff');
    });
    
    /* Filtrar en cliente solicitudes */
    $tt_elem_patientLc.filter(':not([disabled]):enabled:not([readonly])').on('typeahead:select', function(ev, suggestion) {
        $fc_patient_panel.filter(':not([disabled]):visible')
	    .filterPacientesSinCita();
        console.log('$tt_elem_patientLc val', jQuery(this).val());
    });
    
    $tt_elem_clear.click(function() {
        console.log('$tt_elem_patientLc val', $tt_elem_patientLc.filter(':not([disabled]):enabled:not([readonly])').val());
        $tt_elem_patientLc.filter(':not([disabled]):enabled:not([readonly])').typeahead('val', '');
        $fc_patient_panel.filter(':not([disabled]):visible')
	    .mostrarPacientesSinCita();
        $tt_elem_clear.removeClass('glyphicon-repeat glyphicon-refresh-animate').addClass('glyphicon-remove-circle');
        console.log('$tt_elem_patientLc val', $tt_elem_patientLc.filter(':not([disabled]):enabled:not([readonly])').val());
    });
    
    $(document).on('shown.bs.popover', '[data-toggle="popover"]', function() {
	console.log('shown.bs.popover');
    });
    

    /*
     * SUMMERNOTE Text-Editor for Indicaciones
     * DOM elements
     */
    var $field_indRadx 	= jQuery('[id="formIndRadxPrcIndicaciones"]');
    
    /** DOM elements */
    var $form_indRadx 	= jQuery('#agregarIndicacionesRadiologoForm');
    var $modal_indRadx	= jQuery('#agregarIndicacionesRadiologo-modal');
    
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
    
    $modal_indRadx.on('hide', function() {
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
    
    $tt_elem_patientLc.parents('.twitter-typeahead').find('.tt-menu').css('min-width', '0');
    
    
    /*
     * **************************************************************************
     * --| CONTRAER / EXPANDIR VISTA DE PACIENTES NO CITADOS
     * **************************************************************************
     */

    /** local variable DOM objects */
    var $form_prcEmrgRq     = jQuery('#crearSolicitudEstudioFormatoRapido-form');
    var $modal_prcEmrgRq    = jQuery('#crearSolicitudEstudioFormatoRapido-modal');

//    jQuery('#crearSolicitudEstudioFormatoRapido-modal').modal();
//    jQuery('#formPrcEmergencyRequestSolicitudEstudioProyeccion').change(function () {
//        $modal_prcEmrgRq.modal('layout');
//    });

    /** Tabla de solicitudes */
    var $table_prc          = jQuery('#table-lista-solicitudes-estudio');
    
    var $patient_nodated_panel_body_height      = jQuery('#fc-patient-panel').find('.panel-body').height();
//    var $patient_nodated_panel_footer_height    = jQuery('#fc-patient-panel').find('.panel-footer').outerHeight(true);
    /*
     * expand no dated patient view
     */
    jQuery('#panel_patient_btn_expand_height_view').filter(':not([disabled])').click(function(e) {
        jQuery('#panel_patient_btn_default_height_view').parents('li').show();
        jQuery(this).parents('li').hide();
        
        jQuery('#external-events-symbol').hide('slide', {direction: 'down'}, 100, function() {
            jQuery('#fc-patient-panel').find('.panel-body').height(jQuery('#container_fc_agenda_view').find('.panel-body').height() - jQuery('#fc-patient-panel').find('.panel-footer').outerHeight(true) - 25);
            jQuery(window).resize();
        });
    });
    /*
     * return to default no dated patient view
     */
    jQuery('#panel_patient_btn_default_height_view').filter(':not([disabled])').click(function(e) {
        jQuery('#external-events-symbol').show('slide', {direction: 'up'}, 100, function() {
            jQuery('#fc-patient-panel').find('.panel-body').height($patient_nodated_panel_body_height);
            jQuery(window).resize();
        });
        
        jQuery('#panel_patient_btn_expand_height_view').parents('li').show();
        jQuery(this).parents('li').hide();
    });
    
    /*
     * **************************************************************************
     * --| FORMULARIO PARA PACIENTE EXTERNO
     * **************************************************************************
     */
    jQuery('#panel_patient_btn_add_external').filter(':not([disabled])').click(function(e) {
        var $btn_this   = jQuery(this);

        moment.locale('es');

        jQuery('#btn_agregar_prcEmergencyRequest').show();
        jQuery('#btn_editar_prcEmergencyRequest').hide();

        jQuery('#formPrcEmergencyRequestLabel').removeClass('label-element-v2')
                .addClass('label-primary-v2').html('Paciente desconocido' + ' <span class="badge badge-primary-v2" style="margin-left: 5px;"> NI-####-## </span>');

        jQuery('input[id="formPrcEmergencyRequestId"]').val('');

        /*
         * Expediente (local | ficticio)
         */
        jQuery('input[id="formPrcEmergencyRequestIdExpediente"]').val('');

        /*
         * Emergencia
         */
        jQuery('input[id="formPrcEmergencyRequestEsEmergencia"]').val(true);

        /*
         * Origen de la solicitud
         */
        jQuery('select[id="formPrcEmergencyRequestIdAreaAtencion"]').select2('val', '2');
        jQuery('select[id="formPrcEmergencyRequestIdAtencion"]').select2('val', jQuery('select[id="formPrcEmergencyRequestIdAtencion"]').data('default'));
        jQuery('select[id="formPrcEmergencyRequestIdEmpleado"]').select2('val', jQuery('select[id="formPrcEmergencyRequestIdEmpleado"]').data('default'));
        jQuery('select[id="formPrcEmergencyRequestIdAreaAtencion"]').trigger('change', [true, false]);    // --| Filtrar areaAtencion
        /*
         * Estudio solicitado
         */
        jQuery('select[id="formPrcEmergencyRequestIdAreaServicioDiagnostico"]').select2('val', jQuery('select[id="formPrcEmergencyRequestIdAreaServicioDiagnostico"]').data('default'));
        jQuery('select[id="formPrcEmergencyRequestIdAreaServicioDiagnostico"]').trigger('change', [true, false]);    // --| Filtrar modalidad
        /*
         * Requerimiento de prioridad
         */
        jQuery('select[id="formPrcEmergencyRequestIdPrioridadAtencion"]').select2('val', jQuery('select[id="formPrcEmergencyRequestIdPrioridadAtencion"]').data('default'));
        jQuery('select[id="formPrcEmergencyRequestSolicitudEstudioProyeccion"]').select2('val', '');

        var $dt_proximaConsulta = moment().add(0, 'd');
        jQuery('input[id="formPrcEmergencyRequestFechaProximaConsulta"]').val( $dt_proximaConsulta.format('YYYY-MM-DD'));
        jQuery('input[id="formPrcEmergencyRequestFechaProximaConsulta"]').data("DateTimePicker").date($dt_proximaConsulta);

        jQuery('textarea[id="formPrcEmergencyRequestDatosClinicos"]').val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestDatosClinicos', false, 'notEmpty');
        jQuery('textarea[id="formPrcEmergencyRequestHipotesisDiagnostica"]').val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestHipotesisDiagnostica', false, 'notEmpty');
        jQuery('textarea[id="formPrcEmergencyRequestInvestigando"]').val('');
        $form_prcEmrgRq.formValidation('enableFieldValidators', 'formPrcEmergencyRequestInvestigando', false, 'notEmpty');
        jQuery('textarea[id="formPrcEmergencyRequestJustificacionMedica"]').val('');
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
    
});