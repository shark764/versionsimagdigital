<?php

/* MinsalSimagdBundle:ImgCitaAdmin:cit_calendarioCitasProgramadas.html.twig */
class __TwigTemplate_c225330c9db84a9bd53da0444d8b94460e1b8977b772fa8f3b3980ce00be15ed extends Twig_Template
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
    <div id=\"citas-calendario\" class=\"modal container fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\">
\t<div class=\"modal-content panel-primary-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\">Imagenología - Citas programadas</h4>
            </div>

            <div class=\"modal-body\">
                
                <div class=\"row outer\">

                    <div class=\"col-lg-5 col-md-5 col-sm-5\">

                        <div class=\"panel panel-primary\">
                            <div class=\"panel-heading\">
                                <h3 class=\"panel-title\"> Información relevante </h3>
                            </div>
                            <div class=\"panel-body\" >

                                <div class=\"tabbable tabs-below\">

                                    <ul class=\"nav nav-tabs\">
                                        <li class=\"active\"><a href=\"#tab-info-preinscripcion\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-list-alt\"></span> Solicitud de estudio</a></li>
                                        <li><a href=\"#tab-info-parametros-cita\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-tasks\"></span> Parámetros</a></li>
                                        <li><a href=\"#tab-info-reservas-cita\" data-toggle=\"pill\"><span class=\"glyphicon glyphicon-calendar\"></span> Espacios</a></li>
                                    </ul>

                                    <br/>

                                    <div class=\"tab-content\">

                                        <div class=\"tab-pane fade in active\" id=\"tab-info-preinscripcion\">
                                            <table class=\"table table-condensed\">

                                                ";
        // line 37
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio")))) {
            // line 38
            echo "
                                                    <tr>
                                                        <th class=\"col-md-4\">Nombre completo</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static\"> ";
            // line 42
            echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio"), "idExpediente"), "idPaciente");
            echo " </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th class=\"col-md-4\">Modalidad</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static\"> ";
            // line 49
            echo $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio"), "idAreaServicioDiagnostico");
            echo " </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th class=\"col-md-4\">Proyecciones</th>
                                                        <td class=\"col-md-8\">
                                                            <ul>
                                                                ";
            // line 57
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio"), "solicitudEstudioProyeccion"));
            foreach ($context['_seq'] as $context["_key"] => $context["exploracion"]) {
                // line 58
                echo "                                                                    <li> <span class=\"form-control-static\"> ";
                echo $this->getAttribute((isset($context["exploracion"]) ? $context["exploracion"] : $this->getContext($context, "exploracion")), "idProyeccionSolicitada");
                echo " </span> </li>
                                                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exploracion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "                                                            </ul>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th class=\"col-md-4\">Próxima cita médica</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static\"> ";
            // line 67
            echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idSolicitudEstudio"), "fechaProximaConsulta"), "EEEE, MMMM d, yyyy", "es_ES");
            echo " </span>
                                                        </td>
                                                    </tr>

                                                ";
        } else {
            // line 72
            echo "
                                                    <tr>
                                                        <th class=\"col-md-4\">Error</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static text-danger\"> Ninguna preinscripción seleccionada </span>
                                                        </td>
                                                    </tr>

                                                ";
        }
        // line 81
        echo "
                                            </table>
                                        </div>

                                        <div class=\"tab-pane fade\" id=\"tab-info-parametros-cita\">
                                            <table class=\"table table-condensed\">

                                                ";
        // line 88
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idConfiguracionAgenda")))) {
            // line 89
            echo "
                                                    <tr>
                                                        <th class=\"col-md-4\">Máximo por día</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static\"> ";
            // line 93
            echo $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idConfiguracionAgenda"), "maximoCitasDia");
            echo " </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th class=\"col-md-4\">Máximo por turno</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static\"> ";
            // line 100
            echo $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idConfiguracionAgenda"), "maximoCitasTurno");
            echo " </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th class=\"col-md-4\">Máximo por hora</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static\"> ";
            // line 107
            echo $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idConfiguracionAgenda"), "maximoCitasHora");
            echo " </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th class=\"col-md-4\">Máximo por médico</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static\"> ";
            // line 114
            echo $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idConfiguracionAgenda"), "maximoCitasMedico");
            echo " </span>
                                                        </td>
                                                    </tr>

                                                ";
        } else {
            // line 119
            echo "
                                                    <tr>
                                                        <th class=\"col-md-4\">Advertencia</th>
                                                        <td class=\"col-md-8\">
                                                            <span class=\"form-control-static text-danger\"> No se pudieron obtener parámetros para citar el estudio a realizar </span>
                                                        </td>
                                                    </tr>

                                                ";
        }
        // line 128
        echo "
                                            </table>
                                        </div>

                                        <div class=\"tab-pane fade\" id=\"tab-info-reservas-cita\">
                                            ";
        // line 134
        echo "                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>";
        // line 144
        echo "
                    <div class=\"col-lg-7 col-md-7 col-sm-7\">

                        <div class=\"panel panel-info\">
                            <div class=\"panel-heading\">
                                <h3 class=\"panel-title\"> Calendarización </h3>
                            </div>
                            <div class=\"panel-body\" >

                                ";
        // line 154
        echo "                                <div id='calendar'></div>

                            </div>
                        </div>

                    </div>";
        // line 160
        echo "
                </div>";
        // line 162
        echo "
            </div>";
        // line 164
        echo "
            <div class=\"modal-footer\">
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
            
\t</div><!-- /.modal-content -->
        
    </div>";
        // line 172
        echo "    
    ";
        // line 176
        echo "

    ";
        // line 179
        echo "    <div id=\"fullCalModal\" class=\"modal fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\">
\t<div class=\"modal-content panel-success\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 id=\"eventModalTitle\" class=\"modal-title\"></h4>
            </div>

            <div id=\"eventModalBody\" class=\"modal-body\"></div>

            <div class=\"modal-footer\" style=\"margin-top: 0px;\">
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
                <a id=\"eventUrl\" class=\"btn btn-info\" target=\"_blank\"> <span class=\"glyphicon glyphicon-folder-open\"></span>&nbsp; Consultar </a>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCitaAdmin:cit_calendarioCitasProgramadas.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 414,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 392,  862 => 389,  844 => 385,  834 => 382,  802 => 373,  796 => 369,  768 => 352,  747 => 340,  708 => 321,  698 => 313,  677 => 293,  630 => 263,  787 => 404,  784 => 403,  776 => 401,  494 => 240,  564 => 189,  561 => 188,  456 => 170,  431 => 208,  634 => 356,  628 => 354,  601 => 319,  545 => 304,  350 => 175,  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 405,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 352,  596 => 231,  578 => 270,  534 => 176,  507 => 186,  447 => 236,  445 => 216,  419 => 181,  454 => 160,  371 => 174,  651 => 437,  483 => 180,  404 => 184,  517 => 283,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 150,  622 => 204,  531 => 224,  498 => 182,  468 => 163,  458 => 204,  401 => 199,  369 => 165,  356 => 147,  340 => 141,  874 => 781,  854 => 388,  851 => 387,  836 => 361,  831 => 381,  828 => 380,  825 => 357,  820 => 318,  817 => 376,  813 => 349,  799 => 341,  792 => 367,  773 => 327,  766 => 351,  763 => 350,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 327,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 340,  637 => 262,  604 => 320,  588 => 239,  573 => 294,  559 => 187,  547 => 274,  520 => 215,  450 => 173,  408 => 213,  363 => 181,  359 => 280,  348 => 134,  345 => 133,  336 => 170,  316 => 154,  307 => 124,  261 => 111,  266 => 112,  542 => 230,  538 => 177,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 174,  280 => 106,  223 => 97,  585 => 224,  551 => 276,  546 => 308,  506 => 103,  503 => 193,  488 => 261,  485 => 268,  478 => 176,  475 => 164,  471 => 173,  448 => 217,  386 => 127,  378 => 186,  375 => 157,  306 => 146,  291 => 123,  286 => 140,  392 => 178,  332 => 139,  318 => 143,  276 => 160,  190 => 144,  12 => 36,  195 => 86,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 400,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 374,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 389,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 381,  706 => 380,  703 => 379,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 275,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 353,  623 => 183,  616 => 323,  613 => 350,  610 => 349,  608 => 197,  605 => 253,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 190,  533 => 203,  530 => 150,  513 => 168,  496 => 280,  441 => 185,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 161,  395 => 172,  391 => 171,  382 => 195,  372 => 184,  364 => 282,  353 => 175,  335 => 154,  333 => 151,  297 => 141,  292 => 121,  205 => 89,  200 => 82,  184 => 65,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 418,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 403,  900 => 385,  897 => 384,  891 => 399,  884 => 397,  881 => 270,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 400,  754 => 208,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 344,  726 => 341,  723 => 326,  719 => 383,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 378,  696 => 291,  690 => 285,  687 => 173,  681 => 372,  673 => 291,  671 => 280,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 153,  643 => 359,  640 => 358,  636 => 264,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 520,  592 => 519,  589 => 247,  587 => 388,  584 => 320,  576 => 324,  574 => 242,  570 => 291,  567 => 290,  554 => 311,  552 => 235,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 250,  502 => 184,  477 => 196,  472 => 132,  465 => 222,  463 => 208,  446 => 244,  443 => 215,  429 => 183,  425 => 195,  410 => 167,  397 => 194,  394 => 179,  389 => 177,  357 => 138,  342 => 172,  334 => 171,  330 => 158,  328 => 140,  290 => 137,  287 => 120,  263 => 103,  255 => 122,  245 => 102,  194 => 81,  76 => 33,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 401,  888 => 398,  882 => 396,  873 => 267,  868 => 282,  864 => 390,  860 => 327,  856 => 279,  852 => 324,  848 => 386,  843 => 257,  838 => 383,  832 => 271,  826 => 247,  823 => 268,  819 => 377,  814 => 265,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 395,  758 => 346,  756 => 318,  751 => 392,  739 => 200,  736 => 347,  733 => 386,  725 => 385,  722 => 384,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 322,  606 => 321,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 329,  580 => 387,  572 => 218,  568 => 241,  562 => 313,  556 => 307,  550 => 183,  535 => 271,  526 => 222,  521 => 171,  515 => 258,  497 => 243,  492 => 341,  481 => 218,  476 => 175,  467 => 190,  451 => 218,  424 => 182,  418 => 192,  412 => 189,  399 => 154,  396 => 153,  390 => 305,  388 => 190,  383 => 200,  377 => 169,  373 => 149,  370 => 154,  367 => 153,  352 => 157,  349 => 145,  346 => 155,  329 => 138,  326 => 156,  313 => 136,  303 => 141,  300 => 124,  234 => 164,  218 => 96,  207 => 98,  178 => 70,  321 => 134,  295 => 142,  274 => 115,  242 => 110,  236 => 112,  692 => 175,  683 => 373,  678 => 371,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 269,  641 => 368,  635 => 268,  631 => 355,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 246,  579 => 299,  577 => 318,  575 => 252,  569 => 191,  565 => 314,  548 => 207,  540 => 273,  536 => 358,  529 => 174,  524 => 173,  516 => 143,  510 => 185,  504 => 185,  500 => 206,  490 => 201,  486 => 275,  482 => 285,  470 => 225,  464 => 180,  459 => 171,  452 => 145,  434 => 209,  421 => 205,  417 => 159,  385 => 201,  361 => 180,  344 => 157,  339 => 147,  324 => 135,  310 => 113,  302 => 145,  296 => 122,  282 => 114,  259 => 96,  244 => 107,  231 => 162,  226 => 86,  114 => 48,  104 => 54,  288 => 120,  284 => 162,  279 => 129,  275 => 208,  256 => 205,  250 => 179,  237 => 98,  232 => 96,  222 => 57,  215 => 156,  191 => 80,  153 => 100,  563 => 223,  560 => 222,  558 => 236,  555 => 185,  553 => 211,  549 => 182,  543 => 179,  537 => 272,  532 => 270,  528 => 173,  525 => 356,  523 => 221,  518 => 170,  514 => 168,  511 => 167,  508 => 208,  501 => 161,  495 => 158,  491 => 239,  487 => 156,  460 => 143,  455 => 188,  449 => 187,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 202,  405 => 118,  403 => 117,  400 => 182,  380 => 107,  366 => 182,  354 => 101,  331 => 141,  325 => 94,  320 => 144,  317 => 131,  311 => 129,  308 => 128,  304 => 152,  272 => 81,  267 => 78,  249 => 108,  216 => 70,  155 => 62,  152 => 61,  146 => 49,  126 => 81,  181 => 119,  161 => 54,  110 => 45,  188 => 81,  186 => 78,  170 => 63,  150 => 64,  124 => 68,  358 => 179,  351 => 135,  347 => 174,  343 => 146,  338 => 144,  327 => 154,  323 => 128,  319 => 155,  315 => 132,  301 => 124,  299 => 148,  293 => 139,  289 => 125,  281 => 118,  277 => 105,  271 => 105,  265 => 113,  262 => 97,  260 => 98,  257 => 110,  251 => 143,  248 => 103,  239 => 113,  228 => 160,  225 => 81,  213 => 155,  211 => 80,  197 => 69,  174 => 68,  148 => 54,  134 => 49,  127 => 49,  20 => 2,  53 => 20,  270 => 114,  253 => 109,  233 => 101,  212 => 93,  210 => 144,  206 => 88,  202 => 79,  198 => 85,  192 => 128,  185 => 94,  180 => 64,  175 => 68,  172 => 62,  167 => 57,  165 => 65,  160 => 59,  137 => 89,  113 => 46,  100 => 67,  90 => 37,  81 => 36,  129 => 54,  84 => 43,  77 => 26,  34 => 10,  118 => 65,  97 => 40,  70 => 25,  65 => 20,  58 => 38,  23 => 4,  480 => 179,  474 => 195,  469 => 150,  461 => 157,  457 => 161,  453 => 169,  444 => 230,  440 => 172,  437 => 203,  435 => 167,  430 => 172,  427 => 339,  423 => 206,  413 => 160,  409 => 195,  407 => 157,  402 => 190,  398 => 115,  393 => 112,  387 => 176,  384 => 175,  381 => 173,  379 => 194,  374 => 168,  368 => 190,  365 => 165,  362 => 141,  360 => 104,  355 => 156,  341 => 123,  337 => 97,  322 => 93,  314 => 88,  312 => 141,  309 => 118,  305 => 134,  298 => 125,  294 => 145,  285 => 115,  283 => 119,  278 => 116,  268 => 104,  264 => 201,  258 => 108,  252 => 121,  247 => 98,  241 => 88,  229 => 82,  220 => 80,  214 => 82,  177 => 72,  169 => 66,  140 => 53,  132 => 55,  128 => 58,  107 => 67,  61 => 21,  273 => 106,  269 => 113,  254 => 105,  243 => 172,  240 => 195,  238 => 104,  235 => 86,  230 => 106,  227 => 92,  224 => 163,  221 => 154,  219 => 99,  217 => 90,  208 => 104,  204 => 116,  179 => 82,  159 => 63,  143 => 93,  135 => 88,  119 => 43,  102 => 36,  71 => 15,  67 => 24,  63 => 22,  59 => 29,  38 => 9,  94 => 39,  89 => 58,  85 => 57,  75 => 27,  68 => 27,  56 => 37,  201 => 88,  196 => 87,  183 => 77,  171 => 65,  166 => 63,  163 => 107,  158 => 58,  156 => 69,  151 => 55,  142 => 58,  138 => 57,  136 => 75,  121 => 46,  117 => 48,  105 => 44,  91 => 60,  62 => 24,  49 => 16,  28 => 9,  26 => 13,  87 => 29,  31 => 8,  25 => 5,  21 => 2,  24 => 6,  19 => 2,  93 => 49,  88 => 36,  78 => 39,  46 => 15,  44 => 14,  27 => 7,  79 => 29,  72 => 23,  69 => 51,  47 => 14,  40 => 12,  37 => 11,  22 => 4,  246 => 176,  157 => 67,  145 => 59,  139 => 57,  131 => 71,  123 => 49,  120 => 67,  115 => 72,  111 => 47,  108 => 45,  101 => 51,  98 => 60,  96 => 39,  83 => 26,  74 => 49,  66 => 18,  55 => 19,  52 => 20,  50 => 19,  43 => 14,  41 => 13,  35 => 10,  32 => 9,  29 => 8,  209 => 96,  203 => 87,  199 => 134,  193 => 68,  189 => 79,  187 => 142,  182 => 85,  176 => 63,  173 => 114,  168 => 61,  164 => 60,  162 => 64,  154 => 63,  149 => 60,  147 => 69,  144 => 68,  141 => 64,  133 => 63,  130 => 65,  125 => 53,  122 => 52,  116 => 48,  112 => 40,  109 => 38,  106 => 43,  103 => 42,  99 => 35,  95 => 50,  92 => 38,  86 => 35,  82 => 27,  80 => 41,  73 => 26,  64 => 42,  60 => 18,  57 => 18,  54 => 21,  51 => 17,  48 => 16,  45 => 18,  42 => 13,  39 => 12,  36 => 8,  33 => 6,  30 => 5,);
    }
}
