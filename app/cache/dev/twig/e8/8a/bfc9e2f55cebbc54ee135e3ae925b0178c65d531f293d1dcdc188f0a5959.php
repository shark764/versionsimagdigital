<?php

/* MinsalSimagdBundle:ImgCtlMaterialAdmin:mtrl_crearMaterial_modal.html.twig */
class __TwigTemplate_e88abfc9e2f55cebbc54ee135e3ae925b0178c65d531f293d1dcdc188f0a5959 extends Twig_Template
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
        // line 4
        echo "<div id=\"crearMaterial-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-medkit\"></i> <span id=\"formMtrlTitle\">Registrar Material</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formMtrlLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearMaterialForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_material_crearMaterial");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#materialTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-inbox\"></span> Material <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"materialTab\" >

                                    <input type=\"hidden\" id=\"formMtrlId\" name=\"formMtrlId\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label required\">Nombre</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"text\" class=\"form-control\" id=\"formMtrlNombre\" name=\"formMtrlNombre\" placeholder=\"Nombre del material\" maxlength=\"100\"
                                                      ";
        // line 51
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"5\"
                                                      data-fv-stringlength-max=\"100\"
                                                      data-fv-stringlength-message=\"5 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Código</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"text\" class=\"form-control\" id=\"formMtrlCodigo\" name=\"formMtrlCodigo\" placeholder=\"Código del material\" maxlength=\"6\"
                                                      ";
        // line 71
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"2\"
                                                      data-fv-stringlength-max=\"6\"
                                                      data-fv-stringlength-message=\"2 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-Z0-9]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Descripción</label>
                                        <div class=\"col-sm-8\">
                                            <textarea rows=\"4\" class=\"form-control\" name=\"formMtrlDescripcion\" id=\"formMtrlDescripcion\" placeholder=\"Digite una decripción del material utilizable en Imagenología\" style=\"resize: none\"
                                                      ";
        // line 88
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-sm-8 col-sm-offset-4\">
                                            <div class=\"checkbox\">
                                                <label>
                                                    <input type=\"checkbox\" value=\"1\" name=\"formMtrlAgregarEnLocal\" id=\"formMtrlAgregarEnLocal\" /> Agregar en catálogo local
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Inventario disponible</label>
                                        <div class=\"col-sm-8\">
                                            <input type=\"number\" class=\"form-control\" id=\"formMtrlCantidadDisponibleLocal\" name=\"formMtrlCantidadDisponibleLocal\" placeholder=\"Cantidad en Inventario disponible\" value=\"0\" min=\"0\" max=\"2147483647\" data-default=\"0\" readonly=\"readonly\"
                                                      ";
        // line 114
        echo "
                                                      data-fv-integer=\"true\"
                                                      data-fv-integer-message=\"El valor no es un entero\"

                                                      data-fv-greaterthan-inclusive=\"true\"
                                                      data-fv-greaterthan-value=\"0\"
                                                      data-fv-greaterthan-message=\"Debe ser mayor o igual a 0\"

                                                      data-fv-lessthan-inclusive=\"true\"
                                                      data-fv-lessthan-value=\"2147483647\"
                                                      data-fv-lessthan-message=\"Debe ser menor o igual a 2147483647\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-8 col-xs-offset-4\">
                                            <div class=\"checkbox\">
                                                <label>
                                                    <input type=\"checkbox\" value=\"1\" name=\"formMtrlHabilitadoLocal\" id=\"formMtrlHabilitadoLocal\" checked=\"checked\" /> Habilitado en local
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-sm-4 control-label\">Descripción (Para local)</label>
                                        <div class=\"col-sm-8\">
                                            <textarea rows=\"4\" class=\"form-control\" name=\"formMtrlDescripcionLocal\" id=\"formMtrlDescripcionLocal\" placeholder=\"Agregue descripción sobre el material en este establecimiento\" style=\"resize: none\" readonly=\"readonly\"
                                                      ";
        // line 143
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                </div>
\t\t\t    </div>

                            <div class=\"form-group\" style=\"";
        // line 157
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>

\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 167
        echo "\t    </div>

        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_mtrl\" name=\"btn_agregar_mtrl\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_mtrl\" name=\"btn_editar_mtrl\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCtlMaterialAdmin:mtrl_crearMaterial_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 321,  778 => 315,  772 => 312,  760 => 307,  755 => 304,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 254,  596 => 231,  578 => 270,  534 => 200,  507 => 184,  447 => 190,  445 => 175,  419 => 166,  454 => 160,  371 => 155,  651 => 437,  483 => 333,  404 => 257,  517 => 291,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 158,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 204,  401 => 144,  369 => 129,  356 => 142,  340 => 130,  874 => 781,  854 => 325,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 318,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 309,  763 => 308,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 303,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 436,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 205,  520 => 355,  450 => 173,  408 => 161,  363 => 148,  359 => 182,  348 => 129,  345 => 124,  336 => 192,  316 => 116,  307 => 124,  261 => 85,  266 => 83,  542 => 218,  538 => 217,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 272,  473 => 165,  414 => 158,  406 => 152,  280 => 126,  223 => 109,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 176,  485 => 175,  478 => 165,  475 => 164,  471 => 211,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 150,  291 => 121,  286 => 128,  392 => 150,  332 => 164,  318 => 156,  276 => 104,  190 => 167,  12 => 36,  195 => 86,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 357,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 348,  894 => 383,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 389,  730 => 219,  727 => 218,  712 => 214,  709 => 296,  706 => 295,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 251,  632 => 186,  626 => 260,  623 => 183,  616 => 249,  613 => 232,  610 => 407,  608 => 197,  605 => 196,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 224,  533 => 203,  530 => 150,  513 => 79,  496 => 280,  441 => 150,  438 => 149,  432 => 166,  428 => 172,  422 => 150,  416 => 173,  395 => 118,  391 => 109,  382 => 236,  372 => 89,  364 => 137,  353 => 96,  335 => 120,  333 => 127,  297 => 122,  292 => 82,  205 => 96,  200 => 82,  184 => 121,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 300,  946 => 296,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 320,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 313,  754 => 208,  748 => 205,  745 => 392,  742 => 391,  737 => 199,  735 => 220,  732 => 197,  728 => 344,  726 => 341,  723 => 340,  719 => 215,  717 => 186,  714 => 185,  704 => 294,  701 => 180,  699 => 179,  696 => 291,  690 => 285,  687 => 173,  681 => 205,  673 => 281,  671 => 280,  668 => 279,  663 => 277,  658 => 271,  654 => 155,  649 => 153,  643 => 250,  640 => 249,  636 => 145,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 226,  587 => 388,  584 => 320,  576 => 230,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 361,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 352,  502 => 87,  477 => 82,  472 => 132,  465 => 209,  463 => 208,  446 => 244,  443 => 142,  429 => 219,  425 => 228,  410 => 167,  397 => 161,  394 => 54,  389 => 128,  357 => 212,  342 => 137,  334 => 142,  330 => 122,  328 => 125,  290 => 148,  287 => 99,  263 => 104,  255 => 98,  245 => 92,  194 => 73,  76 => 34,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 373,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 296,  888 => 270,  882 => 333,  873 => 267,  868 => 282,  864 => 372,  860 => 327,  856 => 279,  852 => 324,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 347,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 525,  606 => 209,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 190,  580 => 387,  572 => 218,  568 => 227,  562 => 313,  556 => 212,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 183,  492 => 341,  481 => 218,  476 => 271,  467 => 156,  451 => 159,  424 => 115,  418 => 227,  412 => 147,  399 => 64,  396 => 166,  390 => 139,  388 => 153,  383 => 135,  377 => 104,  373 => 46,  370 => 147,  367 => 102,  352 => 141,  349 => 139,  346 => 138,  329 => 111,  326 => 131,  313 => 126,  303 => 132,  300 => 124,  234 => 88,  218 => 109,  207 => 83,  178 => 93,  321 => 119,  295 => 118,  274 => 108,  242 => 93,  236 => 112,  692 => 175,  683 => 170,  678 => 204,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 150,  641 => 368,  635 => 268,  631 => 364,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 224,  579 => 236,  577 => 318,  575 => 252,  569 => 233,  565 => 314,  548 => 207,  540 => 202,  536 => 358,  529 => 213,  524 => 196,  516 => 143,  510 => 185,  504 => 183,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 162,  452 => 145,  434 => 170,  421 => 114,  417 => 159,  385 => 107,  361 => 145,  344 => 94,  339 => 167,  324 => 123,  310 => 113,  302 => 131,  296 => 136,  282 => 106,  259 => 81,  244 => 116,  231 => 117,  226 => 108,  114 => 61,  104 => 58,  288 => 107,  284 => 112,  279 => 111,  275 => 99,  256 => 74,  250 => 95,  237 => 71,  232 => 58,  222 => 57,  215 => 107,  191 => 54,  153 => 74,  563 => 223,  560 => 222,  558 => 186,  555 => 185,  553 => 211,  549 => 206,  543 => 179,  537 => 306,  532 => 199,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 207,  455 => 203,  449 => 247,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 170,  420 => 123,  415 => 226,  411 => 120,  405 => 118,  403 => 160,  400 => 162,  380 => 107,  366 => 146,  354 => 179,  331 => 133,  325 => 119,  320 => 92,  317 => 128,  311 => 168,  308 => 151,  304 => 85,  272 => 98,  267 => 88,  249 => 115,  216 => 55,  155 => 62,  152 => 61,  146 => 63,  126 => 65,  181 => 83,  161 => 75,  110 => 29,  188 => 101,  186 => 51,  170 => 72,  150 => 52,  124 => 64,  358 => 172,  351 => 102,  347 => 140,  343 => 146,  338 => 144,  327 => 121,  323 => 114,  319 => 117,  315 => 82,  301 => 121,  299 => 137,  293 => 135,  289 => 115,  281 => 112,  277 => 95,  271 => 94,  265 => 93,  262 => 92,  260 => 102,  257 => 138,  251 => 72,  248 => 71,  239 => 90,  228 => 103,  225 => 86,  213 => 107,  211 => 86,  197 => 103,  174 => 91,  148 => 71,  134 => 114,  127 => 16,  20 => 2,  53 => 15,  270 => 129,  253 => 100,  233 => 110,  212 => 86,  210 => 63,  206 => 101,  202 => 104,  198 => 75,  192 => 102,  185 => 80,  180 => 157,  175 => 64,  172 => 74,  167 => 156,  165 => 69,  160 => 52,  137 => 68,  113 => 55,  100 => 56,  90 => 31,  81 => 27,  129 => 59,  84 => 29,  77 => 22,  34 => 21,  118 => 46,  97 => 30,  70 => 21,  65 => 16,  58 => 17,  23 => 5,  480 => 134,  474 => 213,  469 => 150,  461 => 157,  457 => 161,  453 => 194,  444 => 151,  440 => 172,  437 => 171,  435 => 167,  430 => 172,  427 => 171,  423 => 169,  413 => 164,  409 => 153,  407 => 238,  402 => 65,  398 => 157,  393 => 156,  387 => 110,  384 => 152,  381 => 150,  379 => 151,  374 => 148,  368 => 154,  365 => 149,  362 => 97,  360 => 147,  355 => 161,  341 => 123,  337 => 136,  322 => 129,  314 => 136,  312 => 125,  309 => 113,  305 => 128,  298 => 128,  294 => 145,  285 => 79,  283 => 127,  278 => 110,  268 => 94,  264 => 104,  258 => 101,  252 => 88,  247 => 95,  241 => 74,  229 => 57,  220 => 88,  214 => 86,  177 => 65,  169 => 55,  140 => 69,  132 => 61,  128 => 49,  107 => 88,  61 => 19,  273 => 130,  269 => 107,  254 => 122,  243 => 76,  240 => 72,  238 => 92,  235 => 120,  230 => 111,  227 => 88,  224 => 60,  221 => 82,  219 => 87,  217 => 87,  208 => 80,  204 => 89,  179 => 70,  159 => 151,  143 => 48,  135 => 42,  119 => 39,  102 => 54,  71 => 19,  67 => 25,  63 => 41,  59 => 7,  38 => 4,  94 => 34,  89 => 71,  85 => 49,  75 => 24,  68 => 51,  56 => 16,  201 => 95,  196 => 84,  183 => 67,  171 => 62,  166 => 54,  163 => 53,  158 => 77,  156 => 75,  151 => 74,  142 => 30,  138 => 47,  136 => 47,  121 => 63,  117 => 45,  105 => 39,  91 => 33,  62 => 19,  49 => 13,  28 => 8,  26 => 7,  87 => 30,  31 => 5,  25 => 10,  21 => 1,  24 => 4,  19 => 2,  93 => 33,  88 => 32,  78 => 46,  46 => 12,  44 => 7,  27 => 5,  79 => 36,  72 => 19,  69 => 43,  47 => 11,  40 => 9,  37 => 5,  22 => 4,  246 => 94,  157 => 58,  145 => 58,  139 => 55,  131 => 45,  123 => 48,  120 => 64,  115 => 12,  111 => 42,  108 => 35,  101 => 38,  98 => 55,  96 => 34,  83 => 29,  74 => 23,  66 => 20,  55 => 38,  52 => 37,  50 => 12,  43 => 25,  41 => 9,  35 => 24,  32 => 21,  29 => 20,  209 => 98,  203 => 96,  199 => 85,  193 => 75,  189 => 70,  187 => 69,  182 => 90,  176 => 79,  173 => 69,  168 => 84,  164 => 143,  162 => 152,  154 => 79,  149 => 51,  147 => 72,  144 => 71,  141 => 49,  133 => 52,  130 => 42,  125 => 46,  122 => 55,  116 => 54,  112 => 45,  109 => 60,  106 => 41,  103 => 32,  99 => 37,  95 => 39,  92 => 44,  86 => 41,  82 => 23,  80 => 28,  73 => 23,  64 => 12,  60 => 40,  57 => 16,  54 => 15,  51 => 11,  48 => 12,  45 => 8,  42 => 27,  39 => 8,  36 => 8,  33 => 3,  30 => 2,);
    }
}
