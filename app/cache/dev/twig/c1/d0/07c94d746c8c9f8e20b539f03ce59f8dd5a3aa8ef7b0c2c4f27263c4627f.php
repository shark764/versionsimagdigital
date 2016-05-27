<?php

/* MinsalSimagdBundle:ImgCtlProyeccionEstablecimientoAdmin:explrz_crearProyeccionLocal_modal.html.twig */
class __TwigTemplate_c1d007c94d746c8c9f8e20b539f03ce59f8dd5a3aa8ef7b0c2c4f27263c4627f extends Twig_Template
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
        echo "<div id=\"crearProyeccionLocal-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-h-square\"></i> <i class=\"fa fa-tasks\"></i> <span id=\"formExplrzTitle\">Nueva proyección en catálogo local</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formExplrzLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearProyeccionLocalForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_proyeccion_establecimiento_crearProyeccionLocal");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#exploracionLcTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-list-alt\"></span> Proyección <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"exploracionLcTab\" >

                                    <input type=\"hidden\" id=\"formExplrzId\" name=\"formExplrzId\" value=\"\" />
                                    <input type=\"hidden\" id=\"formExplrzIdProyeccionInsertada\" name=\"formExplrzIdProyeccionInsertada\" value=\"\" />
                                    <input type=\"hidden\" id=\"formExplrzNombreInsertada\" name=\"formExplrzNombreInsertada\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label required\">Modalidad</label>
                                        <div class=\"col-sm-8\">
                                            <select id=\"formExplrzIdAreaServicioDiagnostico\" name=\"formExplrzIdAreaServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 51
        echo twig_escape_filter($this->env, (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "html", null, true);
        echo "\" data-apply-formatter=\"mld\"
                                                      ";
        // line 53
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Imagenología\">
                                                    ";
        // line 58
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 59
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
        // line 61
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label required\">Examen</label>
                                        <div class=\"col-sm-8\">
                                            <select id=\"formExplrzIdExamenServicioDiagnostico\" name=\"formExplrzIdExamenServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 69
        echo twig_escape_filter($this->env, (isset($context["default_exmRx"]) ? $context["default_exmRx"] : $this->getContext($context, "default_exmRx")), "html", null, true);
        echo "\" data-apply-formatter=\"exm\"
                                                      ";
        // line 71
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 75
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sexos"]) ? $context["sexos"] : $this->getContext($context, "sexos")));
        foreach ($context['_seq'] as $context["_key"] => $context["sexo"]) {
            // line 76
            echo "                                                    <optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["sexo"]) ? $context["sexo"] : $this->getContext($context, "sexo")), "html", null, true);
            echo "\">
                                                    ";
            // line 77
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["examenes"]) ? $context["examenes"] : $this->getContext($context, "examenes")));
            foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
                if (((!(null === $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idsexo"))) && ($this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idsexo"), "id") == $this->getAttribute((isset($context["sexo"]) ? $context["sexo"] : $this->getContext($context, "sexo")), "id")))) {
                    // line 78
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
            // line 80
            echo "                                                    </optgroup>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sexo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo "                                                <optgroup label=\"Todos los sexos\">
                                                ";
        // line 83
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["examenes"]) ? $context["examenes"] : $this->getContext($context, "examenes")));
        foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
            if ((null === $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idsexo"))) {
                // line 84
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
        // line 86
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label required\">Proyección</label>
                                        <div class=\"col-sm-8\">
                                            <select id=\"formExplrzIdProyeccion\" name=\"formExplrzIdProyeccion\" class=\"form-control select2-select\" data-apply-formatter=\"pry\"
                                                      ";
        // line 96
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Proyección insertada\">
                                                </optgroup>
                                                <optgroup label=\"Proyecciones\">
                                                    ";
        // line 103
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")));
        foreach ($context['_seq'] as $context["_key"] => $context["exploracion"]) {
            // line 104
            echo "                                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exploracion"]) ? $context["exploracion"] : $this->getContext($context, "exploracion")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["exploracion"]) ? $context["exploracion"] : $this->getContext($context, "exploracion")), "html", null, true);
            echo "</option>
                                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exploracion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 106
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-sm-8 col-sm-offset-4\">
                                            <div class=\"checkbox\">
                                                <label>
                                                    <input type=\"checkbox\" value=\"1\" name=\"formExplrzHabilitado\" id=\"formExplrzHabilitado\" /> Habilitada
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Observaciones</label>
                                        <div class=\"col-sm-8\">
                                            <textarea rows=\"4\" class=\"form-control\" name=\"formExplrzObservaciones\" id=\"formExplrzObservaciones\" placeholder=\"Digite sus observaciones adicionales\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 126
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
                            </div>

                            <div class=\"form-group\" style=\"";
        // line 141
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>

\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 151
        echo "\t    </div>

        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_crear_explrz\" name=\"btn_crear_explrz\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_explrz\" name=\"btn_editar_explrz\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Continuar</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlProyeccionEstablecimientoAdmin:explrz_crearProyeccionLocal_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  241 => 141,  224 => 126,  203 => 106,  192 => 104,  188 => 103,  179 => 96,  168 => 86,  148 => 82,  124 => 77,  119 => 76,  115 => 75,  109 => 71,  105 => 69,  95 => 61,  84 => 59,  80 => 58,  73 => 53,  69 => 51,  156 => 84,  146 => 109,  129 => 78,  97 => 72,  93 => 71,  86 => 66,  82 => 64,  349 => 258,  339 => 248,  322 => 233,  305 => 217,  244 => 159,  223 => 139,  212 => 137,  201 => 131,  171 => 105,  159 => 103,  154 => 102,  151 => 83,  144 => 99,  132 => 97,  127 => 96,  122 => 95,  112 => 90,  91 => 73,  42 => 27,  34 => 21,  22 => 4,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  503 => 252,  500 => 251,  492 => 249,  490 => 248,  486 => 246,  483 => 245,  475 => 243,  472 => 242,  470 => 241,  467 => 240,  459 => 239,  456 => 238,  454 => 237,  451 => 236,  443 => 234,  440 => 233,  437 => 231,  419 => 218,  411 => 212,  405 => 207,  402 => 204,  385 => 190,  381 => 188,  374 => 187,  371 => 186,  369 => 185,  366 => 184,  347 => 167,  341 => 162,  338 => 159,  325 => 149,  318 => 145,  313 => 142,  298 => 130,  291 => 127,  285 => 198,  277 => 119,  273 => 117,  267 => 114,  265 => 179,  262 => 112,  260 => 111,  254 => 109,  251 => 151,  238 => 100,  232 => 98,  222 => 94,  216 => 92,  211 => 89,  208 => 136,  197 => 129,  190 => 80,  181 => 76,  173 => 74,  170 => 73,  165 => 69,  162 => 68,  158 => 65,  152 => 63,  149 => 62,  141 => 80,  137 => 56,  133 => 55,  128 => 54,  123 => 51,  118 => 94,  113 => 47,  108 => 74,  106 => 45,  96 => 41,  87 => 39,  70 => 53,  67 => 25,  59 => 21,  53 => 18,  50 => 17,  45 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
