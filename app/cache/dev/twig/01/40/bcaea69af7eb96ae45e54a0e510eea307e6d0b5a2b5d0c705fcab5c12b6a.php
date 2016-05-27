<?php

/* MinsalSimagdBundle:ImgCitaAdmin:cit_agenda.html.twig */
class __TwigTemplate_0140bcaea69af7eb96ae45e54a0e510eea307e6d0b5a2b5d0c705fcab5c12b6a extends Twig_Template
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
        $context["_CIT_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_CIT_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_CIT_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        $context["_CIT_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 12
        $context["_PRC_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 13
        $context["_PRC_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 14
        $context["_PRC_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 15
        $context["_PRC_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 16
        $context["_PRC_EXTERNAL_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 19
        $context["_BLOQUEO_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_BLOQUEO_AGENDA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 20
        $context["_BLOQUEO_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_BLOQUEO_AGENDA_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 21
        $context["_BLOQUEO_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_BLOQUEO_AGENDA_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 22
        $context["_BLOQUEO_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_BLOQUEO_AGENDA_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 24
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 25
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    ";
        // line 28
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

    ";
        // line 31
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/fullcalendar-2.3.2/fullcalendar.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/fullcalendar-2.3.2/fullcalendar.print.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" media=\"print\" />

    ";
        // line 35
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/jquery.qtip.custom/jquery.qtip.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

    ";
        // line 38
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-colorpicker-master/dist/css/bootstrap-colorpicker.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

    ";
        // line 41
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/agenda.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    ";
        // line 43
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/colorpicker.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />

";
    }

    // line 47
    public function block_javascripts($context, array $blocks = array())
    {
        // line 48
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         *
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-vistas-agenda';

    \tvar \$selectionsPriority\t\t= [],
    \t    \$listPriority \t\t= [],
    \t    \$prc_is_granted_changePriority,
            \$cit_is_granted_assignDate;

    \t\$prc_is_granted_changePriority = ";
        // line 63
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
        \$cit_is_granted_assignDate     = ";
        // line 64
        if ((((isset($context["_CIT_ALLOW_CREATE"]) ? $context["_CIT_ALLOW_CREATE"] : $this->getContext($context, "_CIT_ALLOW_CREATE")) == true) || ((isset($context["_CIT_ALLOW_EDIT"]) ? $context["_CIT_ALLOW_EDIT"] : $this->getContext($context, "_CIT_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

        jQuery(document).ready(function() {
    \t    /** Lista de prioridades */
    \t    ";
        // line 68
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["prioridades"]) ? $context["prioridades"] : $this->getContext($context, "prioridades")));
        foreach ($context['_seq'] as $context["_key"] => $context["prioridad"]) {
            // line 69
            echo "        \t\t\$selectionsPriority.push({ id: '";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "nombre")), "html", null, true);
            echo "', text: '";
            echo twig_escape_filter($this->env, trim($this->getAttribute((isset($context["prioridad"]) ? $context["prioridad"] : $this->getContext($context, "prioridad")), "nombre")), "html", null, true);
            echo "' });
        \t\t\$listPriority.push({ id: '";
            // line 70
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
        // line 72
        echo "        });

        (function (\$) {
            /*
             * 
             * @type type
             * Global variables for plugin
             */
            window.GROUP_DEPENDENT_ENTITIES = null;   // --| build data collection
            GROUP_DEPENDENT_ENTITIES        = JSON.parse('";
        // line 81
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["GROUP_DEPENDENT_ENTITIES"]) ? $context["GROUP_DEPENDENT_ENTITIES"] : $this->getContext($context, "GROUP_DEPENDENT_ENTITIES"))), "js");
        echo "');

        }(jQuery));
    </script>

    ";
        // line 87
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 88
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/lang/summernote-es-ES.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 89
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_summernote_config.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 92
        echo "    ";
        // line 93
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd-label-bootstrap-table-editable.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 96
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/fullcalendar-2.3.2/fullcalendar.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 97
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/fullcalendar-2.3.2/lang-all.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 100
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/jquery.qtip.custom/jquery.qtip.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 101
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/jquery.qtip.custom/imagesloaded.pkg.min.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 104
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-colorpicker-master/dist/js/bootstrap-colorpicker.min.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 107
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_agenda.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 108
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_config_search.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_accionesCita.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 110
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_pendientesCita.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 111
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_listarPacientesSinCita_v2.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 113
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgBloqueoAgendaAdmin/blAgd_crearBloqueo.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgBloqueoAgendaAdmin/blAgd_listarBloqueos.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 115
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgBloqueoAgendaAdmin/blAgd_excluirRadiologos.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 116
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgBloqueoAgendaAdmin/blAgd_set_form_data.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 119
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_queued_cit_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 120
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_list_v2.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_form_config.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_set_form_data.js"), "html", null, true);
        echo "\" ></script>

    <script type=\"text/javascript\" src=\"";
        // line 124
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgEstudioPacienteAdmin/est_crear_ventana_estudio.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 128
    public function block_simagd_bs_alert($context, array $blocks = array())
    {
        // line 129
        echo "    ";
        $this->displayParentBlock("simagd_bs_alert", $context, $blocks);
        echo "

    ";
        // line 131
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_queued_cit_alert.html.twig")->display($context);
    }

    // line 134
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 135
        echo "    <i class=\"fa fa-clock-o\"></i> <i class=\"fa fa-tags\"></i> Programación
";
    }

    // line 138
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 139
        echo "    <li class=\"list-table-link-navbar active ";
        if (((isset($context["_CIT_ALLOW_CREATE"]) ? $context["_CIT_ALLOW_CREATE"] : $this->getContext($context, "_CIT_ALLOW_CREATE")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-calendar-citas-rx\" data-divtabletarget=\"div-resultado-agenda-rx\"
\t    ";
        // line 141
        if (((isset($context["_CIT_ALLOW_CREATE"]) ? $context["_CIT_ALLOW_CREATE"] : $this->getContext($context, "_CIT_ALLOW_CREATE")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-calendar\"></i> </span> Agenda <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
    <li class=\"list-table-link-navbar ";
        // line 145
        if (((isset($context["_CIT_ALLOW_LIST"]) ? $context["_CIT_ALLOW_LIST"] : $this->getContext($context, "_CIT_ALLOW_LIST")) == false)) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a href=\"javascript:void(0)\" id=\"show-table-citas-programadas\" data-divtabletarget=\"div-resultado-citas-programadas\"
\t    ";
        // line 147
        if (((isset($context["_CIT_ALLOW_LIST"]) ? $context["_CIT_ALLOW_LIST"] : $this->getContext($context, "_CIT_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t    <span class=\"text-info\"><i class=\"fa fa-clock-o\"></i> <i class=\"fa fa-list\"></i> </span> Citas
\t</a>
    </li>
";
    }

    // line 153
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 154
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group\">
\t    <div class='input-group date info-v2' id='irHaciaFecha' style=\"width: 130px;\">
\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Ir a...\"";
        // line 157
        echo " readonly=\"readonly\">
\t\t<span class=\"input-group-addon\">
\t\t    <span class=\"glyphicon glyphicon-calendar\"></span>
\t\t</span>
\t    </div>
\t</div>
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"false\">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
\t</div>
\t<div class=\"form-group\">
\t    <select class=\"form-control\" id=\"navbar_field_cita_modalidad\" name=\"navbar_field_cita_modalidad\" data-apply-formatter=\"mld\" data-apply-placeholder=\"Modalidad\" data-apply-width=\"125px\">
\t\t<option value=\"\"></option>
\t\t<optgroup label=\"Imagenología\">
\t\t    ";
        // line 171
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 172
            echo "\t\t    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "html", null, true);
            echo "</option>
\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modalidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 174
        echo "\t\t</optgroup>
\t    </select>
\t</div>
\t<div class=\"form-group\">
\t    <select class=\"form-control\" id=\"navbar_field_cita_tecnologo\" name=\"navbar_field_cita_tecnologo\" data-apply-formatter=\"user\" data-apply-formatter-mode=\"enabled\" data-apply-placeholder=\"Tecnólogo\" data-apply-width=\"125px\">
\t\t<option value=\"\"></option>
\t\t";
        // line 180
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 181
                echo "\t\t    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
\t\t\t";
                // line 182
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 183
                        echo "\t\t    <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                        echo "</option>
\t\t\t";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 185
                echo "\t\t    </optgroup>
\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 187
        echo "\t\t";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 188
                echo "\t\t    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                echo "</option>
\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 190
        echo "\t    </select>
\t</div>
    </form>
";
    }

    // line 195
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 196
        echo "    ";
        // line 197
        echo "    <li class=\"list-table-link-navbar-parent dropdown\">
\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><span class=\"text-info\"><i class=\"fa fa-unlock-alt\"></i> <i class=\"fa fa-list\"></i> </span> Bloqueos <span class=\"text-info\"><span class=\"caret\"></span></span></a>
\t<ul class=\"dropdown-menu\" role=\"menu\">
\t    <li ";
        // line 200
        if (((isset($context["_BLOQUEO_ALLOW_CREATE"]) ? $context["_BLOQUEO_ALLOW_CREATE"] : $this->getContext($context, "_BLOQUEO_ALLOW_CREATE")) == false)) {
            echo " class=\"disabled link-full-disabled\" ";
        }
        echo ">
\t\t<a href=\"javascript:void(0)\" id=\"navbar_btn_crearBloqueo\" ";
        // line 201
        if (((isset($context["_BLOQUEO_ALLOW_CREATE"]) ? $context["_BLOQUEO_ALLOW_CREATE"] : $this->getContext($context, "_BLOQUEO_ALLOW_CREATE")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                    <span class=\"glyphicon glyphicon-cog \"></span> Insertar bloqueo
\t\t</a>
\t    </li>
\t    <li class=\"divider\"></li>
\t    <li class=\"list-table-link-navbar";
        // line 206
        echo "\" ";
        if (((isset($context["_BLOQUEO_ALLOW_LIST"]) ? $context["_BLOQUEO_ALLOW_LIST"] : $this->getContext($context, "_BLOQUEO_ALLOW_LIST")) == false)) {
            echo " class=\"disabled link-full-disabled\" ";
        }
        echo ">
\t\t<a href=\"javascript:void(0)\" id=\"listarBloqueosBtn\" id=\"show-table-bloqueos-agenda\" data-divtabletarget=\"div-resultado-bloqueos-agenda\"
\t\t    ";
        // line 208
        if (((isset($context["_BLOQUEO_ALLOW_LIST"]) ? $context["_BLOQUEO_ALLOW_LIST"] : $this->getContext($context, "_BLOQUEO_ALLOW_LIST")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo "> <span class=\"glyphicon glyphicon-lock \"></span> Lista de bloqueos
\t\t</a>
\t    </li>
\t</ul>
    </li>
";
    }

    // line 215
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 221
        echo "
    ";
        // line 222
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    <div id=\"div-resultado-agenda-rx\" class=\"menu-vistas-agenda\" ";
        // line 224
        if (((isset($context["_CIT_ALLOW_CREATE"]) ? $context["_CIT_ALLOW_CREATE"] : $this->getContext($context, "_CIT_ALLOW_CREATE")) == false)) {
            echo " style=\"visibility: hidden;\" ";
        }
        echo " >

\t<div class=\"row outer\">

\t    <div id='external-events' class=\"col-lg-3 col-md-3 col-sm-3\">

\t\t<div class=\"panel panel-primary-v2\" id='fc-patient-panel' ";
        // line 230
        if ((((isset($context["_CIT_ALLOW_CREATE"]) ? $context["_CIT_ALLOW_CREATE"] : $this->getContext($context, "_CIT_ALLOW_CREATE")) == false) || ((isset($context["_CIT_ALLOW_EDIT"]) ? $context["_CIT_ALLOW_EDIT"] : $this->getContext($context, "_CIT_ALLOW_EDIT")) == false))) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
\t\t    <div class=\"panel-heading\">
\t\t\t<div class=\"dropdown pull-right\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"> <i class=\"fa fa-cog\"></i> <b class=\"caret\"></b></a>
                            <ul class=\"dropdown-menu\" role=\"menu\">
                                <li ";
        // line 235
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo ">
                                    <a href=\"javascript:void(0)\" id=\"panel_patient_btn_expand_view\" ";
        // line 236
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                                        <span class=\"glyphicon glyphicon-resize-full \"></span> Vista completa
                                    </a>
                                </li>
                                <li class=\"divider\"></li>
                                <li ";
        // line 241
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo ">
                                    <a href=\"javascript:void(0)\" id=\"panel_patient_btn_expand_height_view\" ";
        // line 242
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                                        <span class=\"glyphicon glyphicon-collapse-down \"></span> Expandir hacia abajo
                                    </a>
                                </li>
                                <li ";
        // line 246
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo " style=\"display: none;\">
                                    <a href=\"javascript:void(0)\" id=\"panel_patient_btn_default_height_view\" ";
        // line 247
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                                        <span class=\"glyphicon glyphicon-collapse-up \"></span> Contraer hacia arriba
                                    </a>
                                </li>
                                <li class=\"divider\"></li>
                                <li ";
        // line 252
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo ">
                                    <a href=\"javascript:void(0)\" id=\"panel_patient_btn_show_request_detail\" ";
        // line 253
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                                        <span class=\"glyphicon glyphicon-chevron-down \"></span> Ver detalle
                                    </a>
                                </li>
                                <li ";
        // line 257
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo " style=\"display: none;\">
                                    <a href=\"javascript:void(0)\" id=\"panel_patient_btn_hide_request_detail\" ";
        // line 258
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                                        <span class=\"glyphicon glyphicon-chevron-up \"></span> Ocultar detalle
                                    </a>
                                </li>
                                <li class=\"divider\"></li>
                                <li ";
        // line 263
        if (((isset($context["_PRC_EXTERNAL_ALLOW_CREATE"]) ? $context["_PRC_EXTERNAL_ALLOW_CREATE"] : $this->getContext($context, "_PRC_EXTERNAL_ALLOW_CREATE")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo ">
                                    <a href=\"javascript:void(0)\" id=\"panel_patient_btn_add_external\" ";
        // line 264
        if (((isset($context["_PRC_EXTERNAL_ALLOW_CREATE"]) ? $context["_PRC_EXTERNAL_ALLOW_CREATE"] : $this->getContext($context, "_PRC_EXTERNAL_ALLOW_CREATE")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                                        <span class=\"glyphicon glyphicon-import \"></span> Agregar externo
                                    </a>
                                </li>
            ";
        // line 269
        echo "                            </ul>
                        </div>

\t\t\t<h3 class=\"panel-title\"> <i class=\"fa fa-wheelchair\"></i> Pacientes sin cita ";
        // line 272
        echo " </h3>
\t\t    </div>
\t\t    <div class=\"panel-body\" style=\"height: 450px; overflow-y: auto; overflow-x: no-display;\" >
\t\t\t<p>
\t\t\t    <input type='checkbox' id='drop-remove' checked=\"checked\" />
\t\t\t    <label for='drop-remove'>Borrar al asignar</label>
\t\t\t</p>
\t\t\t<div class=\"form-group has-feedback\">
\t\t\t    <input type=\"text\" class=\"typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente...\" id=\"filter_patientsNoDated\" name=\"filter_patientsNoDated\">
\t\t\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear-v2\" id=\"clear-typeahead-filter-patient-exp\"></i>
\t\t\t</div>
\t\t    </div>
\t\t    <div class=\"panel-footer\">
\t\t\t<button type=\"button\" class=\"btn btn-primary-v2 btn-block\" id=\"reload-pct-sin-cita\"><span class=\"glyphicon glyphicon-repeat\"></span></button>
\t\t    </div>
\t\t</div>

\t\t<div class=\"panel panel-";
        // line 289
        echo "primary-v2\" id='external-events-symbol' >
\t\t    <div class=\"panel-heading\">
\t\t\t<h3 class=\"panel-title\"> <i class=\"fa fa-barcode\"></i> ";
        // line 291
        echo " Código de colores </h3>
\t\t    </div>
\t\t    <div class=\"panel-body\" style=\"";
        // line 293
        echo " overflow-y: auto; overflow-x: no-display;\" >
                        <ul class=\"list-unstyled\">
                            <li style=\"margin-bottom: 5px;\">
                                <span class=\"label label-primary-v2\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> &nbsp; Consulta externa
                            </li>
                            <li style=\"margin-bottom: 5px;\">
                                <span class=\"label\" style=\"background-color: #4d8e9d;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> &nbsp; Hospitalización
                            </li>
                            <li style=\"margin-bottom: 5px;\">
                                <span class=\"label\" style=\"background-color: #e0533d;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> &nbsp; Emergencia
                            </li>
                            <li style=\"height: 1px; margin: 9px 0; overflow: hidden; background-color: #e5e5e5;\"></li>
                            <li style=\"margin-bottom: 0px;\">
                                <span class=\"label\" style=\"background-color: yellow;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> &nbsp; Bloqueo predeterminado
                            </li>
                        </ul>
\t\t    </div>
\t\t</div>

\t    </div>";
        // line 313
        echo "
\t    <div id=\"container_fc_agenda_view\" class=\"col-lg-9 col-md-9 col-sm-9\">

\t\t<div class=\"panel panel-primary-v2\" id=\"fc-calendar-panel\">
\t\t    <div class=\"panel-heading\">
                        <div class=\"dropdown pull-right\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"> <i class=\"fa fa-cog\"></i> <b class=\"caret\"></b></a>
                            <ul class=\"dropdown-menu\" role=\"menu\">
                                <li ";
        // line 321
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo ">
                                    <a href=\"javascript:void(0)\" id=\"panel_agenda_btn_expand_view\" ";
        // line 322
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                                        <span class=\"glyphicon glyphicon-resize-full \"></span> Vista completa
                                    </a>
                                </li>
                                <li ";
        // line 326
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " class=\"disabled\" ";
        }
        echo " style=\"display: none;\">
                                    <a href=\"javascript:void(0)\" id=\"panel_agenda_btn_default_view\" ";
        // line 327
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                                        <span class=\"glyphicon glyphicon-resize-small \"></span> Vista predeterminada
                                    </a>
                                </li>
            ";
        // line 332
        echo "                            </ul>
                        </div>

\t\t\t<!-- refresh calendar view -->
\t\t\t<a class=\"btn btn-primary-v2 btn-sm pull-left\" id=\"panel_agenda_btn_refresh_calendar\" href=\"javascript:void(0)\" style=\"margin-top: -5px;\" ";
        // line 336
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo " target=\"_blank\" title=\"Refrescar agenda\">
\t\t\t    <i class=\"glyphicon glyphicon-repeat\"></i> Refrescar
\t\t\t</a>

\t\t\t<h3 class=\"panel-title\" style=\"text-align: center;\"> <i class=\"fa fa-calendar\"></i> <i class=\"fa fa-calendar-check-o\"></i> Agenda </h3>
\t\t\t
\t\t\t";
        // line 343
        echo "\t\t    </div>
\t\t    <div class=\"panel-body\" >

\t\t\t";
        // line 347
        echo "\t\t\t<div id='calendar' ";
        if ((((isset($context["_CIT_ALLOW_CREATE"]) ? $context["_CIT_ALLOW_CREATE"] : $this->getContext($context, "_CIT_ALLOW_CREATE")) == false) || ((isset($context["_CIT_ALLOW_EDIT"]) ? $context["_CIT_ALLOW_EDIT"] : $this->getContext($context, "_CIT_ALLOW_EDIT")) == false))) {
            echo " disabled=\"disabled\" ";
        }
        echo "></div>
                        
                        <div class=\"pull-right\" style=\"margin-top: 10px;\">
                            <select class=\"form-control select2\" id=\"fullcalendar_slotDuration\" name=\"fullcalendar_slotDuration\" data-input-transform=\"select2\" data-apply-placeholder=\"Modificar intervalos\" data-apply-width=\"200px\" ";
        // line 350
        if ((((isset($context["_CIT_ALLOW_CREATE"]) ? $context["_CIT_ALLOW_CREATE"] : $this->getContext($context, "_CIT_ALLOW_CREATE")) == false) || ((isset($context["_CIT_ALLOW_EDIT"]) ? $context["_CIT_ALLOW_EDIT"] : $this->getContext($context, "_CIT_ALLOW_EDIT")) == false))) {
            echo " disabled ";
        }
        echo ">
                                <option value=\"\"></option>
                                ";
        // line 352
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(5, 60, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 353
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\" ";
            if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) == 5)) {
                echo " selected ";
            }
            echo ">";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo " minutos</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 355
        echo "                            </select>
                        </div>

\t\t    </div>
\t\t</div>

\t    </div>";
        // line 362
        echo "
\t    <div style='clear:both'></div>

\t</div>";
        // line 366
        echo "
        ";
        // line 367
        if (((isset($context["_PRC_ALLOW_LIST"]) ? $context["_PRC_ALLOW_LIST"] : $this->getContext($context, "_PRC_ALLOW_LIST")) == true)) {
            // line 368
            echo "            ";
            $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_listarPacientesSinCita_v2.html.twig")->display($context);
            echo "     ";
            // line 369
            echo "        ";
        }
        // line 370
        echo "
    </div>

    <div id=\"opcionesCita-modal\" class=\"modal fade\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-width=\"760\">
        <div class=\"modal-body\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <p>¿Que acción desea ejecutar con la cita programada?</p>

            <input type=\"hidden\" id=\"formConfirmCitId\" name=\"formConfirmCitId\" value=\"\" />
        </div>
        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn\"><i class=\"fa fa-times\"></i> Cerrar</button>
            <button type=\"button\" id=\"btn_detalle_cit_modal\" name=\"btn_detalle_cit_modal\" class=\"btn btn-primary-v2\" ";
        // line 382
        echo " ><i class=\"fa fa-check-circle\"></i> Detalles</button>
            <button type=\"button\" id=\"btn_editar_cit_modal\" name=\"btn_editar_cit_modal\" class=\"btn btn-primary-v2\" ";
        // line 383
        echo " ><i class=\"fa fa-edit\"></i> Editar</button>
            <button type=\"button\" id=\"btn_confirmar_cit_modal\" name=\"btn_confirmar_cit_modal\" class=\"btn btn-success-v2\" ><i class=\"fa fa-play\"></i> Confirmar</button>
            <button type=\"button\" id=\"btn_cancelar_cit_modal\" name=\"btn_cancelar_cit_modal\" class=\"btn btn-danger\" ";
        // line 385
        echo " ><i class=\"fa fa-times-circle\"></i> Cancelar</button>
        </div>
    </div>

    ";
        // line 389
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_popover_contentwrapper.html.twig")->display($context);
        echo "    \t\t\t\t\t";
        // line 390
        echo "    ";
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_event_contentwrapper.html.twig")->display($context);
        echo "    \t\t\t\t\t";
        // line 391
        echo "    ";
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_event_contentwrapper.html.twig")->display(array_merge($context, array("radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 392
        echo "                                                             ";
        // line 393
        echo "
    ";
        // line 394
        if (((isset($context["_CIT_ALLOW_VIEW"]) ? $context["_CIT_ALLOW_VIEW"] : $this->getContext($context, "_CIT_ALLOW_VIEW")) == true)) {
            // line 395
            echo "\t";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:cit_total_info_modal_v2.html.twig")->display($context);
            echo "    \t\t\t";
            // line 396
            echo "    ";
        }
        // line 397
        echo "    ";
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == true)) {
            // line 398
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal_v2.html.twig")->display($context);
            echo "    \t\t\t";
            // line 399
            echo "    ";
        }
        // line 400
        echo "    ";
        if (((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)) {
            // line 401
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_agregarIndicacionesRadiologo_modal.html.twig")->display($context);
            echo "              ";
            // line 402
            echo "    ";
        }
        // line 403
        echo "    ";
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            // line 404
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_crearSolicitudEstudio_formatoRapido_modal.html.twig")->display(array_merge($context, array("medicos" => (isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "proyecciones" => (isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 405
            echo "     ";
            // line 406
            echo "    ";
        }
        // line 407
        echo "        
    ";
        // line 408
        if (((((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true)) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 409
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_asignarNuevoExpediente_modal.html.twig")->display($context);
            echo "     ";
            // line 410
            echo "    ";
        }
        // line 411
        echo "
    ";
        // line 412
        if (((isset($context["_CIT_ALLOW_LIST"]) ? $context["_CIT_ALLOW_LIST"] : $this->getContext($context, "_CIT_ALLOW_LIST")) == true)) {
            // line 413
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_listarCitas_v2.html.twig")->display($context);
            echo "    \t\t\t\t\t";
            // line 414
            echo "    ";
        }
        // line 415
        echo "
    ";
        // line 416
        if ((((isset($context["_CIT_ALLOW_CREATE"]) ? $context["_CIT_ALLOW_CREATE"] : $this->getContext($context, "_CIT_ALLOW_CREATE")) == true) && ((isset($context["_CIT_ALLOW_EDIT"]) ? $context["_CIT_ALLOW_EDIT"] : $this->getContext($context, "_CIT_ALLOW_EDIT")) == true))) {
            // line 417
            echo "\t";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_editarCita_modal.html.twig")->display(array_merge($context, array("modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")), "estados" => (isset($context["estados"]) ? $context["estados"] : $this->getContext($context, "estados")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 419
            echo "\t";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_cancelarCita_modal.html.twig")->display(array_merge($context, array("estados" => (isset($context["estados"]) ? $context["estados"] : $this->getContext($context, "estados")), "default_statusCancelCit" => (isset($context["default_statusCancelCit"]) ? $context["default_statusCancelCit"] : $this->getContext($context, "default_statusCancelCit")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 421
            echo "    ";
        }
        // line 422
        echo "
    <!-- -->

    ";
        // line 425
        if (((isset($context["_BLOQUEO_ALLOW_VIEW"]) ? $context["_BLOQUEO_ALLOW_VIEW"] : $this->getContext($context, "_BLOQUEO_ALLOW_VIEW")) == true)) {
            // line 426
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:blAgd_total_info_modal_v2.html.twig")->display($context);
            echo "                      ";
            // line 427
            echo "    ";
        }
        // line 428
        echo "
    ";
        // line 429
        if (((isset($context["_BLOQUEO_ALLOW_LIST"]) ? $context["_BLOQUEO_ALLOW_LIST"] : $this->getContext($context, "_BLOQUEO_ALLOW_LIST")) == true)) {
            // line 430
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_listarBloqueos.html.twig")->display($context);
            echo "    \t\t\t\t";
            // line 431
            echo "    ";
        }
        // line 432
        echo "
    ";
        // line 433
        if ((((isset($context["_BLOQUEO_ALLOW_CREATE"]) ? $context["_BLOQUEO_ALLOW_CREATE"] : $this->getContext($context, "_BLOQUEO_ALLOW_CREATE")) == true) && ((isset($context["_BLOQUEO_ALLOW_EDIT"]) ? $context["_BLOQUEO_ALLOW_EDIT"] : $this->getContext($context, "_BLOQUEO_ALLOW_EDIT")) == true))) {
            // line 434
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_crearBloqueo_modal.html.twig")->display(array_merge($context, array("modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 435
            echo "  \t";
            // line 436
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_excluirRadiologoBloqueo_modal.html.twig")->display(array_merge($context, array("radiologos" => (isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 437
            echo "  \t";
            // line 438
            echo "    ";
        }
        // line 439
        echo "
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCitaAdmin:cit_agenda.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1014 => 439,  1011 => 438,  1009 => 437,  1001 => 436,  999 => 435,  991 => 434,  989 => 433,  986 => 432,  983 => 431,  979 => 430,  977 => 429,  974 => 428,  971 => 427,  967 => 426,  965 => 425,  960 => 422,  957 => 421,  949 => 419,  941 => 417,  939 => 416,  936 => 415,  933 => 414,  929 => 413,  927 => 412,  924 => 411,  921 => 410,  917 => 409,  915 => 408,  912 => 407,  909 => 406,  907 => 405,  899 => 404,  896 => 403,  893 => 402,  889 => 401,  886 => 400,  883 => 399,  879 => 398,  876 => 397,  873 => 396,  869 => 395,  867 => 394,  864 => 393,  862 => 392,  854 => 391,  850 => 390,  847 => 389,  841 => 385,  837 => 383,  834 => 382,  820 => 370,  817 => 369,  813 => 368,  811 => 367,  808 => 366,  803 => 362,  795 => 355,  780 => 353,  776 => 352,  769 => 350,  760 => 347,  755 => 343,  744 => 336,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 119,  278 => 116,  274 => 115,  270 => 114,  265 => 113,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 107,  238 => 104,  233 => 101,  228 => 100,  223 => 97,  218 => 96,  212 => 93,  210 => 92,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 68,  141 => 64,  133 => 63,  114 => 48,  111 => 47,  103 => 43,  98 => 41,  92 => 38,  86 => 35,  81 => 32,  76 => 31,  70 => 28,  64 => 25,  61 => 24,  56 => 22,  54 => 21,  52 => 20,  50 => 19,  48 => 16,  46 => 15,  44 => 14,  42 => 13,  40 => 12,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
