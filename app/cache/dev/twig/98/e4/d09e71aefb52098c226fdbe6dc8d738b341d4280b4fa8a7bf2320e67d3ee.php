<?php

/* MinsalSimagdBundle:ImgLecturaAdmin:lct_estudiosLectura_theme.html.twig */
class __TwigTemplate_98e4d09e71aefb52098c226fdbe6dc8d738b341d4280b4fa8a7bf2320e67d3ee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_form_admin_fields.html.twig");

        $this->blocks = array(
            'form_label' => array($this, 'block_form_label'),
            'choice_widget' => array($this, 'block_choice_widget'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_form_admin_fields.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 8
    public function block_form_label($context, array $blocks = array())
    {
        // line 9
        ob_start();
        // line 10
        echo "
    ";
        // line 11
        $context["label_class"] = " control-label col-sm-3";
        // line 12
        echo "    ";
        // line 17
        echo "
    ";
        // line 19
        echo "    ";
        if ((!((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false))) {
            // line 20
            echo "        ";
            $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => ((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class"), "")) : ("")) . (isset($context["label_class"]) ? $context["label_class"] : $this->getContext($context, "label_class")))));
            // line 21
            echo "
        ";
            // line 22
            if ((!(isset($context["compound"]) ? $context["compound"] : $this->getContext($context, "compound")))) {
                // line 23
                echo "            ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("for" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
                // line 24
                echo "        ";
            }
            // line 25
            echo "        ";
            if ((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) {
                // line 26
                echo "            ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class"), "")) : ("")) . " required"))));
                // line 27
                echo "        ";
            }
            // line 28
            echo "
        ";
            // line 29
            if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
                // line 30
                echo "            ";
                $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
                // line 31
                echo "        ";
            }
            // line 32
            echo "
        ";
            // line 33
            if (((array_key_exists("in_list_checkbox", $context) && (isset($context["in_list_checkbox"]) ? $context["in_list_checkbox"] : $this->getContext($context, "in_list_checkbox"))) && array_key_exists("widget", $context))) {
                // line 34
                echo "            <label";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")));
                foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                    echo " ";
                    echo twig_escape_filter($this->env, (isset($context["attrname"]) ? $context["attrname"] : $this->getContext($context, "attrname")), "html", null, true);
                    echo "=\"";
                    echo twig_escape_filter($this->env, (isset($context["attrvalue"]) ? $context["attrvalue"] : $this->getContext($context, "attrvalue")), "html", null, true);
                    echo "\"";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo " data-prevent-label-for=\"toggle\" class=\"col-xs-12\">
                ";
                // line 35
                echo (isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget"));
                echo "
                ";
                // line 36
                if ((!(null === (isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice"))))) {
                    // line 37
                    echo "\t\t    ";
                    $context["_hasPrc"] = $this->getAttribute($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idProcedimientoRealizado"), "idSolicitudEstudio");
                    // line 38
                    echo "\t\t    ";
                    $context["_hasSolCmpl"] = $this->getAttribute($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idProcedimientoRealizado"), "idSolicitudEstudioComplementario");
                    // line 39
                    echo "\t\t    
\t\t    ";
                    // line 40
                    $context["_origen"] = ((((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")))) && (null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) ? ("med") : ("xrad"));
                    // line 41
                    echo "\t\t    <div class=\"panel-group col-xs-11\" id=\"studiesRx_listChk_study_containerGroup_";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                    echo "\" style=\"float: right; ";
                    echo "\">
\t\t\t<div class=\"panel panel-primary-v2\">
\t\t\t    <a class=\"list-group-item btn-link btn-link-v2\" data-toggle=\"collapse\" href=\"#studiesRx_item_listChk_study_panelCollapse_id_";
                    // line 43
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                    echo "\">
\t\t\t\t<span class=\"badge badge-primary-v2 badge-inverse\" style=\"\">
\t\t\t\t    ";
                    // line 45
                    if (((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")))) && (null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 46
                        echo "\t\t\t\t\t";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")), "idAtenAreaModEstab"), "idAreaModEstab"), "html", null, true);
                        echo "
\t\t\t\t    ";
                    } elseif ((!(null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 48
                        echo "\t\t\t\t\t";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl")), "idSolicitudEstudio"), "idAtenAreaModEstab"), "idAreaModEstab"), "html", null, true);
                        echo "
\t\t\t\t    ";
                    } else {
                        // line 50
                        echo "\t\t\t\t\tOrigen desconocido
\t\t\t\t    ";
                    }
                    // line 52
                    echo "\t\t\t\t</span>
\t\t\t\t";
                    // line 53
                    if (((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")))) && (null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 54
                        echo "\t\t\t\t    ";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")), "idAreaServicioDiagnostico"), "html", null, true);
                        echo "<br/><div class=\"list-group-item-summary-block\" style=\"\"><strong>";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idProcedimientoRealizado"), "studyCustomDescription"), "html", null, true);
                        echo "</strong><br/><strong>PACS UID:</strong> &nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "estudioUid"), "html", null, true);
                        echo "<br/><strong>PACS Fecha:</strong> &nbsp;";
                        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "fechaEstudio"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "fechaEstudio"), "H:i:s A")), "html", null, true);
                        // line 55
                        echo "</div>
\t\t\t\t    ";
                        // line 57
                        echo "\t\t\t\t";
                    } elseif ((!(null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 58
                        echo "\t\t\t\t    <span class=\"text-success-v2\">";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl")), "idAreaServicioDiagnostico"), "html", null, true);
                        echo "</span><br/><div class=\"list-group-item-summary-block\" style=\"\"><strong>";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idProcedimientoRealizado"), "studyCustomDescription"), "html", null, true);
                        echo "</strong><br/><strong>PACS UID:</strong> &nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "estudioUid"), "html", null, true);
                        echo "<br/><strong>PACS Fecha:</strong> &nbsp;";
                        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "fechaEstudio"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "fechaEstudio"), "H:i:s A")), "html", null, true);
                        // line 59
                        echo "<br/><i>Solicitado por Médico Radiólogo para complementar estudio de: &nbsp;<strong>";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl")), "idSolicitudEstudio"), "idAreaServicioDiagnostico"), "nombrearea"), "html", null, true);
                        echo "</strong></i></u></div>
\t\t\t\t    ";
                        // line 61
                        echo "\t\t\t\t";
                    } else {
                        // line 62
                        echo "\t\t\t\t    No puede determinarse la modalidad
\t\t\t\t";
                    }
                    // line 64
                    echo "\t\t\t    </a>
\t\t\t    <div class=\"panel-collapse collapse\" id=\"studiesRx_item_listChk_study_panelCollapse_id_";
                    // line 65
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                    echo "\">
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t    <input type=\"hidden\" value=\"\"
\t\t\t\t\t    id=\"fieldOrigenSol_";
                    // line 68
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                    echo "\"
\t\t\t\t\t    name=\"fieldOrigenSol_[";
                    // line 69
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                    echo "]\"
\t\t\t\t\t    data-origen=\"";
                    // line 70
                    echo twig_escape_filter($this->env, (isset($context["_origen"]) ? $context["_origen"] : $this->getContext($context, "_origen")), "html", null, true);
                    echo "\" data-estudio-id=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                    echo "\" />
\t\t\t\t    
\t\t\t\t    <span style=\"margin-left: 25px;\">
\t\t\t\t\tEstudio de:&nbsp;
\t\t\t\t\t<span class=\"
\t\t\t\t\t    ";
                    // line 75
                    if (((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")))) && (null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 76
                        echo "\t\t\t\t\t\ttext-primary-v2\">";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")), "idAreaServicioDiagnostico"), "html", null, true);
                        echo "
\t\t\t\t\t    ";
                    } elseif ((!(null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 78
                        echo "\t\t\t\t\t\ttext-success-v2\">";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl")), "idAreaServicioDiagnostico"), "html", null, true);
                        echo "
\t\t\t\t\t    ";
                    } else {
                        // line 80
                        echo "\t\t\t\t\t\ttext-info\"><i class=\"fa fa-exclamation-triangle\"></i> <i class=\"text-danger\"> No puede determinarse la modalidad</i>
\t\t\t\t\t    ";
                    }
                    // line 82
                    echo "\t\t\t\t\t</span>
\t\t\t\t    </span>
\t\t\t\t    <div class=\"col-xs-12 col-xs-12\" style=\"";
                    // line 84
                    echo "\">
\t\t\t\t\t<table class=\"table table-condensed ";
                    // line 85
                    echo " simagd-normal-td table-no-bordered table-hover non-top-bordered-table list-group-item-contain-table\">
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\"></span></th>
\t\t\t\t\t\t<td class=\"col-xs-10 ";
                    // line 88
                    echo "\" colspan=\"2\">
\t\t\t\t\t\t    <div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
\t\t\t\t\t\t\t";
                    // line 99
                    echo "
\t\t\t\t\t\t\t";
                    // line 101
                    echo "
\t\t\t\t\t\t\t<div class=\"btn-group\" role=\"group\">
\t\t\t\t\t\t\t    <button type=\"button\" class=\"btn btn-primary-v2 btn-sm dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Visualizar estudio\" ";
                    // line 103
                    if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                        echo " disabled=\"disabled\" ";
                    }
                    echo ">
\t\t\t\t\t\t\t\t<i class=\"glyphicon glyphicon-eye-open\"></i>
\t\t\t\t\t\t\t\t&nbsp;Visualizar estudio <span class=\"caret\"></span>
\t\t\t\t\t\t\t    </button>
\t\t\t\t\t\t\t    <ul class=\"dropdown-menu\" style=\"right: 0; left: auto;\" >
\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t    <a href=\"javascript:void(0)\" id=\"btn_solcmpl_study_url_weasis\" target=\"_blank\" title=\"Descargar estudio\" ";
                    // line 109
                    if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                        echo " disabled=\"disabled\" ";
                    }
                    echo ">
\t\t\t\t\t\t\t\t\t<i class=\"glyphicon glyphicon-save\"></i> Weasis
\t\t\t\t\t\t\t\t    </a>
\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t    <a href=\"javascript:void(0)\" id=\"btn_solcmpl_study_url_oviyam2\" target=\"_blank\" title=\"Visualizar estudio en web\" ";
                    // line 114
                    if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
                        echo " disabled=\"disabled\" ";
                    }
                    echo ">
\t\t\t\t\t\t\t\t\t<i class=\"glyphicon glyphicon-play-circle\"></i> Oviyam2
\t\t\t\t\t\t\t\t    </a>
\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t    </ul>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t";
                    // line 122
                    echo "
\t\t\t\t\t\t\t";
                    // line 134
                    echo "                                                        <div class=\"btn-group\" role=\"group\">
                                                            <a id=\"create_solcmpl_for_study__";
                    // line 135
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                    echo "\" title=\"Solicitar estudio complementario\" target=\"_blank\" class=\"btn btn-primary-v2 btn-sm\" href=\"javascript:void(0)\"
                                                                ";
                    // line 136
                    if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (!(null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl")))))) {
                        // line 138
                        echo "                                                                    disabled=\"disabled\"
                                                                ";
                    } else {
                        // line 140
                        echo "                                                                    data-add-new-request-for-study=\"true\" data-study-rq-id=\"";
                        echo twig_escape_filter($this->env, (((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc"))))) ? ($this->getAttribute((isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")), "id")) : (null)), "html", null, true);
                        echo "\" data-study-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                        echo "\" data-study-url=\"";
                        echo twig_escape_filter($this->env, _twig_default_filter(trim($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "url")), "javascript:void(0)"), "html", null, true);
                        echo "\"
                                                                ";
                    }
                    // line 141
                    echo ">
                                                                <i class=\"fa fa-external-link\"></i>
                                                                Complementar</a>
                                                        </div>
                                                    </div>
\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\">RIS ID</span></th>
\t\t\t\t\t\t<td class=\"col-xs-10\" colspan=\"2\">
\t\t\t\t\t\t    ";
                    // line 152
                    echo "\t\t\t\t\t\t\t<span class=\"badge\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t    ";
                    // line 154
                    echo "\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Solicitó</span></th>
\t\t\t\t\t\t<td class=\"col-xs-10\" colspan=\"2\">
\t\t\t\t\t\t    ";
                    // line 160
                    echo "\t\t\t\t\t\t\t";
                    if (((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")))) && (null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 161
                        echo "\t\t\t\t\t\t\t    ";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")), "idEmpleado"), "html", null, true);
                        echo "
\t\t\t\t\t\t\t";
                    } elseif ((!(null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 163
                        echo "\t\t\t\t\t\t\t    ";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl")), "idRadiologoSolicita"), "html", null, true);
                        echo "
\t\t\t\t\t\t\t";
                    } else {
                        // line 165
                        echo "\t\t\t\t\t\t\t    <i class=\"fa fa-exclamation-triangle\"></i> Indeterminado
\t\t\t\t\t\t\t";
                    }
                    // line 167
                    echo "\t\t\t\t\t\t    ";
                    // line 168
                    echo "\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    ";
                    // line 170
                    if (((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")))) && (null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 171
                        echo "\t\t\t\t\t\t<tr>
\t\t\t\t\t\t    <th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\"></span></th>
\t\t\t\t\t\t    <td class=\"col-xs-10\" colspan=\"2\">
\t\t\t\t\t\t\t<span class=\"text-info\">
\t\t\t\t\t\t\t    <u><i>";
                        // line 175
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")), "idAtenAreaModEstab"), "nombreConsulta"), "html", null, true);
                        echo "</i></u>
\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t    </td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t    ";
                    }
                    // line 180
                    echo "\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Realizado en</span></th>
\t\t\t\t\t\t<td class=\"col-xs-10\" colspan=\"2\">
\t\t\t\t\t\t    ";
                    // line 184
                    echo "\t\t\t\t\t\t\t";
                    // line 191
                    echo "\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idEstablecimiento"), "html", null, true);
                    echo "
\t\t\t\t\t\t    ";
                    // line 193
                    echo "\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Examinó</span></th>
\t\t\t\t\t\t<td class=\"col-xs-10\" colspan=\"2\">
\t\t\t\t\t\t    ";
                    // line 199
                    echo "\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idProcedimientoRealizado"), "idTecnologoRealiza"), "html", null, true);
                    echo "
\t\t\t\t\t\t    ";
                    // line 201
                    echo "\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\"></span></th>
\t\t\t\t\t\t<td class=\"col-xs-10\" colspan=\"2\">
\t\t\t\t\t\t    ";
                    // line 207
                    echo "\t\t\t\t\t\t\t";
                    if (((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")))) && (null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 208
                        echo "\t\t\t\t\t\t\t    <span class=\"text-info\">
\t\t\t\t\t\t\t\t<u><i>";
                        // line 209
                        echo "Estudio solicitado por médico referente";
                        echo "</i></u>
\t\t\t\t\t\t\t    </span>
\t\t\t\t\t\t\t";
                    } elseif ((!(null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 212
                        echo "\t\t\t\t\t\t\t    ";
                        if ((!(null === $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idEstudioPadre")))) {
                            // line 213
                            echo "\t\t\t\t\t\t\t\t";
                            $context["_hasFather"] = $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idEstudioPadre");
                            // line 214
                            echo "\t\t\t\t\t\t\t\t";
                            $context["_hasFatherPrc"] = $this->getAttribute($this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "idProcedimientoRealizado"), "idSolicitudEstudio");
                            // line 215
                            echo "\t\t\t\t\t\t\t\t<a  tabindex=\"0\"
\t\t\t\t\t\t\t\t    class=\"btn-link btn-link-v2\"
\t\t\t\t\t\t\t\t    role=\"button\"
\t\t\t\t\t\t\t\t    data-toggle=\"popover\"
\t\t\t\t\t\t\t\t    rel=\"popover\"
\t\t\t\t\t\t\t\t    data-trigger=\"click\"
                                                                    title=\"<i class='fa fa-share-square-o'></i> ";
                            // line 221
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasFatherPrc"]) ? $context["_hasFatherPrc"] : $this->getContext($context, "_hasFatherPrc")), "idAreaServicioDiagnostico"), "html", null, true);
                            echo "\"
\t\t\t\t\t\t\t\t    data-original-title=\"";
                            // line 222
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasFatherPrc"]) ? $context["_hasFatherPrc"] : $this->getContext($context, "_hasFatherPrc")), "idAreaServicioDiagnostico"), "html", null, true);
                            echo "\"
\t\t\t\t\t\t\t\t    data-contentwrapper=\".lctEst_container_contentwrapper_father_id_";
                            // line 223
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "id"), "html", null, true);
                            echo "\"
\t\t\t\t\t\t\t\t    ";
                            // line 225
                            echo "\t\t\t\t\t\t\t\t    data-placement=\"top\"
\t\t\t\t\t\t\t\t    href=\"javascript:void(0)\"
\t\t\t\t\t\t\t\t    data-id=\"";
                            // line 227
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "id"), "html", null, true);
                            echo "\" >
\t\t\t\t\t\t\t\t    <u><i>";
                            // line 228
                            echo "Estudio adicional solicitado por Médico Radiólogo";
                            echo "</i></u>
\t\t\t\t\t\t\t\t</a>

\t\t\t\t\t\t\t\t";
                            // line 231
                            try {
                                $this->env->loadTemplate("MinsalSimagdBundle:ImgLecturaAdmin:lct_lctEst_event_contentwrapper.html.twig")->display(array_merge($context, array("_hasFather" => (isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "_hasFatherPrc" => (isset($context["_hasFatherPrc"]) ? $context["_hasFatherPrc"] : $this->getContext($context, "_hasFatherPrc")), "object_child_patientStudies_collectionChoice" => (isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")))));
                            } catch (Twig_Error_Loader $e) {
                                // ignore missing template
                            }

                            // line 237
                            echo "\t\t\t\t\t\t\t    ";
                        }
                        // line 238
                        echo "\t\t\t\t\t\t\t";
                    } else {
                        // line 239
                        echo "\t\t\t\t\t\t\t    <i class=\"fa fa-exclamation-triangle\"></i> <i class=\"text-danger\"> No puede determinarse el origen</i>
\t\t\t\t\t\t\t";
                    }
                    // line 241
                    echo "\t\t\t\t\t\t    ";
                    // line 242
                    echo "\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Descripción</span></th>
\t\t\t\t\t\t<td class=\"col-xs-10\" colspan=\"2\">
\t\t\t\t\t\t    <span class=\"text-success-v2\">
\t\t\t\t\t\t\t";
                    // line 249
                    echo "\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "idProcedimientoRealizado"), "studyCustomDescription"), "html", null, true);
                    echo "
\t\t\t\t\t\t    </span>
\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<th class=\"col-xs-2 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Proyecciones</span></th>
\t\t\t\t\t\t<td class=\"col-xs-10\" colspan=\"2\">
\t\t\t\t\t\t    ";
                    // line 256
                    if (((!(null === (isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")))) && (null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 257
                        echo "\t\t\t\t\t\t\t";
                        $context["examenesLoop"] = array();
                        // line 258
                        echo "\t\t\t\t\t\t\t";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")), "solicitudEstudioProyeccion"));
                        foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                            // line 259
                            echo "\t\t\t\t\t\t\t    ";
                            $context["i"] = ("_" . $this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id"));
                            // line 260
                            echo "\t\t\t\t\t\t\t    
\t\t\t\t\t\t\t    ";
                            // line 261
                            if (!twig_in_filter((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), twig_get_array_keys_filter((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop"))))) {
                                // line 262
                                echo "\t\t\t\t\t\t\t\t";
                                $context["examenesLoop"] = twig_array_merge((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop")), array((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) => $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico")));
                                // line 263
                                echo "\t\t\t\t\t\t\t    ";
                            }
                            // line 264
                            echo "\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 265
                        echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<ul class=\"list-unstyled\">
\t\t\t\t\t\t\t    ";
                        // line 267
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop")));
                        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                            // line 268
                            echo "\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t    <strong> ";
                            // line 269
                            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
                            echo " </strong>
\t\t\t\t\t\t\t\t    <ul class=\"list-unstyled\" style=\"margin-left: 25px;\">
\t\t\t\t\t\t\t\t\t";
                            // line 271
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["_hasPrc"]) ? $context["_hasPrc"] : $this->getContext($context, "_hasPrc")), "solicitudEstudioProyeccion"));
                            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                                if (($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == trim((isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "_"))) {
                                    // line 272
                                    echo "\t\t\t\t\t\t\t\t\t    <li>
\t\t\t\t\t\t\t\t\t\t<a  tabindex=\"0\"
\t\t\t\t\t\t\t\t\t\t    class=\"btn-link btn-link-v2\"
\t\t\t\t\t\t\t\t\t\t    role=\"button\"
\t\t\t\t\t\t\t\t\t\t    data-toggle=\"popover\"
\t\t\t\t\t\t\t\t\t\t    rel=\"popover\"
\t\t\t\t\t\t\t\t\t\t    data-trigger=\"hover\"
                                                                                    title=\"<i class='fa fa-list-alt'></i> ";
                                    // line 279
                                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                                    echo "\"
\t\t\t\t\t\t\t\t\t\t    data-original-title=\"";
                                    // line 280
                                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                                    echo "\"
\t\t\t\t\t\t\t\t\t\t    data-contentwrapper=\".prc_container_contentwrapper_id_";
                                    // line 281
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                                    echo "\"
\t\t\t\t\t\t\t\t\t\t    data-placement=\"top\"
\t\t\t\t\t\t\t\t\t\t    href=\"javascript:void(0)\"
\t\t\t\t\t\t\t\t\t\t    data-id=\"";
                                    // line 284
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                                    echo "\" >
\t\t\t\t\t\t\t\t\t\t    ";
                                    // line 285
                                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                                    echo "
\t\t\t\t\t\t\t\t\t\t</a>

\t\t\t\t\t\t\t\t\t\t<div class=\"prc_container_contentwrapper_id_";
                                    // line 288
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                                    echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
\t\t\t\t\t\t\t\t\t\t    <table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
\t\t\t\t\t\t\t\t\t\t\t<tr><th class=\"col-md-5\">Código:</th><td class=\"col-md-7\">";
                                    // line 290
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "codigo"), "html", null, true);
                                    echo "</td></tr>
\t\t\t\t\t\t\t\t\t\t\t<tr><th class=\"col-md-5\">Tiempo en sala:</th><td class=\"col-md-7\">";
                                    // line 291
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoOcupacionSala"), "html", null, true);
                                    echo "</td></tr>
\t\t\t\t\t\t\t\t\t\t\t<tr><th class=\"col-md-5\">Tiempo por médico:</th><td class=\"col-md-7\">";
                                    // line 292
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoMedico"), "html", null, true);
                                    echo "</td></tr>
\t\t\t\t\t\t\t\t\t\t\t<tr><th class=\"col-md-5\">Descripción:</th><td class=\"col-md-7\"><pre class=\"pre-display-code-natural\">";
                                    // line 293
                                    echo _twig_default_filter(trim($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "descripcion")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
                                    echo "</pre></td></tr>
\t\t\t\t\t\t\t\t\t\t    </table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t    </li>
\t\t\t\t\t\t\t\t\t";
                                }
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 298
                            echo "\t\t\t\t\t\t\t\t    </ul>
\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 301
                        echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t    ";
                    } elseif ((!(null === (isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl"))))) {
                        // line 303
                        echo "\t\t\t\t\t\t\t";
                        $context["examenesLoop"] = array();
                        // line 304
                        echo "\t\t\t\t\t\t\t";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl")), "solicitudEstudioComplementarioProyeccion"));
                        foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                            // line 305
                            echo "\t\t\t\t\t\t\t    ";
                            $context["i"] = ("_" . $this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id"));
                            // line 306
                            echo "\t\t\t\t\t\t\t    
\t\t\t\t\t\t\t    ";
                            // line 307
                            if (!twig_in_filter((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), twig_get_array_keys_filter((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop"))))) {
                                // line 308
                                echo "\t\t\t\t\t\t\t\t";
                                $context["examenesLoop"] = twig_array_merge((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop")), array((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) => $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico")));
                                // line 309
                                echo "\t\t\t\t\t\t\t    ";
                            }
                            // line 310
                            echo "\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 311
                        echo "\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<ul class=\"list-unstyled\">
\t\t\t\t\t\t\t    ";
                        // line 313
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["examenesLoop"]) ? $context["examenesLoop"] : $this->getContext($context, "examenesLoop")));
                        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                            // line 314
                            echo "\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t    <strong> ";
                            // line 315
                            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
                            echo " </strong>
\t\t\t\t\t\t\t\t    <ul class=\"list-unstyled\" style=\"margin-left: 25px;\">
\t\t\t\t\t\t\t\t\t";
                            // line 317
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["_hasSolCmpl"]) ? $context["_hasSolCmpl"] : $this->getContext($context, "_hasSolCmpl")), "solicitudEstudioComplementarioProyeccion"));
                            foreach ($context['_seq'] as $context["_key"] => $context["proyeccion"]) {
                                if (($this->getAttribute($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "idExamenServicioDiagnostico"), "id") == trim((isset($context["key"]) ? $context["key"] : $this->getContext($context, "key")), "_"))) {
                                    // line 318
                                    echo "\t\t\t\t\t\t\t\t\t    <li>
\t\t\t\t\t\t\t\t\t\t<a  tabindex=\"0\"
\t\t\t\t\t\t\t\t\t\t    class=\"btn-link btn-link-v2\"
\t\t\t\t\t\t\t\t\t\t    role=\"button\"
\t\t\t\t\t\t\t\t\t\t    data-toggle=\"popover\"
\t\t\t\t\t\t\t\t\t\t    rel=\"popover\"
\t\t\t\t\t\t\t\t\t\t    data-trigger=\"hover\"
                                                                                    title=\"<i class='fa fa-list-alt'></i> ";
                                    // line 325
                                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                                    echo "\"
\t\t\t\t\t\t\t\t\t\t    data-original-title=\"";
                                    // line 326
                                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                                    echo "\"
\t\t\t\t\t\t\t\t\t\t    data-contentwrapper=\".solcmpl_container_contentwrapper_id_";
                                    // line 327
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                                    echo "\"
\t\t\t\t\t\t\t\t\t\t    data-placement=\"top\"
\t\t\t\t\t\t\t\t\t\t    href=\"javascript:void(0)\"
\t\t\t\t\t\t\t\t\t\t    data-id=\"";
                                    // line 330
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                                    echo "\" >
\t\t\t\t\t\t\t\t\t\t    ";
                                    // line 331
                                    echo twig_escape_filter($this->env, (isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "html", null, true);
                                    echo "
\t\t\t\t\t\t\t\t\t\t</a>

\t\t\t\t\t\t\t\t\t\t<div class=\"solcmpl_container_contentwrapper_id_";
                                    // line 334
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "id"), "html", null, true);
                                    echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
\t\t\t\t\t\t\t\t\t\t    <table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
\t\t\t\t\t\t\t\t\t\t\t<tr><th class=\"col-md-5\">Código:</th><td class=\"col-md-7\">";
                                    // line 336
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "codigo"), "html", null, true);
                                    echo "</td></tr>
\t\t\t\t\t\t\t\t\t\t\t<tr><th class=\"col-md-5\">Tiempo en sala:</th><td class=\"col-md-7\">";
                                    // line 337
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoOcupacionSala"), "html", null, true);
                                    echo "</td></tr>
\t\t\t\t\t\t\t\t\t\t\t<tr><th class=\"col-md-5\">Tiempo por médico:</th><td class=\"col-md-7\">";
                                    // line 338
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "tiempoMedico"), "html", null, true);
                                    echo "</td></tr>
\t\t\t\t\t\t\t\t\t\t\t<tr><th class=\"col-md-5\">Descripción:</th><td class=\"col-md-7\"><pre class=\"pre-display-code-natural\">";
                                    // line 339
                                    echo _twig_default_filter(trim($this->getAttribute((isset($context["proyeccion"]) ? $context["proyeccion"] : $this->getContext($context, "proyeccion")), "descripcion")), "<span style=\"color: #bbb;\">Sin especificar...</span>");
                                    echo "</pre></td></tr>
\t\t\t\t\t\t\t\t\t\t    </table>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t    </li>
\t\t\t\t\t\t\t\t\t";
                                }
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proyeccion'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 344
                            echo "\t\t\t\t\t\t\t\t    </ul>
\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 347
                        echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t    ";
                    } else {
                        // line 349
                        echo "\t\t\t\t\t\t\t<i class=\"fa fa-exclamation-triangle\"></i> <i class=\"text-danger\"> No pueden determinarse las proyecciones</i>
\t\t\t\t\t\t    ";
                    }
                    // line 351
                    echo "\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t    <tr>
\t\t\t\t\t\t<td class=\"col-xs-12\" colspan=\"2\" style=\"text-align:right\">
\t\t\t\t\t\t    <span class=\"label label-primary-v2\" style=\"text-align: right; vertical-align: bottom;\">
\t\t\t\t\t\t\tPACS: ";
                    // line 356
                    echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "fechaEstudio"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "fechaEstudio"), "H:i:s A")), "html", null, true);
                    // line 357
                    echo "
\t\t\t\t\t\t    </span>
\t\t\t\t\t\t</td>
\t\t\t\t\t    </tr>
\t\t\t\t\t</table>
\t\t\t\t    </div>
\t\t\t\t</div>
\t\t\t    </div>
\t\t\t</div>
\t\t    </div>
                ";
                } else {
                    // line 368
                    echo "                    <span>
                        ";
                    // line 369
                    if ((!$this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"))) {
                        // line 370
                        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
                    } else {
                        // line 372
                        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "translationDomain")), "html", null, true);
                    }
                    // line 374
                    echo "                    </span>
                ";
                }
                // line 376
                echo "            </label>
        ";
            } else {
                // line 378
                echo "            <label";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")));
                foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                    echo " ";
                    echo twig_escape_filter($this->env, (isset($context["attrname"]) ? $context["attrname"] : $this->getContext($context, "attrname")), "html", null, true);
                    echo "=\"";
                    echo twig_escape_filter($this->env, (isset($context["attrvalue"]) ? $context["attrvalue"] : $this->getContext($context, "attrvalue")), "html", null, true);
                    echo "\"";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo ">
                ";
                // line 379
                if ((!$this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"))) {
                    // line 380
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
                } else {
                    // line 382
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"), "trans", array(0 => (isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), 1 => array(), 2 => $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "translationDomain")), "method"), "html", null, true);
                    echo "
                ";
                }
                // line 384
                echo "            </label>
        ";
            }
            // line 386
            echo "    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 390
    public function block_choice_widget($context, array $blocks = array())
    {
        // line 391
        ob_start();
        // line 392
        echo "    ";
        if ((isset($context["compound"]) ? $context["compound"] : $this->getContext($context, "compound"))) {
            // line 393
            echo "\t<div style=\"overflow-y: auto; ";
            echo " max-height: 1176px;\" id=\"form_editTemplate_estudiosLectura_collection\">
\t    <ul ";
            // line 394
            $this->displayBlock("widget_container_attributes_choice_widget", $context, $blocks);
            echo ">
\t\t";
            // line 397
            echo "\t    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 398
                echo "                <li>
                    ";
                // line 399
                ob_start();
                // line 400
                echo "                        ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["child"]) ? $context["child"] : $this->getContext($context, "child")), 'widget', array("horizontal" => true, "horizontal_input_wrapper_class" => ""));
                echo " ";
                // line 401
                echo "                    ";
                $context["form_widget_content"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                // line 402
                echo "                    ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["child"]) ? $context["child"] : $this->getContext($context, "child")), 'label', array("in_list_checkbox" => true, "widget" => (isset($context["form_widget_content"]) ? $context["form_widget_content"] : $this->getContext($context, "form_widget_content")), "object_child_patientStudies_collectionChoice" => $this->getAttribute($this->getAttribute((isset($context["choices"]) ? $context["choices"] : $this->getContext($context, "choices")), $this->getAttribute($this->getAttribute((isset($context["child"]) ? $context["child"] : $this->getContext($context, "child")), "vars"), "value"), array(), "array"), "data")) + (twig_test_empty($_label_ = (($this->getAttribute($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "vars", array(), "any", false, true), "label", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "vars", array(), "any", false, true), "label"), null)) : (null))) ? array() : array("label" => $_label_)));
                // line 403
                echo "
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 406
            echo "            </ul>
\t</div>
    ";
        } else {
            // line 409
            echo "    ";
            if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin") && (!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"), "getConfigurationPool", array(), "method"), "getOption", array(0 => "use_select2"), "method")))) {
                // line 410
                echo "        ";
                $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class"), "")) : ("")) . " form-control")));
                // line 411
                echo "    ";
            }
            // line 412
            echo "    <select ";
            $this->displayBlock("widget_attributes", $context, $blocks);
            if ((isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))) {
                echo " multiple=\"multiple\"";
            }
            echo ">
        ";
            // line 413
            if ((!(null === (isset($context["empty_value"]) ? $context["empty_value"] : $this->getContext($context, "empty_value"))))) {
                // line 414
                echo "            <option value=\"\">
                ";
                // line 415
                if ((!$this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"))) {
                    // line 416
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["empty_value"]) ? $context["empty_value"] : $this->getContext($context, "empty_value")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
                } else {
                    // line 418
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["empty_value"]) ? $context["empty_value"] : $this->getContext($context, "empty_value")), array(), $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "translationDomain")), "html", null, true);
                }
                // line 420
                echo "            </option>
        ";
            }
            // line 422
            echo "        ";
            if ((twig_length_filter($this->env, (isset($context["preferred_choices"]) ? $context["preferred_choices"] : $this->getContext($context, "preferred_choices"))) > 0)) {
                // line 423
                echo "            ";
                $context["options"] = (isset($context["preferred_choices"]) ? $context["preferred_choices"] : $this->getContext($context, "preferred_choices"));
                // line 424
                echo "            ";
                $this->displayBlock("choice_widget_options", $context, $blocks);
                echo "
            ";
                // line 425
                if ((twig_length_filter($this->env, (isset($context["choices"]) ? $context["choices"] : $this->getContext($context, "choices"))) > 0)) {
                    // line 426
                    echo "                <option disabled=\"disabled\">";
                    echo twig_escape_filter($this->env, (isset($context["separator"]) ? $context["separator"] : $this->getContext($context, "separator")), "html", null, true);
                    echo "</option>
            ";
                }
                // line 428
                echo "        ";
            }
            // line 429
            echo "        ";
            $context["options"] = (isset($context["choices"]) ? $context["choices"] : $this->getContext($context, "choices"));
            // line 430
            echo "        ";
            $this->displayBlock("choice_widget_options", $context, $blocks);
            echo "
    </select>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgLecturaAdmin:lct_estudiosLectura_theme.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  946 => 430,  943 => 429,  940 => 428,  934 => 426,  932 => 425,  927 => 424,  924 => 423,  921 => 422,  917 => 420,  914 => 418,  911 => 416,  909 => 415,  906 => 414,  904 => 413,  896 => 412,  893 => 411,  890 => 410,  887 => 409,  882 => 406,  874 => 403,  871 => 402,  868 => 401,  864 => 400,  862 => 399,  859 => 398,  854 => 397,  850 => 394,  846 => 393,  843 => 392,  841 => 391,  838 => 390,  832 => 386,  828 => 384,  822 => 382,  819 => 380,  817 => 379,  801 => 378,  797 => 376,  793 => 374,  790 => 372,  787 => 370,  785 => 369,  782 => 368,  769 => 357,  767 => 356,  760 => 351,  756 => 349,  752 => 347,  744 => 344,  732 => 339,  728 => 338,  724 => 337,  720 => 336,  715 => 334,  709 => 331,  705 => 330,  699 => 327,  695 => 326,  691 => 325,  682 => 318,  677 => 317,  672 => 315,  669 => 314,  665 => 313,  661 => 311,  655 => 310,  652 => 309,  649 => 308,  647 => 307,  644 => 306,  641 => 305,  636 => 304,  633 => 303,  629 => 301,  621 => 298,  609 => 293,  605 => 292,  601 => 291,  597 => 290,  592 => 288,  586 => 285,  582 => 284,  576 => 281,  572 => 280,  568 => 279,  559 => 272,  554 => 271,  549 => 269,  546 => 268,  542 => 267,  538 => 265,  532 => 264,  529 => 263,  526 => 262,  524 => 261,  521 => 260,  518 => 259,  513 => 258,  510 => 257,  508 => 256,  497 => 249,  489 => 242,  487 => 241,  483 => 239,  480 => 238,  477 => 237,  470 => 231,  464 => 228,  460 => 227,  456 => 225,  450 => 223,  446 => 222,  442 => 221,  434 => 215,  431 => 214,  428 => 213,  425 => 212,  419 => 209,  416 => 208,  413 => 207,  406 => 201,  401 => 199,  394 => 193,  389 => 191,  387 => 184,  382 => 180,  374 => 175,  368 => 171,  366 => 170,  362 => 168,  360 => 167,  356 => 165,  350 => 163,  344 => 161,  341 => 160,  334 => 154,  329 => 152,  317 => 141,  307 => 140,  303 => 138,  301 => 136,  297 => 135,  294 => 134,  291 => 122,  279 => 114,  269 => 109,  258 => 103,  254 => 101,  251 => 99,  247 => 88,  242 => 85,  239 => 84,  235 => 82,  231 => 80,  225 => 78,  219 => 76,  217 => 75,  207 => 70,  203 => 69,  199 => 68,  193 => 65,  190 => 64,  186 => 62,  183 => 61,  178 => 59,  169 => 58,  166 => 57,  163 => 55,  154 => 54,  152 => 53,  149 => 52,  145 => 50,  139 => 48,  133 => 46,  131 => 45,  126 => 43,  119 => 41,  117 => 40,  114 => 39,  111 => 38,  108 => 37,  106 => 36,  102 => 35,  86 => 34,  84 => 33,  81 => 32,  78 => 31,  75 => 30,  73 => 29,  70 => 28,  67 => 27,  64 => 26,  61 => 25,  58 => 24,  55 => 23,  53 => 22,  50 => 21,  47 => 20,  44 => 19,  41 => 17,  39 => 12,  37 => 11,  34 => 10,  32 => 9,  29 => 8,);
    }
}
