<?php

/* MinsalSimagdBundle:show_entity_block:pct_entity_block.html.twig */
class __TwigTemplate_4a13e46c166c0c5f597248b571b9864607d30c1e2ee3245409a584a70452acac extends Twig_Template
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
    <div class=\"tab-pane fade ";
        // line 3
        if (((isset($context["tab_active"]) ? $context["tab_active"] : $this->getContext($context, "tab_active")) != false)) {
            echo "in active";
        }
        echo "\" id=\"lct_pacienteTab\" >
        <div class=\"box box-";
        // line 4
        echo twig_escape_filter($this->env, ((array_key_exists("box_style", $context)) ? (_twig_default_filter((isset($context["box_style"]) ? $context["box_style"] : $this->getContext($context, "box_style")), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo " non-titled-sonata-box\">
            <div class=\"box-body\">
\t\t<table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 9
        if ((!(null === (isset($context["object_localRecord"]) ? $context["object_localRecord"] : $this->getContext($context, "object_localRecord"))))) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_localRecord"]) ? $context["object_localRecord"] : $this->getContext($context, "object_localRecord")), "id"), "html", null, true);
            echo " ";
        }
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Número:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 13
        if ((!(null === (isset($context["object_localRecord"]) ? $context["object_localRecord"] : $this->getContext($context, "object_localRecord"))))) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_localRecord"]) ? $context["object_localRecord"] : $this->getContext($context, "object_localRecord")), "numero"), "html", null, true);
            echo " ";
        }
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Nombre:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 17
        echo twig_escape_filter($this->env, (((((($this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "primerApellido") . " ") . $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "segundoApellido")) . ", ") . $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "primerNombre")) . " ") . $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "segundoNombre")), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Sexo:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "idSexo"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha de nacimiento:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            ";
        // line 26
        if ((!(null === $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "fechaNacimiento")))) {
            // line 27
            echo "                                ";
            echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "fechaNacimiento"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "horaNacimiento"), "H:i:s A")), "html", null, true);
            echo "
                            ";
        }
        // line 29
        echo "                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Ocupación:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "idOcupacion"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Trabaja en:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "lugarTrabajo"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Identificación:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "numeroDocIdePaciente"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Direccion:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "direccion"), "html", null, true);
        echo "</pre>
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Teléfono de casa:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "telefonoCasa"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado civil:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "idEstadoCivil"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Nombre de la madre:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "nombreMadre"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Nombre del padre:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "nombrePadre"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Nacionalidad:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_patient"]) ? $context["object_patient"] : $this->getContext($context, "object_patient")), "idNacionalidad"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t</table>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:pct_entity_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 63,  107 => 44,  28 => 4,  39 => 11,  33 => 8,  29 => 6,  26 => 5,  22 => 3,  19 => 2,  118 => 32,  86 => 21,  67 => 15,  63 => 13,  57 => 9,  48 => 17,  40 => 3,  35 => 9,  21 => 1,  392 => 107,  389 => 106,  383 => 104,  377 => 102,  368 => 99,  365 => 98,  362 => 97,  354 => 95,  349 => 93,  335 => 89,  332 => 88,  324 => 85,  309 => 79,  305 => 77,  302 => 76,  276 => 67,  257 => 56,  252 => 53,  233 => 48,  230 => 47,  224 => 45,  222 => 44,  194 => 40,  167 => 36,  150 => 35,  146 => 33,  144 => 32,  140 => 30,  134 => 59,  129 => 57,  126 => 24,  119 => 112,  116 => 111,  110 => 29,  102 => 64,  97 => 24,  95 => 28,  90 => 24,  78 => 19,  76 => 18,  69 => 16,  59 => 19,  55 => 12,  41 => 6,  30 => 2,  24 => 4,  115 => 49,  106 => 26,  96 => 30,  92 => 35,  80 => 26,  73 => 26,  62 => 14,  53 => 15,  45 => 4,  12 => 36,  1002 => 387,  999 => 386,  996 => 385,  994 => 384,  992 => 381,  988 => 379,  985 => 378,  982 => 377,  974 => 375,  972 => 374,  969 => 373,  962 => 371,  957 => 370,  955 => 369,  952 => 368,  948 => 363,  945 => 362,  939 => 359,  935 => 357,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  909 => 348,  906 => 347,  901 => 342,  898 => 341,  893 => 338,  887 => 336,  882 => 333,  863 => 328,  860 => 327,  854 => 325,  852 => 324,  841 => 321,  824 => 320,  820 => 318,  795 => 316,  778 => 315,  774 => 313,  772 => 312,  769 => 311,  766 => 309,  763 => 308,  760 => 307,  755 => 304,  752 => 303,  745 => 392,  742 => 391,  738 => 389,  736 => 347,  731 => 345,  728 => 344,  726 => 341,  723 => 340,  721 => 307,  718 => 306,  715 => 303,  709 => 296,  706 => 295,  704 => 294,  700 => 292,  696 => 291,  689 => 289,  685 => 287,  682 => 285,  676 => 282,  673 => 281,  671 => 280,  668 => 279,  666 => 278,  663 => 277,  661 => 276,  655 => 274,  652 => 273,  646 => 251,  643 => 250,  640 => 249,  635 => 268,  626 => 260,  621 => 256,  618 => 254,  616 => 249,  596 => 231,  593 => 230,  589 => 226,  586 => 225,  583 => 224,  578 => 270,  576 => 230,  571 => 228,  568 => 227,  566 => 224,  563 => 223,  560 => 222,  556 => 212,  553 => 211,  549 => 206,  547 => 205,  544 => 204,  540 => 202,  534 => 200,  532 => 199,  527 => 197,  524 => 196,  522 => 195,  519 => 194,  510 => 185,  507 => 184,  504 => 183,  499 => 188,  497 => 183,  488 => 176,  485 => 175,  481 => 218,  474 => 213,  471 => 211,  465 => 209,  463 => 208,  460 => 207,  458 => 204,  455 => 203,  453 => 194,  447 => 190,  440 => 172,  429 => 219,  426 => 170,  419 => 166,  413 => 164,  408 => 161,  403 => 160,  398 => 157,  393 => 156,  379 => 151,  374 => 101,  370 => 147,  356 => 142,  352 => 94,  337 => 90,  326 => 86,  322 => 129,  317 => 128,  307 => 124,  301 => 121,  295 => 118,  284 => 70,  279 => 68,  274 => 108,  269 => 107,  263 => 58,  258 => 101,  246 => 94,  242 => 93,  227 => 88,  219 => 87,  211 => 41,  200 => 82,  190 => 38,  145 => 58,  139 => 55,  133 => 52,  128 => 49,  123 => 48,  117 => 45,  111 => 42,  105 => 65,  99 => 39,  93 => 33,  87 => 33,  81 => 29,  75 => 27,  70 => 22,  66 => 20,  61 => 19,  56 => 18,  50 => 14,  47 => 13,  42 => 7,  451 => 218,  448 => 217,  445 => 175,  443 => 215,  441 => 212,  437 => 171,  434 => 170,  431 => 208,  423 => 169,  421 => 205,  418 => 204,  411 => 202,  406 => 201,  404 => 200,  401 => 199,  397 => 194,  394 => 193,  388 => 153,  384 => 152,  381 => 187,  378 => 186,  372 => 184,  366 => 146,  363 => 181,  361 => 145,  358 => 179,  355 => 178,  350 => 175,  347 => 140,  342 => 91,  339 => 171,  336 => 170,  331 => 133,  328 => 145,  320 => 144,  318 => 83,  315 => 82,  312 => 125,  304 => 152,  299 => 75,  297 => 141,  293 => 73,  291 => 129,  289 => 115,  287 => 71,  285 => 115,  282 => 69,  271 => 62,  268 => 61,  260 => 102,  253 => 93,  250 => 95,  241 => 88,  238 => 92,  235 => 86,  229 => 82,  225 => 81,  220 => 80,  218 => 79,  215 => 78,  210 => 74,  205 => 71,  201 => 70,  197 => 69,  193 => 68,  189 => 67,  184 => 65,  180 => 80,  176 => 79,  172 => 62,  168 => 61,  164 => 60,  160 => 59,  155 => 62,  152 => 61,  137 => 29,  122 => 53,  112 => 109,  100 => 61,  88 => 28,  83 => 20,  79 => 25,  74 => 24,  68 => 21,  65 => 21,  58 => 17,  52 => 6,  46 => 16,  43 => 7,  38 => 5,  36 => 9,  34 => 4,);
    }
}
