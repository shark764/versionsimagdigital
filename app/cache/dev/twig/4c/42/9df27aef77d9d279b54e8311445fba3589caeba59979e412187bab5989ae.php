<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_crearSolicitudEstudio_formatoRapido_modal.html.twig */
class __TwigTemplate_4c429df27aef77d9d279b54e8311445fba3589caeba59979e412187bab5989ae extends Twig_Template
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
";
        // line 4
        echo "<div id=\"crearSolicitudEstudioFormatoRapido-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-ambulance\"></i> <span id=\"formPrcEmergencyRequestTitle\">Crear solicitud de estudio - <span class=\"badge badge-primary-v2\" style=\"\">Formato rápido</span></span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formPrcEmergencyRequestLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearSolicitudEstudioFormatoRapido-form\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#solicitudShortFormatTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-send\"></span> Solicitud de estudio <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"solicitudShortFormatTab\" >

                                    <input type=\"hidden\" id=\"formPrcEmergencyRequestId\" name=\"formPrcEmergencyRequestId\" value=\"\" data-alias-from-server=\"prc_id\" />
                                    <input type=\"hidden\" id=\"formPrcEmergencyRequestIdExpediente\" name=\"formPrcEmergencyRequestIdExpediente\" value=\"\" data-alias-from-server=\"explocal_id\" />
                                    <input type=\"hidden\" id=\"formPrcEmergencyRequestEsEmergencia\" name=\"formPrcEmergencyRequestEsEmergencia\" value=\"\" data-alias-from-server=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Área</label>
                                        <div class=\"col-xs-3\">
                                            <select id=\"formPrcEmergencyRequestIdAreaAtencion\" name=\"formPrcEmergencyRequestIdAreaAtencion\" class=\"form-control select2-select\" data-alias-from-server=\"prc_id_areaAtencion\" data-trigger-on-display=\"true\" data-default=\"";
        // line 51
        echo twig_escape_filter($this->env, (isset($context["default_areaAtn"]) ? $context["default_areaAtn"] : $this->getContext($context, "default_areaAtn")), "html", null, true);
        echo "\" data-apply-formatter=\"ar\"
                                                      ";
        // line 53
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 57
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["areasAtencion"]) ? $context["areasAtencion"] : $this->getContext($context, "areasAtencion")));
        foreach ($context['_seq'] as $context["_key"] => $context["areaAtencion"]) {
            // line 58
            echo "                                                    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["areaAtencion"]) ? $context["areaAtencion"] : $this->getContext($context, "areaAtencion")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["areaAtencion"]) ? $context["areaAtencion"] : $this->getContext($context, "areaAtencion")), "html", null, true);
            echo "</option>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['areaAtencion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        echo "                                            </select>
                                        </div>
                                        <label class=\"col-xs-2 control-label required\">Servicio</label>
                                        <div class=\"col-xs-3\">
                                            <select id=\"formPrcEmergencyRequestIdAtencion\" name=\"formPrcEmergencyRequestIdAtencion\" class=\"form-control select2-select\" data-alias-from-server=\"prc_id_atencion\" data-default=\"";
        // line 64
        echo twig_escape_filter($this->env, (isset($context["default_atn"]) ? $context["default_atn"] : $this->getContext($context, "default_atn")), "html", null, true);
        echo "\" data-apply-formatter=\"ar\"
                                                      ";
        // line 66
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 70
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposAtencion"]) ? $context["tiposAtencion"] : $this->getContext($context, "tiposAtencion")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipoAtencion"]) {
            // line 71
            echo "                                                    <optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["tipoAtencion"]) ? $context["tipoAtencion"] : $this->getContext($context, "tipoAtencion")), "html", null, true);
            echo "\">
                                                    ";
            // line 72
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["atenciones"]) ? $context["atenciones"] : $this->getContext($context, "atenciones")));
            foreach ($context['_seq'] as $context["_key"] => $context["atencion"]) {
                if (((!(null === $this->getAttribute((isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "idTipoAtencion"))) && ($this->getAttribute($this->getAttribute((isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "idTipoAtencion"), "id") == $this->getAttribute((isset($context["tipoAtencion"]) ? $context["tipoAtencion"] : $this->getContext($context, "tipoAtencion")), "id")))) {
                    // line 73
                    echo "                                                        <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "id"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "html", null, true);
                    echo "</option>
                                                    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atencion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 75
            echo "                                                    </optgroup>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipoAtencion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 77
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["atenciones"]) ? $context["atenciones"] : $this->getContext($context, "atenciones")));
        foreach ($context['_seq'] as $context["_key"] => $context["atencion"]) {
            if ((null === $this->getAttribute((isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "idTipoAtencion"))) {
                // line 78
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atencion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Solicitante</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formPrcEmergencyRequestIdEmpleado\" name=\"formPrcEmergencyRequestIdEmpleado\" class=\"form-control select2-select\" data-alias-from-server=\"prc_id_empleado\" data-default=\"";
        // line 87
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"user\"
                                                      ";
        // line 89
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 93
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if (($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED")) {
                // line 94
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 95
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")));
                foreach ($context['_seq'] as $context["_key"] => $context["medico"]) {
                    if (((!(null === $this->getAttribute((isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 96
                        echo "                                                        <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "html", null, true);
                        echo "</option>
                                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['medico'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 98
                echo "                                                    </optgroup>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 100
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")));
        foreach ($context['_seq'] as $context["_key"] => $context["medico"]) {
            if ((null === $this->getAttribute((isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "idTipoEmpleado"))) {
                // line 101
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['medico'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Modalidad</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formPrcEmergencyRequestIdAreaServicioDiagnostico\" name=\"formPrcEmergencyRequestIdAreaServicioDiagnostico\" class=\"form-control select2-select\" data-alias-from-server=\"prc_id_modalidad\" data-trigger-on-display=\"true\" data-default=\"";
        // line 110
        echo twig_escape_filter($this->env, (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "html", null, true);
        echo "\" data-apply-formatter=\"mld\"
                                                      ";
        // line 112
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\"

                                                      data-fv-callback=\"true\"
                                                      data-fv-callback-message=\"Debe seleccionar al menos una proyección\"
                                                      data-fv-callback-callback=\"checkProyeccionesModalidad\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Imagenología\">
                                                    ";
        // line 121
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 122
            echo "                                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "html", null, true);
            echo "</option>
                                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modalidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 124
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Proyecciones</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formPrcEmergencyRequestSolicitudEstudioProyeccion\" name=\"formPrcEmergencyRequestSolicitudEstudioProyeccion[]\" class=\"form-control select2-select\" data-alias-from-server=\"prc_solicitudEstudioProyeccion\" data-apply-formatter=\"pry\" multiple
                                                      ";
        // line 134
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                ";
        // line 138
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["examenes"]) ? $context["examenes"] : $this->getContext($context, "examenes")));
        foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
            // line 139
            echo "                                                    <optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "html", null, true);
            echo "\">
                                                    ";
            // line 140
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")));
            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                if (((!(null === $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"))) && ($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "id")))) {
                    // line 141
                    echo "                                                        <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "</option>
                                                    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 143
            echo "                                                    </optgroup>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['examen'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 145
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")));
        foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
            if ((null === $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"))) {
                // line 146
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 148
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Próxima consulta</label>
                                        <div class=\"col-xs-3\">
                                            <div class=\"input-group\">
                                                <span class='input-group-btn'>
                                                    <button class='demo btn btn-primary-v2 btn-large' id='formPrcEmergencyRequestFechaProximaConsultaDp'> <i class='glyphicon glyphicon-calendar'></i> </button>
                                                </span>
                                                <input type=\"text\" class=\"form-control\" id=\"formPrcEmergencyRequestFechaProximaConsulta\" name=\"formPrcEmergencyRequestFechaProximaConsulta\" readonly=\"readonly\" data-alias-from-server=\"prc_fechaProximaConsulta\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\"
                                                      ";
        // line 161
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-date=\"true\"
                                                      data-fv-date-format=\"YYYY-MM-DD\"
                                                      data-fv-date-message=\"Formato no válido\" />
                                            </div>
                                        </div>
                                        <label class=\"col-sm-2 control-label required\">Prioridad</label>
                                        <div class=\"col-sm-3\">
                                            <select id=\"formPrcEmergencyRequestIdPrioridadAtencion\" name=\"formPrcEmergencyRequestIdPrioridadAtencion\" class=\"form-control select2-select\" data-alias-from-server=\"prc_id_prioridad\" data-default=\"";
        // line 172
        echo twig_escape_filter($this->env, (isset($context["default_prAtn"]) ? $context["default_prAtn"] : $this->getContext($context, "default_prAtn")), "html", null, true);
        echo "\" data-apply-formatter=\"prAtn\"
                                                      ";
        // line 174
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 178
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["prioridades"]) ? $context["prioridades"] : $this->getContext($context, "prioridades")));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 179
            echo "                                                    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "html", null, true);
            echo "</option>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 181
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Datos clínicos</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"1\" class=\"form-control\" name=\"formPrcEmergencyRequestDatosClinicos\" id=\"formPrcEmergencyRequestDatosClinicos\" placeholder=\"Digite los datos clínicos\" data-alias-from-server=\"prc_datosClinicos\" maxlength=\"150\" style=\"resize: none\"
                                                      ";
        // line 190
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"150\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Hipótesis diagnóstica</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"1\" class=\"form-control\" name=\"formPrcEmergencyRequestHipotesisDiagnostica\" id=\"formPrcEmergencyRequestHipotesisDiagnostica\" placeholder=\"Digite la hipótesis diagóstica del paciente\" data-alias-from-server=\"prc_hipotesisDiagnostica\" maxlength=\"100\" style=\"resize: none\"
                                                      ";
        // line 210
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"100\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Investigando</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"1\" class=\"form-control\" name=\"formPrcEmergencyRequestInvestigando\" id=\"formPrcEmergencyRequestInvestigando\" placeholder=\"Digite que se investiga con el estudio solicitado\" data-alias-from-server=\"prc_investigando\" maxlength=\"100\" style=\"resize: none\"
                                                      ";
        // line 230
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"100\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Justificación médica de la solicitud</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"1\" class=\"form-control\" name=\"formPrcEmergencyRequestJustificacionMedica\" id=\"formPrcEmergencyRequestJustificacionMedica\" placeholder=\"Digite la justificación de la solicitud del estudio\" data-alias-from-server=\"prc_justificacionMedica\" maxlength=\"100\" style=\"resize: none\"
                                                      ";
        // line 250
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"100\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"form-group\" style=\"";
        // line 268
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>
                
\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 278
        echo "\t    </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_prcEmergencyRequest\" name=\"btn_agregar_prcEmergencyRequest\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_prcEmergencyRequest\" name=\"btn_editar_prcEmergencyRequest\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_crearSolicitudEstudio_formatoRapido_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  495 => 278,  485 => 268,  465 => 250,  444 => 230,  423 => 210,  402 => 190,  392 => 181,  381 => 179,  377 => 178,  371 => 174,  367 => 172,  354 => 161,  340 => 148,  328 => 146,  322 => 145,  315 => 143,  303 => 141,  298 => 140,  293 => 139,  288 => 138,  283 => 134,  272 => 124,  261 => 122,  257 => 121,  246 => 112,  242 => 110,  233 => 103,  221 => 101,  207 => 98,  195 => 96,  190 => 95,  185 => 94,  180 => 93,  174 => 89,  170 => 87,  149 => 78,  143 => 77,  136 => 75,  119 => 72,  114 => 71,  104 => 66,  83 => 58,  79 => 57,  42 => 27,  22 => 4,  150 => 130,  31 => 12,  224 => 185,  218 => 180,  215 => 100,  178 => 143,  175 => 140,  139 => 106,  133 => 101,  130 => 98,  100 => 64,  94 => 60,  73 => 53,  69 => 51,  64 => 43,  61 => 42,  35 => 19,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  580 => 365,  577 => 364,  575 => 363,  567 => 362,  564 => 361,  561 => 360,  557 => 359,  555 => 358,  551 => 356,  549 => 355,  526 => 334,  523 => 331,  511 => 321,  501 => 313,  492 => 308,  480 => 301,  468 => 293,  461 => 290,  455 => 287,  447 => 282,  443 => 280,  437 => 277,  435 => 276,  407 => 250,  396 => 248,  391 => 247,  380 => 245,  375 => 244,  364 => 242,  360 => 241,  324 => 207,  306 => 190,  285 => 170,  268 => 154,  247 => 134,  230 => 118,  213 => 102,  202 => 92,  199 => 90,  192 => 82,  189 => 81,  184 => 148,  168 => 69,  164 => 67,  161 => 80,  156 => 63,  151 => 60,  148 => 59,  144 => 56,  138 => 54,  135 => 53,  128 => 49,  124 => 73,  120 => 47,  115 => 46,  110 => 70,  105 => 42,  99 => 39,  91 => 62,  75 => 48,  67 => 45,  57 => 17,  54 => 16,  46 => 12,  43 => 11,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
