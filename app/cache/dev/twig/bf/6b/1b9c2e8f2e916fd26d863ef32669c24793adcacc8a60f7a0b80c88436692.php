<?php

/* MinsalSimagdBundle:Menu:simagd_cabecera.html.twig */
class __TwigTemplate_bf6b1b9c2e8f2e916fd26d863ef32669c24793adcacc8a60f7a0b80c88436692 extends Twig_Template
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
<div class=\"\">             
    <div class=\"box-simagd box-simagd-header box-simagd-success\">
        <div class=\"box-header\">
            <h4 class=\"box-title\">
                ";
        // line 7
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, (isset($context["simagd_title"]) ? $context["simagd_title"] : $this->getContext($context, "simagd_title"))), "html", null, true);
        echo "
            </h4>
            <hr />
        </div>
        <div class=\"box-body\">
            <div class=\"sonata-ba-collapsed-fields\">
                <em>";
        // line 13
        echo (isset($context["simagd_message"]) ? $context["simagd_message"] : $this->getContext($context, "simagd_message"));
        echo "</em>
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:Menu:simagd_cabecera.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 13,  26 => 7,  19 => 2,  47 => 13,  44 => 12,  36 => 11,  34 => 8,  31 => 7,  28 => 5,);
    }
}
