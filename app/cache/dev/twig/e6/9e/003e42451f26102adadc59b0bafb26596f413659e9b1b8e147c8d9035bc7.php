<?php

/* SonataAdminBundle:CRUD:list_choice.html.twig */
class __TwigTemplate_e69e003e42451f26102adadc59b0bafb26596f413659e9b1b8e147c8d9035bc7 extends Twig_Template
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
        ob_start();
        // line 16
        echo "    ";
        if ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "choices", array(), "any", true, true)) {
            // line 17
            echo "        ";
            if ((($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "multiple", array(), "any", true, true) && ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "multiple") == true)) && twig_test_iterable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))))) {
                // line 18
                echo "
            ";
                // line 19
                $context["result"] = "";
                // line 20
                echo "            ";
                $context["delimiter"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "delimiter", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "delimiter"), ", ")) : (", "));
                // line 21
                echo "
            ";
                // line 22
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
                foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
                    // line 23
                    echo "                ";
                    if ((!twig_test_empty((isset($context["result"]) ? $context["result"] : $this->getContext($context, "result"))))) {
                        // line 24
                        echo "                    ";
                        $context["result"] = ((isset($context["result"]) ? $context["result"] : $this->getContext($context, "result")) . (isset($context["delimiter"]) ? $context["delimiter"] : $this->getContext($context, "delimiter")));
                        // line 25
                        echo "                ";
                    }
                    // line 26
                    echo "
                ";
                    // line 27
                    if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "choices", array(), "any", false, true), (isset($context["val"]) ? $context["val"] : $this->getContext($context, "val")), array(), "array", true, true)) {
                        // line 28
                        echo "                    ";
                        if ((!$this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "catalogue", array(), "any", true, true))) {
                            // line 29
                            echo "                        ";
                            $context["result"] = ((isset($context["result"]) ? $context["result"] : $this->getContext($context, "result")) . $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "choices"), (isset($context["val"]) ? $context["val"] : $this->getContext($context, "val")), array(), "array"));
                            // line 30
                            echo "                    ";
                        } else {
                            // line 31
                            echo "                        ";
                            $context["result"] = ((isset($context["result"]) ? $context["result"] : $this->getContext($context, "result")) . $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "choices"), (isset($context["val"]) ? $context["val"] : $this->getContext($context, "val")), array(), "array"), array(), $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "catalogue")));
                            // line 32
                            echo "                    ";
                        }
                        // line 33
                        echo "                ";
                    } else {
                        // line 34
                        echo "                    ";
                        $context["result"] = ((isset($context["result"]) ? $context["result"] : $this->getContext($context, "result")) . (isset($context["val"]) ? $context["val"] : $this->getContext($context, "val")));
                        // line 35
                        echo "                ";
                    }
                    // line 36
                    echo "            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 37
                echo "
            ";
                // line 38
                $context["value"] = (isset($context["result"]) ? $context["result"] : $this->getContext($context, "result"));
                // line 39
                echo "
        ";
            } elseif (twig_in_filter((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), twig_get_array_keys_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "choices")))) {
                // line 41
                echo "            ";
                if ((!$this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "catalogue", array(), "any", true, true))) {
                    // line 42
                    echo "                ";
                    $context["value"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "choices"), (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), array(), "array");
                    // line 43
                    echo "            ";
                } else {
                    // line 44
                    echo "                ";
                    $context["value"] = $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "choices"), (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), array(), "array"), array(), $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "catalogue"));
                    // line 45
                    echo "            ";
                }
                // line 46
                echo "        ";
            }
            // line 47
            echo "    ";
        }
        // line 48
        echo "
    ";
        // line 49
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_choice.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  392 => 107,  332 => 88,  318 => 83,  276 => 67,  190 => 38,  12 => 36,  195 => 49,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 275,  890 => 274,  887 => 273,  885 => 272,  875 => 268,  861 => 256,  858 => 255,  853 => 294,  850 => 255,  847 => 254,  842 => 335,  827 => 252,  805 => 239,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 213,  706 => 212,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 202,  665 => 201,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 246,  613 => 243,  610 => 198,  608 => 197,  605 => 196,  602 => 182,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 151,  530 => 150,  513 => 142,  496 => 140,  441 => 126,  438 => 125,  432 => 123,  428 => 172,  422 => 150,  416 => 123,  395 => 111,  391 => 109,  382 => 106,  372 => 103,  364 => 101,  353 => 96,  335 => 89,  333 => 93,  297 => 84,  292 => 82,  205 => 53,  200 => 73,  184 => 45,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 275,  897 => 274,  891 => 271,  884 => 267,  881 => 270,  879 => 264,  876 => 263,  869 => 265,  867 => 258,  840 => 299,  837 => 253,  835 => 296,  833 => 254,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 232,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 182,  701 => 180,  699 => 179,  696 => 178,  690 => 174,  687 => 173,  681 => 205,  673 => 165,  671 => 164,  668 => 163,  663 => 160,  658 => 158,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 144,  629 => 141,  627 => 140,  624 => 139,  620 => 182,  614 => 133,  599 => 181,  594 => 127,  592 => 126,  589 => 124,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 112,  567 => 110,  554 => 103,  552 => 164,  544 => 158,  541 => 157,  539 => 96,  522 => 145,  519 => 91,  505 => 88,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 76,  446 => 128,  443 => 127,  429 => 66,  425 => 64,  410 => 59,  397 => 55,  394 => 54,  389 => 106,  357 => 37,  342 => 91,  334 => 26,  330 => 92,  328 => 22,  290 => 7,  287 => 71,  263 => 58,  255 => 284,  245 => 270,  194 => 40,  76 => 35,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 257,  860 => 280,  856 => 279,  852 => 278,  848 => 277,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 251,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 246,  758 => 226,  756 => 244,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 217,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 213,  617 => 135,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 206,  595 => 205,  586 => 200,  582 => 198,  580 => 197,  572 => 194,  568 => 173,  562 => 108,  556 => 104,  550 => 101,  535 => 186,  526 => 147,  521 => 180,  515 => 178,  497 => 176,  492 => 174,  481 => 166,  476 => 163,  467 => 130,  451 => 155,  424 => 170,  418 => 148,  412 => 60,  399 => 112,  396 => 135,  390 => 133,  388 => 132,  383 => 104,  377 => 102,  373 => 46,  370 => 45,  367 => 102,  352 => 94,  349 => 93,  346 => 93,  329 => 111,  326 => 86,  313 => 106,  303 => 103,  300 => 13,  234 => 64,  218 => 75,  207 => 216,  178 => 184,  321 => 90,  295 => 11,  274 => 92,  242 => 69,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 154,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 338,  583 => 334,  579 => 118,  577 => 337,  575 => 252,  569 => 178,  565 => 109,  548 => 100,  540 => 308,  536 => 95,  529 => 299,  524 => 297,  516 => 143,  510 => 141,  504 => 292,  500 => 291,  490 => 138,  486 => 136,  482 => 285,  470 => 131,  464 => 129,  459 => 273,  452 => 268,  434 => 256,  421 => 62,  417 => 243,  385 => 107,  361 => 100,  344 => 193,  339 => 28,  324 => 85,  310 => 171,  302 => 76,  296 => 167,  282 => 69,  259 => 75,  244 => 140,  231 => 63,  226 => 131,  114 => 44,  104 => 43,  288 => 107,  284 => 70,  279 => 68,  275 => 330,  256 => 74,  250 => 72,  237 => 262,  232 => 249,  222 => 44,  215 => 126,  191 => 196,  153 => 55,  563 => 176,  560 => 187,  558 => 186,  555 => 165,  553 => 168,  549 => 182,  543 => 189,  537 => 187,  532 => 185,  528 => 173,  525 => 172,  523 => 181,  518 => 179,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 175,  491 => 157,  487 => 156,  460 => 143,  455 => 156,  449 => 138,  442 => 153,  439 => 71,  436 => 151,  433 => 150,  426 => 126,  420 => 123,  415 => 144,  411 => 120,  405 => 114,  403 => 117,  400 => 233,  380 => 130,  366 => 106,  354 => 95,  331 => 96,  325 => 94,  320 => 108,  317 => 87,  311 => 85,  308 => 105,  304 => 85,  272 => 134,  267 => 90,  249 => 74,  216 => 100,  155 => 55,  152 => 61,  146 => 33,  126 => 48,  181 => 44,  161 => 162,  110 => 45,  188 => 194,  186 => 190,  170 => 79,  150 => 56,  124 => 47,  358 => 103,  351 => 135,  347 => 134,  343 => 116,  338 => 112,  327 => 91,  323 => 19,  319 => 124,  315 => 82,  301 => 144,  299 => 75,  293 => 73,  289 => 81,  281 => 94,  277 => 136,  271 => 62,  265 => 299,  262 => 76,  260 => 293,  257 => 56,  251 => 101,  248 => 71,  239 => 68,  228 => 81,  225 => 61,  213 => 69,  211 => 41,  197 => 72,  174 => 64,  148 => 64,  134 => 28,  127 => 76,  20 => 11,  53 => 28,  270 => 316,  253 => 95,  233 => 48,  212 => 74,  210 => 75,  206 => 71,  202 => 77,  198 => 66,  192 => 50,  185 => 46,  180 => 66,  175 => 43,  172 => 51,  167 => 36,  165 => 61,  160 => 57,  137 => 29,  113 => 46,  100 => 61,  90 => 36,  81 => 33,  129 => 49,  84 => 34,  77 => 35,  34 => 17,  118 => 49,  97 => 60,  70 => 27,  65 => 29,  58 => 25,  23 => 18,  480 => 134,  474 => 80,  469 => 158,  461 => 157,  457 => 153,  453 => 151,  444 => 154,  440 => 148,  437 => 70,  435 => 124,  430 => 149,  427 => 65,  423 => 63,  413 => 241,  409 => 132,  407 => 238,  402 => 113,  398 => 232,  393 => 230,  387 => 110,  384 => 109,  381 => 48,  379 => 119,  374 => 101,  368 => 99,  365 => 98,  362 => 97,  360 => 38,  355 => 106,  341 => 173,  337 => 90,  322 => 109,  314 => 86,  312 => 149,  309 => 79,  305 => 77,  298 => 12,  294 => 98,  285 => 79,  283 => 138,  278 => 331,  268 => 61,  264 => 89,  258 => 81,  252 => 53,  247 => 273,  241 => 77,  229 => 73,  220 => 128,  214 => 57,  177 => 65,  169 => 33,  140 => 51,  132 => 57,  128 => 30,  107 => 48,  61 => 26,  273 => 317,  269 => 91,  254 => 85,  243 => 89,  240 => 263,  238 => 84,  235 => 250,  230 => 47,  227 => 80,  224 => 45,  221 => 79,  219 => 58,  217 => 76,  208 => 55,  204 => 215,  179 => 107,  159 => 41,  143 => 59,  135 => 50,  119 => 112,  102 => 64,  71 => 31,  67 => 26,  63 => 17,  59 => 30,  38 => 18,  94 => 45,  89 => 24,  85 => 36,  75 => 31,  68 => 30,  56 => 29,  201 => 213,  196 => 51,  183 => 189,  171 => 63,  166 => 32,  163 => 58,  158 => 56,  156 => 157,  151 => 54,  142 => 61,  138 => 33,  136 => 50,  121 => 52,  117 => 45,  105 => 41,  91 => 37,  62 => 28,  49 => 23,  28 => 14,  26 => 14,  87 => 35,  31 => 16,  25 => 12,  21 => 11,  24 => 12,  19 => 11,  93 => 39,  88 => 37,  78 => 32,  46 => 25,  44 => 22,  27 => 14,  79 => 34,  72 => 30,  69 => 29,  47 => 23,  40 => 19,  37 => 18,  22 => 12,  246 => 99,  157 => 56,  145 => 54,  139 => 52,  131 => 31,  123 => 47,  120 => 46,  115 => 47,  111 => 43,  108 => 42,  101 => 39,  98 => 47,  96 => 37,  83 => 27,  74 => 25,  66 => 28,  55 => 24,  52 => 23,  50 => 24,  43 => 21,  41 => 20,  35 => 15,  32 => 15,  29 => 15,  209 => 223,  203 => 93,  199 => 212,  193 => 73,  189 => 47,  187 => 46,  182 => 85,  176 => 178,  173 => 35,  168 => 62,  164 => 163,  162 => 60,  154 => 153,  149 => 148,  147 => 35,  144 => 32,  141 => 143,  133 => 49,  130 => 57,  125 => 51,  122 => 44,  116 => 45,  112 => 109,  109 => 43,  106 => 34,  103 => 43,  99 => 38,  95 => 32,  92 => 43,  86 => 25,  82 => 38,  80 => 25,  73 => 34,  64 => 27,  60 => 16,  57 => 15,  54 => 16,  51 => 14,  48 => 22,  45 => 21,  42 => 20,  39 => 18,  36 => 17,  33 => 16,  30 => 13,);
    }
}
