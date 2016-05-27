<?php

/* MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_agregarEnCatalogoLocal_modal.html.twig */
class __TwigTemplate_bd7346a6e85cf89d7b1e1bfe78578ae226aa1e2936f20a68caedf243bc1f00a0 extends Twig_Template
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
        echo "<div id=\"agregar-en-catalogo-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-th\"></i> Agregar proyección a catálogo local</h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span class=\"label label-success-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"agregarEnLocalForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_proyeccion_establecimiento_agregarProyeccionEnLocal");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#exploracionRzTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-list-alt\"></span> Proyección <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"exploracionRzTab\" >

                                    <input type=\"hidden\" id=\"formExplExplrzIdProyeccion\" name=\"formExplExplrzIdProyeccion\" value=\"\" />
                                    <input type=\"hidden\" id=\"formExplExplrzIdExamenServicioDiagnostico\" name=\"formExplExplrzIdExamenServicioDiagnostico\" value=\"\" />
                                    <input type=\"hidden\" id=\"formExplExplrzIdAreaExmEstab\" name=\"formExplExplrzIdAreaExmEstab\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Proyección</label>
                                        <div class=\"col-xs-8\">
                                            <p class=\"form-control-static\" id=\"formExplExplrzIdProyeccion-static-label\"></p>
                                        </div>
                                    </div>
                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Examen</label>
                                        <div class=\"col-xs-8\">
                                            <p class=\"form-control-static\" id=\"formExplExplrzIdExamenServicioDiagnostico-static-label\"></p>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Modalidad</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formExplExplrzIdAreaServicioDiagnostico\" name=\"formExplExplrzIdAreaServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 64
        echo twig_escape_filter($this->env, (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "html", null, true);
        echo "\" data-apply-formatter=\"mld\"
                                                      ";
        // line 66
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Imagenología\">
                                                    ";
        // line 71
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 72
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
        // line 74
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-8 col-xs-offset-4\">
                                            <div class=\"checkbox\">
                                                <label>
                                                    <input type=\"checkbox\" value=\"1\" name=\"formExplExplrzHabilitado\" id=\"formExplExplrzHabilitado\" checked=\"checked\" /> Habilitada en local
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Observaciones</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formExplExplrzObservaciones\" id=\"formExplExplrzObservaciones\" placeholder=\"Escriba observaciones sobre la proyección en local\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 94
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
        // line 109
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-success-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>

\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 119
        echo "\t    </div>

        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_explrz\" name=\"btn_agregar_explrz\" class=\"btn btn-success-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Agregar</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_agregarEnCatalogoLocal_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 119,  146 => 109,  129 => 94,  97 => 72,  93 => 71,  86 => 66,  82 => 64,  349 => 258,  339 => 248,  322 => 233,  305 => 217,  244 => 159,  223 => 139,  212 => 137,  201 => 131,  171 => 105,  159 => 103,  154 => 102,  151 => 101,  144 => 99,  132 => 97,  127 => 96,  122 => 95,  112 => 90,  91 => 73,  42 => 27,  34 => 21,  22 => 4,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  503 => 252,  500 => 251,  492 => 249,  490 => 248,  486 => 246,  483 => 245,  475 => 243,  472 => 242,  470 => 241,  467 => 240,  459 => 239,  456 => 238,  454 => 237,  451 => 236,  443 => 234,  440 => 233,  437 => 231,  419 => 218,  411 => 212,  405 => 207,  402 => 204,  385 => 190,  381 => 188,  374 => 187,  371 => 186,  369 => 185,  366 => 184,  347 => 167,  341 => 162,  338 => 159,  325 => 149,  318 => 145,  313 => 142,  298 => 130,  291 => 127,  285 => 198,  277 => 119,  273 => 117,  267 => 114,  265 => 179,  262 => 112,  260 => 111,  254 => 109,  251 => 107,  238 => 100,  232 => 98,  222 => 94,  216 => 92,  211 => 89,  208 => 136,  197 => 129,  190 => 80,  181 => 76,  173 => 74,  170 => 73,  165 => 69,  162 => 68,  158 => 65,  152 => 63,  149 => 62,  141 => 58,  137 => 56,  133 => 55,  128 => 54,  123 => 51,  118 => 94,  113 => 47,  108 => 74,  106 => 45,  96 => 41,  87 => 39,  70 => 53,  67 => 25,  59 => 21,  53 => 18,  50 => 17,  45 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
