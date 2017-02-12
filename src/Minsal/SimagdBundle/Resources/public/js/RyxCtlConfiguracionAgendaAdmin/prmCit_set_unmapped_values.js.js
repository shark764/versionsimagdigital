/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()
{
    var areaExamenEstab = $("input[id='" + $token + "_idAreaExamenEstab']").val();
    var selectorAreaServicioApoyo = "select[id='" + $token + "_idAreaServicioDiagnostico']";
    var selectorExamenServicioApoyo = "select[id='" + $token + "_idExamenServicioDiagnostico']";
    var ruta = 'simagd_solicitud_estudio_extractCamposComponentes';
    var selector = 'mr';
    
    var areaExamenArray = new Array();
    
    areaExamenArray = extractCamposComponentes(areaExamenEstab, ruta, selector);

    if (areaExamenArray && areaExamenArray.length > 0) {
        if (!$(selectorAreaServicioApoyo).val()) $(selectorAreaServicioApoyo).select2('val', areaExamenArray[0]);
        if (!$(selectorExamenServicioApoyo).val()) $(selectorExamenServicioApoyo).select2('val', areaExamenArray[1]);
    }
    
    $(selectorAreaServicioApoyo).trigger("change");
    
});

        