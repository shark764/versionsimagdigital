/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    function loadDatosByFiltro(param_filterA, param_filterB, selectorDatos, ruta, selector) {
        var valAnterior = $(selectorDatos).val();
        console.log('selectorDatos: ' + selectorDatos);
        console.log('selector: ' + selector);
        console.log('filtros: ' + param_filterA + ', ' + param_filterB);
        
        if (param_filterA && param_filterB) {
            $.ajax({
		type: 'POST',
		dataType: 'json',
		url: Routing.generate(ruta),
                data: {
                    param_filterA : param_filterA,
                    param_filterB : param_filterB,
                    selector : selector
                },
                beforeSend: function() {
                    $(selectorDatos).select2('val', '');
                    $(selectorDatos).attr('disabled', true);
                    $(selectorDatos).find('option:gt(0)').prop('disabled', true);
                },
                success: function(data) {
                    $.each(data.resultados, function(i) {
                        $(selectorDatos).append($("<option></option>").attr("value", this.value).text(this.text));
                    });
                    $(selectorDatos).attr('disabled', false);
                    if (valAnterior) $(selectorDatos).select2('val', valAnterior);
                    console.log('anterior para ' + selectorDatos + ': ' + valAnterior);
                },
                error: function (data) {
                    console.log(data.error);
                    console.log(data.responseText);
                }
            });
        }
        else  {
            $(selectorDatos).select2('val', '');
            $(selectorDatos).find('option:gt(0)').prop('disabled', true);
            console.log('erase all for: ' + selectorDatos);
        }
        return false;
    }