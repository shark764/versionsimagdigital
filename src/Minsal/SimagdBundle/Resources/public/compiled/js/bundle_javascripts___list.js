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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function simagdDateTimeFormatter(value, row, index) {
    moment.locale('es');
    
    var dtFormatter = moment(jQuery.trim(value), "YYYY-MM-DD HH:mm:ss");
    
    return dtFormatter.isValid() !== false ?
	      dtFormatter.format("dddd, MMMM D YYYY, h:mm:ss A") : '';
}

function simagdDateFormatter(value, row, index) {
    moment.locale('es');
    
    var dFormatter = moment(jQuery.trim(value), "YYYY-MM-DD");
    
    return dFormatter.isValid() !== false ?
	      dFormatter.format("dddd, MMMM D YYYY") : '';
}

function simagdTimeFormatter(value, row, index) {
    moment.locale('es');
    
    var tFormatter = moment(jQuery.trim(value), "HH:mm:ss");
    
    return tFormatter.isValid() !== false ?
	      tFormatter.format("h:mm:ss A") : '';
}

function simagdOrigenFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.prc_id_origen === $id_userEstab || row.prc_id_origen === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEmpleadoUserLoggedFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.data_id_empUser === $id_emp_userLogged || row.data_id_empUser === $id_emp_userLogged.toString()
            || row.data_id_user === $id_userLogged || row.data_id_user === $id_userLogged.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Usuario logueado]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdPacienteFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (!jQuery.isEmptyObject(row.explocal_id)) {
        $return     = [
//            '<span style="color:#838383;">',
	    '<span class="label label-element-v2">',
                '[' + row.explocal_numero + ']',
            '</span>',
            '  ',
            $return
        ].join('');
    }
    
    if (row.unknExp_id !== null && row.unknExp_id !== '') {
        $return     = [
	    '<span class="label label-danger">',
                '[' + row.unknExp_numero + ']',
            '</span>',
            '  ',
            row.unknExp_nombreFicticio
        ].join('');
    }
    
    return $return;
}

function simagdAreaAtencionFormatter(value, row, index) {
    var $style = row.prc_id_areaAtencion === 2 || row.prc_id_areaAtencion === '2' ?
                        'danger' : ( row.prc_id_areaAtencion === 3 || row.prc_id_areaAtencion === '3' ?
                                        'success-v3' : 'primary-v4' );
    
    var $return     = [
        '<span class=\'label label-' + $style + '\'>',
            jQuery.trim(value),
        '</span>'
    ].join('');
    
    return $return;
}

function simagdReferidoFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.prc_id_referido === $id_userEstab || row.prc_id_referido === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdDiagnosticanteFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.prc_id_diagnosticante === $id_userEstab || row.prc_id_diagnosticante === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEstablecimientoFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.alias_id_establecimiento === $id_userEstab || row.alias_id_establecimiento === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEstadoDiagnosticoFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (jQuery.trim(row.diag_codEstado) === 'APR') {
        $return     = [
            '<span class="text-primary-v4">',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
                '  ',
                $return,
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.diag_codEstado) === 'IMP') {
        $return     = [
            '<span class="text-danger">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-remove-sign">',
                '</i>',
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.diag_codEstado) === 'CRG') {
        $return     = [
            '<span class="text-success-v3">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-exclamation-sign">',
                '</i>',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEstadoLecturaFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (jQuery.trim(row.lct_codEstado) === 'LDO') {
        $return     = [
            '<span class="text-primary-v4">',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
                '  ',
                $return,
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdTipoEstudioFormatter(value, row, index) {
    var ___isCmpl = !jQuery.isEmptyObject(row.solcmpl_id);
    
    return [
        '<span class="label label-' + (___isCmpl === false ? 'primary-v4' : 'success-v3') + '">',
        (___isCmpl === false ? 'Solicitado' : 'Adicional'),
        '</span>'
    ].join('');
}

function simagdEstadoEstudioFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    var ___isCmpl   = !jQuery.isEmptyObject(row.solcmpl_id);
    
    if (jQuery.trim(row.prz_codEstado) === 'ALM') {
        $return     = [
            '<span class="text-' + (___isCmpl === false ? 'primary-v4' : 'success-v3') + '">',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
                '  ',
                $return,
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdSolicitanteEstudioFormatter(value, row, index) {
    var ___isCmpl = !jQuery.isEmptyObject(row.solcmpl_id);
    return ___isCmpl === false ? row.prc_solicitante : '<span style="color:#838383;">' + row.solcmpl_solicitante + '</span>';
}

function simagdModalidadSolicitadaFormatter(value, row, index) {
    var ___isCmpl = !jQuery.isEmptyObject(row.solcmpl_id);
    return ___isCmpl === false ? row.prc_modalidad : '<span style="color:#838383;">' + row.solcmpl_modalidad + '</span>';
}

function simagdDescriptionFormatter(value, row, index) {
    return [
        '<pre class="pre-display-code-natural">',
            jQuery.trim(value),
        '</pre>'
    ].join('');
}

function simagdDescriptionAdvanceFormatter(value, row, index) {
    return [
        '<pre class="pre-display-code-no-natural">',
            jQuery.trim(value),
        '</pre>'
    ].join('');
}

function simagdDescriptionAdvanceNoScrollFormatter(value, row, index) {
    return [
        '<pre class="pre-display-code-no-natural pre-unlimited-height">',
            jQuery.trim(value),
        '</pre>'
    ].join('');
}

function simagdEstabUserLoggedFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.data_id_estab === $id_userEstab || row.data_id_estab === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEstadoCitaFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (jQuery.trim(row.cit_codEstado) === 'CNF') {
        $return     = [
            '<span class="text-primary-v4">',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
                '  ',
                $return,
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.cit_codEstado) === 'ANL') {
        $return     = [
            '<span class="text-danger">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-remove-sign">',
                '</i>',
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.cit_codEstado) === 'CNL') {
        $return     = [
            '<span class="text-warning">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-remove-sign">',
                '</i>',
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.cit_codEstado) === 'ESP') {
        $return     = [
            '<span class="text-element-v2">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-tags">',
                '</i>',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdPrioridadAtencionFormatter(value, row, index) {
    var $pr_defaultClass    = jQuery.isEmptyObject(row.prAtn_estiloPresentacion) === false ? row.prAtn_estiloPresentacion : 'primary-v4';
    
    return [
        '<span class=\'label label-' + $pr_defaultClass + '\'>',
            jQuery.trim(value),
        '</span>'
    ].join('');
}

function simagdTipoNotaFormatter(value, row, index) {
    var $tipoN_class = 'primary-v4';
    
    switch (row.notdiag_codTipo) {
        case 'ACR':
        case 'FVR':
        default:
            $tipoN_class = 'primary-v4';
            break;
        case 'ICM':
        case 'AGR':
        case 'ACL':
            $tipoN_class = 'element-v2';
            break;
        case 'INF':
        case 'DSR':
            $tipoN_class = 'warning';
            break;
        case 'IMP':
            $tipoN_class = 'danger';
            break;
    }
    
    return [
	'<span class=\'label label-' + $tipoN_class + '\'>',
	    jQuery.trim(value),
	'</span>'
    ].join('');
}

function estadoSolicitudFormatter(value, row, index) {
    var $statusSc_class = 'primary-v4';
    
    switch (row.statusSc_codigo) {
        case 'SCR':
        case 'CIT':
        case 'CCN':
        default:
            $statusSc_class = 'primary-v4';
            break;
        case 'PRZ':
        case 'EAP':
            $statusSc_class = 'success-v3';
            break;
        case 'EIR':
        case 'LTR':
        case 'DTR':
        case 'DAP':
            $statusSc_class = 'element-v2';
            break;
        case 'CRP':
            $statusSc_class = 'warning';
            break;
        case 'CCL':
        case 'SRZ':
            $statusSc_class = 'danger';
            break;
    }
    
    return [
	'<span class=\'label label-' + $statusSc_class + '\'>',
	    jQuery.trim(row.statusSc_nombreEstado),
	'</span>'
    ].join('');
}


/*
 * ******************************************************************************
 * Métodos para full-entity
 * ******************************************************************************
 */

function simagdPacienteDesconocidoFormatter(value, row, index) {
    var $text   = row.prc_pacienteDesconocido === false ? 'no' : 'sí';
    var $style  = row.prc_pacienteDesconocido === false ? 'primary-v4' : 'warning';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdPacienteReferidoFormatter(value, row, index) {
    var $text   = row.prc_referirPaciente === false ? 'no' : 'sí';
    var $style  = row.prc_referirPaciente === false ? 'primary-v4' : 'info';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdRequiereDiagnosticoFormatter(value, row, index) {
    var $text   = row.prc_requiereDiagnostico === false ? 'no' : 'sí';
    var $style  = row.prc_requiereDiagnostico === false ? 'warning' : 'success-v3';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdPacienteAmbulatorioFormatter(value, row, index) {
    var $text   = row.prc_pacienteAmbulatorio === false ? 'no' : 'sí';
    var $style  = row.prc_pacienteAmbulatorio === false ? 'primary-v4' : 'info';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdRequiereCitaFormatter(value, row, index) {
    var $text   = row.prc_requiereCita === false ? 'no' : 'sí';
    var $style  = row.prc_requiereCita === false ? 'success-v3' : 'primary-v4';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdAreaServicioDiagnosticoFormatter(value, row, index) {
    return [
        '<span class=\'label label-element-v2\'>',
	    jQuery.trim(value),
        '</span>'
    ].join('');
}

function simagdSolicitudEstudioProyeccionFormatter(value, row, index) {
    var $arr_result = ['<ul>'];
    $.each(row.prc_solicitudEstudioProyeccion, function(i, y) {
        $arr_result.push('<li>', '<strong><span class="text-info">', jQuery.trim(y.expl_codigo) + '</span></strong> ' + jQuery.trim(y.expl_nombre), '</li>');
    });
    $arr_result.push('</ul>');

    return $arr_result.join('');
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {

    /*
     * 
     * @type type
     * Global variables for plugin
     */
    window.BSTABLE_FILTER_COLLECTION                = {};   // --| filter object
    /*
     * Collection of bstables
     */
    BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION    = [];   // --| build collection

    /*
     * *********************************************************************
     * Build filter context for each table bootstrapFilterTable()
     * *********************************************************************
     */
    $.fn.build_bootstrapFilterTable = function(options)
    {
        /*
         * 
         * @type @call;$
         * 
         * Get this Tables with bootstrapTable()
         */
        var $table_bsTable      = jQuery(this);                      // --| get THIS Table DOM
        var $table_bsTable_id   = $table_bsTable.attr('id');    // --| get THIS Table unique id
        
        /*
         * push table into collection
         */
        BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION.push({ bstable : $table_bsTable_id, filter : null, param : null, xparam : {} });

        /*
         * Build custom BS TABLE FILTERS
         */
        var $table_bsTable_toolbar              = $($table_bsTable.bootstrapTable('getOptions').toolbar);   // --| get Toolbar DOM
        var $table_bsTable_toolbar_menuFilter   = $table_bsTable_toolbar
                                                            .find('.table_bsTable_toolbar_menuFilter');     // --| get Menu DOM
        var $table_bsTable_columns              = $table_bsTable.bootstrapTable('getOptions').columns;      // --| get Columns
        var $table_bsTable_url                  = $table_bsTable.bootstrapTable('getOptions').backupUrl;    // --| get Url
        
        /*
         * 
         * @type Array
         * collection of filters for this bstable
         */
        var FILTER_COLLECTION                   = [];   // --| build array collection

        $.each($table_bsTable_columns, function (i, column) {
            if (typeof column.filterBstableBy === "undefined" || column.filterBstableBy === null || column.filterBstableBy === "")
            {
                $table_bsTable_columns[i].filterBstableBy           = column.field;
            }
            if ((typeof column.filterBstableSourceAlias === "undefined" || column.filterBstableSourceAlias === null || column.filterBstableSourceAlias === "")
                    && column.filterBstableType === 'select2')
            {
                var $split_field    = column.filterBstableBy.replace('[', '').split('_');
                $table_bsTable_columns[i].filterBstableSourceAlias  = $split_field[0];
            }
            if (column.filterBstableApply === true || column.filterBstableApply === 'true')
            {
                $table_bsTable_toolbar_menuFilter
                        .append(function(i, html) {
                            return ['<li>',
                                        '<label>',
                                            '<input type="checkbox" value="1" data-field="' + column.field + '" />',
                                            ' ',
                                            column.title,
                                        '</label>',
                                        '<div class="x-editable-filter"',
						' title="Filtrar datos por: ' + column.title + '"',
						' data-field="' + column.field + '"',
						' data-table-filter="' + $table_bsTable_id + '"',
						' data-filter-by="' + column.filterBstableBy + '"',
						' data-type="' + column.filterBstableType + '"',
						' data-source-alias="' + column.filterBstableSourceAlias + '"',
						' data-source="' + column.filterBstableDataSource + '">',
					    render_bsTableFilter(column),
                                        '</div>',
                                    '</li>'
                            ].join('');
                        });
                        
                FILTER_COLLECTION.push({ bstable : $table_bsTable_id, field : column.field, column : column, value : type_bsTable_columnValue(column), active: false });
            }
        });
        
        /*
         * --| HIDE editable elements by DEFAULT
         * --| SEND BUTTON, second choice to submit
         */
        $table_bsTable_toolbar_menuFilter
                .find('.x-editable-filter')
                    .hide()
                .end()
                .append(function(i, html) {
                    return ['<li class="toolbar_menu_footer_block_button">',
                                '<button type="button"    class="btn btn-primary-v4 btn-outline btn-block btn_block_toolbar_filter_send">',
                                    '<span class="glyphicon glyphicon-repeat">',
                                    '</span>',
                                '</button>',
                            '</li>'
                    ].join('');
                });
        
        $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION, function (i, bstable) {
            if (bstable.bstable === $table_bsTable_id) {
                BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter = FILTER_COLLECTION;
            }
        });

        /*
         * Actions for Custom TOOLBAR Buttons
         */
        $table_bsTable_toolbar.find('.btn_toolbar_filter_clear').off('click').on('click', function (e) {
            e.stopImmediatePropagation();
            $table_bsTable_toolbar_menuFilter
                    .find('li')
                    .find('input:checkbox:checked').each(function(i) {
                            var $this   = jQuery(this);
                            var $is_chk = $this.is(':checked');
                            $this.prop('checked', false)
                                        .trigger('change', [$is_chk, false]);
                    });
            
            /*
             * refresh bootstrap table without filters
             */
            $('table[id="' + $table_bsTable_id + '"]')
                    .bootstrapTable('refresh', {
                                url: Routing.generate($table_bsTable_url, {
                                            filters: JSON.stringify({xparam: getExtraParameters_bsTableFilter($table_bsTable_id)})
                                })
                            });
        });
        $table_bsTable_toolbar.find('.btn_toolbar_filter_send').off('click').on('click', function (e) {
            e.stopImmediatePropagation();
            
            var $filters_sendToServer       = {};
	    
	    /*
	     * add extra parameters to var
	     * x-param are gonna be added to param for bstable
	     */
	    $filters_sendToServer['xparam'] = getExtraParameters_bsTableFilter($table_bsTable_id);

            $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION, function (i, bstable) {
                if (bstable.bstable === $table_bsTable_id) {
                    $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter, function (j, bscolumn) {
                        if (bscolumn.active !== false) {
                            $filters_sendToServer[bscolumn.field]   = {
                                            type : bscolumn.column.filterBstableType,
                                            target : bscolumn.column.filterBstableBy,
                                            value : BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter[j].value
                                        }; // get filter value
                        }
                    });
                }
            });

            $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION, function (i, bstable) {
                if (bstable.bstable === $table_bsTable_id) {
                    BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].param = jQuery.extend(true, {}, $filters_sendToServer);
                    console.log('BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].param', BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].param);
                }
            });
            
            /*
             * refresh bootstrap table with new filters from $filters_sendToServer
             */
            $('table[id="' + $table_bsTable_id + '"]')
                    .bootstrapTable('refresh', {
                                url: Routing.generate($table_bsTable_url, {
                                            filters: JSON.stringify($filters_sendToServer)
                                })
                            });

            console.log(JSON.stringify($filters_sendToServer));
        });

	/*
	 * Stop click event in menu
	 */
        $table_bsTable_toolbar_menuFilter.find('li').off('click').on('click', function (e) {
            e.stopImmediatePropagation();
        });

	/*
	 * rewrite click event for checkbox
	 */
        $table_bsTable_toolbar_menuFilter.find('input').off('click').on('click', function () {
            var $this = jQuery(this);
        });

	/*
	 * rewrite change event for checkbox
	 */
        $table_bsTable_toolbar_menuFilter.find('input').on('change', function (e, a, b) {
            var $this = jQuery(this);

	    if ($this.is(':checked')) {
                /*
                * span with filters --| X-editable
                */
                $this.parents('li')
			.find('.x-editable-filter')
                            .fadeIn()
                        .end()
			.find('span[data-x-editable="filter"]')
                                    .build_bootstrapItemFilter();
					
		console.log('filter by:', $this.data('field'));
					
	    } else {
                //Destroy only if is checked
                if ((typeof a !== "undefined" && a !== false) || typeof a === "undefined") {
                    $this.parents('li')
			.find('.x-editable-filter')
                            .fadeOut()
                        .end()
                        .find('span[data-x-editable="filter"]').each(function(i) {
                                    var $x_editable   = jQuery(this);
                                    if (!$x_editable.data("editable").input.$input) {
                                        $x_editable.data("editable").input.$input = $({});  // avoid empty input
                                    }
                                    $x_editable
                                        .editable('destroy')
                                        .end()
                                        .find('span[data-x-editable="filter"]')
                                                .html('Sin editar...');     // destroy editable filter in span
                            });
                }
	    }

            $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION, function (i, bstable) {
                if (bstable.bstable === $table_bsTable_id) {
                    $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter, function (j, bscolumn) {
                        if (bscolumn.field === $this.data('field')) {
                            BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter[j].active    = $this.is(':checked'); // toggle status for filter
                        }
                    });
                }
            });
            
        });
        
        /*
         * Button in bottom of toolbar
         */
        $table_bsTable_toolbar.find('.btn_block_toolbar_filter_send').off('click').on('click', function (e) {
            e.stopImmediatePropagation();
            
            $table_bsTable_toolbar
                    .find('.btn_toolbar_filter_send')
                    .trigger('click');
        });
        
        /* END --| BS TABLE FILTERS */

    };

    /*
     * *********************************************************************
     * Build ITEM filter context for each column in bootstrapFilterTable()
     * *********************************************************************
     */
    $.fn.build_bootstrapItemFilter = function(options)
    {
        moment.locale('es');
        
	var $this 		= jQuery(this),
	    $container		= $this.parents('.x-editable-filter');
	
	var $source_function	= $container.data('source');
	var $source 		= typeof window[$source_function] === 'function' ?
                                        window[$source_function]($container.data('table-filter'), $container.data('type'), $container.data('field'), $container.data('source-alias'))
                                        : getSourceData_bsTableFilter($container.data('table-filter'), $container.data('type'), $container.data('field'), $container.data('source-alias'));

	var $default 		= {
                mode: 'inline',
                emptytext: 'Sin editar...',
                emptyclass: '',
                inputclass: 'input-editable-width-v2',
	    },
	    $options 		= null;
	
	switch ($container.data('type')) {
	    case 'text':
	    default:
		$options	= jQuery.extend({}, $default, {
                    success: function(response, newValue) {
                        var $el = jQuery(this);
                        //display checklist as comma-separated values
                        
                        prepare_send_to_server_bsTableFilter($el, $container.data('table-filter'), $container.data('type'), $this.data('field'), newValue);
                    },
		});
		break;
	    case 'select2':
		$options	= jQuery.extend({}, $default, {
		    source: $source,
		    select2: {
			placeholder: 'click para seleccionar...',
			allowClear: true,
			escape: false,
			dropdownAutoWidth : true,
			multiple: true,
		    },
                    success: function(response, newValue) {
                        var $el = jQuery(this);
                        //display checklist as comma-separated values
                        
                        prepare_send_to_server_bsTableFilter($el, $container.data('table-filter'), $container.data('type'), $this.data('field'), newValue);
                    },
		});
		break;
	    case 'checklist':
	    case 'boolean':
		$options	= jQuery.extend({}, $default, {
		    source: $source,
                    success: function(response, newValue) {
                        var $el = jQuery(this);
                        //display checklist as comma-separated values
                        
                        prepare_send_to_server_bsTableFilter($el, $container.data('table-filter'), $container.data('type'), $this.data('field'), newValue);
                    },
		});
		break;
	    case 'combodate':
		$options	= jQuery.extend({}, $default, {
                    template: 'D / MMM / YYYY',
		    format: 'YYYY-MM-DD',
                    viewformat: 'DD/MM/YYYY',
                    datepicker: {
                        weekStart: 1,
                        language: 'es'
                    },
                    success: function(response, newValue) {
                        var $el         = jQuery(this);
                        //display checklist as comma-separated values
                        
                        prepare_send_to_server_bsTableFilter($el, $container.data('table-filter'), $container.data('type'), $this.data('field'), newValue);
                    },
		});
		break;
	    case 'number':
		$options	= jQuery.extend({}, $default, {
                    success: function(response, newValue) {
                        var $el         = jQuery(this);
                        //display checklist as comma-separated values
                        
                        prepare_send_to_server_bsTableFilter($el, $container.data('table-filter'), $container.data('type'), $this.data('field'), newValue);
                    },
		});
		break;
	}
        
        /*
         * Build custom BS TABLE FILTERS
         */
	$this.editable($options);
        
        /*
         * Traslade select for date to select2
         */
        if ($container.data('type') === 'combodate') {
            $this.on('shown', function(e, editable) {
                jQuery(this).parents('.x-container-sides-range')
                        .find('select').each(function(i) {
                                    var $placeholder    = jQuery(this).hasClass('day') ?
                                                            'Día' : (jQuery(this).hasClass('month') ?
                                                                'Mes' : 'Año');
                                    jQuery(this).select2({
                                            placeholder: $placeholder,
                                            allowClear: true,
                                            width: '105px',
                                            dropdownAutoWidth : true
                                    });
                        });
            });
        }
        /* END --| BS TABLE FILTERS */
    };
    
    function render_bsTableFilter(column)
    {
        var $return = null;
        switch (column.filterBstableType)
        {
	    case 'text':
	    case 'select2':
	    default:
                $return = ['<span class="label label-element-v2" data-x-editable="filter"',
                                    ' data-field="' + column.field + '"',
                                    ' data-title="Filtrar datos por: ' + column.title + '"',
                                    ' data-pk="' + column.field + '"',
                                    ' data-type="' + column.filterBstableType + '">',
                                'Sin editar...',
                            '</span>',
                ].join('');
		break;
	    case 'checklist':
	    case 'boolean':
                $return = ['<span class="label label-element-v2" data-x-editable="filter"',
                                    ' data-field="' + column.field + '"',
                                    ' data-title="Filtrar datos por: ' + column.title + '"',
                                    ' data-pk="' + column.field + '"',
                                    ' data-type="checklist">',
                                'Sin editar...',
                            '</span>',
                ].join('');
		break;
	    case 'combodate':
	    case 'number':
                $return = ['<div class="x-container-sides-range" style="display: inline-block;">',
                                '<span class="label label-element-v2" data-x-editable="filter" data-filter-range="left"',
                                        ' data-field="' + column.field + '"',
                                        ' data-title="Filtrar datos por: ' + column.title + '"',
                                        ' data-pk="' + column.field + '"',
                                        ' data-type="' + column.filterBstableType + '">',
                                    'Sin editar...',
                                '</span>',
                                ' ',
                                'hasta:',
                                ' ',
                                '<span class="label label-element-v2" data-x-editable="filter" data-filter-range="right"',
                                        ' data-filter-range="right"',
                                        ' data-field="' + column.field + '"',
                                        ' data-title="Filtrar datos por: ' + column.title + '"',
                                        ' data-pk="' + column.field + '"',
                                        ' data-type="' + column.filterBstableType + '">',
                                    'Sin editar...',
                                '</span>',
                            '</div>',
                ].join('');
		break;
        }
        return $return;
    }
    
    function type_bsTable_columnValue(column)
    {
        var $return     = null;
        switch (column.filterBstableType)
        {
	    case 'text':
	    case 'select2':
	    case 'checklist':
	    case 'boolean':
	    default:
		break;
	    case 'combodate':
	    case 'number':
                $return     = {left : null, right : null};
		break;
        }
        return $return;
    }
    
    function prepare_send_to_server_bsTableFilter($el, $bstable, $type, $field, $newValue)
    {
        switch ($type)
        {
	    case 'text':
	    case 'select2':
	    case 'checklist':
	    case 'boolean':
	    default:
                $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION, function (i, bstable) {
                    if (bstable.bstable === $bstable) {
                        $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter, function (j, bscolumn) {
                            if (bscolumn.field === $field) {
                                BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter[j].value    = $newValue; // set value for filter
                                console.log($bstable, $type, $field, BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter[j].value);
                            }
                        });
                    }
                });
		break;
	    case 'combodate':
	    case 'number':
                var $parse_newValue         = null,
                    $el_align               = $el.data('filter-range'),
                    $successObject          = {};
            
                $successObject[$el_align]   = null;
                //display checklist as comma-separated values
                
                if ($type === 'number') {
                    $parse_newValue             = parseInt($newValue, 10);
                    $successObject[$el_align]   = !isNaN($parse_newValue) ? $parse_newValue : null;
                } else if ($type === 'combodate') {
                    $parse_newValue             = jQuery.isEmptyObject($newValue) === false ? $newValue.format('YYYY-MM-DD HH:mm') : null;
                    $successObject[$el_align]   = $parse_newValue;
                }

                $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION, function (i, bstable) {
                    if (bstable.bstable === $bstable) {
                        $.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter, function (j, bscolumn) {
                            if (bscolumn.field === $field) {
                                jQuery.extend(true,
                                        BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter[j].value,
                                        $successObject
                                ); // set value for filter
                                console.log($bstable, $type, $field, BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].filter[j].value);
                            }
                        });
                    }
                });
		break;
        }
    
        return false;
    }
    
    
    /*
     * --| SOURCE_DATA_COLLECTION: Collection of data sources from server
     */
    BSTABLE_FILTER_COLLECTION.SOURCE_DATA_COLLECTION   = null;   // --| build data collection

    /*
     * *********************************************************************
     * get SOURCES DATA for each select2 column in bootstrapFilterTable()
     * *********************************************************************
     */
    $.fn.build_sourceDataFilter = function(options)
    {
        /*
         * *******************************************
         *   CALL METHOD get sources in JSON format
         * *******************************************
         * @param {type} $list_alias
         * @returns {Boolean}
         */
        getJSON_bsTableFilter(build_sourcesList_bsTableFilter());
    };
    
    /*
     * *******************************************
     *   build list of sources to send to server
     * *******************************************
     * @returns {Array|Sizzle.uniqueSort}
     */
    function build_sourcesList_bsTableFilter()
    {
        /*
         * build bootstrapFilterTable for all Instances of bootstrapTable()
         */
        var $view_tables_bsTable    = $('table[data-toggle="table"]'); // A variable to store a reference to all tables.
        var $sources_list           = [];
    
        $view_tables_bsTable.each(function(i) {
            var $bstable            = jQuery(this);
            $.each($bstable.bootstrapTable('getOptions').columns, function (i, column) {
                if (column.filterBstableType === 'select2' && !(column.filterBstableRemoteDataSource === true || column.filterBstableRemoteDataSource === 'true'))
                {
                    if (typeof column.filterBstableSourceAlias === "undefined" || column.filterBstableSourceAlias === null || column.filterBstableSourceAlias === "")
                    {
                        var $split_field    = column.filterBstableBy.replace('[', '').split('_');
                        $sources_list.push($split_field[0]);
                    }
                    else
                    {
                        $sources_list.push(column.filterBstableSourceAlias);
                    }
                }
            });
        });
        return jQuery.unique($sources_list);
    }
    
    /*
     * *******************************************
     *          get sources in JSON format
     * *******************************************
     * @param {type} $list_alias
     * @returns {Boolean}
     */
    function getJSON_bsTableFilter($list_alias)
    {
        var $view_tables_bsTable    = $('table[data-toggle="table"]');                          // --| A variable to store a reference to all tables.
        var $getJSON_url            = 'simagd_imagenologia_digital_getJsonFiltersForBsTables';  // --| url to get the sources
        
        /*
         * get sources from remote
         */
        $.getJSON(Routing.generate($getJSON_url), {
            sources: JSON.stringify($list_alias),
        })
        .done(function(data) {
            if (data.status === 'OK')
            {
                /*
                 * enable buttons for dropdown filters menu
                 */
                $view_tables_bsTable.each(function(i) {
                    $(jQuery(this).bootstrapTable('getOptions').toolbar)
                        .find('.btn_filter_display')
                                        .prop("disabled", false);
                });
                /*
                 * set the sources in BSTABLE_FILTER_COLLECTION object
                 */
                BSTABLE_FILTER_COLLECTION.SOURCE_DATA_COLLECTION    = data.sources;
            }
        });
        return false;
    }
    
    /*
     * *******************************************
     *         get source for alias given
     * *******************************************
     * @param {type} $bstable, $type, $field, $source_alias
     * @returns {Array}
     */
    function getSourceData_bsTableFilter($bstable, $type, $field, $source_alias)
    {
        var $return = [];
        $return     = BSTABLE_FILTER_COLLECTION
                                .SOURCE_DATA_COLLECTION[$source_alias];
        return !(typeof $return === "undefined" || $return === null || $return === "") ? $return : [];
    }
    
    
    /*
     * *********************************************************************
     * EXTRA PARAM for filters in bootstrapFilterTable()
     * *********************************************************************
     */
    $.fn.add_extraParametersFilter = function(options)
    {
        /*
         * 
         * @type @call;$
         * 
         * Add this x-params to bootstrapTable()
         */
        var $xparam_bsTable      = jQuery(this),               	// --| get THIS Table DOM
	    $xparam_bsTable_id   = $xparam_bsTable.attr('id');	// --| get THIS Table unique id

	$.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION, function (i, bstable) {
	    if (bstable.bstable === $xparam_bsTable_id) {
		jQuery.extend(true,
			BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].xparam,
			jQuery.isEmptyObject(options.xparam) === false ? options.xparam : {}
		); // set value for filter
		console.log('xparam', $xparam_bsTable_id, BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].xparam, options.xparam);
	    }
	});
        
        /*
         * trigger event in send button --| reload filters
         */
        $($xparam_bsTable.bootstrapTable('getOptions').toolbar)
                .find('.btn_toolbar_filter_send')
                            .trigger('click');
    };
    
    /*
     * --| X-PARAM in BSTABLE_COLLECTION: Collection of extra parameters
     */
    function getExtraParameters_bsTableFilter($bstable)
    {
	var $extra_params	= {};   // --| extra params object
	$.each(BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION, function (i, bstable) {
	    if (bstable.bstable === $bstable) {
		jQuery.extend(true,
			$extra_params, 
			BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION[i].xparam
		); // get value for xparam
                console.log('xparam getExtraParameters_bsTableFilter', $extra_params, BSTABLE_FILTER_COLLECTION);
	    }
	});
    
        return jQuery.isEmptyObject($extra_params) === false ? $extra_params : null;
    }

}(jQuery));

jQuery(document).ready(function() {
    
    /*
     * build bootstrapFilterTable for all Instances of bootstrapTable()
     */
    var $table_bsTable  = $('table[data-toggle="table"]'); // A variable to store a reference to all tables.
    
    $table_bsTable.each(function(i) {
        jQuery(this).build_bootstrapFilterTable();
    });
    /*
     * get the data sources for select2
     * last() used just for call the plugin
     */
    $table_bsTable.last().build_sourceDataFilter();
    
    console.log('BSTABLE_FILTER_COLLECTION', BSTABLE_FILTER_COLLECTION);
    /*
     * instances are builded with filters
     */
    
//     window.alert('DEBERÍA ACTIVARSE FILTER_BSTABLE AL MOMENTO DE DAR CLICK A FILTRAR TABLA BTN,\nASI NO SE EJECUTA EL PROCESO AL LOAD PAGE');
    
});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {

    /*
     * 
     * @type type
     * Global variables for plugin
     */
    window.TT_CURRENT_SUGGESTION        = null;   // --| current suggestion
    
    /*
     * *********************************************************************
     * EXTRA PARAM for filters in bootstrapFilterTable()
     * *********************************************************************
     */
    $.fn.build_explocalExtraParamFilter = function(options)
    {
        /*
         * **********************************************************************
         *                      TYPEAHEAD for num_expediente
         * **********************************************************************
         */
        
        /*
         * 
         * @type @call;$
         * 
         * Get this Tables with bootstrapTable()
         */
        var $tt_elem_explocal           = jQuery(this);                       // --| get THIS Table DOM
        var $tt_elem_explocal_id        = $tt_elem_explocal.attr('id');  // --| get THIS Table unique id
        
        
        /*
         * **********************************************************************
         * --|Set the Options for "Bloodhound" Engine
         * **********************************************************************
         */
        
        /*
         * 
         * @type @new;Bloodhound
         */
        var $explocal_filter_sggClass   = new Bloodhound({
            limit: Infinity,
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: Routing.generate('simagd_estudio_getPatients') + '?query=%QUERY',
                wildcard: '%QUERY'
            },
        }); // --| suggestion class, bloodhound mode

        $explocal_filter_sggClass.initialize(); // --| initialize the Suggestion Engine
        
        /*
         * build typeahead
         */
        $tt_elem_explocal.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'value',
            displayKey: 'exp_numero',
            source: $explocal_filter_sggClass.ttAdapter(),
            limit: Infinity,
            templates: {
                empty: [
                    '<div class="no-items">',
                        'Sin Resultados',
                    '</div>'
                ].join('\n'),
                suggestion: function(item) {
                    var $sggt_template_function	= $tt_elem_explocal.data('template-source');
                    
                    var $edad   = jQuery.isEmptyObject(item.pct_edad) === false ? item.pct_edad.y + ' Años, ' + item.pct_edad.m + ' meses, ' + item.pct_edad.d + ' días' : 'desconocida';
                    
                    return typeof window[$sggt_template_function] === 'function' ?
                        window[$sggt_template_function](item) : [
                            '<div class="expand-box">',
                                '<span style="">',
                                    item.pct_nombreCompleto,
                                '</span>',
                                '<span class="label label-default-v2" style="float: right; margin-top: 5px; min-width: 175px; text-align: left;">',
                                    '[Edad: ' + $edad + ']',
                                '</span>',
                                '<span class="label label-element-v2" style="float: right; margin-top: 5px; min-width: 72px; margin-right: 12px; text-align: left;">',
                                    '[' + item.exp_numero + ']',
                                '</span>',
                            '</div>'
                    ].join('\n');
                },
                footer: function(query) {
                    return [
                        '<div style="text-align: center !important; opacity: 0.5 !important;">',
                            '<span class="text-element-v2">',
                                'Búsqueda: "' + query.query + '"',
                            '</span>',
                        '</div>'
                    ].join('\n');
                }
            }
        });

        /*
         * **********************************************************************
         * --| add buttons events
         * **********************************************************************
         */
        
        /*
         * search button
         * @type @call;$
         */
        var $btn_search_explocal                = $("button[id='btn_search_filter_expNumero']"),
            $btn_clear_explocal                 = $("i[id='clear-typeahead-filter-exp']");

        /*
         * field typeahead select event
         */
        $tt_elem_explocal.filter(':not([disabled]):enabled:not([readonly])').on('typeahead:select', function(e, suggestion) {
            /** trigger event of search button */
            console.log('event', e, 'suggestion', suggestion);
            $btn_search_explocal.trigger("click");
            
            /*
             * trigger custom event
             */
            TT_CURRENT_SUGGESTION               = jQuery.extend(true,
                                                        {},
                                                        suggestion
                                                ); // set value for suggestion
            jQuery(this).trigger('myevt:ttsuggestion', [e, suggestion]);
        });

        /*
         * clear icon click event
         */
        $btn_clear_explocal.filter(':not([disabled])').click(function(e) {
            $tt_elem_explocal.typeahead('val', '');

            /*
             * get table of active container
             * @type @call;$@call;find@call;data
             */
            var $target_divContainer_bsTable    = $('li.list-table-link-navbar.active')
                                                            .find("a")
                                                                    .data('divtabletarget'),
                $target_bstable                 = jQuery('#' + $target_divContainer_bsTable)
                                                            .find('table[data-toggle="table"]:visible');

            /** Refresh table with new empty parameter */
            $target_bstable.add_extraParametersFilter({
                xparam : {
                    explocal_numero: {
                        type    : 'text',
                        target  : 'explocal_numero',
                        value   : null
                    }
                }
            });
            
            /*
             * trigger custom event
             */
            TT_CURRENT_SUGGESTION               = jQuery.extend(true, {}, {}); // set value null
            $tt_elem_explocal.trigger('myevt:ttclear', [e, null]);
        });

        /*
         * Buttons search click event
         */
    
        $btn_search_explocal.filter(':not([disabled])').click(function(e) {
            e.preventDefault();

            var $explocalVal                    = jQuery.trim($tt_elem_explocal.val());

            /*
             * get table of active container
             * @type @call;$@call;find@call;data
             */
            var $target_divContainer_bsTable    = $('li.list-table-link-navbar.active')
                                                            .find("a")
                                                                    .data('divtabletarget'),
                $target_bstable                 = jQuery('#' + $target_divContainer_bsTable)
                                                            .find('table[data-toggle="table"]:visible');

            /** Refresh table with new parameters */
            $target_bstable.add_extraParametersFilter({
                xparam : {
                    explocal_numero: {
                        type    : 'text',
                        target  : 'explocal_numero',
                        value   : jQuery.isEmptyObject($explocalVal) === false ? $explocalVal : null
                    }
                }
            });

            if (!$explocalVal)
            {
                $tt_elem_explocal.typeahead('val', ''); // --| set empty input
            }
        });
    };

}(jQuery));

jQuery(document).ready(function() {
    
    /*
     * **************************************************************************
     * build extra expediente local for all Instances of custom
     * filter of bootstrapFilterTable()
     * **************************************************************************
     */

    /*
     * 
     * @type @call;$
     */
    var $tt_elem_explocal   = $('.typeahead.explocal_navbar_typeahead');    // --| typeahead input field element
    
    $tt_elem_explocal.each(function(i) {
        jQuery(this)
            .filter(':not([disabled]):enabled:not([readonly])')
            .filter('[data-xparam-filter="true"]')
                        .build_explocalExtraParamFilter();
    });
    /*
     * instances are builded with filters
     */
    
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function() {

    /** Reset view of bootstrap table on resize window */
    jQuery(window).resize(function () {
	var $target_divContainer_bsTable    = $('li.list-table-link-navbar.active').find("a").data('divtabletarget');
	jQuery('#' + $target_divContainer_bsTable).find('table[data-toggle="table"]:visible').bootstrapTable('resetView').bootstrapTable('resetWidth');
        /*
         * reposition of modal layout
         */
        $(document).find('.modal.in').modal('layout');
        
	console.log('%cresetView', 'background: #183f52; color: #fff');
    });
    
    jQuery('li.list-table-link-navbar').find("a:not([disabled])").click(function(e) {
        var $target_divContainer_bsTable    = jQuery(this).data('divtabletarget');
	var $target                         = jQuery('#' + $target_divContainer_bsTable);
        
        var $target_bsTable                 = $target.find('table[data-toggle="table"]');               // --| get bstable
        var $target_bsTable_url             = $target_bsTable.bootstrapTable('getOptions').url;         // --| get Url
        var $target_bsTable_backupUrl       = $target_bsTable.bootstrapTable('getOptions').backupUrl;   // --| get backupUrl
        
        if (typeof $target_bsTable_url === "undefined" || $target_bsTable_url === null || $target_bsTable_url === "")
        {
            $target_bsTable_url             = jQuery.trim($target.data('refresh-url'));
        }
	console.log(jQuery.trim($target.data('refresh-url')), jQuery.trim($target_bsTable_backupUrl), jQuery.trim($target_bsTable_url));
        
        /*
         * refresh bootstrap table with new filters from BSTABLE_FILTER_COLLECTION.BSTABLE_COLLECTION.param
         */
        $target_bsTable
                .bootstrapTable('refresh', {
                            url: $target_bsTable_url
                        });
        
        $('.' + $pattern_bstable_container).hide();
        $target.show();
        $('li.list-table-link-navbar').removeClass('active');
        jQuery(this).parents("li").addClass("active");
    });
    
    $('table[data-toggle="table"]').on('load-success.bs.table', function (e, data) {
	console.log(jQuery(this).attr('id'), 'bstable refresh');
    });
    
    /*
     * **************************************************************************
     * multiple select change --| resize modal layout
     * **************************************************************************
     */

    console.log(' /************** $moment **************/');
//     moment.locale('es');
//     var $moment = moment();
//     console.log($moment);
//     console.log($moment._d);
//     var $moment2 = moment("2013-02-08 09:30");
//     console.log($moment2);
//     console.log($moment2._d);
//     console.log(jQuery.extend(true, {}, $moment2, { _d : $moment._d }));
//     console.log(jQuery.extend(true, $moment2, { _d : $moment._d }));
//     
//     
//     /** filterBy */
//     jQuery('#__yeah:not([disabled])').click(function(e) {
// 	jQuery(this).parents('div').find('button').find('span').removeClass('glyphicon-refresh-animate');
// 	jQuery(this).find('span').addClass('glyphicon-refresh-animate');
// 	
// 	jQuery('#table-lista-lecturas')
// // 	    .bootstrapTable('filterBy', {})
// 	    .bootstrapTable('filterBy', { prc_atencion: 'Neumología', prc_modalidad: 'Radiología Convencional' });
//     });
//     jQuery('#__yeah2:not([disabled])').click(function(e) {
// 	jQuery(this).parents('div').find('button').find('span').removeClass('glyphicon-refresh-animate');
// 	jQuery(this).find('span').addClass('glyphicon-refresh-animate');
// 	
// 	jQuery('#table-lista-lecturas')
// // 	    .bootstrapTable('filterBy', {})
// 	    .bootstrapTable('filterBy', { prc_modalidad: 'Tomografía Axial Computarizada' });
//     });
//     jQuery('#__yeah3:not([disabled])').click(function(e) {
// 	jQuery(this).parents('div').find('button').find('span').removeClass('glyphicon-refresh-animate');
// 	jQuery(this).find('span').addClass('glyphicon-refresh-animate');
// 	
// 	jQuery('#table-lista-lecturas')
// 	    .bootstrapTable('filterBy', {});
//     });
//     jQuery('#__yeah4:not([disabled])').click(function(e) {
// 	jQuery(this).parents('div').find('button').find('span').removeClass('glyphicon-refresh-animate');
// 	jQuery(this).find('span').addClass('glyphicon-refresh-animate');
// 	
// 	jQuery('#table-lista-lecturas')
// // 	    .bootstrapTable('filterBy', {})
// 	    .bootstrapTable('filterBy', { allowEdit: true });
// 	    
// 	jQuery('#diagFiltrarDatos-modal').modal();
//     });
    
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var $windowHeight = jQuery(window).height() * 0.69;
var $boxBodyHeight = $windowHeight * 0.82;
	
jQuery(document).ready(function() {
    /** set icheck */
    $(document).find('form.simagd-form-custom-class')
        .find('input:checkbox, input:radio').iCheck({
            checkboxClass: 'icheckbox_minimal'/*-blue'*/,
            radioClass: 'iradio_minimal'/*-blue'*/,
    });
        
    /** set select2 */
    $(document).find('form.simagd-form-custom-class')
        .find('select').each(function () {
            jQuery(this).select2({
                placeholder: 'click para seleccionar...',
                allowClear: true,
                dropdownAutoWidth : true
            });
    });
    
    /** set icheck label right */
    $(document).find('form.simagd-form-custom-class')
        .find('input:checkbox').each(function(i) {
            var labelForCheck = $("label[for='" + jQuery(this).attr('id') + "']");
            var labelForCheckText = jQuery.trim(labelForCheck.text());

            if (labelForCheck.length) {

                jQuery(this).closest("div")
                    .after("<label class='control-label simagd-checkbox-label'>" + labelForCheckText + "</label>");

                labelForCheck.text('');
        }
    });
    
    /** delete empty li */
    $("ul.list-inline").find('li').each(function() {
	if (jQuery(this).html().trim() == "" || typeof(jQuery(this).html().trim()) == "undefined")
	{
	    jQuery(this).remove();
	}
    });

    /** modal body height */
//    $(document).on('show', "div[id$='FullData-showModalContainer'], div[id='simagd-modal-info-support']", function() {
    $(document).on('show', "div[id='simagd-modal-info-support']", function() {
        
        var $windowHeight = jQuery(window).height() * 0.58;
        
//    	jQuery(this).find('.panel-body').css({
//                                            'overflow-y': 'auto',
//                                            'height': $windowHeight,
//                                            'min-height': $windowHeight
//                                        });
        
    	jQuery(this).find('.modal-footer').css({
                                            'margin-top': '0px'
                                        });
    });

    /** modal bloques info tab-pane */
    var $windowHeightTabPane = jQuery(window).height() * 0.51;
    
    $("div[id='custom-entity-content-body']")
            .find('.tab-pane').css({
                'overflow-y': 'auto',
                'height': $windowHeightTabPane,
                'min-height': $windowHeightTabPane
            });

    /** modal bloques nav-tabs */
    $("ul.nav.nav-tabs.tabs-right")
            .closest("div").css({
                'overflow-y': 'auto',
                'height': $windowHeightTabPane,
                'min-height': $windowHeightTabPane
            });
    
    /** custom show-view tables-row */
    $(".simagd-show-view-row").find('th').addClass("col-md-3").wrapInner("<span class='simagd-show-view-text-primary'></span>");
    $(".simagd-show-view-row").find('td').addClass("col-md-9");
    
    /** div remove success style, add primary */
    $("div.box.box-success").removeClass('box-success').addClass("box-primary-v4");

    /** modal body height */
    $(document).on('show', ".simagd-full-form-container", function() {

	var $windowHeight = jQuery(window).height() * 0.69;
	var $boxBodyHeight = $windowHeight * 0.82;
        
//    	jQuery(this).find('.modal-body').css({
//                                            'overflow-y': 'auto',
////                                            'height': $windowHeight,
//                                            'min-height': $windowHeight
//                                        });
        
    	jQuery(this).find('.modal-footer').css({
                                            'margin-top': '0px'
                                        });
        
    	jQuery(this).find('.box-body').css({
                                            'min-height': $boxBodyHeight
                                        });
        
	/** filter modal content height */
        var $windowFilterModalHeight = jQuery(window).height() * 0.58;
        
//    	jQuery(this)
//	    .find('.simagd-filter-content-layout')
//	    .css({
//		'overflow-y': 'auto',
//		'height': $windowFilterModalHeight,
//		'min-height': $windowFilterModalHeight
//	    });
	
        
	/** show detail modal content height, for modal without panel inside */
        var $hwShAction = jQuery(window).height() * 0.645;
        
//    	jQuery(this)
//	    .find('.simagd-filter-content-layout')
//	    .css({
//		'overflow-y': 'auto',
//		'height': $hwShAction,
//		'min-height': $hwShAction
//	    });
    });

    /** modal body height */
    $(document).on('show', "div.simagd-full-data-view", function() {

	var $windowHeight = jQuery(window).height() * 0.69;
        
    	jQuery(this).find('.panel-body').css({
                                            'height': 'none',
//                                            'min-height': $windowHeight
                                        });
        
    	jQuery(this).find('.modal-footer').css({
                                            'margin-top': '0px'
                                        });
    });
    
    /** unbind disabled links click */
    $("li.disabled.link-full-disabled").find('a').off('click').on('click', function (e) {
	e.preventDefault();
    });
    
    /*
     * form input addon
     */
    jQuery('#simagd_entity_full_admin_form').find(':input[data-add-input-addon="true"]').each(function () {
        var $this           = jQuery(this);
        var $addonClass     = 'primary-v4';
        var $dataAttr_Class = $this.data('add-input-addon-class');
        if (typeof $dataAttr_Class !== "undefined" && $dataAttr_Class !== null && $dataAttr_Class !== "")
        {
            $addonClass = $dataAttr_Class;
        }
        $this
            .wrap('<div class="input-group ' + $addonClass + '"></div>');
        $this
            .before(function(i, html) {
                return [' ',
                        '<span class="input-group-addon">',
                            '<i class="' + $this.data("add-input-addon-addon") + '">',
                            '</i>',
                        '</span>'
                ].join('');
            });
    });
    
    /*
     * **************************************************************************
     * --| bootstrapSwitch(), bs Switch apply
     * **************************************************************************
     */
    var $els_bsswitch       = jQuery(':input[data-apply-bootstrap-switch="true"]');
    if ($els_bsswitch.length)
    {
        jQuery(window).resize();
        jQuery(':input[data-apply-bootstrap-switch="true"]').iCheck('destroy').bootstrapSwitch();
        jQuery('.chk-bsswitch-container').on('switchChange.bootstrapSwitch', function(e, state) {
            if ($is_objectAllowToSwitch !== false)
            {
                if (state !== false) // true | false
                {
                    jQuery('#switch_item_container_form').show('slide', {direction: 'right'}, 100, function() {
                        jQuery('#switch_item_container_history').hide('slide', {direction: 'left'}, 100);
                        jQuery(window).resize();
                    });
                }
                else
                {
                    jQuery('#switch_item_container_history').show('slide', {direction: 'right'}, 100, function() {
                        jQuery('#switch_item_container_form').hide('slide', {direction: 'left'}, 100);
                        jQuery(window).resize();
                    });
                }
            }
        });
    }
    
    /*
     * 
     * @param {type} $
     * @returns {undefined}
     */
    jQuery('a.sonata-action-element').find('i').wrap('<span class="text-info"></span>');
    
});

(function ($) {

    /*
     * PLUG-IN --| fv_resetValidationForm
     * @param {type} options
     * @returns {undefined}
     */
    $.fn.fv_resetValidationForm = function(options)
    {
	var $this               = jQuery(this),
            $data_id            = $this.attr('id'),
            $data_name          = $this.attr('name');
        var $resetFields;
    
        if (jQuery.isEmptyObject(options) === false
                && typeof options.resetFields !== "undefined" && options.resetFields !== null && options.resetFields !== "")
        {
            if (options.resetFields === true || options.resetFields === 'true')
            {
                $resetFields    = true;
            }
            else
            {
                $resetFields    = false;
            }
        }
	    
	/** --| reset FORMVALIDATION */
	$this.data('formValidation')
                .resetForm($resetFields);
	$this.find('a[data-toggle="pill"]')
                .parent()
                .find('i')
                        .removeClass('fa-check fa-times');
//        console.log($data_name, 'fv_resetValidationForm')
    };

    /*
     * PLUG-IN --| fv_resetFormInModal
     * @param {type} options
     * @returns {undefined}
     */
    $.fn.fv_resetFormInModal = function(options)
    {
	var $this       = jQuery(this),
            $data_id    = $this.attr('id'),
            $data_name  = $this.attr('name');
        
	/** --| reset FORMVALIDATION */
	$this.find('form').data('formValidation').resetForm();
	$this.find('.nav-pills a:first').tab('show');
	$this.find('a[data-toggle="pill"]')
                .parent()
                .find('i')
                        .removeClass('fa-check fa-times');
	$this
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    };

    /*
     * PLUG-IN --| fv_hideFormInModal
     * @param {type} options
     * @returns {undefined}
     */
    $.fn.fv_hideFormInModal = function(options)
    {
	var $this       = jQuery(this),
            $data_id    = $this.attr('id'),
            $data_name  = $this.attr('name');
        
	$this.find('form').find(':input').each(function () {
            if (typeof jQuery(this).attr('name') !== "undefined") {
                var $field  = jQuery(this);
                if ($field.is('input:text') || $field.attr('type') === 'hidden' || $field.is('textarea')) {
                    if ($field.hasClass('summernote')) {
                        $field.destroySummerNote();
                    }
                    $field.val('');
                }
                if ($field.is('select')) {
                    $field.select2('val', '');
                }
            }
        });
        
	/** --| reset FORMVALIDATION */
	$this.find('form').data('formValidation').resetForm();
	$this.find('.nav-pills a:first').tab('show');
	$this.find('a[data-toggle="pill"]')
                .parent()
                .find('i')
                        .removeClass('fa-check fa-times');
	$this
	    .find(':submit')
		.removeAttr('disabled')
		.removeClass('disabled');
    };

    /*
     * PLUG-IN --| fv_displayEditFormInModal
     * @param {type} options
     * @returns {undefined}
     */
    $.fn.fv_displayEditFormInModal = function(options)
    {
	var $this       = jQuery(this),
            $form       = $this.find('form'),
	    $object	= options.object,
            $data_id    = $this.attr('id'),
            $data_name  = $this.attr('name');
        
	$form.find(':input').each(function () {
           if (typeof jQuery(this).attr('name') !== "undefined") {
               var $field      = jQuery(this),
                   $default    = $field.data('default'),
                   $server     = $field.data('alias-from-server'),
                   $svdata     = $object[$server],
                   $sv_target  = $field.data('alias-from-server-collection-key');
                   console.log('$field', $field.attr('name'), '$default', $default, '$server', $server, '$svdata', $svdata, '$sv_target', $sv_target);
               if ($field.is('input:text') || $field.attr('type') === 'hidden' || $field.is('textarea')) {
                   if (typeof $svdata !== "undefined" && $svdata !== null && $svdata !== "") {
                       if ($field.hasClass('summernote')) {
                           $field.summernote('code', jQuery.trim($svdata));
                       } else {
                           $field.val(jQuery.trim($svdata));
                       }
		    } else {
		      $field.val('');
		    }
               }
               if ($field.is('select')) {
                   $field.find('option').prop('disabled', false);
                   if (!$field.is('[multiple]')) {
                       if (typeof $svdata !== "undefined" && $svdata !== null && $svdata !== "") {
                           $field.select2('val', $svdata);
                       } else {
			  $field.select2('val', '');
                       }
                   } else {
                       if (typeof $svdata !== "undefined" && $svdata !== null && jQuery.isEmptyObject($svdata) === false) {
			  var arr_collection_data = []; // create array here
			  $.each($svdata, function (i, $v) {
			      arr_collection_data.push($v[$sv_target]); //push values here
			  });
			  $field.select2('val', jQuery.unique(arr_collection_data));
			  console.log('arr_collection_data', arr_collection_data);
                       } else {
			  $field.select2('val', '');
                       }
                   }
               }
           }
       });
       
	$form.find(':input').each(function () {
	    if (typeof jQuery(this).attr('name') !== "undefined") {
		var $field      = jQuery(this),
		  $trigger    = $field.data('trigger-on-display');
	      if ($trigger === true || $trigger === 'true') {
		  $field.trigger('change', [true, false]);
		    console.log($field.attr('name'), '$trigger', $trigger);
	      }
           }
       });
        $this.fv_resetFormInModal();
        
        /*
	 * https://doctrine-orm.readthedocs.org/en/latest/reference/batch-processing.html
	 *
         * http://uploaded.net/file/dbjszv4x
	 * http://www.remediosdehoy.com/2015/11/como-eliminar-barriga-y-cintura-con.html
	 * http://www.remediosdehoy.com/2015/11/toma-esta-bebida-por-5-noches-antes-de.html
	 * http://www.remediosdehoy.com/2015/12/limpia-tu-higado-y-pierde-peso-en-72.html
         */
    };

    /*
     * PLUG-IN --| fv_displayEmptyFormInModal
     * @param {type} options
     * @returns {undefined}
     */
    $.fn.fv_displayEmptyFormInModal = function(options)
    {
    };

    /*
     * PLUG-IN --| fv_displayFullEntityInModal
     * @param {type} options
     * @returns {undefined}
     */
    $.fn.fv_displayFullEntityInModal = function(options)
    {
        var $this       = jQuery(this),
            $object_id  = options.id,
	    $object	= options.object,
	    $object_allow   = options.is_allow,
            $table      = $this.find('table'),
            $data_id    = $this.attr('id');
        
        $table.find('td, div').each(function () {
            if (typeof jQuery(this).data('render-text') !== "undefined")
            {
                var $column  = jQuery(this),
                    $text    = jQuery.trim($column.data('render-text')),
                    $method  = jQuery.trim($column.data('render-method')),
                    $result  = typeof window[$method] === 'function' ?
                                    window[$method]($object[$text], $object, $object_id) : false;
                $column.html($result !== false ? $result : $object[$text]);
            }
        });
    };

}(jQuery));

jQuery(function () {
    /*
     * PLUG-IN --| bootstrap tooltip
     * @returns {undefined}
     */
  jQuery('[data-toggle="tooltip"]').tooltip()
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Crea el efecto para avisos "alert"

/** Show after transaction is complete */
jQuery.fn.addFadeSlideEffect = function() {
    jQuery(this).alert()
	.fadeTo(3000, 500)
	.slideUp("slow");
};
    
/** Hide and show alerts */
var $success_bsAlert 	= null,
    $edited_bsAlert 	= null,
    $error_bsAlert 	= null,
    $warning_bsAlert 	= null;

jQuery(document).ready(function() {
    
    /** set DOM bs-alerts */
    $success_bsAlert 	= jQuery('#simagd-added-response-bs-alert');
    $edited_bsAlert 	= jQuery('#simagd-edited-response-bs-alert');
    $error_bsAlert 	= jQuery('#simagd-error-response-bs-alert');
    $warning_bsAlert 	= jQuery('#simagd-warning-response-bs-alert');
    
    /** Clone alerts */
    $success_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$success_bsAlert = $success_cloned.clone(true, true);
	$success_bsAlert.insertAfter(jQuery(this));
	console.log('clone success alert');
    });
    $edited_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$edited_bsAlert = $edited_cloned.clone(true, true);
	$edited_bsAlert.insertAfter(jQuery(this));
	console.log('clone edited alert');
    });
    $error_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$error_bsAlert = $error_cloned.clone(true, true);
	$error_bsAlert.insertAfter(jQuery(this));
	console.log('clone error alert');
    });
    $warning_bsAlert.on('closed.bs.alert', function () {
	// do something…
	$warning_bsAlert = $warning_cloned.clone(true, true);
	$warning_bsAlert.insertAfter(jQuery(this));
	console.log('clone warning alert');
    });
    var $success_cloned	= $success_bsAlert.clone(true, true),
	$edited_cloned 	= $edited_bsAlert.clone(true, true),
	$error_cloned 	= $error_bsAlert.clone(true, true),
	$warning_cloned	= $warning_bsAlert.clone(true, true);
    
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function ___actionLecturaSetterObjectModalData(lctId, $lctObject, allow_userOverData) {
    moment.locale('es');
    var $lctContent = $("#lecturaFullData-showModalContainer");

    $lctContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($lctObject.lct_radiologo, {data_id_empUser: $lctObject.lct_id_radiologo}, $lctObject.lct_id));
    $lctContent.find("[data-render-info='correlativo']")
	    .html(jQuery.trim($lctObject.lct_correlativo));
    $lctContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($lctObject.lct_tipoEmpleado));
    $lctContent.find("[data-render-info='fechaLectura']")
	    .html(simagdDateTimeFormatter($lctObject.lct_fechaLectura, $lctObject, $lctObject.lct_id));
    $lctContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($lctObject.lct_nombreUserReg) + ' <strong> (' + jQuery.trim($lctObject.lct_usernameUserReg) + ') </strong>', {data_id_user: $lctObject.lct_id_userReg}, $lctObject.lct_id));
    $lctContent.find("[data-render-info='idTipoResultado']")
	    .html(jQuery.trim($lctObject.lct_tipoResultado));
    $lctContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdEstabUserLoggedFormatter($lctObject.lct_solicitado, {data_id_estab: $lctObject.lct_id_solicitado}, $lctObject.lct_id));
    $lctContent.find("[data-render-info='indicaciones']")
	    .html(simagdDescriptionFormatter($lctObject.lct_indicaciones, $lctObject, $lctObject.lct_id));
    $lctContent.find("[data-render-info='lecturaRemota']")
	    .html(function() {
                var labelColor = $lctObject.lct_lecturaRemota === false ? 'primary' : 'info';
                var labelText = $lctObject.lct_lecturaRemota === false ? 'no' : 'sí';
                console.log($lctObject.lct_lecturaRemota, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $lctContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($lctObject.lct_observaciones, $lctObject, $lctObject.lct_id));
    $lctContent.find("[data-render-info='idEstadoLectura']")
	    .html(simagdEstadoLecturaFormatter($lctObject.lct_estado, $lctObject, $lctObject.lct_id));
    $lctContent.find("[data-render-info='solicitadaPorRadiologo']")
	    .html(function() {
                var labelColor = $lctObject.lct_solicitadaPorRadiologo === false ? 'primary' : 'info';
                var labelText = $lctObject.lct_solicitadaPorRadiologo === false ? 'no' : 'sí';
                console.log($lctObject.lct_solicitadaPorRadiologo, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $lctContent.find("[data-render-info='idRadiologoDesignadoAprobacion']")
	    .html(jQuery.isEmptyObject($lctObject.lct_radiologoVal) === false ? simagdEmpleadoUserLoggedFormatter($lctObject.lct_radiologoVal, {data_id_empUser: $lctObject.lct_id_radiologoVal}, $lctObject.lct_id) : '');
    $lctContent.find("[data-render-info='idRadiologoSolicita']")
	    .html(jQuery.isEmptyObject($lctObject.lct_radiologoSol) === false ? simagdEmpleadoUserLoggedFormatter($lctObject.lct_radiologoSol, {data_id_empUser: $lctObject.lct_id_radiologoSol}, $lctObject.lct_id) : '');
}

function ___actionDiagnosticoSetterObjectModalData(diagId, $diagObject, allow_userOverData) {
    moment.locale('es');
    var $diagContent = $("#diagnosticoFullData-showModalContainer");

    $diagContent.find("[data-render-info='hallazgos']")
	    .html(simagdDescriptionAdvanceFormatter($diagObject.diag_hallazgos, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='conclusion']")
	    .html(simagdDescriptionAdvanceFormatter($diagObject.diag_conclusion, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='recomendaciones']")
	    .html(simagdDescriptionAdvanceFormatter($diagObject.diag_recomendaciones, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='errores']")
	    .html(simagdDescriptionFormatter($diagObject.diag_errores, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($diagObject.diag_transcriptor, {data_id_empUser: $diagObject.diag_id_transcriptor}, $diagObject.diag_id));
    $diagContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($diagObject.diag_nombreUserReg) + ' <strong> (' + jQuery.trim($diagObject.diag_usernameUserReg) + ') </strong>', {data_id_user: $diagObject.diag_id_userReg}, $diagObject.diag_id));
    $diagContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($diagObject.diag_tipoEmpleado));
    $diagContent.find("[data-render-info='idUserMod']")
	    .html(jQuery.isEmptyObject($diagObject.diag_nombreUserMod) === false ?
                        simagdEmpleadoUserLoggedFormatter(jQuery.trim($diagObject.diag_nombreUserMod) + ' <strong> (' + jQuery.trim($diagObject.diag_usernameUserMod) + ') </strong>', {data_id_user: $diagObject.diag_id_userMod}, $diagObject.diag_id) : ''
           );
    $diagContent.find("[data-render-info='idEstadoDiagnostico']")
	    .html(simagdEstadoDiagnosticoFormatter($diagObject.diag_estado, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='incidencias']")
	    .html(simagdDescriptionFormatter($diagObject.diag_incidencias, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='fechaTranscrito']")
	    .html(simagdDateTimeFormatter($diagObject.diag_fechaTranscrito, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($diagObject.diag_observaciones, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='fechaAprobado']")
	    .html(simagdDateTimeFormatter($diagObject.diag_fechaAprobado, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='fechaCorregido']")
	    .html(simagdDateTimeFormatter($diagObject.diag_fechaCorregido, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='idRadiologoDesignadoAprobacion']")
	    .html(jQuery.isEmptyObject($diagObject.lct_radiologoVal) === false ? simagdEmpleadoUserLoggedFormatter($diagObject.lct_radiologoVal, {data_id_empUser: $diagObject.lct_id_radiologoVal}, $diagObject.diag_id) : '');
    $diagContent.find("[data-render-info='idRadiologoAprueba']")
	    .html(jQuery.isEmptyObject($diagObject.diag_radiologoVal) === false ? simagdEmpleadoUserLoggedFormatter($diagObject.diag_radiologoVal, {data_id_empUser: $diagObject.diag_id_radiologoVal}, $diagObject.diag_id) : '');
}

function ___actionSolicitudEstudioComplementarioSetterObjectModalData(solcmplId, $solcmplObject, allow_userOverData) {
    moment.locale('es');
    var $solcmplContent = $("#solicitudEstudioComplementarioFullData-showModalContainer");
    
    $solcmplContent.find("[data-render-info='idRadiologoSolicita']")
	    .html(simagdEmpleadoUserLoggedFormatter($solcmplObject.solcmpl_solicitante, {data_id_empUser: $solcmplObject.solcmpl_id_solicitante}, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='fechaSolicitud']")
	    .html(simagdDateTimeFormatter($solcmplObject.solcmpl_fechaSolicitud, $solcmplObject, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($solcmplObject.solcmpl_tipoEmpleado));
    $solcmplContent.find("[data-render-info='justificacion']")
	    .html(simagdDescriptionFormatter($solcmplObject.solcmpl_justificacion, $solcmplObject, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='idEstablecimientoSolicitado']")
	    .html(simagdEstabUserLoggedFormatter($solcmplObject.solcmpl_solicitado, {data_id_estab: $solcmplObject.solcmpl_id_solicitado}, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='idPrioridadAtencion']")
	    .html(jQuery.isEmptyObject($solcmplObject.prAtn_nombre) === false ? simagdPrioridadAtencionFormatter($solcmplObject.prAtn_nombre, $solcmplObject, $solcmplObject.solcmpl_id) : '');
    $solcmplContent.find("[data-render-info='idAreaServicioDiagnostico']")
	    .html(jQuery.trim($solcmplObject.solcmpl_modalidad));
    $solcmplContent.find("[data-render-info='solicitudEstudioComplementarioProyeccion']")
	    .html(function() {
		var $arr_result = ['<ul>'];
		
		$.each($solcmplObject.solcmpl_solicitudEstudioComplementarioProyeccion, function(i, y) {
		    $arr_result.push('<li>', '<strong><span class="text-info">', jQuery.trim(y.expl_codigo) + '</span></strong> ' + jQuery.trim(y.expl_nombre), '</li>');
		});
		
		$arr_result.push('</ul>');

                return $arr_result.join('');
            });
    $solcmplContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($solcmplObject.solcmpl_nombreUserReg) + ' <strong> (' + jQuery.trim($solcmplObject.solcmpl_usernameUserReg) + ') </strong>', {data_id_user: $solcmplObject.solcmpl_id_userReg}, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='idEstudioPadre']")
	    .html(function() {
                var estudioUrl = jQuery.trim($solcmplObject.est_url) || 'javascript:void(0)';/* Validar que exista idEstudio isEmptyObject */
                var allowDownload = allow_userOverData.allowDownloadEstudio === false ? ' disabled="disabled"' : '';
                console.log($solcmplObject.est_id, estudioUrl, allowDownload);
                return '<a   title="Recuperar estudio de servidor PACS" target="_blank" class="btn btn-primary-v4 btn-outline btn-sm" href="'
                            + estudioUrl + '"' + allowDownload + '> <i class="fa fa-eye"></i> Recuperar</a>';
            });
}

function ___actionPreinscripcionSetterObjectModalData(prcId, $prcObject, allow_userOverData) {
    moment.locale('es');
    var $prcContent = $("#preinscripcionFullData-showModalContainer");

    $prcContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdOrigenFormatter($prcObject.prc_origen, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='numeroSala']")
	    .html(jQuery.trim($prcObject.prc_numeroSala));
    $prcContent.find("[data-render-info='idAreaAtencion']")
	    .html(simagdAreaAtencionFormatter($prcObject.prc_areaAtencion, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='numeroCama']")
	    .html(jQuery.trim($prcObject.prc_numeroCama));
    $prcContent.find("[data-render-info='idAtencion']")
	    .html(jQuery.trim($prcObject.prc_atencion));
    $prcContent.find("[data-render-info='pacienteDesconocido']")
	    .html(function() {
                var labelColor = $prcObject.prc_pacienteDesconocido === false ? 'primary' : 'warning';
                var labelText = $prcObject.prc_pacienteDesconocido === false ? 'no' : 'sí';
                console.log($prcObject.prc_pacienteDesconocido, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($prcObject.prc_empleado, {data_id_empUser: $prcObject.prc_id_empleado}, $prcObject.prc_id));
    $prcContent.find("[data-render-info='pesoActualLb']")
	    .html(jQuery.trim($prcObject.prc_pesoActualLb));
    $prcContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($prcObject.prc_tipoEmpleado));
    $prcContent.find("[data-render-info='pesoActualKg']")
	    .html(jQuery.trim($prcObject.prc_pesoActualKg));
    $prcContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($prcObject.prc_nombreUserReg) + ' <strong> (' + jQuery.trim($prcObject.prc_usernameUserReg) + ') </strong>', {data_id_user: $prcObject.prc_id_userReg}, $prcObject.prc_id));
    $prcContent.find("[data-render-info='tallaPaciente']")
	    .html(jQuery.trim($prcObject.prc_tallaPaciente));
    $prcContent.find("[data-render-info='idUserMod']")
	    .html(jQuery.isEmptyObject($prcObject.prc_nombreUserMod) === false ?
                    simagdEmpleadoUserLoggedFormatter(jQuery.trim($prcObject.prc_nombreUserMod) + ' <strong> (' + jQuery.trim($prcObject.prc_usernameUserMod) + ') </strong>', {data_id_user: $prcObject.prc_id_userMod}, $prcObject.prc_id)
                        : ''
           );
    $prcContent.find("[data-render-info='referirPaciente']")
	    .html(function() {
                var labelColor = $prcObject.prc_referirPaciente === false ? 'primary' : 'info';
                var labelText = $prcObject.prc_referirPaciente === false ? 'no' : 'sí';
                console.log($prcObject.prc_referirPaciente, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='consultaPor']")
	    .html(simagdDescriptionFormatter($prcObject.prc_consultaPor, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idEstablecimientoReferido']")
	    .html(simagdReferidoFormatter($prcObject.prc_referido, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='estadoClinico']")
	    .html(simagdDescriptionFormatter($prcObject.prc_estadoClinico, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='justificacionReferencia']")
	    .html(simagdDescriptionFormatter($prcObject.prc_justificacionReferencia, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='datosClinicos']")
	    .html(simagdDescriptionFormatter($prcObject.prc_datosClinicos, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idAreaServicioDiagnostico']")
	    .html(jQuery.trim($prcObject.prc_modalidad));
    $prcContent.find("[data-render-info='solicitudEstudioProyeccion']")
	    .html(function() {
		var $arr_result = ['<ul>'];
		
		$.each($prcObject.prc_solicitudEstudioProyeccion, function(i, y) {
		    $arr_result.push('<li>', '<strong><span class="text-info">', jQuery.trim(y.expl_codigo) + '</span></strong> ' + jQuery.trim(y.expl_nombre), '</li>');
		});
		
		$arr_result.push('</ul>');

                return $arr_result.join('');
            });
    $prcContent.find("[data-render-info='hipotesisDiagnostica']")
	    .html(simagdDescriptionFormatter($prcObject.prc_hipotesisDiagnostica, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idPrioridadAtencion']")
	    .html(jQuery.isEmptyObject($prcObject.prAtn_nombre) === false ? simagdPrioridadAtencionFormatter($prcObject.prAtn_nombre, $prcObject, $prcObject.prc_id) : '');
    $prcContent.find("[data-render-info='investigando']")
	    .html(simagdDescriptionFormatter($prcObject.prc_investigar, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='fechaProximaConsulta']")
	    .html(simagdDateFormatter($prcObject.prc_fechaProximaConsulta, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='justificacionMedica']")
	    .html(simagdDescriptionFormatter($prcObject.prc_justificacionMedica, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='requiereCita']")
	    .html(function() {
                var labelColor = $prcObject.prc_requiereCita === false ? 'success' : 'primary';
                var labelText = $prcObject.prc_requiereCita === false ? 'no' : 'sí';
                console.log($prcObject.prc_requiereCita, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='antecedentesClinicosRelevantes']")
	    .html(simagdDescriptionAdvanceFormatter($prcObject.prc_antecedentesClinicosRelevantes, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='requiereDiagnostico']")
	    .html(function() {
                var labelColor = $prcObject.prc_requiereDiagnostico === false ? 'warning' : 'success';
                var labelText = $prcObject.prc_requiereDiagnostico === false ? 'no' : 'sí';
                console.log($prcObject.prc_requiereDiagnostico, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='fechaCreacion']")
	    .html(simagdDateTimeFormatter($prcObject.prc_fechaCreacion, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idEstablecimientoDiagnosticante']")
	    .html(jQuery.isEmptyObject($prcObject.prc_diagnosticante) === false ? simagdDiagnosticanteFormatter($prcObject.prc_diagnosticante, $prcObject, $prcObject.prc_id) : '');
    $prcContent.find("[data-render-info='pacienteAmbulatorio']")
	    .html(function() {
                var labelColor = $prcObject.prc_pacienteAmbulatorio === false ? 'primary' : 'info';
                var labelText = $prcObject.prc_pacienteAmbulatorio === false ? 'no' : 'sí';
                console.log($prcObject.prc_pacienteAmbulatorio, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='justificacionDiagnostico']")
	    .html(simagdDescriptionFormatter($prcObject.prc_justificacionDiagnostico, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idContactoPaciente']")
	    .html(jQuery.isEmptyObject($prcObject.prc_contactoPaciente) === false ? jQuery.trim($prcObject.prc_contactoPaciente) : '');
    $prcContent.find("[data-render-info='idFormaContacto']")
	    .html(jQuery.isEmptyObject($prcObject.prc_formaContacto) === false ? jQuery.trim($prcObject.prc_formaContacto) : '');
    $prcContent.find("[data-render-info='nombreContacto']")
	    .html(jQuery.trim($prcObject.prc_nombreContacto));
    $prcContent.find("[data-render-info='contacto']")
	    .html(jQuery.trim($prcObject.prc_contacto));
}

function ___actionCitaSetterObjectModalData(citId, $citObject, allow_userOverData) {
    moment.locale('es');
    var $citContent = $("#citaFullData-showModalContainer");
    
    $citContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($citObject.cit_empleado, {data_id_empUser: $citObject.cit_id_empleado}, $citObject.cit_id));
    $citContent.find("[data-render-info='idUserPrg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($citObject.cit_nombreUserReg) + ' <strong> (' + jQuery.trim($citObject.cit_usernameUserReg) + ') </strong>', {data_id_user: $citObject.cit_id_userReg}, $citObject.cit_id));
    $citContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($citObject.cit_tipoEmpleado));
    $citContent.find("[data-render-info='idUserReprg']")
	    .html(jQuery.isEmptyObject($citObject.cit_nombreUserMod) === false ?
                        simagdEmpleadoUserLoggedFormatter(jQuery.trim($citObject.cit_nombreUserMod) + ' <strong> (' + jQuery.trim($citObject.cit_usernameUserMod) + ') </strong>', {data_id_user: $citObject.cit_id_userMod}, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdEstabUserLoggedFormatter($citObject.cit_establecimiento, {data_id_estab: $citObject.cit_id_establecimiento}, $citObject.cit_id));
    $citContent.find("[data-render-info='idTecnologoProgramado']")
	    .html(jQuery.isEmptyObject($citObject.cit_tecnologo) === false ? simagdEmpleadoUserLoggedFormatter($citObject.cit_tecnologo, {data_id_empUser: $citObject.cit_id_tecnologo}, $citObject.cit_id) : '');
    $citContent.find("[data-render-info='fechaCreacion']")
	    .html(simagdDateTimeFormatter($citObject.cit_fechaCreacion, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='incidencias']")
	    .html(simagdDescriptionFormatter($citObject.cit_incidencias, $citObject, $citObject.cit_id));
//     $citContent.find("[data-render-info='fechaProgramada']")
// 	    .html(moment(jQuery.trim($citObject.cit_fechaProgramada), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A"));
    $citContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($citObject.cit_observaciones, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='idEstadoCita']")
	    .html(simagdEstadoCitaFormatter($citObject.cit_estado, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='razonAnulada']")
	    .html(simagdDescriptionFormatter($citObject.cit_razonAnulada, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='fechaConfirmacion']")
	    .html(jQuery.isEmptyObject($citObject.cit_fechaConfirmacion) === false ?
                        simagdDateTimeFormatter($citObject.cit_fechaConfirmacion, $citObject, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='necesitaAutorizacion']")
	    .html(function() {
                var labelColor = $citObject.cit_necesitaAutorizacion === false ? 'primary-v4' : 'warning';
                var labelText = $citObject.cit_necesitaAutorizacion === false ? 'no' : 'sí';
                console.log($citObject.cit_necesitaAutorizacion, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $citContent.find("[data-render-info='reprogramada']")
	    .html(function() {
                var labelColor = $citObject.cit_reprogramada === false ? 'primary-v4' : 'warning';
                var labelText = $citObject.cit_reprogramada === false ? 'no' : 'sí';
                console.log($citObject.cit_reprogramada, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $citContent.find("[data-render-info='citaAutorizada']")
	    .html(function() {
                var labelColor = $citObject.cit_citaAutorizada === false ? 'warning' : 'success-v3';
                var labelText = $citObject.cit_citaAutorizada === false ? 'no' : 'sí';
                console.log($citObject.cit_citaAutorizada, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
//     $citContent.find("[data-render-info='fechaProgramadaAnterior']")
// 	    .html(jQuery.isEmptyObject($citObject.cit_fechaProgramadaAnterior) === false ?
//                         moment(jQuery.trim($citObject.cit_fechaProgramadaAnterior), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A") : ''
//            );
    $citContent.find("[data-render-info='idResponsableAutoriza']")
	    .html(jQuery.isEmptyObject($citObject.cit_responsable) === false ? jQuery.trim($citObject.cit_responsable) : '');
    $citContent.find("[data-render-info='fechaReprogramacion']")
	    .html(jQuery.isEmptyObject($citObject.cit_fechaReprogramacion) === false ?
                        simagdDateTimeFormatter($citObject.cit_fechaReprogramacion, $citObject, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='nombreResponsableAutoriza']")
	    .html(jQuery.trim($citObject.cit_nombreResponsableAutoriza));
    $citContent.find("[data-render-info='fechaHoraInicio']")
	    .html(simagdDateTimeFormatter($citObject.cit_fechaHoraInicio, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='fechaHoraInicioAnterior']")
	    .html(jQuery.isEmptyObject($citObject.cit_fechaHoraInicioAnterior) === false ?
                        simagdDateTimeFormatter($citObject.cit_fechaHoraInicioAnterior, $citObject, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='fechaHoraFin']")
	    .html(simagdDateTimeFormatter($citObject.cit_fechaHoraFin, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='fechaHoraFinAnterior']")
	    .html(jQuery.isEmptyObject($citObject.cit_fechaHoraFinAnterior) === false ?
                        simagdDateTimeFormatter($citObject.cit_fechaHoraFinAnterior, $citObject, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='diaCompleto']")
	    .html(function() {
                var labelColor = $citObject.cit_diaCompleto === false ? 'success-v3' : 'warning';
                var labelText = $citObject.cit_diaCompleto === false ? 'no' : 'sí';
                console.log($citObject.cit_diaCompleto, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $citContent.find("[data-render-info='color']")
	    .html(function() {
                var divColor = jQuery.trim($citObject.cit_color);
                console.log($citObject.cit_color, divColor);
                return '<div class="bloqueo-div-color" title="Color de fondo: ' + divColor + '" style="background-color: ' + divColor + '"> &nbsp; </div>';
            });
}

function ___actionProcedimientoRealizadoSetterObjectModalData(przId, $przObject, allow_userOverData) {
    moment.locale('es');
    var $przContent = $("#procedimientoRealizadoFullData-showModalContainer");

    $przContent.find("[data-render-info='origenSolicitud']")
	    .html(simagdTipoEstudioFormatter($przObject.solcmpl_id, $przObject, $przObject.prz_id));

    $przContent.find("[data-render-info='idCitaProgramada']")
	    .html(function() {
                var labelColor = jQuery.isEmptyObject($przObject.cit_id) === false ? 'primary' : 'info';
                var labelText = jQuery.isEmptyObject($przObject.cit_id) === false ? 'no' : 'sí';
                console.log(jQuery.isEmptyObject($przObject.cit_id), labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $przContent.find("[data-render-info='equipoUtilizado']")
	    .html(simagdDescriptionFormatter($przObject.prz_equipoUtilizado, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='idTecnologoProgramado']")
	    .html(jQuery.isEmptyObject($przObject.cit_id) === false && jQuery.isEmptyObject($przObject.cit_tecnologo) === false ? simagdEmpleadoUserLoggedFormatter($przObject.cit_tecnologo, {data_id_empUser: $przObject.cit_id_tecnologo}, $przObject.prz_id) : '');
    $przContent.find("[data-render-info='idTecnologoRealiza']")
	    .html(simagdEmpleadoUserLoggedFormatter($przObject.prz_tecnologo, {data_id_empUser: $przObject.prz_id_tecnologo}, $przObject.prz_id));
    $przContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($przObject.prz_tipoEmpleado));
    $przContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($przObject.prz_nombreUserReg) + ' <strong> (' + jQuery.trim($przObject.prz_usernameUserReg) + ') </strong>', {data_id_user: $przObject.prz_id_userReg}, $przObject.prz_id));
    $przContent.find("[data-render-info='hipotesisDiagnostica']")
	    .html(simagdDescriptionFormatter($przObject.prz_hipotesisDiagnostica, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='idUserMod']")
	    .html(jQuery.isEmptyObject($przObject.prz_nombreUserMod) === false ?
                        simagdEmpleadoUserLoggedFormatter(jQuery.trim($przObject.prz_nombreUserMod) + ' <strong> (' + jQuery.trim($przObject.prz_usernameUserMod) + ') </strong>', {data_id_user: $przObject.prz_id_userMod}, $przObject.prz_id) : ''
           );
    $przContent.find("[data-render-info='incidencias']")
	    .html(simagdDescriptionFormatter($przObject.prz_incidencias, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='idEstadoProcedimientoRealizado']")
	    .html(simagdEstadoEstudioFormatter($przObject.prz_estado, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='fechaNacimientoIndeterminada']")
	    .html(function() {
                var labelColor = $przObject.prz_fechaNacimientoIndeterminada === false ? 'primary' : 'danger';
                var labelText = $przObject.prz_fechaNacimientoIndeterminada === false ? 'no' : 'sí';
                console.log($przObject.prz_fechaNacimientoIndeterminada, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $przContent.find("[data-render-info='fechaRegistro']")
	    .html(simagdDateTimeFormatter($przObject.prz_fechaRegistro, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='fechaAtendido']")
	    .html(jQuery.isEmptyObject($przObject.prz_fechaAtendido) === false ?
                        simagdDateTimeFormatter($przObject.prz_fechaAtendido, $przObject, $przObject.prz_id) : ''
           );
    $przContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($przObject.prz_observaciones, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='fechaRealizado']")
	    .html(jQuery.isEmptyObject($przObject.prz_fechaRealizado) === false ?
                        simagdDateTimeFormatter($przObject.prz_fechaRealizado, $przObject, $przObject.prz_id) : ''
           );
    $przContent.find("[data-render-info='fechaProcesado']")
	    .html(jQuery.isEmptyObject($przObject.prz_fechaProcesado) === false ?
                        simagdDateTimeFormatter($przObject.prz_fechaProcesado, $przObject, $przObject.prz_id) : ''
           );
    $przContent.find("[data-render-info='salaRealizado']")
	    .html(jQuery.trim($przObject.prz_salaRealizado));
    $przContent.find("[data-render-info='fechaAlmacenado']")
	    .html(jQuery.isEmptyObject($przObject.prz_fechaAlmacenado) === false ?
                        simagdDateTimeFormatter($przObject.prz_fechaAlmacenado, $przObject, $przObject.prz_id) : ''
           );
}

function ___actionSolicitudDiagnosticoSetterObjectModalData(soldiagId, $soldiagObject, allow_userOverData) {
    moment.locale('es');
    var $soldiagContent = $("#solicitudDiagnosticoFullData-showModalContainer");

    $soldiagContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($soldiagObject.soldiag_solicitante, {data_id_empUser: $soldiagObject.soldiag_id_solicitante}, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='fechaCreacion']")
	    .html(simagdDateTimeFormatter($soldiagObject.soldiag_fechaCreacion, $soldiagObject, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($soldiagObject.soldiag_tipoEmpleado));
    $soldiagContent.find("[data-render-info='justificacion']")
	    .html(simagdDescriptionFormatter($soldiagObject.soldiag_justificacion, $soldiagObject, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($soldiagObject.soldiag_nombreUserReg) + ' <strong> (' + jQuery.trim($soldiagObject.soldiag_usernameUserReg) + ') </strong>', {data_id_user: $soldiagObject.soldiag_id_userReg}, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='fechaProximaConsulta']")
	    .html(simagdDateFormatter($soldiagObject.soldiag_fechaProximaConsulta, $soldiagObject, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='solicitudRemota']")
	    .html(function() {
                var labelColor = $soldiagObject.soldiag_solicitudRemota === false ? 'primary' : 'info';
                var labelText = $soldiagObject.soldiag_solicitudRemota === false ? 'no' : 'sí';
                console.log($soldiagObject.soldiag_solicitudRemota, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $soldiagContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($soldiagObject.soldiag_observaciones, $soldiagObject, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='idEstablecimientoSolicitado']")
	    .html(simagdEstabUserLoggedFormatter($soldiagObject.soldiag_solicitado, {data_id_estab: $soldiagObject.soldiag_id_solicitado}, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='idEstudio']")
	    .html(function() {
                var estudioUrl = jQuery.trim($soldiagObject.est_url) || 'javascript:void(0)';/* Validar que exista idEstudio isEmptyObject */
                var allowDownload = allow_userOverData.allowDownloadEstudio === false ? ' disabled="disabled"' : '';
                console.log($soldiagObject.est_id, estudioUrl, allowDownload);
                return '<a   title="Recuperar estudio de servidor PACS" target="_blank" class="btn btn-primary-v4 btn-outline btn-sm" href="'
                            + estudioUrl + '"' + allowDownload + '> <i class="fa fa-eye"></i> Recuperar</a>';
            });
}

function ___actionNotaDiagnosticoSetterObjectModalData(notdiagId, $notdiagObject, allow_userOverData) {
    moment.locale('es');
    var $notdiagContent = $("#contenidoFullData-showModalContainer");

    $notdiagContent.find("[data-render-info='contenido']")
	    .html(simagdDescriptionAdvanceFormatter($notdiagObject.notdiag_contenido, $notdiagObject, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($notdiagObject.notdiag_emisorNota, {data_id_empUser: $notdiagObject.notdiag_id_emisorNota}, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($notdiagObject.notdiag_nombreUserReg) + ' <strong> (' + jQuery.trim($notdiagObject.notdiag_usernameUserReg) + ') </strong>', {data_id_user: $notdiagObject.notdiag_id_userReg}, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($notdiagObject.notdiag_tipoEmpleado));
    $notdiagContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdEstabUserLoggedFormatter($notdiagObject.notdiag_stdEmisor, {data_id_estab: $notdiagObject.notdiag_id_stdEmisor}, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='idTipoNotaDiagnostico']")
	    .html(jQuery.trim($notdiagObject.notdiag_tipoNota));
    $notdiagContent.find("[data-render-info='fechaEmision']")
	    .html(simagdDateTimeFormatter($notdiagObject.notdiag_fechaEmision, $notdiagObject, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($notdiagObject.notdiag_observaciones, $notdiagObject, $notdiagObject.notdiag_id));
}

function ___actionBloqueoAgendaSetterObjectModalData(blAgdId, $blAgdObject, allow_userOverData) {
    moment.locale('es');
    var $blAgdContent = $("#bloqueoAgendaFullData-showModalContainer");
    
    $blAgdContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdEstabUserLoggedFormatter($blAgdObject.blAgd_establecimiento, {data_id_estab: $blAgdObject.blAgd_id_establecimiento}, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='idEmpleadoRegistra']")
	    .html(simagdEmpleadoUserLoggedFormatter($blAgdObject.blAgd_empleado, {data_id_empUser: $blAgdObject.blAgd_id_empleado}, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($blAgdObject.blAgd_nombreUserReg) + ' <strong> (' + jQuery.trim($blAgdObject.blAgd_usernameUserReg) + ') </strong>', {data_id_user: $blAgdObject.blAgd_id_userReg}, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='idUserMod']")
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_nombreUserMod) === false ?
                        simagdEmpleadoUserLoggedFormatter(jQuery.trim($blAgdObject.blAgd_nombreUserMod) + ' <strong> (' + jQuery.trim($blAgdObject.blAgd_usernameUserMod) + ') </strong>', {data_id_user: $blAgdObject.blAgd_id_userMod}, $blAgdObject.blAgd_id) : ''
           );
    $blAgdContent.find("[data-render-info='titulo']")
	    .html(jQuery.trim($blAgdObject.blAgd_titulo));
    $blAgdContent.find("[data-render-info='fechaCreacion']")
	    .html(simagdDateTimeFormatter($blAgdObject.blAgd_fechaCreacion, $blAgdObject, $blAgdObject.blAgd_id));
    /* Al momento de crear o editar en controller una cita o bloqueo, si el color va null, no setear para que tome el default */
    $blAgdContent.find("[data-render-info='color']")
	    .html(function() {
                var divColor = jQuery.trim($blAgdObject.blAgd_color);
                console.log($blAgdObject.blAgd_color, divColor);
                return '<div class="bloqueo-div-color" title="Color de fondo: ' + divColor + '" style="background-color: ' + divColor + '"> &nbsp; </div>';
            });
    $blAgdContent.find("[data-render-info='fechaUltimaEdicion']")
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_fechaUltimaEdicion) === false ?
                        simagdDateTimeFormatter($blAgdObject.blAgd_fechaUltimaEdicion, $blAgdObject, $blAgdObject.blAgd_id) : ''
           );
    $blAgdContent.find("[data-render-info='fechaInicio']")
	    .html(simagdDateFormatter($blAgdObject.blAgd_fechaInicio, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='horaInicio']")
	    .html(simagdTimeFormatter($blAgdObject.blAgd_horaInicio, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='fechaFin']")
	    .html(simagdDateFormatter($blAgdObject.blAgd_fechaFin, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='horaFin']")
	    .html(simagdTimeFormatter($blAgdObject.blAgd_horaFin, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='diaCompleto']")
	    .html(function() {
                var labelColor = $blAgdObject.blAgd_diaCompleto === false ? 'success-v3' : 'warning';
                var labelText = $blAgdObject.blAgd_diaCompleto === false ? 'no' : 'sí';
                console.log($blAgdObject.blAgd_diaCompleto, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $blAgdContent.find("[data-render-info='descripcion']")
	    .html(simagdDescriptionFormatter($blAgdObject.blAgd_descripcion, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='idRadiologoBloqueo']")
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_radiologo) === false ? simagdEmpleadoUserLoggedFormatter($blAgdObject.blAgd_radiologo, {data_id_empUser: $blAgdObject.blAgd_id_radiologo}, $blAgdObject.blAgd_id) : '');
    $blAgdContent.find("[data-render-info='idAreaServicioDiagnostico']")
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_modalidad) === false ? jQuery.trim($blAgdObject.blAgd_modalidad) : '');
    /* Falta el tipo empleado en twig */
    $blAgdContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($blAgdObject.blAgd_tipoEmpleado));
}

function ___actionPacienteSetterObjectModalData(pctId, $expObject, $pctObject, allow_userOverData) {
    moment.locale('es');
    var $pctContent = $("#pacienteFullData-showModalContainer");
    var isEmptyExp = jQuery.isEmptyObject($expObject);
    
    $pctContent.find("[data-render-info='numero']")
	    .html(isEmptyExp === false ? jQuery.trim($expObject.numero) : '');
    $pctContent.find("[data-render-info='nombrePadre']")
	    .html(jQuery.trim($pctObject.nombrePadre));
    $pctContent.find("[data-render-info='habilitado']")
	    .html(function() {
                var spanExp = '';
                if (isEmptyExp === false) {
		    var labelColor = $expObject.habilitado === false ? 'danger' : 'primary';
		    var labelText = $expObject.habilitado === false ? 'no' : 'sí';
		    var spanExp = '<span class="label label-' + labelColor + '">' + labelText + '</span>'; 
		    console.log($expObject.habilitado, labelColor, labelText);
                }
                console.log(spanExp);
                return spanExp;
            });
    $pctContent.find("[data-render-info='nombreMadre']")
	    .html(jQuery.trim($pctObject.nombreMadre));
    $pctContent.find("[data-render-info='fechaCreacion']")
	    .html(function() {
		var fechaHoraCreacionExp = jQuery.trim($expObject.fechaCreacion + ' ' + $expObject.horaCreacion);
                console.log('fechaHoraCreacionExp: ' + fechaHoraCreacionExp);
                return isEmptyExp === false && fechaHoraCreacionExp ?
                        moment(fechaHoraCreacionExp, "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A")
			  : '';
            });
    $pctContent.find("[data-render-info='nombreResponsable']")
	    .html(jQuery.trim($pctObject.nombreResponsable));
    $pctContent.find("[data-render-info='nombre']")
	    .html(jQuery.trim($pctObject.nombre));
    $pctContent.find("[data-render-info='fechaRegistro']")
	    .html(jQuery.isEmptyObject($pctObject.fechaRegistro) === false ?
                        moment(jQuery.trim($pctObject.fechaRegistro.date), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A") : ''
           );
    $pctContent.find("[data-render-info='fechaNacimiento']")
	    .html(jQuery.isEmptyObject($pctObject.fechaNacimiento) === false ?
                        moment(jQuery.trim($pctObject.fechaNacimiento.date + ' ' + $pctObject.horaNacimiento.date), "YYYY-MM-DD HH:mm:ss")
			    .format("dddd, MMMM D YYYY, h:mm:ss A") : ''
           );
    $pctContent.find("[data-render-info='idOcupacion']")
	    .html(jQuery.isEmptyObject($pctObject.idOcupacion) === false ? jQuery.trim($pctObject.idOcupacion.nombre) : '');
    $pctContent.find("[data-render-info='numeroDocIdePaciente']")
	    .html(jQuery.trim($pctObject.numeroDocIdePaciente));
    $pctContent.find("[data-render-info='idNacionalidad']")
	    .html(jQuery.isEmptyObject($pctObject.idNacionalidad) === false ? jQuery.trim($pctObject.idNacionalidad.nacionalidad) : '');
    $pctContent.find("[data-render-info='direccion']")
	    .html(jQuery.trim($pctObject.direccion));
    $pctContent.find("[data-render-info='idParentescoResponsable']")
	    .html(jQuery.isEmptyObject($pctObject.idParentescoResponsable) === false ? jQuery.trim($pctObject.idParentescoResponsable.parentesco) : '');
    $pctContent.find("[data-render-info='telefonoCasa']")
	    .html(jQuery.trim($pctObject.telefonoCasa));
    $pctContent.find("[data-render-info='idSexo']")
	    .html(jQuery.isEmptyObject($pctObject.idSexo) === false ? jQuery.trim($pctObject.idSexo.nombre) : 'No definido');
    $pctContent.find("[data-render-info='lugarTrabajo']")
	    .html(jQuery.trim($pctObject.lugarTrabajo));
    $pctContent.find("[data-render-info='idMunicipioNacimiento']")
	    .html(jQuery.isEmptyObject($pctObject.idMunicipioNacimiento) === false ? jQuery.trim($pctObject.idMunicipioNacimiento.nombre) : '');
    $pctContent.find("[data-render-info='asegurado']")
	    .html(function() {
                var labelColor = $pctObject.asegurado === false ? 'warning' : 'primary';
                var labelText = $pctObject.asegurado === false ? 'no' : 'sí';
                console.log($pctObject.asegurado, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $pctContent.find("[data-render-info='idMunicipioDomicilio']")
	    .html(jQuery.isEmptyObject($pctObject.idMunicipioDomicilio) === false ? jQuery.trim($pctObject.idMunicipioDomicilio.nombre) : '');
    $pctContent.find("[data-render-info='numeroAfiliacion']")
	    .html(jQuery.trim($pctObject.numeroAfiliacion));
    $pctContent.find("[data-render-info='idEstadoCivil']")
	    .html(jQuery.isEmptyObject($pctObject.idEstadoCivil) === false ? jQuery.trim($pctObject.idEstadoCivil.nombre) : '');
}
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
                placeholder: 'click para seleccionar...',
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
                placeholder: 'click para seleccionar...',
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
                '<span class="label label-primary-v4" style="float: left; margin-left: 5px; margin-top: 2px; font-weight: normal;">',
                    $arrText[1],
                '</span>',
            '</div>'
        ].join('\n');
    }
    $('[data-apply-formatter="patternDiag"]').select2({
	    placeholder: 'click para seleccionar...',
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
            $dateStatus_class     = 'primary-v4',               // custom define class
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

        var $studyStatus_class     = 'primary-v4'; // custom define class

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

        var $interpretationStatus_class     = 'primary-v4'; // custom define class

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

        var $diagnosticStatus_class     = 'primary-v4',                 // custom define class
            $diagnosticStatus_icon      = 'glyphicon-ok-sign';          // custom define class
        if (state.id === '4' || state.id === 4)
        {
            $diagnosticStatus_class     = 'danger',                     // custom define class
            $diagnosticStatus_icon      = 'glyphicon-remove-sign';      // custom define class
        }
        if (state.id === '5' || state.id === 5)
        {
            $diagnosticStatus_class     = 'success-v3',                 // custom define class
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
