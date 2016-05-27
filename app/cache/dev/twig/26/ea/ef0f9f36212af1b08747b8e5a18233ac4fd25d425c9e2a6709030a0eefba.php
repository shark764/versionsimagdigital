<?php

/* MinsalSimagdBundle:ImgPendienteRealizacionAdmin:pndR_list_v2.html.twig */
class __TwigTemplate_26eaef0f9f36212af1b08747b8e5a18233ac4fd25d425c9e2a6709030a0eefba extends Twig_Template
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
        $context["_PNDR_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_REALIZACION_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_PNDR_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_REALIZACION_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_PNDR_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_REALIZACION_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 11
        $context["_PNDRPR_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_EXAMENES_NO_CONCLUIDOS_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 12
        $context["_PNDRPR_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_EXAMENES_NO_CONCLUIDOS_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 13
        $context["_PNDRPR_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_EXAMENES_NO_CONCLUIDOS_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 16
        $context["_PRC_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 17
        $context["_PRC_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 18
        $context["_PRC_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 19
        $context["_PRC_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 21
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 22
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

";
    }

    // line 26
    public function block_javascripts($context, array $blocks = array())
    {
        // line 27
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         *
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-examenes-pendientes';

        var \$isGranted_studyRequest,
            \$isGranted_studyView;

\tvar \$is_tcnlX;

\t\$is_tcnlX\t\t= ";
        // line 42
        if ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

        \$isGranted_studyRequest = ";
        // line 44
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) && ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
        \$isGranted_studyView    = ";
        // line 45
        if ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$is_tcnlX);

";
        // line 50
        echo "
        (function (\$) {
            /*
             *
             * @type type
             * Global variables for plugin
             */
            window.GROUP_DEPENDENT_ENTITIES = null;   // --| build data collection
            GROUP_DEPENDENT_ENTITIES        = JSON.parse('";
        // line 58
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["GROUP_DEPENDENT_ENTITIES"]) ? $context["GROUP_DEPENDENT_ENTITIES"] : $this->getContext($context, "GROUP_DEPENDENT_ENTITIES"))), "js");
        echo "');

        }(jQuery));
    </script>

    ";
        // line 64
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteRealizacionAdmin/pndR_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 66
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteRealizacionAdmin/pndR_personal_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 70
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 71
        echo "    <i class=\"fa fa-desktop\"></i> <i class=\"fa fa-list-ul\"></i> Procedimientos no realizados
";
    }

    // line 74
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 75
        echo "    <li class=\"list-table-link-navbar active ";
        if (((isset($context["_PNDR_ALLOW_LIST"]) ? $context["_PNDR_ALLOW_LIST"] : $this->getContext($context, "_PNDR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-general-list\" data-divtabletarget=\"div-resultado-examenes-pendientes\"
\t    ";
        // line 77
        if (((isset($context["_PNDR_ALLOW_LIST"]) ? $context["_PNDR_ALLOW_LIST"] : $this->getContext($context, "_PNDR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-desktop\"></i> <i class=\"fa fa-list-ul\"></i> </span> Listado general <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
    <li class=\"list-table-link-navbar ";
        // line 81
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-personal-list\" data-divtabletarget=\"div-resultado-examenes-personal-pendientes\"
\t    ";
        // line 83
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-user\"></i> <i class=\"fa fa-desktop\"></i> <i class=\"fa fa-list-ul\"></i> </span> Listado personal
\t</a>
    </li>
";
    }

    // line 89
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 90
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"true\" data-template-source=\"getSearchExpedienteSourceTemplate\">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
\t</div>
        <button type=\"submit\" id=\"btn_search_filter_expNumero\" name=\"btn_search_filter_expNumero\" class=\"btn btn-primary-v2 ";
        // line 95
        echo "\">
            <i class=\"fa fa-search\"></i>
        </button>
    </form>
";
    }

    // line 101
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
    }

    // line 104
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 105
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "
    ";
        // line 113
        echo "    ";
        if (((isset($context["_PNDR_ALLOW_LIST"]) ? $context["_PNDR_ALLOW_LIST"] : $this->getContext($context, "_PNDR_ALLOW_LIST")) == true)) {
            // line 114
            echo "        <!-- toolbar for table-lista-pendientes-realizar -->
        ";
            // line 115
            $context["code_entity"] = "pndR";
            // line 116
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 119
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 121
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 126
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 129
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 132
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-trash\"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>

                <button id=\"btn_unknown_patient_add_item\" class=\"btn btn-danger btn_unknown_patient_add_item\" title=\"Agregar paciente de emergencia\" style=\"margin-left: 15px\"
                        ";
            // line 140
            if ((!((((isset($context["_PNDR_ALLOW_CREATE"]) ? $context["_PNDR_ALLOW_CREATE"] : $this->getContext($context, "_PNDR_ALLOW_CREATE")) == true) && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                    <i class=\"glyphicon glyphicon-plus-sign \"></i>
                </button>

                <span class=\"btn-separator\"></span>

                <button id=\"btn_external_patient_add_item\" class=\"btn btn-element-v2 btn_external_patient_add_item\" title=\"Agregar paciente referido\" style=\"margin-left: 15px\"
                        ";
            // line 147
            if ((!((((isset($context["_PNDR_ALLOW_CREATE"]) ? $context["_PNDR_ALLOW_CREATE"] : $this->getContext($context, "_PNDR_ALLOW_CREATE")) == true) && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                    <i class=\"glyphicon glyphicon-plus-sign \"></i>
                </button>
                <!-- END --| custom buttons for toolbar -->
            ";
            // line 152
            echo "
        </div> <!-- END --| toolbar for table-lista-pendientes-realizar -->

\t<div id=\"div-resultado-examenes-pendientes\" class=\"menu-listas-examenes-pendientes\" data-refresh-url=\"";
            // line 155
            echo $this->env->getExtension('routing')->getPath("simagd_sin_realizar_listarPendientesRealizar");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-pendientes-realizar\"
\t\t    data-toggle=\"table\"
\t\t    data-id-field=\"pndR_id\"
\t\t    data-url=\"";
            // line 159
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
            // line 169
            echo "]\"
\t\t    ";
            // line 172
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
                    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 177
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
        // line 195
        echo "
    ";
        // line 196
        if (((isset($context["_PNDRPR_ALLOW_LIST"]) ? $context["_PNDRPR_ALLOW_LIST"] : $this->getContext($context, "_PNDRPR_ALLOW_LIST")) == true)) {
            // line 197
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 198
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "pndRPr")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 199
            echo "        <!-- END --| toolbar for table-lista-lecturas -->

\t<div id=\"div-resultado-examenes-personal-pendientes\" style=\"display: none;\" class=\"menu-listas-examenes-pendientes\" data-refresh-url=\"";
            // line 201
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
            // line 215
            echo "]\"
\t\t    ";
            // line 218
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t    data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 223
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
        // line 240
        echo "
    ";
        // line 241
        if ((((((isset($context["_PNDR_ALLOW_CREATE"]) ? $context["_PNDR_ALLOW_CREATE"] : $this->getContext($context, "_PNDR_ALLOW_CREATE")) == true) && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || ((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true)) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            // line 242
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_crearSolicitudEstudio_formatoRapido_modal.html.twig")->display(array_merge($context, array("medicos" => (isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "proyecciones" => (isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 243
            echo "     ";
            // line 244
            echo "    ";
        }
        // line 245
        echo "
    ";
        // line 246
        if (((((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 247
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_asignarNuevoExpediente_modal.html.twig")->display($context);
            echo "     ";
            // line 248
            echo "    ";
        }
        // line 249
        echo "
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgPendienteRealizacionAdmin:pndR_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  442 => 249,  439 => 248,  435 => 247,  433 => 246,  430 => 245,  427 => 244,  425 => 243,  417 => 242,  415 => 241,  412 => 240,  393 => 223,  387 => 218,  384 => 215,  367 => 201,  363 => 199,  356 => 198,  353 => 197,  351 => 196,  348 => 195,  328 => 177,  322 => 172,  319 => 169,  306 => 159,  299 => 155,  294 => 152,  285 => 147,  273 => 140,  261 => 132,  254 => 129,  248 => 126,  240 => 121,  236 => 119,  230 => 116,  228 => 115,  225 => 114,  222 => 113,  218 => 105,  215 => 104,  210 => 101,  202 => 95,  195 => 90,  192 => 89,  181 => 83,  174 => 81,  165 => 77,  157 => 75,  154 => 74,  149 => 71,  146 => 70,  138 => 66,  133 => 64,  125 => 58,  115 => 50,  104 => 45,  96 => 44,  87 => 42,  68 => 27,  65 => 26,  57 => 22,  54 => 21,  49 => 19,  47 => 18,  45 => 17,  43 => 16,  41 => 13,  39 => 12,  37 => 11,  35 => 8,  33 => 7,  31 => 6,);
    }
}
