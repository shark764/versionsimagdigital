/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function() {
    //Remover espacios en blanco extras
    $("input[type='text'], textarea").each(function() {
        jQuery(this).val(jQuery.trim(jQuery(this).val()));
    });
});