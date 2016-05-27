/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {

    /*
     * ******************************************************************
     * arrayIntersect
     * ******************************************************************
     */
    $.fn.get_arrayIntersect = function(options)
    {
        var arr_a   = options.a,
            arr_b   = options.b;

        return jQuery.grep(arr_a, function(i)
        {
            return jQuery.inArray(i, arr_b) > -1;
        });
    };

    /*
     * crear ventana pop-up
     */
    function generarVentanaPopup(options)
    {
        var $width  = 1000;
        var $height = 700;
        var $default_options = {
            width: $width,
            height: $height,
            left: (screen.width/2)-($width/2),
            top: (screen.height/2)-($height/2),
            href: 'javascript:void(0)'
        };
        jQuery.extend(true, $default_options, options);

        window.open($default_options.href, '_blank', "height = " + $default_options.height +
            ", width = " + $default_options.width +
            ", toolbar=0, menubar=0, location=0, status=1, scrollbars=0, resizable=0, top = " + $default_options.top +
            ", left = " + $default_options.left
        );
        return false;
    }

}(jQuery));