<?php

/* MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_bsswitch_history.html.twig */
class __TwigTemplate_ecfdf122a7afd60fed734ef7932bdbf3d8e2ba8284bf484a60eb7a72c50e5542 extends Twig_Template
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
        // line 2
        echo "
";
        // line 3
        $context["object_expediente"] = $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdExpediente", array(), "method");
        // line 4
        $context["object_paciente"] = $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method");
        // line 5
        echo "
<ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"";
        // line 6
        echo "\"> <!-- required for floating -->
    <!-- Nav tabs -->
    ";
        // line 8
        if ((!(null === $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method")))) {
            // line 9
            echo "\t<li class=\"active\"><a href=\"#lct_pacienteTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-user\"></span> Paciente <i class=\"fa\"></i></a></li>
    ";
        }
        // line 11
        echo "</ul>

<!-- Tab panes -->
<div class=\"tab-content col-md-9 col-xs-9\" style=\"overflow-y: auto; min-height: 760px;\">
    
    ";
        // line 16
        if ((!(null === $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method")))) {
            // line 17
            echo "        ";
            try {
                $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:pct_entity_block.html.twig")->display(array_merge($context, array("object_patient" => $this->getAttribute((isset($context["object_expediente"]) ? $context["object_expediente"] : $this->getContext($context, "object_expediente")), "getIdPaciente", array(), "method"), "object_localRecord" => (isset($context["localRecord"]) ? $context["localRecord"] : $this->getContext($context, "localRecord")), "tab_active" => true, "box_style" => "primary-v2")));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 18
            echo "    ";
        }
        // line 19
        echo "    
</div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudEstudioAdmin:prc_bsswitch_history.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 11,  33 => 8,  29 => 6,  26 => 5,  22 => 3,  19 => 2,  118 => 32,  86 => 21,  67 => 15,  63 => 13,  57 => 9,  48 => 17,  40 => 3,  35 => 9,  21 => 1,  392 => 107,  389 => 106,  383 => 104,  377 => 102,  368 => 99,  365 => 98,  362 => 97,  354 => 95,  349 => 93,  335 => 89,  332 => 88,  324 => 85,  309 => 79,  305 => 77,  302 => 76,  276 => 67,  257 => 56,  252 => 53,  233 => 48,  230 => 47,  224 => 45,  222 => 44,  194 => 40,  167 => 36,  150 => 35,  146 => 33,  144 => 32,  140 => 30,  134 => 28,  129 => 25,  126 => 24,  119 => 112,  116 => 111,  110 => 29,  102 => 64,  97 => 24,  95 => 28,  90 => 24,  78 => 19,  76 => 18,  69 => 16,  59 => 19,  55 => 12,  41 => 6,  30 => 2,  24 => 4,  115 => 40,  106 => 26,  96 => 30,  92 => 23,  80 => 26,  73 => 17,  62 => 14,  53 => 15,  45 => 4,  12 => 36,  1002 => 387,  999 => 386,  996 => 385,  994 => 384,  992 => 381,  988 => 379,  985 => 378,  982 => 377,  974 => 375,  972 => 374,  969 => 373,  962 => 371,  957 => 370,  955 => 369,  952 => 368,  948 => 363,  945 => 362,  939 => 359,  935 => 357,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  909 => 348,  906 => 347,  901 => 342,  898 => 341,  893 => 338,  887 => 336,  882 => 333,  863 => 328,  860 => 327,  854 => 325,  852 => 324,  841 => 321,  824 => 320,  820 => 318,  795 => 316,  778 => 315,  774 => 313,  772 => 312,  769 => 311,  766 => 309,  763 => 308,  760 => 307,  755 => 304,  752 => 303,  745 => 392,  742 => 391,  738 => 389,  736 => 347,  731 => 345,  728 => 344,  726 => 341,  723 => 340,  721 => 307,  718 => 306,  715 => 303,  709 => 296,  706 => 295,  704 => 294,  700 => 292,  696 => 291,  689 => 289,  685 => 287,  682 => 285,  676 => 282,  673 => 281,  671 => 280,  668 => 279,  666 => 278,  663 => 277,  661 => 276,  655 => 274,  652 => 273,  646 => 251,  643 => 250,  640 => 249,  635 => 268,  626 => 260,  621 => 256,  618 => 254,  616 => 249,  596 => 231,  593 => 230,  589 => 226,  586 => 225,  583 => 224,  578 => 270,  576 => 230,  571 => 228,  568 => 227,  566 => 224,  563 => 223,  560 => 222,  556 => 212,  553 => 211,  549 => 206,  547 => 205,  544 => 204,  540 => 202,  534 => 200,  532 => 199,  527 => 197,  524 => 196,  522 => 195,  519 => 194,  510 => 185,  507 => 184,  504 => 183,  499 => 188,  497 => 183,  488 => 176,  485 => 175,  481 => 218,  474 => 213,  471 => 211,  465 => 209,  463 => 208,  460 => 207,  458 => 204,  455 => 203,  453 => 194,  447 => 190,  440 => 172,  429 => 219,  426 => 170,  419 => 166,  413 => 164,  408 => 161,  403 => 160,  398 => 157,  393 => 156,  379 => 151,  374 => 101,  370 => 147,  356 => 142,  352 => 94,  337 => 90,  326 => 86,  322 => 129,  317 => 128,  307 => 124,  301 => 121,  295 => 118,  284 => 70,  279 => 68,  274 => 108,  269 => 107,  263 => 58,  258 => 101,  246 => 94,  242 => 93,  227 => 88,  219 => 87,  211 => 41,  200 => 82,  190 => 38,  145 => 58,  139 => 55,  133 => 52,  128 => 49,  123 => 48,  117 => 45,  111 => 42,  105 => 65,  99 => 36,  93 => 33,  87 => 23,  81 => 20,  75 => 18,  70 => 22,  66 => 20,  61 => 19,  56 => 18,  50 => 14,  47 => 11,  42 => 7,  451 => 218,  448 => 217,  445 => 175,  443 => 215,  441 => 212,  437 => 171,  434 => 170,  431 => 208,  423 => 169,  421 => 205,  418 => 204,  411 => 202,  406 => 201,  404 => 200,  401 => 199,  397 => 194,  394 => 193,  388 => 153,  384 => 152,  381 => 187,  378 => 186,  372 => 184,  366 => 146,  363 => 181,  361 => 145,  358 => 179,  355 => 178,  350 => 175,  347 => 140,  342 => 91,  339 => 171,  336 => 170,  331 => 133,  328 => 145,  320 => 144,  318 => 83,  315 => 82,  312 => 125,  304 => 152,  299 => 75,  297 => 141,  293 => 73,  291 => 129,  289 => 115,  287 => 71,  285 => 115,  282 => 69,  271 => 62,  268 => 61,  260 => 102,  253 => 93,  250 => 95,  241 => 88,  238 => 92,  235 => 86,  229 => 82,  225 => 81,  220 => 80,  218 => 79,  215 => 78,  210 => 74,  205 => 71,  201 => 70,  197 => 69,  193 => 68,  189 => 67,  184 => 65,  180 => 80,  176 => 79,  172 => 62,  168 => 61,  164 => 60,  160 => 59,  155 => 62,  152 => 61,  137 => 29,  122 => 41,  112 => 109,  100 => 61,  88 => 28,  83 => 20,  79 => 25,  74 => 24,  68 => 21,  65 => 20,  58 => 17,  52 => 6,  46 => 16,  43 => 7,  38 => 5,  36 => 4,  34 => 4,);
    }
}
