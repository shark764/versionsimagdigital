<?php

/* MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_generarReporte.html.twig */
class __TwigTemplate_48bf99ab4b7b05c73d18fddd0b20bf6c40b669c8cf5f451d847232e268bae3d7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    
    ";
        // line 9
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/select2-bootstrap.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
";
    }

    // line 12
    public function block_javascripts($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\" src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/jquery.formparams.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 17
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_pacientesAtendidos_bootstrapValidator.js.twig")->display($context);
        // line 18
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_pacientesAtendidosMedico_bootstrapValidator.js.twig")->display($context);
        // line 19
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_examenesRealizados_bootstrapValidator.js.twig")->display($context);
        // line 20
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_examenesRealizadosModalidad_bootstrapValidator.js.twig")->display($context);
        // line 21
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_examenesRealizadosPaciente_bootstrapValidator.js.twig")->display($context);
        // line 22
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_examenesRealizadosTecnologo_bootstrapValidator.js.twig")->display($context);
        // line 23
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_estudiosSolicitadosMedicoModalidad_bootstrapValidator.js.twig")->display($context);
        // line 24
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_estudiosDiagnosticadosRadiologoModalidad_bootstrapValidator.js.twig")->display($context);
        // line 25
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_reportes_pacientesAtendidosTecnologoModalidad_bootstrapValidator.js.twig")->display($context);
        // line 26
        echo "
    <script type=\"text/javascript\" src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/GeneracionReporteImagenologiaAdmin/simagd_generar_reportes.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 31
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 33
        $context["simagd_vars"] = array("simagd_title" => "IMAGENOLOGÍA DIGITAL", "simagd_message" => "Utilice este formulario para generar un reporte de Imagenología");
        // line 36
        echo "    ";
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_cabecera.html.twig")->display(array_merge($context, (isset($context["simagd_vars"]) ? $context["simagd_vars"] : $this->getContext($context, "simagd_vars"))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 37
        echo "    
    <br/>

    <h4><img class=\"icono\" src=";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/images/medicina-ortomolecular.png"), "html", null, true);
        echo " />Generación de Reportes</h4>
    
    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">
            <h3 class=\"panel-title\"> <i class=\"fa fa-clipboard\"></i> Introduzca los parámetros para generar un Reporte</h3>
        </div>
        <div class=\"panel-body\">
            <div class=\"col-xs-8\">";
        // line 48
        echo "                <!-- Tab panes -->
                <div class=\"tab-content\">
                    <div class=\"tab-pane fade in active\" id=\"pacientesAtendidos\" >
                        ";
        // line 51
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_pacientesAtendidos.html.twig")->display($context);
        // line 52
        echo "                    </div>
                    <div class=\"tab-pane fade\" id=\"pacientesAtendidosMedico\" >
                        ";
        // line 54
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_pacientesAtendidosMedico.html.twig")->display($context);
        // line 55
        echo "                    </div>
                    <div class=\"tab-pane fade\" id=\"examenesRealizados\" >
                        ";
        // line 57
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_examenesRealizados.html.twig")->display($context);
        // line 58
        echo "                    </div>
                    <div class=\"tab-pane fade\" id=\"examenesRealizadosModalidad\" >
                        ";
        // line 60
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_examenesRealizadosModalidad.html.twig")->display($context);
        // line 61
        echo "                    </div>
                    <div class=\"tab-pane fade\" id=\"examenesRealizadosPaciente\" >
                        ";
        // line 63
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_examenesRealizadosPaciente.html.twig")->display($context);
        // line 64
        echo "                    </div>
                    <div class=\"tab-pane fade\" id=\"examenesRealizadosTecnologo\" >
                        ";
        // line 66
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_examenesRealizadosTecnologo.html.twig")->display($context);
        // line 67
        echo "                    </div>
                    <div class=\"tab-pane fade\" id=\"estudiosSolicitadosMedicoModalidad\" >
                        ";
        // line 69
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_estudiosSolicitadosMedicoModalidad.html.twig")->display($context);
        // line 70
        echo "                    </div>
                    <div class=\"tab-pane fade\" id=\"estudiosDiagnosticadosRadiologoModalidad\" >
                        ";
        // line 72
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_estudiosDiagnosticadosRadiologoModalidad.html.twig")->display($context);
        // line 73
        echo "                    </div>
                    <div class=\"tab-pane fade\" id=\"pacientesAtendidosTecnologoModalidad\" >
                        ";
        // line 75
        $this->env->loadTemplate("MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_report_pacientesAtendidosTecnologoModalidad.html.twig")->display($context);
        // line 76
        echo "                    </div>
                </div>
            </div>

            <div class=\"col-xs-4\" > <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class=\"nav nav-tabs tabs-right\">
                    <li class=\"active\"><a href=\"#pacientesAtendidos\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-user\"></span> Pacientes atendidos</a></li>
                    <li><a href=\"#pacientesAtendidosMedico\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-tags\"></span> Pacientes atendidos por Tecnólogo</a></li>
                    <li><a href=\"#examenesRealizados\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-film\"></span> Exámenes realizados</a></li>
                    <li><a href=\"#examenesRealizadosModalidad\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-tasks\"></span> Exámenes realizados por Modalidad</a></li>
                    <li><a href=\"#examenesRealizadosPaciente\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list-alt\"></span> Exámenes realizados por Paciente</a></li>
                    <li><a href=\"#examenesRealizadosTecnologo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-th-list\"></span> Exámenes realizados por Tecnólogo</a></li>
                    <li><a href=\"#estudiosSolicitadosMedicoModalidad\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-inbox\"></span> Estudios solicitados por Médico y Modalidad</a></li>
                    <li><a href=\"#estudiosDiagnosticadosRadiologoModalidad\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-paperclip\"></span> Estudios diagnosticados por Radiólogo y Modalidad</a></li>
                    <li><a href=\"#pacientesAtendidosTecnologoModalidad\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-eye-open\"></span> Pacientes atendidos por Tecnólogo y Modalidad</a></li>
                </ul>
            </div>
    
        </div>
    </div>
    
    <nav class=\"navbar navbar-default\" role=\"navigation\">
        <div class=\"navbar-header\">
            <a class=\"navbar-brand\" href=\"javascript:void(0)\">Opciones</a>
        </div>
 
        <form class=\"navbar-form form-horizontal\" action=\"#\" id=\"form-navbar\" >
            <div class=\"form-group col-sm-8\">
                <div class=\"col-sm-3\">
                    <select class=\"form-control\" id=\"report_format\" name=\"report_format\" required >
                        ";
        // line 108
        echo "                        <option value=\"PDF\">PDF</option>
                    </select>
                </div>
                <div class=\"col-sm-3\">
                    <select class=\"form-control\" id=\"limite_resultados\" name=\"limite_resultados\" >
                        <option value=\"\"></option>
                        ";
        // line 114
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(50, 2000, 50));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 115
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo "                        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(2500, 10000, 500));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 118
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 120
        echo "                    </select>
                </div>
                <a id=\"iniciar-generar-reporte\" class=\"btn btn-primary-v2\" href=\"javascript:void(0)\">
                    <span class=\"glyphicon glyphicon-export\"></span>
                    Generar Reporte
                </a>
            </div>
        </form>
    </nav>

";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:GeneracionReporteImagenologiaAdmin:simagd_generarReporte.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  557 => 359,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 414,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 392,  862 => 389,  844 => 385,  834 => 382,  802 => 373,  796 => 369,  768 => 352,  747 => 340,  708 => 321,  698 => 313,  677 => 293,  630 => 263,  787 => 404,  784 => 403,  776 => 401,  494 => 240,  564 => 361,  561 => 360,  456 => 170,  431 => 208,  634 => 356,  628 => 354,  601 => 319,  545 => 304,  350 => 175,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 405,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 352,  596 => 231,  578 => 270,  534 => 176,  507 => 186,  447 => 282,  445 => 16,  419 => 200,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 235,  517 => 283,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 224,  622 => 204,  531 => 224,  498 => 182,  468 => 293,  458 => 204,  401 => 199,  369 => 165,  356 => 218,  340 => 141,  874 => 781,  854 => 388,  851 => 387,  836 => 361,  831 => 381,  828 => 380,  825 => 357,  820 => 318,  817 => 376,  813 => 349,  799 => 341,  792 => 367,  773 => 327,  766 => 351,  763 => 350,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 327,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 340,  637 => 262,  604 => 320,  588 => 239,  573 => 294,  559 => 187,  547 => 274,  520 => 215,  450 => 173,  408 => 243,  363 => 220,  359 => 280,  348 => 134,  345 => 133,  336 => 163,  316 => 154,  307 => 183,  261 => 111,  266 => 112,  542 => 230,  538 => 177,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 213,  223 => 130,  585 => 224,  551 => 356,  546 => 308,  506 => 103,  503 => 193,  488 => 261,  485 => 268,  478 => 176,  475 => 164,  471 => 173,  448 => 217,  386 => 215,  378 => 225,  375 => 244,  306 => 190,  291 => 142,  286 => 140,  392 => 178,  332 => 139,  318 => 160,  276 => 137,  190 => 70,  12 => 36,  195 => 87,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 400,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 374,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 389,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 381,  706 => 380,  703 => 379,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 275,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 323,  613 => 350,  610 => 349,  608 => 197,  605 => 253,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 190,  533 => 203,  530 => 150,  513 => 168,  496 => 280,  441 => 185,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 199,  395 => 222,  391 => 247,  382 => 195,  372 => 184,  364 => 242,  353 => 175,  335 => 154,  333 => 151,  297 => 144,  292 => 121,  205 => 89,  200 => 129,  184 => 148,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 418,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 403,  900 => 385,  897 => 384,  891 => 399,  884 => 397,  881 => 270,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 400,  754 => 208,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 344,  726 => 341,  723 => 326,  719 => 383,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 378,  696 => 291,  690 => 285,  687 => 173,  681 => 372,  673 => 291,  671 => 280,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 264,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 520,  592 => 519,  589 => 247,  587 => 388,  584 => 320,  576 => 324,  574 => 242,  570 => 291,  567 => 362,  554 => 311,  552 => 235,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 250,  502 => 184,  477 => 196,  472 => 132,  465 => 222,  463 => 208,  446 => 244,  443 => 280,  429 => 183,  425 => 195,  410 => 167,  397 => 230,  394 => 179,  389 => 177,  357 => 165,  342 => 172,  334 => 157,  330 => 158,  328 => 140,  290 => 137,  287 => 175,  263 => 205,  255 => 122,  245 => 102,  194 => 117,  76 => 57,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 401,  888 => 398,  882 => 396,  873 => 267,  868 => 282,  864 => 390,  860 => 327,  856 => 279,  852 => 324,  848 => 386,  843 => 257,  838 => 383,  832 => 271,  826 => 247,  823 => 268,  819 => 377,  814 => 265,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 395,  758 => 346,  756 => 318,  751 => 392,  739 => 200,  736 => 347,  733 => 386,  725 => 385,  722 => 384,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 322,  606 => 321,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 329,  580 => 365,  572 => 218,  568 => 241,  562 => 313,  556 => 307,  550 => 183,  535 => 271,  526 => 334,  521 => 171,  515 => 258,  497 => 243,  492 => 308,  481 => 218,  476 => 175,  467 => 221,  451 => 213,  424 => 7,  418 => 192,  412 => 198,  399 => 154,  396 => 232,  390 => 230,  388 => 229,  383 => 200,  377 => 169,  373 => 179,  370 => 154,  367 => 221,  352 => 157,  349 => 162,  346 => 172,  329 => 155,  326 => 156,  313 => 186,  303 => 145,  300 => 208,  234 => 164,  218 => 180,  207 => 161,  178 => 66,  321 => 134,  295 => 178,  274 => 171,  242 => 110,  236 => 112,  692 => 175,  683 => 373,  678 => 371,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 269,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 363,  569 => 191,  565 => 314,  548 => 207,  540 => 273,  536 => 358,  529 => 174,  524 => 173,  516 => 143,  510 => 185,  504 => 185,  500 => 206,  490 => 201,  486 => 275,  482 => 285,  470 => 225,  464 => 180,  459 => 171,  452 => 145,  434 => 12,  421 => 6,  417 => 250,  385 => 185,  361 => 180,  344 => 157,  339 => 147,  324 => 207,  310 => 158,  302 => 145,  296 => 122,  282 => 173,  259 => 96,  244 => 157,  231 => 162,  226 => 86,  114 => 40,  104 => 33,  288 => 154,  284 => 162,  279 => 129,  275 => 208,  256 => 141,  250 => 179,  237 => 141,  232 => 113,  222 => 82,  215 => 79,  191 => 80,  153 => 63,  563 => 223,  560 => 222,  558 => 236,  555 => 358,  553 => 211,  549 => 355,  543 => 179,  537 => 272,  532 => 270,  528 => 173,  525 => 356,  523 => 331,  518 => 170,  514 => 168,  511 => 321,  508 => 208,  501 => 313,  495 => 158,  491 => 239,  487 => 156,  460 => 143,  455 => 287,  449 => 187,  442 => 210,  439 => 209,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 202,  405 => 118,  403 => 117,  400 => 182,  380 => 245,  366 => 182,  354 => 101,  331 => 141,  325 => 94,  320 => 144,  317 => 131,  311 => 185,  308 => 128,  304 => 152,  272 => 81,  267 => 169,  249 => 108,  216 => 70,  155 => 64,  152 => 87,  146 => 49,  126 => 56,  181 => 119,  161 => 67,  110 => 84,  188 => 69,  186 => 119,  170 => 63,  150 => 64,  124 => 48,  358 => 179,  351 => 135,  347 => 174,  343 => 146,  338 => 158,  327 => 191,  323 => 128,  319 => 188,  315 => 132,  301 => 181,  299 => 180,  293 => 155,  289 => 176,  281 => 118,  277 => 105,  271 => 170,  265 => 135,  262 => 134,  260 => 98,  257 => 202,  251 => 120,  248 => 129,  239 => 117,  228 => 138,  225 => 137,  213 => 102,  211 => 77,  197 => 125,  174 => 80,  148 => 82,  134 => 49,  127 => 46,  20 => 2,  53 => 12,  270 => 209,  253 => 201,  233 => 101,  212 => 108,  210 => 127,  206 => 93,  202 => 92,  198 => 72,  192 => 104,  185 => 68,  180 => 64,  175 => 140,  172 => 131,  167 => 70,  165 => 69,  160 => 79,  137 => 55,  113 => 51,  100 => 70,  90 => 36,  81 => 29,  129 => 51,  84 => 59,  77 => 23,  34 => 6,  118 => 54,  97 => 39,  70 => 22,  65 => 19,  58 => 20,  23 => 11,  480 => 301,  474 => 195,  469 => 150,  461 => 290,  457 => 216,  453 => 169,  444 => 230,  440 => 15,  437 => 13,  435 => 276,  430 => 172,  427 => 9,  423 => 206,  413 => 160,  409 => 195,  407 => 250,  402 => 193,  398 => 115,  393 => 112,  387 => 176,  384 => 227,  381 => 173,  379 => 194,  374 => 168,  368 => 190,  365 => 165,  362 => 141,  360 => 219,  355 => 156,  341 => 123,  337 => 97,  322 => 93,  314 => 149,  312 => 141,  309 => 118,  305 => 134,  298 => 156,  294 => 143,  285 => 170,  283 => 153,  278 => 172,  268 => 154,  264 => 201,  258 => 127,  252 => 121,  247 => 134,  241 => 141,  229 => 82,  220 => 114,  214 => 82,  177 => 75,  169 => 129,  140 => 53,  132 => 61,  128 => 49,  107 => 34,  61 => 14,  273 => 106,  269 => 113,  254 => 132,  243 => 172,  240 => 118,  238 => 104,  235 => 117,  230 => 118,  227 => 92,  224 => 115,  221 => 154,  219 => 81,  217 => 134,  208 => 76,  204 => 74,  179 => 76,  159 => 66,  143 => 58,  135 => 54,  119 => 117,  102 => 41,  71 => 21,  67 => 26,  63 => 25,  59 => 23,  38 => 9,  94 => 39,  89 => 27,  85 => 54,  75 => 28,  68 => 20,  56 => 25,  201 => 73,  196 => 128,  183 => 84,  171 => 72,  166 => 63,  163 => 107,  158 => 58,  156 => 84,  151 => 83,  142 => 51,  138 => 54,  136 => 77,  121 => 87,  117 => 86,  105 => 69,  91 => 62,  62 => 18,  49 => 13,  28 => 5,  26 => 6,  87 => 35,  31 => 6,  25 => 5,  21 => 6,  24 => 3,  19 => 2,  93 => 31,  88 => 34,  78 => 22,  46 => 12,  44 => 9,  27 => 6,  79 => 54,  72 => 35,  69 => 51,  47 => 15,  40 => 21,  37 => 11,  22 => 11,  246 => 121,  157 => 67,  145 => 52,  139 => 50,  131 => 52,  123 => 53,  120 => 44,  115 => 75,  111 => 109,  108 => 42,  101 => 36,  98 => 31,  96 => 31,  83 => 25,  74 => 22,  66 => 16,  55 => 15,  52 => 17,  50 => 23,  43 => 13,  41 => 22,  35 => 17,  32 => 6,  29 => 5,  209 => 120,  203 => 106,  199 => 90,  193 => 127,  189 => 126,  187 => 112,  182 => 85,  176 => 63,  173 => 73,  168 => 63,  164 => 61,  162 => 60,  154 => 63,  149 => 61,  147 => 60,  144 => 56,  141 => 57,  133 => 48,  130 => 98,  125 => 88,  122 => 44,  116 => 42,  112 => 45,  109 => 37,  106 => 61,  103 => 101,  99 => 33,  95 => 61,  92 => 27,  86 => 26,  82 => 37,  80 => 24,  73 => 53,  64 => 22,  60 => 17,  57 => 13,  54 => 16,  51 => 14,  48 => 10,  45 => 22,  42 => 27,  39 => 9,  36 => 8,  33 => 6,  30 => 5,);
    }
}
