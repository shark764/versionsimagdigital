jQuery(document).ready(function() {
    jQuery('#dui').mask("99999999-9");
    $("#fecha_nacimiento").datepicker().mask("99-99-9999");
    $("#fecha_desde").datepicker().mask("99-99-9999");
    $("#fecha_hasta").datepicker().mask("99-99-9999");
    
    /* Funcion para limpiar parametros de busqueda */
    $("#limpiar").click(function() {
        jQuery('#buscarForm')[0].reset();
        jQuery('#resultadoBusqueda').hide();
        $("#buscar").show();
        return false;
    });
    
    
    $("#buscar").click(function() {
        regexp = /^[0-9]{1,}$/;
        
        /* Valida que se ingrese un numero de expediente */
        if ($("#nec").val()=='')
        {
            (jQuery('#error')) ? jQuery('#error').remove() : '';
                var elem = $("<div id='error' title='Digite Expediente'><center>" +
                        "Debe ingresar el # de Expediente para realizar la busqueda de estudios."
                        + "</center></div>");
                elem.insertAfter($("#buscarForm"));
                $("#error").dialog({
                    close: function() {
                        $("#nec").val('');
                        $("#nec").focus();
                    }
                });
                return false;
        }
        
       
        
        
        /* Valida que la fecha inicial no sea mayor a la final */
        if ($("#fecha_hasta").datepicker("getDate"))
        {          
         if ($("#fecha_desde").datepicker("getDate") > $("#fecha_hasta").datepicker("getDate"))
                {                                                      
                            (jQuery('#error')) ? jQuery('#error').remove() : '';
                    var elem = $("<div id='error' title='Error en fecha'><center>" +
                            "La fecha de inicio desde no puede ser mayor a la fecha hasta."
                            + "</center></div>");
                    elem.insertAfter($("#buscarForm"));
                   
                   $("#error").dialog({
                        close: function() {
                            $("#fecha_desde").val('');
                            $("#fecha_desde").focus();
                        }
                    });
                    return false;
                    
                }
            }
        
        if ($("#nec").val() != '') {
            var valores = $("#nec").val().split('-');
            if (valores.length > 2) {
                /*PARA MOSTRAR MENSAJE DE ERROR DE FORMATO DE EXPEDIENTE
                 * PRIMERO SE CREA O ELIMINA EL ELEMENTO
                 * LUEGO SE CREA CON EL MENSAJE ADECUADO Y SE COLOCA
                 * LUEGO DEL FORMULARIO PARA ABRIRSE.
                 * */
                (jQuery('#error')) ? jQuery('#error').remove() : '';
                var elem = $("<div id='error' title='Error de Formato de Expediente'><center>" +
                        "El formato del número de expediente no es el adecuado."
                        + "</center></div>");
                elem.insertAfter($("#buscarForm"));
                $("#error").dialog({
                    close: function() {
                        $("#nec").val('');
                        $("#nec").focus();
                    }
                });
                return false;
            } else {
                if (!regexp.test(valores[0])) {
                    /*PARA MOSTRAR MENSAJE DE ERROR DE FORMATO DE EXPEDIENTE
                     * PRIMERO SE CREA O ELIMINA EL ELEMENTO
                     * LUEGO SE CREA CON EL MENSAJE ADECUADO Y SE COLOCA
                     * LUEGO DEL FORMULARIO PARA ABRIRSE.
                     * */
                    (jQuery('#error')) ? jQuery('#error').remove() : '';
                    var elem = $("<div id='error' title='Error de escritura'><center>" +
                            "El Número de Expediente no puede contener letras"
                            + "</center></div>");
                    elem.insertAfter($("#buscarForm"));
                    $("#error").dialog({
                        close: function() {
                            $("#nec").val('');
                            $("#nec").focus();
                        }
                    });
                    return false;
                } else {
                    if (valores.length > 1) {
                        if (!regexp.test(valores[1])) {
                            /*PARA MOSTRAR MENSAJE DE ERROR DE FORMATO DE EXPEDIENTE
                             * PRIMERO SE CREA O ELIMINA EL ELEMENTO
                             * LUEGO SE CREA CON EL MENSAJE ADECUADO Y SE COLOCA
                             * LUEGO DEL FORMULARIO PARA ABRIRSE.
                             * */
                            (jQuery('#error')) ? jQuery('#error').remove() : '';
                            var elem = $("<div id='error' title='Error de escritura'><center>" +
                                    "El Número de Expediente no puede contener letras"
                                    + "</center></div>");
                            elem.insertAfter($("#buscarForm"));
                            $("#error").dialog({
                                close: function() {
                                    $("#nec").val('');
                                    $("#nec").focus();
                                }
                            });
                            return false;
                        } else {
                            
                            jQuery('#resultadoBusqueda').load(Routing.generate('buscar_estudio'));
                            jQuery('#resultadoBusqueda').show();
                            
                        }
                    } else {
                      
                        jQuery('#resultadoBusqueda').load(Routing.generate('buscar_estudio'));
                        jQuery('#resultadoBusqueda').show();
                        
                    }
                }
            }
        } 
        return false;
    });
    
  

    //PASANDO A MAYUSCULAS LOS ELEMENTOS
    $("#primer_apellido").keyup(function() {
        jQuery(this).val(limpiar_nombres($("#primer_apellido").val()));
    });

    $("#primer_nombre").keyup(function() {
        jQuery(this).val(limpiar_nombres($("#primer_nombre").val()));
    });   
    
    $("#conocido_por").keyup(function() {
      jQuery(this).val(limpiar_nombre($("#conocido_por").val()));  
    });


    /** Show Datepicker */
    $("input[id^='fecha_']").each(function() {

        jQuery(this).wrap("<div class='input-group'></div>");
        jQuery(this).before(" <span class='input-group-btn'> <button class='bsqEstDatepickerShow demo btn btn-primary-v2 btn-outline btn-large'> <i class='glyphicon glyphicon-calendar'></i> </button> </span>");
	
    });

    $(document).on('click', ".bsqEstDatepickerShow", function(e) {
        e.preventDefault();

        jQuery(this).closest("div").find("input[id^='fecha_']").datepicker('show');
        console.log('Datetimepicker displayed');
    });

    /** Custom input */
    $("input[id='nec'], input[id='dui']")
            .wrap("<div class='input-group'></div>");
    $("input[id='nec']")
            .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-outline btn-large' id='_simagdBtnAddonNec'> <i class='glyphicon glyphicon-barcode'></i> </button> </span>");
    $("input[id='dui']")
            .before(" <span class='input-group-btn'> <button class='demo btn btn-primary-v2 btn-outline btn-large' id='_simagdBtnAddonDui'> <i class='glyphicon glyphicon-barcode'></i> </button> </span>");

    $(document).on('click', "button[id^='_simagdBtnAddon']", function(e) {
        e.preventDefault();
    });

    /** margin inputs */
    $("form[id='buscarForm']")
            .find(':input').css({
                'margin': '0px'
            });

});
