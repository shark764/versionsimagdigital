<?php

/* MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal_v2.html.twig */
class __TwigTemplate_5a263f477b6dac88419f5d57f08a4cbc5b262c8add752ea4ad323fc71e627df4 extends Twig_Template
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
    <div id=\"preinscripcionFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Solicitud de estudio Imagenológico</h4>
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
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creada en:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstablecimiento\" data-render-text=\"prc_origen\" data-render-method=\"simagdOrigenFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Sala:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"numeroSala\" data-render-text=\"prc_numeroSala\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Proviene de:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idAreaAtencion\" data-render-text=\"prc_areaAtencion\" data-render-method=\"simagdAreaAtencionFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Cama:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"numeroCama\" data-render-text=\"prc_numeroCama\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Servicio que refiere:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idAtencion\" data-render-text=\"prc_atencion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Paciente desconocido:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"pacienteDesconocido\" data-render-text=\"prc_pacienteDesconocido\" data-render-method=\"simagdPacienteDesconocidoFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Solicita:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEmpleado\" data-render-text=\"prc_empleado\" data-render-method=\"simagdEmpleadoUserLoggedFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Peso actual ( lb ):</span></th>
                                <td class=\"col-md-4\" data-render-info=\"pesoActualLb\" data-render-text=\"prc_pesoActualLb\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoEmpleado\" data-render-text=\"prc_tipoEmpleado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Peso actual ( kg ):</span></th>
                                <td class=\"col-md-4\" data-render-info=\"pesoActualKg\" data-render-text=\"prc_pesoActualKg\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Usuario que registró:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserReg\" data-render-text=\"prc_nombreUserReg\" data-render-method=\"simagdEmpleadoUserLoggedFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Talla ( m ):</span></th>
                                <td class=\"col-md-4\" data-render-info=\"tallaPaciente\" data-render-text=\"prc_tallaPaciente\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Último usuario que editó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserMod\" data-render-text=\"prc_nombreUserMod\" data-render-method=\"simagdEmpleadoUserLoggedFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Referido:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"referirPaciente\" data-render-text=\"prc_referirPaciente\" data-render-method=\"simagdPacienteReferidoFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Motivo de consulta:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"consultaPor\" data-render-text=\"prc_consultaPor\" data-render-method=\"simagdDescriptionFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Referido a:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstablecimientoReferido\" data-render-text=\"prc_referido\" data-render-method=\"simagdReferidoFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estado clínico:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"estadoClinico\" data-render-text=\"prc_estadoClinico\" data-render-method=\"simagdDescriptionFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Justificación:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"justificacionReferencia\" data-render-text=\"prc_justificacionReferencia\" data-render-method=\"simagdDescriptionFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Datos clínicos:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"datosClinicos\" data-render-text=\"prc_datosClinicos\" data-render-method=\"simagdDescriptionFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Hipótesis diagnóstica:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"hipotesisDiagnostica\" data-render-text=\"prc_hipotesisDiagnostica\" data-render-method=\"simagdDescriptionFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Próxima consulta médica:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaProximaConsulta\" data-render-text=\"prc_fechaProximaConsulta\" data-render-method=\"simagdDateFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Prioridad requerida:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idPrioridadAtencion\" data-render-text=\"prAtn_nombre\" data-render-method=\"simagdPrioridadAtencionFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Investigando:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"investigando\" data-render-text=\"prc_investigar\" data-render-method=\"simagdDescriptionFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Justificación médica:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"justificacionMedica\" data-render-text=\"prc_justificacionMedica\" data-render-method=\"simagdDescriptionFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Antecedentes clínicos:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"antecedentesClinicosRelevantes\" data-render-text=\"prc_antecedentesClinicosRelevantes\" data-render-method=\"simagdDescriptionAdvanceFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Requiere diagnóstico:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"requiereDiagnostico\" data-render-text=\"prc_requiereDiagnostico\" data-render-method=\"simagdRequiereDiagnosticoFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaCreacion\" data-render-text=\"prc_fechaCreacion\" data-render-method=\"simagdDateTimeFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Diagnosticar en:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstablecimientoDiagnosticante\" data-render-text=\"prc_diagnosticante\" data-render-method=\"simagdDiagnosticanteFormatter\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Paciente ambulatorio:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"pacienteAmbulatorio\" data-render-text=\"prc_pacienteAmbulatorio\" data-render-method=\"simagdPacienteAmbulatorioFormatter\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Justificación:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"justificacionDiagnostico\" data-render-text=\"prc_justificacionDiagnostico\" data-render-method=\"simagdDescriptionFormatter\"></td>
                            </tr>
                            
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-users\"></i> Contactar a:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idContactoPaciente\" data-render-text=\"prc_contactoPaciente\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Forma de contacto:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idFormaContacto\" data-render-text=\"prc_formaContacto\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nombre del Contacto:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"nombreContacto\" data-render-text=\"prc_nombreContacto\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Contacto:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"contacto\" data-render-text=\"prc_contacto\"></td>
                            </tr>
                            <tr>
                                <td colspan=\"4\" class=\"col-md-12\">
                                    <div class=\"panel panel-success-v2\" id='solicitud__estudio_proyecciones' >
                                        <div class=\"panel-heading\">
                                            <h3 class=\"panel-title\"> ";
        // line 130
        echo " Proyecciones solicitadas </h3>
                                        </div>
                                        <div class=\"panel-body\" style=\"\" >
                                            <div class=\"form-group\">
                                                <label class=\"col-md-2 col-xs-2 control-label simagd-panel-container-label\"><span class=\"simagd-text-primary\">Modalidad que solicita:</span></label>
                                                <div class=\"col-md-2 col-xs-2\" data-render-info=\"idAreaServicioDiagnostico\" data-render-text=\"prc_modalidad\" data-render-method=\"simagdAreaServicioDiagnosticoFormatter\"></div>
                                                <label class=\"col-md-2 col-xs-2 control-label simagd-panel-container-label\"><span class=\"simagd-text-primary\"><i class=\"fa fa-eye\"></i> Proyecciones solicitadas:</span></label>
                                                <div class=\"col-md-6 col-xs-6\" data-render-info=\"solicitudEstudioProyeccion\" data-render-text=\"prc_solicitudEstudioProyeccion\" data-render-method=\"simagdSolicitudEstudioProyeccionFormatter\"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=\"4\" class=\"col-md-12\">
\t\t\t\t    <a class=\"btn-link btn-link-v2\" id=\"prc_link_show_fullhistory\" style=\"font-weight: bold !important; color: #0c586f !important;\">ver desarrollo...</a>
                                    <div class=\"panel panel-success-v2\" id='__seguimiento_desarrollo_solicitud__resultados' style=\"display: none;\" >
                                        <div class=\"panel-heading\">
                                            <h3 class=\"panel-title\"> <i class=\"fa fa-history\"></i> Seguimiento de solicitud de estudio </h3>
                                        </div>
                                        <div class=\"panel-body\" style=\"\" >
\t\t\t\t\t    <div class=\"panel panel-element-v2\" id='__seguimiento_desarrollo_solicitud__cita' >
\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t    <h3 class=\"panel-title\"> <i class=\"fa fa-clock-o\"></i> Cita otorgada </h3>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"panel-body\" style=\"\" >
\t\t\t\t\t\t    <div class=\"col-md-2 col-xs-2\"><span class=\"simagd-text-primary simagd-panel-container-label\">Requiere cita:</span></div>
\t\t\t\t\t\t    <div class=\"col-md-4 col-xs-4\" data-render-info=\"requiereCita\" data-render-text=\"prc_requiereCita\" data-render-method=\"simagdRequiereCitaFormatter\"></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t    </div>
\t\t\t\t\t    <div class=\"panel panel-element-v2\" id='__seguimiento_desarrollo_solicitud__procedimientos_realizados' >
\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t    <h3 class=\"panel-title\"> <i class=\"fa fa-eye\"></i> Exámenes </h3>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"panel-body\" style=\"\" >
\t\t\t\t\t\t    <div class=\"col-md-2 col-xs-2\"><span class=\"simagd-text-primary simagd-panel-container-label\">Requiere cita:</span></div>
\t\t\t\t\t\t    <div class=\"col-md-4 col-xs-4\" data-render-info=\"requiereCita\" data-render-text=\"prc_requiereCita\" data-render-method=\"simagdRequiereCitaFormatter\"></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t    </div>
\t\t\t\t\t    <div class=\"panel panel-element-v2\" id='__seguimiento_desarrollo_solicitud__diagnostico' >
\t\t\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t\t    <h3 class=\"panel-title\"> <i class=\"fa fa-microphone\"></i> Interpretación </h3>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"panel-body\" style=\"\" >
\t\t\t\t\t\t    <div class=\"col-md-2 col-xs-2\"><span class=\"simagd-text-primary simagd-panel-container-label\">Requiere cita:</span></div>
\t\t\t\t\t\t    <div class=\"col-md-4 col-xs-4\" data-render-info=\"requiereCita\" data-render-text=\"prc_requiereCita\" data-render-method=\"simagdRequiereCitaFormatter\"></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t    </div>
                                        </div>
                                    </div>
                                </td>
                                <script>
\t\t\t\t    var \$link_history\t= jQuery('#prc_link_show_fullhistory');
\t\t\t\t    \$link_history.click(function () {
\t\t\t\t\tjQuery('#__seguimiento_desarrollo_solicitud__resultados').toggle('slow', function() {
\t\t\t\t\t    \$link_history.text(jQuery(this).is(':visible') ? 'ocultar desarrollo...' : 'ver desarrollo...');
\t\t\t\t      });
\t\t\t\t    });
                                </script>
                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button class='btn btn-element-v2' data-toggle='modal' href='#prcRecord-ShowModal' id='btn-prc-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  150 => 130,  31 => 12,  224 => 185,  218 => 180,  215 => 177,  178 => 143,  175 => 140,  139 => 106,  133 => 101,  130 => 98,  100 => 70,  94 => 65,  73 => 54,  69 => 46,  64 => 43,  61 => 42,  35 => 19,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  580 => 365,  577 => 364,  575 => 363,  567 => 362,  564 => 361,  561 => 360,  557 => 359,  555 => 358,  551 => 356,  549 => 355,  526 => 334,  523 => 331,  511 => 321,  501 => 313,  492 => 308,  480 => 301,  468 => 293,  461 => 290,  455 => 287,  447 => 282,  443 => 280,  437 => 277,  435 => 276,  407 => 250,  396 => 248,  391 => 247,  380 => 245,  375 => 244,  364 => 242,  360 => 241,  324 => 207,  306 => 190,  285 => 170,  268 => 154,  247 => 134,  230 => 118,  213 => 102,  202 => 92,  199 => 90,  192 => 82,  189 => 81,  184 => 148,  168 => 69,  164 => 67,  161 => 66,  156 => 63,  151 => 60,  148 => 59,  144 => 56,  138 => 54,  135 => 53,  128 => 49,  124 => 48,  120 => 47,  115 => 46,  110 => 43,  105 => 42,  99 => 39,  91 => 62,  75 => 48,  67 => 45,  57 => 17,  54 => 16,  46 => 12,  43 => 11,  38 => 20,  36 => 8,  34 => 7,  32 => 6,);
    }
}
