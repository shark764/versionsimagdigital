<?php

/* MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_list.html.twig */
class __TwigTemplate_a42fddab3b56d80189c05672a18ca9720ce39f6f39b8bdedcfd4dacf34adb6d4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_list.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'simagd_form_navbar_brand_title' => array($this, 'block_simagd_form_navbar_brand_title'),
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
            $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_proximaConsulta.js.twig")->display(array_merge($context, array("_msjTitle" => "Lista de trabajo:", "_minWarning" => (isset($context["_minWarning"]) ? $context["_minWarning"] : $this->getContext($context, "_minWarning")), "_minDanger" => (isset($context["_minDanger"]) ? $context["_minDanger"] : $this->getContext($context, "_minDanger")))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

    }

    // line 18
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 19
        echo "    ";
        $context["_adminTitle"] = "<i class=\"fa fa-user\"></i> Listado personal de diagnósticos pendientes por verificar";
        // line 20
        echo "    <span class=\"navbar-brand\"><span class=\"label label-primary-v2\"> <i class=\"fa fa-check-square-o\"></i> <i class=\"fa fa-list-ul\"></i> ";
        echo (isset($context["_adminTitle"]) ? $context["_adminTitle"] : $this->getContext($context, "_adminTitle"));
        echo " </span></span>
";
    }

    // line 23
    public function block_table_body($context, array $blocks = array())
    {
        // line 24
        echo "    <tbody>

        ";
        // line 26
        $context["_showPendienteRow"] = false;
        // line 27
        echo "        
\t";
        // line 28
        if ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT"))) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 30
            echo "
            ";
            // line 31
            $context["_showPendienteRow"] = true;
            // line 32
            echo "
\t";
        }
        // line 34
        echo "
        ";
        // line 35
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
            // line 36
            echo "        
            ";
            // line 37
            if ((isset($context["_showPendienteRow"]) ? $context["_showPendienteRow"] : $this->getContext($context, "_showPendienteRow"))) {
                // line 38
                echo "        
                ";
                // line 39
                $context["_preEstudio"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idDiagnostico"), "idLectura"), "idEstudio"), "idProcedimientoRealizado"), "idSolicitudEstudio"), "requiereDiagnostico");
                // line 40
                echo "
                ";
                // line 41
                if ((isset($context["_preEstudio"]) ? $context["_preEstudio"] : $this->getContext($context, "_preEstudio"))) {
                    // line 42
                    echo "
                    ";
                    // line 43
                    $context["_proximaConsulta"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idDiagnostico"), "idLectura"), "idEstudio"), "idProcedimientoRealizado"), "idSolicitudEstudio"), "fechaProximaConsulta");
                    // line 44
                    echo "                    ";
                    $context["_proximaConsultaTitle"] = ("Próxima consulta médica:
" . $this->env->getExtension('sonata_intl_datetime')->formatDate((isset($context["_proximaConsulta"]) ? $context["_proximaConsulta"] : $this->getContext($context, "_proximaConsulta")), "EEEE, MMMM d, yyyy", "es_ES"));
                    // line 45
                    echo "
                    ";
                    // line 46
                    try {
                        $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_rowFechaPendiente.html.twig")->display(array_merge($context, array("_proximaConsulta" => (isset($context["_proximaConsulta"]) ? $context["_proximaConsulta"] : $this->getContext($context, "_proximaConsulta")), "_proximaConsultaTitle" => (isset($context["_proximaConsultaTitle"]) ? $context["_proximaConsultaTitle"] : $this->getContext($context, "_proximaConsultaTitle")), "_warningRow" => (isset($context["_minWarning"]) ? $context["_minWarning"] : $this->getContext($context, "_minWarning")), "_dangerRow" => (isset($context["_minDanger"]) ? $context["_minDanger"] : $this->getContext($context, "_minDanger")))));
                    } catch (Twig_Error_Loader $e) {
                        // ignore missing template
                    }

                    // line 52
                    echo "
                ";
                } else {
                    // line 54
                    echo "                    ";
                    echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("MinsalSimagdBundle:ImgLecturaAdmin:proximaConsulta", array("idEstudioPadre" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idDiagnostico"), "idLectura"), "idEstudio"), "id"), "warningRow" => (isset($context["_minWarning"]) ? $context["_minWarning"] : $this->getContext($context, "_minWarning")), "dangerRow" => (isset($context["_minDanger"]) ? $context["_minDanger"] : $this->getContext($context, "_minDanger")), "_sonata_admin" => "minsal_simagd.admin.img_lectura")));
                    // line 58
                    echo "

                ";
                }
                // line 61
                echo "        
            ";
            } else {
                // line 63
                echo "                <tr>
            ";
            }
            // line 65
            echo "        
                ";
            // line 66
            $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "inner_list_row"), "method"));
            $template->display($context);
            // line 67
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
        // line 69
        echo "    
    </tbody>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 321,  778 => 315,  772 => 312,  760 => 307,  755 => 304,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 254,  596 => 231,  578 => 270,  534 => 200,  507 => 184,  447 => 190,  445 => 175,  419 => 166,  454 => 160,  371 => 191,  651 => 437,  483 => 333,  404 => 257,  517 => 291,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 193,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 204,  401 => 144,  369 => 129,  356 => 212,  340 => 202,  874 => 781,  854 => 325,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 318,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 309,  763 => 308,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 303,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 436,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 205,  520 => 355,  450 => 173,  408 => 161,  363 => 216,  359 => 182,  348 => 129,  345 => 124,  336 => 192,  316 => 116,  307 => 124,  261 => 85,  266 => 83,  542 => 218,  538 => 217,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 272,  473 => 165,  414 => 158,  406 => 152,  280 => 126,  223 => 130,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 176,  485 => 175,  478 => 165,  475 => 164,  471 => 211,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 177,  291 => 165,  286 => 140,  392 => 150,  332 => 164,  318 => 156,  276 => 160,  190 => 167,  12 => 36,  195 => 114,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 357,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 348,  894 => 383,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 389,  730 => 219,  727 => 218,  712 => 214,  709 => 296,  706 => 295,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 251,  632 => 186,  626 => 260,  623 => 183,  616 => 249,  613 => 232,  610 => 407,  608 => 197,  605 => 196,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 224,  533 => 203,  530 => 150,  513 => 79,  496 => 280,  441 => 150,  438 => 149,  432 => 166,  428 => 172,  422 => 150,  416 => 173,  395 => 118,  391 => 109,  382 => 195,  372 => 89,  364 => 137,  353 => 96,  335 => 120,  333 => 127,  297 => 169,  292 => 82,  205 => 113,  200 => 82,  184 => 121,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 300,  946 => 296,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 320,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 313,  754 => 208,  748 => 205,  745 => 392,  742 => 391,  737 => 199,  735 => 220,  732 => 197,  728 => 344,  726 => 341,  723 => 340,  719 => 215,  717 => 186,  714 => 185,  704 => 294,  701 => 180,  699 => 179,  696 => 291,  690 => 285,  687 => 173,  681 => 205,  673 => 281,  671 => 280,  668 => 279,  663 => 277,  658 => 271,  654 => 155,  649 => 153,  643 => 250,  640 => 249,  636 => 145,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 226,  587 => 388,  584 => 320,  576 => 230,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 361,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 352,  502 => 87,  477 => 82,  472 => 132,  465 => 209,  463 => 208,  446 => 244,  443 => 142,  429 => 219,  425 => 228,  410 => 167,  397 => 161,  394 => 54,  389 => 128,  357 => 186,  342 => 137,  334 => 171,  330 => 122,  328 => 167,  290 => 167,  287 => 163,  263 => 122,  255 => 98,  245 => 92,  194 => 73,  76 => 39,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 373,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 296,  888 => 270,  882 => 333,  873 => 267,  868 => 282,  864 => 372,  860 => 327,  856 => 279,  852 => 324,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 347,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 525,  606 => 209,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 190,  580 => 387,  572 => 218,  568 => 227,  562 => 313,  556 => 212,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 183,  492 => 341,  481 => 218,  476 => 271,  467 => 156,  451 => 159,  424 => 115,  418 => 227,  412 => 147,  399 => 64,  396 => 166,  390 => 139,  388 => 153,  383 => 135,  377 => 104,  373 => 46,  370 => 147,  367 => 102,  352 => 141,  349 => 139,  346 => 138,  329 => 111,  326 => 131,  313 => 126,  303 => 132,  300 => 124,  234 => 88,  218 => 98,  207 => 118,  178 => 99,  321 => 119,  295 => 118,  274 => 157,  242 => 93,  236 => 136,  692 => 175,  683 => 170,  678 => 204,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 150,  641 => 368,  635 => 268,  631 => 364,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 224,  579 => 236,  577 => 318,  575 => 252,  569 => 233,  565 => 314,  548 => 207,  540 => 202,  536 => 358,  529 => 213,  524 => 196,  516 => 143,  510 => 185,  504 => 183,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 162,  452 => 145,  434 => 170,  421 => 114,  417 => 159,  385 => 196,  361 => 145,  344 => 94,  339 => 167,  324 => 123,  310 => 113,  302 => 145,  296 => 136,  282 => 106,  259 => 81,  244 => 116,  231 => 117,  226 => 131,  114 => 53,  104 => 61,  288 => 141,  284 => 162,  279 => 111,  275 => 99,  256 => 147,  250 => 95,  237 => 71,  232 => 134,  222 => 57,  215 => 130,  191 => 115,  153 => 86,  563 => 223,  560 => 222,  558 => 186,  555 => 185,  553 => 211,  549 => 206,  543 => 179,  537 => 306,  532 => 199,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 207,  455 => 203,  449 => 247,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 170,  420 => 123,  415 => 226,  411 => 120,  405 => 118,  403 => 160,  400 => 162,  380 => 107,  366 => 146,  354 => 185,  331 => 133,  325 => 119,  320 => 92,  317 => 128,  311 => 181,  308 => 151,  304 => 85,  272 => 98,  267 => 153,  249 => 143,  216 => 55,  155 => 93,  152 => 61,  146 => 54,  126 => 43,  181 => 83,  161 => 89,  110 => 66,  188 => 114,  186 => 108,  170 => 98,  150 => 130,  124 => 74,  358 => 172,  351 => 183,  347 => 206,  343 => 146,  338 => 144,  327 => 121,  323 => 114,  319 => 159,  315 => 183,  301 => 121,  299 => 173,  293 => 135,  289 => 115,  281 => 112,  277 => 95,  271 => 94,  265 => 153,  262 => 92,  260 => 119,  257 => 138,  251 => 143,  248 => 71,  239 => 90,  228 => 130,  225 => 86,  213 => 107,  211 => 124,  197 => 110,  174 => 91,  148 => 89,  134 => 74,  127 => 69,  20 => 2,  53 => 30,  270 => 129,  253 => 100,  233 => 133,  212 => 86,  210 => 116,  206 => 124,  202 => 118,  198 => 112,  192 => 102,  185 => 106,  180 => 109,  175 => 98,  172 => 96,  167 => 156,  165 => 66,  160 => 90,  137 => 79,  113 => 38,  100 => 54,  90 => 48,  81 => 44,  129 => 59,  84 => 32,  77 => 28,  34 => 8,  118 => 40,  97 => 46,  70 => 39,  65 => 23,  58 => 20,  23 => 5,  480 => 134,  474 => 213,  469 => 150,  461 => 157,  457 => 161,  453 => 194,  444 => 151,  440 => 172,  437 => 171,  435 => 167,  430 => 172,  427 => 171,  423 => 169,  413 => 164,  409 => 153,  407 => 238,  402 => 65,  398 => 157,  393 => 156,  387 => 110,  384 => 152,  381 => 150,  379 => 194,  374 => 192,  368 => 190,  365 => 189,  362 => 97,  360 => 187,  355 => 161,  341 => 123,  337 => 136,  322 => 187,  314 => 136,  312 => 125,  309 => 113,  305 => 128,  298 => 143,  294 => 145,  285 => 79,  283 => 163,  278 => 110,  268 => 94,  264 => 104,  258 => 147,  252 => 88,  247 => 109,  241 => 74,  229 => 102,  220 => 124,  214 => 86,  177 => 99,  169 => 96,  140 => 69,  132 => 45,  128 => 44,  107 => 62,  61 => 19,  273 => 130,  269 => 127,  254 => 122,  243 => 137,  240 => 137,  238 => 92,  235 => 120,  230 => 111,  227 => 130,  224 => 100,  221 => 82,  219 => 129,  217 => 87,  208 => 80,  204 => 116,  179 => 104,  159 => 91,  143 => 81,  135 => 46,  119 => 66,  102 => 60,  71 => 19,  67 => 25,  63 => 25,  59 => 32,  38 => 20,  94 => 56,  89 => 52,  85 => 50,  75 => 24,  68 => 24,  56 => 16,  201 => 95,  196 => 87,  183 => 69,  171 => 103,  166 => 92,  163 => 94,  158 => 63,  156 => 86,  151 => 74,  142 => 52,  138 => 78,  136 => 75,  121 => 41,  117 => 70,  105 => 62,  91 => 35,  62 => 36,  49 => 17,  28 => 8,  26 => 7,  87 => 51,  31 => 12,  25 => 10,  21 => 1,  24 => 4,  19 => 2,  93 => 50,  88 => 34,  78 => 46,  46 => 26,  44 => 15,  27 => 5,  79 => 30,  72 => 26,  69 => 40,  47 => 11,  40 => 18,  37 => 9,  22 => 3,  246 => 94,  157 => 90,  145 => 65,  139 => 82,  131 => 74,  123 => 42,  120 => 64,  115 => 64,  111 => 37,  108 => 36,  101 => 60,  98 => 53,  96 => 56,  83 => 44,  74 => 27,  66 => 36,  55 => 19,  52 => 18,  50 => 28,  43 => 11,  41 => 22,  35 => 19,  32 => 7,  29 => 6,  209 => 119,  203 => 96,  199 => 120,  193 => 116,  189 => 70,  187 => 107,  182 => 90,  176 => 100,  173 => 69,  168 => 67,  164 => 99,  162 => 65,  154 => 61,  149 => 58,  147 => 84,  144 => 80,  141 => 83,  133 => 75,  130 => 76,  125 => 72,  122 => 68,  116 => 39,  112 => 66,  109 => 60,  106 => 58,  103 => 56,  99 => 54,  95 => 56,  92 => 51,  86 => 41,  82 => 31,  80 => 46,  73 => 42,  64 => 36,  60 => 40,  57 => 32,  54 => 29,  51 => 11,  48 => 26,  45 => 8,  42 => 14,  39 => 8,  36 => 17,  33 => 3,  30 => 6,);
    }
}
