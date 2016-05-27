<?php

/* MinsalSimagdBundle:ImgCtlMaterialAdmin:mtrl_edit.html.twig */
class __TwigTemplate_639b44d172e247e72991c63b86e362db9051e8306c85dd9a4ef992455beabbdb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_edit.html.twig");

        $this->blocks = array(
            'form' => array($this, 'block_form'),
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

    // line 20
    public function block_form($context, array $blocks = array())
    {
        // line 21
        echo "    ";
        $context["mtrl_vars"] = array("simagd_title" => "FORMULARIO PARA REGISTRAR MATERIALES DE USO MÉDICO", "simagd_message" => "Llene este formulario para agregar un nuevo material al catálogo general");
        // line 24
        echo "    ";
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_cabecera.html.twig")->display(array_merge($context, (isset($context["mtrl_vars"]) ? $context["mtrl_vars"] : $this->getContext($context, "mtrl_vars"))));
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
        return "MinsalSimagdBundle:ImgCtlMaterialAdmin:mtrl_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  454 => 160,  371 => 155,  651 => 437,  483 => 333,  404 => 257,  517 => 291,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 840,  905 => 802,  880 => 784,  376 => 158,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 309,  401 => 144,  369 => 129,  356 => 127,  340 => 130,  874 => 781,  854 => 367,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 352,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 322,  763 => 321,  746 => 311,  740 => 307,  734 => 305,  731 => 304,  729 => 303,  721 => 301,  715 => 297,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 436,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 220,  520 => 355,  450 => 173,  408 => 156,  363 => 148,  359 => 182,  348 => 129,  345 => 124,  336 => 192,  316 => 116,  307 => 107,  261 => 85,  266 => 83,  542 => 218,  538 => 217,  527 => 173,  509 => 353,  499 => 157,  493 => 155,  479 => 272,  473 => 165,  414 => 158,  406 => 152,  280 => 126,  223 => 109,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 172,  485 => 195,  478 => 165,  475 => 164,  471 => 164,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 150,  291 => 121,  286 => 128,  392 => 150,  332 => 164,  318 => 156,  276 => 104,  190 => 81,  12 => 36,  195 => 86,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 864,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 850,  974 => 305,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 383,  890 => 381,  887 => 380,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 295,  706 => 294,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 332,  613 => 232,  610 => 407,  608 => 197,  605 => 196,  602 => 230,  593 => 323,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 79,  496 => 280,  441 => 150,  438 => 149,  432 => 166,  428 => 172,  422 => 150,  416 => 173,  395 => 118,  391 => 109,  382 => 236,  372 => 89,  364 => 137,  353 => 96,  335 => 120,  333 => 127,  297 => 122,  292 => 82,  205 => 96,  200 => 94,  184 => 121,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 330,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 293,  701 => 180,  699 => 179,  696 => 178,  690 => 285,  687 => 173,  681 => 205,  673 => 165,  671 => 277,  668 => 163,  663 => 160,  658 => 271,  654 => 155,  649 => 153,  643 => 149,  640 => 434,  636 => 145,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 192,  587 => 388,  584 => 320,  576 => 115,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 361,  544 => 307,  541 => 359,  539 => 96,  522 => 145,  519 => 200,  505 => 352,  502 => 87,  477 => 82,  472 => 132,  465 => 164,  463 => 148,  446 => 244,  443 => 142,  429 => 230,  425 => 228,  410 => 167,  397 => 161,  394 => 54,  389 => 128,  357 => 212,  342 => 131,  334 => 142,  330 => 122,  328 => 125,  290 => 148,  287 => 99,  263 => 86,  255 => 98,  245 => 92,  194 => 73,  76 => 34,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 372,  860 => 280,  856 => 279,  852 => 278,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 433,  621 => 255,  617 => 254,  612 => 526,  609 => 525,  606 => 209,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 191,  582 => 190,  580 => 387,  572 => 218,  568 => 315,  562 => 313,  556 => 182,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 191,  492 => 341,  481 => 273,  476 => 271,  467 => 156,  451 => 159,  424 => 115,  418 => 227,  412 => 147,  399 => 64,  396 => 166,  390 => 139,  388 => 204,  383 => 135,  377 => 104,  373 => 46,  370 => 100,  367 => 102,  352 => 150,  349 => 139,  346 => 138,  329 => 111,  326 => 161,  313 => 126,  303 => 132,  300 => 124,  234 => 88,  218 => 109,  207 => 83,  178 => 93,  321 => 119,  295 => 117,  274 => 87,  242 => 91,  236 => 112,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 268,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 334,  579 => 236,  577 => 318,  575 => 252,  569 => 233,  565 => 314,  548 => 207,  540 => 99,  536 => 358,  529 => 213,  524 => 211,  516 => 143,  510 => 288,  504 => 285,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 162,  452 => 145,  434 => 256,  421 => 114,  417 => 159,  385 => 107,  361 => 183,  344 => 94,  339 => 167,  324 => 123,  310 => 113,  302 => 131,  296 => 136,  282 => 106,  259 => 81,  244 => 116,  231 => 117,  226 => 108,  114 => 61,  104 => 58,  288 => 107,  284 => 98,  279 => 96,  275 => 99,  256 => 74,  250 => 96,  237 => 71,  232 => 58,  222 => 57,  215 => 107,  191 => 54,  153 => 74,  563 => 188,  560 => 187,  558 => 186,  555 => 185,  553 => 184,  549 => 309,  543 => 179,  537 => 306,  532 => 303,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 143,  455 => 252,  449 => 247,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 226,  411 => 120,  405 => 118,  403 => 117,  400 => 162,  380 => 107,  366 => 186,  354 => 179,  331 => 141,  325 => 119,  320 => 92,  317 => 91,  311 => 168,  308 => 151,  304 => 85,  272 => 98,  267 => 88,  249 => 115,  216 => 55,  155 => 76,  152 => 52,  146 => 63,  126 => 65,  181 => 83,  161 => 75,  110 => 29,  188 => 101,  186 => 51,  170 => 72,  150 => 52,  124 => 64,  358 => 172,  351 => 102,  347 => 134,  343 => 146,  338 => 144,  327 => 121,  323 => 114,  319 => 117,  315 => 82,  301 => 129,  299 => 137,  293 => 135,  289 => 82,  281 => 112,  277 => 95,  271 => 94,  265 => 93,  262 => 92,  260 => 184,  257 => 138,  251 => 72,  248 => 71,  239 => 90,  228 => 103,  225 => 86,  213 => 107,  211 => 105,  197 => 103,  174 => 91,  148 => 71,  134 => 67,  127 => 16,  20 => 2,  53 => 16,  270 => 129,  253 => 100,  233 => 110,  212 => 86,  210 => 63,  206 => 101,  202 => 104,  198 => 75,  192 => 102,  185 => 80,  180 => 72,  175 => 64,  172 => 74,  167 => 156,  165 => 69,  160 => 52,  137 => 68,  113 => 55,  100 => 56,  90 => 31,  81 => 47,  129 => 59,  84 => 29,  77 => 22,  34 => 8,  118 => 46,  97 => 30,  70 => 14,  65 => 16,  58 => 39,  23 => 5,  480 => 134,  474 => 150,  469 => 150,  461 => 157,  457 => 161,  453 => 174,  444 => 151,  440 => 148,  437 => 289,  435 => 167,  430 => 172,  427 => 171,  423 => 63,  413 => 172,  409 => 153,  407 => 238,  402 => 65,  398 => 115,  393 => 159,  387 => 110,  384 => 151,  381 => 150,  379 => 196,  374 => 140,  368 => 154,  365 => 149,  362 => 97,  360 => 147,  355 => 161,  341 => 123,  337 => 129,  322 => 118,  314 => 136,  312 => 149,  309 => 113,  305 => 128,  298 => 128,  294 => 145,  285 => 79,  283 => 127,  278 => 110,  268 => 94,  264 => 104,  258 => 138,  252 => 88,  247 => 95,  241 => 74,  229 => 57,  220 => 88,  214 => 86,  177 => 65,  169 => 55,  140 => 69,  132 => 61,  128 => 43,  107 => 59,  61 => 19,  273 => 130,  269 => 128,  254 => 122,  243 => 76,  240 => 72,  238 => 84,  235 => 120,  230 => 111,  227 => 67,  224 => 60,  221 => 82,  219 => 56,  217 => 87,  208 => 80,  204 => 89,  179 => 70,  159 => 151,  143 => 48,  135 => 42,  119 => 39,  102 => 54,  71 => 19,  67 => 25,  63 => 41,  59 => 7,  38 => 4,  94 => 53,  89 => 33,  85 => 49,  75 => 45,  68 => 59,  56 => 12,  201 => 95,  196 => 84,  183 => 67,  171 => 62,  166 => 54,  163 => 53,  158 => 77,  156 => 75,  151 => 74,  142 => 30,  138 => 47,  136 => 47,  121 => 63,  117 => 52,  105 => 47,  91 => 52,  62 => 16,  49 => 13,  28 => 8,  26 => 7,  87 => 26,  31 => 6,  25 => 10,  21 => 1,  24 => 4,  19 => 2,  93 => 35,  88 => 34,  78 => 46,  46 => 26,  44 => 7,  27 => 5,  79 => 36,  72 => 19,  69 => 43,  47 => 12,  40 => 2,  37 => 5,  22 => 3,  246 => 122,  157 => 58,  145 => 46,  139 => 63,  131 => 45,  123 => 40,  120 => 64,  115 => 12,  111 => 50,  108 => 35,  101 => 46,  98 => 55,  96 => 34,  83 => 30,  74 => 23,  66 => 17,  55 => 38,  52 => 37,  50 => 16,  43 => 25,  41 => 9,  35 => 24,  32 => 21,  29 => 20,  209 => 98,  203 => 96,  199 => 85,  193 => 75,  189 => 70,  187 => 69,  182 => 90,  176 => 85,  173 => 69,  168 => 84,  164 => 64,  162 => 152,  154 => 79,  149 => 51,  147 => 72,  144 => 71,  141 => 49,  133 => 44,  130 => 42,  125 => 46,  122 => 55,  116 => 54,  112 => 45,  109 => 60,  106 => 41,  103 => 32,  99 => 35,  95 => 39,  92 => 44,  86 => 41,  82 => 23,  80 => 29,  73 => 15,  64 => 12,  60 => 40,  57 => 16,  54 => 15,  51 => 11,  48 => 12,  45 => 8,  42 => 7,  39 => 8,  36 => 8,  33 => 3,  30 => 2,);
    }
}
