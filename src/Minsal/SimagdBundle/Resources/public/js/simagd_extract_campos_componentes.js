/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    function extractCamposComponentes(idCampoCompuesto, ruta, selector) {
        var camposComponentesArray = new Array();
        
        if (idCampoCompuesto) {
            $.ajax({
		type: 'post',
		dataType: 'json',
		url: Routing.generate(ruta),
                data: {
                    idCampoCompuesto : idCampoCompuesto,
                    selector : selector
                },
                success: function(data) {
                    camposComponentesArray.push(data.campoA, data.campoB);
                    console.log(data.campoA);
                    console.log(data.campoB);
                },
                error: function (data) {
                    console.log(data.error);
                    console.log(data.responseText);
                }
            });
        }
        
        return camposComponentesArray;
    }