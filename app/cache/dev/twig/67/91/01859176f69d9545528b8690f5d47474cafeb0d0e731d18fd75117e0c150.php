<?php

/* MinsalSiapsBundle:Core:dashboard.html.twig */
class __TwigTemplate_679101859176f69d9545528b8690f5d47474cafeb0d0e731d18fd75117e0c150 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_content($context, array $blocks = array())
    {
        // line 14
        echo "    <!--div id=\"fondo_siaps\"></div-->
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:Core:dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 14,  26 => 13,);
    }
}
