/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"
    
/** Hide and show alerts */
var $radXRecord_bsAlert = null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $radXRecord_bsAlert = jQuery('#simagd-assign-radx-response-bs-alert');
    
    /** Clone alerts */
    $radXRecord_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$radXRecord_bsAlert = $radXRecord_cloned.clone(true, true);
	$radXRecord_bsAlert.insertAfter(jQuery(this));
	console.log('clone radXRecord alert');
    });
    var $radXRecord_cloned  = $radXRecord_bsAlert.clone(true, true);
    
});