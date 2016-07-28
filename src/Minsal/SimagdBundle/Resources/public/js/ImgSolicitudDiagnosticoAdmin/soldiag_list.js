/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Declare an empty array using literal notation:
var solicitudDiagCacheShowView = [];
var solicitudDiagCacheShowViewObject = [];

function actionSolDiagFormatter(value, row, index) {
    return [
        '<a   class="show-solicitud-diagnostico-action btn btn-primary-v2 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar solicitud de diagnóstico detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
        '<i class="glyphicon glyphicon-info-sign"></i>',
        '</a>',
        '<a   class="edit-solicitud-diagnostico-action btn btn-primary-v2 btn-outline btn-xs ml10" href="javascript:void(0)" title="Editar registro de solicitud de diagnóstico"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
        '<i class="glyphicon glyphicon-repeat"></i>',
        '</a>'
    ].join('');
}

function remotaFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.remota === false ? 'primary' : 'info') + '">',
        (row.remota === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

window.actionSolDiagEvents = {
    'click .show-solicitud-diagnostico-action': function (e, value, row, index) {
	moment.locale('es');

	console.log('******************** ************ ***** AQUI COMIENZA LO BUENO!! ***** ************ ********************');
	if (jQuery.inArray(row.id, solicitudDiagCacheShowView ) === -1) {
            $.ajax({ type: 'post', dataType: 'json', url: Routing.generate('simagd_solicitud_diagnostico_getObjectVarsAsArray'), data: { id: row.id },
                success: function(response) {
                            solicitudDiagCacheShowView.push(row.id);
                            solicitudDiagCacheShowViewObject.push({ 'id' : row.id, 'object' : response.object });
                            console.log('added');
                            
                            console.log('objeto recuperado exitosamente');
                            jQuery('#crearSolicitudDiag-modal')
                                .find('div.modal-footer')
                                    .html('<span class="text-success">\n\
                                                <span class="glyphicon glyphicon-question-sign"></span>\n\
                                                    ¿Está seguro que desea continuar?</span>\n\
                                                    <button type="button"    class="btn btn-success" ><i class="fa fa-plus-circle"></i>\n\
                                                    ' + moment(jQuery.trim(response.object.fechaCreacion.date), "YYYY-MM-DD HH:mm:ss")
                                                          .format("dddd, MMMM D YYYY, h:mm:ss A") + '</button>');
                            jQuery('#crearSolicitudDiag-modal').modal();
                },
                error: function(e) {
                            console.log('Se ha producido un error al recuperar objeto');
                            console.log(e.error);
                            console.log(e.responseText);
                }
            });
    
	} else {
	    console.log('is here');
	    $.each(solicitudDiagCacheShowViewObject, function(indexCache, valueCache) {
		if (valueCache.id === row.id) {
                    jQuery('#crearSolicitudDiag-modal')
                        .find('div.modal-footer')
                            .html('<span class="text-info">\n\
                                        <span class="glyphicon glyphicon-question-sign"></span>\n\
                                            ¿Está seguro que desea continuar?</span>\n\
                                            <button type="button"    class="btn btn-info" ><i class="fa fa-plus-circle"></i>\n\
                                            ' + moment(jQuery.trim(valueCache.object.fechaCreacion.date), "YYYY-MM-DD HH:mm:ss")
                                                  .format("dddd, MMMM D YYYY, h:mm:ss A") + '</button>');
                    jQuery('#crearSolicitudDiag-modal').modal();
		}
	    });
	}
    },
    'click .edit-solicitud-diagnostico-action': function (e, value, row, index) {
        jQuery('#btn_agregar_soldiag').hide();
        jQuery('#btn_editar_soldiag').show();
        
        jQuery('#crearSolicitudDiag-modal').modal();
        
        $("input[id='formSolicitudDiagId']").val(row.id);
        
        $("input[id='formSolicitudDiagRemota']").iCheck(row.remota === false ? 'uncheck' : 'check');
        
        $("select[id='formSolicitudDiagIdEmpleado']").select2('val', row.empleadoId);
        $("select[id='formSolicitudDiagIdEstablecimientoSolicitado']").select2('val', row.solicitadoId);
        
        $("textarea[id='formSolicitudDiagJustificacion']").val(jQuery.trim(row.justificacion));
        $("textarea[id='formSolicitudDiagObservaciones']").val(jQuery.trim(row.observaciones));
        
        var rowFechaProximaConsulta = moment(row.fechaProximaConsulta, "YYYY-MM-DD");
        $("input[id='formSolicitudDiagFechaProximaConsulta']").val(rowFechaProximaConsulta.format('YYYY-MM-DD'));
        $("input[id='formSolicitudDiagFechaProximaConsulta']").data("DateTimePicker").date(rowFechaProximaConsulta);

        console.log(row);
    }
};
    
$(document).on('click', "button[id='btn_editar_soldiag']", function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: Routing.generate('simagd_solicitud_diagnostico_editarSolicitudDiag'),
        data: jQuery('#crearSolicitudDiagForm').formParams(),
        success: function(response) {
            console.log('Solicitud de diagnóstico editada satisfactoriamente');
            jQuery('#table-lista-solicitudes-diagnostico').bootstrapTable('refresh');
            jQuery('#crearSolicitudDiag-modal').modal('hide');
        },
        error: function(e) {
            console.log('Se ha producido un error al editar solicitud de diagnóstico');
            console.log(e.error);
            console.log(e.responseText);
        }
    });

});

jQuery(document).ready(function() {
    
    $("input[id='formSolicitudDiagFechaProximaConsulta']").datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.change", function (e) {
        jQuery(this).blur();
//        jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', jQuery(this).attr('name'));
    });
    
    $(document).on('click', "button[id='showDateTimePicker']", function(e) {
        e.preventDefault();

        $("input[id='formSolicitudDiagFechaProximaConsulta']").data("DateTimePicker").show();
        console.log('Datetimepicker displayed');
    });
    
    jQuery('#table-lista-solicitudes-diagnostico').on('load-success.bs.table', function (e, data) {
	solicitudDiagCacheShowView.length = 0;
	solicitudDiagCacheShowViewObject.length = 0;
	console.log('refresh');
    });
    
});