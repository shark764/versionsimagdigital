<?php

/* MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_agregarElementosListaLocal_modal.html.twig */
class __TwigTemplate_4d442ffe455e89cdca629be9671f8a00a626ead9c851b31ec867f5c6ae701188 extends Twig_Template
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
<div id=\"asignarProyeccionListaLocal-modal\" class=\"modal fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\" aria-labelledby=\"mySmallModalLabel\" data-width=\"760\">
    <div class=\"modal-content panel-element-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-list-alt\"></i> <i class=\"fa fa-hospital-o\"></i> Agregar proyecciones a lista local</h4>
        </div>

        <div class=\"modal-body\">
            <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">

                <form id=\"asignarProyeccionListaLocal-form\" action=\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("simagd_proyeccion_asignarElementoListaLocal");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
                    data-fv-framework=\"bootstrap\"
                    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
                    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
                    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

                    data-fv-message=\"El valor introducido no es válido\">

                    <div class=\"form-group\">
                        <label class=\"col-sm-4 control-label required\">Modalidad de Diagnóstico por imagen</label>
                        <div class=\"col-sm-8\">
                            <select id=\"formPryLocalListIdAreaServicioApoyo\" name=\"formPryLocalListIdAreaServicioApoyo\" class=\"form-control select2-select\" data-default=\"";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "html", null, true);
        echo "\" data-apply-formatter=\"mld\"
                                      ";
        // line 26
        echo "
                                      data-fv-notempty=\"true\"
                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                <option value=\"\"></option>
                                <optgroup label=\"Imagenología\">
                                    ";
        // line 31
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 32
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "html", null, true);
            echo "</option>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modalidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "                                </optgroup>
                            </select>
                        </div>
                    </div>

                </form>
                
            </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_pryXLocalList\" name=\"btn_agregar_pryXLocalList\" class=\"btn btn-element-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_agregarElementosListaLocal_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 34,  61 => 32,  57 => 31,  46 => 24,  32 => 13,  241 => 141,  224 => 126,  203 => 106,  192 => 104,  188 => 103,  179 => 96,  168 => 86,  148 => 82,  124 => 77,  119 => 76,  115 => 75,  109 => 71,  105 => 69,  95 => 61,  84 => 59,  80 => 58,  73 => 53,  69 => 51,  156 => 84,  146 => 109,  129 => 78,  97 => 72,  93 => 71,  86 => 66,  82 => 64,  349 => 258,  339 => 248,  322 => 233,  305 => 217,  244 => 159,  223 => 139,  212 => 137,  201 => 131,  171 => 105,  159 => 103,  154 => 102,  151 => 83,  144 => 99,  132 => 97,  127 => 96,  122 => 95,  112 => 90,  91 => 73,  42 => 27,  34 => 21,  22 => 4,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  503 => 252,  500 => 251,  492 => 249,  490 => 248,  486 => 246,  483 => 245,  475 => 243,  472 => 242,  470 => 241,  467 => 240,  459 => 239,  456 => 238,  454 => 237,  451 => 236,  443 => 234,  440 => 233,  437 => 231,  419 => 218,  411 => 212,  405 => 207,  402 => 204,  385 => 190,  381 => 188,  374 => 187,  371 => 186,  369 => 185,  366 => 184,  347 => 167,  341 => 162,  338 => 159,  325 => 149,  318 => 145,  313 => 142,  298 => 130,  291 => 127,  285 => 198,  277 => 119,  273 => 117,  267 => 114,  265 => 179,  262 => 112,  260 => 111,  254 => 109,  251 => 151,  238 => 100,  232 => 98,  222 => 94,  216 => 92,  211 => 89,  208 => 136,  197 => 129,  190 => 80,  181 => 76,  173 => 74,  170 => 73,  165 => 69,  162 => 68,  158 => 65,  152 => 63,  149 => 62,  141 => 80,  137 => 56,  133 => 55,  128 => 54,  123 => 51,  118 => 94,  113 => 47,  108 => 74,  106 => 45,  96 => 41,  87 => 39,  70 => 53,  67 => 25,  59 => 21,  53 => 18,  50 => 26,  45 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
