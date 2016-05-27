<?php

/* MinsalSimagdBundle:show_entity_block:cit_entity_block.html.twig */
class __TwigTemplate_e502313423f136c296c7b245cc2ec5ea636efe4e4165ef454ccf8c2c9fb62356 extends Twig_Template
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
        echo "\" id=\"lct_citaTab\" >
        <div class=\"box box-";
        // line 4
        echo twig_escape_filter($this->env, ((array_key_exists("box_style", $context)) ? (_twig_default_filter((isset($context["box_style"]) ? $context["box_style"] : $this->getContext($context, "box_style")), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo " non-titled-sonata-box\">
            <div class=\"box-body\">
                <table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "id"), "html", null, true);
        echo "</span></td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Creada:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 13
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaCreacion"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaCreacion"), "H:i:s A")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Registró:</span></th>
                        <td class=\"col-md-3\" >";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "idEmpleado"), "html", null, true);
        echo "</td>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Usuario:</span></th>
                        <td class=\"col-md-3\" >";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "idUserPrg"), "idEmpleado"), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha programada:</span></th>
                        <td class=\"col-md-3\" >";
        // line 23
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaHoraInicio"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaHoraInicio"), "H:i:s A")), "html", null, true);
        echo "</td>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha programada anterior:</span></th>
                        <td class=\"col-md-3\" >
\t\t\t    ";
        // line 26
        if ((!(null === $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaHoraInicioAnterior")))) {
            // line 27
            echo "\t\t\t\t";
            echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaHoraInicioAnterior"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaHoraInicioAnterior"), "H:i:s A")), "html", null, true);
            echo "
\t\t\t    ";
        }
        // line 29
        echo "\t\t\t</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "idEstadoCita"), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Se confirmó:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 37
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaConfirmacion"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaConfirmacion"), "H:i:s A")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Tecnólogo asignado:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "idTecnologoProgramado"), "html", null, true);
        echo "</td>
                    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Reprogramada:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 45
        echo (($this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "reprogramada")) ? ("Si") : ("No"));
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Se reprogramó:</span></th>
\t\t\t<td class=\"col-md-3\" >
\t\t\t    ";
        // line 48
        if ((!(null === $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaReprogramacion")))) {
            // line 49
            echo "\t\t\t\t";
            echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaReprogramacion"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "fechaReprogramacion"), "H:i:s A")), "html", null, true);
            echo "
\t\t\t    ";
        }
        // line 51
        echo "\t\t\t</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Incidencias:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "incidencias"), "html", null, true);
        echo "</pre>
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 62
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "observaciones"), "html", null, true);
        echo "</pre>
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Justificación de anulación/cancelación:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 68
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_study_cit"]) ? $context["object_study_cit"] : $this->getContext($context, "object_study_cit")), "razonAnulada"), "html", null, true);
        echo "</pre>
                        </td>
\t\t    </tr>
                </table>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:cit_entity_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 68,  133 => 62,  124 => 56,  117 => 51,  111 => 49,  109 => 48,  103 => 45,  96 => 41,  89 => 37,  82 => 33,  76 => 29,  70 => 27,  68 => 26,  62 => 23,  55 => 19,  50 => 17,  43 => 13,  36 => 9,  28 => 4,  22 => 3,  19 => 2,);
    }
}
