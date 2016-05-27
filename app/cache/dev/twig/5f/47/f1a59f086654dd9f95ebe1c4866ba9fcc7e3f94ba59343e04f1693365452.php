<?php

/* SonataAdminBundle:Button:show_button.html.twig */
class __TwigTemplate_5f47f1a59f086654dd9f95ebe1c4866ba9fcc7e3f94ba59343e04f1693365452 extends Twig_Template
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
        // line 11
        echo "
";
        // line 12
        if (((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "show"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "VIEW", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")) && (twig_length_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "show")) > 0))) {
            // line 13
            echo "    <a class=\"sonata-action-element\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "show", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
            echo "\">
        <i class=\"fa fa-eye\"></i>
        ";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_show", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a>
";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Button:show_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 13,  132 => 75,  118 => 63,  78 => 38,  69 => 32,  62 => 28,  46 => 18,  25 => 5,  23 => 4,  51 => 20,  45 => 17,  37 => 12,  31 => 8,  28 => 7,  26 => 6,  22 => 12,  19 => 11,  83 => 32,  73 => 28,  70 => 27,  64 => 23,  59 => 18,  56 => 17,  47 => 18,  163 => 63,  160 => 62,  156 => 60,  154 => 57,  150 => 55,  147 => 54,  144 => 53,  136 => 51,  134 => 50,  131 => 49,  124 => 47,  119 => 46,  117 => 45,  114 => 44,  110 => 58,  107 => 38,  101 => 52,  97 => 33,  94 => 48,  91 => 31,  85 => 42,  79 => 27,  76 => 29,  74 => 25,  71 => 24,  68 => 23,  61 => 22,  53 => 22,  50 => 14,  44 => 11,  39 => 8,  33 => 9,  30 => 15,);
    }
}
