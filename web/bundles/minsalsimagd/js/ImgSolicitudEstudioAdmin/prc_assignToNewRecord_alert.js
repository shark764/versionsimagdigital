/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"
    
/** Hide and show alerts */
var $newRecord_bsAlert = null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $newRecord_bsAlert = jQuery('#simagd-assign-newrecord-unknownreg-response-bs-alert');
    
    /** Clone alerts */
    $newRecord_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$newRecord_bsAlert = $newRecord_cloned.clone(true, true);
	$newRecord_bsAlert.insertAfter(jQuery(this));
	console.log('clone newRecord alert');
    });
    var $newRecord_cloned  = $newRecord_bsAlert.clone(true, true);
    
});