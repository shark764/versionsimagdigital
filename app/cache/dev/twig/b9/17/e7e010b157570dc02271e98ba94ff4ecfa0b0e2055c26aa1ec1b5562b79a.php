<?php

/* MinsalSimagdBundle:ImgPendienteLecturaAdmin:pndL_list_v2.html.twig */
class __TwigTemplate_b917e7e010b157570dc02271e98ba94ff4ecfa0b0e2055c26aa1ec1b5562b79a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_list_v2.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'simagd_bs_alert' => array($this, 'block_simagd_bs_alert'),
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
        $context["_PNDL_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_PNDL_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_LECTURA_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_PNDL_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_LECTURA_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 11
        $context["_PNDLPR_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_LECTURAS_NO_CONCLUIDAS_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 14
        $context["_PNDV_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_VALIDACION_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 15
        $context["_PNDV_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_VALIDACION_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 16
        $context["_PNDV_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_VALIDACION_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 18
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 19
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    ";
        // line 22
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

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
        var \$pattern_bstable_container  = 'menu-listas-lecturas-pendientes';
        
        /** Lista de patrones para diagnósticos */
\tvar \$DIAGNOSTIC_PATTERN_LIST            = null,
            \$isGranted_assigWorklist,
            \$isGranted_assigValidationWorklist;
\t
        \$isGranted_assigWorklist        = ";
        // line 42
        if (((((isset($context["_PNDL_ALLOW_EDIT"]) ? $context["_PNDL_ALLOW_EDIT"] : $this->getContext($context, "_PNDL_ALLOW_EDIT")) == true) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t
        \$isGranted_assigValidationWorklist  = ";
        // line 44
        if ((((isset($context["_PNDV_ALLOW_EDIT"]) ? $context["_PNDV_ALLOW_EDIT"] : $this->getContext($context, "_PNDV_ALLOW_EDIT")) == true) && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE")))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t
        jQuery(document).ready(function() {
            /*
             * get sources from remote
             */
            var \$getJSON_url            = 'simagd_patron_diagnostico_listarPatronesDiagnostico';  // --| url to get the sources
            \$.getJSON(Routing.generate(\$getJSON_url), {
                filters: JSON.stringify([]),
            })
            .done(function(data) {
                /*
                 * set the sources in \$DIAGNOSTIC_PATTERN_LIST object
                 */
                \$DIAGNOSTIC_PATTERN_LIST        = data;
            })
            .fail(function(jqxhr, textStatus, error) {
                var err                 = textStatus + \", \" + error;
                console.log( \"Request failed: \" + err );
                
                \$DIAGNOSTIC_PATTERN_LIST        = [];
            });
        });
    </script>

    ";
        // line 70
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/lang/summernote-es-ES.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_summernote_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 75
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_webkitSpeechRecognition.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 78
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteLecturaAdmin/pndL_assignRadX_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteLecturaAdmin/pndL_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 81
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteLecturaAdmin/pndL_personal_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 83
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteValidacionAdmin/pndV_valid_diag_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 84
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteValidacionAdmin/pndV_assignRadXValid_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteValidacionAdmin/pndV_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 89
    public function block_simagd_bs_alert($context, array $blocks = array())
    {
        // line 90
        echo "    ";
        $this->displayParentBlock("simagd_bs_alert", $context, $blocks);
        echo "
    
    ";
        // line 92
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteLecturaAdmin:pndL_assignRadX_alert.html.twig")->display($context);
        // line 93
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_assignRadXValid_alert.html.twig")->display($context);
        // line 94
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_valid_diag_alert.html.twig")->display($context);
    }

    // line 97
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 98
        echo "    <i class=\"fa fa-microphone\"></i> <i class=\"fa fa-list-ul\"></i> Interpretaciones pendientes
";
    }

    // line 101
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 102
        echo "    <li class=\"list-table-link-navbar active ";
        if (((isset($context["_PNDL_ALLOW_LIST"]) ? $context["_PNDL_ALLOW_LIST"] : $this->getContext($context, "_PNDL_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-general-list\" data-divtabletarget=\"div-resultado-lecturas-pendientes\"
\t    ";
        // line 104
        if (((isset($context["_PNDL_ALLOW_LIST"]) ? $context["_PNDL_ALLOW_LIST"] : $this->getContext($context, "_PNDL_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-microphone\"></i> <i class=\"fa fa-list-ul\"></i> </span> Listado general <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
    <li class=\"list-table-link-navbar ";
        // line 108
        if (((isset($context["_PNDLPR_ALLOW_LIST"]) ? $context["_PNDLPR_ALLOW_LIST"] : $this->getContext($context, "_PNDLPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-personal-list\" data-divtabletarget=\"div-resultado-lecturas-personal-pendientes\"
\t    ";
        // line 110
        if (((isset($context["_PNDLPR_ALLOW_LIST"]) ? $context["_PNDLPR_ALLOW_LIST"] : $this->getContext($context, "_PNDLPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-user\"></i> <i class=\"fa fa-microphone\"></i> <i class=\"fa fa-list-ul\"></i> </span> Listado personal
\t</a>
    </li>
";
    }

    // line 116
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 117
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"true\">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
\t</div>
        <button type=\"submit\" id=\"btn_search_filter_expNumero\" name=\"btn_search_filter_expNumero\" class=\"btn btn-primary-v2 ";
        // line 122
        echo "\">
            <i class=\"fa fa-search\"></i>
        </button>
    </form>
";
    }

    // line 128
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 129
        echo "    <li class=\"list-table-link-navbar ";
        if (((isset($context["_PNDV_ALLOW_LIST"]) ? $context["_PNDV_ALLOW_LIST"] : $this->getContext($context, "_PNDV_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-sin-validar-list\" data-divtabletarget=\"div-resultado-sin-validar\"
\t    ";
        // line 131
        if (((isset($context["_PNDV_ALLOW_LIST"]) ? $context["_PNDV_ALLOW_LIST"] : $this->getContext($context, "_PNDV_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-check-square-o\"></i> <i class=\"fa fa-list-ul\"></i> </span> Resultados sin validar
\t</a>
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

    // line 144
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 145
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "
    ";
        // line 147
        echo "
    ";
        // line 148
        if (((isset($context["_PNDL_ALLOW_LIST"]) ? $context["_PNDL_ALLOW_LIST"] : $this->getContext($context, "_PNDL_ALLOW_LIST")) == true)) {
            // line 149
            echo "        <!-- toolbar for table-lista-lecturas-pendientes -->
        ";
            // line 150
            $context["code_entity"] = "pndL";
            // line 151
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 154
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 156
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 161
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 164
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 167
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-trash\"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_add_item_radx_worklist\" class=\"btn btn-element-v2 btn_add_item_radx_worklist\" title=\"Asignar lectura a lista de Radiológo\" style=\"margin-left: 15px\" disabled=\"disabled\">
                    <i class=\"glyphicon glyphicon-user \"></i>
                </button>
                <!-- END --| custom buttons for toolbar -->
            ";
            // line 179
            echo "
        </div> <!-- END --| toolbar for table-lista-lecturas-pendientes -->
        
\t<div id=\"div-resultado-lecturas-pendientes\" class=\"menu-listas-lecturas-pendientes\" data-refresh-url=\"";
            // line 182
            echo $this->env->getExtension('routing')->getPath("simagd_sin_lectura_listarPendientesLectura");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-pendientes-lectura\"
\t\t    data-toggle=\"table\"
\t\t    data-id-field=\"pndL_id\"
\t\t    data-url=\"";
            // line 186
            echo $this->env->getExtension('routing')->getPath("simagd_sin_lectura_listarPendientesLectura");
            echo "\"
\t\t    data-backup-url=\"simagd_sin_lectura_listarPendientesLectura\"
                    data-toolbar=\"#bs_pndL_toolbar\"
\t\t    data-cache=\"false\"
\t\t    data-show-refresh=\"true\"
\t\t    data-show-toggle=\"true\"
\t\t    data-show-columns=\"true\"
\t\t    data-search=\"true\"
\t\t    data-select-item-name=\"listaPendientesLecturaToolbar\"
\t\t    data-pagination=\"true\"
\t\t    data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 196
            echo "]\"
\t\t    ";
            // line 199
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t    data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 204
            echo "\t\t\t<th data-field=\"pndL_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[empprc_id, empcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[m_id, mcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"pndR_tipo\" data-formatter=\"simagdTipoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"pndL_establecimiento\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretar en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"prz_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" data-formatter=\"simagdEstadoEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"pndL_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t\t<th data-field=\"pndL_postEstudio\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"pndL_solicitudPostEstudio\" data-filter-bstable-type=\"boolean\" data-filter-bstable-data-source=\"getPostEstudioSourceData\" data-formatter=\"postEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Post Estudio</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionFormatter\" data-events=\"actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                        <th data-field=\"pndL_chk\" data-checkbox=\"true\" data-formatter=\"selectableRowFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 224
        echo "
    ";
        // line 225
        if (((isset($context["_PNDLPR_ALLOW_LIST"]) ? $context["_PNDLPR_ALLOW_LIST"] : $this->getContext($context, "_PNDLPR_ALLOW_LIST")) == true)) {
            // line 226
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 227
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "pndLPr")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 228
            echo "        <!-- END --| toolbar for table-lista-lecturas -->
        
\t<div id=\"div-resultado-lecturas-personal-pendientes\" style=\"display: none;\" class=\"menu-listas-lecturas-pendientes\" data-refresh-url=\"";
            // line 230
            echo $this->env->getExtension('routing')->getPath("simagd_mi_lista_sin_lectura_listarPendientesLectura");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-personal-pendientes-lectura\"
\t\t    data-toggle=\"table\"
\t\t    data-id-field=\"pndL_id\"
\t\t    data-url=\"\"
                    data-backup-url=\"simagd_mi_lista_sin_lectura_listarPendientesLectura\"
\t\t    data-toolbar=\"#bs_pndLPr_toolbar\"
\t\t    data-cache=\"false\"
\t\t    data-show-refresh=\"true\"
\t\t    data-show-toggle=\"true\"
\t\t    data-show-columns=\"true\"
\t\t    data-search=\"true\"
\t\t    data-select-item-name=\"listaPersonalPendientesLecturaToolbar\"
\t\t    data-pagination=\"true\"
\t\t    data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 244
            echo "]\"
\t\t    ";
            // line 247
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t    data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 252
            echo "\t\t\t<th data-field=\"pndL_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[empprc_id, empcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[m_id, mcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"pndR_tipo\" data-formatter=\"simagdTipoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"pndL_establecimiento\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretar en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"prz_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" data-formatter=\"simagdEstadoEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"pndL_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t\t<th data-field=\"pndL_postEstudio\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"pndL_solicitudPostEstudio\" data-filter-bstable-type=\"boolean\" data-filter-bstable-data-source=\"getPostEstudioSourceData\" data-formatter=\"postEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Post Estudio</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionPersonalFormatter\" data-events=\"actionPersonalEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 271
        echo "
    ";
        // line 272
        if (((isset($context["_PNDV_ALLOW_LIST"]) ? $context["_PNDV_ALLOW_LIST"] : $this->getContext($context, "_PNDV_ALLOW_LIST")) == true)) {
            // line 273
            echo "        <!-- toolbar for table-lista-validaciones-pendientes -->
        ";
            // line 274
            $context["code_entity"] = "pndV";
            // line 275
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 278
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 280
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 285
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 288
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 291
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-trash\"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_add_item_radx_validation_worklist\" class=\"btn btn-element-v2 btn_add_item_radx_validation_worklist\" title=\"Asignar diagnóstico a lista de Radiológo\" style=\"margin-left: 15px\" disabled=\"disabled\">
                    <i class=\"glyphicon glyphicon-user \"></i>
                </button>
                <!-- END --| custom buttons for toolbar -->
            ";
            // line 303
            echo "
        </div> <!-- END --| toolbar for table-lista-validaciones-pendientes -->
        
\t";
            // line 306
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_list_v2.html.twig")->display(array_merge($context, array("view_menu_class" => "menu-listas-lecturas-pendientes")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 307
            echo "    ";
            // line 308
            echo "    ";
        }
        // line 309
        echo "                    
    ";
        // line 310
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 311
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_transcribirDiagnostico_modal.html.twig")->display(array_merge($context, array("estados" => (isset($context["estadosDiag"]) ? $context["estadosDiag"] : $this->getContext($context, "estadosDiag")), "transcriptores" => (isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "estadoDiagDefault" => (isset($context["estadoDiagDefault"]) ? $context["estadoDiagDefault"] : $this->getContext($context, "estadoDiagDefault")), "patronesDiag" => (isset($context["patronesDiag"]) ? $context["patronesDiag"] : $this->getContext($context, "patronesDiag")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 313
            echo "    ";
        }
        // line 314
        echo "
    ";
        // line 315
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 316
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:lct_total_info_modal_v2.html.twig")->display($context);
            echo "    ";
            // line 317
            echo "    ";
        }
        // line 318
        echo "    ";
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 319
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:diag_total_info_modal_v2.html.twig")->display($context);
            echo "    ";
            // line 320
            echo "    ";
        }
        // line 321
        echo "    
    ";
        // line 322
        $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_speechRecognition_modal.html.twig")->display($context);
        echo "    ";
        // line 323
        echo "    
    <!-- form for assign radX to rows -->
    ";
        // line 325
        if (((((isset($context["_PNDL_ALLOW_EDIT"]) ? $context["_PNDL_ALLOW_EDIT"] : $this->getContext($context, "_PNDL_ALLOW_EDIT")) == true) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE"))) {
            // line 326
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteLecturaAdmin:pndL_asignarRadiologoListaTrabajo_modal.html.twig")->display(array_merge($context, array("radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 328
            echo "    ";
        }
        // line 329
        echo "    
    <!-- form for assign radX to validation rows -->
    ";
        // line 331
        if ((((isset($context["_PNDV_ALLOW_EDIT"]) ? $context["_PNDV_ALLOW_EDIT"] : $this->getContext($context, "_PNDV_ALLOW_EDIT")) == true) && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE")))) {
            // line 332
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_asignarRadiologoListaTrabajo_modal.html.twig")->display(array_merge($context, array("radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 334
            echo "    ";
        }
        // line 335
        echo "    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgPendienteLecturaAdmin:pndL_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  627 => 335,  624 => 334,  616 => 332,  614 => 331,  610 => 329,  607 => 328,  599 => 326,  597 => 325,  593 => 323,  590 => 322,  587 => 321,  584 => 320,  580 => 319,  577 => 318,  574 => 317,  570 => 316,  568 => 315,  565 => 314,  562 => 313,  554 => 311,  552 => 310,  549 => 309,  546 => 308,  544 => 307,  537 => 306,  532 => 303,  517 => 291,  510 => 288,  504 => 285,  496 => 280,  492 => 278,  486 => 275,  484 => 274,  481 => 273,  479 => 272,  476 => 271,  455 => 252,  449 => 247,  446 => 244,  429 => 230,  425 => 228,  418 => 227,  415 => 226,  413 => 225,  410 => 224,  388 => 204,  382 => 199,  379 => 196,  366 => 186,  359 => 182,  354 => 179,  339 => 167,  332 => 164,  326 => 161,  318 => 156,  314 => 154,  308 => 151,  306 => 150,  303 => 149,  301 => 148,  298 => 147,  294 => 145,  291 => 144,  273 => 131,  265 => 129,  262 => 128,  254 => 122,  247 => 117,  244 => 116,  233 => 110,  226 => 108,  217 => 104,  209 => 102,  206 => 101,  201 => 98,  198 => 97,  193 => 94,  190 => 93,  188 => 92,  182 => 90,  179 => 89,  172 => 85,  168 => 84,  163 => 83,  158 => 81,  154 => 79,  149 => 78,  143 => 75,  138 => 72,  134 => 71,  129 => 70,  97 => 44,  88 => 42,  69 => 27,  66 => 26,  58 => 22,  52 => 19,  49 => 18,  44 => 16,  42 => 15,  40 => 14,  38 => 11,  36 => 8,  34 => 7,  32 => 6,);
    }
}
