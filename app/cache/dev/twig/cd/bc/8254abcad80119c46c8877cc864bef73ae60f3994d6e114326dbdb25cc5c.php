<?php

/* MinsalSimagdBundle:show_entity_block:soldiag_entity_block.html.twig */
class __TwigTemplate_cdbc8254abcad80119c46c8877cc864bef73ae60f3994d6e114326dbdb25cc5c extends Twig_Template
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
        echo "\" id=\"lct_soldiagTab\" >
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
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "id"), "html", null, true);
        echo "</span></td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Registrada:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 13
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "fechaCreacion"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "fechaCreacion"), "H:i:s A")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicitante:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "idEmpleado"), "html", null, true);
        echo "</td>
                    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Justificación:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "justificacion"), "html", null, true);
        echo "</pre>
                        </td>
\t\t    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Próxima consulta médica:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 27
        echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "fechaProximaConsulta"), "EEEE, MMMM d, yyyy", "es_ES");
        echo "</td>
                    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "observaciones"), "html", null, true);
        echo "</pre>
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicitud a externo:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 37
        echo (($this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "solicitudRemota")) ? ("Si") : ("No"));
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicitado a:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_soldiag"]) ? $context["object_soldiag"] : $this->getContext($context, "object_soldiag")), "idEstablecimientoSolicitado"), "html", null, true);
        echo "</td>
\t\t    </tr>
                </table>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:soldiag_entity_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 39,  82 => 37,  74 => 32,  66 => 27,  58 => 22,  50 => 17,  43 => 13,  36 => 9,  28 => 4,  22 => 3,  19 => 2,);
    }
}
