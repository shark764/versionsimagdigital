<?php

/* MinsalSimagdBundle:ImgLecturaAdmin:lct_funcionesClienteServidor.js.twig */
class __TwigTemplate_61c3b8dc47b355671e04cea9ce3e8487d5bac44bb435c6c6041596d2be145da5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
    <script type=\"text/javascript\">
        jQuery(document).ready(function() {

            /** Bloqueo de empleado */
            if (\$is_admin === false) {
\t\t\$(\"select[id='\" + \$token \"_idEmpleado']\").select2()
\t\t\t.on('select2-selecting', function(e) {
\t\t\t    e.preventDefault();
\t\t\t});
            }

            /** Bloqueo Estado */
            if ( \$(\"input[id='\" + \$token \"_setLockEstado']\").val() ) {
\t\t\$(\"select[id='\" + \$token \"_idEstadoLectura']\").select2()
\t\t\t.on('select2-selecting', function(e) {
\t\t\t    e.preventDefault();
\t\t\t});
            }
            
        });
    </script>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgLecturaAdmin:lct_funcionesClienteServidor.js.twig";
    }

    public function getDebugInfo()
    {
        return array (  611 => 304,  512 => 265,  466 => 245,  557 => 281,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 414,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 392,  862 => 389,  844 => 385,  834 => 382,  802 => 373,  796 => 369,  768 => 352,  747 => 340,  708 => 321,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 403,  776 => 401,  494 => 240,  564 => 361,  561 => 360,  456 => 170,  431 => 232,  634 => 356,  628 => 354,  601 => 319,  545 => 304,  350 => 153,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 405,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 282,  445 => 16,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 235,  517 => 267,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 224,  622 => 204,  531 => 224,  498 => 261,  468 => 293,  458 => 204,  401 => 199,  369 => 165,  356 => 218,  340 => 141,  874 => 781,  854 => 388,  851 => 387,  836 => 361,  831 => 381,  828 => 380,  825 => 357,  820 => 318,  817 => 376,  813 => 349,  799 => 341,  792 => 367,  773 => 327,  766 => 351,  763 => 350,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 327,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 320,  588 => 239,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 173,  408 => 222,  363 => 220,  359 => 164,  348 => 149,  345 => 148,  336 => 163,  316 => 154,  307 => 183,  261 => 111,  266 => 112,  542 => 230,  538 => 177,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 111,  223 => 80,  585 => 224,  551 => 356,  546 => 308,  506 => 103,  503 => 193,  488 => 254,  485 => 268,  478 => 249,  475 => 248,  471 => 173,  448 => 217,  386 => 167,  378 => 164,  375 => 244,  306 => 190,  291 => 142,  286 => 140,  392 => 178,  332 => 139,  318 => 160,  276 => 137,  190 => 70,  12 => 36,  195 => 73,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 400,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 374,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 389,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 381,  706 => 380,  703 => 379,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 275,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 323,  613 => 305,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 296,  571 => 228,  566 => 190,  533 => 203,  530 => 271,  513 => 168,  496 => 280,  441 => 235,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 226,  395 => 222,  391 => 247,  382 => 195,  372 => 184,  364 => 242,  353 => 175,  335 => 154,  333 => 151,  297 => 144,  292 => 121,  205 => 89,  200 => 129,  184 => 70,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 418,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 403,  900 => 385,  897 => 384,  891 => 399,  884 => 397,  881 => 270,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 400,  754 => 208,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 344,  726 => 341,  723 => 326,  719 => 383,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 378,  696 => 291,  690 => 285,  687 => 173,  681 => 372,  673 => 291,  671 => 280,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 312,  633 => 311,  629 => 141,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 520,  592 => 519,  589 => 295,  587 => 388,  584 => 293,  576 => 324,  574 => 242,  570 => 291,  567 => 362,  554 => 311,  552 => 280,  544 => 204,  541 => 274,  539 => 96,  522 => 195,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 222,  463 => 208,  446 => 244,  443 => 280,  429 => 183,  425 => 195,  410 => 167,  397 => 169,  394 => 168,  389 => 177,  357 => 165,  342 => 172,  334 => 139,  330 => 158,  328 => 140,  290 => 116,  287 => 175,  263 => 205,  255 => 122,  245 => 102,  194 => 117,  76 => 23,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 401,  888 => 398,  882 => 396,  873 => 267,  868 => 282,  864 => 390,  860 => 327,  856 => 279,  852 => 324,  848 => 386,  843 => 257,  838 => 383,  832 => 271,  826 => 247,  823 => 268,  819 => 377,  814 => 265,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 395,  758 => 346,  756 => 318,  751 => 392,  739 => 200,  736 => 347,  733 => 386,  725 => 385,  722 => 384,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 307,  617 => 254,  612 => 526,  609 => 322,  606 => 321,  603 => 523,  600 => 522,  598 => 298,  595 => 394,  586 => 294,  582 => 290,  580 => 365,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 279,  535 => 272,  526 => 334,  521 => 171,  515 => 266,  497 => 243,  492 => 308,  481 => 218,  476 => 175,  467 => 221,  451 => 213,  424 => 229,  418 => 192,  412 => 198,  399 => 154,  396 => 232,  390 => 230,  388 => 229,  383 => 200,  377 => 169,  373 => 210,  370 => 154,  367 => 221,  352 => 160,  349 => 162,  346 => 172,  329 => 155,  326 => 156,  313 => 186,  303 => 145,  300 => 208,  234 => 164,  218 => 180,  207 => 76,  178 => 66,  321 => 134,  295 => 178,  274 => 171,  242 => 110,  236 => 112,  692 => 175,  683 => 373,  678 => 371,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 269,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 358,  529 => 174,  524 => 173,  516 => 143,  510 => 185,  504 => 185,  500 => 262,  490 => 201,  486 => 275,  482 => 251,  470 => 225,  464 => 180,  459 => 171,  452 => 240,  434 => 12,  421 => 6,  417 => 250,  385 => 185,  361 => 171,  344 => 157,  339 => 147,  324 => 207,  310 => 158,  302 => 145,  296 => 118,  282 => 173,  259 => 96,  244 => 157,  231 => 162,  226 => 86,  114 => 40,  104 => 39,  288 => 154,  284 => 112,  279 => 129,  275 => 110,  256 => 100,  250 => 179,  237 => 141,  232 => 84,  222 => 82,  215 => 78,  191 => 72,  153 => 63,  563 => 223,  560 => 282,  558 => 236,  555 => 358,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 269,  523 => 331,  518 => 170,  514 => 168,  511 => 321,  508 => 208,  501 => 313,  495 => 260,  491 => 255,  487 => 156,  460 => 243,  455 => 241,  449 => 239,  442 => 210,  439 => 209,  436 => 132,  433 => 233,  426 => 126,  420 => 123,  415 => 121,  411 => 202,  405 => 215,  403 => 117,  400 => 182,  380 => 245,  366 => 175,  354 => 101,  331 => 138,  325 => 94,  320 => 144,  317 => 131,  311 => 185,  308 => 123,  304 => 152,  272 => 81,  267 => 169,  249 => 108,  216 => 70,  155 => 64,  152 => 87,  146 => 59,  126 => 56,  181 => 119,  161 => 67,  110 => 84,  188 => 69,  186 => 119,  170 => 65,  150 => 60,  124 => 48,  358 => 179,  351 => 135,  347 => 174,  343 => 146,  338 => 158,  327 => 191,  323 => 128,  319 => 188,  315 => 126,  301 => 181,  299 => 180,  293 => 117,  289 => 176,  281 => 118,  277 => 105,  271 => 170,  265 => 104,  262 => 134,  260 => 101,  257 => 202,  251 => 98,  248 => 129,  239 => 117,  228 => 138,  225 => 137,  213 => 102,  211 => 77,  197 => 125,  174 => 66,  148 => 82,  134 => 49,  127 => 46,  20 => 2,  53 => 13,  270 => 108,  253 => 201,  233 => 101,  212 => 108,  210 => 127,  206 => 93,  202 => 92,  198 => 72,  192 => 104,  185 => 68,  180 => 64,  175 => 140,  172 => 131,  167 => 70,  165 => 69,  160 => 79,  137 => 55,  113 => 79,  100 => 37,  90 => 36,  81 => 25,  129 => 54,  84 => 59,  77 => 23,  34 => 6,  118 => 54,  97 => 34,  70 => 22,  65 => 19,  58 => 16,  23 => 11,  480 => 301,  474 => 195,  469 => 150,  461 => 290,  457 => 242,  453 => 169,  444 => 236,  440 => 15,  437 => 13,  435 => 276,  430 => 172,  427 => 230,  423 => 206,  413 => 225,  409 => 195,  407 => 250,  402 => 214,  398 => 115,  393 => 112,  387 => 176,  384 => 166,  381 => 165,  379 => 194,  374 => 168,  368 => 190,  365 => 165,  362 => 141,  360 => 219,  355 => 162,  341 => 123,  337 => 97,  322 => 131,  314 => 149,  312 => 125,  309 => 118,  305 => 122,  298 => 156,  294 => 143,  285 => 170,  283 => 153,  278 => 172,  268 => 154,  264 => 201,  258 => 127,  252 => 121,  247 => 134,  241 => 141,  229 => 82,  220 => 114,  214 => 82,  177 => 75,  169 => 129,  140 => 53,  132 => 95,  128 => 49,  107 => 34,  61 => 17,  273 => 109,  269 => 113,  254 => 132,  243 => 93,  240 => 118,  238 => 104,  235 => 117,  230 => 118,  227 => 92,  224 => 115,  221 => 154,  219 => 79,  217 => 134,  208 => 76,  204 => 74,  179 => 76,  159 => 66,  143 => 58,  135 => 56,  119 => 117,  102 => 41,  71 => 21,  67 => 21,  63 => 25,  59 => 23,  38 => 8,  94 => 39,  89 => 31,  85 => 54,  75 => 28,  68 => 19,  56 => 25,  201 => 73,  196 => 128,  183 => 84,  171 => 72,  166 => 64,  163 => 107,  158 => 62,  156 => 84,  151 => 83,  142 => 58,  138 => 57,  136 => 96,  121 => 87,  117 => 86,  105 => 69,  91 => 62,  62 => 18,  49 => 11,  28 => 5,  26 => 6,  87 => 30,  31 => 6,  25 => 5,  21 => 6,  24 => 5,  19 => 2,  93 => 31,  88 => 34,  78 => 22,  46 => 10,  44 => 22,  27 => 6,  79 => 54,  72 => 22,  69 => 51,  47 => 15,  40 => 21,  37 => 6,  22 => 3,  246 => 121,  157 => 67,  145 => 52,  139 => 50,  131 => 55,  123 => 53,  120 => 44,  115 => 75,  111 => 109,  108 => 42,  101 => 36,  98 => 31,  96 => 37,  83 => 52,  74 => 22,  66 => 16,  55 => 15,  52 => 17,  50 => 23,  43 => 13,  41 => 22,  35 => 5,  32 => 6,  29 => 7,  209 => 120,  203 => 75,  199 => 74,  193 => 127,  189 => 126,  187 => 71,  182 => 85,  176 => 63,  173 => 73,  168 => 122,  164 => 121,  162 => 63,  154 => 61,  149 => 61,  147 => 60,  144 => 56,  141 => 57,  133 => 48,  130 => 98,  125 => 53,  122 => 44,  116 => 42,  112 => 45,  109 => 44,  106 => 61,  103 => 101,  99 => 33,  95 => 33,  92 => 32,  86 => 26,  82 => 37,  80 => 24,  73 => 53,  64 => 18,  60 => 17,  57 => 13,  54 => 16,  51 => 14,  48 => 10,  45 => 11,  42 => 10,  39 => 9,  36 => 7,  33 => 6,  30 => 5,);
    }
}
