<?php

/* SonataUserBundle:Admin:Security/login.html.twig */
class __TwigTemplate_5d307d87273253cbe15983f1e9ed27052a575cec927019ea3efc5eb6d62750de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_nav' => array($this, 'block_sonata_nav'),
            'sonata_header' => array($this, 'block_sonata_header'),
            'logo' => array($this, 'block_logo'),
            'sonata_left_side' => array($this, 'block_sonata_left_side'),
            'body_attributes' => array($this, 'block_body_attributes'),
            'sonata_wrapper' => array($this, 'block_sonata_wrapper'),
            'sonata_user_login_form' => array($this, 'block_sonata_user_login_form'),
            'sonata_user_login_error' => array($this, 'block_sonata_user_login_error'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/corelogin.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 9
    public function block_javascripts($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            \$('body').append('</div>');

            \$('#_digitalSignature').on('change', function() {
                var file = this.files[0];
                var name = file.name;
                var size = file.size;
                var type = file.type;

                if(type !== 'application/x-pkcs12') {
                    \$(this).val('');
                    \$('#fileInfo').val('');
                    if(\$('div#dialog-message').length == 0) {
                        \$('body').append('<div id=\"dialog-message\"></div>');
                    } else {
                        \$('#dialog-message').empty();
                    }

                    \$(\"#dialog-message\").append('<p><i class=\"icon-warning-sign\" style=\"margin-right:7px;\"></i>\\
                                         El archivo seleccionado no es un archivo de tipo <b>Firma digital</b> cuya extensi&oacute;n debe ser <b>.p12</b>,\\
                                         <br />Por favor seleccione un nuevo archivo.</p>');

                    \$(\"#dialog-message\").dialog({
                        dialogClass: \"dialog-warning\",
                        modal: true,
                        title: 'Tipo de archivo incorrecto!!!',
                        buttons: {
                            Cerrar: function() {
                                    \$( this ).dialog( \"close\" );
                            }
                        }
                    });
                } else {
                    \$('#fileInfo').val(\$(this).val().replace(\"C:\\\\fakepath\\\\\", \"\"));
                }
            });

            ";
        // line 50
        if (array_key_exists("module", $context)) {
            // line 51
            echo "                var url = window.location;
                //truco para añadir a la url el modulo seleccionado en la primera pagina de login
                if(window.location.href.indexOf('_moduleSelection') == -1) {
                    window.history.replaceState(\"object or string\", \"Title\", \"?";
            // line 54
            echo twig_escape_filter($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), "html", null, true);
            echo "\");
                }
            ";
        }
        // line 57
        echo "        });
    </script>
";
    }

    // line 61
    public function block_sonata_nav($context, array $blocks = array())
    {
    }

    // line 64
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 65
        echo "    <div id=\"wrapper\">
        <header class=\"header\">
            ";
        // line 67
        $this->displayBlock('logo', $context, $blocks);
        // line 70
        echo "        </header>
";
    }

    // line 67
    public function block_logo($context, array $blocks = array())
    {
        // line 68
        echo "                <center><img class=\"banner\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/banner.png"), "html", null, true);
        echo "\" alt=\"Ministerio de Salud banner\" /></center>
            ";
    }

    // line 73
    public function block_sonata_left_side($context, array $blocks = array())
    {
    }

    // line 76
    public function block_body_attributes($context, array $blocks = array())
    {
        echo "class=\"sonata-bc bg-black\"";
    }

    // line 78
    public function block_sonata_wrapper($context, array $blocks = array())
    {
        // line 79
        echo "prueba
    <div class=\"form-box\" id=\"login-box\">
        <div class=\"header\">";
        // line 81
        echo "</div>
        ";
        // line 82
        $this->displayBlock('sonata_user_login_form', $context, $blocks);
        // line 127
        echo "    </div>
    <div class=\"page-footer\"><img class=\"dtic-footer\" src=\"";
        // line 128
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/dtic.png"), "html", null, true);
        echo "\" alt=\"dtic\"/>Direcci&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n y Comunicaciones - Ministerio de Salud</div>
";
    }

    // line 82
    public function block_sonata_user_login_form($context, array $blocks = array())
    {
        // line 83
        echo "            <form action=\"";
        echo $this->env->getExtension('routing')->getPath("sonata_user_admin_security_check");
        echo "\" method=\"post\" role=\"form\" enctype=\"multipart/form-data\">
                <div class=\"body bg-gray\">
                    ";
        // line 85
        $this->displayBlock('sonata_user_login_error', $context, $blocks);
        // line 90
        echo "
                    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 91
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\"/>
                    <input type=\"hidden\" name=\"_moduleSelection\" value=\"";
        // line 92
        echo twig_escape_filter($this->env, twig_slice($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), (-1), 1), "html", null, true);
        echo "\" />
                    <div class=\"form-group control-group\">
                        ";
        // line 94
        if ((((twig_slice($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), (-1), 1) != "3") && (twig_slice($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), (-1), 1) != "4")) && (twig_slice($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), (-1), 1) != "6"))) {
            // line 95
            echo "                            <label for=\"username\" style=\"text-align:left;\">Nombre de Usuario</label>
                            <input type=\"text\" class=\"form-control\" id=\"username\"  name=\"_username\" value=\"";
            // line 96
            echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
            echo "\" required=\"required\" placeholder=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "SonataUserBundle"), "html", null, true);
            echo "\"/>
                        ";
        } else {
            // line 98
            echo "                            <label for=\"digtalSignature\" style=\"text-align:left;\">Firma digital</label>
                            <div class=\"custom_file_upload form-control\">
                                <input type=\"text\" id=\"fileInfo\" class=\"file_info\" placeholder=\"Seleccionar firma digital\" name=\"_username\" readonly />
                                <div class=\"file_upload\">
                                    <input type=\"file\" id=\"_digitalSignature\" name=\"_digitalSignature\" />
                                </div>
                            </div>
                        ";
        }
        // line 106
        echo "                    </div>


                    <div class=\"form-group control-group\">
                        <label>Contrase&ntilde;a</label>
                        <input type=\"password\" class=\"form-control\" id=\"password\" name=\"_password\" required=\"required\" placeholder=\"";
        // line 111
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "SonataUserBundle"), "html", null, true);
        echo "\"/>
                    </div>

                    <!--<div class=\"form-group\">
                        <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"/>
                        ";
        // line 116
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
                    </div>-->

                </div>

                <div class=\"footer\">
                    <center><button type=\"submit\" id=\"_submit\" name=\"_submit\" class=\"btn btn-primary btn-block\">";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "</button></center>
                    <!--<p><a href=\"";
        // line 123
        echo $this->env->getExtension('routing')->getPath("fos_user_resetting_request");
        echo "\" class=\"text-center\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("forgotten_password", array(), "SonataUserBundle"), "html", null, true);
        echo "</a></p>-->
                </div>
            </form>
        ";
    }

    // line 85
    public function block_sonata_user_login_error($context, array $blocks = array())
    {
        // line 86
        echo "                        ";
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 87
            echo "                            <div class=\"alert alert-danger alert-error\">";
            echo $this->env->getExtension('translator')->trans((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), array(), "FOSUserBundle");
            echo "</div>
                        ";
        }
        // line 89
        echo "                    ";
    }

    public function getTemplateName()
    {
        return "SonataUserBundle:Admin:Security/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  272 => 89,  266 => 87,  263 => 86,  260 => 85,  250 => 123,  246 => 122,  237 => 116,  229 => 111,  222 => 106,  212 => 98,  205 => 96,  202 => 95,  200 => 94,  195 => 92,  191 => 91,  188 => 90,  186 => 85,  180 => 83,  177 => 82,  171 => 128,  168 => 127,  166 => 82,  163 => 81,  159 => 79,  156 => 78,  150 => 76,  145 => 73,  138 => 68,  135 => 67,  130 => 70,  128 => 67,  124 => 65,  121 => 64,  116 => 61,  110 => 57,  104 => 54,  99 => 51,  97 => 50,  53 => 10,  50 => 9,  44 => 6,  38 => 4,  35 => 3,);
    }
}
