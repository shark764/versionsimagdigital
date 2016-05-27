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