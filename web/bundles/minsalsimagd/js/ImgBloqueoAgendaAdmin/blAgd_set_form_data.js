/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** Ingresar en formulario los datos existentes */
function ___setDataEditBloqueoForm(e, value, $object, index)
{
    moment.locale('es');
    
    jQuery('#btn_agregar_blAgd').hide();
    jQuery('#btn_editar_blAgd').show();
    
    jQuery('#formBlAgdTitle').text('Editar bloqueo de agenda');
    jQuery('#formBlAgdLabel').removeClass('label-primary-v2')
	    .addClass('label-element-v2').text('Formulario para edición');
    
    $("input[id='formBlAgdId']").val($object.blAgd_id);
    $("input[id='formBlAgdTitulo']").val($object.blAgd_titulo);
    $("select[id='formBlAgdIdAreaServicioDiagnostico']").select2('val', $object.blAgd_id_area_servicio_diagnostico);
    $("select[id='formBlAgdIdRadiologoBloqueo']").select2('val', $object.blAgd_id_radiologo);
    
    var $rowFechaIni = moment($object.blAgd_fechaInicio, "YYYY-MM-DD");
    $("input[id='formBlAgdFechaInicio']").val($rowFechaIni.format('YYYY-MM-DD'));
    $("input[id='formBlAgdFechaInicio']").data("DateTimePicker").date($rowFechaIni);
    
    var $rowFechaFin = moment($object.blAgd_fechaFin, "YYYY-MM-DD");
    $("input[id='formBlAgdFechaFin']").val($rowFechaFin.format('YYYY-MM-DD'));
    $("input[id='formBlAgdFechaFin']").data("DateTimePicker").date($rowFechaFin);
    
    var $rowHoraIni = moment($object.blAgd_horaInicio, "HH:mm");
    $("input[id='formBlAgdHoraInicio']").val($rowHoraIni.format('HH:mm'));
    $("input[id='formBlAgdHoraInicio']").data("DateTimePicker").date($rowHoraIni);
    
    var $rowHoraFin = moment($object.blAgd_horaFin, "HH:mm");
    $("input[id='formBlAgdHoraFin']").val($rowHoraFin.format('HH:mm'));
    $("input[id='formBlAgdHoraFin']").data("DateTimePicker").date($rowHoraFin);
    
    $("input[id='formBlAgdDiaCompleto']").iCheck($object.blAgd_diaCompleto === false ? 'uncheck' : 'check');
    $("input[id='formBlAgdColor']").val($object.blAgd_color);
    $("input[id='formBlAgdColor']").colorpicker('setValue', $object.blAgd_color);
    $("textarea[id='formBlAgdDescripcion']").val(jQuery.trim($object.blAgd_descripcion));
    
    jQuery('#crearBloqueo-modal').modal();
    
    /* Set the form no validated */
    jQuery('#crearBloqueoForm').data('formValidation').resetForm();
    
    jQuery('#crearBloqueoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
    
    jQuery('#crearBloqueo-modal')
	.find(':submit')
	    .removeAttr('disabled')
	    .removeClass('disabled');
}