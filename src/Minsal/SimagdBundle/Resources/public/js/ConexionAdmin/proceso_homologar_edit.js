jQuery(document).ready(function($) {
      var x = true; 
      var suma=0;
    $("button[type='submit']:not([disabled])").click(function(e) {
         if (x){
            var self = this;
            e.preventDefault();
            var pesos=[];
            var aprovados=true;
            suma=0;
            var pnegativo=parseFloat($("input[type='text'][id*=_pesoNegativo]:visible").val());
            $("input[type='text'][id*=peso__]:visible").each(function() {
               // pesos[this.id]=this.value;
               item = {};
               item ["id"] = this.id;
               item ["value"] = this.value;
                if (isNumber(this.value)){
                    if ((this.value<=100 && (this.value>=0))){
                        pesos.push(item);
                        suma=suma+parseFloat(this.value);
                    }
                    else
                    {
                        this.focus();
                        this.select();
                        showDialogMsg('','El peso debe ser mayor o igual que cero y menor o igual que cien.','dialog-warning');
                        aprovados=false;
                    }

                }
                else
                {
                    this.focus();
                    this.select();
                    showDialogMsg('','Introduzca un valor num&eacute;rico para cada peso.','dialog-warning');
                    aprovados=false;
                }
            });
       
                //guardar_cambio(pesos, e);
                if (aprovados)
                {
                    if ((suma+pnegativo)===100)
                    {
                        if (pnegativo<100)
                        {
                             $.getJSON(Routing.generate('configurar_campopeso'), {elobjeto:pesos},
                            function(resp) {
                                var estado = resp.estado;
                                if (estado === 'error')
                                {
                                    e.preventDefault();
                                    alert(resp.mensaje);
                                }
                                else
                                {
                                    self.click();
                                  // $(this).trigger('click'); 
                                }
                                $('#mensajito_cambio').html('<DIV class="alert alert-' + estado + '">' + resp.mensaje + '</DIV>');
                            });
                        }
                        else
                        {
                            alert('here');
                            self.click();
                        }
                       
                       x = false;
                    }
                    else
                    {
                        showDialogMsg('','La suma de los pesos debe ser igual a 100. Suma actual es: '+(suma+pnegativo),'dialog-warning');
                    }
                }
         
            }
            
        
    });
     if ($('input[id$="_nombre"]').length) {
        var $id = $('input[id$="_nombre"]').attr('id').split('_')[0];

        
        
        
    }
    $('div .form-actions').after('<div ><table style=width:50% border=1 align=center id="datos" ></table><input type="hidden" name="cuantoscampos" id="cuantoscampos"></div>');
    //************************** CÓDIGO PARA MOSTRAR EL RESULTADO PARA CONFIGURACIÓN DE CAMPOS
    
    //Quitar los otros botones, solo debe estar agregar y editar
    $('input[name$="btn_create_and_create"]').remove();
    $('input[name$="btn_create_and_list"]').remove();

    function cargarDatos(recargar_origen) {
        
        $('#datos').html('');
        $('#datos').addClass("table table-condensed table-hover");
        $('#datos').before("<div id='mensajito_cambio'></div>");
        $.getJSON(Routing.generate('proceso_homologar_leer', {id: $('#configurar').attr('data')}), {recargar: recargar_origen},
        function(resp) {
            //Construir los options de tipo_datoe
            $('#cuantoscampos').val(resp.cuantoscampos);
            var tipos_datos = '';
            if (resp.estado === 'error') {
                alert(resp.mensaje);
                $('#mensajito_cambio').html('<DIV class="alert alert-error">' + resp.mensaje + '</DIV>');
            }
            else {
                


                // Los encabezados de la fila
                $('#datos').append("<CAPTION>" + trans.configure_peso +
                        "</CAPTION>" +
                        "<THEAD>" +
                        "<TR id='fila_enc' class='info'>" +
                        "<TH>" + trans.nombre_campo + "</TH>" +
                        "<TH>" + trans.lpeso + "</TH>" +
                        "</TR></THEAD>" +
                        "<TBODY id='datos_body'></TBODY>");
                
                $.each(resp.significados, function(id, valor) {
                    //alert('hola '+valor);
                    fila = "<TR>" +
                            "<TD>" + valor + "</TD>" +
                            "<TD>" +
                            "<input type='text' class='peso' id='peso__" + id + "' title='" + trans.elija_tipo_dato + "' >"  +
                            "</TD>" +
                            "</TR>";
                    $('#datos_body').append(fila);
                })

                //Elegir los valores que ya tienen, en el caso que esté modificando
                $.each(resp.campos, function(campo, fila) {
                    $('#peso__' + fila.id).val(fila.peso);
                    
                })


                

            }
        });
        
    }
    //Si existe la capa configurar, cargar los datos    
    if ($('#configurar').length) {
        cargarDatos(false);
    }

    
    function isNumber(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }

});
function showDialogMsg(title, msg, dialogClass){
        if (jQuery('body #dialog-message').length > 0)
            jQuery('body #dialog-message').remove();

        jQuery("body").append('<div id="dialog-message"></div>');
        var element = jQuery('body #dialog-message');

        if (typeof dialogClass === "undefined" || dialogClass === null || dialogClass === '') {
            dialogClass = 'dialog-info'
        }

        if (typeof title === "undefined" || title === null || title === '') { 
            switch(dialogClass.replace('dialog-','')) {
            case 'error':
                    title = 'Ha ocurrido un Error!';
                    break;
            case 'warning':
                    title = 'Advertencia!';
                    break;
            case 'success':
                    title = 'Realizado correctamente!';
                    break;
            default:
                    title = 'Informaci&oacute;n';
            }
        }

        if (typeof msg === "undefined" || msg === null || msg === '') {
            switch(dialogClass.replace('dialog-','')) {
            case 'error':
                    msg = 'Se ha producido un error inesperado! Por favor, verifique los datos ingresados e intente nuevamente.';
                    break;
            case 'warning':
                    msg = 'Atenci&oacute;n, verifique la información proporcionada y que los datos esten completos. Estos podría generar un error.';
                    break;
            case 'success':
                    msg = 'La acci&oacute;n se ha realizado correctamente.';
                    break;
            default:
                    msg = 'No se ha definido información a mostrar al usuario.';
            }
        }

        var msgWi = '';

        switch(dialogClass.replace('dialog-','')) {
            case 'error':
                    msgWi = '<i class="icon-remove"></i>&nbsp;&nbsp;'+msg;
                    break;
            case 'warning':
                    msgWi = '<i class="icon-warning-sign"></i>&nbsp;&nbsp;'+msg;
                    break;
            case 'success':
                    msgWi = '<i class="icon-ok-sign"></i>&nbsp;&nbsp;'+msg;
                    break;
            default:
                    msgWi = '<i class="icon-info-sign"></i>&nbsp;&nbsp;'+msg;
        }

        element.append(msgWi);                  

        element.dialog({
            dialogClass: dialogClass,
            modal: true,
            title: title,
            buttons: {
                Ok: function() {
                    jQuery( this ).dialog("close");
                }
            }
        });
    };
