<?php

/* MinsalSimagdBundle:ImgLecturaAdmin:lct_bsswitch_history.html.twig */
class __TwigTemplate_2652a25329749cc55c018e7ec3875957f59443384a7b48c43323d099b28dcf40 extends Twig_Template
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
        $context["object_study"] = $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method");
        // line 4
        $context["object_study_proc"] = $this->getAttribute((isset($context["object_study"]) ? $context["object_study"] : $this->getContext($context, "object_study")), "getIdProcedimientoRealizado", array(), "method");
        // line 5
        $context["object_request"] = $this->getAttribute((isset($context["object_study_proc"]) ? $context["object_study_proc"] : $this->getContext($context, "object_study_proc")), "getIdSolicitudEstudio", array(), "method");
        // line 6
        $context["object_study_cit"] = $this->getAttribute((isset($context["object_study_proc"]) ? $context["object_study_proc"] : $this->getContext($context, "object_study_proc")), "getIdCitaProgramada", array(), "method");
        // line 7
        $context["object_expediente"] = $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "getIdExpediente", array(), "method");
        // line 8
        $context["object_paciente"] = $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method");
        // line 9
        echo "
";
        // line 10
        $context["object_diagnostics"] = $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getLecturaDiagnostico", array(), "method");
        // line 11
        $context["object_diagnostic"] = null;
        // line 12
        $context["object_notasdiag"] = null;
        // line 13
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["object_diagnostics"]) ? $context["object_diagnostics"] : $this->getContext($context, "object_diagnostics")));
        foreach ($context['_seq'] as $context["_key"] => $context["diagnostic"]) {
            // line 14
            echo "    ";
            $context["object_diagnostic"] = (isset($context["diagnostic"]) ? $context["diagnostic"] : $this->getContext($context, "diagnostic"));
            // line 15
            echo "    ";
            $context["object_notasdiag"] = $this->getAttribute((isset($context["diagnostic"]) ? $context["diagnostic"] : $this->getContext($context, "diagnostic")), "getNotasDiagnostico", array(), "method");
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['diagnostic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "
";
        // line 18
        $context["object_requests_diagnostic"] = $this->getAttribute((isset($context["object_study"]) ? $context["object_study"] : $this->getContext($context, "object_study")), "getEstudioSolicitudesDiagnostico", array(), "method");
        // line 19
        $context["object_request_diagnostic"] = null;
        // line 20
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["object_requests_diagnostic"]) ? $context["object_requests_diagnostic"] : $this->getContext($context, "object_requests_diagnostic")));
        foreach ($context['_seq'] as $context["_key"] => $context["request_diagnostic"]) {
            // line 21
            echo "    ";
            $context["object_request_diagnostic"] = (isset($context["request_diagnostic"]) ? $context["request_diagnostic"] : $this->getContext($context, "request_diagnostic"));
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['request_diagnostic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "
<ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"";
        // line 24
        echo "\"> <!-- required for floating -->
    <!-- Nav tabs -->
    ";
        // line 26
        if ((!(null === $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method")))) {
            // line 27
            echo "\t<li class=\"active\"><a href=\"#lct_pacienteTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-user\"></span> Paciente <i class=\"fa\"></i></a></li>
    ";
        }
        // line 29
        echo "    ";
        if ((!(null === $this->getAttribute((isset($context["object_study_proc"]) ? $context["object_study_proc"] : $this->getContext($context, "object_study_proc")), "getIdSolicitudEstudio", array(), "method")))) {
            // line 30
            echo "\t<li><a href=\"#lct_solicitudTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-book\"></span> Solicitud de estudio <i class=\"fa\"></i></a></li>
    ";
        }
        // line 32
        echo "    ";
        if ((!(null === $this->getAttribute((isset($context["object_study_proc"]) ? $context["object_study_proc"] : $this->getContext($context, "object_study_proc")), "getIdCitaProgramada", array(), "method")))) {
            // line 33
            echo "        <li><a href=\"#lct_citaTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-tags\"></span> Cita otorgada <i class=\"fa\"></i></a></li>
    ";
        }
        // line 35
        echo "    ";
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method")))) {
            // line 36
            echo "\t<li><a href=\"#lct_estudiosTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-eye-open\"></span> Estudios realizados <i class=\"fa\"></i></a></li>
    ";
        }
        // line 38
        echo "    ";
        if ((!(null === (isset($context["object_request_diagnostic"]) ? $context["object_request_diagnostic"] : $this->getContext($context, "object_request_diagnostic"))))) {
            // line 39
            echo "\t<li><a href=\"#lct_soldiagTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-inbox\"></span> Solicitud de Diagnóstico <i class=\"fa\"></i></a></li>
    ";
        }
        // line 41
        echo "    ";
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            // line 42
            echo "\t<li><a href=\"#lct_lecturaTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-adjust\"></span> Diagnóstico radiológico <i class=\"fa\"></i></a></li>
    ";
        }
        // line 44
        echo "    ";
        if ((twig_length_filter($this->env, (isset($context["object_notasdiag"]) ? $context["object_notasdiag"] : $this->getContext($context, "object_notasdiag"))) > 0)) {
            // line 45
            echo "\t<li><a href=\"#lct_notdiagTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-comment\"></span> Notas al diagnóstico <i class=\"fa\"></i></a></li>
    ";
        }
        // line 47
        echo "</ul>

<!-- Tab panes -->
<div class=\"tab-content col-md-9 col-xs-9\" style=\"overflow-y: auto; min-height: 760px;\">
    
    ";
        // line 52
        if ((!(null === $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method")))) {
            // line 53
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:pct_entity_block.html.twig")->display(array_merge($context, array("object_patient" => $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method"), "object_localRecord" => (isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord")), "tab_active" => true, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 54
            echo "    ";
        }
        // line 55
        echo "    
    ";
        // line 56
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method")))) {
            // line 57
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:est_entity_block.html.twig")->display(array_merge($context, array("object_study" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method"), "object_studies" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getEstudiosLectura", array(), "method"), "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 58
            echo "    ";
        }
        // line 59
        echo "    
    ";
        // line 60
        if ((!(null === $this->getAttribute((isset($context["object_study_proc"]) ? $context["object_study_proc"] : $this->getContext($context, "object_study_proc")), "getIdSolicitudEstudio", array(), "method")))) {
            // line 61
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:prc_entity_block.html.twig")->display(array_merge($context, array("object_request" => $this->getAttribute((isset($context["object_study_proc"]) ? $context["object_study_proc"] : $this->getContext($context, "object_study_proc")), "getIdSolicitudEstudio", array(), "method"), "object_requests" => null, "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 62
            echo "    ";
        }
        // line 63
        echo "    
    ";
        // line 64
        if ((!(null === $this->getAttribute((isset($context["object_study_proc"]) ? $context["object_study_proc"] : $this->getContext($context, "object_study_proc")), "getIdCitaProgramada", array(), "method")))) {
            // line 65
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:cit_entity_block.html.twig")->display(array_merge($context, array("object_date" => $this->getAttribute((isset($context["object_study_proc"]) ? $context["object_study_proc"] : $this->getContext($context, "object_study_proc")), "getIdCitaProgramada", array(), "method"), "object_dates" => null, "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 66
            echo "    ";
        }
        // line 67
        echo "    
    ";
        // line 68
        if ((!(null === (isset($context["object_request_diagnostic"]) ? $context["object_request_diagnostic"] : $this->getContext($context, "object_request_diagnostic"))))) {
            // line 69
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:soldiag_entity_block.html.twig")->display(array_merge($context, array("object_request_diagnostic" => (isset($context["object_request_diagnostic"]) ? $context["object_request_diagnostic"] : $this->getContext($context, "object_request_diagnostic")), "object_requests_diagnostic" => null, "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 70
            echo "    ";
        }
        // line 71
        echo "    
    ";
        // line 72
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            // line 73
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:lct_entity_block.html.twig")->display(array_merge($context, array("object_rxresult" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "object_diagnostic" => (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 74
            echo "    ";
        }
        // line 75
        echo "    
    ";
        // line 76
        if ((twig_length_filter($this->env, (isset($context["object_notasdiag"]) ? $context["object_notasdiag"] : $this->getContext($context, "object_notasdiag"))) > 0)) {
            // line 77
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:notdiag_entity_block.html.twig")->display(array_merge($context, array("object_notdiag" => null, "object_notasdiag" => (isset($context["object_notasdiag"]) ? $context["object_notasdiag"] : $this->getContext($context, "object_notasdiag")), "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 78
            echo "    ";
        }
        // line 79
        echo "    
</div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgLecturaAdmin:lct_bsswitch_history.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  246 => 79,  235 => 77,  233 => 76,  230 => 75,  227 => 74,  217 => 72,  214 => 71,  201 => 68,  198 => 67,  185 => 64,  182 => 63,  179 => 62,  171 => 61,  169 => 60,  163 => 58,  155 => 57,  153 => 56,  147 => 54,  139 => 53,  137 => 52,  130 => 47,  126 => 45,  123 => 44,  119 => 42,  116 => 41,  112 => 39,  105 => 36,  102 => 35,  98 => 33,  95 => 32,  91 => 30,  88 => 29,  84 => 27,  82 => 26,  78 => 24,  75 => 23,  68 => 21,  64 => 20,  62 => 19,  60 => 18,  57 => 17,  50 => 15,  47 => 14,  43 => 13,  41 => 12,  39 => 11,  34 => 9,  32 => 8,  30 => 7,  28 => 6,  26 => 5,  24 => 4,  22 => 3,  19 => 2,  639 => 313,  636 => 312,  633 => 311,  630 => 310,  621 => 307,  618 => 306,  613 => 305,  611 => 304,  608 => 303,  602 => 299,  598 => 298,  596 => 297,  591 => 296,  589 => 295,  586 => 294,  584 => 293,  582 => 290,  578 => 288,  575 => 287,  572 => 286,  569 => 285,  560 => 282,  557 => 281,  552 => 280,  550 => 279,  547 => 278,  541 => 274,  537 => 273,  535 => 272,  530 => 271,  528 => 270,  525 => 269,  517 => 267,  515 => 266,  512 => 265,  505 => 263,  500 => 262,  498 => 261,  495 => 260,  491 => 255,  488 => 254,  482 => 251,  478 => 249,  475 => 248,  472 => 247,  466 => 245,  460 => 243,  457 => 242,  455 => 241,  452 => 240,  449 => 239,  444 => 236,  441 => 235,  433 => 233,  431 => 232,  427 => 230,  424 => 229,  419 => 227,  416 => 226,  413 => 225,  408 => 222,  405 => 215,  402 => 214,  397 => 169,  394 => 168,  386 => 167,  384 => 166,  381 => 165,  378 => 164,  373 => 210,  366 => 175,  361 => 171,  359 => 164,  355 => 162,  352 => 160,  350 => 153,  348 => 149,  345 => 148,  334 => 139,  331 => 138,  322 => 131,  315 => 126,  312 => 125,  308 => 123,  305 => 122,  296 => 118,  293 => 117,  290 => 116,  284 => 112,  280 => 111,  275 => 110,  273 => 109,  270 => 108,  265 => 104,  260 => 101,  256 => 100,  251 => 98,  243 => 78,  232 => 84,  223 => 80,  219 => 73,  215 => 78,  211 => 70,  207 => 76,  203 => 69,  199 => 74,  195 => 66,  191 => 72,  187 => 65,  184 => 70,  174 => 66,  170 => 65,  166 => 59,  162 => 63,  158 => 62,  154 => 61,  150 => 55,  146 => 59,  142 => 58,  138 => 57,  135 => 56,  131 => 55,  129 => 54,  125 => 53,  109 => 38,  100 => 38,  96 => 37,  87 => 30,  81 => 26,  76 => 23,  72 => 22,  67 => 21,  61 => 18,  58 => 17,  51 => 14,  45 => 11,  42 => 10,  37 => 10,  35 => 5,);
    }
}
