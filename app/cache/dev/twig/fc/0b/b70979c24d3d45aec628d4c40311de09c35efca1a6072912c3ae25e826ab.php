<?php

/* MinsalSimagdBundle:show_container_fullEntity:diag_total_info_modal_v2.html.twig */
class __TwigTemplate_fc0bb70979c24d3d45aec628d4c40311de09c35efca1a6072912c3ae25e826ab extends Twig_Template
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
    <div id=\"diagnosticoFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Diagnóstico radiológico transcrito</h4>
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
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Hallazgos:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"hallazgos\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Conclusión:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"conclusion\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Recomendaciones:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"recomendaciones\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Errores en transcripción:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"errores\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Transcribió:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Usuario que transcribió:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserReg\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Último usuario que editó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserMod\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstadoDiagnostico\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Incidencias:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"incidencias\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Se transcribió:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaTranscrito\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"observaciones\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Se aprobó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaAprobado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Se corrigió:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaCorregido\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Designado para validación:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idRadiologoDesignadoAprobacion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Aprobación por:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idRadiologoAprueba\"></td>
                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
\t\t<button type=\"submit\" id=\"btn_aprobar_diag\" name=\"btn_aprobar_diag\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"glyphicon glyphicon-ok\"></i> Aprobar</button>
                <button class='btn btn-element-v2' data-toggle='modal' href='#diagRecord-ShowModal' id='btn-diag-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button class='btn btn-primary-v2' ";
        // line 85
        echo " id='btn_diag_show_and_edit' style=\"display: none;\"><i class=\"fa fa-check-square-o\"></i> Editar </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:diag_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  105 => 85,  91 => 68,  70 => 50,  35 => 19,  31 => 12,  310 => 210,  300 => 200,  282 => 180,  264 => 150,  257 => 148,  245 => 146,  240 => 145,  235 => 144,  231 => 143,  214 => 128,  196 => 111,  178 => 94,  167 => 84,  156 => 82,  152 => 81,  145 => 76,  141 => 74,  132 => 67,  120 => 65,  114 => 64,  106 => 62,  94 => 60,  89 => 59,  84 => 58,  79 => 57,  73 => 51,  54 => 28,  47 => 22,  41 => 17,  22 => 4,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  627 => 335,  624 => 334,  616 => 332,  614 => 331,  610 => 329,  607 => 328,  599 => 326,  597 => 325,  593 => 323,  590 => 322,  587 => 321,  584 => 320,  580 => 319,  577 => 318,  574 => 317,  570 => 316,  568 => 315,  565 => 314,  562 => 313,  554 => 311,  552 => 310,  549 => 309,  546 => 308,  544 => 307,  537 => 306,  532 => 303,  517 => 291,  510 => 288,  504 => 285,  496 => 280,  492 => 278,  486 => 275,  484 => 274,  481 => 273,  479 => 272,  476 => 271,  455 => 252,  449 => 247,  446 => 244,  429 => 230,  425 => 228,  418 => 227,  415 => 226,  413 => 225,  410 => 224,  388 => 204,  382 => 199,  379 => 196,  366 => 186,  359 => 182,  354 => 179,  339 => 167,  332 => 164,  326 => 161,  318 => 156,  314 => 154,  308 => 151,  306 => 150,  303 => 149,  301 => 148,  298 => 147,  294 => 145,  291 => 193,  273 => 165,  265 => 129,  262 => 128,  254 => 122,  247 => 117,  244 => 116,  233 => 110,  226 => 108,  217 => 104,  209 => 102,  206 => 101,  201 => 98,  198 => 97,  193 => 94,  190 => 93,  188 => 92,  182 => 90,  179 => 89,  172 => 85,  168 => 84,  163 => 83,  158 => 81,  154 => 79,  149 => 78,  143 => 75,  138 => 72,  134 => 71,  129 => 70,  97 => 44,  88 => 42,  69 => 51,  66 => 26,  58 => 22,  52 => 19,  49 => 24,  44 => 20,  42 => 27,  40 => 14,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
