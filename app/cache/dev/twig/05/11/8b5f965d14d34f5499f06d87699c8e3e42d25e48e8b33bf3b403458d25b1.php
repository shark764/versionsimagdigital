<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_assignToNewRecord_alert.html.twig */
class __TwigTemplate_05118b5f965d14d34f5499f06d87699c8e3e42d25e48e8b33bf3b403458d25b1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'simagd_assignRadValidationX_alert' => array($this, 'block_simagd_assignRadValidationX_alert'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "    
";
        // line 3
        $this->displayBlock('simagd_assignRadValidationX_alert', $context, $blocks);
    }

    public function block_simagd_assignRadValidationX_alert($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"simagd-response-bs-alert\" aria-hidden=\"true\">
\t<div class=\"alert alert-warning alert-dismissable\" id=\"simagd-assign-newrecord-unknownreg-response-bs-alert\" style=\"display: none;\">
\t    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
\t    <span>
\t\t<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span>
\t\t<strong>Migración exitosa! &nbsp; </strong> Los registros fueron asignados a nuevo expediente satisfactoriamente.
\t    </span>
\t</div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_assignToNewRecord_alert.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  29 => 4,  23 => 3,  20 => 2,  580 => 365,  577 => 364,  575 => 363,  567 => 362,  564 => 361,  561 => 360,  557 => 359,  555 => 358,  551 => 356,  549 => 355,  526 => 334,  523 => 331,  511 => 321,  501 => 313,  492 => 308,  480 => 301,  468 => 293,  461 => 290,  455 => 287,  447 => 282,  443 => 280,  437 => 277,  435 => 276,  407 => 250,  396 => 248,  391 => 247,  380 => 245,  375 => 244,  364 => 242,  360 => 241,  324 => 207,  306 => 190,  285 => 170,  268 => 154,  247 => 134,  230 => 118,  213 => 102,  202 => 92,  199 => 90,  192 => 82,  189 => 81,  184 => 78,  168 => 69,  164 => 67,  161 => 66,  156 => 63,  151 => 60,  148 => 59,  144 => 56,  138 => 54,  135 => 53,  128 => 49,  124 => 48,  120 => 47,  115 => 46,  110 => 43,  105 => 42,  99 => 39,  91 => 33,  75 => 24,  67 => 23,  57 => 17,  54 => 16,  46 => 12,  43 => 11,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
