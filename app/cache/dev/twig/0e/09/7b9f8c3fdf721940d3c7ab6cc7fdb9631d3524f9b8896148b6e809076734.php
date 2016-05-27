<?php

/* SonataCoreBundle:FlashMessage:render.html.twig */
class __TwigTemplate_0e097b9f8c3fdf721940d3c7ab6cc7fdb9631d3524f9b8896148b6e809076734 extends Twig_Template
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
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getExtension('sonata_core_flashmessage')->getFlashMessagesTypes());
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 12
            echo "    ";
            $context["domain"] = ((array_key_exists("domain", $context)) ? ((isset($context["domain"]) ? $context["domain"] : $this->getContext($context, "domain"))) : (null));
            // line 13
            echo "    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->env->getExtension('sonata_core_flashmessage')->getFlashMessages((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), (isset($context["domain"]) ? $context["domain"] : $this->getContext($context, "domain"))));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 14
                echo "        <div class=\"alert alert-";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_core_status')->statusClass((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type"))), "html", null, true);
                echo " alert-dismissable\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
            ";
                // line 16
                echo (isset($context["message"]) ? $context["message"] : $this->getContext($context, "message"));
                echo "
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "SonataCoreBundle:FlashMessage:render.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 14,  23 => 12,  19 => 11,  112 => 44,  103 => 38,  97 => 36,  80 => 23,  56 => 13,  41 => 7,  20 => 1,  270 => 4,  268 => 3,  264 => 2,  253 => 1,  243 => 83,  221 => 79,  212 => 74,  210 => 73,  208 => 72,  206 => 71,  202 => 68,  198 => 66,  196 => 65,  192 => 64,  189 => 61,  187 => 60,  185 => 59,  182 => 57,  180 => 56,  172 => 51,  169 => 49,  167 => 48,  163 => 45,  160 => 44,  156 => 41,  154 => 40,  137 => 37,  120 => 36,  117 => 34,  111 => 30,  100 => 37,  95 => 22,  93 => 21,  90 => 20,  86 => 17,  84 => 16,  81 => 15,  65 => 16,  60 => 81,  57 => 80,  52 => 78,  50 => 44,  47 => 43,  45 => 28,  37 => 16,  35 => 5,  32 => 14,  30 => 3,  27 => 2,  251 => 110,  241 => 107,  235 => 105,  233 => 81,  228 => 103,  226 => 102,  224 => 101,  222 => 100,  220 => 99,  218 => 98,  215 => 97,  207 => 93,  201 => 91,  199 => 90,  194 => 89,  191 => 88,  183 => 84,  177 => 54,  175 => 53,  168 => 80,  165 => 47,  159 => 75,  155 => 73,  153 => 72,  150 => 71,  143 => 66,  141 => 65,  136 => 62,  132 => 59,  128 => 57,  124 => 55,  122 => 54,  118 => 53,  115 => 33,  113 => 31,  110 => 48,  108 => 28,  105 => 45,  102 => 43,  99 => 41,  96 => 39,  94 => 38,  92 => 37,  89 => 35,  87 => 34,  85 => 27,  82 => 26,  79 => 29,  77 => 28,  74 => 20,  72 => 10,  69 => 18,  66 => 21,  64 => 20,  62 => 15,  59 => 14,  55 => 79,  53 => 12,  51 => 11,  48 => 10,  46 => 9,  44 => 8,  42 => 27,  40 => 20,  38 => 6,  36 => 4,  33 => 4,  29 => 14,  26 => 13,);
    }
}
