<?php

/* MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_modal_support.html.twig */
class __TwigTemplate_01dbb66ab254468030de0bb67aba443717f3ef9e8dcb980f5b5340f6798353f8 extends Twig_Template
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
    <div class=\"col-xs-9\">";
        // line 4
        echo "        <!-- Tab panes -->
        <div class=\"tab-content\">
            <div class=\"tab-pane fade in active\" id=\"pacienteInfo\" >
                ";
        // line 7
        $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:pct_bloque_informacion.html.twig")->display($context);
        // line 8
        echo "            </div>
            ";
        // line 9
        if ((!(null === (isset($context["historiaClinicaInfo"]) ? $context["historiaClinicaInfo"] : $this->getContext($context, "historiaClinicaInfo"))))) {
            // line 10
            echo "                <div class=\"tab-pane fade\" id=\"historiaClinicaInfo\" >
                    ";
            // line 11
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:hcl_bloque_informacion.html.twig")->display($context);
            // line 12
            echo "                </div>
            ";
        }
        // line 14
        echo "            ";
        if ((!(null === (isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo"))))) {
            // line 15
            echo "                <div class=\"tab-pane fade\" id=\"preinscripcionInfo\" >
                    ";
            // line 16
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:prc_bloque_informacion.html.twig")->display($context);
            // line 17
            echo "                </div>
            ";
        }
        // line 19
        echo "            ";
        if ((!(null === (isset($context["citaInfo"]) ? $context["citaInfo"] : $this->getContext($context, "citaInfo"))))) {
            // line 20
            echo "                <div class=\"tab-pane fade\" id=\"citaInfo\" >
                    ";
            // line 21
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:cit_bloque_informacion.html.twig")->display($context);
            // line 22
            echo "                </div>
            ";
        }
        // line 24
        echo "            ";
        if ((!(null === (isset($context["procedimientoRealizadoInfo"]) ? $context["procedimientoRealizadoInfo"] : $this->getContext($context, "procedimientoRealizadoInfo"))))) {
            // line 25
            echo "                <div class=\"tab-pane fade\" id=\"procedimientoRealizadoInfo\" >
                    ";
            // line 26
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:prz_bloque_informacion.html.twig")->display($context);
            // line 27
            echo "                </div>
            ";
        }
        // line 29
        echo "            ";
        if ((!(null === (isset($context["solicitudDiagnosticoInfo"]) ? $context["solicitudDiagnosticoInfo"] : $this->getContext($context, "solicitudDiagnosticoInfo"))))) {
            // line 30
            echo "                <div class=\"tab-pane fade\" id=\"solicitudDiagnosticoInfo\" >
                    ";
            // line 31
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:soldiag_bloque_informacion.html.twig")->display($context);
            // line 32
            echo "                </div>
            ";
        }
        // line 34
        echo "            ";
        if ((!(null === (isset($context["lecturaInfo"]) ? $context["lecturaInfo"] : $this->getContext($context, "lecturaInfo"))))) {
            // line 35
            echo "                <div class=\"tab-pane fade\" id=\"lecturaInfo\" >
                    ";
            // line 36
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:lct_bloque_informacion.html.twig")->display($context);
            // line 37
            echo "                </div>
            ";
        }
        // line 39
        echo "            ";
        if ((twig_length_filter($this->env, (isset($context["notaDiagInfo"]) ? $context["notaDiagInfo"] : $this->getContext($context, "notaDiagInfo"))) > 0)) {
            // line 40
            echo "                <div class=\"tab-pane fade\" id=\"notaDiagInfo\" >
                    ";
            // line 41
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:notdiag_bloque_informacion.html.twig")->display($context);
            // line 42
            echo "                </div>
            ";
        }
        // line 44
        echo "        </div>
    </div>

    <div class=\"col-xs-3\"> <!-- required for floating -->
        <!-- Nav tabs -->
        <ul class=\"nav nav-tabs tabs-right\">
            <li class=\"active\"><a href=\"#pacienteInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-user\"></span> Paciente</a></li>
            ";
        // line 51
        if ((!(null === (isset($context["historiaClinicaInfo"]) ? $context["historiaClinicaInfo"] : $this->getContext($context, "historiaClinicaInfo"))))) {
            // line 52
            echo "                <li><a href=\"#historiaClinicaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list-alt\"></span> Historia clínica</a></li>
            ";
        }
        // line 54
        echo "            ";
        if ((!(null === (isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo"))))) {
            // line 55
            echo "                <li><a href=\"#preinscripcionInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list-alt\"></span> Solicitud de estudio</a></li>
            ";
        }
        // line 57
        echo "            ";
        if ((!(null === (isset($context["citaInfo"]) ? $context["citaInfo"] : $this->getContext($context, "citaInfo"))))) {
            // line 58
            echo "                <li><a href=\"#citaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-floppy-saved\"></span> Cita</a></li>
            ";
        }
        // line 60
        echo "            ";
        if ((!(null === (isset($context["procedimientoRealizadoInfo"]) ? $context["procedimientoRealizadoInfo"] : $this->getContext($context, "procedimientoRealizadoInfo"))))) {
            // line 61
            echo "                <li><a href=\"#procedimientoRealizadoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-floppy-saved\"></span> Examen realizado</a></li>
            ";
        }
        // line 63
        echo "            ";
        if ((!(null === (isset($context["solicitudDiagnosticoInfo"]) ? $context["solicitudDiagnosticoInfo"] : $this->getContext($context, "solicitudDiagnosticoInfo"))))) {
            // line 64
            echo "                <li><a href=\"#solicitudDiagnosticoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list\"></span> Solicitud de diagnóstico</a></li>
            ";
        }
        // line 66
        echo "            ";
        if ((!(null === (isset($context["lecturaInfo"]) ? $context["lecturaInfo"] : $this->getContext($context, "lecturaInfo"))))) {
            // line 67
            echo "                <li><a href=\"#lecturaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list\"></span> Interpretación</a></li>
            ";
        }
        // line 69
        echo "            ";
        if ((twig_length_filter($this->env, (isset($context["notaDiagInfo"]) ? $context["notaDiagInfo"] : $this->getContext($context, "notaDiagInfo"))) > 0)) {
            // line 70
            echo "                <li><a href=\"#notaDiagInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-comment\"></span> Notas agregadas <span class=\"badge\">";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["notaDiagInfo"]) ? $context["notaDiagInfo"] : $this->getContext($context, "notaDiagInfo"))), "html", null, true);
            echo "</span></a></li>
            ";
        }
        // line 72
        echo "        </ul>
    </div>

    ";
        // line 76
        echo "    ";
        if ((!(null === (isset($context["pacienteInfo"]) ? $context["pacienteInfo"] : $this->getContext($context, "pacienteInfo"))))) {
            // line 77
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:pct_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 78
            echo "    ";
        }
        // line 79
        echo "    ";
        if ((!(null === (isset($context["historiaClinicaInfo"]) ? $context["historiaClinicaInfo"] : $this->getContext($context, "historiaClinicaInfo"))))) {
            // line 80
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:hcl_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 81
            echo "    ";
        }
        // line 82
        echo "    ";
        if ((!(null === (isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo"))))) {
            // line 83
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 84
            echo "    ";
        }
        // line 85
        echo "    ";
        if ((!(null === (isset($context["citaInfo"]) ? $context["citaInfo"] : $this->getContext($context, "citaInfo"))))) {
            // line 86
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:cit_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 87
            echo "    ";
        }
        // line 88
        echo "    ";
        if ((!(null === (isset($context["procedimientoRealizadoInfo"]) ? $context["procedimientoRealizadoInfo"] : $this->getContext($context, "procedimientoRealizadoInfo"))))) {
            // line 89
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prz_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 90
            echo "    ";
        }
        // line 91
        echo "    ";
        if ((!(null === (isset($context["solicitudDiagnosticoInfo"]) ? $context["solicitudDiagnosticoInfo"] : $this->getContext($context, "solicitudDiagnosticoInfo"))))) {
            // line 92
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:soldiag_total_info_modal.html.twig")->display($context);
            echo " ";
            // line 93
            echo "    ";
        }
        // line 94
        echo "    ";
        if ((!(null === (isset($context["lecturaInfo"]) ? $context["lecturaInfo"] : $this->getContext($context, "lecturaInfo"))))) {
            // line 95
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:lct_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 96
            echo "    ";
        }
        // line 97
        echo "    ";
        if ((twig_length_filter($this->env, (isset($context["notaDiagInfo"]) ? $context["notaDiagInfo"] : $this->getContext($context, "notaDiagInfo"))) > 0)) {
            // line 98
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:notdiag_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 99
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_modal_support.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  489 => 228,  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 245,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 230,  564 => 361,  561 => 235,  456 => 198,  431 => 185,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 151,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 194,  445 => 193,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 186,  517 => 244,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 105,  622 => 204,  531 => 224,  498 => 231,  468 => 236,  458 => 204,  401 => 199,  369 => 103,  356 => 180,  340 => 91,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 195,  408 => 182,  363 => 174,  359 => 100,  348 => 149,  345 => 163,  336 => 89,  316 => 159,  307 => 79,  261 => 116,  266 => 122,  542 => 230,  538 => 228,  527 => 197,  509 => 353,  499 => 248,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 117,  223 => 121,  585 => 224,  551 => 356,  546 => 308,  506 => 237,  503 => 193,  488 => 242,  485 => 268,  478 => 218,  475 => 205,  471 => 204,  448 => 192,  386 => 169,  378 => 178,  375 => 177,  306 => 190,  291 => 193,  286 => 128,  392 => 110,  332 => 142,  318 => 83,  276 => 115,  190 => 87,  12 => 36,  195 => 79,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 243,  496 => 280,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 197,  416 => 120,  395 => 111,  391 => 182,  382 => 195,  372 => 190,  364 => 102,  353 => 97,  335 => 159,  333 => 88,  297 => 132,  292 => 145,  205 => 82,  200 => 97,  184 => 71,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 223,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 201,  463 => 208,  446 => 207,  443 => 200,  429 => 200,  425 => 195,  410 => 190,  397 => 112,  394 => 168,  389 => 109,  357 => 150,  342 => 145,  334 => 139,  330 => 87,  328 => 140,  290 => 130,  287 => 119,  263 => 61,  255 => 101,  245 => 146,  194 => 82,  76 => 26,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 229,  481 => 208,  476 => 239,  467 => 221,  451 => 213,  424 => 198,  418 => 183,  412 => 183,  399 => 113,  396 => 167,  390 => 171,  388 => 181,  383 => 200,  377 => 169,  373 => 159,  370 => 164,  367 => 155,  352 => 160,  349 => 95,  346 => 94,  329 => 157,  326 => 136,  313 => 81,  303 => 145,  300 => 200,  234 => 93,  218 => 86,  207 => 80,  178 => 94,  321 => 134,  295 => 122,  274 => 125,  242 => 95,  236 => 93,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 227,  529 => 174,  524 => 173,  516 => 143,  510 => 218,  504 => 185,  500 => 262,  490 => 211,  486 => 210,  482 => 251,  470 => 237,  464 => 180,  459 => 171,  452 => 209,  434 => 201,  421 => 184,  417 => 250,  385 => 185,  361 => 173,  344 => 157,  339 => 141,  324 => 85,  310 => 210,  302 => 74,  296 => 121,  282 => 180,  259 => 122,  244 => 99,  231 => 143,  226 => 90,  114 => 64,  104 => 31,  288 => 122,  284 => 136,  279 => 162,  275 => 64,  256 => 99,  250 => 107,  237 => 108,  232 => 92,  222 => 89,  215 => 85,  191 => 78,  153 => 84,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 224,  523 => 268,  518 => 221,  514 => 168,  511 => 242,  508 => 241,  501 => 313,  495 => 260,  491 => 255,  487 => 224,  460 => 243,  455 => 241,  449 => 208,  442 => 210,  439 => 209,  436 => 202,  433 => 186,  426 => 126,  420 => 194,  415 => 182,  411 => 202,  405 => 115,  403 => 117,  400 => 185,  380 => 179,  366 => 152,  354 => 167,  331 => 138,  325 => 94,  320 => 154,  317 => 131,  311 => 127,  308 => 135,  304 => 139,  272 => 124,  267 => 169,  249 => 97,  216 => 87,  155 => 57,  152 => 81,  146 => 61,  126 => 52,  181 => 74,  161 => 67,  110 => 46,  188 => 77,  186 => 78,  170 => 64,  150 => 61,  124 => 51,  358 => 172,  351 => 166,  347 => 150,  343 => 146,  338 => 160,  327 => 140,  323 => 155,  319 => 138,  315 => 82,  301 => 182,  299 => 73,  293 => 69,  289 => 172,  281 => 109,  277 => 116,  271 => 106,  265 => 124,  262 => 123,  260 => 60,  257 => 148,  251 => 115,  248 => 99,  239 => 94,  228 => 101,  225 => 88,  213 => 102,  211 => 84,  197 => 79,  174 => 72,  148 => 57,  134 => 50,  127 => 42,  20 => 2,  53 => 15,  270 => 108,  253 => 58,  233 => 51,  212 => 86,  210 => 98,  206 => 84,  202 => 83,  198 => 96,  192 => 80,  185 => 93,  180 => 75,  175 => 73,  172 => 45,  167 => 84,  165 => 69,  160 => 62,  137 => 57,  113 => 36,  100 => 35,  90 => 30,  81 => 27,  129 => 46,  84 => 58,  77 => 24,  34 => 10,  118 => 42,  97 => 36,  70 => 25,  65 => 17,  58 => 20,  23 => 4,  480 => 301,  474 => 195,  469 => 150,  461 => 200,  457 => 199,  453 => 169,  444 => 236,  440 => 203,  437 => 187,  435 => 188,  430 => 172,  427 => 199,  423 => 206,  413 => 119,  409 => 117,  407 => 171,  402 => 114,  398 => 184,  393 => 183,  387 => 176,  384 => 164,  381 => 107,  379 => 106,  374 => 161,  368 => 175,  365 => 154,  362 => 101,  360 => 219,  355 => 98,  341 => 161,  337 => 144,  322 => 135,  314 => 149,  312 => 151,  309 => 126,  305 => 134,  298 => 146,  294 => 131,  285 => 119,  283 => 118,  278 => 108,  268 => 127,  264 => 150,  258 => 138,  252 => 98,  247 => 56,  241 => 127,  229 => 91,  220 => 107,  214 => 128,  177 => 74,  169 => 60,  140 => 58,  132 => 67,  128 => 72,  107 => 45,  61 => 21,  273 => 165,  269 => 63,  254 => 120,  243 => 116,  240 => 145,  238 => 96,  235 => 144,  230 => 94,  227 => 122,  224 => 108,  221 => 87,  219 => 88,  217 => 138,  208 => 83,  204 => 83,  179 => 76,  159 => 88,  143 => 122,  135 => 56,  119 => 46,  102 => 33,  71 => 22,  67 => 24,  63 => 22,  59 => 18,  38 => 9,  94 => 35,  89 => 59,  85 => 31,  75 => 27,  68 => 23,  56 => 14,  201 => 81,  196 => 81,  183 => 75,  171 => 72,  166 => 63,  163 => 63,  158 => 66,  156 => 82,  151 => 63,  142 => 56,  138 => 52,  136 => 51,  121 => 45,  117 => 42,  105 => 35,  91 => 34,  62 => 16,  49 => 16,  28 => 5,  26 => 6,  87 => 32,  31 => 5,  25 => 5,  21 => 6,  24 => 6,  19 => 2,  93 => 28,  88 => 27,  78 => 47,  46 => 15,  44 => 12,  27 => 7,  79 => 29,  72 => 20,  69 => 51,  47 => 15,  40 => 8,  37 => 11,  22 => 4,  246 => 96,  157 => 38,  145 => 76,  139 => 55,  131 => 49,  123 => 41,  120 => 65,  115 => 44,  111 => 42,  108 => 39,  101 => 33,  98 => 67,  96 => 68,  83 => 28,  74 => 23,  66 => 21,  55 => 19,  52 => 13,  50 => 15,  43 => 14,  41 => 11,  35 => 14,  32 => 9,  29 => 8,  209 => 85,  203 => 93,  199 => 82,  193 => 77,  189 => 79,  187 => 78,  182 => 77,  176 => 72,  173 => 71,  168 => 70,  164 => 118,  162 => 62,  154 => 64,  149 => 82,  147 => 61,  144 => 60,  141 => 74,  133 => 55,  130 => 54,  125 => 52,  122 => 85,  116 => 37,  112 => 40,  109 => 41,  106 => 40,  103 => 39,  99 => 37,  95 => 35,  92 => 58,  86 => 26,  82 => 30,  80 => 25,  73 => 26,  64 => 17,  60 => 19,  57 => 18,  54 => 14,  51 => 17,  48 => 21,  45 => 13,  42 => 27,  39 => 12,  36 => 10,  33 => 7,  30 => 6,);
    }
}
