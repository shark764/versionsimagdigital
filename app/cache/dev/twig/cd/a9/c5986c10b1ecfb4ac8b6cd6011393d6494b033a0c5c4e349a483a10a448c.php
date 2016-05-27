<?php

/* MinsalSimagdBundle:show_entity_block:solcmpl_entity_block.html.twig */
class __TwigTemplate_cda9c5986c10b1ecfb4ac8b6cd6011393d6494b033a0c5c4e349a483a10a448c extends Twig_Template
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
    <div class=\"tab-pane fade ";
        // line 3
        if (((isset($context["tab_active"]) ? $context["tab_active"] : $this->getContext($context, "tab_active")) != false)) {
            echo "in active";
        }
        echo "\" id=\"lct_solcmplTab\" >
        <div class=\"box box-";
        // line 4
        echo twig_escape_filter($this->env, ((array_key_exists("box_style", $context)) ? (_twig_default_filter((isset($context["box_style"]) ? $context["box_style"] : $this->getContext($context, "box_style")), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo " non-titled-sonata-box\">
            <div class=\"box-body\">
\t\t<table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "id"), "html", null, true);
        echo "</span></td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicita:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "idRadiologoSolicita"), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha de registro:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 17
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "fechaSolicitud"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "fechaSolicitud"), "H:i:s A")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "idEstadoSolicitud"), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Prioridad requerida:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "idPrioridadAtencion"), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Justificación:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "justificacion"), "html", null, true);
        echo "</pre>
                        </td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Indicaciones para el estudio:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >
                            ";
        // line 36
        echo $this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "indicacionesEstudio");
        echo "
                        </td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Modalidad solicitada:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "idAreaServicioDiagnostico"), "html", null, true);
        echo "</td>
                    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Proyecciones:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
\t\t\t    ";
        // line 46
        $context["solcmpl_examenesLoop"] = array();
        // line 47
        echo "\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "solicitudEstudioComplementarioProyeccion"));
        foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
            // line 48
            echo "\t\t\t\t";
            $context["i"] = ("_" . $this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id"));
            // line 49
            echo "\t\t\t\t
\t\t\t\t";
            // line 50
            if (!twig_in_filter((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), twig_get_array_keys_filter((isset($context["solcmpl_examenesLoop"]) ? $context["solcmpl_examenesLoop"] : $this->getContext($context, "solcmpl_examenesLoop"))))) {
                // line 51
                echo "\t\t\t\t    ";
                $context["solcmpl_examenesLoop"] = twig_array_merge((isset($context["solcmpl_examenesLoop"]) ? $context["solcmpl_examenesLoop"] : $this->getContext($context, "solcmpl_examenesLoop")), array((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) => $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico")));
                // line 52
                echo "\t\t\t\t";
            }
            // line 53
            echo "\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "\t\t\t    
\t\t\t    <div class=\"panel-group\" id=\"solcmpl_exm_containerGroup\">
\t\t\t\t";
        // line 56
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["solcmpl_examenesLoop"]) ? $context["solcmpl_examenesLoop"] : $this->getContext($context, "solcmpl_examenesLoop")));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 57
            echo "\t\t\t\t    
\t\t\t\t    ";
            // line 58
            $context["solcmpl_exm_proyeccionCount"] = 0;
            // line 59
            echo "\t\t\t\t    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "solicitudEstudioComplementarioProyeccion"));
            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                if (($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == trim((isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "_"))) {
                    // line 60
                    echo "\t\t\t\t\t";
                    $context["solcmpl_exm_proyeccionCount"] = ((isset($context["solcmpl_exm_proyeccionCount"]) ? $context["solcmpl_exm_proyeccionCount"] : $this->getContext($context, "solcmpl_exm_proyeccionCount")) + 1);
                    // line 61
                    echo "\t\t\t\t    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            echo "\t\t\t\t    
\t\t\t\t    <div class=\"panel panel-primary-v2\">
\t\t\t\t\t<a class=\"list-group-item btn-link btn-link-v2\" data-toggle=\"collapse\" href=\"#solcmpl_proyecciones_panelCollapse_id_";
            // line 64
            echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "html", null, true);
            echo "\">
\t\t\t\t\t    <span class=\"badge\">";
            // line 65
            echo twig_escape_filter($this->env, (isset($context["solcmpl_exm_proyeccionCount"]) ? $context["solcmpl_exm_proyeccionCount"] : $this->getContext($context, "solcmpl_exm_proyeccionCount")), "html", null, true);
            echo "</span>
\t\t\t\t\t    ";
            // line 66
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"panel-collapse collapse\" id=\"solcmpl_proyecciones_panelCollapse_id_";
            // line 68
            echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "html", null, true);
            echo "\">
\t\t\t\t\t    <div class=\"panel-body\">
\t\t\t\t\t\t";
            // line 70
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object_request_cmpl"]) ? $context["object_request_cmpl"] : $this->getContext($context, "object_request_cmpl")), "solicitudEstudioComplementarioProyeccion"));
            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                if (($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == trim((isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "_"))) {
                    // line 71
                    echo "\t\t\t\t\t\t    <a  tabindex=\"0\"
\t\t\t\t\t\t\tclass=\"list-group-item btn-link btn-link-v2\"
\t\t\t\t\t\t\trole=\"button\"
\t\t\t\t\t\t\tdata-toggle=\"popover\"
\t\t\t\t\t\t\trel=\"popover\"
\t\t\t\t\t\t\tdata-trigger=\"hover\"
\t\t\t\t\t\t\ttitle=\"";
                    // line 77
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-original-title=\"";
                    // line 78
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-contentwrapper=\".solcmpl_history_container_contentwrapper_id_";
                    // line 79
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-placement=\"top\"
\t\t\t\t\t\t\thref=\"javascript:void(0)\"
\t\t\t\t\t\t\tdata-id=\"";
                    // line 82
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\" >
\t\t\t\t\t\t\t<span class=\"badge\">";
                    // line 83
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "codigo"), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t";
                    // line 85
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "
\t\t\t\t\t\t    </a>

\t\t\t\t\t\t    <div class=\"solcmpl_history_container_contentwrapper_id_";
                    // line 88
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
                                                        <table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
                                                            <tr><th class=\"col-md-5\">Código:</th><td class=\"col-md-7\">";
                    // line 90
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "codigo"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Tiempo en sala:</th><td class=\"col-md-7\">";
                    // line 91
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoOcupacionSala"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Tiempo por médico:</th><td class=\"col-md-7\">";
                    // line 92
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoMedico"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Descripción:</th><td class=\"col-md-7\"><pre class=\"pre-display-code-natural\">";
                    // line 93
                    echo _twig_default_filter(trim($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "descripcion")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
                    echo "</pre></td></tr>
                                                        </table>
\t\t\t\t\t\t    </div>
\t\t\t\t\t\t";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 97
            echo "\t\t\t\t\t    </div>
\t\t\t\t\t</div>
\t\t\t\t    </div>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        echo "\t\t\t    </div>
\t\t\t</td>
\t\t    </tr>
                </table>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:solcmpl_entity_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  254 => 101,  245 => 97,  234 => 93,  230 => 92,  226 => 91,  222 => 90,  217 => 88,  211 => 85,  206 => 83,  202 => 82,  196 => 79,  192 => 78,  188 => 77,  180 => 71,  175 => 70,  170 => 68,  165 => 66,  161 => 65,  157 => 64,  153 => 62,  146 => 61,  143 => 60,  137 => 59,  135 => 58,  132 => 57,  128 => 56,  124 => 54,  118 => 53,  115 => 52,  112 => 51,  110 => 50,  107 => 49,  104 => 48,  99 => 47,  97 => 46,  89 => 41,  81 => 36,  72 => 30,  64 => 25,  57 => 21,  50 => 17,  43 => 13,  36 => 9,  28 => 4,  22 => 3,  19 => 2,);
    }
}
