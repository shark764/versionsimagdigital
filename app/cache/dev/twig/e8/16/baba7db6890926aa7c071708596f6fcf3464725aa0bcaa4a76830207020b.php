<?php

/* MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_edit.html.twig */
class __TwigTemplate_e816baba7db6890926aa7c071708596f6fcf3464725aa0bcaa4a76830207020b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_edit.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'form' => array($this, 'block_form'),
            'custom_entity_support' => array($this, 'block_custom_entity_support'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_javascripts($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    
    <script type=\"text/javascript\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlPacsEstablecimientoAdmin/pacs_duracion_estudio.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 11
        echo "    
    ";
        // line 13
        echo "
    <script type=\"text/javascript\" src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/CRUD/base_edit.js"), "html", null, true);
        echo "\" ></script>
";
    }

    // line 17
    public function block_form($context, array $blocks = array())
    {
        // line 18
        echo "    ";
        // line 22
        echo "    
    ";
        // line 23
        $this->displayParentBlock("form", $context, $blocks);
        echo "
";
    }

    // line 27
    public function block_custom_entity_support($context, array $blocks = array())
    {
        // line 28
        echo "    <div id=\"custom-entity-content-body\">
        ";
        // line 29
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_modal_support.html.twig")->display(array_merge($context, array("establecimientoInfo" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idEstablecimiento"))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 32
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 32,  73 => 28,  70 => 27,  64 => 23,  59 => 18,  56 => 17,  47 => 13,  163 => 63,  160 => 62,  156 => 60,  154 => 57,  150 => 55,  147 => 54,  144 => 53,  136 => 51,  134 => 50,  131 => 49,  124 => 47,  119 => 46,  117 => 45,  114 => 44,  110 => 39,  107 => 38,  101 => 35,  97 => 33,  94 => 32,  91 => 31,  85 => 29,  79 => 27,  76 => 29,  74 => 25,  71 => 24,  68 => 23,  61 => 22,  53 => 15,  50 => 14,  44 => 11,  39 => 8,  33 => 6,  30 => 5,);
    }
}
