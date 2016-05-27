<?php

/* MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_list_v2.html.twig */
class __TwigTemplate_ee8e1d5535af702f3305898810de3484cb568d76c4e2fd3c81621d5037cd22f7 extends Twig_Template
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
        $context["_PNDT_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_TRANSCRIPCION_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_PNDT_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_TRANSCRIPCION_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_PNDT_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_TRANSCRIPCION_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 11
        $context["_PNDTPR_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_TRANSCRIPCIONES_NO_CONCLUIDAS_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 14
        $context["_PNDV_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_VALIDACION_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 16
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 17
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    ";
        // line 20
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

";
    }

    // line 24
    public function block_javascripts($context, array $blocks = array())
    {
        // line 25
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         * 
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-transcripciones-pendientes';
        
        /** Lista de patrones para diagnósticos */
\tvar \$listDiagPattern            = null,
            \$isGranted_assigWorklist;
\t
        \$isGranted_assigWorklist        = ";
        // line 39
        if (((((isset($context["_PNDT_ALLOW_EDIT"]) ? $context["_PNDT_ALLOW_EDIT"] : $this->getContext($context, "_PNDT_ALLOW_EDIT")) == true) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE"))) {
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
                 * set the sources in \$listDiagPattern object
                 */
                \$listDiagPattern        = data;
            })
            .fail(function(jqxhr, textStatus, error) {
                var err                 = textStatus + \", \" + error;
                console.log( \"Request failed: \" + err );
                
                \$listDiagPattern        = [];
            });
        });
    </script>

    ";
        // line 65
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/lang/summernote-es-ES.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_summernote_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 70
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_webkitSpeechRecognition.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 73
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteTranscripcionAdmin/pndT_assignTrcX_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteTranscripcionAdmin/pndT_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 76
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteTranscripcionAdmin/pndT_personal_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 78
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteValidacionAdmin/pndV_valid_diag_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteValidacionAdmin/pndV_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 83
    public function block_simagd_bs_alert($context, array $blocks = array())
    {
        // line 84
        echo "    ";
        $this->displayParentBlock("simagd_bs_alert", $context, $blocks);
        echo "
    
    ";
        // line 86
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_assignTrcX_alert.html.twig")->display($context);
        // line 87
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_valid_diag_alert.html.twig")->display($context);
    }

    // line 90
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 91
        echo "    <i class=\"fa fa-clipboard\"></i> <i class=\"fa fa-list-ul\"></i> Transcripción pendientes
";
    }

    // line 94
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 95
        echo "    <li class=\"list-table-link-navbar active ";
        if (((isset($context["_PNDT_ALLOW_LIST"]) ? $context["_PNDT_ALLOW_LIST"] : $this->getContext($context, "_PNDT_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-general-list\" data-divtabletarget=\"div-resultado-transcripciones-pendientes\"
\t    ";
        // line 97
        if (((isset($context["_PNDT_ALLOW_LIST"]) ? $context["_PNDT_ALLOW_LIST"] : $this->getContext($context, "_PNDT_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-clipboard\"></i> <i class=\"fa fa-list-ul\"></i> </span> Listado general <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
    <li class=\"list-table-link-navbar ";
        // line 101
        if (((isset($context["_PNDTPR_ALLOW_LIST"]) ? $context["_PNDTPR_ALLOW_LIST"] : $this->getContext($context, "_PNDTPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-personal-list\" data-divtabletarget=\"div-resultado-transcripciones-personal-pendientes\"
\t    ";
        // line 103
        if (((isset($context["_PNDTPR_ALLOW_LIST"]) ? $context["_PNDTPR_ALLOW_LIST"] : $this->getContext($context, "_PNDTPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-user\"></i> <i class=\"fa fa-clipboard\"></i> <i class=\"fa fa-list-ul\"></i> </span> Listado personal ";
        // line 105
        echo "\t</a>
    </li>
";
    }

    // line 109
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 110
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"true\">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
\t</div>
        <button type=\"submit\" id=\"btn_search_filter_expNumero\" name=\"btn_search_filter_expNumero\" class=\"btn btn-primary-v2 ";
        // line 115
        echo "\">
            <i class=\"fa fa-search\"></i>
        </button>
    </form>
";
    }

    // line 121
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 122
        echo "    <li class=\"list-table-link-navbar ";
        if (((isset($context["_PNDV_ALLOW_LIST"]) ? $context["_PNDV_ALLOW_LIST"] : $this->getContext($context, "_PNDV_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-sin-validar-list\" data-divtabletarget=\"div-resultado-sin-validar\"
\t    ";
        // line 124
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

    // line 137
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 138
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    ";
        // line 140
        if (((isset($context["_PNDT_ALLOW_LIST"]) ? $context["_PNDT_ALLOW_LIST"] : $this->getContext($context, "_PNDT_ALLOW_LIST")) == true)) {
            // line 141
            echo "        <!-- toolbar for table-lista-transcripciones-pendientes -->
        ";
            // line 142
            $context["code_entity"] = "pndT";
            // line 143
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 146
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 148
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 153
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 156
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 159
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-trash\"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_add_item_trcx_worklist\" class=\"btn btn-element-v2 btn_add_item_trcx_worklist\" title=\"Asignar lectura a lista de Transcriptor\" style=\"margin-left: 15px\" disabled=\"disabled\">
                    <i class=\"glyphicon glyphicon-user \"></i>
                </button>
                <!-- END --| custom buttons for toolbar -->
            ";
            // line 171
            echo "
        </div> <!-- END --| toolbar for table-lista-transcripciones-pendientes -->
        
\t<div id=\"div-resultado-transcripciones-pendientes\" class=\"menu-listas-transcripciones-pendientes\" data-refresh-url=\"";
            // line 174
            echo $this->env->getExtension('routing')->getPath("simagd_sin_transcribir_listarPendientesTranscripcion");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-pendientes-transcripcion\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"pndT_id\"
\t\t  data-url=\"";
            // line 178
            echo $this->env->getExtension('routing')->getPath("simagd_sin_transcribir_listarPendientesTranscripcion");
            echo "\"
\t\t  data-backup-url=\"simagd_sin_transcribir_listarPendientesTranscripcion\"
\t\t  data-toolbar=\"#bs_pndT_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaPendientesTranscripcionToolbar\"
\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 188
            echo "]\"
\t\t  ";
            // line 191
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 196
            echo "\t\t\t<th data-field=\"pndT_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prc_referido\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizado en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"lct_radiologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"emplct_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretó</th>
\t\t\t<th data-field=\"lct_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statuslct_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"lct_fechaLectura\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se interpretó</th>
\t\t\t<th data-field=\"lct_correlativo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Correlativo</th>
\t\t\t<th data-field=\"pndT_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t\t<th data-field=\"pndT_fueImpugnado\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"boolean\" data-formatter=\"impugnadoFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Para corrección</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionFormatter\" data-events=\"actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                        <th data-field=\"pndT_chk\" data-checkbox=\"true\" data-formatter=\"selectableRowFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 218
        echo "
    ";
        // line 219
        if (((isset($context["_PNDTPR_ALLOW_LIST"]) ? $context["_PNDTPR_ALLOW_LIST"] : $this->getContext($context, "_PNDTPR_ALLOW_LIST")) == true)) {
            // line 220
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 221
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "pndTPr")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 222
            echo "        <!-- END --| toolbar for table-lista-lecturas -->
        
\t<div id=\"div-resultado-transcripciones-personal-pendientes\" style=\"display: none;\" class=\"menu-listas-transcripciones-pendientes\" data-refresh-url=\"";
            // line 224
            echo $this->env->getExtension('routing')->getPath("simagd_mi_lista_sin_transcribir_listarPendientesTranscripcion");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-personal-pendientes-transcripcion\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"pndT_id\"
\t\t  data-url=\"\"
                  data-backup-url=\"simagd_mi_lista_sin_transcribir_listarPendientesTranscripcion\"
\t\t  data-toolbar=\"#bs_pndTPr_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaPersonalPendientesTranscripcionToolbar\"
\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 238
            echo "]\"
\t\t  ";
            // line 241
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 246
            echo "\t\t\t<th data-field=\"pndT_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prc_referido\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizado en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"lct_radiologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"emplct_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretó</th>
\t\t\t<th data-field=\"lct_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statuslct_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"lct_fechaLectura\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se interpretó</th>
\t\t\t<th data-field=\"lct_correlativo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Correlativo</th>
\t\t\t<th data-field=\"pndT_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t\t<th data-field=\"pndT_fueImpugnado\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"boolean\" data-formatter=\"impugnadoFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Para corrección</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionPersonalFormatter\" data-events=\"actionPersonalEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 267
        echo "
    ";
        // line 268
        if (((isset($context["_PNDV_ALLOW_LIST"]) ? $context["_PNDV_ALLOW_LIST"] : $this->getContext($context, "_PNDV_ALLOW_LIST")) == true)) {
            // line 269
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 270
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "pndV")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 271
            echo "        <!-- END --| toolbar for table-lista-lecturas -->
        
\t";
            // line 273
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_list_v2.html.twig")->display(array_merge($context, array("view_menu_class" => "menu-listas-transcripciones-pendientes")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 274
            echo "    ";
            // line 275
            echo "    ";
        }
        // line 276
        echo "        
    ";
        // line 277
        if ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 278
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_transcribirDiagnostico_modal.html.twig")->display(array_merge($context, array("estados" => (isset($context["estadosDiag"]) ? $context["estadosDiag"] : $this->getContext($context, "estadosDiag")), "transcriptores" => (isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "estadoDiagDefault" => (isset($context["estadoDiagDefault"]) ? $context["estadoDiagDefault"] : $this->getContext($context, "estadoDiagDefault")), "patronesDiag" => (isset($context["patronesDiag"]) ? $context["patronesDiag"] : $this->getContext($context, "patronesDiag")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 280
            echo "    ";
        }
        // line 281
        echo "        
    ";
        // line 282
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 283
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:diag_total_info_modal_v2.html.twig")->display($context);
            echo "    ";
            // line 284
            echo "    ";
        }
        // line 285
        echo "    
    ";
        // line 286
        $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_speechRecognition_modal.html.twig")->display($context);
        echo "    ";
        // line 287
        echo "    
    <!-- form for assign trcX to rows -->
    ";
        // line 289
        if (((((isset($context["_PNDT_ALLOW_EDIT"]) ? $context["_PNDT_ALLOW_EDIT"] : $this->getContext($context, "_PNDT_ALLOW_EDIT")) == true) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE"))) {
            // line 290
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_asignarTranscriptorListaTrabajo_modal.html.twig")->display(array_merge($context, array("transcriptores" => (isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 292
            echo "    ";
        }
        // line 293
        echo "    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  540 => 293,  537 => 292,  529 => 290,  527 => 289,  523 => 287,  520 => 286,  517 => 285,  514 => 284,  510 => 283,  508 => 282,  505 => 281,  502 => 280,  494 => 278,  492 => 277,  489 => 276,  486 => 275,  484 => 274,  477 => 273,  473 => 271,  466 => 270,  463 => 269,  461 => 268,  458 => 267,  435 => 246,  429 => 241,  426 => 238,  409 => 224,  405 => 222,  398 => 221,  395 => 220,  393 => 219,  390 => 218,  366 => 196,  360 => 191,  357 => 188,  344 => 178,  337 => 174,  332 => 171,  317 => 159,  310 => 156,  304 => 153,  296 => 148,  292 => 146,  286 => 143,  284 => 142,  281 => 141,  279 => 140,  274 => 138,  271 => 137,  253 => 124,  245 => 122,  242 => 121,  234 => 115,  227 => 110,  224 => 109,  218 => 105,  212 => 103,  205 => 101,  196 => 97,  188 => 95,  185 => 94,  180 => 91,  177 => 90,  172 => 87,  170 => 86,  164 => 84,  161 => 83,  154 => 79,  149 => 78,  144 => 76,  140 => 74,  135 => 73,  129 => 70,  124 => 67,  120 => 66,  115 => 65,  83 => 39,  65 => 25,  62 => 24,  54 => 20,  48 => 17,  45 => 16,  40 => 14,  38 => 11,  36 => 8,  34 => 7,  32 => 6,);
    }
}
