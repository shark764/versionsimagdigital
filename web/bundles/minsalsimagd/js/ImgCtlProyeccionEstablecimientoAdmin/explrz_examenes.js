/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Function encargada de hacer el request al action, y llenar el select con los exámenes regresados, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.

jQuery(document).ready(function() {
    
    $("select[id='formExplrzIdAreaServicioDiagnostico']").change(function() {
        var fieldAreaServicioApoyoVal = jQuery(this).val();
        var $fieldExamenServicioApoyo = $("select[id='formExplrzIdExamenServicioDiagnostico']");
	var fieldExamenServicioApoyoVal = $fieldExamenServicioApoyo.val();
	var imgAtencionVal = '97';
	
	if (fieldAreaServicioApoyoVal) {
            $.ajax({
		type: 'post',
		dataType: 'json',
		url: Routing.generate('simagd_solicitud_estudio_cargarDatosPorFiltro'),
                data: {
                    param_filterA : fieldAreaServicioApoyoVal,
                    param_filterB : imgAtencionVal,
                    selector : 'exm'
                },
                beforeSend: function() {
				$fieldExamenServicioApoyo.select2('val', '');
				$fieldExamenServicioApoyo.attr('disabled', true);
				$fieldExamenServicioApoyo.find('option:gt(0)').prop('disabled', true);
                },
                success: function(data) {
			    $.each(data.resultados, function(i) {
				$fieldExamenServicioApoyo.append($("<option></option>").attr("value", this.value).text(this.text));
			    });
			    $fieldExamenServicioApoyo.attr('disabled', false);
			    
			    $fieldExamenServicioApoyo
				.select2('val', $initFormNoValidated !== false ?
					    $currentProyeccion.exm_id : fieldExamenServicioApoyoVal);
			    
			    if (fieldAreaServicioApoyoVal && !fieldExamenServicioApoyoVal) {
				$fieldExamenServicioApoyo.select2("search", "");
			    }
			    $fieldExamenServicioApoyo.trigger("change");
                },
                error: function (data) {
			  console.log(data.error);
			  console.log(data.responseText);
                }
            });
        } else  {
            $fieldExamenServicioApoyo.select2('val', '');
            $fieldExamenServicioApoyo.find('option:gt(0)').prop('disabled', true);
	    $fieldExamenServicioApoyo.trigger("change");
        }
    });
    
    $("select[id='formExplrzIdExamenServicioDiagnostico']").change(function() {
        var fieldAreaServicioApoyoVal = $("select[id='formExplrzIdAreaServicioDiagnostico']").val();
        var fieldExamenServicioApoyoVal = jQuery(this).val();
        var $fieldProyeccion = $("select[id='formExplrzIdProyeccion']");
	var fieldProyeccionVal = $fieldProyeccion.val();
	
	if (fieldAreaServicioApoyoVal && fieldExamenServicioApoyoVal) {
            $.ajax({
		type: 'post',
		dataType: 'json',
		url: Routing.generate('simagd_solicitud_estudio_cargarDatosPorFiltro'),
                data: {
                    param_filterA : fieldAreaServicioApoyoVal,
                    param_filterB : fieldExamenServicioApoyoVal,
                    selector : 'explnrz'
                },
                beforeSend: function() {
				$fieldProyeccion.select2('val', '');
				$fieldProyeccion.attr('disabled', true);
				$fieldProyeccion.find('option:gt(0)').prop('disabled', true);
                },
                success: function(data) {
			    $.each(data.resultados, function(i) {
				$fieldProyeccion.append($("<option></option>").attr("value", this.value).text(this.text));
			    });
			    $fieldProyeccion.attr('disabled', false);
			    
			    /** Proyección ya insertada */
			    if ($currentProyeccion.m_id == fieldAreaServicioApoyoVal && $currentProyeccion.exm_id == fieldExamenServicioApoyoVal) {
				$fieldProyeccion.find('optgroup[label="Proyección insertada"]')
						.append($("<option></option>")
							  .attr("value", $currentProyeccion.expl_id)
							  .text($currentProyeccion.expl_nombre));
			    }
			    
			    $fieldProyeccion
				.select2('val', $initFormNoValidated !== false ?
					    $currentProyeccion.expl_id : fieldProyeccionVal);
			    
			    if (fieldExamenServicioApoyoVal && !fieldProyeccionVal) {
				$fieldProyeccion.select2("search", "");
			    }
			    $fieldProyeccion.trigger("change");
			    
			    if ($initFormNoValidated !== false) {
				jQuery('#crearProyeccionLocalForm').data('formValidation').resetForm();
				jQuery('#crearProyeccionLocal-modal').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
			    }
			    $initFormNoValidated = false;
                },
                error: function (data) {
			  console.log(data.error);
			  console.log(data.responseText);
                }
            });
        } else  {
            $fieldProyeccion.select2('val', '');
            $fieldProyeccion.find('option:gt(0)').prop('disabled', true);
	    $fieldProyeccion.trigger("change");
	    
	    $initFormNoValidated = false;
        }
    });
    
});