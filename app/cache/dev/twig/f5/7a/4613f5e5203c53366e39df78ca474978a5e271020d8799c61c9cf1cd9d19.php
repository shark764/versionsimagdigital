<?php

/* MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_bootstrapValidator.js.twig */
class __TwigTemplate_f57a4613f5e5203c53366e39df78ca474978a5e271020d8799c61c9cf1cd9d19 extends Twig_Template
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
    <script type=\"text/javascript\">
        //options
        //http://bootstrapvalidator.com/api/#update-message
        
        jQuery(document).ready(function() {
            /** Validación de formulario de inserción/actualización */
            jQuery('#simagd_entity_full_admin_form').formValidation({
                excluded: [':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    '";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[hipotesisDiagnostica]': {
                        message: 'Hipótesis diagnóstica inválida',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 150,
                                message: 'La hipótesis diagnóstica debe contener al menos 15 caracteres y máximo 150'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[equipoUtilizado]': {
                        message: 'Valor en equipo utilizado inválido',
                        validators: {
                            stringLength: {
                                min: 5,
                                max: 100,
                                message: 'El texto en equipo utilizado debe contener al menos 5 caracteres y máximo 100'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[tecnicaUtilizada]': {
                        message: 'Técnica utilizada inválida',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 150,
                                message: 'La técnica utilizada debe contener al menos 15 caracteres y máximo 150'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                        }
                    },
                    '";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[observaciones]': {
                        message: 'Observaciones al registro de examen inválidas',
                        validators: {
                            stringLength: {
                                min: 5,
                                max: 255,
                                message: 'Las observaciones al registro de examen deben contener al menos 5 caracteres y máximo 255'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                            callback: {
                                message: 'Registro de examen sin preinscripción seleccionada',
                                callback: function(value, validator) {
                                    /** begin callback function */
                                    var preinscripcionVal = \$(\"input[id='\" + \$token + \"_idSolicitudEstudio']\").val();
                                    var existsVal = false;
                                    
                                    existsVal = preinscripcionVal ? true : false;
                                    
                                    return existsVal;
                                    /** end callback function */
                                }
                            },
                        }
                    },
                    '";
        // line 86
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[salaRealizado]': {
                        message: 'El valor de la sala de realización no es válido',
                        validators: {
                            stringLength: {
                                min: 1,
                                max: 50,
                                message: 'El valor de la sala de realización debe contener al menos 5 carácteres y máximo 50'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9;,:\\.()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ;,:.()_- )'
                            },
                        }
                    },
                    '";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEstadoProcedimientoRealizado]': {
                        message: 'Estado seleccionado inválido',
                        validators: {
                            notEmpty: {
                                message: 'Estado en que se encuentra el registro de examen es requerido'
                            },
                        }
                    },
                    '";
        // line 108
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[incidencias]': {
                        message: 'Valor en incidencias del registro de examen inválido',
                        validators: {
                            stringLength: {
                                min: 15,
                                max: 255,
                                message: 'Este campo debe contener al menos 15 caracteres y máximo 255'
                            },
                            regexp: {
                                regexp: /^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$/,
                                message: 'El texto ingresado viola la restricción de caracteres permitidos ( a-z, A-Z, üÜ, ñÑ, áéíóú, ÁÉÍÓÚ, 0-9, ¿!¡;,:.?#@()_- )'
                            },
                            callback: {
                                message: 'El campo no es válido',
                                callback: function(value, validator) {
                                    /** begin callback function */
                                    var textVal = validator.getFieldElements('";
        // line 124
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[incidencias]').val();
                                    var optionVal = \$(\"input[name='";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEstadoProcedimientoRealizado]']:checked\").val();
                                    
                                    if ( optionVal >= 6 && optionVal <= 9 ) {
                                        if (textVal != null && textVal.length >= 1) {
                                            return true;
                                        }
                                        else {
                                            return {
                                                valid: false,
                                                message: 'El estado seleccionado requiere descripción, por favor utilice este campo'
                                            };
                                        }
                                    }
                                    else {
                                        return true;
                                    }
                                    /** end callback function */
                                }
                            },
                        }
                    },
                }
            });
            
            /** Validación para estado de procedimiento realizado */
            \$(document).on('ifChanged ifClicked ifChecked', \"input[name='";
        // line 150
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEstadoProcedimientoRealizado]']\", function(event) {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', '";
        // line 151
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[incidencias]');
            });
            \$(document).on('keyup change blur', \"textarea[id='\" + \$token + \"_incidencias']\", function(event) {
                jQuery('#simagd_entity_full_admin_form').formValidation('revalidateField', '";
        // line 154
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqId"), "html", null, true);
        echo "[idEstadoProcedimientoRealizado]');
            });
        });
    </script>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgProcedimientoRealizadoAdmin:prz_bootstrapValidator.js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 321,  778 => 315,  772 => 312,  760 => 307,  755 => 304,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 254,  596 => 231,  578 => 270,  534 => 200,  507 => 184,  447 => 190,  445 => 175,  419 => 198,  454 => 160,  371 => 168,  651 => 437,  483 => 333,  404 => 193,  517 => 291,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 193,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 204,  401 => 144,  369 => 129,  356 => 212,  340 => 156,  874 => 781,  854 => 325,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 318,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 309,  763 => 308,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 303,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 436,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 205,  520 => 355,  450 => 173,  408 => 161,  363 => 216,  359 => 182,  348 => 156,  345 => 124,  336 => 192,  316 => 144,  307 => 124,  261 => 85,  266 => 83,  542 => 218,  538 => 217,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 272,  473 => 165,  414 => 158,  406 => 194,  280 => 126,  223 => 130,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 176,  485 => 175,  478 => 165,  475 => 164,  471 => 211,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 177,  291 => 165,  286 => 140,  392 => 150,  332 => 164,  318 => 156,  276 => 160,  190 => 95,  12 => 36,  195 => 74,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 357,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 348,  894 => 383,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 389,  730 => 219,  727 => 218,  712 => 214,  709 => 296,  706 => 295,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 251,  632 => 186,  626 => 260,  623 => 183,  616 => 249,  613 => 232,  610 => 407,  608 => 197,  605 => 196,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 224,  533 => 203,  530 => 150,  513 => 79,  496 => 280,  441 => 150,  438 => 206,  432 => 204,  428 => 203,  422 => 150,  416 => 173,  395 => 118,  391 => 109,  382 => 195,  372 => 89,  364 => 166,  353 => 96,  335 => 154,  333 => 151,  297 => 169,  292 => 134,  205 => 100,  200 => 151,  184 => 121,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 300,  946 => 296,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 320,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 313,  754 => 208,  748 => 205,  745 => 392,  742 => 391,  737 => 199,  735 => 220,  732 => 197,  728 => 344,  726 => 341,  723 => 340,  719 => 215,  717 => 186,  714 => 185,  704 => 294,  701 => 180,  699 => 179,  696 => 291,  690 => 285,  687 => 173,  681 => 205,  673 => 281,  671 => 280,  668 => 279,  663 => 277,  658 => 271,  654 => 155,  649 => 153,  643 => 250,  640 => 249,  636 => 145,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 226,  587 => 388,  584 => 320,  576 => 230,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 361,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 352,  502 => 87,  477 => 82,  472 => 132,  465 => 209,  463 => 208,  446 => 244,  443 => 142,  429 => 219,  425 => 202,  410 => 167,  397 => 161,  394 => 54,  389 => 128,  357 => 186,  342 => 154,  334 => 171,  330 => 150,  328 => 142,  290 => 167,  287 => 163,  263 => 115,  255 => 122,  245 => 119,  194 => 73,  76 => 39,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 373,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 296,  888 => 270,  882 => 333,  873 => 267,  868 => 282,  864 => 372,  860 => 327,  856 => 279,  852 => 324,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 347,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 525,  606 => 209,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 190,  580 => 387,  572 => 218,  568 => 227,  562 => 313,  556 => 212,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 183,  492 => 341,  481 => 218,  476 => 271,  467 => 156,  451 => 159,  424 => 115,  418 => 227,  412 => 147,  399 => 64,  396 => 188,  390 => 139,  388 => 153,  383 => 135,  377 => 104,  373 => 46,  370 => 147,  367 => 167,  352 => 157,  349 => 161,  346 => 155,  329 => 111,  326 => 148,  313 => 136,  303 => 132,  300 => 124,  234 => 88,  218 => 88,  207 => 80,  178 => 99,  321 => 119,  295 => 130,  274 => 157,  242 => 93,  236 => 136,  692 => 175,  683 => 170,  678 => 204,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 150,  641 => 368,  635 => 268,  631 => 364,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 224,  579 => 236,  577 => 318,  575 => 252,  569 => 233,  565 => 314,  548 => 207,  540 => 202,  536 => 358,  529 => 213,  524 => 196,  516 => 143,  510 => 185,  504 => 183,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 162,  452 => 145,  434 => 205,  421 => 114,  417 => 159,  385 => 196,  361 => 165,  344 => 157,  339 => 167,  324 => 123,  310 => 113,  302 => 145,  296 => 136,  282 => 106,  259 => 81,  244 => 116,  231 => 117,  226 => 131,  114 => 46,  104 => 41,  288 => 141,  284 => 162,  279 => 129,  275 => 99,  256 => 147,  250 => 95,  237 => 71,  232 => 96,  222 => 57,  215 => 130,  191 => 115,  153 => 86,  563 => 223,  560 => 222,  558 => 186,  555 => 185,  553 => 211,  549 => 206,  543 => 179,  537 => 306,  532 => 199,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 207,  455 => 203,  449 => 247,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 170,  420 => 123,  415 => 197,  411 => 120,  405 => 118,  403 => 160,  400 => 162,  380 => 107,  366 => 146,  354 => 185,  331 => 133,  325 => 119,  320 => 92,  317 => 138,  311 => 181,  308 => 151,  304 => 140,  272 => 127,  267 => 116,  249 => 143,  216 => 55,  155 => 63,  152 => 61,  146 => 55,  126 => 43,  181 => 83,  161 => 65,  110 => 66,  188 => 73,  186 => 108,  170 => 98,  150 => 57,  124 => 56,  358 => 164,  351 => 183,  347 => 206,  343 => 146,  338 => 144,  327 => 121,  323 => 114,  319 => 145,  315 => 183,  301 => 139,  299 => 131,  293 => 135,  289 => 127,  281 => 125,  277 => 128,  271 => 94,  265 => 125,  262 => 92,  260 => 119,  257 => 123,  251 => 143,  248 => 71,  239 => 100,  228 => 110,  225 => 92,  213 => 107,  211 => 124,  197 => 110,  174 => 68,  148 => 63,  134 => 100,  127 => 45,  20 => 2,  53 => 31,  270 => 117,  253 => 108,  233 => 133,  212 => 103,  210 => 116,  206 => 154,  202 => 99,  198 => 75,  192 => 102,  185 => 72,  180 => 109,  175 => 98,  172 => 96,  167 => 156,  165 => 64,  160 => 67,  137 => 79,  113 => 38,  100 => 40,  90 => 48,  81 => 31,  129 => 58,  84 => 31,  77 => 34,  34 => 8,  118 => 40,  97 => 39,  70 => 45,  65 => 23,  58 => 25,  23 => 3,  480 => 134,  474 => 213,  469 => 150,  461 => 157,  457 => 161,  453 => 194,  444 => 210,  440 => 172,  437 => 171,  435 => 167,  430 => 172,  427 => 171,  423 => 169,  413 => 196,  409 => 195,  407 => 238,  402 => 65,  398 => 157,  393 => 156,  387 => 182,  384 => 152,  381 => 150,  379 => 194,  374 => 192,  368 => 190,  365 => 165,  362 => 164,  360 => 163,  355 => 161,  341 => 123,  337 => 155,  322 => 146,  314 => 136,  312 => 125,  309 => 135,  305 => 134,  298 => 143,  294 => 145,  285 => 126,  283 => 130,  278 => 110,  268 => 126,  264 => 104,  258 => 147,  252 => 121,  247 => 109,  241 => 74,  229 => 102,  220 => 124,  214 => 86,  177 => 99,  169 => 69,  140 => 63,  132 => 53,  128 => 44,  107 => 46,  61 => 22,  273 => 130,  269 => 127,  254 => 122,  243 => 137,  240 => 118,  238 => 117,  235 => 116,  230 => 111,  227 => 130,  224 => 108,  221 => 107,  219 => 129,  217 => 87,  208 => 101,  204 => 116,  179 => 71,  159 => 91,  143 => 81,  135 => 46,  119 => 66,  102 => 60,  71 => 33,  67 => 24,  63 => 25,  59 => 32,  38 => 15,  94 => 38,  89 => 34,  85 => 50,  75 => 24,  68 => 25,  56 => 19,  201 => 76,  196 => 150,  183 => 67,  171 => 67,  166 => 68,  163 => 66,  158 => 64,  156 => 86,  151 => 64,  142 => 70,  138 => 78,  136 => 60,  121 => 55,  117 => 86,  105 => 62,  91 => 40,  62 => 36,  49 => 20,  28 => 5,  26 => 7,  87 => 59,  31 => 5,  25 => 10,  21 => 1,  24 => 7,  19 => 2,  93 => 37,  88 => 39,  78 => 46,  46 => 19,  44 => 11,  27 => 8,  79 => 30,  72 => 26,  69 => 25,  47 => 14,  40 => 18,  37 => 9,  22 => 3,  246 => 104,  157 => 66,  145 => 108,  139 => 61,  131 => 59,  123 => 42,  120 => 48,  115 => 64,  111 => 37,  108 => 42,  101 => 60,  98 => 53,  96 => 43,  83 => 32,  74 => 28,  66 => 32,  55 => 19,  52 => 18,  50 => 26,  43 => 11,  41 => 11,  35 => 14,  32 => 13,  29 => 4,  209 => 81,  203 => 96,  199 => 120,  193 => 116,  189 => 70,  187 => 94,  182 => 92,  176 => 70,  173 => 69,  168 => 125,  164 => 124,  162 => 63,  154 => 65,  149 => 58,  147 => 74,  144 => 80,  141 => 83,  133 => 75,  130 => 46,  125 => 44,  122 => 43,  116 => 52,  112 => 66,  109 => 40,  106 => 58,  103 => 56,  99 => 44,  95 => 56,  92 => 51,  86 => 33,  82 => 37,  80 => 30,  73 => 42,  64 => 23,  60 => 40,  57 => 18,  54 => 17,  51 => 11,  48 => 26,  45 => 8,  42 => 14,  39 => 8,  36 => 17,  33 => 6,  30 => 6,);
    }
}
