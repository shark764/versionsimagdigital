<?php

/* MinsalSiapsBundle:MntAmbienteAreaEstablecimiento:edit.html.twig */
class __TwigTemplate_2d0b98b76a6531ad04638e9553d3da1c7efb399e426f358e2355a8d1f575516c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:edit.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'form' => array($this, 'block_form'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'sonata_post_fieldsets' => array($this, 'block_sonata_post_fieldsets'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_javascripts($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
<script src=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/MntAmbienteAreaEstablecimiento/edit.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
";
    }

    // line 6
    public function block_form($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 8
        echo "
    ";
        // line 9
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 10
            echo "        <div>
            ";
            // line 11
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 14
            echo "    
        <form
            ";
            // line 16
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 17
            echo "            role=\"form\"
            action=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
            method=\"POST\"
            ";
            // line 20
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 21
            echo "        >
        
            ";
            // line 23
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 24
                echo "                <div class=\"sonata-ba-form-error\">
                    ";
                // line 25
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 28
            echo "
            ";
            // line 29
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 32
            echo "
            ";
            // line 33
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 80
            echo "
            ";
            // line 81
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 84
            echo "
            ";
            // line 85
            $this->displayBlock('formactions', $context, $blocks);
            // line 113
            echo "            <fieldset id=\"resultados\" style=\"width: 700px; display: block; vertical-align: top; margin-left: 89px;\"></fieldset> 
        </form>
    ";
        }
        // line 116
        echo "
    ";
        // line 117
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.bottom", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

";
    }

    // line 29
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 30
        echo "                <div class=\"row\">
            ";
    }

    // line 33
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 34
        echo "                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formgroups"));
        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
            // line 35
            echo "                    <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                        <div class=\"box box-success\">
                            <div class=\"box-header\">
                                <h4 class=\"box-title\">
                                    ";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), 1 => array(), 2 => $this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "translation_domain")), "method"), "html", null, true);
            echo "
                                </h4>
                            </div>
                            ";
            // line 43
            echo "                                <div class=\"box-body\">
                                    <div class=\"sonata-ba-collapsed-fields\">
                                        <div class=\"form-group\">
                                            <label class=\"control-label required\">
                                                Modalidades de la Hospitalizaci&oacute;n
                                            </label>
                                            <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                                                <select id=\"areas-modalidad\">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        ";
            // line 55
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAtencion"), array(), "array"), 'row');
            echo "
                                        <input type=\"hidden\" value=\"\" class=\"span5\" name=\"idAtenModEstab\" id=\"idAtenModEstab\">
                                        <div class=\"form-group\">
                                            <label class=\"control-label required\">
                                                Dividir ambientes por sexo
                                            </label>
                                            <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                                                <input type=\"checkbox\" name=\"por_sexo\" id=\"por_sexo\">
                                            </div>
                                        </div>
                                        <div class=\"form-group\">
                                            <label class=\"control-label required\">
                                                N&uacute;mero de ambientes
                                            </label>
                                            <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                                                <input type=\"text\" value=\"\" class=\"form-control\" style=\"width:41.66666667%;\" name=\"numero_ambientes\" id=\"numero_ambientes\">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
            // line 76
            echo "                        </div>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        echo "            ";
    }

    // line 81
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 82
        echo "                </div>
            ";
    }

    // line 85
    public function block_formactions($context, array $blocks = array())
    {
        // line 86
        echo "                <div class=\"well form-actions\">
                    ";
        // line 87
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 88
            echo "                         ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")) {
                // line 89
                echo "                            <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_update\" value=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "\"/>
                        ";
            } else {
                // line 91
                echo "                            <input type=\"submit\" class=\"btn\" name=\"btn_create\" value=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "\"/>
                        ";
            }
            // line 93
            echo "                    ";
        } else {
            // line 94
            echo "                        ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 95
                echo "                            <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                                <i class=\"icon-eye-open\"></i>
                                ";
                // line 97
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                            </button>
                        ";
            }
            // line 100
            echo "                        ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 101
                echo "                            <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_update_and_edit\" value=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_and_edit_again", array(), "SonataAdminBundle"), "html", null, true);
                echo "\"/>
                            
                            ";
                // line 103
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 104
                    echo "                                <input type=\"submit\" class=\"btn\" name=\"btn_update_and_list\" value=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_and_return_to_list", array(), "SonataAdminBundle"), "html", null, true);
                    echo "\"/>
                            ";
                }
                // line 106
                echo "
                        ";
            } else {
                // line 108
                echo "                            <input class=\"btn btn-primary\" type=\"button\" name=\"btn_generar\" value=\"Generar\"/>
                        ";
            }
            // line 110
            echo "                    ";
        }
        // line 111
        echo "                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntAmbienteAreaEstablecimiento:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 160,  401 => 144,  369 => 129,  356 => 127,  340 => 122,  874 => 376,  854 => 367,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 352,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 322,  763 => 321,  746 => 311,  740 => 307,  734 => 305,  731 => 304,  729 => 303,  721 => 301,  715 => 297,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 266,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 220,  520 => 210,  450 => 173,  408 => 156,  363 => 136,  359 => 135,  348 => 129,  345 => 128,  336 => 125,  316 => 116,  307 => 112,  261 => 76,  266 => 87,  542 => 218,  538 => 217,  527 => 173,  509 => 204,  499 => 157,  493 => 155,  479 => 154,  473 => 165,  414 => 148,  406 => 155,  280 => 75,  223 => 69,  585 => 224,  551 => 101,  546 => 206,  506 => 103,  503 => 193,  488 => 172,  485 => 195,  478 => 165,  475 => 164,  471 => 164,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 109,  291 => 87,  286 => 108,  392 => 107,  332 => 145,  318 => 83,  276 => 104,  190 => 53,  12 => 36,  195 => 92,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 383,  890 => 381,  887 => 380,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 295,  706 => 294,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 202,  613 => 232,  610 => 198,  608 => 197,  605 => 196,  602 => 230,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 79,  496 => 199,  441 => 156,  438 => 140,  432 => 166,  428 => 172,  422 => 150,  416 => 123,  395 => 118,  391 => 109,  382 => 143,  372 => 89,  364 => 98,  353 => 96,  335 => 92,  333 => 93,  297 => 84,  292 => 82,  205 => 96,  200 => 94,  184 => 55,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 377,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 330,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 293,  701 => 180,  699 => 179,  696 => 178,  690 => 285,  687 => 173,  681 => 205,  673 => 165,  671 => 277,  668 => 163,  663 => 160,  658 => 271,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 261,  629 => 141,  627 => 206,  624 => 139,  620 => 182,  614 => 201,  599 => 194,  594 => 243,  592 => 126,  589 => 192,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 186,  567 => 110,  554 => 185,  552 => 164,  544 => 219,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 159,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 148,  446 => 143,  443 => 142,  429 => 116,  425 => 152,  410 => 59,  397 => 55,  394 => 54,  389 => 128,  357 => 37,  342 => 123,  334 => 26,  330 => 122,  328 => 117,  290 => 110,  287 => 71,  263 => 86,  255 => 95,  245 => 70,  194 => 55,  76 => 70,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 372,  860 => 280,  856 => 279,  852 => 278,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 255,  617 => 254,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 244,  595 => 193,  586 => 191,  582 => 190,  580 => 197,  572 => 218,  568 => 173,  562 => 184,  556 => 182,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 191,  492 => 76,  481 => 167,  476 => 163,  467 => 156,  451 => 155,  424 => 115,  418 => 148,  412 => 147,  399 => 143,  396 => 135,  390 => 139,  388 => 138,  383 => 135,  377 => 104,  373 => 46,  370 => 100,  367 => 102,  352 => 126,  349 => 101,  346 => 125,  329 => 111,  326 => 86,  313 => 126,  303 => 103,  300 => 112,  234 => 88,  218 => 81,  207 => 61,  178 => 48,  321 => 119,  295 => 11,  274 => 103,  242 => 110,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 268,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 226,  583 => 334,  579 => 236,  577 => 188,  575 => 252,  569 => 233,  565 => 109,  548 => 207,  540 => 99,  536 => 98,  529 => 213,  524 => 211,  516 => 143,  510 => 78,  504 => 90,  500 => 88,  490 => 197,  486 => 136,  482 => 285,  470 => 131,  464 => 180,  459 => 177,  452 => 145,  434 => 256,  421 => 114,  417 => 160,  385 => 107,  361 => 97,  344 => 94,  339 => 126,  324 => 142,  310 => 113,  302 => 131,  296 => 89,  282 => 106,  259 => 97,  244 => 111,  231 => 75,  226 => 85,  114 => 80,  104 => 28,  288 => 107,  284 => 98,  279 => 96,  275 => 95,  256 => 74,  250 => 73,  237 => 89,  232 => 87,  222 => 64,  215 => 66,  191 => 54,  153 => 72,  563 => 188,  560 => 187,  558 => 186,  555 => 185,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  400 => 116,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 92,  317 => 91,  311 => 87,  308 => 86,  304 => 85,  272 => 81,  267 => 78,  249 => 93,  216 => 70,  155 => 35,  152 => 51,  146 => 49,  126 => 38,  181 => 61,  161 => 54,  110 => 29,  188 => 90,  186 => 51,  170 => 355,  150 => 34,  124 => 113,  358 => 103,  351 => 102,  347 => 134,  343 => 127,  338 => 112,  327 => 121,  323 => 114,  319 => 124,  315 => 82,  301 => 110,  299 => 90,  293 => 111,  289 => 82,  281 => 97,  277 => 74,  271 => 94,  265 => 100,  262 => 76,  260 => 85,  257 => 56,  251 => 72,  248 => 71,  239 => 68,  228 => 103,  225 => 65,  213 => 69,  211 => 64,  197 => 72,  174 => 59,  148 => 38,  134 => 35,  127 => 16,  20 => 1,  53 => 8,  270 => 70,  253 => 71,  233 => 66,  212 => 98,  210 => 97,  206 => 76,  202 => 62,  198 => 54,  192 => 66,  185 => 61,  180 => 49,  175 => 47,  172 => 42,  167 => 53,  165 => 351,  160 => 57,  137 => 46,  113 => 51,  100 => 26,  90 => 27,  81 => 30,  129 => 116,  84 => 21,  77 => 20,  34 => 4,  118 => 37,  97 => 26,  70 => 17,  65 => 18,  58 => 10,  23 => 5,  480 => 134,  474 => 150,  469 => 150,  461 => 157,  457 => 153,  453 => 174,  444 => 171,  440 => 148,  437 => 118,  435 => 167,  430 => 153,  427 => 65,  423 => 63,  413 => 241,  409 => 146,  407 => 238,  402 => 154,  398 => 115,  393 => 112,  387 => 110,  384 => 109,  381 => 109,  379 => 119,  374 => 140,  368 => 138,  365 => 137,  362 => 97,  360 => 104,  355 => 95,  341 => 93,  337 => 97,  322 => 93,  314 => 88,  312 => 149,  309 => 113,  305 => 111,  298 => 12,  294 => 98,  285 => 79,  283 => 111,  278 => 110,  268 => 101,  264 => 104,  258 => 75,  252 => 94,  247 => 72,  241 => 69,  229 => 86,  220 => 99,  214 => 79,  177 => 52,  169 => 43,  140 => 47,  132 => 117,  128 => 57,  107 => 29,  61 => 11,  273 => 71,  269 => 91,  254 => 85,  243 => 91,  240 => 72,  238 => 84,  235 => 67,  230 => 65,  227 => 104,  224 => 62,  221 => 82,  219 => 60,  217 => 67,  208 => 96,  204 => 53,  179 => 86,  159 => 40,  143 => 36,  135 => 42,  119 => 84,  102 => 28,  71 => 16,  67 => 14,  63 => 11,  59 => 10,  38 => 15,  94 => 25,  89 => 21,  85 => 20,  75 => 17,  68 => 59,  56 => 9,  201 => 91,  196 => 68,  183 => 55,  171 => 128,  166 => 43,  163 => 39,  158 => 50,  156 => 78,  151 => 47,  142 => 30,  138 => 43,  136 => 43,  121 => 37,  117 => 81,  105 => 39,  91 => 24,  62 => 17,  49 => 20,  28 => 3,  26 => 13,  87 => 22,  31 => 4,  25 => 10,  21 => 12,  24 => 3,  19 => 1,  93 => 23,  88 => 24,  78 => 18,  46 => 7,  44 => 9,  27 => 4,  79 => 24,  72 => 20,  69 => 15,  47 => 6,  40 => 7,  37 => 5,  22 => 2,  246 => 122,  157 => 53,  145 => 46,  139 => 29,  131 => 34,  123 => 43,  120 => 35,  115 => 12,  111 => 36,  108 => 31,  101 => 28,  98 => 25,  96 => 26,  83 => 176,  74 => 21,  66 => 15,  55 => 9,  52 => 21,  50 => 7,  43 => 8,  41 => 4,  35 => 6,  32 => 5,  29 => 3,  209 => 127,  203 => 56,  199 => 61,  193 => 55,  189 => 65,  187 => 48,  182 => 87,  176 => 85,  173 => 51,  168 => 50,  164 => 42,  162 => 52,  154 => 36,  149 => 62,  147 => 33,  144 => 44,  141 => 65,  133 => 42,  130 => 40,  125 => 46,  122 => 85,  116 => 35,  112 => 33,  109 => 32,  106 => 31,  103 => 35,  99 => 30,  95 => 24,  92 => 37,  86 => 177,  82 => 31,  80 => 21,  73 => 29,  64 => 26,  60 => 10,  57 => 22,  54 => 21,  51 => 9,  48 => 8,  45 => 18,  42 => 6,  39 => 17,  36 => 3,  33 => 2,  30 => 2,);
    }
}
