/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

jQuery(document).ready(function() {

    /**
     * Formato para USUARIO LOGUEADO
     */
    function patternUserLoggedFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }

        if (state.id !== $id_emp_userLogged.toString())
        {
            return state.text; // is not the user logged
        }

        var $userLogged_class 	= 'element-v2', // custom define class
            $userLogged_style 	= 'text-align: left; margin-left: 10px; vertical-align: inherit; font-weight: normal;'; // custom define style

        return jQuery.trim(state.text) + ' ' + [
            '<span class=\'label label-' + $userLogged_class + '\' style=\'' + $userLogged_style + '\'>',
                '[Usuario logueado]',
            '</span>'
        ].join('');
    }

    $('[data-apply-formatter="user"]').each(function(i) {
        var $select2        = jQuery(this);
        var $placeholder    = $select2.data('apply-placeholder');
        $placeholder        = !(typeof $placeholder === "undefined" || $placeholder === null || $placeholder === "") ? $placeholder : '';
        var $width          = $select2.data('apply-width');
        $width              = !(typeof $width === "undefined" || $width === null || $width === "") ? $width : '100%';
        $select2.select2({
                placeholder         : $placeholder,
                allowClear          : true,
                width               : $width,
                dropdownAutoWidth   : true,
                formatResult        : patternUserLoggedFormat,
                formatSelection     : patternUserLoggedFormat,
                escapeMarkup        : function(m) {
                                            return m;
                                        }
        });
    })
    .on('select2-selecting', function(e) {
        if (jQuery(this).data('apply-formatter-mode') === 'disabled') {
            e.preventDefault();
        }
    });


    /**
     * Formato para ESTABLECIMIENTOS
     */
    function patternStdUserLoggedFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }

        if (state.id !== $id_userEstab.toString())
        {
            return state.text; // is not the std of user logged
        }

        var $stdUserLogged_class 	= 'element-v2', // custom define class
            $stdUserLogged_style 	= 'text-align: left; margin-left: 10px; vertical-align: inherit; font-weight: normal;'; // custom define style

        return jQuery.trim(state.text) + ' ' + [
            '<span class=\'label label-' + $stdUserLogged_class + '\' style=\'' + $stdUserLogged_style + '\'>',
                '[Servicio local]',
            '</span>'
        ].join('');
    }

    $('[data-apply-formatter="std"]').select2({
                placeholder: '',
                allowClear: true,
                dropdownAutoWidth : true,
                formatResult: patternStdUserLoggedFormat,
                formatSelection: patternStdUserLoggedFormat,
                escapeMarkup: function(m) {
                                  return m;
                              }
    });


    /**
     * Formato para REPOSITORIOS PACS
     */
    function patternStdPacsUserLoggedFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }

        if (state.id !== $id_userEstab.toString())
        {
            return state.text; // is not the std for PACS of user logged
        }

        var $stdPacsUserLogged_class 	= 'element-v2', // custom define class
            $stdPacsUserLogged_style 	= 'text-align: left; margin-left: 10px; vertical-align: inherit; font-weight: normal;'; // custom define style

        return jQuery.trim(state.text) + ' ' + [
            '<span class=\'label label-' + $stdPacsUserLogged_class + '\' style=\'' + $stdPacsUserLogged_style + '\'>',
                '[Repositorio PACS Local]',
            '</span>'
        ].join('');
    }

    $('[data-apply-formatter="stdPacs"]').select2({
                placeholder: '',
                allowClear: true,
                dropdownAutoWidth : true,
                formatResult: patternStdPacsUserLoggedFormat,
                formatSelection: patternStdPacsUserLoggedFormat,
                escapeMarkup: function(m) {
                                  return m;
                              }
    });
    
    
    /*
     * Formato PATRÓN DIAGNÓSTICO
     */
    function patternDiagFormat(state)
    {
	/*if (!state.id)
	{
	    return state.text; // optgroup
	}*/
	if (!state.id)
        {
            var $arrText    = state.text.split('-');
            var $nextText   = state.text.split(/-(.+)?/)[1];

            return [
                '<div class="expand-box">',
                    '<span style="">',
                        $arrText[0],
                    '</span>',
                    '<span style="margin-left: 10px;">',
                        $nextText,
                    '</span>',
                '</div>'
            ].join('\n'); // optgroup
        }

	var $arrText = state.text.split('-');
	
        return typeof $arrText[1] === "undefined" ?
	    state.text : [
            '<div class="expand-box">',
                '<span style="float: left; min-width: 295px;">',
                    $arrText[0],
                '</span>',
                '<span class="label label-primary-v2" style="float: left; margin-left: 5px; margin-top: 2px; font-weight: normal;">',
                    $arrText[1],
                '</span>',
            '</div>'
        ].join('\n');
    }
    $('[data-apply-formatter="patternDiag"]').select2({
	    placeholder: '',
	    allowClear: true,
	    dropdownAutoWidth : true,
	    formatResult: patternDiagFormat,
	    formatSelection: patternDiagFormat,
	    escapeMarkup: function(m) {
			      return m;
			  }
	});


    /*
     * format for date status
     */
    function dateStatusFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }

        if (jQuery.inArray(state.id.toString(), ['1', '2', '5', '6'] ) === -1)
        {
            return state.text; // is not the final status
        }

        var $dateStatus_class     = 'element-v2',               // custom define class
            $dateStatus_icon      = 'glyphicon-tags';           // custom define class
        if (state.id === '2' || state.id === 2)
        {
            $dateStatus_class     = 'primary-v2',               // custom define class
            $dateStatus_icon      = 'glyphicon-ok-sign';        // custom define class
        }
        if (state.id === '5' || state.id === 5)
        {
            $dateStatus_class     = 'danger',                   // custom define class
            $dateStatus_icon      = 'glyphicon-remove-sign';    // custom define class
        }
        if (state.id === '6' || state.id === 6)
        {
            $dateStatus_class     = 'warning',                  // custom define class
            $dateStatus_icon      = 'glyphicon-remove-sign';    // custom define class
        }

        return [
            '<span class=\'text-' + $dateStatus_class + '\'>',
                state.text,
                '  ',
                '<i class=\'glyphicon ' + $dateStatus_icon + '\'>',
                '</i>',
            '</span>'
        ].join('');
    }
    $('[data-select2-formatter="dateStatus"]').select2({
        placeholder         : '',
        allowClear          : true,
        dropdownAutoWidth   : true,
        formatResult        : dateStatusFormat,
        formatSelection     : dateStatusFormat,
        escapeMarkup        : function(m) {
                                    return m;
                            }
    });


    /*
     * format for study status
     */
    function studyStatusFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }

        if (state.id !== '5' && state.id !== 5)
        {
            return state.text; // is not the final status
        }

        var $studyStatus_class     = 'primary-v2'; // custom define class

        return [
            '<span class=\'text-' + $studyStatus_class + '\'>',
                state.text,
                '  ',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
            '</span>'
        ].join('');
    }
    $('[data-select2-formatter="studyStatus"]').select2({
        placeholder         : '',
        allowClear          : true,
        dropdownAutoWidth   : true,
        formatResult        : studyStatusFormat,
        formatSelection     : studyStatusFormat,
        escapeMarkup        : function(m) {
                                    return m;
                            }
    });


    /*
     * format for interpretation status
     */
    function interpretationStatusFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }

        if (state.id !== '4' && state.id !== 4)
        {
            return state.text; // is not the final status
        }

        var $interpretationStatus_class     = 'primary-v2'; // custom define class

        return [
            '<span class=\'text-' + $interpretationStatus_class + '\'>',
                state.text,
                '  ',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
            '</span>'
        ].join('');
    }
    $('[data-select2-formatter="interpretationStatus"]').select2({
        placeholder         : '',
        allowClear          : true,
        dropdownAutoWidth   : true,
        formatResult        : interpretationStatusFormat,
        formatSelection     : interpretationStatusFormat,
        escapeMarkup        : function(m) {
                                    return m;
                            }
    });


    /*
     * format for diagnostic status
     */
    function diagnosticStatusFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }

        if (jQuery.inArray(state.id.toString(), ['4', '5', '6'] ) === -1)
        {
            return state.text; // is not the final status
        }

        var $diagnosticStatus_class     = 'primary-v2',                 // custom define class
            $diagnosticStatus_icon      = 'glyphicon-ok-sign';          // custom define class
        if (state.id === '4' || state.id === 4)
        {
            $diagnosticStatus_class     = 'danger',                     // custom define class
            $diagnosticStatus_icon      = 'glyphicon-remove-sign';      // custom define class
        }
        if (state.id === '5' || state.id === 5)
        {
            $diagnosticStatus_class     = 'success-v2',                 // custom define class
            $diagnosticStatus_icon      = 'glyphicon-exclamation-sign'; // custom define class
        }

        return [
            '<span class=\'text-' + $diagnosticStatus_class + '\'>',
                state.text,
                '  ',
                '<i class=\'glyphicon ' + $diagnosticStatus_icon + '\'>',
                '</i>',
            '</span>'
        ].join('');
    }
    $('[data-select2-formatter="diagnosticStatus"]').select2({
        placeholder         : '',
        allowClear          : true,
        dropdownAutoWidth   : true,
        formatResult        : diagnosticStatusFormat,
        formatSelection     : diagnosticStatusFormat,
        escapeMarkup        : function(m) {
                                    return m;
                            }
    });


    /*
     * format for proyecciones
     */
    function proyeccionesFormat(state)
    {
	if (!state.id)
	{
            var $arrText    = state.text.split('-');
            var $nextText   = state.text.split(/-(.+)?/)[1];

            return [
                '<div class="expand-box">',
                    '<span style="">',
                        $arrText[0],
                    '</span>',
                    '<span style="margin-left: 10px;">',
                        $nextText,
                    '</span>',
                '</div>'
            ].join('\n'); // optgroup
	}
        
	var $arrText    = state.text.split('-');
        var $nextText   = state.text.split(/-(.+)?/)[1];
        
        return [
            '<div class="expand-box">',
                '<span style="float: left; min-width: 59px;">',
                    $arrText[0],
                '</span>',
                '<span style="float: left; margin-left: 5px;">',
                    $nextText,
                '</span>',
            '</div>'
        ].join('\n');
    }
    $('[data-apply-formatter="pry"]').select2({
        placeholder         : '',
        allowClear          : true,
        dropdownAutoWidth   : true,
        formatResult        : proyeccionesFormat,
        formatSelection     : proyeccionesFormat,
        escapeMarkup        : function(m) {
                                    return m;
                            }
    });
//    $('[data-apply-formatter="pry"]').find('option[value=197], option[value=199], option[value=205]').prop('disabled', true);


    /*
     * format for examenes
     */
    function examenesFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }
        
	var $arrText    = state.text.split('-');
        var $nextText   = state.text.split(/-(.+)?/)[1];
        
        return [
            '<div class="expand-box">',
                '<span style="float: left; min-width: 59px;">',
                    $arrText[0],
                '</span>',
                '<span style="float: left; margin-left: 5px;">',
                    $nextText,
                '</span>',
            '</div>'
        ].join('\n');
    }
    $('[data-apply-formatter="exm"]').select2({
        placeholder         : '',
        allowClear          : true,
        dropdownAutoWidth   : true,
        formatResult        : examenesFormat,
        formatSelection     : examenesFormat,
        escapeMarkup        : function(m) {
                                    return m;
                            }
    });


    /*
     * format for modalidades
     */
    function modalidadesFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }
        
	var $arrText    = state.text.split('-');
        var $nextText   = state.text.split(/-(.+)?/)[1];
        
        return [
            '<div class="expand-box">',
                '<span style="float: left; min-width: 59px;">',
                    $arrText[0],
                '</span>',
                '<span style="float: left; margin-left: 5px;">',
                    $nextText,
                '</span>',
            '</div>'
        ].join('\n');
    }
    /*
     * short format for modalidades
     */
    function modalidadesShortFormat(state)
    {
        if (!state.id)
        {
            return state.text; // optgroup
        }
        
        return state.text.split(/-(.+)?/)[1];
    }
    $('[data-apply-formatter="mld"]').each(function(i) {
        var $select2        = jQuery(this);
        var $placeholder    = $select2.data('apply-placeholder');
        $placeholder        = !(typeof $placeholder === "undefined" || $placeholder === null || $placeholder === "") ? $placeholder : '';
        var $width          = $select2.data('apply-width');
        $width              = !(typeof $width === "undefined" || $width === null || $width === "") ? $width : '100%';
        $select2.select2({
                placeholder         : $placeholder,
                allowClear          : true,
                width               : $width,
                dropdownAutoWidth   : true,
                formatResult        : modalidadesFormat,
                formatSelection     : $width === '100%' ? modalidadesFormat : modalidadesShortFormat,
                escapeMarkup        : function(m) {
                                            return m;
                                        }
        });
    });

});
