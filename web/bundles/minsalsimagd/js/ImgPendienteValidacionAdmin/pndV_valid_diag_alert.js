/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"
    
/** Hide and show alerts */
var $valid_bsAlert = null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $valid_bsAlert 	= jQuery('#simagd-valid-response-bs-alert');
    
    /** Clone alerts */
    $valid_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$valid_bsAlert = $valid_cloned.clone(true, true);
	$valid_bsAlert.insertAfter(jQuery(this));
	console.log('clone valid alert');
    });
    var $valid_cloned	= $valid_bsAlert.clone(true, true);
    
});