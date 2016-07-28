/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



jQuery(document).ready(function() {
        
    /** select2 */
    $("select[id='report_format']").select2({
        placeholder: 'Formato',
        allowClear: true,
        dropdownAutoWidth : true
    });
    $("select[id='limite_resultados']").select2({
        placeholder: 'Límite',
        allowClear: true,
        dropdownAutoWidth : true
    });
    
    /** datetimepicker */
    var busqPctParamOptions = { inputType: 'date' };
    $("input[id^='fechaIni'], input[id^='fechaFin']").createSimagdDateTimePicker(busqPctParamOptions);
    $("input[id^='fechaIni'], input[id^='fechaFin']").datetimepicker('option', {
                                                        setDate : new Date(),
                                                        minDate: null,
                                                        maxDate: 0,
                                                        yearRange: '-100:+0',
                                                    });

    $("input[id^='fechaIni'], input[id^='fechaFin']").each(function() {

        jQuery(this).wrap("<div class='input-group'></div>");
        jQuery(this).before(" <span class='input-group-btn'> <button class='reportDatepickerShow demo btn btn-primary-v2 btn-outline btn-large'> <i class='glyphicon glyphicon-calendar'></i> </button> </span>");
	
    });

    $(document).on('click', ".reportDatepickerShow", function(e) {
        e.preventDefault();

        jQuery(this).closest("div").find("input[id^='fecha']").datepicker('show');
        console.log('Datetimepicker displayed');
    });

    $(document).on('change', "input[id='fechaIni_1'], input[id='fechaFin_1']", function(e) {
        $("form[id='formPacientesAtendidos']").formValidation('revalidateField', 'fechaIni_1');
        $("form[id='formPacientesAtendidos']").formValidation('revalidateField', 'fechaFin_1');
    });
    $(document).on('change', "input[id='fechaIni_2'], input[id='fechaFin_2']", function(e) {
        $("form[id='formPacientesAtendidosMedico']").formValidation('revalidateField', 'fechaIni_2');
        $("form[id='formPacientesAtendidosMedico']").formValidation('revalidateField', 'fechaFin_2');
    });
    $(document).on('change', "input[id='fechaIni_3'], input[id='fechaFin_3']", function(e) {
        $("form[id='formExamenesRealizados']").formValidation('revalidateField', 'fechaIni_3');
        $("form[id='formExamenesRealizados']").formValidation('revalidateField', 'fechaFin_3');
    });
    $(document).on('change', "input[id='fechaIni_4'], input[id='fechaFin_4']", function(e) {
        $("form[id='formExamenesRealizadosModalidad']").formValidation('revalidateField', 'fechaIni_4');
        $("form[id='formExamenesRealizadosModalidad']").formValidation('revalidateField', 'fechaFin_4');
    });
    $(document).on('change', "input[id='fechaIni_5'], input[id='fechaFin_5']", function(e) {
        $("form[id='formExamenesRealizadosPaciente']").formValidation('revalidateField', 'fechaIni_5');
        $("form[id='formExamenesRealizadosPaciente']").formValidation('revalidateField', 'fechaFin_5');
    });
    $(document).on('change', "input[id='fechaIni_6'], input[id='fechaFin_6']", function(e) {
        $("form[id='formExamenesRealizadosTecnologo']").formValidation('revalidateField', 'fechaIni_6');
        $("form[id='formExamenesRealizadosTecnologo']").formValidation('revalidateField', 'fechaFin_6');
    });
    $(document).on('change', "input[id='fechaIni_7'], input[id='fechaFin_7']", function(e) {
        $("form[id='formEstudiosSolicitadosMedicoModalidad']").formValidation('revalidateField', 'fechaIni_7');
        $("form[id='formEstudiosSolicitadosMedicoModalidad']").formValidation('revalidateField', 'fechaFin_7');
    });
    $(document).on('change', "input[id='fechaIni_8'], input[id='fechaFin_8']", function(e) {
        $("form[id='formEstudiosDiagnosticadosRadiologoModalidad']").formValidation('revalidateField', 'fechaIni_8');
        $("form[id='formEstudiosDiagnosticadosRadiologoModalidad']").formValidation('revalidateField', 'fechaFin_8');
    });
    $(document).on('change', "input[id='fechaIni_9'], input[id='fechaFin_9']", function(e) {
        $("form[id='formPacientesAtendidosTecnologoModalidad']").formValidation('revalidateField', 'fechaIni_9');
        $("form[id='formPacientesAtendidosTecnologoModalidad']").formValidation('revalidateField', 'fechaFin_9');
    });

//    $("form[id='formPacientesAtendidos']").data('formValidation').resetForm();
    
    /** Enviar datos al Action */
    $("a[id='iniciar-generar-reporte']:not([disabled])").click(function(e) {
        
        e.preventDefault();
        
        var activeTabPane = $("div.tab-pane.active");
        var activeForm = activeTabPane.find('form');
        activeForm.submit();

        console.log(activeForm.attr('id'));
        
    });
    
});