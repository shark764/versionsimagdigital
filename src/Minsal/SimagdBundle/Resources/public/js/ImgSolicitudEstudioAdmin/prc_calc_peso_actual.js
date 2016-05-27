/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()  {
    /** DOM fields */
    var $pesoKgField 	= $("input[id='" + $token + "_pesoActualKg']");
    var $pesoLbField 	= $("input[id='" + $token + "_pesoActualLb']");
    var $tallaPctField 	= $("input[id='" + $token + "_tallaPaciente']");
    
    //Formato con punto decimal
    if ($pesoLbField.length)
    {
	$pesoLbField.val($pesoLbField.val().replace(/\,/g, '.'));
    }
    if ($pesoKgField.length)
    {
	$pesoKgField.val($pesoKgField.val().replace(/\,/g, '.'));
    }
    if ($tallaPctField.length)
    {
	$tallaPctField.val($tallaPctField.val().replace(/\,/g, '.'));
    }
    
    //Transformar libras a kilogramos
    $pesoLbField.keyup(function() {
//         jQuery(this).val(jQuery(this).getValidDecimal());
        
        var pesoLb = parseFloat(jQuery(this).val());
        var pesoKg = pesoLb / 2.20462262;
        (!isNaN(pesoKg)) ? $pesoKgField.val(pesoKg.toFixed(2)) : $pesoKgField.val('');
    });
    //Transformar kilogramos a libras
    $pesoKgField.keyup(function() {
//         jQuery(this).val(jQuery(this).getValidDecimal());
        
        var pesoKg = parseFloat(jQuery(this).val());
        var pesoLb = pesoKg * 2.20462262;
        (!isNaN(pesoLb)) ? $pesoLbField.val(pesoLb.toFixed(2)) : $pesoLbField.val('');
    });
    
    //Validar la talla
    $tallaPctField.keyup(function() {
//         jQuery(this).val(jQuery(this).getValidDecimal());
    });
    
});

