/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Validar valores de maximoCitasDia y maximoCitasHora

$(document).ready(function()  {
    var maximoCitasDia = "input[id='" + $token + "_maximoCitasDia']";
    var maximoCitasTurno = "input[id='" + $token + "_maximoCitasTurno']";
    var maximoCitasHora = "input[id='" + $token + "_maximoCitasHora']";
    var maximoCitasMedico = "input[id='" + $token + "_maximoCitasMedico']";
    
    //maximoCitasDia debe ser entero
    $(maximoCitasDia).bind('keyup mouseup', function () {
        jQuery(this).val(jQuery(this).getValidInteger());
    });
    //maximoCitasTurno debe ser entero
    $(maximoCitasTurno).bind('keyup mouseup', function () {
        jQuery(this).val(jQuery(this).getValidInteger());
    });
    //maximoCitasHora debe ser entero
    $(maximoCitasHora).bind('keyup mouseup', function () {
        jQuery(this).val(jQuery(this).getValidInteger());
    });
    //maximoCitasMedico debe ser entero
    $(maximoCitasMedico).bind('keyup mouseup', function () {
        jQuery(this).val(jQuery(this).getValidInteger());
    });
    
});