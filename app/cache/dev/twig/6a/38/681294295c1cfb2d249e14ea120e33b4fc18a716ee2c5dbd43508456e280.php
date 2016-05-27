<?php

/* ::base.html.twig */
class __TwigTemplate_6a38681294295c1cfb2d249e14ea120e33b4fc18a716ee2c5dbd43508456e280 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1073 => 656,  1069 => 654,  1044 => 645,  1035 => 639,  1026 => 633,  1021 => 631,  1013 => 627,  984 => 615,  970 => 607,  937 => 593,  911 => 581,  780 => 513,  724 => 484,  664 => 463,  462 => 202,  803 => 487,  788 => 518,  771 => 481,  702 => 479,  489 => 276,  907 => 387,  846 => 364,  818 => 355,  810 => 529,  807 => 528,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 472,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 623,  997 => 622,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 519,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 270,  557 => 295,  964 => 421,  956 => 420,  941 => 595,  938 => 415,  934 => 556,  926 => 589,  920 => 409,  915 => 406,  872 => 393,  870 => 560,  862 => 557,  844 => 546,  834 => 382,  802 => 348,  796 => 521,  768 => 439,  747 => 340,  708 => 403,  698 => 477,  677 => 293,  630 => 452,  787 => 404,  784 => 482,  776 => 401,  494 => 278,  564 => 361,  561 => 235,  456 => 238,  431 => 189,  634 => 348,  628 => 444,  601 => 319,  545 => 407,  350 => 120,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 608,  962 => 576,  955 => 600,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 588,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 572,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 482,  689 => 289,  685 => 287,  682 => 470,  618 => 448,  596 => 297,  578 => 432,  534 => 418,  507 => 186,  447 => 194,  445 => 193,  419 => 218,  454 => 237,  371 => 156,  651 => 437,  483 => 245,  404 => 186,  517 => 285,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 579,  880 => 566,  376 => 105,  622 => 442,  531 => 224,  498 => 231,  468 => 236,  458 => 267,  401 => 172,  369 => 185,  356 => 122,  340 => 145,  874 => 562,  854 => 552,  851 => 367,  836 => 543,  831 => 483,  828 => 538,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 485,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 491,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 449,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 427,  547 => 278,  520 => 286,  450 => 186,  408 => 176,  363 => 153,  359 => 123,  348 => 140,  345 => 147,  336 => 138,  316 => 132,  307 => 128,  261 => 132,  266 => 117,  542 => 421,  538 => 228,  527 => 416,  509 => 353,  499 => 248,  493 => 155,  479 => 205,  473 => 271,  414 => 180,  406 => 237,  280 => 194,  223 => 139,  585 => 224,  551 => 424,  546 => 423,  506 => 237,  503 => 252,  488 => 242,  485 => 268,  478 => 218,  475 => 243,  471 => 204,  448 => 192,  386 => 159,  378 => 157,  375 => 177,  306 => 129,  291 => 127,  286 => 112,  392 => 110,  332 => 171,  318 => 145,  276 => 111,  190 => 80,  12 => 36,  195 => 87,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 632,  1018 => 630,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 621,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 597,  944 => 417,  940 => 293,  935 => 592,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 580,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 504,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 471,  703 => 299,  697 => 377,  694 => 467,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 451,  632 => 186,  626 => 443,  623 => 344,  616 => 440,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 445,  593 => 230,  591 => 436,  571 => 238,  566 => 237,  533 => 226,  530 => 417,  513 => 400,  496 => 208,  441 => 196,  438 => 189,  432 => 204,  428 => 211,  422 => 184,  416 => 166,  395 => 135,  391 => 182,  382 => 131,  372 => 145,  364 => 102,  353 => 149,  335 => 134,  333 => 115,  297 => 200,  292 => 146,  205 => 101,  200 => 72,  184 => 63,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 651,  1060 => 652,  1051 => 647,  1048 => 646,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 606,  963 => 604,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 590,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 571,  884 => 568,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 539,  824 => 537,  822 => 378,  815 => 531,  812 => 530,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 509,  754 => 499,  748 => 391,  745 => 493,  742 => 492,  737 => 490,  735 => 387,  732 => 487,  728 => 414,  726 => 341,  723 => 472,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 476,  690 => 466,  687 => 173,  681 => 288,  673 => 461,  671 => 465,  668 => 464,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 448,  636 => 446,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 434,  584 => 246,  576 => 324,  574 => 431,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 213,  519 => 194,  505 => 281,  502 => 280,  477 => 273,  472 => 242,  465 => 201,  463 => 269,  446 => 197,  443 => 234,  429 => 188,  425 => 243,  410 => 190,  397 => 112,  394 => 168,  389 => 160,  357 => 188,  342 => 137,  334 => 141,  330 => 87,  328 => 139,  290 => 119,  287 => 119,  263 => 116,  255 => 101,  245 => 122,  194 => 68,  76 => 17,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 657,  1061 => 370,  1055 => 648,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 624,  980 => 323,  975 => 609,  969 => 423,  959 => 602,  942 => 295,  936 => 306,  919 => 587,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 573,  888 => 570,  882 => 396,  873 => 373,  868 => 371,  864 => 558,  860 => 370,  856 => 279,  852 => 324,  848 => 548,  843 => 257,  838 => 544,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 488,  800 => 523,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 507,  767 => 397,  764 => 505,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 480,  688 => 292,  675 => 462,  672 => 203,  662 => 365,  660 => 217,  655 => 457,  638 => 433,  621 => 449,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 439,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 249,  481 => 208,  476 => 239,  467 => 240,  451 => 236,  424 => 198,  418 => 183,  412 => 240,  399 => 113,  396 => 167,  390 => 218,  388 => 134,  383 => 147,  377 => 129,  373 => 156,  370 => 164,  367 => 155,  352 => 160,  349 => 258,  346 => 94,  329 => 131,  326 => 138,  313 => 110,  303 => 122,  300 => 121,  234 => 90,  218 => 105,  207 => 76,  178 => 59,  321 => 135,  295 => 122,  274 => 110,  242 => 121,  236 => 119,  692 => 474,  683 => 289,  678 => 468,  676 => 467,  666 => 278,  661 => 279,  656 => 460,  652 => 273,  645 => 458,  641 => 267,  635 => 268,  631 => 347,  625 => 450,  615 => 354,  607 => 404,  597 => 442,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 430,  548 => 207,  540 => 293,  536 => 419,  529 => 290,  524 => 173,  516 => 143,  510 => 283,  504 => 210,  500 => 251,  490 => 248,  486 => 246,  482 => 251,  470 => 241,  464 => 180,  459 => 239,  452 => 209,  434 => 201,  421 => 184,  417 => 143,  385 => 190,  361 => 152,  344 => 178,  339 => 248,  324 => 112,  310 => 156,  302 => 125,  296 => 121,  282 => 180,  259 => 103,  244 => 159,  231 => 143,  226 => 84,  114 => 36,  104 => 31,  288 => 118,  284 => 142,  279 => 140,  275 => 105,  256 => 96,  250 => 107,  237 => 91,  232 => 88,  222 => 83,  215 => 77,  191 => 67,  153 => 56,  563 => 429,  560 => 296,  558 => 234,  555 => 294,  553 => 425,  549 => 355,  543 => 179,  537 => 292,  532 => 270,  528 => 406,  525 => 405,  523 => 404,  518 => 402,  514 => 415,  511 => 242,  508 => 282,  501 => 313,  495 => 260,  491 => 255,  487 => 224,  460 => 243,  455 => 241,  449 => 198,  442 => 249,  439 => 195,  436 => 202,  433 => 246,  426 => 238,  420 => 194,  415 => 180,  411 => 140,  405 => 137,  403 => 117,  400 => 185,  380 => 158,  366 => 184,  354 => 329,  331 => 140,  325 => 129,  320 => 127,  317 => 159,  311 => 127,  308 => 109,  304 => 153,  272 => 124,  267 => 101,  249 => 92,  216 => 79,  155 => 47,  152 => 46,  146 => 109,  126 => 43,  181 => 65,  161 => 58,  110 => 38,  188 => 76,  186 => 72,  170 => 56,  150 => 55,  124 => 44,  358 => 151,  351 => 141,  347 => 119,  343 => 146,  338 => 116,  327 => 126,  323 => 128,  319 => 133,  315 => 131,  301 => 182,  299 => 127,  293 => 120,  289 => 196,  281 => 114,  277 => 119,  271 => 190,  265 => 105,  262 => 93,  260 => 111,  257 => 148,  251 => 182,  248 => 97,  239 => 94,  228 => 115,  225 => 114,  213 => 78,  211 => 89,  197 => 69,  174 => 74,  148 => 52,  134 => 39,  127 => 35,  20 => 1,  53 => 5,  270 => 102,  253 => 100,  233 => 87,  212 => 76,  210 => 77,  206 => 92,  202 => 94,  198 => 71,  192 => 86,  185 => 66,  180 => 70,  175 => 58,  172 => 57,  167 => 71,  165 => 60,  160 => 60,  137 => 56,  113 => 38,  100 => 36,  90 => 27,  81 => 24,  129 => 94,  84 => 25,  77 => 20,  34 => 5,  118 => 49,  97 => 72,  70 => 19,  65 => 17,  58 => 15,  23 => 1,  480 => 301,  474 => 204,  469 => 203,  461 => 268,  457 => 199,  453 => 199,  444 => 236,  440 => 233,  437 => 231,  435 => 246,  430 => 245,  427 => 244,  423 => 206,  413 => 119,  409 => 224,  407 => 138,  402 => 204,  398 => 136,  393 => 219,  387 => 164,  384 => 132,  381 => 188,  379 => 106,  374 => 128,  368 => 126,  365 => 125,  362 => 124,  360 => 191,  355 => 150,  341 => 117,  337 => 174,  322 => 233,  314 => 149,  312 => 130,  309 => 129,  305 => 108,  298 => 120,  294 => 152,  285 => 100,  283 => 115,  278 => 106,  268 => 183,  264 => 150,  258 => 187,  252 => 98,  247 => 163,  241 => 93,  229 => 87,  220 => 81,  214 => 92,  177 => 69,  169 => 66,  140 => 52,  132 => 45,  128 => 42,  107 => 37,  61 => 12,  273 => 117,  269 => 107,  254 => 109,  243 => 116,  240 => 121,  238 => 100,  235 => 89,  230 => 102,  227 => 86,  224 => 109,  221 => 80,  219 => 80,  217 => 138,  208 => 76,  204 => 75,  179 => 80,  159 => 57,  143 => 122,  135 => 46,  119 => 40,  102 => 30,  71 => 13,  67 => 18,  63 => 18,  59 => 6,  38 => 5,  94 => 21,  89 => 35,  85 => 26,  75 => 22,  68 => 20,  56 => 14,  201 => 74,  196 => 92,  183 => 71,  171 => 73,  166 => 54,  163 => 53,  158 => 80,  156 => 58,  151 => 53,  142 => 49,  138 => 47,  136 => 71,  121 => 50,  117 => 37,  105 => 25,  91 => 29,  62 => 16,  49 => 12,  28 => 3,  26 => 3,  87 => 26,  31 => 4,  25 => 5,  21 => 2,  24 => 2,  19 => 1,  93 => 28,  88 => 30,  78 => 24,  46 => 10,  44 => 11,  27 => 3,  79 => 18,  72 => 21,  69 => 11,  47 => 12,  40 => 8,  37 => 7,  22 => 2,  246 => 96,  157 => 56,  145 => 74,  139 => 49,  131 => 44,  123 => 42,  120 => 31,  115 => 40,  111 => 47,  108 => 33,  101 => 33,  98 => 29,  96 => 30,  83 => 33,  74 => 22,  66 => 25,  55 => 12,  52 => 12,  50 => 10,  43 => 9,  41 => 7,  35 => 7,  32 => 5,  29 => 5,  209 => 93,  203 => 73,  199 => 93,  193 => 77,  189 => 66,  187 => 76,  182 => 87,  176 => 63,  173 => 85,  168 => 61,  164 => 70,  162 => 59,  154 => 102,  149 => 62,  147 => 43,  144 => 42,  141 => 48,  133 => 45,  130 => 46,  125 => 41,  122 => 95,  116 => 39,  112 => 39,  109 => 27,  106 => 51,  103 => 37,  99 => 23,  95 => 27,  92 => 31,  86 => 66,  82 => 25,  80 => 24,  73 => 16,  64 => 10,  60 => 20,  57 => 39,  54 => 15,  51 => 13,  48 => 10,  45 => 11,  42 => 10,  39 => 6,  36 => 5,  33 => 6,  30 => 3,);
    }
}
