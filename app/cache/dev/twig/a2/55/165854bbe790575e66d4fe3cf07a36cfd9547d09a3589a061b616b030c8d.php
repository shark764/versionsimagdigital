<?php

/* SonataAdminBundle:CRUD:list__action.html.twig */
class __TwigTemplate_a255165854bbe790575e66d4fe3cf07a36cfd9547d09a3589a061b616b030c8d extends Twig_Template
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
        echo "    <div class=\"btn-group\">
        ";
        // line 16
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "actions"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
            // line 17
            echo "            ";
            $template = $this->env->resolveTemplate($this->getAttribute((isset($context["actions"]) ? $context["actions"] : $this->getContext($context, "actions")), "template"));
            $template->display($context);
            // line 18
            echo "        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list__action.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 19,  49 => 17,  51 => 24,  48 => 23,  95 => 32,  89 => 24,  75 => 36,  64 => 32,  61 => 31,  59 => 30,  53 => 18,  50 => 27,  46 => 25,  40 => 23,  38 => 16,  35 => 15,  32 => 16,  30 => 13,  24 => 12,  21 => 11,  36 => 19,  34 => 18,  31 => 16,  29 => 15,  26 => 14,  45 => 22,  22 => 12,  19 => 11,  613 => 232,  602 => 230,  598 => 229,  590 => 226,  585 => 224,  579 => 222,  577 => 221,  572 => 218,  562 => 214,  555 => 210,  551 => 208,  548 => 207,  546 => 206,  540 => 205,  537 => 204,  533 => 203,  529 => 202,  525 => 201,  519 => 200,  510 => 196,  506 => 194,  503 => 193,  500 => 192,  497 => 191,  492 => 182,  488 => 168,  485 => 167,  481 => 166,  478 => 165,  475 => 164,  471 => 157,  467 => 156,  464 => 155,  459 => 125,  448 => 123,  444 => 122,  437 => 118,  433 => 117,  429 => 116,  424 => 115,  421 => 114,  398 => 92,  395 => 91,  389 => 128,  386 => 127,  384 => 114,  380 => 112,  378 => 91,  375 => 90,  372 => 89,  366 => 169,  364 => 164,  358 => 160,  354 => 158,  352 => 155,  349 => 154,  342 => 149,  332 => 145,  327 => 143,  324 => 142,  320 => 141,  313 => 137,  308 => 134,  306 => 133,  302 => 131,  299 => 130,  296 => 89,  293 => 88,  291 => 87,  286 => 85,  282 => 83,  279 => 82,  274 => 79,  271 => 78,  268 => 77,  265 => 76,  259 => 72,  253 => 71,  250 => 70,  246 => 68,  242 => 67,  237 => 66,  231 => 65,  219 => 64,  217 => 63,  214 => 62,  211 => 61,  208 => 60,  205 => 59,  202 => 58,  199 => 57,  196 => 56,  193 => 55,  190 => 54,  187 => 53,  185 => 52,  182 => 51,  180 => 50,  176 => 48,  170 => 44,  167 => 43,  163 => 42,  159 => 40,  156 => 39,  151 => 30,  141 => 184,  138 => 183,  136 => 182,  133 => 181,  127 => 178,  124 => 177,  121 => 176,  117 => 174,  115 => 173,  112 => 172,  110 => 82,  107 => 81,  105 => 76,  102 => 75,  100 => 39,  97 => 38,  92 => 36,  87 => 35,  84 => 39,  81 => 38,  79 => 32,  76 => 31,  74 => 30,  69 => 33,  65 => 26,  62 => 25,  56 => 29,  47 => 17,  44 => 24,  42 => 21,  39 => 20,);
    }
}
