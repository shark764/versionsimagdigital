<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_show_v2.html.twig */
class __TwigTemplate_94d05fef8ed165a5eedaee9e9053511fddf3a1c39f135fbe0e674111ca31b772 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_list_v2.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

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
\tvar \$is_prcAux,
\t    \$is_cit;
\t
\t\$is_prcAux\t= ";
        // line 26
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") && ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "idEmpleado"), "idTipoEmpleado"), "codigo") != "MED"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t\$is_cit\t\t= ";
        // line 27
        if ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$is_prcAux, \$is_cit);
    </script>
    
    <script type=\"text/javascript\" src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_show_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 36
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 39
    public function block_tab_menu($context, array $blocks = array())
    {
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
    }

    // line 41
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 42
        echo "    <i class=\"fa fa-wheelchair\"></i> ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idExpediente"), "getIdPaciente", array(), "method"), "html", null, true);
        echo " <span class=\"badge\" style=\" margin-left: 5px;\">";
        if ((!(null === (isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord"))))) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord")), "numero"), "html", null, true);
            echo " ";
        }
        echo "</span>
";
    }

    // line 45
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 46
        echo "    <li class=\"list-table-link-navbar ";
        if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a title=\"Regresar a listado de solicitudes\" target=\"_self\" class=\"\"
\t    href=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
        echo "\" autofocus>
\t    <span class=\"text-info\"> <i class=\"fa fa-user-md\"></i> <i class=\"fa fa-undo\"></i> </span> Solicitudes <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
";
    }

    // line 54
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
    }

    // line 57
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 58
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    ";
        // line 60
        $context["expediente"] = $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idExpediente");
        // line 61
        echo "    ";
        $context["sec_solicitud"] = $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idSolicitudestudios");
        // line 62
        echo "    
    <div class=\"show-full-entity-v2 col-lg-12 col-md-12 col-xs-12\">

        <div class=\"box box-primary-v2 container\">
\t    ";
        // line 67
        echo "            <div class=\"box-header\">
                <h3 class=\"box-title\"><span class=\"label label-primary-v2\">Consulta: Solicitud de estudio</span></h3>
            </div>
            <div class=\"box-body\">

                ";
        // line 72
        $context["object_expediente"] = $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdExpediente", array(), "method");
        // line 73
        echo "
                <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"";
        // line 74
        echo "\"> <!-- required for floating -->
                    <!-- Nav tabs -->
                    <li><a href=\"#lct_pacienteTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-user\"></span> Paciente <i class=\"fa\"></i></a></li>
                    <li class=\"active\"><a href=\"#lct_solicitudTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-book\"></span> Solicitud de estudio <i class=\"fa\"></i></a></li>
                </ul>

                <!-- Tab panes -->
                <div class=\"tab-content col-md-9 col-xs-9\" style=\"overflow-y: auto; min-height: 675px;\">
                    ";
        // line 82
        if ((!(null === $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method")))) {
            // line 83
            echo "                        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:pct_entity_block.html.twig")->display(array_merge($context, array("object_patient" => $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method"), "object_localRecord" => (isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord")), "tab_active" => false, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 84
            echo "                    ";
        }
        // line 85
        echo "                    ";
        if ((!(null === (isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud"))))) {
            // line 86
            echo "                        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:prc_entity_block.html.twig")->display(array_merge($context, array("object_request" => (isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "object_requests" => null, "tab_active" => true, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 87
            echo "                    ";
        }
        // line 88
        echo "                </div>
            </div>
        </div>
    </div>

    <div class=\"show-full-entity-v2 col-lg-6 col-md-6 col-xs-6\">
        
        <div class=\"box box-danger\">
            <div class=\"box-body\">
                ¿Desea agregar otra solicitud de estudio con estos datos?
            </div>
            <div class=\"box-footer clearfix\" style=\"";
        // line 99
        echo "\">
\t\t<div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t<a title=\"Regresar a edición de formulario\" target=\"_self\" class=\"btn btn-primary-v2 btn-sm \"
\t\t\t    href=\"";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "edit", 1 => (isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud"))), "method"), "html", null, true);
        echo "\" autofocus>
\t\t\t    <i class=\"fa fa-undo\"></i>
\t\t\t    No, Regresar</a>
\t\t    </div>
\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t<a title=\"Solicitar otra modalidad\" target=\"_self\" class=\"btn btn-element-v2 btn-sm \"
\t\t\t    href=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_create", array("__exp" => (((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente"))) ? ($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getId", array(), "method")) : (null)), "__hcl" => ((((isset($context["sec_solicitud"]) ? $context["sec_solicitud"] : $this->getContext($context, "sec_solicitud")) && (twig_upper_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sec_solicitud"]) ? $context["sec_solicitud"] : $this->getContext($context, "sec_solicitud")), "idHistorialClinico"), "piloto")) != "V"))) ? ($this->getAttribute($this->getAttribute((isset($context["sec_solicitud"]) ? $context["sec_solicitud"] : $this->getContext($context, "sec_solicitud")), "idHistorialClinico"), "getId", array(), "method")) : (null)), "__prc" => $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "id"))), "html", null, true);
        // line 112
        echo "\"
\t\t\t    ";
        // line 113
        if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (null === (isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente"))))) {
            // line 114
            echo "\t\t\t\tdisabled=\"disabled\"
\t\t\t    ";
        }
        // line 115
        echo ">
\t\t\t    <i class=\"fa fa-wheelchair\"></i>
\t\t\t    Si, Continuar</a>
\t\t    </div>
\t\t</div>
            </div>
        </div>
    </div>
    
    <div class=\"empty-layout-clear\" style=\"height:76px;\"></div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_show_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  245 => 115,  241 => 114,  239 => 113,  236 => 112,  234 => 109,  225 => 103,  219 => 99,  206 => 88,  203 => 87,  195 => 86,  192 => 85,  189 => 84,  181 => 83,  179 => 82,  169 => 74,  166 => 73,  164 => 72,  157 => 67,  151 => 62,  148 => 61,  146 => 60,  141 => 58,  138 => 57,  133 => 54,  124 => 48,  116 => 46,  113 => 45,  100 => 42,  97 => 41,  91 => 39,  86 => 36,  79 => 32,  67 => 27,  59 => 26,  49 => 20,  46 => 19,  38 => 15,  35 => 14,);
    }
}
