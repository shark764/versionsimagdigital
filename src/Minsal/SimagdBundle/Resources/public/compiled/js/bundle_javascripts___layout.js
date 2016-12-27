/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function() {
    //Remover espacios en blanco extras
    $("input[type='text'], textarea").each(function() {
        jQuery(this).val(jQuery.trim(jQuery(this).val()));
    });
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function() {
    //Desactivar la validación html5
    jQuery('form').each(function() {
        jQuery(this).attr('novalidate', 'novalidate');
    });
});
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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    function generarMensajeToast (toastType, toastMessage, strongTitle) {

        var messagesToastType = [ "success", "notice", "warning", "error" ];
        
        if ($.inArray(toastType, messagesToastType) === -1) { toastType = 'notice'; }
        
        $().toastmessage('showToast', {
            text     : '<strong>' + strongTitle + '</strong> <br/>' + jQuery.trim( toastMessage ),
            sticky   : false,
            position : 'middle-center',
            inEffectDuration:  600,
            stayTime : 3000,
            type     : toastType
        });

        return false;

    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()
{    
    (function($) {
        $.fn.writeError = function(message) {
            return this.each(function() {
                var $this = jQuery(this);
                var errorDIV = $('<div>').removeClass().addClass('ui-widget').append(
                    $('<div>').addClass('ui-state-error ui-corner-all').css(
                                {'padding':'0.7em', 'font':'68.5% "Trebuchet MS",sans-serif', 'margin-top':'20px', 'display':'table-cell'}
                    ).append(
                        $('<p>').append(
                            $('<span>').addClass('ui-icon ui-icon-alert').css(
                                        {'float':'left', 'margin-right': '.3em'}
                            )
                        ).append(message)
                    )
               );
                $this.html(errorDIV);
            });
        };
    })(jQuery);

    (function($) {
        $.fn.writeAlert = function(message) {
            return this.each(function() {
                var $this = jQuery(this);
                var alertDIV = $('<div>').removeClass().addClass('ui-widget').append(
                    $('<div>').addClass('ui-state-highlight ui-corner-all').css(
                                {'padding':'0.7em', 'font':'68.5% "Trebuchet MS",sans-serif', 'margin-top':'20px', 'display':'table-cell'}
                    ).append(
                        $('<p>').append(
                            $('<span>').addClass('ui-icon ui-icon-info').css(
                                        {'float':'left', 'margin-right': '.3em'}
                            )
                        ).append(message)
                    )
               );
                $this.html(alertDIV); 
            }); 
        };
    })(jQuery);
    
});