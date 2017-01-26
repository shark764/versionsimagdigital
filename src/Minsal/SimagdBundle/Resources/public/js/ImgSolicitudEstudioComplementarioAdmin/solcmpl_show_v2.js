/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {
    
    /*
     * initialize popover content
     */
    
    /** popover para muestra de datos de proyecciones */
    $('[data-toggle="popover"]').popover({
	html: true,
	placement: 'top',
	template: [
		      '<div class="popover popover-container-bigger-width" role="tooltip">',
			  '<div class="arrow">',
			  '</div>',
			  '<h3 class="popover-title">',
			  '</h3>',
			  '<div class="popover-content">',
			  '</div>',
		      '</div>'
		  ].join(''),
	content: function() {
		    return $(jQuery(this).data('contentwrapper')).html();
	}
    }).on('shown.bs.popover', function(e) {
	var $popover = jQuery(this);
    })
    .click(function() {
	$('[data-toggle="popover"]')
	    .not(this)
		.popover('hide');
		
	return false;
    });
    
    /*
     * Collapse containers for proyecciones
     */
    var $exm_containerGroup = jQuery('#exm_containerGroup');
    $exm_containerGroup.find('.panel').on('show.bs.collapse', function(e) {
	$exm_containerGroup
	    .find('.collapse.in')
		    .not(this)
		    .collapse('hide');
    });
    
});