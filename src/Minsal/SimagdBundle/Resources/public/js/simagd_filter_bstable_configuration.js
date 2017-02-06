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
