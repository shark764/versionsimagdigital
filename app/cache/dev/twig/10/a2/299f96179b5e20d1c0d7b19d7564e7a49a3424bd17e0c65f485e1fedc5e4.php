<?php

/* MinsalSimagdBundle:show_container_fullEntity:cit_total_info_modal_v2.html.twig */
class __TwigTemplate_10a2299f96179b5e20d1c0d7b19d7564e7a49a3424bd17e0c65f485e1fedc5e4 extends Twig_Template
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
    <div id=\"citaFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Cita programada</h4>
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
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-user\"></i> Programó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-user\"></i> Usuario que programó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserPrg\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-user\"></i> Usuario que reprogramó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserReprg\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creada en:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstablecimiento\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-user-md\"></i> Realizará examen:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTecnologoProgramado\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Creada:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaCreacion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Incidencias:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"incidencias\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Programada para:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaProgramada\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"observaciones\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstadoCita\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-trash\"></i> Justificación de anulación/cancelación:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"razonAnulada\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Confirmada:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaConfirmacion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Necesita autorización de responsable:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"necesitaAutorizacion\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-refresh\"></i> Reprogramada:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"reprogramada\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Autorizada:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"citaAutorizada\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Fecha programada anterior:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaProgramadaAnterior\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Responsable por paciente:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idResponsableAutoriza\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Se reprogramó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaReprogramacion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Responsable que autorizó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"nombreResponsableAutoriza\"></td>
                            </tr>
                            
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Fecha programada:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaHoraInicio\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Fecha programada anterior:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaHoraInicioAnterior\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Finalización programada:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaHoraFin\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Finalización programada anterior:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaHoraFinAnterior\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-arrows-v\"></i> Para día completo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"diaCompleto\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-tint\"></i> Color de evento en agenda:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"color\"></td>
                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button class='btn btn-element-v2' data-toggle='modal' href='#citRecord-ShowModal' id='btn-cit-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:cit_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  94 => 68,  79 => 54,  75 => 53,  73 => 52,  24 => 5,  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 28,  49 => 18,  43 => 15,  35 => 19,  31 => 12,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 119,  278 => 116,  274 => 115,  270 => 114,  265 => 113,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 107,  238 => 104,  233 => 101,  228 => 100,  223 => 97,  218 => 96,  212 => 93,  210 => 92,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 68,  141 => 64,  133 => 63,  114 => 48,  111 => 47,  103 => 43,  98 => 50,  92 => 38,  86 => 35,  81 => 36,  76 => 33,  70 => 28,  64 => 25,  61 => 24,  56 => 21,  54 => 21,  52 => 20,  50 => 19,  48 => 16,  46 => 15,  44 => 14,  42 => 13,  40 => 12,  38 => 20,  36 => 8,  34 => 7,  32 => 6,);
    }
}
