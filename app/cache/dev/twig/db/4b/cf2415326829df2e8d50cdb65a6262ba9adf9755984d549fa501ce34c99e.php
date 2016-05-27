<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_crearSolicitudEstudio_formatoRapido_modal.html.twig */
class __TwigTemplate_db4bcf2415326829df2e8d50cdb65a6262ba9adf9755984d549fa501ce34c99e extends Twig_Template
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
        echo "<div id=\"crearSolicitudEstudioComplementarioFastFormat-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-eye\"></i> <i class=\"fa fa-pencil-square\"></i> <span id=\"formSolcmplFastRequestTitle\">Crear solicitud de estudio complementario - <span class=\"badge badge-primary-v2\" style=\"\">Formato rápido</span></span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formSolcmplFastRequestLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearSolicitudEstudioComplementarioFastFormat-form\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_complementario_crearSolicitudEstudioComplementarioFastFormat");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#solicitudSolcmplShortFormatTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-random\"></span> Solicitud de estudio <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"solicitudSolcmplShortFormatTab\" >

                                    <input type=\"hidden\" id=\"formSolcmplFastRequestId\" name=\"formSolcmplFastRequestId\" value=\"\" />
                                    <input type=\"hidden\" id=\"formSolcmplFastRequestIdSolicitudEstudio\" name=\"formSolcmplFastRequestIdSolicitudEstudio\" value=\"\" />
                                    <input type=\"hidden\" id=\"formSolcmplFastRequestIdEstudioPadre\" name=\"formSolcmplFastRequestIdEstudioPadre\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Radiólogo</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formSolcmplFastRequestIdRadiologo\" name=\"formSolcmplFastRequestIdRadiologo\" class=\"form-control select2-select\" data-default=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collection_default_empLogged"]) ? $context["collection_default_empLogged"] : $this->getContext($context, "collection_default_empLogged")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"user\"
                                                      ";
        // line 53
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 57
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_tiposEmpleado"]) ? $context["collection_tiposEmpleado"] : $this->getContext($context, "collection_tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 58
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 59
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["collection_radiologos"]) ? $context["collection_radiologos"] : $this->getContext($context, "collection_radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 60
                        echo "                                                        <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                        echo "\" ";
                        if (($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id") == $this->getAttribute((isset($context["collection_default_empLogged"]) ? $context["collection_default_empLogged"] : $this->getContext($context, "collection_default_empLogged")), "id"))) {
                            echo " selected ";
                        }
                        echo ">";
                        echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                        echo "</option>
                                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 62
                echo "                                                    </optgroup>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_radiologos"]) ? $context["collection_radiologos"] : $this->getContext($context, "collection_radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 65
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                echo "\" ";
                if (($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id") == $this->getAttribute((isset($context["collection_default_empLogged"]) ? $context["collection_default_empLogged"] : $this->getContext($context, "collection_default_empLogged")), "id"))) {
                    echo " selected ";
                }
                echo ">";
                echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Prioridad</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formSolcmplFastRequestIdPrioridadAtencion\" name=\"formSolcmplFastRequestIdPrioridadAtencion\" class=\"form-control select2-select\" data-default=\"";
        // line 74
        echo twig_escape_filter($this->env, (isset($context["collection_default_prAtn"]) ? $context["collection_default_prAtn"] : $this->getContext($context, "collection_default_prAtn")), "html", null, true);
        echo "\" data-apply-formatter=\"prAtn\"
                                                      ";
        // line 76
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 80
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_prioridades"]) ? $context["collection_prioridades"] : $this->getContext($context, "collection_prioridades")));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 81
            echo "                                                    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "id"), "html", null, true);
            echo "\" ";
            if (($this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "id") == (isset($context["collection_default_prAtn"]) ? $context["collection_default_prAtn"] : $this->getContext($context, "collection_default_prAtn")))) {
                echo " selected ";
            }
            echo ">";
            echo twig_escape_filter($this->env, (isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "html", null, true);
            echo "</option>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 83
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Justificación de la solicitud</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"2\" class=\"form-control\" name=\"formSolcmplFastRequestJustificacion\" id=\"formSolcmplFastRequestJustificacion\" placeholder=\"Digite la justificación de la solicitud del estudio\" maxlength=\"100\" style=\"resize: none\"
                                                      ";
        // line 92
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
                                        <label class=\"col-xs-4 control-label required\">Modalidad</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formSolcmplFastRequestIdAreaServicioDiagnostico\" name=\"formSolcmplFastRequestIdAreaServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 110
        echo twig_escape_filter($this->env, (isset($context["collection_default_mldRx"]) ? $context["collection_default_mldRx"] : $this->getContext($context, "collection_default_mldRx")), "html", null, true);
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
                                                <optgroup label=\"Servicio de Diagnóstico por imagen\">
                                                    ";
        // line 121
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_modalidades"]) ? $context["collection_modalidades"] : $this->getContext($context, "collection_modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 122
            echo "                                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id"), "html", null, true);
            echo "\" ";
            if (($this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id") == (isset($context["collection_default_mldRx"]) ? $context["collection_default_mldRx"] : $this->getContext($context, "collection_default_mldRx")))) {
                echo " selected ";
            }
            echo ">";
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
                                            <select id=\"formSolcmplFastRequestSolicitudEstudioProyeccion\" name=\"formSolcmplFastRequestSolicitudEstudioProyeccion[]\" class=\"form-control select2-select\" data-apply-formatter=\"pry\" multiple
                                                      ";
        // line 134
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                ";
        // line 138
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_examenes"]) ? $context["collection_examenes"] : $this->getContext($context, "collection_examenes")));
        foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
            // line 139
            echo "                                                    <optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "html", null, true);
            echo "\">
                                                    ";
            // line 140
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["collection_proyecciones"]) ? $context["collection_proyecciones"] : $this->getContext($context, "collection_proyecciones")));
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
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_proyecciones"]) ? $context["collection_proyecciones"] : $this->getContext($context, "collection_proyecciones")));
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
                                        <label class=\"col-xs-4 control-label\">Indicaciones para la realización del estudio</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"2\" class=\"form-control\" name=\"formSolcmplFastRequestIndicaciones\" id=\"formSolcmplFastRequestIndicaciones\" placeholder=\"Digite las indicaciones para el estudio\" style=\"resize: none\"
                                                      ";
        // line 157
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"form-group\" style=\"";
        // line 171
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>
                
\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 181
        echo "\t    </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
\t    <a title=\"Recuperar estudio realizado\" target=\"_blank\" class=\"btn btn-element-v2\" href=\"javascript:void(0)\" id=\"btn_descargar_estudio_solcmpl\"
\t\t";
        // line 187
        if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t<i class=\"fa fa-eye\"></i> Recuperar Estudio</a>

            <!-- --| custom buttons for footer -->
            <span class=\"btn-separator\"></span>
            
            <span class=\"text-info\" style=\"margin-left: 15px\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_solcmplFastRequest\" name=\"btn_agregar_solcmplFastRequest\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_solcmplFastRequest\" name=\"btn_editar_solcmplFastRequest\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_crearSolicitudEstudio_formatoRapido_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  354 => 187,  320 => 157,  310 => 148,  292 => 145,  285 => 143,  273 => 141,  263 => 139,  242 => 124,  227 => 122,  159 => 80,  149 => 74,  140 => 67,  110 => 62,  94 => 60,  89 => 59,  79 => 57,  73 => 53,  65 => 41,  59 => 23,  52 => 19,  39 => 13,  22 => 4,  58 => 30,  27 => 6,  19 => 2,  217 => 87,  214 => 86,  207 => 90,  204 => 89,  199 => 85,  196 => 84,  190 => 81,  185 => 80,  180 => 77,  175 => 76,  172 => 74,  170 => 72,  165 => 69,  161 => 68,  141 => 60,  136 => 59,  133 => 57,  122 => 52,  113 => 48,  106 => 45,  100 => 42,  95 => 39,  90 => 38,  84 => 58,  81 => 36,  75 => 35,  69 => 51,  63 => 31,  57 => 20,  34 => 21,  416 => 173,  413 => 172,  400 => 162,  397 => 161,  384 => 151,  381 => 150,  368 => 140,  365 => 139,  361 => 183,  358 => 172,  355 => 161,  352 => 150,  349 => 139,  346 => 181,  342 => 131,  340 => 130,  337 => 129,  333 => 127,  331 => 126,  328 => 125,  324 => 123,  322 => 122,  319 => 121,  314 => 113,  303 => 132,  301 => 129,  298 => 146,  296 => 125,  293 => 124,  291 => 121,  283 => 115,  281 => 112,  268 => 140,  265 => 100,  260 => 184,  258 => 138,  255 => 137,  253 => 134,  250 => 98,  239 => 91,  234 => 88,  225 => 86,  220 => 88,  216 => 82,  212 => 112,  208 => 110,  203 => 79,  198 => 76,  193 => 75,  184 => 71,  179 => 70,  169 => 66,  157 => 60,  151 => 64,  146 => 63,  134 => 48,  126 => 47,  118 => 64,  107 => 41,  103 => 40,  99 => 39,  83 => 27,  80 => 26,  72 => 22,  66 => 32,  60 => 16,  54 => 18,  51 => 11,  49 => 13,  43 => 6,  40 => 11,  651 => 437,  648 => 436,  640 => 434,  638 => 433,  610 => 407,  607 => 404,  595 => 394,  587 => 388,  580 => 387,  552 => 361,  541 => 359,  536 => 358,  525 => 356,  520 => 355,  509 => 353,  505 => 352,  492 => 341,  483 => 333,  458 => 309,  437 => 289,  404 => 257,  382 => 236,  357 => 212,  336 => 171,  311 => 112,  290 => 148,  269 => 128,  257 => 117,  249 => 115,  245 => 95,  236 => 112,  230 => 87,  223 => 121,  215 => 107,  211 => 105,  202 => 86,  197 => 103,  192 => 102,  188 => 92,  178 => 83,  174 => 67,  166 => 85,  163 => 81,  156 => 67,  153 => 76,  148 => 55,  138 => 63,  128 => 55,  124 => 65,  121 => 57,  116 => 49,  111 => 42,  108 => 50,  101 => 46,  97 => 45,  92 => 44,  86 => 41,  77 => 34,  56 => 29,  53 => 16,  45 => 16,  42 => 27,  37 => 9,  35 => 8,  33 => 7,  31 => 8,);
    }
}
