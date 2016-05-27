<?php

/* MinsalSimagdBundle::simagd_base_edit.html.twig */
class __TwigTemplate_3be8d9cfe0ab9f5bd847e94df16c90de64ce8196f4339ef2c5244152bdccfd9d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_edit.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_page_content_header' => array($this, 'block_sonata_page_content_header'),
            'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
            'tab_menu_navbar_header' => array($this, 'block_tab_menu_navbar_header'),
            'simagd_form_navbar_brand_title' => array($this, 'block_simagd_form_navbar_brand_title'),
            'simagd_navbar_left_nav' => array($this, 'block_simagd_navbar_left_nav'),
            'simagd_navbar_middle_nav' => array($this, 'block_simagd_navbar_middle_nav'),
            'simagd_navbar_right_nav' => array($this, 'block_simagd_navbar_right_nav'),
            'content' => array($this, 'block_content'),
            'notice' => array($this, 'block_notice'),
            'simagd_info_support' => array($this, 'block_simagd_info_support'),
            'custom_entity_support' => array($this, 'block_custom_entity_support'),
            'form' => array($this, 'block_form'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'sonata_post_fieldsets' => array($this, 'block_sonata_post_fieldsets'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 7
        $context["_messageCurrentTemplate"] = (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? ("<i class=\"fa fa-refresh\"></i> <i class=\"fa fa-pencil-square-o\"></i> Edición de registro") : ("<i class=\"fa fa-floppy-o\"></i> <i class=\"fa fa-plus-circle\"></i> Nuevo registro"));
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
        echo "    ";
        // line 17
        echo "    
    ";
        // line 19
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-styles.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-form-styles.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-table.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 24
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/jquery-ui-1.11.2.custom/jquery-ui.theme.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 27
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 30
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/iCheck-master/skins/minimal/blue.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 33
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-ckeditor.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 36
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/typeahead.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 39
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/bootstrap-table.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />
    
    ";
        // line 42
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/formvalidation-master/dist/css/formValidation.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 45
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/toastmessage-plugin/src/main/resources/css/jquery.toastmessage.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 48
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/css/bootstrap-modal-bs3patch.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/css/bootstrap-modal.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 52
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 55
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 58
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/select2-bootstrap.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
";
    }

    // line 61
    public function block_javascripts($context, array $blocks = array())
    {
        // line 62
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
\tvar \$token,
\t    \$current_action_form,
\t    \$object_id,
            \$is_objectAllowToSwitch;
\t
\tvar \$is_admin,
\t    \$is_radX,
\t    \$is_prcMed;
\t    
\tvar \$id_userLogged,
\t    \$id_emp_userLogged,
\t    \$cod_emp_userLogged,
\t    \$id_userEstab;

\t\$token \t\t\t= \"";
        // line 79
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "\";
\t\$current_action_form \t= ";
        // line 80
        if (array_key_exists("action", $context)) {
            echo " \"";
            echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "html", null, true);
            echo "\" ";
        } else {
            echo " \"create\" ";
        }
        echo ";
\t\$object_id \t\t= ";
        // line 81
        if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id"), "html", null, true);
            echo " ";
        } else {
            echo " false ";
        }
        echo ";
\t\$is_admin \t\t= ";
        // line 82
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$token, \$current_action_form, \$object_id);
\t
\t\$is_admin\t\t= ";
        // line 86
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t\$is_radX\t\t= ";
        // line 87
        if ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t\$is_prcMed\t\t= ";
        // line 88
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") && ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "idEmpleado"), "idTipoEmpleado"), "codigo") == "MED"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$is_admin, \$is_radX, \$is_prcMed);
\t
\t\$id_userLogged\t\t= ";
        // line 92
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getId", array(), "method"), "js"), "html", null, true);
        echo ";
\t\$id_emp_userLogged\t= ";
        // line 93
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId", array(), "method"), "js"), "html", null, true);
        echo ";
\t\$cod_emp_userLogged\t= \"";
        // line 94
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo", array(), "method"), "js"), "html", null, true);
        echo "\";
\t\$id_userEstab \t\t= ";
        // line 95
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento"), "getId", array(), "method"), "js"), "html", null, true);
        echo ";

\tconsole.log(\$id_userLogged, \$id_emp_userLogged, \$cod_emp_userLogged, \$id_userEstab);
    </script>
    
    ";
        // line 101
        echo "    ";
        // line 102
        echo "
    ";
        // line 104
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/sonataadmin/vendor/select2/select2_locale_es.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 107
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/iCheck-master/icheck.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 108
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_form_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 111
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/jquery-ui-1.11.2.custom/jquery-ui.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 112
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_highlight_error_ui.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 115
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/jquery.formparams.min.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 118
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/jquery.mask.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 121
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_jQueryCustomFunctions.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 124
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/typeahead.js-master/dist/typeahead.bundle.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/typeahead.js-master/dist/bloodhound.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 128
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/bootstrap-table.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 129
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/locale/bootstrap-table-es-CR.min.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 131
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_data_bsTable_formatter.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 133
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_filter_bstable_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 136
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/moment-master/min/moment-with-locales.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 137
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 140
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_trim_datos.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 141
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_html5_novalidate.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 142
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_validate_number.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 145
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_form_config_v2.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 146
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_config_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 147
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_setterObject_modalData.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 148
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_select2_custom_formatter.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 151
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/formvalidation-master/dist/js/formValidation.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 152
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/formvalidation-master/dist/js/framework/bootstrap.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 153
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/formvalidation-master/dist/js/language/es_ES.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 156
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/toastmessage-plugin/src/main/javascript/jquery.toastmessage.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 157
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_generar_mensaje_toast.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 160
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/js/bootstrap-modalmanager.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 161
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/js/bootstrap-modal.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 164
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-switch-master/dist/js/bootstrap-switch.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 166
        $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_funcionesClienteServidor.js.twig")->display($context);
    }

    // line 169
    public function block_sonata_page_content_header($context, array $blocks = array())
    {
        // line 170
        echo "    ";
        $this->displayBlock('sonata_page_content_nav', $context, $blocks);
        // line 219
        echo "
";
    }

    // line 170
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 171
        echo "        ";
        if (((!twig_test_empty((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu")))) || (!twig_test_empty((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")))))) {
            // line 172
            echo "            <nav class=\"navbar navbar-default\" role=\"navigation\">
                <div class=\"container-fluid\">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    ";
            // line 175
            $this->displayBlock('tab_menu_navbar_header', $context, $blocks);
            // line 190
            echo "
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                        <ul class=\"nav navbar-nav\">
                            ";
            // line 194
            $this->displayBlock('simagd_navbar_left_nav', $context, $blocks);
            // line 203
            echo "                        </ul>
                        ";
            // line 204
            $this->displayBlock('simagd_navbar_middle_nav', $context, $blocks);
            // line 207
            echo "                        <ul class=\"nav navbar-nav navbar-right\">
                            ";
            // line 208
            if ((!twig_test_empty(trim(strtr((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")), array("<li>" => "", "</li>" => "")))))) {
                // line 209
                echo "                                ";
                echo (isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions"));
                echo "
                            ";
            }
            // line 211
            echo "                            ";
            $this->displayBlock('simagd_navbar_right_nav', $context, $blocks);
            // line 213
            echo "                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        ";
        }
        // line 218
        echo "    ";
    }

    // line 175
    public function block_tab_menu_navbar_header($context, array $blocks = array())
    {
        // line 176
        echo "                        <div class=\"navbar-header\">
                            <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
                                <span class=\"sr-only\">Toggle navigation</span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                            </button>
                            ";
        // line 183
        $this->displayBlock('simagd_form_navbar_brand_title', $context, $blocks);
        // line 188
        echo "                        </div>
                    ";
    }

    // line 183
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 184
        echo "                                <span class=\"navbar-brand\">
                                    <span class=\"label label-";
        // line 185
        echo (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? ("primary-v2") : ("element-v2"));
        echo "\"> ";
        echo twig_truncate_filter($this->env, (isset($context["_messageCurrentTemplate"]) ? $context["_messageCurrentTemplate"] : $this->getContext($context, "_messageCurrentTemplate")), 150);
        echo " </span>
                                </span>
                            ";
    }

    // line 194
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 195
        echo "                                ";
        // line 196
        echo "                                <div style=\"padding-top: 8px;\">
                                    <input type=\"checkbox\" name=\"switch_for_form_and_register\" data-apply-bootstrap-switch=\"true\" checked data-on-text=\"";
        // line 197
        echo " Formulario\" data-off-text=\"";
        echo " Registros\" data-label-text=\"Vista\" data-inverse=\"true\" class=\"chk-bsswitch-container\" />
                                </div>
                                ";
        // line 199
        if ((!twig_test_empty((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"))))) {
            // line 200
            echo "                                    ";
            echo (isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"));
            echo "
                                ";
        }
        // line 202
        echo "                            ";
    }

    // line 204
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 205
        echo "                            ";
        // line 206
        echo "                        ";
    }

    // line 211
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 212
        echo "                            ";
    }

    // line 222
    public function block_content($context, array $blocks = array())
    {
        // line 223
        echo "    
    ";
        // line 224
        $this->displayBlock('notice', $context, $blocks);
        // line 227
        echo "    
    ";
        // line 228
        $this->displayParentBlock("content", $context, $blocks);
        echo "
    
    ";
        // line 230
        $this->displayBlock('simagd_info_support', $context, $blocks);
        // line 270
        echo "    
";
    }

    // line 224
    public function block_notice($context, array $blocks = array())
    {
        // line 225
        echo "        ";
        $this->env->loadTemplate("MinsalSimagdBundle::simagd_flash_notice.html.twig")->display($context);
        // line 226
        echo "    ";
    }

    // line 230
    public function block_simagd_info_support($context, array $blocks = array())
    {
        // line 231
        echo "
        <div id=\"simagd-modal-info-support\" class=\"modal container fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\">
            <div class=\"modal-content panel-primary-v2\">
                <div class=\"modal-header panel-heading\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                    <h4 class=\"modal-title\"><i class=\"fa fa-desktop\"></i> <strong>Imagenología</strong> - Cuadro informativo</h4>
                </div>
                
                <div class=\"modal-body\" >

                    <div class=\"panel panel-primary\">

                        <div class=\"panel-heading\">
                            <h3 class=\"panel-title\"><i class=\"fa fa-random\"></i> Información de registros </h3>
                        </div>

                        <div class=\"panel-body\" >

                            ";
        // line 249
        $this->displayBlock('custom_entity_support', $context, $blocks);
        // line 254
        echo "
                        </div>";
        // line 256
        echo "
                    </div><!-- /.modal-content -->

                </div>";
        // line 260
        echo "
                <div class=\"modal-footer\">
                    <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
                </div>

            </div><!-- /.modal-content -->

        </div>";
        // line 268
        echo "
    ";
    }

    // line 249
    public function block_custom_entity_support($context, array $blocks = array())
    {
        // line 250
        echo "
                                <div id=\"custom-entity-content-body\"> ";
        // line 251
        echo " </div>

                            ";
    }

    // line 273
    public function block_form($context, array $blocks = array())
    {
        // line 274
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    ";
        // line 276
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 277
        echo "    
    ";
        // line 278
        $context["__my_form_type"] = "horizontal";
        // line 279
        echo "
    ";
        // line 280
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 281
            echo "        <div>
            ";
            // line 282
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 285
            echo "        <form
";
            // line 287
            echo "              class=\"form-horizontal\"
              role=\"form\"
              action=\"";
            // line 289
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
              method=\"POST\"
              ";
            // line 291
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 292
            echo "              id=\"simagd_entity_full_admin_form\"
              >
            ";
            // line 294
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 295
                echo "                <div class=\"sonata-ba-form-error\">
                    ";
                // line 296
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 303
            echo "            ";
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 306
            echo "
            ";
            // line 307
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 340
            echo "
            ";
            // line 341
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 344
            echo "
            ";
            // line 345
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

            ";
            // line 347
            $this->displayBlock('formactions', $context, $blocks);
            // line 389
            echo "        </form>
    ";
        }
        // line 391
        echo "
    ";
        // line 392
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.bottom", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

";
    }

    // line 303
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 304
        echo "                <div class=\"row\">
            ";
    }

    // line 307
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 308
        echo "                ";
        $context["has_tab"] = (((twig_length_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formtabs")) == 1) && ($this->getAttribute(twig_get_array_keys_filter($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formtabs")), 0, array(), "array") != "default")) || (twig_length_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formtabs")) > 1));
        // line 309
        echo "
                ";
        // line 311
        echo "                <div class=\"col-md-12\">
                    ";
        // line 312
        if ((isset($context["has_tab"]) ? $context["has_tab"] : $this->getContext($context, "has_tab"))) {
            // line 313
            echo "                        <div class=\"nav-tabs-custom\">
                            <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" role=\"tablist\">
                                ";
            // line 315
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formtabs"));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["name"] => $context["form_tab"]) {
                // line 316
                echo "                                    <li";
                if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "index") == 1)) {
                    echo " class=\"active\"";
                }
                echo "><a href=\"#tab_";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "index"), "html", null, true);
                echo "\" data-toggle=\"pill\"><span class=\"";
                echo $this->getAttribute((isset($context["form_tab"]) ? $context["form_tab"] : $this->getContext($context, "form_tab")), "tab_icon");
                echo "\"></span> ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), 1 => array(), 2 => $this->getAttribute((isset($context["form_tab"]) ? $context["form_tab"] : $this->getContext($context, "form_tab")), "translation_domain")), "method"), "html", null, true);
                echo " <i class=\"fa\"></i></a></li>
                                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 318
            echo "                            </ul>
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                ";
            // line 320
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formtabs"));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["code"] => $context["form_tab"]) {
                // line 321
                echo "                                    <div class=\"tab-pane fade";
                if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "first")) {
                    echo " in active";
                }
                echo "\" id=\"tab_";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "index"), "html", null, true);
                echo "\">
                                        <div class=\"box-body\">
                                            <div class=\"sonata-ba-collapsed-fields\">
                                                ";
                // line 324
                if (($this->getAttribute((isset($context["form_tab"]) ? $context["form_tab"] : $this->getContext($context, "form_tab")), "description") != false)) {
                    // line 325
                    echo "                                                    <p>";
                    echo $this->getAttribute((isset($context["form_tab"]) ? $context["form_tab"] : $this->getContext($context, "form_tab")), "description");
                    echo "</p>
                                                ";
                }
                // line 327
                echo "
                                                ";
                // line 328
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["form_helper"]) ? $context["form_helper"] : $this->getContext($context, "form_helper")), "render_groups", array(0 => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), 1 => (isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 2 => $this->getAttribute((isset($context["form_tab"]) ? $context["form_tab"] : $this->getContext($context, "form_tab")), "groups", array(), "array"), 3 => (isset($context["has_tab"]) ? $context["has_tab"] : $this->getContext($context, "has_tab"))), "method"), "html", null, true);
                echo "
                                            </div>
                                        </div>
                                    </div>
                                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['code'], $context['form_tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 333
            echo "                            </div>
                        </div>
                    ";
        } else {
            // line 336
            echo "                        ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["form_helper"]) ? $context["form_helper"] : $this->getContext($context, "form_helper")), "render_groups", array(0 => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), 1 => (isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formtabs"), "default", array(), "array"), "groups"), 3 => (isset($context["has_tab"]) ? $context["has_tab"] : $this->getContext($context, "has_tab"))), "method"), "html", null, true);
            echo "
                    ";
        }
        // line 338
        echo "                </div>
            ";
    }

    // line 341
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 342
        echo "                </div>
            ";
    }

    // line 347
    public function block_formactions($context, array $blocks = array())
    {
        // line 348
        echo "                <div class=\"well well-small form-actions\">
                    ";
        // line 349
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 350
            echo "                        ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 351
                echo "                            <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
                        ";
            } else {
                // line 353
                echo "                            <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
                        ";
            }
            // line 355
            echo "                    ";
        } else {
            // line 356
            echo "                        ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 357
                echo "                            <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                                <i class=\"fa fa-eye\"></i>
                                ";
                // line 359
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                            </button>
                        ";
            }
            // line 362
            echo "                        ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 363
                echo "                            <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>

                            ";
                // line 368
                echo "
                            ";
                // line 369
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 370
                    echo "                                ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                                <a class=\"btn btn-danger\" href=\"";
                    // line 371
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                            ";
                }
                // line 373
                echo "
                            ";
                // line 374
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 375
                    echo "                                <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                            ";
                }
                // line 377
                echo "                        ";
            } else {
                // line 378
                echo "                            ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT"), "method"))) {
                    // line 379
                    echo "                                <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>
                            ";
                }
                // line 381
                echo "                            ";
                // line 384
                echo "                            ";
                // line 385
                echo "                        ";
            }
            // line 386
            echo "                    ";
        }
        // line 387
        echo "                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle::simagd_base_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1002 => 387,  999 => 386,  996 => 385,  994 => 384,  992 => 381,  988 => 379,  985 => 378,  982 => 377,  974 => 375,  972 => 374,  969 => 373,  962 => 371,  957 => 370,  955 => 369,  952 => 368,  948 => 363,  945 => 362,  939 => 359,  935 => 357,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  909 => 348,  906 => 347,  901 => 342,  898 => 341,  893 => 338,  887 => 336,  882 => 333,  863 => 328,  860 => 327,  854 => 325,  852 => 324,  841 => 321,  824 => 320,  820 => 318,  795 => 316,  778 => 315,  774 => 313,  772 => 312,  769 => 311,  766 => 309,  763 => 308,  760 => 307,  755 => 304,  752 => 303,  745 => 392,  742 => 391,  738 => 389,  736 => 347,  731 => 345,  728 => 344,  726 => 341,  723 => 340,  721 => 307,  718 => 306,  715 => 303,  709 => 296,  706 => 295,  704 => 294,  700 => 292,  696 => 291,  689 => 289,  685 => 287,  682 => 285,  676 => 282,  673 => 281,  671 => 280,  668 => 279,  666 => 278,  663 => 277,  661 => 276,  655 => 274,  652 => 273,  646 => 251,  643 => 250,  640 => 249,  635 => 268,  626 => 260,  621 => 256,  618 => 254,  616 => 249,  596 => 231,  593 => 230,  589 => 226,  586 => 225,  583 => 224,  578 => 270,  576 => 230,  571 => 228,  568 => 227,  566 => 224,  563 => 223,  560 => 222,  556 => 212,  553 => 211,  549 => 206,  547 => 205,  544 => 204,  540 => 202,  534 => 200,  532 => 199,  527 => 197,  524 => 196,  522 => 195,  519 => 194,  510 => 185,  507 => 184,  504 => 183,  499 => 188,  497 => 183,  488 => 176,  485 => 175,  481 => 218,  474 => 213,  471 => 211,  465 => 209,  463 => 208,  460 => 207,  458 => 204,  455 => 203,  453 => 194,  447 => 190,  440 => 172,  429 => 219,  426 => 170,  419 => 166,  413 => 164,  408 => 161,  403 => 160,  398 => 157,  393 => 156,  379 => 151,  374 => 148,  370 => 147,  356 => 142,  352 => 141,  337 => 136,  326 => 131,  322 => 129,  317 => 128,  307 => 124,  301 => 121,  295 => 118,  284 => 112,  279 => 111,  274 => 108,  269 => 107,  263 => 104,  258 => 101,  246 => 94,  242 => 93,  227 => 88,  219 => 87,  211 => 86,  200 => 82,  190 => 81,  145 => 58,  139 => 55,  133 => 52,  128 => 49,  123 => 48,  117 => 45,  111 => 42,  105 => 39,  99 => 36,  93 => 33,  87 => 30,  81 => 27,  75 => 24,  70 => 21,  66 => 20,  61 => 19,  56 => 15,  50 => 12,  47 => 11,  42 => 7,  451 => 218,  448 => 217,  445 => 175,  443 => 215,  441 => 212,  437 => 171,  434 => 170,  431 => 208,  423 => 169,  421 => 205,  418 => 204,  411 => 202,  406 => 201,  404 => 200,  401 => 199,  397 => 194,  394 => 193,  388 => 153,  384 => 152,  381 => 187,  378 => 186,  372 => 184,  366 => 146,  363 => 181,  361 => 145,  358 => 179,  355 => 178,  350 => 175,  347 => 140,  342 => 137,  339 => 171,  336 => 170,  331 => 133,  328 => 145,  320 => 144,  318 => 143,  315 => 142,  312 => 125,  304 => 152,  299 => 148,  297 => 141,  293 => 139,  291 => 129,  289 => 115,  287 => 120,  285 => 115,  282 => 114,  271 => 105,  268 => 104,  260 => 102,  253 => 93,  250 => 95,  241 => 88,  238 => 92,  235 => 86,  229 => 82,  225 => 81,  220 => 80,  218 => 79,  215 => 78,  210 => 74,  205 => 71,  201 => 70,  197 => 69,  193 => 68,  189 => 67,  184 => 65,  180 => 80,  176 => 79,  172 => 62,  168 => 61,  164 => 60,  160 => 59,  155 => 62,  152 => 61,  137 => 47,  122 => 41,  112 => 40,  100 => 37,  88 => 29,  83 => 26,  79 => 25,  74 => 24,  68 => 21,  65 => 20,  58 => 17,  52 => 14,  46 => 11,  43 => 10,  38 => 6,  36 => 5,  34 => 4,);
    }
}
