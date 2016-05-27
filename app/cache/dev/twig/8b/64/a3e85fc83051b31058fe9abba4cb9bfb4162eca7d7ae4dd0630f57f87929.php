<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_list_v2.html.twig */
class __TwigTemplate_8b64a3e85fc83051b31058fe9abba4cb9bfb4162eca7d7ae4dd0630f57f87929 extends Twig_Template
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
        $context["_PRC_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_PRC_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_PRC_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        $context["_PRC_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 12
        $context["_SOLDIAG_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 13
        $context["_SOLDIAG_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 14
        $context["_SOLDIAG_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 15
        $context["_SOLDIAG_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_DIAGNOSTICO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 18
        $context["_SOLCMPL_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 19
        $context["_SOLCMPL_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 20
        $context["_SOLCMPL_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 21
        $context["_SOLCMPL_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 23
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 24
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    ";
        // line 27
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

";
    }

    // line 31
    public function block_javascripts($context, array $blocks = array())
    {
        // line 32
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    
    <script>
        /*
         * 
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-solicitudes';
        
        var \$isGranted_studyRequest,
            \$isGranted_studyView,
            \$isGranted_assignNewRecord;
        
\tvar \$selectionsPriority\t\t= [],
            \$listPriority \t\t= [],
            \$prc_is_granted_changePriority,
\t    \$solcmpl_is_granted_changePriority;
\t
        \$isGranted_studyRequest             = ";
        // line 51
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) && ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
        \$isGranted_studyView                = ";
        // line 52
        if ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
        \$isGranted_assignNewRecord          = ";
        // line 53
        if (((((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t\$prc_is_granted_changePriority      = ";
        // line 54
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t\$solcmpl_is_granted_changePriority  = ";
        // line 55
        if ((((isset($context["_SOLCMPL_ALLOW_CREATE"]) ? $context["_SOLCMPL_ALLOW_CREATE"] : $this->getContext($context, "_SOLCMPL_ALLOW_CREATE")) == true) || ((isset($context["_SOLCMPL_ALLOW_EDIT"]) ? $context["_SOLCMPL_ALLOW_EDIT"] : $this->getContext($context, "_SOLCMPL_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t
        jQuery(document).ready(function() {
\t    /** Lista de prioridades */
\t    ";
        // line 59
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["prioridades"]) ? $context["prioridades"] : $this->getContext($context, "prioridades")));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 60
            echo "\t\t\$selectionsPriority.push({ id: '";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "nombre")), "html", null, true);
            echo "', text: '";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "nombre")), "html", null, true);
            echo "' });
\t\t\$listPriority.push({ id: '";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "id"), "html", null, true);
            echo "', text: '";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "nombre")), "html", null, true);
            echo "', cod: '";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "codigo")), "html", null, true);
            echo "', style: '";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "estiloPresentacion")), "html", null, true);
            echo "' });
\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prioridad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "    
            console.log('agenda editable: false -> override for object:editable, ----> for cit from radx\\nbtn new prc in navbar\\nnew navbar in edit form, detail view on dropdown');
        });

        (function (\$) {
            /*
             * 
             * @type type
             * Global variables for plugin
             */
            window.GROUP_DEPENDENT_ENTITIES = null;   // --| build data collection
            GROUP_DEPENDENT_ENTITIES        = JSON.parse('";
        // line 74
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["GROUP_DEPENDENT_ENTITIES"]) ? $context["GROUP_DEPENDENT_ENTITIES"] : $this->getContext($context, "GROUP_DEPENDENT_ENTITIES"))), "js");
        echo "');

        }(jQuery));
    </script>

    ";
        // line 80
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/lang/summernote-es-ES.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_summernote_config.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 85
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_assignToNewRecord_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 86
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_newRecord_typeahead.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 89
        echo "    ";
        // line 90
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd-label-bootstrap-table-editable.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 93
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_list_v2.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 94
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_solicitudEmergencia.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 96
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudDiagnosticoAdmin/soldiag_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 98
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioComplementarioAdmin/solcmpl_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 102
    public function block_simagd_bs_alert($context, array $blocks = array())
    {
        // line 103
        echo "    ";
        $this->displayParentBlock("simagd_bs_alert", $context, $blocks);
        echo "
    
    ";
        // line 105
        $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_assignToNewRecord_alert.html.twig")->display($context);
    }

    // line 108
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 109
        echo "    <i class=\"fa fa-inbox\"></i> <i class=\"fa fa-paperclip\"></i> <i class=\"fa fa-reply-all\"></i> Solicitudes
";
    }

    // line 112
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 113
        echo "    <li class=\"list-table-link-navbar-parent dropdown active\">
\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><span class=\"text-info\"> <i class=\"fa fa-list-ul\"></i> <i class=\"fa fa-inbox\"></i> </span> Solicitudes <span class=\"text-info\"><span class=\"caret\"></span></span></a>
\t<ul class=\"dropdown-menu\" role=\"menu\">
\t    <li class=\"list-table-link-navbar active ";
        // line 116
        if (((isset($context["_PRC_ALLOW_LIST"]) ? $context["_PRC_ALLOW_LIST"] : $this->getContext($context, "_PRC_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-solicitudes-estudio-list\" data-divtabletarget=\"div-resultado-solicitudes-estudio\"
\t\t    ";
        // line 118
        if (((isset($context["_PRC_ALLOW_LIST"]) ? $context["_PRC_ALLOW_LIST"] : $this->getContext($context, "_PRC_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-tasks \"></span> Solicitudes de estudio
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar ";
        // line 123
        if (((isset($context["_SOLDIAG_ALLOW_LIST"]) ? $context["_SOLDIAG_ALLOW_LIST"] : $this->getContext($context, "_SOLDIAG_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-solicitudes-diagnostico-list\" data-divtabletarget=\"div-resultado-solicitudes-diagnostico\"
\t\t    ";
        // line 125
        if (((isset($context["_SOLDIAG_ALLOW_LIST"]) ? $context["_SOLDIAG_ALLOW_LIST"] : $this->getContext($context, "_SOLDIAG_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-paperclip \"></span> Solicitudes de diagnóstico
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar ";
        // line 130
        if (((isset($context["_SOLCMPL_ALLOW_LIST"]) ? $context["_SOLCMPL_ALLOW_LIST"] : $this->getContext($context, "_SOLCMPL_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-solicitudes-estudio-compl-list\" data-divtabletarget=\"div-resultado-solicitudes-estudio-compl\"
\t\t    ";
        // line 132
        if (((isset($context["_SOLCMPL_ALLOW_LIST"]) ? $context["_SOLCMPL_ALLOW_LIST"] : $this->getContext($context, "_SOLCMPL_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-export \"></span> Solicitudes de estudio complementario
\t\t</a>
\t    </li>
\t</ul>
    </li>
";
    }

    // line 140
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 141
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"true\" data-template-source=\"getSearchExpedienteSourceTemplate\">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
\t</div>
        <div class=\"btn-group\">
            <button type=\"submit\" id=\"btn_search_filter_expNumero\" name=\"btn_search_filter_expNumero\" class=\"btn btn-primary-v2 ";
        // line 147
        echo "\">
                <i class=\"fa fa-search\"></i>
            </button>
            <button type=\"button\" id=\"btn_add_action_prc\" class=\"btn btn-primary-v2 dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Aplicar a expediente\">
                <b class=\"caret\"></b>
            </button>
            <!-- Menu -->
            <ul class=\"dropdown-menu\" id=\"menu_prc_moreActions\" >
                <li ";
        // line 155
        if (((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo ">
                    <a href=\"javascript:void(0)\" id=\"btn_navbar_add_prc\" ";
        // line 156
        if (((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo " target=\"_blank\">
                        <span class=\"glyphicon glyphicon-edit\"></span> Nueva solicitud
                    </a>
                </li>
            </ul>
        </div>
    </form>
";
    }

    // line 165
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
    }

    // line 168
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 169
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "
    ";
        // line 173
        echo "                                    
";
        // line 175
        echo "
    ";
        // line 176
        if (((isset($context["_PRC_ALLOW_LIST"]) ? $context["_PRC_ALLOW_LIST"] : $this->getContext($context, "_PRC_ALLOW_LIST")) == true)) {
            // line 177
            echo "        <!-- toolbar for table-lista-solicitudes -->
        ";
            // line 178
            $context["code_entity"] = "prc";
            // line 179
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 182
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 184
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 189
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 192
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 195
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-trash\"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_unknown_patient_add_item\" class=\"btn btn-danger btn_unknown_patient_add_item\" title=\"Agregar paciente de emergencia\" style=\"margin-left: 15px\"
                        ";
            // line 203
            if ((!(((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                    <i class=\"glyphicon glyphicon-plus-sign \"></i>
                </button>
                
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_external_patient_add_item\" class=\"btn btn-element-v2 btn_external_patient_add_item\" title=\"Agregar paciente referido\" style=\"margin-left: 15px\"
                        ";
            // line 210
            if ((!(((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                    <i class=\"glyphicon glyphicon-plus-sign \"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_unknown_patient_assign_newRecord\" class=\"btn btn-danger btn_unknown_patient_assign_newRecord\" title=\"Asignar registros a nuevo Expediente\" style=\"margin-left: 15px\" disabled=\"disabled\">
                    <i class=\"glyphicon glyphicon-share \"></i>
                </button>

                <!-- --| custom buttons for footer -->
                <span class=\"btn-separator\"></span>

                <div class=\"btn-group\" role=\"group\" style=\"margin-left: 15px\">
                    <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Alternar vista\" ";
            // line 225
            if (((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == false)) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                        <i class=\"glyphicon glyphicon-resize-horizontal\"></i>
                        ";
            // line 227
            echo " <span class=\"caret\"></span>
                    </button>
                    <ul class=\"dropdown-menu\" style=\"right: 0; left: auto;\" >
                        <li ";
            // line 230
            if (((isset($context["_PRC_ALLOW_LIST"]) ? $context["_PRC_ALLOW_LIST"] : $this->getContext($context, "_PRC_ALLOW_LIST")) == false)) {
                echo " class=\"disabled\" ";
            }
            echo ">
                            <a href=\"javascript:void(0)\" id=\"panel_studyrequest_btn_expand_view\" ";
            // line 231
            if (((isset($context["_PRC_ALLOW_LIST"]) ? $context["_PRC_ALLOW_LIST"] : $this->getContext($context, "_PRC_ALLOW_LIST")) == false)) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                                <span class=\"glyphicon glyphicon-resize-horizontal \"></span> Vista completa
                            </a>
                        </li>
                        <li ";
            // line 235
            if (((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == false)) {
                echo " class=\"disabled\" ";
            }
            echo " style=\"display: none;\">
                            <a href=\"javascript:void(0)\" id=\"panel_studyrequest_btn_default_view\" ";
            // line 236
            if (((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == false)) {
                echo " disabled=\"disabled\" ";
            }
            echo ">
                                <span class=\"glyphicon glyphicon-resize-horizontal \"></span> Vista predeterminada
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END --| custom buttons for toolbar -->
            ";
            // line 244
            echo "
        </div> <!-- END --| toolbar for table-lista-solicitudes -->
        
\t<div id=\"div-resultado-solicitudes-estudio\" class=\"menu-listas-solicitudes\" data-refresh-url=\"";
            // line 247
            echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_listarSolicitudesEstudio");
            echo "\">
            
            <div class=\"row outer\">
                ";
            // line 250
            if (((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) != false)) {
                // line 251
                echo "                    <div id=\"container_prc_column_bsform\" class=\"col-lg-3 col-md-3 col-sm-3\" style=\"margin-top: 60px;\">
                        <form id=\"crearSolicitudEstudioFormatoRapido_container_column_form\" action=\"";
                // line 252
                echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_crearSolicitudEstudioFormatoRapido");
                echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
                            data-fv-framework=\"bootstrap\"
                            data-fv-icon-valid=\"glyphicon glyphicon-ok\"
                            data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
                            data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

                            data-fv-message=\"El valor introducido no es válido\">

                            <div class=\"form-group\" style=\"";
                // line 260
                echo "\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 ";
                // line 262
                echo "\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                    <button type=\"button\" class=\"btn btn-default ";
                // line 263
                echo "\"><i class=\"glyphicon glyphicon-remove\"></i> Limpiar</button>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <span class=\"form-control-static\" ><span class=\"text-success\">Registro exitoso</span></span>
                                </div>
                            </div>

                        </form>
                    </div>
                ";
            }
            // line 275
            echo "                <div id=\"container_prc_column_bstable\" class=\"";
            if (((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) != false)) {
                echo " col-lg-9 col-md-9 col-sm-9 ";
            } else {
                echo " col-lg-12 col-md-12 col-sm-12 ";
            }
            echo "\">
                    <table class=\"table table-condensed\" id=\"table-lista-solicitudes-estudio\"
                            data-toggle=\"table\"
                            data-id-field=\"prc_id\"
                            data-url=\"";
            // line 279
            if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == false) && ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == false))) {
                echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_listarSolicitudesEstudio");
            }
            echo "\"
                            data-backup-url=\"simagd_solicitud_estudio_listarSolicitudesEstudio\"
                            data-toolbar=\"#bs_prc_toolbar\"
                            data-cache=\"false\"
                            data-show-refresh=\"true\"
                            data-show-toggle=\"true\"
                            data-show-columns=\"true\"
                            data-search=\"true\"
                            data-select-item-name=\"listaSolicitudesToolbar\"
                            ";
            // line 289
            echo "                            data-pagination=\"true\"
                            data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 290
            echo "]\"
                            ";
            // line 293
            echo "                            data-detail-view=\"false\"
                            data-detail-formatter=\"prc_detailFormatter\"
                            data-classes=\"table table-hover table-condensed table-no-bordered\"
                            data-height=\"760\">
                        <thead>
                            <tr style=\"background-color: #31708f !important; color: #fff !important;\">
                                ";
            // line 300
            echo "                                <th data-field=\"prc_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
                                <th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
                                <th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
                                <th data-field=\"prc_empleado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
                                <th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" data-formatter=\"simagdAreaAtencionFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
                                <th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
                                <th data-field=\"prc_referido\" data-visible=\"false\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido a</th>
                                <th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
                                <th data-field=\"prAtn_nombre\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"prAtn_id\" data-filter-bstable-type=\"select2\" ";
            // line 308
            if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == false) && ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == false))) {
                echo " data-formatter=\"simagdPrioridadAtencionFormatter\" ";
            }
            echo " data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Prioridad</th>
                                <th data-field=\"prc_diagnosticante\" data-formatter=\"simagdDiagnosticanteFormatter\" data-visible=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Diagnosticar en</th>
                                <th data-field=\"prc_fechaCreacion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se creó</th>
                                <th data-field=\"prc_fechaProximaConsulta\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Próxima consulta</th>
                                <th data-field=\"statusSc_nombreEstado\" data-visible=\"false\" data-formatter=\"estadoSolicitudFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
                                <th data-field=\"action\" data-formatter=\"actionSolEstudioFormatter\" data-events=\"actionSolEstudioEvents\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                                <th data-field=\"prc_chk\" data-checkbox=\"true\" data-formatter=\"selectableRowFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
\t</div>
    ";
        }
        // line 323
        echo "
    ";
        // line 324
        if (((isset($context["_SOLDIAG_ALLOW_LIST"]) ? $context["_SOLDIAG_ALLOW_LIST"] : $this->getContext($context, "_SOLDIAG_ALLOW_LIST")) == true)) {
            // line 325
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 326
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "soldiag")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 327
            echo "        <!-- END --| toolbar for table-lista-lecturas -->
        
\t<div id=\"div-resultado-solicitudes-diagnostico\" style=\"display: none;\" class=\"menu-listas-solicitudes\" data-refresh-url=\"";
            // line 329
            echo $this->env->getExtension('routing')->getPath("simagd_solicitud_diagnostico_listarSolicitudesDiagnostico");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-solicitudes-diagnostico\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"soldiag_id\"
\t\t  data-url=\"\"
                  data-backup-url=\"simagd_solicitud_diagnostico_listarSolicitudesDiagnostico\"
\t\t  data-toolbar=\"#bs_soldiag_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaSolicitudesDiagnosticoToolbar\"
\t\t  ";
            // line 343
            echo "\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 344
            echo "]\"
\t\t  ";
            // line 347
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f !important; color: #fff !important;\">
\t\t\t";
            // line 352
            echo "\t\t\t<th data-field=\"soldiag_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\"  data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"soldiag_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empsoldiag_id\" data-filter-bstable-type=\"select2\"  class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\"  data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\"  class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\"  class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prc_referido\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizado en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"soldiag_fechaCreacion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\"  data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se solicitó</th>
\t\t\t<th data-field=\"est_fechaEstudio\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\"  data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se almacenó en PACS</th>
\t\t\t<th data-field=\"prc_fechaCreacion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\"  data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se solicitó estudio</th>
\t\t\t<th data-field=\"soldiag_solicitado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdsoldiag_id\" data-filter-bstable-type=\"select2\"  class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitado a</th>
\t\t\t<th data-field=\"soldiag_remota\"  data-formatter=\"remotaFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">A externo</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionSolDiagFormatter\" data-events=\"actionSolDiagEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 372
        echo "
    ";
        // line 373
        if (((isset($context["_SOLCMPL_ALLOW_LIST"]) ? $context["_SOLCMPL_ALLOW_LIST"] : $this->getContext($context, "_SOLCMPL_ALLOW_LIST")) == true)) {
            // line 374
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 375
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "solcmpl")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 376
            echo "        <!-- END --| toolbar for table-lista-lecturas -->
        
\t<div id=\"div-resultado-solicitudes-estudio-compl\" style=\"display: none;\" class=\"menu-listas-solicitudes\" data-refresh-url=\"";
            // line 378
            echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_complementario_listarSolicitudesEstudioComplementario");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-solicitudes-estudio-compl\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"solcmpl_id\"
\t\t  data-url=\"\"
                  data-backup-url=\"simagd_solicitud_estudio_complementario_listarSolicitudesEstudioComplementario\"
\t\t  data-toolbar=\"#bs_solcmpl_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaSolicitudesEstudioComplementarioToolbar\"
\t\t  ";
            // line 392
            echo "\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 393
            echo "]\"
\t\t  ";
            // line 396
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f !important; color: #fff !important;\">
\t\t\t";
            // line 401
            echo "\t\t\t<th data-field=\"solcmpl_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\"  data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Remitió</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\"  data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\"  data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\"  class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prc_referido\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizado en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"est_fechaEstudio\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\"  data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se almacenó en PACS</th>
\t\t\t<th data-field=\"prc_fechaCreacion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\"  data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se solicitó estudio</th>
\t\t\t<th data-field=\"solcmpl_fechaSolicitud\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\"  data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se solicitó estudio ( Compl )</th>
\t\t\t<th data-field=\"solcmpl_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"mcmpl_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\"  class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad ( Compl )</th>
\t\t\t<th data-field=\"prAtn_nombre\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"prAtn_id\" data-filter-bstable-type=\"select2\"  ";
            // line 414
            if ((((isset($context["_SOLCMPL_ALLOW_CREATE"]) ? $context["_SOLCMPL_ALLOW_CREATE"] : $this->getContext($context, "_SOLCMPL_ALLOW_CREATE")) == false) && ((isset($context["_SOLCMPL_ALLOW_EDIT"]) ? $context["_SOLCMPL_ALLOW_EDIT"] : $this->getContext($context, "_SOLCMPL_ALLOW_EDIT")) == false))) {
                echo " data-formatter=\"simagdPrioridadAtencionFormatter\" ";
            }
            echo " class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Prioridad</th>
\t\t\t<th data-field=\"solcmpl_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empcmpl_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"solcmpl_solicitado\"  class=\"col-md-2\" data-visible=\"false\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitado a</th>
\t\t\t<th data-field=\"statusSc_nombreEstado\" data-visible=\"false\" data-formatter=\"estadoSolicitudFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionSolEstudioCmplFormatter\" data-events=\"actionSolEstudioCmplEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 424
        echo "        
    ";
        // line 425
        if ((((isset($context["_SOLDIAG_ALLOW_CREATE"]) ? $context["_SOLDIAG_ALLOW_CREATE"] : $this->getContext($context, "_SOLDIAG_ALLOW_CREATE")) == true) || ((isset($context["_SOLDIAG_ALLOW_EDIT"]) ? $context["_SOLDIAG_ALLOW_EDIT"] : $this->getContext($context, "_SOLDIAG_ALLOW_EDIT")) == true))) {
            // line 426
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_crearSolicitud_modal.html.twig")->display(array_merge($context, array("establecimientos" => (isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")), "medicos" => (isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "defaultEstab" => (isset($context["defaultEstab"]) ? $context["defaultEstab"] : $this->getContext($context, "defaultEstab")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 428
            echo "    ";
        }
        // line 429
        echo "
    ";
        // line 430
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == true)) {
            // line 431
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal_v2.html.twig")->display($context);
            echo "          ";
            // line 432
            echo "    ";
        }
        // line 433
        echo "    ";
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            // line 434
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_crearSolicitudEstudio_formatoRapido_modal.html.twig")->display(array_merge($context, array("medicos" => (isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "proyecciones" => (isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 435
            echo "     ";
            // line 436
            echo "    ";
        }
        // line 437
        echo "    ";
        if (((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)) {
            // line 438
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_agregarIndicacionesRadiologo_modal.html.twig")->display(array_merge($context, array("radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 439
            echo "         ";
            // line 440
            echo "    ";
        }
        // line 441
        echo "    ";
        if (((isset($context["_SOLDIAG_ALLOW_VIEW"]) ? $context["_SOLDIAG_ALLOW_VIEW"] : $this->getContext($context, "_SOLDIAG_ALLOW_VIEW")) == true)) {
            // line 442
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:soldiag_total_info_modal_v2.html.twig")->display($context);
            echo "      ";
            // line 443
            echo "    ";
        }
        // line 444
        echo "    ";
        if (((isset($context["_SOLCMPL_ALLOW_VIEW"]) ? $context["_SOLCMPL_ALLOW_VIEW"] : $this->getContext($context, "_SOLCMPL_ALLOW_VIEW")) == true)) {
            // line 445
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:solcmpl_total_info_modal_v2.html.twig")->display($context);
            echo "      ";
            // line 446
            echo "    ";
        }
        // line 447
        echo "        
    ";
        // line 448
        if (((((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 449
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_asignarNuevoExpediente_modal.html.twig")->display($context);
            echo "     ";
            // line 450
            echo "    ";
        }
        // line 451
        echo "    
    <!-- form for create study request -->
    ";
        // line 453
        if (((isset($context["_SOLCMPL_ALLOW_CREATE"]) ? $context["_SOLCMPL_ALLOW_CREATE"] : $this->getContext($context, "_SOLCMPL_ALLOW_CREATE")) == true)) {
            // line 454
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_crearSolicitudEstudio_formatoRapido_modal.html.twig")->display(array_merge($context, array("collection_prioridades" => (isset($context["collection_prioridades"]) ? $context["collection_prioridades"] : $this->getContext($context, "collection_prioridades")), "collection_modalidades" => (isset($context["collection_modalidades"]) ? $context["collection_modalidades"] : $this->getContext($context, "collection_modalidades")), "collection_examenes" => (isset($context["collection_examenes"]) ? $context["collection_examenes"] : $this->getContext($context, "collection_examenes")), "collection_proyecciones" => (isset($context["collection_proyecciones"]) ? $context["collection_proyecciones"] : $this->getContext($context, "collection_proyecciones")), "collection_default_mldRx" => (isset($context["collection_default_mldRx"]) ? $context["collection_default_mldRx"] : $this->getContext($context, "collection_default_mldRx")), "collection_default_exmRx" => (isset($context["collection_default_exmRx"]) ? $context["collection_default_exmRx"] : $this->getContext($context, "collection_default_exmRx")), "collection_tiposEmpleado" => (isset($context["collection_tiposEmpleado"]) ? $context["collection_tiposEmpleado"] : $this->getContext($context, "collection_tiposEmpleado")), "collection_radiologos" => (isset($context["collection_radiologos"]) ? $context["collection_radiologos"] : $this->getContext($context, "collection_radiologos")), "collection_default_empLogged" => (isset($context["collection_default_empLogged"]) ? $context["collection_default_empLogged"] : $this->getContext($context, "collection_default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 456
            echo "    ";
        }
        // line 457
        echo "
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  887 => 457,  884 => 456,  876 => 454,  874 => 453,  870 => 451,  867 => 450,  863 => 449,  861 => 448,  858 => 447,  855 => 446,  851 => 445,  848 => 444,  845 => 443,  841 => 442,  838 => 441,  835 => 440,  833 => 439,  825 => 438,  822 => 437,  819 => 436,  817 => 435,  809 => 434,  806 => 433,  803 => 432,  799 => 431,  797 => 430,  794 => 429,  791 => 428,  783 => 426,  781 => 425,  778 => 424,  763 => 414,  748 => 401,  742 => 396,  739 => 393,  736 => 392,  720 => 378,  716 => 376,  709 => 375,  706 => 374,  704 => 373,  701 => 372,  679 => 352,  673 => 347,  670 => 344,  667 => 343,  651 => 329,  647 => 327,  640 => 326,  637 => 325,  635 => 324,  632 => 323,  612 => 308,  602 => 300,  594 => 293,  591 => 290,  588 => 289,  574 => 279,  562 => 275,  548 => 263,  545 => 262,  541 => 260,  530 => 252,  527 => 251,  525 => 250,  519 => 247,  514 => 244,  502 => 236,  496 => 235,  487 => 231,  481 => 230,  476 => 227,  469 => 225,  449 => 210,  437 => 203,  425 => 195,  418 => 192,  412 => 189,  404 => 184,  400 => 182,  394 => 179,  392 => 178,  389 => 177,  387 => 176,  384 => 175,  381 => 173,  377 => 169,  374 => 168,  369 => 165,  355 => 156,  349 => 155,  339 => 147,  331 => 141,  328 => 140,  315 => 132,  308 => 130,  298 => 125,  291 => 123,  281 => 118,  274 => 116,  269 => 113,  266 => 112,  261 => 109,  258 => 108,  254 => 105,  248 => 103,  245 => 102,  237 => 98,  232 => 96,  228 => 94,  223 => 93,  217 => 90,  215 => 89,  210 => 86,  205 => 85,  200 => 82,  196 => 81,  191 => 80,  183 => 74,  170 => 63,  156 => 61,  149 => 60,  145 => 59,  134 => 55,  126 => 54,  118 => 53,  110 => 52,  102 => 51,  79 => 32,  76 => 31,  68 => 27,  62 => 24,  59 => 23,  54 => 21,  52 => 20,  50 => 19,  48 => 18,  46 => 15,  44 => 14,  42 => 13,  40 => 12,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
