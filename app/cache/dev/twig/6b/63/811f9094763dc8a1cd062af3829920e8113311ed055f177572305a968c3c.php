<?php

/* MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_filtrarData.html.twig */
class __TwigTemplate_6b63811f9094763dc8a1cd062af3829920e8113311ed055f177572305a968c3c extends Twig_Template
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
        echo "<div id=\"diagFiltrarDatos-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-clipboard\"></i> Filtrar diagnósticos</h4>
        </div>

        <div class=\"modal-body\">

\t    <div style=\"padding-left: 15px; padding-right: 15px;\">
\t\t    
\t\t<h4 class=\"\" style=\"\">
\t\t    <span class=\"label label-primary-v2\"> Formulario para filtrar listado de diagnósticos </span>
\t\t</h4>
\t\t<br/>
\t\t
\t\t<div class=\"row outer simagd-filter-content-layout\" style=\"padding-left: 15px; padding-right: 15px; ";
        // line 20
        echo "\">

\t\t    <form id=\"diagFiltrarDatosForm\" action=\"";
        // line 22
        echo $this->env->getExtension('routing')->getPath("simagd_diagnostico_listarDiagnosticos");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\">

\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-xs-2 control-label\">ID:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<input type=\"number\" class=\"form-control\" id=\"formFilterDiagId\" name=\"formFilterDiagId\" placeholder=\"ID\" min=\"1\" />
\t\t\t    </div>
\t\t\t    <label class=\"col-xs-2 control-label\">Estado:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagEstado\" name=\"formFilterDiagEstado\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    <optgroup label=\"Estados posibles\">
\t\t\t\t    ";
        // line 34
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["estados"]) ? $context["estados"] : $this->getContext($context, "estados")));
        foreach ($context['_seq'] as $context["_key"] => $context["estado"]) {
            // line 35
            echo "\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "html", null, true);
            echo "</option>
\t\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "\t\t\t\t    </optgroup>
\t\t\t\t</select>
\t\t\t    </div>
\t\t\t</div>

\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-xs-2 control-label\">Origen:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagOrigen\" name=\"formFilterDiagOrigen\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    ";
        // line 47
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEstab"]) ? $context["tiposEstab"] : $this->getContext($context, "tiposEstab")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            // line 48
            echo "\t\t\t\t\t<optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
            echo "\">
\t\t\t\t\t";
            // line 49
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")));
            foreach ($context['_seq'] as $context["_key"] => $context["establecimiento"]) {
                if (((!(null === $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"))) && ($this->getAttribute($this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                    // line 50
                    echo "\t\t\t\t\t    <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "id"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "nombre"), "html", null, true);
                    echo "</option>
\t\t\t\t\t";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['establecimiento'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "\t\t\t\t\t</optgroup>
\t\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "\t\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")));
        foreach ($context['_seq'] as $context["_key"] => $context["establecimiento"]) {
            if ((null === $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"))) {
                // line 55
                echo "\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "nombre"), "html", null, true);
                echo "</option>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['establecimiento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        echo "\t\t\t\t</select>
\t\t\t    </div>
\t\t\t    <label class=\"col-xs-2 control-label\">Transcribió:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagTranscriptor\" name=\"formFilterDiagTranscriptor\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    ";
        // line 63
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if (((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY")) || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "ACL"))) {
                // line 64
                echo "\t\t\t\t\t<optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
\t\t\t\t\t";
                // line 65
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")));
                foreach ($context['_seq'] as $context["_key"] => $context["transcriptor"]) {
                    if (((!(null === $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 66
                        echo "\t\t\t\t\t    <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "html", null, true);
                        echo "</option>
\t\t\t\t\t";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transcriptor'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 68
                echo "\t\t\t\t\t</optgroup>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "\t\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")));
        foreach ($context['_seq'] as $context["_key"] => $context["transcriptor"]) {
            if ((null === $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"))) {
                // line 71
                echo "\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "html", null, true);
                echo "</option>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transcriptor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        echo "\t\t\t\t</select>
\t\t\t    </div>
\t\t\t</div>

\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-xs-2 control-label\">Paciente:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagPaciente\" name=\"formFilterDiagPaciente\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    ";
        // line 91
        echo "\t\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pacientes"]) ? $context["pacientes"] : $this->getContext($context, "pacientes")));
        foreach ($context['_seq'] as $context["_key"] => $context["paciente"]) {
            // line 92
            echo "\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "id"), "html", null, true);
            echo "\">
\t\t\t\t\t    ";
            // line 93
            echo twig_escape_filter($this->env, (((((($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "primerApellido") . " ") . $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "segundoApellido")) . ", ") . $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "primerNombre")) . " ") . $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "segundoNombre")), "html", null, true);
            echo "
\t\t\t\t\t</option>
\t\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['paciente'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "\t\t\t\t</select>
\t\t\t    </div>
\t\t\t    <label class=\"col-xs-2 control-label\">Interpretó:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagInterprete\" name=\"formFilterDiagInterprete\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    ";
        // line 102
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 103
                echo "\t\t\t\t\t<optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
\t\t\t\t\t";
                // line 104
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 105
                        echo "\t\t\t\t\t    <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                        echo "</option>
\t\t\t\t\t";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 107
                echo "\t\t\t\t\t</optgroup>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 109
        echo "\t\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 110
                echo "\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                echo "</option>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 112
        echo "\t\t\t\t</select>
\t\t\t    </div>
\t\t\t</div>

\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-xs-2 control-label\">Solicitó:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagSolicitante\" name=\"formFilterDiagSolicitante\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    ";
        // line 121
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if (($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED")) {
                // line 122
                echo "\t\t\t\t\t<optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
\t\t\t\t\t";
                // line 123
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["solicitantes"]) ? $context["solicitantes"] : $this->getContext($context, "solicitantes")));
                foreach ($context['_seq'] as $context["_key"] => $context["solicitante"]) {
                    if (((!(null === $this->getAttribute((isset($context["solicitante"]) ? $context["solicitante"] : $this->getContext($context, "solicitante")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["solicitante"]) ? $context["solicitante"] : $this->getContext($context, "solicitante")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 124
                        echo "\t\t\t\t\t    <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitante"]) ? $context["solicitante"] : $this->getContext($context, "solicitante")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["solicitante"]) ? $context["solicitante"] : $this->getContext($context, "solicitante")), "html", null, true);
                        echo "</option>
\t\t\t\t\t";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['solicitante'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 126
                echo "\t\t\t\t\t</optgroup>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        echo "\t\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["solicitantes"]) ? $context["solicitantes"] : $this->getContext($context, "solicitantes")));
        foreach ($context['_seq'] as $context["_key"] => $context["solicitante"]) {
            if ((null === $this->getAttribute((isset($context["solicitante"]) ? $context["solicitante"] : $this->getContext($context, "solicitante")), "idTipoEmpleado"))) {
                // line 129
                echo "\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitante"]) ? $context["solicitante"] : $this->getContext($context, "solicitante")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["solicitante"]) ? $context["solicitante"] : $this->getContext($context, "solicitante")), "html", null, true);
                echo "</option>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['solicitante'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 131
        echo "\t\t\t\t</select>
\t\t\t    </div>
\t\t\t    <label class=\"col-xs-2 control-label\">Correlativo:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Digite un correlativo\" id=\"formFilterDiagCorrelativo\" name=\"formFilterDiagCorrelativo\" maxlength=\"35\" />
\t\t\t    </div>
\t\t\t</div>

\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-xs-2 control-label\">Área de atención:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagAreaAtencion\" name=\"formFilterDiagAreaAtencion\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    ";
        // line 144
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["areasAtencion"]) ? $context["areasAtencion"] : $this->getContext($context, "areasAtencion")));
        foreach ($context['_seq'] as $context["_key"] => $context["areaAtencion"]) {
            // line 145
            echo "\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["areaAtencion"]) ? $context["areaAtencion"] : $this->getContext($context, "areaAtencion")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["areaAtencion"]) ? $context["areaAtencion"] : $this->getContext($context, "areaAtencion")), "html", null, true);
            echo "</option>
\t\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['areaAtencion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 147
        echo "\t\t\t\t</select>
\t\t\t    </div>
\t\t\t    <label class=\"col-xs-2 control-label\">Se interpretó:</label>
\t\t\t    <div class=\"col-xs-2\">
\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Rango inicial\" id=\"formFilterDiagInterpretadoInicio\" name=\"formFilterDiagInterpretadoInicio\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\" />
\t\t\t    </div>
\t\t\t    <div class=\"col-xs-2\">
\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Rango final\" id=\"formFilterDiagInterpretadoFin\" name=\"formFilterDiagInterpretadoFin\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\" />
\t\t\t    </div>
\t\t\t</div>

\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-xs-2 control-label\">Servicio:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagAtencion\" name=\"formFilterDiagAtencion\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    ";
        // line 163
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["atenciones"]) ? $context["atenciones"] : $this->getContext($context, "atenciones")));
        foreach ($context['_seq'] as $context["_key"] => $context["atencion"]) {
            // line 164
            echo "\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["atencion"]) ? $context["atencion"] : $this->getContext($context, "atencion")), "html", null, true);
            echo "</option>
\t\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atencion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 166
        echo "\t\t\t\t</select>
\t\t\t    </div>
\t\t\t    <label class=\"col-xs-2 control-label\">Se transcribió</label>
\t\t\t    <div class=\"col-xs-2\">
\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Rango inicial\" id=\"formFilterDiagTranscritoInicio\" name=\"formFilterDiagTranscritoInicio\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\" />
\t\t\t    </div>
\t\t\t    <div class=\"col-xs-2\">
\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Rango final\" id=\"formFilterDiagTranscritoFin\" name=\"formFilterDiagTranscritoFin\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\" />
\t\t\t    </div>
\t\t\t</div>

\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-xs-2 control-label\">Modalidad:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagModalidad\" name=\"formFilterDiagModalidad\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    <optgroup label=\"Imagenología\">
\t\t\t\t    ";
        // line 183
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 184
            echo "\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "html", null, true);
            echo "</option>
\t\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modalidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 186
        echo "\t\t\t\t    </optgroup>
\t\t\t\t</select>
\t\t\t    </div>
\t\t\t    <label class=\"col-xs-2 control-label\">Se aprobó:</label>
\t\t\t    <div class=\"col-xs-2\">
\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Rango inicial\" id=\"formFilterDiagAprobadoInicio\" name=\"formFilterDiagAprobadoInicio\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\" />
\t\t\t    </div>
\t\t\t    <div class=\"col-xs-2\">
\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Rango final\" id=\"formFilterDiagAprobadoFin\" name=\"formFilterDiagAprobadoFin\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\" />
\t\t\t    </div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"form-group\">
\t\t\t    <label class=\"col-xs-2 control-label\">Tecnólogo:</label>
\t\t\t    <div class=\"col-xs-4\">
\t\t\t\t<select id=\"formFilterDiagTecnologo\" name=\"formFilterDiagTecnologo\" class=\"form-control select2-select\" multiple >
\t\t\t\t    <option value=\"\"></option>
\t\t\t\t    ";
        // line 203
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 204
                echo "\t\t\t\t\t<optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
\t\t\t\t\t";
                // line 205
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["tecnologos"]) ? $context["tecnologos"] : $this->getContext($context, "tecnologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["tecnologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["tecnologo"]) ? $context["tecnologo"] : $this->getContext($context, "tecnologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["tecnologo"]) ? $context["tecnologo"] : $this->getContext($context, "tecnologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 206
                        echo "\t\t\t\t\t    <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tecnologo"]) ? $context["tecnologo"] : $this->getContext($context, "tecnologo")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["tecnologo"]) ? $context["tecnologo"] : $this->getContext($context, "tecnologo")), "html", null, true);
                        echo "</option>
\t\t\t\t\t";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tecnologo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 208
                echo "\t\t\t\t\t</optgroup>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 210
        echo "\t\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tecnologos"]) ? $context["tecnologos"] : $this->getContext($context, "tecnologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["tecnologo"]) {
            if ((null === $this->getAttribute((isset($context["tecnologo"]) ? $context["tecnologo"] : $this->getContext($context, "tecnologo")), "idTipoEmpleado"))) {
                // line 211
                echo "\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tecnologo"]) ? $context["tecnologo"] : $this->getContext($context, "tecnologo")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["tecnologo"]) ? $context["tecnologo"] : $this->getContext($context, "tecnologo")), "html", null, true);
                echo "</option>
\t\t\t\t    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tecnologo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 213
        echo "\t\t\t\t</select>
\t\t\t    </div>
\t\t\t</div>
\t    
\t\t    </form>
\t\t
\t\t</div>
\t    </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Estos filtros están bien? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> Cerrar</button>
            <button type=\"button\" id=\"btn_vaciar_filtros_diag\" name=\"btn_vaciar_filtros_diag\" class=\"btn btn-danger\" ><i class=\"fa fa-trash-o\"></i> Vaciar</button>
            <button type=\"button\" id=\"btn_filtrar_datos_diag\" name=\"btn_filtrar_datos_diag\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-square\"></i> Filtrar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_filtrarData.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  489 => 228,  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 245,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 230,  564 => 361,  561 => 235,  456 => 198,  431 => 185,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 151,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 194,  445 => 193,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 186,  517 => 244,  484 => 206,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 105,  622 => 204,  531 => 224,  498 => 231,  468 => 236,  458 => 204,  401 => 163,  369 => 103,  356 => 180,  340 => 91,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 186,  408 => 182,  363 => 174,  359 => 100,  348 => 149,  345 => 163,  336 => 89,  316 => 159,  307 => 79,  261 => 116,  266 => 122,  542 => 230,  538 => 228,  527 => 197,  509 => 353,  499 => 248,  493 => 155,  479 => 205,  473 => 165,  414 => 180,  406 => 237,  280 => 117,  223 => 121,  585 => 224,  551 => 356,  546 => 308,  506 => 237,  503 => 193,  488 => 242,  485 => 268,  478 => 218,  475 => 205,  471 => 204,  448 => 192,  386 => 169,  378 => 178,  375 => 177,  306 => 190,  291 => 193,  286 => 128,  392 => 110,  332 => 142,  318 => 83,  276 => 115,  190 => 87,  12 => 36,  195 => 79,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 243,  496 => 208,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 197,  416 => 166,  395 => 111,  391 => 182,  382 => 195,  372 => 145,  364 => 102,  353 => 131,  335 => 128,  333 => 88,  297 => 132,  292 => 145,  205 => 82,  200 => 97,  184 => 71,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 213,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 201,  463 => 208,  446 => 207,  443 => 200,  429 => 200,  425 => 195,  410 => 190,  397 => 112,  394 => 168,  389 => 109,  357 => 150,  342 => 145,  334 => 139,  330 => 87,  328 => 140,  290 => 130,  287 => 119,  263 => 107,  255 => 101,  245 => 146,  194 => 82,  76 => 26,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 229,  481 => 208,  476 => 239,  467 => 221,  451 => 213,  424 => 198,  418 => 183,  412 => 183,  399 => 113,  396 => 167,  390 => 171,  388 => 181,  383 => 147,  377 => 169,  373 => 159,  370 => 164,  367 => 155,  352 => 160,  349 => 95,  346 => 94,  329 => 157,  326 => 136,  313 => 81,  303 => 145,  300 => 121,  234 => 93,  218 => 86,  207 => 80,  178 => 94,  321 => 134,  295 => 122,  274 => 125,  242 => 95,  236 => 102,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 227,  529 => 174,  524 => 173,  516 => 143,  510 => 211,  504 => 210,  500 => 262,  490 => 211,  486 => 210,  482 => 251,  470 => 237,  464 => 180,  459 => 171,  452 => 209,  434 => 201,  421 => 184,  417 => 250,  385 => 185,  361 => 173,  344 => 157,  339 => 141,  324 => 85,  310 => 123,  302 => 74,  296 => 121,  282 => 180,  259 => 122,  244 => 99,  231 => 143,  226 => 90,  114 => 64,  104 => 31,  288 => 122,  284 => 136,  279 => 162,  275 => 64,  256 => 99,  250 => 107,  237 => 108,  232 => 92,  222 => 89,  215 => 85,  191 => 78,  153 => 84,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 224,  523 => 268,  518 => 221,  514 => 168,  511 => 242,  508 => 241,  501 => 313,  495 => 260,  491 => 255,  487 => 224,  460 => 243,  455 => 241,  449 => 208,  442 => 210,  439 => 184,  436 => 202,  433 => 186,  426 => 126,  420 => 194,  415 => 182,  411 => 202,  405 => 164,  403 => 117,  400 => 185,  380 => 179,  366 => 152,  354 => 167,  331 => 138,  325 => 94,  320 => 154,  317 => 131,  311 => 127,  308 => 135,  304 => 139,  272 => 124,  267 => 169,  249 => 97,  216 => 87,  155 => 65,  152 => 81,  146 => 61,  126 => 52,  181 => 74,  161 => 67,  110 => 46,  188 => 77,  186 => 71,  170 => 64,  150 => 64,  124 => 51,  358 => 172,  351 => 166,  347 => 150,  343 => 146,  338 => 160,  327 => 126,  323 => 155,  319 => 138,  315 => 124,  301 => 182,  299 => 73,  293 => 69,  289 => 112,  281 => 109,  277 => 110,  271 => 109,  265 => 124,  262 => 123,  260 => 60,  257 => 148,  251 => 105,  248 => 99,  239 => 94,  228 => 96,  225 => 88,  213 => 102,  211 => 84,  197 => 79,  174 => 72,  148 => 57,  134 => 50,  127 => 42,  20 => 2,  53 => 15,  270 => 108,  253 => 58,  233 => 51,  212 => 86,  210 => 98,  206 => 84,  202 => 83,  198 => 73,  192 => 80,  185 => 93,  180 => 70,  175 => 73,  172 => 68,  167 => 84,  165 => 69,  160 => 66,  137 => 57,  113 => 36,  100 => 50,  90 => 48,  81 => 27,  129 => 46,  84 => 58,  77 => 24,  34 => 10,  118 => 42,  97 => 36,  70 => 25,  65 => 17,  58 => 20,  23 => 4,  480 => 301,  474 => 204,  469 => 203,  461 => 200,  457 => 199,  453 => 169,  444 => 236,  440 => 203,  437 => 187,  435 => 183,  430 => 172,  427 => 199,  423 => 206,  413 => 119,  409 => 117,  407 => 171,  402 => 114,  398 => 184,  393 => 183,  387 => 176,  384 => 164,  381 => 107,  379 => 106,  374 => 161,  368 => 144,  365 => 154,  362 => 101,  360 => 219,  355 => 98,  341 => 129,  337 => 144,  322 => 135,  314 => 149,  312 => 151,  309 => 126,  305 => 122,  298 => 146,  294 => 131,  285 => 119,  283 => 118,  278 => 108,  268 => 127,  264 => 150,  258 => 138,  252 => 98,  247 => 56,  241 => 103,  229 => 91,  220 => 107,  214 => 92,  177 => 74,  169 => 60,  140 => 58,  132 => 67,  128 => 72,  107 => 45,  61 => 21,  273 => 165,  269 => 63,  254 => 120,  243 => 116,  240 => 145,  238 => 96,  235 => 144,  230 => 94,  227 => 122,  224 => 108,  221 => 87,  219 => 93,  217 => 138,  208 => 83,  204 => 83,  179 => 76,  159 => 88,  143 => 122,  135 => 56,  119 => 54,  102 => 33,  71 => 22,  67 => 24,  63 => 35,  59 => 34,  38 => 9,  94 => 35,  89 => 59,  85 => 31,  75 => 27,  68 => 23,  56 => 14,  201 => 81,  196 => 81,  183 => 75,  171 => 72,  166 => 63,  163 => 63,  158 => 66,  156 => 82,  151 => 63,  142 => 56,  138 => 52,  136 => 51,  121 => 45,  117 => 42,  105 => 35,  91 => 34,  62 => 16,  49 => 16,  28 => 5,  26 => 6,  87 => 32,  31 => 5,  25 => 5,  21 => 6,  24 => 6,  19 => 2,  93 => 28,  88 => 27,  78 => 47,  46 => 15,  44 => 22,  27 => 7,  79 => 29,  72 => 20,  69 => 51,  47 => 15,  40 => 20,  37 => 11,  22 => 4,  246 => 104,  157 => 38,  145 => 63,  139 => 55,  131 => 49,  123 => 41,  120 => 65,  115 => 44,  111 => 42,  108 => 39,  101 => 33,  98 => 67,  96 => 68,  83 => 28,  74 => 37,  66 => 21,  55 => 19,  52 => 13,  50 => 15,  43 => 14,  41 => 11,  35 => 14,  32 => 9,  29 => 8,  209 => 91,  203 => 93,  199 => 82,  193 => 77,  189 => 79,  187 => 78,  182 => 77,  176 => 72,  173 => 71,  168 => 70,  164 => 118,  162 => 62,  154 => 64,  149 => 82,  147 => 61,  144 => 60,  141 => 74,  133 => 55,  130 => 54,  125 => 55,  122 => 85,  116 => 37,  112 => 52,  109 => 41,  106 => 40,  103 => 39,  99 => 37,  95 => 49,  92 => 58,  86 => 47,  82 => 30,  80 => 25,  73 => 26,  64 => 17,  60 => 19,  57 => 18,  54 => 14,  51 => 17,  48 => 21,  45 => 13,  42 => 27,  39 => 12,  36 => 10,  33 => 7,  30 => 6,);
    }
}
