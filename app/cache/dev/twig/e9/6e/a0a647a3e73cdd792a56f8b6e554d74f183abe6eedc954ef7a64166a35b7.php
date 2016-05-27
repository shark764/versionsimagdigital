<?php

/* MinsalSimagdBundle:ImgLecturaAdmin:lct_list_v2.html.twig */
class __TwigTemplate_e96ea0a647a3e73cdd792a56f8b6e554d74f183abe6eedc954ef7a64166a35b7 extends Twig_Template
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
        $context["_LCT_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_LCT_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_LCT_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        $context["_LCT_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 12
        $context["_DIAG_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 13
        $context["_DIAG_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 14
        $context["_DIAG_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 15
        $context["_DIAG_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 18
        $context["_NOTDIAG_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 19
        $context["_NOTDIAG_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 20
        $context["_NOTDIAG_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 21
        $context["_NOTDIAG_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_NOTA_DIAGNOSTICO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 24
        $context["_PNDL_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 25
        $context["_PNDL_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_LECTURA_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 26
        $context["_PNDL_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_LECTURA_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 29
        $context["_PNDLPR_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_LECTURAS_NO_CONCLUIDAS_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 32
        $context["_PNDT_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_TRANSCRIPCION_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 33
        $context["_PNDT_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_TRANSCRIPCION_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 34
        $context["_PNDT_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_TRANSCRIPCION_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 37
        $context["_PNDTPR_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_MIS_TRANSCRIPCIONES_NO_CONCLUIDAS_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 40
        $context["_PNDV_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_VALIDACION_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 41
        $context["_PNDV_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_VALIDACION_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 42
        $context["_PNDV_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PENDIENTE_VALIDACION_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 44
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 45
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    ";
        // line 48
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

";
    }

    // line 52
    public function block_javascripts($context, array $blocks = array())
    {
        // line 53
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         * 
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-resultados-radiologicos';
        
        /** Lista de patrones para diagnósticos */
\tvar ";
        // line 65
        echo "            \$isGranted_assigInterpretationWorklist,
            \$isGranted_assigTranscriptionWorklist,
            \$isGranted_assigValidationWorklist;

        \$isGranted_assigInterpretationWorklist\t= ";
        // line 69
        if (((((isset($context["_PNDL_ALLOW_EDIT"]) ? $context["_PNDL_ALLOW_EDIT"] : $this->getContext($context, "_PNDL_ALLOW_EDIT")) == true) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
        \$isGranted_assigTranscriptionWorklist\t= ";
        // line 70
        if (((((isset($context["_PNDT_ALLOW_EDIT"]) ? $context["_PNDT_ALLOW_EDIT"] : $this->getContext($context, "_PNDT_ALLOW_EDIT")) == true) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
        \$isGranted_assigValidationWorklist\t= ";
        // line 71
        if ((((isset($context["_PNDV_ALLOW_EDIT"]) ? $context["_PNDV_ALLOW_EDIT"] : $this->getContext($context, "_PNDV_ALLOW_EDIT")) == true) && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE")))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t
        ";
        // line 95
        echo "
        (function (\$) {
            /*
             * 
             * @type type
             * Global variables for plugin
             */
            window.\$DIAGNOSTIC_PATTERN_LIST = null;   // --| build data collection
            \$DIAGNOSTIC_PATTERN_LIST    = JSON.parse('";
        // line 103
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["DIAGNOSTIC_PATTERN_LIST"]) ? $context["DIAGNOSTIC_PATTERN_LIST"] : $this->getContext($context, "DIAGNOSTIC_PATTERN_LIST"))), "js");
        echo "');
            console.log('\$DIAGNOSTIC_PATTERN_LIST', \$DIAGNOSTIC_PATTERN_LIST);

        }(jQuery));
        
        console.log('%c typeahead overslap button can be solved by adding 100% width again', 'background: #f00; color: #bada55');
        
    </script>

    ";
        // line 113
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/lang/summernote-es-ES.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 115
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_summernote_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 118
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_webkitSpeechRecognition.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 121
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgLecturaAdmin/lct_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 123
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgDiagnosticoAdmin/diag_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 125
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgNotaDiagnosticoAdmin/notdiag_list_v2.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 128
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteLecturaAdmin/pndL_assignRadX_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 129
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteLecturaAdmin/pndL_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 131
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteLecturaAdmin/pndL_personal_list_v2.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 134
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteTranscripcionAdmin/pndT_assignTrcX_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 135
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteTranscripcionAdmin/pndT_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 137
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteTranscripcionAdmin/pndT_personal_list_v2.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 140
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteValidacionAdmin/pndV_valid_diag_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 141
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteValidacionAdmin/pndV_assignRadXValid_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 142
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgPendienteValidacionAdmin/pndV_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 146
    public function block_simagd_bs_alert($context, array $blocks = array())
    {
        // line 147
        echo "    ";
        $this->displayParentBlock("simagd_bs_alert", $context, $blocks);
        echo "

    ";
        // line 149
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteLecturaAdmin:pndL_assignRadX_alert.html.twig")->display($context);
        // line 150
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_assignTrcX_alert.html.twig")->display($context);
        // line 151
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_assignRadXValid_alert.html.twig")->display($context);
        // line 152
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_valid_diag_alert.html.twig")->display($context);
    }

    // line 155
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 156
        echo "    <i class=\"fa fa-user-md\"></i> <i class=\"fa fa-microphone\"></i> Resultados de Rayos X
";
    }

    // line 159
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 160
        echo "    <li class=\"list-table-link-navbar-parent dropdown active\">
\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><span class=\"text-info\"><i class=\"fa fa-microphone\"></i> <i class=\"fa fa-list-ul\"></i> </span> Resultados <span class=\"text-info\"><span class=\"caret\"></span></span></a>
\t<ul class=\"dropdown-menu\" role=\"menu\">
\t    <li class=\"list-table-link-navbar active ";
        // line 163
        if (((isset($context["_LCT_ALLOW_LIST"]) ? $context["_LCT_ALLOW_LIST"] : $this->getContext($context, "_LCT_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-lecturas-list\" data-divtabletarget=\"div-resultado-lecturas-realizadas\"
\t\t\t";
        // line 165
        if (((isset($context["_LCT_ALLOW_LIST"]) ? $context["_LCT_ALLOW_LIST"] : $this->getContext($context, "_LCT_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                    <span class=\"glyphicon glyphicon-adjust \"></span> Interpretaciones
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar ";
        // line 170
        if (((isset($context["_DIAG_ALLOW_LIST"]) ? $context["_DIAG_ALLOW_LIST"] : $this->getContext($context, "_DIAG_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-diagnosticos-list\" data-divtabletarget=\"div-resultado-diagnosticos-transcritos\"
\t\t\t";
        // line 172
        if (((isset($context["_DIAG_ALLOW_LIST"]) ? $context["_DIAG_ALLOW_LIST"] : $this->getContext($context, "_DIAG_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-headphones \"></span> Transcripciones
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar ";
        // line 177
        if (((isset($context["_NOTDIAG_ALLOW_LIST"]) ? $context["_NOTDIAG_ALLOW_LIST"] : $this->getContext($context, "_NOTDIAG_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-notas-diagnostico-list\" data-divtabletarget=\"div-resultado-notas-diagnostico\"
\t\t\t";
        // line 179
        if (((isset($context["_NOTDIAG_ALLOW_LIST"]) ? $context["_NOTDIAG_ALLOW_LIST"] : $this->getContext($context, "_NOTDIAG_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-comment \"></span> Notas a diagnósticos
\t\t</a>
\t    </li>
\t</ul>
    </li>
";
    }

    // line 187
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 188
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"true\">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
\t</div>
        <button type=\"submit\" id=\"btn_search_filter_expNumero\" name=\"btn_search_filter_expNumero\" class=\"btn btn-primary-v2 ";
        // line 193
        echo "\">
            <i class=\"fa fa-search\"></i>
        </button>
    </form>
";
    }

    // line 199
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 200
        echo "    <li class=\"list-table-link-navbar-parent dropdown\">
\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><span class=\"text-info\"><i class=\"fa fa-microphone\"></i> <i class=\"fa fa-list-ul\"></i> </span> Resultados pendientes <span class=\"text-info\"><span class=\"caret\"></span></span></a>
\t<ul class=\"dropdown-menu\" role=\"menu\">
\t    <li class=\"list-table-link-navbar ";
        // line 203
        if (((isset($context["_PNDL_ALLOW_LIST"]) ? $context["_PNDL_ALLOW_LIST"] : $this->getContext($context, "_PNDL_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-general-list\" data-divtabletarget=\"div-resultado-lecturas-pendientes\"
\t\t\t";
        // line 205
        if (((isset($context["_PNDL_ALLOW_LIST"]) ? $context["_PNDL_ALLOW_LIST"] : $this->getContext($context, "_PNDL_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                    <span class=\"glyphicon glyphicon-tasks \"></span> Interpretaciones pendientes
\t\t</a>
\t    </li>
\t    <li class=\"list-table-link-navbar ";
        // line 209
        if (((isset($context["_PNDLPR_ALLOW_LIST"]) ? $context["_PNDLPR_ALLOW_LIST"] : $this->getContext($context, "_PNDLPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-personal-list\" data-divtabletarget=\"div-resultado-lecturas-personal-pendientes\"
\t\t\t";
        // line 211
        if (((isset($context["_PNDLPR_ALLOW_LIST"]) ? $context["_PNDLPR_ALLOW_LIST"] : $this->getContext($context, "_PNDLPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-user \"></span> Listado personal
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar ";
        // line 216
        if (((isset($context["_PNDT_ALLOW_LIST"]) ? $context["_PNDT_ALLOW_LIST"] : $this->getContext($context, "_PNDT_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-trc_table-general-list\" data-divtabletarget=\"div-resultado-transcripciones-pendientes\"
\t\t    ";
        // line 218
        if (((isset($context["_PNDT_ALLOW_LIST"]) ? $context["_PNDT_ALLOW_LIST"] : $this->getContext($context, "_PNDT_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                    <span class=\"glyphicon glyphicon-tasks \"></span> Transcripciones pendientes
\t\t</a>
\t    </li>
\t    <li class=\"list-table-link-navbar ";
        // line 222
        if (((isset($context["_PNDTPR_ALLOW_LIST"]) ? $context["_PNDTPR_ALLOW_LIST"] : $this->getContext($context, "_PNDTPR_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-trc-table-personal-list\" data-divtabletarget=\"div-resultado-transcripciones-personal-pendientes\"
\t\t    ";
        // line 224
        if (((isset($context["_PNDTPR_ALLOW_LIST"]) ? $context["_PNDTPR_ALLOW_LIST"] : $this->getContext($context, "_PNDTPR_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-user \"></span> Listado personal
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar ";
        // line 229
        if (((isset($context["_PNDV_ALLOW_LIST"]) ? $context["_PNDV_ALLOW_LIST"] : $this->getContext($context, "_PNDV_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t\t<a href=\"javascript:void(0)\" id=\"show-table-sin-validar-list\" data-divtabletarget=\"div-resultado-sin-validar\"
\t\t\t";
        // line 231
        if (((isset($context["_PNDV_ALLOW_LIST"]) ? $context["_PNDV_ALLOW_LIST"] : $this->getContext($context, "_PNDV_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <span class=\"glyphicon glyphicon-check \"></span> Resultados sin validar
\t\t</a>
\t    </li>
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

    // line 246
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 249
        echo "    ";
        // line 250
        echo "    ";
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    ";
        // line 252
        if (((isset($context["_LCT_ALLOW_LIST"]) ? $context["_LCT_ALLOW_LIST"] : $this->getContext($context, "_LCT_ALLOW_LIST")) == true)) {
            // line 253
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 254
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "lct")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 255
            echo "        <!-- END --| toolbar for table-lista-lecturas -->
        
\t<div id=\"div-resultado-lecturas-realizadas\" class=\"menu-listas-resultados-radiologicos\" data-refresh-url=\"";
            // line 257
            echo $this->env->getExtension('routing')->getPath("simagd_lectura_listarLecturas");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-lecturas\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"lct_id\"
\t\t  data-url=\"";
            // line 261
            echo $this->env->getExtension('routing')->getPath("simagd_lectura_listarLecturas");
            echo "\"
\t\t  data-backup-url=\"simagd_lectura_listarLecturas\"
                  data-toolbar=\"#bs_lct_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaLecturasToolbar\"
\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 271
            echo "]\"
";
            // line 274
            echo "\t\t  ";
            // line 276
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 281
            echo "\t\t\t<th data-field=\"lct_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" ";
            // line 282
            echo " class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prc_referido\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizado en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"prz_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" data-formatter=\"simagdEstadoEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado (estudio)</th>
\t\t\t<th data-field=\"lct_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statuslct_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-formatter=\"simagdEstadoLecturaFormatter\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"lct_tipoResultado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tipoR_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo de Resultado</th>
\t\t\t<th data-field=\"lct_radiologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"emplct_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretó</th>
\t\t\t<th data-field=\"lct_fechaLectura\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se interpretó</th>
\t\t\t<th data-field=\"lct_correlativo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Correlativo</th>
\t\t\t<th data-field=\"lct_lecturaRemota\" data-formatter=\"remotaFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Fué remota</th>
\t\t\t<th data-field=\"lct_solicitadaPorRadiologo\" data-formatter=\"solicitadaPorRadiologoFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Requerido por radiólogo</th>
\t\t\t<th data-field=\"lct_radiologoSol\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Requirió (Radiólogo)</th>
\t\t\t<th data-field=\"lct_radiologoVal\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Validará</th>
\t\t\t<th data-field=\"action\" data-formatter=\"lectura_actionFormatter\" data-events=\"lectura_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 306
        echo "
    ";
        // line 307
        if (((isset($context["_DIAG_ALLOW_LIST"]) ? $context["_DIAG_ALLOW_LIST"] : $this->getContext($context, "_DIAG_ALLOW_LIST")) == true)) {
            // line 308
            echo "        <!-- toolbar for table-lista-diagnosticos -->
        ";
            // line 309
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "diag")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 310
            echo "        <!-- END --| toolbar for table-lista-diagnosticos -->
        
\t<div id=\"div-resultado-diagnosticos-transcritos\" style=\"display: none;\" class=\"menu-listas-resultados-radiologicos\" data-refresh-url=\"";
            // line 312
            echo $this->env->getExtension('routing')->getPath("simagd_diagnostico_listarDiagnosticos");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-diagnosticos\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"diag_id\"
\t\t  data-url=\"\"
                  data-backup-url=\"simagd_diagnostico_listarDiagnosticos\"
                  data-toolbar=\"#bs_diag_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaDiagnosticosToolbar\"
\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 326
            echo "]\"
\t\t  ";
            // line 329
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 334
            echo "\t\t\t<th data-field=\"diag_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"diag_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusdiag_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdEstadoDiagnosticoFormatter\" class=\"col-md-1\"  data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"diag_fechaRegistro\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se registró</th>
\t\t\t<th data-field=\"diag_transcriptor\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empdiag_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Transcribió</th>
\t\t\t<th data-field=\"diag_fechaTranscrito\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se transcribió</th>
\t\t\t<th data-field=\"lct_radiologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"emplct_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretó</th>
\t\t\t<th data-field=\"diag_fechaAprobado\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se aprobó</th>
\t\t\t<th data-field=\"lct_correlativo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Correlativo</th>
\t\t\t<th data-field=\"lct_fechaLectura\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se interpretó</th>
\t\t\t<th data-field=\"action\" data-formatter=\"diagnostico_actionFormatter\" data-events=\"diagnostico_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
\t
        ";
            // line 356
            echo "    ";
            // line 357
            echo "    ";
        }
        // line 358
        echo "
    ";
        // line 359
        if (((isset($context["_NOTDIAG_ALLOW_LIST"]) ? $context["_NOTDIAG_ALLOW_LIST"] : $this->getContext($context, "_NOTDIAG_ALLOW_LIST")) == true)) {
            // line 360
            echo "        <!-- toolbar for table-lista-notas-diagnosticos -->
        ";
            // line 361
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "notdiag")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 362
            echo "        <!-- END --| toolbar for table-lista-notas-diagnosticos -->
        
\t<div id=\"div-resultado-notas-diagnostico\" style=\"display: none;\" class=\"menu-listas-resultados-radiologicos\" data-refresh-url=\"";
            // line 364
            echo $this->env->getExtension('routing')->getPath("simagd_nota_listarNotasDiagnostico");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-notas-diagnostico\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"notdiag_id\"
\t\t  data-url=\"\"
                  data-backup-url=\"simagd_nota_listarNotasDiagnostico\"
                  data-toolbar=\"#bs_notdiag_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaNotasDiagnosticoToolbar\"
\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 378
            echo "]\"
\t\t  ";
            // line 381
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 386
            echo "\t\t\t<th data-field=\"notdiag_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"prc_referido\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estudio realizado en</th>
\t\t\t<th data-field=\"diag_transcriptor\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empdiag_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Transcribió</th>
\t\t\t<th data-field=\"diag_fechaRegistro\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se registró</th>
\t\t\t<th data-field=\"diag_fechaTranscrito\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se transcribió</th>
\t\t\t<th data-field=\"lct_radiologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"emplct_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretó</th>
\t\t\t<th data-field=\"lct_fechaLectura\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se interpretó</th>
\t\t\t<th data-field=\"lct_diagnosticante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdlct_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretado en</th>
\t\t\t<th data-field=\"diag_fechaAprobado\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se aprobó</th>
\t\t\t<th data-field=\"diag_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusdiag_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdEstadoDiagnosticoFormatter\" class=\"col-md-1\"  data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"lct_correlativo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Correlativo</th>
\t\t\t<th data-field=\"notdiag_emisorNota\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empnotdiag_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Emitió</th>
\t\t\t<th data-field=\"notdiag_tipoNota\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tipoN_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdTipoNotaFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"notdiag_fechaEmision\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se emitió</th>
\t\t\t<th data-field=\"action\" data-formatter=\"notadiagnostico_actionFormatter\" data-events=\"notadiagnostico_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 413
        echo "
    ";
        // line 414
        if (((isset($context["_PNDL_ALLOW_LIST"]) ? $context["_PNDL_ALLOW_LIST"] : $this->getContext($context, "_PNDL_ALLOW_LIST")) == true)) {
            // line 415
            echo "        <!-- toolbar for table-lista-lecturas-pendientes -->
        ";
            // line 416
            $context["code_entity"] = "pndL";
            // line 417
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 420
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 422
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 427
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 430
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 433
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
            // line 445
            echo "
        </div> <!-- END --| toolbar for table-lista-lecturas-pendientes -->

\t<div id=\"div-resultado-lecturas-pendientes\" style=\"display: none;\" class=\"menu-listas-resultados-radiologicos\" data-refresh-url=\"";
            // line 448
            echo $this->env->getExtension('routing')->getPath("simagd_sin_lectura_listarPendientesLectura");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-pendientes-lectura\"
\t\t    data-toggle=\"table\"
\t\t    data-id-field=\"pndL_id\"
\t\t    data-url=\"";
            // line 452
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
            // line 462
            echo "]\"
\t\t    ";
            // line 465
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t    data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 470
            echo "\t\t\t<th data-field=\"pndL_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[empprc_id, empcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[m_id, mcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"pndR_tipo\" data-formatter=\"simagdTipoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"pndL_establecimiento\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretar en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"prz_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" data-formatter=\"simagdEstadoEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"pndL_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t\t<th data-field=\"pndL_postEstudio\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"pndL_solicitudPostEstudio\" data-filter-bstable-type=\"boolean\" data-filter-bstable-data-source=\"getPostEstudioSourceData\" data-formatter=\"postEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Post Estudio</th>
\t\t\t<th data-field=\"action\" data-formatter=\"pendienteLectura_actionFormatter\" data-events=\"pendienteLectura_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                        <th data-field=\"pndL_chk\" data-checkbox=\"true\" data-formatter=\"selectableRowFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 490
        echo "
    ";
        // line 491
        if (((isset($context["_PNDLPR_ALLOW_LIST"]) ? $context["_PNDLPR_ALLOW_LIST"] : $this->getContext($context, "_PNDLPR_ALLOW_LIST")) == true)) {
            // line 492
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 493
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "pndLPr")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 494
            echo "        <!-- END --| toolbar for table-lista-lecturas -->

\t<div id=\"div-resultado-lecturas-personal-pendientes\" style=\"display: none;\" class=\"menu-listas-resultados-radiologicos\" data-refresh-url=\"";
            // line 496
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
            // line 510
            echo "]\"
\t\t    ";
            // line 513
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t    data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 518
            echo "\t\t\t<th data-field=\"pndL_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[empprc_id, empcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[m_id, mcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"pndR_tipo\" data-formatter=\"simagdTipoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t\t<th data-field=\"pndL_establecimiento\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretar en</th>
\t\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t\t<th data-field=\"prz_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" data-formatter=\"simagdEstadoEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"pndL_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t\t<th data-field=\"pndL_postEstudio\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"pndL_solicitudPostEstudio\" data-filter-bstable-type=\"boolean\" data-filter-bstable-data-source=\"getPostEstudioSourceData\" data-formatter=\"postEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Post Estudio</th>
\t\t\t<th data-field=\"action\" data-formatter=\"pendienteLectura_personal_actionFormatter\" data-events=\"pendienteLectura_personal_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 537
        echo "
    ";
        // line 538
        if (((isset($context["_PNDT_ALLOW_LIST"]) ? $context["_PNDT_ALLOW_LIST"] : $this->getContext($context, "_PNDT_ALLOW_LIST")) == true)) {
            // line 539
            echo "        <!-- toolbar for table-lista-transcripciones-pendientes -->
        ";
            // line 540
            $context["code_entity"] = "pndT";
            // line 541
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 544
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 546
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 551
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 554
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 557
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
            // line 569
            echo "
        </div> <!-- END --| toolbar for table-lista-transcripciones-pendientes -->

\t<div id=\"div-resultado-transcripciones-pendientes\" style=\"display: none;\" class=\"menu-listas-resultados-radiologicos\" data-refresh-url=\"";
            // line 572
            echo $this->env->getExtension('routing')->getPath("simagd_sin_transcribir_listarPendientesTranscripcion");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-pendientes-transcripcion\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"pndT_id\"
\t\t  data-url=\"";
            // line 576
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
            // line 586
            echo "]\"
\t\t  ";
            // line 589
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 594
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
\t\t\t<th data-field=\"action\" data-formatter=\"pendienteTranscripcion_actionFormatter\" data-events=\"pendienteTranscripcion_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                        <th data-field=\"pndT_chk\" data-checkbox=\"true\" data-formatter=\"selectableRowFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 616
        echo "
    ";
        // line 617
        if (((isset($context["_PNDTPR_ALLOW_LIST"]) ? $context["_PNDTPR_ALLOW_LIST"] : $this->getContext($context, "_PNDTPR_ALLOW_LIST")) == true)) {
            // line 618
            echo "        <!-- toolbar for table-lista-lecturas -->
        ";
            // line 619
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "pndTPr")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 620
            echo "        <!-- END --| toolbar for table-lista-lecturas -->

\t<div id=\"div-resultado-transcripciones-personal-pendientes\" style=\"display: none;\" class=\"menu-listas-resultados-radiologicos\" data-refresh-url=\"";
            // line 622
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
            // line 636
            echo "]\"
\t\t  ";
            // line 639
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 644
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
\t\t\t<th data-field=\"action\" data-formatter=\"pendienteTranscripcion_personal_actionFormatter\" data-events=\"pendienteTranscripcion_personal_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 665
        echo "
    ";
        // line 666
        if (((isset($context["_PNDV_ALLOW_LIST"]) ? $context["_PNDV_ALLOW_LIST"] : $this->getContext($context, "_PNDV_ALLOW_LIST")) == true)) {
            // line 667
            echo "        <!-- toolbar for table-lista-validaciones-pendientes -->
        ";
            // line 668
            $context["code_entity"] = "pndV";
            // line 669
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 672
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 674
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 679
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 682
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 685
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
            // line 697
            echo "
        </div> <!-- END --| toolbar for table-lista-validaciones-pendientes -->

\t";
            // line 700
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_list_v2.html.twig")->display(array_merge($context, array("view_menu_class" => "menu-listas-resultados-radiologicos")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 701
            echo "    ";
            // line 702
            echo "    ";
        }
        // line 703
        echo "
    <!-- form for assign radX to rows -->
    ";
        // line 705
        if (((((isset($context["_PNDL_ALLOW_EDIT"]) ? $context["_PNDL_ALLOW_EDIT"] : $this->getContext($context, "_PNDL_ALLOW_EDIT")) == true) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE"))) {
            // line 706
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteLecturaAdmin:pndL_asignarRadiologoListaTrabajo_modal.html.twig")->display(array_merge($context, array("radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 708
            echo "    ";
        }
        // line 709
        echo "
    <!-- form for assign trcX to rows -->
    ";
        // line 711
        if (((((isset($context["_PNDT_ALLOW_EDIT"]) ? $context["_PNDT_ALLOW_EDIT"] : $this->getContext($context, "_PNDT_ALLOW_EDIT")) == true) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE"))) {
            // line 712
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_asignarTranscriptorListaTrabajo_modal.html.twig")->display(array_merge($context, array("transcriptores" => (isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 714
            echo "    ";
        }
        // line 715
        echo "
    <!-- form for assign radX to validation rows -->
    ";
        // line 717
        if ((((isset($context["_PNDV_ALLOW_EDIT"]) ? $context["_PNDV_ALLOW_EDIT"] : $this->getContext($context, "_PNDV_ALLOW_EDIT")) == true) && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_DIAGNOSTICO_CREATE")))) {
            // line 718
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_asignarRadiologoListaTrabajo_modal.html.twig")->display(array_merge($context, array("radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 720
            echo "    ";
        }
        // line 721
        echo "    
    ";
        // line 722
        if ((((isset($context["_DIAG_ALLOW_CREATE"]) ? $context["_DIAG_ALLOW_CREATE"] : $this->getContext($context, "_DIAG_ALLOW_CREATE")) == true) || ((isset($context["_DIAG_ALLOW_EDIT"]) ? $context["_DIAG_ALLOW_EDIT"] : $this->getContext($context, "_DIAG_ALLOW_EDIT")) == true))) {
            // line 723
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_transcribirDiagnostico_modal.html.twig")->display(array_merge($context, array("estados" => (isset($context["estadosDiag"]) ? $context["estadosDiag"] : $this->getContext($context, "estadosDiag")), "transcriptores" => (isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "estadoDiagDefault" => (isset($context["estadoDiagDefault"]) ? $context["estadoDiagDefault"] : $this->getContext($context, "estadoDiagDefault")), "patronesDiag" => (isset($context["patronesDiag"]) ? $context["patronesDiag"] : $this->getContext($context, "patronesDiag")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 725
            echo "    ";
        }
        // line 726
        echo "    ";
        if ((((isset($context["_NOTDIAG_ALLOW_CREATE"]) ? $context["_NOTDIAG_ALLOW_CREATE"] : $this->getContext($context, "_NOTDIAG_ALLOW_CREATE")) == true) || ((isset($context["_NOTDIAG_ALLOW_EDIT"]) ? $context["_NOTDIAG_ALLOW_EDIT"] : $this->getContext($context, "_NOTDIAG_ALLOW_EDIT")) == true))) {
            // line 727
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgNotaDiagnosticoAdmin:notdiag_crearNota_modal.html.twig")->display(array_merge($context, array("tipos" => (isset($context["tiposNota"]) ? $context["tiposNota"] : $this->getContext($context, "tiposNota")), "radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "tipoNotaDefault" => (isset($context["tipoNotaDefault"]) ? $context["tipoNotaDefault"] : $this->getContext($context, "tipoNotaDefault")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 729
            echo "    ";
        }
        // line 730
        echo "
    ";
        // line 731
        if (((isset($context["_LCT_ALLOW_VIEW"]) ? $context["_LCT_ALLOW_VIEW"] : $this->getContext($context, "_LCT_ALLOW_VIEW")) == true)) {
            // line 732
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:lct_total_info_modal_v2.html.twig")->display($context);
            echo "    \t";
            // line 733
            echo "    ";
        }
        // line 734
        echo "    ";
        if (((isset($context["_DIAG_ALLOW_VIEW"]) ? $context["_DIAG_ALLOW_VIEW"] : $this->getContext($context, "_DIAG_ALLOW_VIEW")) == true)) {
            // line 735
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:diag_total_info_modal_v2.html.twig")->display($context);
            echo "    \t";
            // line 736
            echo "    ";
        }
        // line 737
        echo "    ";
        if (((isset($context["_NOTDIAG_ALLOW_VIEW"]) ? $context["_NOTDIAG_ALLOW_VIEW"] : $this->getContext($context, "_NOTDIAG_ALLOW_VIEW")) == true)) {
            // line 738
            echo "\t";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:notdiag_total_info_modal_v2.html.twig")->display($context);
            echo " \t";
            // line 739
            echo "    ";
        }
        // line 740
        echo "    
    ";
        // line 748
        echo "    
    ";
        // line 750
        echo "    ";
        // line 755
        echo "    
    ";
        // line 756
        $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_speechRecognition_modal.html.twig")->display($context);
        echo "    ";
        // line 757
        echo "    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgLecturaAdmin:lct_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1257 => 757,  1254 => 756,  1251 => 755,  1249 => 750,  1246 => 748,  1243 => 740,  1240 => 739,  1236 => 738,  1233 => 737,  1230 => 736,  1226 => 735,  1223 => 734,  1220 => 733,  1216 => 732,  1214 => 731,  1211 => 730,  1208 => 729,  1200 => 727,  1197 => 726,  1194 => 725,  1186 => 723,  1184 => 722,  1181 => 721,  1178 => 720,  1170 => 718,  1168 => 717,  1164 => 715,  1161 => 714,  1153 => 712,  1151 => 711,  1147 => 709,  1144 => 708,  1136 => 706,  1134 => 705,  1130 => 703,  1127 => 702,  1125 => 701,  1118 => 700,  1113 => 697,  1098 => 685,  1091 => 682,  1085 => 679,  1077 => 674,  1073 => 672,  1067 => 669,  1065 => 668,  1062 => 667,  1060 => 666,  1057 => 665,  1034 => 644,  1028 => 639,  1025 => 636,  1008 => 622,  1004 => 620,  997 => 619,  994 => 618,  992 => 617,  989 => 616,  965 => 594,  959 => 589,  956 => 586,  943 => 576,  936 => 572,  931 => 569,  916 => 557,  909 => 554,  903 => 551,  895 => 546,  891 => 544,  885 => 541,  883 => 540,  880 => 539,  878 => 538,  875 => 537,  854 => 518,  848 => 513,  845 => 510,  828 => 496,  824 => 494,  817 => 493,  814 => 492,  812 => 491,  809 => 490,  787 => 470,  781 => 465,  778 => 462,  765 => 452,  758 => 448,  753 => 445,  738 => 433,  731 => 430,  725 => 427,  717 => 422,  713 => 420,  707 => 417,  705 => 416,  702 => 415,  700 => 414,  697 => 413,  668 => 386,  662 => 381,  659 => 378,  642 => 364,  638 => 362,  631 => 361,  628 => 360,  626 => 359,  623 => 358,  620 => 357,  618 => 356,  594 => 334,  588 => 329,  585 => 326,  568 => 312,  564 => 310,  557 => 309,  554 => 308,  552 => 307,  549 => 306,  523 => 282,  520 => 281,  514 => 276,  512 => 274,  509 => 271,  496 => 261,  489 => 257,  485 => 255,  478 => 254,  475 => 253,  473 => 252,  467 => 250,  465 => 249,  462 => 246,  442 => 231,  435 => 229,  425 => 224,  418 => 222,  409 => 218,  402 => 216,  392 => 211,  385 => 209,  376 => 205,  369 => 203,  364 => 200,  361 => 199,  353 => 193,  346 => 188,  343 => 187,  330 => 179,  323 => 177,  313 => 172,  306 => 170,  296 => 165,  289 => 163,  284 => 160,  281 => 159,  276 => 156,  273 => 155,  268 => 152,  265 => 151,  262 => 150,  260 => 149,  254 => 147,  251 => 146,  244 => 142,  240 => 141,  235 => 140,  229 => 137,  225 => 135,  220 => 134,  214 => 131,  210 => 129,  205 => 128,  199 => 125,  194 => 123,  189 => 121,  183 => 118,  178 => 115,  174 => 114,  169 => 113,  157 => 103,  147 => 95,  138 => 71,  130 => 70,  122 => 69,  116 => 65,  101 => 53,  98 => 52,  90 => 48,  84 => 45,  81 => 44,  76 => 42,  74 => 41,  72 => 40,  70 => 37,  68 => 34,  66 => 33,  64 => 32,  62 => 29,  60 => 26,  58 => 25,  56 => 24,  54 => 21,  52 => 20,  50 => 19,  48 => 18,  46 => 15,  44 => 14,  42 => 13,  40 => 12,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
