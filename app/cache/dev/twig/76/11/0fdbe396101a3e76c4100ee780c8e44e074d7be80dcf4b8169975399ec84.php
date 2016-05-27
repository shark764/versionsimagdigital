<?php

/* MinsalSimagdBundle:ImgCtlPatronDiagnosticoAdmin:ptrDiag_crearPatronDiagnostico_modal.html.twig */
class __TwigTemplate_76110fdbe396101a3e76c4100ee780c8e44e074d7be80dcf4b8169975399ec84 extends Twig_Template
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
        echo "<div id=\"crearPatronDiagnostico-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-microphone\"></i> <span id=\"formPtrDiagTitle\">Crear patrón para diagnóstico</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formPtrDiagLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearPatronDiagnosticoForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_patron_diagnostico_crearPatronDiagnostico");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked ";
        // line 35
        echo " col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#generalesTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-user\"></span> Datos generales <i class=\"fa\"></i></a></li>
                                <li><a href=\"#patronTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-paperclip\"></span> Patrón <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content ";
        // line 42
        echo " col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"generalesTab\" >

                                    <input type=\"hidden\" id=\"formPtrDiagId\" name=\"formPtrDiagId\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label required\">Nombre</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"text\" class=\"form-control\" id=\"formPtrDiagNombre\" name=\"formPtrDiagNombre\" placeholder=\"Nombre del patrón de resultados\" maxlength=\"255\"
                                                      ";
        // line 52
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"5\"
                                                      data-fv-stringlength-max=\"255\"
                                                      data-fv-stringlength-message=\"5 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Código</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"text\" class=\"form-control\" id=\"formPtrDiagCodigo\" name=\"formPtrDiagCodigo\" placeholder=\"Código del patrón de resultados\" maxlength=\"6\"
                                                      ";
        // line 72
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"4\"
                                                      data-fv-stringlength-max=\"6\"
                                                      data-fv-stringlength-message=\"4 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-Z0-9]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Ingresa</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formPtrDiagIdEmpleado\" name=\"formPtrDiagIdEmpleado\" class=\"form-control select2-select\" data-default=\"";
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
            if ((((((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "ACL") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "ENF")) || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED")) || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY")) || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "CIT")) || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "ARC"))) {
                // line 94
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 95
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["empleados"]) ? $context["empleados"] : $this->getContext($context, "empleados")));
                foreach ($context['_seq'] as $context["_key"] => $context["empleado"]) {
                    if (((!(null === $this->getAttribute((isset($context["empleado"]) ? $context["empleado"] : $this->getContext($context, "empleado")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["empleado"]) ? $context["empleado"] : $this->getContext($context, "empleado")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 96
                        echo "                                                        <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["empleado"]) ? $context["empleado"] : $this->getContext($context, "empleado")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["empleado"]) ? $context["empleado"] : $this->getContext($context, "empleado")), "html", null, true);
                        echo "</option>
                                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['empleado'], $context['_parent'], $context['loop']);
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
        $context['_seq'] = twig_ensure_traversable((isset($context["empleados"]) ? $context["empleados"] : $this->getContext($context, "empleados")));
        foreach ($context['_seq'] as $context["_key"] => $context["empleado"]) {
            if ((null === $this->getAttribute((isset($context["empleado"]) ? $context["empleado"] : $this->getContext($context, "empleado")), "idTipoEmpleado"))) {
                // line 101
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["empleado"]) ? $context["empleado"] : $this->getContext($context, "empleado")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["empleado"]) ? $context["empleado"] : $this->getContext($context, "empleado")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['empleado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label required\">Modalidad</label>
                                        <div class=\"col-sm-8\">
                                            <select id=\"formPtrDiagIdAreaServicioDiagnostico\" name=\"formPtrDiagIdAreaServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 110
        echo twig_escape_filter($this->env, (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "html", null, true);
        echo "\" data-apply-formatter=\"mld\"
                                                      ";
        // line 112
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Imagenología\">
                                                    ";
        // line 117
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 118
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
        // line 120
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Tipo de resultado</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formPtrDiagIdTipoResultado\" name=\"formPtrDiagIdTipoResultado\" class=\"form-control select2-select\" data-default=\"";
        // line 128
        echo twig_escape_filter($this->env, (isset($context["tipoResultDefault"]) ? $context["tipoResultDefault"] : $this->getContext($context, "tipoResultDefault")), "html", null, true);
        echo "\"
                                                      ";
        // line 130
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Determinado\">
                                                    ";
        // line 135
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposResultado"]) ? $context["tiposResultado"] : $this->getContext($context, "tiposResultado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipoResultado"]) {
            if (($this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "getIndeterminado") == false)) {
                // line 136
                echo "                                                        <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "html", null, true);
                echo "</option>
                                                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipoResultado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 138
        echo "                                                </optgroup>
                                                <optgroup label=\"Indeterminado\">
                                                    ";
        // line 140
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposResultado"]) ? $context["tiposResultado"] : $this->getContext($context, "tiposResultado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipoResultado"]) {
            if (($this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "getIndeterminado") != false)) {
                // line 141
                echo "                                                        <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "html", null, true);
                echo "</option>
                                                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipoResultado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 143
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Radiólogo</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formPtrDiagIdRadiologoDefine\" name=\"formPtrDiagIdRadiologoDefine\" class=\"form-control select2-select\" data-default=\"";
        // line 151
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"user\" >
                                                <option value=\"\"></option>
                                                ";
        // line 153
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 154
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 155
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 156
                        echo "                                                        <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                        echo "</option>
                                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 158
                echo "                                                    </optgroup>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 160
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 161
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 163
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Indicaciones generales</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formPtrDiagIndicacionesGenerales\" id=\"formPtrDiagIndicacionesGenerales\" placeholder=\"Indicaciones para el uso de esta plantilla\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 172
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
                                        <label class=\"col-xs-4 control-label\">Observaciones</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formPtrDiagObservaciones\" id=\"formPtrDiagObservaciones\" placeholder=\"Digite sus observaciones adicionales\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 189
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

                                </div>
                                <div class=\"tab-pane fade\" id=\"patronTab\" >

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Hallazgos</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"7\" class=\"form-control summernote\" name=\"formPtrDiagHallazgos\" id=\"formPtrDiagHallazgos\" ";
        // line 207
        echo " ";
        // line 215
        echo " /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Conclusión</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"4\" class=\"form-control summernote\" name=\"formPtrDiagConclusion\" id=\"formPtrDiagConclusion\" ";
        // line 222
        echo " ";
        // line 230
        echo " /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Recomendaciones</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"5\" class=\"form-control summernote\" name=\"formPtrDiagRecomendaciones\" id=\"formPtrDiagRecomendaciones\" ";
        // line 237
        echo " ";
        // line 243
        echo " /></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"form-group\" style=\"";
        // line 250
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>
                
\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 260
        echo "\t    </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_ptrDiag\" name=\"btn_agregar_ptrDiag\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_ptrDiag\" name=\"btn_editar_ptrDiag\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlPatronDiagnosticoAdmin:ptrDiag_crearPatronDiagnostico_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 414,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 392,  862 => 389,  844 => 385,  834 => 382,  802 => 373,  796 => 369,  768 => 352,  747 => 340,  708 => 321,  698 => 313,  677 => 293,  630 => 263,  787 => 404,  784 => 403,  776 => 401,  494 => 240,  564 => 189,  561 => 188,  456 => 170,  431 => 208,  634 => 356,  628 => 354,  601 => 319,  545 => 304,  350 => 175,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 405,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 352,  596 => 231,  578 => 270,  534 => 176,  507 => 186,  447 => 236,  445 => 216,  419 => 200,  454 => 160,  371 => 174,  651 => 437,  483 => 180,  404 => 184,  517 => 283,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 150,  622 => 204,  531 => 224,  498 => 182,  468 => 163,  458 => 204,  401 => 199,  369 => 165,  356 => 147,  340 => 141,  874 => 781,  854 => 388,  851 => 387,  836 => 361,  831 => 381,  828 => 380,  825 => 357,  820 => 318,  817 => 376,  813 => 349,  799 => 341,  792 => 367,  773 => 327,  766 => 351,  763 => 350,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 327,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 340,  637 => 262,  604 => 320,  588 => 239,  573 => 294,  559 => 187,  547 => 274,  520 => 215,  450 => 173,  408 => 243,  363 => 181,  359 => 280,  348 => 134,  345 => 133,  336 => 163,  316 => 154,  307 => 147,  261 => 111,  266 => 112,  542 => 230,  538 => 177,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 213,  223 => 130,  585 => 224,  551 => 276,  546 => 308,  506 => 103,  503 => 193,  488 => 261,  485 => 268,  478 => 176,  475 => 164,  471 => 173,  448 => 217,  386 => 215,  378 => 181,  375 => 157,  306 => 146,  291 => 142,  286 => 140,  392 => 178,  332 => 139,  318 => 160,  276 => 137,  190 => 144,  12 => 36,  195 => 95,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 400,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 374,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 389,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 381,  706 => 380,  703 => 379,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 275,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 323,  613 => 350,  610 => 349,  608 => 197,  605 => 253,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 190,  533 => 203,  530 => 150,  513 => 168,  496 => 280,  441 => 185,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 199,  395 => 222,  391 => 171,  382 => 195,  372 => 184,  364 => 189,  353 => 175,  335 => 154,  333 => 151,  297 => 144,  292 => 121,  205 => 89,  200 => 97,  184 => 65,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 418,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 403,  900 => 385,  897 => 384,  891 => 399,  884 => 397,  881 => 270,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 400,  754 => 208,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 344,  726 => 341,  723 => 326,  719 => 383,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 378,  696 => 291,  690 => 285,  687 => 173,  681 => 372,  673 => 291,  671 => 280,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 264,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 520,  592 => 519,  589 => 247,  587 => 388,  584 => 320,  576 => 324,  574 => 242,  570 => 291,  567 => 290,  554 => 311,  552 => 235,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 250,  502 => 184,  477 => 196,  472 => 132,  465 => 222,  463 => 208,  446 => 244,  443 => 215,  429 => 183,  425 => 195,  410 => 167,  397 => 230,  394 => 179,  389 => 177,  357 => 165,  342 => 172,  334 => 157,  330 => 158,  328 => 140,  290 => 137,  287 => 120,  263 => 205,  255 => 122,  245 => 102,  194 => 117,  76 => 33,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 401,  888 => 398,  882 => 396,  873 => 267,  868 => 282,  864 => 390,  860 => 327,  856 => 279,  852 => 324,  848 => 386,  843 => 257,  838 => 383,  832 => 271,  826 => 247,  823 => 268,  819 => 377,  814 => 265,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 395,  758 => 346,  756 => 318,  751 => 392,  739 => 200,  736 => 347,  733 => 386,  725 => 385,  722 => 384,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 322,  606 => 321,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 329,  580 => 387,  572 => 218,  568 => 241,  562 => 313,  556 => 307,  550 => 183,  535 => 271,  526 => 222,  521 => 171,  515 => 258,  497 => 243,  492 => 341,  481 => 218,  476 => 175,  467 => 221,  451 => 213,  424 => 182,  418 => 192,  412 => 198,  399 => 154,  396 => 153,  390 => 187,  388 => 190,  383 => 200,  377 => 169,  373 => 179,  370 => 154,  367 => 153,  352 => 157,  349 => 162,  346 => 172,  329 => 155,  326 => 156,  313 => 136,  303 => 145,  300 => 208,  234 => 164,  218 => 169,  207 => 161,  178 => 70,  321 => 134,  295 => 142,  274 => 210,  242 => 110,  236 => 112,  692 => 175,  683 => 373,  678 => 371,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 269,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 246,  579 => 299,  577 => 318,  575 => 252,  569 => 191,  565 => 314,  548 => 207,  540 => 273,  536 => 358,  529 => 174,  524 => 173,  516 => 143,  510 => 185,  504 => 185,  500 => 206,  490 => 201,  486 => 275,  482 => 285,  470 => 225,  464 => 180,  459 => 171,  452 => 145,  434 => 209,  421 => 205,  417 => 250,  385 => 185,  361 => 180,  344 => 157,  339 => 147,  324 => 161,  310 => 158,  302 => 145,  296 => 122,  282 => 114,  259 => 96,  244 => 157,  231 => 162,  226 => 86,  114 => 37,  104 => 37,  288 => 154,  284 => 162,  279 => 129,  275 => 208,  256 => 141,  250 => 179,  237 => 151,  232 => 113,  222 => 57,  215 => 156,  191 => 80,  153 => 59,  563 => 223,  560 => 222,  558 => 236,  555 => 185,  553 => 211,  549 => 182,  543 => 179,  537 => 272,  532 => 270,  528 => 173,  525 => 356,  523 => 221,  518 => 170,  514 => 168,  511 => 167,  508 => 208,  501 => 161,  495 => 158,  491 => 239,  487 => 156,  460 => 143,  455 => 215,  449 => 187,  442 => 210,  439 => 209,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 202,  405 => 118,  403 => 117,  400 => 182,  380 => 107,  366 => 182,  354 => 101,  331 => 141,  325 => 94,  320 => 144,  317 => 131,  311 => 148,  308 => 128,  304 => 152,  272 => 81,  267 => 131,  249 => 108,  216 => 70,  155 => 77,  152 => 87,  146 => 49,  126 => 94,  181 => 119,  161 => 54,  110 => 35,  188 => 91,  186 => 119,  170 => 63,  150 => 64,  124 => 68,  358 => 179,  351 => 135,  347 => 174,  343 => 146,  338 => 158,  327 => 154,  323 => 128,  319 => 151,  315 => 132,  301 => 124,  299 => 148,  293 => 155,  289 => 141,  281 => 118,  277 => 105,  271 => 105,  265 => 176,  262 => 97,  260 => 98,  257 => 202,  251 => 140,  248 => 103,  239 => 117,  228 => 160,  225 => 109,  213 => 155,  211 => 80,  197 => 125,  174 => 103,  148 => 98,  134 => 49,  127 => 89,  20 => 2,  53 => 35,  270 => 209,  253 => 201,  233 => 101,  212 => 93,  210 => 127,  206 => 88,  202 => 79,  198 => 118,  192 => 128,  185 => 94,  180 => 64,  175 => 68,  172 => 131,  167 => 83,  165 => 65,  160 => 79,  137 => 51,  113 => 51,  100 => 67,  90 => 59,  81 => 41,  129 => 54,  84 => 27,  77 => 26,  34 => 21,  118 => 54,  97 => 30,  70 => 22,  65 => 41,  58 => 16,  23 => 4,  480 => 179,  474 => 195,  469 => 150,  461 => 218,  457 => 216,  453 => 169,  444 => 230,  440 => 172,  437 => 203,  435 => 208,  430 => 172,  427 => 260,  423 => 206,  413 => 160,  409 => 195,  407 => 157,  402 => 193,  398 => 115,  393 => 112,  387 => 176,  384 => 207,  381 => 173,  379 => 194,  374 => 168,  368 => 190,  365 => 165,  362 => 141,  360 => 104,  355 => 156,  341 => 123,  337 => 97,  322 => 93,  314 => 149,  312 => 141,  309 => 118,  305 => 134,  298 => 156,  294 => 143,  285 => 115,  283 => 153,  278 => 151,  268 => 143,  264 => 201,  258 => 127,  252 => 121,  247 => 138,  241 => 88,  229 => 82,  220 => 80,  214 => 82,  177 => 72,  169 => 129,  140 => 53,  132 => 69,  128 => 45,  107 => 34,  61 => 26,  273 => 106,  269 => 113,  254 => 105,  243 => 172,  240 => 195,  238 => 104,  235 => 136,  230 => 135,  227 => 92,  224 => 163,  221 => 154,  219 => 128,  217 => 132,  208 => 104,  204 => 116,  179 => 136,  159 => 63,  143 => 93,  135 => 71,  119 => 43,  102 => 36,  71 => 29,  67 => 42,  63 => 25,  59 => 23,  38 => 9,  94 => 72,  89 => 28,  85 => 54,  75 => 53,  68 => 27,  56 => 37,  201 => 88,  196 => 87,  183 => 110,  171 => 65,  166 => 63,  163 => 107,  158 => 58,  156 => 100,  151 => 55,  142 => 54,  138 => 57,  136 => 96,  121 => 93,  117 => 46,  105 => 40,  91 => 31,  62 => 42,  49 => 16,  28 => 9,  26 => 7,  87 => 29,  31 => 8,  25 => 5,  21 => 2,  24 => 4,  19 => 2,  93 => 39,  88 => 36,  78 => 55,  46 => 15,  44 => 14,  27 => 6,  79 => 54,  72 => 23,  69 => 30,  47 => 12,  40 => 15,  37 => 14,  22 => 4,  246 => 121,  157 => 67,  145 => 55,  139 => 66,  131 => 95,  123 => 57,  120 => 67,  115 => 89,  111 => 87,  108 => 48,  101 => 31,  98 => 42,  96 => 33,  83 => 35,  74 => 23,  66 => 18,  55 => 20,  52 => 19,  50 => 28,  43 => 14,  41 => 9,  35 => 13,  32 => 5,  29 => 11,  209 => 120,  203 => 87,  199 => 134,  193 => 124,  189 => 79,  187 => 112,  182 => 85,  176 => 63,  173 => 114,  168 => 61,  164 => 60,  162 => 101,  154 => 63,  149 => 60,  147 => 69,  144 => 68,  141 => 104,  133 => 61,  130 => 46,  125 => 44,  122 => 88,  116 => 48,  112 => 66,  109 => 38,  106 => 61,  103 => 58,  99 => 35,  95 => 59,  92 => 38,  86 => 44,  82 => 27,  80 => 53,  73 => 52,  64 => 19,  60 => 18,  57 => 16,  54 => 37,  51 => 20,  48 => 17,  45 => 16,  42 => 27,  39 => 13,  36 => 6,  33 => 13,  30 => 7,);
    }
}
