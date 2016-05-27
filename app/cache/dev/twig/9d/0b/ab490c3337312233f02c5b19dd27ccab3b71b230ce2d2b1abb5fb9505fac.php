<?php

/* MinsalSimagdBundle:ImgCtlMotorBdAdmin:mtrBd_edit.html.twig */
class __TwigTemplate_9d0bab490c3337312233f02c5b19dd27ccab3b71b230ce2d2b1abb5fb9505fac extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_edit.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'form' => array($this, 'block_form'),
            'sonata_page_content_header' => array($this, 'block_sonata_page_content_header'),
            'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
            'tab_menu_navbar_header' => array($this, 'block_tab_menu_navbar_header'),
            'simagd_info_support' => array($this, 'block_simagd_info_support'),
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
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlMotorBdAdmin/mtrBd_form_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 10
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlMotorBdAdmin:mtrBd_bootstrapValidator.js.twig")->display($context);
    }

    // line 13
    public function block_form($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        $context["mtrBd_vars"] = array("simagd_title" => "FORMULARIO PARA AGREGAR MOTOR DE BASE DE DATOS", "simagd_message" => "Llene este formulario para agregar un nuevo motor de BD al catálogo");
        // line 17
        echo "    ";
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_cabecera.html.twig")->display(array_merge($context, (isset($context["mtrBd_vars"]) ? $context["mtrBd_vars"] : $this->getContext($context, "mtrBd_vars"))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 18
        echo "    
    ";
        // line 19
        $this->displayBlock("parentForm", $context, $blocks);
        echo "
";
    }

    // line 22
    public function block_sonata_page_content_header($context, array $blocks = array())
    {
        // line 23
        echo "    ";
        $this->displayBlock('sonata_page_content_nav', $context, $blocks);
        // line 49
        echo "
";
    }

    // line 23
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 24
        echo "        ";
        if (((!twig_test_empty((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu")))) || (!twig_test_empty((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")))))) {
            // line 25
            echo "            <nav class=\"navbar navbar-default\" role=\"navigation\">
                ";
            // line 26
            $this->displayBlock('tab_menu_navbar_header', $context, $blocks);
            // line 29
            echo "                <div class=\"container-fluid\">
                    <div class=\"navbar-left\">
                        ";
            // line 31
            if ((!twig_test_empty((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"))))) {
                // line 32
                echo "                            ";
                echo (isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"));
                echo "
                        ";
            }
            // line 34
            echo "                    </div>

                    ";
            // line 36
            if ((!twig_test_empty(trim(strtr((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")), array("<li>" => "", "</li>" => "")))))) {
                // line 37
                echo "                        <ul class=\"nav navbar-nav navbar-right ul-simagd-right\">
                            <li class=\"dropdown sonata-actions\">
                                <ul class=\"list-inline\" role=\"menu\">
                                    ";
                // line 40
                echo (isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions"));
                echo "
                                </ul>
                            </li>
                        </ul>
                    ";
            }
            // line 45
            echo "                </div>
            </nav>
        ";
        }
        // line 48
        echo "    ";
    }

    // line 26
    public function block_tab_menu_navbar_header($context, array $blocks = array())
    {
        // line 27
        echo "                    ";
        $this->displayParentBlock("tab_menu_navbar_header", $context, $blocks);
        echo "
                ";
    }

    // line 53
    public function block_simagd_info_support($context, array $blocks = array())
    {
        // line 54
        echo "    ";
    }

    // line 57
    public function block_formactions($context, array $blocks = array())
    {
        // line 58
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 59
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 60
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 61
                echo "                <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 63
                echo "                <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 65
            echo "        ";
        } else {
            // line 66
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 67
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 69
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 72
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 73
                echo "                <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>

                ";
                // line 75
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                    // line 76
                    echo "                    <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> Guardar</button>
                ";
                }
                // line 78
                echo "
                ";
                // line 79
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 80
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    <a class=\"btn btn-danger\" href=\"";
                    // line 81
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 83
                echo "
                ";
                // line 84
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 85
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 87
                echo "            ";
            } else {
                // line 88
                echo "                ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT"), "method"))) {
                    // line 89
                    echo "                    <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>
                ";
                }
                // line 91
                echo "                ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                    // line 92
                    echo "                    <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_create_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> Guardar</button>
                ";
                }
                // line 94
                echo "                <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_create\"><i class=\"fa fa-plus-circle\"></i> Guardar</button>
            ";
            }
            // line 96
            echo "        ";
        }
        // line 97
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlMotorBdAdmin:mtrBd_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  634 => 356,  628 => 354,  601 => 346,  545 => 304,  350 => 172,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 321,  778 => 315,  772 => 312,  760 => 307,  755 => 304,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 352,  596 => 231,  578 => 270,  534 => 200,  507 => 184,  447 => 236,  445 => 175,  419 => 198,  454 => 160,  371 => 168,  651 => 437,  483 => 258,  404 => 193,  517 => 283,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 193,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 204,  401 => 144,  369 => 129,  356 => 212,  340 => 156,  874 => 781,  854 => 325,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 318,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 309,  763 => 308,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 303,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 436,  642 => 264,  639 => 263,  637 => 262,  604 => 347,  588 => 239,  573 => 321,  559 => 183,  547 => 205,  520 => 355,  450 => 173,  408 => 213,  363 => 216,  359 => 180,  348 => 156,  345 => 124,  336 => 192,  316 => 154,  307 => 124,  261 => 85,  266 => 83,  542 => 303,  538 => 217,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 272,  473 => 165,  414 => 216,  406 => 194,  280 => 126,  223 => 83,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 261,  485 => 175,  478 => 165,  475 => 164,  471 => 211,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 146,  291 => 165,  286 => 140,  392 => 150,  332 => 164,  318 => 156,  276 => 160,  190 => 92,  12 => 36,  195 => 74,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 357,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 348,  894 => 383,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 389,  730 => 219,  727 => 218,  712 => 214,  709 => 296,  706 => 295,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 351,  613 => 350,  610 => 349,  608 => 197,  605 => 196,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 224,  533 => 203,  530 => 150,  513 => 79,  496 => 280,  441 => 150,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 173,  395 => 118,  391 => 109,  382 => 195,  372 => 89,  364 => 166,  353 => 175,  335 => 154,  333 => 151,  297 => 169,  292 => 134,  205 => 81,  200 => 75,  184 => 73,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 300,  946 => 296,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 320,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 313,  754 => 208,  748 => 205,  745 => 392,  742 => 391,  737 => 199,  735 => 220,  732 => 197,  728 => 344,  726 => 341,  723 => 340,  719 => 215,  717 => 186,  714 => 185,  704 => 294,  701 => 180,  699 => 179,  696 => 291,  690 => 285,  687 => 173,  681 => 205,  673 => 281,  671 => 280,  668 => 279,  663 => 277,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 357,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 226,  587 => 388,  584 => 320,  576 => 324,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 305,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 352,  502 => 87,  477 => 82,  472 => 132,  465 => 209,  463 => 208,  446 => 244,  443 => 142,  429 => 219,  425 => 202,  410 => 167,  397 => 161,  394 => 54,  389 => 128,  357 => 186,  342 => 154,  334 => 171,  330 => 158,  328 => 142,  290 => 137,  287 => 163,  263 => 115,  255 => 122,  245 => 119,  194 => 77,  76 => 33,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 373,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 296,  888 => 270,  882 => 333,  873 => 267,  868 => 282,  864 => 372,  860 => 327,  856 => 279,  852 => 324,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 347,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 525,  606 => 348,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 329,  580 => 387,  572 => 218,  568 => 227,  562 => 313,  556 => 307,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 183,  492 => 341,  481 => 218,  476 => 271,  467 => 156,  451 => 159,  424 => 115,  418 => 227,  412 => 147,  399 => 64,  396 => 206,  390 => 203,  388 => 202,  383 => 200,  377 => 104,  373 => 46,  370 => 147,  367 => 167,  352 => 157,  349 => 161,  346 => 155,  329 => 111,  326 => 156,  313 => 136,  303 => 145,  300 => 124,  234 => 88,  218 => 88,  207 => 80,  178 => 71,  321 => 119,  295 => 130,  274 => 131,  242 => 89,  236 => 87,  692 => 175,  683 => 170,  678 => 204,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 150,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 224,  579 => 236,  577 => 318,  575 => 252,  569 => 233,  565 => 314,  548 => 207,  540 => 302,  536 => 358,  529 => 213,  524 => 196,  516 => 143,  510 => 185,  504 => 183,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 243,  452 => 145,  434 => 228,  421 => 219,  417 => 159,  385 => 201,  361 => 165,  344 => 157,  339 => 167,  324 => 123,  310 => 113,  302 => 145,  296 => 136,  282 => 106,  259 => 81,  244 => 116,  231 => 117,  226 => 84,  114 => 46,  104 => 50,  288 => 141,  284 => 162,  279 => 129,  275 => 99,  256 => 147,  250 => 122,  237 => 71,  232 => 115,  222 => 57,  215 => 130,  191 => 75,  153 => 86,  563 => 223,  560 => 222,  558 => 186,  555 => 185,  553 => 211,  549 => 206,  543 => 179,  537 => 301,  532 => 199,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 278,  508 => 275,  501 => 161,  495 => 265,  491 => 157,  487 => 156,  460 => 207,  455 => 203,  449 => 247,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 170,  420 => 123,  415 => 197,  411 => 120,  405 => 118,  403 => 160,  400 => 208,  380 => 199,  366 => 146,  354 => 185,  331 => 133,  325 => 119,  320 => 92,  317 => 138,  311 => 152,  308 => 151,  304 => 140,  272 => 127,  267 => 129,  249 => 92,  216 => 81,  155 => 63,  152 => 75,  146 => 55,  126 => 43,  181 => 72,  161 => 66,  110 => 66,  188 => 74,  186 => 108,  170 => 98,  150 => 54,  124 => 56,  358 => 164,  351 => 183,  347 => 206,  343 => 146,  338 => 144,  327 => 121,  323 => 114,  319 => 155,  315 => 183,  301 => 139,  299 => 131,  293 => 135,  289 => 127,  281 => 125,  277 => 128,  271 => 94,  265 => 125,  262 => 92,  260 => 97,  257 => 96,  251 => 143,  248 => 71,  239 => 88,  228 => 85,  225 => 92,  213 => 107,  211 => 80,  197 => 79,  174 => 70,  148 => 62,  134 => 100,  127 => 45,  20 => 2,  53 => 23,  270 => 117,  253 => 94,  233 => 133,  212 => 103,  210 => 116,  206 => 78,  202 => 76,  198 => 75,  192 => 102,  185 => 72,  180 => 66,  175 => 98,  172 => 96,  167 => 156,  165 => 61,  160 => 59,  137 => 26,  113 => 36,  100 => 41,  90 => 31,  81 => 49,  129 => 53,  84 => 31,  77 => 28,  34 => 5,  118 => 48,  97 => 29,  70 => 25,  65 => 28,  58 => 17,  23 => 3,  480 => 134,  474 => 253,  469 => 150,  461 => 157,  457 => 161,  453 => 194,  444 => 210,  440 => 172,  437 => 171,  435 => 167,  430 => 172,  427 => 171,  423 => 169,  413 => 196,  409 => 195,  407 => 238,  402 => 65,  398 => 157,  393 => 156,  387 => 182,  384 => 152,  381 => 150,  379 => 194,  374 => 192,  368 => 190,  365 => 165,  362 => 164,  360 => 163,  355 => 161,  341 => 123,  337 => 162,  322 => 146,  314 => 153,  312 => 125,  309 => 135,  305 => 134,  298 => 143,  294 => 145,  285 => 126,  283 => 135,  278 => 110,  268 => 126,  264 => 104,  258 => 147,  252 => 121,  247 => 109,  241 => 74,  229 => 102,  220 => 124,  214 => 86,  177 => 65,  169 => 69,  140 => 27,  132 => 54,  128 => 45,  107 => 46,  61 => 21,  273 => 130,  269 => 127,  254 => 122,  243 => 137,  240 => 117,  238 => 117,  235 => 116,  230 => 111,  227 => 130,  224 => 108,  221 => 107,  219 => 129,  217 => 87,  208 => 104,  204 => 116,  179 => 86,  159 => 91,  143 => 81,  135 => 46,  119 => 38,  102 => 42,  71 => 26,  67 => 24,  63 => 22,  59 => 32,  38 => 9,  94 => 38,  89 => 24,  85 => 31,  75 => 22,  68 => 25,  56 => 15,  201 => 76,  196 => 73,  183 => 67,  171 => 63,  166 => 68,  163 => 80,  158 => 65,  156 => 86,  151 => 63,  142 => 70,  138 => 78,  136 => 56,  121 => 55,  117 => 86,  105 => 62,  91 => 34,  62 => 27,  49 => 16,  28 => 8,  26 => 7,  87 => 32,  31 => 6,  25 => 5,  21 => 2,  24 => 3,  19 => 2,  93 => 32,  88 => 34,  78 => 23,  46 => 15,  44 => 6,  27 => 7,  79 => 29,  72 => 26,  69 => 19,  47 => 18,  40 => 18,  37 => 6,  22 => 4,  246 => 91,  157 => 58,  145 => 108,  139 => 61,  131 => 59,  123 => 56,  120 => 40,  115 => 37,  111 => 37,  108 => 42,  101 => 31,  98 => 53,  96 => 43,  83 => 29,  74 => 27,  66 => 18,  55 => 14,  52 => 13,  50 => 17,  43 => 8,  41 => 13,  35 => 8,  32 => 9,  29 => 8,  209 => 79,  203 => 96,  199 => 120,  193 => 72,  189 => 70,  187 => 69,  182 => 92,  176 => 70,  173 => 69,  168 => 68,  164 => 67,  162 => 60,  154 => 57,  149 => 58,  147 => 53,  144 => 61,  141 => 60,  133 => 48,  130 => 46,  125 => 51,  122 => 50,  116 => 52,  112 => 51,  109 => 34,  106 => 44,  103 => 32,  99 => 44,  95 => 26,  92 => 25,  86 => 23,  82 => 30,  80 => 28,  73 => 26,  64 => 23,  60 => 12,  57 => 25,  54 => 9,  51 => 17,  48 => 10,  45 => 17,  42 => 14,  39 => 12,  36 => 7,  33 => 7,  30 => 7,);
    }
}
