<?php

/* MinsalSimagdBundle:ImgNotaDiagnosticoAdmin:notdiag_modal_support.html.twig */
class __TwigTemplate_e24e3b7c6b7a2e0b2176b5f400f5fb49be0082fd33051a9abd99767c25b366af extends Twig_Template
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
        if ((!(null === (isset($context["diagnosticoInfo"]) ? $context["diagnosticoInfo"] : $this->getContext($context, "diagnosticoInfo"))))) {
            // line 40
            echo "                <div class=\"tab-pane fade\" id=\"diagnosticoInfo\" >
                    ";
            // line 41
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:diag_bloque_informacion.html.twig")->display($context);
            // line 42
            echo "                </div>
            ";
        }
        // line 44
        echo "            ";
        if ((twig_length_filter($this->env, (isset($context["notaDiagInfo"]) ? $context["notaDiagInfo"] : $this->getContext($context, "notaDiagInfo"))) > 0)) {
            // line 45
            echo "                <div class=\"tab-pane fade\" id=\"notaDiagInfo\" >
                    ";
            // line 46
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:notdiag_bloque_informacion.html.twig")->display($context);
            // line 47
            echo "                </div>
            ";
        }
        // line 49
        echo "        </div>
    </div>

    <div class=\"col-xs-3\"> <!-- required for floating -->
        <!-- Nav tabs -->
        <ul class=\"nav nav-tabs tabs-right\">
            <li class=\"active\"><a href=\"#pacienteInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-user\"></span> Paciente</a></li>
            ";
        // line 56
        if ((!(null === (isset($context["historiaClinicaInfo"]) ? $context["historiaClinicaInfo"] : $this->getContext($context, "historiaClinicaInfo"))))) {
            // line 57
            echo "                <li><a href=\"#historiaClinicaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list-alt\"></span> Historia clínica</a></li>
            ";
        }
        // line 59
        echo "            ";
        if ((!(null === (isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo"))))) {
            // line 60
            echo "                <li><a href=\"#preinscripcionInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list-alt\"></span> Solicitud de estudio</a></li>
            ";
        }
        // line 62
        echo "            ";
        if ((!(null === (isset($context["citaInfo"]) ? $context["citaInfo"] : $this->getContext($context, "citaInfo"))))) {
            // line 63
            echo "                <li><a href=\"#citaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-floppy-saved\"></span> Cita</a></li>
            ";
        }
        // line 65
        echo "            ";
        if ((!(null === (isset($context["procedimientoRealizadoInfo"]) ? $context["procedimientoRealizadoInfo"] : $this->getContext($context, "procedimientoRealizadoInfo"))))) {
            // line 66
            echo "                <li><a href=\"#procedimientoRealizadoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-floppy-saved\"></span> Examen realizado</a></li>
            ";
        }
        // line 68
        echo "            ";
        if ((!(null === (isset($context["solicitudDiagnosticoInfo"]) ? $context["solicitudDiagnosticoInfo"] : $this->getContext($context, "solicitudDiagnosticoInfo"))))) {
            // line 69
            echo "                <li><a href=\"#solicitudDiagnosticoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list\"></span> Solicitud de diagnóstico</a></li>
            ";
        }
        // line 71
        echo "            ";
        if ((!(null === (isset($context["lecturaInfo"]) ? $context["lecturaInfo"] : $this->getContext($context, "lecturaInfo"))))) {
            // line 72
            echo "                <li><a href=\"#lecturaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list\"></span> Interpretación</a></li>
            ";
        }
        // line 74
        echo "            ";
        if ((!(null === (isset($context["diagnosticoInfo"]) ? $context["diagnosticoInfo"] : $this->getContext($context, "diagnosticoInfo"))))) {
            // line 75
            echo "                <li><a href=\"#diagnosticoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-paperclip\"></span> Diagnóstico</a></li>
            ";
        }
        // line 77
        echo "            ";
        if ((twig_length_filter($this->env, (isset($context["notaDiagInfo"]) ? $context["notaDiagInfo"] : $this->getContext($context, "notaDiagInfo"))) > 0)) {
            // line 78
            echo "                <li><a href=\"#notaDiagInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-comment\"></span> Notas agregadas <span class=\"badge\">";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["notaDiagInfo"]) ? $context["notaDiagInfo"] : $this->getContext($context, "notaDiagInfo"))), "html", null, true);
            echo "</span></a></li>
            ";
        }
        // line 80
        echo "        </ul>
    </div>

    ";
        // line 84
        echo "    ";
        if ((!(null === (isset($context["pacienteInfo"]) ? $context["pacienteInfo"] : $this->getContext($context, "pacienteInfo"))))) {
            // line 85
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:pct_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 86
            echo "    ";
        }
        // line 87
        echo "    ";
        if ((!(null === (isset($context["historiaClinicaInfo"]) ? $context["historiaClinicaInfo"] : $this->getContext($context, "historiaClinicaInfo"))))) {
            // line 88
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:hcl_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 89
            echo "    ";
        }
        // line 90
        echo "    ";
        if ((!(null === (isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo"))))) {
            // line 91
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 92
            echo "    ";
        }
        // line 93
        echo "    ";
        if ((!(null === (isset($context["citaInfo"]) ? $context["citaInfo"] : $this->getContext($context, "citaInfo"))))) {
            // line 94
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:cit_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 95
            echo "    ";
        }
        // line 96
        echo "    ";
        if ((!(null === (isset($context["procedimientoRealizadoInfo"]) ? $context["procedimientoRealizadoInfo"] : $this->getContext($context, "procedimientoRealizadoInfo"))))) {
            // line 97
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prz_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 98
            echo "    ";
        }
        // line 99
        echo "    ";
        if ((!(null === (isset($context["solicitudDiagnosticoInfo"]) ? $context["solicitudDiagnosticoInfo"] : $this->getContext($context, "solicitudDiagnosticoInfo"))))) {
            // line 100
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:soldiag_total_info_modal.html.twig")->display($context);
            echo " ";
            // line 101
            echo "    ";
        }
        // line 102
        echo "    ";
        if ((!(null === (isset($context["lecturaInfo"]) ? $context["lecturaInfo"] : $this->getContext($context, "lecturaInfo"))))) {
            // line 103
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:lct_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 104
            echo "    ";
        }
        // line 105
        echo "    ";
        if ((!(null === (isset($context["diagnosticoInfo"]) ? $context["diagnosticoInfo"] : $this->getContext($context, "diagnosticoInfo"))))) {
            // line 106
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:diag_total_info_modal.html.twig")->display($context);
            echo "    ";
            // line 107
            echo "    ";
        }
        // line 108
        echo "    ";
        if ((twig_length_filter($this->env, (isset($context["notaDiagInfo"]) ? $context["notaDiagInfo"] : $this->getContext($context, "notaDiagInfo"))) > 0)) {
            // line 109
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:notdiag_total_info_modal.html.twig")->display($context);
            echo "     ";
            // line 110
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgNotaDiagnosticoAdmin:notdiag_modal_support.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 245,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 212,  564 => 361,  561 => 235,  456 => 170,  431 => 190,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 145,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 282,  445 => 218,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 235,  517 => 263,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 224,  622 => 204,  531 => 224,  498 => 213,  468 => 236,  458 => 204,  401 => 199,  369 => 165,  356 => 180,  340 => 146,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 173,  408 => 182,  363 => 220,  359 => 164,  348 => 149,  345 => 148,  336 => 163,  316 => 159,  307 => 129,  261 => 103,  266 => 112,  542 => 230,  538 => 228,  527 => 197,  509 => 353,  499 => 248,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 111,  223 => 121,  585 => 224,  551 => 356,  546 => 308,  506 => 103,  503 => 193,  488 => 242,  485 => 268,  478 => 240,  475 => 205,  471 => 204,  448 => 192,  386 => 169,  378 => 158,  375 => 244,  306 => 190,  291 => 121,  286 => 113,  392 => 175,  332 => 139,  318 => 134,  276 => 115,  190 => 113,  12 => 36,  195 => 91,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 168,  496 => 280,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 150,  416 => 184,  395 => 198,  391 => 247,  382 => 195,  372 => 190,  364 => 186,  353 => 175,  335 => 154,  333 => 142,  297 => 144,  292 => 123,  205 => 86,  200 => 97,  184 => 77,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 223,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 201,  463 => 208,  446 => 244,  443 => 200,  429 => 183,  425 => 195,  410 => 180,  397 => 176,  394 => 168,  389 => 177,  357 => 150,  342 => 172,  334 => 139,  330 => 137,  328 => 140,  290 => 116,  287 => 119,  263 => 125,  255 => 101,  245 => 98,  194 => 82,  76 => 54,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 244,  481 => 208,  476 => 239,  467 => 221,  451 => 213,  424 => 229,  418 => 183,  412 => 183,  399 => 177,  396 => 232,  390 => 171,  388 => 174,  383 => 200,  377 => 169,  373 => 156,  370 => 164,  367 => 155,  352 => 160,  349 => 148,  346 => 147,  329 => 155,  326 => 136,  313 => 132,  303 => 145,  300 => 208,  234 => 93,  218 => 90,  207 => 128,  178 => 84,  321 => 134,  295 => 122,  274 => 171,  242 => 95,  236 => 103,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 227,  529 => 174,  524 => 173,  516 => 143,  510 => 218,  504 => 185,  500 => 262,  490 => 211,  486 => 210,  482 => 251,  470 => 237,  464 => 180,  459 => 171,  452 => 240,  434 => 12,  421 => 184,  417 => 250,  385 => 185,  361 => 152,  344 => 157,  339 => 141,  324 => 207,  310 => 158,  302 => 127,  296 => 118,  282 => 112,  259 => 96,  244 => 104,  231 => 94,  226 => 109,  114 => 50,  104 => 47,  288 => 122,  284 => 136,  279 => 143,  275 => 107,  256 => 99,  250 => 107,  237 => 141,  232 => 92,  222 => 90,  215 => 89,  191 => 90,  153 => 79,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 224,  523 => 268,  518 => 221,  514 => 168,  511 => 321,  508 => 208,  501 => 313,  495 => 260,  491 => 255,  487 => 156,  460 => 243,  455 => 241,  449 => 239,  442 => 210,  439 => 209,  436 => 132,  433 => 233,  426 => 126,  420 => 186,  415 => 182,  411 => 202,  405 => 203,  403 => 117,  400 => 182,  380 => 245,  366 => 152,  354 => 101,  331 => 138,  325 => 94,  320 => 144,  317 => 131,  311 => 127,  308 => 123,  304 => 125,  272 => 114,  267 => 169,  249 => 97,  216 => 87,  155 => 57,  152 => 63,  146 => 71,  126 => 56,  181 => 83,  161 => 75,  110 => 40,  188 => 77,  186 => 89,  170 => 71,  150 => 55,  124 => 45,  358 => 179,  351 => 135,  347 => 150,  343 => 146,  338 => 158,  327 => 136,  323 => 128,  319 => 134,  315 => 126,  301 => 181,  299 => 123,  293 => 117,  289 => 176,  281 => 109,  277 => 105,  271 => 106,  265 => 104,  262 => 134,  260 => 101,  257 => 121,  251 => 100,  248 => 99,  239 => 104,  228 => 93,  225 => 92,  213 => 102,  211 => 88,  197 => 91,  174 => 98,  148 => 82,  134 => 54,  127 => 49,  20 => 2,  53 => 22,  270 => 108,  253 => 107,  233 => 76,  212 => 86,  210 => 86,  206 => 97,  202 => 96,  198 => 84,  192 => 90,  185 => 64,  180 => 75,  175 => 70,  172 => 70,  167 => 67,  165 => 77,  160 => 83,  137 => 55,  113 => 41,  100 => 45,  90 => 29,  81 => 55,  129 => 64,  84 => 26,  77 => 24,  34 => 10,  118 => 45,  97 => 36,  70 => 25,  65 => 18,  58 => 20,  23 => 4,  480 => 301,  474 => 195,  469 => 150,  461 => 200,  457 => 199,  453 => 169,  444 => 236,  440 => 15,  437 => 13,  435 => 188,  430 => 172,  427 => 185,  423 => 206,  413 => 181,  409 => 195,  407 => 179,  402 => 179,  398 => 178,  393 => 112,  387 => 176,  384 => 173,  381 => 165,  379 => 163,  374 => 161,  368 => 190,  365 => 154,  362 => 141,  360 => 219,  355 => 155,  341 => 141,  337 => 140,  322 => 135,  314 => 149,  312 => 130,  309 => 126,  305 => 124,  298 => 126,  294 => 143,  285 => 110,  283 => 153,  278 => 108,  268 => 105,  264 => 111,  258 => 102,  252 => 98,  247 => 105,  241 => 97,  229 => 110,  220 => 81,  214 => 88,  177 => 74,  169 => 60,  140 => 56,  132 => 61,  128 => 56,  107 => 49,  61 => 21,  273 => 130,  269 => 113,  254 => 120,  243 => 116,  240 => 102,  238 => 96,  235 => 95,  230 => 102,  227 => 74,  224 => 108,  221 => 91,  219 => 88,  217 => 138,  208 => 87,  204 => 99,  179 => 76,  159 => 66,  143 => 67,  135 => 59,  119 => 63,  102 => 46,  71 => 22,  67 => 24,  63 => 22,  59 => 24,  38 => 18,  94 => 35,  89 => 30,  85 => 31,  75 => 27,  68 => 30,  56 => 27,  201 => 85,  196 => 81,  183 => 65,  171 => 61,  166 => 69,  163 => 68,  158 => 66,  156 => 65,  151 => 77,  142 => 59,  138 => 57,  136 => 56,  121 => 46,  117 => 62,  105 => 38,  91 => 34,  62 => 21,  49 => 16,  28 => 8,  26 => 7,  87 => 32,  31 => 6,  25 => 5,  21 => 6,  24 => 5,  19 => 2,  93 => 30,  88 => 34,  78 => 27,  46 => 15,  44 => 13,  27 => 7,  79 => 29,  72 => 27,  69 => 20,  47 => 14,  40 => 10,  37 => 11,  22 => 4,  246 => 105,  157 => 72,  145 => 60,  139 => 59,  131 => 62,  123 => 47,  120 => 46,  115 => 44,  111 => 42,  108 => 39,  101 => 36,  98 => 35,  96 => 45,  83 => 31,  74 => 23,  66 => 48,  55 => 19,  52 => 16,  50 => 15,  43 => 14,  41 => 11,  35 => 7,  32 => 9,  29 => 8,  209 => 85,  203 => 93,  199 => 82,  193 => 80,  189 => 79,  187 => 78,  182 => 76,  176 => 96,  173 => 72,  168 => 68,  164 => 81,  162 => 74,  154 => 69,  149 => 62,  147 => 72,  144 => 60,  141 => 75,  133 => 69,  130 => 46,  125 => 44,  122 => 56,  116 => 44,  112 => 45,  109 => 41,  106 => 40,  103 => 39,  99 => 37,  95 => 34,  92 => 43,  86 => 56,  82 => 30,  80 => 28,  73 => 26,  64 => 25,  60 => 19,  57 => 18,  54 => 15,  51 => 17,  48 => 21,  45 => 12,  42 => 27,  39 => 12,  36 => 10,  33 => 14,  30 => 5,);
    }
}
