<?php

/* MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_list_v2.html.twig */
class __TwigTemplate_dce5152e38c0000ac04fa78c8d98db1ff079e311dc41d9d1658548970ca2c9d9 extends Twig_Template
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
        $context["_EXPL_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_EXPL_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_EXPL_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        $context["_EXPL_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 12
        $context["_EXPLRZ_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_ESTABLECIMIENTO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 13
        $context["_EXPLRZ_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_ESTABLECIMIENTO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 14
        $context["_EXPLRZ_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_ESTABLECIMIENTO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 15
        $context["_EXPLRZ_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PROYECCION_ESTABLECIMIENTO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 17
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 18
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    
    ";
        // line 21
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap3-editable/css/bootstrap-editable.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />

";
    }

    // line 25
    public function block_javascripts($context, array $blocks = array())
    {
        // line 26
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         * 
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-proyecciones';
        
\tvar \$explrz_is_granted_changeStatus,
            \$isGranted_addPryLocalList;
\t
        \$isGranted_addPryLocalList      = ";
        // line 39
        if ((((isset($context["_EXPL_ALLOW_CREATE"]) ? $context["_EXPL_ALLOW_CREATE"] : $this->getContext($context, "_EXPL_ALLOW_CREATE")) == true) && (((isset($context["_EXPLRZ_ALLOW_CREATE"]) ? $context["_EXPLRZ_ALLOW_CREATE"] : $this->getContext($context, "_EXPLRZ_ALLOW_CREATE")) == true) || ((isset($context["_EXPLRZ_ALLOW_EDIT"]) ? $context["_EXPLRZ_ALLOW_EDIT"] : $this->getContext($context, "_EXPLRZ_ALLOW_EDIT")) == true)))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t
\t\$explrz_is_granted_changeStatus\t= ";
        // line 41
        if ((((isset($context["_EXPLRZ_ALLOW_CREATE"]) ? $context["_EXPLRZ_ALLOW_CREATE"] : $this->getContext($context, "_EXPLRZ_ALLOW_CREATE")) == true) || ((isset($context["_EXPLRZ_ALLOW_EDIT"]) ? $context["_EXPLRZ_ALLOW_EDIT"] : $this->getContext($context, "_EXPLRZ_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
    </script>
    
    ";
        // line 45
        echo "    ";
        // line 46
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd-label-bootstrap-table-editable.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap3-editable/js/bootstrap-editable.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 50
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlProyeccionEstablecimientoAdmin/explrz_examenes.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_cargar_datos.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 54
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlProyeccionAdmin/expl_addPryLocalList_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlProyeccionAdmin/expl_form_config.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlProyeccionAdmin/expl_list_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 58
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlProyeccionEstablecimientoAdmin/explrz_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 62
    public function block_simagd_bs_alert($context, array $blocks = array())
    {
        // line 63
        echo "    ";
        $this->displayParentBlock("simagd_bs_alert", $context, $blocks);
        echo "
    
    ";
        // line 65
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_addPryLocalList_alert.html.twig")->display($context);
    }

    // line 68
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 69
        echo "    <i class=\"fa fa-th-large\"></i> <i class=\"fa fa-tasks\"></i> Proyecciones de Imagenología
    ";
    }

    // line 73
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 74
        echo "    <li class=\"list-table-link-navbar active ";
        if (((isset($context["_EXPL_ALLOW_LIST"]) ? $context["_EXPL_ALLOW_LIST"] : $this->getContext($context, "_EXPL_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-general-list\" data-divtabletarget=\"div-resultado-proyecciones\"
\t    ";
        // line 76
        if (((isset($context["_EXPL_ALLOW_LIST"]) ? $context["_EXPL_ALLOW_LIST"] : $this->getContext($context, "_EXPL_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-tasks\"></i> </span> Listado general <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
    <li class=\"list-table-link-navbar ";
        // line 80
        if (((isset($context["_EXPLRZ_ALLOW_LIST"]) ? $context["_EXPLRZ_ALLOW_LIST"] : $this->getContext($context, "_EXPLRZ_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-local-list\" data-divtabletarget=\"div-resultado-proyecciones-locales\"
\t    ";
        // line 82
        if (((isset($context["_EXPLRZ_ALLOW_LIST"]) ? $context["_EXPLRZ_ALLOW_LIST"] : $this->getContext($context, "_EXPLRZ_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-h-square\"></i> <i class=\"fa fa-tasks\"></i> </span> Listado local
\t</a>
    </li>
";
    }

    // line 88
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 89
        echo "    <li class=\"dropdown\">
\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"> <span class=\"text-info\"><i class=\"fa fa-plus-circle\"></i> </span> Registrar <span class=\"caret\"></span></a>
\t<ul class=\"dropdown-menu\" role=\"menu\">
\t    <li ";
        // line 92
        if (((isset($context["_EXPL_ALLOW_CREATE"]) ? $context["_EXPL_ALLOW_CREATE"] : $this->getContext($context, "_EXPL_ALLOW_CREATE")) == false)) {
            echo " class=\"disabled link-full-disabled\" ";
        }
        echo ">
\t\t<a href=\"javascript:void(0)\" id=\"nuevaProyeccionBtn\" ";
        // line 94
        echo "\t\t    ";
        if (((isset($context["_EXPL_ALLOW_CREATE"]) ? $context["_EXPL_ALLOW_CREATE"] : $this->getContext($context, "_EXPL_ALLOW_CREATE")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo "> <span class=\"glyphicon glyphicon-cog \"></span> Nueva proyección
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li ";
        // line 98
        if (((isset($context["_EXPLRZ_ALLOW_CREATE"]) ? $context["_EXPLRZ_ALLOW_CREATE"] : $this->getContext($context, "_EXPLRZ_ALLOW_CREATE")) == false)) {
            echo " class=\"disabled link-full-disabled\" ";
        }
        echo ">
\t\t<a href=\"javascript:void(0)\" id=\"navbar_btn_crearExplEnLocal\" ";
        // line 100
        echo "\t\t    ";
        if (((isset($context["_EXPLRZ_ALLOW_CREATE"]) ? $context["_EXPLRZ_ALLOW_CREATE"] : $this->getContext($context, "_EXPLRZ_ALLOW_CREATE")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo "> <span class=\"glyphicon glyphicon-home \"></span> Agregar a catálogo
\t\t</a>
\t    </li>
\t</ul>
    </li>
";
    }

    // line 107
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 109
        echo "    ";
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    ";
        // line 111
        if (((isset($context["_EXPL_ALLOW_LIST"]) ? $context["_EXPL_ALLOW_LIST"] : $this->getContext($context, "_EXPL_ALLOW_LIST")) == true)) {
            // line 112
            echo "        <!-- toolbar for table-lista-proyecciones -->
        ";
            // line 113
            $context["code_entity"] = "expl";
            // line 114
            echo "        <div id=\"bs_";
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
            // line 117
            echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
            // line 119
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
            // line 124
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
            // line 127
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
            // line 130
            echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
            echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
            echo ">
                    <i class=\"glyphicon glyphicon-trash\"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_add_pry_locallist\" class=\"btn btn-element-v2 btn_add_pry_locallist\" title=\"Agregar a lista local\" style=\"margin-left: 15px\" disabled=\"disabled\">
                    <i class=\"glyphicon glyphicon-list-alt \"></i>
                </button>
                <!-- END --| custom buttons for toolbar -->
            ";
            // line 142
            echo "
        </div> <!-- END --| toolbar for table-lista-proyecciones -->
        
\t<div id=\"div-resultado-proyecciones\" class=\"menu-listas-proyecciones\" data-refresh-url=\"";
            // line 145
            echo $this->env->getExtension('routing')->getPath("simagd_proyeccion_listarProyecciones");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-proyecciones\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"expl_id\"
\t\t  data-url=\"";
            // line 149
            echo $this->env->getExtension('routing')->getPath("simagd_proyeccion_listarProyecciones");
            echo "\"
                  data-backup-url=\"simagd_proyeccion_listarProyecciones\"
                  data-toolbar=\"#bs_expl_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaProyeccionesToolbar\"
\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 159
            echo "]\"
\t\t  ";
            // line 162
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 167
            echo "\t\t\t<th data-field=\"expl_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"expl_nombre\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"expl_id\" data-filter-bstable-type=\"select2\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Nombre</th>
\t\t\t<th data-field=\"expl_codigo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Código</th>
\t\t\t<th data-field=\"expl_tiempoMedico\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tiempo de médico (min)</th>
\t\t\t<th data-field=\"expl_tiempoOcupacionSala\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tiempo ocupado en sala (min)</th>
\t\t\t<th data-field=\"expl_fechaHoraReg\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Registrada</th>
\t\t\t<th data-field=\"expl_fechaHoraMod\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Editada</th>
\t\t\t<th data-field=\"exm_descripcion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"exm_id\" data-filter-bstable-type=\"select2\" class=\"col-md-3\" data-formatter=\"simagdDescriptionFormatter\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Examen</th>
\t\t\t<th data-field=\"exm_imgCodigo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Código</th>
\t\t\t<th data-field=\"exm_sexo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"sex_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Aplica al sexo</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionFormatter\" data-events=\"actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                        <th data-field=\"expl_chk\" data-checkbox=\"true\" data-formatter=\"__pryX_selectableRowFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 184
        echo "
    ";
        // line 185
        if (((isset($context["_EXPLRZ_ALLOW_LIST"]) ? $context["_EXPLRZ_ALLOW_LIST"] : $this->getContext($context, "_EXPLRZ_ALLOW_LIST")) == true)) {
            // line 186
            echo "        <!-- toolbar for table-lista-proyecciones-locales -->
        ";
            // line 187
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "explrz")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 188
            echo "        <!-- END --| toolbar for table-lista-proyecciones-locales -->
        
\t<div id=\"div-resultado-proyecciones-locales\" style=\"display: none;\" class=\"menu-listas-proyecciones\" data-refresh-url=\"";
            // line 190
            echo $this->env->getExtension('routing')->getPath("simagd_proyeccion_establecimiento_listarProyeccionesLocales");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-proyecciones-locales\"
\t\t  data-toggle=\"table\"
\t\t  data-id-field=\"explrz_id\"
\t\t  data-url=\"\"
                  data-backup-url=\"simagd_proyeccion_establecimiento_listarProyeccionesLocales\"
                  data-toolbar=\"#bs_explrz_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaProyeccionesLocalesToolbar\"
\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 204
            echo "]\"
\t\t  ";
            // line 207
            echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 212
            echo "\t\t\t<th data-field=\"explrz_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"expl_nombre\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"expl_id\" data-filter-bstable-type=\"select2\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Nombre</th>
\t\t\t<th data-field=\"expl_codigo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Código</th>
\t\t\t<th data-field=\"explrz_fechaHoraReg\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Agregada</th>
\t\t\t<th data-field=\"explrz_fechaHoraMod\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Editada</th>
\t\t\t<th data-field=\"explrz_nombreUserReg\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Agregó</th>
\t\t\t<th data-field=\"explrz_habilitado\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"boolean\" ";
            // line 218
            if ((((isset($context["_EXPLRZ_ALLOW_CREATE"]) ? $context["_EXPLRZ_ALLOW_CREATE"] : $this->getContext($context, "_EXPLRZ_ALLOW_CREATE")) == false) && ((isset($context["_EXPLRZ_ALLOW_EDIT"]) ? $context["_EXPLRZ_ALLOW_EDIT"] : $this->getContext($context, "_EXPLRZ_ALLOW_EDIT")) == false))) {
                echo " data-formatter=\"habilitadaFormatter\" ";
            }
            echo " data-filter-bstable-data-source=\"getProyeccionHabilitadaSourceData\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Habilitada</th>
\t\t\t<th data-field=\"expl_fechaHoraReg\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Registrada</th>
\t\t\t<th data-field=\"m_nombrearea\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"m_imgCodigo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Código</th>
\t\t\t<th data-field=\"exm_descripcion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"exm_id\" data-filter-bstable-type=\"select2\" class=\"col-md-3\" data-formatter=\"simagdDescriptionFormatter\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Examen</th>
\t\t\t<th data-field=\"exm_imgCodigo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Código</th>
\t\t\t<th data-field=\"exm_sexo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"sex_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Aplica al sexo</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionLocalesFormatter\" data-events=\"actionLocalesEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 231
        echo "
    ";
        // line 233
        echo "\t";
        if ((((isset($context["_EXPL_ALLOW_CREATE"]) ? $context["_EXPL_ALLOW_CREATE"] : $this->getContext($context, "_EXPL_ALLOW_CREATE")) == true) || ((isset($context["_EXPL_ALLOW_EDIT"]) ? $context["_EXPL_ALLOW_EDIT"] : $this->getContext($context, "_EXPL_ALLOW_EDIT")) == true))) {
            // line 234
            echo "\t    ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_crearProyeccion_modal.html.twig")->display(array_merge($context, array("modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "examenes" => (isset($context["examenes"]) ? $context["examenes"] : $this->getContext($context, "examenes")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "default_exmRx" => (isset($context["default_exmRx"]) ? $context["default_exmRx"] : $this->getContext($context, "default_exmRx")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 236
            echo "\t";
        }
        // line 237
        echo "    ";
        // line 238
        echo "\t";
        if (((isset($context["_EXPLRZ_ALLOW_CREATE"]) ? $context["_EXPLRZ_ALLOW_CREATE"] : $this->getContext($context, "_EXPLRZ_ALLOW_CREATE")) == true)) {
            // line 239
            echo "\t    ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_agregarEnCatalogoLocal_modal.html.twig")->display(array_merge($context, array("modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 240
            echo "\t";
        }
        // line 241
        echo "    ";
        // line 242
        echo "\t";
        if ((((isset($context["_EXPLRZ_ALLOW_CREATE"]) ? $context["_EXPLRZ_ALLOW_CREATE"] : $this->getContext($context, "_EXPLRZ_ALLOW_CREATE")) == true) || ((isset($context["_EXPLRZ_ALLOW_EDIT"]) ? $context["_EXPLRZ_ALLOW_EDIT"] : $this->getContext($context, "_EXPLRZ_ALLOW_EDIT")) == true))) {
            // line 243
            echo "\t    ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlProyeccionEstablecimientoAdmin:explrz_crearProyeccionLocal_modal.html.twig")->display(array_merge($context, array("modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "examenes" => (isset($context["examenes"]) ? $context["examenes"] : $this->getContext($context, "examenes")), "proyecciones" => (isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "default_exmRx" => (isset($context["default_exmRx"]) ? $context["default_exmRx"] : $this->getContext($context, "default_exmRx")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 245
            echo "\t";
        }
        // line 246
        echo "    
    <!-- form for add rows to local list -->
    ";
        // line 248
        if ((((isset($context["_EXPL_ALLOW_CREATE"]) ? $context["_EXPL_ALLOW_CREATE"] : $this->getContext($context, "_EXPL_ALLOW_CREATE")) == true) && (((isset($context["_EXPLRZ_ALLOW_CREATE"]) ? $context["_EXPLRZ_ALLOW_CREATE"] : $this->getContext($context, "_EXPLRZ_ALLOW_CREATE")) == true) || ((isset($context["_EXPLRZ_ALLOW_EDIT"]) ? $context["_EXPLRZ_ALLOW_EDIT"] : $this->getContext($context, "_EXPLRZ_ALLOW_EDIT")) == true)))) {
            // line 249
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_agregarElementosListaLocal_modal.html.twig")->display(array_merge($context, array("modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "examenes" => (isset($context["examenes"]) ? $context["examenes"] : $this->getContext($context, "examenes")), "proyecciones" => (isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "default_exmRx" => (isset($context["default_exmRx"]) ? $context["default_exmRx"] : $this->getContext($context, "default_exmRx")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 251
            echo "    ";
        }
        // line 252
        echo "    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  503 => 252,  500 => 251,  492 => 249,  490 => 248,  486 => 246,  483 => 245,  475 => 243,  472 => 242,  470 => 241,  467 => 240,  459 => 239,  456 => 238,  454 => 237,  451 => 236,  443 => 234,  440 => 233,  437 => 231,  419 => 218,  411 => 212,  405 => 207,  402 => 204,  385 => 190,  381 => 188,  374 => 187,  371 => 186,  369 => 185,  366 => 184,  347 => 167,  341 => 162,  338 => 159,  325 => 149,  318 => 145,  313 => 142,  298 => 130,  291 => 127,  285 => 124,  277 => 119,  273 => 117,  267 => 114,  265 => 113,  262 => 112,  260 => 111,  254 => 109,  251 => 107,  238 => 100,  232 => 98,  222 => 94,  216 => 92,  211 => 89,  208 => 88,  197 => 82,  190 => 80,  181 => 76,  173 => 74,  170 => 73,  165 => 69,  162 => 68,  158 => 65,  152 => 63,  149 => 62,  141 => 58,  137 => 56,  133 => 55,  128 => 54,  123 => 51,  118 => 50,  113 => 47,  108 => 46,  106 => 45,  96 => 41,  87 => 39,  70 => 26,  67 => 25,  59 => 21,  53 => 18,  50 => 17,  45 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
