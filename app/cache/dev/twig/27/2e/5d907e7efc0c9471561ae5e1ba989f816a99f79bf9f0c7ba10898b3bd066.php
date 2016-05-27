<?php

/* SonataAdminBundle:CRUD:base_edit.html.twig */
class __TwigTemplate_272e5d907e7efc0c9471561ae5e1ba989f816a99f79bf9f0c7ba10898b3bd066 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $_trait_0 = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_edit_form.html.twig");
        // line 36
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."SonataAdminBundle:CRUD:base_edit_form.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        if (!isset($_trait_0_blocks["form"])) {
            throw new Twig_Error_Runtime(sprintf('Block "form" is not defined in trait "SonataAdminBundle:CRUD:base_edit_form.html.twig".'));
        }

        $_trait_0_blocks["parentForm"] = $_trait_0_blocks["form"]; unset($_trait_0_blocks["form"]);

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'title' => array($this, 'block_title'),
                'navbar_title' => array($this, 'block_navbar_title'),
                'actions' => array($this, 'block_actions'),
                'tab_menu' => array($this, 'block_tab_menu'),
                'form' => array($this, 'block_form'),
            )
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 37
        $context["form_helper"] = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_edit_form_macro.html.twig");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_title($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
            // line 16
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_edit", array("%name%" => twig_truncate_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "toString", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), 15)), "SonataAdminBundle"), "html", null, true);
            echo "
    ";
        } else {
            // line 18
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_create", array(), "SonataAdminBundle"), "html", null, true);
            echo "
    ";
        }
    }

    // line 22
    public function block_navbar_title($context, array $blocks = array())
    {
        // line 23
        echo "    ";
        $this->displayBlock("title", $context, $blocks);
        echo "
";
    }

    // line 26
    public function block_actions($context, array $blocks = array())
    {
        // line 27
        echo "    <li>";
        $this->env->loadTemplate("SonataAdminBundle:Button:show_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 28
        $this->env->loadTemplate("SonataAdminBundle:Button:history_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 29
        $this->env->loadTemplate("SonataAdminBundle:Button:acl_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 30
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 31
        $this->env->loadTemplate("SonataAdminBundle:Button:create_button.html.twig")->display($context);
        echo "</li>
";
    }

    // line 34
    public function block_tab_menu($context, array $blocks = array())
    {
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
    }

    // line 39
    public function block_form($context, array $blocks = array())
    {
        // line 40
        echo "    ";
        $this->displayBlock("parentForm", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 40,  106 => 34,  96 => 30,  92 => 29,  80 => 26,  73 => 23,  62 => 18,  53 => 15,  45 => 37,  12 => 36,  1002 => 387,  999 => 386,  996 => 385,  994 => 384,  992 => 381,  988 => 379,  985 => 378,  982 => 377,  974 => 375,  972 => 374,  969 => 373,  962 => 371,  957 => 370,  955 => 369,  952 => 368,  948 => 363,  945 => 362,  939 => 359,  935 => 357,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  909 => 348,  906 => 347,  901 => 342,  898 => 341,  893 => 338,  887 => 336,  882 => 333,  863 => 328,  860 => 327,  854 => 325,  852 => 324,  841 => 321,  824 => 320,  820 => 318,  795 => 316,  778 => 315,  774 => 313,  772 => 312,  769 => 311,  766 => 309,  763 => 308,  760 => 307,  755 => 304,  752 => 303,  745 => 392,  742 => 391,  738 => 389,  736 => 347,  731 => 345,  728 => 344,  726 => 341,  723 => 340,  721 => 307,  718 => 306,  715 => 303,  709 => 296,  706 => 295,  704 => 294,  700 => 292,  696 => 291,  689 => 289,  685 => 287,  682 => 285,  676 => 282,  673 => 281,  671 => 280,  668 => 279,  666 => 278,  663 => 277,  661 => 276,  655 => 274,  652 => 273,  646 => 251,  643 => 250,  640 => 249,  635 => 268,  626 => 260,  621 => 256,  618 => 254,  616 => 249,  596 => 231,  593 => 230,  589 => 226,  586 => 225,  583 => 224,  578 => 270,  576 => 230,  571 => 228,  568 => 227,  566 => 224,  563 => 223,  560 => 222,  556 => 212,  553 => 211,  549 => 206,  547 => 205,  544 => 204,  540 => 202,  534 => 200,  532 => 199,  527 => 197,  524 => 196,  522 => 195,  519 => 194,  510 => 185,  507 => 184,  504 => 183,  499 => 188,  497 => 183,  488 => 176,  485 => 175,  481 => 218,  474 => 213,  471 => 211,  465 => 209,  463 => 208,  460 => 207,  458 => 204,  455 => 203,  453 => 194,  447 => 190,  440 => 172,  429 => 219,  426 => 170,  419 => 166,  413 => 164,  408 => 161,  403 => 160,  398 => 157,  393 => 156,  379 => 151,  374 => 148,  370 => 147,  356 => 142,  352 => 141,  337 => 136,  326 => 131,  322 => 129,  317 => 128,  307 => 124,  301 => 121,  295 => 118,  284 => 112,  279 => 111,  274 => 108,  269 => 107,  263 => 104,  258 => 101,  246 => 94,  242 => 93,  227 => 88,  219 => 87,  211 => 86,  200 => 82,  190 => 81,  145 => 58,  139 => 55,  133 => 52,  128 => 49,  123 => 48,  117 => 45,  111 => 42,  105 => 39,  99 => 36,  93 => 33,  87 => 30,  81 => 27,  75 => 24,  70 => 22,  66 => 20,  61 => 19,  56 => 16,  50 => 14,  47 => 11,  42 => 7,  451 => 218,  448 => 217,  445 => 175,  443 => 215,  441 => 212,  437 => 171,  434 => 170,  431 => 208,  423 => 169,  421 => 205,  418 => 204,  411 => 202,  406 => 201,  404 => 200,  401 => 199,  397 => 194,  394 => 193,  388 => 153,  384 => 152,  381 => 187,  378 => 186,  372 => 184,  366 => 146,  363 => 181,  361 => 145,  358 => 179,  355 => 178,  350 => 175,  347 => 140,  342 => 137,  339 => 171,  336 => 170,  331 => 133,  328 => 145,  320 => 144,  318 => 143,  315 => 142,  312 => 125,  304 => 152,  299 => 148,  297 => 141,  293 => 139,  291 => 129,  289 => 115,  287 => 120,  285 => 115,  282 => 114,  271 => 105,  268 => 104,  260 => 102,  253 => 93,  250 => 95,  241 => 88,  238 => 92,  235 => 86,  229 => 82,  225 => 81,  220 => 80,  218 => 79,  215 => 78,  210 => 74,  205 => 71,  201 => 70,  197 => 69,  193 => 68,  189 => 67,  184 => 65,  180 => 80,  176 => 79,  172 => 62,  168 => 61,  164 => 60,  160 => 59,  155 => 62,  152 => 61,  137 => 47,  122 => 41,  112 => 39,  100 => 31,  88 => 28,  83 => 27,  79 => 25,  74 => 24,  68 => 21,  65 => 20,  58 => 17,  52 => 14,  46 => 11,  43 => 10,  38 => 6,  36 => 5,  34 => 4,);
    }
}
