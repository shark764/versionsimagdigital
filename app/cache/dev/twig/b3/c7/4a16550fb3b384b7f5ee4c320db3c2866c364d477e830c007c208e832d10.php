<?php

/* MinsalSimagdBundle:ImgNotaDiagnosticoAdmin:notdiag_bootstrapValidator.js.twig */
class __TwigTemplate_b3c74a16550fb3b384b7f5ee4c320db3c2866c364d477e830c007c208e832d10 extends Twig_Template
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
            /** Validación de formulario de inserción/actualización */
            jQuery('#simagd_entity_full_admin_form').formValidation({
                excluded: [':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    '";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEmpleado]': {
                        message: 'Médico autor de la nota es inválido',
                        validators: {
                            notEmpty: {
                                message: 'Médico autor de la nota es requerido'
                            }
                        }
                    },";
        // line 35
        echo "                    '";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idTipoNotaDiagnostico]': {
                        message: 'Tipo de la nota agregada es inválido',
                        validators: {
                            notEmpty: {
                                message: 'Tipo de la nota agregada es requerido'
                            },
                        }
                    },
                    '";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[observaciones]': {
                        message: 'Observaciones a la transcripción inválidas',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 255,
                                message: 'Observaciones a la transcripción deben contener al menos 15 caracteres y máximo 255'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                            callback: {
                                message: 'Nota sin diagnóstico seleccionado',
                                callback: function(value, validator) {
                                    /** begin callback function */
                                    var diagnosticoVal = \$(\"input[id='\" + \$token + \"_idDiagnostico']\").val();
                                    var existsVal = false;
                                    
                                    existsVal = diagnosticoVal ? true : false;
                                    
                                    return existsVal;
                                    /** end callback function */
                                }
                            },
                        }
                    },
                }
            });
            
        });
    </script>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgNotaDiagnosticoAdmin:notdiag_bootstrapValidator.js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 245,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 212,  564 => 361,  561 => 235,  456 => 170,  431 => 190,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 145,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 282,  445 => 218,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 235,  517 => 263,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 224,  622 => 204,  531 => 224,  498 => 213,  468 => 236,  458 => 204,  401 => 199,  369 => 165,  356 => 180,  340 => 146,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 173,  408 => 182,  363 => 220,  359 => 164,  348 => 149,  345 => 148,  336 => 163,  316 => 159,  307 => 129,  261 => 110,  266 => 112,  542 => 230,  538 => 228,  527 => 197,  509 => 353,  499 => 248,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 111,  223 => 121,  585 => 224,  551 => 356,  546 => 308,  506 => 103,  503 => 193,  488 => 242,  485 => 268,  478 => 240,  475 => 205,  471 => 204,  448 => 192,  386 => 169,  378 => 158,  375 => 244,  306 => 190,  291 => 121,  286 => 113,  392 => 175,  332 => 139,  318 => 134,  276 => 115,  190 => 113,  12 => 36,  195 => 91,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 168,  496 => 280,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 150,  416 => 184,  395 => 198,  391 => 247,  382 => 195,  372 => 190,  364 => 186,  353 => 175,  335 => 154,  333 => 142,  297 => 144,  292 => 123,  205 => 94,  200 => 97,  184 => 85,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 223,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 201,  463 => 208,  446 => 244,  443 => 200,  429 => 183,  425 => 195,  410 => 180,  397 => 176,  394 => 168,  389 => 177,  357 => 150,  342 => 172,  334 => 139,  330 => 137,  328 => 140,  290 => 116,  287 => 119,  263 => 125,  255 => 108,  245 => 117,  194 => 82,  76 => 54,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 244,  481 => 208,  476 => 239,  467 => 221,  451 => 213,  424 => 229,  418 => 183,  412 => 183,  399 => 177,  396 => 232,  390 => 171,  388 => 174,  383 => 200,  377 => 169,  373 => 156,  370 => 164,  367 => 155,  352 => 160,  349 => 148,  346 => 147,  329 => 155,  326 => 136,  313 => 132,  303 => 145,  300 => 208,  234 => 93,  218 => 89,  207 => 128,  178 => 84,  321 => 134,  295 => 122,  274 => 171,  242 => 95,  236 => 103,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 227,  529 => 174,  524 => 173,  516 => 143,  510 => 218,  504 => 185,  500 => 262,  490 => 211,  486 => 210,  482 => 251,  470 => 237,  464 => 180,  459 => 171,  452 => 240,  434 => 12,  421 => 184,  417 => 250,  385 => 185,  361 => 152,  344 => 157,  339 => 141,  324 => 207,  310 => 158,  302 => 127,  296 => 118,  282 => 112,  259 => 96,  244 => 104,  231 => 93,  226 => 109,  114 => 50,  104 => 47,  288 => 122,  284 => 136,  279 => 143,  275 => 115,  256 => 99,  250 => 107,  237 => 141,  232 => 92,  222 => 90,  215 => 78,  191 => 90,  153 => 79,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 224,  523 => 268,  518 => 221,  514 => 168,  511 => 321,  508 => 208,  501 => 313,  495 => 260,  491 => 255,  487 => 156,  460 => 243,  455 => 241,  449 => 239,  442 => 210,  439 => 209,  436 => 132,  433 => 233,  426 => 126,  420 => 186,  415 => 182,  411 => 202,  405 => 203,  403 => 117,  400 => 182,  380 => 245,  366 => 152,  354 => 101,  331 => 138,  325 => 94,  320 => 144,  317 => 131,  311 => 127,  308 => 123,  304 => 125,  272 => 114,  267 => 169,  249 => 97,  216 => 87,  155 => 57,  152 => 71,  146 => 71,  126 => 56,  181 => 83,  161 => 75,  110 => 48,  188 => 77,  186 => 89,  170 => 79,  150 => 55,  124 => 58,  358 => 179,  351 => 135,  347 => 150,  343 => 146,  338 => 158,  327 => 136,  323 => 128,  319 => 134,  315 => 126,  301 => 181,  299 => 123,  293 => 117,  289 => 176,  281 => 117,  277 => 105,  271 => 114,  265 => 137,  262 => 134,  260 => 101,  257 => 121,  251 => 99,  248 => 118,  239 => 104,  228 => 101,  225 => 100,  213 => 102,  211 => 96,  197 => 91,  174 => 98,  148 => 82,  134 => 59,  127 => 61,  20 => 2,  53 => 22,  270 => 108,  253 => 107,  233 => 76,  212 => 86,  210 => 86,  206 => 97,  202 => 96,  198 => 83,  192 => 90,  185 => 64,  180 => 84,  175 => 70,  172 => 70,  167 => 67,  165 => 77,  160 => 83,  137 => 65,  113 => 50,  100 => 45,  90 => 42,  81 => 55,  129 => 64,  84 => 35,  77 => 35,  34 => 21,  118 => 51,  97 => 43,  70 => 50,  65 => 26,  58 => 20,  23 => 4,  480 => 301,  474 => 195,  469 => 150,  461 => 200,  457 => 199,  453 => 169,  444 => 236,  440 => 15,  437 => 13,  435 => 188,  430 => 172,  427 => 185,  423 => 206,  413 => 181,  409 => 195,  407 => 179,  402 => 179,  398 => 178,  393 => 112,  387 => 176,  384 => 173,  381 => 165,  379 => 163,  374 => 161,  368 => 190,  365 => 154,  362 => 141,  360 => 219,  355 => 155,  341 => 141,  337 => 140,  322 => 135,  314 => 149,  312 => 130,  309 => 126,  305 => 124,  298 => 126,  294 => 143,  285 => 170,  283 => 153,  278 => 116,  268 => 107,  264 => 111,  258 => 109,  252 => 98,  247 => 105,  241 => 96,  229 => 110,  220 => 81,  214 => 88,  177 => 101,  169 => 60,  140 => 68,  132 => 61,  128 => 56,  107 => 49,  61 => 21,  273 => 130,  269 => 113,  254 => 120,  243 => 116,  240 => 102,  238 => 113,  235 => 112,  230 => 102,  227 => 74,  224 => 108,  221 => 99,  219 => 88,  217 => 138,  208 => 95,  204 => 99,  179 => 76,  159 => 66,  143 => 67,  135 => 59,  119 => 63,  102 => 46,  71 => 33,  67 => 24,  63 => 30,  59 => 24,  38 => 18,  94 => 50,  89 => 38,  85 => 42,  75 => 30,  68 => 30,  56 => 27,  201 => 84,  196 => 81,  183 => 65,  171 => 61,  166 => 58,  163 => 65,  158 => 66,  156 => 59,  151 => 77,  142 => 73,  138 => 71,  136 => 65,  121 => 69,  117 => 62,  105 => 41,  91 => 57,  62 => 23,  49 => 27,  28 => 4,  26 => 5,  87 => 38,  31 => 10,  25 => 5,  21 => 6,  24 => 5,  19 => 2,  93 => 35,  88 => 34,  78 => 30,  46 => 18,  44 => 13,  27 => 6,  79 => 29,  72 => 27,  69 => 25,  47 => 14,  40 => 10,  37 => 12,  22 => 4,  246 => 105,  157 => 72,  145 => 77,  139 => 59,  131 => 62,  123 => 53,  120 => 40,  115 => 51,  111 => 61,  108 => 43,  101 => 45,  98 => 37,  96 => 45,  83 => 31,  74 => 32,  66 => 48,  55 => 43,  52 => 20,  50 => 16,  43 => 35,  41 => 11,  35 => 7,  32 => 14,  29 => 7,  209 => 85,  203 => 93,  199 => 82,  193 => 127,  189 => 79,  187 => 77,  182 => 76,  176 => 96,  173 => 61,  168 => 68,  164 => 81,  162 => 74,  154 => 69,  149 => 78,  147 => 72,  144 => 60,  141 => 75,  133 => 69,  130 => 46,  125 => 44,  122 => 56,  116 => 53,  112 => 45,  109 => 48,  106 => 46,  103 => 59,  99 => 41,  95 => 41,  92 => 43,  86 => 56,  82 => 39,  80 => 38,  73 => 29,  64 => 25,  60 => 29,  57 => 26,  54 => 25,  51 => 22,  48 => 21,  45 => 20,  42 => 27,  39 => 9,  36 => 9,  33 => 14,  30 => 5,);
    }
}
