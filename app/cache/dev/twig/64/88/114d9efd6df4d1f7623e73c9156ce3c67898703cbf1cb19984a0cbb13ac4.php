<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_edit.html.twig */
class __TwigTemplate_6488114d9efd6df4d1f7623e73c9156ce3c67898703cbf1cb19984a0cbb13ac4 extends Twig_Template
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
            'simagd_navbar_middle_nav' => array($this, 'block_simagd_navbar_middle_nav'),
            'simagd_navbar_right_nav' => array($this, 'block_simagd_navbar_right_nav'),
            'form' => array($this, 'block_form'),
            'bsswitch_container' => array($this, 'block_bsswitch_container'),
            'content' => array($this, 'block_content'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        $context["localRecord_number"] = (((!(null === (isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord"))))) ? ($this->getAttribute((isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord")), "numero")) : (""));
        // line 5
        $context["_pacienteTitle"] = (((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idExpediente")))) ? (((twig_truncate_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idExpediente"), "idPaciente"), 50) . " ") . (isset($context["localRecord_number"]) ? $context["localRecord_number"] : $this->getContext($context, "localRecord_number")))) : ("No hay expediente"));
        // line 6
        $context["_prcMessageTemplate"] = (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? (("<i class=\"fa fa-inbox\"></i> <i class=\"fa fa-pencil-square-o\"></i> " . (isset($context["_pacienteTitle"]) ? $context["_pacienteTitle"] : $this->getContext($context, "_pacienteTitle")))) : (("<i class=\"fa fa-inbox\"></i> <i class=\"fa fa-plus-circle\"></i> " . (isset($context["_pacienteTitle"]) ? $context["_pacienteTitle"] : $this->getContext($context, "_pacienteTitle")))));
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
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 17
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/iCheck-master/skins/minimal/red.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
";
    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        // line 21
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    ";
        // line 24
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/lang/summernote-es-ES.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_summernote_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 29
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_webkitSpeechRecognition.js"), "html", null, true);
        echo "\" ></script>

    <script>
\tvar \$prc_dateCreation,
\t    \$id_exp,
\t    \$name_pct;
\t
\t/** Obtener fecha de solicitud */
\t\$prc_dateCreation           = ";
        // line 37
        if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
            echo " new Date('";
            echo twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "fechaCreacion"), "m/d/Y");
            echo "') ";
        } else {
            echo " false ";
        }
        echo ";
\t
\t/** Obtener datos contacto paciente */
\t\$id_exp                     = ";
        // line 40
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idExpediente")))) {
            echo " ";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdExpediente"), "getId", array(), "method"), "js"), "html", null, true);
            echo " ";
        } else {
            echo " false ";
        }
        echo ";
\t\$name_pct                   = ";
        // line 41
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idExpediente")))) {
            echo " \"";
            echo twig_escape_filter($this->env, trim(twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idExpediente"), "idPaciente"), "js")), "html", null, true);
            echo "\" ";
        } else {
            echo " false ";
        }
        echo ";
        
        /*
         * from simagd base edit template
         * @returns {undefined}
         */
\t\$is_objectAllowToSwitch     = ";
        // line 47
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdExpediente", array(), "method")))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$prc_dateCreation, \$id_exp, \$name_pct, \$is_objectAllowToSwitch);
        
        var \$stdref_association_id  = 'idEstablecimientoReferido';  // --| establecimiento referido
        var \$msol_association_id    = 'idAreaServicioDiagnostico';      // --| modalidad solicitada
    </script>

    ";
        // line 56
        echo "
    <script type=\"text/javascript\" src=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_form_config.js"), "html", null, true);
        echo "\" ></script>
    
    <script type=\"text/javascript\" src=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_solicitar_diagnostico.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_calc_peso_actual.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_realizables.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_atenciones.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_empleados.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_modalidad_exploraciones.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudEstudioAdmin/prc_exploraciones_realizables.js"), "html", null, true);
        echo "\" ></script>
    
    <script type=\"text/javascript\" src=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_cargar_datos.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_cargar_datos_seleccionados.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_each_values_array.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_valor_campo_compuesto.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_extract_campos_componentes.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 74
        echo "    
    ";
    }

    // line 78
    public function block_actions($context, array $blocks = array())
    {
        // line 79
        echo "    ";
        // line 80
        echo "    <li>";
        $this->env->loadTemplate("SonataAdminBundle:Button:history_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 81
        $this->env->loadTemplate("SonataAdminBundle:Button:acl_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 82
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
    ";
    }

    // line 86
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 87
        echo "    <span class=\"navbar-brand\">
        <span class=\"label label-";
        // line 88
        echo (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? ("primary-v2") : ("element-v2"));
        echo "\"> ";
        echo (isset($context["_prcMessageTemplate"]) ? $context["_prcMessageTemplate"] : $this->getContext($context, "_prcMessageTemplate"));
        echo " </span>
    </span>
";
    }

    // line 92
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 93
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" style=\"margin-left: 50px !important;\" role=\"search\">
        <div class=\"form-group has-feedback\">
            <input type=\"text\" class=\"typeahead explocal_navbar_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"navbar_filter_expNumero\" name=\"navbar_filter_expNumero\" data-xparam-filter=\"true\">
            <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-filter-exp\"></i>
        </div>
        <button type=\"submit\" id=\"btn_search_filter_expNumero\" name=\"btn_search_filter_expNumero\" class=\"btn btn-primary-v2 ";
        // line 98
        echo "\">
            <i class=\"fa fa-search\"></i>
        </button>
    </form>
";
    }

    // line 104
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 105
        echo "    <li>
        <div style=\"padding-top: 10px; padding-left: 10px;\">
            <button id=\"btn_start_recognition\" class=\"btn btn-element-v2 btn-sm btn_start_recognition\" title=\"Iniciar transcripción por voz\" >
                <i class=\"fa fa-microphone\" id=\"icon_start_recognition\"></i>
            </button>
        </div>
    </li>
";
    }

    // line 114
    public function block_form($context, array $blocks = array())
    {
        // line 115
        echo "    ";
        // line 120
        echo "    ";
        // line 125
        echo "    ";
        // line 129
        echo "    ";
        // line 139
        echo "    
    <div id=\"switch_item_container_history\" class=\"bsswitch-container\" style=\"display: none;\" >
        ";
        // line 141
        $this->displayBlock('bsswitch_container', $context, $blocks);
        // line 148
        echo "    </div>

    <div id=\"switch_item_container_form\" class=\"bsswitch-container\" >
";
        // line 152
        echo "        ";
        $this->displayParentBlock("form", $context, $blocks);
        echo "
    </div>
";
    }

    // line 141
    public function block_bsswitch_container($context, array $blocks = array())
    {
        // line 142
        echo "        <div id=\"bs_container_history\">
            ";
        // line 143
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdExpediente", array(), "method")))) {
            // line 144
            echo "                ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_bsswitch_history.html.twig")->display(array_merge($context, array("object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 145
            echo "            ";
        }
        // line 146
        echo "        </div>
        ";
    }

    // line 170
    public function block_content($context, array $blocks = array())
    {
        // line 171
        echo "    
    ";
        // line 172
        $this->displayParentBlock("content", $context, $blocks);
        echo "
    
    ";
        // line 174
        $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_speechRecognition_modal.html.twig")->display($context);
        echo "    ";
        // line 175
        echo "    
";
    }

    // line 178
    public function block_formactions($context, array $blocks = array())
    {
        // line 179
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 180
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 181
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 182
                echo "                <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 184
                echo "                <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 186
            echo "        ";
        } else {
            // line 187
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 188
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 190
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 193
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 194
                echo "\t\t<button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_edit_and_request\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-inbox\"></i> Guardar</button>

                ";
                // line 199
                echo "
                ";
                // line 200
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 201
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    <a class=\"btn btn-danger\" href=\"";
                    // line 202
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 204
                echo "
                ";
                // line 205
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 206
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 208
                echo "            ";
            } else {
                // line 209
                echo "                ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT"), "method"))) {
                    // line 210
                    echo "\t\t    <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_create_and_request\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-inbox\"></i> Guardar</button>
                ";
                }
                // line 212
                echo "                ";
                // line 215
                echo "                ";
                // line 216
                echo "            ";
            }
            // line 217
            echo "        ";
        }
        // line 218
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  451 => 218,  448 => 217,  445 => 216,  443 => 215,  441 => 212,  437 => 210,  434 => 209,  431 => 208,  423 => 206,  421 => 205,  418 => 204,  411 => 202,  406 => 201,  404 => 200,  401 => 199,  397 => 194,  394 => 193,  388 => 190,  384 => 188,  381 => 187,  378 => 186,  372 => 184,  366 => 182,  363 => 181,  361 => 180,  358 => 179,  355 => 178,  350 => 175,  347 => 174,  342 => 172,  339 => 171,  336 => 170,  331 => 146,  328 => 145,  320 => 144,  318 => 143,  315 => 142,  312 => 141,  304 => 152,  299 => 148,  297 => 141,  293 => 139,  291 => 129,  289 => 125,  287 => 120,  285 => 115,  282 => 114,  271 => 105,  268 => 104,  260 => 98,  253 => 93,  250 => 92,  241 => 88,  238 => 87,  235 => 86,  229 => 82,  225 => 81,  220 => 80,  218 => 79,  215 => 78,  210 => 74,  205 => 71,  201 => 70,  197 => 69,  193 => 68,  189 => 67,  184 => 65,  180 => 64,  176 => 63,  172 => 62,  168 => 61,  164 => 60,  160 => 59,  155 => 57,  152 => 56,  137 => 47,  122 => 41,  112 => 40,  100 => 37,  88 => 29,  83 => 26,  79 => 25,  74 => 24,  68 => 21,  65 => 20,  58 => 17,  52 => 14,  46 => 11,  43 => 10,  38 => 6,  36 => 5,  34 => 4,);
    }
}
