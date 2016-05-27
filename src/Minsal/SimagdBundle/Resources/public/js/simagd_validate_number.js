/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Retorna un valor decimal válido

jQuery.fn.getValidDecimal = function() {
    var val = jQuery.trim(jQuery(this).val());
    val = val.replace(/[^0-9\.]+/g, '');

    if (val.length == 0 || val.indexOf('.') == 0) return '';

    var i = 0;
    val = val.replace(/\./g, function () {
                                return (++i != 1) ? '' : '.';
                            });
    if (val.indexOf('.') != -1 && (val.length - val.indexOf('.')) >= 4) val = parseFloat(val).toFixed(2);

    return val;
};

jQuery.fn.getValidInteger = function() {
    var val = jQuery.trim(jQuery(this).val());
    val = val.replace(/[^0-9]+/g, '');

    if (val.length == 0) return '';

    return val;
};