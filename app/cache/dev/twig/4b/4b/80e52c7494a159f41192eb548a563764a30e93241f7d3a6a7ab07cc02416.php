<?php

/* MinsalSimagdBundle:ImgLecturaAdmin:lct_edit.html.twig */
class __TwigTemplate_4b4b80e52c7494a159f41192eb548a563764a30e93241f7d3a6a7ab07cc02416 extends Twig_Template
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
            'custom_entity_support' => array($this, 'block_custom_entity_support'),
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
        // line 5
        $context["_pacienteTitle"] = (((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio")))) ? (twig_truncate_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"), "idExpediente"), "idPaciente"), 50)) : ("No hay estudio"));
        // line 6
        $context["_lctMessageTemplate"] = (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? (("<i class=\"fa fa-microphone\"></i> <i class=\"fa fa-pencil-square-o\"></i> " . (isset($context["_pacienteTitle"]) ? $context["_pacienteTitle"] : $this->getContext($context, "_pacienteTitle")))) : (("<i class=\"fa fa-microphone\"></i> <i class=\"fa fa-plus-circle\"></i> " . (isset($context["_pacienteTitle"]) ? $context["_pacienteTitle"] : $this->getContext($context, "_pacienteTitle")))));
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
    }

    // line 17
    public function block_javascripts($context, array $blocks = array())
    {
        // line 18
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    ";
        // line 21
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/dist/summernote.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/summernote-master/lang/summernote-es-ES.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_summernote_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 26
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_webkitSpeechRecognition.js"), "html", null, true);
        echo "\" ></script>

    ";
        // line 30
        echo "
    <script>
\tvar \$id_estab;

\t";
        // line 35
        echo "\tvar \$diagExists;
\t
\t\$id_estab \t\t= ";
        // line 37
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstablecimiento"), "getId", array(), "method"), "js"), "html", null, true);
        echo ";
\t\$diagExists\t\t= ";
        // line 38
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "lecturaDiagnostico")), "html", null, true);
        echo ";
        
        /*
         * from simagd base edit template
         * @returns {undefined}
         */
\t\$is_objectAllowToSwitch = ";
        // line 44
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method")))) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$id_estab, \$diagExists, \$is_objectAllowToSwitch);
        
        console.log('%c http://codepen.io/mikethedj4/pen/oXMLOy', 'background: #222; color: #bada55');
        console.log('%c Estudios en tabs history solo el principal, los demas en div como el de filters, \\n partiendo de la izquierda', 'background: #70A; color: #fff');
\t
        ";
        // line 85
        echo "
        (function (\$) {
            /*
             * 
             * @type type
             * Global variables for plugin
             */
            window.GROUP_DEPENDENT_ENTITIES = null;   // --| build data collection
            GROUP_DEPENDENT_ENTITIES    = JSON.parse('";
        // line 93
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["GROUP_DEPENDENT_ENTITIES"]) ? $context["GROUP_DEPENDENT_ENTITIES"] : $this->getContext($context, "GROUP_DEPENDENT_ENTITIES"))), "js");
        echo "');

            /*
             * 
             * @type type
             * Global variables for plugin
             */
            window.\$DIAGNOSTIC_PATTERN_LIST = null;   // --| build data collection
            \$DIAGNOSTIC_PATTERN_LIST    = JSON.parse('";
        // line 101
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["DIAGNOSTIC_PATTERN_LIST"]) ? $context["DIAGNOSTIC_PATTERN_LIST"] : $this->getContext($context, "DIAGNOSTIC_PATTERN_LIST"))), "js");
        echo "');
            console.log('\$DIAGNOSTIC_PATTERN_LIST', \$DIAGNOSTIC_PATTERN_LIST);

            /*
             * 
             * @type type
             * Global variables for plugin
             */
            window.\$FORM_MAIN_STUDY_MODALITY    = null;   // --| build data collection
            window.\$FORM_MAIN_STUDY_DESCRIPTION = null;   // --| build data collection
            window.\$FORM_MAIN_DIAGNOSIS_RESULT_TYPE = ";
        // line 111
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdTipoResultado", array(), "method"), "getId", array(), "method"), "js"), "html", null, true);
        echo ";   // --| build data collection
            ";
        // line 112
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method")))) {
            // line 113
            echo "                \$FORM_MAIN_STUDY_MODALITY   = ";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method"), "getIdProcedimientoRealizado", array(), "method"), "getIdSolicitudEstudio", array(), "method"), "getIdAreaServicioDiagnostico", array(), "method"), "getId", array(), "method"), "js"), "html", null, true);
            echo ";
                \$FORM_MAIN_STUDY_DESCRIPTION    = '";
            // line 114
            echo _twig_default_filter(trim($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method"), "getServidor", array(), "method")), "Sin especificar...");
            echo "';";
            // line 115
            echo "            ";
        }
        // line 116
        echo "        }(jQuery));
    </script>

    <script type=\"text/javascript\" src=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgEstudioPacienteAdmin/est_crear_ventana_estudio.js"), "html", null, true);
        echo "\" ></script>

    <script type=\"text/javascript\" src=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgLecturaAdmin/lct_form_config.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgLecturaAdmin/lct_diag_editor.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 125
        echo "    
    ";
    }

    // line 129
    public function block_actions($context, array $blocks = array())
    {
        // line 130
        echo "    ";
        // line 131
        echo "    <li>";
        $this->env->loadTemplate("SonataAdminBundle:Button:history_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 132
        $this->env->loadTemplate("SonataAdminBundle:Button:acl_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 133
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
    ";
    }

    // line 137
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 138
        echo "    <span class=\"navbar-brand\">
        <span class=\"label label-";
        // line 139
        echo (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? ("primary-v2") : ("element-v2"));
        echo "\"> ";
        echo (isset($context["_lctMessageTemplate"]) ? $context["_lctMessageTemplate"] : $this->getContext($context, "_lctMessageTemplate"));
        echo " </span>
    </span>
";
    }

    // line 143
    public function block_simagd_navbar_middle_nav($context, array $blocks = array())
    {
        // line 144
        echo "    <form class=\"navbar-form navbar-left navbar-input-group\" role=\"search\">
\t<div class=\"fixed-navbar-display-worklist\">
\t    <div class=\"btn-group\" style=\"";
        // line 146
        echo "\">
\t\t<button type=\"button\" id=\"btn_";
        // line 147
        echo "_display_fast_worklist\" class=\"btn btn-primary-v2 dropdown-toggle btn_display_fast_worklist\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Lista de trabajo\">
\t\t    <i class=\"glyphicon glyphicon-user\"></i>
\t\t    Lista de trabajo <span class=\"caret\"></span>
\t\t</button>
\t\t<!-- Menu -->
\t\t<ul class=\"dropdown-menu table_bsTable_display_worklist\" id=\"bs_";
        // line 152
        echo "_display_fast_worklist\" >
\t\t</ul>
\t    </div>
\t</div>
    </form>
";
    }

    // line 159
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
        // line 160
        echo "    <li>
        <div style=\"padding-top: 10px; padding-left: 10px;\">
            <button id=\"btn_start_recognition\" class=\"btn btn-element-v2 btn-sm btn_start_recognition\" title=\"Iniciar transcripción por voz\" >
                <i class=\"fa fa-microphone\" id=\"icon_start_recognition\"></i>
            </button>
        </div>
    </li>
";
    }

    // line 169
    public function block_form($context, array $blocks = array())
    {
        // line 170
        echo "    ";
        // line 174
        echo "    ";
        // line 181
        echo "    
";
        // line 183
        echo "    
    <div id=\"switch_item_container_history\" class=\"bsswitch-container\" style=\"display: none;\" >
        ";
        // line 185
        $this->displayBlock('bsswitch_container', $context, $blocks);
        // line 192
        echo "    </div>

    <div id=\"switch_item_container_form\" class=\"bsswitch-container\" >
";
        // line 196
        echo "        ";
        $this->displayParentBlock("form", $context, $blocks);
        echo "
    </div>
    
    ";
        // line 231
        echo "    
";
    }

    // line 185
    public function block_bsswitch_container($context, array $blocks = array())
    {
        // line 186
        echo "        <div id=\"bs_container_history\">
            ";
        // line 187
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method")))) {
            // line 188
            echo "                ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_bsswitch_history.html.twig")->display(array_merge($context, array("object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 189
            echo "            ";
        }
        // line 190
        echo "        </div>
        ";
    }

    // line 235
    public function block_custom_entity_support($context, array $blocks = array())
    {
        // line 236
        echo "    <div id=\"custom-entity-content-body\">
        ";
        // line 243
        echo "    </div>
";
    }

    // line 246
    public function block_content($context, array $blocks = array())
    {
        // line 247
        echo "    
    ";
        // line 248
        $this->displayParentBlock("content", $context, $blocks);
        echo "
    
    ";
        // line 250
        $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_speechRecognition_modal.html.twig")->display($context);
        echo "    ";
        // line 251
        echo "    
    <!-- form for assign radX to rows -->
    ";
        // line 253
        if (($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) {
            // line 254
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgSolicitudEstudioComplementarioAdmin:solcmpl_crearSolicitudEstudio_formatoRapido_modal.html.twig")->display(array_merge($context, array("collection_prioridades" => (isset($context["collection_prioridades"]) ? $context["collection_prioridades"] : $this->getContext($context, "collection_prioridades")), "collection_modalidades" => (isset($context["collection_modalidades"]) ? $context["collection_modalidades"] : $this->getContext($context, "collection_modalidades")), "collection_examenes" => (isset($context["collection_examenes"]) ? $context["collection_examenes"] : $this->getContext($context, "collection_examenes")), "collection_proyecciones" => (isset($context["collection_proyecciones"]) ? $context["collection_proyecciones"] : $this->getContext($context, "collection_proyecciones")), "collection_default_mldRx" => (isset($context["collection_default_mldRx"]) ? $context["collection_default_mldRx"] : $this->getContext($context, "collection_default_mldRx")), "collection_default_exmRx" => (isset($context["collection_default_exmRx"]) ? $context["collection_default_exmRx"] : $this->getContext($context, "collection_default_exmRx")), "collection_tiposEmpleado" => (isset($context["collection_tiposEmpleado"]) ? $context["collection_tiposEmpleado"] : $this->getContext($context, "collection_tiposEmpleado")), "collection_radiologos" => (isset($context["collection_radiologos"]) ? $context["collection_radiologos"] : $this->getContext($context, "collection_radiologos")), "collection_default_empLogged" => (isset($context["collection_default_empLogged"]) ? $context["collection_default_empLogged"] : $this->getContext($context, "collection_default_empLogged")))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 256
            echo "    ";
        }
        // line 257
        echo "    
    <!-- form for assign radX to rows -->
    ";
        // line 259
        if (((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method"))) && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CTL_PATRON_DIAGNOSTICO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            // line 260
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_addDiagnosisAsPattern_modal.html.twig")->display(array_merge($context, array("collection_modalidades" => (isset($context["collection_modalidades"]) ? $context["collection_modalidades"] : $this->getContext($context, "collection_modalidades")), "collection_tiposResultado" => (isset($context["collection_tiposResultado"]) ? $context["collection_tiposResultado"] : $this->getContext($context, "collection_tiposResultado")), "form_currentstudy_mldRx" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstudio", array(), "method"), "getIdProcedimientoRealizado", array(), "method"), "getIdSolicitudEstudio", array(), "method"), "getIdAreaServicioDiagnostico", array(), "method"), "form_currentdiagnosis_tipoResult" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdTipoResultado", array(), "method"))));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 262
            echo "    ";
        }
        // line 263
        echo "    
";
    }

    // line 266
    public function block_formactions($context, array $blocks = array())
    {
        // line 267
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 268
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 269
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 270
                echo "                <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 272
                echo "                <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 274
            echo "        ";
        } else {
            // line 275
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 276
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 278
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 281
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 282
                echo "                <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>

                ";
                // line 287
                echo "
                ";
                // line 288
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 289
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    <a class=\"btn btn-danger\" href=\"";
                    // line 290
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 292
                echo "
                ";
                // line 293
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 294
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 296
                echo "
\t\t";
                // line 297
                if (((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"))) && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                    // line 298
                    echo "\t\t    <a class=\"btn btn-primary-v2\" href=\"";
                    echo twig_escape_filter($this->env, _twig_default_filter(trim($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"), "url")), "javascript:void(0)"), "html", null, true);
                    echo "\" target=\"_blank\" title=\"Recuperar estudio realizado\"
\t\t\t";
                    // line 299
                    if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                        // line 300
                        echo "\t\t\t    disabled=\"disabled\"
\t\t\t";
                    }
                    // line 301
                    echo ">
\t\t\t<i class=\"fa fa-eye\"></i> Recuperar estudio
\t\t    </a>
\t\t";
                }
                // line 305
                echo "
\t\t";
                // line 306
                if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio")))) {
                    // line 307
                    echo "\t\t    ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"), "estudioPendienteLectura"));
                    foreach ($context['_seq'] as $context["_key"] => $context["estudioPndL"]) {
                        // line 308
                        echo "\t\t\t<span class=\"label label-danger\">
\t\t\t    Pendiente desde: ";
                        // line 309
                        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["estudioPndL"]) ? $context["estudioPndL"] : $this->getContext($context, "estudioPndL")), "fechaIngresoLista"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["estudioPndL"]) ? $context["estudioPndL"] : $this->getContext($context, "estudioPndL")), "fechaIngresoLista"), "H:i:s A")), "html", null, true);
                        echo "
\t\t\t</span>
\t\t    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estudioPndL'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 312
                    echo "\t\t";
                }
                // line 313
                echo "            ";
            } else {
                // line 314
                echo "                ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT"), "method"))) {
                    // line 315
                    echo "                    <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>
                ";
                }
                // line 317
                echo "                ";
                // line 320
                echo "                ";
                // line 321
                echo "
\t\t";
                // line 322
                if (((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"))) && ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                    // line 323
                    echo "\t\t    <a class=\"btn btn-primary-v2\" href=\"";
                    echo twig_escape_filter($this->env, _twig_default_filter(trim($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"), "url")), "javascript:void(0)"), "html", null, true);
                    echo "\" target=\"_blank\" title=\"Recuperar estudio realizado\"
\t\t\t";
                    // line 324
                    if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                        // line 325
                        echo "\t\t\t    disabled=\"disabled\"
\t\t\t";
                    }
                    // line 326
                    echo ">
\t\t\t<i class=\"fa fa-eye\"></i> Recuperar estudio
\t\t    </a>
\t\t";
                }
                // line 330
                echo "
\t\t";
                // line 331
                if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio")))) {
                    // line 332
                    echo "\t\t    ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstudio"), "estudioPendienteLectura"));
                    foreach ($context['_seq'] as $context["_key"] => $context["estudioPndL"]) {
                        // line 333
                        echo "\t\t\t<span class=\"label label-primary-v2\">
\t\t\t    Pendiente desde: ";
                        // line 334
                        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["estudioPndL"]) ? $context["estudioPndL"] : $this->getContext($context, "estudioPndL")), "fechaIngresoLista"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["estudioPndL"]) ? $context["estudioPndL"] : $this->getContext($context, "estudioPndL")), "fechaIngresoLista"), "H:i:s A")), "html", null, true);
                        echo "
\t\t\t</span>
\t\t    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estudioPndL'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 337
                    echo "\t\t";
                }
                // line 338
                echo "            ";
            }
            // line 339
            echo "        ";
        }
        // line 340
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgLecturaAdmin:lct_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  585 => 340,  582 => 339,  579 => 338,  576 => 337,  567 => 334,  564 => 333,  559 => 332,  557 => 331,  554 => 330,  548 => 326,  544 => 325,  542 => 324,  537 => 323,  535 => 322,  532 => 321,  530 => 320,  528 => 317,  524 => 315,  521 => 314,  518 => 313,  515 => 312,  506 => 309,  503 => 308,  498 => 307,  496 => 306,  493 => 305,  487 => 301,  483 => 300,  481 => 299,  476 => 298,  474 => 297,  471 => 296,  463 => 294,  461 => 293,  458 => 292,  451 => 290,  446 => 289,  444 => 288,  441 => 287,  437 => 282,  434 => 281,  428 => 278,  424 => 276,  421 => 275,  418 => 274,  412 => 272,  406 => 270,  403 => 269,  401 => 268,  398 => 267,  395 => 266,  390 => 263,  387 => 262,  379 => 260,  377 => 259,  373 => 257,  370 => 256,  362 => 254,  360 => 253,  356 => 251,  353 => 250,  348 => 248,  345 => 247,  342 => 246,  337 => 243,  334 => 236,  331 => 235,  326 => 190,  323 => 189,  315 => 188,  313 => 187,  310 => 186,  307 => 185,  302 => 231,  295 => 196,  290 => 192,  288 => 185,  284 => 183,  281 => 181,  279 => 174,  277 => 170,  274 => 169,  263 => 160,  260 => 159,  251 => 152,  244 => 147,  241 => 146,  237 => 144,  234 => 143,  225 => 139,  222 => 138,  219 => 137,  213 => 133,  209 => 132,  204 => 131,  202 => 130,  199 => 129,  194 => 125,  189 => 122,  185 => 121,  180 => 119,  175 => 116,  172 => 115,  169 => 114,  164 => 113,  162 => 112,  158 => 111,  145 => 101,  134 => 93,  124 => 85,  110 => 44,  101 => 38,  97 => 37,  93 => 35,  87 => 30,  81 => 26,  76 => 23,  72 => 22,  67 => 21,  61 => 18,  58 => 17,  51 => 14,  45 => 11,  42 => 10,  37 => 6,  35 => 5,);
    }
}
