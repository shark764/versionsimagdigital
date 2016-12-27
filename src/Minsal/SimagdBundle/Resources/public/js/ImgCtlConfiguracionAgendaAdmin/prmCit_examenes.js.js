/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Function encargada de hacer el request al action, y llenar el select con los exámenes regresados, usando json_encode
//En routing.yml esta la declaracion del bundle FOSjsRouting.
$(document).ready(function()
{
    $("select[id='" + $token + "_idAreaServicioDiagnostico']").change(function() {
        var idAreaServicioDiagnostico = jQuery(this).val();
        var idAtencion = '97';
        var selectorDatos = "select[id='" + $token + "_idExamenServicioDiagnostico']";
        var ruta = 'simagd_solicitud_estudio_cargarDatosPorFiltro';
        var selector = 'exm';
        loadDatosByFiltro(idAreaServicioDiagnostico, idAtencion, selectorDatos, ruta, selector);
        $(selectorDatos).trigger("change");
    });
    
    $("select[id='" + $token + "_idExamenServicioDiagnostico']").change(function() {
        var idAreaServicioDiagnostico = $("select[id='" + $token + "_idAreaServicioDiagnostico']").val();
        var idExamenServicioDiagnostico = jQuery(this).val();
        
        /** obtener MntAreaExamenEstab */
        var inputDatos = "input[id='" + $token + "_idAreaExamenEstab']";
        var ruta = 'simagd_solicitud_estudio_valorCampoCompuesto';
        var selector = 'mr';
        getValorCampoCompuesto(idAreaServicioDiagnostico, idExamenServicioDiagnostico, inputDatos, ruta, selector);
    });
    
});