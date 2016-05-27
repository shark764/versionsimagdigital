/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"
    
/** Hide and show alerts */
var $queued_bsAlert = null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $queued_bsAlert 	= jQuery('#simagd-queued-response-bs-alert');
    
    /** Clone alerts */
    $queued_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$queued_bsAlert = $queued_cloned.clone(true, true);
	$queued_bsAlert.insertAfter(jQuery(this));
	console.log('clone queued alert');
    });
    var $queued_cloned	= $queued_bsAlert.clone(true, true);
    
});