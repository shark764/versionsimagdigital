/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function() {
    /*
     * APLICACION DE PLUGIN Y ESTILOS A ELEMENTOS DENTRO
     * DE VISTAS PROPIAS DE SONATA, NO TRANSFORMADAS AL
     * ESTANDAR DE SIMAGD
     */
    
    /** set icheck */
    $('input:checkbox, input:radio').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue',
    });
        
    /** set select2 */
    $(document).find('select').each(function () {
        jQuery(this).select2({
            placeholder: '',
            allowClear: true,
            dropdownAutoWidth : true
        });
    });
    
    /** set icheck label right */
/*    $('input:checkbox').each(function(i) {
        var labelForCheck = $("label[for='" + jQuery(this).attr('id') + "']");
        var labelForCheckText = jQuery.trim(labelForCheck.text());

        if (labelForCheck.length) {
            
            jQuery(this).closest("div")
                .after("<label class='control-label simagd-checkbox-label'>" + labelForCheckText + "</label>");

            labelForCheck.text('');
            
        }
    });
*/    
    
    /** BOX BOX PRIMARY-V2 head title custom style */
/*    $("div.box").not('.non-titled-sonata-box').each(function(i) {
	var $___boxTitle = jQuery(this)
				.find('.box-header')
				.find('.box-title')
					.html().trim();
	jQuery(this)
	    .find('.box-header')
	    .find('.box-title')
		    .html("<span class='label label-primary-v2'>" + $___boxTitle + "</span>");
    });
*/    
});
