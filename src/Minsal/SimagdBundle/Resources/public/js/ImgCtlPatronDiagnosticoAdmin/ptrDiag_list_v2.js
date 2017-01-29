/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-patron-diagnostico-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar patrón de diagnóstico detallado"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-patron-diagnostico-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Editar registro de patrón de diagnóstico"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionEvents = {
    'click .show-patron-diagnostico-action': function (e, value, row, index) {
	console.log(row);
	___actionDiagnosticoSetterObjectModalData(row.ptrDiag_id, row, {});
        jQuery('#patronDiagnosticoFullData-showModalContainer').modal();
    },
    'click .edit-patron-diagnostico-action': function (e, value, row, index) {
        jQuery('#btn_agregar_ptrDiag').hide();
        jQuery('#btn_editar_ptrDiag').show();
        
        jQuery('#formPtrDiagTitle').text('Editar patrón para diagnóstico');
        jQuery('#formPtrDiagLabel').removeClass('label-primary-v4')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formPtrDiagId']").val(row.ptrDiag_id);
        
        $("select[id='formPtrDiagIdEmpleado']").select2('val', row.ptrDiag_id_empleado);
        $("select[id='formPtrDiagIdAreaServicioDiagnostico']").select2('val', row.m_id);
        $("select[id='formPtrDiagIdTipoResultado']").select2('val', row.tpR_id);
        
        $("select[id='formPtrDiagIdRadiologoDefine']").select2('val', row.ptrDiag_id_radiologo);
        
        $("input[id='formPtrDiagNombre']").val(jQuery.trim(row.ptrDiag_nombre));
        $("input[id='formPtrDiagCodigo']").val(jQuery.trim(row.ptrDiag_codigo));
	
	/** text-editor Hallazgos */
	$("[id='formPtrDiagHallazgos']").buildSummerNote({ newOptions: {
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand',     // toolbar
            ___speech   : true,         // active speech recognition
        }});
        $("[id='formPtrDiagHallazgos']").summernote('code', row.ptrDiag_hallazgos);
	/** text-editor Conclusion */
	$("[id='formPtrDiagConclusion']").buildSummerNote({ newOptions: {
	    height: 75,                 // set editor height
	    maxHeight: 100,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand',     // toolbar
            ___speech   : true,         // active speech recognition
	}});
        $("[id='formPtrDiagConclusion']").summernote('code', row.ptrDiag_conclusion);
	/** text-editor Recomendaciones */
	$("[id='formPtrDiagRecomendaciones']").buildSummerNote({ newOptions: {
	    height: 90,                 // set editor height
	    maxHeight: 125,             // set maximum height of editor
            focus: false,               // set focus to editable area after initializing summernote
            ___toolbar  : 'expand',     // toolbar
            ___speech   : true,         // active speech recognition
	}});
        $("[id='formPtrDiagRecomendaciones']").summernote('code', row.ptrDiag_recomendaciones);
	/** -- summernote */
	
        $("textarea[id='formPtrDiagIndicacionesGenerales']").val(jQuery.trim(row.ptrDiag_indicacionesGenerales));
        $("textarea[id='formPtrDiagObservaciones']").val(jQuery.trim(row.ptrDiag_observaciones));
        
        jQuery('#crearPatronDiagnostico-modal').modal();
        
        /* Set the form no validated */
	jQuery('#crearPatronDiagnosticoForm').data('formValidation').resetForm();
	
	jQuery('#crearPatronDiagnosticoForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearPatronDiagnostico-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};
    
jQuery(document).ready(function() {
    
});