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