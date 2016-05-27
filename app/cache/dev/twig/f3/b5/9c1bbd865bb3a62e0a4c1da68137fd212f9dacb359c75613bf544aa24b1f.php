<?php

/* MinsalSimagdBundle:ImgCtlPatronDiagnosticoAdmin:ptrDiag_list_v2.html.twig */
class __TwigTemplate_f3b59c1bbd865bb3a62e0a4c1da68137fd212f9dacb359c75613bf544aa24b1f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_list_v2.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'simagd_navbar_menu_label' => array($this, 'block_simagd_navbar_menu_label'),
            'simagd_navbar_left_nav' => array($this, 'block_simagd_navbar_left_nav'),
            'simagd_navbar_right_nav' => array($this, 'block_simagd_navbar_right_nav'),
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_base_list_v2.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 6
        $context["_PTRDIAG_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PATRON_DIAGNOSTICO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_PTRDIAG_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PATRON_DIAGNOSTICO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_PTRDIAG_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PATRON_DIAGNOSTICO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        $context["_PTRDIAG_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PATRON_DIAGNOSTICO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 11
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    ";
        // line 15
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

";
    }

    // line 19
    public function block_javascripts($context, array $blocks = array())
    {
        // line 20
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         * 
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-patrones-diagnostico';
        
    </script>

    ";
        // line 33
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/lang/summernote-es-ES.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_summernote_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 38
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_webkitSpeechRecognition.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 41
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlPatronDiagnosticoAdmin/ptrDiag_form_config.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlPatronDiagnosticoAdmin/ptrDiag_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 46
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 47
        echo "    <i class=\"fa fa-th-large\"></i> <i class=\"fa fa-file\"></i> <i class=\"fa fa-microphone\"></i> Patrones de diagnóstico radiológico
";
    }

    // line 50
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 51
        echo "    <li class=\"list-table-link-navbar active ";
        if (((isset($context["_PTRDIAG_ALLOW_LIST"]) ? $context["_PTRDIAG_ALLOW_LIST"] : $this->getContext($context, "_PTRDIAG_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-general-list\" data-divtabletarget=\"div-resultado-patrones-diagnostico\"
\t    ";
        // line 53
        if (((isset($context["_PTRDIAG_ALLOW_LIST"]) ? $context["_PTRDIAG_ALLOW_LIST"] : $this->getContext($context, "_PTRDIAG_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-tasks\"></i> </span> Listado general <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
";
    }

    // line 59
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 60
        echo "    <li class=\"dropdown\">
\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"> <span class=\"text-info\"><i class=\"fa fa-plus-circle\"></i> </span> Registrar <span class=\"caret\"></span></a>
\t<ul class=\"dropdown-menu\" role=\"menu\">
\t    <li ";
        // line 63
        if (((isset($context["_PTRDIAG_ALLOW_CREATE"]) ? $context["_PTRDIAG_ALLOW_CREATE"] : $this->getContext($context, "_PTRDIAG_ALLOW_CREATE")) == false)) {
            echo " class=\"disabled link-full-disabled\" ";
        }
        echo ">
\t\t<a href=\"javascript:void(0)\" id=\"navbar_btn_nuevoPatron\" ";
        // line 65
        echo "\t\t    ";
        if (((isset($context["_PTRDIAG_ALLOW_CREATE"]) ? $context["_PTRDIAG_ALLOW_CREATE"] : $this->getContext($context, "_PTRDIAG_ALLOW_CREATE")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo "> <span class=\"glyphicon glyphicon-cog \"></span> Insertar patrón
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t</ul>
    </li>
    <li>
        <div style=\"padding-top: 10px; padding-left: 10px;\">
            <button id=\"btn_start_recognition\" class=\"btn btn-element-v2 btn-sm btn_start_recognition\" title=\"Iniciar transcripción por voz\" >
                <i class=\"fa fa-microphone\" id=\"icon_start_recognition\"></i>
            </button>
        </div>
    </li>
";
    }

    // line 80
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 82
        echo "    ";
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    ";
        // line 84
        if (((isset($context["_PTRDIAG_ALLOW_LIST"]) ? $context["_PTRDIAG_ALLOW_LIST"] : $this->getContext($context, "_PTRDIAG_ALLOW_LIST")) == true)) {
            // line 85
            echo "        <!-- toolbar for table-lista-patrones-diagnostico -->
        ";
            // line 86
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "ptrDiag")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 87
            echo "        <!-- END --| toolbar for table-lista-patrones-diagnostico -->
        
\t<div id=\"div-resultado-patrones-diagnostico\" class=\"menu-listas-patrones-diagnostico\" data-refresh-url=\"";
            // line 89
            echo $this->env->getExtension('routing')->getPath("simagd_patron_diagnostico_listarPatronesDiagnostico");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-patrones-diagnostico\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"ptrDiag_id\"
\t\t  data-url=\"";
            // line 93
            echo $this->env->getExtension('routing')->getPath("simagd_patron_diagnostico_listarPatronesDiagnostico");
            echo "\"
\t\t  data-backup-url=\"simagd_patron_diagnostico_listarPatronesDiagnostico\"
\t\t  data-toolbar=\"#bs_ptrDiag_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaPatronesDiagnosticoToolbar\"
\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 103
            echo "]\"
\t\t  ";
            // line 106
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 111
            echo "\t\t\t<th data-field=\"ptrDiag_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"ptrDiag_nombre\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-switchable=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Nombre</th>
\t\t\t<th data-field=\"ptrDiag_codigo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Código</th>
\t\t\t<th data-field=\"m_nombrearea\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"m_imgCodigo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Código</th>
\t\t\t<th data-field=\"tpR_nombreTipo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tpR_nombreTipo\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"ptrDiag_radiologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"radX_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Definido por</th>
\t\t\t<th data-field=\"ptrDiag_fechaHoraReg\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Registrado</th>
\t\t\t<th data-field=\"ptrDiag_fechaHoraMod\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Editado</th>
\t\t\t<th data-field=\"ptrDiag_empleado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empptrDiag_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Ingresó</th>
\t\t\t<th data-field=\"ptrDiag_nombreUserReg\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Usuario ingresó</th>
\t\t\t<th data-field=\"ptrDiag_nombreUserMod\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Usuario modificó</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionFormatter\" data-events=\"actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 129
        echo "
    ";
        // line 131
        echo "    ";
        if ((((isset($context["_PTRDIAG_ALLOW_CREATE"]) ? $context["_PTRDIAG_ALLOW_CREATE"] : $this->getContext($context, "_PTRDIAG_ALLOW_CREATE")) == true) || ((isset($context["_PTRDIAG_ALLOW_EDIT"]) ? $context["_PTRDIAG_ALLOW_EDIT"] : $this->getContext($context, "_PTRDIAG_ALLOW_EDIT")) == true))) {
            // line 132
            echo "\t";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlPatronDiagnosticoAdmin:ptrDiag_crearPatronDiagnostico_modal.html.twig")->display(array_merge($context, array("modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "empleados" => (isset($context["empleados"]) ? $context["empleados"] : $this->getContext($context, "empleados")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "tiposResultado" => (isset($context["tiposResultado"]) ? $context["tiposResultado"] : $this->getContext($context, "tiposResultado")), "tipoResultDefault" => (isset($context["tipoResultDefault"]) ? $context["tipoResultDefault"] : $this->getContext($context, "tipoResultDefault")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 134
            echo "    ";
        }
        // line 135
        echo "    
    ";
        // line 136
        $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_speechRecognition_modal.html.twig")->display($context);
        echo "    ";
        // line 137
        echo "    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlPatronDiagnosticoAdmin:ptrDiag_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 414,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 392,  862 => 389,  844 => 385,  834 => 382,  802 => 373,  796 => 369,  768 => 352,  747 => 340,  708 => 321,  698 => 313,  677 => 293,  630 => 263,  787 => 404,  784 => 403,  776 => 401,  494 => 240,  564 => 189,  561 => 188,  456 => 170,  431 => 208,  634 => 356,  628 => 354,  601 => 319,  545 => 304,  350 => 175,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 405,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 352,  596 => 231,  578 => 270,  534 => 176,  507 => 186,  447 => 236,  445 => 216,  419 => 200,  454 => 160,  371 => 174,  651 => 437,  483 => 180,  404 => 184,  517 => 283,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 150,  622 => 204,  531 => 224,  498 => 182,  468 => 163,  458 => 204,  401 => 199,  369 => 165,  356 => 147,  340 => 141,  874 => 781,  854 => 388,  851 => 387,  836 => 361,  831 => 381,  828 => 380,  825 => 357,  820 => 318,  817 => 376,  813 => 349,  799 => 341,  792 => 367,  773 => 327,  766 => 351,  763 => 350,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 327,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 340,  637 => 262,  604 => 320,  588 => 239,  573 => 294,  559 => 187,  547 => 274,  520 => 215,  450 => 173,  408 => 243,  363 => 181,  359 => 280,  348 => 134,  345 => 133,  336 => 163,  316 => 154,  307 => 147,  261 => 111,  266 => 112,  542 => 230,  538 => 177,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 213,  223 => 130,  585 => 224,  551 => 276,  546 => 308,  506 => 103,  503 => 193,  488 => 261,  485 => 268,  478 => 176,  475 => 164,  471 => 173,  448 => 217,  386 => 215,  378 => 181,  375 => 157,  306 => 146,  291 => 142,  286 => 140,  392 => 178,  332 => 139,  318 => 160,  276 => 137,  190 => 144,  12 => 36,  195 => 87,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 400,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 374,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 389,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 381,  706 => 380,  703 => 379,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 275,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 323,  613 => 350,  610 => 349,  608 => 197,  605 => 253,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 190,  533 => 203,  530 => 150,  513 => 168,  496 => 280,  441 => 185,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 199,  395 => 222,  391 => 171,  382 => 195,  372 => 184,  364 => 189,  353 => 175,  335 => 154,  333 => 151,  297 => 144,  292 => 121,  205 => 89,  200 => 97,  184 => 65,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 418,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 403,  900 => 385,  897 => 384,  891 => 399,  884 => 397,  881 => 270,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 400,  754 => 208,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 344,  726 => 341,  723 => 326,  719 => 383,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 378,  696 => 291,  690 => 285,  687 => 173,  681 => 372,  673 => 291,  671 => 280,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 264,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 520,  592 => 519,  589 => 247,  587 => 388,  584 => 320,  576 => 324,  574 => 242,  570 => 291,  567 => 290,  554 => 311,  552 => 235,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 250,  502 => 184,  477 => 196,  472 => 132,  465 => 222,  463 => 208,  446 => 244,  443 => 215,  429 => 183,  425 => 195,  410 => 167,  397 => 230,  394 => 179,  389 => 177,  357 => 165,  342 => 172,  334 => 157,  330 => 158,  328 => 140,  290 => 137,  287 => 120,  263 => 205,  255 => 122,  245 => 102,  194 => 117,  76 => 33,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 401,  888 => 398,  882 => 396,  873 => 267,  868 => 282,  864 => 390,  860 => 327,  856 => 279,  852 => 324,  848 => 386,  843 => 257,  838 => 383,  832 => 271,  826 => 247,  823 => 268,  819 => 377,  814 => 265,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 395,  758 => 346,  756 => 318,  751 => 392,  739 => 200,  736 => 347,  733 => 386,  725 => 385,  722 => 384,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 322,  606 => 321,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 329,  580 => 387,  572 => 218,  568 => 241,  562 => 313,  556 => 307,  550 => 183,  535 => 271,  526 => 222,  521 => 171,  515 => 258,  497 => 243,  492 => 341,  481 => 218,  476 => 175,  467 => 221,  451 => 213,  424 => 182,  418 => 192,  412 => 198,  399 => 154,  396 => 153,  390 => 187,  388 => 190,  383 => 200,  377 => 169,  373 => 179,  370 => 154,  367 => 153,  352 => 157,  349 => 162,  346 => 172,  329 => 155,  326 => 156,  313 => 136,  303 => 145,  300 => 208,  234 => 164,  218 => 169,  207 => 161,  178 => 70,  321 => 134,  295 => 142,  274 => 210,  242 => 110,  236 => 112,  692 => 175,  683 => 373,  678 => 371,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 269,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 246,  579 => 299,  577 => 318,  575 => 252,  569 => 191,  565 => 314,  548 => 207,  540 => 273,  536 => 358,  529 => 174,  524 => 173,  516 => 143,  510 => 185,  504 => 185,  500 => 206,  490 => 201,  486 => 275,  482 => 285,  470 => 225,  464 => 180,  459 => 171,  452 => 145,  434 => 209,  421 => 205,  417 => 250,  385 => 185,  361 => 180,  344 => 157,  339 => 147,  324 => 161,  310 => 158,  302 => 145,  296 => 122,  282 => 114,  259 => 96,  244 => 157,  231 => 162,  226 => 86,  114 => 37,  104 => 37,  288 => 154,  284 => 162,  279 => 129,  275 => 208,  256 => 141,  250 => 179,  237 => 151,  232 => 113,  222 => 106,  215 => 156,  191 => 80,  153 => 65,  563 => 223,  560 => 222,  558 => 236,  555 => 185,  553 => 211,  549 => 182,  543 => 179,  537 => 272,  532 => 270,  528 => 173,  525 => 356,  523 => 221,  518 => 170,  514 => 168,  511 => 167,  508 => 208,  501 => 161,  495 => 158,  491 => 239,  487 => 156,  460 => 143,  455 => 215,  449 => 187,  442 => 210,  439 => 209,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 202,  405 => 118,  403 => 117,  400 => 182,  380 => 107,  366 => 182,  354 => 101,  331 => 141,  325 => 94,  320 => 144,  317 => 131,  311 => 148,  308 => 128,  304 => 152,  272 => 81,  267 => 131,  249 => 108,  216 => 70,  155 => 77,  152 => 87,  146 => 49,  126 => 94,  181 => 119,  161 => 54,  110 => 35,  188 => 86,  186 => 119,  170 => 63,  150 => 64,  124 => 68,  358 => 179,  351 => 135,  347 => 174,  343 => 146,  338 => 158,  327 => 154,  323 => 128,  319 => 151,  315 => 132,  301 => 124,  299 => 148,  293 => 155,  289 => 141,  281 => 118,  277 => 105,  271 => 137,  265 => 135,  262 => 134,  260 => 98,  257 => 202,  251 => 131,  248 => 129,  239 => 117,  228 => 111,  225 => 109,  213 => 155,  211 => 80,  197 => 125,  174 => 80,  148 => 98,  134 => 49,  127 => 89,  20 => 2,  53 => 35,  270 => 209,  253 => 201,  233 => 101,  212 => 93,  210 => 127,  206 => 93,  202 => 79,  198 => 118,  192 => 128,  185 => 85,  180 => 64,  175 => 68,  172 => 131,  167 => 83,  165 => 65,  160 => 79,  137 => 51,  113 => 51,  100 => 67,  90 => 59,  81 => 41,  129 => 54,  84 => 27,  77 => 33,  34 => 8,  118 => 54,  97 => 41,  70 => 22,  65 => 41,  58 => 19,  23 => 4,  480 => 179,  474 => 195,  469 => 150,  461 => 218,  457 => 216,  453 => 169,  444 => 230,  440 => 172,  437 => 203,  435 => 208,  430 => 172,  427 => 260,  423 => 206,  413 => 160,  409 => 195,  407 => 157,  402 => 193,  398 => 115,  393 => 112,  387 => 176,  384 => 207,  381 => 173,  379 => 194,  374 => 168,  368 => 190,  365 => 165,  362 => 141,  360 => 104,  355 => 156,  341 => 123,  337 => 97,  322 => 93,  314 => 149,  312 => 141,  309 => 118,  305 => 134,  298 => 156,  294 => 143,  285 => 115,  283 => 153,  278 => 151,  268 => 136,  264 => 201,  258 => 127,  252 => 121,  247 => 138,  241 => 88,  229 => 82,  220 => 80,  214 => 82,  177 => 82,  169 => 129,  140 => 53,  132 => 69,  128 => 53,  107 => 34,  61 => 20,  273 => 106,  269 => 113,  254 => 132,  243 => 172,  240 => 195,  238 => 104,  235 => 136,  230 => 135,  227 => 92,  224 => 163,  221 => 154,  219 => 103,  217 => 132,  208 => 104,  204 => 116,  179 => 136,  159 => 63,  143 => 93,  135 => 71,  119 => 43,  102 => 42,  71 => 29,  67 => 42,  63 => 25,  59 => 23,  38 => 9,  94 => 72,  89 => 28,  85 => 54,  75 => 53,  68 => 27,  56 => 37,  201 => 88,  196 => 87,  183 => 84,  171 => 65,  166 => 63,  163 => 107,  158 => 58,  156 => 100,  151 => 55,  142 => 60,  138 => 57,  136 => 96,  121 => 93,  117 => 50,  105 => 40,  91 => 38,  62 => 42,  49 => 16,  28 => 9,  26 => 7,  87 => 29,  31 => 8,  25 => 5,  21 => 2,  24 => 4,  19 => 2,  93 => 39,  88 => 36,  78 => 55,  46 => 15,  44 => 12,  27 => 6,  79 => 54,  72 => 23,  69 => 30,  47 => 12,  40 => 15,  37 => 14,  22 => 4,  246 => 121,  157 => 67,  145 => 55,  139 => 59,  131 => 95,  123 => 57,  120 => 51,  115 => 89,  111 => 87,  108 => 48,  101 => 31,  98 => 42,  96 => 33,  83 => 35,  74 => 23,  66 => 18,  55 => 20,  52 => 19,  50 => 15,  43 => 14,  41 => 11,  35 => 13,  32 => 7,  29 => 11,  209 => 120,  203 => 87,  199 => 89,  193 => 124,  189 => 79,  187 => 112,  182 => 85,  176 => 63,  173 => 114,  168 => 61,  164 => 60,  162 => 101,  154 => 63,  149 => 60,  147 => 63,  144 => 68,  141 => 104,  133 => 61,  130 => 46,  125 => 44,  122 => 88,  116 => 48,  112 => 47,  109 => 46,  106 => 61,  103 => 58,  99 => 35,  95 => 59,  92 => 38,  86 => 35,  82 => 34,  80 => 53,  73 => 52,  64 => 19,  60 => 18,  57 => 16,  54 => 37,  51 => 20,  48 => 17,  45 => 16,  42 => 27,  39 => 13,  36 => 9,  33 => 13,  30 => 6,);
    }
}
