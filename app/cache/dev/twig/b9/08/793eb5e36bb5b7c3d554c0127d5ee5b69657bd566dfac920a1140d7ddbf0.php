<?php

/* MinsalSimagdBundle::simagd_base_list.html.twig */
class __TwigTemplate_b908793eb5e36bb5b7c3d554c0127d5ee5b69657bd566dfac920a1140d7ddbf0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_page_content_header' => array($this, 'block_sonata_page_content_header'),
            'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
            'tab_menu_navbar_header' => array($this, 'block_tab_menu_navbar_header'),
            'simagd_form_navbar_brand_title' => array($this, 'block_simagd_form_navbar_brand_title'),
            'content' => array($this, 'block_content'),
            'notice' => array($this, 'block_notice'),
            'table_body' => array($this, 'block_table_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 7
        $context["_messageCurrentTemplate"] = "<i class=\"fa fa-th-list\"></i> Listado de registros";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 9
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    
    ";
        // line 13
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-styles.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-form-styles.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-table.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 19
        echo "    
    ";
        // line 22
        echo "    
    ";
        // line 25
        echo "    
    ";
        // line 28
        echo "    
    ";
        // line 31
        echo "    
    ";
        // line 34
        echo "    
    ";
        // line 36
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/toastmessage-plugin/src/main/resources/css/jquery.toastmessage.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 39
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/css/bootstrap-modal-bs3patch.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/css/bootstrap-modal.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
";
    }

    // line 43
    public function block_javascripts($context, array $blocks = array())
    {
        // line 44
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    ";
        // line 47
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/sonataadmin/vendor/select2/select2_locale_es.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 52
        echo "    
    ";
        // line 54
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/jquery-ui-1.11.2.custom/jquery-ui.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_highlight_error_ui.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 58
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/jquery-ui-timepicker-addon.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_datetimepicker_configuration.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 62
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_trim_datos.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_html5_novalidate.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_validate_number.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 69
        echo "    
    ";
        // line 71
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/toastmessage-plugin/src/main/javascript/jquery.toastmessage.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_generar_mensaje_toast.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 75
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/js/bootstrap-modalmanager.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/js/bootstrap-modal.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 79
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_list_view_config.js"), "html", null, true);
        echo "\" ></script>
";
    }

    // line 82
    public function block_sonata_page_content_header($context, array $blocks = array())
    {
        // line 83
        echo "    ";
        $this->displayBlock('sonata_page_content_nav', $context, $blocks);
        // line 121
        echo "
";
    }

    // line 83
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 85
        echo "            <nav class=\"navbar navbar-default\" role=\"navigation\">
                ";
        // line 86
        $this->displayBlock('tab_menu_navbar_header', $context, $blocks);
        // line 93
        echo "                <div class=\"container-fluid\">
                    <div class=\"navbar-left\">
                        ";
        // line 95
        if ((!twig_test_empty((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"))))) {
            // line 96
            echo "                            ";
            echo (isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"));
            echo "
                        ";
        }
        // line 98
        echo "                    </div>

                    ";
        // line 107
        echo "
                    ";
        // line 108
        if ((!twig_test_empty(trim(strtr((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")), array("<li>" => "", "</li>" => "")))))) {
            // line 109
            echo "                        <ul class=\"nav navbar-nav navbar-right ul-simagd-right\">
                            <li class=\"dropdown sonata-actions\">
                                <ul class=\"list-inline\" role=\"menu\">
                                    ";
            // line 112
            echo (isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions"));
            echo "
                                </ul>
                            </li>
                        </ul>
                    ";
        }
        // line 117
        echo "                </div>
            </nav>
";
        // line 120
        echo "    ";
    }

    // line 86
    public function block_tab_menu_navbar_header($context, array $blocks = array())
    {
        // line 87
        echo "                    <div class=\"navbar-header nav-simagd-right-list\">
                        ";
        // line 88
        $this->displayBlock('simagd_form_navbar_brand_title', $context, $blocks);
        // line 91
        echo "                    </div>
                ";
    }

    // line 88
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 89
        echo "                            <span class=\"navbar-brand\"><span class=\"label label-primary-v2\"> ";
        echo (isset($context["_messageCurrentTemplate"]) ? $context["_messageCurrentTemplate"] : $this->getContext($context, "_messageCurrentTemplate"));
        echo " </span></span>
                        ";
    }

    // line 124
    public function block_content($context, array $blocks = array())
    {
        // line 125
        echo "    
    ";
        // line 126
        $this->displayBlock('notice', $context, $blocks);
        // line 129
        echo "    
    ";
        // line 130
        $this->displayParentBlock("content", $context, $blocks);
        echo "
    
";
    }

    // line 126
    public function block_notice($context, array $blocks = array())
    {
        // line 127
        echo "        ";
        $this->env->loadTemplate("MinsalSimagdBundle::simagd_flash_notice.html.twig")->display($context);
        // line 128
        echo "    ";
    }

    // line 134
    public function block_table_body($context, array $blocks = array())
    {
        // line 135
        echo "    <tbody>
        ";
        // line 136
        $template = $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "outer_list_rows_list"), "method"));
        $template->display($context);
        // line 137
        echo "    </tbody>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle::simagd_base_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  517 => 291,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 840,  905 => 802,  880 => 784,  376 => 147,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 160,  401 => 144,  369 => 129,  356 => 127,  340 => 130,  874 => 781,  854 => 367,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 352,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 322,  763 => 321,  746 => 311,  740 => 307,  734 => 305,  731 => 304,  729 => 303,  721 => 301,  715 => 297,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 266,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 220,  520 => 210,  450 => 173,  408 => 156,  363 => 136,  359 => 182,  348 => 129,  345 => 124,  336 => 125,  316 => 116,  307 => 107,  261 => 85,  266 => 83,  542 => 218,  538 => 217,  527 => 173,  509 => 204,  499 => 157,  493 => 155,  479 => 272,  473 => 165,  414 => 158,  406 => 152,  280 => 126,  223 => 112,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 172,  485 => 195,  478 => 165,  475 => 164,  471 => 164,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 150,  291 => 121,  286 => 128,  392 => 150,  332 => 164,  318 => 156,  276 => 104,  190 => 81,  12 => 36,  195 => 86,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 864,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 850,  974 => 305,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 383,  890 => 381,  887 => 380,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 295,  706 => 294,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 332,  613 => 232,  610 => 329,  608 => 197,  605 => 196,  602 => 230,  593 => 323,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 79,  496 => 280,  441 => 156,  438 => 140,  432 => 166,  428 => 172,  422 => 150,  416 => 173,  395 => 118,  391 => 109,  382 => 199,  372 => 89,  364 => 137,  353 => 96,  335 => 120,  333 => 127,  297 => 103,  292 => 82,  205 => 96,  200 => 94,  184 => 121,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 330,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 293,  701 => 180,  699 => 179,  696 => 178,  690 => 285,  687 => 173,  681 => 205,  673 => 165,  671 => 277,  668 => 163,  663 => 160,  658 => 271,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 192,  587 => 321,  584 => 320,  576 => 115,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 310,  544 => 307,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 159,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 148,  446 => 244,  443 => 142,  429 => 230,  425 => 228,  410 => 224,  397 => 161,  394 => 54,  389 => 128,  357 => 37,  342 => 131,  334 => 26,  330 => 122,  328 => 125,  290 => 134,  287 => 99,  263 => 86,  255 => 89,  245 => 88,  194 => 55,  76 => 34,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 372,  860 => 280,  856 => 279,  852 => 278,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 255,  617 => 254,  612 => 526,  609 => 525,  606 => 209,  603 => 523,  600 => 522,  598 => 244,  595 => 193,  586 => 191,  582 => 190,  580 => 319,  572 => 218,  568 => 315,  562 => 313,  556 => 182,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 191,  492 => 278,  481 => 273,  476 => 271,  467 => 156,  451 => 155,  424 => 115,  418 => 227,  412 => 147,  399 => 64,  396 => 63,  390 => 139,  388 => 204,  383 => 135,  377 => 104,  373 => 46,  370 => 100,  367 => 102,  352 => 150,  349 => 139,  346 => 138,  329 => 111,  326 => 161,  313 => 126,  303 => 132,  300 => 112,  234 => 88,  218 => 109,  207 => 90,  178 => 82,  321 => 119,  295 => 11,  274 => 87,  242 => 87,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 268,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 328,  597 => 325,  590 => 322,  583 => 334,  579 => 236,  577 => 318,  575 => 252,  569 => 233,  565 => 314,  548 => 207,  540 => 99,  536 => 98,  529 => 213,  524 => 211,  516 => 143,  510 => 288,  504 => 285,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 177,  452 => 145,  434 => 256,  421 => 114,  417 => 159,  385 => 107,  361 => 183,  344 => 94,  339 => 167,  324 => 123,  310 => 113,  302 => 131,  296 => 136,  282 => 106,  259 => 81,  244 => 116,  231 => 117,  226 => 108,  114 => 54,  104 => 28,  288 => 107,  284 => 98,  279 => 96,  275 => 95,  256 => 74,  250 => 98,  237 => 71,  232 => 72,  222 => 63,  215 => 66,  191 => 54,  153 => 72,  563 => 188,  560 => 187,  558 => 186,  555 => 185,  553 => 184,  549 => 309,  543 => 179,  537 => 306,  532 => 303,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 143,  455 => 252,  449 => 247,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 226,  411 => 120,  405 => 118,  403 => 117,  400 => 162,  380 => 107,  366 => 186,  354 => 179,  331 => 126,  325 => 94,  320 => 92,  317 => 91,  311 => 112,  308 => 151,  304 => 85,  272 => 81,  267 => 88,  249 => 78,  216 => 108,  155 => 35,  152 => 49,  146 => 63,  126 => 43,  181 => 83,  161 => 75,  110 => 29,  188 => 73,  186 => 51,  170 => 72,  150 => 52,  124 => 58,  358 => 172,  351 => 102,  347 => 134,  343 => 127,  338 => 112,  327 => 121,  323 => 114,  319 => 121,  315 => 82,  301 => 129,  299 => 137,  293 => 135,  289 => 82,  281 => 112,  277 => 95,  271 => 94,  265 => 125,  262 => 124,  260 => 184,  257 => 56,  251 => 72,  248 => 71,  239 => 86,  228 => 103,  225 => 86,  213 => 107,  211 => 64,  197 => 93,  174 => 67,  148 => 69,  134 => 62,  127 => 16,  20 => 2,  53 => 18,  270 => 129,  253 => 100,  233 => 110,  212 => 81,  210 => 63,  206 => 101,  202 => 86,  198 => 75,  192 => 85,  185 => 80,  180 => 72,  175 => 76,  172 => 74,  167 => 156,  165 => 69,  160 => 57,  137 => 44,  113 => 48,  100 => 42,  90 => 40,  81 => 33,  129 => 59,  84 => 35,  77 => 25,  34 => 8,  118 => 46,  97 => 37,  70 => 28,  65 => 12,  58 => 20,  23 => 3,  480 => 134,  474 => 150,  469 => 150,  461 => 157,  457 => 153,  453 => 174,  444 => 171,  440 => 148,  437 => 118,  435 => 167,  430 => 153,  427 => 65,  423 => 63,  413 => 172,  409 => 153,  407 => 238,  402 => 65,  398 => 115,  393 => 112,  387 => 110,  384 => 151,  381 => 150,  379 => 196,  374 => 140,  368 => 140,  365 => 139,  362 => 97,  360 => 104,  355 => 161,  341 => 123,  337 => 129,  322 => 122,  314 => 113,  312 => 149,  309 => 113,  305 => 111,  298 => 128,  294 => 145,  285 => 79,  283 => 127,  278 => 110,  268 => 126,  264 => 104,  258 => 138,  252 => 88,  247 => 91,  241 => 74,  229 => 86,  220 => 88,  214 => 86,  177 => 71,  169 => 67,  140 => 47,  132 => 61,  128 => 44,  107 => 41,  61 => 19,  273 => 130,  269 => 91,  254 => 122,  243 => 76,  240 => 72,  238 => 84,  235 => 120,  230 => 87,  227 => 67,  224 => 66,  221 => 82,  219 => 66,  217 => 87,  208 => 80,  204 => 89,  179 => 70,  159 => 151,  143 => 64,  135 => 42,  119 => 55,  102 => 54,  71 => 33,  67 => 25,  63 => 23,  59 => 20,  38 => 9,  94 => 36,  89 => 33,  85 => 39,  75 => 29,  68 => 59,  56 => 15,  201 => 95,  196 => 84,  183 => 73,  171 => 79,  166 => 76,  163 => 63,  158 => 81,  156 => 72,  151 => 71,  142 => 30,  138 => 48,  136 => 47,  121 => 57,  117 => 81,  105 => 47,  91 => 37,  62 => 6,  49 => 13,  28 => 5,  26 => 13,  87 => 32,  31 => 7,  25 => 10,  21 => 1,  24 => 6,  19 => 2,  93 => 35,  88 => 34,  78 => 30,  46 => 24,  44 => 11,  27 => 7,  79 => 36,  72 => 27,  69 => 25,  47 => 13,  40 => 11,  37 => 14,  22 => 3,  246 => 122,  157 => 58,  145 => 46,  139 => 63,  131 => 45,  123 => 42,  120 => 64,  115 => 12,  111 => 52,  108 => 43,  101 => 28,  98 => 37,  96 => 43,  83 => 30,  74 => 16,  66 => 19,  55 => 16,  52 => 14,  50 => 16,  43 => 6,  41 => 10,  35 => 8,  32 => 6,  29 => 4,  209 => 98,  203 => 96,  199 => 85,  193 => 75,  189 => 83,  187 => 48,  182 => 90,  176 => 85,  173 => 69,  168 => 84,  164 => 64,  162 => 152,  154 => 79,  149 => 78,  147 => 51,  144 => 46,  141 => 49,  133 => 46,  130 => 42,  125 => 46,  122 => 52,  116 => 49,  112 => 45,  109 => 40,  106 => 41,  103 => 40,  99 => 44,  95 => 39,  92 => 34,  86 => 28,  82 => 31,  80 => 29,  73 => 31,  64 => 22,  60 => 16,  57 => 20,  54 => 18,  51 => 11,  48 => 2,  45 => 12,  42 => 15,  39 => 9,  36 => 8,  33 => 7,  30 => 6,);
    }
}
