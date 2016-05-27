<?php

/* MinsalSimagdBundle:show_container_fullEntity:soldiag_total_info_modal_v2.html.twig */
class __TwigTemplate_9b4d3c4fd44a12a1d85017df929369bfc2bbd977b6cf6e41ce8c4e6adf7bed7c extends Twig_Template
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
    <div id=\"solicitudDiagnosticoFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Solicitud de diagnóstico radiológico</h4>
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
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Solicitante:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creada:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaCreacion\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Justificación:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"justificacion\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Usuario que registró:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserReg\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Próxima consulta médica:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaProximaConsulta\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Solicitado a externo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"solicitudRemota\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"observaciones\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Solicitado a:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstablecimientoSolicitado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estudio a interpretar:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstudio\"></td>
                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button class='btn btn-element-v2' data-toggle='modal' href='#soldiagRecord-ShowModal' id='btn-soldiag-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:soldiag_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  35 => 19,  31 => 12,  158 => 97,  148 => 87,  139 => 80,  130 => 65,  112 => 62,  104 => 60,  92 => 58,  87 => 57,  82 => 56,  77 => 55,  71 => 51,  67 => 49,  22 => 4,  19 => 2,  787 => 404,  784 => 403,  776 => 401,  774 => 400,  770 => 398,  767 => 397,  763 => 396,  761 => 395,  758 => 394,  755 => 393,  751 => 392,  748 => 391,  745 => 390,  741 => 389,  738 => 388,  735 => 387,  733 => 386,  725 => 385,  722 => 384,  719 => 383,  717 => 382,  709 => 381,  706 => 380,  703 => 379,  699 => 378,  697 => 377,  694 => 376,  691 => 375,  683 => 373,  681 => 372,  678 => 371,  663 => 361,  648 => 348,  642 => 343,  639 => 340,  636 => 339,  620 => 325,  616 => 323,  609 => 322,  606 => 321,  604 => 320,  601 => 319,  579 => 299,  573 => 294,  570 => 291,  567 => 290,  551 => 276,  547 => 274,  540 => 273,  537 => 272,  535 => 271,  532 => 270,  515 => 258,  505 => 250,  497 => 243,  494 => 240,  491 => 239,  477 => 229,  470 => 225,  465 => 222,  449 => 210,  437 => 203,  425 => 195,  418 => 192,  412 => 189,  404 => 184,  400 => 182,  394 => 179,  392 => 178,  389 => 177,  387 => 176,  384 => 175,  381 => 173,  377 => 169,  374 => 168,  369 => 165,  355 => 156,  349 => 155,  339 => 147,  331 => 141,  328 => 140,  315 => 132,  308 => 130,  298 => 125,  291 => 123,  281 => 118,  274 => 116,  269 => 113,  266 => 112,  261 => 109,  258 => 108,  254 => 105,  248 => 103,  245 => 102,  237 => 98,  232 => 96,  228 => 94,  223 => 93,  217 => 90,  215 => 89,  210 => 86,  205 => 85,  200 => 82,  196 => 81,  191 => 80,  183 => 74,  170 => 63,  156 => 61,  149 => 60,  145 => 59,  134 => 55,  126 => 54,  118 => 63,  110 => 52,  102 => 51,  79 => 32,  76 => 31,  68 => 27,  62 => 24,  59 => 23,  54 => 21,  52 => 20,  50 => 19,  48 => 18,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
