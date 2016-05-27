<?php

/* MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_edit.html.twig */
class __TwigTemplate_2ecfaa04a69196709a167e47b8d6db89fed4d6e8af8c3c405dd5bbad45733002 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_edit.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'form' => array($this, 'block_form'),
            'custom_entity_support' => array($this, 'block_custom_entity_support'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_javascripts($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    
    <script type=\"text/javascript\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlProyeccionAdmin/expl_examenes.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlProyeccionAdmin/expl_tiempo_sala_medico.js"), "html", null, true);
        echo "\" ></script>

    <script type=\"text/javascript\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlProyeccionAdmin/expl_form_config.js"), "html", null, true);
        echo "\" ></script>
    
    <script type=\"text/javascript\" src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_valor_campo_compuesto.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 15
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_funcionesClienteServidor.js.twig")->display($context);
        // line 16
        echo "    
    ";
        // line 17
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_bootstrapValidator.js.twig")->display($context);
    }

    // line 20
    public function block_form($context, array $blocks = array())
    {
        // line 21
        echo "    ";
        $context["expl_vars"] = array("simagd_title" => "FORMULARIO PARA REGISTRAR UNA EXPLORACIÓN IMAGENOLÓGICA", "simagd_message" => "Llene este formulario para agregar una nueva proyección al catálogo de Imagenología");
        // line 24
        echo "    ";
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_cabecera.html.twig")->display(array_merge($context, (isset($context["expl_vars"]) ? $context["expl_vars"] : $this->getContext($context, "expl_vars"))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 25
        echo "    
    ";
        // line 26
        $this->displayBlock("parentForm", $context, $blocks);
        echo "
";
    }

    // line 30
    public function block_custom_entity_support($context, array $blocks = array())
    {
        // line 31
        echo "    <div id=\"custom-entity-content-body\">
        ";
        // line 32
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_modal_support.html.twig")->display(array_merge($context, array("examenInfo" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idExamenServicioDiagnostico"))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 34
        echo "    </div>
";
    }

    // line 37
    public function block_formactions($context, array $blocks = array())
    {
        // line 38
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 39
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 40
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 41
                echo "                <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 43
                echo "                <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 45
            echo "        ";
        } else {
            // line 46
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 47
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 49
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 52
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 53
                echo "                <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>

                ";
                // line 55
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                    // line 56
                    echo "                    <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> Guardar</button>
                ";
                }
                // line 58
                echo "
                ";
                // line 59
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 60
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    <a class=\"btn btn-danger\" href=\"";
                    // line 61
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 63
                echo "
                ";
                // line 64
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 65
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 67
                echo "            ";
            } else {
                // line 68
                echo "                ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT"), "method"))) {
                    // line 69
                    echo "                    <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>
                ";
                }
                // line 71
                echo "                ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                    // line 72
                    echo "                    <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_create_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> Guardar</button>
                ";
                }
                // line 74
                echo "                <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_create\"><i class=\"fa fa-plus-circle\"></i> Guardar</button>
            ";
            }
            // line 76
            echo "        ";
        }
        // line 77
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  489 => 276,  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 270,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 278,  564 => 361,  561 => 235,  456 => 238,  431 => 185,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 151,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 194,  445 => 193,  419 => 218,  454 => 237,  371 => 186,  651 => 437,  483 => 245,  404 => 186,  517 => 285,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 105,  622 => 204,  531 => 224,  498 => 231,  468 => 236,  458 => 267,  401 => 163,  369 => 185,  356 => 198,  340 => 91,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 286,  450 => 186,  408 => 182,  363 => 199,  359 => 100,  348 => 195,  345 => 163,  336 => 138,  316 => 132,  307 => 79,  261 => 132,  266 => 117,  542 => 230,  538 => 228,  527 => 289,  509 => 353,  499 => 248,  493 => 155,  479 => 205,  473 => 271,  414 => 180,  406 => 237,  280 => 117,  223 => 139,  585 => 224,  551 => 356,  546 => 308,  506 => 237,  503 => 252,  488 => 242,  485 => 268,  478 => 218,  475 => 243,  471 => 204,  448 => 192,  386 => 169,  378 => 178,  375 => 177,  306 => 129,  291 => 127,  286 => 143,  392 => 110,  332 => 171,  318 => 145,  276 => 120,  190 => 80,  12 => 36,  195 => 87,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 243,  496 => 208,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 197,  416 => 166,  395 => 220,  391 => 182,  382 => 195,  372 => 145,  364 => 102,  353 => 197,  335 => 128,  333 => 137,  297 => 132,  292 => 146,  205 => 101,  200 => 97,  184 => 75,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 213,  519 => 194,  505 => 281,  502 => 280,  477 => 273,  472 => 242,  465 => 201,  463 => 269,  446 => 207,  443 => 234,  429 => 241,  425 => 243,  410 => 190,  397 => 112,  394 => 168,  389 => 109,  357 => 188,  342 => 145,  334 => 139,  330 => 87,  328 => 177,  290 => 130,  287 => 119,  263 => 116,  255 => 101,  245 => 122,  194 => 68,  76 => 54,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 249,  481 => 208,  476 => 239,  467 => 240,  451 => 236,  424 => 198,  418 => 183,  412 => 240,  399 => 113,  396 => 167,  390 => 218,  388 => 181,  383 => 147,  377 => 169,  373 => 159,  370 => 164,  367 => 201,  352 => 160,  349 => 258,  346 => 94,  329 => 136,  326 => 135,  313 => 142,  303 => 128,  300 => 121,  234 => 115,  218 => 105,  207 => 80,  178 => 63,  321 => 134,  295 => 122,  274 => 138,  242 => 121,  236 => 119,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 293,  536 => 227,  529 => 290,  524 => 173,  516 => 143,  510 => 283,  504 => 210,  500 => 251,  490 => 248,  486 => 246,  482 => 251,  470 => 241,  464 => 180,  459 => 239,  452 => 209,  434 => 201,  421 => 184,  417 => 242,  385 => 190,  361 => 173,  344 => 178,  339 => 248,  324 => 85,  310 => 156,  302 => 74,  296 => 148,  282 => 180,  259 => 115,  244 => 159,  231 => 143,  226 => 90,  114 => 64,  104 => 34,  288 => 122,  284 => 142,  279 => 140,  275 => 64,  256 => 114,  250 => 107,  237 => 105,  232 => 98,  222 => 94,  215 => 77,  191 => 67,  153 => 84,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 292,  532 => 270,  528 => 270,  525 => 224,  523 => 287,  518 => 221,  514 => 284,  511 => 242,  508 => 282,  501 => 313,  495 => 260,  491 => 255,  487 => 224,  460 => 243,  455 => 241,  449 => 208,  442 => 249,  439 => 248,  436 => 202,  433 => 246,  426 => 238,  420 => 194,  415 => 241,  411 => 212,  405 => 207,  403 => 117,  400 => 185,  380 => 179,  366 => 184,  354 => 167,  331 => 138,  325 => 149,  320 => 154,  317 => 159,  311 => 127,  308 => 135,  304 => 153,  272 => 124,  267 => 114,  249 => 112,  216 => 92,  155 => 55,  152 => 63,  146 => 63,  126 => 43,  181 => 64,  161 => 58,  110 => 48,  188 => 68,  186 => 71,  170 => 73,  150 => 51,  124 => 44,  358 => 172,  351 => 196,  347 => 167,  343 => 140,  338 => 159,  327 => 126,  323 => 134,  319 => 133,  315 => 124,  301 => 182,  299 => 127,  293 => 125,  289 => 124,  281 => 141,  277 => 119,  271 => 137,  265 => 113,  262 => 112,  260 => 111,  257 => 148,  251 => 107,  248 => 126,  239 => 94,  228 => 115,  225 => 114,  213 => 95,  211 => 89,  197 => 69,  174 => 81,  148 => 52,  134 => 50,  127 => 96,  20 => 2,  53 => 18,  270 => 108,  253 => 124,  233 => 51,  212 => 76,  210 => 101,  206 => 92,  202 => 90,  198 => 71,  192 => 86,  185 => 67,  180 => 91,  175 => 73,  172 => 87,  167 => 84,  165 => 69,  160 => 60,  137 => 56,  113 => 47,  100 => 39,  90 => 56,  81 => 25,  129 => 47,  84 => 37,  77 => 29,  34 => 6,  118 => 50,  97 => 32,  70 => 26,  65 => 25,  58 => 16,  23 => 3,  480 => 301,  474 => 204,  469 => 203,  461 => 268,  457 => 199,  453 => 169,  444 => 236,  440 => 233,  437 => 231,  435 => 246,  430 => 245,  427 => 244,  423 => 206,  413 => 119,  409 => 224,  407 => 171,  402 => 204,  398 => 221,  393 => 219,  387 => 218,  384 => 215,  381 => 188,  379 => 106,  374 => 187,  368 => 144,  365 => 154,  362 => 101,  360 => 191,  355 => 98,  341 => 162,  337 => 174,  322 => 233,  314 => 149,  312 => 151,  309 => 130,  305 => 217,  298 => 130,  294 => 152,  285 => 124,  283 => 122,  278 => 108,  268 => 183,  264 => 150,  258 => 138,  252 => 98,  247 => 163,  241 => 107,  229 => 91,  220 => 98,  214 => 92,  177 => 90,  169 => 66,  140 => 52,  132 => 45,  128 => 54,  107 => 67,  61 => 16,  273 => 117,  269 => 118,  254 => 109,  243 => 116,  240 => 121,  238 => 100,  235 => 144,  230 => 102,  227 => 110,  224 => 109,  221 => 87,  219 => 80,  217 => 138,  208 => 74,  204 => 72,  179 => 80,  159 => 103,  143 => 122,  135 => 46,  119 => 44,  102 => 66,  71 => 21,  67 => 25,  63 => 29,  59 => 15,  38 => 11,  94 => 31,  89 => 29,  85 => 26,  75 => 23,  68 => 20,  56 => 19,  201 => 71,  196 => 97,  183 => 65,  171 => 61,  166 => 60,  163 => 64,  158 => 65,  156 => 58,  151 => 53,  142 => 49,  138 => 47,  136 => 46,  121 => 45,  117 => 40,  105 => 41,  91 => 30,  62 => 15,  49 => 11,  28 => 7,  26 => 6,  87 => 39,  31 => 5,  25 => 5,  21 => 6,  24 => 4,  19 => 2,  93 => 35,  88 => 34,  78 => 22,  46 => 24,  44 => 9,  27 => 5,  79 => 54,  72 => 34,  69 => 27,  47 => 15,  40 => 8,  37 => 9,  22 => 3,  246 => 111,  157 => 56,  145 => 55,  139 => 49,  131 => 44,  123 => 51,  120 => 41,  115 => 39,  111 => 38,  108 => 46,  101 => 34,  98 => 31,  96 => 41,  83 => 39,  74 => 24,  66 => 16,  55 => 15,  52 => 17,  50 => 17,  43 => 14,  41 => 13,  35 => 8,  32 => 13,  29 => 4,  209 => 93,  203 => 93,  199 => 89,  193 => 77,  189 => 84,  187 => 76,  182 => 77,  176 => 62,  173 => 74,  168 => 62,  164 => 59,  162 => 68,  154 => 102,  149 => 62,  147 => 50,  144 => 99,  141 => 58,  133 => 55,  130 => 56,  125 => 54,  122 => 95,  116 => 43,  112 => 38,  109 => 37,  106 => 45,  103 => 39,  99 => 37,  95 => 31,  92 => 27,  86 => 28,  82 => 25,  80 => 25,  73 => 26,  64 => 17,  60 => 29,  57 => 31,  54 => 13,  51 => 23,  48 => 12,  45 => 15,  42 => 27,  39 => 12,  36 => 6,  33 => 7,  30 => 5,);
    }
}
