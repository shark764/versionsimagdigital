<?php

/* SonataDoctrineORMAdminBundle:CRUD:show_orm_many_to_one.html.twig */
class __TwigTemplate_835d2959bfeb392c271d5d9fba4030a4f92de03a08c83d867d57a97c69a4bd36 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig");

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        if ((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))) {
            // line 16
            echo "        ";
            if ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "hasAssociationAdmin") && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "hasRoute", array(0 => "edit"), "method")) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "isGranted", array(0 => "EDIT"), "method"))) {
                // line 17
                echo "            <a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "generateObjectUrl", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "route"), "name"), 1 => (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "route"), "parameters")), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
                echo "</a>
        ";
            } else {
                // line 19
                echo "            ";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
                echo "
        ";
            }
            // line 21
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:show_orm_many_to_one.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  181 => 80,  161 => 71,  110 => 48,  188 => 84,  186 => 83,  170 => 74,  150 => 65,  124 => 31,  358 => 139,  351 => 135,  347 => 134,  343 => 132,  338 => 130,  327 => 126,  323 => 125,  319 => 124,  315 => 123,  301 => 117,  299 => 116,  293 => 113,  289 => 112,  281 => 110,  277 => 109,  271 => 108,  265 => 106,  262 => 105,  260 => 104,  257 => 103,  251 => 101,  248 => 100,  239 => 97,  228 => 88,  225 => 87,  213 => 82,  211 => 81,  197 => 74,  174 => 67,  148 => 64,  134 => 59,  127 => 56,  20 => 11,  53 => 10,  270 => 4,  253 => 1,  233 => 81,  212 => 74,  210 => 73,  206 => 71,  202 => 77,  198 => 66,  192 => 86,  185 => 59,  180 => 56,  175 => 77,  172 => 51,  167 => 48,  165 => 72,  160 => 70,  137 => 59,  113 => 44,  100 => 23,  90 => 20,  81 => 25,  129 => 57,  84 => 39,  77 => 27,  34 => 16,  118 => 43,  97 => 47,  70 => 24,  65 => 30,  58 => 15,  23 => 32,  480 => 162,  474 => 161,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 148,  437 => 147,  435 => 146,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 131,  402 => 130,  398 => 129,  393 => 126,  387 => 122,  384 => 121,  381 => 120,  379 => 119,  374 => 116,  368 => 112,  365 => 141,  362 => 110,  360 => 109,  355 => 106,  341 => 131,  337 => 103,  322 => 101,  314 => 99,  312 => 98,  309 => 120,  305 => 119,  298 => 91,  294 => 90,  285 => 111,  283 => 88,  278 => 86,  268 => 107,  264 => 2,  258 => 81,  252 => 80,  247 => 78,  241 => 77,  229 => 73,  220 => 70,  214 => 69,  177 => 54,  169 => 74,  140 => 55,  132 => 58,  128 => 49,  107 => 52,  61 => 16,  273 => 96,  269 => 94,  254 => 102,  243 => 98,  240 => 86,  238 => 85,  235 => 74,  230 => 82,  227 => 81,  224 => 71,  221 => 79,  219 => 84,  217 => 75,  208 => 72,  204 => 78,  179 => 69,  159 => 70,  143 => 59,  135 => 35,  119 => 28,  102 => 32,  71 => 17,  67 => 18,  63 => 20,  59 => 23,  38 => 15,  94 => 35,  89 => 40,  85 => 25,  75 => 27,  68 => 31,  56 => 23,  201 => 92,  196 => 65,  183 => 82,  171 => 61,  166 => 71,  163 => 45,  158 => 62,  156 => 68,  151 => 63,  142 => 61,  138 => 36,  136 => 56,  121 => 53,  117 => 51,  105 => 47,  91 => 34,  62 => 29,  49 => 9,  28 => 14,  26 => 14,  87 => 25,  31 => 15,  25 => 12,  21 => 11,  24 => 13,  19 => 11,  93 => 21,  88 => 6,  78 => 36,  46 => 7,  44 => 18,  27 => 13,  79 => 37,  72 => 25,  69 => 19,  47 => 43,  40 => 19,  37 => 17,  22 => 12,  246 => 99,  157 => 56,  145 => 46,  139 => 60,  131 => 55,  123 => 54,  120 => 36,  115 => 50,  111 => 30,  108 => 48,  101 => 25,  98 => 44,  96 => 31,  83 => 25,  74 => 34,  66 => 29,  55 => 21,  52 => 21,  50 => 20,  43 => 6,  41 => 18,  35 => 16,  32 => 12,  29 => 15,  209 => 82,  203 => 78,  199 => 67,  193 => 73,  189 => 71,  187 => 60,  182 => 80,  176 => 77,  173 => 65,  168 => 72,  164 => 72,  162 => 71,  154 => 67,  149 => 51,  147 => 58,  144 => 62,  141 => 48,  133 => 55,  130 => 57,  125 => 44,  122 => 43,  116 => 45,  112 => 49,  109 => 53,  106 => 36,  103 => 46,  99 => 26,  95 => 43,  92 => 35,  86 => 17,  82 => 28,  80 => 19,  73 => 19,  64 => 17,  60 => 22,  57 => 22,  54 => 18,  51 => 21,  48 => 13,  45 => 19,  42 => 18,  39 => 17,  36 => 17,  33 => 13,  30 => 15,);
    }
}
