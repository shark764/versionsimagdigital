<?php

/* MinsalSimagdBundle:show_container_fullEntity:pct_total_info_modal_v2.html.twig */
class __TwigTemplate_a53376b5cf8a450292408821dd4ff6db64c28e76ab065e34367057e7efa3e3a2 extends Twig_Template
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
    <div id=\"pacienteFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Paciente registrado</h4>
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
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Expediente:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"numero\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nombre del padre:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"nombrePadre\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Habilitado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"habilitado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nombre de la madre:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"nombreMadre\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaCreacion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nombre de responsable:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"nombreResponsable\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nombre:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"nombre\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Registrado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaRegistro\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nació:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaNacimiento\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Ocupación:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idOcupacion\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Identificación:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"numeroDocIdePaciente\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nacionalidad:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idNacionalidad\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Direccion:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"direccion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Responsable:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idParentescoResponsable\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Teléfono de casa:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"telefonoCasa\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Sexo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idSexo\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Trabaja en:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"lugarTrabajo\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Nació en el municipio de:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idMunicipioNacimiento\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Asegurado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"asegurado\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Reside en el municipio de:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idMunicipioDomicilio\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Numero de afiliación:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"numeroAfiliacion\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Estado civil:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstadoCivil\"></td>
                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button class='btn btn-element-v2' data-toggle='modal' href='#pctRecord-ShowModal' id='btn-pct-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:pct_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  31 => 12,  224 => 185,  218 => 180,  215 => 177,  178 => 143,  175 => 140,  139 => 106,  133 => 101,  130 => 98,  100 => 70,  94 => 65,  73 => 54,  69 => 46,  64 => 43,  61 => 42,  35 => 19,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  580 => 365,  577 => 364,  575 => 363,  567 => 362,  564 => 361,  561 => 360,  557 => 359,  555 => 358,  551 => 356,  549 => 355,  526 => 334,  523 => 331,  511 => 321,  501 => 313,  492 => 308,  480 => 301,  468 => 293,  461 => 290,  455 => 287,  447 => 282,  443 => 280,  437 => 277,  435 => 276,  407 => 250,  396 => 248,  391 => 247,  380 => 245,  375 => 244,  364 => 242,  360 => 241,  324 => 207,  306 => 190,  285 => 170,  268 => 154,  247 => 134,  230 => 118,  213 => 102,  202 => 92,  199 => 90,  192 => 82,  189 => 81,  184 => 148,  168 => 69,  164 => 67,  161 => 66,  156 => 63,  151 => 60,  148 => 59,  144 => 56,  138 => 54,  135 => 53,  128 => 49,  124 => 48,  120 => 47,  115 => 46,  110 => 43,  105 => 42,  99 => 39,  91 => 62,  75 => 48,  67 => 45,  57 => 17,  54 => 16,  46 => 12,  43 => 11,  38 => 20,  36 => 8,  34 => 7,  32 => 6,);
    }
}
