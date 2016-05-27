<?php

/* SonataIntlBundle:CRUD:list_decimal.html.twig */
class __TwigTemplate_ab6e1917e88a79733b6f91aa8281c7113729f94cd182f6bbda88ea9b35e3adb7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        // line 15
        if ((null === (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "&nbsp;";
        } else {
            // line 18
            $context["attributes"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "attributes", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "attributes"), array())) : (array()));
            // line 19
            echo "        ";
            $context["textAttributes"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "textAttributes", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "textAttributes"), array())) : (array()));
            // line 20
            echo "        ";
            $context["locale"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "locale", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "locale"), null)) : (null));
            // line 21
            echo "
        ";
            // line 22
            echo $this->env->getExtension('sonata_intl_number')->formatDecimal((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["attributes"]) ? $context["attributes"] : $this->getContext($context, "attributes")), (isset($context["textAttributes"]) ? $context["textAttributes"] : $this->getContext($context, "textAttributes")), (isset($context["locale"]) ? $context["locale"] : $this->getContext($context, "locale")));
        }
    }

    public function getTemplateName()
    {
        return "SonataIntlBundle:CRUD:list_decimal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 19,  34 => 18,  31 => 16,  29 => 15,  26 => 14,  45 => 22,  22 => 12,  19 => 11,  613 => 232,  602 => 230,  598 => 229,  590 => 226,  585 => 224,  579 => 222,  577 => 221,  572 => 218,  562 => 214,  555 => 210,  551 => 208,  548 => 207,  546 => 206,  540 => 205,  537 => 204,  533 => 203,  529 => 202,  525 => 201,  519 => 200,  510 => 196,  506 => 194,  503 => 193,  500 => 192,  497 => 191,  492 => 182,  488 => 168,  485 => 167,  481 => 166,  478 => 165,  475 => 164,  471 => 157,  467 => 156,  464 => 155,  459 => 125,  448 => 123,  444 => 122,  437 => 118,  433 => 117,  429 => 116,  424 => 115,  421 => 114,  398 => 92,  395 => 91,  389 => 128,  386 => 127,  384 => 114,  380 => 112,  378 => 91,  375 => 90,  372 => 89,  366 => 169,  364 => 164,  358 => 160,  354 => 158,  352 => 155,  349 => 154,  342 => 149,  332 => 145,  327 => 143,  324 => 142,  320 => 141,  313 => 137,  308 => 134,  306 => 133,  302 => 131,  299 => 130,  296 => 89,  293 => 88,  291 => 87,  286 => 85,  282 => 83,  279 => 82,  274 => 79,  271 => 78,  268 => 77,  265 => 76,  259 => 72,  253 => 71,  250 => 70,  246 => 68,  242 => 67,  237 => 66,  231 => 65,  219 => 64,  217 => 63,  214 => 62,  211 => 61,  208 => 60,  205 => 59,  202 => 58,  199 => 57,  196 => 56,  193 => 55,  190 => 54,  187 => 53,  185 => 52,  182 => 51,  180 => 50,  176 => 48,  170 => 44,  167 => 43,  163 => 42,  159 => 40,  156 => 39,  151 => 30,  141 => 184,  138 => 183,  136 => 182,  133 => 181,  127 => 178,  124 => 177,  121 => 176,  117 => 174,  115 => 173,  112 => 172,  110 => 82,  107 => 81,  105 => 76,  102 => 75,  100 => 39,  97 => 38,  92 => 36,  87 => 35,  84 => 34,  81 => 33,  79 => 32,  76 => 31,  74 => 30,  69 => 28,  65 => 26,  62 => 25,  56 => 22,  47 => 17,  44 => 16,  42 => 21,  39 => 20,);
    }
}
