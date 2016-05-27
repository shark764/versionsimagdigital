<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_list.html.twig */
class __TwigTemplate_4c8f54da8b2bf4a59fd036ca3c6f1612325c58eafe9e66a9de41d4901cd2ebb0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_list.html.twig");

        $this->blocks = array(
            'simagd_form_navbar_brand_title' => array($this, 'block_simagd_form_navbar_brand_title'),
            'table_body' => array($this, 'block_table_body'),
            'actions' => array($this, 'block_actions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 6
        echo "    <span class=\"navbar-brand\"><span class=\"label label-primary-v2\"> <i class=\"fa fa-inbox\"></i> Estudios Imagenológicos solicitados </span></span>
";
    }

    // line 9
    public function block_table_body($context, array $blocks = array())
    {
        // line 10
        echo "    <tbody>

        ";
        // line 12
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "datagrid"), "results"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["object"]) {
            // line 13
            echo "\t    <tr data-objectid=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id"), "html", null, true);
            echo "\">
        
                ";
            // line 15
            $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "inner_list_row"), "method"));
            $template->display($context);
            // line 16
            echo "            </tr>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['object'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "    
    </tbody>
";
    }

    // line 22
    public function block_actions($context, array $blocks = array())
    {
        // line 23
        echo "    ";
        ob_start();
        // line 24
        echo "        ";
        // line 25
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  564 => 189,  561 => 188,  456 => 170,  431 => 142,  634 => 356,  628 => 354,  601 => 346,  545 => 304,  350 => 172,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 321,  778 => 315,  772 => 312,  760 => 307,  755 => 304,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 352,  596 => 231,  578 => 270,  534 => 176,  507 => 186,  447 => 236,  445 => 175,  419 => 198,  454 => 160,  371 => 174,  651 => 437,  483 => 180,  404 => 156,  517 => 283,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 150,  622 => 204,  531 => 175,  498 => 182,  468 => 163,  458 => 204,  401 => 144,  369 => 129,  356 => 212,  340 => 148,  874 => 781,  854 => 325,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 318,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 309,  763 => 308,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 303,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 436,  642 => 264,  639 => 263,  637 => 262,  604 => 347,  588 => 239,  573 => 321,  559 => 187,  547 => 205,  520 => 171,  450 => 173,  408 => 213,  363 => 216,  359 => 280,  348 => 134,  345 => 133,  336 => 131,  316 => 154,  307 => 124,  261 => 122,  266 => 205,  542 => 303,  538 => 177,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 272,  473 => 165,  414 => 216,  406 => 194,  280 => 106,  223 => 85,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 261,  485 => 268,  478 => 176,  475 => 164,  471 => 173,  448 => 172,  386 => 127,  378 => 151,  375 => 90,  306 => 146,  291 => 165,  286 => 140,  392 => 181,  332 => 130,  318 => 121,  276 => 160,  190 => 95,  12 => 36,  195 => 86,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 357,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 348,  894 => 383,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 389,  730 => 219,  727 => 218,  712 => 214,  709 => 296,  706 => 295,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 351,  613 => 350,  610 => 349,  608 => 197,  605 => 196,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 190,  533 => 203,  530 => 150,  513 => 168,  496 => 280,  441 => 150,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 161,  395 => 118,  391 => 109,  382 => 195,  372 => 89,  364 => 282,  353 => 175,  335 => 154,  333 => 151,  297 => 169,  292 => 134,  205 => 80,  200 => 78,  184 => 73,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 300,  946 => 296,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 320,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 313,  754 => 208,  748 => 205,  745 => 392,  742 => 391,  737 => 199,  735 => 220,  732 => 197,  728 => 344,  726 => 341,  723 => 340,  719 => 215,  717 => 186,  714 => 185,  704 => 294,  701 => 180,  699 => 179,  696 => 291,  690 => 285,  687 => 173,  681 => 205,  673 => 281,  671 => 280,  668 => 279,  663 => 277,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 357,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 226,  587 => 388,  584 => 320,  576 => 324,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 305,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 352,  502 => 184,  477 => 82,  472 => 132,  465 => 250,  463 => 208,  446 => 244,  443 => 146,  429 => 219,  425 => 202,  410 => 167,  397 => 161,  394 => 54,  389 => 128,  357 => 138,  342 => 132,  334 => 171,  330 => 158,  328 => 146,  290 => 137,  287 => 108,  263 => 103,  255 => 122,  245 => 115,  194 => 77,  76 => 63,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 373,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 296,  888 => 270,  882 => 333,  873 => 267,  868 => 282,  864 => 372,  860 => 327,  856 => 279,  852 => 324,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 347,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 525,  606 => 348,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 329,  580 => 387,  572 => 218,  568 => 227,  562 => 313,  556 => 307,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 169,  497 => 183,  492 => 341,  481 => 218,  476 => 175,  467 => 156,  451 => 159,  424 => 164,  418 => 162,  412 => 147,  399 => 154,  396 => 153,  390 => 305,  388 => 202,  383 => 200,  377 => 178,  373 => 149,  370 => 147,  367 => 172,  352 => 157,  349 => 273,  346 => 155,  329 => 111,  326 => 156,  313 => 136,  303 => 141,  300 => 124,  234 => 109,  218 => 88,  207 => 98,  178 => 69,  321 => 152,  295 => 142,  274 => 104,  242 => 110,  236 => 112,  692 => 175,  683 => 170,  678 => 204,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 150,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 224,  579 => 236,  577 => 318,  575 => 252,  569 => 191,  565 => 314,  548 => 207,  540 => 302,  536 => 358,  529 => 174,  524 => 173,  516 => 143,  510 => 185,  504 => 185,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 171,  452 => 145,  434 => 143,  421 => 219,  417 => 159,  385 => 201,  361 => 165,  344 => 157,  339 => 167,  324 => 123,  310 => 113,  302 => 145,  296 => 111,  282 => 106,  259 => 96,  244 => 116,  231 => 117,  226 => 86,  114 => 86,  104 => 66,  288 => 138,  284 => 162,  279 => 129,  275 => 208,  256 => 205,  250 => 201,  237 => 95,  232 => 115,  222 => 57,  215 => 100,  191 => 73,  153 => 72,  563 => 223,  560 => 222,  558 => 186,  555 => 185,  553 => 211,  549 => 182,  543 => 179,  537 => 301,  532 => 199,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  400 => 116,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 92,  317 => 91,  311 => 87,  308 => 86,  304 => 85,  272 => 81,  267 => 78,  249 => 74,  216 => 70,  155 => 52,  152 => 51,  146 => 49,  126 => 42,  181 => 61,  161 => 54,  110 => 70,  188 => 74,  186 => 64,  170 => 87,  150 => 64,  124 => 41,  358 => 103,  351 => 135,  347 => 206,  343 => 146,  338 => 144,  327 => 154,  323 => 128,  319 => 155,  315 => 143,  301 => 144,  299 => 112,  293 => 139,  289 => 82,  281 => 125,  277 => 105,  271 => 207,  265 => 211,  262 => 97,  260 => 102,  257 => 121,  251 => 143,  248 => 200,  239 => 113,  228 => 85,  225 => 103,  213 => 69,  211 => 80,  197 => 77,  174 => 59,  148 => 61,  134 => 45,  127 => 49,  20 => 2,  53 => 42,  270 => 102,  253 => 195,  233 => 71,  212 => 103,  210 => 81,  206 => 88,  202 => 79,  198 => 85,  192 => 66,  185 => 94,  180 => 93,  175 => 68,  172 => 71,  167 => 57,  165 => 77,  160 => 76,  137 => 46,  113 => 45,  100 => 25,  90 => 41,  81 => 49,  129 => 92,  84 => 28,  77 => 47,  34 => 26,  118 => 84,  97 => 41,  70 => 33,  65 => 32,  58 => 20,  23 => 18,  480 => 179,  474 => 150,  469 => 150,  461 => 157,  457 => 161,  453 => 169,  444 => 230,  440 => 172,  437 => 144,  435 => 167,  430 => 172,  427 => 339,  423 => 210,  413 => 160,  409 => 195,  407 => 157,  402 => 190,  398 => 115,  393 => 112,  387 => 110,  384 => 109,  381 => 179,  379 => 194,  374 => 192,  368 => 190,  365 => 165,  362 => 141,  360 => 104,  355 => 161,  341 => 123,  337 => 97,  322 => 93,  314 => 88,  312 => 119,  309 => 118,  305 => 134,  298 => 140,  294 => 145,  285 => 107,  283 => 134,  278 => 110,  268 => 126,  264 => 98,  258 => 147,  252 => 121,  247 => 98,  241 => 114,  229 => 102,  220 => 90,  214 => 82,  177 => 65,  169 => 74,  140 => 100,  132 => 44,  128 => 58,  107 => 76,  61 => 21,  273 => 106,  269 => 133,  254 => 122,  243 => 92,  240 => 195,  238 => 117,  235 => 116,  230 => 106,  227 => 92,  224 => 103,  221 => 101,  219 => 99,  217 => 83,  208 => 104,  204 => 116,  179 => 82,  159 => 91,  143 => 77,  135 => 97,  119 => 72,  102 => 38,  71 => 16,  67 => 27,  63 => 22,  59 => 26,  38 => 9,  94 => 60,  89 => 70,  85 => 69,  75 => 46,  68 => 15,  56 => 34,  201 => 76,  196 => 68,  183 => 67,  171 => 67,  166 => 73,  163 => 80,  158 => 53,  156 => 62,  151 => 108,  142 => 101,  138 => 57,  136 => 75,  121 => 46,  117 => 86,  105 => 39,  91 => 39,  62 => 13,  49 => 20,  28 => 9,  26 => 13,  87 => 33,  31 => 7,  25 => 5,  21 => 12,  24 => 9,  19 => 2,  93 => 34,  88 => 40,  78 => 40,  46 => 19,  44 => 12,  27 => 10,  79 => 32,  72 => 37,  69 => 51,  47 => 19,  40 => 18,  37 => 11,  22 => 3,  246 => 112,  157 => 67,  145 => 56,  139 => 80,  131 => 59,  123 => 90,  120 => 56,  115 => 44,  111 => 44,  108 => 72,  101 => 31,  98 => 24,  96 => 61,  83 => 58,  74 => 35,  66 => 18,  55 => 22,  52 => 30,  50 => 16,  43 => 18,  41 => 10,  35 => 14,  32 => 9,  29 => 6,  209 => 96,  203 => 87,  199 => 120,  193 => 75,  189 => 65,  187 => 87,  182 => 85,  176 => 82,  173 => 69,  168 => 69,  164 => 72,  162 => 60,  154 => 63,  149 => 78,  147 => 69,  144 => 68,  141 => 58,  133 => 54,  130 => 65,  125 => 51,  122 => 50,  116 => 46,  112 => 52,  109 => 40,  106 => 69,  103 => 39,  99 => 77,  95 => 23,  92 => 22,  86 => 18,  82 => 38,  80 => 41,  73 => 29,  64 => 26,  60 => 33,  57 => 29,  54 => 31,  51 => 27,  48 => 26,  45 => 12,  42 => 27,  39 => 17,  36 => 16,  33 => 6,  30 => 5,);
    }
}
