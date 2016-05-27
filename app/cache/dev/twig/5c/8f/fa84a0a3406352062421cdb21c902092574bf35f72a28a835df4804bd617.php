<?php

/* MinsalSimagdBundle:ImgCitaAdmin:cit_edit.html.twig */
class __TwigTemplate_5c8ffa84a0a3406352062421cdb21c902092574bf35f72a28a835df4804bd617 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_base_edit.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'actions' => array($this, 'block_actions'),
            'simagd_form_navbar_brand_title' => array($this, 'block_simagd_form_navbar_brand_title'),
            'form' => array($this, 'block_form'),
            'custom_entity_support' => array($this, 'block_custom_entity_support'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 5
        $context["_pacienteTitle"] = (((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio")))) ? (twig_truncate_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio"), "idExpediente"), "idPaciente"), 50)) : ("No hay preinscripción"));
        // line 6
        $context["_citMessageTemplate"] = (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? ((("<i class=\"fa fa-tags\"></i> <i class=\"fa fa-pencil-square-o\"></i> Edición de Cita programada para: <i>" . (isset($context["_pacienteTitle"]) ? $context["_pacienteTitle"] : $this->getContext($context, "_pacienteTitle"))) . "</i>")) : ((("<i class=\"fa fa-tags\"></i> <i class=\"fa fa-plus-circle\"></i> Programación de cita a paciente preinscrito: <i>" . (isset($context["_pacienteTitle"]) ? $context["_pacienteTitle"] : $this->getContext($context, "_pacienteTitle"))) . "</i>")));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    
    ";
        // line 14
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/fullcalendar-2.3.2/fullcalendar.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
";
    }

    // line 17
    public function block_javascripts($context, array $blocks = array())
    {
        // line 18
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    
    <script type=\"text/javascript\" src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_config_picker.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_calendar_modal_config.js"), "html", null, true);
        echo "\" ></script>

    <script type=\"text/javascript\" src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgCitaAdmin/cit_form_config.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 26
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/fullcalendar-2.3.2/fullcalendar.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/fullcalendar-2.3.2/lang-all.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 29
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_funcionesClienteServidor.js.twig")->display($context);
        // line 30
        echo "    
    ";
        // line 31
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_bootstrapValidator.js.twig")->display($context);
        // line 32
        echo "    
";
    }

    // line 35
    public function block_actions($context, array $blocks = array())
    {
        // line 36
        echo "    ";
        // line 37
        echo "    <li>";
        $this->env->loadTemplate("SonataAdminBundle:Button:history_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 38
        $this->env->loadTemplate("SonataAdminBundle:Button:acl_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 39
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
    ";
    }

    // line 43
    public function block_simagd_form_navbar_brand_title($context, array $blocks = array())
    {
        // line 44
        echo "    <span class=\"navbar-brand\">
        <span class=\"label label-";
        // line 45
        echo (((array_key_exists("action", $context) && ((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit"))) ? ("primary-v2") : ("element-v2"));
        echo "\"> ";
        echo (isset($context["_citMessageTemplate"]) ? $context["_citMessageTemplate"] : $this->getContext($context, "_citMessageTemplate"));
        echo " </span>
    </span>
";
    }

    // line 49
    public function block_form($context, array $blocks = array())
    {
        // line 50
        echo "    ";
        $context["cit_vars"] = array("simagd_title" => "FORMULARIO PARA PROGRAMACIÓN DE CITA DE IMAGENOLOGÍA", "simagd_message" => "Llene este formulario para concertar una cita para el paciente preinscrito");
        // line 53
        echo "    ";
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_cabecera.html.twig")->display(array_merge($context, (isset($context["cit_vars"]) ? $context["cit_vars"] : $this->getContext($context, "cit_vars"))));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 54
        echo "    
    ";
        // line 55
        $this->displayBlock("parentForm", $context, $blocks);
        echo "
    
    ";
        // line 57
        $this->env->loadTemplate("MinsalSimagdBundle:ImgCitaAdmin:cit_calendarioCitasProgramadas.html.twig")->display($context);
        // line 58
        echo "    
";
    }

    // line 62
    public function block_custom_entity_support($context, array $blocks = array())
    {
        // line 63
        echo "    <div id=\"custom-entity-content-body\">
        ";
        // line 64
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio")))) {
            // line 65
            echo "            ";
            echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("MinsalSimagdBundle:ImgCitaAdmin:mostrarInformacionModal", array("idSolicitudEstudioPadre" => $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio"), "id"), "id" => (($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id")) ? ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id")) : ((-1))), "_sonata_admin" => "minsal_simagd.admin.img_cita")));
            // line 68
            echo "
        ";
        }
        // line 70
        echo "    </div>
";
    }

    // line 77
    public function block_content($context, array $blocks = array())
    {
        // line 78
        echo "    
    ";
        // line 79
        $this->displayParentBlock("content", $context, $blocks);
        echo "
    
    <a href=\"";
        // line 81
        echo $this->env->getExtension('routing')->getPath("simagd_cita_calendario");
        echo "\">Calendario</a>
    
    <a href=\"";
        // line 83
        echo $this->env->getExtension('routing')->getPath("simagd_cita_agenda");
        echo "\">Agenda</a>
    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCitaAdmin:cit_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  787 => 404,  784 => 403,  776 => 401,  494 => 240,  564 => 189,  561 => 188,  456 => 170,  431 => 208,  634 => 356,  628 => 354,  601 => 319,  545 => 304,  350 => 175,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 321,  778 => 315,  772 => 312,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 352,  596 => 231,  578 => 270,  534 => 176,  507 => 186,  447 => 236,  445 => 216,  419 => 198,  454 => 160,  371 => 174,  651 => 437,  483 => 180,  404 => 184,  517 => 283,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 150,  622 => 204,  531 => 175,  498 => 182,  468 => 163,  458 => 204,  401 => 199,  369 => 165,  356 => 212,  340 => 148,  874 => 781,  854 => 325,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 318,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 309,  763 => 396,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 303,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 340,  637 => 262,  604 => 320,  588 => 239,  573 => 294,  559 => 187,  547 => 274,  520 => 171,  450 => 173,  408 => 213,  363 => 181,  359 => 280,  348 => 134,  345 => 133,  336 => 170,  316 => 154,  307 => 124,  261 => 109,  266 => 112,  542 => 303,  538 => 177,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 272,  473 => 165,  414 => 216,  406 => 201,  280 => 106,  223 => 93,  585 => 224,  551 => 276,  546 => 308,  506 => 103,  503 => 193,  488 => 261,  485 => 268,  478 => 176,  475 => 164,  471 => 173,  448 => 217,  386 => 127,  378 => 186,  375 => 90,  306 => 146,  291 => 123,  286 => 140,  392 => 178,  332 => 130,  318 => 143,  276 => 160,  190 => 144,  12 => 36,  195 => 86,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 357,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 348,  894 => 383,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 389,  738 => 388,  730 => 219,  727 => 218,  712 => 214,  709 => 381,  706 => 380,  703 => 379,  697 => 377,  694 => 376,  691 => 375,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 323,  613 => 350,  610 => 349,  608 => 197,  605 => 196,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 190,  533 => 203,  530 => 150,  513 => 168,  496 => 280,  441 => 212,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 161,  395 => 118,  391 => 109,  382 => 195,  372 => 184,  364 => 282,  353 => 175,  335 => 154,  333 => 151,  297 => 141,  292 => 134,  205 => 85,  200 => 82,  184 => 65,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 300,  946 => 296,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 320,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 400,  754 => 208,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 344,  726 => 341,  723 => 340,  719 => 383,  717 => 382,  714 => 185,  704 => 294,  701 => 180,  699 => 378,  696 => 291,  690 => 285,  687 => 173,  681 => 372,  673 => 281,  671 => 280,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 339,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 325,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 226,  587 => 388,  584 => 320,  576 => 324,  574 => 317,  570 => 291,  567 => 290,  554 => 311,  552 => 305,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 250,  502 => 184,  477 => 229,  472 => 132,  465 => 222,  463 => 208,  446 => 244,  443 => 215,  429 => 219,  425 => 195,  410 => 167,  397 => 194,  394 => 179,  389 => 177,  357 => 138,  342 => 172,  334 => 171,  330 => 158,  328 => 140,  290 => 137,  287 => 120,  263 => 103,  255 => 122,  245 => 102,  194 => 81,  76 => 38,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 373,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 296,  888 => 270,  882 => 333,  873 => 267,  868 => 282,  864 => 372,  860 => 327,  856 => 279,  852 => 324,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 395,  758 => 394,  756 => 318,  751 => 392,  739 => 200,  736 => 347,  733 => 386,  725 => 385,  722 => 384,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 322,  606 => 321,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 329,  580 => 387,  572 => 218,  568 => 227,  562 => 313,  556 => 307,  550 => 183,  535 => 271,  526 => 212,  521 => 171,  515 => 258,  497 => 243,  492 => 341,  481 => 218,  476 => 175,  467 => 156,  451 => 218,  424 => 164,  418 => 192,  412 => 189,  399 => 154,  396 => 153,  390 => 305,  388 => 190,  383 => 200,  377 => 169,  373 => 149,  370 => 147,  367 => 172,  352 => 157,  349 => 155,  346 => 155,  329 => 111,  326 => 156,  313 => 136,  303 => 141,  300 => 124,  234 => 109,  218 => 79,  207 => 98,  178 => 70,  321 => 152,  295 => 142,  274 => 205,  242 => 110,  236 => 112,  692 => 175,  683 => 373,  678 => 371,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 150,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 224,  579 => 299,  577 => 318,  575 => 252,  569 => 191,  565 => 314,  548 => 207,  540 => 273,  536 => 358,  529 => 174,  524 => 173,  516 => 143,  510 => 185,  504 => 185,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 225,  464 => 180,  459 => 171,  452 => 145,  434 => 209,  421 => 205,  417 => 159,  385 => 201,  361 => 180,  344 => 157,  339 => 147,  324 => 123,  310 => 113,  302 => 145,  296 => 111,  282 => 114,  259 => 96,  244 => 116,  231 => 117,  226 => 86,  114 => 72,  104 => 37,  288 => 138,  284 => 162,  279 => 129,  275 => 208,  256 => 205,  250 => 92,  237 => 98,  232 => 96,  222 => 57,  215 => 156,  191 => 80,  153 => 72,  563 => 223,  560 => 222,  558 => 186,  555 => 185,  553 => 211,  549 => 182,  543 => 179,  537 => 272,  532 => 270,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 239,  487 => 156,  460 => 143,  455 => 141,  449 => 210,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 202,  405 => 118,  403 => 117,  400 => 182,  380 => 107,  366 => 182,  354 => 101,  331 => 141,  325 => 94,  320 => 144,  317 => 91,  311 => 87,  308 => 130,  304 => 152,  272 => 81,  267 => 78,  249 => 74,  216 => 70,  155 => 57,  152 => 56,  146 => 49,  126 => 54,  181 => 61,  161 => 54,  110 => 52,  188 => 74,  186 => 78,  170 => 63,  150 => 64,  124 => 68,  358 => 179,  351 => 135,  347 => 174,  343 => 146,  338 => 144,  327 => 154,  323 => 128,  319 => 155,  315 => 132,  301 => 144,  299 => 148,  293 => 139,  289 => 125,  281 => 118,  277 => 105,  271 => 105,  265 => 211,  262 => 97,  260 => 98,  257 => 121,  251 => 143,  248 => 103,  239 => 113,  228 => 94,  225 => 81,  213 => 155,  211 => 80,  197 => 69,  174 => 68,  148 => 54,  134 => 49,  127 => 49,  20 => 2,  53 => 42,  270 => 204,  253 => 93,  233 => 71,  212 => 103,  210 => 86,  206 => 88,  202 => 79,  198 => 85,  192 => 66,  185 => 94,  180 => 64,  175 => 68,  172 => 62,  167 => 57,  165 => 77,  160 => 59,  137 => 50,  113 => 39,  100 => 67,  90 => 41,  81 => 49,  129 => 92,  84 => 43,  77 => 26,  34 => 6,  118 => 65,  97 => 41,  70 => 22,  65 => 20,  58 => 17,  23 => 3,  480 => 179,  474 => 150,  469 => 150,  461 => 157,  457 => 161,  453 => 169,  444 => 230,  440 => 172,  437 => 203,  435 => 167,  430 => 172,  427 => 339,  423 => 206,  413 => 160,  409 => 195,  407 => 157,  402 => 190,  398 => 115,  393 => 112,  387 => 176,  384 => 175,  381 => 173,  379 => 194,  374 => 168,  368 => 190,  365 => 165,  362 => 141,  360 => 104,  355 => 156,  341 => 123,  337 => 97,  322 => 93,  314 => 88,  312 => 141,  309 => 118,  305 => 134,  298 => 125,  294 => 145,  285 => 115,  283 => 134,  278 => 110,  268 => 104,  264 => 201,  258 => 108,  252 => 121,  247 => 98,  241 => 88,  229 => 82,  220 => 80,  214 => 82,  177 => 65,  169 => 64,  140 => 53,  132 => 44,  128 => 58,  107 => 60,  61 => 21,  273 => 106,  269 => 113,  254 => 105,  243 => 92,  240 => 195,  238 => 87,  235 => 86,  230 => 106,  227 => 92,  224 => 163,  221 => 101,  219 => 99,  217 => 90,  208 => 104,  204 => 116,  179 => 82,  159 => 91,  143 => 77,  135 => 97,  119 => 43,  102 => 36,  71 => 15,  67 => 21,  63 => 20,  59 => 29,  38 => 10,  94 => 32,  89 => 30,  85 => 31,  75 => 46,  68 => 27,  56 => 17,  201 => 70,  196 => 81,  183 => 77,  171 => 65,  166 => 63,  163 => 62,  158 => 58,  156 => 57,  151 => 55,  142 => 101,  138 => 57,  136 => 75,  121 => 46,  117 => 86,  105 => 44,  91 => 60,  62 => 24,  49 => 20,  28 => 9,  26 => 13,  87 => 29,  31 => 5,  25 => 5,  21 => 2,  24 => 9,  19 => 1,  93 => 49,  88 => 32,  78 => 39,  46 => 15,  44 => 10,  27 => 10,  79 => 32,  72 => 23,  69 => 51,  47 => 14,  40 => 12,  37 => 7,  22 => 3,  246 => 112,  157 => 67,  145 => 59,  139 => 80,  131 => 71,  123 => 49,  120 => 56,  115 => 44,  111 => 61,  108 => 45,  101 => 31,  98 => 24,  96 => 39,  83 => 26,  74 => 24,  66 => 18,  55 => 22,  52 => 16,  50 => 19,  43 => 10,  41 => 11,  35 => 13,  32 => 6,  29 => 10,  209 => 96,  203 => 87,  199 => 83,  193 => 68,  189 => 79,  187 => 142,  182 => 85,  176 => 63,  173 => 69,  168 => 61,  164 => 60,  162 => 60,  154 => 63,  149 => 60,  147 => 69,  144 => 68,  141 => 58,  133 => 54,  130 => 65,  125 => 45,  122 => 44,  116 => 48,  112 => 40,  109 => 38,  106 => 69,  103 => 68,  99 => 35,  95 => 50,  92 => 31,  86 => 44,  82 => 27,  80 => 41,  73 => 37,  64 => 19,  60 => 18,  57 => 18,  54 => 17,  51 => 21,  48 => 15,  45 => 18,  42 => 17,  39 => 9,  36 => 8,  33 => 6,  30 => 5,);
    }
}
