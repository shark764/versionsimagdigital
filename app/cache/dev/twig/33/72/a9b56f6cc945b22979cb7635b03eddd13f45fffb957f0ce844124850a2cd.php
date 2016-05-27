<?php

/* MinsalCitasBundle:Custom:index.html.twig */
class __TwigTemplate_3372a9b56f6cc945b22979cb7635b03eddd13f45fffb957f0ce844124850a2cd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'notice' => array($this, 'block_notice'),
            'content' => array($this, 'block_content'),
            'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalcitas/css/CitasBundle.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        // line 12
        echo "\t";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
        var modal_elements = [];
\t\tvar cit_info = [];
\t\tvar clickDay;

        function getMedicData() {
            var idEmpleado = \"\";
            var nombreEmpleado = \"\";
            var idEmpleadoEspecialidadEstab = \"\";

            ";
        // line 23
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true) && ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED"))) {
            // line 24
            echo "                idEmpleado     = '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId"), "html", null, true);
            echo "';
                nombreEmpleado = '";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getNombreempleado"), "html", null, true);
            echo "';
                idEmpleadoEspecialidadEstab = '";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idEmpEspecialidadEstab"), "method"), "html", null, true);
            echo "';
            ";
        } else {
            // line 28
            echo "                if(\$('#idEmpleado').select2('data') != null) {
                    idEmpleado     = \$('#idEmpleado').select2('data').id;
                    nombreEmpleado = \$('#idEmpleado').select2('data').text;
                }

                if(\$('#idEmpleadoEspecialidadEstab').select2('data') != null) {
                    idEmpleadoEspecialidadEstab = \$('#idEmpleadoEspecialidadEstab').select2('data').id;
                }
            ";
        }
        // line 37
        echo "
            return {'idEmpleado': idEmpleado, 'nombreEmpleado': nombreEmpleado, 'idEmpleadoEspecialidadEstab': idEmpleadoEspecialidadEstab};
        }

\t\tfunction pushModalElement(newId, callFunction, parameters_func) {
\t\t\tmodalElmentFound = 0;
\t\t\tif(modal_elements.length != 0) {
\t\t\t\tfor (var i in modal_elements) {
\t\t\t\t\tif (modal_elements[i].id == newId) {
\t\t\t\t\t\tmodalElmentFound = modalElmentFound + 1;
\t\t\t\t\t}
\t\t\t\t}
\t\t\t}

\t\t\tif(modalElmentFound == 0) {
                var foot = \"\";

                ";
        // line 54
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CREATE"), "method") || $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_CITCITASDIA_CREATE"), "method"))) {
            // line 55
            echo "                    if(parameters_func.type == 4 || parameters_func.type == 5) {
                        foot = '<button id=\"cita_submit\" name=\"cita_submit\" value=\"cita_submit\" class=\"btn btn-primary\" form=\"cita_submit_form\"><span class=\"label\"><span class=\"glyphicon glyphicon-plus-sign\"></span> Crear Cita</span></button>';
                    }
                ";
        }
        // line 59
        echo "
\t\t\t\tmodal_elements.push({
\t\t\t\t\tid: newId,
\t\t\t\t\tfunc: callFunction,
\t\t\t\t\theader: 'Agenda M&eacute;dica',
\t\t\t\t\tfooter: foot,
\t\t\t\t\twidthModal: 750,
\t\t\t\t\tparameters: parameters_func
\t\t\t\t});
\t\t\t}
\t\t}

\t\tfunction updateMonthIformationCit() {
\t\t\tvar calendarDate = \$('#calendar-holder').fullCalendar('getDate');
\t\t\t    calendarDate.setHours(0,0,0,0);
            var medicData = getMedicData();
\t\t\tjQuery.ajax({
\t\t\t    url: Routing.generate('citasdiaxmedico') + '?idEmpleado='+medicData.idEmpleado+'&idEmpleadoEspecialidadEstab='+medicData.idEmpleadoEspecialidadEstab+'&calendarDate='+calendarDate,
\t\t\t    async: false,
\t\t\t    dataType: 'json',
\t\t\t    success: function(data) {
\t\t\t    \tcit_info[0] = data.data1;
\t\t\t    \tcit_info[1] = data.data2;
\t\t\t    \tcit_info[2] = data.data3;
\t\t\t    }
            });
\t\t}

\t\tfunction getIndexOfK(arr, date){
\t\t    for(var i=0; i<arr.length; i++){
\t\t    \tvar array_date = new Date(arr[i].date+' 00:00:00'); \t// YYYY/MM/DD formato soportado para FF, GC, y IC
\t\t    \tif (date.getDate() === array_date.getDate() && date.getMonth() === array_date.getMonth() && date.getFullYear() === array_date.getFullYear()) {
\t\t    \t\treturn i;
\t\t    \t}
\t\t    }
\t\t    return -1;
\t\t}
    </script>
\t<script type=\"text/javascript\">
\t\tfunction agendaMedica(parameters) {
\t\t\tvar options = {weekday: \"long\", year: \"numeric\", month: \"long\", day: \"numeric\"};
            var medicData = getMedicData();
\t\t\tvar header = '\\
\t\t\t\t<div id=\"cm-modal\">\\
\t\t\t\t\t<center>\\
\t\t\t\t\t<div class=\"custom-modal-header\">\\
                        <form id=\"cita_submit_form\" onsubmit=\"return validate_form();\" action=\"";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
        echo "\" method=\"POST\">\\
                            <table>\\
                                <tr><td rowspan=\"2\" style=\"text-align:center;\">'+medicData.nombreEmpleado+'<br />'+parameters['date'].toLocaleString(\"es-SV\", options).replace(' 00:00:00 CST','')+'</td><td id=\"horario-atencion\"></td></tr>\\
                                <tr><td id=\"num_exp_nom_paciente\"></td></tr>\\
                            </table>\\
                        <input type=\"hidden\" id=\"idEmpleado\" name=\"idEmpleado\" value=\"'+medicData.idEmpleado+'\" />\\
                        <input type=\"hidden\" id=\"idEmpleadoEspecialidadEstab\" name=\"idEmpleadoEspecialidadEstab\" value=\"'+medicData.idEmpleadoEspecialidadEstab+'\" />\\
                        <input type=\"hidden\" id=\"date\" name=\"date\" value=\"'+clickDay+'\" />\\
                        </form>\\
\t\t\t\t\t</div>\\
\t\t\t\t\t</center>\\
\t\t\t\t<div>';
\t\t\tif(\$('#cm-modal'.length != 0)) {
\t\t\t\t\$('#cm-modal').remove();
\t\t\t}
\t\t\t\$('#myModalLabel').after(header);
\t\t\t//\$('#myModal').css('top','40%');
\t\t\t\$('#myModalLabel').css('color','#5bc0de');
\t\t\t\$('#myModalLabel').css('text-align','center');
\t\t\t\$('div.modal-body').css('background-color','#f7f7f9');
\t\t\t\$('div.modal-footer').css('background-color','#ffffff');
\t\t\thtml = \"\";
\t\t\tswitch(parameters['type']) {
\t\t\t\tcase 1:
\t\t\t\t\thtml =  '<div class=\"alert alert-block alert-info\">\\
\t\t\t\t\t\t\t\t<h4>D&iacute;a No Disponible</h4>\\
\t\t\t\t\t\t\t\tEl m&eacute;dico no posee un horario de atenci&oacute;n de pacientes para la fecha seleccionadad, motivo por el cual <b>no es posible asignar citas</b>...\\
\t\t\t\t\t\t   \t</div>';
\t\t\t\tbreak;
\t\t\t\tcase 2:
\t\t\t\t\thtml =  '<div class=\"alert alert-block alert-info\">\\
\t\t\t\t\t\t\t\t<h4>D&iacute;a Bloqueado</h4>\\
\t\t\t\t\t\t\t\t<b>no es posible asignar citas</b>...\\
\t\t\t\t\t\t   \t</div>';
\t\t\t\tbreak;
\t\t\t\tcase 3:
\t\t\t\t\thtml = '<div class=\"alert alert-block alert-warning\">\\
\t\t\t\t\t\t\t\t<h4>Dia Inhabilitado</h4>\\
\t\t\t\t\t\t\t\tDia inhabilitado por las Fiestas, <b>no es posible asignar citas</b>...\\
\t\t\t\t\t\t\t</div>';
\t\t\t\tbreak;
\t\t\t\tcase 4:
\t\t\t\t\thtml = '<div class=\"alert alert-info\">\\
\t\t\t\t\t\t\t\t<b>Algunos horarios de atenci&oacute;n no estan disponibles debido a que han sido bloqueados por el m&eacute;dico</b>...\\
\t\t\t\t\t\t   \t</div>';
\t\t\t\t\thtml = html + buildAgendaMedica(parameters);
\t\t\t\tbreak;
\t\t\t\tcase 5:
\t\t\t\t\thtml = buildAgendaMedica(parameters);
\t\t\t\tbreak;
\t\t\t\tcase 6:
\t\t\t\t\thtml = '<div class=\"alert alert-block alert-info\">\\
\t\t\t\t\t\t\t\t<h4>Dia Inhabilitado</h4>\\
\t\t\t\t\t\t\t\tEl dia seleccionado es anterior a la fecha actual, motivo por el cual <b>no es posible asignar citas</b>...\\
\t\t\t\t\t\t\t</div>';
\t\t\t\tbreak;
\t\t\t}
\t\t\treturn html;
\t\t}

\t\tfunction buildAgendaMedica(parameters) {
\t\t\tvar content = \"\";
            var medicData = getMedicData();

\t\t\t\$(\"#horario-atencion\").empty();
\t\t\t\$(\"#horario-atencion\").append('Horario de Atencion de Pacientes<br /><select id=\"horarioMedico\" name=\"horarioMedico\"></select>');
            \$(\"#num_exp_nom_paciente\").empty();
\t\t\t\$(\"#num_exp_nom_paciente\").append('No. Expedinte - Nombre Paciente<br /><input type=\"hidden\" id=\"numExpNomPac\" name=\"numExpNomPac\" style=\"width:203px !important;\"></input>');

\t\t\t\$field = \$('#horarioMedico');
            \$field.select2({
                allowClear: false,
                width: \t \t'100%'
            });

            \$field2 = \$('#numExpNomPac');
            \$field2.select2({
                allowClear: true,
                placeholder: 'Seleccionar...',
                minimumInputLength: 1,
                dropdownAutoWidth: true,
                ajax: {
                    url: Routing.generate('citasexpedientepaciente'),
                    dataType: 'json',
                    quietMillis: 500,
                    data: function (term, page) {
                        return {
                            clue: term,     //search term
                            page_limit: 10, // page size
                            page: page,     // page number
                        };
                    },
                    results: function (data, page) {
                        var more = (page * 10) < data.data2;

                        return {results: data.data1, more: more};
                    }
                }
            });

\t\t\tjQuery.ajax({
\t\t\t    url: Routing.generate('citashorariomedico') + '?idEmpleado='+medicData.idEmpleado+'&idEmpleadoEspecialidadEstab='+medicData.idEmpleadoEspecialidadEstab+'&date='+parameters['date'],
\t\t\t    async: false,
\t\t\t    dataType: 'json',
\t\t\t    success: function(data) {
\t\t\t    \t\$.each(data.data1, function(indice, val) {
                        \$field.append(\$('<option>', {value:val.id, text: val.hora_ini}));
                    });
\t\t\t    }
            });

            \$field.select2('val',\$('#'+\$field.attr('id')+' option').eq(0).val());
            parameters['field'] = \$field;

\t\t\tcontent = buildDetailAgendaMedica(parameters);

\t\t\tif(content == \"\") {
\t\t\t\tcontent = '<div class=\"alert alert-block alert-error\">\\
\t\t\t\t\t\t\t\t<h4>Error al construir la agenda m&eacute;dica</h4>\\
\t\t\t\t\t\t\t\tLo sentimos un error al construir el detalle de la agenda m&eacute;dica, por favor intentelo nuevamente, si el problema persiste contacte con el administrador del sistema...\\
\t\t\t\t\t\t   \t</div>';
\t\t\t}

\t\t\treturn '<div id=\"info-message\"></div>\\<div class=\"panel-primary-custom\"><div class=\"agendamd-content\">'+content+'</div></div>';
\t\t}

\t\tfunction buildDetailAgendaMedica(parameters) {
\t\t\tvar content \t = \"\";
\t\t\tvar detalle \t = [];
\t\t\tvar primera_vez  = \"\";
\t\t\tvar subsecuentes = \"\";
\t\t\tvar agregados \t = \"\";
            var medicData    = getMedicData();
            var count        = 0;

\t\t\tjQuery.ajax({
\t\t\t\turl: Routing.generate('citasdetallehora') + '?idEmpleado='+medicData.idEmpleado+'&idEmpleadoEspecialidadEstab='+medicData.idEmpleadoEspecialidadEstab+'&date='+parameters['date']+'&hora='+parameters['field'].select2('val'),
\t\t\t\tasync: false,
\t\t\t\tdataType: 'json',
\t\t\t\tsuccess: function(data) {
\t\t\t\t\tdetalle['primera_vez']  = data.data1;
\t\t\t\t   \tdetalle['subsecuentes'] = data.data2;
\t\t\t\t    detalle['agregados']\t= data.data3;
\t\t\t\t}
\t        });

\t\t\tif(detalle['primera_vez'].length == 0) {
\t\t\t\tprimera_vez = '<tr><td colspan=\"4\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td></tr>';
\t\t\t} else {
\t\t\t\tjQuery.each( detalle['primera_vez'], function( key, value ) {
                    count += 1;
\t\t\t\t  \tprimera_vez = primera_vez + '\\
\t\t\t\t  \t\t<tr>\\
\t\t\t\t  \t\t\t<td>'+ count +'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.codExpediente +'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.nombrePaciente+'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.nombreEstado+'</td>\\
\t\t\t\t  \t\t</tr>';
\t\t\t\t});
\t\t\t}

\t\t\tif(detalle['subsecuentes'].length == 0) {
\t\t\t\tsubsecuentes = '<tr><td colspan=\"4\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td></tr>';
\t\t\t} else {
                count = 0;
\t\t\t\tjQuery.each( detalle['subsecuentes'], function( key, value ) {
                    count += 1;
\t\t\t\t  \tsubsecuentes = subsecuentes + '\\
\t\t\t\t  \t\t<tr>\\
\t\t\t\t  \t\t\t<td>'+ count +'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.codExpediente +'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.nombrePaciente+'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.nombreEstado+'</td>\\
\t\t\t\t  \t\t</tr>';
\t\t\t\t});
\t\t\t}

\t\t\tif(detalle['agregados'].length == 0) {
\t\t\t\tagregados = '<tr><td colspan=\"4\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td></tr>';
\t\t\t} else {
                count = 0;
\t\t\t\tjQuery.each( detalle['agregados'], function( key, value ) {
                    count += 1;
\t\t\t\t  \tagregados = agregados + '\\
\t\t\t\t  \t\t<tr>\\
\t\t\t\t  \t\t\t<td>'+ count +'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.codExpediente +'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.nombrePaciente+'</td>\\
\t\t\t\t  \t\t\t<td>'+ value.nombreEstado+'</td>\\
\t\t\t\t  \t\t</tr>';
\t\t\t\t});
\t\t\t}

\t\t\tcontent = '<div class=\"panel panel-primary\">\\
\t\t\t\t\t<div class=\"panel-heading\">Pacientes primera vez</div>\\
\t\t\t\t\t<div class=\"panel-body\" id=\"pb-primervez\">\\
\t\t\t\t\t\t<table class=\"table table-striped table-hover table-condensed\">\\
\t\t\t\t\t\t\t<thead>\\
\t\t\t\t\t\t\t\t<tr><th>No.</th><th>Expediente</th><th>Nombre del paciente</th><th>Estado de la cita</th></tr>\\
\t\t\t\t\t\t\t</thead>\\
\t\t\t\t\t\t\t<tbody>\\
 \t \t\t\t\t\t\t\t'+primera_vez+'\\
 \t \t\t\t\t\t\t</tbody>\\
\t\t\t\t\t\t</table>\\
\t\t\t\t\t</div>\\
\t\t\t\t</div>\\
\t\t\t\t<div class=\"panel panel-success\">\\
\t\t\t\t\t<div class=\"panel-heading\">Pacientes subsecuentes</div>\\
\t\t\t\t\t<div class=\"panel-body\" id=\"pb-subsecuentes\">\\
\t\t\t\t\t\t<table class=\"table table-striped table-hover table-condensed\">\\
\t\t\t\t\t\t\t<thead>\\
\t\t\t\t\t\t\t\t<tr><th>No.</th><th>Expediente</th><th>Nombre del paciente</th><th>Estado de la cita</th></tr>\\
\t\t\t\t\t\t\t</thead>\\
\t\t\t\t\t\t\t<tbody>\\
\t\t\t\t\t\t\t\t'+subsecuentes+'\\
\t\t\t\t\t\t\t</tbody>\\
\t\t\t\t\t\t</table>\\
\t\t\t\t\t</div>\\
\t\t\t\t</div>\\
\t\t\t\t<div class=\"panel panel-info\">\\
\t\t\t\t\t<div class=\"panel-heading\">Pacientes agregados</div>\\
\t\t\t\t\t<div class=\"panel-body\" id=\"pb-agregados\">\\
\t\t\t\t\t\t<table class=\"table table-striped table-hover table-condensed\">\\
\t\t\t\t\t\t\t<thead>\\
\t\t\t\t\t\t\t\t<tr><th>No.</th><th>Expediente</th><th>Nombre del paciente</th><th>Estado de la cita</th></tr>\\
\t\t\t\t\t\t\t</thead>\\
\t\t\t\t\t\t\t<tbody>\\
\t\t\t\t\t\t\t\t'+agregados+'\\
\t\t\t\t\t\t\t</tbody>\\
\t\t\t\t\t\t</table>\\
\t\t\t\t\t</div>\\
\t\t\t\t</div>';

\t\t\treturn content;
\t\t}

        function validate_form() {
            var horario       = jQuery(\"#horarioMedico\");
            var expediente    = jQuery(\"#numExpNomPac\");
            var info_message  = jQuery(\"#info-message\");
            var date          = new Date();
            var hora          = formatTime_12_24(\"12\", date.getHours()+':00:00');
            var medicData     = getMedicData();
            var error_message = [];
            var error_string  = '';
            var citaExistente = [];
            var citaDelMedico = [];
            var max_agregados = 0;
            var act_agregados = 0;
            var horarioEvento = [];
            var subsecuentes  = '';
            var ok = false;

            if(!horario.select2('data')) {
                error_message.push('<li>El horario no ha sido seleccionado.</li>');
            } else {
                if(clickDay.getFullYear() == date.getFullYear() && clickDay.getMonth() == date.getMonth() && clickDay.getDate() == date.getDate()) {
                    var horarioSeleccionado = formatTime_12_24(\"24\", horario.select2('data').text);
                    if(!horarioSeleccionado) {
                        error_message.push('<li>Error al convertir la hora, el formato de hora brindado no es el adecuado se requiere el formato (HH:mm:ss AM/PM), por favor contacte con el administrador</li>');
                    } else {
                        if(parseInt(horarioSeleccionado.substring(0,2)) < date.getHours()) {
                            error_message.push('<li>El horario seleccionado es anterior al rango de hora actual <b>'+hora+'</b>.</li>');
                        }
                    }
                }
            }

            \$.ajax({
                url:  Routing.generate(\"citasverificarevento\"),
                async: false,
                dataType: 'json',
                data: {
                    idEmpleado: medicData.idEmpleado,
                    hora:       horario.select2('data').text,
                    date:       clickDay
                },
                success: function(data) {
                    horarioEvento = data.data1;
                }
            });

            if(horarioEvento.length > 0 ) {
                error_message.push('<li>El medico tiene un evento en el horario seleccionado, motivo por el cual <b>no es posible crear la cita</b></li>');
            }

            if(\$('#numExpNomPac').val() === \"\") {
                error_message.push('<li>El campo <b>\"No. de Expedinte - Nombre del Paciente\"</b>, no ha sido seleccionado.</li>');
            }

            \$.ajax({
                url:  Routing.generate(\"citaspacienteposeecita\"),
                async: false,
                dataType: 'json',
                data: {
                    idEmpleado:   medicData.idEmpleado,
                    especialidad: medicData.idEmpleadoEspecialidadEstab,
                    idExpediente: expediente.val(),
                    date:         clickDay
                },
                success: function(data) {
                    citaExistente = data.data1;
                    citaDelMedico = data.data2;

                }
            });

            if(citaExistente.length > 0 || citaDelMedico.length > 0) {
                if(citaDelMedico.length > 0) {
                    error_message.push('<li>El paciente ya posee cita este dia en el horario <b>'+citaDelMedico[0].hora_ini+' '+citaDelMedico[0].meridianoini+'</b> en <b>'+citaDelMedico[0].nombre_atencion+'</b>, por favor seleccione otro dia.</li>');
                } else {
                    error_message.push('<li>El paciente ya posee cita este dia en el horario <b>'+citaExistente[0].hora_ini+' '+citaExistente[0].meridianoini+'</b> en <b>'+citaExistente[0].nombre_atencion_procedimiento+'</b>, por favor seleccione otro dia.</li>');
                }
            }

            \$.ajax({
                url:  Routing.generate(\"citascomprobardisponibilidad\"),
                async: false,
                dataType: 'JSON',
                data: {
                    idEmpleado:   medicData.idEmpleado,
                    especialidad: medicData.idEmpleadoEspecialidadEstab,
                    date:         clickDay,
                    idRangohora:  horario.select2('val'),
                    idExpediente: expediente.val()
                },
                success: function(data) {
                    max_agregados = data.data1.max_citas_agregadas;
                    act_agregados = data.data2;
                    subsecuentes  = data.data3;

                }
            });

            if(subsecuentes == 'true') {
                if(act_agregados >= max_agregados) {
                    error_message.push('<li>Ya no hay cupos de citas disponible para el dia y horario seleccionado, por favor intente en <b>otro horario o en otro dia</b></li>');
                }
            }

            if(error_message.length > 0) {
                info_message.empty();
                error_string = '<div class=\"alert alert-block alert-error\">\\
                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\\
                                        <h4>Error al crear la cita</h4>\\
                                        <ul>';
                for(var i = 0; i < error_message.length; i++) {
                    error_string = error_string + error_message[i];
                }
                error_string = error_string +'</ul></div>';

                info_message.empty();
                info_message.append(error_string);
            } else {
                ok = true;
            }

            return ok;
        }

\t\tjQuery(document).ready(function(\$) {

\t\t\t\$(\"body\").on('change', \"#horarioMedico\", function(e){
\t\t\t\t\$field = \$('#horarioMedico');
\t\t\t\tvar ag_content = \"\";
\t\t\t\tvar parameters = [];
\t\t\t\tparameters['field'] = \$field;
\t\t\t\tparameters['date']\t= clickDay;

                \$('div#info-message').empty();
\t\t\t\t\$('div.agendamd-content').empty();
\t\t\t\t\$('div.agendamd-content').append('<center><img id=\"wait\" src=\"";
        // line 476
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/wait_icon1.gif"), "html", null, true);
        echo "\" alt=\"wait\" width=\"24\" height=\"24\"><div id=\"search-message\">Buscando...</div></center>');

\t\t\t\tsetTimeout(function() {
                    ag_content = buildDetailAgendaMedica(parameters);
                    if(ag_content == \"\") {
                        ag_content = '<div class=\"alert alert-block alert-error\">\\
                                        <h4>Error al construir la agenda m&eacute;dica</h4>\\
                                        Lo sentimos un error al construir el detalle de la agenda m&eacute;dica, por favor intentelo nuevamente, si el problema persiste contacte con el administrador del sistema...\\
                                    </div>';
                    }

                    \$('div.agendamd-content').empty();
                    \$('div.agendamd-content').append(ag_content);
                }, 500);
\t\t\t});

\t\t\t\$('#calendar-holder').fullCalendar({
\t\t\t\theader: {
\t\t\t\t\tleft: 'prev, next,today',
\t\t\t\t\tcenter: 'title',
\t\t\t\t\tright: 'prevYear, nextYear'
\t\t\t\t},
\t\t\t\tlazyFetching:true,
\t            timeFormat: {
\t                    // for agendaWeek and agendaDay
\t                    agenda: 'h:mmt', // 5:00 - 6:30

\t                    // for all other views
\t                    '': 'h:mmt'            // 7p
\t            },
\t            buttonText: {
\t\t\t        prev: \t  'Mes Anterior',
\t\t\t        next: \t  'Mes Siguiente',
\t\t\t        prevYear: 'Año Anterior',
\t\t\t        nextYear: 'Año Siguiente',
\t\t\t        today: \t  'Hoy'
\t\t\t    },
\t\t\t    buttonIcons: {
\t\t\t    \tprev: \t  'left-single-arrow',
\t\t\t\t    next: \t  'right-single-arrow',
\t\t\t\t    prevYear: 'left-double-arrow',
\t\t\t\t    nextYear: 'right-double-arrow'
\t\t\t    },
                ";
        // line 519
        if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "month"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method"))))) {
            // line 520
            echo "                    month: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method"), "html", null, true);
            echo ",
                ";
        }
        // line 522
        echo "                ";
        if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "year"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method"))))) {
            // line 523
            echo "                    year: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method"), "html", null, true);
            echo ",
                ";
        }
        // line 525
        echo "\t\t\t    dayRender: function(date, cell) {
                    var medicUser = '";
        // line 526
        if (((!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) || (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")))) {
            echo "false";
        } else {
            echo "true";
        }
        echo "';
                    var renderCalendar = false;

                    if(medicUser == 'false') {
                        if(\$('#idEmpleado').select2('data') && \$('#idEmpleadoEspecialidadEstab').select2('data')) {
                            renderCalendar = true;
                        }
                    } else {
                        renderCalendar = true;
                    }

                    if(renderCalendar) {
                        var today = new Date();
                        date.setHours(0,0,0,0);
                        today.setHours(0,0,0,0);
                        var moment = \$('#calendar-holder').fullCalendar('getDate');
                        var calendarDate = new Date(moment);
                        var lowerLimit = new Date(calendarDate.getFullYear(), calendarDate.getMonth(), 1);
                        var upperLimit = new Date(calendarDate.getFullYear(), calendarDate.getMonth()+1, 0);
                        var cell_date  = date.getFullYear()+ '-' + (date.getMonth() < 10 ? '0' + date.getMonth()+1 : '' + date.getMonth()+1) + '-' + (date.getDate()  < 10 ? '0' + date.getDate()  : '' + date.getDate());
                        var primera_vez;
                        var subsecuentes;
                        var agregados;
                        var total_citas;
                        var atendidos;
                        var index;
                        var type;

                        if(cit_info != false && date >= lowerLimit && date <= upperLimit) {
                            index = getIndexOfK(cit_info[0], date);
                            if(index > -1) {

                                total_citas  = cit_info[0][index].total_citas;
                                atendidos    = cit_info[0][index].atendidos;
                                primera_vez  = cit_info[0][index].primera_vez;
                                subsecuentes = cit_info[0][index].subsecuentes;
                                agregados    = cit_info[0][index].agregados;

                                if(date >= lowerLimit && date < today) {
                                    if(cit_info[2][index]['distribucion'] > 0) {
                                        if(cit_info[1][index]['bloqueado'] == 'true') {
                                            if(cit_info[1][index]['tipo_evento'] == 'festivo') {
                                                type = 3;
                                            } else {
                                                type = 6;
                                            }
                                        } else {
                                            type = 6;
                                        }
                                    } else {
                                        if(cit_info[1][index]['bloqueado'] == 'true') {
                                            if(cit_info[1][index]['tipo_evento'] == 'festivo') {
                                                type = 3;
                                            } else {
                                                type = 2;
                                            }
                                        } else {
                                            type = 1;
                                        }
                                    }

                                    createCellContent(cell, [{
                                            'type': type,
                                            'total_citas':  total_citas,
                                            'atendidos':    atendidos,
                                            'cell_date':    cell_date,
                                            'date':         date,
                                            'index': \t\tindex,
                                            'before': \t\ttrue
                                        }]
                                    );
                                }

                                if((date > today && date >= lowerLimit && date <= upperLimit) || (date.getDate() === today.getDate() && date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear()))
                                {

                                    if(cit_info[2][index]['distribucion'] > 0) {
                                        if(cit_info[1][index]['bloqueado'] == 'true') {
                                            if(cit_info[1][index]['tipo_evento'] == 'festivo') {
                                                type = 3;
                                            } else {
                                                type = 4;
                                            }
                                        } else {
                                            type = 5;
                                        }
                                    } else {
                                        if(cit_info[1][index]['bloqueado'] == 'true') {
                                            if(cit_info[1][index]['tipo_evento'] == 'festivo') {
                                                type = 3;
                                            } else {
                                                type = 2;
                                            }
                                        } else {
                                            type = 1;
                                        }
                                    }

                                    createCellContent(cell, [{
                                            'type': type,
                                            'primera_vez': \tprimera_vez,
                                            'subsecuentes': subsecuentes,
                                            'total_citas': \ttotal_citas,
                                            'agregados': \tagregados,
                                            'cell_date': \tcell_date,
                                            'date': \t\tdate,
                                            'index': \t\tindex,
                                            'before': \t\tfalse
                                        }]
                                    );
                                }

                                if (date.getDate() === today.getDate() && date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear()) {
                                    cell.css(\"background-color\", \"#FEFFDB\");
                                }
                            }
                        }
                    }

                    if(cell.find(\"div.fc-custom-content-tb\").length == 0) {
                        cell.append('<div class=\"fc-custom-content-tb\"></div>');
                    }
\t\t\t    },
\t\t\t    dayClick: function(date, allDay, jsEvent, view) {
\t\t\t    \tclickDay = date;
\t\t\t    },
\t\t\t    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
\t\t\t    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
\t\t\t    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
\t\t\t    hiddenDays: [ 0, 6 ],
\t\t\t    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab'],
\t\t\t\teventSources: [
\t                    {
\t                        url: Routing.generate('fullcalendar_loader'),
\t\t\t\t\t\t\ttype: 'POST',
\t\t\t\t\t\t\t// A way to add custom filters to your event listeners
\t\t\t\t\t\t\tdata: {

\t                        },
\t                        error: function() {
\t                           //alert('There was an error while fetching Google Calendar!');
\t                        }
\t                    }
\t\t\t\t]
\t\t\t});

\t\t\t/********************************************************************************************************
\t\t\t * Creación del contenido de la celda (día) del calendario dependiendo del tipo de condicion que cumpla,*
\t\t\t * los cuales se describen a continuacion: \t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t*
\t\t\t * 1: Dia No Disponible- Debido a que el medico no posee una distribucion de horarios para esa fecha\t*
\t\t\t * 2: Dia Bloqueado    - El medico no posee distribucion y posee un evento de tipo personal para dicha\t*
\t\t\t *                       fecha\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t*
\t\t\t * 3: Dia Festivo \t   - Dia inhabilitado debido a fiestas a nivel nacional aplica a todos los empleados*
\t\t\t * 4: Bloqueo Parcial  - Si el medico tiene un evento personal y ha bloqueado ciertos horarios de aten- *
\t\t\t *                       cion de pacientes, puede asignarse cita pero solo en los horarios disponibles. *
\t\t\t * 5: Dia Habilitado   - Puese ser asignada la cita.\t\t\t\t\t\t\t\t\t\t\t\t\t*
\t\t\t * 6: Dia Inhabilitado - No es posible asignar citas por que la fecha es anterior a la fecha actual. \t*
\t\t\t ********************************************************************************************************/
\t\t\tfunction createCellContent(cell, parameters) {
\t\t\t\tswitch(parameters[0].type) {
\t\t\t\t\tcase 1:
\t\t\t\t\t\tif(parameters[0].before) {
\t\t\t\t\t\t\tcell.css(\"background-color\", \"#E8F2FF\");
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\tcell.css(\"background-color\", \"#DCFCE9\");
\t\t\t\t\t\t}
\t\t\t\t\t\tcell.append('<a href=\"#myModal\" id=\"citDay-'+parameters[0].cell_date+'_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
\t\t\t\t\t\t\t\t<div class=\"fc-custom-content-tb\">\\
\t\t\t\t\t\t\t\t\t<div class=\"fc-custom-content\">\\
\t\t\t\t\t\t\t\t\t\t<div class=\"disabled-day\">DIA NO DISPONIBLE</div>\\
\t\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t</a>');
\t\t\t\t\tbreak;
\t\t\t\t\tcase 2:
\t\t\t\t\t\tif(parameters[0].before) {
\t\t\t\t\t\t\tcell.css(\"background-color\", \"#E8F2FF\");
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\tcell.css(\"background-color\", \"#FFE7E7\");
\t\t\t\t\t\t}
\t\t\t\t\t\tcell.append('<a href=\"#myModal\" id=\"citDay-'+parameters[0].cell_date+'_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
\t\t\t\t\t\t\t\t<div class=\"fc-custom-content-tb\">\\
\t\t\t\t\t\t\t\t\t<div class=\"fc-custom-content\">\\
\t\t\t\t\t\t\t\t\t\t<div class=\"locked-day\">DIA BLOQUEADO</div>\\
\t\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t</a>');
\t\t\t\t\tbreak;
\t\t\t\t\tcase 3:
\t\t\t\t\t\tcell.css(\"background-color\", \"#FFF1E1\");
\t\t\t\t\t\tcell.append('<a href=\"#myModal\" id=\"citDay-'+parameters[0].cell_date+'_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
\t\t\t\t\t\t\t\t<div class=\"fc-custom-content-tb\">\\
\t\t\t\t\t\t\t\t\t<div class=\"fc-custom-content\">\\
\t\t\t\t\t\t\t\t\t\t<div class=\"festive-day\">DIA FESTIVO</div>\\
\t\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t</a>');
\t\t\t\t\tbreak;
\t\t\t\t\tcase 4:
\t\t\t\t\t\tcell.css(\"background-color\", \"#DCFCE9\");
\t\t\t\t\t\tcell.append('<a href=\"#myModal\" id=\"citDay-'+parameters[0].cell_date+'_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
\t\t\t\t\t\t\t    <div class=\"fc-custom-content-tb\">\\
\t\t\t\t\t\t\t\t    <div class=\"fc-custom-content\">\\
\t\t\t\t\t\t\t\t    \t<div class=\"locked-day\">DIA BLOQUEADO</div><br />\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-left fc-cuscont-enabled\">1er vez:</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-right fc-cuscont-enabled\">'+ parameters[0].primera_vez +'</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-left fc-cuscont-enabled\">Subsecuentes:</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-right fc-cuscont-enabled\">'+ parameters[0].subsecuentes +'</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-left fc-cuscont-enabled fc-cuscont-border\">Agregados:</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-right fc-cuscont-enabled fc-cuscont-border\">'+ parameters[0].agregados +'</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-left fc-cuscont-enabled\">Total Citados:</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-right fc-cuscont-enabled\">'+ parameters[0].total_citas +'</div>\\
\t\t\t\t\t\t    \t\t</div>\\
\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t</a>');
\t\t\t\t\tbreak;
\t\t\t\t\tcase 5:
\t\t\t\t\t\tcell.css(\"background-color\", \"#DCFCE9\");
\t\t\t\t\t\tcell.append('<a href=\"#myModal\" id=\"citDay-'+parameters[0].cell_date+'_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
\t\t\t\t\t\t\t    <div class=\"fc-custom-content-tb\">\\
\t\t\t\t\t\t\t\t    <div class=\"fc-custom-content\">\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-left fc-cuscont-enabled\">1er vez:</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-right fc-cuscont-enabled\">'+ parameters[0].primera_vez +'</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-left fc-cuscont-enabled\">Subsecuentes:</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-right fc-cuscont-enabled\">'+ parameters[0].subsecuentes +'</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-left fc-cuscont-enabled fc-cuscont-border\">Agregados:</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-right fc-cuscont-enabled fc-cuscont-border\">'+ parameters[0].agregados +'</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-left fc-cuscont-enabled\">Total Citados:</div>\\
\t\t\t\t\t\t\t\t\t    <div class=\"fc-cuscont-right fc-cuscont-enabled\">'+ parameters[0].total_citas +'</div>\\
\t\t\t\t\t\t    \t\t</div>\\
\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t</a>');
\t\t\t\t\tbreak;
\t\t\t\t\tcase 6:
\t\t\t\t\t\tcell.css(\"background-color\", \"#E8F2FF\");
\t\t\t\t\t\tcell.append('<a href=\"#myModal\" id=\"citDay-'+parameters[0].cell_date+'_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
\t\t\t\t\t\t\t\t<div class=\"fc-custom-content-tb\">\\
\t\t\t\t\t\t\t\t\t<div class=\"fc-custom-content\">\\
\t\t\t\t\t\t\t\t\t\t<div class=\"fc-cuscont-left fc-cuscont-disabled fc-cuscont-border\">Citados:</div>\\
\t\t\t\t\t\t\t\t\t\t<div class=\"fc-cuscont-right fc-cuscont-disabled fc-cuscont-border\">'+ parameters[0].total_citas+'</div>\\
\t\t\t\t\t\t\t\t\t\t<div class=\"fc-cuscont-left fc-cuscont-disabled fc-cuscont-border\">Atendidos:</div>\\
\t\t\t\t\t\t\t\t\t\t<div class=\"fc-cuscont-right fc-cuscont-disabled fc-cuscont-border\">'+ parameters[0].atendidos +'</div>\\
\t\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t\t</div>\\
\t\t\t\t\t\t\t</a>');
\t\t\t\t\tbreak;
\t\t\t\t}

\t\t\t\tpushModalElement('citDay-'+parameters[0].cell_date+'_modal','agendaMedica',parameters[0]);
\t\t\t}
\t\t});
\t</script>
\t<script type=\"text/javascript\">
\t\tjQuery(document).ready(function(\$) {
\t\t\t// initialize calendar first
            ";
        // line 781
        if (((!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) || (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")))) {
            // line 782
            echo "                \$idEmpleado = \$('#idEmpleado');
                \$idEmpleadoEspecialidadEstab = \$('#idEmpleadoEspecialidadEstab');
                var superAdmin = '";
            // line 784
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "';

                \$idEmpleado.prepend('<option/>').val(function(){return \$('[selected]',this).val() ;});
                \$idEmpleado.select2({
                    placeholder: 'Seleccionar Medico...',
                    allowClear:  true,
                    width: \t\t '100%'
                });

                \$.ajax({
                    url:  Routing.generate(\"citasgetmedico\"),
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.data1, function(indice, val) {
                            if(superAdmin == 'true') {
                                \$idEmpleado.append(\$('<option>', {value:val.id, text: val.nombre}));
                            } else {
                                if(val.idEstablecimiento == '";
            // line 802
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado")) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdEstablecimiento"), "getId"), "html", null, true);
            }
            echo "') {
                                    \$idEmpleado.append(\$('<option>', {value:val.id, text: val.nombre}));
                                }
                            }
                        });
                    }
                });

                \$idEmpleadoEspecialidadEstab.prepend('<option/>').val(function(){return \$('[selected]',this).val() ;});
                \$idEmpleadoEspecialidadEstab.select2({
                    placeholder: 'Seleccionar Especialidad...',
                    allowClear:  true,
                    width: \t\t '100%'
                });

                \$idEmpleado.on('change', function(e) {
                    \$idEmpleadoEspecialidadEstab.children().remove();

                    \$idEmpleadoEspecialidadEstab.prepend('<option/>').val(function(){return \$('[selected]',this).val() ;});
                    \$idEmpleadoEspecialidadEstab.select2({
                        placeholder: 'Seleccionar Especialidad...',
                        allowClear:  true,
                        width: \t\t '100%'
                    });

                    if(e.val) {
                        empleadoChange(e.val);
                    }
                    updateCalendar();
                });

                \$idEmpleadoEspecialidadEstab.on('change', function(e) {
                    if(e.val) {
                        updateMonthIformationCit();
                    }
                    updateCalendar();
                });

                ";
            // line 840
            if ((twig_length_filter($this->env, (isset($context["query"]) ? $context["query"] : $this->getContext($context, "query"))) > 0)) {
                // line 841
                echo "                    ";
                if ($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "idEmpleado"), "method", true, true)) {
                    // line 842
                    echo "                        \$idEmpleado.select2('val', '";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "idEmpleado"), "method"), "html", null, true);
                    echo "');
                        empleadoChange('";
                    // line 843
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "idEmpleado"), "method"), "html", null, true);
                    echo "');
                    ";
                }
                // line 845
                echo "                    ";
                if ($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "idEspecialidad"), "method", true, true)) {
                    // line 846
                    echo "                        \$idEmpleadoEspecialidadEstab.select2('val', '";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "idEspecialidad"), "method"), "html", null, true);
                    echo "');
                        updateMonthIformationCit();
                    ";
                }
                // line 849
                echo "                ";
            }
            // line 850
            echo "            ";
        } else {
            // line 851
            echo "                updateMonthIformationCit();
            ";
        }
        // line 853
        echo "
            function empleadoChange(id) {
                \$.ajax({
                    url: Routing.generate('citasgetmedicoespecilidadestab') + '?idEmpleado=' + id,
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.data1, function(indice, val) {
                            if(superAdmin == 'true') {
                                \$idEmpleadoEspecialidadEstab.append(\$('<option>', {value:val.id, text: val.nombre}));
                            } else {
                                if(value.idEstablecimiento == '";
        // line 864
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado")) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdEstablecimiento"), "getId"), "html", null, true);
        }
        echo "') {
                                    \$idEmpleadoEspecialidadEstab.append(\$('<option>', {value: val.id, text: val.nombre }));
                                }
                            }
                        });
                    }
                });
            }

            updateCalendar();

\t\t\t//removiendo css
\t\t\t\$('#calendar-holder .fc-week .fc-day.fc-first div:first-child').css('min-height','');

\t\t\t// Update the calendar when previous button is pressed
\t\t\t\$('#calendar-holder .fc-button-prev').on('click', function(){
\t\t\t\tupdateMonthIformationCit();
\t\t\t\tupdateCalendar();
\t\t\t});

\t\t\t// Update the calendar when next button is pressed
\t\t\t\$('#calendar-holder .fc-button-next').on('click', function(){
\t\t\t\tupdateMonthIformationCit();
\t\t\t\tupdateCalendar();
\t\t\t});

\t\t\t// Update the calendar when the today button is pressed
\t\t\t\$('#calendar-holder .fc-button-today').on('click', function(){
\t\t\t\tupdateMonthIformationCit();
\t\t\t\tupdateCalendar();
\t\t\t});

\t\t\t\$('#calendar-holder .fc-button-prevYear').on('click', function(){
\t\t\t\tupdateMonthIformationCit();
\t\t\t\tupdateCalendar();
\t\t\t});

\t\t\t// Update the calendar when next button is pressed
\t\t\t\$('#calendar-holder .fc-button-nextYear').on('click', function(){
\t\t\t\tupdateMonthIformationCit();
\t\t\t\tupdateCalendar();
\t\t\t});


\t\t\tfunction updateCalendar() {
                modal_elements = [];
\t\t\t\trenderCalendar();
\t\t\t\tvar calendarDate = \$('#calendar-holder').fullCalendar('getDate');
\t\t\t\tcalendarDate.setHours(0,0,0,0);

\t\t\t\tvar currentDate = new Date();
\t\t\t\tcurrentDate.setHours(0,0,0,0);

\t\t\t\t// Disable prev button for the past
\t\t\t\tif (currentDate.getFullYear() == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
\t\t\t\t\tdisablePrevMonthButton();
\t\t\t\t} else {
\t\t\t\t\tenablePrevMonthButton();
\t\t\t\t}

\t\t\t\t// Disable next button for 2 years from today
\t\t\t\tif (currentDate.getFullYear() + 2 == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
\t\t\t\t\tdisableNextMonthButton();
\t\t\t\t} else {
\t\t\t\t\tenableNextMonthButton();
\t\t\t\t}

\t\t\t\tvar limit = new Date(currentDate.getFullYear() + 1, currentDate.getMonth(), currentDate.getDate());
\t\t\t\tif (currentDate.getFullYear() == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
\t\t\t\t\tdisablePrevYearButton();
\t\t\t\t\tenableNextYearButton();
\t\t\t\t} else if (currentDate.getFullYear() +1 == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
\t\t\t\t\tenablePrevYearButton();
\t\t\t\t\tenableNextYearButton();
\t\t\t\t} else if(calendarDate < limit) {
\t\t\t\t\t\tdisablePrevYearButton();
\t\t\t\t\t\tenableNextYearButton();
\t\t\t\t\t} else {
\t\t\t\t\t\tdisableNextYearButton();
\t\t\t\t\t\tenablePrevYearButton();
\t\t\t\t\t}
\t\t\t}

\t\t\tfunction enablePrevMonthButton() {
\t\t\t\t\$(\"#calendar-holder .fc-button-prev\").removeClass('fc-state-disabled');
\t\t\t}

\t\t\tfunction disablePrevMonthButton() {
\t\t\t\t\$(\"#calendar-holder .fc-button-prev\").addClass('fc-state-disabled');
\t\t\t}

\t\t\tfunction enableNextMonthButton() {
\t\t\t\t\$(\"#calendar-holder .fc-button-next\").removeClass('fc-state-disabled');
\t\t\t}

\t\t\tfunction disableNextMonthButton() {
\t\t\t\t\$(\"#calendar-holder .fc-button-next\").addClass('fc-state-disabled');
\t\t\t}

\t\t\tfunction enablePrevYearButton() {
\t\t\t\t\$(\"#calendar-holder .fc-button-prevYear\").removeClass('fc-state-disabled');
\t\t\t}

\t\t\tfunction disablePrevYearButton() {
\t\t\t\t\$(\"#calendar-holder .fc-button-prevYear\").addClass('fc-state-disabled');
\t\t\t}

\t\t\tfunction enableNextYearButton() {
\t\t\t\t\$(\"#calendar-holder .fc-button-nextYear\").removeClass('fc-state-disabled');
\t\t\t}

\t\t\tfunction disableNextYearButton() {
\t\t\t\t\$(\"#calendar-holder .fc-button-nextYear\").addClass('fc-state-disabled');
\t\t\t}

\t\t\t\$(window).on('resize', function() {
\t\t\t\trenderCalendar();
\t\t\t});

\t\t\tfunction renderCalendar () {
\t\t\t\t\$('#calendar-holder').fullCalendar('render');
\t\t\t    \$('#calendar-holder .fc-week .fc-day.fc-first div:first-child').css('min-height','');
\t\t\t    \$('#calendar-holder .fc-week .fc-day.fc-first div.fc-custom-content-tb').css('min-height','');
\t\t\t}
\t\t});
\t</script>
\t<script type=\"text/javascript\">
\t\tjQuery(document).ready(function(\$) {
\t\t\t\$('span.fc-button-prev').prepend('<span class=\"glyphicon glyphicon-chevron-left\"></span> ')
\t\t\t\$('span.fc-button-next').append(' <span class=\"glyphicon glyphicon-chevron-right\"></span>')

\t\t\t\$('span.fc-button-prevYear').prepend('<span class=\"glyphicon glyphicon-chevron-left\"></span><span class=\"glyphicon glyphicon-chevron-left\"></span> ')
\t\t\t\$('span.fc-button-nextYear').append(' <span class=\"glyphicon glyphicon-chevron-right\"></span><span class=\"glyphicon glyphicon-chevron-right\"></span>')
\t\t});
\t</script>
";
    }

    // line 1001
    public function block_notice($context, array $blocks = array())
    {
        // line 1002
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(array(0 => "success", 1 => "error", 2 => "info", 3 => "warning"));
        foreach ($context['_seq'] as $context["_key"] => $context["notice_level"]) {
            // line 1003
            echo "    ";
            $context["session_var"] = ("sonata_flash_" . (isset($context["notice_level"]) ? $context["notice_level"] : $this->getContext($context, "notice_level")));
            // line 1004
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => (isset($context["session_var"]) ? $context["session_var"] : $this->getContext($context, "session_var"))), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flash"]) {
                // line 1005
                echo "            <div class=\"alert ";
                echo twig_escape_filter($this->env, ("alert-" . (isset($context["notice_level"]) ? $context["notice_level"] : $this->getContext($context, "notice_level"))), "html", null, true);
                echo "\">
               <center>";
                // line 1006
                echo $this->env->getExtension('translator')->trans((isset($context["flash"]) ? $context["flash"] : $this->getContext($context, "flash")), array(), "SonataAdminBundle");
                echo "</center>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flash'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1009
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notice_level'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 1012
    public function block_content($context, array $blocks = array())
    {
        // line 1013
        echo "    ";
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"))) {
            // line 1014
            echo "        <div>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "</div>
    ";
        } else {
            // line 1016
            echo "    \t";
            $this->displayBlock('sonata_page_content_nav', $context, $blocks);
            // line 1018
            echo "        <div class=\"col-md-3\">
            <div class=\"col-md-12\" style=\"margin-bottom: 20px;\">
                ";
            // line 1020
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true) && ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED"))) {
                // line 1021
                echo "                    <label class=\"col-md-12 label-filters\">Especialidad:</label>
                    <label class=\"col-md-12\" style=\"font-weight:bold;\">";
                // line 1022
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_nombreEmpEspecialidadEstab"), "method"), "html", null, true);
                echo "</label>
                ";
            } else {
                // line 1024
                echo "                    <label class=\"col-md-12 label-filters\">Medico:</label>
                    <select id=\"idEmpleado\"></select>
                    <label class=\"col-md-12 label-filters\">Especialidad:</label>
                    <select id=\"idEmpleadoEspecialidadEstab\"></select>
                ";
            }
            // line 1029
            echo "            </div>
            <div class=\"col-md-12\" style=\"padding-top: 20px; border-top:1px solid #DDDDDD;\">
                <div class=\"accordion\" id=\"accordion2\" style=\"background-color:white;\">
                    <div class=\"accordion-group\">
                        <div class=\"accordion-heading\">
                            <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseOne\">
                                <div style=\"font-size: 15px;font-weight:bold;\">Codigo de Colores</div>
                            </a>
                        </div>
                        <div id=\"collapseOne\" class=\"accordion-body collapse in\">
                            <div class=\"accordion-inner\">
                                <div style=\"text-align:left;\">
                                    <table>
                                        <tr><td style=\"background-color:#E8F2FF;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Dia anterior a la fecha actual</td></tr>
                                        <tr><td style=\"background-color:#FEFFDB;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Fecha Actual</td></tr>
                                        <tr><td style=\"background-color:#DCFCE9;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Dia posterior a la fecha actual</td></tr>
                                        <tr><td style=\"background-color:#FFF1E1;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Dia festivo</td></tr>
                                        <tr><td style=\"background-color:#FFE7E7;width:16px;height:36px;\"></td><td style=\"padding-left:10px;\">Dia bloqueado</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-md-9\">";
            // line 1055
            $this->env->loadTemplate("ADesignsCalendarBundle::calendar.html.twig")->display($context);
            echo "</div>
    ";
        }
    }

    // line 1016
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 1017
        echo "\t\t";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:Custom:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1250 => 1017,  1247 => 1016,  1240 => 1055,  1212 => 1029,  1205 => 1024,  1200 => 1022,  1197 => 1021,  1195 => 1020,  1191 => 1018,  1188 => 1016,  1182 => 1014,  1179 => 1013,  1176 => 1012,  1168 => 1009,  1159 => 1006,  1154 => 1005,  1149 => 1004,  1146 => 1003,  1141 => 1002,  1138 => 1001,  973 => 849,  958 => 843,  948 => 840,  905 => 802,  880 => 784,  376 => 147,  622 => 204,  531 => 95,  498 => 78,  468 => 163,  458 => 160,  401 => 144,  369 => 129,  356 => 127,  340 => 122,  874 => 781,  854 => 367,  851 => 366,  836 => 361,  831 => 359,  828 => 358,  825 => 357,  820 => 352,  817 => 351,  813 => 349,  799 => 341,  792 => 337,  773 => 327,  766 => 322,  763 => 321,  746 => 311,  740 => 307,  734 => 305,  731 => 304,  729 => 303,  721 => 301,  715 => 297,  700 => 292,  684 => 282,  680 => 280,  674 => 278,  648 => 266,  642 => 264,  639 => 263,  637 => 262,  604 => 247,  588 => 239,  573 => 234,  559 => 183,  547 => 220,  520 => 210,  450 => 173,  408 => 156,  363 => 136,  359 => 135,  348 => 129,  345 => 124,  336 => 125,  316 => 116,  307 => 107,  261 => 85,  266 => 83,  542 => 218,  538 => 217,  527 => 173,  509 => 204,  499 => 157,  493 => 155,  479 => 154,  473 => 165,  414 => 158,  406 => 152,  280 => 75,  223 => 69,  585 => 224,  551 => 101,  546 => 476,  506 => 103,  503 => 193,  488 => 172,  485 => 195,  478 => 165,  475 => 164,  471 => 164,  448 => 172,  386 => 127,  378 => 132,  375 => 90,  306 => 109,  291 => 100,  286 => 108,  392 => 150,  332 => 145,  318 => 112,  276 => 104,  190 => 53,  12 => 36,  195 => 92,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 864,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 850,  974 => 305,  966 => 846,  953 => 842,  950 => 841,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 383,  890 => 381,  887 => 380,  885 => 272,  875 => 268,  861 => 256,  858 => 369,  853 => 294,  850 => 255,  847 => 254,  842 => 363,  827 => 252,  805 => 346,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 295,  706 => 294,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 276,  665 => 275,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 202,  613 => 232,  610 => 198,  608 => 197,  605 => 196,  602 => 230,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 79,  496 => 199,  441 => 156,  438 => 140,  432 => 166,  428 => 172,  422 => 150,  416 => 123,  395 => 118,  391 => 109,  382 => 143,  372 => 89,  364 => 137,  353 => 96,  335 => 120,  333 => 93,  297 => 103,  292 => 82,  205 => 96,  200 => 94,  184 => 55,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 853,  981 => 307,  979 => 851,  971 => 304,  967 => 303,  963 => 845,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 385,  897 => 384,  891 => 271,  884 => 379,  881 => 270,  879 => 264,  876 => 782,  869 => 265,  867 => 373,  840 => 299,  837 => 253,  835 => 296,  833 => 360,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 330,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 293,  701 => 180,  699 => 179,  696 => 178,  690 => 285,  687 => 173,  681 => 205,  673 => 165,  671 => 277,  668 => 163,  663 => 160,  658 => 271,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 261,  629 => 141,  627 => 206,  624 => 139,  620 => 182,  614 => 201,  599 => 194,  594 => 520,  592 => 519,  589 => 192,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 186,  567 => 110,  554 => 185,  552 => 164,  544 => 219,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 159,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 148,  446 => 143,  443 => 142,  429 => 116,  425 => 152,  410 => 59,  397 => 55,  394 => 54,  389 => 128,  357 => 37,  342 => 123,  334 => 26,  330 => 122,  328 => 117,  290 => 110,  287 => 99,  263 => 86,  255 => 95,  245 => 76,  194 => 55,  76 => 19,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 372,  860 => 280,  856 => 279,  852 => 278,  848 => 365,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 332,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 320,  758 => 226,  756 => 318,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 302,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 255,  617 => 254,  612 => 526,  609 => 525,  606 => 209,  603 => 523,  600 => 522,  598 => 244,  595 => 193,  586 => 191,  582 => 190,  580 => 197,  572 => 218,  568 => 173,  562 => 184,  556 => 182,  550 => 183,  535 => 216,  526 => 212,  521 => 171,  515 => 207,  497 => 191,  492 => 76,  481 => 167,  476 => 163,  467 => 156,  451 => 155,  424 => 115,  418 => 148,  412 => 147,  399 => 64,  396 => 63,  390 => 139,  388 => 138,  383 => 135,  377 => 104,  373 => 46,  370 => 100,  367 => 102,  352 => 126,  349 => 101,  346 => 125,  329 => 111,  326 => 86,  313 => 126,  303 => 103,  300 => 112,  234 => 88,  218 => 81,  207 => 61,  178 => 48,  321 => 119,  295 => 11,  274 => 87,  242 => 110,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 268,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 226,  583 => 334,  579 => 236,  577 => 188,  575 => 252,  569 => 233,  565 => 109,  548 => 207,  540 => 99,  536 => 98,  529 => 213,  524 => 211,  516 => 143,  510 => 78,  504 => 90,  500 => 88,  490 => 197,  486 => 136,  482 => 285,  470 => 131,  464 => 180,  459 => 177,  452 => 145,  434 => 256,  421 => 114,  417 => 159,  385 => 107,  361 => 97,  344 => 94,  339 => 126,  324 => 115,  310 => 113,  302 => 131,  296 => 89,  282 => 106,  259 => 81,  244 => 111,  231 => 69,  226 => 69,  114 => 80,  104 => 28,  288 => 107,  284 => 98,  279 => 96,  275 => 95,  256 => 74,  250 => 73,  237 => 71,  232 => 72,  222 => 63,  215 => 66,  191 => 54,  153 => 72,  563 => 188,  560 => 187,  558 => 186,  555 => 185,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  400 => 116,  380 => 107,  366 => 106,  354 => 130,  331 => 119,  325 => 94,  320 => 92,  317 => 91,  311 => 87,  308 => 86,  304 => 85,  272 => 81,  267 => 88,  249 => 78,  216 => 65,  155 => 35,  152 => 49,  146 => 49,  126 => 38,  181 => 51,  161 => 54,  110 => 29,  188 => 53,  186 => 51,  170 => 355,  150 => 34,  124 => 59,  358 => 103,  351 => 102,  347 => 134,  343 => 127,  338 => 112,  327 => 121,  323 => 114,  319 => 124,  315 => 82,  301 => 104,  299 => 90,  293 => 111,  289 => 82,  281 => 96,  277 => 95,  271 => 94,  265 => 100,  262 => 76,  260 => 85,  257 => 56,  251 => 72,  248 => 71,  239 => 68,  228 => 103,  225 => 65,  213 => 69,  211 => 64,  197 => 72,  174 => 163,  148 => 47,  134 => 43,  127 => 16,  20 => 1,  53 => 3,  270 => 85,  253 => 79,  233 => 66,  212 => 98,  210 => 63,  206 => 76,  202 => 62,  198 => 54,  192 => 66,  185 => 53,  180 => 49,  175 => 47,  172 => 105,  167 => 156,  165 => 351,  160 => 57,  137 => 44,  113 => 60,  100 => 29,  90 => 27,  81 => 26,  129 => 116,  84 => 22,  77 => 25,  34 => 2,  118 => 55,  97 => 37,  70 => 23,  65 => 12,  58 => 10,  23 => 5,  480 => 134,  474 => 150,  469 => 150,  461 => 157,  457 => 153,  453 => 174,  444 => 171,  440 => 148,  437 => 118,  435 => 167,  430 => 153,  427 => 65,  423 => 63,  413 => 241,  409 => 153,  407 => 238,  402 => 65,  398 => 115,  393 => 112,  387 => 110,  384 => 109,  381 => 109,  379 => 119,  374 => 140,  368 => 138,  365 => 137,  362 => 97,  360 => 104,  355 => 95,  341 => 123,  337 => 97,  322 => 93,  314 => 111,  312 => 149,  309 => 113,  305 => 111,  298 => 12,  294 => 98,  285 => 79,  283 => 111,  278 => 110,  268 => 101,  264 => 104,  258 => 75,  252 => 79,  247 => 77,  241 => 74,  229 => 86,  220 => 99,  214 => 79,  177 => 52,  169 => 43,  140 => 47,  132 => 117,  128 => 92,  107 => 29,  61 => 11,  273 => 71,  269 => 91,  254 => 80,  243 => 76,  240 => 72,  238 => 84,  235 => 73,  230 => 65,  227 => 67,  224 => 66,  221 => 82,  219 => 66,  217 => 60,  208 => 96,  204 => 61,  179 => 86,  159 => 151,  143 => 36,  135 => 42,  119 => 37,  102 => 54,  71 => 8,  67 => 7,  63 => 30,  59 => 5,  38 => 6,  94 => 26,  89 => 16,  85 => 20,  75 => 19,  68 => 59,  56 => 11,  201 => 60,  196 => 58,  183 => 50,  171 => 128,  166 => 43,  163 => 42,  158 => 50,  156 => 78,  151 => 47,  142 => 30,  138 => 43,  136 => 29,  121 => 57,  117 => 81,  105 => 39,  91 => 25,  62 => 6,  49 => 9,  28 => 3,  26 => 13,  87 => 22,  31 => 14,  25 => 10,  21 => 1,  24 => 6,  19 => 2,  93 => 23,  88 => 20,  78 => 20,  46 => 8,  44 => 8,  27 => 7,  79 => 40,  72 => 24,  69 => 15,  47 => 9,  40 => 7,  37 => 14,  22 => 3,  246 => 122,  157 => 53,  145 => 46,  139 => 29,  131 => 34,  123 => 38,  120 => 64,  115 => 12,  111 => 32,  108 => 32,  101 => 28,  98 => 25,  96 => 26,  83 => 176,  74 => 16,  66 => 14,  55 => 12,  52 => 11,  50 => 7,  43 => 6,  41 => 7,  35 => 15,  32 => 5,  29 => 3,  209 => 55,  203 => 56,  199 => 59,  193 => 57,  189 => 65,  187 => 48,  182 => 87,  176 => 85,  173 => 48,  168 => 50,  164 => 155,  162 => 152,  154 => 52,  149 => 34,  147 => 33,  144 => 46,  141 => 32,  133 => 71,  130 => 42,  125 => 46,  122 => 85,  116 => 54,  112 => 33,  109 => 32,  106 => 31,  103 => 30,  99 => 30,  95 => 50,  92 => 17,  86 => 28,  82 => 31,  80 => 21,  73 => 16,  64 => 12,  60 => 12,  57 => 8,  54 => 24,  51 => 9,  48 => 2,  45 => 1,  42 => 6,  39 => 3,  36 => 3,  33 => 3,  30 => 3,);
    }
}
