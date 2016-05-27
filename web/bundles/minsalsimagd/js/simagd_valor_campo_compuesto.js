/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    function getValorCampoCompuesto(param_filterA, param_filterB, inputDatos, ruta, selector) {
        if (param_filterA && param_filterB) {
            $.ajax({
		type: 'post',
		dataType: 'json',
		url: Routing.generate(ruta),
                data: {
                    param_filterA : param_filterA,
                    param_filterB : param_filterB,
                    selector : selector
                },
                beforeSend: function() {
				$(inputDatos).val('');
                },
                success: function(data) {
			    $(inputDatos).val(data.id);
			    console.log(data.id);
                },
                error: function (data) {
			  console.log(data.error);
			  console.log(data.responseText);
                }
            });
        }
        else  {
            $(inputDatos).val('');
        }
        return false;
    }