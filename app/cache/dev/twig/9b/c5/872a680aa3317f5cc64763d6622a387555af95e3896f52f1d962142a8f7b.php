<?php

/* MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_list_v2.html.twig */
class __TwigTemplate_9bc5872a680aa3317f5cc64763d6622a387555af95e3896f52f1d962142a8f7b extends Twig_Template
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
            'simagd_navbar_middle_nav' => array($this, 'block_simagd_navbar_middle_nav'),
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
        $context["_PRZ_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_PRZ_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_PRZ_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        $context["_PRZ_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 12
        $context["_PNDR_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_REALIZACION_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 13
        $context["_PNDR_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_REALIZACION_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 14
        $context["_PNDR_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_REALIZACION_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 17
        $context["_PNDRPR_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_EXAMENES_NO_CONCLUIDOS_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 18
        $context["_PNDRPR_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_EXAMENES_NO_CONCLUIDOS_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 19
        $context["_PNDRPR_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_EXAMENES_NO_CONCLUIDOS_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 22
        $context["_PRC_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 23
        $context["_PRC_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 24
        $context["_PRC_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 25
        $context["_PRC_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 27
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 28
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

";
    }

    // line 32
    public function block_javascripts($context, array $blocks = array())
    {
        // line 33
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         *
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-procedimientos-realizados';

\tvar \$is_tcnlX;

        var \$isGranted_studyRequest,
            \$isGranted_studyView;

\t\$is_tcnlX\t\t= ";
        // line 48
        if ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

        \$isGranted_studyRequest = ";
        // line 50
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) && ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
        \$isGranted_studyView    = ";
        // line 51
        if ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$is_tcnlX);

";
        // line 56
        echo "
        (function (\$) {
            /*
             *
             * @type type
             * Global variables for plugin
             */
            window.GROUP_DEPENDENT_ENTITIES = null;   // --| build data collection
            GROUP_DEPENDENT_ENTITIES        = JSON.parse('";
        // line 64
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["GROUP_DEPENDENT_ENTITIES"]) ? $context["GROUP_DEPENDENT_ENTITIES"] : $this->getContext($context, "GROUP_DEPENDENT_ENTITIES"))), "js");
        echo "');

        }(jQuery));
    </script>

    ";
        // line 70
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgProcedimientoRealizadoAdmin/prz_list_v2.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 73
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteRealizacionAdmin/pndR_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 75
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteRealizacionAdmin/pndR_personal_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 79
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 80
        echo "    <i class=\"fa fa-desktop\"></i> Registro de exámenes
";
    }

    // line 83
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 84
        echo "    <li class=\"list-table-link-navbar active ";
        if (((isset($context["_PRZ_ALLOW_LIST"]) ? $context["_PRZ_ALLOW_LIST"] : $this->getContext($context, "_PRZ_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-general-list\" data-divtabletarget=\"div-resultado-procedimientos-realizados\"
\t    ";
        // line 86
        if (((isset($context["_PRZ_ALLOW_LIST"]) ? $context["_PRZ_ALLOW_LIST"] : $this->getContext($context, "_PRZ_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"> <i class=\"fa fa-wheelchair\"></i> <i class=\"fa fa-tasks\"></i> <i class=\"fa fa-eye-slash\"></i> <i class=\"fa fa-film\"></i> </span> Procedimientos realizados <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
";
    }

    // line 92
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 93
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"true\" data-template-source=\"getSearchExpedienteSourceTemplate\">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
\t</div>
        <button type=\"submit\" id=\"btn_search_filter_expNumero\" name=\"btn_search_filter_expNumero\" class=\"btn btn-primary-v2 ";
        // line 98
        echo "\">
            <i class=\"fa fa-search\"></i>
        </button>
    </form>
";
    }

    // line 104
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 105
        echo "    <li class=\"list-table-link-navbar-parent dropdown\">
\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><span class=\"text-info\"><i class=\"fa fa-desktop\"></i> <i class=\"fa fa-list-ul\"></i> </span> Estudios pendientes <span class=\"text-info\"><span class=\"caret\"></span></span></a>
\t<ul class=\"dropdown-menu\" role=\"menu\">
\t    <li class=\"list-table-link-navbar ";
        // line 108
        if (((isset($context["_PNDR_ALLOW_LIST"]) ? $context["_PNDR_ALLOW_LIST"] : $this->getContext($context, "_PNDR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-general-list\" data-divtabletarget=\"div-resultado-examenes-pendientes\"
\t\t\t";
        // line 110
        if (((isset($context["_PNDR_ALLOW_LIST"]) ? $context["_PNDR_ALLOW_LIST"] : $this->getContext($context, "_PNDR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                    <span class=\"glyphicon glyphicon-tasks \"></span> Listado general
\t\t</a>
\t    </li>
\t    ";
        // line 115
        echo "\t    <li class=\"list-table-link-navbar ";
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-personal-list\" data-divtabletarget=\"div-resultado-examenes-personal-pendientes\"
\t\t\t";
        // line 117
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-user \"></span> Listado personal
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar ";
        // line 122
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-personal-list\" data-divtabletarget=\"div-resultado-examenes-personal-pendientes\"
\t\t\t";
        // line 124
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-import \"></span> Referido externo
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar ";
        // line 129
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-personal-list\" data-divtabletarget=\"div-resultado-examenes-personal-pendientes\"
\t\t\t";
        // line 131
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-question-sign \"></span> Registrar desconocido
\t\t</a>
\t    </li>
\t    <li class=\"list-table-link-navbar ";
        // line 135
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-personal-list\" data-divtabletarget=\"div-resultado-examenes-personal-pendientes\"
\t\t\t";
        // line 137
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-send \"></span> Registrar emergencia
\t\t</a>
\t    </li>
\t</ul>
    </li>
";
    }

    // line 145
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 146
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "
    
    ";
        // line 152
        echo "
    ";
        // line 153
        if (((isset($context["_PRZ_ALLOW_LIST"]) ? $context["_PRZ_ALLOW_LIST"] : $this->getContext($context, "_PRZ_ALLOW_LIST")) == true)) {
            // line 154
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 155
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "prz")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 156
            echo "        <!-- END --| toolbar for table-lista-lecturas -->

\t<div id=\"div-resultado-procedimientos-realizados\" class=\"menu-listas-procedimientos-realizados\" data-refresh-url=\"";
            // line 158
            echo $this->env->getExtension('routing')->getPath("simagd_realizado_listarProcedimientosRealizados");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-procedimientos-realizados\"
\t\t    data-toggle=\"table\"
\t\t    data-id-field=\"prz_id\"
\t\t    data-url=\"";
            // line 162
            echo $this->env->getExtension('routing')->getPath("simagd_realizado_listarProcedimientosRealizados");
            echo "\"
\t\t    data-backup-url=\"simagd_realizado_listarProcedimientosRealizados\"
\t\t    data-toolbar=\"#bs_prz_toolbar\"
\t\t    data-cache=\"false\"
\t\t    data-show-refresh=\"true\"
\t\t    data-show-toggle=\"true\"
\t\t    data-show-columns=\"true\"
\t\t    data-search=\"true\"
\t\t    data-select-item-name=\"listaProcedimientosRealizadosToolbar\"
\t\t    data-pagination=\"true\"
\t\t    data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 172
            echo "]\"
\t\t    ";
            // line 175
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t    data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 180
            echo "\t\t\t<th data-field=\"prz_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[empprc_id, empcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[m_id, mcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prz_tipo\" data-formatter=\"simagdTipoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"cit_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlcit_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" data-formatter=\"tecnologoAsignadoFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Asignado a</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"prz_fechaRegistro\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-visible=\"false\" class=\"col-md-1\" data-formatter=\"simagdDateTimeFormatter\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se registró</th>
\t\t\t<th data-field=\"prz_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusprz_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdEstadoEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"prz_fechaAlmacenado\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-visible=\"false\" class=\"col-md-1\" data-formatter=\"simagdDateTimeFormatter\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se almacenó</th>
\t\t\t<th data-field=\"action\" data-formatter=\"procedimientoRealizado_actionFormatter\" data-events=\"procedimientoRealizado_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 199
        echo "
    ";
        // line 200
        if (((isset($context["_PNDR_ALLOW_LIST"]) ? $context["_PNDR_ALLOW_LIST"] : $this->getContext($context, "_PNDR_ALLOW_LIST")) == true)) {
            // line 201
            echo "        <!-- toolbar for table-lista-pendientes-realizar -->
        ";
            // line 202
            $context["code_entity"] = "pndR";
            // line 203
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 206
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 208
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 213
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 216
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 219
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-trash\"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>

                <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-primary-v2 dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Agregar paciente de emergencia\" style=\"margin-left: 15px\"
                        ";
            // line 228
            if ((!((((isset($context["_PNDR_ALLOW_CREATE"]) ? $context["_PNDR_ALLOW_CREATE"] : $this->getContext($context, "_PNDR_ALLOW_CREATE")) == true) && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                        <i class=\"glyphicon glyphicon-plus-sign \"></i>
                            Emergencia <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
\t\t    <ul class=\"dropdown-menu\" >
\t\t\t<li>
\t\t\t    <a href=\"javascript:void(0)\" id=\"btn_unknown_patient_add_item\" class=\"btn_unknown_patient_add_item\" target=\"_blank\" title=\"Registrar paciente desconocido\"
\t\t\t\t    ";
            // line 236
            if ((!(((((isset($context["_PNDR_ALLOW_CREATE"]) ? $context["_PNDR_ALLOW_CREATE"] : $this->getContext($context, "_PNDR_ALLOW_CREATE")) == true) && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || ((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true)) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)))) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
\t\t\t\t<i class=\"glyphicon glyphicon-warning-sign\"></i> Registrar desconocido
\t\t\t    </a>
\t\t\t</li>
\t\t\t<li class=\"divider\"></li>
\t\t\t<li>
\t\t\t    <a href=\"javascript:void(0)\" target=\"_blank\" title=\"Registrar externo de emergencia\"
\t\t\t\t    ";
            // line 243
            if ((!(((((isset($context["_PNDR_ALLOW_CREATE"]) ? $context["_PNDR_ALLOW_CREATE"] : $this->getContext($context, "_PNDR_ALLOW_CREATE")) == true) && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || ((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true)) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)))) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
\t\t\t\t<i class=\"glyphicon glyphicon-remove-circle\"></i> Registrar emergencia
\t\t\t    </a>
\t\t\t</li>
\t\t    </ul>
                </div>

                <span class=\"btn-separator\"></span>

                <button id=\"btn_external_patient_add_item\" class=\"btn btn-element-v2 btn_external_patient_add_item\" title=\"Agregar paciente referido\" style=\"margin-left: 15px\"
                        ";
            // line 253
            if ((!((((isset($context["_PNDR_ALLOW_CREATE"]) ? $context["_PNDR_ALLOW_CREATE"] : $this->getContext($context, "_PNDR_ALLOW_CREATE")) == true) && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                    <i class=\"glyphicon glyphicon-plus-sign \"></i> <i class=\"glyphicon glyphicon-import \"></i>
                </button>
                <!-- END --| custom buttons for toolbar -->
            ";
            // line 258
            echo "
        </div> <!-- END --| toolbar for table-lista-pendientes-realizar -->

\t<div id=\"div-resultado-examenes-pendientes\" style=\"display: none;\" class=\"menu-listas-procedimientos-realizados\" data-refresh-url=\"";
            // line 261
            echo $this->env->getExtension('routing')->getPath("simagd_sin_realizar_listarPendientesRealizar");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-pendientes-realizar\"
\t\t    data-toggle=\"table\"
\t\t    data-id-field=\"pndR_id\"
\t\t    data-url=\"";
            // line 265
            echo $this->env->getExtension('routing')->getPath("simagd_sin_realizar_listarPendientesRealizar");
            echo "\"
\t\t    data-backup-url=\"simagd_sin_realizar_listarPendientesRealizar\"
\t\t    data-toolbar=\"#bs_pndR_toolbar\"
\t\t    data-cache=\"false\"
\t\t    data-show-refresh=\"true\"
\t\t    data-show-toggle=\"true\"
\t\t    data-show-columns=\"true\"
\t\t    data-search=\"true\"
\t\t    data-select-item-name=\"listaPendientesRealizarToolbar\"
\t\t    data-pagination=\"true\"
\t\t    data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 275
            echo "]\"
\t\t    ";
            // line 278
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
                    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 283
            echo "\t\t\t<th data-field=\"pndR_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[empprc_id, empcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[m_id, mcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"pndR_tipo\" data-formatter=\"simagdTipoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"pndR_establecimiento\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizar en</th>
\t\t\t<th data-field=\"cit_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlcit_id\" data-filter-bstable-type=\"select2\" data-formatter=\"tecnologoAsignadoFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Asignado a</th>
\t\t\t<th data-field=\"pndR_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t\t<th data-field=\"action\" data-formatter=\"pendienteRealizar_actionFormatter\" data-events=\"pendienteRealizar_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                        <th data-field=\"pndR_chk\" data-checkbox=\"true\" data-formatter=\"selectableRowFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 301
        echo "
    ";
        // line 302
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == true)) {
            // line 303
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 304
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "pndRPr")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 305
            echo "        <!-- END --| toolbar for table-lista-lecturas -->

\t<div id=\"div-resultado-examenes-personal-pendientes\" style=\"display: none;\" class=\"menu-listas-procedimientos-realizados\" data-refresh-url=\"";
            // line 307
            echo $this->env->getExtension('routing')->getPath("simagd_mi_lista_sin_realizar_listarPendientesRealizar");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-personal-pendientes-realizar\"
\t\t    data-toggle=\"table\"
\t\t    data-id-field=\"pndR_id\"
\t\t    data-url=\"\"
                    data-backup-url=\"simagd_mi_lista_sin_realizar_listarPendientesRealizar\"
\t\t    data-toolbar=\"#bs_pndRPr_toolbar\"
\t\t    data-cache=\"false\"
\t\t    data-show-refresh=\"true\"
\t\t    data-show-toggle=\"true\"
\t\t    data-show-columns=\"true\"
\t\t    data-search=\"true\"
\t\t    data-select-item-name=\"listaPersonalPendientesRealizarToolbar\"
\t\t    data-pagination=\"true\"
\t\t    data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 321
            echo "]\"
\t\t    ";
            // line 324
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t    data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 329
            echo "\t\t\t<th data-field=\"pndR_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[empprc_id, empcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[m_id, mcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"pndR_tipo\" data-formatter=\"simagdTipoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"pndR_establecimiento\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizar en</th>
\t\t\t<th data-field=\"cit_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlcit_id\" data-filter-bstable-type=\"select2\" data-formatter=\"tecnologoAsignadoFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Asignado a</th>
\t\t\t<th data-field=\"pndR_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t\t<th data-field=\"action\" data-formatter=\"pendienteRealizar_personal_actionFormatter\" data-events=\"pendienteRealizar_personal_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 346
        echo "
    ";
        // line 347
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 348
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prz_total_info_modal_v2.html.twig")->display($context);
            echo "    ";
            // line 349
            echo "    ";
        }
        // line 350
        echo "
    ";
        // line 351
        if ((((((isset($context["_PNDR_ALLOW_CREATE"]) ? $context["_PNDR_ALLOW_CREATE"] : $this->getContext($context, "_PNDR_ALLOW_CREATE")) == true) && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || ((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true)) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            // line 352
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_crearSolicitudEstudio_formatoRapido_modal.html.twig")->display(array_merge($context, array("medicos" => (isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "proyecciones" => (isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 353
            echo "     ";
            // line 354
            echo "    ";
        }
        // line 355
        echo "
    ";
        // line 356
        if (((((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 357
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_asignarNuevoExpediente_modal.html.twig")->display($context);
            echo "     ";
            // line 358
            echo "    ";
        }
        // line 359
        echo "
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  643 => 359,  640 => 358,  636 => 357,  634 => 356,  631 => 355,  628 => 354,  626 => 353,  618 => 352,  616 => 351,  613 => 350,  610 => 349,  606 => 348,  604 => 347,  601 => 346,  582 => 329,  576 => 324,  573 => 321,  556 => 307,  552 => 305,  545 => 304,  542 => 303,  540 => 302,  537 => 301,  517 => 283,  511 => 278,  508 => 275,  495 => 265,  488 => 261,  483 => 258,  474 => 253,  459 => 243,  447 => 236,  434 => 228,  421 => 219,  414 => 216,  408 => 213,  400 => 208,  396 => 206,  390 => 203,  388 => 202,  385 => 201,  383 => 200,  380 => 199,  359 => 180,  353 => 175,  350 => 172,  337 => 162,  330 => 158,  326 => 156,  319 => 155,  316 => 154,  314 => 153,  311 => 152,  306 => 146,  303 => 145,  290 => 137,  283 => 135,  274 => 131,  267 => 129,  257 => 124,  250 => 122,  240 => 117,  232 => 115,  223 => 110,  216 => 108,  211 => 105,  208 => 104,  200 => 98,  193 => 93,  190 => 92,  179 => 86,  171 => 84,  168 => 83,  163 => 80,  160 => 79,  152 => 75,  147 => 73,  141 => 70,  133 => 64,  123 => 56,  112 => 51,  104 => 50,  95 => 48,  76 => 33,  73 => 32,  65 => 28,  62 => 27,  57 => 25,  55 => 24,  53 => 23,  51 => 22,  49 => 19,  47 => 18,  45 => 17,  43 => 14,  41 => 13,  39 => 12,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
