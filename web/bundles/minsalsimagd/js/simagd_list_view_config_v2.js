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
        
	console.log('%cresetView', 'background: #31708f; color: #fff');
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