<?php

/* MinsalSeguimientoBundle:SecIngreso:edit.html.twig */
class __TwigTemplate_35c8604fc86be492efe351785d198c21ea3bcc4bc1386c6ce64dd025fdbfed02 extends Twig_Template
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
            'notice' => array($this, 'block_notice'),
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

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalseguimiento/css/SecIngreso/edit.css"), "html", null, true);
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
    <script src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/datepicker/jquery.ui.datepicker-es.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/maskedinput/jquery.maskedinput.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalseguimiento/js/SecIngreso/edit.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 14
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
            echo "        ";
            $this->env->loadTemplate("MinsalSiapsBundle:MntPacienteAdmin:identificacion_paciente.html.twig")->display($context);
            // line 30
            echo "
        ";
            // line 31
            if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                // line 32
                echo "            <a style=\"position:relative;float:right;margin-bottom:20px;\" class=\"btn btn-info\" href=\"";
                echo $this->env->getExtension('routing')->getPath("admin_minsal_siaps_mntpaciente_list");
                echo "\">
                <span class=\"glyphicon glyphicon-list\"></span> Buscar Otro Paciente
            </a>
        ";
            }
            // line 36
            echo "
        <input id=\"sexo\" type=\"hidden\" value=\"";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "getIdSexo", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo "\"/>
        <input id=\"embarazo\" type=\"hidden\" value=\"";
            // line 38
            echo twig_escape_filter($this->env, (isset($context["embarazo"]) ? $context["embarazo"] : $this->getContext($context, "embarazo")), "html", null, true);
            echo "\"/>

        <form
            id=\"form_ingreso\"
            ";
            // line 42
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 43
            echo "            role=\"form\"
            action=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id_paciente" => $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "getId"), "id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
            method=\"POST\"
            ";
            // line 46
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 47
            echo "            >

            ";
            // line 49
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 52
            echo "
                ";
            // line 53
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 151
            echo "
                ";
            // line 152
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 155
            echo "
            ";
            // line 156
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

            ";
            // line 158
            $this->displayBlock('formactions', $context, $blocks);
            // line 163
            echo "        </form>
    ";
        }
    }

    // line 49
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 50
        echo "                <div class=\"row\">
                ";
    }

    // line 53
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 54
        echo "                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formgroups"));
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
        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
            // line 55
            echo "                        <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                            <div class=\"box box-success\">
                                <div class=\"box-header\">
                                    <h4 class=\"box-title\">
                                        ";
            // line 60
            echo "                                    </h4>
                                    <br />

                                    ";
            // line 63
            $this->displayBlock('notice', $context, $blocks);
            // line 66
            echo "                                    ";
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 67
                echo "                                        <div class=\"alert alert-danger alert-dismissable\">
                                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                            ";
                // line 69
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                                        </div>
                                    ";
            }
            // line 71
            echo "    
                                </div>
                                ";
            // line 74
            echo "                                <div class=\"box-body\">
                                    <div class=\"sonata-ba-collapsed-fields\">
                                        ";
            // line 76
            if (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description") != false)) {
                // line 77
                echo "                                            <p>";
                echo $this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description");
                echo "</p>
                                        ";
            }
            // line 79
            echo "                                        <center>
                                            <table class=\"dat_ingreso\">
                                                <tr class=\"dat_ingreso_sec\">
                                                    <td colspan=\"4\">EN CASO DE REFERENCIA</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%' colspan=\"4\">";
            // line 85
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEstablecimientoReferencia"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%' colspan=\"4\">";
            // line 88
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "motivoReferencia"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <!-- BLOQUE DE INGRESO -->
                                                <tr class=\"dat_ingreso_sec\">
                                                    <td colspan=\"4\">DATOS DE INGRESO</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 95
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idProcedenciaIngreso"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 96
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCircunstanciaIngreso"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 99
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "fecha"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 100
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "hora"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 103
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAtenAreaModEstab"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 104
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAmbienteIngreso"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 107
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "embarazada"), array(), "array"), 'row');
            echo "</td>
                                                    <td ></td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 111
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "semanasAmenorrea"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 112
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "fechaProbableParto"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%' colspan=4>";
            // line 115
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "diagnostico"), array(), "array"), 'row');
            echo "</td>

                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 119
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idTipoAccidente"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 120
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEmpleado"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 123
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "tarjetasEntregadas"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 124
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "responsableTarjeta"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'><div class=\"control-group\">
                                                            <label class=\" control-label\">Responsable de elaborar el ingreso en ESDOMED:</label>
                                                            <div class=\"controls sonata-ba-field sonata-ba-field-standard-natural \">
                                                                <strong>";
            // line 130
            echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "firstname") . $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "lastname")), "html", null, true);
            echo "</strong>
                                                            </div>
                                                    </td>
                                                    <td >
                                                        <div class=\"control-group\">
                                                            <label class=\" control-label\"> Fecha y hora de elaboración: </label>
                                                            <div class=\"controls sonata-ba-field sonata-ba-field-standard-natural \">
                                                                <strong>";
            // line 137
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d-M-Y H:i"), "html", null, true);
            echo "</strong>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                    </div>
                                </div>
                                ";
            // line 147
            echo "                            </div>
                        </div>
                    ";
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
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 150
        echo "                ";
    }

    // line 63
    public function block_notice($context, array $blocks = array())
    {
        // line 64
        echo "                                        ";
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
        // line 65
        echo "                                    ";
    }

    // line 152
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 153
        echo "                </div>
            ";
    }

    // line 158
    public function block_formactions($context, array $blocks = array())
    {
        // line 159
        echo "                <div class=\"well well-small form-actions\">
                    <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_create_and_list\" value=\"Guardar\"/>
                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecIngreso:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  376 => 147,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 160,  401 => 144,  369 => 129,  356 => 127,  340 => 122,  874 => 376,  854 => 367,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 352,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 322,  763 => 321,  746 => 311,  740 => 307,  734 => 305,  731 => 304,  729 => 303,  721 => 301,  715 => 297,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 266,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 220,  520 => 210,  450 => 173,  408 => 156,  363 => 136,  359 => 135,  348 => 129,  345 => 124,  336 => 125,  316 => 116,  307 => 107,  261 => 85,  266 => 83,  542 => 218,  538 => 217,  527 => 173,  509 => 204,  499 => 157,  493 => 155,  479 => 154,  473 => 165,  414 => 158,  406 => 152,  280 => 75,  223 => 69,  585 => 224,  551 => 101,  546 => 206,  506 => 103,  503 => 193,  488 => 172,  485 => 195,  478 => 165,  475 => 164,  471 => 164,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 109,  291 => 100,  286 => 108,  392 => 150,  332 => 145,  318 => 112,  276 => 104,  190 => 53,  12 => 36,  195 => 92,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 383,  890 => 381,  887 => 380,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 295,  706 => 294,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 202,  613 => 232,  610 => 198,  608 => 197,  605 => 196,  602 => 230,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 79,  496 => 199,  441 => 156,  438 => 140,  432 => 166,  428 => 172,  422 => 150,  416 => 123,  395 => 118,  391 => 109,  382 => 143,  372 => 89,  364 => 137,  353 => 96,  335 => 120,  333 => 93,  297 => 103,  292 => 82,  205 => 96,  200 => 94,  184 => 55,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 377,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 330,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 293,  701 => 180,  699 => 179,  696 => 178,  690 => 285,  687 => 173,  681 => 205,  673 => 165,  671 => 277,  668 => 163,  663 => 160,  658 => 271,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 261,  629 => 141,  627 => 206,  624 => 139,  620 => 182,  614 => 201,  599 => 194,  594 => 243,  592 => 126,  589 => 192,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 186,  567 => 110,  554 => 185,  552 => 164,  544 => 219,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 159,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 148,  446 => 143,  443 => 142,  429 => 116,  425 => 152,  410 => 59,  397 => 55,  394 => 54,  389 => 128,  357 => 37,  342 => 123,  334 => 26,  330 => 122,  328 => 117,  290 => 110,  287 => 99,  263 => 86,  255 => 95,  245 => 76,  194 => 55,  76 => 70,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 372,  860 => 280,  856 => 279,  852 => 278,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 255,  617 => 254,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 244,  595 => 193,  586 => 191,  582 => 190,  580 => 197,  572 => 218,  568 => 173,  562 => 184,  556 => 182,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 191,  492 => 76,  481 => 167,  476 => 163,  467 => 156,  451 => 155,  424 => 115,  418 => 148,  412 => 147,  399 => 64,  396 => 63,  390 => 139,  388 => 138,  383 => 135,  377 => 104,  373 => 46,  370 => 100,  367 => 102,  352 => 126,  349 => 101,  346 => 125,  329 => 111,  326 => 86,  313 => 126,  303 => 103,  300 => 112,  234 => 88,  218 => 81,  207 => 61,  178 => 48,  321 => 119,  295 => 11,  274 => 87,  242 => 110,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 268,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 226,  583 => 334,  579 => 236,  577 => 188,  575 => 252,  569 => 233,  565 => 109,  548 => 207,  540 => 99,  536 => 98,  529 => 213,  524 => 211,  516 => 143,  510 => 78,  504 => 90,  500 => 88,  490 => 197,  486 => 136,  482 => 285,  470 => 131,  464 => 180,  459 => 177,  452 => 145,  434 => 256,  421 => 114,  417 => 159,  385 => 107,  361 => 97,  344 => 94,  339 => 126,  324 => 115,  310 => 113,  302 => 131,  296 => 89,  282 => 106,  259 => 81,  244 => 111,  231 => 69,  226 => 69,  114 => 80,  104 => 28,  288 => 107,  284 => 98,  279 => 96,  275 => 95,  256 => 74,  250 => 73,  237 => 71,  232 => 72,  222 => 63,  215 => 66,  191 => 54,  153 => 72,  563 => 188,  560 => 187,  558 => 186,  555 => 185,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  400 => 116,  380 => 107,  366 => 106,  354 => 130,  331 => 119,  325 => 94,  320 => 92,  317 => 91,  311 => 87,  308 => 86,  304 => 85,  272 => 81,  267 => 88,  249 => 78,  216 => 65,  155 => 35,  152 => 49,  146 => 49,  126 => 38,  181 => 51,  161 => 54,  110 => 29,  188 => 53,  186 => 51,  170 => 355,  150 => 34,  124 => 113,  358 => 103,  351 => 102,  347 => 134,  343 => 127,  338 => 112,  327 => 121,  323 => 114,  319 => 124,  315 => 82,  301 => 104,  299 => 90,  293 => 111,  289 => 82,  281 => 96,  277 => 95,  271 => 94,  265 => 100,  262 => 76,  260 => 85,  257 => 56,  251 => 72,  248 => 71,  239 => 68,  228 => 103,  225 => 65,  213 => 69,  211 => 64,  197 => 72,  174 => 163,  148 => 47,  134 => 43,  127 => 16,  20 => 1,  53 => 3,  270 => 85,  253 => 79,  233 => 66,  212 => 98,  210 => 63,  206 => 76,  202 => 62,  198 => 54,  192 => 66,  185 => 53,  180 => 49,  175 => 47,  172 => 158,  167 => 156,  165 => 351,  160 => 57,  137 => 44,  113 => 52,  100 => 29,  90 => 27,  81 => 30,  129 => 116,  84 => 22,  77 => 17,  34 => 2,  118 => 56,  97 => 24,  70 => 15,  65 => 13,  58 => 10,  23 => 5,  480 => 134,  474 => 150,  469 => 150,  461 => 157,  457 => 153,  453 => 174,  444 => 171,  440 => 148,  437 => 118,  435 => 167,  430 => 153,  427 => 65,  423 => 63,  413 => 241,  409 => 153,  407 => 238,  402 => 65,  398 => 115,  393 => 112,  387 => 110,  384 => 109,  381 => 109,  379 => 119,  374 => 140,  368 => 138,  365 => 137,  362 => 97,  360 => 104,  355 => 95,  341 => 123,  337 => 97,  322 => 93,  314 => 111,  312 => 149,  309 => 113,  305 => 111,  298 => 12,  294 => 98,  285 => 79,  283 => 111,  278 => 110,  268 => 101,  264 => 104,  258 => 75,  252 => 79,  247 => 77,  241 => 74,  229 => 86,  220 => 99,  214 => 79,  177 => 52,  169 => 43,  140 => 47,  132 => 117,  128 => 92,  107 => 29,  61 => 12,  273 => 71,  269 => 91,  254 => 80,  243 => 76,  240 => 72,  238 => 84,  235 => 73,  230 => 65,  227 => 67,  224 => 66,  221 => 82,  219 => 66,  217 => 60,  208 => 96,  204 => 61,  179 => 86,  159 => 151,  143 => 36,  135 => 42,  119 => 37,  102 => 28,  71 => 8,  67 => 7,  63 => 11,  59 => 5,  38 => 5,  94 => 26,  89 => 24,  85 => 20,  75 => 19,  68 => 59,  56 => 10,  201 => 60,  196 => 58,  183 => 50,  171 => 128,  166 => 43,  163 => 42,  158 => 50,  156 => 78,  151 => 47,  142 => 30,  138 => 43,  136 => 29,  121 => 57,  117 => 81,  105 => 39,  91 => 25,  62 => 6,  49 => 9,  28 => 3,  26 => 13,  87 => 22,  31 => 14,  25 => 10,  21 => 1,  24 => 3,  19 => 1,  93 => 23,  88 => 20,  78 => 20,  46 => 7,  44 => 7,  27 => 4,  79 => 24,  72 => 20,  69 => 14,  47 => 8,  40 => 7,  37 => 5,  22 => 2,  246 => 122,  157 => 53,  145 => 46,  139 => 29,  131 => 34,  123 => 38,  120 => 35,  115 => 12,  111 => 32,  108 => 32,  101 => 28,  98 => 25,  96 => 26,  83 => 176,  74 => 16,  66 => 15,  55 => 9,  52 => 10,  50 => 7,  43 => 6,  41 => 4,  35 => 4,  32 => 5,  29 => 3,  209 => 55,  203 => 56,  199 => 59,  193 => 57,  189 => 65,  187 => 48,  182 => 87,  176 => 85,  173 => 48,  168 => 50,  164 => 155,  162 => 152,  154 => 52,  149 => 34,  147 => 33,  144 => 46,  141 => 32,  133 => 28,  130 => 42,  125 => 46,  122 => 85,  116 => 36,  112 => 33,  109 => 32,  106 => 31,  103 => 30,  99 => 30,  95 => 24,  92 => 22,  86 => 23,  82 => 31,  80 => 21,  73 => 16,  64 => 12,  60 => 11,  57 => 11,  54 => 21,  51 => 9,  48 => 2,  45 => 1,  42 => 6,  39 => 3,  36 => 3,  33 => 3,  30 => 2,);
    }
}
