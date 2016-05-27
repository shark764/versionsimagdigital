<?php

/* MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_excluirRadiologoBloqueo_modal.html.twig */
class __TwigTemplate_5c3d58c8f975f41fcc89c888857fabc95a5c05e8c3830dfad39d679572943d64 extends Twig_Template
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
<div id=\"excluirRadiologoBloqueo-modal\" class=\"modal fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\" aria-labelledby=\"mySmallModalLabel\" data-width=\"760\">
    <div class=\"modal-content panel-element-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-user-md\"></i> <i class=\"fa fa-unlock-alt\"></i> Excluir Radiólogo de bloqueo de agenda</h4>
        </div>

        <div class=\"modal-body\">
            <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">

                <form id=\"excluirRadiologoBloqueo-form\" action=\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("simagd_bloqueo_agenda_excluirRadiologoBloqueo");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
                    data-fv-framework=\"bootstrap\"
                    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
                    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
                    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

                    data-fv-message=\"El valor introducido no es válido\">

                    ";
        // line 22
        echo "                    <input type=\"hidden\" id=\"formBlAgdExclRadxIdBloqueoAgenda\" name=\"formBlAgdExclRadxIdBloqueoAgenda\" value=\"\" data-alias-from-server=\"blAgd_id\" />

                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label\">Bloqueo</label>
                        <div class=\"col-xs-8\">
                            <p class=\"form-control-static\" id=\"formBlAgdExclRadxIdBloqueoAgenda-static-label\"></p>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label\">Modalidad</label>
                        <div class=\"col-xs-8\">
                            <p class=\"form-control-static\" id=\"formBlAgdExclRadxIdExamenServicioDiagnostico-static-label\"></p>
                        </div>
                    </div>
                    ";
        // line 38
        echo "                    ";
        // line 44
        echo "
                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label required\">Radiólogos a excluir</label>
                        <div class=\"col-xs-8\">
                            <select id=\"formBlAgdExclRadxIdRadiologoExcluido\" name=\"formBlAgdExclRadxIdRadiologoExcluido[]\" class=\"form-control select2-select\" data-default=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "id"), "html", null, true);
        echo "\" data-alias-from-server=\"blAgd_bloqueoExclusionesBloqueo\" data-alias-from-server-collection-key=\"exclBlAgd_id_radiologo\" data-apply-formatter=\"user\" multiple
                                      ";
        // line 50
        echo "
                                    data-fv-notempty=\"true\"
                                    data-fv-notempty-message=\"Seleccione un elemento\" >
                                ";
        // line 54
        echo "                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 55
                echo "                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                    ";
                // line 56
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 57
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
                // line 59
                echo "                                    </optgroup>
                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 62
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
        // line 64
        echo "                            </select>
                        </div>
                    </div>

                </form>
                
            </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_excluirRadx_blAgd\" name=\"btn_excluirRadx_blAgd\" class=\"btn btn-element-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_excluirRadiologoBloqueo_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 64,  118 => 62,  87 => 56,  82 => 55,  59 => 38,  313 => 225,  303 => 215,  286 => 200,  268 => 183,  240 => 157,  194 => 112,  178 => 97,  165 => 85,  143 => 74,  137 => 73,  129 => 71,  117 => 69,  107 => 67,  102 => 66,  90 => 56,  66 => 33,  60 => 29,  51 => 21,  172 => 131,  162 => 121,  145 => 106,  127 => 89,  95 => 59,  83 => 57,  78 => 56,  71 => 50,  310 => 218,  300 => 208,  247 => 163,  237 => 151,  217 => 132,  197 => 125,  193 => 124,  186 => 119,  155 => 76,  135 => 71,  132 => 69,  123 => 61,  105 => 58,  97 => 56,  85 => 54,  80 => 53,  112 => 61,  106 => 69,  69 => 50,  55 => 20,  30 => 5,  22 => 4,  94 => 68,  79 => 54,  75 => 53,  73 => 52,  24 => 4,  120 => 67,  110 => 59,  104 => 59,  101 => 51,  67 => 48,  49 => 18,  43 => 22,  35 => 19,  31 => 12,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 193,  278 => 116,  274 => 115,  270 => 114,  265 => 176,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 157,  238 => 104,  233 => 101,  228 => 100,  223 => 137,  218 => 96,  212 => 129,  210 => 127,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 87,  141 => 64,  133 => 63,  114 => 48,  111 => 59,  103 => 58,  98 => 50,  92 => 57,  86 => 44,  81 => 41,  76 => 54,  70 => 51,  64 => 25,  61 => 44,  56 => 39,  54 => 24,  52 => 20,  50 => 19,  48 => 17,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 21,  32 => 13,);
    }
}
