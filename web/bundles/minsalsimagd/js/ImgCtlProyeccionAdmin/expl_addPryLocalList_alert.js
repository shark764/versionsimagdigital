/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"
    
/** Hide and show alerts */
var $pryListLocalXRecord_bsAlert = null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $pryListLocalXRecord_bsAlert = jQuery('#simagd-add-pry-locallist-response-bs-alert');
    
    /** Clone alerts */
    $pryListLocalXRecord_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$pryListLocalXRecord_bsAlert = $pryListLocalXRecord_cloned.clone(true, true);
	$pryListLocalXRecord_bsAlert.insertAfter(jQuery(this));
	console.log('clone pryListLocalXRecord alert');
    });
    var $pryListLocalXRecord_cloned  = $pryListLocalXRecord_bsAlert.clone(true, true);
    
});