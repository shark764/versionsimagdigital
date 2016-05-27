<?php

/* MinsalSiapsBundle:MntPacienteAdmin:edit.html.twig */
class __TwigTemplate_8b90a045107a70efe9bd4873814a9547f2783bb073ff3ad221bf19a73392a988 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'form' => array($this, 'block_form'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'sonata_post_fieldsets' => array($this, 'block_sonata_post_fieldsets'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntPacienteAdmin/form-edit.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />  
";
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/datepicker/jquery.ui.datepicker-es.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/maskedinput/jquery.maskedinput.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/MntPacienteAdmin/MntPaciente_edit.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/funciones_generales.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
";
    }

    // line 19
    public function block_form($context, array $blocks = array())
    {
        // line 20
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    ";
        // line 22
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 23
        echo "
    ";
        // line 24
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 25
            echo "        <div>
            ";
            // line 26
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 29
            echo "        <form id=\"form_paciente\"
              ";
            // line 30
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 31
            echo "              role=\"form\"
              action=\"";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
              method=\"POST\"
              ";
            // line 34
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 35
            echo "              >

            ";
            // line 37
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 38
                echo "                <div class=\"sonata-ba-form-error\">
                    ";
                // line 39
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 42
            echo "
            ";
            // line 43
            if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                // line 44
                echo "                <a style=\"position:relative;float:right;margin-bottom:20px;\" class=\"btn btn-info\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
                echo "\">
                    <span class=\"glyphicon glyphicon-list\"></span>
                    ";
                // line 46
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_list", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </a>
            ";
            }
            // line 49
            echo "
            ";
            // line 50
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 53
            echo "
                ";
            // line 54
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 350
            echo "
                ";
            // line 351
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 354
            echo "
            ";
            // line 355
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

            ";
            // line 357
            $this->displayBlock('formactions', $context, $blocks);
            // line 387
            echo "        </form>
    ";
        }
    }

    // line 50
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 51
        echo "                <div class=\"row\">
                ";
    }

    // line 54
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 55
        echo "                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formgroups"));
        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
            // line 56
            echo "                        <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                            <div class=\"box box-success\">
                                <div class=\"box-header\">
                                    <h4 class=\"box-title\">
                                        ";
            // line 61
            echo "                                    </h4>
                                </div>
                                ";
            // line 64
            echo "                                <div class=\"box-body\">
                                    <div class=\"sonata-ba-collapsed-fields\">
                                        ";
            // line 66
            if (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description") != false)) {
                // line 67
                echo "                                            <p>";
                echo $this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description");
                echo "</p>
                                        ";
            }
            // line 69
            echo "                                        <center>
                                            <table class=\"dat_paciente\">
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">A.Nombre del Paciente</td>
                                                </tr>
                                                <tr class=\"dat_paciente_content\">
                                                    <td width='50%'>";
            // line 75
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "primerApellido"), array(), "array"), 'row');
            echo "</td>
                                                    <td width=''>";
            // line 76
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "segundoApellido"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 79
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "primerNombre"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 80
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "segundoNombre"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 83
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "tercerNombre"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 84
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "apellidoCasada"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 87
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "conocidoPor"), array(), "array"), 'row');
            echo "</td>
                                                    <td></td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">B.Datos del Nacimiento</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 94
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "fechaNacimiento"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 95
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "horaNacimiento"), array(), "array"), 'row');
            echo "
                                                     ";
            // line 96
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "horaNacimiento"), array(), "array"), 'errors')) > 0)) {
                // line 97
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 98
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "horaNacimiento"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 101
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Edad:</label>
                                                        <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                                                            <input id=\"edad\" type=\"text\" maxlength=\"25\" class=\"form-control\">
                                                        </div>
                                                    </td>
                                                    <td>";
            // line 110
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idSexo"), array(), "array"), 'row');
            echo "
                                                    ";
            // line 111
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idSexo"), array(), "array"), 'errors')) > 0)) {
                // line 112
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 113
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idSexo"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 116
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 119
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idPaisNacimiento"), array(), "array"), 'row');
            echo "
                                                     ";
            // line 120
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idPaisNacimiento"), array(), "array"), 'errors')) > 0)) {
                // line 121
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 122
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idPaisNacimiento"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 125
            echo "                                                    </td>
                                                    <td>";
            // line 126
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoNacimiento"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t\t ";
            // line 127
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoNacimiento"), array(), "array"), 'errors')) > 0)) {
                // line 128
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 129
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoNacimiento"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 132
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 135
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioNacimiento"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t       ";
            // line 136
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioNacimiento"), array(), "array"), 'errors')) > 0)) {
                // line 137
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 138
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioNacimiento"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 140
            echo "\t\t\t\t\t\t      
                                                    </td>
                                                    <td>";
            // line 142
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idNacionalidad"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t\t";
            // line 143
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idNacionalidad"), array(), "array"), 'errors')) > 0)) {
                // line 144
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 145
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idNacionalidad"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 147
            echo "\t
                                                    </td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">C.Datos de Identificación</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 154
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocPaciente"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 155
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocPaciente"), array(), "array"), 'errors')) > 0)) {
                // line 156
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 157
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocPaciente"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t      ";
            }
            // line 160
            echo "                                                    </td>
                                                    <td>";
            // line 161
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numeroDocIdePaciente"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 164
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEstadoCivil"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t\t ";
            // line 165
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEstadoCivil"), array(), "array"), 'errors')) > 0)) {
                // line 166
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 167
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEstadoCivil"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t      ";
            }
            // line 170
            echo "                                                    </td>
                                                    <td>";
            // line 171
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idOcupacion"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t\t";
            // line 172
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idOcupacion"), array(), "array"), 'errors')) > 0)) {
                // line 173
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 174
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idOcupacion"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t      ";
            }
            // line 177
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"4\">";
            // line 180
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "direccion"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id=\"sonata-ba-field-container-numeroAmbientes\" class=\"control-group\">
                                                            <label class=\" control-label\">País Domicilio:</label>
                                                            <div class=\"controls sonata-ba-field sonata-ba-field-standard-natural \">
                                                                <select id=\"idPaisDomicilio\" name=\"idPaisDomicilio\">
                                                                </select></td>
                                                            </div>
                                                        </div>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 194
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoDomicilio"), array(), "array"), 'row');
            echo "
                                                       ";
            // line 195
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoDomicilio"), array(), "array"), 'errors')) > 0)) {
                // line 196
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 197
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoDomicilio"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t      ";
            }
            // line 199
            echo "                                                    
                                                    </td>
                                                    <td>";
            // line 201
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioDomicilio"), array(), "array"), 'row');
            echo "
                                                    ";
            // line 202
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioDomicilio"), array(), "array"), 'errors')) > 0)) {
                // line 203
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 204
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioDomicilio"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 207
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 210
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "areaGeograficaDomicilio"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 211
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "areaGeograficaDomicilio"), array(), "array"), 'errors')) > 0)) {
                // line 212
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 213
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "areaGeograficaDomicilio"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 216
            echo "                                                    </td>
                                                    <td>";
            // line 217
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCantonDomicilio"), array(), "array"), 'row');
            echo "
                                                    ";
            // line 218
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCantonDomicilio"), array(), "array"), 'errors')) > 0)) {
                // line 219
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 220
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCantonDomicilio"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 222
            echo "                                                    
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 226
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "telefonoCasa"), array(), "array"), 'row');
            echo "</td>
                                                    <td></td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">D.Datos Laborales</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 233
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "asegurado"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 234
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAreaCotizacion"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 235
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAreaCotizacion"), array(), "array"), 'errors')) > 0)) {
                // line 236
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 237
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAreaCotizacion"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 239
            echo "   
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 243
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "cotizante"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 244
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numeroAfiliacion"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 247
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "lugarTrabajo"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 248
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "telefonoTrabajo"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">E.Datos Familiares</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 254
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombrePadre"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 255
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombreMadre"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td >";
            // line 258
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombreConyuge"), array(), "array"), 'row');
            echo "</td><td></td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 261
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoResponsable"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 262
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoResponsable"), array(), "array"), 'errors')) > 0)) {
                // line 263
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 264
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoResponsable"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 266
            echo "   
                                                    </td>
                                                    <td>";
            // line 268
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombreResponsable"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 271
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "telefonoResponsable"), array(), "array"), 'row');
            echo "</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 275
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocResponsable"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 276
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocResponsable"), array(), "array"), 'errors')) > 0)) {
                // line 277
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 278
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocResponsable"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 280
            echo "   
                                                    </td>
                                                    <td>";
            // line 282
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numeroDocIdeResponsable"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"4\">";
            // line 285
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "direccionResponsable"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">F.Persona que Proporcionó Datos</td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"4\">
                                                        ";
            // line 292
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoProporDatos"), array(), "array"), 'row');
            echo "
                                                         ";
            // line 293
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoProporDatos"), array(), "array"), 'errors')) > 0)) {
                // line 294
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 295
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoProporDatos"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 297
            echo " 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td >";
            // line 301
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombreProporcionoDatos"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 302
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocProporcionoDatos"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t       ";
            // line 303
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocProporcionoDatos"), array(), "array"), 'errors')) > 0)) {
                // line 304
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 305
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocProporcionoDatos"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 307
            echo " 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 311
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numeroDocIdeProporDatos"), array(), "array"), 'row');
            echo "</td>
                                                    <td></td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">G.Otros</td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"4\">";
            // line 318
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "observacion"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                ";
            // line 320
            if (array_key_exists("procedencia", $context)) {
                // line 321
                echo "                                                    ";
                if (((isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")) != "e")) {
                    // line 322
                    echo "                                                        <tr class=\"dat_paciente_sec\">
                                                            <td colspan=\"4\">H.Número de Expediente</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan=\"4\" >";
                    // line 327
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "expedientes"), array(), "array"), 'row');
                    echo "</td>
                                                        </tr>
                                                    ";
                }
                // line 330
                echo "                                                    <input type=\"hidden\" id=\"procedencia\" name=\"procedencia\" value=\"";
                echo twig_escape_filter($this->env, (isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")), "html", null, true);
                echo "\"/>
                                                ";
            } else {
                // line 332
                echo "                                                    <tr class=\"dat_paciente_sec\">
                                                        <td colspan=\"4\">H.Número de Expediente</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan=\"4\" >";
                // line 337
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "expedientes"), array(), "array"), 'row');
                echo "</td>
                                                    </tr>
                                                    <input type=\"hidden\" id=\"procedencia\" name=\"procedencia\" value=\"c\"/>
                                                ";
            }
            // line 341
            echo "                                            </table>
                                        </center>
                                    </div>
                                </div>
                                ";
            // line 346
            echo "                            </div>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 349
        echo "                ";
    }

    // line 351
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 352
        echo "                </div>
            ";
    }

    // line 357
    public function block_formactions($context, array $blocks = array())
    {
        // line 358
        echo "                <div class=\"well well-small form-actions\">
                    ";
        // line 359
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 360
            echo "                        ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 361
                echo "                            <button type=\"submit\" class=\"btn btn-success\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
                        ";
            } else {
                // line 363
                echo "                            <button type=\"submit\" class=\"btn btn-success\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
                        ";
            }
            // line 365
            echo "                    ";
        } else {
            // line 366
            echo "                        ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 367
                echo "                            <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                                <i class=\"fa fa-eye\"></i>
                                ";
                // line 369
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                            </button>
                        ";
            }
            // line 372
            echo "                        ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 373
                echo "                            <button type=\"submit\" class=\"btn btn-success\" name=\"btn_update_and_edit\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_and_edit_again", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>

                           
                            ";
                // line 376
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 377
                    echo "                                <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                            ";
                }
                // line 379
                echo "                        ";
            } else {
                // line 380
                echo "                            ";
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 381
                    echo "                                <button type=\"submit\" class=\"btn btn-success\" name=\"btn_create_and_list\"><i class=\"fa fa-save\"></i> Guardar</button>
                            ";
                }
                // line 383
                echo "                        ";
            }
            // line 384
            echo "                    ";
        }
        // line 385
        echo "                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntPacienteAdmin:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  874 => 376,  854 => 367,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 352,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 322,  763 => 321,  746 => 311,  740 => 307,  734 => 305,  731 => 304,  729 => 303,  721 => 301,  715 => 297,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 266,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 226,  547 => 220,  520 => 210,  450 => 173,  408 => 156,  363 => 136,  359 => 135,  348 => 129,  345 => 128,  336 => 125,  316 => 116,  307 => 112,  261 => 87,  266 => 87,  542 => 218,  538 => 217,  527 => 173,  509 => 204,  499 => 157,  493 => 155,  479 => 154,  473 => 152,  414 => 137,  406 => 155,  280 => 75,  223 => 69,  585 => 224,  551 => 208,  546 => 206,  506 => 203,  503 => 193,  488 => 168,  485 => 195,  478 => 165,  475 => 164,  471 => 157,  448 => 172,  386 => 127,  378 => 142,  375 => 90,  306 => 109,  291 => 87,  286 => 85,  392 => 107,  332 => 145,  318 => 83,  276 => 67,  190 => 54,  12 => 36,  195 => 92,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 383,  890 => 381,  887 => 380,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 295,  706 => 294,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 246,  613 => 232,  610 => 198,  608 => 248,  605 => 196,  602 => 230,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 167,  496 => 199,  441 => 170,  438 => 140,  432 => 166,  428 => 172,  422 => 150,  416 => 123,  395 => 118,  391 => 109,  382 => 143,  372 => 89,  364 => 98,  353 => 96,  335 => 92,  333 => 93,  297 => 84,  292 => 82,  205 => 96,  200 => 94,  184 => 87,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 377,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 330,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 293,  701 => 180,  699 => 179,  696 => 178,  690 => 285,  687 => 173,  681 => 205,  673 => 165,  671 => 277,  668 => 163,  663 => 160,  658 => 271,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 261,  629 => 141,  627 => 258,  624 => 139,  620 => 182,  614 => 133,  599 => 181,  594 => 243,  592 => 126,  589 => 124,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 195,  567 => 110,  554 => 185,  552 => 164,  544 => 219,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 159,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 148,  446 => 143,  443 => 142,  429 => 116,  425 => 64,  410 => 59,  397 => 55,  394 => 54,  389 => 128,  357 => 37,  342 => 149,  334 => 26,  330 => 122,  328 => 103,  290 => 101,  287 => 71,  263 => 86,  255 => 84,  245 => 80,  194 => 55,  76 => 7,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 372,  860 => 280,  856 => 279,  852 => 278,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 255,  617 => 254,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 244,  595 => 205,  586 => 200,  582 => 237,  580 => 197,  572 => 218,  568 => 173,  562 => 190,  556 => 186,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 191,  492 => 182,  481 => 194,  476 => 163,  467 => 156,  451 => 155,  424 => 115,  418 => 148,  412 => 136,  399 => 112,  396 => 135,  390 => 133,  388 => 132,  383 => 104,  377 => 104,  373 => 46,  370 => 100,  367 => 102,  352 => 155,  349 => 101,  346 => 95,  329 => 111,  326 => 86,  313 => 126,  303 => 103,  300 => 13,  234 => 58,  218 => 98,  207 => 61,  178 => 184,  321 => 119,  295 => 11,  274 => 79,  242 => 110,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 268,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 226,  583 => 334,  579 => 236,  577 => 235,  575 => 252,  569 => 233,  565 => 109,  548 => 207,  540 => 205,  536 => 95,  529 => 213,  524 => 211,  516 => 143,  510 => 196,  504 => 202,  500 => 201,  490 => 197,  486 => 136,  482 => 285,  470 => 131,  464 => 180,  459 => 177,  452 => 145,  434 => 256,  421 => 114,  417 => 160,  385 => 107,  361 => 97,  344 => 94,  339 => 126,  324 => 142,  310 => 113,  302 => 131,  296 => 89,  282 => 83,  259 => 118,  244 => 111,  231 => 75,  226 => 102,  114 => 39,  104 => 25,  288 => 107,  284 => 98,  279 => 96,  275 => 95,  256 => 65,  250 => 123,  237 => 116,  232 => 249,  222 => 100,  215 => 66,  191 => 54,  153 => 72,  563 => 176,  560 => 187,  558 => 186,  555 => 210,  553 => 222,  549 => 182,  543 => 189,  537 => 204,  532 => 175,  528 => 173,  525 => 201,  523 => 181,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 175,  491 => 157,  487 => 196,  460 => 147,  455 => 156,  449 => 138,  442 => 153,  439 => 71,  436 => 151,  433 => 117,  426 => 164,  420 => 161,  415 => 144,  411 => 157,  405 => 114,  403 => 133,  400 => 233,  380 => 112,  366 => 169,  354 => 132,  331 => 105,  325 => 120,  320 => 91,  317 => 90,  311 => 85,  308 => 123,  304 => 85,  272 => 89,  267 => 90,  249 => 63,  216 => 99,  155 => 50,  152 => 49,  146 => 46,  126 => 38,  181 => 48,  161 => 53,  110 => 29,  188 => 90,  186 => 51,  170 => 355,  150 => 71,  124 => 37,  358 => 96,  351 => 102,  347 => 134,  343 => 127,  338 => 112,  327 => 121,  323 => 92,  319 => 124,  315 => 82,  301 => 110,  299 => 90,  293 => 88,  289 => 81,  281 => 97,  277 => 74,  271 => 94,  265 => 76,  262 => 76,  260 => 85,  257 => 56,  251 => 83,  248 => 71,  239 => 68,  228 => 103,  225 => 162,  213 => 69,  211 => 64,  197 => 72,  174 => 85,  148 => 49,  134 => 55,  127 => 66,  20 => 1,  53 => 6,  270 => 70,  253 => 71,  233 => 104,  212 => 98,  210 => 97,  206 => 74,  202 => 95,  198 => 56,  192 => 90,  185 => 61,  180 => 83,  175 => 357,  172 => 42,  167 => 354,  165 => 351,  160 => 54,  137 => 63,  113 => 51,  100 => 24,  90 => 25,  81 => 8,  129 => 39,  84 => 19,  77 => 20,  34 => 6,  118 => 53,  97 => 32,  70 => 14,  65 => 35,  58 => 7,  23 => 5,  480 => 134,  474 => 80,  469 => 150,  461 => 157,  457 => 153,  453 => 174,  444 => 171,  440 => 148,  437 => 118,  435 => 167,  430 => 165,  427 => 65,  423 => 63,  413 => 241,  409 => 135,  407 => 238,  402 => 154,  398 => 92,  393 => 147,  387 => 145,  384 => 144,  381 => 109,  379 => 119,  374 => 140,  368 => 138,  365 => 137,  362 => 97,  360 => 38,  355 => 95,  341 => 93,  337 => 90,  322 => 109,  314 => 86,  312 => 149,  309 => 79,  305 => 111,  298 => 12,  294 => 98,  285 => 79,  283 => 76,  278 => 331,  268 => 77,  264 => 68,  258 => 66,  252 => 53,  247 => 273,  241 => 79,  229 => 111,  220 => 99,  214 => 62,  177 => 387,  169 => 33,  140 => 44,  132 => 59,  128 => 57,  107 => 36,  61 => 15,  273 => 71,  269 => 91,  254 => 85,  243 => 89,  240 => 263,  238 => 84,  235 => 76,  230 => 61,  227 => 104,  224 => 101,  221 => 79,  219 => 64,  217 => 67,  208 => 96,  204 => 53,  179 => 86,  159 => 75,  143 => 48,  135 => 42,  119 => 59,  102 => 30,  71 => 10,  67 => 4,  63 => 3,  59 => 17,  38 => 4,  94 => 38,  89 => 29,  85 => 23,  75 => 24,  68 => 16,  56 => 13,  201 => 91,  196 => 56,  183 => 50,  171 => 128,  166 => 82,  163 => 81,  158 => 37,  156 => 78,  151 => 77,  142 => 74,  138 => 43,  136 => 47,  121 => 64,  117 => 40,  105 => 45,  91 => 41,  62 => 8,  49 => 34,  28 => 13,  26 => 6,  87 => 34,  31 => 14,  25 => 10,  21 => 1,  24 => 1,  19 => 1,  93 => 26,  88 => 24,  78 => 24,  46 => 9,  44 => 7,  27 => 4,  79 => 25,  72 => 25,  69 => 15,  47 => 8,  40 => 11,  37 => 7,  22 => 4,  246 => 122,  157 => 53,  145 => 74,  139 => 71,  131 => 60,  123 => 43,  120 => 35,  115 => 53,  111 => 22,  108 => 47,  101 => 33,  98 => 34,  96 => 23,  83 => 22,  74 => 19,  66 => 14,  55 => 1,  52 => 9,  50 => 5,  43 => 27,  41 => 7,  35 => 9,  32 => 15,  29 => 15,  209 => 127,  203 => 72,  199 => 56,  193 => 55,  189 => 51,  187 => 48,  182 => 87,  176 => 85,  173 => 35,  168 => 91,  164 => 79,  162 => 350,  154 => 36,  149 => 62,  147 => 75,  144 => 60,  141 => 65,  133 => 68,  130 => 44,  125 => 46,  122 => 56,  116 => 34,  112 => 70,  109 => 32,  106 => 31,  103 => 35,  99 => 29,  95 => 41,  92 => 37,  86 => 30,  82 => 31,  80 => 19,  73 => 15,  64 => 15,  60 => 14,  57 => 16,  54 => 18,  51 => 12,  48 => 11,  45 => 22,  42 => 8,  39 => 2,  36 => 1,  33 => 3,  30 => 2,);
    }
}
