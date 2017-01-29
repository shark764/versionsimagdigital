/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"
    
/** Hide and show alerts */
var $radXValidationRecord_bsAlert = null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $radXValidationRecord_bsAlert = jQuery('#simagd-assign-radx-validation-response-bs-alert');
    
    /** Clone alerts */
    $radXValidationRecord_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$radXValidationRecord_bsAlert = $radXValidationRecord_cloned.clone(true, true);
	$radXValidationRecord_bsAlert.insertAfter(jQuery(this));
	console.log('clone radXValidationRecord alert');
    });
    var $radXValidationRecord_cloned  = $radXValidationRecord_bsAlert.clone(true, true);
    
});