<?php

/* SonataAdminBundle:CRUD:base_list_inner_row.html.twig */
class __TwigTemplate_e6c9dc052fa248d0bca48fcdde1f113f715fa4c6ed0c0bfe40ce6136ee7fd932 extends Twig_Template
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
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list"), "elements"));
        foreach ($context['_seq'] as $context["_key"] => $context["field_description"]) {
            // line 13
            echo "    ";
            if ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "name") == "_action") && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest"))) {
                // line 14
                echo "        ";
                // line 15
                echo "    ";
            } elseif ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "getOption", array(0 => "ajax_hidden"), "method") == true) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isXmlHttpRequest"))) {
                // line 16
                echo "        ";
                // line 17
                echo "    ";
            } else {
                // line 18
                echo "        ";
                echo $this->env->getExtension('sonata_admin')->renderListElement((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")));
                echo "
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_description'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_list_inner_row.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 17,  34 => 16,  31 => 15,  29 => 14,  26 => 13,  45 => 15,  22 => 12,  19 => 11,  613 => 232,  602 => 230,  598 => 229,  590 => 226,  585 => 224,  579 => 222,  577 => 221,  572 => 218,  562 => 214,  555 => 210,  551 => 208,  548 => 207,  546 => 206,  540 => 205,  537 => 204,  533 => 203,  529 => 202,  525 => 201,  519 => 200,  510 => 196,  506 => 194,  503 => 193,  500 => 192,  497 => 191,  492 => 182,  488 => 168,  485 => 167,  481 => 166,  478 => 165,  475 => 164,  471 => 157,  467 => 156,  464 => 155,  459 => 125,  448 => 123,  444 => 122,  437 => 118,  433 => 117,  429 => 116,  424 => 115,  421 => 114,  398 => 92,  395 => 91,  389 => 128,  386 => 127,  384 => 114,  380 => 112,  378 => 91,  375 => 90,  372 => 89,  366 => 169,  364 => 164,  358 => 160,  354 => 158,  352 => 155,  349 => 154,  342 => 149,  332 => 145,  327 => 143,  324 => 142,  320 => 141,  313 => 137,  308 => 134,  306 => 133,  302 => 131,  299 => 130,  296 => 89,  293 => 88,  291 => 87,  286 => 85,  282 => 83,  279 => 82,  274 => 79,  271 => 78,  268 => 77,  265 => 76,  259 => 72,  253 => 71,  250 => 70,  246 => 68,  242 => 67,  237 => 66,  231 => 65,  219 => 64,  217 => 63,  214 => 62,  211 => 61,  208 => 60,  205 => 59,  202 => 58,  199 => 57,  196 => 56,  193 => 55,  190 => 54,  187 => 53,  185 => 52,  182 => 51,  180 => 50,  176 => 48,  170 => 44,  167 => 43,  163 => 42,  159 => 40,  156 => 39,  151 => 30,  141 => 184,  138 => 183,  136 => 182,  133 => 181,  127 => 178,  124 => 177,  121 => 176,  117 => 174,  115 => 173,  112 => 172,  110 => 82,  107 => 81,  105 => 76,  102 => 75,  100 => 39,  97 => 38,  92 => 36,  87 => 35,  84 => 34,  81 => 33,  79 => 32,  76 => 31,  74 => 30,  69 => 28,  65 => 26,  62 => 25,  56 => 22,  47 => 17,  44 => 16,  42 => 14,  39 => 18,);
    }
}
