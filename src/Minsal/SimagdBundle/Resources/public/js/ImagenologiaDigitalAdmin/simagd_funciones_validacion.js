/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {

    jQuery.fn.isValidDUI = function() {
        var correct = false;

        var posicion = 0, vnValor = 9, vnSuma = 0, vnResta = 0, vnDiv = 1;

        var val = jQuery.trim(jQuery(this).val());
        val = val.replace(/-/g, '');

        if (val.length === 9)
        {
            do {
                vnSuma += parseInt(val.substr(posicion, 1)) * vnValor;
                --vnValor;
            } while ( ++posicion < 8 )

            vnDiv = vnSuma % 10;
            vnResta = 10 - vnDiv;

            if (vnResta === 10) { vnResta = 0; }

            if (vnResta === parseInt(val.substr(8, 1))) {
                correct = true;
            }
        }

        return correct;
    };

    jQuery.fn.checkIfEmptyForm = function() {
        var isFormEmpty = true;
        var formVal = jQuery(this);
        
        formVal.find(':input').each(function () {
            if (jQuery.trim(jQuery(this).val())) { isFormEmpty = false; }
        });

        return isFormEmpty;
    };

});