/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$currentExp = null;

function actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="mostrar-lista-pacientes-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Ver información"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-zoom-in"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="preinscribir-lista-pacientes-action btn btn-element-v2 btn-outline btn-xs " href="' + row.prc_createUrl + '" target="_blank" title="Solicitar estudio a servicio de Imagenología"' + (row.allowPreinscribir === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-edit"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionEvents = {
    'click .mostrar-lista-pacientes-action': function (e, value, row, index) {
	/** current expediente */
	$currentExp = jQuery.extend(true, {}, row);
	/** set in view, modal */
	actionPacienteSetterSimpleObjectBlockData(row.exp_id, row, {});
	___actionPacienteSetterObjectModalData(row.exp_id, row, row, {});
	
        $('div.menu-listas-historial-paciente').each(function(i, elem) {
            jQuery(this).data('refresh-parameter', row.exp_id);
        });
        
//        jQuery('#table-lista-preinscripciones-paciente').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_listarSolicitudesEstudioPaciente', { expediente: row.exp_id }) });
//        jQuery('#table-lista-citas-paciente').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_listarCitasPaciente', { expediente: row.exp_id }) });
//        jQuery('#table-lista-estudios-paciente').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_listarExamenesPaciente', { expediente: row.exp_id }) });
//        jQuery('#table-lista-diagnosticos-paciente').bootstrapTable('refresh', { url: Routing.generate('simagd_imagenologia_digital_listarDiagnosticosPaciente', { expediente: row.exp_id }) });
        
        $("div[id='div-resultado-informacion-paciente']").empty()
                .load(Routing.generate('simagd_imagenologia_digital_listarDatosPaciente', { expediente: row.exp_id }));
	$('li.list-table-link-navbar').first().find("a").trigger("click");
        
        $("div[id='container_resultado_busquedaPaciente']").fadeOut("fast");
        $("div[id='container_menu_historiaImagenologica']").fadeIn("fast");
    }
};

jQuery(document).ready(function() {
    
    $('li.list-table-link-navbar').find("a:not([disabled])").click(function(e) {
        var $target_divContainer_bsTable = jQuery(this).data('divtabletarget');
	var $target = jQuery('#' + $target_divContainer_bsTable);
	console.log(jQuery.trim($target.data('refresh-url')));
	if ($target.attr('id') !== 'div-resultado-informacion-paciente') {
	    $target.find("table").bootstrapTable('refresh', { url:
								    Routing.generate(jQuery.trim($target.data('refresh-url')), {
									expediente:
									    $target.data('refresh-parameter')
								    })
							    });
	}
        $('.menu-listas-historial-paciente').hide();
        $target.show();
        $('li.list-table-link-navbar').removeClass('active');
        jQuery(this).parents("li").addClass("active");
    });
    
});

function reprogramadaFormatter(value, row, index) {
    return [
        '<span class="label label-' + (row.reprogramada === false ? 'primary' : 'warning') + '">',
        (row.reprogramada === false ? 'no' : 'sí'),
        '</span>'
    ].join('');
}

function fechaHoraNacimientoFormatter(value, row, index) {
    return simagdDateTimeFormatter(value + ' ' + row.pct_horaNacimiento, row, index);
}