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
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue',
    });
        
    /** set select2 */
    $(document).find('form.simagd-form-custom-class')
        .find('select').each(function () {
            jQuery(this).select2({
                placeholder: '',
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
    $("div.box.box-success").removeClass('box-success').addClass("box-primary-v2");

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
        var $addonClass     = 'info-v2';
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
                           $field.code(jQuery.trim($svdata));
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