<?php

/* MinsalSimagdBundle:show_container_fullEntity:notdiag_total_info_modal_v2.html.twig */
class __TwigTemplate_52ec62e9651a936f5bddcd1119b96d67fc4ab4117a32ff023c2b3d62cbc2449e extends Twig_Template
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
    <div id=\"contenidoFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Nota al Diagnóstico radiológico</h4>
            </div>

            <div class=\"modal-body\">

\t\t<div ";
        // line 12
        echo ">
                
                ";
        // line 19
        echo "\t\t
\t\t    <div class=\"row outer simagd-filter-content-layout\" style=\"padding-left: 15px; padding-right: 15px; ";
        // line 20
        echo "\">
                
                        <table class=\"table table-condensed\">
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Contenido:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"contenido\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Emitió:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Usuario que registró:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserReg\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creada en:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstablecimiento\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de nota:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoNotaDiagnostico\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Se creó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaEmision\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"observaciones\"></td>
                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button class='btn btn-element-v2' data-toggle='modal' href='#notdiagRecord-ShowModal' id='btn-notdiag-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:notdiag_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  35 => 19,  31 => 12,  217 => 138,  207 => 128,  190 => 113,  174 => 98,  164 => 81,  153 => 79,  149 => 78,  142 => 73,  138 => 71,  117 => 62,  111 => 61,  103 => 59,  91 => 57,  86 => 56,  22 => 4,  19 => 2,  1261 => 745,  1258 => 744,  1255 => 743,  1253 => 738,  1250 => 736,  1247 => 728,  1244 => 727,  1240 => 726,  1237 => 725,  1234 => 724,  1230 => 723,  1227 => 722,  1224 => 721,  1220 => 720,  1218 => 719,  1215 => 718,  1212 => 717,  1204 => 715,  1201 => 714,  1198 => 713,  1190 => 711,  1188 => 710,  1185 => 709,  1182 => 708,  1174 => 706,  1172 => 705,  1168 => 703,  1165 => 702,  1157 => 700,  1155 => 699,  1151 => 697,  1148 => 696,  1140 => 694,  1138 => 693,  1134 => 691,  1131 => 690,  1129 => 689,  1122 => 688,  1117 => 685,  1102 => 673,  1095 => 670,  1089 => 667,  1081 => 662,  1077 => 660,  1071 => 657,  1069 => 656,  1066 => 655,  1064 => 654,  1061 => 653,  1038 => 632,  1032 => 627,  1029 => 624,  1012 => 610,  1008 => 608,  1001 => 607,  998 => 606,  996 => 605,  993 => 604,  969 => 582,  963 => 577,  960 => 574,  947 => 564,  940 => 560,  935 => 557,  920 => 545,  913 => 542,  907 => 539,  899 => 534,  895 => 532,  889 => 529,  887 => 528,  884 => 527,  882 => 526,  879 => 525,  858 => 506,  852 => 501,  849 => 498,  832 => 484,  828 => 482,  821 => 481,  818 => 480,  816 => 479,  813 => 478,  791 => 458,  785 => 453,  782 => 450,  769 => 440,  762 => 436,  757 => 433,  742 => 421,  735 => 418,  729 => 415,  721 => 410,  717 => 408,  711 => 405,  709 => 404,  706 => 403,  704 => 402,  701 => 401,  672 => 374,  666 => 369,  663 => 366,  646 => 352,  642 => 350,  635 => 349,  632 => 348,  630 => 347,  627 => 346,  624 => 345,  622 => 344,  598 => 322,  592 => 317,  589 => 314,  572 => 300,  568 => 298,  561 => 297,  558 => 296,  556 => 295,  553 => 294,  527 => 270,  524 => 269,  518 => 264,  516 => 262,  513 => 259,  500 => 249,  493 => 245,  489 => 243,  482 => 242,  479 => 241,  477 => 240,  471 => 238,  469 => 237,  466 => 234,  446 => 219,  439 => 217,  429 => 212,  422 => 210,  413 => 206,  406 => 204,  396 => 199,  389 => 197,  380 => 193,  373 => 191,  368 => 188,  365 => 187,  357 => 181,  350 => 176,  347 => 175,  334 => 167,  327 => 165,  317 => 160,  310 => 158,  300 => 153,  293 => 151,  288 => 148,  285 => 147,  280 => 144,  277 => 143,  272 => 140,  269 => 139,  266 => 138,  264 => 137,  258 => 135,  255 => 134,  248 => 130,  244 => 129,  239 => 128,  233 => 125,  229 => 123,  224 => 122,  218 => 119,  214 => 117,  209 => 116,  203 => 113,  198 => 111,  193 => 109,  187 => 106,  182 => 103,  178 => 102,  173 => 101,  137 => 71,  129 => 64,  121 => 69,  101 => 53,  98 => 52,  90 => 48,  84 => 45,  81 => 55,  76 => 54,  74 => 41,  72 => 40,  70 => 50,  68 => 34,  66 => 48,  64 => 32,  62 => 29,  60 => 26,  58 => 25,  56 => 24,  54 => 21,  52 => 20,  50 => 19,  48 => 18,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
