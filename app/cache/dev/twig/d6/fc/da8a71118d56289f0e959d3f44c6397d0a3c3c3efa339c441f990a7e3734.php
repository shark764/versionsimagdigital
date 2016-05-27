<?php

/* MinsalSimagdBundle:show_entity_block:est_entity_block.html.twig */
class __TwigTemplate_d6fcda8a71118d56289f0e959d3f44c6397d0a3c3c3efa339c441f990a7e3734 extends Twig_Template
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
        echo "\" id=\"lct_estudiosTab\" >
        <div class=\"box box-";
        // line 4
        echo twig_escape_filter($this->env, ((array_key_exists("box_style", $context)) ? (_twig_default_filter((isset($context["box_style"]) ? $context["box_style"] : $this->getContext($context, "box_style")), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo " non-titled-sonata-box\">
            <div class=\"box-body\">
\t\t";
        // line 6
        if (((!(null === (isset($context["object_studies"]) ? $context["object_studies"] : $this->getContext($context, "object_studies")))) && (twig_length_filter($this->env, (isset($context["object_studies"]) ? $context["object_studies"] : $this->getContext($context, "object_studies"))) > 0))) {
            // line 7
            echo "\t\t    <div class=\"panel-group\" id=\"studiesRx_studies_containerGroup\">
\t\t\t";
            // line 8
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["object_studies"]) ? $context["object_studies"] : $this->getContext($context, "object_studies")));
            foreach ($context['_seq'] as $context["_key"] => $context["study"]) {
                // line 9
                echo "\t\t\t    ";
                $context["study_proc"] = $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdProcedimientoRealizado", array(), "method");
                // line 10
                echo "\t\t\t    ";
                $context["study_request"] = $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "getIdSolicitudEstudio", array(), "method");
                // line 11
                echo "\t\t\t    ";
                $context["study_request_cmpl"] = $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "getIdSolicitudEstudioComplementario", array(), "method");
                // line 12
                echo "\t\t\t    
\t\t\t    ";
                // line 13
                $context["study_modality"] = null;
                // line 14
                echo "\t\t\t    ";
                if (((!(null === (isset($context["study_request"]) ? $context["study_request"] : $this->getContext($context, "study_request")))) && (null === (isset($context["study_request_cmpl"]) ? $context["study_request_cmpl"] : $this->getContext($context, "study_request_cmpl"))))) {
                    // line 15
                    echo "\t\t\t\t";
                    $context["study_modality"] = twig_truncate_filter($this->env, trim($this->getAttribute((isset($context["study_request"]) ? $context["study_request"] : $this->getContext($context, "study_request")), "getIdAreaServicioDiagnostico", array(), "method")), 35);
                    // line 16
                    echo "\t\t\t    ";
                } elseif ((!(null === (isset($context["study_request_cmpl"]) ? $context["study_request_cmpl"] : $this->getContext($context, "study_request_cmpl"))))) {
                    // line 17
                    echo "\t\t\t\t";
                    $context["study_modality"] = twig_truncate_filter($this->env, trim($this->getAttribute((isset($context["study_request_cmpl"]) ? $context["study_request_cmpl"] : $this->getContext($context, "study_request_cmpl")), "getIdAreaServicioDiagnostico", array(), "method")), 35);
                    // line 18
                    echo "\t\t\t    ";
                } else {
                    // line 19
                    echo "\t\t\t\t";
                    $context["study_modality"] = "Modalidad no determinada";
                    // line 20
                    echo "\t\t\t    ";
                }
                // line 21
                echo "
\t\t\t    <div class=\"panel panel-primary-v2\">
\t\t\t\t<a class=\"list-group-item btn-link btn-link-v2\" data-toggle=\"collapse\" href=\"#studiesRx_study_panelCollapse_id_";
                // line 23
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "id"), "html", null, true);
                echo "\">
\t\t\t\t    <span class=\"badge\">";
                // line 24
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "idEstadoProcedimientoRealizado"), "html", null, true);
                echo "</span>
\t\t\t\t    ";
                // line 25
                echo twig_escape_filter($this->env, ((array_key_exists("study_modality", $context)) ? (_twig_default_filter((isset($context["study_modality"]) ? $context["study_modality"] : $this->getContext($context, "study_modality")), "Modalidad no determinada")) : ("Modalidad no determinada")), "html", null, true);
                echo "
\t\t\t\t</a>
\t\t\t\t<div class=\"panel-collapse collapse ";
                // line 27
                if (((!(null === (isset($context["object_study"]) ? $context["object_study"] : $this->getContext($context, "object_study")))) && ($this->getAttribute((isset($context["object_study"]) ? $context["object_study"] : $this->getContext($context, "object_study")), "getId", array(), "method") == $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getId", array(), "method")))) {
                    echo "in";
                }
                echo "\" id=\"studiesRx_study_panelCollapse_id_";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "id"), "html", null, true);
                echo "\">
\t\t\t\t    <div class=\"panel-body\">
\t\t\t\t\t<table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "id"), "html", null, true);
                echo "</span></td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estudio de:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
                // line 36
                echo twig_escape_filter($this->env, ((array_key_exists("study_modality", $context)) ? (_twig_default_filter((isset($context["study_modality"]) ? $context["study_modality"] : $this->getContext($context, "study_modality")), "Modalidad no determinada")) : ("Modalidad no determinada")), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Tecnólogo:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
                // line 40
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "idTecnologoRealiza"), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha de registro:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
                // line 44
                echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "fechaRegistro"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "fechaRegistro"), "H:i:s A")), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha de almacenamiento en PACS:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
                // line 48
                echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "fechaEstudio"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "fechaEstudio"), "H:i:s A")), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
                // line 52
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "idEstadoProcedimientoRealizado"), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Incidencias:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
\t\t\t\t\t\t    <pre class=\"pre-display-code-natural\">";
                // line 57
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "incidencias"), "html", null, true);
                echo "</pre>
\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Materiales utilizados:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
\t\t\t\t\t\t
\t\t\t\t\t\t    <ul class=\"list-group\">
\t\t\t\t\t\t\t";
                // line 65
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "materialUtilizadoV2"));
                foreach ($context['_seq'] as $context["_key"] => $context["material"]) {
                    // line 66
                    echo "\t\t\t\t\t\t\t    <li class=\"list-group-item\">
\t\t\t\t\t\t\t\t<span class=\"badge\">";
                    // line 67
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "cantidadUtilizada"), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<a  tabindex=\"0\"
\t\t\t\t\t\t\t\t    class=\"btn-link btn-link-v2\"
\t\t\t\t\t\t\t\t    role=\"button\"
\t\t\t\t\t\t\t\t    data-toggle=\"popover\"
\t\t\t\t\t\t\t\t    rel=\"popover\"
\t\t\t\t\t\t\t\t    data-trigger=\"hover\"
\t\t\t\t\t\t\t\t    title=\"";
                    // line 75
                    echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
                    echo "\"
\t\t\t\t\t\t\t\t    data-original-title=\"";
                    // line 76
                    echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
                    echo "\"
\t\t\t\t\t\t\t\t    data-contentwrapper=\".mtrl_history_container_contentwrapper_id_";
                    // line 77
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\t\t    data-placement=\"top\"
\t\t\t\t\t\t\t\t    href=\"javascript:void(0)\"
\t\t\t\t\t\t\t\t    data-id=\"";
                    // line 80
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
                    echo "\" >
\t\t\t\t\t\t\t\t    ";
                    // line 81
                    echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
                    echo "
\t\t\t\t\t\t\t\t</a>

\t\t\t\t\t\t\t\t<div class=\"mtrl_history_container_contentwrapper_id_";
                    // line 84
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
                    echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
\t\t\t\t\t\t\t\t    <strong>Código:</strong> <span class=\"badge\"> ";
                    // line 85
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method"), "codigo"), "html", null, true);
                    echo " </span> <br/>
\t\t\t\t\t\t\t\t    <strong>Cantidad utilizada:</strong> ";
                    // line 86
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "cantidadUtilizada"), "html", null, true);
                    echo " <br/>
\t\t\t\t\t\t\t\t    ";
                    // line 88
                    echo "\t\t\t\t\t\t\t\t    <strong>Otras especificaciones:</strong> ";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "otrasEspecificaciones"), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t    </li>
\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['material'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 92
                echo "\t\t\t\t\t\t    </ul>
\t\t\t\t\t\t    
\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t</table>
\t\t\t\t    </div>
\t\t\t\t</div>
\t\t\t    </div>
\t\t\t    
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['study'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 102
            echo "\t\t    </div>
\t\t";
        }
        // line 104
        echo "\t\t";
        if ((((!(null === (isset($context["object_study"]) ? $context["object_study"] : $this->getContext($context, "object_study")))) && (null === (isset($context["object_studies"]) ? $context["object_studies"] : $this->getContext($context, "object_studies")))) && (twig_length_filter($this->env, (isset($context["object_studies"]) ? $context["object_studies"] : $this->getContext($context, "object_studies"))) <= 0))) {
            // line 105
            echo "                    ";
            $context["study"] = (isset($context["object_study"]) ? $context["object_study"] : $this->getContext($context, "object_study"));
            // line 106
            echo "\t\t    <div class=\"panel-group\" id=\"studiesRx_single_study_containerGroup\">
                        ";
            // line 107
            $context["study_proc"] = $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdProcedimientoRealizado", array(), "method");
            // line 108
            echo "                        ";
            $context["study_request"] = $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "getIdSolicitudEstudio", array(), "method");
            // line 109
            echo "                        ";
            $context["study_request_cmpl"] = $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "getIdSolicitudEstudioComplementario", array(), "method");
            // line 110
            echo "
                        ";
            // line 111
            $context["study_modality"] = null;
            // line 112
            echo "                        ";
            if (((!(null === (isset($context["study_request"]) ? $context["study_request"] : $this->getContext($context, "study_request")))) && (null === (isset($context["study_request_cmpl"]) ? $context["study_request_cmpl"] : $this->getContext($context, "study_request_cmpl"))))) {
                // line 113
                echo "                            ";
                $context["study_modality"] = twig_truncate_filter($this->env, trim($this->getAttribute((isset($context["study_request"]) ? $context["study_request"] : $this->getContext($context, "study_request")), "getIdAreaServicioDiagnostico", array(), "method")), 35);
                // line 114
                echo "                        ";
            } elseif ((!(null === (isset($context["study_request_cmpl"]) ? $context["study_request_cmpl"] : $this->getContext($context, "study_request_cmpl"))))) {
                // line 115
                echo "                            ";
                $context["study_modality"] = twig_truncate_filter($this->env, trim($this->getAttribute((isset($context["study_request_cmpl"]) ? $context["study_request_cmpl"] : $this->getContext($context, "study_request_cmpl")), "getIdAreaServicioDiagnostico", array(), "method")), 35);
                // line 116
                echo "                        ";
            } else {
                // line 117
                echo "                            ";
                $context["study_modality"] = "Modalidad no determinada";
                // line 118
                echo "                        ";
            }
            // line 119
            echo "
                        <div class=\"panel panel-primary-v2\">
                            <a class=\"list-group-item btn-link btn-link-v2\" data-toggle=\"collapse\" href=\"#studiesRx_single_study_panelCollapse_id_";
            // line 121
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "id"), "html", null, true);
            echo "\">
                                <span class=\"badge\">";
            // line 122
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "idEstadoProcedimientoRealizado"), "html", null, true);
            echo "</span>
                                ";
            // line 123
            echo twig_escape_filter($this->env, ((array_key_exists("study_modality", $context)) ? (_twig_default_filter((isset($context["study_modality"]) ? $context["study_modality"] : $this->getContext($context, "study_modality")), "Modalidad no determinada")) : ("Modalidad no determinada")), "html", null, true);
            echo "
                            </a>
                            <div class=\"panel-collapse collapse in\" id=\"studiesRx_single_study_panelCollapse_id_";
            // line 125
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "id"), "html", null, true);
            echo "\">
                                <div class=\"panel-body\">
                                    <table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
                                        <tr>
                                            <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
                                            <td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
            // line 130
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "id"), "html", null, true);
            echo "</span></td>
                                        </tr>
                                        <tr>
                                            <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estudio de:</span></th>
                                            <td colspan=\"3\" class=\"col-md-9\" >";
            // line 134
            echo twig_escape_filter($this->env, ((array_key_exists("study_modality", $context)) ? (_twig_default_filter((isset($context["study_modality"]) ? $context["study_modality"] : $this->getContext($context, "study_modality")), "Modalidad no determinada")) : ("Modalidad no determinada")), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Tecnólogo:</span></th>
                                            <td colspan=\"3\" class=\"col-md-9\" >";
            // line 138
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "idTecnologoRealiza"), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha de registro:</span></th>
                                            <td colspan=\"3\" class=\"col-md-9\" >";
            // line 142
            echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "fechaRegistro"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "fechaRegistro"), "H:i:s A")), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha de almacenamiento en PACS:</span></th>
                                            <td colspan=\"3\" class=\"col-md-9\" >";
            // line 146
            echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "fechaEstudio"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "fechaEstudio"), "H:i:s A")), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado:</span></th>
                                            <td colspan=\"3\" class=\"col-md-9\" >";
            // line 150
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "idEstadoProcedimientoRealizado"), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Incidencias:</span></th>
                                            <td colspan=\"3\" class=\"col-md-9\" >
                                                <pre class=\"pre-display-code-natural\">";
            // line 155
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "incidencias"), "html", null, true);
            echo "</pre>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Materiales utilizados:</span></th>
                                            <td colspan=\"3\" class=\"col-md-9\" >

                                                <ul class=\"list-group\">
                                                    ";
            // line 163
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["study_proc"]) ? $context["study_proc"] : $this->getContext($context, "study_proc")), "materialUtilizadoV2"));
            foreach ($context['_seq'] as $context["_key"] => $context["material"]) {
                // line 164
                echo "                                                        <li class=\"list-group-item\">
                                                            <span class=\"badge\">";
                // line 165
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "cantidadUtilizada"), "html", null, true);
                echo "</span>

                                                            <a  tabindex=\"0\"
                                                                class=\"btn-link btn-link-v2\"
                                                                role=\"button\"
                                                                data-toggle=\"popover\"
                                                                rel=\"popover\"
                                                                data-trigger=\"hover\"
                                                                title=\"";
                // line 173
                echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
                echo "\"
                                                                data-original-title=\"";
                // line 174
                echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
                echo "\"
                                                                data-contentwrapper=\".mtrl_history_container_contentwrapper_id_";
                // line 175
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
                echo "\"
                                                                data-placement=\"top\"
                                                                href=\"javascript:void(0)\"
                                                                data-id=\"";
                // line 178
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
                echo "\" >
                                                                ";
                // line 179
                echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
                echo "
                                                            </a>

                                                            <div class=\"mtrl_history_container_contentwrapper_id_";
                // line 182
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
                echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
                                                                <strong>Código:</strong> <span class=\"badge\"> ";
                // line 183
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method"), "codigo"), "html", null, true);
                echo " </span> <br/>
                                                                <strong>Cantidad utilizada:</strong> ";
                // line 184
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "cantidadUtilizada"), "html", null, true);
                echo " <br/>
                                                                ";
                // line 186
                echo "                                                                <strong>Otras especificaciones:</strong> ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "otrasEspecificaciones"), "html", null, true);
                echo "
                                                            </div>
                                                        </li>
                                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['material'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 190
            echo "                                                </ul>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
\t\t    </div>
\t\t";
        }
        // line 200
        echo "            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:est_entity_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  443 => 200,  420 => 186,  412 => 183,  398 => 178,  392 => 175,  388 => 174,  370 => 164,  347 => 150,  340 => 146,  333 => 142,  326 => 138,  319 => 134,  304 => 125,  299 => 123,  295 => 122,  291 => 121,  287 => 119,  281 => 117,  278 => 116,  272 => 114,  269 => 113,  266 => 112,  264 => 111,  261 => 110,  258 => 109,  255 => 108,  253 => 107,  250 => 106,  247 => 105,  244 => 104,  240 => 102,  225 => 92,  210 => 86,  206 => 85,  202 => 84,  196 => 81,  192 => 80,  186 => 77,  178 => 75,  167 => 67,  164 => 66,  160 => 65,  149 => 57,  141 => 52,  134 => 48,  127 => 44,  120 => 40,  113 => 36,  106 => 32,  94 => 27,  89 => 25,  85 => 24,  77 => 21,  74 => 20,  71 => 19,  65 => 17,  59 => 15,  56 => 14,  54 => 13,  48 => 11,  38 => 8,  33 => 6,  246 => 79,  235 => 77,  233 => 76,  230 => 75,  227 => 74,  217 => 72,  214 => 88,  201 => 68,  198 => 67,  185 => 64,  182 => 76,  179 => 62,  171 => 61,  169 => 60,  163 => 58,  155 => 57,  153 => 56,  147 => 54,  139 => 53,  137 => 52,  130 => 47,  126 => 45,  123 => 44,  119 => 42,  116 => 41,  112 => 39,  105 => 36,  102 => 35,  98 => 33,  95 => 32,  91 => 30,  88 => 29,  84 => 27,  82 => 26,  78 => 24,  75 => 23,  68 => 18,  64 => 20,  62 => 16,  60 => 18,  57 => 17,  50 => 15,  47 => 14,  43 => 13,  41 => 12,  39 => 11,  34 => 9,  32 => 8,  30 => 7,  28 => 4,  26 => 5,  24 => 4,  22 => 3,  19 => 2,  639 => 313,  636 => 312,  633 => 311,  630 => 310,  621 => 307,  618 => 306,  613 => 305,  611 => 304,  608 => 303,  602 => 299,  598 => 298,  596 => 297,  591 => 296,  589 => 295,  586 => 294,  584 => 293,  582 => 290,  578 => 288,  575 => 287,  572 => 286,  569 => 285,  560 => 282,  557 => 281,  552 => 280,  550 => 279,  547 => 278,  541 => 274,  537 => 273,  535 => 272,  530 => 271,  528 => 270,  525 => 269,  517 => 267,  515 => 266,  512 => 265,  505 => 263,  500 => 262,  498 => 261,  495 => 260,  491 => 255,  488 => 254,  482 => 251,  478 => 249,  475 => 248,  472 => 247,  466 => 245,  460 => 243,  457 => 242,  455 => 241,  452 => 240,  449 => 239,  444 => 236,  441 => 235,  433 => 233,  431 => 190,  427 => 230,  424 => 229,  419 => 227,  416 => 184,  413 => 225,  408 => 182,  405 => 215,  402 => 179,  397 => 169,  394 => 168,  386 => 167,  384 => 173,  381 => 165,  378 => 164,  373 => 165,  366 => 163,  361 => 171,  359 => 164,  355 => 155,  352 => 160,  350 => 153,  348 => 149,  345 => 148,  334 => 139,  331 => 138,  322 => 131,  315 => 126,  312 => 130,  308 => 123,  305 => 122,  296 => 118,  293 => 117,  290 => 116,  284 => 118,  280 => 111,  275 => 115,  273 => 109,  270 => 108,  265 => 104,  260 => 101,  256 => 100,  251 => 98,  243 => 78,  232 => 84,  223 => 80,  219 => 73,  215 => 78,  211 => 70,  207 => 76,  203 => 69,  199 => 74,  195 => 66,  191 => 72,  187 => 65,  184 => 70,  174 => 66,  170 => 65,  166 => 59,  162 => 63,  158 => 62,  154 => 61,  150 => 55,  146 => 59,  142 => 58,  138 => 57,  135 => 56,  131 => 55,  129 => 54,  125 => 53,  109 => 38,  100 => 38,  96 => 37,  87 => 30,  81 => 23,  76 => 23,  72 => 22,  67 => 21,  61 => 18,  58 => 17,  51 => 12,  45 => 10,  42 => 9,  37 => 10,  35 => 7,);
    }
}
