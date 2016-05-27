<?php

/* SonataAdminBundle::layout.html.twig */
class __TwigTemplate_30175162618ecab5fedd3f04309c0bf5fa8e7b893939148e4c4421bcbe794aae extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::standard_layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_header' => array($this, 'block_sonata_header'),
            'logo' => array($this, 'block_logo'),
            'sonata_nav' => array($this, 'block_sonata_nav'),
            'sonata_side_nav' => array($this, 'block_sonata_side_nav'),
            'side_bar_before_nav' => array($this, 'block_side_bar_before_nav'),
            'side_bar_nav' => array($this, 'block_side_bar_nav'),
            'custom_menu' => array($this, 'block_custom_menu'),
            'side_bar_after_nav' => array($this, 'block_side_bar_after_nav'),
            'sonata_top_nav_menu' => array($this, 'block_sonata_top_nav_menu'),
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'sonata_left_side' => array($this, 'block_sonata_left_side'),
            'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::standard_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/escudo.png"), "html", null, true);
        echo "\" type=\"image/png\" rel=\"Shortcut Icon\">
    ";
        // line 5
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamarkitup/markitup/markitup/skins/sonata/style.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamarkitup/markitup/markitup/sets/markdown/style.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamarkitup/markitup/markitup/sets/html/style.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamarkitup/markitup/markitup/sets/textile/style.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/siaps.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    ";
        // line 12
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getId", array(), "method", true, true)) {
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/corelayout.css"), "html", null, true);
            echo "\" type=\"text/css\" media=\"all\" />";
        }
        // line 13
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/fullcalendar/fullcalendar.css"), "html", null, true);
        echo "\" />
";
    }

    // line 16
    public function block_javascripts($context, array $blocks = array())
    {
        // line 17
        echo "    <script>
        window.SONATA_CONFIG = {
            CONFIRM_EXIT: ";
        // line 19
        echo "false,
            USE_SELECT2: ";
        // line 20
        if ((array_key_exists("admin_pool", $context) && $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "use_select2"), "method"))) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
            USE_ICHECK: ";
        // line 21
        if ((array_key_exists("admin_pool", $context) && $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "use_icheck"), "method"))) {
            echo "true";
        } else {
            echo "false";
        }
        // line 22
        echo "        };
        window.SONATA_TRANSLATIONS = {
            CONFIRM_EXIT:  '";
        // line 24
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("confirm_exit", array(), "SonataAdminBundle"), "js"), "html", null, true);
        echo "'
        };
    </script>

    ";
        // line 28
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "javascripts", 1 => array()), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["javascript"]) {
            // line 29
            echo "        <script src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((isset($context["javascript"]) ? $context["javascript"] : $this->getContext($context, "javascript"))), "html", null, true);
            echo "\" type=\"text/javascript\"></script>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['javascript'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "
    <script src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/ivoryckeditor/ckeditor.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamarkitup/markitup/markitup/jquery.markitup.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamarkitup/markitup/markitup/sets/markdown/set.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamarkitup/markitup/markitup/sets/html/set.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatamarkitup/markitup/markitup/sets/textile/set.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/fosjsrouting/js/router.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 38
        echo $this->env->getExtension('routing')->getPath("fos_js_routing_js", array("callback" => "fos.Router.setData"));
        echo "\"></script>

    <!--Adesigns Bundle-->
    <script type=\"text/javascript\" src=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/js/fullcalendar/fullcalendar.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/funciones_generales.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>

    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            \$('body').removeClass('skin-black');
            \$('aside.left-side').removeClass('left-side');
            ";
        // line 48
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getId", array(), "method", true, true)) {
            // line 49
            echo "                \$('body').append('<div class=\"page-footer\"><img class=\"dtic-footer\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/dtic.png"), "html", null, true);
            echo "\" alt=\"dtic\"/>Dirección de Tecnologías de Información y Comunicaciones - Ministerio de Salud</div>');
            ";
        }
        // line 51
        echo "        });
    </script>
";
    }

    // line 55
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 56
        echo "    <header class=\"header\">
        ";
        // line 57
        $this->displayBlock('logo', $context, $blocks);
        // line 72
        echo "
        ";
        // line 74
        echo "        ";
        $this->displayBlock('sonata_nav', $context, $blocks);
        // line 127
        echo "        ";
        // line 128
        echo "    </header>

    ";
        // line 131
        echo "    <div class=\"row";
        if ((twig_test_empty((isset($context["_breadcrumb"]) ? $context["_breadcrumb"] : $this->getContext($context, "_breadcrumb"))) && (!array_key_exists("action", $context)))) {
            echo " row-breadcrumb";
        }
        echo "\">
        <div class=\"col-md-12 breadcrumb\">
            ";
        // line 133
        $this->displayBlock('sonata_breadcrumb', $context, $blocks);
        // line 162
        echo "        </div>
    </div>
    ";
    }

    // line 57
    public function block_logo($context, array $blocks = array())
    {
        // line 58
        echo "            <center>
                <a class=\"logo\" href=\"";
        // line 59
        echo $this->env->getExtension('routing')->getUrl("sonata_admin_dashboard");
        echo "\">
                    <img class=\"banner\" src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/logo_siaps.png"), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "title"), "html", null, true);
        echo "\">
                </a>
            </center>
             ";
        // line 63
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")) {
            // line 64
            echo "                    <h1 class=\"establecimiento\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento", array(), "method"), "html", null, true);
            echo "</h1>
                    ";
            // line 65
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method")) {
                // line 66
                echo "                        <p class=\"usuario\"><strong>Bienvenid@:</strong>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getNombreempleado", array(), "method"), "html", null, true);
                echo "</p>
                    ";
            } else {
                // line 68
                echo "                        <p class=\"usuario\"><strong>Bienvenid@:</strong>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "html", null, true);
                echo "</p>
                    ";
            }
            // line 70
            echo "                ";
        }
        // line 71
        echo "        ";
    }

    // line 74
    public function block_sonata_nav($context, array $blocks = array())
    {
        // line 75
        echo "            ";
        if (array_key_exists("admin_pool", $context)) {
            // line 76
            echo "                <nav class=\"navbar navbar-static-top\" role=\"navigation\">
                    <div class=\"container-fluid\">
                        <div class=\"navbar-header\">
                            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#navbar-collapse-1\">
                                <span class=\"sr-only\">Toggle navigation</span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                            </button>
                            <a class=\"navbar-brand\" href=\"#\"></a>
                        </div>

                        <div class=\"navbar-left\">
                            <div class=\"collapse navbar-collapse\" id=\"navbar-collapse-1\">
                                ";
            // line 90
            $this->displayBlock('sonata_side_nav', $context, $blocks);
            // line 106
            echo "                            </div>
                        </div>

                        ";
            // line 109
            $this->displayBlock('sonata_top_nav_menu', $context, $blocks);
            // line 123
            echo "                    </div>    <!--Container Fluid-->
                </nav>
            ";
        }
        // line 126
        echo "        ";
    }

    // line 90
    public function block_sonata_side_nav($context, array $blocks = array())
    {
        // line 91
        echo "
                                    ";
        // line 92
        $this->displayBlock('side_bar_before_nav', $context, $blocks);
        // line 93
        echo "                                    ";
        $this->displayBlock('side_bar_nav', $context, $blocks);
        // line 103
        echo "                                    ";
        $this->displayBlock('side_bar_after_nav', $context, $blocks);
        // line 105
        echo "                                ";
    }

    // line 92
    public function block_side_bar_before_nav($context, array $blocks = array())
    {
        echo " ";
    }

    // line 93
    public function block_side_bar_nav($context, array $blocks = array())
    {
        // line 94
        echo "                                        ";
        // line 95
        echo "                                            ";
        $this->displayBlock('custom_menu', $context, $blocks);
        // line 101
        echo "                                        ";
        // line 102
        echo "                                    ";
    }

    // line 95
    public function block_custom_menu($context, array $blocks = array())
    {
        // line 96
        echo "                                                ";
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")) {
            // line 97
            echo "                                                    ";
            $context["cus_menu"] = $this->env->getExtension('knp_menu')->get("ApplicationCoreBundle:MenuBuilder:mainMenu", array(), array("admin" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "dashboardgroups"), "user" => $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")));
            // line 98
            echo "                                                        ";
            echo $this->env->getExtension('knp_menu')->render((isset($context["cus_menu"]) ? $context["cus_menu"] : $this->getContext($context, "cus_menu")), array("currentClass" => "active", "template" => "ApplicationCoreBundle:Menu:knp_menu.html.twig"));
            echo "
                                                ";
        }
        // line 100
        echo "                                            ";
    }

    // line 103
    public function block_side_bar_after_nav($context, array $blocks = array())
    {
        // line 104
        echo "                                    ";
    }

    // line 109
    public function block_sonata_top_nav_menu($context, array $blocks = array())
    {
        // line 110
        echo "                            <div class=\"navbar-right\">
                                <ul class=\"nav navbar-nav\">
                                    <li class=\"dropdown user-menu\">
                                        <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                                            <i class=\"fa fa-user fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                                        </a>
                                        <ul class=\"dropdown-menu dropdown-user\">
                                            ";
        // line 117
        $this->env->loadTemplate("SonataAdminBundle::user_block.html.twig")->display($context);
        // line 118
        echo "                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        ";
    }

    // line 133
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
        // line 134
        echo "                ";
        if (((!twig_test_empty((isset($context["_breadcrumb"]) ? $context["_breadcrumb"] : $this->getContext($context, "_breadcrumb")))) || array_key_exists("action", $context))) {
            // line 135
            echo "                    <ol class=\"nav navbar-top-links breadcrumb\">
                        ";
            // line 136
            if (twig_test_empty((isset($context["_breadcrumb"]) ? $context["_breadcrumb"] : $this->getContext($context, "_breadcrumb")))) {
                // line 137
                echo "                            ";
                if (array_key_exists("action", $context)) {
                    // line 138
                    echo "                                ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "breadcrumbs", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"));
                    $context['loop'] = array(
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    );
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
                        // line 139
                        echo "                                    ";
                        if ((!$this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "last"))) {
                            // line 140
                            echo "                                        <li>
                                            ";
                            // line 141
                            if ((!twig_test_empty($this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "uri")))) {
                                // line 142
                                echo "                                                ";
                                if ((($this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label") == "Dashboard") || ($this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label") == "⌂"))) {
                                    // line 143
                                    echo "                                                    <a href=\"";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "uri"), "html", null, true);
                                    echo "\"><span class=\"glyphicon glyphicon-home\"></span> </a>
                                                ";
                                } else {
                                    // line 145
                                    echo "                                                    <a href=\"";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "uri"), "html", null, true);
                                    echo "\">";
                                    echo $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label");
                                    echo "</a>
                                                ";
                                }
                                // line 147
                                echo "                                            ";
                            } else {
                                // line 148
                                echo "                                                ";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label"), "html", null, true);
                                echo "
                                            ";
                            }
                            // line 150
                            echo "                                        </li>
                                    ";
                        } else {
                            // line 152
                            echo "                                        <li class=\"active\"><span>";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), "label"), "html", null, true);
                            echo "</span></li>
                                    ";
                        }
                        // line 154
                        echo "                                ";
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['length'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 155
                    echo "                            ";
                }
                // line 156
                echo "                        ";
            } else {
                // line 157
                echo "                            ";
                echo (isset($context["_breadcrumb"]) ? $context["_breadcrumb"] : $this->getContext($context, "_breadcrumb"));
                echo "
                        ";
            }
            // line 159
            echo "                    </ol>
                ";
        }
        // line 161
        echo "            ";
    }

    // line 167
    public function block_sonata_left_side($context, array $blocks = array())
    {
    }

    // line 170
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 171
        echo "    ";
        if (((!twig_test_empty((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu")))) || (!twig_test_empty((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")))))) {
            // line 172
            echo "        <nav class=\"navbar navbar-default\" role=\"navigation\">
            ";
            // line 173
            if ((!twig_test_empty((isset($context["_navbar_title"]) ? $context["_navbar_title"] : $this->getContext($context, "_navbar_title"))))) {
                // line 174
                echo "                <div class=\"navbar-header\">
                    <span class=\"navbar-brand\">";
                // line 175
                echo (isset($context["_navbar_title"]) ? $context["_navbar_title"] : $this->getContext($context, "_navbar_title"));
                echo "</span>
                </div>
            ";
            }
            // line 178
            echo "            <div class=\"container-fluid\">
                <div class=\"navbar-left\">
                    ";
            // line 180
            if ((!twig_test_empty((isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"))))) {
                // line 181
                echo "                        ";
                echo (isset($context["_tab_menu"]) ? $context["_tab_menu"] : $this->getContext($context, "_tab_menu"));
                echo "
                    ";
            }
            // line 183
            echo "                </div>

                ";
            // line 185
            if ((!twig_test_empty(trim(strtr((isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions")), array("<li>" => "", "</li>" => "")))))) {
                // line 186
                echo "                    <ul class=\"nav navbar-nav navbar-right\">
                        <li class=\"dropdown sonata-actions\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Acci&oacute;n<b class=\"caret\"></b></a>
                            <ul class=\"dropdown-menu\" role=\"menu\">
                                ";
                // line 190
                echo (isset($context["_actions"]) ? $context["_actions"] : $this->getContext($context, "_actions"));
                echo "
                            </ul>
                        </li>
                    </ul>
                ";
            }
            // line 195
            echo "            </div>
        </nav>
    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  570 => 195,  562 => 190,  556 => 186,  554 => 185,  550 => 183,  544 => 181,  542 => 180,  538 => 178,  532 => 175,  529 => 174,  527 => 173,  524 => 172,  521 => 171,  518 => 170,  513 => 167,  509 => 161,  505 => 159,  499 => 157,  496 => 156,  493 => 155,  479 => 154,  473 => 152,  469 => 150,  463 => 148,  460 => 147,  452 => 145,  446 => 143,  443 => 142,  441 => 141,  438 => 140,  435 => 139,  417 => 138,  414 => 137,  412 => 136,  409 => 135,  406 => 134,  403 => 133,  395 => 118,  393 => 117,  384 => 110,  381 => 109,  377 => 104,  374 => 103,  370 => 100,  364 => 98,  361 => 97,  358 => 96,  355 => 95,  351 => 102,  349 => 101,  346 => 95,  344 => 94,  341 => 93,  335 => 92,  331 => 105,  328 => 103,  325 => 93,  323 => 92,  320 => 91,  317 => 90,  313 => 126,  308 => 123,  306 => 109,  301 => 106,  299 => 90,  283 => 76,  280 => 75,  277 => 74,  273 => 71,  270 => 70,  264 => 68,  258 => 66,  256 => 65,  251 => 64,  249 => 63,  241 => 60,  234 => 58,  231 => 57,  225 => 162,  223 => 133,  215 => 131,  211 => 128,  209 => 127,  206 => 74,  203 => 72,  201 => 57,  198 => 56,  189 => 51,  183 => 49,  181 => 48,  172 => 42,  162 => 38,  158 => 37,  154 => 36,  146 => 34,  142 => 33,  126 => 29,  122 => 28,  115 => 24,  111 => 22,  105 => 21,  94 => 19,  90 => 17,  87 => 16,  80 => 13,  74 => 12,  70 => 11,  66 => 10,  62 => 9,  58 => 8,  54 => 7,  49 => 5,  41 => 3,  272 => 89,  266 => 87,  263 => 86,  260 => 85,  250 => 123,  246 => 122,  237 => 59,  229 => 111,  222 => 106,  212 => 98,  205 => 96,  202 => 95,  200 => 94,  195 => 55,  191 => 91,  188 => 90,  186 => 85,  180 => 83,  177 => 82,  171 => 128,  168 => 41,  166 => 82,  163 => 81,  159 => 79,  156 => 78,  150 => 35,  145 => 73,  138 => 32,  135 => 31,  130 => 70,  128 => 67,  124 => 65,  121 => 64,  116 => 61,  110 => 57,  104 => 54,  99 => 51,  97 => 20,  53 => 10,  50 => 9,  44 => 4,  38 => 4,  35 => 3,);
    }
}
