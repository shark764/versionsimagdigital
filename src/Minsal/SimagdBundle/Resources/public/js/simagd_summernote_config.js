/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
    
    /** text-editor options for summernote */
    var $snOptions 		= {
        height: 	115,        // set editor height
        minHeight: 	null,       // set minimum height of editor
        maxHeight: 	150,        // set maximum height of editor
        lang: 	'es-ES',    // default: 'en-US'
        focus: 	true,       // set focus to editable area after initializing summernote
        // toolbar
        toolbar: 	null,       // set toolbar without options
    };

    var $default_onInit     = {
        onInit:     function() {
                        console.log('Summernote is launched', jQuery(this).attr('name'));
                    },
    };

    var $speech_onInit      = {
        onInit      : function() {
                        // Add "speech" button
                        var $this               = jQuery(this);
                        var btn_toolbar_speech  = '<button id="sn_start_speechrecognition' + $this.attr('id') + '" type="button" class="btn btn-element-v2 btn-outline btn-sm btn-small sn_start_speechrecognition" title="Iniciar transcripción por voz" data-event="speech" tabindex="-1"><i class="fa fa-microphone"></i></button>';            
                        var filegroup_speech    = '<div class="note-file btn-group">' + btn_toolbar_speech + '</div>';
                        jQuery(filegroup_speech).appendTo($this.next('.note-editor').find('.note-toolbar'));
                        // Button tooltips
                        jQuery('#sn_start_speechrecognition' + $this.attr('id')).tooltip({container: 'body', placement: 'bottom'});
                        // Button events
                        jQuery('#sn_start_speechrecognition' + $this.attr('id')).off('click').on('click', function (e) {
                            e.preventDefault();
                            jQuery.extend(true,
                                    field_speechRecognition,
                                    {
                                        editor  : $this.attr('id')
                                    }
                            ); // set value for $editor
                            jQuery(document).trigger('myevt:summernote:speechrecognition', [e, $this, $this.attr('id'), jQuery(this).attr('id')]);
                        });
                    },
    };

    var $expand_toolBarOpt  = {
        toolbar: [
            //[groupname, [button list]]
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['misc', ['undo', 'redo']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['height', ['height']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ]
    };

    var $toolBarOpt 	= {
        toolbar: [
            //[groupname, [button list]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['fullscreen']],
        ]
    };

    var $mini_toolBarOpt    = {
        toolbar: [
            //[groupname, [button list]]
            ['style', ['bold', 'italic', 'underline']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen']],
        ]
    };

    $.fn.buildSummerNote = function(options)
    {
	var $data_notempty      = jQuery(this).data('summernote-notempty'),
            $data_name          = jQuery(this).attr('name');
        
	/** text-editor CREATE */
	jQuery(this).summernote(
	    jQuery.extend(true,
                        $snOptions,
                        options.newOptions,
                        options.newOptions.___speech === true || options.newOptions.___speech === 'true' ? $speech_onInit : $default_onInit,
                        options.newOptions.___toolbar === 'mini' ?
                                $mini_toolBarOpt :
                                        (options.newOptions.___toolbar === 'expand' ? $expand_toolBarOpt : $toolBarOpt)
	))
	.on('summernote.change', function(customEvent, contents, $editable) {
	    // Revalidate the content when its value is changed by Summernote
	    if ($data_notempty === true || $data_notempty === 'true') {
		jQuery(this).closest('form').formValidation('revalidateField', $data_name);
	    }
	    console.log($data_name, 'data-summernote-notempty', $data_notempty);
        });
	jQuery(this).code('Sin editar...');
	
	/** enable FORMVALIDATION */
	var $data_validators    = jQuery(this).data('summernote-validators');
	if ($data_validators === true || $data_validators === 'true') {
	    jQuery(this)
		.closest('form')
			    .formValidation('enableFieldValidators', $data_name, true);
	    console.log($data_name, 'add to fv');
	}
    };

    $.fn.destroySummerNote = function()
    {
	/** disable FORMVALIDATION */
	var $data_validators	= jQuery(this).data('summernote-validators'),
            $data_name		= jQuery(this).attr('name');
	if ($data_validators === true || $data_validators === 'true') {
	    jQuery(this)
		.closest('form')
			    .formValidation('resetField', $data_name)
			    .formValidation('enableFieldValidators', $data_name, false);
	    console.log($data_name, 'remove from fv');
	}
	
	/** text-editor DESTROY */
	jQuery(this).code('').destroy();
	
	/** redefine RESIZE event for WINDOW */
	var $window 	= jQuery(window);
	$window.off('resize').on('resize', function () {
	    var $target_container_bsTable = $('li.list-table-link-navbar.active')
						.find("a")
						.data('divtabletarget');
	    jQuery('#' + $target_container_bsTable)
		    .find("table:visible")
			    .bootstrapTable('resetView')
			    .bootstrapTable('resetWidth');
	    console.log('resetView', 'now from summernote');
	});
    };

}(jQuery));

jQuery(document).ready(function() {
    
    /*
     * destroy CKEDITOR INSTANCES
     */
    var $ckEditor_instance; // A variable to store a reference to the current editor.
    CKEDITOR.on('instanceReady', function(e) {
	$ckEditor_instance = e.editor;
//	console.log(CKEDITOR.instances[e.editor.name]);
	CKEDITOR.instances[e.editor.name].destroy(true);	// destroy instance
    });
    /*
     * instances are destroyed after ready
     */
    
    /*
     * set contenteditable TRUE for SUMMERNOTE instances on display tab content
     */
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
//        var target = $(e.target).attr("href")
        // activated tab
        $(e.target)
            .closest('form')
                    .find('.summernote:enabled:not([readonly])')
                            .each(function() {
                                jQuery(this)
                                    .parent()
                                    .find(".note-editable")
                                            .attr('contenteditable', true);
                                console.log(jQuery(this).attr('name'), 'shown.bs.tab', 'DON\'T DISPLAY ALWAYS, JUST WHEN IS TAB WITH SUMMERNOTES');
                            });
    });
    
});