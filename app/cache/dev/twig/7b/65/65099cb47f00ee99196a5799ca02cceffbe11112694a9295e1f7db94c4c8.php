<?php

/* SonataAdminBundle:CRUD:base_list_field.html.twig */
class __TwigTemplate_7b6565099cb47f00ee99196a5799ca02cceffbe11112694a9295e1f7db94c4c8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'field' => array($this, 'block_field'),
            'field_span_attributes' => array($this, 'block_field_span_attributes'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
<td class=\"sonata-ba-list-field sonata-ba-list-field-";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "type"), "html", null, true);
        echo "\" objectId=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
        echo "\">
    ";
        // line 13
        $context["route"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "route", array(), "any", false, true), "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "route", array(), "any", false, true), "name"), null)) : (null));
        // line 14
        echo "    ";
        $context["action"] = ((((isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")) == "show")) ? ("VIEW") : (twig_upper_filter($this->env, (isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")))));
        // line 15
        echo "
    ";
        // line 16
        if ((((($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "identifier", array(), "any", true, true) && (isset($context["route"]) ? $context["route"] : $this->getContext($context, "route"))) && (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["route"]) ? $context["route"] : $this->getContext($context, "route"))), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), 1 => ((twig_in_filter((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), array(0 => "VIEW", 1 => "EDIT"))) ? ((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))) : (null))), "method"))) {
            // line 23
            echo "        <a class=\"sonata-link-identifier\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => (isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")), 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "route"), "parameters")), "method"), "html", null, true);
            echo "\">";
            // line 24
            $this->displayBlock('field', $context, $blocks);
            // line 25
            echo "</a>
    ";
        } else {
            // line 27
            echo "        ";
            $context["isEditable"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "editable", array(), "any", true, true) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "editable")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"));
            // line 28
            echo "        ";
            $context["xEditableType"] = $this->env->getExtension('sonata_admin')->getXEditableType($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "type"));
            // line 29
            echo "
        ";
            // line 30
            if (((isset($context["isEditable"]) ? $context["isEditable"] : $this->getContext($context, "isEditable")) && (isset($context["xEditableType"]) ? $context["xEditableType"] : $this->getContext($context, "xEditableType")))) {
                // line 31
                echo "            ";
                $context["url"] = $this->env->getExtension('routing')->getPath("sonata_admin_set_object_field_value", array("context" => "list", "field" => $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "name"), "objectId" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "code" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "code", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")));
                // line 32
                echo "            <span ";
                $this->displayBlock('field_span_attributes', $context, $blocks);
                echo ">
                ";
                // line 33
                $this->displayBlock("field", $context, $blocks);
                echo "
            </span>
        ";
            } else {
                // line 36
                echo "            ";
                $this->displayBlock("field", $context, $blocks);
                echo "
        ";
            }
            // line 38
            echo "    ";
        }
        // line 39
        echo "</td>
";
    }

    // line 24
    public function block_field($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
    }

    // line 32
    public function block_field_span_attributes($context, array $blocks = array())
    {
        echo "class=\"x-editable\" data-type=\"";
        echo twig_escape_filter($this->env, (isset($context["xEditableType"]) ? $context["xEditableType"] : $this->getContext($context, "xEditableType")), "html", null, true);
        echo "\" data-value=\"";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo "\" data-title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "label"), array(), $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "translationDomain")), "html", null, true);
        echo "\" data-pk=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
        echo "\" data-url=\"";
        echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), "html", null, true);
        echo "\" ";
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_list_field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 32,  89 => 24,  75 => 36,  64 => 32,  61 => 31,  59 => 30,  53 => 28,  50 => 27,  46 => 25,  40 => 23,  38 => 16,  35 => 15,  32 => 14,  30 => 13,  24 => 12,  21 => 11,  36 => 19,  34 => 18,  31 => 16,  29 => 15,  26 => 14,  45 => 22,  22 => 12,  19 => 11,  613 => 232,  602 => 230,  598 => 229,  590 => 226,  585 => 224,  579 => 222,  577 => 221,  572 => 218,  562 => 214,  555 => 210,  551 => 208,  548 => 207,  546 => 206,  540 => 205,  537 => 204,  533 => 203,  529 => 202,  525 => 201,  519 => 200,  510 => 196,  506 => 194,  503 => 193,  500 => 192,  497 => 191,  492 => 182,  488 => 168,  485 => 167,  481 => 166,  478 => 165,  475 => 164,  471 => 157,  467 => 156,  464 => 155,  459 => 125,  448 => 123,  444 => 122,  437 => 118,  433 => 117,  429 => 116,  424 => 115,  421 => 114,  398 => 92,  395 => 91,  389 => 128,  386 => 127,  384 => 114,  380 => 112,  378 => 91,  375 => 90,  372 => 89,  366 => 169,  364 => 164,  358 => 160,  354 => 158,  352 => 155,  349 => 154,  342 => 149,  332 => 145,  327 => 143,  324 => 142,  320 => 141,  313 => 137,  308 => 134,  306 => 133,  302 => 131,  299 => 130,  296 => 89,  293 => 88,  291 => 87,  286 => 85,  282 => 83,  279 => 82,  274 => 79,  271 => 78,  268 => 77,  265 => 76,  259 => 72,  253 => 71,  250 => 70,  246 => 68,  242 => 67,  237 => 66,  231 => 65,  219 => 64,  217 => 63,  214 => 62,  211 => 61,  208 => 60,  205 => 59,  202 => 58,  199 => 57,  196 => 56,  193 => 55,  190 => 54,  187 => 53,  185 => 52,  182 => 51,  180 => 50,  176 => 48,  170 => 44,  167 => 43,  163 => 42,  159 => 40,  156 => 39,  151 => 30,  141 => 184,  138 => 183,  136 => 182,  133 => 181,  127 => 178,  124 => 177,  121 => 176,  117 => 174,  115 => 173,  112 => 172,  110 => 82,  107 => 81,  105 => 76,  102 => 75,  100 => 39,  97 => 38,  92 => 36,  87 => 35,  84 => 39,  81 => 38,  79 => 32,  76 => 31,  74 => 30,  69 => 33,  65 => 26,  62 => 25,  56 => 29,  47 => 17,  44 => 24,  42 => 21,  39 => 20,);
    }
}
