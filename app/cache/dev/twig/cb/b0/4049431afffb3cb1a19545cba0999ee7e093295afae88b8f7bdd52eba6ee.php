<?php

/* ApplicationCoreBundle::index.html.twig */
class __TwigTemplate_cbb04049431afffb3cb1a19545cba0999ee7e093295afae88b8f7bdd52eba6ee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <link href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/escudo.png"), "html", null, true);
        echo "\" type=\"image/png\" rel=\"Shortcut Icon\" />
        <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/seleccion_modulo.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
        <!-- Latest compiled and minified CSS -->
        <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap3/css/bootstrap.min.css"), "html", null, true);
        echo "\">
        <!-- Optional theme -->
        <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap3/css/bootstrap-theme.min.css"), "html", null, true);
        echo "\">
        <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-1.10.2.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-ui-1.10.4.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-ui-i18n.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap3/js/bootstrap.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                \$('.carousel').carousel({
                    interval: 3000
                });
            });
        </script>
        <title>Ministerio de Salud de El Salvador</title>
    </head>
    <body>
        <div id=\"pagina\">
            <div id=\"pagina-content\">
                <div id=\"content\">
                    <center>
                        <table>
                            <tr><td id=\"cont-title\"><b>El Salvador<br />Ministerio de Salud<br />Sistema Integral de Atención al Paciente</b></td></tr>
                            <tr><td id=\"cont-body\">
                                    <div class=\"box-shadow\">
                                        <a href=\"";
        // line 35
        echo twig_escape_filter($this->env, (((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule"))) ? ($this->getAttribute((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule")), "module1")) : ("#")), "html", null, true);
        echo "\">
                                            <div class=\"module module1\"></div>
                                        </a>
                                        <a href=\"";
        // line 38
        echo twig_escape_filter($this->env, (((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule"))) ? ($this->getAttribute((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule")), "module2")) : ("#")), "html", null, true);
        echo "\">
                                            <div class=\"module module2\"></div>
                                        </a>
                                        <a href=\"";
        // line 41
        echo twig_escape_filter($this->env, (((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule"))) ? ($this->getAttribute((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule")), "module6")) : ("#")), "html", null, true);
        echo "\">
                                            <div class=\"module module6\"></div>
                                        </a>
                                        <a href=\"";
        // line 44
        echo twig_escape_filter($this->env, (((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule"))) ? ($this->getAttribute((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule")), "module3")) : ("#")), "html", null, true);
        echo "\">
                                            <div class=\"module module3\"></div>
                                        </a>
                                        <a href=\"";
        // line 47
        echo twig_escape_filter($this->env, (((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule"))) ? ($this->getAttribute((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule")), "module4")) : ("#")), "html", null, true);
        echo "\">
                                            <div class=\"module module4\"></div>
                                        </a>
                                        <a href=\"";
        // line 50
        echo twig_escape_filter($this->env, (((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule"))) ? ($this->getAttribute((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule")), "module5")) : ("#")), "html", null, true);
        echo "\">
                                            <div class=\"module module5\"></div>
                                        </a>
                                        <a href=\"";
        // line 53
        echo twig_escape_filter($this->env, (((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule"))) ? ($this->getAttribute((isset($context["urlModule"]) ? $context["urlModule"] : $this->getContext($context, "urlModule")), "module8")) : ("#")), "html", null, true);
        echo "\">
                                            <div class=\"module module8\"></div>
                                        </a>
                                        <div id=\"cover-carousel\" class=\"carousel slide\" data-ride=\"carousel\">
                                            <!-- Indicators -->
                                            <ol class=\"carousel-indicators\">
                                                <li data-target=\"#cover-carousel\" data-slide-to=\"0\" class=\"active\"></li>
                                                <li data-target=\"#cover-carousel\" data-slide-to=\"1\"></li>
                                                <li data-target=\"#cover-carousel\" data-slide-to=\"2\"></li>
                                                <li data-target=\"#cover-carousel\" data-slide-to=\"3\"></li>
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class=\"carousel-inner\">
                                                <div class=\"item active\">
                                                    <img src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/cover01.png"), "html", null, true);
        echo "\" alt=\"img01\">
                                                </div>
                                                <div class=\"item\">
                                                    <img src=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/cover02.png"), "html", null, true);
        echo "\" alt=\"img02\">
                                                </div>
                                                <div class=\"item\">
                                                    <img src=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/cover03.png"), "html", null, true);
        echo "\" alt=\"img03\">
                                                </div>
                                                <div class=\"item\">
                                                    <img src=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/cover04.png"), "html", null, true);
        echo "\" alt=\"img04\">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr><td id=\"cont-footer\"><div id=\"footer\"></div></td></tr>
                        </table>
                    </center>
                </div>
            </div>
        </div>
        <div class=\"page-footer\">
                <img class=\"dtic-footer\" src=\"";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/dtic.png"), "html", null, true);
        echo "\" alt=\"dtic\"/>Dirección de Tecnologías de Información y Comunicaciones - Ministerio de Salud
            </div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "ApplicationCoreBundle::index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  168 => 91,  151 => 77,  145 => 74,  139 => 71,  133 => 68,  115 => 53,  109 => 50,  103 => 47,  97 => 44,  91 => 41,  85 => 38,  79 => 35,  57 => 16,  52 => 14,  48 => 13,  44 => 12,  40 => 11,  35 => 9,  30 => 7,  26 => 6,  19 => 1,);
    }
}
