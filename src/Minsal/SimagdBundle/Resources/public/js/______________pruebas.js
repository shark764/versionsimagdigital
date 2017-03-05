

                {% if is_granted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') or is_granted('ROLE_ADMIN') %}
                    <button type="submit"    class="btn btn-element-v2 btn-outline" name="btn_edit_and_diagnosticate"><i class="fa fa-save"></i> <i class="fa fa-microphone"></i> Guardar e Interpretar</button>
                {% endif %}

                {% if is_granted('ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE') or is_granted('ROLE_ADMIN') %}
                    <button type="submit"    class="btn btn-element-v2 btn-outline" name="btn_create_and_diagnosticate"><i class="fa fa-save"></i> <i class="fa fa-microphone"></i> Guardar e Interpretar</button>
                {% endif %}
                
                
                
                
                ---- ¿Desea utilizar estos datos para crear otra solicitud?
		    -- Ejemplo: Delete de CtlExamenServicioDiagnostico
		    -- pend lectura general deben enviar a lct_editUrl si son complementarios
		    
		--- ////////////////Complementarios no deben poder complementarse aunque el user sea admin
		    
		---- 'data-apply-formatter-mode' => $setLockEstado ? 'disabled' : 'enabled',
		    -- Ejemplo: Empleado de RyxProcedimientoRadiologicoRealizado
		    
		---- Bloqueo de estados en transcripcion
		    -- Ejemplo: funcionesClienteServidor de diag_
		    
		---- ///////////////Registrar examen y diagnosticar
		    -- /////////////Ejemplo: prz_edit y controller
		    
		---- Form type: Horizontal
		    -- base_edit_form.html.twig y form_admin_fields.html.twig de vendors/sonata-project/resources
		    
		---- Focus, active, etc de inputs, textarea, etc
		    -- Ejemplo: add primary-v4 en select2 css
		    
		---- colors error, success, validating en formValidation
		    -- Ejemplo: success en validated por success-v3
		    
		-- add form incrustado está recargando la página
		    -- Puede ser el form.defaultSubmmit del formValidation a causa de summernote
		    
		-- Bloqueo de empleado en select2 debe ser solo si esta disabled, enabled or is admin not(enabled or is admin)
		
		-- Desea realizar de inmediato el proc. realizado "complementario" que acaba de solicitar
		    -- just diag user
		    -- Diag debe poseer privilegios de tcnl

		-- lista de solicitudes posee error en resetForm, debe configurarse formValitadion primero para SUMMERNOTE
		
		-- Link <li><a> bloqueados aun siguen teniendo onclick activado.
		
		-- radX debe poder manipular prz, pndR
		-- cit debe poder manipular (para mientras) prc y prcExpl
		
		-- Para que se pueda enviar desde Solcmpl hacia Prz, sin pasar por pndR
		    -- Se necesita un onetomany para todos los q contengan pndR/L/T/V
		-- También servirá para que se pueda llegar desde prc hasta notdiag en server twig.
		-- A parte de "realizar de inmediato", tambien se debe poder guardar "en personal"
		
		-- Lecturas tambien son asignadas a alguien

		-- Para que pueda pasarse desde prz hacia lct, se necesita que se haya pedido diagnostico, por tanto
		-- se necesita primero crear un pndL si el estudio no lo posee
		-- si no posee, modal preguntando si esta seguro, ya que creara un registro en lista de trabajo

		-- ESTUDIOS SE ESTAN SAMPANDO DE UN SOLO EN PNDL !!!!!!!!!!!!!


		/** speech to text  */
		https://github.com/zzmp/juliusjs
		https://github.com/jimmybyrum/voice-commands.js
		http://syl22-00.github.io/pocketsphinx.js/live-demo.html
		    
		    
		    
		    
		** a, b... no siempre existen, ya que no vienen de un trigger, como en ifchanged de remove expl en prc_form
		** si es en document.on change, tambien se deben agregar a, b
        
        
                -- Continuar reporte de prz por tecnologo y modalidad.

		***************************************************************
		quitar de los panel q no sean los de citas
		.panel-primary-v4 {
			  /* border-color: #e5e5e5 !important; */
		}
		***************************************************************

				
		***************************************************************
		en panels con form, poner un button q diga "desea agregar otra"
		para evitar cerrar y volver a cargar, tener en cuenta el success
		alert, se debe mostrar solo como mensajito o algo (sweetalert)
		para los catalogos x ejemplo
		***************************************************************


                /*
                 * How to close a Twitter Bootstrap popover by clicking outside
                 */
                http://jsfiddle.net/raving/jpsmegvL/
                
                /*
                 * SmartMenus Bootstrap Addon (Navbar) --| submenu
                 */
                http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html