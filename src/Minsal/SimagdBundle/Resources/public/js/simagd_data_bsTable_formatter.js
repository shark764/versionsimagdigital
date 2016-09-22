/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function simagdDateTimeFormatter(value, row, index) {
    moment.locale('es');
    
    var dtFormatter = moment(jQuery.trim(value), "YYYY-MM-DD HH:mm:ss");
    
    return dtFormatter.isValid() !== false ?
	      dtFormatter.format("dddd, MMMM D YYYY, h:mm:ss A") : '';
}

function simagdDateFormatter(value, row, index) {
    moment.locale('es');
    
    var dFormatter = moment(jQuery.trim(value), "YYYY-MM-DD");
    
    return dFormatter.isValid() !== false ?
	      dFormatter.format("dddd, MMMM D YYYY") : '';
}

function simagdTimeFormatter(value, row, index) {
    moment.locale('es');
    
    var tFormatter = moment(jQuery.trim(value), "HH:mm:ss");
    
    return tFormatter.isValid() !== false ?
	      tFormatter.format("h:mm:ss A") : '';
}

function simagdOrigenFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.prc_id_origen === $id_userEstab || row.prc_id_origen === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEmpleadoUserLoggedFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.data_id_empUser === $id_emp_userLogged || row.data_id_empUser === $id_emp_userLogged.toString()
            || row.data_id_user === $id_userLogged || row.data_id_user === $id_userLogged.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Usuario logueado]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdPacienteFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (!jQuery.isEmptyObject(row.explocal_id)) {
        $return     = [
//            '<span style="color:#838383;">',
	    '<span class="label label-element-v2">',
                '[' + row.explocal_numero + ']',
            '</span>',
            '  ',
            $return
        ].join('');
    }
    
    if (row.unknExp_id !== null && row.unknExp_id !== '') {
        $return     = [
	    '<span class="label label-danger">',
                '[' + row.unknExp_numero + ']',
            '</span>',
            '  ',
            row.unknExp_nombreFicticio
        ].join('');
    }
    
    return $return;
}

function simagdAreaAtencionFormatter(value, row, index) {
    var $style = row.prc_id_areaAtencion === 2 || row.prc_id_areaAtencion === '2' ?
                        'danger' : ( row.prc_id_areaAtencion === 3 || row.prc_id_areaAtencion === '3' ?
                                        'success-v3' : 'primary-v4' );
    
    var $return     = [
        '<span class=\'label label-' + $style + '\'>',
            jQuery.trim(value),
        '</span>'
    ].join('');
    
    return $return;
}

function simagdReferidoFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.prc_id_referido === $id_userEstab || row.prc_id_referido === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdDiagnosticanteFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.prc_id_diagnosticante === $id_userEstab || row.prc_id_diagnosticante === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEstablecimientoFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.alias_id_establecimiento === $id_userEstab || row.alias_id_establecimiento === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEstadoDiagnosticoFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (jQuery.trim(row.diag_codEstado) === 'APR') {
        $return     = [
            '<span class="text-primary-v4">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.diag_codEstado) === 'IMP') {
        $return     = [
            '<span class="text-danger">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-remove-sign">',
                '</i>',
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.diag_codEstado) === 'CRG') {
        $return     = [
            '<span class="text-success-v3">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-exclamation-sign">',
                '</i>',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEstadoLecturaFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (jQuery.trim(row.lct_codEstado) === 'LDO') {
        $return     = [
            '<span class="text-primary-v4">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdTipoEstudioFormatter(value, row, index) {
    var ___isCmpl = !jQuery.isEmptyObject(row.solcmpl_id);
    
    return [
        '<span class="label label-' + (___isCmpl === false ? 'primary-v4' : 'success-v3') + '">',
        (___isCmpl === false ? 'Solicitado' : 'Adicional'),
        '</span>'
    ].join('');
}

function simagdEstadoEstudioFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    var ___isCmpl   = !jQuery.isEmptyObject(row.solcmpl_id);
    
    if (jQuery.trim(row.prz_codEstado) === 'ALM') {
        $return     = [
            '<span class="text-' + (___isCmpl === false ? 'primary-v4' : 'success-v3') + '">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdSolicitanteEstudioFormatter(value, row, index) {
    var ___isCmpl = !jQuery.isEmptyObject(row.solcmpl_id);
    return ___isCmpl === false ? row.prc_solicitante : '<span style="color:#838383;">' + row.solcmpl_solicitante + '</span>';
}

function simagdModalidadSolicitadaFormatter(value, row, index) {
    var ___isCmpl = !jQuery.isEmptyObject(row.solcmpl_id);
    return ___isCmpl === false ? row.prc_modalidad : '<span style="color:#838383;">' + row.solcmpl_modalidad + '</span>';
}

function simagdDescriptionFormatter(value, row, index) {
    return [
        '<pre class="pre-display-code-natural">',
            jQuery.trim(value),
        '</pre>'
    ].join('');
}

function simagdDescriptionAdvanceFormatter(value, row, index) {
    return [
        '<pre class="pre-display-code-no-natural">',
            jQuery.trim(value),
        '</pre>'
    ].join('');
}

function simagdDescriptionAdvanceNoScrollFormatter(value, row, index) {
    return [
        '<pre class="pre-display-code-no-natural pre-unlimited-height">',
            jQuery.trim(value),
        '</pre>'
    ].join('');
}

function simagdEstabUserLoggedFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (row.data_id_estab === $id_userEstab || row.data_id_estab === $id_userEstab.toString()) {
        $return     = [
            $return,
            ' ',
            '<span class="label label-element-v2">',
                '[Servicio local]',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdEstadoCitaFormatter(value, row, index) {
    var $return     = jQuery.trim(value);
    
    if (jQuery.trim(row.cit_codEstado) === 'CNF') {
        $return     = [
            '<span class="text-primary-v4">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-ok-sign">',
                '</i>',
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.cit_codEstado) === 'ANL') {
        $return     = [
            '<span class="text-danger">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-remove-sign">',
                '</i>',
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.cit_codEstado) === 'CNL') {
        $return     = [
            '<span class="text-warning">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-remove-sign">',
                '</i>',
            '</span>'
        ].join('');
    } else if (jQuery.trim(row.cit_codEstado) === 'ESP') {
        $return     = [
            '<span class="text-element-v2">',
                $return,
                '  ',
                '<i class="glyphicon glyphicon-tags">',
                '</i>',
            '</span>'
        ].join('');
    }
    
    return $return;
}

function simagdPrioridadAtencionFormatter(value, row, index) {
    var $pr_defaultClass    = jQuery.isEmptyObject(row.prAtn_estiloPresentacion) === false ? row.prAtn_estiloPresentacion : 'primary-v4';
    
    return [
        '<span class=\'label label-' + $pr_defaultClass + '\'>',
            jQuery.trim(value),
        '</span>'
    ].join('');
}

function simagdTipoNotaFormatter(value, row, index) {
    var $tipoN_class = 'primary-v4';
    
    switch (row.notdiag_codTipo) {
        case 'ACR':
        case 'FVR':
        default:
            $tipoN_class = 'primary-v4';
            break;
        case 'ICM':
        case 'AGR':
        case 'ACL':
            $tipoN_class = 'element-v2';
            break;
        case 'INF':
        case 'DSR':
            $tipoN_class = 'warning';
            break;
        case 'IMP':
            $tipoN_class = 'danger';
            break;
    }
    
    return [
	'<span class=\'label label-' + $tipoN_class + '\'>',
	    jQuery.trim(value),
	'</span>'
    ].join('');
}

function estadoSolicitudFormatter(value, row, index) {
    var $statusSc_class = 'primary-v4';
    
    switch (row.statusSc_codigo) {
        case 'SCR':
        case 'CIT':
        case 'CCN':
        default:
            $statusSc_class = 'primary-v4';
            break;
        case 'PRZ':
        case 'EAP':
            $statusSc_class = 'success-v3';
            break;
        case 'EIR':
        case 'LTR':
        case 'DTR':
        case 'DAP':
            $statusSc_class = 'element-v2';
            break;
        case 'CRP':
            $statusSc_class = 'warning';
            break;
        case 'CCL':
        case 'SRZ':
            $statusSc_class = 'danger';
            break;
    }
    
    return [
	'<span class=\'label label-' + $statusSc_class + '\'>',
	    jQuery.trim(row.statusSc_nombreEstado),
	'</span>'
    ].join('');
}


/*
 * ******************************************************************************
 * Métodos para full-entity
 * ******************************************************************************
 */

function simagdPacienteDesconocidoFormatter(value, row, index) {
    var $text   = row.prc_pacienteDesconocido === false ? 'no' : 'sí';
    var $style  = row.prc_pacienteDesconocido === false ? 'primary-v4' : 'warning';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdPacienteReferidoFormatter(value, row, index) {
    var $text   = row.prc_referirPaciente === false ? 'no' : 'sí';
    var $style  = row.prc_referirPaciente === false ? 'primary-v4' : 'info';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdRequiereDiagnosticoFormatter(value, row, index) {
    var $text   = row.prc_requiereDiagnostico === false ? 'no' : 'sí';
    var $style  = row.prc_requiereDiagnostico === false ? 'warning' : 'success-v3';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdPacienteAmbulatorioFormatter(value, row, index) {
    var $text   = row.prc_pacienteAmbulatorio === false ? 'no' : 'sí';
    var $style  = row.prc_pacienteAmbulatorio === false ? 'primary-v4' : 'info';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdRequiereCitaFormatter(value, row, index) {
    var $text   = row.prc_requiereCita === false ? 'no' : 'sí';
    var $style  = row.prc_requiereCita === false ? 'success-v3' : 'primary-v4';
    
    var $return = [
        '<span class=\'label label-' + $style + '\'>',
            $text,
        '</span>'
    ].join('');
    
    return $return;
}

function simagdAreaServicioDiagnosticoFormatter(value, row, index) {
    return [
        '<span class=\'label label-element-v2\'>',
	    jQuery.trim(value),
        '</span>'
    ].join('');
}

function simagdSolicitudEstudioProyeccionFormatter(value, row, index) {
    var $arr_result = ['<ul>'];
    $.each(row.prc_solicitudEstudioProyeccion, function(i, y) {
        $arr_result.push('<li>', '<strong><span class="text-info">', jQuery.trim(y.expl_codigo) + '</span></strong> ' + jQuery.trim(y.expl_nombre), '</li>');
    });
    $arr_result.push('</ul>');

    return $arr_result.join('');
}