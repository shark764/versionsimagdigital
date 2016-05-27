/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($) {
 
    $.fn.eachValuesArray = function(options) {
        var valuesArray = new Array();
        
        $( options.selector ).each(function() {    
            var link = jQuery(this);
            valuesArray.push(link.val() ? link.val() : '-1');
        });
 
        return valuesArray;
 
    };
 
}(jQuery));