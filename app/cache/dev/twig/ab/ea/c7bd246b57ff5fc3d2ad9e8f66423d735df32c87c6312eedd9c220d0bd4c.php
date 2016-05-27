<?php

/* MinsalSimagdBundle:ImgLecturaAdmin:lct_lctEst_event_contentwrapper.html.twig */
class __TwigTemplate_abeac7bd246b57ff5fc3d2ad9e8f66423d735df32c87c6312eedd9c220d0bd4c extends Twig_Template
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
        echo "

    <div class=\"lctEst_container_contentwrapper_father_id_";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_child_patientStudies_collectionChoice"]) ? $context["object_child_patientStudies_collectionChoice"] : $this->getContext($context, "object_child_patientStudies_collectionChoice")), "id"), "html", null, true);
        echo "_";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "id"), "html", null, true);
        echo "\" style=\"display: none;\"> <!-- Here i define my content and add an attribute data-contentwrapper t0 a selector-->
\t<table class=\"table table-hover table-condensed table-responsive table-borderless\">
\t    <tr>
\t\t<th class=\"col-md-3\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "id"), "html", null, true);
        echo "</span></td>
\t    </tr>
\t    <tr>
\t\t<th class=\"col-md-3\"><span class=\"simagd-text-primary\">Solicitado por:</span></th>
\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasFatherPrc"]) ? $context["_hasFatherPrc"] : $this->getContext($context, "_hasFatherPrc")), "idEmpleado"), "html", null, true);
        echo "</td>
\t    </tr>
\t    <tr>
\t\t<th class=\"col-md-3\"><span class=\"simagd-text-primary\">Realizado en:</span></th>
\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "idEstablecimiento"), "html", null, true);
        echo "</td>
\t    </tr>
\t    <tr>
\t\t<th class=\"col-md-3\"><span class=\"simagd-text-primary\">Tecnólogo:</span></th>
\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "idProcedimientoRealizado"), "idTecnologoRealiza"), "html", null, true);
        echo "</td>
\t    </tr>
\t    ";
        // line 27
        echo "\t    <tr>
\t\t<td colspan=\"4\" class=\"col-md-12\">
\t\t    <div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
\t\t\t<div class=\"btn-group\" role=\"group\">
\t\t\t    <a class=\"btn btn-primary-v2 btn-sm editable-submit download-estudio-padre-popover-action\" href=\"";
        // line 31
        echo twig_escape_filter($this->env, _twig_default_filter(trim($this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "url")), "javascript:void(0)"), "html", null, true);
        echo "\" target=\"_blank\" title=\"Descargar este estudio\"
\t\t\t\t";
        // line 32
        if ((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_ESTUDIO_PACIENTE_VIEW") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            // line 33
            echo "\t\t\t\t    disabled=\"disabled\"
\t\t\t\t";
        }
        // line 34
        echo ">
\t\t\t\t<i class=\"glyphicon glyphicon-eye-open\"></i>
\t\t\t    </a>
\t\t\t</div>
\t\t\t<div class=\"btn-group\" role=\"group\">
\t\t\t    <a class=\"btn btn-success-v2 btn-sm editable-submit add-estudio-padre-popover-action\" target=\"_blank\" title=\"Complementar este estudio\"
\t\t\t\thref=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_complementario_create", array("__prc" => (((!(null === (isset($context["_hasFatherPrc"]) ? $context["_hasFatherPrc"] : $this->getContext($context, "_hasFatherPrc"))))) ? ($this->getAttribute((isset($context["_hasFatherPrc"]) ? $context["_hasFatherPrc"] : $this->getContext($context, "_hasFatherPrc")), "id")) : (null)), "__est" => $this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "id"))), "html", null, true);
        // line 41
        echo "\"
\t\t\t\t";
        // line 42
        if (((!($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_SOLICITUD_ESTUDIO_COMPLEMENTARIO_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_ADMIN"))) || (!(null === $this->getAttribute($this->getAttribute((isset($context["_hasFather"]) ? $context["_hasFather"] : $this->getContext($context, "_hasFather")), "idProcedimientoRealizado"), "idSolicitudEstudioComplementario"))))) {
            // line 44
            echo "\t\t\t\t    disabled=\"disabled\"
\t\t\t\t";
        }
        // line 45
        echo ">
\t\t\t\t<i class=\"glyphicon glyphicon-random\"></i>
\t\t\t    </a>
\t\t\t</div>
\t\t\t<div class=\"btn-group\" role=\"group\">
\t\t\t    <a class=\"btn btn-default btn-sm editable-cancel close-estudio-padre-popover-action\" href=\"javascript:void(0)\" title=\"Cerrar\"><i class=\"glyphicon glyphicon-remove\"></i></a>
\t\t\t</div>
\t\t    </div>
\t\t</td>
\t    </tr>
\t    
\t</table>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgLecturaAdmin:lct_lctEst_event_contentwrapper.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 45,  89 => 44,  87 => 42,  84 => 41,  82 => 40,  74 => 34,  70 => 33,  68 => 32,  64 => 31,  58 => 27,  53 => 19,  46 => 15,  39 => 11,  32 => 7,  23 => 3,  19 => 1,);
    }
}
