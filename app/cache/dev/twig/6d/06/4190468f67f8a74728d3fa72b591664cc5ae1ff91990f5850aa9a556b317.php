<?php

/* MinsalSimagdBundle:show_container_fullEntity:lct_total_info_modal_v2.html.twig */
class __TwigTemplate_6d064190468f67f8a74728d3fa72b591664cc5ae1ff91990f5850aa9a556b317 extends Twig_Template
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
    <div id=\"lecturaFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Lectura radiológica resultante</h4>
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
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Interpretó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Número correlativo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"correlativo\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Se dió lectura:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaLectura\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Usuario que interpretó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserReg\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de resultado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoResultado\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estudio leido en:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstablecimiento\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Indicaciones para transcripción:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"indicaciones\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Solicitud de externo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"lecturaRemota\"></td>
                                <th ";
        // line 50
        echo " class=\"col-md-2\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
                                <td ";
        // line 51
        echo " class=\"col-md-4\" data-render-info=\"observaciones\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstadoLectura\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Lectura solicitada por radiólogo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"solicitadaPorRadiologo\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Validará resultados:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idRadiologoDesignadoAprobacion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Radiólogo solicitante:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idRadiologoSolicita\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-film\"></i> Estudios que componen lectura:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"estudiosLectura\"></td> ";
        // line 68
        echo "                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button class='btn btn-element-v2' data-toggle='modal' href='#lctRecord-ShowModal' id='btn-lct-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:lct_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  91 => 68,  70 => 50,  35 => 19,  31 => 12,  310 => 210,  300 => 200,  282 => 180,  264 => 150,  257 => 148,  245 => 146,  240 => 145,  235 => 144,  231 => 143,  214 => 128,  196 => 111,  178 => 94,  167 => 84,  156 => 82,  152 => 81,  145 => 76,  141 => 74,  132 => 67,  120 => 65,  114 => 64,  106 => 62,  94 => 60,  89 => 59,  84 => 58,  79 => 57,  73 => 51,  54 => 28,  47 => 22,  41 => 17,  22 => 4,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  627 => 335,  624 => 334,  616 => 332,  614 => 331,  610 => 329,  607 => 328,  599 => 326,  597 => 325,  593 => 323,  590 => 322,  587 => 321,  584 => 320,  580 => 319,  577 => 318,  574 => 317,  570 => 316,  568 => 315,  565 => 314,  562 => 313,  554 => 311,  552 => 310,  549 => 309,  546 => 308,  544 => 307,  537 => 306,  532 => 303,  517 => 291,  510 => 288,  504 => 285,  496 => 280,  492 => 278,  486 => 275,  484 => 274,  481 => 273,  479 => 272,  476 => 271,  455 => 252,  449 => 247,  446 => 244,  429 => 230,  425 => 228,  418 => 227,  415 => 226,  413 => 225,  410 => 224,  388 => 204,  382 => 199,  379 => 196,  366 => 186,  359 => 182,  354 => 179,  339 => 167,  332 => 164,  326 => 161,  318 => 156,  314 => 154,  308 => 151,  306 => 150,  303 => 149,  301 => 148,  298 => 147,  294 => 145,  291 => 193,  273 => 165,  265 => 129,  262 => 128,  254 => 122,  247 => 117,  244 => 116,  233 => 110,  226 => 108,  217 => 104,  209 => 102,  206 => 101,  201 => 98,  198 => 97,  193 => 94,  190 => 93,  188 => 92,  182 => 90,  179 => 89,  172 => 85,  168 => 84,  163 => 83,  158 => 81,  154 => 79,  149 => 78,  143 => 75,  138 => 72,  134 => 71,  129 => 70,  97 => 44,  88 => 42,  69 => 51,  66 => 26,  58 => 22,  52 => 19,  49 => 24,  44 => 20,  42 => 27,  40 => 14,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
