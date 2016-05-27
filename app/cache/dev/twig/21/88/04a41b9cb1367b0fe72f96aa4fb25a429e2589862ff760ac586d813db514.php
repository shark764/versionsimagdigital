<?php

/* MinsalSimagdBundle::simagd_accesoDenegado.html.twig */
class __TwigTemplate_218804a41b9cb1367b0fe72f96aa4fb25a429e2589862ff760ac586d813db514 extends Twig_Template
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
        echo "<div id=\"simagd-access-denied-container\" style=\"height: 400px; min-height: 400px;\">
        ";
        // line 8
        $context["simagd_vars"] = array("simagd_title" => "IMAGENOLOGÍA DIGITAL", "simagd_message" => "<span class=\"text-danger\">No está autorizado para ver el contenido al que intentó acceder</span>");
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
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/images/Stop.png"), "html", null, true);
        echo " /><strong>Acceso Denegado</strong></span></h4>

        <div class=\"alert alert-info alert-dismissible\" role=\"alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
                <span aria-hidden=\"true\">&times;</span>
                <span class=\"sr-only\"> Cerrar </span>
            </button>
            <span>
                <span class=\"glyphicon glyphicon-warning-sign\" aria-hidden=\"true\"></span>
                <strong>ACCESO DENEGADO!</strong> &nbsp; No tiene autorización para ver este contenido.
            </span> 
        </div>

        <p class=\"text-danger\" style=\"margin-left: 25px;\">
            Usted ha sido redirigido hacia esta página por motivos de seguridad.
            Intentó acceder a contenido al cual no posee permisos para ver.<br/>
            Por favor intente con otra opción del menú o consulte al administrador del sistema para mayor información.
        </p>
    </div>

";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle::simagd_accesoDenegado.html.twig";
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
