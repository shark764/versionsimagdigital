<?php

/* SonataDoctrineORMAdminBundle:CRUD:show_orm_many_to_many.html.twig */
class __TwigTemplate_f56075a1952e06dec83d99ec3e602812f2f871b6ed9ce4d6b2e784f585c6e897 extends Twig_Template
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
        echo "    <ul class=\"sonata-ba-show-many-to-many\">
    ";
        // line 16
        if ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "hasassociationadmin") && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "hasRoute", array(0 => "edit"), "method")) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "isGranted", array(0 => "EDIT"), "method"))) {
            // line 17
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 18
                echo "            <li>
                <a href=\"";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "generateObjectUrl", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "route"), "name"), 1 => (isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "route"), "parameters")), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
                echo "</a>
            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "    ";
        } else {
            // line 23
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 24
                echo "            <li>
                ";
                // line 25
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
                echo "
            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 28
            echo "    ";
        }
        // line 29
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:show_orm_many_to_many.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  288 => 107,  284 => 106,  279 => 104,  275 => 103,  256 => 96,  250 => 93,  237 => 86,  232 => 84,  222 => 81,  215 => 78,  191 => 69,  153 => 56,  563 => 188,  560 => 187,  558 => 186,  555 => 185,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  400 => 116,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 122,  317 => 121,  311 => 118,  308 => 86,  304 => 85,  272 => 81,  267 => 78,  249 => 74,  216 => 70,  155 => 52,  152 => 51,  146 => 49,  126 => 42,  181 => 61,  161 => 54,  110 => 40,  188 => 84,  186 => 64,  170 => 74,  150 => 55,  124 => 31,  358 => 103,  351 => 135,  347 => 134,  343 => 132,  338 => 130,  327 => 126,  323 => 125,  319 => 124,  315 => 120,  301 => 117,  299 => 112,  293 => 109,  289 => 82,  281 => 105,  277 => 109,  271 => 108,  265 => 99,  262 => 105,  260 => 98,  257 => 103,  251 => 101,  248 => 100,  239 => 97,  228 => 83,  225 => 87,  213 => 69,  211 => 81,  197 => 70,  174 => 64,  148 => 64,  134 => 45,  127 => 32,  20 => 11,  53 => 10,  270 => 4,  253 => 95,  233 => 71,  212 => 74,  210 => 75,  206 => 71,  202 => 77,  198 => 66,  192 => 66,  185 => 68,  180 => 56,  175 => 77,  172 => 51,  167 => 57,  165 => 59,  160 => 58,  137 => 46,  113 => 41,  100 => 36,  90 => 20,  81 => 25,  129 => 57,  84 => 39,  77 => 58,  34 => 16,  118 => 43,  97 => 47,  70 => 24,  65 => 30,  58 => 23,  23 => 18,  480 => 162,  474 => 150,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 148,  437 => 147,  435 => 146,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 131,  402 => 130,  398 => 115,  393 => 112,  387 => 110,  384 => 109,  381 => 120,  379 => 119,  374 => 116,  368 => 112,  365 => 141,  362 => 110,  360 => 104,  355 => 106,  341 => 131,  337 => 97,  322 => 93,  314 => 88,  312 => 98,  309 => 117,  305 => 115,  298 => 91,  294 => 90,  285 => 111,  283 => 88,  278 => 86,  268 => 107,  264 => 2,  258 => 81,  252 => 80,  247 => 78,  241 => 77,  229 => 73,  220 => 80,  214 => 69,  177 => 54,  169 => 74,  140 => 47,  132 => 44,  128 => 49,  107 => 52,  61 => 25,  273 => 96,  269 => 100,  254 => 102,  243 => 89,  240 => 72,  238 => 85,  235 => 74,  230 => 82,  227 => 81,  224 => 71,  221 => 79,  219 => 84,  217 => 79,  208 => 72,  204 => 73,  179 => 66,  159 => 70,  143 => 59,  135 => 35,  119 => 43,  102 => 37,  71 => 17,  67 => 28,  63 => 24,  59 => 49,  38 => 17,  94 => 69,  89 => 35,  85 => 34,  75 => 28,  68 => 31,  56 => 24,  201 => 72,  196 => 68,  183 => 82,  171 => 63,  166 => 71,  163 => 45,  158 => 53,  156 => 57,  151 => 63,  142 => 61,  138 => 50,  136 => 56,  121 => 53,  117 => 51,  105 => 27,  91 => 34,  62 => 29,  49 => 20,  28 => 14,  26 => 13,  87 => 65,  31 => 15,  25 => 12,  21 => 12,  24 => 13,  19 => 11,  93 => 34,  88 => 6,  78 => 29,  46 => 35,  44 => 19,  27 => 13,  79 => 37,  72 => 25,  69 => 19,  47 => 21,  40 => 18,  37 => 17,  22 => 12,  246 => 99,  157 => 56,  145 => 52,  139 => 60,  131 => 48,  123 => 54,  120 => 36,  115 => 50,  111 => 78,  108 => 39,  101 => 25,  98 => 37,  96 => 31,  83 => 25,  74 => 34,  66 => 25,  55 => 22,  52 => 17,  50 => 22,  43 => 20,  41 => 18,  35 => 16,  32 => 15,  29 => 15,  209 => 82,  203 => 78,  199 => 67,  193 => 73,  189 => 65,  187 => 60,  182 => 80,  176 => 65,  173 => 65,  168 => 60,  164 => 72,  162 => 71,  154 => 67,  149 => 51,  147 => 58,  144 => 62,  141 => 48,  133 => 55,  130 => 57,  125 => 45,  122 => 44,  116 => 45,  112 => 49,  109 => 40,  106 => 36,  103 => 46,  99 => 26,  95 => 43,  92 => 35,  86 => 17,  82 => 33,  80 => 19,  73 => 29,  64 => 51,  60 => 22,  57 => 20,  54 => 18,  51 => 21,  48 => 40,  45 => 19,  42 => 18,  39 => 17,  36 => 17,  33 => 13,  30 => 14,);
    }
}
