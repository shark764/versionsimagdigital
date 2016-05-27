/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function actionFormatter(value, row, index) {
    return [
	'<div class="btn-toolbar" role="toolbar" aria-label="...">',
	    '<div class="btn-group" role="group">',
		'<a class="show-material-action btn btn-primary-v2 btn-xs" href="javascript:void(0)" title="Mostrar material detallado"' + (row.allowShow === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-info-sign"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a class="edit-material-action btn btn-primary-v2 btn-xs " href="javascript:void(0)" title="Editar registro de material"' + (row.allowEdit === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-repeat"></i>',
		'</a>',
	    '</div>',
	    '<div class="btn-group" role="group">',
		'<a class="catalogo-material-action btn btn-success-v2 btn-xs " href="javascript:void(0)" title="Agregar material en Catálogo local"' + (row.allowAgregarLc === false ? ' disabled="disabled"' : '') + '>',
		    '<i class="glyphicon glyphicon-plus-sign"></i>',
		'</a>',
	    '</div>',
	'</div>'
    ].join('');
}

window.actionEvents = {
    'click .show-material-action': function (e, value, row, index) {
	console.log(row);
	actionMaterialSetterObjectModalData(row.mtrl_id, row, {});
//         jQuery('#materialFullData-showModalContainer').modal();
    },
    'click .edit-material-action': function (e, value, row, index) {
        jQuery('#btn_agregar_mtrl').hide();
        jQuery('#btn_editar_mtrl').show();
        
        jQuery('#formMtrlTitle').text('Editar Material');
        jQuery('#formMtrlLabel').removeClass('label-primary-v2')
		.addClass('label-element-v2').text('Formulario para edición');
        
        $("input[id='formMtrlId']").val(row.mtrl_id);
        
        $("input[id='formMtrlNombre']").val(jQuery.trim(row.mtrl_nombre));
        $("input[id='formMtrlCodigo']").val(jQuery.trim(row.mtrl_codigo));
        $("textarea[id='formMtrlDescripcion']").val(jQuery.trim(row.mtrl_descripcion));
	
        $("input[id='formMtrlAgregarEnLocal']").iCheck('enable').iCheck('uncheck');
	$("input:checkbox[id='formMtrlAgregarEnLocal']").trigger('ifChanged');
        $("input[id='formMtrlAgregarEnLocal']").iCheck('uncheck').iCheck('disable');
        
	/** *****************************************
        $("input[id='habilitado']").iCheck('uncheck');
        ****************************************** */
	
        jQuery('#crearMaterial-modal').modal();
        
        /* Set the form no validated */
	jQuery('#crearMaterialForm').data('formValidation').resetForm();
	
	jQuery('#crearMaterialForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#crearMaterial-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    },
    'click .catalogo-material-action': function (e, value, row, index) {
        
        $("input[id='formMtrlMtrLcIdMaterial']").val(row.mtrl_id);
        
        jQuery('#formMtrlMtrLcNombre-static-label').text(row.mtrl_nombre);
        jQuery('#formMtrlMtrLcCodigo-static-label').text(row.mtrl_codigo);
        jQuery('#formMtrlMtrLcDescripcion-static-label').html('<pre class="pre-display-code-natural">' + jQuery.trim(row.mtrl_descripcion) + '</pre>');
	
	var $cantidadDisponible = $("input[id='formMtrlMtrLcCantidadDisponible']");
        $cantidadDisponible.val($cantidadDisponible.data('default'));
        
        $("input[id='formMtrlMtrLcHabilitado']").iCheck('uncheck');
	
        $("textarea[id='formMtrlMtrLcDescripcion']").val('');
        
	/** *****************************************
        $("input[id='habilitado']").iCheck('uncheck');
        ****************************************** */
        
        jQuery('#agregar-en-catalogo-modal').modal();
        
        /* Set the form no validated */
	jQuery('#agregarEnLocalForm').data('formValidation').resetForm();
	
	jQuery('#agregarEnLocalForm').find('a[data-toggle="pill"]').parent().find('i').removeClass('fa-check fa-times');
	
	jQuery('#agregar-en-catalogo-modal')
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    }
};

function getMaterialHabilitadoSourceData(field) {
    return [
	{value: 1, text: 'Habilitado'},
    ];
}
    
jQuery(document).ready(function() {
    
});