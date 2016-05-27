<?php

/* MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_resultado_busquedaPaciente.html.twig */
class __TwigTemplate_408f7ce02438c1a47a4132bc4ed6100899900348db05a58d1b5de5a062b90266 extends Twig_Template
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
    <div id=\"container_menu_historiaImagenologica\" style=\"display: none;\">
    
        <nav class=\"navbar navbar-default\">
            <div class=\"container-fluid\">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    </button>
                    <span class=\"navbar-brand\"><span class=\"label label-primary-v2\"> <i class=\"fa fa-wheelchair\"></i> <i class=\"fa fa-list\"></i> Historial </span></span>
                    ";
        // line 17
        echo "                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                    <ul class=\"nav navbar-nav\">
                        <li class=\"list-table-link-navbar active\"><a href=\"javascript:void(0)\" id=\"show-table-info-paciente\" data-divtabletarget=\"div-resultado-informacion-paciente\">Información <span class=\"sr-only\">(current)</span></a></li>
                        <li class=\"list-table-link-navbar\"><a href=\"javascript:void(0)\" id=\"show-table-preinscripciones-paciente\" data-divtabletarget=\"div-resultado-preinscripciones-paciente\">Solicitudes</a></li>
                        <li class=\"list-table-link-navbar\"><a href=\"javascript:void(0)\" id=\"show-table-citas-paciente\" data-divtabletarget=\"div-resultado-citas-paciente\">Citas</a></li>
                        <li class=\"list-table-link-navbar\"><a href=\"javascript:void(0)\" id=\"show-table-estudios-paciente\" data-divtabletarget=\"div-resultado-estudios-paciente\">Exámenes</a></li>
                        <li class=\"list-table-link-navbar\"><a href=\"javascript:void(0)\" id=\"show-table-diagnosticos-paciente\" data-divtabletarget=\"div-resultado-diagnosticos-paciente\">Diagnósticos</a></li>
                    </ul>
                
                    <ul class=\"nav navbar-nav navbar-right\">
                        <li>
                            <a href=\"javascript:void(0)\" title=\"Volver a listado\" id=\"volver-resultado-busqueda\" name=\"btn_back_result_search\">
                                <i class=\"fa fa-reply-all\"></i> Volver
                            </a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div id=\"div-resultado-informacion-paciente\" class=\"menu-listas-historial-paciente\">
\t    ";
        // line 42
        echo "\t    ";
        $this->env->loadTemplate("MinsalSimagdBundle:show_entity_block:pct_bloque_informacion_v2.html.twig")->display($context);
        // line 43
        echo "
\t    ";
        // line 45
        echo "\t    ";
        // line 46
        echo "\t\t";
        $this->env->loadTemplate("MinsalSimagdBundle:show_container_fullEntity:pct_total_info_modal_v2.html.twig")->display($context);
        echo "     ";
        // line 47
        echo "\t    ";
        // line 48
        echo "        </div>

        <div id=\"div-resultado-preinscripciones-paciente\" style=\"display: none;\" class=\"menu-listas-historial-paciente\" data-refresh-parameter=\"\" data-refresh-url=\"simagd_imagenologia_digital_listarSolicitudesEstudioPaciente\">
            <table class=\"table table-condensed\" id=\"table-lista-preinscripciones-paciente\"
                   data-toggle=\"table\"
                   data-url=\"\"
                   data-backup-url=\"simagd_imagenologia_digital_listarSolicitudesEstudioPaciente\"
                   data-cache=\"false\"
                   data-show-refresh=\"true\"
                   data-show-toggle=\"true\"
                   data-show-columns=\"true\"
                   data-search=\"true\"
                   data-select-item-name=\"listaSolicitudesToolbar\"
                   data-pagination=\"true\"
                   data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 62
        echo "]\"
                   ";
        // line 65
        echo "                   data-classes=\"table table-hover table-condensed table-no-bordered\"
                   data-height=\"760\">
                <thead>
                    <tr style=\"background-color: #31708f; color: #fff;\">
                        ";
        // line 70
        echo "                        <th data-field=\"id\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
                        <th data-field=\"origen\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
                        <th data-field=\"empleado\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
                        <th data-field=\"areaAtencion\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
                        <th data-field=\"atencion\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
                        <th data-field=\"referido\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido a</th>
                        <th data-field=\"modalidad\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
                        <th data-field=\"diagnosticante\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Diagnosticar en</th>
                        <th data-field=\"fechaCreacion\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se creó</th>
                        <th data-field=\"fechaProximaConsulta\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Próxima consulta</th>
                        <th data-field=\"action\" data-formatter=\"actionSolicitudesEstudioFormatter\" data-events=\"actionSolicitudesEstudioEvents\" class=\"col-md-1\"></th>
                    </tr>
                </thead>
            </table>
        </div>

        <div id=\"div-resultado-citas-paciente\" style=\"display: none;\" class=\"menu-listas-historial-paciente\" data-refresh-parameter=\"\" data-refresh-url=\"simagd_imagenologia_digital_listarCitasPaciente\">
            <table class=\"table table-condensed\" id=\"table-lista-citas-paciente\"
                   data-toggle=\"table\"
                   data-url=\"\"
                   data-backup-url=\"simagd_imagenologia_digital_listarCitasPaciente\"
                   data-cache=\"false\"
                   data-show-refresh=\"true\"
                   data-show-toggle=\"true\"
                   data-show-columns=\"true\"
                   data-search=\"true\"
                   data-select-item-name=\"listaCitasToolbar\"
                   data-pagination=\"true\"
                   data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 98
        echo "]\"
                   ";
        // line 101
        echo "                   data-classes=\"table table-hover table-condensed table-no-bordered\"
                   data-height=\"760\">
                <thead>
                    <tr style=\"background-color: #31708f; color: #fff;\">
                        ";
        // line 106
        echo "                        <th data-field=\"id\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
                        <th data-field=\"origen\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
                        <th data-field=\"solicitante\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
                        <th data-field=\"areaAtencion\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
                        <th data-field=\"atencion\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
                        <th data-field=\"modalidad\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
                        <th data-field=\"diagnosticante\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Diagnosticar en</th>
                        <th data-field=\"solicitada\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se solicitó</th>
                        <th data-field=\"fechaProximaConsulta\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Próxima consulta</th>
                        <th data-field=\"empleado\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Programó</th>
                        <th data-field=\"estado\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
                        <th data-field=\"fechaCreacion\" data-visible=\"false\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se creó</th>
                        <th data-field=\"inicio\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Fecha programada</th>
                        <th data-field=\"fin\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Hasta</th>
                        <th data-field=\"confirmada\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se confirmó</th>
                        <th data-field=\"reprogramada\" data-visible=\"false\" data-formatter=\"reprogramadaFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Reprogramada</th>
                        <th data-field=\"action\" data-formatter=\"actionCitasFormatter\" data-events=\"actionCitasEvents\" class=\"col-md-1\"></th>
                    </tr>
                </thead>
            </table>
        </div>

        <div id=\"div-resultado-estudios-paciente\" style=\"display: none;\" class=\"menu-listas-historial-paciente\" data-refresh-parameter=\"\" data-refresh-url=\"simagd_imagenologia_digital_listarExamenesPaciente\">
            <table class=\"table table-condensed\" id=\"table-lista-estudios-paciente\"
                   data-toggle=\"table\"
                   data-url=\"\"
                   data-backup-url=\"simagd_imagenologia_digital_listarExamenesPaciente\"
                   data-cache=\"false\"
                   data-show-refresh=\"true\"
                   data-show-toggle=\"true\"
                   data-show-columns=\"true\"
                   data-search=\"true\"
                   data-select-item-name=\"listaProcedimientosRealizadosToolbar\"
                   data-pagination=\"true\"
                   data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 140
        echo "]\"
                   ";
        // line 143
        echo "                   data-classes=\"table table-hover table-condensed table-no-bordered\"
                   data-height=\"760\">
                <thead>
                    <tr style=\"background-color: #31708f; color: #fff;\">
                        ";
        // line 148
        echo "                        <th data-field=\"id\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
                        <th data-field=\"origen\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
                        <th data-field=\"solicitante\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
                        <th data-field=\"areaAtencion\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
                        <th data-field=\"atencion\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
                        <th data-field=\"modalidad\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
                        <th data-field=\"tecnologo\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
                        <th data-field=\"estado\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
                        <th data-field=\"realizado\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se realizó</th>
                        <th data-field=\"procesado\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se procesó</th>
                        <th data-field=\"almacenado\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se almacenó</th>
                        <th data-field=\"action\" data-formatter=\"actionExamenesFormatter\" data-events=\"actionExamenesEvents\" class=\"col-md-1\"></th>
                    </tr>
                </thead>
            </table>
        </div>

        <div id=\"div-resultado-diagnosticos-paciente\" style=\"display: none;\" class=\"menu-listas-historial-paciente\" data-refresh-parameter=\"\" data-refresh-url=\"simagd_imagenologia_digital_listarDiagnosticosPaciente\">
            <table class=\"table table-condensed\" id=\"table-lista-diagnosticos-paciente\"
                   data-toggle=\"table\"
                   data-url=\"\"
                   data-backup-url=\"simagd_imagenologia_digital_listarDiagnosticosPaciente\"
                   data-cache=\"false\"
                   data-show-refresh=\"true\"
                   data-show-toggle=\"true\"
                   data-show-columns=\"true\"
                   data-search=\"true\"
                   data-select-item-name=\"listaDiagnosticosToolbar\"
                   data-pagination=\"true\"
                   data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 177
        echo "]\"
                   ";
        // line 180
        echo "                   data-classes=\"table table-hover table-condensed table-no-bordered\"
                   data-height=\"760\">
                <thead>
                    <tr style=\"background-color: #31708f; color: #fff;\">
                        ";
        // line 185
        echo "                        <th data-field=\"id\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
                        <th data-field=\"origen\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
                        <th data-field=\"solicitante\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
                        <th data-field=\"areaAtencion\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
                        <th data-field=\"atencion\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
                        <th data-field=\"modalidad\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
                        <th data-field=\"tecnologo\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
                        <th data-field=\"estado\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
                        <th data-field=\"transcriptor\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Transcribió</th>
                        <th data-field=\"transcrito\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se transcribió</th>
                        <th data-field=\"radiologo\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretó</th>
                        <th data-field=\"aprobado\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se aprobó</th>
                        <th data-field=\"correlativo\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Correlativo</th>
                        <th data-field=\"interpretado\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se interpretó</th>
                        <th data-field=\"action\" data-formatter=\"actionDiagnosticosFormatter\" data-events=\"actionDiagnosticosEvents\" class=\"col-md-1\"></th>
                    </tr>
                </thead>
            </table>
        </div>
        
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_resultado_busquedaPaciente.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  224 => 185,  218 => 180,  215 => 177,  178 => 143,  175 => 140,  139 => 106,  133 => 101,  130 => 98,  100 => 70,  94 => 65,  73 => 47,  69 => 46,  64 => 43,  61 => 42,  35 => 17,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  580 => 365,  577 => 364,  575 => 363,  567 => 362,  564 => 361,  561 => 360,  557 => 359,  555 => 358,  551 => 356,  549 => 355,  526 => 334,  523 => 331,  511 => 321,  501 => 313,  492 => 308,  480 => 301,  468 => 293,  461 => 290,  455 => 287,  447 => 282,  443 => 280,  437 => 277,  435 => 276,  407 => 250,  396 => 248,  391 => 247,  380 => 245,  375 => 244,  364 => 242,  360 => 241,  324 => 207,  306 => 190,  285 => 170,  268 => 154,  247 => 134,  230 => 118,  213 => 102,  202 => 92,  199 => 90,  192 => 82,  189 => 81,  184 => 148,  168 => 69,  164 => 67,  161 => 66,  156 => 63,  151 => 60,  148 => 59,  144 => 56,  138 => 54,  135 => 53,  128 => 49,  124 => 48,  120 => 47,  115 => 46,  110 => 43,  105 => 42,  99 => 39,  91 => 62,  75 => 48,  67 => 45,  57 => 17,  54 => 16,  46 => 12,  43 => 11,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
