<?php

/* MinsalSimagdBundle:ImgEstudioPacienteAdmin:est_busquedaEstudio_v2.html.twig */
class __TwigTemplate_f5c1478815c23571ec238be4efea3363c5a1b9b7e6737b08097175fa1e745bf0 extends Twig_Template
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
        $context["_EST_ALLOW_CREATE"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 7
        $context["_EST_ALLOW_EDIT"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 8
        $context["_EST_ALLOW_LIST"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
        // line 9
        $context["_EST_ALLOW_VIEW"] = ((($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) ? (true) : (false));
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
        /*
         * 
         * @type String
         * navbar menu container for bstables
         */
        var \$pattern_bstable_container  = 'menu-listas-estudios';

        (function (\$) {
            /*
             * 
             * @type type
             * Global variables for plugin
             */
            window.GROUP_DEPENDENT_ENTITIES = null;   // --| build data collection
            GROUP_DEPENDENT_ENTITIES        = JSON.parse('";
        // line 34
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["GROUP_DEPENDENT_ENTITIES"]) ? $context["GROUP_DEPENDENT_ENTITIES"] : $this->getContext($context, "GROUP_DEPENDENT_ENTITIES"))), "js");
        echo "');

        }(jQuery));
        
    </script>

    ";
        // line 41
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImagenologiaDigitalAdmin/simagd_funciones_validacion.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 44
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgEstudioPacienteAdmin/est_config_search.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgEstudioPacienteAdmin/est_busqueda_estudio.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgEstudioPacienteAdmin/est_lista_estudios.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 50
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 51
        echo "    <i class=\"fa fa-wheelchair\"></i> <i class=\"fa fa-eye-slash\"></i> <i class=\"fa fa-floppy-o\"></i> <i class=\"fa fa-microphone\"></i> Búsqueda de estudios en Repositorio PACS
";
    }

    // line 54
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
    }

    // line 57
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 58
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"form-group has-feedback\">
\t    <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"false\" ";
        // line 60
        if ((!(null === (isset($context["expRequest"]) ? $context["expRequest"] : $this->getContext($context, "expRequest"))))) {
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expRequest"]) ? $context["expRequest"] : $this->getContext($context, "expRequest")), "numero"), "html", null, true);
            echo "\" ";
        }
        echo ">
\t    <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
\t</div>
        <button type=\"submit\" id=\"btn_search_filter_expNumero\" name=\"btn_search_filter_expNumero\" class=\"btn btn-primary-v2 ";
        // line 63
        echo "\">
            <i class=\"fa fa-search\"></i>
        </button>
\t<button type=\"submit\" id=\"btn_search_plus_est\" name=\"btn_search_plus_est\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-search-plus\"></i> Más opciones</button>
\t<button type=\"submit\" id=\"btn_search_minus_est\" name=\"btn_search_minus_est\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-search-minus\"></i> Menos opciones</button>
    </form>
";
    }

    // line 71
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
    }

    // line 74
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 75
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "
    
    <div id=\"container_form_busquedaEstudio\" style=\"display: none;\">

\t";
        // line 83
        echo "
\t";
        // line 85
        echo "\t
\t<form id=\"formBusquedaEstudio\" method=\"post\" class=\"form-horizontal\" >

\t    <div class=\"form-group\">
\t\t<label class=\"col-xs-2 control-label required\">Buscar estudios en</label>
\t\t<div class=\"col-xs-6\">
\t\t    <select id=\"establecimientoAlojado\" name=\"establecimientoAlojado\" class=\"form-control select2-select\" data-default=\"";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["defaultEstab"]) ? $context["defaultEstab"] : $this->getContext($context, "defaultEstab")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"stdPacs\"
\t\t\t      ";
        // line 93
        echo "                                  
                              data-filter-bstable-apply=\"true\"
                              data-filter-bstable-type=\"server\"
                              data-filter-bstable-by=\"stdest_id\"

\t\t\t      data-fv-notempty=\"true\"
\t\t\t      data-fv-notempty-message=\"Seleccione un elemento\" >
\t\t\t<option value=\"\"></option>
\t\t\t";
        // line 101
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEstab"]) ? $context["tiposEstab"] : $this->getContext($context, "tiposEstab")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            // line 102
            echo "\t\t\t    <optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
            echo "\">
\t\t\t    ";
            // line 103
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")));
            foreach ($context['_seq'] as $context["_key"] => $context["establecimiento"]) {
                if (((!(null === $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"))) && ($this->getAttribute($this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                    // line 104
                    echo "\t\t\t\t<option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "id"), "html", null, true);
                    echo "\" ";
                    if (($this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "id") == $this->getAttribute((isset($context["defaultEstab"]) ? $context["defaultEstab"] : $this->getContext($context, "defaultEstab")), "id"))) {
                        echo " selected ";
                    }
                    echo ">
\t\t\t\t    ";
                    // line 105
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "nombre"), "html", null, true);
                    echo "
\t\t\t\t    ";
                    // line 107
                    echo "\t\t\t\t</option>
\t\t\t    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['establecimiento'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 109
            echo "\t\t\t    </optgroup>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 111
        echo "\t\t\t";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")));
        foreach ($context['_seq'] as $context["_key"] => $context["establecimiento"]) {
            if ((null === $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "idTipoEstablecimiento"))) {
                // line 112
                echo "\t\t\t    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "id"), "html", null, true);
                echo "\" ";
                if (($this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "id") == $this->getAttribute((isset($context["defaultEstab"]) ? $context["defaultEstab"] : $this->getContext($context, "defaultEstab")), "id"))) {
                    echo " selected ";
                }
                echo ">
\t\t\t\t";
                // line 113
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "nombre"), "html", null, true);
                echo "
\t\t\t\t";
                // line 115
                echo "\t\t\t    </option>
\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['establecimiento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo "\t\t    </select>
\t\t</div>
\t    </div>
\t
\t    <div class=\"form-group\">
\t\t<label class=\"col-xs-2 control-label\">Nombres</label>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"primerNombre\" name=\"primerNombre\" placeholder=\"Primer Nombre\" maxlength=\"25\"
\t\t\t\t  ";
        // line 128
        echo "                                  
                                  data-filter-bstable-apply=\"true\"
                                  data-filter-bstable-type=\"text\"
                                  data-filter-bstable-by=\"pct_primerNombre\"
\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ\\s]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"segundoNombre\" name=\"segundoNombre\" placeholder=\"Segundo Nombre\" maxlength=\"25\"
\t\t\t\t  ";
        // line 148
        echo "                                  
                                  data-filter-bstable-apply=\"true\"
                                  data-filter-bstable-type=\"text\"
                                  data-filter-bstable-by=\"pct_segundoNombre\"
\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ\\s]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"tercerNombre\" name=\"tercerNombre\" placeholder=\"Tercer Nombre\" maxlength=\"25\"
\t\t\t\t  ";
        // line 168
        echo "                                  
                                  data-filter-bstable-apply=\"true\"
                                  data-filter-bstable-type=\"text\"
                                  data-filter-bstable-by=\"pct_tercerNombre\"
\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ\\s]+\$\"
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
        // line 192
        echo "                                  
                                  data-filter-bstable-apply=\"true\"
                                  data-filter-bstable-type=\"text\"
                                  data-filter-bstable-by=\"pct_primerApellido\"
\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ\\s]+\$\"
\t\t\t\t  data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
\t\t    </div>
\t\t</div>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info-v2\">
\t\t\t<span class=\"input-group-addon\"><i class='glyphicon glyphicon-user'></i></span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"segundoApellido\" name=\"segundoApellido\" placeholder=\"Segundo Apellido\" maxlength=\"25\"
\t\t\t\t  ";
        // line 212
        echo "                                  
                                  data-filter-bstable-apply=\"true\"
                                  data-filter-bstable-type=\"text\"
                                  data-filter-bstable-by=\"pct_segundoApellido\"
\t\t\t\t  
\t\t\t\t  data-fv-stringlength=\"true\"
\t\t\t\t  data-fv-stringlength-min=\"3\"
\t\t\t\t  data-fv-stringlength-max=\"25\"
\t\t\t\t  data-fv-stringlength-message=\"3 caracteres mínimo para iniciar búsqueda\"

\t\t\t\t  data-fv-regexp=\"true\"
\t\t\t\t  data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ\\s]+\$\"
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
        // line 236
        echo "                                  
                                  data-filter-bstable-apply=\"true\"
                                  data-filter-bstable-type=\"text\"
                                  data-filter-bstable-by=\"explocal_numero\"
\t\t\t\t  
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
        // line 257
        echo "                                  
                                  data-filter-bstable-apply=\"true\"
                                  data-filter-bstable-type=\"text\"
                                  data-filter-bstable-by=\"pct_numeroDocIdePaciente\"
\t\t\t\t  
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
\t
\t    <div class=\"form-group\">
\t\t<label class=\"col-xs-2 control-label required\">Rango</label>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info\">
\t\t\t<span class='input-group-btn'>
\t\t\t    <button class='demo btn btn-element-v2 btn-large' id='showDateTimePickerFechaDesde'> <i class='glyphicon glyphicon-time'></i> </button>
\t\t\t</span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"fechaDesde\" name=\"fechaDesde\" placeholder=\"Desde\" readonly=\"readonly\"
\t\t\t\t";
        // line 289
        echo "                                  
                                data-filter-bstable-apply=\"true\"
                                data-filter-bstable-type=\"daterange\"
\t\t\t\t\t\t\t\t  
\t\t\t\tdata-fv-notempty=\"true\"
\t\t\t\tdata-fv-notempty-message=\"Este campo es requerido\"

\t\t\t\tdata-fv-date=\"true\"
\t\t\t\tdata-fv-date-format=\"YYYY-MM-DD h:m A\"
\t\t\t\tdata-fv-date-max=\"fechaHasta\"
\t\t\t\tdata-fv-date-message=\"Fecha no válida\" />
\t\t    </div>
\t\t</div>
\t\t<div class=\"col-xs-3\">
\t\t    <div class=\"input-group info\">
\t\t\t<span class='input-group-btn'>
\t\t\t    <button class='demo btn btn-element-v2 btn-large' id='showDateTimePickerFechaHasta'> <i class='glyphicon glyphicon-time'></i> </button>
\t\t\t</span>
\t\t\t<input type=\"text\" class=\"form-control\" id=\"fechaHasta\" name=\"fechaHasta\" placeholder=\"Hasta\" readonly=\"readonly\"
\t\t\t\t";
        // line 309
        echo "                                  
                                data-filter-bstable-apply=\"true\"
                                data-filter-bstable-type=\"daterange\"
\t\t\t\t\t\t\t\t  
\t\t\t\tdata-fv-notempty=\"true\"
\t\t\t\tdata-fv-notempty-message=\"Este campo es requerido\"

\t\t\t\tdata-fv-date=\"true\"
\t\t\t\tdata-fv-date-format=\"YYYY-MM-DD h:m A\"
\t\t\t\tdata-fv-date-min=\"fechaDesde\"
\t\t\t\tdata-fv-date-message=\"Fecha no válida\" />
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
\t\t\t<input type=\"text\" class=\"form-control\" id=\"fechaNacimiento\" name=\"fechaNacimiento\" placeholder=\"YYYY-MM-DD\" readonly=\"readonly\"
\t\t\t\t";
        // line 333
        echo "                                  
                                data-filter-bstable-apply=\"true\"
                                data-filter-bstable-type=\"date\"
                                data-filter-bstable-by=\"pct_fechaNacimiento\"

\t\t\t\tdata-fv-date=\"true\"
\t\t\t\tdata-fv-date-format=\"YYYY-MM-DD\"
\t\t\t\t";
        // line 341
        echo "\t\t\t\tdata-fv-date-message=\"Fecha no válida\" />
\t\t    </div>
\t\t</div>
\t\t<label class=\"col-xs-2 control-label\">Desplegar</label>
\t\t<div class=\"col-xs-2\">
\t\t    <center>
\t\t\t<select class=\"form-control select2\" id=\"limitarResultados\" name=\"limitarResultados\"
                                  
                                data-filter-bstable-apply=\"true\"
                                data-filter-bstable-type=\"limit\">
\t\t\t    <option value=\"\"></option>
\t\t\t    ";
        // line 352
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(10, 40, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 353
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
        // line 355
        echo "\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(50, 2000, 50));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 356
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
        // line 358
        echo "\t\t\t    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(2500, 10000, 500));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 359
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
        // line 361
        echo "\t\t\t</select>
\t\t    </center>
\t\t</div>
\t\t<label class=\"col-xs-1 control-label\">Resultados</label>
\t    </div>

\t    <div class=\"form-group\">
\t\t<div class=\"col-xs-offset-2 col-xs-10\">
\t\t    <button type=\"submit\" id=\"iniciar-busqueda\" name=\"btn_buscar_estudios\" class=\"btn btn-primary-v2\" >
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
        
    <!-- toolbar for table-lista-proyecciones -->
    ";
        // line 387
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "est")));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 388
        echo "    <!-- END --| toolbar for table-lista-proyecciones -->
    
    <div id=\"container_resultado_busquedaEstudio\" style=\"display: none;\">
        <table class=\"table table-condensed\" id=\"table-resultado-busqueda\"
\t\tdata-toggle=\"table\"
\t\tdata-id-field=\"est_id\"
\t\tdata-url=\"";
        // line 394
        echo "\"
                data-backup-url=\"simagd_estudio_resultadosBusquedaEstudio\"
                data-toolbar=\"#bs_est_toolbar\"
\t\tdata-cache=\"false\"
\t\tdata-show-refresh=\"true\"
\t\tdata-show-toggle=\"true\"
\t\tdata-show-columns=\"true\"
\t\tdata-search=\"true\"
\t\tdata-select-item-name=\"busquedaEstToolbar\"
\t\tdata-pagination=\"true\"
\t\tdata-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 404
        echo "]\"
\t\t";
        // line 407
        echo "\t\tdata-classes=\"table table-hover table-condensed table-no-bordered\"
\t\tdata-height=\"760\">
            <thead>
                <tr style=\"background-color: #31708f; color: #fff;\">
                    <th data-field=\"est_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-halign=\"center\" data-align=\"center\" data-sortable=\"true\">ID</th>
\t\t    <th data-field=\"est_paciente\" data-switchable=\"false\" data-formatter=\"simagdPacienteFormatter\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t    <th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t    <th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[empprc_id, empcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdSolicitanteEstudioFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t    <th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t    <th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t    <th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"[m_id, mcmpl_id]\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdModalidadSolicitadaFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t    <th data-field=\"est_tipo\" data-formatter=\"simagdTipoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Tipo</th>
\t\t    <th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t    <th data-field=\"prz_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusprz_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdEstadoEstudioFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t    <th data-field=\"est_fechaEstudio\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\"  data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Registrado en RIS</th>
\t\t    <th data-field=\"prz_fechaAlmacenado\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" class=\"col-md-1\" data-formatter=\"simagdDateTimeFormatter\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Almacenado en PACS</th>
\t\t    <th data-field=\"est_almacenado\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizado en</th>
\t\t    <th data-field=\"est_eliminadoEnPacs\" data-formatter=\"eliminadoEnPacsFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Eliminado</th>
                    <th data-field=\"action\" data-switchable=\"false\" data-formatter=\"actionFormatter\" data-events=\"actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                    <th data-field=\"est_chk\" data-checkbox=\"true\" data-formatter=\"\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
                </tr>
            </thead>
        </table>
    </div>
    
    <!-- form for create study request -->
    ";
        // line 433
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 434
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_crearSolicitudEstudio_formatoRapido_modal.html.twig")->display(array_merge($context, array("collection_prioridades" => (isset($context["collection_prioridades"]) ? $context["collection_prioridades"] : $this->getContext($context, "collection_prioridades")), "collection_modalidades" => (isset($context["collection_modalidades"]) ? $context["collection_modalidades"] : $this->getContext($context, "collection_modalidades")), "collection_examenes" => (isset($context["collection_examenes"]) ? $context["collection_examenes"] : $this->getContext($context, "collection_examenes")), "collection_proyecciones" => (isset($context["collection_proyecciones"]) ? $context["collection_proyecciones"] : $this->getContext($context, "collection_proyecciones")), "collection_default_mldRx" => (isset($context["collection_default_mldRx"]) ? $context["collection_default_mldRx"] : $this->getContext($context, "collection_default_mldRx")), "collection_default_exmRx" => (isset($context["collection_default_exmRx"]) ? $context["collection_default_exmRx"] : $this->getContext($context, "collection_default_exmRx")), "collection_tiposEmpleado" => (isset($context["collection_tiposEmpleado"]) ? $context["collection_tiposEmpleado"] : $this->getContext($context, "collection_tiposEmpleado")), "collection_radiologos" => (isset($context["collection_radiologos"]) ? $context["collection_radiologos"] : $this->getContext($context, "collection_radiologos")), "collection_default_empLogged" => (isset($context["collection_default_empLogged"]) ? $context["collection_default_empLogged"] : $this->getContext($context, "collection_default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 436
            echo "    ";
        }
        // line 437
        echo "    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgEstudioPacienteAdmin:est_busquedaEstudio_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  651 => 437,  648 => 436,  640 => 434,  638 => 433,  610 => 407,  607 => 404,  595 => 394,  587 => 388,  580 => 387,  552 => 361,  541 => 359,  536 => 358,  525 => 356,  520 => 355,  509 => 353,  505 => 352,  492 => 341,  483 => 333,  458 => 309,  437 => 289,  404 => 257,  382 => 236,  357 => 212,  336 => 192,  311 => 168,  290 => 148,  269 => 128,  257 => 117,  249 => 115,  245 => 113,  236 => 112,  230 => 111,  223 => 109,  215 => 107,  211 => 105,  202 => 104,  197 => 103,  192 => 102,  188 => 101,  178 => 93,  174 => 91,  166 => 85,  163 => 83,  156 => 75,  153 => 74,  148 => 71,  138 => 63,  128 => 60,  124 => 58,  121 => 57,  116 => 54,  111 => 51,  108 => 50,  101 => 46,  97 => 45,  92 => 44,  86 => 41,  77 => 34,  56 => 17,  53 => 16,  45 => 12,  42 => 11,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
