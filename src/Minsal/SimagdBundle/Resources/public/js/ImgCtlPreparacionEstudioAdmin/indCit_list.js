/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Declare an empty array using literal notation:
var indicacionCitaCacheShowView = [];
var indicacionCitaCacheShowViewObject = [];

function actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a   class="show-indicaciones-cita-action btn btn-primary-v4 btn-outline btn-xs" href="javascript:void(0)" title="Mostrar indicaciones para citar pacientes detalladas"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a   class="edit-indicaciones-cita-action btn btn-primary-v4 btn-outline btn-xs " href="javascript:void(0)" title="Editar registro de indicaciones para citar pacientes"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionEvents = {
    'click .show-indicaciones-cita-action': function (e, value, row, index) {
	console.log(row);
	___actionDiagnosticoSetterObjectModalData(row.indCit_id, row, {});
        jQuery('#indicacionCitaFullData-showModalContainer').modal();
    },
    'click .edit-indicaciones-cita-action': function (e, value, row, index) {
        jQuery('#btn_agregar_indCit').hide();
        jQuery('#btn_editar_indCit').show();

        jQuery('#formIndCitTitle').text('Editar indicaciones para citar pacientes');
        jQuery('#formIndCitLabel').removeClass('label-primary-v4')
		.addClass('label-element-v2').text('Formulario para edición');

        $("input[id='formIndCitId']").val(row.indCit_id);

        $("select[id='formIndCitIdEmpleado']").select2('val', row.indCit_id_empleado);
        $("select[id='formIndCitIdAreaServicioDiagnosticoAplica']").select2('val', row.m_id);
	
	/** text-editor Indicaciones */
	$("[id='formIndCitPreparacionEstudio']").buildSummerNote({ newOptions: {}});
        $("[id='formIndCitPreparacionEstudio']").summernote('code', row.indCit_preparacionEstudio);
	/** text-editor Recomendaciones */
	$("[id='formIndCitRecomendaciones']").buildSummerNote({ newOptions: {
	    height: 90,                 // set editor height
	    maxHeight: 125,             // set maximum height of editor
	}});
        $("[id='formIndCitRecomendaciones']").summernote('code', row.indCit_recomendaciones);
	/** -- summernote */
	
        $("textarea[id='formIndCitObservaciones']").val(jQuery.trim(row.indCit_observaciones));

        jQuery('#crearIndicacionCita-modal').modal();

        /* Set the form no validated */
	jQuery('#crearIndicacionCitaForm').data('formValidation').resetForm();

	jQuery('#crearIndicacionCitaForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');

	jQuery('#crearIndicacionCita-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};

jQuery(document).ready(function() {

    jQuery('#table-lista-indicaciones-cita').on('load-success.bs.table', function (e, data) {
	indicacionCitaCacheShowView.length = 0;
	indicacionCitaCacheShowViewObject.length = 0;
	console.log('indCit refresh');
    });

    $('li.list-table-link-navbar').find("a:not([disabled])").click(function(e) {
        var $target_divContainer_bsTable = jQuery(this).data('divtabletarget');
	var $target = jQuery('#' + $target_divContainer_bsTable);
	console.log(jQuery.trim($target.data('refresh-url')));
        $target.find('table[data-toggle="table"]').bootstrapTable('refresh', { url: jQuery.trim($target.data('refresh-url')) });
        $('.menu-listas-indicaciones-cita').hide();
        $target.show();
        $('li.list-table-link-navbar').removeClass('active');
        jQuery(this).parents("li").addClass("active");
    });

});