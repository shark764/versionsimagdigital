<?php

/* SonataAdminBundle::user_block.html.twig */
class __TwigTemplate_e311602c1b744d598725d421d1817820ad6e75167041c1e7e15222aa0b393c02 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'user_block' => array($this, 'block_user_block'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo " ";
        $this->displayBlock('user_block', $context, $blocks);
    }

    public function block_user_block($context, array $blocks = array())
    {
        // line 2
        echo "    ";
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")) {
            // line 3
            echo "
        ";
            // line 4
            $context["_bg_class"] = "bg-light-blue";
            // line 5
            echo "        ";
            $context["_logout_uri"] = $this->env->getExtension('routing')->getUrl("sonata_user_admin_security_logout");
            // line 6
            echo "        ";
            $context["_logout_text"] = $this->env->getExtension('translator')->trans("user_block_logout", array(), "SonataUserBundle");
            // line 7
            echo "        ";
            $context["_user_image"] = $this->env->getExtension('assets')->getAssetUrl($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : $this->getContext($context, "sonata_user")), "defaultAvatar"));
            // line 8
            echo "        ";
            // line 9
            echo "        ";
            // line 10
            echo "
        ";
            // line 11
            if (($this->env->getExtension('security')->isGranted("ROLE_PREVIOUS_ADMIN") && $this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : $this->getContext($context, "sonata_user")), "impersonating"))) {
                // line 12
                echo "            ";
                $context["_bg_class"] = "bg-light-green";
                // line 13
                echo "            ";
                $context["_logout_uri"] = $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : $this->getContext($context, "sonata_user")), "impersonating"), "route"), twig_array_merge($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : $this->getContext($context, "sonata_user")), "impersonating"), "parameters"), array("_switch_user" => "_exit")));
                // line 14
                echo "            ";
                $context["_logout_text"] = "(exit)";
                // line 15
                echo "        ";
            }
            // line 16
            echo "
            <li>
                <a href=\"";
            // line 18
            echo twig_escape_filter($this->env, (isset($context["_logout_uri"]) ? $context["_logout_uri"] : $this->getContext($context, "_logout_uri")), "html", null, true);
            echo "\">
                    <i class=\"fa fa-sign-out fa-fw\" style=\"width:25px;\"></i>
                    ";
            // line 20
            echo twig_escape_filter($this->env, (isset($context["_logout_text"]) ? $context["_logout_text"] : $this->getContext($context, "_logout_text")), "html", null, true);
            echo "
                </a>
            </li>
            ";
            // line 23
            if ((((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true) && ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array(), "any", false, true), "get", array(0 => "_secured_token"), "method", true, true)) && (!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_secured_token"), "method")))) && ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") != "verify_medic_service"))) {
                // line 26
                echo "                <li>
                    <a href=\"";
                // line 27
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("verify_medic_service", array("_provided_token" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_secured_token"), "method"))), "html", null, true);
                echo "\">
                        <i style=\"width:25px; margin-right: 10px;\">
                            <span class=\"glyphicon glyphicon-user\" style=\"margin-right: 0;font-size: 10px;\"></span>
                            <span class=\"glyphicon glyphicon-log-in\" style=\"margin-right: 0;font-size: 10px;\"></span>
                        </i>
                        Cambiar de Especialidad
                    </a>
                </li>
            ";
            }
            // line 36
            echo "            ";
            if (((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_moduleSelection"), "method") != 3) && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_moduleSelection"), "method") != 4)) && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_moduleSelection"), "method") != 6))) {
                // line 37
                echo "                <li>
                    <a href=\"";
                // line 38
                echo $this->env->getExtension('routing')->getUrl("fos_user_change_password");
                echo "\">
                        <span class=\"glyphicon glyphicon-pencil\" style=\"width:25px;\"></span>
                        Cambiar Contraseña
                    </a>
                <li>
            ";
            }
            // line 44
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle::user_block.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  112 => 44,  103 => 38,  97 => 36,  80 => 23,  56 => 13,  41 => 7,  20 => 1,  270 => 4,  268 => 3,  264 => 2,  253 => 1,  243 => 83,  221 => 79,  212 => 74,  210 => 73,  208 => 72,  206 => 71,  202 => 68,  198 => 66,  196 => 65,  192 => 64,  189 => 61,  187 => 60,  185 => 59,  182 => 57,  180 => 56,  172 => 51,  169 => 49,  167 => 48,  163 => 45,  160 => 44,  156 => 41,  154 => 40,  137 => 37,  120 => 36,  117 => 34,  111 => 30,  100 => 37,  95 => 22,  93 => 21,  90 => 20,  86 => 17,  84 => 16,  81 => 15,  65 => 16,  60 => 81,  57 => 80,  52 => 78,  50 => 44,  47 => 43,  45 => 28,  37 => 19,  35 => 5,  32 => 14,  30 => 3,  27 => 2,  251 => 110,  241 => 107,  235 => 105,  233 => 81,  228 => 103,  226 => 102,  224 => 101,  222 => 100,  220 => 99,  218 => 98,  215 => 97,  207 => 93,  201 => 91,  199 => 90,  194 => 89,  191 => 88,  183 => 84,  177 => 54,  175 => 53,  168 => 80,  165 => 47,  159 => 75,  155 => 73,  153 => 72,  150 => 71,  143 => 66,  141 => 65,  136 => 62,  132 => 59,  128 => 57,  124 => 55,  122 => 54,  118 => 53,  115 => 33,  113 => 31,  110 => 48,  108 => 28,  105 => 45,  102 => 43,  99 => 41,  96 => 39,  94 => 38,  92 => 37,  89 => 35,  87 => 34,  85 => 27,  82 => 26,  79 => 29,  77 => 28,  74 => 20,  72 => 10,  69 => 18,  66 => 21,  64 => 20,  62 => 15,  59 => 14,  55 => 79,  53 => 12,  51 => 11,  48 => 10,  46 => 9,  44 => 8,  42 => 27,  40 => 20,  38 => 6,  36 => 4,  33 => 4,  29 => 14,  26 => 13,);
    }
}
