<?php

/* MinsalSimagdBundle:show_entity_block:prc_entity_block.html.twig */
class __TwigTemplate_d12b48189804e101ef8a6f387b9406791b1d0e4358e2a9b1c2d402d7aaf9ab6c extends Twig_Template
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
        echo "\" id=\"lct_solicitudTab\" >
        <div class=\"box box-";
        // line 4
        echo twig_escape_filter($this->env, ((array_key_exists("box_style", $context)) ? (_twig_default_filter((isset($context["box_style"]) ? $context["box_style"] : $this->getContext($context, "box_style")), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo " non-titled-sonata-box\">
            <div class=\"box-body\">
\t\t<table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "id"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Nombre:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idExpediente"), "getIdPaciente", array(), "method"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">N° de Registro:</span></th>
\t\t\t<td class=\"col-md-3\" ><span class=\"badge\">";
        // line 15
        if ((!(null === (isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord"))))) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord")), "numero"), "html", null, true);
            echo " ";
        }
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Peso:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 19
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "pesoActualLb") . " lb"), "html", null, true);
        echo " <i>";
        echo twig_escape_filter($this->env, (("(" . $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "pesoActualKg")) . " kg)"), "html", null, true);
        echo "</i></td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Talla:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 21
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "tallaPaciente") . " m"), "html", null, true);
        echo " <i>";
        echo twig_escape_filter($this->env, (("(" . ($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "tallaPaciente") * 100)) . " cm)"), "html", null, true);
        echo "</i></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Área:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idAtenAreaModEstab"), "idAreaModEstab"), "idAreaAtencion"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Servicio:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idAtenAreaModEstab"), "idAtencion"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicitante:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idEmpleado"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 33
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "fechaCreacion"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "fechaCreacion"), "H:i:s A")), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Datos clínicos:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 38
        echo _twig_default_filter(trim($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "datosClinicos")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
        echo "</pre>
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Hipótesis diagnóstica:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 44
        echo _twig_default_filter(trim($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "hipotesisDiagnostica")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
        echo "</pre>
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Investigando:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 50
        echo _twig_default_filter(trim($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "investigando")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
        echo "</pre>
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Justificación de estudio:</span></th>
\t\t\t<td class=\"col-md-3\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 56
        echo _twig_default_filter(trim($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "justificacionMedica")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
        echo "</pre>
                        </td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Prioridad requerida:</span></th>
\t\t\t<td class=\"col-md-3\" ><span class=\"label label-";
        // line 59
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : null), "idPrioridadAtencion", array(), "any", false, true), "estiloPresentacion", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : null), "idPrioridadAtencion", array(), "any", false, true), "estiloPresentacion"), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idPrioridadAtencion"), "nombre"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Consulta por:</span></th>
\t\t\t<td class=\"col-md-3\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 64
        echo _twig_default_filter(trim($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "consultaPor")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
        echo "</pre>
                        </td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado clínico:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "estadoClinico"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Antecedentes clínicos:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            ";
        // line 72
        echo $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "antecedentesClinicosRelevantes");
        echo "
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Referido a:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 77
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idEstablecimientoReferido"), "html", null, true);
        echo " ";
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento"), "getId", array(), "method") == $this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idEstablecimientoReferido"), "getId", array(), "method"))) {
            echo " <span class=\"label label-element-v2\" style=\"\">[Servicio local]</span> ";
        }
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Justificación:</span></th>
\t\t\t<td class=\"col-md-3\" ><pre class=\"pre-display-code-natural\">";
        // line 79
        echo _twig_default_filter(trim($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "justificacionReferencia")), "<span style=\"color: #bbb;\">Referido a servicio local...</span>");
        echo "</pre></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Modalidad:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idAreaServicioDiagnostico"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Proyecciones:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
\t\t\t
\t\t\t    ";
        // line 89
        $context["examenesLoop"] = array();
        // line 90
        echo "\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "solicitudEstudioProyeccion"));
        foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
            // line 91
            echo "\t\t\t\t";
            $context["i"] = ("_" . $this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id"));
            // line 92
            echo "\t\t\t\t
\t\t\t\t";
            // line 93
            if (!twig_in_filter((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), twig_get_array_keys_filter((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop"))))) {
                // line 94
                echo "\t\t\t\t    ";
                $context["examenesLoop"] = twig_array_merge((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop")), array((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) => $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico")));
                // line 95
                echo "\t\t\t\t";
            }
            // line 96
            echo "\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 97
        echo "\t\t\t    
\t\t\t    <div class=\"panel-group\" id=\"exm_containerGroup\">
\t\t\t\t";
        // line 99
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop")));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 100
            echo "\t\t\t\t    
\t\t\t\t    ";
            // line 101
            $context["exm_proyeccionCount"] = 0;
            // line 102
            echo "\t\t\t\t    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "solicitudEstudioProyeccion"));
            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                if (($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == trim((isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "_"))) {
                    // line 103
                    echo "\t\t\t\t\t";
                    $context["exm_proyeccionCount"] = ((isset($context["exm_proyeccionCount"]) ? $context["exm_proyeccionCount"] : $this->getContext($context, "exm_proyeccionCount")) + 1);
                    // line 104
                    echo "\t\t\t\t    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            echo "\t\t\t\t    
\t\t\t\t    <div class=\"panel panel-primary-v2\">
\t\t\t\t\t<a class=\"list-group-item btn-link btn-link-v2\" data-toggle=\"collapse\" href=\"#proyecciones_panelCollapse_id_";
            // line 107
            echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "html", null, true);
            echo "\">
\t\t\t\t\t    <span class=\"badge\">";
            // line 108
            echo twig_escape_filter($this->env, (isset($context["exm_proyeccionCount"]) ? $context["exm_proyeccionCount"] : $this->getContext($context, "exm_proyeccionCount")), "html", null, true);
            echo "</span>
                                            <span class=\"caret\" style=\"margin-right: 5px;\"></span> <span class=\"dropup\" style=\"margin-right: 5px; ";
            // line 109
            echo "\"><span class=\"caret\"></span></span>
                                            ";
            // line 110
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"panel-collapse collapse\" id=\"proyecciones_panelCollapse_id_";
            // line 112
            echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "html", null, true);
            echo "\">
\t\t\t\t\t    <div class=\"panel-body\">
\t\t\t\t\t\t";
            // line 114
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "solicitudEstudioProyeccion"));
            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                if (($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == trim((isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "_"))) {
                    // line 115
                    echo "\t\t\t\t\t\t    <a  tabindex=\"0\"
\t\t\t\t\t\t\tclass=\"list-group-item btn-link btn-link-v2\"
\t\t\t\t\t\t\trole=\"button\"
\t\t\t\t\t\t\tdata-toggle=\"popover\"
\t\t\t\t\t\t\trel=\"popover\"
\t\t\t\t\t\t\tdata-trigger=\"hover\"
\t\t\t\t\t\t\ttitle=\"";
                    // line 121
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-original-title=\"";
                    // line 122
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-contentwrapper=\".prc_pry_container_contentwrapper_id_";
                    // line 123
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-placement=\"top\"
\t\t\t\t\t\t\thref=\"javascript:void(0)\"
\t\t\t\t\t\t\tdata-id=\"";
                    // line 126
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\" >
\t\t\t\t\t\t\t<span class=\"badge\">";
                    // line 127
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "codigo"), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t";
                    // line 129
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "
\t\t\t\t\t\t    </a>

\t\t\t\t\t\t    <div class=\"prc_pry_container_contentwrapper_id_";
                    // line 132
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
                                                        <table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
                                                            <tr><th class=\"col-md-5\">Código:</th><td class=\"col-md-7\">";
                    // line 134
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "codigo"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Tiempo en sala:</th><td class=\"col-md-7\">";
                    // line 135
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoOcupacionSala"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Tiempo por médico:</th><td class=\"col-md-7\">";
                    // line 136
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoMedico"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Descripción:</th><td class=\"col-md-7\"><pre class=\"pre-display-code-natural\">";
                    // line 137
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
            // line 141
            echo "\t\t\t\t\t    </div>
\t\t\t\t\t</div>
\t\t\t\t    </div>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 145
        echo "\t\t\t    </div>
\t\t\t</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Diagnosticar en:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 150
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idEstablecimientoDiagnosticante"), "html", null, true);
        echo " ";
        if (((!(null === $this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idEstablecimientoDiagnosticante"))) && ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento"), "getId", array(), "method") == $this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idEstablecimientoDiagnosticante"), "getId", array(), "method")))) {
            echo " <span class=\"label label-element-v2\" style=\"\">[Servicio local]</span> ";
        }
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Justificación:</span></th>
\t\t\t<td class=\"col-md-3\" ><pre class=\"pre-display-code-natural\">";
        // line 152
        echo _twig_default_filter(trim($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "justificacionDiagnostico")), "<span style=\"color: #bbb;\">No solicitó diagnóstico...</span>");
        echo "</pre></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Próxima consulta médica:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 156
        echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "fechaProximaConsulta"), "EEEE, MMMM d, yyyy", "es_ES");
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado:</span></th>
\t\t\t<td class=\"col-md-3\" ><span class=\"";
        // line 158
        if ((!(null === $this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idEstadoSolicitud"), "estiloPresentacion")))) {
            echo "label label-";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : null), "idEstadoSolicitud", array(), "any", false, true), "estiloPresentacion", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : null), "idEstadoSolicitud", array(), "any", false, true), "estiloPresentacion"), "primary-v2")) : ("primary-v2")), "html", null, true);
        }
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_request"]) ? $context["object_request"] : $this->getContext($context, "object_request")), "idEstadoSolicitud"), "nombreEstado"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t</table>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:prc_entity_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  357 => 150,  341 => 141,  330 => 137,  318 => 134,  313 => 132,  307 => 129,  302 => 127,  298 => 126,  292 => 123,  288 => 122,  276 => 115,  271 => 114,  254 => 108,  239 => 104,  236 => 103,  228 => 101,  221 => 99,  208 => 95,  205 => 94,  200 => 92,  197 => 91,  190 => 89,  181 => 83,  165 => 77,  157 => 72,  143 => 64,  133 => 59,  118 => 50,  92 => 33,  80 => 27,  66 => 21,  36 => 9,  443 => 200,  420 => 186,  412 => 183,  398 => 178,  392 => 175,  388 => 174,  370 => 164,  347 => 150,  340 => 146,  333 => 142,  326 => 136,  319 => 134,  304 => 125,  299 => 123,  295 => 122,  291 => 121,  287 => 119,  281 => 117,  278 => 116,  272 => 114,  269 => 113,  266 => 112,  264 => 111,  261 => 110,  258 => 109,  255 => 108,  253 => 107,  250 => 107,  247 => 105,  244 => 104,  240 => 102,  225 => 100,  210 => 86,  206 => 85,  202 => 84,  196 => 81,  192 => 90,  186 => 77,  178 => 75,  167 => 67,  164 => 66,  160 => 65,  149 => 67,  141 => 52,  134 => 48,  127 => 56,  120 => 40,  113 => 36,  106 => 32,  94 => 27,  89 => 25,  85 => 24,  77 => 21,  74 => 20,  71 => 19,  65 => 17,  59 => 19,  56 => 14,  54 => 13,  48 => 15,  38 => 8,  33 => 6,  246 => 105,  235 => 77,  233 => 76,  230 => 102,  227 => 74,  217 => 97,  214 => 88,  201 => 68,  198 => 67,  185 => 64,  182 => 76,  179 => 62,  171 => 61,  169 => 60,  163 => 58,  155 => 57,  153 => 56,  147 => 54,  139 => 53,  137 => 52,  130 => 47,  126 => 45,  123 => 44,  119 => 42,  116 => 41,  112 => 39,  105 => 36,  102 => 35,  98 => 33,  95 => 32,  91 => 30,  88 => 29,  84 => 27,  82 => 26,  78 => 24,  75 => 25,  68 => 18,  64 => 20,  62 => 16,  60 => 18,  57 => 17,  50 => 15,  47 => 14,  43 => 13,  41 => 12,  39 => 11,  34 => 9,  32 => 8,  30 => 7,  28 => 4,  26 => 5,  24 => 4,  22 => 3,  19 => 2,  639 => 313,  636 => 312,  633 => 311,  630 => 310,  621 => 307,  618 => 306,  613 => 305,  611 => 304,  608 => 303,  602 => 299,  598 => 298,  596 => 297,  591 => 296,  589 => 295,  586 => 294,  584 => 293,  582 => 290,  578 => 288,  575 => 287,  572 => 286,  569 => 285,  560 => 282,  557 => 281,  552 => 280,  550 => 279,  547 => 278,  541 => 274,  537 => 273,  535 => 272,  530 => 271,  528 => 270,  525 => 269,  517 => 267,  515 => 266,  512 => 265,  505 => 263,  500 => 262,  498 => 261,  495 => 260,  491 => 255,  488 => 254,  482 => 251,  478 => 249,  475 => 248,  472 => 247,  466 => 245,  460 => 243,  457 => 242,  455 => 241,  452 => 240,  449 => 239,  444 => 236,  441 => 235,  433 => 233,  431 => 190,  427 => 230,  424 => 229,  419 => 227,  416 => 184,  413 => 225,  408 => 182,  405 => 215,  402 => 179,  397 => 169,  394 => 168,  386 => 167,  384 => 173,  381 => 165,  378 => 158,  373 => 156,  366 => 152,  361 => 171,  359 => 164,  355 => 155,  352 => 160,  350 => 145,  348 => 149,  345 => 148,  334 => 139,  331 => 138,  322 => 135,  315 => 126,  312 => 130,  308 => 123,  305 => 122,  296 => 118,  293 => 117,  290 => 116,  284 => 121,  280 => 111,  275 => 115,  273 => 109,  270 => 108,  265 => 104,  260 => 101,  256 => 100,  251 => 98,  243 => 78,  232 => 84,  223 => 80,  219 => 73,  215 => 78,  211 => 96,  207 => 76,  203 => 93,  199 => 74,  195 => 66,  191 => 72,  187 => 65,  184 => 70,  174 => 79,  170 => 65,  166 => 59,  162 => 63,  158 => 62,  154 => 61,  150 => 55,  146 => 59,  142 => 58,  138 => 57,  135 => 56,  131 => 55,  129 => 54,  125 => 53,  109 => 44,  100 => 38,  96 => 37,  87 => 31,  81 => 23,  76 => 23,  72 => 22,  67 => 21,  61 => 18,  58 => 17,  51 => 12,  45 => 10,  42 => 9,  37 => 10,  35 => 7,);
    }
}
