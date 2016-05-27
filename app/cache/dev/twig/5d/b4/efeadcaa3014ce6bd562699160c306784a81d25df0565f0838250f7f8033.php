<?php

/* SonataUserBundle::layout.html.twig */
class __TwigTemplate_5db4efeadcaa3014ce6bd562699160c306784a81d25df0565f0838250f7f8033 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "   ";
        $this->displayBlock('fos_user_content', $context, $blocks);
    }

    public function block_fos_user_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "SonataUserBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 3,  29 => 2,  140 => 68,  135 => 66,  129 => 63,  123 => 60,  119 => 59,  113 => 56,  109 => 55,  103 => 52,  99 => 51,  91 => 48,  88 => 47,  85 => 46,  48 => 13,  45 => 12,  33 => 4,  30 => 3,);
    }
}
