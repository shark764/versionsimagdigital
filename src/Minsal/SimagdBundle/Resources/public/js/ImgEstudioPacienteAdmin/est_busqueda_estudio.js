/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {
    
//     alert('alert.info debajo de todos los options more or minus, instead of toast')

    /** --| local variable DOM objects */
    /*
     * 
     * @type @call;$
     */
    var $search_container       = $('div[id="container_resultado_busquedaEstudio"]');
    
    /*
     * 
     * @type @call;$
     */
    var $av_container_form      = $('div[id="container_form_busquedaEstudio"]');
    
    /*
     * 
     * @type @call;$
     */
    var $search_advance_form    = $("form[id='formBusquedaEstudio']");
        
    /*
     * get table of active container
     * @type @call;$@call;find@call;data
     */
    var $target_bstable         = $('table[id="table-resultado-busqueda"]');
    

    $("#limitarResultados").select2({
        maximumSelectionSize: 1
    });
    
    $("#fechaNacimiento").datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.change", function (e) {
        jQuery(this).blur();
    }).on('dp.change dp.show', function(e) {
        $search_advance_form.formValidation('revalidateField', 'fechaNacimiento');
    }).prev().click(function(e) {
        e.preventDefault();
        jQuery(this).next().data("DateTimePicker").show();
        console.log(jQuery(this).next().attr('name') + ' displayed');
    });

    jQuery('#fechaDesde, #fechaHasta').datetimepicker({
	locale: 'es',
	format: 'YYYY-MM-DD hh:mm A',
	showTodayButton: true,
	showClear: true,
        showClose: true,
        ignoreReadonly: true
    }).on("dp.hide", function (e) {
        jQuery(this).blur();
    }).on('dp.change dp.hide dp.show', function(e) {
        $search_advance_form.formValidation('revalidateField', jQuery(this).attr('name'));
    }).prev().click(function(e) {
        e.preventDefault();
        jQuery(this).next().data("DateTimePicker").show();
        console.log(jQuery(this).next().attr('name') + ' displayed');
    });
        
    $("button[id='limpiar-form']").click(function() {
        $search_advance_form.data('formValidation').resetForm();
        $search_advance_form.get(0).reset();
        $("select[id='limitarResultados']").select2('val', '');
    });
    
    $("button[id='limpiar-resultados']").click(function() {
        $search_container.fadeOut("fast");
    });
    
    $search_advance_form.formValidation({
            excluded: [':disabled'],
	    locale: 'es_ES'
        })
        // Called when a field is valid
        .on('success.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.element --> The field element
            // The success.field.fv is triggered when a field is valid
            // data.field ---> the field name
            // data.fv    ---> the plugin instance which you can call some APIs on

            if (data.field === 'fechaDesde' && !data.fv.isValidField('fechaHasta')) {
                // We need to revalidate the end date
                data.fv.revalidateField('fechaHasta');
            }

            if (data.field === 'fechaHasta' && !data.fv.isValidField('fechaDesde')) {
                // We need to revalidate the start date
                data.fv.revalidateField('fechaDesde');
            }
        
            /*console.log('success.field.fv');*/
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Some instances you can use are
            var $form = $(e.target),        // The form instance
                fv    = $(e.target).data('formValidation'); // FormValidation instance
                
	    var $formParam_object = {};
            $.each($form.find(':input[data-filter-bstable-apply="true"]'), function (i, field) {
                var $this   = jQuery(this);
                $formParam_object[$this.attr('name')]   = {
                                type    : $this.data('filter-bstable-type'),
                                target  : $this.data('filter-bstable-by'),
                                value   : jQuery.isEmptyObject(jQuery.trim($this.val())) === false ? jQuery.trim($this.val()) : null
                            }; // get filter value
            });
	
	    /*
	     * submit form in add_extraParametersFilter
	     */
	    if (!$form.checkIfEmptyForm()) {
		$search_container.fadeIn("fast");
		
		/** Refresh table with new empty parameter */
		$target_bstable.filter(':visible').add_extraParametersFilter({
		    xparam : 
			jQuery.extend(true, {
			    explocal_numero: {
				type    : 'text',
				target  : 'explocal_numero',
				value   : null
			    }
			}, $formParam_object)
		});
		
		generarMensajeToast('notice', 'Espere mientras se cargan los resultados.', 'Su búsqueda ha finalizado:');
	    } else {
		generarMensajeToast('error', 'Formulario vacío.', 'Error en la búsqueda:');
	    }
	    
	    console.log('$formParam_object', jQuery.extend(true, { explocal_numero: { type: 'text', target: 'explocal_numero', value : null } }, $formParam_object));
        })
        /*
         * apply mask
         */
        .find('[id="dui"]').mask('99999999-9', {placeholder: "________-_"});
    
});

function checkValidDUI(value, validator, $field) {
    /** begin callback function */
    if (value === '') { return true; }
                                    
    return $field.isValidDUI() ? true : false;
}
