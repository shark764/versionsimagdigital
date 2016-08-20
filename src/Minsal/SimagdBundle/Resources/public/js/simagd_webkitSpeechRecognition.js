/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {

    /*
     * ******************************************************************
     * webkitSpeechRecognition
     * ******************************************************************
     */
    $.fn.build_webkitSpeechRecognition      = function(options)
    {
        var info                            = jQuery('#info'),
            btn_start_recognition           = jQuery('#btn_start_recognition'),
            icon_start_recognition          = jQuery('#icon_start_recognition'),
            modal_start_recognition         = jQuery('.bs-start-recognition-modal'),
            final_span                      = jQuery('#final_span'),
            interim_span                    = jQuery('#interim_span');

        var final_transcript                = '',
            recognizing                     = false,
            ignore_onend,
            start_timestamp;

        if (!('webkitSpeechRecognition' in window))
        {
            upgrade();
        }
        else
        {
            btn_start_recognition.css('display', 'inline-block');
            var $rx_recognition             = new webkitSpeechRecognition();
            $rx_recognition.continuous      = true;
            $rx_recognition.interimResults  = true;

            $rx_recognition.onstart         = function() {
                                                recognizing         = true;
                                                showInfo('info_speak_now');
                                                icon_start_recognition.removeClass('fa-microphone fa-microphone-slash').addClass('fa-spinner icon-refresh-animate');
                                                /*
                                                 * open modal for view of results
                                                 */
                                                modal_start_recognition.modal();
                                            };

            $rx_recognition.onerror         = function(e) {
                                                if (e.error == 'no-speech')
                                                {
                                                    icon_start_recognition.removeClass('fa-microphone-slash fa-spinner icon-refresh-animate').addClass('fa-microphone');
                                                    showInfo('info_no_speech');
                                                    ignore_onend    = true;
                                                }
                                                if (e.error == 'audio-capture')
                                                {
                                                    icon_start_recognition.removeClass('fa-microphone-slash fa-spinner icon-refresh-animate').addClass('fa-microphone');
                                                    showInfo('info_no_microphone');
                                                    ignore_onend    = true;
                                                }
                                                if (e.error == 'not-allowed')
                                                {
                                                    if (e.timeStamp - start_timestamp < 100)
                                                    {
                                                        showInfo('info_blocked');
                                                    }
                                                    else
                                                    {
                                                        showInfo('info_denied');
                                                    }
                                                    ignore_onend    = true;
                                                }
                                            };

            $rx_recognition.onend           = function() {
                                                /*
                                                 * hide modal
                                                 */
                                                modal_start_recognition.modal('hide');
                                                
                                                recognizing         = false;
                                                if (ignore_onend)
                                                {
                                                    return;
                                                }
                                                icon_start_recognition.removeClass('fa-microphone-slash fa-spinner icon-refresh-animate').addClass('fa-microphone');
                                                if (!final_transcript)
                                                {
                                                    showInfo('info_start');
                                                    return;
                                                }
                                                showInfo('');
                                                if (window.getSelection)
                                                {
                                                    window.getSelection().removeAllRanges();
                                                    var range       = document.createRange();
                                                    range.selectNode(document.getElementById('final_span'));
                                                    window.getSelection().addRange(range);

                                                    /*
                                                     * add transcript to summernote
                                                     */
                                                    var $target     = get_recognitionTargetCode()
                                                    jQuery($target).set_recognitionResultCode();
                                                    /*
                                                     * 
                                                     */
                                                }
                                            };

            $rx_recognition.onresult        = function(e) {
                                                var interim_transcript      = '';
                                                if (typeof(e.results) == 'undefined')
                                                {
                                                    $rx_recognition.onend   = null;
                                                    $rx_recognition.stop();
                                                    upgrade();
                                                    return;
                                                }
                                                for (var i = e.resultIndex; i < e.results.length; ++i)
                                                {
                                                    if (e.results[i].isFinal)
                                                    {
                                                        final_transcript    += e.results[i][0].transcript;
                                                    }
                                                    else
                                                    {
                                                        interim_transcript  += e.results[i][0].transcript;
                                                    }
                                                }
                                                final_transcript            = capitalize(final_transcript);
                                                final_span.html(linebreak(final_transcript));
                                                interim_span.html(linebreak(interim_transcript));
                                            };

            console.log('%c webkitSpeechRecognition is full configured', 'background: #31708f; color: #fff');
        }

        btn_start_recognition.click(function(e) {
            if (recognizing)
            {
                $rx_recognition.stop();
                return;
            }
            final_transcript                = '';
            $rx_recognition.lang            = 'es-SV';
            $rx_recognition.start();
            ignore_onend                    = false;
            final_span.html('');
            interim_span.html('');
            icon_start_recognition.removeClass('fa-microphone fa-spinner icon-refresh-animate').addClass('fa-microphone-slash');
            showInfo('info_allow');
            start_timestamp                 = e.timeStamp;
        });
        /* END --| BS TABLE FILTERS */

        jQuery(document).on('myevt:summernote:speechrecognition', function(e, snevt, $el, $el_id, $sn_btn_id) {
            if (recognizing)
            {
                $rx_recognition.stop();
                return;
            }
            final_transcript                = '';
            $rx_recognition.lang            = 'es-SV';
            $rx_recognition.start();
            ignore_onend                    = false;
            final_span.html('');
            interim_span.html('');
            icon_start_recognition.removeClass('fa-microphone fa-spinner icon-refresh-animate').addClass('fa-microphone-slash');
            showInfo('info_allow');
            start_timestamp                 = e.timeStamp;
        });

        /*
         * recognition modal hide;
         */
        modal_start_recognition.on('hide', function(e) {
            if (recognizing)
            {
                $rx_recognition.stop();
            }
        });

    };

    function upgrade()
    {
        var btn_start_recognition           = jQuery('#btn_start_recognition');
        btn_start_recognition.css('visibility', 'hidden');
        showInfo('info_upgrade');
    }

    var two_line                            = /\n\n/g;
    var one_line                            = /\n/g;
    function linebreak(s)
    {
        return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
    }

    var first_char                          = /\S/;
    function capitalize(s)
    {
        return s.replace(first_char, function(m) {
            return m.toUpperCase();
        });
    }

    /*
     * 
     * @type type
     * Global variables for plugin
     */
    window.field_speechRecognition  = {};   // --| speechRecognition options object

    /*
     * get target for speech result
     */
    function get_recognitionTargetCode()
    {
        var $target                 = null;

        if (jQuery.isEmptyObject(field_speechRecognition) !== false)
        {
            var $editor             = jQuery('.note-editor').first().siblings('textarea');
            $target                 = '#' + $editor[0].id;
        }
        else
        {
            $target                 = '#' + field_speechRecognition.editor;
        }
        return $target;
    }

    /*
     * ******************************************************************
     * --| add Result to target
     * ******************************************************************
     */
    $.fn.set_recognitionResultCode  = function(options)
    {
        /*
         * vars
         */
        var $this                   = jQuery(this),
            final_span              = jQuery('#final_span');

        $this.summernote('code', $this.summernote('code') + ' ' + jQuery.trim(final_span.html()));
        field_speechRecognition     = jQuery.extend(true, {}, {});
    };

    function showInfo(s)
    {
        var info                    = jQuery('#info');
        if (s)
        {
            info.children('p').each(function(i) {
                var child_display   = jQuery(this).attr('id') === s ? 'inline' : 'none'
                jQuery(this).css('display', child_display);
            });
            info.css('visibility', 'visible');
        }
        else
        {
            info.css('visibility', 'hidden');
        }
    }

}(jQuery));

jQuery(document).ready(function() {
    console.log('%c a lo facil, el boton cerca del bsswitch de transcripcion, y q sirva para todos los summernote.... q se guarde en window. donde esta el puntero\ntambien puede ser que en un div abajo de cada summernote aparezca lo q se va escribiendo, o en el modal para cualquier sn, asi el boton no maneja el evento, sino el trigger del evento\n\notra onda tambien es poner en pantalla entera sin los tab los summernote para q aparezcan mas largos', 'background: #70A; color: #fff');

    /*
     * set speechrecognition to last element
     * last() used just for call the plugin
     */
    jQuery('.summernote').last().build_webkitSpeechRecognition();

    jQuery('.note-editing-area').on('click', function() {
        var $editor     = jQuery(this).closest('.note-editor').prev('textarea');

        if (jQuery.isEmptyObject(field_speechRecognition) !== false)
        {
            jQuery.extend(true,
                    field_speechRecognition,
                    {
                        editor  : $editor[0].id
                    }
            ); // set value for $editor
        }
    });

});