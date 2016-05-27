<?php

/* MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:conexion-edit.html.twig */
class __TwigTemplate_dfe4d7a5232883e3cb005381cfc4aa42c423b1e66e2ae5c0b3d7396bcdeeb5da extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_edit.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:pacs_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_javascripts($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\" src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ConexionAdmin/conexion_edit.js"), "html", null, true);
        echo "\" ></script>

    <script type=\"text/javascript\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCtlPacsEstablecimientoAdmin/pacs_form_config.js"), "html", null, true);
        echo "\" ></script>
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $this->displayParentBlock("content", $context, $blocks);
        echo "
    
    <button type='button' name=\"btn_probar_conexion\" id='btn_probar_conexion' class='btn btn-primary' >
        <span class=\"glyphicon glyphicon-refresh\"></span> 
        ";
        // line 19
        echo "Probar Conexión";
        echo "
    </button>
";
    }

    // line 23
    public function block_formactions($context, array $blocks = array())
    {
        // line 24
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 25
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 26
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 27
                echo "                <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 29
                echo "                <button type=\"submit\" class=\"btn btn-success-v2\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 31
            echo "        ";
        } else {
            // line 32
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 33
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 35
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 38
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 39
                echo "                <button type=\"submit\" class=\"btn btn-primary-v2\" name=\"btn_update_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>

                ";
                // line 44
                echo "
                ";
                // line 45
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 46
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    <a class=\"btn btn-danger\" href=\"";
                    // line 47
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 49
                echo "
                ";
                // line 50
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 51
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 53
                echo "            ";
            } else {
                // line 54
                echo "                ";
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT"), "method"))) {
                    // line 55
                    echo "                    <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_edit\"><i class=\"fa fa-save\"></i> Guardar</button>
                ";
                }
                // line 57
                echo "                ";
                // line 60
                echo "                <button class=\"btn btn-primary-v2\" type=\"submit\" name=\"btn_create_and_create\"><i class=\"fa fa-plus-circle\"></i> Guardar</button>
            ";
            }
            // line 62
            echo "        ";
        }
        // line 63
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlPacsEstablecimientoAdmin:conexion-edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 63,  160 => 62,  156 => 60,  154 => 57,  150 => 55,  147 => 54,  144 => 53,  136 => 51,  134 => 50,  131 => 49,  124 => 47,  119 => 46,  117 => 45,  114 => 44,  110 => 39,  107 => 38,  101 => 35,  97 => 33,  94 => 32,  91 => 31,  85 => 29,  79 => 27,  76 => 26,  74 => 25,  71 => 24,  68 => 23,  61 => 19,  53 => 15,  50 => 14,  44 => 11,  39 => 9,  33 => 7,  30 => 6,);
    }
}
