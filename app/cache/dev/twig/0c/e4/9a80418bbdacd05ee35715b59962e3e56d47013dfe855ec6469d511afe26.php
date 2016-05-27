<?php

/* MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal.html.twig */
class __TwigTemplate_0ce49a80418bbdacd05ee35715b59962e3e56d47013dfe855ec6469d511afe26 extends Twig_Template
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
                
                <div class=\"panel panel-info-v2\">
                    <div class=\"panel-heading\">
                        <h3 class=\"panel-title\"> <i class=\"fa fa-folder-open-o\"></i> Detalles de la preinscripción </h3>
                    </div>
                    <div class=\"panel-body\" >

                        <table class=\"table table-condensed\">
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creada en:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idAtenAreaModEstab"), "idEstablecimiento"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Sala:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "numeroSala"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Proviene de:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idAtenAreaModEstab"), "idAreaModEstab"), "idAreaAtencion"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Cama:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "numeroCama"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Servicio que refiere:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idAtenAreaModEstab"), "idAtencion"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Paciente desconocido:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 46
        echo (($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "pacienteDesconocido")) ? ("Si") : ("No"));
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Preinscribe:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idEmpleado"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Peso actual ( lb ):</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "pesoActualLb"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 62
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idEmpleado"), "idTipoEmpleado"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Peso actual ( kg ):</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "pesoActualKg"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Usuario que registró:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idUserReg"), "idEmpleado"), "html", null, true);
        echo " <strong> ( ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idUserReg"), "username"), "html", null, true);
        echo " ) </strong>
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Talla ( m ):</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "tallaPaciente"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Último usuario que editó:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 82
        if ((!(null === $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idUserMod")))) {
            // line 83
            echo "                                        ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idUserMod"), "idEmpleado"), "html", null, true);
            echo " <strong> ( ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idUserMod"), "username"), "html", null, true);
            echo " ) </strong>
                                    ";
        }
        // line 85
        echo "                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Referido:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 88
        echo (($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "referirPaciente")) ? ("Si") : ("No"));
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Motivo de consulta:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "consultaPor"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Referido a:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 98
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idEstablecimientoReferido"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estado clínico:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 104
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "estadoClinico"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Justificación:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 108
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "justificacionReferencia"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Datos clínicos:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "datosClinicos"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Modalidad que solicita:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 118
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idAreaServicioDiagnostico"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Hipótesis diagnóstica:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 124
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "hipotesisDiagnostica"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Proyecciones:</span></th>
                                <td class=\"col-md-4\">
                                    <ul>
                                        ";
        // line 129
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "solicitudEstudioProyeccion"));
        foreach ($context['_seq'] as $context["_key"] => $context["exploracion"]) {
            // line 130
            echo "                                            <li>
                                                <a data-toggle=\"modal\" href=\"#\" data-id=\"";
            // line 131
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exploracion"]) ? $context["exploracion"] : $this->getContext($context, "exploracion")), "id"), "html", null, true);
            echo "\" data-target=\"#exploracionSolFullData-showModalContainer\" class=\"open-explSolDialog btn-link\" title=\"Abrir detalles de la Proyección\">
                                                    <i class=\"fa fa-external-link-square\"></i>
                                                </a> &nbsp;
                                                <strong> ";
            // line 134
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["exploracion"]) ? $context["exploracion"] : $this->getContext($context, "exploracion")), "idProyeccionSolicitada"), "idExamenServicioDiagnostico"), "html", null, true);
            echo " </strong> : ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exploracion"]) ? $context["exploracion"] : $this->getContext($context, "exploracion")), "idProyeccionSolicitada"), "html", null, true);
            echo "
                                            </li>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exploracion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 137
        echo "                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Investigando:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 143
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "investigando"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Próxima consulta médica:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 147
        echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "fechaProximaConsulta"), "EEEE, MMMM d, yyyy", "es_ES");
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Justificación médica:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 153
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "justificacionMedica"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Requiere cita:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 157
        echo (($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "requiereCita")) ? ("Si") : ("No"));
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Antecedentes clínicos:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 163
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "antecedentesClinicosRelevantes"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Requiere diagnóstico:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 167
        echo (($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "requiereDiagnostico")) ? ("Si") : ("No"));
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creado:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 173
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "fechaCreacion"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "fechaCreacion"), "H:i:s A")), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Diagnosticar en:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 177
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idEstablecimientoDiagnosticante"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Paciente ambulatorio:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 183
        echo (($this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "pacienteAmbulatorio")) ? ("Si") : ("No"));
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Justificación:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 187
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "justificacionDiagnostico"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan=\"4\" class=\"col-md-12\">&nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan=\"4\" class=\"col-md-12\">
                                    <span class=\"text-danger\"><strong> <i class=\"fa fa-users\"></i> Información de contacto:</strong></span>
                                </th>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Contactar a:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 202
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idContactoPaciente"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Forma de contacto:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 206
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "idFormaContacto"), "html", null, true);
        echo "
                                </td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nombre del Contacto:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 212
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "nombreContacto"), "html", null, true);
        echo "
                                </td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Contacto:</span></th>
                                <td class=\"col-md-4\">
                                    ";
        // line 216
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preinscripcionInfo"]) ? $context["preinscripcionInfo"] : $this->getContext($context, "preinscripcionInfo")), "contacto"), "html", null, true);
        echo "
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:prc_total_info_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1002 => 387,  999 => 386,  994 => 384,  992 => 381,  988 => 379,  972 => 374,  962 => 371,  955 => 369,  952 => 368,  945 => 362,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  901 => 342,  898 => 341,  893 => 338,  863 => 328,  841 => 321,  778 => 315,  772 => 312,  760 => 307,  755 => 304,  752 => 303,  718 => 306,  689 => 289,  685 => 287,  682 => 285,  618 => 254,  596 => 231,  578 => 270,  534 => 200,  507 => 184,  447 => 190,  445 => 175,  419 => 166,  454 => 160,  371 => 191,  651 => 437,  483 => 333,  404 => 257,  517 => 291,  484 => 274,  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 363,  905 => 802,  880 => 784,  376 => 193,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 204,  401 => 144,  369 => 129,  356 => 212,  340 => 202,  874 => 781,  854 => 325,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 318,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 309,  763 => 308,  746 => 311,  740 => 307,  734 => 305,  731 => 345,  729 => 303,  721 => 307,  715 => 303,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 436,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 205,  520 => 355,  450 => 173,  408 => 161,  363 => 216,  359 => 182,  348 => 129,  345 => 124,  336 => 192,  316 => 116,  307 => 124,  261 => 85,  266 => 83,  542 => 218,  538 => 217,  527 => 197,  509 => 353,  499 => 188,  493 => 155,  479 => 272,  473 => 165,  414 => 158,  406 => 152,  280 => 126,  223 => 130,  585 => 224,  551 => 101,  546 => 308,  506 => 103,  503 => 193,  488 => 176,  485 => 175,  478 => 165,  475 => 164,  471 => 211,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 177,  291 => 165,  286 => 140,  392 => 150,  332 => 164,  318 => 156,  276 => 160,  190 => 167,  12 => 36,  195 => 114,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 385,  993 => 312,  987 => 310,  985 => 378,  982 => 377,  976 => 850,  974 => 375,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 357,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 348,  894 => 383,  890 => 381,  887 => 336,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 311,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 389,  730 => 219,  727 => 218,  712 => 214,  709 => 296,  706 => 295,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 251,  632 => 186,  626 => 260,  623 => 183,  616 => 249,  613 => 232,  610 => 407,  608 => 197,  605 => 196,  602 => 230,  593 => 230,  591 => 181,  571 => 228,  566 => 224,  533 => 203,  530 => 150,  513 => 79,  496 => 280,  441 => 150,  438 => 149,  432 => 166,  428 => 172,  422 => 150,  416 => 173,  395 => 118,  391 => 109,  382 => 195,  372 => 89,  364 => 137,  353 => 96,  335 => 120,  333 => 127,  297 => 169,  292 => 82,  205 => 113,  200 => 82,  184 => 121,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 370,  954 => 300,  946 => 296,  939 => 359,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 320,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 316,  793 => 227,  786 => 224,  779 => 330,  774 => 313,  754 => 208,  748 => 205,  745 => 392,  742 => 391,  737 => 199,  735 => 220,  732 => 197,  728 => 344,  726 => 341,  723 => 340,  719 => 215,  717 => 186,  714 => 185,  704 => 294,  701 => 180,  699 => 179,  696 => 291,  690 => 285,  687 => 173,  681 => 205,  673 => 281,  671 => 280,  668 => 279,  663 => 277,  658 => 271,  654 => 155,  649 => 153,  643 => 250,  640 => 249,  636 => 145,  633 => 261,  629 => 141,  627 => 335,  624 => 334,  620 => 182,  614 => 331,  599 => 326,  594 => 520,  592 => 519,  589 => 226,  587 => 388,  584 => 320,  576 => 230,  574 => 317,  570 => 316,  567 => 110,  554 => 311,  552 => 361,  544 => 204,  541 => 359,  539 => 96,  522 => 195,  519 => 194,  505 => 352,  502 => 87,  477 => 82,  472 => 132,  465 => 209,  463 => 208,  446 => 244,  443 => 142,  429 => 219,  425 => 228,  410 => 167,  397 => 161,  394 => 54,  389 => 128,  357 => 186,  342 => 137,  334 => 171,  330 => 122,  328 => 167,  290 => 167,  287 => 163,  263 => 122,  255 => 98,  245 => 92,  194 => 73,  76 => 39,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 373,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 347,  902 => 276,  896 => 296,  888 => 270,  882 => 333,  873 => 267,  868 => 282,  864 => 372,  860 => 327,  856 => 279,  852 => 324,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 347,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 274,  638 => 433,  621 => 256,  617 => 254,  612 => 526,  609 => 525,  606 => 209,  603 => 523,  600 => 522,  598 => 244,  595 => 394,  586 => 225,  582 => 190,  580 => 387,  572 => 218,  568 => 227,  562 => 313,  556 => 212,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 183,  492 => 341,  481 => 218,  476 => 271,  467 => 156,  451 => 159,  424 => 115,  418 => 227,  412 => 147,  399 => 64,  396 => 166,  390 => 139,  388 => 153,  383 => 135,  377 => 104,  373 => 46,  370 => 147,  367 => 102,  352 => 141,  349 => 139,  346 => 138,  329 => 111,  326 => 131,  313 => 126,  303 => 132,  300 => 124,  234 => 88,  218 => 98,  207 => 118,  178 => 99,  321 => 119,  295 => 118,  274 => 157,  242 => 93,  236 => 136,  692 => 175,  683 => 170,  678 => 204,  676 => 282,  666 => 278,  661 => 276,  656 => 198,  652 => 273,  645 => 150,  641 => 368,  635 => 268,  631 => 364,  625 => 361,  615 => 354,  607 => 404,  597 => 325,  590 => 322,  583 => 224,  579 => 236,  577 => 318,  575 => 252,  569 => 233,  565 => 314,  548 => 207,  540 => 202,  536 => 358,  529 => 213,  524 => 196,  516 => 143,  510 => 185,  504 => 183,  500 => 88,  490 => 197,  486 => 275,  482 => 285,  470 => 131,  464 => 180,  459 => 162,  452 => 145,  434 => 170,  421 => 114,  417 => 159,  385 => 196,  361 => 145,  344 => 94,  339 => 167,  324 => 123,  310 => 113,  302 => 145,  296 => 136,  282 => 106,  259 => 81,  244 => 116,  231 => 117,  226 => 131,  114 => 53,  104 => 61,  288 => 141,  284 => 162,  279 => 111,  275 => 99,  256 => 147,  250 => 95,  237 => 71,  232 => 134,  222 => 57,  215 => 130,  191 => 115,  153 => 86,  563 => 223,  560 => 222,  558 => 186,  555 => 185,  553 => 211,  549 => 206,  543 => 179,  537 => 306,  532 => 199,  528 => 173,  525 => 356,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 207,  455 => 203,  449 => 247,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 170,  420 => 123,  415 => 226,  411 => 120,  405 => 118,  403 => 160,  400 => 162,  380 => 107,  366 => 146,  354 => 185,  331 => 133,  325 => 119,  320 => 92,  317 => 128,  311 => 181,  308 => 151,  304 => 85,  272 => 98,  267 => 153,  249 => 143,  216 => 55,  155 => 93,  152 => 61,  146 => 63,  126 => 75,  181 => 83,  161 => 89,  110 => 66,  188 => 114,  186 => 108,  170 => 98,  150 => 130,  124 => 74,  358 => 172,  351 => 183,  347 => 206,  343 => 146,  338 => 144,  327 => 121,  323 => 114,  319 => 159,  315 => 183,  301 => 121,  299 => 173,  293 => 135,  289 => 115,  281 => 112,  277 => 95,  271 => 94,  265 => 153,  262 => 92,  260 => 119,  257 => 138,  251 => 143,  248 => 71,  239 => 90,  228 => 130,  225 => 86,  213 => 107,  211 => 124,  197 => 110,  174 => 91,  148 => 89,  134 => 74,  127 => 69,  20 => 2,  53 => 30,  270 => 129,  253 => 100,  233 => 133,  212 => 86,  210 => 116,  206 => 124,  202 => 118,  198 => 112,  192 => 102,  185 => 106,  180 => 109,  175 => 98,  172 => 96,  167 => 156,  165 => 93,  160 => 90,  137 => 79,  113 => 55,  100 => 54,  90 => 48,  81 => 44,  129 => 59,  84 => 50,  77 => 46,  34 => 8,  118 => 68,  97 => 46,  70 => 39,  65 => 16,  58 => 22,  23 => 5,  480 => 134,  474 => 213,  469 => 150,  461 => 157,  457 => 161,  453 => 194,  444 => 151,  440 => 172,  437 => 171,  435 => 167,  430 => 172,  427 => 171,  423 => 169,  413 => 164,  409 => 153,  407 => 238,  402 => 65,  398 => 157,  393 => 156,  387 => 110,  384 => 152,  381 => 150,  379 => 194,  374 => 192,  368 => 190,  365 => 189,  362 => 97,  360 => 187,  355 => 161,  341 => 123,  337 => 136,  322 => 187,  314 => 136,  312 => 125,  309 => 113,  305 => 128,  298 => 143,  294 => 145,  285 => 79,  283 => 163,  278 => 110,  268 => 94,  264 => 104,  258 => 147,  252 => 88,  247 => 109,  241 => 74,  229 => 102,  220 => 124,  214 => 86,  177 => 99,  169 => 96,  140 => 69,  132 => 79,  128 => 49,  107 => 62,  61 => 19,  273 => 130,  269 => 127,  254 => 122,  243 => 137,  240 => 137,  238 => 92,  235 => 120,  230 => 111,  227 => 130,  224 => 100,  221 => 82,  219 => 129,  217 => 87,  208 => 80,  204 => 116,  179 => 104,  159 => 91,  143 => 81,  135 => 78,  119 => 66,  102 => 60,  71 => 19,  67 => 25,  63 => 25,  59 => 32,  38 => 20,  94 => 56,  89 => 52,  85 => 50,  75 => 24,  68 => 37,  56 => 16,  201 => 95,  196 => 87,  183 => 101,  171 => 103,  166 => 92,  163 => 94,  158 => 77,  156 => 86,  151 => 74,  142 => 77,  138 => 78,  136 => 75,  121 => 72,  117 => 70,  105 => 62,  91 => 52,  62 => 36,  49 => 17,  28 => 8,  26 => 7,  87 => 51,  31 => 12,  25 => 10,  21 => 1,  24 => 4,  19 => 2,  93 => 50,  88 => 32,  78 => 46,  46 => 26,  44 => 15,  27 => 5,  79 => 36,  72 => 19,  69 => 40,  47 => 11,  40 => 18,  37 => 5,  22 => 3,  246 => 94,  157 => 90,  145 => 65,  139 => 82,  131 => 74,  123 => 48,  120 => 64,  115 => 64,  111 => 42,  108 => 35,  101 => 60,  98 => 53,  96 => 56,  83 => 44,  74 => 23,  66 => 36,  55 => 38,  52 => 18,  50 => 28,  43 => 25,  41 => 22,  35 => 19,  32 => 7,  29 => 20,  209 => 119,  203 => 96,  199 => 120,  193 => 116,  189 => 70,  187 => 107,  182 => 90,  176 => 100,  173 => 69,  168 => 84,  164 => 99,  162 => 152,  154 => 88,  149 => 85,  147 => 84,  144 => 80,  141 => 83,  133 => 75,  130 => 76,  125 => 72,  122 => 68,  116 => 66,  112 => 66,  109 => 60,  106 => 58,  103 => 56,  99 => 54,  95 => 56,  92 => 51,  86 => 41,  82 => 46,  80 => 46,  73 => 42,  64 => 36,  60 => 40,  57 => 32,  54 => 29,  51 => 11,  48 => 26,  45 => 8,  42 => 14,  39 => 8,  36 => 17,  33 => 3,  30 => 6,);
    }
}
