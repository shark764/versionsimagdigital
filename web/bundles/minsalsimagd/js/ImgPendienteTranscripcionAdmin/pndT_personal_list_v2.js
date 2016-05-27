/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function pendienteTranscripcion_personal_actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a class="transcribir-personal-pendiente-transcribir-action btn btn-primary-v2 btn-xs" href="javascript:void(0)" title="Transcribir lectura radiológica"' + (row.allowTranscribir === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-edit"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.pendienteTranscripcion_personal_actionEvents = {
    'click .transcribir-personal-pendiente-transcribir-action': function (e, value, row, index) {
        jQuery('#btn_agregar_diag').hide();
        jQuery('#btn_editar_diag').show();
        
        jQuery('#formDiagTitle').text('Concluir transcripción de diagnóstico');
        jQuery('#formDiagLabel').removeClass('label-primary-v2 label-warning')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formDiagId']").val(row.diag_id);
        
        $("select[id='formDiagIdEmpleado']").select2('val', row.diag_id_transcriptor);
        $("select[id='formDiagIdEstado']").select2('val', row.diag_id_estado);
	
	/** Patrón definido en lectura */
        $("select[id='formDiagIdPatronAplicado']").select2('val', row.ptrApl_id);
	
	/** text-editor Hallazgos */
	$("[id='formDiagHallazgos']").buildSummerNote({ newOptions: {
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
        }});
        $("[id='formDiagHallazgos']").code(row.diag_hallazgos);
	/** text-editor Conclusion */
	$("[id='formDiagConclusion']").buildSummerNote({ newOptions: {
	    height: 75,                 // set editor height
	    maxHeight: 100,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
        $("[id='formDiagConclusion']").code(row.diag_conclusion);
	/** text-editor Recomendaciones */
	$("[id='formDiagRecomendaciones']").buildSummerNote({ newOptions: {
	    height: 90,                 // set editor height
	    maxHeight: 125,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand', // toolbar
            ___speech   : true,     // active speech recognition
	}});
        $("[id='formDiagRecomendaciones']").code(row.diag_recomendaciones);
	/** -- summernote */
	
        $("textarea[id='formDiagIncidencias']").val(jQuery.trim(row.diag_incidencias));
        $("textarea[id='formDiagObservaciones']").val(jQuery.trim(row.diag_observaciones));
        $("textarea[id='formDiagErrores']").val(jQuery.trim(row.diag_errores));
        
        jQuery('#transcribirDiagnostico-modal').modal();
	
	/* Set the form no validated */
	jQuery('#transcribirDiagnosticoForm').data('formValidation').resetForm();
	
	jQuery('#transcribirDiagnosticoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#transcribirDiagnostico-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};

jQuery(document).ready(function() {
    
});