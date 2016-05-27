<?php

/* MinsalSimagdBundle::simagd_base_list_v2.html.twig */
class __TwigTemplate_7b0aee899c5ef22b037572348cd8a84ebef6afd1efac62c336662ce9146bcc52 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
            'simagd_navbar_menu_list' => array($this, 'block_simagd_navbar_menu_list'),
            'simagd_navbar_menu_label' => array($this, 'block_simagd_navbar_menu_label'),
            'simagd_navbar_left_nav' => array($this, 'block_simagd_navbar_left_nav'),
            'simagd_navbar_middle_nav' => array($this, 'block_simagd_navbar_middle_nav'),
            'simagd_navbar_right_nav' => array($this, 'block_simagd_navbar_right_nav'),
            'simagd_bs_alert' => array($this, 'block_simagd_bs_alert'),
            'simagd_inserted_alert' => array($this, 'block_simagd_inserted_alert'),
            'simagd_edited_alert' => array($this, 'block_simagd_edited_alert'),
            'simagd_error_alert' => array($this, 'block_simagd_error_alert'),
            'simagd_warning_alert' => array($this, 'block_simagd_warning_alert'),
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
        echo "    ";
        // line 11
        echo "    
    ";
        // line 13
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/typeahead.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 16
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/bootstrap-table.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />
    
    ";
        // line 19
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/formvalidation-master/dist/css/formValidation.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 22
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap3-editable/css/bootstrap-editable.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />

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
\tvar \$id_userLogged,
\t    \$id_emp_userLogged,
\t    \$cod_emp_userLogged,
\t    \$id_userEstab;
\t
\tvar \$is_admin,
\t    \$is_radX,
\t    \$is_prcMed;
\t
\t\$id_userLogged\t\t= ";
        // line 39
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getId", array(), "method"), "js"), "html", null, true);
        echo ";
\t\$id_emp_userLogged\t= ";
        // line 40
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId", array(), "method"), "js"), "html", null, true);
        echo ";
\t\$cod_emp_userLogged\t= \"";
        // line 41
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo", array(), "method"), "js"), "html", null, true);
        echo "\";
\t\$id_userEstab \t\t= ";
        // line 42
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento"), "getId", array(), "method"), "js"), "html", null, true);
        echo ";

\tconsole.log(\$id_userLogged, \$id_emp_userLogged, \$cod_emp_userLogged, \$id_userEstab);
\t
\t\$is_admin\t\t= ";
        // line 46
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t\$is_radX\t\t= ";
        // line 47
        if ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t\$is_prcMed\t\t= ";
        // line 48
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") && ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "idEmpleado"), "idTipoEmpleado"), "codigo") == "MED"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$is_admin, \$is_radX, \$is_prcMed);
    </script>
    
    ";
        // line 54
        echo "    ";
        // line 55
        echo "
    ";
        // line 57
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/jquery.formparams.min.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 60
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/jquery.mask.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 63
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_jQueryCustomFunctions.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 66
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/typeahead.js-master/dist/typeahead.bundle.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/typeahead.js-master/dist/bloodhound.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 70
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/bootstrap-table.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/locale/bootstrap-table-es-CR.min.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 73
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_data_bsTable_formatter.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 75
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_filter_bstable_config.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_explocal_navbarFilter_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 79
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_list_view_config_v2.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_form_config_v2.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_config_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_setterObject_modalData.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 83
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_select2_custom_formatter.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 86
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/formvalidation-master/dist/js/formValidation.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/formvalidation-master/dist/js/framework/bootstrap.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 88
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/formvalidation-master/dist/js/language/es_ES.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 91
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap3-editable/js/bootstrap-editable.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 95
        echo "
";
    }

    // line 98
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 100
        $this->displayBlock('simagd_navbar_menu_list', $context, $blocks);
        // line 137
        echo "    
    ";
        // line 138
        $this->displayBlock('simagd_bs_alert', $context, $blocks);
        // line 184
        echo "    
";
    }

    // line 100
    public function block_simagd_navbar_menu_list($context, array $blocks = array())
    {
        // line 101
        echo "\t<nav class=\"navbar navbar-default\">
\t    <div class=\"container-fluid\">
\t\t<!-- Brand and toggle get grouped for better mobile display -->
\t\t<div class=\"navbar-header\">
\t\t    <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
\t\t\t<span class=\"sr-only\">Toggle navigation</span>
\t\t\t<span class=\"icon-bar\"></span>
\t\t\t<span class=\"icon-bar\"></span>
\t\t\t<span class=\"icon-bar\"></span>
\t\t    </button>
\t\t    <span class=\"navbar-brand\"><span class=\"label label-primary-v2\">
\t\t\t";
        // line 112
        $this->displayBlock('simagd_navbar_menu_label', $context, $blocks);
        // line 115
        echo "\t\t    </span></span>
\t\t</div>

\t\t<!-- Collect the nav links, forms, and other content for toggling -->
\t\t<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
\t\t    <ul class=\"nav navbar-nav\">
\t\t\t";
        // line 121
        $this->displayBlock('simagd_navbar_left_nav', $context, $blocks);
        // line 124
        echo "\t\t    </ul>
\t\t    ";
        // line 125
        $this->displayBlock('simagd_navbar_middle_nav', $context, $blocks);
        // line 128
        echo "\t\t    <ul class=\"nav navbar-nav navbar-right\">
\t\t\t";
        // line 129
        $this->displayBlock('simagd_navbar_right_nav', $context, $blocks);
        // line 132
        echo "\t\t    </ul>
\t\t</div><!-- /.navbar-collapse -->
\t    </div><!-- /.container-fluid -->
\t</nav>
    ";
    }

    // line 112
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 113
        echo "\t\t\t    <i class=\"fa fa-th-list\"></i> Listado de registros
\t\t\t";
    }

    // line 121
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 122
        echo "\t\t\t    ";
        // line 123
        echo "\t\t\t";
    }

    // line 125
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 126
        echo "\t\t\t";
        // line 127
        echo "\t\t    ";
    }

    // line 129
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 130
        echo "\t\t\t    ";
        // line 131
        echo "\t\t\t";
    }

    // line 138
    public function block_simagd_bs_alert($context, array $blocks = array())
    {
        // line 139
        echo "\t";
        $this->displayBlock('simagd_inserted_alert', $context, $blocks);
        // line 150
        echo "\t";
        $this->displayBlock('simagd_edited_alert', $context, $blocks);
        // line 161
        echo "\t";
        $this->displayBlock('simagd_error_alert', $context, $blocks);
        // line 172
        echo "\t";
        $this->displayBlock('simagd_warning_alert', $context, $blocks);
        // line 183
        echo "    ";
    }

    // line 139
    public function block_simagd_inserted_alert($context, array $blocks = array())
    {
        // line 140
        echo "\t    <div class=\"simagd-response-bs-alert\" aria-hidden=\"true\">
\t\t<div class=\"alert alert-success alert-dismissable\" id=\"simagd-added-response-bs-alert\" style=\"display: none;\">
\t\t    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
\t\t    <span>
\t\t\t<span class=\"glyphicon glyphicon-ok-circle\" aria-hidden=\"true\"></span>
\t\t\t<strong>Finalizado! &nbsp; </strong> El registro ha sido insertado con éxito.
\t\t    </span>
\t\t</div>
\t    </div>
\t";
    }

    // line 150
    public function block_simagd_edited_alert($context, array $blocks = array())
    {
        // line 151
        echo "\t    <div class=\"simagd-response-bs-alert\" aria-hidden=\"true\">
\t\t<div class=\"alert alert-info alert-dismissable\" id=\"simagd-edited-response-bs-alert\" style=\"display: none;\">
\t\t    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
\t\t    <span>
\t\t\t<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span>
\t\t\t<strong>Finalizado! &nbsp; </strong> El registro ha sido modificado con éxito.
\t\t    </span>
\t\t</div>
\t    </div>
\t";
    }

    // line 161
    public function block_simagd_error_alert($context, array $blocks = array())
    {
        // line 162
        echo "\t    <div class=\"simagd-response-bs-alert\" aria-hidden=\"true\">
\t\t<div class=\"alert alert-danger alert-dismissable\" id=\"simagd-error-response-bs-alert\" style=\"display: none;\">
\t\t    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
\t\t    <span>
\t\t\t<span class=\"glyphicon glyphicon-remove-circle\" aria-hidden=\"true\"></span>
\t\t\t<strong>Error! &nbsp; </strong> Fallo la operación realizada.
\t\t    </span>
\t\t</div>
\t    </div>
\t";
    }

    // line 172
    public function block_simagd_warning_alert($context, array $blocks = array())
    {
        // line 173
        echo "\t    <div class=\"simagd-response-bs-alert\" aria-hidden=\"true\">
\t\t<div class=\"alert alert-warning alert-dismissable\" id=\"simagd-warning-response-bs-alert\" style=\"display: none;\">
\t\t    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
\t\t    <span>
\t\t\t<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
\t\t\t<strong>Advertencia! &nbsp; </strong> La operación no finalizó correctamente.
\t\t    </span>
\t\t</div>
\t    </div>
\t";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle::simagd_base_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  416 => 173,  413 => 172,  400 => 162,  397 => 161,  384 => 151,  381 => 150,  368 => 140,  365 => 139,  361 => 183,  358 => 172,  355 => 161,  352 => 150,  349 => 139,  346 => 138,  342 => 131,  340 => 130,  337 => 129,  333 => 127,  331 => 126,  328 => 125,  324 => 123,  322 => 122,  319 => 121,  314 => 113,  303 => 132,  301 => 129,  298 => 128,  296 => 125,  293 => 124,  291 => 121,  283 => 115,  281 => 112,  268 => 101,  265 => 100,  260 => 184,  258 => 138,  255 => 137,  253 => 100,  250 => 98,  239 => 91,  234 => 88,  225 => 86,  220 => 83,  216 => 82,  212 => 81,  208 => 80,  203 => 79,  198 => 76,  193 => 75,  184 => 71,  179 => 70,  169 => 66,  157 => 60,  151 => 57,  146 => 54,  134 => 48,  126 => 47,  118 => 46,  107 => 41,  103 => 40,  99 => 39,  83 => 27,  80 => 26,  72 => 22,  66 => 19,  60 => 16,  54 => 13,  51 => 11,  49 => 9,  43 => 6,  40 => 5,  651 => 437,  648 => 436,  640 => 434,  638 => 433,  610 => 407,  607 => 404,  595 => 394,  587 => 388,  580 => 387,  552 => 361,  541 => 359,  536 => 358,  525 => 356,  520 => 355,  509 => 353,  505 => 352,  492 => 341,  483 => 333,  458 => 309,  437 => 289,  404 => 257,  382 => 236,  357 => 212,  336 => 192,  311 => 112,  290 => 148,  269 => 128,  257 => 117,  249 => 115,  245 => 95,  236 => 112,  230 => 87,  223 => 109,  215 => 107,  211 => 105,  202 => 104,  197 => 103,  192 => 102,  188 => 73,  178 => 93,  174 => 67,  166 => 85,  163 => 63,  156 => 75,  153 => 74,  148 => 55,  138 => 63,  128 => 60,  124 => 58,  121 => 57,  116 => 54,  111 => 42,  108 => 50,  101 => 46,  97 => 45,  92 => 44,  86 => 41,  77 => 34,  56 => 17,  53 => 16,  45 => 12,  42 => 11,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
