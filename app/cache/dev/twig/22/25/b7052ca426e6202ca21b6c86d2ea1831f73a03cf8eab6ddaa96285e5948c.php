<?php

/* SonataAdminBundle:CRUD:show_array.html.twig */
class __TwigTemplate_2225b7052ca426e6202ca21b6c86d2ea1831f73a03cf8eab6ddaa96285e5948c extends Twig_Template
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
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 16
            echo "        ";
            if ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "safe")) {
                // line 17
                echo "            [";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "html", null, true);
                echo " => ";
                echo (isset($context["val"]) ? $context["val"] : $this->getContext($context, "val"));
                echo "]
        ";
            } else {
                // line 19
                echo "            [";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "html", null, true);
                echo " => ";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : $this->getContext($context, "val")), "html", null, true);
                echo "]
        ";
            }
            // line 21
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:show_array.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  585 => 224,  551 => 208,  546 => 206,  506 => 194,  503 => 193,  488 => 168,  485 => 167,  478 => 165,  475 => 164,  471 => 157,  448 => 123,  386 => 127,  378 => 91,  375 => 90,  306 => 133,  291 => 87,  286 => 85,  392 => 107,  332 => 145,  318 => 83,  276 => 67,  190 => 54,  12 => 36,  195 => 49,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 275,  890 => 274,  887 => 273,  885 => 272,  875 => 268,  861 => 256,  858 => 255,  853 => 294,  850 => 255,  847 => 254,  842 => 335,  827 => 252,  805 => 239,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 213,  706 => 212,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 202,  665 => 201,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 246,  613 => 232,  610 => 198,  608 => 197,  605 => 196,  602 => 230,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 142,  496 => 140,  441 => 126,  438 => 125,  432 => 123,  428 => 172,  422 => 150,  416 => 123,  395 => 91,  391 => 109,  382 => 106,  372 => 89,  364 => 164,  353 => 96,  335 => 89,  333 => 93,  297 => 84,  292 => 82,  205 => 59,  200 => 73,  184 => 45,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 275,  897 => 274,  891 => 271,  884 => 267,  881 => 270,  879 => 264,  876 => 263,  869 => 265,  867 => 258,  840 => 299,  837 => 253,  835 => 296,  833 => 254,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 232,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 182,  701 => 180,  699 => 179,  696 => 178,  690 => 174,  687 => 173,  681 => 205,  673 => 165,  671 => 164,  668 => 163,  663 => 160,  658 => 158,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 144,  629 => 141,  627 => 140,  624 => 139,  620 => 182,  614 => 133,  599 => 181,  594 => 127,  592 => 126,  589 => 124,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 112,  567 => 110,  554 => 103,  552 => 164,  544 => 158,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 88,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 76,  446 => 128,  443 => 127,  429 => 116,  425 => 64,  410 => 59,  397 => 55,  394 => 54,  389 => 128,  357 => 37,  342 => 149,  334 => 26,  330 => 92,  328 => 22,  290 => 7,  287 => 71,  263 => 58,  255 => 284,  245 => 270,  194 => 40,  76 => 31,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 257,  860 => 280,  856 => 279,  852 => 278,  848 => 277,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 251,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 246,  758 => 226,  756 => 244,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 217,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 213,  617 => 135,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 229,  595 => 205,  586 => 200,  582 => 198,  580 => 197,  572 => 218,  568 => 173,  562 => 214,  556 => 104,  550 => 101,  535 => 186,  526 => 147,  521 => 180,  515 => 178,  497 => 191,  492 => 182,  481 => 166,  476 => 163,  467 => 156,  451 => 155,  424 => 115,  418 => 148,  412 => 60,  399 => 112,  396 => 135,  390 => 133,  388 => 132,  383 => 104,  377 => 102,  373 => 46,  370 => 45,  367 => 102,  352 => 155,  349 => 154,  346 => 93,  329 => 111,  326 => 86,  313 => 137,  303 => 103,  300 => 13,  234 => 64,  218 => 75,  207 => 216,  178 => 184,  321 => 90,  295 => 11,  274 => 79,  242 => 67,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 154,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 226,  583 => 334,  579 => 222,  577 => 221,  575 => 252,  569 => 178,  565 => 109,  548 => 207,  540 => 205,  536 => 95,  529 => 202,  524 => 297,  516 => 143,  510 => 196,  504 => 292,  500 => 192,  490 => 138,  486 => 136,  482 => 285,  470 => 131,  464 => 155,  459 => 125,  452 => 268,  434 => 256,  421 => 114,  417 => 243,  385 => 107,  361 => 100,  344 => 193,  339 => 28,  324 => 142,  310 => 171,  302 => 131,  296 => 89,  282 => 83,  259 => 72,  244 => 140,  231 => 65,  226 => 131,  114 => 44,  104 => 43,  288 => 107,  284 => 70,  279 => 82,  275 => 330,  256 => 74,  250 => 70,  237 => 66,  232 => 249,  222 => 44,  215 => 126,  191 => 196,  153 => 55,  563 => 176,  560 => 187,  558 => 186,  555 => 210,  553 => 168,  549 => 182,  543 => 189,  537 => 204,  532 => 185,  528 => 173,  525 => 201,  523 => 181,  518 => 179,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 175,  491 => 157,  487 => 156,  460 => 143,  455 => 156,  449 => 138,  442 => 153,  439 => 71,  436 => 151,  433 => 117,  426 => 126,  420 => 123,  415 => 144,  411 => 120,  405 => 114,  403 => 117,  400 => 233,  380 => 112,  366 => 169,  354 => 158,  331 => 96,  325 => 94,  320 => 141,  317 => 87,  311 => 85,  308 => 134,  304 => 85,  272 => 134,  267 => 90,  249 => 74,  216 => 100,  155 => 55,  152 => 61,  146 => 33,  126 => 48,  181 => 44,  161 => 162,  110 => 41,  188 => 194,  186 => 190,  170 => 44,  150 => 56,  124 => 177,  358 => 160,  351 => 135,  347 => 134,  343 => 116,  338 => 112,  327 => 143,  323 => 19,  319 => 124,  315 => 82,  301 => 144,  299 => 130,  293 => 88,  289 => 81,  281 => 94,  277 => 136,  271 => 78,  265 => 76,  262 => 76,  260 => 293,  257 => 56,  251 => 101,  248 => 71,  239 => 68,  228 => 81,  225 => 61,  213 => 69,  211 => 61,  197 => 72,  174 => 64,  148 => 64,  134 => 28,  127 => 178,  20 => 11,  53 => 18,  270 => 316,  253 => 71,  233 => 48,  212 => 74,  210 => 75,  206 => 71,  202 => 58,  198 => 66,  192 => 50,  185 => 52,  180 => 50,  175 => 43,  172 => 51,  167 => 43,  165 => 61,  160 => 57,  137 => 29,  113 => 42,  100 => 39,  90 => 36,  81 => 33,  129 => 49,  84 => 34,  77 => 30,  34 => 18,  118 => 49,  97 => 38,  70 => 27,  65 => 26,  58 => 25,  23 => 18,  480 => 134,  474 => 80,  469 => 158,  461 => 157,  457 => 153,  453 => 151,  444 => 122,  440 => 148,  437 => 118,  435 => 124,  430 => 149,  427 => 65,  423 => 63,  413 => 241,  409 => 132,  407 => 238,  402 => 113,  398 => 92,  393 => 230,  387 => 110,  384 => 114,  381 => 48,  379 => 119,  374 => 101,  368 => 99,  365 => 98,  362 => 97,  360 => 38,  355 => 106,  341 => 173,  337 => 90,  322 => 109,  314 => 86,  312 => 149,  309 => 79,  305 => 77,  298 => 12,  294 => 98,  285 => 79,  283 => 138,  278 => 331,  268 => 77,  264 => 89,  258 => 81,  252 => 53,  247 => 273,  241 => 77,  229 => 73,  220 => 128,  214 => 62,  177 => 65,  169 => 33,  140 => 51,  132 => 57,  128 => 47,  107 => 40,  61 => 26,  273 => 317,  269 => 91,  254 => 85,  243 => 89,  240 => 263,  238 => 84,  235 => 250,  230 => 47,  227 => 80,  224 => 45,  221 => 79,  219 => 64,  217 => 63,  208 => 60,  204 => 215,  179 => 107,  159 => 40,  143 => 59,  135 => 50,  119 => 44,  102 => 75,  71 => 28,  67 => 19,  63 => 25,  59 => 30,  38 => 18,  94 => 45,  89 => 34,  85 => 36,  75 => 31,  68 => 27,  56 => 22,  201 => 213,  196 => 56,  183 => 189,  171 => 63,  166 => 32,  163 => 42,  158 => 56,  156 => 39,  151 => 30,  142 => 61,  138 => 183,  136 => 182,  121 => 176,  117 => 174,  105 => 76,  91 => 37,  62 => 25,  49 => 17,  28 => 14,  26 => 14,  87 => 35,  31 => 15,  25 => 12,  21 => 11,  24 => 13,  19 => 11,  93 => 39,  88 => 37,  78 => 32,  46 => 25,  44 => 19,  27 => 14,  79 => 32,  72 => 30,  69 => 28,  47 => 19,  40 => 19,  37 => 20,  22 => 12,  246 => 68,  157 => 56,  145 => 53,  139 => 51,  131 => 48,  123 => 47,  120 => 46,  115 => 173,  111 => 43,  108 => 42,  101 => 37,  98 => 36,  96 => 37,  83 => 32,  74 => 29,  66 => 26,  55 => 21,  52 => 23,  50 => 21,  43 => 21,  41 => 20,  35 => 15,  32 => 16,  29 => 15,  209 => 223,  203 => 93,  199 => 57,  193 => 55,  189 => 47,  187 => 53,  182 => 51,  176 => 48,  173 => 35,  168 => 62,  164 => 163,  162 => 60,  154 => 153,  149 => 148,  147 => 35,  144 => 32,  141 => 184,  133 => 49,  130 => 57,  125 => 46,  122 => 45,  116 => 43,  112 => 172,  109 => 43,  106 => 34,  103 => 38,  99 => 38,  95 => 32,  92 => 35,  86 => 33,  82 => 38,  80 => 31,  73 => 34,  64 => 27,  60 => 24,  57 => 23,  54 => 22,  51 => 16,  48 => 15,  45 => 14,  42 => 18,  39 => 17,  36 => 16,  33 => 15,  30 => 13,);
    }
}
