/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function ___actionLecturaSetterObjectModalData(lctId, $lctObject, allow_userOverData) {
    moment.locale('es');
    var $lctContent = $("#lecturaFullData-showModalContainer");

    $lctContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($lctObject.lct_radiologo, {data_id_empUser: $lctObject.lct_id_radiologo}, $lctObject.lct_id));
    $lctContent.find("[data-render-info='correlativo']")
	    .html(jQuery.trim($lctObject.lct_correlativo));
    $lctContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($lctObject.lct_tipoEmpleado));
    $lctContent.find("[data-render-info='fechaLectura']")
	    .html(simagdDateTimeFormatter($lctObject.lct_fechaLectura, $lctObject, $lctObject.lct_id));
    $lctContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($lctObject.lct_nombreUserReg) + ' <strong> (' + jQuery.trim($lctObject.lct_usernameUserReg) + ') </strong>', {data_id_user: $lctObject.lct_id_userReg}, $lctObject.lct_id));
    $lctContent.find("[data-render-info='idTipoResultado']")
	    .html(jQuery.trim($lctObject.lct_tipoResultado));
    $lctContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdEstabUserLoggedFormatter($lctObject.lct_solicitado, {data_id_estab: $lctObject.lct_id_solicitado}, $lctObject.lct_id));
    $lctContent.find("[data-render-info='indicaciones']")
	    .html(simagdDescriptionFormatter($lctObject.lct_indicaciones, $lctObject, $lctObject.lct_id));
    $lctContent.find("[data-render-info='lecturaRemota']")
	    .html(function() {
                var labelColor = $lctObject.lct_lecturaRemota === false ? 'primary' : 'info';
                var labelText = $lctObject.lct_lecturaRemota === false ? 'no' : 'sí';
                console.log($lctObject.lct_lecturaRemota, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $lctContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($lctObject.lct_observaciones, $lctObject, $lctObject.lct_id));
    $lctContent.find("[data-render-info='idEstadoLectura']")
	    .html(simagdEstadoLecturaFormatter($lctObject.lct_estado, $lctObject, $lctObject.lct_id));
    $lctContent.find("[data-render-info='solicitadaPorRadiologo']")
	    .html(function() {
                var labelColor = $lctObject.lct_solicitadaPorRadiologo === false ? 'primary' : 'info';
                var labelText = $lctObject.lct_solicitadaPorRadiologo === false ? 'no' : 'sí';
                console.log($lctObject.lct_solicitadaPorRadiologo, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $lctContent.find("[data-render-info='idRadiologoDesignadoAprobacion']")
	    .html(jQuery.isEmptyObject($lctObject.lct_radiologoVal) === false ? simagdEmpleadoUserLoggedFormatter($lctObject.lct_radiologoVal, {data_id_empUser: $lctObject.lct_id_radiologoVal}, $lctObject.lct_id) : '');
    $lctContent.find("[data-render-info='idRadiologoSolicita']")
	    .html(jQuery.isEmptyObject($lctObject.lct_radiologoSol) === false ? simagdEmpleadoUserLoggedFormatter($lctObject.lct_radiologoSol, {data_id_empUser: $lctObject.lct_id_radiologoSol}, $lctObject.lct_id) : '');
}

function ___actionDiagnosticoSetterObjectModalData(diagId, $diagObject, allow_userOverData) {
    moment.locale('es');
    var $diagContent = $("#diagnosticoFullData-showModalContainer");

    $diagContent.find("[data-render-info='hallazgos']")
	    .html(simagdDescriptionAdvanceFormatter($diagObject.diag_hallazgos, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='conclusion']")
	    .html(simagdDescriptionAdvanceFormatter($diagObject.diag_conclusion, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='recomendaciones']")
	    .html(simagdDescriptionAdvanceFormatter($diagObject.diag_recomendaciones, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='errores']")
	    .html(simagdDescriptionFormatter($diagObject.diag_errores, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($diagObject.diag_transcriptor, {data_id_empUser: $diagObject.diag_id_transcriptor}, $diagObject.diag_id));
    $diagContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($diagObject.diag_nombreUserReg) + ' <strong> (' + jQuery.trim($diagObject.diag_usernameUserReg) + ') </strong>', {data_id_user: $diagObject.diag_id_userReg}, $diagObject.diag_id));
    $diagContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($diagObject.diag_tipoEmpleado));
    $diagContent.find("[data-render-info='idUserMod']")
	    .html(jQuery.isEmptyObject($diagObject.diag_nombreUserMod) === false ?
                        simagdEmpleadoUserLoggedFormatter(jQuery.trim($diagObject.diag_nombreUserMod) + ' <strong> (' + jQuery.trim($diagObject.diag_usernameUserMod) + ') </strong>', {data_id_user: $diagObject.diag_id_userMod}, $diagObject.diag_id) : ''
           );
    $diagContent.find("[data-render-info='idEstadoDiagnostico']")
	    .html(simagdEstadoDiagnosticoFormatter($diagObject.diag_estado, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='incidencias']")
	    .html(simagdDescriptionFormatter($diagObject.diag_incidencias, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='fechaTranscrito']")
	    .html(simagdDateTimeFormatter($diagObject.diag_fechaTranscrito, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($diagObject.diag_observaciones, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='fechaAprobado']")
	    .html(simagdDateTimeFormatter($diagObject.diag_fechaAprobado, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='fechaCorregido']")
	    .html(simagdDateTimeFormatter($diagObject.diag_fechaCorregido, $diagObject, $diagObject.diag_id));
    $diagContent.find("[data-render-info='idRadiologoDesignadoAprobacion']")
	    .html(jQuery.isEmptyObject($diagObject.lct_radiologoVal) === false ? simagdEmpleadoUserLoggedFormatter($diagObject.lct_radiologoVal, {data_id_empUser: $diagObject.lct_id_radiologoVal}, $diagObject.diag_id) : '');
    $diagContent.find("[data-render-info='idRadiologoAprueba']")
	    .html(jQuery.isEmptyObject($diagObject.diag_radiologoVal) === false ? simagdEmpleadoUserLoggedFormatter($diagObject.diag_radiologoVal, {data_id_empUser: $diagObject.diag_id_radiologoVal}, $diagObject.diag_id) : '');
}

function ___actionSolicitudEstudioComplementarioSetterObjectModalData(solcmplId, $solcmplObject, allow_userOverData) {
    moment.locale('es');
    var $solcmplContent = $("#solicitudEstudioComplementarioFullData-showModalContainer");
    
    $solcmplContent.find("[data-render-info='idRadiologoSolicita']")
	    .html(simagdEmpleadoUserLoggedFormatter($solcmplObject.solcmpl_solicitante, {data_id_empUser: $solcmplObject.solcmpl_id_solicitante}, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='fechaSolicitud']")
	    .html(simagdDateTimeFormatter($solcmplObject.solcmpl_fechaSolicitud, $solcmplObject, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($solcmplObject.solcmpl_tipoEmpleado));
    $solcmplContent.find("[data-render-info='justificacion']")
	    .html(simagdDescriptionFormatter($solcmplObject.solcmpl_justificacion, $solcmplObject, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='idEstablecimientoSolicitado']")
	    .html(simagdEstabUserLoggedFormatter($solcmplObject.solcmpl_solicitado, {data_id_estab: $solcmplObject.solcmpl_id_solicitado}, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='idPrioridadAtencion']")
	    .html(jQuery.isEmptyObject($solcmplObject.prAtn_nombre) === false ? simagdPrioridadAtencionFormatter($solcmplObject.prAtn_nombre, $solcmplObject, $solcmplObject.solcmpl_id) : '');
    $solcmplContent.find("[data-render-info='idAreaServicioDiagnostico']")
	    .html(jQuery.trim($solcmplObject.solcmpl_modalidad));
    $solcmplContent.find("[data-render-info='solicitudEstudioComplementarioProyeccion']")
	    .html(function() {
		var $arr_result = ['<ul>'];
		
		$.each($solcmplObject.solcmpl_solicitudEstudioComplementarioProyeccion, function(i, y) {
		    $arr_result.push('<li>', '<strong><span class="text-info">', jQuery.trim(y.expl_codigo) + '</span></strong> ' + jQuery.trim(y.expl_nombre), '</li>');
		});
		
		$arr_result.push('</ul>');

                return $arr_result.join('');
            });
    $solcmplContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($solcmplObject.solcmpl_nombreUserReg) + ' <strong> (' + jQuery.trim($solcmplObject.solcmpl_usernameUserReg) + ') </strong>', {data_id_user: $solcmplObject.solcmpl_id_userReg}, $solcmplObject.solcmpl_id));
    $solcmplContent.find("[data-render-info='idEstudioPadre']")
	    .html(function() {
                var estudioUrl = jQuery.trim($solcmplObject.est_url) || 'javascript:void(0)';/* Validar que exista idEstudio isEmptyObject */
                var allowDownload = allow_userOverData.allowDownloadEstudio === false ? ' disabled="disabled"' : '';
                console.log($solcmplObject.est_id, estudioUrl, allowDownload);
                return '<a title="Recuperar estudio de servidor PACS" target="_blank" class="btn btn-primary btn-sm" href="'
                            + estudioUrl + '"' + allowDownload + '> <i class="fa fa-eye"></i> Recuperar</a>';
            });
}

function ___actionPreinscripcionSetterObjectModalData(prcId, $prcObject, allow_userOverData) {
    moment.locale('es');
    var $prcContent = $("#preinscripcionFullData-showModalContainer");

    $prcContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdOrigenFormatter($prcObject.prc_origen, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='numeroSala']")
	    .html(jQuery.trim($prcObject.prc_numeroSala));
    $prcContent.find("[data-render-info='idAreaAtencion']")
	    .html(simagdAreaAtencionFormatter($prcObject.prc_areaAtencion, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='numeroCama']")
	    .html(jQuery.trim($prcObject.prc_numeroCama));
    $prcContent.find("[data-render-info='idAtencion']")
	    .html(jQuery.trim($prcObject.prc_atencion));
    $prcContent.find("[data-render-info='pacienteDesconocido']")
	    .html(function() {
                var labelColor = $prcObject.prc_pacienteDesconocido === false ? 'primary' : 'warning';
                var labelText = $prcObject.prc_pacienteDesconocido === false ? 'no' : 'sí';
                console.log($prcObject.prc_pacienteDesconocido, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($prcObject.prc_empleado, {data_id_empUser: $prcObject.prc_id_empleado}, $prcObject.prc_id));
    $prcContent.find("[data-render-info='pesoActualLb']")
	    .html(jQuery.trim($prcObject.prc_pesoActualLb));
    $prcContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($prcObject.prc_tipoEmpleado));
    $prcContent.find("[data-render-info='pesoActualKg']")
	    .html(jQuery.trim($prcObject.prc_pesoActualKg));
    $prcContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($prcObject.prc_nombreUserReg) + ' <strong> (' + jQuery.trim($prcObject.prc_usernameUserReg) + ') </strong>', {data_id_user: $prcObject.prc_id_userReg}, $prcObject.prc_id));
    $prcContent.find("[data-render-info='tallaPaciente']")
	    .html(jQuery.trim($prcObject.prc_tallaPaciente));
    $prcContent.find("[data-render-info='idUserMod']")
	    .html(jQuery.isEmptyObject($prcObject.prc_nombreUserMod) === false ?
                    simagdEmpleadoUserLoggedFormatter(jQuery.trim($prcObject.prc_nombreUserMod) + ' <strong> (' + jQuery.trim($prcObject.prc_usernameUserMod) + ') </strong>', {data_id_user: $prcObject.prc_id_userMod}, $prcObject.prc_id)
                        : ''
           );
    $prcContent.find("[data-render-info='referirPaciente']")
	    .html(function() {
                var labelColor = $prcObject.prc_referirPaciente === false ? 'primary' : 'info';
                var labelText = $prcObject.prc_referirPaciente === false ? 'no' : 'sí';
                console.log($prcObject.prc_referirPaciente, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='consultaPor']")
	    .html(simagdDescriptionFormatter($prcObject.prc_consultaPor, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idEstablecimientoReferido']")
	    .html(simagdReferidoFormatter($prcObject.prc_referido, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='estadoClinico']")
	    .html(simagdDescriptionFormatter($prcObject.prc_estadoClinico, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='justificacionReferencia']")
	    .html(simagdDescriptionFormatter($prcObject.prc_justificacionReferencia, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='datosClinicos']")
	    .html(simagdDescriptionFormatter($prcObject.prc_datosClinicos, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idAreaServicioDiagnostico']")
	    .html(jQuery.trim($prcObject.prc_modalidad));
    $prcContent.find("[data-render-info='solicitudEstudioProyeccion']")
	    .html(function() {
		var $arr_result = ['<ul>'];
		
		$.each($prcObject.prc_solicitudEstudioProyeccion, function(i, y) {
		    $arr_result.push('<li>', '<strong><span class="text-info">', jQuery.trim(y.expl_codigo) + '</span></strong> ' + jQuery.trim(y.expl_nombre), '</li>');
		});
		
		$arr_result.push('</ul>');

                return $arr_result.join('');
            });
    $prcContent.find("[data-render-info='hipotesisDiagnostica']")
	    .html(simagdDescriptionFormatter($prcObject.prc_hipotesisDiagnostica, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idPrioridadAtencion']")
	    .html(jQuery.isEmptyObject($prcObject.prAtn_nombre) === false ? simagdPrioridadAtencionFormatter($prcObject.prAtn_nombre, $prcObject, $prcObject.prc_id) : '');
    $prcContent.find("[data-render-info='investigando']")
	    .html(simagdDescriptionFormatter($prcObject.prc_investigar, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='fechaProximaConsulta']")
	    .html(simagdDateFormatter($prcObject.prc_fechaProximaConsulta, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='justificacionMedica']")
	    .html(simagdDescriptionFormatter($prcObject.prc_justificacionMedica, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='requiereCita']")
	    .html(function() {
                var labelColor = $prcObject.prc_requiereCita === false ? 'success' : 'primary';
                var labelText = $prcObject.prc_requiereCita === false ? 'no' : 'sí';
                console.log($prcObject.prc_requiereCita, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='antecedentesClinicosRelevantes']")
	    .html(simagdDescriptionAdvanceFormatter($prcObject.prc_antecedentesClinicosRelevantes, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='requiereDiagnostico']")
	    .html(function() {
                var labelColor = $prcObject.prc_requiereDiagnostico === false ? 'warning' : 'success';
                var labelText = $prcObject.prc_requiereDiagnostico === false ? 'no' : 'sí';
                console.log($prcObject.prc_requiereDiagnostico, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='fechaCreacion']")
	    .html(simagdDateTimeFormatter($prcObject.prc_fechaCreacion, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idEstablecimientoDiagnosticante']")
	    .html(jQuery.isEmptyObject($prcObject.prc_diagnosticante) === false ? simagdDiagnosticanteFormatter($prcObject.prc_diagnosticante, $prcObject, $prcObject.prc_id) : '');
    $prcContent.find("[data-render-info='pacienteAmbulatorio']")
	    .html(function() {
                var labelColor = $prcObject.prc_pacienteAmbulatorio === false ? 'primary' : 'info';
                var labelText = $prcObject.prc_pacienteAmbulatorio === false ? 'no' : 'sí';
                console.log($prcObject.prc_pacienteAmbulatorio, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $prcContent.find("[data-render-info='justificacionDiagnostico']")
	    .html(simagdDescriptionFormatter($prcObject.prc_justificacionDiagnostico, $prcObject, $prcObject.prc_id));
    $prcContent.find("[data-render-info='idContactoPaciente']")
	    .html(jQuery.isEmptyObject($prcObject.prc_contactoPaciente) === false ? jQuery.trim($prcObject.prc_contactoPaciente) : '');
    $prcContent.find("[data-render-info='idFormaContacto']")
	    .html(jQuery.isEmptyObject($prcObject.prc_formaContacto) === false ? jQuery.trim($prcObject.prc_formaContacto) : '');
    $prcContent.find("[data-render-info='nombreContacto']")
	    .html(jQuery.trim($prcObject.prc_nombreContacto));
    $prcContent.find("[data-render-info='contacto']")
	    .html(jQuery.trim($prcObject.prc_contacto));
}

function ___actionCitaSetterObjectModalData(citId, $citObject, allow_userOverData) {
    moment.locale('es');
    var $citContent = $("#citaFullData-showModalContainer");
    
    $citContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($citObject.cit_empleado, {data_id_empUser: $citObject.cit_id_empleado}, $citObject.cit_id));
    $citContent.find("[data-render-info='idUserPrg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($citObject.cit_nombreUserReg) + ' <strong> (' + jQuery.trim($citObject.cit_usernameUserReg) + ') </strong>', {data_id_user: $citObject.cit_id_userReg}, $citObject.cit_id));
    $citContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($citObject.cit_tipoEmpleado));
    $citContent.find("[data-render-info='idUserReprg']")
	    .html(jQuery.isEmptyObject($citObject.cit_nombreUserMod) === false ?
                        simagdEmpleadoUserLoggedFormatter(jQuery.trim($citObject.cit_nombreUserMod) + ' <strong> (' + jQuery.trim($citObject.cit_usernameUserMod) + ') </strong>', {data_id_user: $citObject.cit_id_userMod}, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdEstabUserLoggedFormatter($citObject.cit_establecimiento, {data_id_estab: $citObject.cit_id_establecimiento}, $citObject.cit_id));
    $citContent.find("[data-render-info='idTecnologoProgramado']")
	    .html(jQuery.isEmptyObject($citObject.cit_tecnologo) === false ? simagdEmpleadoUserLoggedFormatter($citObject.cit_tecnologo, {data_id_empUser: $citObject.cit_id_tecnologo}, $citObject.cit_id) : '');
    $citContent.find("[data-render-info='fechaCreacion']")
	    .html(simagdDateTimeFormatter($citObject.cit_fechaCreacion, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='incidencias']")
	    .html(simagdDescriptionFormatter($citObject.cit_incidencias, $citObject, $citObject.cit_id));
//     $citContent.find("[data-render-info='fechaProgramada']")
// 	    .html(moment(jQuery.trim($citObject.cit_fechaProgramada), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A"));
    $citContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($citObject.cit_observaciones, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='idEstadoCita']")
	    .html(simagdEstadoCitaFormatter($citObject.cit_estado, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='razonAnulada']")
	    .html(simagdDescriptionFormatter($citObject.cit_razonAnulada, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='fechaConfirmacion']")
	    .html(jQuery.isEmptyObject($citObject.cit_fechaConfirmacion) === false ?
                        simagdDateTimeFormatter($citObject.cit_fechaConfirmacion, $citObject, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='necesitaAutorizacion']")
	    .html(function() {
                var labelColor = $citObject.cit_necesitaAutorizacion === false ? 'primary-v2' : 'warning';
                var labelText = $citObject.cit_necesitaAutorizacion === false ? 'no' : 'sí';
                console.log($citObject.cit_necesitaAutorizacion, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $citContent.find("[data-render-info='reprogramada']")
	    .html(function() {
                var labelColor = $citObject.cit_reprogramada === false ? 'primary-v2' : 'warning';
                var labelText = $citObject.cit_reprogramada === false ? 'no' : 'sí';
                console.log($citObject.cit_reprogramada, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $citContent.find("[data-render-info='citaAutorizada']")
	    .html(function() {
                var labelColor = $citObject.cit_citaAutorizada === false ? 'warning' : 'success-v2';
                var labelText = $citObject.cit_citaAutorizada === false ? 'no' : 'sí';
                console.log($citObject.cit_citaAutorizada, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
//     $citContent.find("[data-render-info='fechaProgramadaAnterior']")
// 	    .html(jQuery.isEmptyObject($citObject.cit_fechaProgramadaAnterior) === false ?
//                         moment(jQuery.trim($citObject.cit_fechaProgramadaAnterior), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A") : ''
//            );
    $citContent.find("[data-render-info='idResponsableAutoriza']")
	    .html(jQuery.isEmptyObject($citObject.cit_responsable) === false ? jQuery.trim($citObject.cit_responsable) : '');
    $citContent.find("[data-render-info='fechaReprogramacion']")
	    .html(jQuery.isEmptyObject($citObject.cit_fechaReprogramacion) === false ?
                        simagdDateTimeFormatter($citObject.cit_fechaReprogramacion, $citObject, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='nombreResponsableAutoriza']")
	    .html(jQuery.trim($citObject.cit_nombreResponsableAutoriza));
    $citContent.find("[data-render-info='fechaHoraInicio']")
	    .html(simagdDateTimeFormatter($citObject.cit_fechaHoraInicio, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='fechaHoraInicioAnterior']")
	    .html(jQuery.isEmptyObject($citObject.cit_fechaHoraInicioAnterior) === false ?
                        simagdDateTimeFormatter($citObject.cit_fechaHoraInicioAnterior, $citObject, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='fechaHoraFin']")
	    .html(simagdDateTimeFormatter($citObject.cit_fechaHoraFin, $citObject, $citObject.cit_id));
    $citContent.find("[data-render-info='fechaHoraFinAnterior']")
	    .html(jQuery.isEmptyObject($citObject.cit_fechaHoraFinAnterior) === false ?
                        simagdDateTimeFormatter($citObject.cit_fechaHoraFinAnterior, $citObject, $citObject.cit_id) : ''
           );
    $citContent.find("[data-render-info='diaCompleto']")
	    .html(function() {
                var labelColor = $citObject.cit_diaCompleto === false ? 'success-v2' : 'warning';
                var labelText = $citObject.cit_diaCompleto === false ? 'no' : 'sí';
                console.log($citObject.cit_diaCompleto, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $citContent.find("[data-render-info='color']")
	    .html(function() {
                var divColor = jQuery.trim($citObject.cit_color);
                console.log($citObject.cit_color, divColor);
                return '<div class="bloqueo-div-color" title="Color de fondo: ' + divColor + '" style="background-color: ' + divColor + '"> &nbsp; </div>';
            });
}

function ___actionProcedimientoRealizadoSetterObjectModalData(przId, $przObject, allow_userOverData) {
    moment.locale('es');
    var $przContent = $("#procedimientoRealizadoFullData-showModalContainer");

    $przContent.find("[data-render-info='origenSolicitud']")
	    .html(simagdTipoEstudioFormatter($przObject.solcmpl_id, $przObject, $przObject.prz_id));

    $przContent.find("[data-render-info='idCitaProgramada']")
	    .html(function() {
                var labelColor = jQuery.isEmptyObject($przObject.cit_id) === false ? 'primary' : 'info';
                var labelText = jQuery.isEmptyObject($przObject.cit_id) === false ? 'no' : 'sí';
                console.log(jQuery.isEmptyObject($przObject.cit_id), labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $przContent.find("[data-render-info='equipoUtilizado']")
	    .html(simagdDescriptionFormatter($przObject.prz_equipoUtilizado, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='idTecnologoProgramado']")
	    .html(jQuery.isEmptyObject($przObject.cit_id) === false && jQuery.isEmptyObject($przObject.cit_tecnologo) === false ? simagdEmpleadoUserLoggedFormatter($przObject.cit_tecnologo, {data_id_empUser: $przObject.cit_id_tecnologo}, $przObject.prz_id) : '');
    $przContent.find("[data-render-info='idTecnologoRealiza']")
	    .html(simagdEmpleadoUserLoggedFormatter($przObject.prz_tecnologo, {data_id_empUser: $przObject.prz_id_tecnologo}, $przObject.prz_id));
    $przContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($przObject.prz_tipoEmpleado));
    $przContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($przObject.prz_nombreUserReg) + ' <strong> (' + jQuery.trim($przObject.prz_usernameUserReg) + ') </strong>', {data_id_user: $przObject.prz_id_userReg}, $przObject.prz_id));
    $przContent.find("[data-render-info='hipotesisDiagnostica']")
	    .html(simagdDescriptionFormatter($przObject.prz_hipotesisDiagnostica, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='idUserMod']")
	    .html(jQuery.isEmptyObject($przObject.prz_nombreUserMod) === false ?
                        simagdEmpleadoUserLoggedFormatter(jQuery.trim($przObject.prz_nombreUserMod) + ' <strong> (' + jQuery.trim($przObject.prz_usernameUserMod) + ') </strong>', {data_id_user: $przObject.prz_id_userMod}, $przObject.prz_id) : ''
           );
    $przContent.find("[data-render-info='incidencias']")
	    .html(simagdDescriptionFormatter($przObject.prz_incidencias, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='idEstadoProcedimientoRealizado']")
	    .html(simagdEstadoEstudioFormatter($przObject.prz_estado, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='fechaNacimientoIndeterminada']")
	    .html(function() {
                var labelColor = $przObject.prz_fechaNacimientoIndeterminada === false ? 'primary' : 'danger';
                var labelText = $przObject.prz_fechaNacimientoIndeterminada === false ? 'no' : 'sí';
                console.log($przObject.prz_fechaNacimientoIndeterminada, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $przContent.find("[data-render-info='fechaRegistro']")
	    .html(simagdDateTimeFormatter($przObject.prz_fechaRegistro, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='fechaAtendido']")
	    .html(jQuery.isEmptyObject($przObject.prz_fechaAtendido) === false ?
                        simagdDateTimeFormatter($przObject.prz_fechaAtendido, $przObject, $przObject.prz_id) : ''
           );
    $przContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($przObject.prz_observaciones, $przObject, $przObject.prz_id));
    $przContent.find("[data-render-info='fechaRealizado']")
	    .html(jQuery.isEmptyObject($przObject.prz_fechaRealizado) === false ?
                        simagdDateTimeFormatter($przObject.prz_fechaRealizado, $przObject, $przObject.prz_id) : ''
           );
    $przContent.find("[data-render-info='fechaProcesado']")
	    .html(jQuery.isEmptyObject($przObject.prz_fechaProcesado) === false ?
                        simagdDateTimeFormatter($przObject.prz_fechaProcesado, $przObject, $przObject.prz_id) : ''
           );
    $przContent.find("[data-render-info='salaRealizado']")
	    .html(jQuery.trim($przObject.prz_salaRealizado));
    $przContent.find("[data-render-info='fechaAlmacenado']")
	    .html(jQuery.isEmptyObject($przObject.prz_fechaAlmacenado) === false ?
                        simagdDateTimeFormatter($przObject.prz_fechaAlmacenado, $przObject, $przObject.prz_id) : ''
           );
}

function ___actionSolicitudDiagnosticoSetterObjectModalData(soldiagId, $soldiagObject, allow_userOverData) {
    moment.locale('es');
    var $soldiagContent = $("#solicitudDiagnosticoFullData-showModalContainer");

    $soldiagContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($soldiagObject.soldiag_solicitante, {data_id_empUser: $soldiagObject.soldiag_id_solicitante}, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='fechaCreacion']")
	    .html(simagdDateTimeFormatter($soldiagObject.soldiag_fechaCreacion, $soldiagObject, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($soldiagObject.soldiag_tipoEmpleado));
    $soldiagContent.find("[data-render-info='justificacion']")
	    .html(simagdDescriptionFormatter($soldiagObject.soldiag_justificacion, $soldiagObject, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($soldiagObject.soldiag_nombreUserReg) + ' <strong> (' + jQuery.trim($soldiagObject.soldiag_usernameUserReg) + ') </strong>', {data_id_user: $soldiagObject.soldiag_id_userReg}, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='fechaProximaConsulta']")
	    .html(simagdDateFormatter($soldiagObject.soldiag_fechaProximaConsulta, $soldiagObject, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='solicitudRemota']")
	    .html(function() {
                var labelColor = $soldiagObject.soldiag_solicitudRemota === false ? 'primary' : 'info';
                var labelText = $soldiagObject.soldiag_solicitudRemota === false ? 'no' : 'sí';
                console.log($soldiagObject.soldiag_solicitudRemota, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $soldiagContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($soldiagObject.soldiag_observaciones, $soldiagObject, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='idEstablecimientoSolicitado']")
	    .html(simagdEstabUserLoggedFormatter($soldiagObject.soldiag_solicitado, {data_id_estab: $soldiagObject.soldiag_id_solicitado}, $soldiagObject.soldiag_id));
    $soldiagContent.find("[data-render-info='idEstudio']")
	    .html(function() {
                var estudioUrl = jQuery.trim($soldiagObject.est_url) || 'javascript:void(0)';/* Validar que exista idEstudio isEmptyObject */
                var allowDownload = allow_userOverData.allowDownloadEstudio === false ? ' disabled="disabled"' : '';
                console.log($soldiagObject.est_id, estudioUrl, allowDownload);
                return '<a title="Recuperar estudio de servidor PACS" target="_blank" class="btn btn-primary btn-sm" href="'
                            + estudioUrl + '"' + allowDownload + '> <i class="fa fa-eye"></i> Recuperar</a>';
            });
}

function ___actionNotaDiagnosticoSetterObjectModalData(notdiagId, $notdiagObject, allow_userOverData) {
    moment.locale('es');
    var $notdiagContent = $("#contenidoFullData-showModalContainer");

    $notdiagContent.find("[data-render-info='contenido']")
	    .html(simagdDescriptionAdvanceFormatter($notdiagObject.notdiag_contenido, $notdiagObject, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='idEmpleado']")
	    .html(simagdEmpleadoUserLoggedFormatter($notdiagObject.notdiag_emisorNota, {data_id_empUser: $notdiagObject.notdiag_id_emisorNota}, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($notdiagObject.notdiag_nombreUserReg) + ' <strong> (' + jQuery.trim($notdiagObject.notdiag_usernameUserReg) + ') </strong>', {data_id_user: $notdiagObject.notdiag_id_userReg}, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($notdiagObject.notdiag_tipoEmpleado));
    $notdiagContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdEstabUserLoggedFormatter($notdiagObject.notdiag_stdEmisor, {data_id_estab: $notdiagObject.notdiag_id_stdEmisor}, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='idTipoNotaDiagnostico']")
	    .html(jQuery.trim($notdiagObject.notdiag_tipoNota));
    $notdiagContent.find("[data-render-info='fechaEmision']")
	    .html(simagdDateTimeFormatter($notdiagObject.notdiag_fechaEmision, $notdiagObject, $notdiagObject.notdiag_id));
    $notdiagContent.find("[data-render-info='observaciones']")
	    .html(simagdDescriptionFormatter($notdiagObject.notdiag_observaciones, $notdiagObject, $notdiagObject.notdiag_id));
}

function ___actionBloqueoAgendaSetterObjectModalData(blAgdId, $blAgdObject, allow_userOverData) {
    moment.locale('es');
    var $blAgdContent = $("#bloqueoAgendaFullData-showModalContainer");
    
    $blAgdContent.find("[data-render-info='idEstablecimiento']")
	    .html(simagdEstabUserLoggedFormatter($blAgdObject.blAgd_establecimiento, {data_id_estab: $blAgdObject.blAgd_id_establecimiento}, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='idEmpleadoRegistra']")
	    .html(simagdEmpleadoUserLoggedFormatter($blAgdObject.blAgd_empleado, {data_id_empUser: $blAgdObject.blAgd_id_empleado}, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='idUserReg']")
	    .html(simagdEmpleadoUserLoggedFormatter(jQuery.trim($blAgdObject.blAgd_nombreUserReg) + ' <strong> (' + jQuery.trim($blAgdObject.blAgd_usernameUserReg) + ') </strong>', {data_id_user: $blAgdObject.blAgd_id_userReg}, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='idUserMod']")
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_nombreUserMod) === false ?
                        simagdEmpleadoUserLoggedFormatter(jQuery.trim($blAgdObject.blAgd_nombreUserMod) + ' <strong> (' + jQuery.trim($blAgdObject.blAgd_usernameUserMod) + ') </strong>', {data_id_user: $blAgdObject.blAgd_id_userMod}, $blAgdObject.blAgd_id) : ''
           );
    $blAgdContent.find("[data-render-info='titulo']")
	    .html(jQuery.trim($blAgdObject.blAgd_titulo));
    $blAgdContent.find("[data-render-info='fechaCreacion']")
	    .html(simagdDateTimeFormatter($blAgdObject.blAgd_fechaCreacion, $blAgdObject, $blAgdObject.blAgd_id));
    /* Al momento de crear o editar en controller una cita o bloqueo, si el color va null, no setear para que tome el default */
    $blAgdContent.find("[data-render-info='color']")
	    .html(function() {
                var divColor = jQuery.trim($blAgdObject.blAgd_color);
                console.log($blAgdObject.blAgd_color, divColor);
                return '<div class="bloqueo-div-color" title="Color de fondo: ' + divColor + '" style="background-color: ' + divColor + '"> &nbsp; </div>';
            });
    $blAgdContent.find("[data-render-info='fechaUltimaEdicion']")
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_fechaUltimaEdicion) === false ?
                        simagdDateTimeFormatter($blAgdObject.blAgd_fechaUltimaEdicion, $blAgdObject, $blAgdObject.blAgd_id) : ''
           );
    $blAgdContent.find("[data-render-info='fechaInicio']")
	    .html(simagdDateFormatter($blAgdObject.blAgd_fechaInicio, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='horaInicio']")
	    .html(simagdTimeFormatter($blAgdObject.blAgd_horaInicio, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='fechaFin']")
	    .html(simagdDateFormatter($blAgdObject.blAgd_fechaFin, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='horaFin']")
	    .html(simagdTimeFormatter($blAgdObject.blAgd_horaFin, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='diaCompleto']")
	    .html(function() {
                var labelColor = $blAgdObject.blAgd_diaCompleto === false ? 'success-v2' : 'warning';
                var labelText = $blAgdObject.blAgd_diaCompleto === false ? 'no' : 'sí';
                console.log($blAgdObject.blAgd_diaCompleto, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $blAgdContent.find("[data-render-info='descripcion']")
	    .html(simagdDescriptionFormatter($blAgdObject.blAgd_descripcion, $blAgdObject, $blAgdObject.blAgd_id));
    $blAgdContent.find("[data-render-info='idRadiologoBloqueo']")
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_radiologo) === false ? simagdEmpleadoUserLoggedFormatter($blAgdObject.blAgd_radiologo, {data_id_empUser: $blAgdObject.blAgd_id_radiologo}, $blAgdObject.blAgd_id) : '');
    $blAgdContent.find("[data-render-info='idAreaServicioDiagnostico']")
	    .html(jQuery.isEmptyObject($blAgdObject.blAgd_modalidad) === false ? jQuery.trim($blAgdObject.blAgd_modalidad) : '');
    /* Falta el tipo empleado en twig */
    $blAgdContent.find("[data-render-info='idTipoEmpleado']")
	    .html(jQuery.trim($blAgdObject.blAgd_tipoEmpleado));
}

function ___actionPacienteSetterObjectModalData(pctId, $expObject, $pctObject, allow_userOverData) {
    moment.locale('es');
    var $pctContent = $("#pacienteFullData-showModalContainer");
    var isEmptyExp = jQuery.isEmptyObject($expObject);
    
    $pctContent.find("[data-render-info='numero']")
	    .html(isEmptyExp === false ? jQuery.trim($expObject.numero) : '');
    $pctContent.find("[data-render-info='nombrePadre']")
	    .html(jQuery.trim($pctObject.nombrePadre));
    $pctContent.find("[data-render-info='habilitado']")
	    .html(function() {
                var spanExp = '';
                if (isEmptyExp === false) {
		    var labelColor = $expObject.habilitado === false ? 'danger' : 'primary';
		    var labelText = $expObject.habilitado === false ? 'no' : 'sí';
		    var spanExp = '<span class="label label-' + labelColor + '">' + labelText + '</span>'; 
		    console.log($expObject.habilitado, labelColor, labelText);
                }
                console.log(spanExp);
                return spanExp;
            });
    $pctContent.find("[data-render-info='nombreMadre']")
	    .html(jQuery.trim($pctObject.nombreMadre));
    $pctContent.find("[data-render-info='fechaCreacion']")
	    .html(function() {
		var fechaHoraCreacionExp = jQuery.trim($expObject.fechaCreacion + ' ' + $expObject.horaCreacion);
                console.log('fechaHoraCreacionExp: ' + fechaHoraCreacionExp);
                return isEmptyExp === false && fechaHoraCreacionExp ?
                        moment(fechaHoraCreacionExp, "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A")
			  : '';
            });
    $pctContent.find("[data-render-info='nombreResponsable']")
	    .html(jQuery.trim($pctObject.nombreResponsable));
    $pctContent.find("[data-render-info='nombre']")
	    .html(jQuery.trim($pctObject.nombre));
    $pctContent.find("[data-render-info='fechaRegistro']")
	    .html(jQuery.isEmptyObject($pctObject.fechaRegistro) === false ?
                        moment(jQuery.trim($pctObject.fechaRegistro.date), "YYYY-MM-DD HH:mm:ss").format("dddd, MMMM D YYYY, h:mm:ss A") : ''
           );
    $pctContent.find("[data-render-info='fechaNacimiento']")
	    .html(jQuery.isEmptyObject($pctObject.fechaNacimiento) === false ?
                        moment(jQuery.trim($pctObject.fechaNacimiento.date + ' ' + $pctObject.horaNacimiento.date), "YYYY-MM-DD HH:mm:ss")
			    .format("dddd, MMMM D YYYY, h:mm:ss A") : ''
           );
    $pctContent.find("[data-render-info='idOcupacion']")
	    .html(jQuery.isEmptyObject($pctObject.idOcupacion) === false ? jQuery.trim($pctObject.idOcupacion.nombre) : '');
    $pctContent.find("[data-render-info='numeroDocIdePaciente']")
	    .html(jQuery.trim($pctObject.numeroDocIdePaciente));
    $pctContent.find("[data-render-info='idNacionalidad']")
	    .html(jQuery.isEmptyObject($pctObject.idNacionalidad) === false ? jQuery.trim($pctObject.idNacionalidad.nacionalidad) : '');
    $pctContent.find("[data-render-info='direccion']")
	    .html(jQuery.trim($pctObject.direccion));
    $pctContent.find("[data-render-info='idParentescoResponsable']")
	    .html(jQuery.isEmptyObject($pctObject.idParentescoResponsable) === false ? jQuery.trim($pctObject.idParentescoResponsable.parentesco) : '');
    $pctContent.find("[data-render-info='telefonoCasa']")
	    .html(jQuery.trim($pctObject.telefonoCasa));
    $pctContent.find("[data-render-info='idSexo']")
	    .html(jQuery.isEmptyObject($pctObject.idSexo) === false ? jQuery.trim($pctObject.idSexo.nombre) : 'No definido');
    $pctContent.find("[data-render-info='lugarTrabajo']")
	    .html(jQuery.trim($pctObject.lugarTrabajo));
    $pctContent.find("[data-render-info='idMunicipioNacimiento']")
	    .html(jQuery.isEmptyObject($pctObject.idMunicipioNacimiento) === false ? jQuery.trim($pctObject.idMunicipioNacimiento.nombre) : '');
    $pctContent.find("[data-render-info='asegurado']")
	    .html(function() {
                var labelColor = $pctObject.asegurado === false ? 'warning' : 'primary';
                var labelText = $pctObject.asegurado === false ? 'no' : 'sí';
                console.log($pctObject.asegurado, labelColor, labelText);
                return '<span class="label label-' + labelColor + '">' + labelText + '</span>';
            });
    $pctContent.find("[data-render-info='idMunicipioDomicilio']")
	    .html(jQuery.isEmptyObject($pctObject.idMunicipioDomicilio) === false ? jQuery.trim($pctObject.idMunicipioDomicilio.nombre) : '');
    $pctContent.find("[data-render-info='numeroAfiliacion']")
	    .html(jQuery.trim($pctObject.numeroAfiliacion));
    $pctContent.find("[data-render-info='idEstadoCivil']")
	    .html(jQuery.isEmptyObject($pctObject.idEstadoCivil) === false ? jQuery.trim($pctObject.idEstadoCivil.nombre) : '');
}