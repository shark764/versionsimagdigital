<?php

/* MinsalSimagdBundle:show_container_fullEntity:prz_total_info_modal_v2.html.twig */
class __TwigTemplate_aab93d0d5dcf86ba52a54f41f3032cff7f3f84802952a22af2284c7d0aa655b7 extends Twig_Template
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
    <div id=\"procedimientoRealizadoFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Examen realizado</h4>
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
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-external-link\"></i> Origen de la solicitud:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"origenSolicitud\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Posee cita:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idCitaProgramada\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tecnólogo programado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTecnologoProgramado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Realizado por:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTecnologoRealiza\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Técnica empleada:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"tecnicaUtilizada\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Usuario que registró:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserReg\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Hipótesis diagnóstica:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"hipotesisDiagnostica\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Último usuario que editó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserMod\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Incidencias:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"incidencias\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Equipo utilizado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"equipoUtilizado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Sin fecha de nacimiento:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaNacimientoIndeterminada\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Realizado en sala:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"salaRealizado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"observaciones\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstadoProcedimientoRealizado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Registrado en RIS:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaRegistro\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Atendido:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaAtendido\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Realizado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaRealizado\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Procesado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaProcesado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Almacenado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaAlmacenado\"></td>
                            </tr>
                            
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-film\"></i> Estudio realizado al paciente:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"estudioRealizado\">
                                    <div id=\"div-estudio-registrado-pacs\" style=\"display: none;\">
                                        <table class=\"table table-condensed\">
                                            <tr>
                                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Registrado en PACS:</span></th>
                                                <td class=\"col-md-4\" data-render-info=\"fechaEstudio\"></td>
                                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Uid:</span></th>
                                                <td class=\"col-md-4\" data-render-info=\"estudioUid\"></td>
                                            </tr>
                                            <tr>
                                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Servidor:</span></th>
                                                <td class=\"col-md-4\" data-render-info=\"servidor\"></td>
                                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Series:</span></th>
                                                <td class=\"col-md-4\" data-render-info=\"seriesUid\"></td>
                                            </tr>
                                            <tr>
                                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creado en:</span></th>
                                                <td colspan=\"3\" class=\"col-md-4\" data-render-info=\"idEstablecimiento\"></td>
                                            </tr>
                                            <tr>
                                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Enlace al estudio:</span></th>
                                                <td class=\"col-md-4\" data-render-info=\"url\"></td>
                                            </tr>
                                        </table>
\t\t\t\t    </div>
\t\t\t\t    <div id=\"div-prz-sin-estudio\" class=\"alert alert-info alert-dismissible\" role=\"alert\" style=\"display: none;\">
\t\t\t\t        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
\t\t\t\t            <span aria-hidden=\"true\">&times;</span>
\t\t\t\t            <span class=\"sr-only\"> Cerrar </span>
\t\t\t\t        </button>
\t\t\t\t        <strong>Sin resultados!</strong> Estudio aun no ha sido registrado en el sistema.
\t\t\t\t    </div>
\t\t\t\t</td>
\t\t\t    </tr>
                            
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Materiales utilizados:</span></th>
                                <td colspan=\"3\" class=\"col-md-10\" data-render-info=\"materialUtilizadoV2\"></td>
                            </tr>
                            
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button class='btn btn-element-v2' data-toggle='modal' href='#przRecord-ShowModal' id='btn-prz-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:prz_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  38 => 20,  19 => 2,  643 => 359,  640 => 358,  636 => 357,  634 => 356,  631 => 355,  628 => 354,  626 => 353,  618 => 352,  616 => 351,  613 => 350,  610 => 349,  606 => 348,  604 => 347,  601 => 346,  582 => 329,  576 => 324,  573 => 321,  556 => 307,  552 => 305,  545 => 304,  542 => 303,  540 => 302,  537 => 301,  517 => 283,  511 => 278,  508 => 275,  495 => 265,  488 => 261,  483 => 258,  474 => 253,  459 => 243,  447 => 236,  434 => 228,  421 => 219,  414 => 216,  408 => 213,  400 => 208,  396 => 206,  390 => 203,  388 => 202,  385 => 201,  383 => 200,  380 => 199,  359 => 180,  353 => 175,  350 => 172,  337 => 162,  330 => 158,  326 => 156,  319 => 155,  316 => 154,  314 => 153,  311 => 152,  306 => 146,  303 => 145,  290 => 137,  283 => 135,  274 => 131,  267 => 129,  257 => 124,  250 => 122,  240 => 117,  232 => 115,  223 => 110,  216 => 108,  211 => 105,  208 => 104,  200 => 98,  193 => 93,  190 => 92,  179 => 86,  171 => 84,  168 => 83,  163 => 80,  160 => 79,  152 => 75,  147 => 73,  141 => 70,  133 => 64,  123 => 56,  112 => 51,  104 => 50,  95 => 48,  76 => 33,  73 => 32,  65 => 28,  62 => 27,  57 => 25,  55 => 24,  53 => 23,  51 => 22,  49 => 19,  47 => 18,  45 => 17,  43 => 14,  41 => 13,  39 => 12,  37 => 9,  35 => 19,  33 => 7,  31 => 12,);
    }
}
