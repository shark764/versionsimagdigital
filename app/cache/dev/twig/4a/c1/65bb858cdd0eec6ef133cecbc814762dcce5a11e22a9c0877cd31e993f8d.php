<?php

/* MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_modal_support.html.twig */
class __TwigTemplate_4ac165bb858cdd0eec6ef133cecbc814762dcce5a11e22a9c0877cd31e993f8d extends Twig_Template
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
    <div class=\"col-xs-9\">";
        // line 4
        echo "        <!-- Tab panes -->
        <div class=\"tab-content\">
            ";
        // line 6
        if ((!(null === (isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo"))))) {
            // line 7
            echo "                <div class=\"tab-pane fade in active\" id=\"establecimientoInfo\" >
                    ";
            // line 8
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:std_bloque_informacion.html.twig")->display($context);
            // line 9
            echo "                </div>
            ";
        }
        // line 11
        echo "        </div>
    </div>

    <div class=\"col-xs-3\"> <!-- required for floating -->
        <!-- Nav tabs -->
        <ul class=\"nav nav-tabs tabs-right\">
            ";
        // line 17
        if ((!(null === (isset($context["establecimientoInfo"]) ? $context["establecimientoInfo"] : $this->getContext($context, "establecimientoInfo"))))) {
            // line 18
            echo "                <li class=\"active\"><a href=\"#establecimientoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-home\"></span> Establecimiento</a></li>
            ";
        }
        // line 20
        echo "        </ul>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_modal_support.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 20,  45 => 17,  37 => 11,  31 => 8,  28 => 7,  26 => 6,  22 => 4,  19 => 2,  83 => 32,  73 => 28,  70 => 27,  64 => 23,  59 => 18,  56 => 17,  47 => 18,  163 => 63,  160 => 62,  156 => 60,  154 => 57,  150 => 55,  147 => 54,  144 => 53,  136 => 51,  134 => 50,  131 => 49,  124 => 47,  119 => 46,  117 => 45,  114 => 44,  110 => 39,  107 => 38,  101 => 35,  97 => 33,  94 => 32,  91 => 31,  85 => 29,  79 => 27,  76 => 29,  74 => 25,  71 => 24,  68 => 23,  61 => 22,  53 => 15,  50 => 14,  44 => 11,  39 => 8,  33 => 9,  30 => 5,);
    }
}
