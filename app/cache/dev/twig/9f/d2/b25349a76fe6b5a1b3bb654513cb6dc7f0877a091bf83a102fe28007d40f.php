<?php

/* MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_crearSolicitud_modal.html.twig */
class __TwigTemplate_9fd2b25349a76fe6b5a1b3bb654513cb6dc7f0877a091bf83a102fe28007d40f extends Twig_Template
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
        echo "<div id=\"crearSolicitudDiag-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-paperclip\"></i> <i class=\"fa fa-reply-all\"></i> <span id=\"formSolicitudDiagTitle\">Solicitar diagnóstico radiológico</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formSolicitudDiagLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearSolicitudDiagForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_solicitud_diagnostico_crearSolicitudDiag");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#solicitudTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-book\"></span> Solicitud de diagnóstico <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"solicitudTab\" >

                                    <input type=\"hidden\" id=\"formSolicitudDiagId\" name=\"formSolicitudDiagId\" value=\"\" />
                                    <input type=\"hidden\" id=\"formSolicitudDiagIdSolicitudEstudio\" name=\"formSolicitudDiagIdSolicitudEstudio\" value=\"\" />
                                    <input type=\"hidden\" id=\"formSolicitudDiagIdEstudio\" name=\"formSolicitudDiagIdEstudio\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Solicitante</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formSolicitudDiagIdEmpleado\" name=\"formSolicitudDiagIdEmpleado\" class=\"form-control select2-select\" data-default=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"user\"
                                                      ";
        // line 51
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 55
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if (($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED")) {
                // line 56
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 57
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")));
                foreach ($context['_seq'] as $context["_key"] => $context["medico"]) {
                    if (((!(null === $this->getAttribute((isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 58
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
                // line 60
                echo "                                                    </optgroup>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")));
        foreach ($context['_seq'] as $context["_key"] => $context["medico"]) {
            if ((null === $this->getAttribute((isset($context["medico"]) ? $context["medico"] : $this->getContext($context, "medico")), "idTipoEmpleado"))) {
                // line 63
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
        // line 65
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-8 col-xs-offset-4\">
                                            <div class=\"checkbox\">
                                                <label>
                                                    <input type=\"checkbox\" value=\"1\" name=\"formSolicitudDiagRemota\" id=\"formSolicitudDiagRemota\" /> Solicitar a externo
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Se solicita se diagnostique en</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formSolicitudDiagIdEstablecimientoSolicitado\" name=\"formSolicitudDiagIdEstablecimientoSolicitado\" class=\"form-control select2-select\" data-default=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["defaultEstab"]) ? $context["defaultEstab"] : $this->getContext($context, "defaultEstab")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"std\"
                                                      ";
        // line 84
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 88
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEstab"]) ? $context["tiposEstab"] : $this->getContext($context, "tiposEstab")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            // line 89
            echo "                                                    <optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
            echo "\">
                                                    ";
            // line 90
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")));
            foreach ($context['_seq'] as $context["_key"] => $context["establecimiento"]) {
                if (((!(null === $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"))) && ($this->getAttribute($this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                    // line 91
                    echo "                                                        <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "id"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "nombre"), "html", null, true);
                    echo "</option>
                                                    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['establecimiento'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 93
            echo "                                                    </optgroup>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 95
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")));
        foreach ($context['_seq'] as $context["_key"] => $context["establecimiento"]) {
            if ((null === $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"))) {
                // line 96
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "nombre"), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['establecimiento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Justificación</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"2\" class=\"form-control\" name=\"formSolicitudDiagJustificacion\" id=\"formSolicitudDiagJustificacion\" placeholder=\"Justifique por qué desea diagnóstico del estudio (Añada si desea diagnóstico externo)\"  maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 107
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"255\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Observaciones</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formSolicitudDiagObservaciones\" id=\"formSolicitudDiagObservaciones\" placeholder=\"Digite sus observaciones adicionales\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 127
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"255\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Próxima consulta</label>
                                        <div class=\"col-xs-8\">
                                            <div class=\"input-group\">
                                                <span class='input-group-btn'>
                                                    <button class='demo btn btn-primary-v2 btn-large' id='showDateTimePicker'> <i class='glyphicon glyphicon-calendar'></i> </button>
                                                </span>
                                                <input type=\"text\" class=\"form-control\" placeholder=\"Próxima consulta médica\" id=\"formSolicitudDiagFechaProximaConsulta\" name=\"formSolicitudDiagFechaProximaConsulta\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\"
                                                      ";
        // line 148
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-date=\"true\"
                                                      data-fv-date-format=\"YYYY-MM-DD\"
                                                      data-fv-date-message=\"Formato no válido\" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"form-group\" style=\"";
        // line 162
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>
                
\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 172
        echo "\t    </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_soldiag\" name=\"btn_agregar_soldiag\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Agregar</button>
            <button type=\"submit\" id=\"btn_editar_soldiag\" name=\"btn_editar_soldiag\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
\t    <a title=\"Recuperar estudio realizado\" target=\"_blank\" class=\"btn btn-primary-v2\" href=\"javascript:void(0)\" id=\"btn_descargar_estudio_soldiag\"
\t\t";
        // line 182
        if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t<i class=\"fa fa-eye\"></i> Estudio</a>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_crearSolicitud_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  301 => 182,  289 => 172,  279 => 162,  263 => 148,  241 => 127,  220 => 107,  210 => 98,  198 => 96,  192 => 95,  185 => 93,  173 => 91,  168 => 90,  163 => 89,  159 => 88,  153 => 84,  149 => 82,  130 => 65,  118 => 63,  112 => 62,  104 => 60,  92 => 58,  87 => 57,  82 => 56,  77 => 55,  71 => 51,  67 => 49,  42 => 27,  34 => 21,  22 => 4,  19 => 2,);
    }
}
