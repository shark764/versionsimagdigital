<?php

/* MinsalSimagdBundle:ImgPendienteLecturaAdmin:pndL_asignarRadiologoListaTrabajo_modal.html.twig */
class __TwigTemplate_2ff24bebc28edcdaa1efbcbb418c3f33a944c481befae94c62748b7b3db849e1 extends Twig_Template
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
<div id=\"asignarRadiologoListaTrabajo-modal\" class=\"modal fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\" aria-labelledby=\"mySmallModalLabel\" data-width=\"760\">
    <div class=\"modal-content panel-element-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-user-md\"></i> <i class=\"fa fa-microphone\"></i> Asignar registros a Radiólogo</h4>
        </div>

        <div class=\"modal-body\">
            <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">

                <form id=\"asignarRadiologoListaTrabajo-form\" action=\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("simagd_sin_lectura_asignarElementoListaTrabajo");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
                    data-fv-framework=\"bootstrap\"
                    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
                    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
                    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

                    data-fv-message=\"El valor introducido no es válido\">

                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label\">Radiólogo</label>
                        <div class=\"col-xs-8\">
                            <select id=\"formPndLWorkListIdRadiologoAsignado\" name=\"formPndLWorkListIdRadiologoAsignado\" class=\"form-control select2-select\" data-default=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"user\"
                                    ";
        // line 26
        echo "
                                    data-fv-notempty=\"true\"
                                    data-fv-notempty-message=\"Seleccione un elemento\" >
                                <option value=\"\"></option>
                                ";
        // line 30
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 31
                echo "                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                    ";
                // line 32
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 33
                        echo "                                        <option value=\"";
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
                // line 35
                echo "                                    </optgroup>
                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 38
                echo "                                    <option value=\"";
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
        // line 40
        echo "                            </select>
                        </div>
                    </div>

                </form>
                
            </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_asignar_pndLWorkList\" name=\"btn_asignar_pndLWorkList\" class=\"btn btn-element-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgPendienteLecturaAdmin:pndL_asignarRadiologoListaTrabajo_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 40,  83 => 35,  71 => 33,  61 => 31,  56 => 30,  50 => 26,  46 => 24,  105 => 85,  91 => 37,  70 => 50,  35 => 19,  31 => 12,  310 => 210,  300 => 200,  282 => 180,  264 => 150,  257 => 148,  245 => 146,  240 => 145,  235 => 144,  231 => 143,  214 => 128,  196 => 111,  178 => 94,  167 => 84,  156 => 82,  152 => 81,  145 => 76,  141 => 74,  132 => 67,  120 => 65,  114 => 64,  106 => 62,  94 => 60,  89 => 59,  84 => 58,  79 => 57,  73 => 51,  54 => 28,  47 => 22,  41 => 17,  22 => 4,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  627 => 335,  624 => 334,  616 => 332,  614 => 331,  610 => 329,  607 => 328,  599 => 326,  597 => 325,  593 => 323,  590 => 322,  587 => 321,  584 => 320,  580 => 319,  577 => 318,  574 => 317,  570 => 316,  568 => 315,  565 => 314,  562 => 313,  554 => 311,  552 => 310,  549 => 309,  546 => 308,  544 => 307,  537 => 306,  532 => 303,  517 => 291,  510 => 288,  504 => 285,  496 => 280,  492 => 278,  486 => 275,  484 => 274,  481 => 273,  479 => 272,  476 => 271,  455 => 252,  449 => 247,  446 => 244,  429 => 230,  425 => 228,  418 => 227,  415 => 226,  413 => 225,  410 => 224,  388 => 204,  382 => 199,  379 => 196,  366 => 186,  359 => 182,  354 => 179,  339 => 167,  332 => 164,  326 => 161,  318 => 156,  314 => 154,  308 => 151,  306 => 150,  303 => 149,  301 => 148,  298 => 147,  294 => 145,  291 => 193,  273 => 165,  265 => 129,  262 => 128,  254 => 122,  247 => 117,  244 => 116,  233 => 110,  226 => 108,  217 => 104,  209 => 102,  206 => 101,  201 => 98,  198 => 97,  193 => 94,  190 => 93,  188 => 92,  182 => 90,  179 => 89,  172 => 85,  168 => 84,  163 => 83,  158 => 81,  154 => 79,  149 => 78,  143 => 75,  138 => 72,  134 => 71,  129 => 70,  97 => 38,  88 => 42,  69 => 51,  66 => 32,  58 => 22,  52 => 19,  49 => 24,  44 => 20,  42 => 27,  40 => 14,  38 => 20,  36 => 8,  34 => 21,  32 => 13,);
    }
}
