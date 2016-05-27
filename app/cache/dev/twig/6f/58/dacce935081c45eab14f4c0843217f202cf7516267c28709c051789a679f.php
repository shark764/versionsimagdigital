<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_agregarIndicacionesRadiologo_modal.html.twig */
class __TwigTemplate_6f58dacce935081c45eab14f4c0843217f202cf7516267c28709c051789a679f extends Twig_Template
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
        echo "<div id=\"agregarIndicacionesRadiologo-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-user-md\"></i> <i class=\"fa fa-stethoscope\"></i> <i class=\"fa fa-wheelchair\"></i> <span id=\"formIndRadxPrcTitle\">Agregar indicaciones de Médico Radiólogo</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formIndRadxPrcLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"agregarIndicacionesRadiologoForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_agregarIndicacionesRadiologo");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#indRadxTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-log-in\"></span> Indicaciones <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"indRadxTab\" >

                                    <input type=\"hidden\" id=\"formIndRadxPrcId\" name=\"formIndRadxPrcId\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Radiólogo</label>
                                        <div class=\"col-xs-10\">
                                            <select id=\"formIndRadxPrcIdRadiologo\" name=\"formIndRadxPrcIdRadiologo\" class=\"form-control select2-select\" data-default=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "id"), "html", null, true);
        echo "\"
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
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 56
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 57
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 58
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
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 63
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
        // line 65
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Indicaciones adicionales</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"4\" class=\"form-control summernote\" name=\"formIndRadxPrcIndicaciones\" id=\"formIndRadxPrcIndicaciones\" ";
        // line 80
        echo " /></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"form-group\" style=\"";
        // line 87
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>

\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 97
        echo "\t    </div>

        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregarIndRadx_prc\" name=\"btn_agregarIndRadx_prc\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editarIndRadx_prc\" name=\"btn_editarIndRadx_prc\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_agregarIndicacionesRadiologo_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 97,  148 => 87,  139 => 80,  130 => 65,  112 => 62,  104 => 60,  92 => 58,  87 => 57,  82 => 56,  77 => 55,  71 => 51,  67 => 49,  22 => 4,  19 => 2,  787 => 404,  784 => 403,  776 => 401,  774 => 400,  770 => 398,  767 => 397,  763 => 396,  761 => 395,  758 => 394,  755 => 393,  751 => 392,  748 => 391,  745 => 390,  741 => 389,  738 => 388,  735 => 387,  733 => 386,  725 => 385,  722 => 384,  719 => 383,  717 => 382,  709 => 381,  706 => 380,  703 => 379,  699 => 378,  697 => 377,  694 => 376,  691 => 375,  683 => 373,  681 => 372,  678 => 371,  663 => 361,  648 => 348,  642 => 343,  639 => 340,  636 => 339,  620 => 325,  616 => 323,  609 => 322,  606 => 321,  604 => 320,  601 => 319,  579 => 299,  573 => 294,  570 => 291,  567 => 290,  551 => 276,  547 => 274,  540 => 273,  537 => 272,  535 => 271,  532 => 270,  515 => 258,  505 => 250,  497 => 243,  494 => 240,  491 => 239,  477 => 229,  470 => 225,  465 => 222,  449 => 210,  437 => 203,  425 => 195,  418 => 192,  412 => 189,  404 => 184,  400 => 182,  394 => 179,  392 => 178,  389 => 177,  387 => 176,  384 => 175,  381 => 173,  377 => 169,  374 => 168,  369 => 165,  355 => 156,  349 => 155,  339 => 147,  331 => 141,  328 => 140,  315 => 132,  308 => 130,  298 => 125,  291 => 123,  281 => 118,  274 => 116,  269 => 113,  266 => 112,  261 => 109,  258 => 108,  254 => 105,  248 => 103,  245 => 102,  237 => 98,  232 => 96,  228 => 94,  223 => 93,  217 => 90,  215 => 89,  210 => 86,  205 => 85,  200 => 82,  196 => 81,  191 => 80,  183 => 74,  170 => 63,  156 => 61,  149 => 60,  145 => 59,  134 => 55,  126 => 54,  118 => 63,  110 => 52,  102 => 51,  79 => 32,  76 => 31,  68 => 27,  62 => 24,  59 => 23,  54 => 21,  52 => 20,  50 => 19,  48 => 18,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 9,  36 => 8,  34 => 21,  32 => 6,);
    }
}
