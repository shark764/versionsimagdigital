<?php

/* SonataUserBundle:ChangePassword:changePassword.html.twig */
class __TwigTemplate_1dc1a0968f904315f0f162be1b8134735e60d3ebe83fbed5312cd960d0f641d0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataUserBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <style type=\"text/css\">
        .ui-front {
            z-index: 1030 !important;
        }
    </style>
";
    }

    // line 12
    public function block_javascripts($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
        \$(document).ready(function() {
            \$(\"#guardar\").click(function() {
                if (\$(\"#fos_user_change_password_form_new_first\").val() != \$(\"#fos_user_change_password_form_new_second\").val()) {
                    \$(\"#fos_user_change_password_form_new_first\").val('');
                    \$(\"#fos_user_change_password_form_new_second\").val('');
                    \$(\"#fos_user_change_password_form_new_first\").focus();

                    \$(\"body\").append('<div id=\"dialog-message\"></div>');
                    \$(\"#dialog-message\").empty();
                    \$(\"#dialog-message\").append('<p><span class=\"glyphicon glyphicon-exclamation-sign\"></span> Los campos de la nueva contraseña no coinciden.<br /><strong>Por favor vuelva a digitarlas</strong></p>');
                    \$(\"#dialog-message\").dialog({
                        dialogClass: \"dialog-error\",
                        modal: true,
                        title: 'Contraseñas no coinciden.',
                        width: 500,
                        buttons: {
                            Aceptar: function() {
                                \$( this ).dialog( \"close\" );
                            }
                        }
                    });
                    
                    return false;
                }

            });
        });

    </script>
";
    }

    // line 46
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 47
        echo "    <center>
        <form action=\"";
        // line 48
        echo $this->env->getExtension('routing')->getPath("fos_user_change_password");
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo " method=\"POST\" class=\"fos_user_change_password\">
            <table style=\"border-collapse: separate; border-spacing: 10px;\">
                <tr>
                    <td>";
        // line 51
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "current_password"), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "</td>
                    <td>";
        // line 52
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "current_password"), 'widget');
        echo "</td>
                </tr>
                <tr>
                    <td>";
        // line 55
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new"), "first"), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "</td>
                    <td>";
        // line 56
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new"), "first"), 'widget');
        echo "</td>
                </tr>
                <tr>
                    <td>";
        // line 59
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new"), "second"), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "</td>
                    <td>";
        // line 60
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new"), "second"), 'widget');
        echo "</td>
                </tr>
            </table>
            ";
        // line 63
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
            <div>
                <button id=\"guardar\" type=\"submit\" class=\"btn btn-primary\">
                    <span class=\"glyphicon glyphicon-ok\"></span> ";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("change_password.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "
                </button>
                <a class=\"btn btn-info\" href=\"";
        // line 68
        echo $this->env->getExtension('routing')->getPath("_inicio");
        echo "\">
                    <span class=\"glyphicon glyphicon-home\"></span> Regresar
                </a>
            </div>
        </form>
    </center>
";
    }

    public function getTemplateName()
    {
        return "SonataUserBundle:ChangePassword:changePassword.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 68,  135 => 66,  129 => 63,  123 => 60,  119 => 59,  113 => 56,  109 => 55,  103 => 52,  99 => 51,  91 => 48,  88 => 47,  85 => 46,  48 => 13,  45 => 12,  33 => 4,  30 => 3,);
    }
}
