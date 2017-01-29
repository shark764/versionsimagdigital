/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Declare an empty array using literal notation:
var lecturaCacheShowView = [];
var lecturaCacheShowViewObject = [];

function actionLecturaFormatter(value, row, index) {
    return [
        '<a   class="show-lectura-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar lectura detallada"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
        '<i class="glyphicon glyphicon-info-sign"></i>',
        '</a>',
        '<a   class="edit-lectura-action btn btn-primary-v4 btn-outline btn-xs ml10" href="' + row.editLctUrl + '" target="_blank" title="Editar registro de lectura"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
        '<i class="glyphicon glyphicon-repeat"></i>',
        '</a>'
    ].join('');
}

window.actionLecturaEvents = {
    'click .show-lectura-action': function (e, value, row, index) {
// 	console.log('row.lectura3.correlativo: ' + row.lectura3.correlativo);
	
 	console.log('********************');
	moment.locale('es');
	console.log('row.lectura3.fechaLectura: ' +
		      moment(jQuery.trim(row.lectura3.fechaLectura.date), "YYYY-MM-DD HH:mm:ss")
			  .format("dddd, MMMM D YYYY, h:mm:ss A"));

	$.each(row.lectura3.estudiosLectura, function(index, value) {
	    console.log('********************&&&&&&&& Estudio : ' + value.id + ', Uid: ' + value.estudioUid + ' &&&&&&&&********************');
	    console.log("index : " + index);
	    console.log(value);
	    console.log('******************** PRZ material_v2 con: ' + value.idProcedimientoRealizado.materialUtilizadoV2.length + ' ********************');
	    $.each(value.idProcedimientoRealizado.materialUtilizadoV2, function(index2, value2) {
		console.log("index2 : " + index2);
		console.log(value2);
	    });
	    console.log('******************** fin PRZ matUtlz V2 ********************');
            
	    console.log('******************** idCitaProgramada ********************');
	    console.log("idCitaProgramada V2 : " + jQuery.isEmptyObject(value.idProcedimientoRealizado.idCitaProgramada));
            var $citaObject = $.extend( {}, value.idProcedimientoRealizado.idCitaProgramada);
            var isEmptyCit = jQuery.isEmptyObject($citaObject);
            console.log("idCitaProgramada V3 ( Extend {} ) : " + isEmptyCit + " ::: real: " + jQuery.isEmptyObject($citaObject));
            console.log($citaObject);
	    console.log('******************** fin idCitaProgramada ********************');
	});
        
// 	console.log(row.lectura3);

        var pctId = jQuery.isEmptyObject(row.lectura3.idEstudio) === false ? jQuery.trim(row.lectura3.idEstudio.idExpediente.idPaciente) : -1;

	console.log('******************** ************ ***** AQUI COMIENZA LO BUENO!! ***** ************ ********************');
	if (jQuery.inArray(row.lectura3.id, lecturaCacheShowView ) === -1) {
	    lecturaCacheShowView.push(row.lectura3.id);
	    lecturaCacheShowViewObject.push({ 'id' : row.lectura3.id, 'lectura' : row.lectura3 });
	    console.log('added');

            $.ajax({ type: 'POST', dataType: 'json', url: Routing.generate('simagd_lectura_getObjectVarsAsArray'), data: { id: row.id, pct: pctId },
                success: function(response) {
                            console.log('objeto recuperado exitosamente');
                            console.log(response);
                            /* Para saber si el string de fechaCreacion es comprobable */
                            console.log(response.expediente[0].fechaCreacion);
                            if (!jQuery.trim(response.expediente[0].fechaCreacion)) {
                                console.log('response.expediente[0].fechaCreacion vacio');
                            } else {
                                console.log('response.expediente[0].fechaCreacion NO vacio');
                            }
                            
                            jQuery('#transcribirDiagnostico-modal').modal();
                            jQuery('#transcribirDiagnostico-modal')
                                .find('div.modal-footer')
                                    .html('<span class="text-success">\n\
                                                <span class="glyphicon glyphicon-question-sign"></span>\n\
                                                    ¿Está seguro que desea continuar?</span>\n\
                                                    <button type="button"    class="btn btn-success" ><i class="fa fa-plus-circle"></i>\n\
                                                    ' + moment(jQuery.trim(response.object.fechaLectura.date), "YYYY-MM-DD HH:mm:ss")
                                                          .format("dddd, MMMM D YYYY, h:mm:ss A") + '</button>');
				    
			    $("#miprueba")
				.find("[data-render-info='fechaHoraInicioAnterior']")
                                    .html('<span class="text-success">' + moment(jQuery.trim(response.object.fechaLectura.date), "YYYY-MM-DD HH:mm:ss")
                                                          .format("dddd, MMMM D YYYY, h:mm:ss A") + '</span>');
                },
                error: function(e) {
                            console.log('Se ha producido un error al recuperar objeto');
                            console.log(e.error);
                            console.log(e.responseText);
                }
            });
    
	} else {
	    console.log('is here');
	    $.each(lecturaCacheShowViewObject, function(indexCache, valueCache) {
		if (valueCache.id === row.lectura3.id) {
		    console.log("index lecturaCacheShowViewObject found row.lectura3.id = object.id : " + indexCache);
		    console.log(valueCache);
                    jQuery('#transcribirDiagnostico-modal').modal();
                    jQuery('#transcribirDiagnostico-modal')
                        .find('div.modal-footer')
                            .html('<span class="text-info">\n\
                                        <span class="glyphicon glyphicon-question-sign"></span>\n\
                                            ¿Está seguro que desea continuar?</span>\n\
                                            <button type="button"    class="btn btn-info" ><i class="fa fa-plus-circle"></i>\n\
                                            ' + moment(jQuery.trim(valueCache.lectura.fechaLectura.date), "YYYY-MM-DD HH:mm:ss")
                                                  .format("dddd, MMMM D YYYY, h:mm:ss A") + '</button>');
				    
		    $("#miprueba")
			.find("[data-render-info='fechaHoraInicioAnterior']")
			    .html('<span class="text-info">' + moment(jQuery.trim(valueCache.lectura.fechaLectura.date), "YYYY-MM-DD HH:mm:ss")
						  .format("dddd, MMMM D YYYY, h:mm:ss A") + '</span>');
		}
	    });
	}
	
 	console.log('lecturaCacheShowView is now: -->');
 	console.log(lecturaCacheShowView);
 	console.log('lecturaCacheShowViewObject is now: -->');
 	console.log(lecturaCacheShowViewObject);
    }
};

function remotaFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.remota === false ? 'primary' : 'info') + '">',
        (row.remota === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

jQuery(document).ready(function() {
    
    $('li.list-table-link-navbar').find("a:not([disabled])").click(function(e) {
        var $target_divContainer_bsTable = jQuery(this).data('divtabletarget');
	var $target = jQuery('#' + $target_divContainer_bsTable);
	console.log(jQuery.trim($target.data('refresh-url')));
        $target.find('table[data-toggle="table"]').bootstrapTable('refresh', { url: jQuery.trim($target.data('refresh-url')) });
        $('.menu-listas-resultados-radiologicos').hide();
        $target.show();
        $('li.list-table-link-navbar').removeClass('active');
        jQuery(this).parents("li").addClass("active");
    });
    
    jQuery('#table-lista-lecturas').on('load-success.bs.table', function (e, data) {
	lecturaCacheShowView.length = 0;
	lecturaCacheShowViewObject.length = 0;
	console.log('refresh');
    });
    
});