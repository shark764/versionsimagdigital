<?php

/* MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_assignTrcX_alert.html.twig */
class __TwigTemplate_33a668b867e556a40ff7629ccbe4746f89acad2509700769486b0abfc5555b0a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'simagd_assignTrcX_alert' => array($this, 'block_simagd_assignTrcX_alert'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "    
";
        // line 3
        $this->displayBlock('simagd_assignTrcX_alert', $context, $blocks);
    }

    public function block_simagd_assignTrcX_alert($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"simagd-response-bs-alert\" aria-hidden=\"true\">
\t<div class=\"alert alert-info alert-dismissable\" id=\"simagd-assign-trcx-response-bs-alert\" style=\"display: none;\">
\t    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
\t    <span>
\t\t<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span>
\t\t<strong>Asignados! &nbsp; </strong> Los registros fueron asignados satisfactoriamente.
\t    </span>
\t</div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgPendienteTranscripcionAdmin:pndT_assignTrcX_alert.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  29 => 4,  23 => 3,  20 => 2,  540 => 293,  537 => 292,  529 => 290,  527 => 289,  523 => 287,  520 => 286,  517 => 285,  514 => 284,  510 => 283,  508 => 282,  505 => 281,  502 => 280,  494 => 278,  492 => 277,  489 => 276,  486 => 275,  484 => 274,  477 => 273,  473 => 271,  466 => 270,  463 => 269,  461 => 268,  458 => 267,  435 => 246,  429 => 241,  426 => 238,  409 => 224,  405 => 222,  398 => 221,  395 => 220,  393 => 219,  390 => 218,  366 => 196,  360 => 191,  357 => 188,  344 => 178,  337 => 174,  332 => 171,  317 => 159,  310 => 156,  304 => 153,  296 => 148,  292 => 146,  286 => 143,  284 => 142,  281 => 141,  279 => 140,  274 => 138,  271 => 137,  253 => 124,  245 => 122,  242 => 121,  234 => 115,  227 => 110,  224 => 109,  218 => 105,  212 => 103,  205 => 101,  196 => 97,  188 => 95,  185 => 94,  180 => 91,  177 => 90,  172 => 87,  170 => 86,  164 => 84,  161 => 83,  154 => 79,  149 => 78,  144 => 76,  140 => 74,  135 => 73,  129 => 70,  124 => 67,  120 => 66,  115 => 65,  83 => 39,  65 => 25,  62 => 24,  54 => 20,  48 => 17,  45 => 16,  40 => 14,  38 => 11,  36 => 8,  34 => 7,  32 => 6,);
    }
}
