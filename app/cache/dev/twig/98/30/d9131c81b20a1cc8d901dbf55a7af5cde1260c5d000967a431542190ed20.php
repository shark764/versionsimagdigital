<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_show_v2.html.twig */
class __TwigTemplate_9830d9131c81b20a1cc8d901dbf55a7af5cde1260c5d000967a431542190ed20 extends Twig_Template
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
\tvar \$is_tcnlX;
\t
\t\$is_tcnlX\t\t= ";
        // line 25
        if ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$is_tcnlX);
    </script>
    
    <script type=\"text/javascript\" src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioComplementarioAdmin/solcmpl_show_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 34
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 37
    public function block_tab_menu($context, array $blocks = array())
    {
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
    }

    // line 39
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 40
        echo "    <i class=\"fa fa-user-md\"></i> <i class=\"fa fa-microphone\"></i> <i class=\"fa fa-external-link\"></i> <i class=\"fa fa-reply-all\"></i> Solicitud ha sido guardada
";
    }

    // line 43
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 44
        echo "    <li class=\"list-table-link-navbar ";
        if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a title=\"Regresar a edición de formulario\" target=\"_self\" class=\"\"
\t    href=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
        echo "\" autofocus>
\t    <span class=\"text-info\"> <i class=\"fa fa-wheelchair\"></i> <i class=\"fa fa-user-md\"></i> <i class=\"fa fa-microphone\"></i> </span> Solicitudes de estudio complementario <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
";
    }

    // line 52
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
    }

    // line 55
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 56
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    ";
        // line 58
        $context["studyPdr"] = $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idEstudioPadre");
        // line 59
        echo "    ";
        $context["expediente"] = $this->getAttribute((isset($context["studyPdr"]) ? $context["studyPdr"] : $this->getContext($context, "studyPdr")), "idExpediente");
        // line 60
        echo "    ";
        $context["prc_solicitud"] = $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idSolicitudEstudio");
        // line 61
        echo "    
    ";
        // line 62
        $context["item_listaPndR"] = null;
        // line 63
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "complementarioExamenPendienteRealizar"));
        foreach ($context['_seq'] as $context["_key"] => $context["noRealizado"]) {
            if ((null === $this->getAttribute((isset($context["noRealizado"]) ? $context["noRealizado"] : $this->getContext($context, "noRealizado")), "getIdProcedimientoIniciado", array(), "method"))) {
                // line 64
                echo "\t";
                $context["item_listaPndR"] = (isset($context["noRealizado"]) ? $context["noRealizado"] : $this->getContext($context, "noRealizado"));
                // line 65
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['noRealizado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "    
    <div class=\"anexo-nueva-solicitud\">

        <div class=\"box box-danger\">
            <div class=\"box-header\">
                <h3 class=\"box-title\">Solicitar nuevo estudio a partir de estudio padre</h3>
            </div>
            <div class=\"box-body\">
\t\t<table class=\"table table-hover table-condensed table-responsive table-borderless\">
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 77
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "id"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Nombre:</span></th>
\t\t\t<td class=\"col-md-3\">";
        // line 81
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">N° de Registro:</span></th>
\t\t\t<td class=\"col-md-3\"><span class=\"badge\">";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "numero"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Procedencia:</span></th>
\t\t\t<td class=\"col-md-3\">";
        // line 87
        echo twig_escape_filter($this->env, (((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud"))) ? ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud")), "idAtenAreaModEstab"), "idAreaModEstab"), "idAreaAtencion")) : ("No especificado...")), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Servicio clínico:</span></th>
\t\t\t<td class=\"col-md-3\">";
        // line 89
        echo twig_escape_filter($this->env, (((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud"))) ? ($this->getAttribute($this->getAttribute((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud")), "idAtenAreaModEstab"), "idAtencion")) : ("No especificado...")), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicitado por:</span></th>
\t\t\t<td class=\"col-md-3\">";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idRadiologoSolicita"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Se registró:</span></th>
\t\t\t<td class=\"col-md-3\">";
        // line 95
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "fechaSolicitud"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "fechaSolicitud"), "H:i:s A")), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Justificación:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><pre class=\"pre-display-code-natural\">";
        // line 99
        echo _twig_default_filter(trim($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "justificacion")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
        echo "</pre></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Indicaciones del radiólogo:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><pre class=\"pre-display-code-no-natural\">";
        // line 103
        echo _twig_default_filter(trim($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "indicacionesEstudio")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
        echo "</pre></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicitado a:</span></th>
\t\t\t<td class=\"col-md-3\">";
        // line 107
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idEstablecimientoSolicitado"), "html", null, true);
        echo " ";
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento"), "getId", array(), "method") == $this->getAttribute($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idEstablecimientoSolicitado"), "getId", array(), "method"))) {
            echo " <span class=\"label label-element-v2\" style=\"\">[Servicio local]</span> ";
        }
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Prioridad requerida:</span></th>
\t\t\t<td class=\"col-md-3\"><span class=\"label label-";
        // line 109
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : null), "idPrioridadAtencion", array(), "any", false, true), "estiloPresentacion", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : null), "idPrioridadAtencion", array(), "any", false, true), "estiloPresentacion"), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idPrioridadAtencion"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Modalidad:</span></th>
\t\t\t<td class=\"col-md-3\">";
        // line 113
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idAreaServicioDiagnostico"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Complementa estudio de:</span></th>
\t\t\t<td class=\"col-md-3\">";
        // line 115
        echo twig_escape_filter($this->env, (((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud"))) ? ($this->getAttribute((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud")), "idAreaServicioDiagnostico")) : ("No especificado...")), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Proyecciones:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
\t\t\t    ";
        // line 120
        $context["examenesLoop"] = array();
        // line 121
        echo "\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "solicitudEstudioComplementarioProyeccion"));
        foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
            // line 122
            echo "\t\t\t\t";
            $context["i"] = ("_" . $this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id"));
            // line 123
            echo "\t\t\t\t
\t\t\t\t";
            // line 124
            if (!twig_in_filter((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), twig_get_array_keys_filter((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop"))))) {
                // line 125
                echo "\t\t\t\t    ";
                $context["examenesLoop"] = twig_array_merge((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop")), array((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) => $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico")));
                // line 126
                echo "\t\t\t\t";
            }
            // line 127
            echo "\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        echo "\t\t\t    
\t\t\t    <div class=\"panel-group\" id=\"exm_containerGroup\">
\t\t\t\t";
        // line 130
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop")));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 131
            echo "\t\t\t\t    
\t\t\t\t    ";
            // line 132
            $context["exm_proyeccionCount"] = 0;
            // line 133
            echo "\t\t\t\t    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "solicitudEstudioComplementarioProyeccion"));
            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                if (($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == trim((isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "_"))) {
                    // line 134
                    echo "\t\t\t\t\t";
                    $context["exm_proyeccionCount"] = ((isset($context["exm_proyeccionCount"]) ? $context["exm_proyeccionCount"] : $this->getContext($context, "exm_proyeccionCount")) + 1);
                    // line 135
                    echo "\t\t\t\t    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 136
            echo "\t\t\t\t    
\t\t\t\t    <div class=\"panel panel-primary-v2\">
\t\t\t\t\t<a class=\"list-group-item btn-link btn-link-v2\" data-toggle=\"collapse\" href=\"#solcmpl_proyecciones_panelCollapse_id_";
            // line 138
            echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "html", null, true);
            echo "\">
\t\t\t\t\t    <span class=\"badge\">";
            // line 139
            echo twig_escape_filter($this->env, (isset($context["exm_proyeccionCount"]) ? $context["exm_proyeccionCount"] : $this->getContext($context, "exm_proyeccionCount")), "html", null, true);
            echo "</span>
\t\t\t\t\t    ";
            // line 140
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "
\t\t\t\t\t</a>
\t\t\t\t\t<div class=\"panel-collapse collapse\" id=\"solcmpl_proyecciones_panelCollapse_id_";
            // line 142
            echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "html", null, true);
            echo "\">
\t\t\t\t\t    <div class=\"panel-body\">
\t\t\t\t\t\t";
            // line 144
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "solicitudEstudioComplementarioProyeccion"));
            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                if (($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == trim((isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "_"))) {
                    // line 145
                    echo "\t\t\t\t\t\t    <a  tabindex=\"0\"
\t\t\t\t\t\t\tclass=\"list-group-item btn-link btn-link-v2\"
\t\t\t\t\t\t\trole=\"button\"
\t\t\t\t\t\t\tdata-toggle=\"popover\"
\t\t\t\t\t\t\trel=\"popover\"
\t\t\t\t\t\t\tdata-trigger=\"hover\"
\t\t\t\t\t\t\ttitle=\"";
                    // line 151
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-original-title=\"";
                    // line 152
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-contentwrapper=\".solcmpl_history_container_contentwrapper_id_";
                    // line 153
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\tdata-placement=\"top\"
\t\t\t\t\t\t\thref=\"javascript:void(0)\"
\t\t\t\t\t\t\tdata-id=\"";
                    // line 156
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\" >
\t\t\t\t\t\t\t<span class=\"badge\">";
                    // line 157
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "codigo"), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t";
                    // line 159
                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                    echo "
\t\t\t\t\t\t    </a>

\t\t\t\t\t\t    <div class=\"solcmpl_history_container_contentwrapper_id_";
                    // line 162
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                    echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
                                                        <table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
                                                            <tr><th class=\"col-md-5\">Código:</th><td class=\"col-md-7\">";
                    // line 164
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "codigo"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Tiempo en sala:</th><td class=\"col-md-7\">";
                    // line 165
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoOcupacionSala"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Tiempo por médico:</th><td class=\"col-md-7\">";
                    // line 166
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoMedico"), "html", null, true);
                    echo "</td></tr>
                                                            <tr><th class=\"col-md-5\">Descripción:</th><td class=\"col-md-7\"><pre class=\"pre-display-code-natural\">";
                    // line 167
                    echo _twig_default_filter(trim($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "descripcion")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
                    echo "</pre></td></tr>
                                                        </table>
\t\t\t\t\t\t    </div>
\t\t\t\t\t\t";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 171
            echo "\t\t\t\t\t    </div>
\t\t\t\t\t</div>
\t\t\t\t    </div>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 175
        echo "\t\t\t    </div>
\t\t\t</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3\"></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\">
\t\t\t    <div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
\t\t\t\t<div class=\"btn-group\" role=\"group\">
                                    <a title=\"Recuperar estudio de Servidor PACS\" target=\"_blank\" class=\"btn btn-primary-v2 btn-sm\"
                                        href=\"";
        // line 184
        echo twig_escape_filter($this->env, (((isset($context["studyPdr"]) ? $context["studyPdr"] : $this->getContext($context, "studyPdr"))) ? (_twig_default_filter(trim($this->getAttribute((isset($context["studyPdr"]) ? $context["studyPdr"] : $this->getContext($context, "studyPdr")), "url")), "javascript:void(0)")) : ("javascript:void(0)")), "html", null, true);
        echo "\"
                                        ";
        // line 185
        if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            // line 186
            echo "                                            disabled=\"disabled\"
                                        ";
        }
        // line 187
        echo ">
                                        <i class=\"glyphicon glyphicon-eye-open\"></i>
                                        Descargar</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"btn-group\" role=\"group\">
                                    <a title=\"Solicitar estudio complementario\" target=\"_blank\" class=\"btn btn-primary-v2 btn-sm ml10\"
                                        href=\"";
        // line 193
        echo twig_escape_filter($this->env, (((isset($context["studyPdr"]) ? $context["studyPdr"] : $this->getContext($context, "studyPdr"))) ? ($this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_complementario_create", array("__prc" => (((!(null === (isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud"))))) ? ($this->getAttribute((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud")), "id")) : (null)), "__est" => (((isset($context["studyPdr"]) ? $context["studyPdr"] : $this->getContext($context, "studyPdr"))) ? ($this->getAttribute((isset($context["studyPdr"]) ? $context["studyPdr"] : $this->getContext($context, "studyPdr")), "id")) : (null))))) : ("javascript:void(0)")), "html", null, true);
        // line 194
        echo "\"
                                        ";
        // line 195
        if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (!(null === $this->getAttribute((isset($context["studyPdr"]) ? $context["studyPdr"] : $this->getContext($context, "studyPdr")), "idEstudioPadre"))))) {
            // line 197
            echo "\t\t\t\t\t    disabled=\"disabled\"
\t\t\t\t\t";
        }
        // line 198
        echo ">
\t\t\t\t\t<i class=\"glyphicon glyphicon-random\"></i>
                                        Complementar</a>
\t\t\t\t</div>
\t\t\t    </div>
\t\t\t</td>
\t\t    </tr>
\t\t    
\t\t</table>
            </div>
        </div>

        <div class=\"box box-danger\">
            <div class=\"box-body\">
                ¿Desea agregar nueva solicitud de estudio complementario para estudio padre con estos datos?
            </div>
            <div class=\"box-footer clearfix\">
\t\t<div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t<a title=\"Regresar a edición de formulario\" target=\"_self\" class=\"btn btn-primary-v2 btn-sm \"
\t\t\t    href=\"";
        // line 218
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "edit", 1 => (isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud"))), "method"), "html", null, true);
        echo "\" autofocus>
\t\t\t    <i class=\"fa fa-times\"></i>
\t\t\t    No, Regresar</a>
\t\t    </div>
\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t<a title=\"Registrar examen complementario\" target=\"_self\" class=\"btn btn-element-v2 btn-sm \"
\t\t\t    href=\"";
        // line 224
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("simagd_realizado_create", array("__prc" => (((!(null === (isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud"))))) ? ($this->getAttribute((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud")), "id")) : (null)), "__cmpl" => $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "id"), "__pndR" => (((!(null === (isset($context["item_listaPndR"]) ? $context["item_listaPndR"] : $this->getContext($context, "item_listaPndR"))))) ? ($this->getAttribute((isset($context["item_listaPndR"]) ? $context["item_listaPndR"] : $this->getContext($context, "item_listaPndR")), "id")) : (null)))), "html", null, true);
        // line 228
        echo "\"
\t\t\t    ";
        // line 229
        if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (null === (isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente"))))) {
            // line 230
            echo "\t\t\t\tdisabled=\"disabled\"
\t\t\t    ";
        }
        // line 231
        echo ">
\t\t\t    <i class=\"fa fa-save\"></i> <i class=\"fa fa-external-link\"></i> <i class=\"fa fa-microphone\"></i>
\t\t\t    No, Examinar</a>
\t\t    </div>
\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t<a title=\"Solicitar otra modalidad\" target=\"_self\" class=\"btn btn-element-v2 btn-sm \"
\t\t\t    href=\"";
        // line 237
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_complementario_create", array("__prc" => (((!(null === (isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud"))))) ? ($this->getAttribute((isset($context["prc_solicitud"]) ? $context["prc_solicitud"] : $this->getContext($context, "prc_solicitud")), "id")) : (null)), "__est" => $this->getAttribute((isset($context["studyPdr"]) ? $context["studyPdr"] : $this->getContext($context, "studyPdr")), "id"), "__cmpl" => $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "id"))), "html", null, true);
        // line 241
        echo "\"
\t\t\t    ";
        // line 242
        if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (null === (isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente"))))) {
            // line 243
            echo "\t\t\t\tdisabled=\"disabled\"
\t\t\t    ";
        }
        // line 244
        echo ">
\t\t\t    <i class=\"fa fa-save\"></i> <i class=\"fa fa-external-link\"></i> <i class=\"fa fa-microphone\"></i>
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
        return "MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_show_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  489 => 228,  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 245,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 230,  564 => 361,  561 => 235,  456 => 198,  431 => 185,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 151,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 194,  445 => 193,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 235,  517 => 244,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 224,  622 => 204,  531 => 224,  498 => 231,  468 => 236,  458 => 204,  401 => 199,  369 => 165,  356 => 180,  340 => 146,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 195,  408 => 182,  363 => 220,  359 => 164,  348 => 149,  345 => 148,  336 => 163,  316 => 159,  307 => 129,  261 => 121,  266 => 122,  542 => 230,  538 => 228,  527 => 197,  509 => 353,  499 => 248,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 127,  223 => 121,  585 => 224,  551 => 356,  546 => 308,  506 => 237,  503 => 193,  488 => 242,  485 => 268,  478 => 218,  475 => 205,  471 => 204,  448 => 192,  386 => 169,  378 => 158,  375 => 244,  306 => 190,  291 => 121,  286 => 128,  392 => 166,  332 => 142,  318 => 134,  276 => 115,  190 => 87,  12 => 36,  195 => 89,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 243,  496 => 280,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 150,  416 => 175,  395 => 198,  391 => 247,  382 => 195,  372 => 190,  364 => 156,  353 => 175,  335 => 154,  333 => 142,  297 => 132,  292 => 123,  205 => 86,  200 => 97,  184 => 77,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 223,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 201,  463 => 208,  446 => 244,  443 => 200,  429 => 183,  425 => 195,  410 => 180,  397 => 176,  394 => 168,  389 => 177,  357 => 150,  342 => 145,  334 => 139,  330 => 137,  328 => 140,  290 => 130,  287 => 119,  263 => 125,  255 => 101,  245 => 98,  194 => 82,  76 => 54,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 229,  481 => 208,  476 => 239,  467 => 221,  451 => 213,  424 => 229,  418 => 183,  412 => 183,  399 => 177,  396 => 167,  390 => 171,  388 => 165,  383 => 200,  377 => 169,  373 => 159,  370 => 164,  367 => 155,  352 => 160,  349 => 148,  346 => 147,  329 => 155,  326 => 136,  313 => 132,  303 => 145,  300 => 208,  234 => 93,  218 => 90,  207 => 95,  178 => 81,  321 => 134,  295 => 122,  274 => 125,  242 => 95,  236 => 103,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 227,  529 => 174,  524 => 173,  516 => 143,  510 => 218,  504 => 185,  500 => 262,  490 => 211,  486 => 210,  482 => 251,  470 => 237,  464 => 180,  459 => 171,  452 => 197,  434 => 12,  421 => 184,  417 => 250,  385 => 185,  361 => 152,  344 => 157,  339 => 141,  324 => 207,  310 => 158,  302 => 127,  296 => 118,  282 => 112,  259 => 120,  244 => 104,  231 => 94,  226 => 109,  114 => 50,  104 => 47,  288 => 122,  284 => 136,  279 => 143,  275 => 107,  256 => 99,  250 => 107,  237 => 109,  232 => 92,  222 => 90,  215 => 89,  191 => 90,  153 => 79,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 224,  523 => 268,  518 => 221,  514 => 168,  511 => 242,  508 => 241,  501 => 313,  495 => 260,  491 => 255,  487 => 224,  460 => 243,  455 => 241,  449 => 239,  442 => 210,  439 => 209,  436 => 132,  433 => 186,  426 => 126,  420 => 186,  415 => 182,  411 => 202,  405 => 203,  403 => 117,  400 => 182,  380 => 245,  366 => 152,  354 => 152,  331 => 138,  325 => 94,  320 => 144,  317 => 131,  311 => 127,  308 => 135,  304 => 125,  272 => 124,  267 => 169,  249 => 97,  216 => 87,  155 => 57,  152 => 63,  146 => 71,  126 => 56,  181 => 83,  161 => 75,  110 => 40,  188 => 77,  186 => 89,  170 => 71,  150 => 55,  124 => 56,  358 => 153,  351 => 135,  347 => 150,  343 => 146,  338 => 158,  327 => 140,  323 => 139,  319 => 138,  315 => 136,  301 => 181,  299 => 133,  293 => 117,  289 => 176,  281 => 109,  277 => 126,  271 => 106,  265 => 104,  262 => 134,  260 => 101,  257 => 121,  251 => 115,  248 => 99,  239 => 104,  228 => 107,  225 => 92,  213 => 102,  211 => 88,  197 => 91,  174 => 98,  148 => 64,  134 => 60,  127 => 49,  20 => 2,  53 => 22,  270 => 108,  253 => 107,  233 => 76,  212 => 86,  210 => 86,  206 => 97,  202 => 93,  198 => 84,  192 => 90,  185 => 64,  180 => 75,  175 => 70,  172 => 70,  167 => 67,  165 => 77,  160 => 83,  137 => 61,  113 => 41,  100 => 45,  90 => 29,  81 => 36,  129 => 58,  84 => 26,  77 => 34,  34 => 10,  118 => 45,  97 => 36,  70 => 30,  65 => 18,  58 => 25,  23 => 4,  480 => 301,  474 => 195,  469 => 150,  461 => 200,  457 => 199,  453 => 169,  444 => 236,  440 => 15,  437 => 187,  435 => 188,  430 => 172,  427 => 184,  423 => 206,  413 => 181,  409 => 195,  407 => 171,  402 => 179,  398 => 178,  393 => 112,  387 => 176,  384 => 164,  381 => 165,  379 => 162,  374 => 161,  368 => 157,  365 => 154,  362 => 141,  360 => 219,  355 => 155,  341 => 141,  337 => 144,  322 => 135,  314 => 149,  312 => 130,  309 => 126,  305 => 134,  298 => 126,  294 => 131,  285 => 110,  283 => 153,  278 => 108,  268 => 105,  264 => 111,  258 => 102,  252 => 98,  247 => 105,  241 => 97,  229 => 110,  220 => 81,  214 => 99,  177 => 74,  169 => 60,  140 => 62,  132 => 61,  128 => 56,  107 => 46,  61 => 21,  273 => 130,  269 => 123,  254 => 120,  243 => 116,  240 => 102,  238 => 96,  235 => 95,  230 => 102,  227 => 74,  224 => 108,  221 => 103,  219 => 88,  217 => 138,  208 => 87,  204 => 99,  179 => 76,  159 => 66,  143 => 67,  135 => 59,  119 => 63,  102 => 46,  71 => 22,  67 => 24,  63 => 31,  59 => 24,  38 => 15,  94 => 35,  89 => 30,  85 => 31,  75 => 35,  68 => 30,  56 => 29,  201 => 85,  196 => 81,  183 => 83,  171 => 77,  166 => 69,  163 => 68,  158 => 66,  156 => 65,  151 => 65,  142 => 63,  138 => 57,  136 => 56,  121 => 55,  117 => 62,  105 => 38,  91 => 40,  62 => 21,  49 => 20,  28 => 8,  26 => 7,  87 => 32,  31 => 9,  25 => 5,  21 => 6,  24 => 5,  19 => 2,  93 => 30,  88 => 39,  78 => 27,  46 => 19,  44 => 13,  27 => 8,  79 => 29,  72 => 27,  69 => 20,  47 => 14,  40 => 10,  37 => 11,  22 => 4,  246 => 113,  157 => 72,  145 => 60,  139 => 59,  131 => 59,  123 => 47,  120 => 46,  115 => 44,  111 => 42,  108 => 39,  101 => 36,  98 => 35,  96 => 43,  83 => 31,  74 => 23,  66 => 32,  55 => 19,  52 => 16,  50 => 15,  43 => 14,  41 => 11,  35 => 14,  32 => 9,  29 => 8,  209 => 85,  203 => 93,  199 => 82,  193 => 80,  189 => 79,  187 => 78,  182 => 76,  176 => 96,  173 => 72,  168 => 68,  164 => 81,  162 => 74,  154 => 69,  149 => 62,  147 => 72,  144 => 60,  141 => 75,  133 => 69,  130 => 46,  125 => 44,  122 => 56,  116 => 52,  112 => 45,  109 => 41,  106 => 40,  103 => 39,  99 => 44,  95 => 34,  92 => 43,  86 => 56,  82 => 37,  80 => 28,  73 => 26,  64 => 25,  60 => 19,  57 => 18,  54 => 15,  51 => 17,  48 => 21,  45 => 12,  42 => 27,  39 => 12,  36 => 10,  33 => 14,  30 => 5,);
    }
}
