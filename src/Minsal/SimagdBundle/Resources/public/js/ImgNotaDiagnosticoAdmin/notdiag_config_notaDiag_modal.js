/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



jQuery(document).ready(function() {
    
    $(document).on("click", ".open-notaDiagDialog", function () {
        
        var notaDiagId = jQuery(this).data('id');
        
        $("div[class='div-nota-completa-info'][data-id=" + notaDiagId + "]").show().siblings("div").hide();
        
        return false;
        
    });

});