<?php

/* MinsalSiapsBundle:MntPacienteAdmin:identificacion_paciente.html.twig */
class __TwigTemplate_c88fa0038c7eda7e6d053498da8b6943b15cae245322c9bff03677220d8c5418 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 4
        echo "<table class=\"vista_paciente\" border=\"0\" width=\"80%\" align='center'>
    <tr class=\"titulo_vista\">
        <td colspan=\"4\">Identificación del Paciente</td>
    </tr>
    <tr class=\"dat_paciente_content\">               
        <td width='25%'><label>Número Expediente:</label></td>
         <td width='25%' style=\"font-size: 14pt;\">
       ";
        // line 11
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "getExpedientes", array(), "method")) > 0)) {
            // line 12
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "expedientes"));
            foreach ($context['_seq'] as $context["_key"] => $context["expediente"]) {
                // line 13
                echo "                    <b>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "numero"), "html", null, true);
                echo "</b>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['expediente'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "        ";
        } else {
            // line 16
            echo "                    <b>EM</b>
        ";
        }
        // line 18
        echo "         </td>
        <td colspan=\"2\"><label>Nombre:</label> 
            ";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "primerApellido"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "segundoApellido"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "apellidoCasada"), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "primerNombre"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "segundoNombre"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "tercerNombre"), "html", null, true);
        echo "   
        </td>
    </tr>
    <tr class=\"dat_paciente_content\">
        <td><label>Edad:</label></td><td>";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "html", null, true);
        echo "</td>
        <td><label>Sexo:</label></td><td>";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "idSexo"), "html", null, true);
        echo "</td>
    </tr>
    <tr class=\"dat_paciente_content\">
        <td><label>Fecha Nacimiento:</label></td><td>";
        // line 28
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "fechaNacimiento"), "d/m/Y"), "html", null, true);
        echo " </td>
        <td><label>Lugar Nacimiento:</label></td><td>";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "idDepartamentoNacimiento"), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "idMunicipioNacimiento"), "html", null, true);
        echo "</td>
    </tr>
    <tr class=\"dat_paciente_content\">
        <td><label>Dirección:</label></td><td colspan=\"3\">";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "direccion"), "html", null, true);
        echo " </td>
    </tr>
    <tr class=\"dat_paciente_content\">
        <td><label>Nombre Padre:</label></td><td>";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "nombrePadre"), "html", null, true);
        echo "</td>
        <td><label>Nombre Madre:</label></td><td>";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "nombreMadre"), "html", null, true);
        echo "</td>
    </tr>
    <tr class=\"dat_paciente_content\">
        <td><label>Nombre Responsable:</label></td><td>";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "nombreResponsable"), "html", null, true);
        echo "</td>
        <td><label>Dirección Responsable:</label></td><td>";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "direccionResponsable"), "html", null, true);
        echo "</td>
    </tr>
    <tr class=\"dat_paciente_content\">
        <td><label>Fecha Elaboración:</label></td><td>";
        // line 43
        if ($this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "fechaMod")) {
            echo " ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "fechaRegistro"), "d/m/Y H:i"), "html", null, true);
        }
        echo "</td>
        <td><label>Elaboró :</label></td><td>";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "idUser"), "html", null, true);
        echo "</td>
    </tr>
    <tr class=\"dat_paciente_content\">
        <td><label>Fecha Modificación:</label></td><td>";
        // line 47
        if ($this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "fechaMod")) {
            echo " ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "fechaMod"), "d/m/Y H:i"), "html", null, true);
        }
        echo "</td>
        <td><label>Modificó:</label></td><td>";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "idUserMod"), "html", null, true);
        echo "</td>
    </tr>

</table>
<br/>";
    }

    // line 1
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 2
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntPacienteAdmin/view.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />  
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntPacienteAdmin:identificacion_paciente.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  266 => 87,  542 => 180,  538 => 178,  527 => 173,  509 => 161,  499 => 157,  493 => 155,  479 => 154,  473 => 152,  414 => 137,  406 => 134,  280 => 75,  223 => 133,  585 => 224,  551 => 208,  546 => 206,  506 => 194,  503 => 193,  488 => 168,  485 => 167,  478 => 165,  475 => 164,  471 => 157,  448 => 123,  386 => 127,  378 => 91,  375 => 90,  306 => 109,  291 => 87,  286 => 85,  392 => 107,  332 => 145,  318 => 83,  276 => 67,  190 => 54,  12 => 36,  195 => 92,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 275,  890 => 274,  887 => 273,  885 => 272,  875 => 268,  861 => 256,  858 => 255,  853 => 294,  850 => 255,  847 => 254,  842 => 335,  827 => 252,  805 => 239,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 213,  706 => 212,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 202,  665 => 201,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 246,  613 => 232,  610 => 198,  608 => 197,  605 => 196,  602 => 230,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 167,  496 => 156,  441 => 141,  438 => 140,  432 => 123,  428 => 172,  422 => 150,  416 => 123,  395 => 118,  391 => 109,  382 => 106,  372 => 89,  364 => 98,  353 => 96,  335 => 92,  333 => 93,  297 => 84,  292 => 82,  205 => 96,  200 => 94,  184 => 87,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 275,  897 => 274,  891 => 271,  884 => 267,  881 => 270,  879 => 264,  876 => 263,  869 => 265,  867 => 258,  840 => 299,  837 => 253,  835 => 296,  833 => 254,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 232,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 182,  701 => 180,  699 => 179,  696 => 178,  690 => 174,  687 => 173,  681 => 205,  673 => 165,  671 => 164,  668 => 163,  663 => 160,  658 => 158,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 144,  629 => 141,  627 => 140,  624 => 139,  620 => 182,  614 => 133,  599 => 181,  594 => 127,  592 => 126,  589 => 124,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 195,  567 => 110,  554 => 185,  552 => 164,  544 => 181,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 159,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 148,  446 => 143,  443 => 142,  429 => 116,  425 => 64,  410 => 59,  397 => 55,  394 => 54,  389 => 128,  357 => 37,  342 => 149,  334 => 26,  330 => 92,  328 => 103,  290 => 7,  287 => 71,  263 => 86,  255 => 284,  245 => 270,  194 => 89,  76 => 7,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 257,  860 => 280,  856 => 279,  852 => 278,  848 => 277,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 251,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 246,  758 => 226,  756 => 244,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 217,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 213,  617 => 135,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 229,  595 => 205,  586 => 200,  582 => 198,  580 => 197,  572 => 218,  568 => 173,  562 => 190,  556 => 186,  550 => 183,  535 => 186,  526 => 147,  521 => 171,  515 => 178,  497 => 191,  492 => 182,  481 => 166,  476 => 163,  467 => 156,  451 => 155,  424 => 115,  418 => 148,  412 => 136,  399 => 112,  396 => 135,  390 => 133,  388 => 132,  383 => 104,  377 => 104,  373 => 46,  370 => 100,  367 => 102,  352 => 155,  349 => 101,  346 => 95,  329 => 111,  326 => 86,  313 => 126,  303 => 103,  300 => 13,  234 => 58,  218 => 98,  207 => 93,  178 => 184,  321 => 90,  295 => 11,  274 => 79,  242 => 110,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 154,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 226,  583 => 334,  579 => 222,  577 => 221,  575 => 252,  569 => 178,  565 => 109,  548 => 207,  540 => 205,  536 => 95,  529 => 174,  524 => 172,  516 => 143,  510 => 196,  504 => 292,  500 => 192,  490 => 138,  486 => 136,  482 => 285,  470 => 131,  464 => 155,  459 => 125,  452 => 145,  434 => 256,  421 => 114,  417 => 138,  385 => 107,  361 => 97,  344 => 94,  339 => 28,  324 => 142,  310 => 171,  302 => 131,  296 => 89,  282 => 83,  259 => 118,  244 => 111,  231 => 57,  226 => 102,  114 => 39,  104 => 25,  288 => 107,  284 => 70,  279 => 82,  275 => 330,  256 => 65,  250 => 123,  237 => 116,  232 => 249,  222 => 100,  215 => 97,  191 => 88,  153 => 72,  563 => 176,  560 => 187,  558 => 186,  555 => 210,  553 => 168,  549 => 182,  543 => 189,  537 => 204,  532 => 175,  528 => 173,  525 => 201,  523 => 181,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 175,  491 => 157,  487 => 156,  460 => 147,  455 => 156,  449 => 138,  442 => 153,  439 => 71,  436 => 151,  433 => 117,  426 => 126,  420 => 123,  415 => 144,  411 => 120,  405 => 114,  403 => 133,  400 => 233,  380 => 112,  366 => 169,  354 => 158,  331 => 105,  325 => 93,  320 => 91,  317 => 90,  311 => 85,  308 => 123,  304 => 85,  272 => 89,  267 => 90,  249 => 63,  216 => 99,  155 => 2,  152 => 1,  146 => 34,  126 => 29,  181 => 48,  161 => 53,  110 => 29,  188 => 90,  186 => 85,  170 => 44,  150 => 71,  124 => 55,  358 => 96,  351 => 102,  347 => 134,  343 => 116,  338 => 112,  327 => 143,  323 => 92,  319 => 124,  315 => 82,  301 => 106,  299 => 90,  293 => 88,  289 => 81,  281 => 94,  277 => 74,  271 => 78,  265 => 76,  262 => 76,  260 => 85,  257 => 56,  251 => 110,  248 => 71,  239 => 68,  228 => 103,  225 => 162,  213 => 69,  211 => 128,  197 => 72,  174 => 85,  148 => 49,  134 => 55,  127 => 66,  20 => 1,  53 => 14,  270 => 70,  253 => 71,  233 => 104,  212 => 98,  210 => 97,  206 => 74,  202 => 95,  198 => 56,  192 => 90,  185 => 61,  180 => 83,  175 => 81,  172 => 42,  167 => 75,  165 => 79,  160 => 50,  137 => 63,  113 => 39,  100 => 24,  90 => 38,  81 => 8,  129 => 63,  84 => 19,  77 => 28,  34 => 4,  118 => 53,  97 => 32,  70 => 18,  65 => 35,  58 => 20,  23 => 6,  480 => 134,  474 => 80,  469 => 150,  461 => 157,  457 => 153,  453 => 151,  444 => 122,  440 => 148,  437 => 118,  435 => 139,  430 => 149,  427 => 65,  423 => 63,  413 => 241,  409 => 135,  407 => 238,  402 => 113,  398 => 92,  393 => 117,  387 => 110,  384 => 110,  381 => 109,  379 => 119,  374 => 103,  368 => 99,  365 => 98,  362 => 97,  360 => 38,  355 => 95,  341 => 93,  337 => 90,  322 => 109,  314 => 86,  312 => 149,  309 => 79,  305 => 77,  298 => 12,  294 => 98,  285 => 79,  283 => 76,  278 => 331,  268 => 77,  264 => 68,  258 => 66,  252 => 53,  247 => 273,  241 => 107,  229 => 111,  220 => 99,  214 => 62,  177 => 82,  169 => 33,  140 => 73,  132 => 59,  128 => 57,  107 => 36,  61 => 15,  273 => 71,  269 => 91,  254 => 85,  243 => 89,  240 => 263,  238 => 84,  235 => 105,  230 => 61,  227 => 104,  224 => 101,  221 => 79,  219 => 64,  217 => 63,  208 => 96,  204 => 53,  179 => 86,  159 => 75,  143 => 48,  135 => 67,  119 => 59,  102 => 43,  71 => 10,  67 => 4,  63 => 3,  59 => 17,  38 => 13,  94 => 38,  89 => 29,  85 => 28,  75 => 24,  68 => 23,  56 => 11,  201 => 91,  196 => 56,  183 => 84,  171 => 128,  166 => 82,  163 => 81,  158 => 37,  156 => 78,  151 => 77,  142 => 74,  138 => 68,  136 => 47,  121 => 64,  117 => 40,  105 => 45,  91 => 41,  62 => 21,  49 => 34,  28 => 13,  26 => 6,  87 => 34,  31 => 11,  25 => 12,  21 => 1,  24 => 1,  19 => 1,  93 => 39,  88 => 21,  78 => 24,  46 => 9,  44 => 8,  27 => 4,  79 => 25,  72 => 25,  69 => 15,  47 => 15,  40 => 11,  37 => 6,  22 => 4,  246 => 122,  157 => 51,  145 => 74,  139 => 71,  131 => 60,  123 => 43,  120 => 34,  115 => 53,  111 => 22,  108 => 47,  101 => 33,  98 => 34,  96 => 23,  83 => 29,  74 => 26,  66 => 14,  55 => 1,  52 => 10,  50 => 16,  43 => 27,  41 => 7,  35 => 9,  32 => 15,  29 => 15,  209 => 127,  203 => 72,  199 => 90,  193 => 55,  189 => 51,  187 => 48,  182 => 87,  176 => 85,  173 => 35,  168 => 91,  164 => 79,  162 => 38,  154 => 36,  149 => 62,  147 => 75,  144 => 60,  141 => 65,  133 => 68,  130 => 44,  125 => 46,  122 => 64,  116 => 61,  112 => 70,  109 => 50,  106 => 26,  103 => 35,  99 => 41,  95 => 41,  92 => 37,  86 => 30,  82 => 31,  80 => 19,  73 => 6,  64 => 20,  60 => 12,  57 => 16,  54 => 18,  51 => 12,  48 => 13,  45 => 22,  42 => 19,  39 => 20,  36 => 8,  33 => 12,  30 => 3,);
    }
}
