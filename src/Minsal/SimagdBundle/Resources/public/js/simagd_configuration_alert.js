/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"

/** Show after transaction is complete */
jQuery.fn.addFadeSlideEffect = function() {
    jQuery(this).alert()
	.fadeTo(3000, 500)
	.slideUp("slow");
};
    
/** Hide and show alerts */
var $success_bsAlert 	= null,
    $edited_bsAlert 	= null,
    $error_bsAlert 	= null,
    $warning_bsAlert 	= null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $success_bsAlert 	= jQuery('#simagd-added-response-bs-alert');
    $edited_bsAlert 	= jQuery('#simagd-edited-response-bs-alert');
    $error_bsAlert 	= jQuery('#simagd-error-response-bs-alert');
    $warning_bsAlert 	= jQuery('#simagd-warning-response-bs-alert');
    
    /** Clone alerts */
    $success_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$success_bsAlert = $success_cloned.clone(true, true);
	$success_bsAlert.insertAfter(jQuery(this));
	console.log('clone success alert');
    });
    $edited_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$edited_bsAlert = $edited_cloned.clone(true, true);
	$edited_bsAlert.insertAfter(jQuery(this));
	console.log('clone edited alert');
    });
    $error_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$error_bsAlert = $error_cloned.clone(true, true);
	$error_bsAlert.insertAfter(jQuery(this));
	console.log('clone error alert');
    });
    $warning_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$warning_bsAlert = $warning_cloned.clone(true, true);
	$warning_bsAlert.insertAfter(jQuery(this));
	console.log('clone warning alert');
    });
    var $success_cloned	= $success_bsAlert.clone(true, true),
	$edited_cloned 	= $edited_bsAlert.clone(true, true),
	$error_cloned 	= $error_bsAlert.clone(true, true),
	$warning_cloned	= $warning_bsAlert.clone(true, true);
    
});