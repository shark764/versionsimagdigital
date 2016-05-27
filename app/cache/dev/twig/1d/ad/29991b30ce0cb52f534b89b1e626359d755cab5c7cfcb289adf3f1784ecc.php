<?php

/* MinsalSimagdBundle::simagd_detail_info_v2.html.twig */
class __TwigTemplate_1dad29991b30ce0cb52f534b89b1e626359d755cab5c7cfcb289adf3f1784ecc extends Twig_Template
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
    ";
        // line 3
        $context["_HCL_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_SEC_HISTORIAL_CLINICO_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_SEC_HISTORIAL_CLINICO_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 5
        echo "    ";
        $context["_PRC_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        echo "    ";
        $context["_CIT_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        echo "    ";
        $context["_PRZ_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 11
        echo "    ";
        $context["_SOLCMPL_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 13
        echo "    ";
        $context["_SOLDIAG_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 15
        echo "    ";
        $context["_LCT_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 17
        echo "    ";
        $context["_DIAG_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 19
        echo "    ";
        $context["_NOTDIAG_ALLOW_LIST_AND_VIEW"] = (((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 21
        echo "
    <div class=\"col-xs-9\">";
        // line 23
        echo "        <!-- Tab panes -->
        <div class=\"tab-content\">
\t    <div class=\"tab-pane fade in active\" id=\"pacienteInfo\" >
\t\t";
        // line 26
        $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:pct_bloque_informacion_v2.html.twig")->display($context);
        // line 27
        echo "\t    </div>
            ";
        // line 28
        if (((isset($context["_HCL_ALLOW_LIST_AND_VIEW"]) ? $context["_HCL_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_HCL_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 29
            echo "                <div class=\"tab-pane fade\" id=\"historiaClinicaInfo\" >
                    ";
            // line 30
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:hcl_bloque_informacion_v2.html.twig")->display($context);
            // line 31
            echo "                </div>
            ";
        }
        // line 33
        echo "            ";
        if (((isset($context["_PRC_ALLOW_LIST_AND_VIEW"]) ? $context["_PRC_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_PRC_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 34
            echo "                <div class=\"tab-pane fade\" id=\"preinscripcionInfo\" data-refresh-url=\"";
            echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_listarSolicitudesEstudioSummary");
            echo "\" >
                    ";
            // line 35
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:prc_bloque_informacion_v2.html.twig")->display($context);
            // line 36
            echo "                </div>
            ";
        }
        // line 38
        echo "            ";
        if (((isset($context["_CIT_ALLOW_LIST_AND_VIEW"]) ? $context["_CIT_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_CIT_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 39
            echo "                <div class=\"tab-pane fade\" id=\"citaInfo\" >
                    ";
            // line 40
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:cit_bloque_informacion_v2.html.twig")->display($context);
            // line 41
            echo "                </div>
            ";
        }
        // line 43
        echo "            ";
        if (((isset($context["_PRZ_ALLOW_LIST_AND_VIEW"]) ? $context["_PRZ_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_PRZ_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 44
            echo "                <div class=\"tab-pane fade\" id=\"procedimientoRealizadoInfo\" >
                    ";
            // line 45
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:prz_bloque_informacion_v2.html.twig")->display($context);
            // line 46
            echo "                </div>
            ";
        }
        // line 48
        echo "            ";
        if (((isset($context["_SOLCMPL_ALLOW_LIST_AND_VIEW"]) ? $context["_SOLCMPL_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_SOLCMPL_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 49
            echo "                <div class=\"tab-pane fade\" id=\"solicitudComplementarioInfo\" >
                    ";
            // line 50
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:solcmpl_bloque_informacion_v2.html.twig")->display($context);
            // line 51
            echo "                </div>
            ";
        }
        // line 53
        echo "            ";
        if (((isset($context["_SOLDIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_SOLDIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_SOLDIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 54
            echo "                <div class=\"tab-pane fade\" id=\"solicitudDiagnosticoInfo\" >
                    ";
            // line 55
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:soldiag_bloque_informacion_v2.html.twig")->display($context);
            // line 56
            echo "                </div>
            ";
        }
        // line 58
        echo "            ";
        if (((isset($context["_LCT_ALLOW_LIST_AND_VIEW"]) ? $context["_LCT_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_LCT_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 59
            echo "                <div class=\"tab-pane fade\" id=\"lecturaInfo\" >
                    ";
            // line 60
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:lct_bloque_informacion_v2.html.twig")->display($context);
            // line 61
            echo "                </div>
            ";
        }
        // line 63
        echo "            ";
        if (((isset($context["_DIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_DIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_DIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 64
            echo "                <div class=\"tab-pane fade\" id=\"diagnosticoInfo\" >
                    ";
            // line 65
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:diag_bloque_informacion_v2.html.twig")->display($context);
            // line 66
            echo "                </div>
            ";
        }
        // line 68
        echo "            ";
        if (((isset($context["_NOTDIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_NOTDIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_NOTDIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 69
            echo "                <div class=\"tab-pane fade\" id=\"notaDiagInfo\" >
                    ";
            // line 70
            $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:notdiag_bloque_informacion_v2.html.twig")->display($context);
            // line 71
            echo "                </div>
            ";
        }
        // line 73
        echo "        </div>
    </div>

    <div class=\"col-xs-3\"> <!-- required for floating -->
        <!-- Nav tabs -->
        <ul class=\"nav nav-tabs tabs-right\">
            <li class=\"active\"><a href=\"#pacienteInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-user\"></span> Paciente</a></li>
            ";
        // line 80
        if (((isset($context["_HCL_ALLOW_LIST_AND_VIEW"]) ? $context["_HCL_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_HCL_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 81
            echo "                <li><a href=\"#historiaClinicaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list-alt\"></span> Historia clínica</a></li>
            ";
        }
        // line 83
        echo "            ";
        if (((isset($context["_PRC_ALLOW_LIST_AND_VIEW"]) ? $context["_PRC_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_PRC_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 84
            echo "                <li><a href=\"#preinscripcionInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-inbox\"></span> Solicitudes</a></li>
            ";
        }
        // line 86
        echo "            ";
        if (((isset($context["_CIT_ALLOW_LIST_AND_VIEW"]) ? $context["_CIT_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_CIT_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 87
            echo "                <li><a href=\"#citaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-time\"></span> Citas</a></li>
            ";
        }
        // line 89
        echo "            ";
        if (((isset($context["_PRZ_ALLOW_LIST_AND_VIEW"]) ? $context["_PRZ_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_PRZ_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 90
            echo "                <li><a href=\"#procedimientoRealizadoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-eye-open\"></span> Exámenes</a></li>
            ";
        }
        // line 92
        echo "            ";
        if (((isset($context["_SOLCMPL_ALLOW_LIST_AND_VIEW"]) ? $context["_SOLCMPL_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_SOLCMPL_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 93
            echo "                <li><a href=\"#solicitudComplementarioInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-repeat\"></span> Solicitudes de estudio complementario</a></li>
            ";
        }
        // line 95
        echo "            ";
        if (((isset($context["_SOLDIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_SOLDIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_SOLDIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 96
            echo "                <li><a href=\"#solicitudDiagnosticoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-inbox\"></span> Solicitudes de diagnóstico</a></li>
            ";
        }
        // line 98
        echo "            ";
        if (((isset($context["_LCT_ALLOW_LIST_AND_VIEW"]) ? $context["_LCT_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_LCT_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 99
            echo "                <li><a href=\"#lecturaInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-book\"></span> Interpretación</a></li>
            ";
        }
        // line 101
        echo "            ";
        if (((isset($context["_DIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_DIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_DIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 102
            echo "                <li><a href=\"#diagnosticoInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-floppy-saved\"></span> Diagnóstico</a></li>
            ";
        }
        // line 104
        echo "            ";
        if (((isset($context["_NOTDIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_NOTDIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_NOTDIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 105
            echo "                <li><a href=\"#notaDiagInfo\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-comment\"></span> Notas agregadas <span class=\"badge\"></span></a></li>
            ";
        }
        // line 107
        echo "        </ul>
    </div>

    ";
        // line 111
        echo "    ";
        if ((!(null === (isset($context["pacienteInfo"]) ? $context["pacienteInfo"] : $this->getContext($context, "pacienteInfo"))))) {
            // line 112
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:pct_total_info_modal_v2.html.twig")->display($context);
            echo "     ";
            // line 113
            echo "    ";
        }
        // line 114
        echo "    ";
        if (((isset($context["_HCL_ALLOW_LIST_AND_VIEW"]) ? $context["_HCL_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_HCL_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 115
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:hcl_total_info_modal_v2.html.twig")->display($context);
            echo "     ";
            // line 116
            echo "    ";
        }
        // line 117
        echo "    ";
        if (((isset($context["_PRC_ALLOW_LIST_AND_VIEW"]) ? $context["_PRC_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_PRC_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 118
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal_v2.html.twig")->display($context);
            echo "     ";
            // line 119
            echo "    ";
        }
        // line 120
        echo "    ";
        if (((isset($context["_CIT_ALLOW_LIST_AND_VIEW"]) ? $context["_CIT_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_CIT_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 121
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:cit_total_info_modal_v2.html.twig")->display($context);
            echo "     ";
            // line 122
            echo "    ";
        }
        // line 123
        echo "    ";
        if (((isset($context["_PRZ_ALLOW_LIST_AND_VIEW"]) ? $context["_PRZ_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_PRZ_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 124
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prz_total_info_modal_v2.html.twig")->display($context);
            echo "     ";
            // line 125
            echo "    ";
        }
        // line 126
        echo "    ";
        if (((isset($context["_SOLCMPL_ALLOW_LIST_AND_VIEW"]) ? $context["_SOLCMPL_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_SOLCMPL_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 127
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:solcmpl_total_info_modal_v2.html.twig")->display($context);
            echo " ";
            // line 128
            echo "    ";
        }
        // line 129
        echo "    ";
        if (((isset($context["_SOLDIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_SOLDIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_SOLDIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 130
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:soldiag_total_info_modal_v2.html.twig")->display($context);
            echo " ";
            // line 131
            echo "    ";
        }
        // line 132
        echo "    ";
        if (((isset($context["_LCT_ALLOW_LIST_AND_VIEW"]) ? $context["_LCT_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_LCT_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 133
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:lct_total_info_modal_v2.html.twig")->display($context);
            echo "     ";
            // line 134
            echo "    ";
        }
        // line 135
        echo "    ";
        if (((isset($context["_DIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_DIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_DIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 136
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:diag_total_info_modal_v2.html.twig")->display($context);
            echo "    ";
            // line 137
            echo "    ";
        }
        // line 138
        echo "    ";
        if (((isset($context["_NOTDIAG_ALLOW_LIST_AND_VIEW"]) ? $context["_NOTDIAG_ALLOW_LIST_AND_VIEW"] : $this->getContext($context, "_NOTDIAG_ALLOW_LIST_AND_VIEW")) == true)) {
            // line 139
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:notdiag_total_info_modal_v2.html.twig")->display($context);
            echo " ";
            // line 140
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle::simagd_detail_info_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  489 => 228,  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 245,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 230,  564 => 361,  561 => 235,  456 => 198,  431 => 185,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 151,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 194,  445 => 193,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 186,  517 => 244,  484 => 206,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 105,  622 => 204,  531 => 224,  498 => 231,  468 => 236,  458 => 204,  401 => 163,  369 => 103,  356 => 198,  340 => 91,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 186,  408 => 182,  363 => 199,  359 => 100,  348 => 195,  345 => 163,  336 => 138,  316 => 132,  307 => 79,  261 => 132,  266 => 117,  542 => 230,  538 => 228,  527 => 197,  509 => 353,  499 => 248,  493 => 155,  479 => 205,  473 => 165,  414 => 180,  406 => 237,  280 => 117,  223 => 99,  585 => 224,  551 => 356,  546 => 308,  506 => 237,  503 => 193,  488 => 242,  485 => 268,  478 => 218,  475 => 205,  471 => 204,  448 => 192,  386 => 169,  378 => 178,  375 => 177,  306 => 129,  291 => 193,  286 => 123,  392 => 110,  332 => 142,  318 => 83,  276 => 120,  190 => 77,  12 => 36,  195 => 87,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 243,  496 => 208,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 197,  416 => 166,  395 => 111,  391 => 182,  382 => 195,  372 => 145,  364 => 102,  353 => 197,  335 => 128,  333 => 137,  297 => 132,  292 => 145,  205 => 98,  200 => 97,  184 => 75,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 213,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 201,  463 => 208,  446 => 207,  443 => 200,  429 => 200,  425 => 243,  410 => 190,  397 => 112,  394 => 168,  389 => 109,  357 => 150,  342 => 145,  334 => 139,  330 => 87,  328 => 177,  290 => 130,  287 => 119,  263 => 116,  255 => 101,  245 => 146,  194 => 112,  76 => 54,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 229,  481 => 208,  476 => 239,  467 => 221,  451 => 213,  424 => 198,  418 => 183,  412 => 240,  399 => 113,  396 => 167,  390 => 171,  388 => 181,  383 => 147,  377 => 169,  373 => 159,  370 => 164,  367 => 201,  352 => 160,  349 => 95,  346 => 94,  329 => 136,  326 => 135,  313 => 131,  303 => 128,  300 => 121,  234 => 104,  218 => 105,  207 => 80,  178 => 97,  321 => 134,  295 => 122,  274 => 125,  242 => 95,  236 => 119,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 227,  529 => 174,  524 => 173,  516 => 143,  510 => 211,  504 => 210,  500 => 262,  490 => 211,  486 => 210,  482 => 251,  470 => 237,  464 => 180,  459 => 171,  452 => 209,  434 => 201,  421 => 184,  417 => 242,  385 => 185,  361 => 173,  344 => 157,  339 => 139,  324 => 85,  310 => 123,  302 => 74,  296 => 126,  282 => 180,  259 => 115,  244 => 99,  231 => 143,  226 => 90,  114 => 64,  104 => 45,  288 => 122,  284 => 136,  279 => 121,  275 => 64,  256 => 114,  250 => 107,  237 => 105,  232 => 92,  222 => 113,  215 => 104,  191 => 78,  153 => 84,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 224,  523 => 268,  518 => 221,  514 => 168,  511 => 242,  508 => 241,  501 => 313,  495 => 260,  491 => 255,  487 => 224,  460 => 243,  455 => 241,  449 => 208,  442 => 249,  439 => 248,  436 => 202,  433 => 246,  426 => 126,  420 => 194,  415 => 241,  411 => 202,  405 => 164,  403 => 117,  400 => 185,  380 => 179,  366 => 152,  354 => 167,  331 => 138,  325 => 94,  320 => 154,  317 => 131,  311 => 127,  308 => 135,  304 => 139,  272 => 124,  267 => 169,  249 => 112,  216 => 96,  155 => 58,  152 => 65,  146 => 63,  126 => 43,  181 => 81,  161 => 69,  110 => 48,  188 => 84,  186 => 71,  170 => 73,  150 => 64,  124 => 51,  358 => 172,  351 => 196,  347 => 150,  343 => 140,  338 => 160,  327 => 126,  323 => 134,  319 => 133,  315 => 124,  301 => 182,  299 => 127,  293 => 125,  289 => 124,  281 => 109,  277 => 110,  271 => 109,  265 => 124,  262 => 123,  260 => 60,  257 => 148,  251 => 105,  248 => 126,  239 => 94,  228 => 115,  225 => 114,  213 => 95,  211 => 101,  197 => 117,  174 => 81,  148 => 57,  134 => 58,  127 => 44,  20 => 2,  53 => 18,  270 => 108,  253 => 113,  233 => 51,  212 => 129,  210 => 101,  206 => 92,  202 => 90,  198 => 161,  192 => 86,  185 => 83,  180 => 76,  175 => 73,  172 => 69,  167 => 84,  165 => 77,  160 => 60,  137 => 59,  113 => 49,  100 => 39,  90 => 56,  81 => 28,  129 => 71,  84 => 37,  77 => 29,  34 => 7,  118 => 51,  97 => 37,  70 => 25,  65 => 26,  58 => 27,  23 => 4,  480 => 301,  474 => 204,  469 => 203,  461 => 200,  457 => 199,  453 => 169,  444 => 236,  440 => 203,  437 => 187,  435 => 247,  430 => 245,  427 => 244,  423 => 206,  413 => 119,  409 => 117,  407 => 171,  402 => 114,  398 => 184,  393 => 223,  387 => 218,  384 => 215,  381 => 107,  379 => 106,  374 => 161,  368 => 144,  365 => 154,  362 => 101,  360 => 219,  355 => 98,  341 => 129,  337 => 144,  322 => 172,  314 => 149,  312 => 151,  309 => 130,  305 => 122,  298 => 146,  294 => 152,  285 => 147,  283 => 122,  278 => 108,  268 => 183,  264 => 150,  258 => 138,  252 => 98,  247 => 163,  241 => 107,  229 => 91,  220 => 98,  214 => 92,  177 => 93,  169 => 68,  140 => 60,  132 => 61,  128 => 55,  107 => 67,  61 => 28,  273 => 119,  269 => 118,  254 => 129,  243 => 116,  240 => 121,  238 => 96,  235 => 144,  230 => 102,  227 => 101,  224 => 108,  221 => 87,  219 => 103,  217 => 138,  208 => 100,  204 => 164,  179 => 80,  159 => 63,  143 => 74,  135 => 47,  119 => 64,  102 => 66,  71 => 50,  67 => 24,  63 => 29,  59 => 20,  38 => 9,  94 => 41,  89 => 39,  85 => 31,  75 => 34,  68 => 31,  56 => 26,  201 => 81,  196 => 81,  183 => 79,  171 => 72,  166 => 71,  163 => 64,  158 => 68,  156 => 58,  151 => 56,  142 => 61,  138 => 66,  136 => 111,  121 => 45,  117 => 69,  105 => 41,  91 => 35,  62 => 16,  49 => 19,  28 => 5,  26 => 6,  87 => 42,  31 => 6,  25 => 5,  21 => 6,  24 => 5,  19 => 2,  93 => 35,  88 => 34,  78 => 30,  46 => 15,  44 => 11,  27 => 7,  79 => 54,  72 => 33,  69 => 25,  47 => 18,  40 => 20,  37 => 11,  22 => 3,  246 => 111,  157 => 75,  145 => 63,  139 => 55,  131 => 45,  123 => 42,  120 => 41,  115 => 50,  111 => 42,  108 => 43,  101 => 44,  98 => 43,  96 => 44,  83 => 30,  74 => 28,  66 => 30,  55 => 19,  52 => 20,  50 => 16,  43 => 16,  41 => 13,  35 => 8,  32 => 13,  29 => 9,  209 => 93,  203 => 93,  199 => 89,  193 => 77,  189 => 84,  187 => 76,  182 => 77,  176 => 62,  173 => 71,  168 => 67,  164 => 70,  162 => 62,  154 => 66,  149 => 64,  147 => 54,  144 => 75,  141 => 74,  133 => 64,  130 => 56,  125 => 54,  122 => 53,  116 => 50,  112 => 45,  109 => 41,  106 => 46,  103 => 40,  99 => 38,  95 => 49,  92 => 40,  86 => 38,  82 => 36,  80 => 35,  73 => 26,  64 => 23,  60 => 29,  57 => 22,  54 => 21,  51 => 23,  48 => 21,  45 => 19,  42 => 17,  39 => 15,  36 => 13,  33 => 11,  30 => 9,);
    }
}
