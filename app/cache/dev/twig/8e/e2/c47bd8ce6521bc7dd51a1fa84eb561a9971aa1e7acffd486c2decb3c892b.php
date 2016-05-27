<?php

/* MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_list_v2.html.twig */
class __TwigTemplate_8ee2c47bd8ce6521bc7dd51a1fa84eb561a9971aa1e7acffd486c2decb3c892b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MinsalSimagdBundle::simagd_layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MinsalSimagdBundle::simagd_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    
    ";
        // line 9
        echo "    ";
        // line 11
        echo "    
    ";
        // line 13
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/typeahead.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 16
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/bootstrap-table.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />

";
    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        // line 21
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    
    ";
        // line 24
        echo "    ";
        // line 25
        echo "
    ";
        // line 27
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/jquery.formparams.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 30
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/typeahead.js-master/dist/typeahead.bundle.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/typeahead.js-master/dist/bloodhound.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 34
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/bootstrap-table.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/locale/bootstrap-table-es-CR.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-table-master/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"), "html", null, true);
        echo "\" ></script>

    <script type=\"text/javascript\" src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/ImgSolicitudDiagnosticoAdmin/soldiag_list_v2.js"), "html", null, true);
        echo "\" ></script>

";
    }

    // line 42
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 44
        echo "<table class=\"table table-condensed\" id=\"table-lista-solicitudes-diagnostico\"
           data-toggle=\"table\"
           data-url=\"";
        // line 46
        echo $this->env->getExtension('routing')->getPath("simagd_solicitud_diagnostico_listarSolicitudesDiagnostico");
        echo "\"
           data-cache=\"false\"
           data-show-refresh=\"true\"
           data-show-toggle=\"true\"
           data-show-columns=\"true\"
           data-search=\"true\"
           data-select-item-name=\"listaSolicitudesDiagnosticoToolbar\"
           data-pagination=\"true\"
           data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 54
        echo "]\"
           ";
        // line 57
        echo "           data-classes=\"table table-hover table-condensed table-no-bordered\"
           data-filter-control=\"true\"
           data-height=\"760\">
        <thead>
            <tr style=\"background-color: #31708f; color: #fff;\">
                ";
        // line 63
        echo "                <th data-field=\"id\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
                <th data-field=\"origen\" data-filter-control=\"select\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
                <th data-field=\"paciente\" data-filter-control=\"select\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
                <th data-field=\"solicitante\" data-filter-control=\"select\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
                <th data-field=\"areaAtencion\" data-filter-control=\"select\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
                <th data-field=\"atencion\" data-filter-control=\"select\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
                <th data-field=\"modalidad\" data-filter-control=\"select\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
                <th data-field=\"referido\" data-filter-control=\"select\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizado en</th>
                <th data-field=\"tecnologo\" data-filter-control=\"select\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
                <th data-field=\"fechaSolDiag\" data-filter-control=\"input\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se solicitó</th>
                <th data-field=\"fechaEstudio\" data-filter-control=\"input\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se registró estudio</th>
                <th data-field=\"fechaSolEstudio\" data-filter-control=\"input\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se solicitó estudio</th>
                <th data-field=\"solicitado\" data-filter-control=\"select\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitado a</th>
                <th data-field=\"remota\" data-filter-control=\"select\" data-formatter=\"remotaFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">A externo</th>
                <th data-field=\"action\" data-formatter=\"actionFormatter\" data-events=\"actionEvents\" class=\"col-md-1\"></th>
            </tr>
        </thead>
    </table>
    
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgSolicitudDiagnosticoAdmin:soldiag_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  489 => 228,  907 => 387,  846 => 364,  818 => 355,  810 => 351,  807 => 350,  783 => 338,  765 => 336,  757 => 332,  749 => 327,  686 => 290,  667 => 281,  1260 => 744,  1257 => 743,  1254 => 742,  1252 => 737,  1249 => 735,  1246 => 727,  1243 => 726,  1239 => 725,  1236 => 724,  1233 => 723,  1229 => 722,  1226 => 721,  1223 => 720,  1219 => 719,  1217 => 718,  1214 => 717,  1211 => 716,  1203 => 714,  1189 => 710,  1187 => 709,  1184 => 708,  1181 => 707,  1173 => 705,  1171 => 704,  1167 => 702,  1164 => 701,  1156 => 699,  1150 => 696,  1147 => 695,  1139 => 693,  1137 => 692,  1133 => 690,  1130 => 689,  1128 => 688,  1121 => 687,  1116 => 684,  1101 => 672,  1094 => 669,  1088 => 666,  1076 => 659,  1070 => 656,  1065 => 654,  1063 => 653,  1028 => 623,  1011 => 609,  1000 => 606,  997 => 605,  968 => 581,  886 => 527,  883 => 526,  878 => 376,  857 => 369,  790 => 457,  781 => 337,  720 => 409,  716 => 407,  710 => 404,  611 => 304,  512 => 258,  466 => 245,  557 => 295,  964 => 421,  956 => 420,  941 => 416,  938 => 415,  934 => 556,  926 => 411,  920 => 409,  915 => 406,  872 => 393,  870 => 372,  862 => 389,  844 => 385,  834 => 382,  802 => 348,  796 => 344,  768 => 439,  747 => 340,  708 => 403,  698 => 313,  677 => 293,  630 => 310,  787 => 404,  784 => 452,  776 => 401,  494 => 230,  564 => 361,  561 => 235,  456 => 198,  431 => 185,  634 => 348,  628 => 354,  601 => 319,  545 => 304,  350 => 151,  1002 => 387,  999 => 386,  994 => 384,  992 => 603,  988 => 379,  972 => 374,  962 => 576,  955 => 369,  952 => 368,  945 => 362,  932 => 413,  929 => 412,  923 => 353,  917 => 351,  914 => 350,  912 => 541,  901 => 342,  898 => 384,  893 => 338,  863 => 328,  841 => 384,  778 => 315,  772 => 353,  760 => 307,  755 => 393,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 306,  596 => 297,  578 => 288,  534 => 176,  507 => 186,  447 => 194,  445 => 193,  419 => 227,  454 => 160,  371 => 222,  651 => 437,  483 => 180,  404 => 186,  517 => 244,  484 => 200,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 713,  1197 => 712,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 698,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 224,  622 => 204,  531 => 224,  498 => 231,  468 => 236,  458 => 204,  401 => 199,  369 => 165,  356 => 180,  340 => 146,  874 => 781,  854 => 368,  851 => 367,  836 => 361,  831 => 483,  828 => 358,  825 => 357,  820 => 480,  817 => 479,  813 => 349,  799 => 341,  792 => 342,  773 => 327,  766 => 351,  763 => 350,  746 => 326,  740 => 307,  734 => 417,  731 => 314,  729 => 327,  721 => 307,  715 => 303,  700 => 400,  684 => 282,  680 => 280,  674 => 278,  648 => 348,  642 => 343,  639 => 313,  637 => 262,  604 => 254,  588 => 247,  573 => 294,  559 => 187,  547 => 278,  520 => 215,  450 => 195,  408 => 182,  363 => 174,  359 => 164,  348 => 149,  345 => 163,  336 => 171,  316 => 159,  307 => 148,  261 => 116,  266 => 122,  542 => 230,  538 => 228,  527 => 197,  509 => 353,  499 => 248,  493 => 155,  479 => 197,  473 => 165,  414 => 180,  406 => 237,  280 => 117,  223 => 121,  585 => 224,  551 => 356,  546 => 308,  506 => 237,  503 => 193,  488 => 242,  485 => 268,  478 => 218,  475 => 205,  471 => 204,  448 => 192,  386 => 169,  378 => 178,  375 => 177,  306 => 190,  291 => 121,  286 => 128,  392 => 166,  332 => 142,  318 => 153,  276 => 115,  190 => 87,  12 => 36,  195 => 74,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 631,  1031 => 626,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 422,  953 => 842,  950 => 841,  947 => 259,  944 => 417,  940 => 293,  935 => 357,  927 => 285,  922 => 410,  918 => 281,  913 => 279,  909 => 348,  894 => 531,  890 => 381,  887 => 336,  885 => 380,  875 => 374,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 481,  805 => 349,  775 => 354,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 420,  738 => 332,  730 => 219,  727 => 218,  712 => 214,  709 => 303,  706 => 380,  703 => 299,  697 => 377,  694 => 376,  691 => 375,  669 => 289,  665 => 280,  659 => 199,  650 => 272,  646 => 251,  632 => 186,  626 => 345,  623 => 344,  616 => 323,  613 => 257,  610 => 349,  608 => 303,  605 => 253,  602 => 299,  593 => 230,  591 => 316,  571 => 238,  566 => 237,  533 => 226,  530 => 225,  513 => 243,  496 => 280,  441 => 235,  438 => 189,  432 => 204,  428 => 211,  422 => 197,  416 => 192,  395 => 198,  391 => 182,  382 => 195,  372 => 190,  364 => 156,  353 => 175,  335 => 159,  333 => 142,  297 => 132,  292 => 145,  205 => 86,  200 => 97,  184 => 71,  1074 => 338,  1068 => 655,  1066 => 335,  1064 => 334,  1060 => 652,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 607,  995 => 604,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 419,  946 => 563,  939 => 559,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 386,  900 => 385,  897 => 384,  891 => 382,  884 => 397,  881 => 378,  879 => 395,  876 => 394,  869 => 265,  867 => 391,  840 => 299,  837 => 253,  835 => 360,  833 => 360,  830 => 253,  824 => 379,  822 => 378,  815 => 478,  812 => 477,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 340,  779 => 330,  774 => 400,  754 => 330,  748 => 391,  745 => 390,  742 => 391,  737 => 199,  735 => 387,  732 => 197,  728 => 414,  726 => 341,  723 => 326,  719 => 304,  717 => 382,  714 => 322,  704 => 294,  701 => 180,  699 => 298,  696 => 291,  690 => 285,  687 => 173,  681 => 288,  673 => 291,  671 => 282,  668 => 279,  663 => 361,  658 => 271,  654 => 155,  649 => 271,  643 => 359,  640 => 358,  636 => 312,  633 => 264,  629 => 346,  627 => 335,  624 => 334,  620 => 258,  614 => 257,  599 => 252,  594 => 250,  592 => 519,  589 => 295,  587 => 388,  584 => 246,  576 => 324,  574 => 242,  570 => 291,  567 => 297,  554 => 233,  552 => 293,  544 => 230,  541 => 229,  539 => 96,  522 => 223,  519 => 194,  505 => 263,  502 => 184,  477 => 196,  472 => 247,  465 => 201,  463 => 208,  446 => 207,  443 => 200,  429 => 200,  425 => 195,  410 => 190,  397 => 176,  394 => 168,  389 => 177,  357 => 150,  342 => 145,  334 => 139,  330 => 137,  328 => 140,  290 => 130,  287 => 119,  263 => 123,  255 => 101,  245 => 98,  194 => 82,  76 => 54,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 661,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 423,  959 => 573,  942 => 295,  936 => 306,  919 => 544,  916 => 280,  910 => 388,  906 => 538,  902 => 276,  896 => 383,  888 => 381,  882 => 396,  873 => 373,  868 => 371,  864 => 390,  860 => 370,  856 => 279,  852 => 324,  848 => 497,  843 => 257,  838 => 361,  832 => 359,  826 => 357,  823 => 356,  819 => 377,  814 => 352,  811 => 240,  809 => 375,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 366,  785 => 332,  782 => 233,  770 => 398,  767 => 397,  764 => 247,  761 => 334,  758 => 346,  756 => 432,  751 => 328,  739 => 200,  736 => 347,  733 => 315,  725 => 385,  722 => 384,  705 => 301,  688 => 292,  675 => 225,  672 => 203,  662 => 365,  660 => 217,  655 => 275,  638 => 433,  621 => 259,  617 => 258,  612 => 526,  609 => 256,  606 => 321,  603 => 523,  600 => 522,  598 => 251,  595 => 394,  586 => 294,  582 => 290,  580 => 245,  572 => 286,  568 => 241,  562 => 313,  556 => 307,  550 => 231,  535 => 272,  526 => 269,  521 => 171,  515 => 261,  497 => 243,  492 => 229,  481 => 208,  476 => 239,  467 => 221,  451 => 213,  424 => 198,  418 => 183,  412 => 183,  399 => 177,  396 => 167,  390 => 171,  388 => 181,  383 => 200,  377 => 169,  373 => 159,  370 => 164,  367 => 155,  352 => 160,  349 => 148,  346 => 181,  329 => 157,  326 => 136,  313 => 132,  303 => 145,  300 => 208,  234 => 93,  218 => 90,  207 => 80,  178 => 83,  321 => 134,  295 => 122,  274 => 125,  242 => 124,  236 => 96,  692 => 293,  683 => 289,  678 => 287,  676 => 282,  666 => 278,  661 => 279,  656 => 198,  652 => 273,  645 => 269,  641 => 267,  635 => 268,  631 => 347,  625 => 361,  615 => 354,  607 => 404,  597 => 321,  590 => 322,  583 => 246,  579 => 299,  577 => 364,  575 => 287,  569 => 285,  565 => 314,  548 => 207,  540 => 273,  536 => 227,  529 => 174,  524 => 173,  516 => 143,  510 => 218,  504 => 185,  500 => 262,  490 => 211,  486 => 210,  482 => 251,  470 => 237,  464 => 180,  459 => 171,  452 => 209,  434 => 201,  421 => 184,  417 => 250,  385 => 185,  361 => 173,  344 => 157,  339 => 141,  324 => 207,  310 => 148,  302 => 127,  296 => 121,  282 => 112,  259 => 120,  244 => 99,  231 => 94,  226 => 109,  114 => 50,  104 => 47,  288 => 122,  284 => 136,  279 => 143,  275 => 107,  256 => 99,  250 => 107,  237 => 109,  232 => 92,  222 => 90,  215 => 89,  191 => 73,  153 => 59,  563 => 223,  560 => 296,  558 => 234,  555 => 294,  553 => 211,  549 => 355,  543 => 179,  537 => 273,  532 => 270,  528 => 270,  525 => 224,  523 => 268,  518 => 221,  514 => 168,  511 => 242,  508 => 241,  501 => 313,  495 => 260,  491 => 255,  487 => 224,  460 => 243,  455 => 241,  449 => 208,  442 => 210,  439 => 209,  436 => 202,  433 => 186,  426 => 126,  420 => 194,  415 => 182,  411 => 202,  405 => 203,  403 => 117,  400 => 185,  380 => 179,  366 => 152,  354 => 167,  331 => 138,  325 => 94,  320 => 154,  317 => 131,  311 => 127,  308 => 135,  304 => 139,  272 => 124,  267 => 169,  249 => 102,  216 => 84,  155 => 57,  152 => 63,  146 => 71,  126 => 56,  181 => 70,  161 => 75,  110 => 62,  188 => 92,  186 => 72,  170 => 64,  150 => 55,  124 => 65,  358 => 172,  351 => 166,  347 => 150,  343 => 146,  338 => 160,  327 => 140,  323 => 155,  319 => 138,  315 => 152,  301 => 138,  299 => 133,  293 => 120,  289 => 176,  281 => 109,  277 => 116,  271 => 106,  265 => 104,  262 => 134,  260 => 101,  257 => 114,  251 => 115,  248 => 99,  239 => 104,  228 => 107,  225 => 92,  213 => 102,  211 => 88,  197 => 91,  174 => 65,  148 => 57,  134 => 60,  127 => 54,  20 => 2,  53 => 22,  270 => 108,  253 => 134,  233 => 95,  212 => 112,  210 => 86,  206 => 97,  202 => 93,  198 => 84,  192 => 90,  185 => 64,  180 => 75,  175 => 70,  172 => 70,  167 => 67,  165 => 77,  160 => 83,  137 => 63,  113 => 41,  100 => 45,  90 => 29,  81 => 26,  129 => 58,  84 => 58,  77 => 25,  34 => 5,  118 => 43,  97 => 36,  70 => 26,  65 => 18,  58 => 20,  23 => 4,  480 => 301,  474 => 195,  469 => 150,  461 => 200,  457 => 199,  453 => 169,  444 => 236,  440 => 203,  437 => 187,  435 => 188,  430 => 172,  427 => 199,  423 => 206,  413 => 191,  409 => 195,  407 => 171,  402 => 179,  398 => 184,  393 => 183,  387 => 176,  384 => 164,  381 => 165,  379 => 162,  374 => 161,  368 => 175,  365 => 154,  362 => 141,  360 => 219,  355 => 155,  341 => 161,  337 => 144,  322 => 135,  314 => 149,  312 => 151,  309 => 126,  305 => 134,  298 => 146,  294 => 131,  285 => 119,  283 => 118,  278 => 108,  268 => 127,  264 => 111,  258 => 138,  252 => 103,  247 => 105,  241 => 98,  229 => 110,  220 => 81,  214 => 99,  177 => 74,  169 => 60,  140 => 67,  132 => 51,  128 => 56,  107 => 36,  61 => 21,  273 => 141,  269 => 123,  254 => 109,  243 => 116,  240 => 102,  238 => 96,  235 => 95,  230 => 94,  227 => 122,  224 => 108,  221 => 103,  219 => 85,  217 => 138,  208 => 110,  204 => 79,  179 => 76,  159 => 80,  143 => 67,  135 => 59,  119 => 63,  102 => 38,  71 => 22,  67 => 24,  63 => 20,  59 => 24,  38 => 15,  94 => 60,  89 => 31,  85 => 31,  75 => 28,  68 => 30,  56 => 17,  201 => 78,  196 => 81,  183 => 83,  171 => 77,  166 => 63,  163 => 81,  158 => 61,  156 => 65,  151 => 65,  142 => 63,  138 => 57,  136 => 56,  121 => 44,  117 => 62,  105 => 35,  91 => 32,  62 => 21,  49 => 17,  28 => 6,  26 => 5,  87 => 32,  31 => 9,  25 => 5,  21 => 6,  24 => 4,  19 => 2,  93 => 35,  88 => 34,  78 => 30,  46 => 19,  44 => 13,  27 => 8,  79 => 57,  72 => 27,  69 => 25,  47 => 14,  40 => 10,  37 => 10,  22 => 3,  246 => 113,  157 => 72,  145 => 60,  139 => 59,  131 => 59,  123 => 47,  120 => 46,  115 => 37,  111 => 42,  108 => 39,  101 => 37,  98 => 35,  96 => 35,  83 => 31,  74 => 23,  66 => 21,  55 => 19,  52 => 16,  50 => 16,  43 => 14,  41 => 11,  35 => 14,  32 => 8,  29 => 8,  209 => 85,  203 => 93,  199 => 82,  193 => 80,  189 => 79,  187 => 78,  182 => 76,  176 => 96,  173 => 72,  168 => 68,  164 => 81,  162 => 62,  154 => 69,  149 => 74,  147 => 72,  144 => 56,  141 => 75,  133 => 69,  130 => 57,  125 => 46,  122 => 56,  116 => 46,  112 => 44,  109 => 42,  106 => 40,  103 => 38,  99 => 33,  95 => 34,  92 => 43,  86 => 29,  82 => 37,  80 => 28,  73 => 27,  64 => 25,  60 => 19,  57 => 23,  54 => 15,  51 => 17,  48 => 21,  45 => 15,  42 => 27,  39 => 9,  36 => 6,  33 => 6,  30 => 5,);
    }
}
