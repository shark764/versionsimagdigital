<?php

/* MinsalSimagdBundle:show_entity_block:notdiag_entity_block.html.twig */
class __TwigTemplate_063beef56013dbd41bd4ee6c74d7f47d30f31332b6a434f03143511513f8d280 extends Twig_Template
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
        echo "\" id=\"lct_notdiagTab\" >
        <div class=\"box box-";
        // line 4
        echo twig_escape_filter($this->env, ((array_key_exists("box_style", $context)) ? (_twig_default_filter((isset($context["box_style"]) ? $context["box_style"] : $this->getContext($context, "box_style")), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo " non-titled-sonata-box\">
            <div class=\"box-body\">
\t\t";
        // line 6
        if ((!(null === (isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag"))))) {
            // line 7
            echo "\t\t    <table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
\t\t\t<tr>
\t\t\t    <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t\t    <td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "id"), "html", null, true);
            echo "</span></td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t    <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Registrada:</span></th>
\t\t\t    <td colspan=\"3\" class=\"col-md-9\" >";
            // line 14
            echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "fechaEmision"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "fechaEmision"), "H:i:s A")), "html", null, true);
            echo "</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t    <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Emitió:</span></th>
\t\t\t    <td class=\"col-md-3\" >";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "idEmpleado"), "html", null, true);
            echo "</td>
\t\t\t    <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Usuario:</span></th>
\t\t\t    <td class=\"col-md-3\" >";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "idUserReg"), "html", null, true);
            echo "</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t    <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Contenido:</span></th>
\t\t\t    <td colspan=\"3\" class=\"col-md-9\" >
\t\t\t\t<pre class=\"pre-display-code-no-natural\">";
            // line 25
            echo $this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "contenido");
            echo "</pre>
\t\t\t    </td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t    <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Tipo de nota:</span></th>
\t\t\t    <td colspan=\"3\" class=\"col-md-9\" >";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "idTipoNotaDiagnostico"), "html", null, true);
            echo "</td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t    <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
\t\t\t    <td colspan=\"3\" class=\"col-md-9\" >
\t\t\t\t<pre class=\"pre-display-code-natural\">";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "observaciones"), "html", null, true);
            echo "</pre>
\t\t\t    </td>
\t\t\t</tr>
\t\t\t<tr>
\t\t\t    <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Creada en:</span></th>
\t\t\t    <td colspan=\"3\" class=\"col-md-9\" >";
            // line 40
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_notdiag"]) ? $context["object_notdiag"] : $this->getContext($context, "object_notdiag")), "idEstablecimiento"), "html", null, true);
            echo "</td>
\t\t\t</tr>
\t\t    </table>
\t\t";
        }
        // line 44
        echo "\t\t
\t\t";
        // line 45
        if (((!(null === (isset($context["object_notasdiag"]) ? $context["object_notasdiag"] : $this->getContext($context, "object_notasdiag")))) && (twig_length_filter($this->env, (isset($context["object_notasdiag"]) ? $context["object_notasdiag"] : $this->getContext($context, "object_notasdiag"))) > 0))) {
            // line 46
            echo "\t\t    <div class=\"panel-group\" id=\"notdiag_notas_containerGroup\">
\t\t\t";
            // line 47
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["object_notasdiag"]) ? $context["object_notasdiag"] : $this->getContext($context, "object_notasdiag")));
            foreach ($context['_seq'] as $context["_key"] => $context["nota"]) {
                // line 48
                echo "
\t\t\t    <div class=\"panel panel-primary-v2\">
\t\t\t\t<a class=\"list-group-item btn-link btn-link-v2\" data-toggle=\"collapse\" href=\"#notdiag_nota_panelCollapse_id_";
                // line 50
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "id"), "html", null, true);
                echo "\">
\t\t\t\t    <span class=\"badge\">";
                // line 51
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "idTipoNotaDiagnostico"), "html", null, true);
                echo "</span>
\t\t\t\t    ";
                // line 52
                echo twig_escape_filter($this->env, twig_truncate_filter($this->env, trim($this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "idEmpleado")), 35), "html", null, true);
                echo "
\t\t\t\t</a>
\t\t\t\t<div class=\"panel-collapse collapse\" id=\"notdiag_nota_panelCollapse_id_";
                // line 54
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "id"), "html", null, true);
                echo "\">
\t\t\t\t    <div class=\"panel-body\">
\t\t\t\t\t<table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
                // line 59
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "id"), "html", null, true);
                echo "</span></td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Registrada:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
                // line 63
                echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "fechaEmision"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "fechaEmision"), "H:i:s A")), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Emitió:</span></th>
\t\t\t\t\t\t<td class=\"col-md-3\" >";
                // line 67
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "idEmpleado"), "html", null, true);
                echo "</td>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Usuario:</span></th>
\t\t\t\t\t\t<td class=\"col-md-3\" >";
                // line 69
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "idUserReg"), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Contenido:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
\t\t\t\t\t\t    ";
                // line 74
                echo $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "contenido");
                echo "
\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Tipo de nota:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
                // line 79
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "idTipoNotaDiagnostico"), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
\t\t\t\t\t\t    <pre class=\"pre-display-code-natural\">";
                // line 84
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "observaciones"), "html", null, true);
                echo "</pre>
\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Creada en:</span></th>
\t\t\t\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
                // line 89
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["nota"]) ? $context["nota"] : $this->getContext($context, "nota")), "idEstablecimiento"), "html", null, true);
                echo "</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t</table>
\t\t\t\t    </div>
\t\t\t\t</div>
\t\t\t    </div>
\t\t\t    
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nota'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 97
            echo "\t\t    </div>
\t\t";
        }
        // line 99
        echo "            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:notdiag_entity_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  204 => 99,  200 => 97,  186 => 89,  178 => 84,  170 => 79,  162 => 74,  154 => 69,  149 => 67,  142 => 63,  135 => 59,  127 => 54,  122 => 52,  118 => 51,  114 => 50,  110 => 48,  106 => 47,  103 => 46,  101 => 45,  98 => 44,  91 => 40,  83 => 35,  75 => 30,  67 => 25,  59 => 20,  54 => 18,  47 => 14,  40 => 10,  35 => 7,  33 => 6,  28 => 4,  22 => 3,  19 => 2,);
    }
}
