<?php

/* MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_bsswitch_history.html.twig */
class __TwigTemplate_01fa070d44e9f768a8109c5eb911b6a3fa6180dd9b899765997db0001e44885e extends Twig_Template
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
        // line 3
        $context["object_request"] = $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdSolicitudEstudio", array(), "method");
        // line 4
        $context["object_study_cit"] = $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdCitaProgramada", array(), "method");
        // line 5
        $context["object_request_cmpl"] = $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdSolicitudEstudioComplementario", array(), "method");
        // line 6
        $context["object_expediente"] = $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "getIdExpediente", array(), "method");
        // line 7
        $context["object_paciente"] = $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method");
        // line 8
        echo "
<ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"";
        // line 9
        echo "\"> <!-- required for floating -->
    <!-- Nav tabs -->
    <li class=\"active\"><a href=\"#lct_pacienteTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-user\"></span> Paciente <i class=\"fa\"></i></a></li>
    <li><a href=\"#lct_solicitudTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-book\"></span> Solicitud <i class=\"fa\"></i></a></li>
    ";
        // line 13
        if ((!(null === (isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit"))))) {
            // line 14
            echo "        <li><a href=\"#lct_citaTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-tags\"></span> Cita <i class=\"fa\"></i></a></li>
    ";
        }
        // line 16
        echo "    ";
        if ((!(null === (isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl"))))) {
            // line 17
            echo "        <li><a href=\"#lct_solcmplTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-export\"></span> Solicitud de complementario <i class=\"fa\"></i></a></li>
    ";
        }
        // line 19
        echo "</ul>

<!-- Tab panes -->
<div class=\"tab-content col-md-9 col-xs-9\" style=\"overflow-y: auto; min-height: 760px;\">
    
    ";
        // line 24
        if ((!(null === $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method")))) {
            // line 25
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:pct_entity_block.html.twig")->display(array_merge($context, array("object_patient" => $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method"), "object_localRecord" => (isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord")), "tab_active" => true, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 26
            echo "    ";
        }
        // line 27
        echo "    
    ";
        // line 28
        if ((!(null === (isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request"))))) {
            // line 29
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:prc_entity_block.html.twig")->display(array_merge($context, array("object_request" => (isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "object_requests" => null, "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 30
            echo "    ";
        }
        // line 31
        echo "    
    ";
        // line 32
        if ((!(null === (isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit"))))) {
            // line 33
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:cit_entity_block.html.twig")->display(array_merge($context, array("object_date" => (isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "object_dates" => null, "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 34
            echo "    ";
        }
        // line 35
        echo "    
    ";
        // line 36
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdSolicitudEstudioComplementario", array(), "method")))) {
            // line 37
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:solcmpl_entity_block.html.twig")->display(array_merge($context, array("object_request_cmpl" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdSolicitudEstudioComplementario", array(), "method"), "object_requests_cmpl" => null, "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 38
            echo "    ";
        }
        // line 39
        echo "    
</div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_bsswitch_history.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 39,  119 => 38,  111 => 37,  109 => 36,  106 => 35,  103 => 34,  95 => 33,  93 => 32,  90 => 31,  87 => 30,  79 => 29,  77 => 28,  74 => 27,  71 => 26,  63 => 25,  61 => 24,  50 => 17,  43 => 14,  35 => 9,  32 => 8,  30 => 7,  28 => 6,  26 => 5,  24 => 4,  22 => 3,  19 => 2,  364 => 166,  361 => 165,  358 => 164,  349 => 161,  346 => 160,  344 => 157,  340 => 156,  337 => 155,  335 => 154,  333 => 151,  330 => 150,  326 => 148,  322 => 146,  319 => 145,  316 => 144,  313 => 143,  304 => 140,  301 => 139,  299 => 136,  295 => 135,  292 => 134,  283 => 130,  279 => 129,  277 => 128,  272 => 127,  268 => 126,  265 => 125,  257 => 123,  255 => 122,  252 => 121,  245 => 119,  240 => 118,  238 => 117,  235 => 116,  232 => 112,  228 => 110,  224 => 108,  221 => 107,  218 => 106,  212 => 103,  208 => 101,  205 => 100,  202 => 99,  196 => 97,  190 => 95,  187 => 94,  185 => 93,  182 => 92,  179 => 91,  174 => 68,  171 => 67,  163 => 66,  161 => 65,  158 => 64,  155 => 63,  147 => 74,  142 => 70,  140 => 63,  136 => 61,  134 => 57,  132 => 53,  129 => 52,  120 => 48,  117 => 47,  114 => 46,  108 => 42,  104 => 41,  99 => 40,  97 => 39,  94 => 38,  89 => 34,  84 => 31,  80 => 30,  68 => 25,  57 => 18,  54 => 19,  47 => 16,  41 => 13,  38 => 10,  33 => 6,  31 => 5,);
    }
}
