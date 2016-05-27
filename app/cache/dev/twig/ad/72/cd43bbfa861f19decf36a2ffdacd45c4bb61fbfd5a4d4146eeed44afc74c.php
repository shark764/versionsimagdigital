<?php

/* MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_asignarTranscriptorListaTrabajo_modal.html.twig */
class __TwigTemplate_ad72cd43bbfa861f19decf36a2ffdacd45c4bb61fbfd5a4d4146eeed44afc74c extends Twig_Template
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
<div id=\"asignarTranscriptorListaTrabajo-modal\" class=\"modal fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\" aria-labelledby=\"mySmallModalLabel\" data-width=\"760\">
    <div class=\"modal-content panel-element-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-user\"></i> <i class=\"fa fa-headphones\"></i> Asignar registros a Transcriptor</h4>
        </div>

        <div class=\"modal-body\">
            <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">

                <form id=\"asignarTranscriptorListaTrabajo-form\" action=\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("simagd_sin_transcribir_asignarElementoListaTrabajo");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
                    data-fv-framework=\"bootstrap\"
                    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
                    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
                    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

                    data-fv-message=\"El valor introducido no es válido\">

                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label\">Transcriptor</label>
                        <div class=\"col-xs-8\">
                            <select id=\"formPndTWorkListIdTranscriptorAsignado\" name=\"formPndTWorkListIdTranscriptorAsignado\" class=\"form-control select2-select\" data-default=\"";
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
            if ((((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY")) || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "ACL")) || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "CIT"))) {
                // line 31
                echo "                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                    ";
                // line 32
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")));
                foreach ($context['_seq'] as $context["_key"] => $context["transcriptor"]) {
                    if (((!(null === $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 33
                        echo "                                        <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "html", null, true);
                        echo "</option>
                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transcriptor'], $context['_parent'], $context['loop']);
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
        $context['_seq'] = twig_ensure_traversable((isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")));
        foreach ($context['_seq'] as $context["_key"] => $context["transcriptor"]) {
            if ((null === $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"))) {
                // line 38
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "html", null, true);
                echo "</option>
                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transcriptor'], $context['_parent'], $context['loop']);
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
            <button type=\"submit\" id=\"btn_asignar_pndTWorkList\" name=\"btn_asignar_pndTWorkList\" class=\"btn btn-element-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_asignarTranscriptorListaTrabajo_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 40,  97 => 38,  91 => 37,  71 => 33,  66 => 32,  61 => 31,  56 => 30,  50 => 26,  46 => 24,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  540 => 293,  537 => 292,  529 => 290,  527 => 289,  523 => 287,  520 => 286,  517 => 285,  514 => 284,  510 => 283,  508 => 282,  505 => 281,  502 => 280,  494 => 278,  492 => 277,  489 => 276,  486 => 275,  484 => 274,  477 => 273,  473 => 271,  466 => 270,  463 => 269,  461 => 268,  458 => 267,  435 => 246,  429 => 241,  426 => 238,  409 => 224,  405 => 222,  398 => 221,  395 => 220,  393 => 219,  390 => 218,  366 => 196,  360 => 191,  357 => 188,  344 => 178,  337 => 174,  332 => 171,  317 => 159,  310 => 156,  304 => 153,  296 => 148,  292 => 146,  286 => 143,  284 => 142,  281 => 141,  279 => 140,  274 => 138,  271 => 137,  253 => 124,  245 => 122,  242 => 121,  234 => 115,  227 => 110,  224 => 109,  218 => 105,  212 => 103,  205 => 101,  196 => 97,  188 => 95,  185 => 94,  180 => 91,  177 => 90,  172 => 87,  170 => 86,  164 => 84,  161 => 83,  154 => 79,  149 => 78,  144 => 76,  140 => 74,  135 => 73,  129 => 70,  124 => 67,  120 => 66,  115 => 65,  83 => 35,  65 => 25,  62 => 24,  54 => 20,  48 => 17,  45 => 16,  40 => 14,  38 => 11,  36 => 8,  34 => 7,  32 => 13,);
    }
}
