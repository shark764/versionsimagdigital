<?php

/* MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_crearProyeccion_modal.html.twig */
class __TwigTemplate_b8a5b28c7ae0a7cf3e2b43ae4c5f9259baa8757831d2b9ba564866d85fec39c2 extends Twig_Template
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
        echo "<div id=\"crearProyeccion-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-tasks\"></i> <span id=\"formExplTitle\">Registrar proyección imagenológica</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formExplLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearProyeccionForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_proyeccion_crearProyeccion");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#exploracionTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-list-alt\"></span> Proyección <i class=\"fa\"></i></a></li>
                                <li><a href=\"#detallesExplTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-paperclip\"></span> Detalles <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"exploracionTab\" >

                                    <input type=\"hidden\" id=\"formExplId\" name=\"formExplId\" value=\"\" />
                                    <input type=\"hidden\" id=\"formExplIdExamen\" name=\"formExplIdExamen\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label required\">Nombre</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"text\" class=\"form-control\" id=\"formExplNombre\" name=\"formExplNombre\" placeholder=\"Nombre de la proyección\" maxlength=\"100\"
                                                      ";
        // line 53
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"5\"
                                                      data-fv-stringlength-max=\"100\"
                                                      data-fv-stringlength-message=\"5 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Código</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"text\" class=\"form-control\" id=\"formExplCodigo\" name=\"formExplCodigo\" placeholder=\"Código de la proyección\" maxlength=\"10\"
                                                      ";
        // line 73
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"4\"
                                                      data-fv-stringlength-max=\"10\"
                                                      data-fv-stringlength-message=\"4 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-Z0-9]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label required\">Examen</label>
                                        <div class=\"col-sm-8\">
                                            <select id=\"formExplIdExamenServicioDiagnostico\" name=\"formExplIdExamenServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 88
        echo twig_escape_filter($this->env, (isset($context["default_exmRx"]) ? $context["default_exmRx"] : $this->getContext($context, "default_exmRx")), "html", null, true);
        echo "\" data-apply-formatter=\"exm\"
                                                      ";
        // line 90
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 94
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sexos"]) ? $context["sexos"] : $this->getContext($context, "sexos")));
        foreach ($context['_seq'] as $context["_key"] => $context["sexo"]) {
            // line 95
            echo "                                                    <optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["sexo"]) ? $context["sexo"] : $this->getContext($context, "sexo")), "html", null, true);
            echo "\">
                                                    ";
            // line 96
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["examenes"]) ? $context["examenes"] : $this->getContext($context, "examenes")));
            foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
                if (((!(null === $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idsexo"))) && ($this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idsexo"), "id") == $this->getAttribute((isset($context["sexo"]) ? $context["sexo"] : $this->getContext($context, "sexo")), "id")))) {
                    // line 97
                    echo "                                                        <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "id"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "html", null, true);
                    echo "</option>
                                                    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['examen'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 99
            echo "                                                    </optgroup>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sexo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        echo "                                                <optgroup label=\"Todos los sexos\">
                                                ";
        // line 102
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["examenes"]) ? $context["examenes"] : $this->getContext($context, "examenes")));
        foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
            if ((null === $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idsexo"))) {
                // line 103
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['examen'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=\"form-group\" style=\"display: none;\">
                                        <label class=\"col-xs-4 control-label\">Examen</label>
                                        <div class=\"col-xs-8\">
                                            <p class=\"form-control-static\" id=\"formExplIdExamenServicioDiagnostico-static-label\"></p>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-sm-8 col-sm-offset-4\">
                                            <div class=\"checkbox\">
                                                <label>
                                                    <input type=\"checkbox\" value=\"1\" name=\"formExplProyeccionRealizable\" id=\"formExplProyeccionRealizable\" /> Agregar en catálogo local
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Modalidad</label>
                                        <div class=\"col-sm-8\">
                                            <select id=\"formExplIdAreaServicioDiagnostico\" name=\"formExplIdAreaServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 129
        echo twig_escape_filter($this->env, (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "html", null, true);
        echo "\" data-apply-formatter=\"mld\" disabled=\"disabled\"
                                                      ";
        // line 131
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Imagenología\">
                                                    ";
        // line 136
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 137
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
        // line 139
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-8 col-xs-offset-4\">
                                            <div class=\"checkbox\">
                                                <label>
                                                    <input type=\"checkbox\" value=\"1\" name=\"formExplHabilitadoLocal\" id=\"formExplHabilitadoLocal\" disabled=\"disabled\" /> Habilitada en local
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Observaciones (Local)</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formExplObservacionesLocal\" id=\"formExplObservacionesLocal\" placeholder=\"Escriba observaciones sobre la proyección en local\" maxlength=\"255\" style=\"resize: none\" readonly=\"readonly\"
                                                      ";
        // line 159
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
                                <div class=\"tab-pane fade\" id=\"detallesExplTab\" >

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Tiempo ocupado en sala (min)</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"number\" class=\"form-control\" id=\"formExplTiempoOcupacionSala\" name=\"formExplTiempoOcupacionSala\" placeholder=\"Tiempo ocupado en sala ( en minutos )\" value=\"5\" data-default=\"5\" min=\"1\" max=\"32767\"
                                                      ";
        // line 179
        echo "
                                                      data-fv-integer=\"true\"
                                                      data-fv-integer-message=\"El valor no es un entero\"

                                                      data-fv-greaterthan-inclusive=\"true\"
                                                      data-fv-greaterthan-value=\"1\"
                                                      data-fv-greaterthan-message=\"Debe ser mayor o igual a 1\"

                                                      data-fv-lessthan-inclusive=\"true\"
                                                      data-fv-lessthan-value=\"32767\"
                                                      data-fv-lessthan-message=\"Debe ser menor o igual a 32767\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Tiempo de médico (min)</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"number\" class=\"form-control\" id=\"formExplTiempoMedico\" name=\"formExplTiempoMedico\" placeholder=\"Tiempo de médico ( en minutos )\" value=\"5\" data-default=\"5\" min=\"1\" max=\"32767\"
                                                      ";
        // line 198
        echo "
                                                      data-fv-integer=\"true\"
                                                      data-fv-integer-message=\"El valor no es un entero\"

                                                      data-fv-greaterthan-inclusive=\"true\"
                                                      data-fv-greaterthan-value=\"1\"
                                                      data-fv-greaterthan-message=\"Debe ser mayor o igual a 1\"

                                                      data-fv-lessthan-inclusive=\"true\"
                                                      data-fv-lessthan-value=\"32767\"
                                                      data-fv-lessthan-message=\"Debe ser menor o igual a 32767\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Descripción</label>
                                        <div class=\"col-sm-8\">
                                            <textarea rows=\"4\" class=\"form-control\" name=\"formExplDescripcion\" id=\"formExplDescripcion\" placeholder=\"Describa en qué consiste la proyección imagenológica\" style=\"resize: none\"
                                                      ";
        // line 217
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Observaciones</label>
                                        <div class=\"col-sm-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formExplObservaciones\" id=\"formExplObservaciones\" placeholder=\"Digite sus observaciones adicionales\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 233
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
                                    
\t\t\t\t</div>
\t\t\t    </div><!-- tab content -->

                            <div class=\"form-group\" style=\"";
        // line 248
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>

\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 258
        echo "\t    </div>

        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_expl\" name=\"btn_agregar_expl\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_expl\" name=\"btn_editar_expl\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Continuar</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal -->
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_crearProyeccion_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  349 => 258,  339 => 248,  322 => 233,  305 => 217,  244 => 159,  223 => 139,  212 => 137,  201 => 131,  171 => 105,  159 => 103,  154 => 102,  151 => 101,  144 => 99,  132 => 97,  127 => 96,  122 => 95,  112 => 90,  91 => 73,  42 => 27,  34 => 21,  22 => 4,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  503 => 252,  500 => 251,  492 => 249,  490 => 248,  486 => 246,  483 => 245,  475 => 243,  472 => 242,  470 => 241,  467 => 240,  459 => 239,  456 => 238,  454 => 237,  451 => 236,  443 => 234,  440 => 233,  437 => 231,  419 => 218,  411 => 212,  405 => 207,  402 => 204,  385 => 190,  381 => 188,  374 => 187,  371 => 186,  369 => 185,  366 => 184,  347 => 167,  341 => 162,  338 => 159,  325 => 149,  318 => 145,  313 => 142,  298 => 130,  291 => 127,  285 => 198,  277 => 119,  273 => 117,  267 => 114,  265 => 179,  262 => 112,  260 => 111,  254 => 109,  251 => 107,  238 => 100,  232 => 98,  222 => 94,  216 => 92,  211 => 89,  208 => 136,  197 => 129,  190 => 80,  181 => 76,  173 => 74,  170 => 73,  165 => 69,  162 => 68,  158 => 65,  152 => 63,  149 => 62,  141 => 58,  137 => 56,  133 => 55,  128 => 54,  123 => 51,  118 => 94,  113 => 47,  108 => 88,  106 => 45,  96 => 41,  87 => 39,  70 => 53,  67 => 25,  59 => 21,  53 => 18,  50 => 17,  45 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
