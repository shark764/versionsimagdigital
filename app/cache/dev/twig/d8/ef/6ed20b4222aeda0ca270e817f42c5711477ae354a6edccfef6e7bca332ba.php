<?php

/* SonataDoctrineORMAdminBundle:Block:block_audit.html.twig */
class __TwigTemplate_d8ef6ed20b4222aeda0ca270e817f42c5711477ae354a6edccfef6e7bca332ba extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataBlockBundle:Block:block_base.html.twig");

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataBlockBundle:Block:block_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_block($context, array $blocks = array())
    {
        // line 14
        echo "    <div class=\"sonata-news-block-recent-post panel panel-default\">
        <div class=\"panel-heading\">
            <h3 class=\"sonata-news-block-recent-post panel-title\"><i
                        class=\"fa fa-history\"></i> ";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_audit_log", array(), "SonataAdminBundle"), "html", null, true);
        echo "</h3>
        </div>
        <h3></h3>


        <div class=\"panel-group\" id=\"accordion\">
            ";
        // line 23
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["revisions"]) ? $context["revisions"] : $this->getContext($context, "revisions")));
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
        foreach ($context['_seq'] as $context["_key"] => $context["revision"]) {
            // line 24
            echo "                <div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        <h4 class=\"panel-title\">
                            <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "index"), "html", null, true);
            echo "\">
                                ";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "revision"), "rev"), "html", null, true);
            echo " - ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "revision"), "username"), "html", null, true);
            echo "
                                - ";
            // line 29
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "revision"), "timestamp")), "html", null, true);
            echo "
                            </a>
                        </h4>
                    </div>
                    <div id=\"collapse";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "index"), "html", null, true);
            echo "\" class=\"panel-collapse collapse ";
            echo (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "first")) ? ("in") : (""));
            echo "\">
                        <div class=\"panel-body\">
                            <ul>
                                ";
            // line 36
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "entities"));
            foreach ($context['_seq'] as $context["_key"] => $context["changedEntity"]) {
                // line 37
                echo "                                    <li>
                                        ";
                // line 38
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["changedEntity"]) ? $context["changedEntity"] : $this->getContext($context, "changedEntity")), "entity"), "html", null, true);
                echo " / ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["changedEntity"]) ? $context["changedEntity"] : $this->getContext($context, "changedEntity")), "revisionType"), "html", null, true);
                echo "
                                        / ";
                // line 39
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["changedEntity"]) ? $context["changedEntity"] : $this->getContext($context, "changedEntity")), "className"), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["changedEntity"]) ? $context["changedEntity"] : $this->getContext($context, "changedEntity")), "id"), "html", null, true);
                echo "
                                    </li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['changedEntity'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            echo "                            </ul>
                        </div>
                    </div>
                </div>
            ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['revision'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "        </div>

    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:Block:block_audit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  692 => 399,  683 => 393,  678 => 390,  676 => 385,  666 => 382,  661 => 380,  656 => 378,  652 => 376,  645 => 369,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 338,  583 => 334,  579 => 332,  577 => 329,  575 => 328,  569 => 325,  565 => 324,  548 => 313,  540 => 308,  536 => 306,  529 => 299,  524 => 297,  516 => 294,  510 => 293,  504 => 292,  500 => 291,  490 => 287,  486 => 286,  482 => 285,  470 => 278,  464 => 275,  459 => 273,  452 => 268,  434 => 256,  421 => 244,  417 => 243,  385 => 225,  361 => 207,  344 => 193,  339 => 191,  324 => 179,  310 => 171,  302 => 168,  296 => 167,  282 => 161,  259 => 149,  244 => 140,  231 => 133,  226 => 131,  114 => 71,  104 => 67,  288 => 107,  284 => 106,  279 => 104,  275 => 103,  256 => 96,  250 => 93,  237 => 86,  232 => 84,  222 => 81,  215 => 126,  191 => 69,  153 => 56,  563 => 188,  560 => 187,  558 => 186,  555 => 317,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 289,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  400 => 233,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 122,  317 => 121,  311 => 118,  308 => 86,  304 => 85,  272 => 81,  267 => 78,  249 => 74,  216 => 70,  155 => 52,  152 => 92,  146 => 49,  126 => 42,  181 => 61,  161 => 54,  110 => 40,  188 => 84,  186 => 111,  170 => 74,  150 => 55,  124 => 31,  358 => 103,  351 => 135,  347 => 134,  343 => 132,  338 => 130,  327 => 126,  323 => 125,  319 => 124,  315 => 173,  301 => 117,  299 => 112,  293 => 109,  289 => 163,  281 => 105,  277 => 109,  271 => 108,  265 => 99,  262 => 105,  260 => 98,  257 => 103,  251 => 101,  248 => 100,  239 => 97,  228 => 83,  225 => 87,  213 => 69,  211 => 81,  197 => 119,  174 => 64,  148 => 64,  134 => 47,  127 => 76,  20 => 11,  53 => 10,  270 => 157,  253 => 95,  233 => 71,  212 => 74,  210 => 75,  206 => 71,  202 => 77,  198 => 66,  192 => 66,  185 => 68,  180 => 56,  175 => 77,  172 => 51,  167 => 57,  165 => 59,  160 => 58,  137 => 46,  113 => 41,  100 => 36,  90 => 20,  81 => 25,  129 => 57,  84 => 33,  77 => 29,  34 => 16,  118 => 43,  97 => 63,  70 => 24,  65 => 30,  58 => 23,  23 => 18,  480 => 162,  474 => 150,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 263,  440 => 148,  437 => 147,  435 => 146,  430 => 255,  427 => 143,  423 => 250,  413 => 241,  409 => 132,  407 => 238,  402 => 237,  398 => 232,  393 => 230,  387 => 110,  384 => 109,  381 => 120,  379 => 119,  374 => 217,  368 => 112,  365 => 141,  362 => 110,  360 => 104,  355 => 106,  341 => 131,  337 => 97,  322 => 93,  314 => 88,  312 => 98,  309 => 117,  305 => 115,  298 => 91,  294 => 90,  285 => 111,  283 => 88,  278 => 160,  268 => 107,  264 => 2,  258 => 81,  252 => 80,  247 => 78,  241 => 77,  229 => 73,  220 => 128,  214 => 69,  177 => 54,  169 => 74,  140 => 47,  132 => 44,  128 => 49,  107 => 52,  61 => 25,  273 => 96,  269 => 100,  254 => 147,  243 => 89,  240 => 139,  238 => 85,  235 => 74,  230 => 82,  227 => 81,  224 => 71,  221 => 79,  219 => 84,  217 => 79,  208 => 124,  204 => 73,  179 => 107,  159 => 70,  143 => 59,  135 => 81,  119 => 43,  102 => 37,  71 => 28,  67 => 27,  63 => 24,  59 => 49,  38 => 32,  94 => 69,  89 => 35,  85 => 34,  75 => 28,  68 => 31,  56 => 40,  201 => 72,  196 => 68,  183 => 82,  171 => 102,  166 => 100,  163 => 45,  158 => 53,  156 => 93,  151 => 63,  142 => 61,  138 => 50,  136 => 56,  121 => 75,  117 => 51,  105 => 39,  91 => 34,  62 => 24,  49 => 21,  28 => 13,  26 => 14,  87 => 65,  31 => 14,  25 => 12,  21 => 12,  24 => 13,  19 => 11,  93 => 34,  88 => 60,  78 => 53,  46 => 35,  44 => 19,  27 => 13,  79 => 37,  72 => 25,  69 => 50,  47 => 21,  40 => 18,  37 => 17,  22 => 12,  246 => 99,  157 => 56,  145 => 52,  139 => 60,  131 => 48,  123 => 54,  120 => 36,  115 => 50,  111 => 78,  108 => 39,  101 => 25,  98 => 37,  96 => 37,  83 => 25,  74 => 52,  66 => 25,  55 => 22,  52 => 17,  50 => 22,  43 => 19,  41 => 18,  35 => 17,  32 => 16,  29 => 15,  209 => 82,  203 => 122,  199 => 67,  193 => 73,  189 => 65,  187 => 60,  182 => 80,  176 => 65,  173 => 65,  168 => 60,  164 => 72,  162 => 71,  154 => 67,  149 => 51,  147 => 90,  144 => 62,  141 => 48,  133 => 55,  130 => 57,  125 => 45,  122 => 44,  116 => 42,  112 => 49,  109 => 69,  106 => 36,  103 => 46,  99 => 38,  95 => 43,  92 => 36,  86 => 17,  82 => 33,  80 => 19,  73 => 29,  64 => 51,  60 => 22,  57 => 20,  54 => 18,  51 => 38,  48 => 40,  45 => 23,  42 => 18,  39 => 17,  36 => 17,  33 => 13,  30 => 14,);
    }
}
