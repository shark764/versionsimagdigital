<?php

/* MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_diagnostico.html.twig */
class __TwigTemplate_8d66d55da6d1f88bc3deac91f9776036efcfffac343f4e52002c2b1fbef572de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_list_v2.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'simagd_navbar_menu_label' => array($this, 'block_simagd_navbar_menu_label'),
            'simagd_navbar_left_nav' => array($this, 'block_simagd_navbar_left_nav'),
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

";
    }

    // line 19
    public function block_javascripts($context, array $blocks = array())
    {
        // line 20
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
\tvar \$is_tcnlX;
\t
\t\$is_tcnlX\t\t= ";
        // line 25
        if ($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_CREATE")) {
            echo " true ";
        } else {
            echo " false ";
        }
        echo ";

\tconsole.log(\$is_tcnlX);
    </script>
    
    <script type=\"text/javascript\" src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgProcedimientoRealizadoAdmin/prz_diagnostico_config.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 34
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 37
    public function block_tab_menu($context, array $blocks = array())
    {
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
    }

    // line 39
    public function block_simagd_navbar_menu_label($context, array $blocks = array())
    {
        // line 40
        echo "    <i class=\"fa fa-desktop\"></i> <i class=\"fa fa-eye\"></i> <i class=\"fa fa-microphone\"></i> Examen ha sido guardado
";
    }

    // line 43
    public function block_simagd_navbar_left_nav($context, array $blocks = array())
    {
        // line 44
        echo "    <li class=\"list-table-link-navbar ";
        if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_PROCEDIMIENTO_REALIZADO_LIST") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            echo " disabled link-full-disabled ";
        }
        echo "\">
\t<a title=\"Regresar a edición de formulario\" target=\"_self\" class=\"\"
\t    href=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
        echo "\" autofocus>
\t    <span class=\"text-info\"> <i class=\"fa fa-wheelchair\"></i> <i class=\"fa fa-eye-slash\"></i> </span> Procedimientos realizados <span class=\"sr-only\">(current)</span>
\t</a>
    </li>
";
    }

    // line 52
    public function block_simagd_navbar_right_nav($context, array $blocks = array())
    {
    }

    // line 55
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 56
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "

    ";
        // line 58
        $context["study"] = null;
        // line 59
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "examenEstudio"));
        foreach ($context['_seq'] as $context["_key"] => $context["estudio"]) {
            // line 60
            echo "\t";
            $context["study"] = (isset($context["estudio"]) ? $context["estudio"] : $this->getContext($context, "estudio"));
            // line 61
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estudio'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "    ";
        $context["studyParent"] = null;
        // line 63
        echo "    ";
        $context["diagnostic"] = null;
        // line 64
        echo "    ";
        if ((!(null === (isset($context["study"]) ? $context["study"] : $this->getContext($context, "study"))))) {
            // line 65
            echo "\t";
            if ((!(null === $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdEstudioPadre", array(), "method")))) {
                // line 66
                echo "\t    ";
                $context["studyParent"] = $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdEstudioPadre", array(), "method");
                // line 67
                echo "\t    ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["studyParent"]) ? $context["studyParent"] : $this->getContext($context, "studyParent")), "estudioLecturasRealizadas"));
                foreach ($context['_seq'] as $context["_key"] => $context["lectura"]) {
                    if (($this->getAttribute($this->getAttribute((isset($context["lectura"]) ? $context["lectura"] : $this->getContext($context, "lectura")), "getIdEstablecimiento", array(), "method"), "getId", array(), "method") == $this->getAttribute($this->getAttribute((isset($context["studyParent"]) ? $context["studyParent"] : $this->getContext($context, "studyParent")), "getIdEstablecimiento", array(), "method"), "getId", array(), "method"))) {
                        // line 68
                        echo "\t\t";
                        $context["diagnostic"] = (isset($context["lectura"]) ? $context["lectura"] : $this->getContext($context, "lectura"));
                        // line 69
                        echo "\t    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['lectura'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 70
                echo "\t";
            } else {
                // line 71
                echo "\t    ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "estudioLecturasRealizadas"));
                foreach ($context['_seq'] as $context["_key"] => $context["lectura"]) {
                    if (($this->getAttribute($this->getAttribute((isset($context["lectura"]) ? $context["lectura"] : $this->getContext($context, "lectura")), "getIdEstablecimiento", array(), "method"), "getId", array(), "method") == $this->getAttribute($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdEstablecimiento", array(), "method"), "getId", array(), "method"))) {
                        // line 72
                        echo "\t\t";
                        $context["diagnostic"] = (isset($context["lectura"]) ? $context["lectura"] : $this->getContext($context, "lectura"));
                        // line 73
                        echo "\t    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['lectura'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 74
                echo "\t";
            }
            // line 75
            echo "    ";
        }
        // line 76
        echo "    
    <div class=\"anexo-lectura-examen\">

        <div class=\"box box-danger\">
\t    ";
        // line 80
        $context["solicitud"] = $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idSolicitudEstudio");
        // line 81
        echo "            <div class=\"box-header\">
                <h3 class=\"box-title\">Anexar interpretación radiológica</h3>
            </div>
            <div class=\"box-body\">
\t\t<table class=\"table table-hover table-condensed table-responsive table-borderless\">
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "id"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicitado por:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 92
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idEmpleado"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Realizado en:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 96
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idEstablecimientoReferido"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Se registró:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 100
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fechaRegistro"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fechaRegistro"), "H:i:s A")), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Tecnólogo:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 104
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idTecnologoRealiza"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Técnica:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><pre class=\"pre-display-code-natural\">";
        // line 108
        echo _twig_default_filter(trim($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "tecnicaUtilizada")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
        echo "</pre></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Materiales:</span></th>
\t\t\t<td colspan=\"2\" class=\"col-md-5\" >
\t\t\t
\t\t\t    <ul class=\"list-group\">
\t\t\t\t";
        // line 115
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "materialUtilizadoV2"));
        foreach ($context['_seq'] as $context["_key"] => $context["material"]) {
            // line 116
            echo "\t\t\t\t    <li class=\"list-group-item\">
\t\t\t\t\t<span class=\"badge\">";
            // line 117
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "cantidadUtilizada"), "html", null, true);
            echo "</span>
\t\t\t\t\t
\t\t\t\t\t<a  tabindex=\"0\"
\t\t\t\t\t    class=\"btn-link btn-link-v2\"
\t\t\t\t\t    role=\"button\"
\t\t\t\t\t    data-toggle=\"popover\"
\t\t\t\t\t    rel=\"popover\"
\t\t\t\t\t    data-trigger=\"hover\"
\t\t\t\t\t    title=\"";
            // line 125
            echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
            echo "\"
\t\t\t\t\t    data-original-title=\"";
            // line 126
            echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
            echo "\"
\t\t\t\t\t    data-contentwrapper=\".mtrl_container_contentwrapper_id_";
            // line 127
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
            echo "\"
\t\t\t\t\t    data-placement=\"top\"
\t\t\t\t\t    href=\"javascript:void(0)\"
\t\t\t\t\t    data-id=\"";
            // line 130
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
            echo "\" >
\t\t\t\t\t    ";
            // line 131
            echo _twig_default_filter(trim($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method")), "Material sin especificar...");
            echo "
\t\t\t\t\t</a>

\t\t\t\t\t<div class=\"mtrl_container_contentwrapper_id_";
            // line 134
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "id"), "html", null, true);
            echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
\t\t\t\t\t    <strong>Código:</strong> ";
            // line 135
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "getIdMaterial", array(), "method"), "codigo"), "html", null, true);
            echo " <br/>
\t\t\t\t\t    <strong>Cantidad utilizada:</strong> ";
            // line 136
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "cantidadUtilizada"), "html", null, true);
            echo " <br/>
\t\t\t\t\t    ";
            // line 138
            echo "\t\t\t\t\t    <strong>Otras especificaciones:</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["material"]) ? $context["material"] : $this->getContext($context, "material")), "otrasEspecificaciones"), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t    </li>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['material'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 142
        echo "\t\t\t    </ul>
\t\t\t    
\t\t\t</td>
\t\t\t<td class=\"col-md-4\" >
\t\t\t</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3\"></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\">
\t\t\t    <div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
\t\t\t\t<div class=\"btn-group\" role=\"group\">
                                    <a title=\"Recuperar estudio de Servidor PACS\" target=\"_blank\" class=\"btn btn-primary-v2 btn-sm\"
                                        href=\"";
        // line 154
        echo twig_escape_filter($this->env, (((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study"))) ? (_twig_default_filter(trim($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "url")), "javascript:void(0)")) : ("javascript:void(0)")), "html", null, true);
        echo "\"
                                        ";
        // line 155
        if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            // line 156
            echo "                                            disabled=\"disabled\"
                                        ";
        }
        // line 157
        echo ">
                                        <i class=\"glyphicon glyphicon-eye-open\"></i>
                                        Descargar</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"btn-group\" role=\"group\">
                                    <a title=\"Solicitar estudio complementario\" target=\"_blank\" class=\"btn btn-primary-v2 btn-sm ml10\"
                                        href=\"";
        // line 163
        echo twig_escape_filter($this->env, (((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study"))) ? ($this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_complementario_create", array("__prc" => (((!(null === (isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud"))))) ? ($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "id")) : (null)), "__est" => (((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study"))) ? ($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "id")) : (null))))) : ("javascript:void(0)")), "html", null, true);
        // line 164
        echo "\"
                                        ";
        // line 165
        if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (!(null === $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "idSolicitudEstudioComplementario"))))) {
            // line 167
            echo "\t\t\t\t\t    disabled=\"disabled\"
\t\t\t\t\t";
        }
        // line 168
        echo ">
\t\t\t\t\t<i class=\"glyphicon glyphicon-random\"></i>
                                        Complementar</a>
\t\t\t\t</div>
\t\t\t    </div>
\t\t\t</td>
\t\t    </tr>
\t\t    
\t\t</table>
            </div>
        </div>

        <div class=\"box box-danger\">
            <div class=\"box-body\">
                ¿Desea ";
        // line 182
        echo (((!(null === (isset($context["diagnostic"]) ? $context["diagnostic"] : $this->getContext($context, "diagnostic"))))) ? ("editar") : ("iniciar"));
        echo " lectura de este estudio?
            </div>
            <div class=\"box-footer clearfix\">
\t\t<div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t<a title=\"Regresar a edición de formulario\" target=\"_self\" class=\"btn btn-primary-v2 btn-sm \"
\t\t\t    href=\"";
        // line 188
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "edit", 1 => (isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen"))), "method"), "html", null, true);
        echo "\" autofocus>
\t\t\t    <i class=\"fa fa-times\"></i>
\t\t\t    No, Regresar</a>
\t\t    </div>
\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t";
        // line 193
        if ((!(null === (isset($context["diagnostic"]) ? $context["diagnostic"] : $this->getContext($context, "diagnostic"))))) {
            // line 194
            echo "\t\t\t    <a title=\"Iniciar lectura de estudio\" target=\"_self\" class=\"btn btn-element-v2 btn-sm \"
\t\t\t\thref=\"";
            // line 195
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("simagd_lectura_edit", array("id" => $this->getAttribute((isset($context["diagnostic"]) ? $context["diagnostic"] : $this->getContext($context, "diagnostic")), "getId", array(), "method"), "__est" => (((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study"))) ? ($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getId", array(), "method")) : (null)), "__estPdr" => ((((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")) && $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdEstudioPadre", array(), "method"))) ? ($this->getAttribute($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdEstudioPadre", array(), "method"), "getId", array(), "method")) : (null)))), "html", null, true);
            echo "\"
\t\t\t\t";
            // line 196
            if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_EDIT") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (null === (isset($context["study"]) ? $context["study"] : $this->getContext($context, "study"))))) {
                // line 197
                echo "\t\t\t\t    disabled=\"disabled\"
\t\t\t\t";
            }
            // line 198
            echo ">
\t\t\t\t<i class=\"fa fa-save\"></i> <i class=\"fa fa-microphone\"></i>
\t\t\t\tSi, Editar</a>
\t\t\t";
        } else {
            // line 202
            echo "\t\t\t    <a title=\"Iniciar lectura de estudio\" target=\"_self\" class=\"btn btn-element-v2 btn-sm \"
\t\t\t\thref=\"";
            // line 203
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("simagd_lectura_create", array("__est" => (((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study"))) ? ($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getId", array(), "method")) : (null)), "__estPdr" => ((((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")) && $this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdEstudioPadre", array(), "method"))) ? ($this->getAttribute($this->getAttribute((isset($context["study"]) ? $context["study"] : $this->getContext($context, "study")), "getIdEstudioPadre", array(), "method"), "getId", array(), "method")) : (null)), "__xrad" => true, "__xradAnx" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId", array(), "method"), "__przLct" => true)), "html", null, true);
            echo "\"
\t\t\t\t";
            // line 204
            if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (null === (isset($context["study"]) ? $context["study"] : $this->getContext($context, "study"))))) {
                // line 205
                echo "\t\t\t\t    disabled=\"disabled\"
\t\t\t\t";
            }
            // line 206
            echo ">
\t\t\t\t<i class=\"fa fa-save\"></i> <i class=\"fa fa-microphone\"></i>
\t\t\t\tSi, Continuar</a>
\t\t\t";
        }
        // line 210
        echo "\t\t    </div>
\t\t</div>
            </div>
        </div>
    </div>
    
    <div class=\"empty-layout-clear\" style=\"height:76px;\"></div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_diagnostico.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  444 => 210,  438 => 206,  434 => 205,  432 => 204,  428 => 203,  425 => 202,  419 => 198,  415 => 197,  413 => 196,  409 => 195,  406 => 194,  404 => 193,  396 => 188,  387 => 182,  371 => 168,  367 => 167,  365 => 165,  362 => 164,  360 => 163,  352 => 157,  348 => 156,  346 => 155,  342 => 154,  328 => 142,  317 => 138,  313 => 136,  309 => 135,  305 => 134,  299 => 131,  295 => 130,  289 => 127,  285 => 126,  281 => 125,  270 => 117,  267 => 116,  263 => 115,  253 => 108,  246 => 104,  239 => 100,  232 => 96,  225 => 92,  218 => 88,  209 => 81,  207 => 80,  201 => 76,  198 => 75,  195 => 74,  188 => 73,  185 => 72,  179 => 71,  176 => 70,  169 => 69,  166 => 68,  160 => 67,  157 => 66,  154 => 65,  151 => 64,  148 => 63,  145 => 62,  139 => 61,  136 => 60,  131 => 59,  129 => 58,  124 => 56,  121 => 55,  116 => 52,  107 => 46,  99 => 44,  96 => 43,  91 => 40,  88 => 39,  82 => 37,  77 => 34,  70 => 30,  58 => 25,  49 => 20,  46 => 19,  38 => 15,  35 => 14,);
    }
}
