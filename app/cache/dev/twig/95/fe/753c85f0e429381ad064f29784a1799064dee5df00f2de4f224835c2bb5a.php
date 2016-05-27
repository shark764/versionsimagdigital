<?php

/* MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_edit.html.twig */
class __TwigTemplate_95fe753c85f0e429381ad064f29784a1799064dee5df00f2de4f224835c2bb5a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_edit.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'actions' => array($this, 'block_actions'),
            'simagd_form_navbar_brand_title' => array($this, 'block_simagd_form_navbar_brand_title'),
            'form' => array($this, 'block_form'),
            'bsswitch_container' => array($this, 'block_bsswitch_container'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 5
        $context["_pacienteTitle"] = (((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio")))) ? (twig_truncate_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio"), "idExpediente"), "idPaciente"), 50)) : ("No hay solicitud de estudio"));
        // line 6
        $context["_przMessageTemplate"] = (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? (("<i class=\"fa fa-desktop\"></i> <i class=\"fa fa-pencil-square-o\"></i> " . (isset($context["_pacienteTitle"]) ? $context["_pacienteTitle"] : $this->getContext($context, "_pacienteTitle")))) : (("<i class=\"fa fa-desktop\"></i> <i class=\"fa fa-plus-circle\"></i> " . (isset($context["_pacienteTitle"]) ? $context["_pacienteTitle"] : $this->getContext($context, "_pacienteTitle")))));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    
    ";
        // line 14
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/iCheck-master/skins/minimal/red.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
";
    }

    // line 17
    public function block_javascripts($context, array $blocks = array())
    {
        // line 18
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        /*
         * from simagd base edit template
         * @returns {undefined}
         */
\t\$is_objectAllowToSwitch     = ";
        // line 25
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdSolicitudEstudio", array(), "method")))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";
\t
\tconsole.log(\$is_objectAllowToSwitch);
    </script>

    <script type=\"text/javascript\" src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_each_values_array.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgProcedimientoRealizadoAdmin/prz_form_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 34
        echo "    
    ";
    }

    // line 38
    public function block_actions($context, array $blocks = array())
    {
        // line 39
        echo "    ";
        // line 40
        echo "    <li>";
        $this->env->loadTemplate("SonataAdminBundle:Button:history_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 41
        $this->env->loadTemplate("SonataAdminBundle:Button:acl_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 42
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
    ";
    }

    // line 46
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 47
        echo "    <span class=\"navbar-brand\">
        <span class=\"label label-";
        // line 48
        echo (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? ("primary-v2") : ("element-v2"));
        echo "\"> ";
        echo (isset($context["_przMessageTemplate"]) ? $context["_przMessageTemplate"] : $this->getContext($context, "_przMessageTemplate"));
        echo " </span>
    </span>
";
    }

    // line 52
    public function block_form($context, array $blocks = array())
    {
        // line 53
        echo "    ";
        // line 57
        echo "    ";
        // line 61
        echo "    
    <div id=\"switch_item_container_history\" class=\"bsswitch-container\" style=\"display: none;\" >
        ";
        // line 63
        $this->displayBlock('bsswitch_container', $context, $blocks);
        // line 70
        echo "    </div>

    <div id=\"switch_item_container_form\" class=\"bsswitch-container\" >
";
        // line 74
        echo "        ";
        $this->displayParentBlock("form", $context, $blocks);
        echo "
    </div>
";
    }

    // line 63
    public function block_bsswitch_container($context, array $blocks = array())
    {
        // line 64
        echo "        <div id=\"bs_container_history\">
            ";
        // line 65
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdSolicitudEstudio", array(), "method")))) {
            // line 66
            echo "                ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_bsswitch_history.html.twig")->display(array_merge($context, array("object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 67
            echo "            ";
        }
        // line 68
        echo "        </div>
        ";
    }

    // line 91
    public function block_formactions($context, array $blocks = array())
    {
        // line 92
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 93
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 94
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 95
                echo "                <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 97
                echo "                <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 99
            echo "        ";
        } else {
            // line 100
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 101
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 103
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 106
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 107
                echo "                ";
                if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
                    // line 108
                    echo "                    <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_edit_and_diagnosticate\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-microphone\"></i> Guardar</button>
                ";
                }
                // line 110
                echo "\t\t<button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>

                ";
                // line 115
                echo "
                ";
                // line 116
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 117
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    <a class=\"btn btn-danger\" href=\"";
                    // line 118
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 120
                echo "
                ";
                // line 121
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 122
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 124
                echo "
\t\t";
                // line 125
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "examenEstudio"));
                foreach ($context['_seq'] as $context["_key"] => $context["estudio"]) {
                    // line 126
                    echo "\t\t    <a class=\"btn btn-primary-v2\" href=\"";
                    echo twig_escape_filter($this->env, _twig_default_filter(trim($this->getAttribute((isset($context["estudio"]) ? $context["estudio"] : $this->getContext($context, "estudio")), "url")), "javascript:void(0)"), "html", null, true);
                    echo "\" target=\"_blank\" title=\"Recuperar estudio realizado\"
\t\t\t";
                    // line 127
                    if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                        // line 128
                        echo "\t\t\t    disabled=\"disabled\"
\t\t\t";
                    }
                    // line 129
                    echo ">
\t\t\t<i class=\"fa fa-eye\"></i> Recuperar estudio
\t\t    </a>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estudio'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 133
                echo "
\t\t";
                // line 134
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "examenPendienteRealizar"));
                foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
                    // line 135
                    echo "\t\t    ";
                    // line 138
                    echo "\t\t    <span class=\"label label-danger\">
\t\t\tPendiente desde: ";
                    // line 139
                    echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fechaIngresoLista"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fechaIngresoLista"), "H:i:s A")), "html", null, true);
                    echo "
\t\t    </span>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['examen'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 142
                echo "            ";
            } else {
                // line 143
                echo "                ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT"), "method"))) {
                    // line 144
                    echo "\t\t    ";
                    if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
                        // line 145
                        echo "\t\t\t<button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_create_and_diagnosticate\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-microphone\"></i> Guardar</button>
\t\t    ";
                    }
                    // line 147
                    echo "\t\t    <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>
                ";
                }
                // line 149
                echo "                ";
                // line 152
                echo "                ";
                // line 153
                echo "
\t\t";
                // line 154
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "examenPendienteRealizar"));
                foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
                    // line 155
                    echo "\t\t    ";
                    // line 158
                    echo "\t\t    <span class=\"label label-primary-v2\">
\t\t\tPendiente desde: ";
                    // line 159
                    echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fechaIngresoLista"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fechaIngresoLista"), "H:i:s A")), "html", null, true);
                    echo "
\t\t    </span>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['examen'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 162
                echo "            ";
            }
            // line 163
            echo "        ";
        }
        // line 164
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  358 => 164,  355 => 163,  352 => 162,  343 => 159,  340 => 158,  338 => 155,  334 => 154,  331 => 153,  329 => 152,  327 => 149,  323 => 147,  319 => 145,  316 => 144,  313 => 143,  310 => 142,  301 => 139,  298 => 138,  296 => 135,  292 => 134,  289 => 133,  280 => 129,  276 => 128,  274 => 127,  269 => 126,  265 => 125,  262 => 124,  254 => 122,  252 => 121,  249 => 120,  242 => 118,  237 => 117,  235 => 116,  232 => 115,  228 => 110,  224 => 108,  221 => 107,  218 => 106,  212 => 103,  208 => 101,  205 => 100,  202 => 99,  196 => 97,  190 => 95,  187 => 94,  185 => 93,  182 => 92,  179 => 91,  174 => 68,  171 => 67,  163 => 66,  161 => 65,  158 => 64,  155 => 63,  147 => 74,  142 => 70,  140 => 63,  136 => 61,  134 => 57,  132 => 53,  129 => 52,  120 => 48,  117 => 47,  114 => 46,  108 => 42,  104 => 41,  99 => 40,  97 => 39,  94 => 38,  89 => 34,  84 => 31,  80 => 30,  68 => 25,  57 => 18,  54 => 17,  47 => 14,  41 => 11,  38 => 10,  33 => 6,  31 => 5,);
    }
}
