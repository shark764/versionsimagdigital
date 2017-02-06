/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function() {
    
    /** table class */
    $('table').removeClass("table-bordered table-striped").addClass("table-hover table-condensed table-responsive");
    $('table').find('thead').find('th').css({
                                                'border-top': '0px solid',
                                                'background': '#FFFEFD',
                                                'border-top-color': '#f56954'
                                            });
        
    /** set select2 */
//    $(document).find('select').each(function () {
//        jQuery(this).select2({
//            placeholder: 'click para seleccionar...',
//            allowClear: true,
//            dropdownAutoWidth : true
//        });
//    });
    
    /** delete empty li */
    $("ul.list-inline").find('li').each(function() {
	if (jQuery(this).html().trim() == "" || typeof(jQuery(this).html().trim()) == "undefined")
	{
	    jQuery(this).remove();
	}
    });
});