/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function() {
    var dateOptions = {
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 3,
        buttonText: "Seleccione",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        defaultDate: +8,
        minDate: 0,
        closeText: 'Limpiar',
        onClose: function () {
                        if ($(window.event.srcElement).hasClass('ui-datepicker-close')) {
                            jQuery(this).val('');
                        }
                        jQuery(this).change();
        },
        currentText: 'Hoy',
        nextText: 'Siguiente',
        prevText: 'Anterior',
        monthNames: [   "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                    ],
        monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
        dayNames: [ "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ],
        dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá" ],
        dayNamesShort: [ "Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb" ],
        showTimepicker: false
    };
    
    var dateTimeOptions = {
        showTimepicker: true,
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        pickerTimeFormat: 'hh:mm tt',
//        timeFormat: 'hh:mm tt',
        ampm: true,
        amPmText: ['AM', 'PM'],
        pmNames: ['PM', 'P'],
        amNames: ['AM', 'A'],
        timeText: 'Horario',
        hourText: 'Hora',
        minuteText: 'Minuto',
        stepHour: 1,
        stepMinute: 1
    };
    
    (function ($) {
 
        $.fn.createSimagdDateTimePicker = function(options) {

            if (jQuery.inArray(options.inputType, ['date', 'datetime']) === -1) { return; }
            
            jQuery(this).datetimepicker(options.inputType == 'date' ?
                                                            dateOptions : $.extend(dateOptions, dateTimeOptions
                                                ));

        };

    }(jQuery));
    
});