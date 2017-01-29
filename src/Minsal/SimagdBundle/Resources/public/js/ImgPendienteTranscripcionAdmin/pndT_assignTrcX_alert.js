/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"
    
/** Hide and show alerts */
var $trcXRecord_bsAlert = null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $trcXRecord_bsAlert = jQuery('#simagd-assign-trcx-response-bs-alert');
    
    /** Clone alerts */
    $trcXRecord_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$trcXRecord_bsAlert = $trcXRecord_cloned.clone(true, true);
	$trcXRecord_bsAlert.insertAfter(jQuery(this));
	console.log('clone trcXRecord alert');
    });
    var $trcXRecord_cloned  = $trcXRecord_bsAlert.clone(true, true);
    
});