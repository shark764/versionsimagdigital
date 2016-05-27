<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_bootstrapValidator.js.twig */
class __TwigTemplate_77b6b3ce852613555a376ce6deb1662022bf20f3c2bad77ae816f8c048f4a1e6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
    <script type=\"text/javascript\">
/*        http://doc.javake.cn/bootstrap-validator/settings/
        https://github.com/nghuuphuoc/bootstrapvalidator/blob/master/demo/selector.html
        http://www.bootply.com/dzv0yijvI5
        http://bootstrapvalidator.com/examples/icheck/
        http://bootstrapvalidator.com/api/#revalidate-field*/
    
        jQuery(document).ready(function() {
            /** Validación de formulario de inserción/actualización */
            jQuery('#simagd_entity_full_admin_form').formValidation({
                excluded: [':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    '";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[datosClinicos]': {
                        message: 'Digite datos clínicos válidos para la preinscripción',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 150,
                                message: 'Este campo debe contener al menos 15 caracteres y máximo 150'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[hipotesisDiagnostica]': {
                        message: 'Hipótesis diagnóstica digitada de la preinscripción inválida',
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 100,
                                message: 'Este campo debe contener al menos 10 caracteres y máximo 100'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[investigando]': {
                        message: 'Investigando buscada con la preinscripción inválida',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 150,
                                message: 'Este campo debe contener al menos 15 caracteres y máximo 150'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 62
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[justificacionMedica]': {
                        message: 'Justificación de la preinscripción inválida',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 150,
                                message: 'Este campo debe contener al menos 15 caracteres y máximo 150'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idAreaAtencion]': {
                        message: 'Procedencia de la preinscripción inválida',
                        validators: {
                            notEmpty: {
                                message: 'La procedencia es requerida'
                            },
                        }
                    },
                    '";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idAtencion]': {
                        message: 'El servicio clínico de la preinscripción es inválido',
                        validators: {
                            notEmpty: {
                                message: 'El servicio clínico es requerido'
                            }
                        }
                    },
                    '";
        // line 92
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEmpleado]': {
                        message: 'El empleado preinscriptor es inválido',
                        validators: {
                            notEmpty: {
                                message: 'El empleado preinscriptor es requerido'
                            }
                        }
                    },
                    '";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[consultaPor]': {
                        message: 'Motivo de consulta inválido',
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 255,
                                message: 'Este campo debe contener al menos 10 caracteres y máximo 255'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[estadoClinico]': {
                        message: 'Estado clínico del paciente inválido',
                        validators: {
                            stringLength: {
                                min: 5,
                                max: 50,
                                message: 'Este campo debe contener al menos 5 caracteres y máximo 50'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 128
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[antecedentesClinicosRelevantes]': {
                        message: 'Antecedentes clínicos del paciente inválido',
                        validators: {
                            stringLength: {
                                min: 10,
                                message: 'Este campo debe contener al menos 10 caracteres y máximo 50'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 141
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[nombreContacto]': {
                        message: 'Nombre del contacto del paciente es inválido',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 75,
                                message: 'Este campo debe contener al menos 15 caracteres y máximo 75'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ,\\.\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, ,. )'
                            },
                        }
                    },
                    '";
        // line 155
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[contacto]': {
                        message: 'Dato de contacto del paciente es inválido',
                        validators: {
                            stringLength: {
                                min: 5,
                                max: 75,
                                message: 'Este campo debe contener al menos 5 caracteres y máximo 75'
                            },
                            callback: {
                                message: 'Dato introducido no es válido',
                                callback: function(value, validator) {
                                    /** begin callback function */
                                            
                                    if (value === '') { return true; }

                                    var formaContVal = \$(\"select[name='";
        // line 170
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idFormaContacto]']\").val();

\t\t\t\t    var regexEmailPattern = /^([^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+|\\x22([^\\x0d\\x22\\x5c\\x80-\\xff]|\\x5c[\\x00-\\x7f])*\\x22)(\\x2e([^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+|\\x22([^\\x0d\\x22\\x5c\\x80-\\xff]|\\x5c[\\x00-\\x7f])*\\x22))*\\x40([^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+|\\x5b([^\\x0d\\x5b-\\x5d\\x80-\\xff]|\\x5c[\\x00-\\x7f])*\\x5d)(\\x2e([^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+|\\x5b([^\\x0d\\x5b-\\x5d\\x80-\\xff]|\\x5c[\\x00-\\x7f])*\\x5d))*\$/;
\t\t\t\t    if ( formaContVal == 3 && !regexEmailPattern.test(value) ) {
\t\t                        return {
\t\t                            valid: false,
\t\t                            message: 'No es una dirección de correo electrónico válida'
\t\t                        };
\t\t\t\t    }

\t\t\t\t    var regexPhonePattern = /\\d{1}-{0,1}\\d{3}-{0,1}\\d{4}-{0,1}/;
\t\t\t\t    if ( ( formaContVal == 1 || formaContVal == 2 ) && !regexPhonePattern.test(value) ) {
\t\t                        return {
\t\t                            valid: false,
\t\t                            message: 'Número de teléfono no es válido'
\t\t                        };
\t\t\t\t    }

\t                            return true;
\t\t\t\t    
                                    /** end callback function */
                                }
                            },
                        }
                    },
                    '";
        // line 195
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEstablecimientoReferido]': {
                        message: 'Establecimiento al que se referirá al paciente inválido',
                        validators: {
                            notEmpty: {
                                message: 'Establecimiento al que se referirá al paciente es requerido'
                            },
                            callback: {
                                message: 'El elemento seleccionado no es válido, cambie a otro establecimiento',
                                callback: function(value, validator) {
                                    /** begin callback function */
                                    var optionVal = validator.getFieldElements('";
        // line 205
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEstablecimientoReferido]').val();
                                    var checkboxExternoVal = \$(\"input:checkbox[id='\" + \$token + \"_referirPaciente']\");
                                    var textVal = validator.getFieldElements('";
        // line 207
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[justificacionReferencia]').val();
                                    var estabLocal = ";
        // line 208
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento"), "getId"), "html", null, true);
        echo ";
                                            
                                    if (optionVal != null && optionVal.length >= 1 && ( estabLocal != value )) {
                                        if (checkboxExternoVal.is(':checked') && (textVal != null && textVal.length >= 1)) {
                                            return true;
                                        }
                                        else {
                                            return false;
                                        }
                                    }
                                    else {
                                        if (checkboxExternoVal.is(':checked') || (textVal != null && textVal.length >= 1)) {
                                            return false;
                                        }
                                        else {
                                            return true;
                                        }
                                    }
                                    /** end callback function */
                                }
                            },
                        }
                    },
                    '";
        // line 231
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[justificacionReferencia]': {
                        message: 'Justificación de referencia inválida',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 255,
                                message: 'Este campo debe contener al menos 15 caracteres y máximo 255'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 245
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idAreaServicioDiagnostico]': {
                        message: 'Modalidad solicitada inválida',
                        validators: {
                            notEmpty: {
                                message: 'Modalidad que preinscribe es requerida'
                            },
                            callback: {
                                message: 'Sin proyecciones seleccionadas',
                                callback: function(value, validator) {
                                    /** begin callback function */
\t\t\t\t    
\t\t\t\t    if ( !\$(\"select[id\$='_solicitudEstudioProyeccion']\").length )
\t\t\t\t    {
// \t\t                        generarMensajeToast('error', 'No ha seleccionado ninguna proyección a realizar.', 'Error, sección vacía:' );

\t\t                        return {
\t\t                            valid: false,
\t\t                            message: 'Debe agregar al menos una proyección a la solicitud'
\t\t                        };
\t\t\t\t    }

\t                            return true;

                                    /** end callback function */
                                }
                            },
                        }
                    },
                    '";
        // line 273
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEstablecimientoDiagnosticante]': {
                        message: 'Establecimiento al que se solicita diagnóstico inválido',
                        validators: {
                            callback: {
                                message: 'El elemento seleccionado no es válido',
                                callback: function(value, validator) {
                                    /** begin callback function */
                                    var optionVal = validator.getFieldElements('";
        // line 280
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEstablecimientoDiagnosticante]').val();
                                    var checkboxReqDiagVal = \$(\"input:checkbox[id='\" + \$token + \"_requiereDiagnostico']\");
                                    var textVal = validator.getFieldElements('";
        // line 282
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[justificacionDiagnostico]').val();
                                            
                                    if (optionVal != null && optionVal.length >= 1) {
                                        if (checkboxReqDiagVal.is(':checked') && (textVal != null && textVal.length >= 1)) {
                                            return true;
                                        }
                                        else {
                                            return false;
                                        }
                                    }
                                    else {
                                        if (checkboxReqDiagVal.is(':checked') || (textVal != null && textVal.length >= 1)) {
                                            return false;
                                        }
                                        else {
                                            return true;
                                        }
                                    }
                                    /** end callback function */
                                }
                            },
                        }
                    },
                    '";
        // line 305
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[justificacionDiagnostico]': {
                        message: 'Justificación de diagnóstico requerido inválida',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 255,
                                message: 'Este campo debe contener al menos 15 caracteres y máximo 255'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                }
            })
            .on('error.field.bv', function(e, data) {
                // \$(e.target)  --> The field element
                // data.bv      --> The BootstrapValidator instance
                // data.field   --> The field name
                // data.element --> The field element

                data.bv.disableSubmitButtons(false);
            })
            .on('success.field.bv', function(e, data) {
                // e, data parameters are the same as in error.field.bv event handler
                // Despite that the field is valid, by default, the submit button will be disabled if all the following conditions meet
                // - The submit button is clicked
                // - The form is invalid
                data.bv.disableSubmitButtons(false);
            });
            
            /** Validación para filtro de área, atención y empleado */
//             \$(document).on('change', \"select[id='\" + \$token + \"_idAreaAtencion'], select[id='\" + \$token + \"_idAtencion']\", function(event) {
//                 jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', '";
        // line 339
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEmpleado]');
//             });
    
    /** Validación para información de contacto */
    \$(document).on('change', \"select[id='\" + \$token + \"_idContactoPaciente']\", function() {
\tjQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', \$token + '[nombreContacto]');
    });
    \$(document).on('change', \"select[id='\" + \$token + \"_idFormaContacto']\", function() {
\tjQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', \$token + '[contacto]');
    });
            
            /** Validación para referencia de paciente */
            \$(document).on('ifChanged', \"input:checkbox[id='\" + \$token + \"_referirPaciente']\", function(event) {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', \$token + '[idEstablecimientoReferido]');
            });
            \$(document).on('keyup change blur', \"textarea[id='\" + \$token + \"_justificacionReferencia']\", function(event) {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', \$token + '[idEstablecimientoReferido]');
            });
            
            /** Validación para solicitar modalidad */
            \$(document).on('change', \"select[id='\" + \$token + \"_idEstablecimientoDiagnosticante']\", function() {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', \$token + '[idAreaServicioDiagnostico]');
            });
            
            /** Validación para requerir diagnóstico */
            \$(document).on('ifChanged', \"input:checkbox[id='\" + \$token + \"_requiereDiagnostico']\", function(event) {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', \$token + '[idEstablecimientoDiagnosticante]');
            });
            \$(document).on('keyup change blur', \"textarea[id='\" + \$token + \"_justificacionDiagnostico']\", function(event) {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', \$token + '[idEstablecimientoDiagnosticante]');
            });
            \$(document).on('change', \"select[id\$='_solicitudEstudioProyeccion'], select[id='\" + \$token + \"_idAreaServicioDiagnostico']\", function() {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', \$token + '[idEstablecimientoDiagnosticante]');
            });

            /** Validación para fecha próxima consulta */
            /*\$(document).on('change', \"input[id='\" + \$token + \"_fechaProximaConsulta']\", function( event ) {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', jQuery(this).attr('name'));
                console.log(jQuery(this).attr('name') );
            })*/;
        });
    </script>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_bootstrapValidator.js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  634 => 356,  628 => 354,  601 => 346,  545 => 304,  350 => 172,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 321,  778 => 315,  772 => 312,  760 => 307,  755 => 304,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 352,  596 => 231,  578 => 270,  534 => 200,  507 => 184,  447 => 236,  445 => 175,  419 => 198,  454 => 160,  371 => 168,  651 => 437,  483 => 258,  404 => 193,  517 => 283,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 193,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 204,  401 => 144,  369 => 129,  356 => 212,  340 => 156,  874 => 781,  854 => 325,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 318,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 309,  763 => 308,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 303,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 436,  642 => 264,  639 => 263,  637 => 262,  604 => 347,  588 => 239,  573 => 321,  559 => 183,  547 => 205,  520 => 355,  450 => 173,  408 => 213,  363 => 216,  359 => 280,  348 => 156,  345 => 124,  336 => 192,  316 => 154,  307 => 124,  261 => 85,  266 => 205,  542 => 303,  538 => 217,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 272,  473 => 165,  414 => 216,  406 => 194,  280 => 108,  223 => 91,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 261,  485 => 175,  478 => 165,  475 => 164,  471 => 211,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 146,  291 => 165,  286 => 140,  392 => 150,  332 => 164,  318 => 245,  276 => 160,  190 => 141,  12 => 36,  195 => 80,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 357,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 348,  894 => 383,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 389,  730 => 219,  727 => 218,  712 => 214,  709 => 296,  706 => 295,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 351,  613 => 350,  610 => 349,  608 => 197,  605 => 196,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 224,  533 => 203,  530 => 150,  513 => 79,  496 => 280,  441 => 150,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 173,  395 => 118,  391 => 109,  382 => 195,  372 => 89,  364 => 282,  353 => 175,  335 => 154,  333 => 151,  297 => 169,  292 => 134,  205 => 81,  200 => 84,  184 => 73,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 300,  946 => 296,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 320,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 313,  754 => 208,  748 => 205,  745 => 392,  742 => 391,  737 => 199,  735 => 220,  732 => 197,  728 => 344,  726 => 341,  723 => 340,  719 => 215,  717 => 186,  714 => 185,  704 => 294,  701 => 180,  699 => 179,  696 => 291,  690 => 285,  687 => 173,  681 => 205,  673 => 281,  671 => 280,  668 => 279,  663 => 277,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 357,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 226,  587 => 388,  584 => 320,  576 => 324,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 305,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 352,  502 => 87,  477 => 82,  472 => 132,  465 => 209,  463 => 208,  446 => 244,  443 => 142,  429 => 219,  425 => 202,  410 => 167,  397 => 161,  394 => 54,  389 => 128,  357 => 186,  342 => 154,  334 => 171,  330 => 158,  328 => 142,  290 => 137,  287 => 110,  263 => 103,  255 => 122,  245 => 119,  194 => 77,  76 => 23,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 373,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 296,  888 => 270,  882 => 333,  873 => 267,  868 => 282,  864 => 372,  860 => 327,  856 => 279,  852 => 324,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 347,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 525,  606 => 348,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 329,  580 => 387,  572 => 218,  568 => 227,  562 => 313,  556 => 307,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 183,  492 => 341,  481 => 218,  476 => 271,  467 => 156,  451 => 159,  424 => 115,  418 => 227,  412 => 147,  399 => 64,  396 => 206,  390 => 305,  388 => 202,  383 => 200,  377 => 104,  373 => 46,  370 => 147,  367 => 167,  352 => 157,  349 => 273,  346 => 155,  329 => 111,  326 => 156,  313 => 136,  303 => 145,  300 => 124,  234 => 88,  218 => 88,  207 => 155,  178 => 71,  321 => 119,  295 => 130,  274 => 131,  242 => 89,  236 => 87,  692 => 175,  683 => 170,  678 => 204,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 150,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 224,  579 => 236,  577 => 318,  575 => 252,  569 => 233,  565 => 314,  548 => 207,  540 => 302,  536 => 358,  529 => 213,  524 => 196,  516 => 143,  510 => 185,  504 => 183,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 243,  452 => 145,  434 => 228,  421 => 219,  417 => 159,  385 => 201,  361 => 165,  344 => 157,  339 => 167,  324 => 123,  310 => 113,  302 => 145,  296 => 136,  282 => 106,  259 => 81,  244 => 116,  231 => 117,  226 => 84,  114 => 46,  104 => 60,  288 => 141,  284 => 162,  279 => 129,  275 => 208,  256 => 147,  250 => 99,  237 => 95,  232 => 115,  222 => 57,  215 => 130,  191 => 75,  153 => 86,  563 => 223,  560 => 222,  558 => 186,  555 => 185,  553 => 211,  549 => 206,  543 => 179,  537 => 301,  532 => 199,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 278,  508 => 275,  501 => 161,  495 => 265,  491 => 157,  487 => 156,  460 => 207,  455 => 203,  449 => 247,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 170,  420 => 123,  415 => 197,  411 => 120,  405 => 118,  403 => 160,  400 => 208,  380 => 199,  366 => 146,  354 => 185,  331 => 133,  325 => 119,  320 => 92,  317 => 138,  311 => 152,  308 => 151,  304 => 140,  272 => 127,  267 => 104,  249 => 92,  216 => 81,  155 => 67,  152 => 75,  146 => 58,  126 => 43,  181 => 72,  161 => 66,  110 => 44,  188 => 74,  186 => 77,  170 => 98,  150 => 64,  124 => 56,  358 => 164,  351 => 183,  347 => 206,  343 => 146,  338 => 144,  327 => 121,  323 => 114,  319 => 155,  315 => 183,  301 => 231,  299 => 131,  293 => 135,  289 => 127,  281 => 125,  277 => 107,  271 => 207,  265 => 125,  262 => 92,  260 => 102,  257 => 101,  251 => 143,  248 => 71,  239 => 88,  228 => 85,  225 => 170,  213 => 88,  211 => 80,  197 => 79,  174 => 128,  148 => 87,  134 => 100,  127 => 49,  20 => 2,  53 => 18,  270 => 105,  253 => 195,  233 => 94,  212 => 103,  210 => 87,  206 => 78,  202 => 76,  198 => 85,  192 => 102,  185 => 72,  180 => 66,  175 => 72,  172 => 71,  167 => 156,  165 => 68,  160 => 64,  137 => 26,  113 => 36,  100 => 41,  90 => 62,  81 => 49,  129 => 92,  84 => 28,  77 => 55,  34 => 21,  118 => 84,  97 => 36,  70 => 25,  65 => 17,  58 => 20,  23 => 3,  480 => 134,  474 => 253,  469 => 150,  461 => 157,  457 => 161,  453 => 194,  444 => 210,  440 => 172,  437 => 171,  435 => 167,  430 => 172,  427 => 339,  423 => 169,  413 => 196,  409 => 195,  407 => 238,  402 => 65,  398 => 157,  393 => 156,  387 => 182,  384 => 152,  381 => 150,  379 => 194,  374 => 192,  368 => 190,  365 => 165,  362 => 164,  360 => 163,  355 => 161,  341 => 123,  337 => 162,  322 => 146,  314 => 153,  312 => 125,  309 => 135,  305 => 134,  298 => 143,  294 => 145,  285 => 126,  283 => 109,  278 => 110,  268 => 126,  264 => 104,  258 => 147,  252 => 121,  247 => 98,  241 => 74,  229 => 102,  220 => 90,  214 => 86,  177 => 65,  169 => 72,  140 => 100,  132 => 52,  128 => 45,  107 => 76,  61 => 21,  273 => 106,  269 => 127,  254 => 122,  243 => 97,  240 => 96,  238 => 117,  235 => 116,  230 => 93,  227 => 92,  224 => 108,  221 => 107,  219 => 129,  217 => 89,  208 => 104,  204 => 116,  179 => 74,  159 => 91,  143 => 81,  135 => 54,  119 => 38,  102 => 43,  71 => 51,  67 => 49,  63 => 22,  59 => 19,  38 => 9,  94 => 35,  89 => 38,  85 => 31,  75 => 27,  68 => 26,  56 => 34,  201 => 76,  196 => 73,  183 => 67,  171 => 68,  166 => 67,  163 => 80,  158 => 97,  156 => 62,  151 => 62,  142 => 59,  138 => 57,  136 => 56,  121 => 46,  117 => 86,  105 => 45,  91 => 34,  62 => 23,  49 => 16,  28 => 5,  26 => 5,  87 => 57,  31 => 7,  25 => 5,  21 => 2,  24 => 4,  19 => 2,  93 => 9,  88 => 34,  78 => 23,  46 => 16,  44 => 12,  27 => 7,  79 => 29,  72 => 26,  69 => 19,  47 => 13,  40 => 18,  37 => 11,  22 => 3,  246 => 91,  157 => 114,  145 => 60,  139 => 80,  131 => 59,  123 => 47,  120 => 40,  115 => 44,  111 => 42,  108 => 42,  101 => 31,  98 => 53,  96 => 10,  83 => 36,  74 => 29,  66 => 18,  55 => 19,  52 => 13,  50 => 16,  43 => 14,  41 => 11,  35 => 9,  32 => 9,  29 => 6,  209 => 79,  203 => 85,  199 => 120,  193 => 75,  189 => 78,  187 => 69,  182 => 75,  176 => 70,  173 => 69,  168 => 69,  164 => 69,  162 => 60,  154 => 63,  149 => 58,  147 => 53,  144 => 61,  141 => 57,  133 => 48,  130 => 65,  125 => 51,  122 => 50,  116 => 52,  112 => 62,  109 => 41,  106 => 40,  103 => 39,  99 => 37,  95 => 39,  92 => 58,  86 => 23,  82 => 56,  80 => 33,  73 => 48,  64 => 23,  60 => 12,  57 => 14,  54 => 9,  51 => 17,  48 => 17,  45 => 7,  42 => 27,  39 => 20,  36 => 11,  33 => 8,  30 => 5,);
    }
}
