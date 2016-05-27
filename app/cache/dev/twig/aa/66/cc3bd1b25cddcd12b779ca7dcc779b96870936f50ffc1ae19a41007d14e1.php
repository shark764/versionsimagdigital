<?php

/* MinsalSimagdBundle:ImgLecturaAdmin:lct_list.html.twig */
class __TwigTemplate_aa66cc3bd1b25cddcd12b779ca7dcc779b96870936f50ffc1ae19a41007d14e1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_list.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'simagd_form_navbar_brand_title' => array($this, 'block_simagd_form_navbar_brand_title'),
            'actions' => array($this, 'block_actions'),
            'table_body' => array($this, 'block_table_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 5
        $context["_minWarning"] = 8;
        // line 6
        $context["_minDanger"] = 5;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 8
    public function block_javascripts($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    ";
        // line 11
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_proximaConsulta.js.twig")->display(array_merge($context, array("_msjTitle" => "Lecturas pendientes:", "_minWarning" => (isset($context["_minWarning"]) ? $context["_minWarning"] : $this->getContext($context, "_minWarning")), "_minDanger" => (isset($context["_minDanger"]) ? $context["_minDanger"] : $this->getContext($context, "_minDanger")))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

    }

    // line 18
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 19
        echo "    <span class=\"navbar-brand\"><span class=\"label label-primary-v2\"> <i class=\"fa fa-microphone\"></i> Lecturas radiológicas realizadas </span></span>
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

    // line 28
    public function block_table_body($context, array $blocks = array())
    {
        // line 29
        echo "    <tbody>

        ";
        // line 31
        $context["_showPendienteRow"] = false;
        // line 32
        echo "        
\t";
        // line 33
        if ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT"))) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 35
            echo "
            ";
            // line 36
            $context["_showPendienteRow"] = true;
            // line 37
            echo "
\t";
        }
        // line 39
        echo "
        ";
        // line 40
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
            // line 41
            echo "        
            ";
            // line 42
            if ((isset($context["_showPendienteRow"]) ? $context["_showPendienteRow"] : $this->getContext($context, "_showPendienteRow"))) {
                // line 43
                echo "        
                ";
                // line 44
                if (!twig_in_filter($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstadoLectura"), "id"), array(0 => 4, 1 => 5, 2 => 6))) {
                    // line 45
                    echo "
                    ";
                    // line 46
                    $context["_preEstudio"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"), "idProcedimientoRealizado"), "idSolicitudEstudio"), "requiereDiagnostico");
                    // line 47
                    echo "
                    ";
                    // line 48
                    if ((isset($context["_preEstudio"]) ? $context["_preEstudio"] : $this->getContext($context, "_preEstudio"))) {
                        // line 49
                        echo "
                        ";
                        // line 50
                        $context["_proximaConsulta"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"), "idProcedimientoRealizado"), "idSolicitudEstudio"), "fechaProximaConsulta");
                        // line 51
                        echo "                        ";
                        $context["_proximaConsultaTitle"] = ("Próxima consulta médica:
" . $this->env->getExtension('sonata_intl_datetime')->formatDate((isset($context["_proximaConsulta"]) ? $context["_proximaConsulta"] : $this->getContext($context, "_proximaConsulta")), "EEEE, MMMM d, yyyy", "es_ES"));
                        // line 52
                        echo "
                        ";
                        // line 53
                        try {
                            $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_rowFechaPendiente.html.twig")->display(array_merge($context, array("_proximaConsulta" => (isset($context["_proximaConsulta"]) ? $context["_proximaConsulta"] : $this->getContext($context, "_proximaConsulta")), "_proximaConsultaTitle" => (isset($context["_proximaConsultaTitle"]) ? $context["_proximaConsultaTitle"] : $this->getContext($context, "_proximaConsultaTitle")), "_warningRow" => (isset($context["_minWarning"]) ? $context["_minWarning"] : $this->getContext($context, "_minWarning")), "_dangerRow" => (isset($context["_minDanger"]) ? $context["_minDanger"] : $this->getContext($context, "_minDanger")))));
                        } catch (Twig_Error_Loader $e) {
                            // ignore missing template
                        }

                        // line 59
                        echo "
                    ";
                    } else {
                        // line 61
                        echo "                        ";
                        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("MinsalSimagdBundle:ImgLecturaAdmin:proximaConsulta", array("idEstudioPadre" => $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"), "id"), "warningRow" => (isset($context["_minWarning"]) ? $context["_minWarning"] : $this->getContext($context, "_minWarning")), "dangerRow" => (isset($context["_minDanger"]) ? $context["_minDanger"] : $this->getContext($context, "_minDanger")), "_sonata_admin" => "minsal_simagd.admin.img_lectura")));
                        // line 65
                        echo "

                    ";
                    }
                    // line 68
                    echo "
                ";
                } else {
                    // line 70
                    echo "                    <tr>
                ";
                }
                // line 72
                echo "        
            ";
            } else {
                // line 74
                echo "                <tr>
            ";
            }
            // line 76
            echo "        
                ";
            // line 77
            $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "inner_list_row"), "method"));
            $template->display($context);
            // line 78
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
        // line 80
        echo "    
    </tbody>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgLecturaAdmin:lct_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 245,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 212,  564 => 361,  561 => 235,  456 => 170,  431 => 187,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 153,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 282,  445 => 218,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 235,  517 => 263,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 224,  622 => 204,  531 => 224,  498 => 213,  468 => 236,  458 => 204,  401 => 199,  369 => 165,  356 => 180,  340 => 141,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 173,  408 => 222,  363 => 220,  359 => 164,  348 => 149,  345 => 148,  336 => 163,  316 => 159,  307 => 183,  261 => 102,  266 => 112,  542 => 230,  538 => 228,  527 => 197,  509 => 353,  499 => 248,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 111,  223 => 121,  585 => 224,  551 => 356,  546 => 308,  506 => 103,  503 => 193,  488 => 242,  485 => 268,  478 => 240,  475 => 205,  471 => 204,  448 => 192,  386 => 169,  378 => 164,  375 => 244,  306 => 190,  291 => 142,  286 => 113,  392 => 178,  332 => 139,  318 => 133,  276 => 142,  190 => 78,  12 => 36,  195 => 66,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 168,  496 => 280,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 150,  416 => 226,  395 => 198,  391 => 247,  382 => 195,  372 => 190,  364 => 186,  353 => 175,  335 => 154,  333 => 138,  297 => 144,  292 => 116,  205 => 80,  200 => 129,  184 => 76,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 223,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 201,  463 => 208,  446 => 244,  443 => 191,  429 => 183,  425 => 195,  410 => 180,  397 => 176,  394 => 168,  389 => 177,  357 => 165,  342 => 172,  334 => 139,  330 => 158,  328 => 140,  290 => 116,  287 => 147,  263 => 136,  255 => 122,  245 => 102,  194 => 82,  76 => 42,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 244,  481 => 208,  476 => 239,  467 => 221,  451 => 213,  424 => 229,  418 => 183,  412 => 205,  399 => 177,  396 => 232,  390 => 171,  388 => 170,  383 => 200,  377 => 169,  373 => 210,  370 => 154,  367 => 155,  352 => 160,  349 => 148,  346 => 147,  329 => 155,  326 => 164,  313 => 186,  303 => 145,  300 => 208,  234 => 94,  218 => 89,  207 => 76,  178 => 66,  321 => 134,  295 => 178,  274 => 171,  242 => 95,  236 => 93,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 227,  529 => 174,  524 => 173,  516 => 143,  510 => 218,  504 => 185,  500 => 262,  490 => 211,  486 => 210,  482 => 251,  470 => 237,  464 => 180,  459 => 171,  452 => 240,  434 => 12,  421 => 184,  417 => 250,  385 => 185,  361 => 152,  344 => 157,  339 => 141,  324 => 207,  310 => 158,  302 => 123,  296 => 118,  282 => 112,  259 => 96,  244 => 97,  231 => 93,  226 => 90,  114 => 39,  104 => 39,  288 => 154,  284 => 146,  279 => 143,  275 => 110,  256 => 99,  250 => 98,  237 => 141,  232 => 92,  222 => 89,  215 => 78,  191 => 81,  153 => 65,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 224,  523 => 268,  518 => 221,  514 => 168,  511 => 321,  508 => 208,  501 => 313,  495 => 260,  491 => 255,  487 => 156,  460 => 243,  455 => 241,  449 => 239,  442 => 210,  439 => 209,  436 => 132,  433 => 233,  426 => 126,  420 => 123,  415 => 182,  411 => 202,  405 => 203,  403 => 117,  400 => 182,  380 => 245,  366 => 175,  354 => 101,  331 => 138,  325 => 94,  320 => 144,  317 => 131,  311 => 127,  308 => 123,  304 => 152,  272 => 108,  267 => 169,  249 => 97,  216 => 87,  155 => 57,  152 => 53,  146 => 52,  126 => 52,  181 => 78,  161 => 67,  110 => 84,  188 => 80,  186 => 78,  170 => 72,  150 => 55,  124 => 51,  358 => 179,  351 => 135,  347 => 174,  343 => 146,  338 => 158,  327 => 136,  323 => 128,  319 => 188,  315 => 126,  301 => 181,  299 => 122,  293 => 117,  289 => 176,  281 => 118,  277 => 105,  271 => 139,  265 => 137,  262 => 134,  260 => 101,  257 => 134,  251 => 99,  248 => 98,  239 => 94,  228 => 92,  225 => 137,  213 => 116,  211 => 87,  197 => 71,  174 => 72,  148 => 82,  134 => 49,  127 => 45,  20 => 2,  53 => 18,  270 => 108,  253 => 99,  233 => 76,  212 => 86,  210 => 127,  206 => 84,  202 => 83,  198 => 83,  192 => 80,  185 => 64,  180 => 74,  175 => 140,  172 => 70,  167 => 71,  165 => 69,  160 => 61,  137 => 49,  113 => 44,  100 => 40,  90 => 48,  81 => 31,  129 => 70,  84 => 32,  77 => 29,  34 => 10,  118 => 54,  97 => 39,  70 => 25,  65 => 24,  58 => 20,  23 => 3,  480 => 301,  474 => 195,  469 => 150,  461 => 200,  457 => 199,  453 => 169,  444 => 236,  440 => 15,  437 => 13,  435 => 188,  430 => 172,  427 => 185,  423 => 206,  413 => 181,  409 => 195,  407 => 179,  402 => 178,  398 => 115,  393 => 112,  387 => 176,  384 => 166,  381 => 165,  379 => 163,  374 => 161,  368 => 190,  365 => 154,  362 => 141,  360 => 219,  355 => 150,  341 => 123,  337 => 140,  322 => 131,  314 => 149,  312 => 125,  309 => 126,  305 => 124,  298 => 156,  294 => 143,  285 => 170,  283 => 153,  278 => 110,  268 => 107,  264 => 106,  258 => 101,  252 => 98,  247 => 97,  241 => 96,  229 => 91,  220 => 81,  214 => 88,  177 => 101,  169 => 60,  140 => 50,  132 => 47,  128 => 54,  107 => 34,  61 => 22,  273 => 109,  269 => 113,  254 => 100,  243 => 78,  240 => 118,  238 => 95,  235 => 77,  230 => 75,  227 => 74,  224 => 91,  221 => 90,  219 => 88,  217 => 72,  208 => 86,  204 => 85,  179 => 76,  159 => 66,  143 => 58,  135 => 48,  119 => 41,  102 => 35,  71 => 21,  67 => 24,  63 => 22,  59 => 23,  38 => 9,  94 => 35,  89 => 34,  85 => 31,  75 => 27,  68 => 21,  56 => 19,  201 => 84,  196 => 81,  183 => 65,  171 => 61,  166 => 58,  163 => 65,  158 => 66,  156 => 59,  151 => 63,  142 => 51,  138 => 57,  136 => 96,  121 => 69,  117 => 41,  105 => 41,  91 => 36,  62 => 19,  49 => 16,  28 => 5,  26 => 5,  87 => 32,  31 => 10,  25 => 5,  21 => 6,  24 => 6,  19 => 2,  93 => 37,  88 => 35,  78 => 31,  46 => 15,  44 => 11,  27 => 7,  79 => 29,  72 => 27,  69 => 25,  47 => 20,  40 => 12,  37 => 11,  22 => 4,  246 => 96,  157 => 67,  145 => 50,  139 => 59,  131 => 45,  123 => 44,  120 => 42,  115 => 44,  111 => 42,  108 => 42,  101 => 39,  98 => 33,  96 => 37,  83 => 32,  74 => 28,  66 => 33,  55 => 19,  52 => 20,  50 => 21,  43 => 14,  41 => 14,  35 => 8,  32 => 9,  29 => 8,  209 => 85,  203 => 69,  199 => 82,  193 => 127,  189 => 79,  187 => 77,  182 => 77,  176 => 72,  173 => 61,  168 => 68,  164 => 121,  162 => 63,  154 => 64,  149 => 53,  147 => 61,  144 => 60,  141 => 57,  133 => 55,  130 => 46,  125 => 44,  122 => 43,  116 => 41,  112 => 39,  109 => 41,  106 => 40,  103 => 39,  99 => 37,  95 => 32,  92 => 32,  86 => 33,  82 => 30,  80 => 24,  73 => 26,  64 => 23,  60 => 22,  57 => 21,  54 => 21,  51 => 17,  48 => 17,  45 => 16,  42 => 13,  39 => 12,  36 => 12,  33 => 6,  30 => 6,);
    }
}
