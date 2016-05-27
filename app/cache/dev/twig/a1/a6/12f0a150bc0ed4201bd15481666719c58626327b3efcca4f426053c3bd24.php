<?php

/* SonataAdminBundle:CRUD:base_acl.html.twig */
class __TwigTemplate_a1a612f0a150bc0ed4201bd15481666719c58626327b3efcca4f426053c3bd24 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'form' => array($this, 'block_form'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        // line 15
        echo "    <li>";
        $this->env->loadTemplate("SonataAdminBundle:Button:edit_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->env->loadTemplate("SonataAdminBundle:Button:history_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 17
        $this->env->loadTemplate("SonataAdminBundle:Button:show_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 18
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
";
    }

    // line 21
    public function block_form($context, array $blocks = array())
    {
        // line 22
        echo "    <form class=\"form-horizontal\"
              action=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "acl", 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo "
              method=\"POST\"
              ";
        // line 25
        if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
            echo "novalidate=\"novalidate\"";
        }
        // line 26
        echo "              >
        ";
        // line 27
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
            // line 28
            echo "            <div class=\"sonata-ba-form-error\">
                ";
            // line 29
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
            </div>
        ";
        }
        // line 32
        echo "
        <table class=\"table\">
            <thead>
                <tr>
                    <th>";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_username", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    ";
        // line 37
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : $this->getContext($context, "permissions")));
        foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
            // line 38
            echo "                    <th>";
            echo twig_escape_filter($this->env, (isset($context["permission"]) ? $context["permission"] : $this->getContext($context, "permission")), "html", null, true);
            echo "</th>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "                </tr>
            </thead>
            <tbody>
            ";
        // line 43
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["users"]) ? $context["users"] : $this->getContext($context, "users")));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 44
            echo "                <tr>
                    <td>";
            // line 45
            echo twig_escape_filter($this->env, (isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "html", null, true);
            echo "</td>
                    ";
            // line 46
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : $this->getContext($context, "permissions")));
            foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
                // line 47
                echo "                    <td>";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), ($this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "id") . (isset($context["permission"]) ? $context["permission"] : $this->getContext($context, "permission"))), array(), "array"), 'widget');
                echo "</td>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "            </tbody>
        </table>

        ";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "

        ";
        // line 56
        $this->displayBlock('formactions', $context, $blocks);
        // line 61
        echo "    </form>
";
    }

    // line 56
    public function block_formactions($context, array $blocks = array())
    {
        // line 57
        echo "            <div class=\"well well-small form-actions\">
                <input class=\"btn btn-primary\" type=\"submit\" name=\"btn_create_and_edit\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_acl", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
            </div>
        ";
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_acl.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  392 => 107,  332 => 88,  318 => 83,  276 => 67,  190 => 38,  12 => 36,  195 => 49,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 275,  890 => 274,  887 => 273,  885 => 272,  875 => 268,  861 => 256,  858 => 255,  853 => 294,  850 => 255,  847 => 254,  842 => 335,  827 => 252,  805 => 239,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 213,  706 => 212,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 202,  665 => 201,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 246,  613 => 243,  610 => 198,  608 => 197,  605 => 196,  602 => 182,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 151,  530 => 150,  513 => 142,  496 => 140,  441 => 126,  438 => 125,  432 => 123,  428 => 172,  422 => 150,  416 => 123,  395 => 111,  391 => 109,  382 => 106,  372 => 103,  364 => 101,  353 => 96,  335 => 89,  333 => 93,  297 => 84,  292 => 82,  205 => 53,  200 => 73,  184 => 45,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 275,  897 => 274,  891 => 271,  884 => 267,  881 => 270,  879 => 264,  876 => 263,  869 => 265,  867 => 258,  840 => 299,  837 => 253,  835 => 296,  833 => 254,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 232,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 182,  701 => 180,  699 => 179,  696 => 178,  690 => 174,  687 => 173,  681 => 205,  673 => 165,  671 => 164,  668 => 163,  663 => 160,  658 => 158,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 144,  629 => 141,  627 => 140,  624 => 139,  620 => 182,  614 => 133,  599 => 181,  594 => 127,  592 => 126,  589 => 124,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 112,  567 => 110,  554 => 103,  552 => 164,  544 => 158,  541 => 157,  539 => 96,  522 => 145,  519 => 91,  505 => 88,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 76,  446 => 128,  443 => 127,  429 => 66,  425 => 64,  410 => 59,  397 => 55,  394 => 54,  389 => 106,  357 => 37,  342 => 91,  334 => 26,  330 => 92,  328 => 22,  290 => 7,  287 => 71,  263 => 58,  255 => 284,  245 => 270,  194 => 40,  76 => 18,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 257,  860 => 280,  856 => 279,  852 => 278,  848 => 277,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 251,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 246,  758 => 226,  756 => 244,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 217,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 213,  617 => 135,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 206,  595 => 205,  586 => 200,  582 => 198,  580 => 197,  572 => 194,  568 => 173,  562 => 108,  556 => 104,  550 => 101,  535 => 186,  526 => 147,  521 => 180,  515 => 178,  497 => 176,  492 => 174,  481 => 166,  476 => 163,  467 => 130,  451 => 155,  424 => 170,  418 => 148,  412 => 60,  399 => 112,  396 => 135,  390 => 133,  388 => 132,  383 => 104,  377 => 102,  373 => 46,  370 => 45,  367 => 102,  352 => 94,  349 => 93,  346 => 93,  329 => 111,  326 => 86,  313 => 106,  303 => 103,  300 => 13,  234 => 64,  218 => 75,  207 => 216,  178 => 184,  321 => 90,  295 => 11,  274 => 92,  242 => 69,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 154,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 338,  583 => 334,  579 => 118,  577 => 337,  575 => 252,  569 => 178,  565 => 109,  548 => 100,  540 => 308,  536 => 95,  529 => 299,  524 => 297,  516 => 143,  510 => 141,  504 => 292,  500 => 291,  490 => 138,  486 => 136,  482 => 285,  470 => 131,  464 => 129,  459 => 273,  452 => 268,  434 => 256,  421 => 62,  417 => 243,  385 => 107,  361 => 100,  344 => 193,  339 => 28,  324 => 85,  310 => 171,  302 => 76,  296 => 167,  282 => 69,  259 => 75,  244 => 140,  231 => 63,  226 => 131,  114 => 91,  104 => 40,  288 => 107,  284 => 70,  279 => 68,  275 => 330,  256 => 74,  250 => 72,  237 => 262,  232 => 249,  222 => 44,  215 => 126,  191 => 196,  153 => 55,  563 => 176,  560 => 187,  558 => 186,  555 => 165,  553 => 168,  549 => 182,  543 => 189,  537 => 187,  532 => 185,  528 => 173,  525 => 172,  523 => 181,  518 => 179,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 175,  491 => 157,  487 => 156,  460 => 143,  455 => 156,  449 => 138,  442 => 153,  439 => 71,  436 => 151,  433 => 150,  426 => 126,  420 => 123,  415 => 144,  411 => 120,  405 => 114,  403 => 117,  400 => 233,  380 => 130,  366 => 106,  354 => 95,  331 => 96,  325 => 94,  320 => 108,  317 => 87,  311 => 85,  308 => 105,  304 => 85,  272 => 134,  267 => 90,  249 => 74,  216 => 100,  155 => 55,  152 => 61,  146 => 33,  126 => 24,  181 => 44,  161 => 162,  110 => 67,  188 => 194,  186 => 190,  170 => 79,  150 => 56,  124 => 47,  358 => 103,  351 => 135,  347 => 134,  343 => 116,  338 => 112,  327 => 91,  323 => 19,  319 => 124,  315 => 82,  301 => 144,  299 => 75,  293 => 73,  289 => 81,  281 => 94,  277 => 136,  271 => 62,  265 => 299,  262 => 76,  260 => 293,  257 => 56,  251 => 101,  248 => 71,  239 => 68,  228 => 81,  225 => 61,  213 => 69,  211 => 41,  197 => 72,  174 => 64,  148 => 64,  134 => 28,  127 => 76,  20 => 11,  53 => 22,  270 => 316,  253 => 95,  233 => 48,  212 => 74,  210 => 75,  206 => 71,  202 => 77,  198 => 66,  192 => 50,  185 => 46,  180 => 66,  175 => 43,  172 => 51,  167 => 36,  165 => 61,  160 => 57,  137 => 29,  113 => 44,  100 => 61,  90 => 24,  81 => 32,  129 => 25,  84 => 38,  77 => 35,  34 => 16,  118 => 44,  97 => 60,  70 => 27,  65 => 26,  58 => 23,  23 => 18,  480 => 134,  474 => 80,  469 => 158,  461 => 157,  457 => 153,  453 => 151,  444 => 154,  440 => 148,  437 => 70,  435 => 124,  430 => 149,  427 => 65,  423 => 63,  413 => 241,  409 => 132,  407 => 238,  402 => 113,  398 => 232,  393 => 230,  387 => 110,  384 => 109,  381 => 48,  379 => 119,  374 => 101,  368 => 99,  365 => 98,  362 => 97,  360 => 38,  355 => 106,  341 => 173,  337 => 90,  322 => 109,  314 => 86,  312 => 149,  309 => 79,  305 => 77,  298 => 12,  294 => 98,  285 => 79,  283 => 138,  278 => 331,  268 => 61,  264 => 89,  258 => 81,  252 => 53,  247 => 273,  241 => 77,  229 => 73,  220 => 128,  214 => 57,  177 => 65,  169 => 33,  140 => 51,  132 => 49,  128 => 30,  107 => 341,  61 => 24,  273 => 317,  269 => 91,  254 => 85,  243 => 89,  240 => 263,  238 => 84,  235 => 250,  230 => 47,  227 => 80,  224 => 45,  221 => 79,  219 => 58,  217 => 76,  208 => 55,  204 => 215,  179 => 107,  159 => 41,  143 => 59,  135 => 50,  119 => 112,  102 => 64,  71 => 33,  67 => 26,  63 => 25,  59 => 13,  38 => 5,  94 => 45,  89 => 39,  85 => 34,  75 => 29,  68 => 31,  56 => 23,  201 => 213,  196 => 51,  183 => 189,  171 => 63,  166 => 32,  163 => 58,  158 => 56,  156 => 157,  151 => 54,  142 => 61,  138 => 33,  136 => 50,  121 => 107,  117 => 51,  105 => 65,  91 => 37,  62 => 14,  49 => 21,  28 => 14,  26 => 14,  87 => 36,  31 => 15,  25 => 12,  21 => 12,  24 => 1,  19 => 11,  93 => 34,  88 => 28,  78 => 19,  46 => 8,  44 => 18,  27 => 14,  79 => 30,  72 => 28,  69 => 16,  47 => 15,  40 => 17,  37 => 17,  22 => 12,  246 => 99,  157 => 56,  145 => 54,  139 => 52,  131 => 31,  123 => 57,  120 => 46,  115 => 40,  111 => 90,  108 => 39,  101 => 41,  98 => 47,  96 => 30,  83 => 27,  74 => 25,  66 => 22,  55 => 12,  52 => 11,  50 => 21,  43 => 7,  41 => 6,  35 => 19,  32 => 16,  29 => 15,  209 => 223,  203 => 93,  199 => 212,  193 => 73,  189 => 47,  187 => 46,  182 => 85,  176 => 178,  173 => 35,  168 => 62,  164 => 163,  162 => 60,  154 => 153,  149 => 148,  147 => 35,  144 => 32,  141 => 143,  133 => 49,  130 => 57,  125 => 51,  122 => 44,  116 => 45,  112 => 109,  109 => 43,  106 => 34,  103 => 43,  99 => 54,  95 => 38,  92 => 27,  86 => 66,  82 => 33,  80 => 26,  73 => 17,  64 => 21,  60 => 19,  57 => 20,  54 => 16,  51 => 25,  48 => 13,  45 => 37,  42 => 17,  39 => 17,  36 => 16,  33 => 17,  30 => 2,);
    }
}
