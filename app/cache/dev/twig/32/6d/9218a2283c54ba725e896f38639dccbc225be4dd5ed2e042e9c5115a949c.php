<?php

/* MinsalSimagdBundle:show_entity_block:std_bloque_informacion.html.twig */
class __TwigTemplate_326d9218a2283c54ba725e896f38639dccbc225be4dd5ed2e042e9c5115a949c extends Twig_Template
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
    <table class=\"table table-condensed\">
        ";
        // line 4
        if ((!(null === (isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo"))))) {
            // line 5
            echo "            <tr>
                <th class=\"col-md-2\">Nombre:</th>
                <td class=\"col-md-4\">
                    ";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "nombre"), "html", null, true);
            echo "
                </td>
                <th class=\"col-md-2\">Dirección:</th>
                <td class=\"col-md-4\">
                    ";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "direccion"), "html", null, true);
            echo "
                </td>
            </tr>
            <tr>
                <th class=\"col-md-2\">Teléfono:</th>
                <td class=\"col-md-4\">
                    ";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "telefono"), "html", null, true);
            echo "
                </td>
                <th class=\"col-md-2\">Nivel de atención:</th>
                <td class=\"col-md-4\">
                    ";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "idNivelMinsal"), "html", null, true);
            echo "
                </td>
            </tr>
            <tr>
                <th class=\"col-md-2\">Código ( UCSF ):</th>
                <td class=\"col-md-4\">
                    ";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "codUcsf"), "html", null, true);
            echo "
                </td>
                <th class=\"col-md-2\">Activo:</th>
                <td class=\"col-md-4\">
                    ";
            // line 32
            echo (($this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "activo")) ? ("Si") : ("No"));
            echo "
                </td>
            </tr>
            <tr>
                <th class=\"col-md-2\">Tipo de expediente:</th>
                <td class=\"col-md-4\">
                    ";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "tipoExpediente"), "html", null, true);
            echo "
                </td>
                <th class=\"col-md-2\">Configurado:</th>
                <td class=\"col-md-4\">
                    ";
            // line 42
            echo (($this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "configurado")) ? ("Si") : ("No"));
            echo "
                </td>
            </tr>
            <tr>
                <th class=\"col-md-2\">Tipo de establecimiento:</th>
                <td class=\"col-md-4\">
                    ";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "idTipoEstablecimiento"), "html", null, true);
            echo "
                </td>
                <th class=\"col-md-2\">Municipio:</th>
                <td class=\"col-md-4\">
                    ";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "idMunicipio"), "html", null, true);
            echo "
                </td>
            </tr>
            <tr>
                <th class=\"col-md-2\">Establecimiento padre:</th>
                <td class=\"col-md-4\">
                    ";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo")), "idEstablecimientoPadre"), "html", null, true);
            echo "
                </td>
            </tr>

        ";
        } else {
            // line 63
            echo "            <tr>
                <td class=\"col-md-12\">
                    <div class=\"alert alert-info alert-dismissible\" role=\"alert\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                            <span aria-hidden=\"true\">&times;</span>
                            <span class=\"sr-only\"> Cerrar </span>
                        </button>
                        <strong>Sin resultados!</strong> No se encontró registro.
                    </div>
                </td>
            </tr>
        ";
        }
        // line 75
        echo "    </table>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:std_bloque_informacion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 75,  118 => 63,  78 => 38,  69 => 32,  62 => 28,  46 => 18,  25 => 5,  23 => 4,  51 => 20,  45 => 17,  37 => 12,  31 => 8,  28 => 7,  26 => 6,  22 => 4,  19 => 2,  83 => 32,  73 => 28,  70 => 27,  64 => 23,  59 => 18,  56 => 17,  47 => 18,  163 => 63,  160 => 62,  156 => 60,  154 => 57,  150 => 55,  147 => 54,  144 => 53,  136 => 51,  134 => 50,  131 => 49,  124 => 47,  119 => 46,  117 => 45,  114 => 44,  110 => 58,  107 => 38,  101 => 52,  97 => 33,  94 => 48,  91 => 31,  85 => 42,  79 => 27,  76 => 29,  74 => 25,  71 => 24,  68 => 23,  61 => 22,  53 => 22,  50 => 14,  44 => 11,  39 => 8,  33 => 9,  30 => 8,);
    }
}
