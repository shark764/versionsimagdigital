<?php

/* MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_addPryLocalList_alert.html.twig */
class __TwigTemplate_ad9e11caa1aec149886b845cca958a7dafe4e271a774ff2eaa7981fe6dd1c76d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'simagd_locallist_alert' => array($this, 'block_simagd_locallist_alert'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "    
";
        // line 3
        $this->displayBlock('simagd_locallist_alert', $context, $blocks);
    }

    public function block_simagd_locallist_alert($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"simagd-response-bs-alert\" aria-hidden=\"true\">
\t<div class=\"alert alert-success alert-dismissable\" id=\"simagd-add-pry-locallist-response-bs-alert\" style=\"display: none;\">
\t    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
\t    <span>
\t\t<span class=\"glyphicon glyphicon-list-alt\" aria-hidden=\"true\"></span>
\t\t<strong>Agregados! &nbsp; </strong> Los registros fueron ingresados en lista local satisfactoriamente.
\t    </span>
\t</div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlProyeccionAdmin:expl_addPryLocalList_alert.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  29 => 4,  23 => 3,  20 => 2,  503 => 252,  500 => 251,  492 => 249,  490 => 248,  486 => 246,  483 => 245,  475 => 243,  472 => 242,  470 => 241,  467 => 240,  459 => 239,  456 => 238,  454 => 237,  451 => 236,  443 => 234,  440 => 233,  437 => 231,  419 => 218,  411 => 212,  405 => 207,  402 => 204,  385 => 190,  381 => 188,  374 => 187,  371 => 186,  369 => 185,  366 => 184,  347 => 167,  341 => 162,  338 => 159,  325 => 149,  318 => 145,  313 => 142,  298 => 130,  291 => 127,  285 => 124,  277 => 119,  273 => 117,  267 => 114,  265 => 113,  262 => 112,  260 => 111,  254 => 109,  251 => 107,  238 => 100,  232 => 98,  222 => 94,  216 => 92,  211 => 89,  208 => 88,  197 => 82,  190 => 80,  181 => 76,  173 => 74,  170 => 73,  165 => 69,  162 => 68,  158 => 65,  152 => 63,  149 => 62,  141 => 58,  137 => 56,  133 => 55,  128 => 54,  123 => 51,  118 => 50,  113 => 47,  108 => 46,  106 => 45,  96 => 41,  87 => 39,  70 => 26,  67 => 25,  59 => 21,  53 => 18,  50 => 17,  45 => 15,  43 => 14,  41 => 13,  39 => 12,  37 => 9,  35 => 8,  33 => 7,  31 => 6,);
    }
}
