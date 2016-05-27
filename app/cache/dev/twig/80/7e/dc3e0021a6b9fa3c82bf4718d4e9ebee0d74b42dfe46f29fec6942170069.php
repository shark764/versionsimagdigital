<?php

/* MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_list_v2.html.twig */
class __TwigTemplate_807edc3e0021a6b9fa3c82bf4718d4e9ebee0d74b42dfe46f29fec6942170069 extends Twig_Template
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
        $context["_PACS_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PACS_ESTABLECIMIENTO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_PACS_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PACS_ESTABLECIMIENTO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_PACS_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PACS_ESTABLECIMIENTO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        $context["_PACS_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PACS_ESTABLECIMIENTO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
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
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap3-editable/css/bootstrap-editable.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />

";
    }

    // line 19
    public function block_javascripts($context, array $blocks = array())
    {
        // line 20
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         * 
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-conexiones-pacs';
        
\tvar \$pacs_is_granted_changeStatus;
\t
\t\$pacs_is_granted_changeStatus\t= ";
        // line 32
        if ((((isset($context["_PACS_ALLOW_CREATE"]) ? $context["_PACS_ALLOW_CREATE"] : $this->getContext($context, "_PACS_ALLOW_CREATE")) == true) || ((isset($context["_PACS_ALLOW_EDIT"]) ? $context["_PACS_ALLOW_EDIT"] : $this->getContext($context, "_PACS_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
    </script>

    ";
        // line 36
        echo "    ";
        // line 37
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd-label-bootstrap-table-editable.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap3-editable/js/bootstrap-editable.min.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 41
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlPacsEstablecimientoAdmin/pacs_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 45
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 46
        echo "    <i class=\"fa fa-link\"></i> <i class=\"fa fa-refresh\"></i> <i class=\"fa fa-tasks\"></i> Conexiones a servidores PACS
";
    }

    // line 49
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 50
        echo "    <li class=\"list-table-link-navbar active ";
        if (((isset($context["_PACS_ALLOW_LIST"]) ? $context["_PACS_ALLOW_LIST"] : $this->getContext($context, "_PACS_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-pacs-establecimiento-list\" data-divtabletarget=\"div-resultado-pacs-establecimiento\"
\t    ";
        // line 52
        if (((isset($context["_PACS_ALLOW_LIST"]) ? $context["_PACS_ALLOW_LIST"] : $this->getContext($context, "_PACS_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-refresh\"></i> <i class=\"fa fa-tasks\"></i> </span> Conexiones <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
";
    }

    // line 58
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 59
        echo "    <li class=\"dropdown\">
\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"> <span class=\"text-info\"><i class=\"fa fa-plus-circle\"></i> <i class=\"fa fa-tasks\"></i> </span> Registrar <span class=\"caret\"></span></a>
\t<ul class=\"dropdown-menu\" role=\"menu\">
\t    <li ";
        // line 62
        if (((isset($context["_PACS_ALLOW_CREATE"]) ? $context["_PACS_ALLOW_CREATE"] : $this->getContext($context, "_PACS_ALLOW_CREATE")) == false)) {
            echo " class=\"disabled link-full-disabled\" ";
        }
        echo ">
\t\t<a href=\"";
        // line 63
        if (((isset($context["_PACS_ALLOW_CREATE"]) ? $context["_PACS_ALLOW_CREATE"] : $this->getContext($context, "_PACS_ALLOW_CREATE")) == true)) {
            echo " ";
            echo $this->env->getExtension('routing')->getPath("simagd_pacs_create");
            echo " ";
        } else {
            echo " javascript:void(0) ";
        }
        echo "\" id=\"nuevoServidorPacsBtn\" target=\"_blank\"
\t\t    ";
        // line 64
        if (((isset($context["_PACS_ALLOW_CREATE"]) ? $context["_PACS_ALLOW_CREATE"] : $this->getContext($context, "_PACS_ALLOW_CREATE")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo "> <span class=\"glyphicon glyphicon-cog \"></span> Nueva conexión
\t\t</a>
\t    </li>
\t</ul>
    </li>
";
    }

    // line 71
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 72
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    ";
        // line 74
        if (((isset($context["_PACS_ALLOW_LIST"]) ? $context["_PACS_ALLOW_LIST"] : $this->getContext($context, "_PACS_ALLOW_LIST")) == true)) {
            // line 75
            echo "        <!-- toolbar for table-lista-pacs-establecimiento -->
        ";
            // line 76
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "pacs")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 77
            echo "        <!-- END --| toolbar for table-lista-pacs-establecimiento -->
        
\t<div id=\"div-resultado-pacs-establecimiento\" class=\"menu-listas-conexiones-pacs\" data-refresh-url=\"";
            // line 79
            echo $this->env->getExtension('routing')->getPath("simagd_pacs_listarPacsEstablecimiento");
            echo "\">
\t    <table class=\"table table-condensed\" id=\"table-lista-pacs-establecimiento\"
\t\t    data-toggle=\"table\"
\t\t    data-id-field=\"pacs_id\"
\t\t    data-url=\"";
            // line 83
            if ((((isset($context["_PACS_ALLOW_CREATE"]) ? $context["_PACS_ALLOW_CREATE"] : $this->getContext($context, "_PACS_ALLOW_CREATE")) == false) && ((isset($context["_PACS_ALLOW_EDIT"]) ? $context["_PACS_ALLOW_EDIT"] : $this->getContext($context, "_PACS_ALLOW_EDIT")) == false))) {
                echo $this->env->getExtension('routing')->getPath("simagd_pacs_listarPacsEstablecimiento");
            }
            echo "\"
\t\t    data-backup-url=\"simagd_pacs_listarPacsEstablecimiento\"
\t\t    data-toolbar=\"#bs_pacs_toolbar\"
\t\t    data-cache=\"false\"
\t\t    data-show-refresh=\"true\"
\t\t    data-show-toggle=\"true\"
\t\t    data-show-columns=\"true\"
\t\t    data-search=\"true\"
\t\t    data-select-item-name=\"listaPacsEstablecimientoToolbar\"
\t\t    data-pagination=\"true\"
\t\t    data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
            // line 93
            echo "]\"
\t\t    ";
            // line 96
            echo "\t\t    data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t    data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t\t";
            // line 101
            echo "\t\t\t<th data-field=\"pacs_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"pacs_establecimiento\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdpacs_id\" data-filter-bstable-type=\"select2\" data-switchable=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Establecimiento</th>
\t\t\t<th data-field=\"pacs_nombreConexion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Conexión</th>
\t\t\t<th data-field=\"pacs_ip\" class=\"col-md-1\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Dirección IP</th>
\t\t\t<th data-field=\"pacs_host\" data-visible=\"false\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Host</th>
\t\t\t<th data-field=\"pacs_duracionEstudio\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" data-visible=\"false\" data-formatter=\"duracionEstudioFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Duración de Estudios</th>
\t\t\t<th data-field=\"pacs_nombreBaseDatos\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Nombre de BD</th>
\t\t\t<th data-field=\"pacs_habilitado\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"boolean\" ";
            // line 108
            if ((((isset($context["_PACS_ALLOW_CREATE"]) ? $context["_PACS_ALLOW_CREATE"] : $this->getContext($context, "_PACS_ALLOW_CREATE")) == false) && ((isset($context["_PACS_ALLOW_EDIT"]) ? $context["_PACS_ALLOW_EDIT"] : $this->getContext($context, "_PACS_ALLOW_EDIT")) == false))) {
                echo " data-formatter=\"habilitadoFormatter\" ";
            }
            echo " class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Habilitado</th>
\t\t\t<th data-field=\"mtrBd_nombre\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"mtrBd_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Gestor de BD</th>
\t\t\t<th data-field=\"pacs_usuario\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Usuario de BD</th>
\t\t\t<th data-field=\"pacs_puerto\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Puerto</th>
\t\t\t<th data-field=\"pacs_fechaHoraReg\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Registrado</th>
\t\t\t<th data-field=\"pacs_fechaHoraMod\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Editado</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionFormatter\" data-events=\"actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
\t</div>
    ";
        }
        // line 120
        echo "
    ";
        // line 121
        if (((isset($context["_PACS_ALLOW_VIEW"]) ? $context["_PACS_ALLOW_VIEW"] : $this->getContext($context, "_PACS_ALLOW_VIEW")) == true)) {
            // line 122
            echo "        ";
            echo "    ";
            // line 123
            echo "    ";
        }
        // line 124
        echo "    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  265 => 124,  262 => 123,  259 => 122,  257 => 121,  254 => 120,  237 => 108,  228 => 101,  222 => 96,  219 => 93,  204 => 83,  197 => 79,  193 => 77,  186 => 76,  183 => 75,  181 => 74,  176 => 72,  173 => 71,  161 => 64,  151 => 63,  145 => 62,  140 => 59,  137 => 58,  126 => 52,  118 => 50,  115 => 49,  110 => 46,  107 => 45,  99 => 41,  94 => 38,  89 => 37,  87 => 36,  77 => 32,  61 => 20,  58 => 19,  50 => 15,  44 => 12,  41 => 11,  36 => 9,  34 => 8,  32 => 7,  30 => 6,);
    }
}
