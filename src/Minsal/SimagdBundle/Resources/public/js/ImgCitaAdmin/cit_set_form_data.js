/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** Ingresar en formulario los datos existentes */
function ___setDataEditCitForm(e, value, $object, index)
{
    moment.locale('es');
    
    $("#formCitId").val($object.cit_id);
    
    $("#formCitFechaProximaConsulta").val($object.prc_fechaProximaConsulta);
    
    $("#formCitIdTecnologoProgramado").select2('val', $object.cit_id_tecnologo);
    
    var $objectFechaHoraInicio = moment(jQuery.trim($object.cit_fechaHoraInicio), "YYYY-MM-DD HH:mm:ss");
    $("#formCitFechaHoraInicio").val($objectFechaHoraInicio.format('YYYY-MM-DD hh:mm A'));
    $("#formCitFechaHoraInicio").data("DateTimePicker").date($objectFechaHoraInicio);
    
    var $objectFechaHoraFin = moment(jQuery.trim($object.cit_fechaHoraFin), "YYYY-MM-DD HH:mm:ss");
    $("#formCitFechaHoraFin").val($objectFechaHoraFin.format('YYYY-MM-DD hh:mm A'));
    $("#formCitFechaHoraFin").data("DateTimePicker").date($objectFechaHoraFin);
    
    $("#formCitDiaCompleto").iCheck($object.cit_diaCompleto === false ? 'uncheck' : 'check');
    
    $("#formCitIdEstadoCita").select2('val', $object.cit_id_estado);
    
    var $razonAnulacion = $("#divformCitRazonAnulada");
    var codEstado = jQuery.trim(jQuery('#formCitIdEstadoCita').find(':selected').data('codigo'));
    var $field = $("#formCitRazonAnulada");
    
    $field.val(jQuery.trim($object.cit_razonAnulada));
    $razonAnulacion.data("razon-previa", jQuery.trim($object.cit_razonAnulada));
    if (jQuery.inArray(codEstado, ["CNL", "ANL"]) !== -1) {
	$field.prop('readonly', false);
	if (!jQuery.trim($field.val())) {
	    $field.val(jQuery.trim($razonAnulacion.data("razon-previa")));
	}
    } else {
	$field.prop('readonly', true);
	$field.val('');
    }
    
    $("#formCitColor").val($object.cit_color);
    $("#formCitColor").colorpicker('setValue', $object.cit_color);
    
    $("#formCitIncidencias").val(jQuery.trim($object.cit_incidencias));
    $("#formCitObservaciones").val(jQuery.trim($object.cit_observaciones));
    
    jQuery('#editarCita-modal').modal();

    /* Set the form no validated */
    jQuery('#editarCitaForm').data('formValidation').resetForm();
    
    jQuery('#editarCitaForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
    
    jQuery('#editarCita-modal')
	.find(':submit')
	    .removeAttr('disabled')
	    .removeClass('disabled');
}

/** Insertar en formulario de cancelación los datos existentes */
function ___setDataCancelCitForm(e, value, $object, index)
{
    $("#formCancelCitId").val($object.cit_id);

    var $estadoCancel = $("#formCancelCitIdEstadoCita");
    $estadoCancel.select2('val', $object.cit_id_estado);
    if (!$estadoCancel.val()) {
	$estadoCancel.select2('val', 6);
    }
    
    $("#formCancelCitRazonAnulada").val(jQuery.trim($object.cit_razonAnulada));
    
    $("#formCancelCitIncidencias").val(jQuery.trim($object.cit_incidencias));
    $("#formCancelCitObservaciones").val(jQuery.trim($object.cit_observaciones));

    jQuery('#cancelarCita-modal').modal();
    
    /* Set the form no validated */
    jQuery('#cancelarCitaForm').data('formValidation').resetForm();
    
    jQuery('#cancelarCitaForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
    
    jQuery('#cancelarCita-modal')
	.find(':submit')
	    .removeAttr('disabled')
	    .removeClass('disabled');
}
