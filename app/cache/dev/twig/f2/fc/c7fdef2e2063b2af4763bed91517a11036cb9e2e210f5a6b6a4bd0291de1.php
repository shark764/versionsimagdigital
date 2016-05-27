<?php

/* MinsalSimagdBundle::simagd_registroNoEncontrado.html.twig */
class __TwigTemplate_f2fcc7fdef2e2063b2af4763bed91517a11036cb9e2e210f5a6b6a4bd0291de1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_layout.html.twig");

        $this->blocks = array(
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 7
        echo "<div id=\"simagd-not-found-container\" style=\"height: 400px; min-height: 400px;\">
        ";
        // line 8
        $context["simagd_vars"] = array("simagd_title" => "IMAGENOLOGÍA DIGITAL", "simagd_message" => "<i class=\"text-danger\">Registro no existente en el Sistema</i>");
        // line 11
        echo "        ";
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_cabecera.html.twig")->display(array_merge($context, (isset($context["simagd_vars"]) ? $context["simagd_vars"] : $this->getContext($context, "simagd_vars"))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 12
        echo "
        <h4><span class=\"simagd-text-primary\"><img class=\"icono\" src=";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/images/Warning_Basic_Full_TRAN.PNG"), "html", null, true);
        echo " /><strong>Registro no encontrado</strong></span></h4>

        <div class=\"alert alert-info alert-dismissible\" role=\"alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                <span aria-hidden=\"true\">&times;</span>
                <span class=\"sr-only\"> Cerrar </span>
            </button>
            <span>
                <span class=\"glyphicon glyphicon-warning-sign\" aria-hidden=\"true\"></span>
                <strong>REGISTRO NO EXISTE!</strong> &nbsp; Su petición no produjo ningún resultado.
            </span> 
        </div>

        <p class=\"text-danger\" style=\"margin-left: 25px;\">
            Usted ha sido redirigido hacia esta página por motivos de seguridad.
            El registro al que intentó acceder no existe.<br/>
            Por favor intente hacer nuevamente la consulta accediendo desde la lista de registros.
        </p>
    </div>

";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle::simagd_registroNoEncontrado.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 13,  44 => 12,  36 => 11,  34 => 8,  31 => 7,  28 => 5,);
    }
}
