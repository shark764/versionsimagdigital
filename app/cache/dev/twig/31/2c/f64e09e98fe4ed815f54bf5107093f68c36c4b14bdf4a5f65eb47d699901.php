<?php

/* MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_busquedaPaciente.html.twig */
class __TwigTemplate_312cf64e09e98fe4ed815f54bf5107093f68c36c4b14bdf4a5f65eb47d699901 extends Twig_Template
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
    }

    // line 16
    public function block_javascripts($context, array $blocks = array())
    {
        // line 17
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    
    <script>
        var \$isGranted_studyRequest,
            \$isGranted_studyView;
\t
        \$isGranted_studyRequest = ";
        // line 23
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) && ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
        \$isGranted_studyView    = ";
        // line 24
        if ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_LIST") && $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

        (function (\$) {
            /*
             * 
             * @type type
             * Global variables for plugin
             */
            window.GROUP_DEPENDENT_ENTITIES = null;   // --| build data collection
            GROUP_DEPENDENT_ENTITIES        = JSON.parse('";
        // line 33
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["GROUP_DEPENDENT_ENTITIES"]) ? $context["GROUP_DEPENDENT_ENTITIES"] : $this->getContext($context, "GROUP_DEPENDENT_ENTITIES"))), "js");
        echo "');

        }(jQuery));
    </script>

    ";
        // line 39
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImagenologiaDigitalAdmin/simagd_funciones_validacion.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 42
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_assignToNewRecord_alert.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_newRecord_typeahead.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 46
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImagenologiaDigitalAdmin/simagd_config_search.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImagenologiaDigitalAdmin/simagd_busqueda_paciente.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImagenologiaDigitalAdmin/simagd_lista_pacientes.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImagenologiaDigitalAdmin/simagd_fastRequest.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 53
    public function block_simagd_bs_alert($context, array $blocks = array())
    {
        // line 54
        echo "    ";
        $this->displayParentBlock("simagd_bs_alert", $context, $blocks);
        echo "
    
    ";
        // line 56
        $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_assignToNewRecord_alert.html.twig")->display($context);
    }

    // line 59
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 60
        echo "    <i class=\"fa fa-wheelchair\"></i> <i class=\"fa fa-tasks\"></i> <i class=\"fa fa-clock-o\"></i> <i class=\"fa fa-eye-slash\"></i> <i class=\"fa fa-clipboard\"></i> Búsqueda de Pacientes
";
    }

    // line 63
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
    }

    // line 66
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 67
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"false\" data-template-source=\"getSearchExpedienteSourceTemplate\" ";
        // line 69
        if ((!(null === (isset($context["expRequest"]) ? $context["expRequest"] : $this->getContext($context, "expRequest"))))) {
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expRequest"]) ? $context["expRequest"] : $this->getContext($context, "expRequest")), "numero"), "html", null, true);
            echo "\" ";
        }
        echo ">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-exp\"></i>
\t</div>
        <button type=\"submit\" id=\"btn_search_pct\" name=\"btn_search_pct\" class=\"btn btn-primary-v2\"><i class=\"fa fa-search\"></i></button>
\t<button type=\"submit\" id=\"btn_search_plus_pct\" name=\"btn_search_plus_pct\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-search-plus\"></i> Más opciones</button>
\t<button type=\"submit\" id=\"btn_search_minus_pct\" name=\"btn_search_minus_pct\" class=\"btn btn-primary-v2\" style=\"display: none;\" ><i class=\"fa fa-search-minus\"></i> Menos opciones</button>
    </form>
";
    }

    // line 78
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
    }

    // line 81
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 82
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "
    
    <div id=\"container_form_busquedaPaciente\" style=\"display: none;\">

\t";
        // line 90
        echo "
\t";
        // line 92
        echo "\t
\t<form id=\"formBusquedaPaciente\" method=\"post\" class=\"form-horizontal\" >
\t
\t    <div class=\"form-group\">
\t\t<label class=\"col-xs-2 control-label\">Nombres</label>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"primerNombre\" name=\"primerNombre\" placeholder=\"Primer Nombre\" maxlength=\"25\"
\t\t\t\t  ";
        // line 102
        echo "\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"segundoNombre\" name=\"segundoNombre\" placeholder=\"Segundo Nombre\" maxlength=\"25\"
\t\t\t\t  ";
        // line 118
        echo "\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"tercerNombre\" name=\"tercerNombre\" placeholder=\"Tercer Nombre\" maxlength=\"25\"
\t\t\t\t  ";
        // line 134
        echo "\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t    </div>

\t    <div class=\"form-group\">
\t\t<label class=\"col-xs-2 control-label\">Apellidos</label>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"primerApellido\" name=\"primerApellido\" placeholder=\"Primer Apellido\" maxlength=\"25\"
\t\t\t\t  ";
        // line 154
        echo "\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"segundoApellido\" name=\"segundoApellido\" placeholder=\"Segundo Apellido\" maxlength=\"25\"
\t\t\t\t  ";
        // line 170
        echo "\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t    </div>

\t    <div class=\"form-group\">
\t\t<label class=\"col-xs-2 control-label\">N° de Expediente</label>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-barcode'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"numeroExp\" name=\"numeroExp\" maxlength=\"12\"
\t\t\t\t  ";
        // line 190
        echo "\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"1\"
\t\t\t\t  data-fv-stringlength-max=\"12\"
\t\t\t\t  data-fv-stringlength-message=\"1 caracter mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[0-9\\-]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t\t<label class=\"col-xs-2 control-label\">DUI</label>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-barcode'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"dui\" name=\"dui\" maxlength=\"10\"
\t\t\t\t  ";
        // line 207
        echo "\t\t\t\t  
\t\t\t\t  data-fv-verbose=\"false\"
\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"9\"
\t\t\t\t  data-fv-stringlength-max=\"10\"
\t\t\t\t  data-fv-stringlength-message=\"Debe contener 10 carácteres, inlcuyendo guión\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"(^\\d{8})-{0,1}(\\d\$)\"
\t\t\t\t  data-fv-regexp-message=\"No corresponde al patrón '99999999-9'\"
\t\t\t\t  
\t\t\t\t  data-fv-callback=\"true\"
\t\t\t\t  data-fv-callback-message=\"No es un número de DUI válido\"
\t\t\t\t  data-fv-callback-callback=\"checkValidDUI\" />
\t\t    </div>
\t\t</div>
\t    </div>

\t    <div class=\"form-group\">
\t\t<label class=\"col-xs-2 control-label\">Fecha Nacimiento</label>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class='input-group-btn'>
\t\t\t    <button class='demo btn btn-primary-v2 btn-large' id='showDateTimePicker'> <i class='glyphicon glyphicon-calendar'></i> </button>
\t\t\t</span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"fechaNacimiento\" name=\"fechaNacimiento\" readonly=\"readonly\" />
\t\t    </div>
\t\t</div>
\t\t<label class=\"col-xs-2 control-label\">Desplegar</label>
\t\t<div class=\"col-xs-2\">
\t\t    <center>
\t\t\t<select class=\"form-control select2\" id=\"limitarResultados\" name=\"limitarResultados\">
\t\t\t    <option value=\"\"></option>
\t\t\t    ";
        // line 241
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(10, 40, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 242
            echo "\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "</option>
\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 244
        echo "\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(50, 2000, 50));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 245
            echo "\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "</option>
\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 247
        echo "\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(2500, 10000, 500));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 248
            echo "\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "</option>
\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 250
        echo "\t\t\t</select>
\t\t    </center>
\t\t</div>
\t\t<label class=\"col-xs-1 control-label\">Resultados</label>
\t    </div>

\t    <div class=\"form-group\">
\t\t<div class=\"col-xs-offset-2 col-xs-10\">
\t\t    <button type=\"submit\" id=\"iniciar-busqueda\" name=\"btn_buscar_pacientes\" class=\"btn btn-primary-v2\" >
\t\t\t<i class=\"fa fa-search\"></i> Buscar
\t\t    </button>
\t\t    <button type=\"button\" id=\"limpiar-form\" name=\"btn_reset_form\" class=\"btn btn-element-v2\" >
\t\t\t<i class=\"fa fa-repeat\"></i> Restablecer
\t\t    </button>
\t\t    <button type=\"button\" id=\"limpiar-resultados\" name=\"btn_reset_resultados\" class=\"btn btn-danger\" >
\t\t\t<i class=\"fa fa-trash-o\"></i> Limpiar
\t\t    </button>
\t\t</div>
\t    </div>
\t</form>
\t
    </div>
    
    <br/><br/>
    
    <!-- toolbar for table-resultado-busqueda -->
    ";
        // line 276
        $context["code_entity"] = "exp";
        // line 277
        echo "        <div id=\"bs_";
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

            ";
        // line 280
        echo "                <!-- Single button -->
                <div class=\"btn-group\">
                    <button type=\"button\" id=\"btn_";
        // line 282
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                        <i class=\"glyphicon glyphicon-filter\"></i>
                        Filtrar <span class=\"caret\"></span>
                    </button>
                    <!-- Menu -->
                    <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
        // line 287
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_menuFilter\" >
                    </ul>
                </div>
                <button id=\"btn_";
        // line 290
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
        echo ">
                    <i class=\"glyphicon glyphicon-repeat\"></i>
                </button>
                <button id=\"btn_";
        // line 293
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
        echo ">
                    <i class=\"glyphicon glyphicon-trash\"></i>
                </button>

                <!-- --| custom buttons for toolbar -->
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_unknown_patient_add_item\" class=\"btn btn-danger btn_unknown_patient_add_item\" title=\"Agregar paciente de emergencia\" style=\"margin-left: 15px\"
                        ";
        // line 301
        if ((!(((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                    <i class=\"glyphicon glyphicon-plus-sign \"></i>
                </button>
                
                <span class=\"btn-separator\"></span>
                
                <button id=\"btn_external_patient_add_item\" class=\"btn btn-element-v2 btn_external_patient_add_item\" title=\"Agregar paciente referido\" style=\"margin-left: 15px\"
                        ";
        // line 308
        if ((!(((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                    <i class=\"glyphicon glyphicon-plus-sign \"></i>
                </button>
                <!-- END --| custom buttons for toolbar -->
            ";
        // line 313
        echo "
        </div>
    <!-- END --| toolbar for table-resultado-busqueda -->

    <div id=\"container_resultado_busquedaPaciente\" style=\"display: none;\">
        <table class=\"table table-condensed\" id=\"table-resultado-busqueda\"
                data-toggle=\"table\"
                data-id-field=\"exp_id\"
                data-url=\"";
        // line 321
        echo "\"
                data-backup-url=\"simagd_imagenologia_digital_resultadosBusquedaPaciente\"
                data-toolbar=\"#bs_exp_toolbar\"
                data-cache=\"false\"
                data-show-refresh=\"true\"
                data-show-toggle=\"true\"
                data-show-columns=\"true\"
                data-search=\"true\"
                data-select-item-name=\"busquedaPctToolbar\"
                data-pagination=\"true\"
                data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 331
        echo "]\"
                ";
        // line 334
        echo "                data-classes=\"table table-hover table-condensed table-no-bordered\"
                data-height=\"760\">
            <thead>
                <tr style=\"background-color: #31708f; color: #fff;\">
                    <th data-field=\"exp_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-halign=\"center\" data-align=\"center\" data-sortable=\"true\">ID</th>
                    <th data-field=\"exp_numero\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-switchable=\"false\" class=\"col-md-1\" data-halign=\"center\" data-align=\"left\" data-sortable=\"true\">Número</th>
                    <th data-field=\"pct_nombreCompleto\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-switchable=\"false\" class=\"col-md-3\" data-halign=\"center\" data-align=\"left\" data-sortable=\"true\">Nombre completo</th>
                    <th data-field=\"pct_fechaNacimiento\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"fechaHoraNacimientoFormatter\" class=\"col-md-1\" data-halign=\"center\" data-align=\"right\" data-sortable=\"true\">Fecha nacimiento</th>
                    <th data-field=\"pct_numeroDocIdePaciente\" class=\"col-md-1\" data-halign=\"center\" data-align=\"left\" data-sortable=\"true\">Identificación</th>
                    <th data-field=\"pct_ocupacion\" data-visible=\"false\" class=\"col-md-1\" data-halign=\"center\" data-align=\"left\" data-sortable=\"true\">Ocupación</th>
                    <th data-field=\"pct_nacionalidad\" data-visible=\"false\" class=\"col-md-1\" data-halign=\"center\" data-align=\"left\" data-sortable=\"true\">Nacionalidad</th>
                    <th data-field=\"pct_sexo\" class=\"col-md-1\" data-halign=\"center\" data-align=\"left\" data-sortable=\"true\">Sexo</th>
                    <th data-field=\"pct_estadoCivil\" class=\"col-md-1\" data-halign=\"center\" data-align=\"left\" data-sortable=\"true\">Estado civil</th>
                    <th data-field=\"action\" data-switchable=\"false\" data-formatter=\"actionFormatter\" data-events=\"actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                </tr>
            </thead>
        </table>
    </div>
    
    <br/><br/>
    
    ";
        // line 355
        $this->env->loadTemplate("MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_resultado_busquedaPaciente.html.twig")->display($context);
        // line 356
        echo "    
    <!-- form for create study request -->
    ";
        // line 358
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == true)) {
            // line 359
            echo "        ";
            $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal_v2.html.twig")->display($context);
            echo "          ";
            // line 360
            echo "    ";
        }
        // line 361
        echo "    ";
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == true) || ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == true))) {
            // line 362
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_crearSolicitudEstudio_formatoRapido_modal.html.twig")->display(array_merge($context, array("medicos" => (isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")), "default_empLogged" => (isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "modalidades" => (isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")), "default_mldRx" => (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "proyecciones" => (isset($context["proyecciones"]) ? $context["proyecciones"] : $this->getContext($context, "proyecciones")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 363
            echo "     ";
            // line 364
            echo "    ";
        }
        // line 365
        echo "    
    <br/><br/>
    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_busquedaPaciente.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  580 => 365,  577 => 364,  575 => 363,  567 => 362,  564 => 361,  561 => 360,  557 => 359,  555 => 358,  551 => 356,  549 => 355,  526 => 334,  523 => 331,  511 => 321,  501 => 313,  492 => 308,  480 => 301,  468 => 293,  461 => 290,  455 => 287,  447 => 282,  443 => 280,  437 => 277,  435 => 276,  407 => 250,  396 => 248,  391 => 247,  380 => 245,  375 => 244,  364 => 242,  360 => 241,  324 => 207,  306 => 190,  285 => 170,  268 => 154,  247 => 134,  230 => 118,  213 => 102,  202 => 92,  199 => 90,  192 => 82,  189 => 81,  184 => 78,  168 => 69,  164 => 67,  161 => 66,  156 => 63,  151 => 60,  148 => 59,  144 => 56,  138 => 54,  135 => 53,  128 => 49,  124 => 48,  120 => 47,  115 => 46,  110 => 43,  105 => 42,  99 => 39,  91 => 33,  75 => 24,  67 => 23,  57 => 17,  54 => 16,  46 => 12,  43 => 11,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
