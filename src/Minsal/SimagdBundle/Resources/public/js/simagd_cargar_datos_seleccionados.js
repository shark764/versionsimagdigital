/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    function loadDatosSeleccionadosArray(param_filterA, param_filterB, ruta, selector) {
        var dataArray = [];
        if (param_filterA && param_filterB) {
            $.ajax({ type: 'POST', dataType: 'json', async: false, url: Routing.generate(ruta),
                data: { param_filterA : param_filterA, param_filterB : param_filterB, selector : selector },
                success: function(data) {
                                $.each(data, function(i) {
                                                dataArray.push({
                                                                value: this.value, 
                                                                text:  this.text
                                                            });
                                });
                },
            });
        }
        return dataArray;
    }
    
//    http://stackoverflow.com/questions/4825899/how-to-push-both-key-and-value-into-an-array-in-jquery
//        https://groups.google.com/forum/#!topic/sonata-users/CbM2ytzqfK0
//        http://php-jotter.blogspot.com/2013/01/override-display-of-sonatacollectiontyp.html
    
    /** Uso de incrustado en twig */
    //$(document).on('sonata.add_element', "#field_container_{# admin.uniqId #}_solicitudEstudioProyeccion", function() {