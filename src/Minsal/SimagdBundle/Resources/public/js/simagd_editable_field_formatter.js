/**
 * @author simagdigital
 * extensions: https://github.com/vitalets/x-editable
 */

!function ($) {

    'use strict';

    var BootstrapTable = $.fn.bootstrapTable.Constructor,
        _initTable = BootstrapTable.prototype.initTable;

    BootstrapTable.prototype.initTable = function () {
        var that = this;
        _initTable.apply(this, Array.prototype.slice.apply(arguments));

        if (!this.options.editable) {
            return;
        }

        $.each(this.options.columns, function (i, column) {
            if (!column.editable) {
                return;
            }

            var _formatter = column.formatter;
            column.formatter = function (value, row, index) {
                var result = _formatter ? _formatter(value, row, index) : value;
		console.log(['<a   href="javascript:void(0)"',
                    ' data-name="' + column.field + '"',
                    ' data-pk="' + row[that.options.idField] + '"',
                    ' data-value="' + jQuery.trim(value) + '"',
                    '>' + result + '</a>'
                ].join(''));

                return ['<a   href="javascript:void(0)"',
                    ' data-name="' + column.field + '"',
                    ' data-pk="' + row[that.options.idField] + '"',
                    ' data-value="' + jQuery.trim(value) + '"',
                    '>' + result + '</a>'
                ].join('');
            };
        });
    };

}(jQuery);