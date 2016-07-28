/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(
    function() {

        $("input[id='" + $token + "_nombre'], input[id='" + $token + "_codigo']")
		.wrap("<div class='input-group'></div>");
        $("input[id='" + $token + "_nombre']")
                .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-outline btn-large' id='_mtrBdBtnAddonNombre'> <i class='glyphicon glyphicon-edit'></i> </button> </span>");
        $("input[id='" + $token + "_codigo']")
                .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-outline btn-large' id='_mtrBdBtnAddonCodigo'> <i class='glyphicon glyphicon-edit'></i> </button> </span>");
    
    	$(document).on('click', "button[id^='_mtrBdBtnAddon']", function(e) {
            e.preventDefault();
    	});
        
    });