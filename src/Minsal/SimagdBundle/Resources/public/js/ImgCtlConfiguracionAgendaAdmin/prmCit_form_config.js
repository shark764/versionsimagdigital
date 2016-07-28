/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(
    function() {

        $("input[id='" + $token + "_maximoCitasDia'], input[id='" + $token + "_maximoCitasTurno'], input[id='" + $token + "_maximoCitasHora'], input[id='" + $token + "_maximoCitasMedico']")
		.wrap("<div class='input-group'></div>");
        $("input[id='" + $token + "_maximoCitasDia']")
                .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-outline btn-large' id='_prmCitBtnAddonMaximoCitasDia'> <i class='glyphicon glyphicon-question-sign'></i> </button> </span>");
        $("input[id='" + $token + "_maximoCitasTurno']")
                .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-outline btn-large' id='_prmCitBtnAddonMaximoCitasTurno'> <i class='glyphicon glyphicon-question-sign'></i> </button> </span>");
        $("input[id='" + $token + "_maximoCitasHora']")
                .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-outline btn-large' id='_prmCitBtnAddonMaximoCitasHora'> <i class='glyphicon glyphicon-question-sign'></i> </button> </span>");
        $("input[id='" + $token + "_maximoCitasMedico']")
                .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-outline btn-large' id='_prmCitBtnAddonMaximoCitasMedico'> <i class='glyphicon glyphicon-question-sign'></i> </button> </span>");
    
    	$(document).on('click', "button[id^='_prmCitBtnAddon']", function(e) {
            e.preventDefault();
    	});
        
    });