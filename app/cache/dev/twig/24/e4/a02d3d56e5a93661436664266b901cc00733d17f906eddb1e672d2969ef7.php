<?php

/* MinsalSimagdBundle:show_container_fullEntity:blAgd_total_info_modal_v2.html.twig */
class __TwigTemplate_24e4a02d3d56e5a93661436664266b901cc00733d17f906eddb1e672d2969ef7 extends Twig_Template
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
    <div id=\"bloqueoAgendaFullData-showModalContainer\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container simagd-full-data-view\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"true\" data-keyboard=\"true\">
\t<div class=\"modal-content panel-info-v2\">
            <div class=\"modal-header panel-heading\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
                <h4 class=\"modal-title\"><i class=\"fa fa-folder-open\"></i> Bloqueo de horarios en agenda</h4>
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
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Establecimiento médico:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEstablecimiento\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Registró:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idEmpleadoRegistra\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Tipo de empleado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idTipoEmpleado\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Usuario registró:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserReg\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Ultimo usuario que editó:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idUserMod\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Título:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"titulo\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Creado:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaCreacion\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-tint\"></i> Color de fondo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"color\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Ultima edición:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaUltimaEdicion\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class='fa fa-calendar'></i> Fecha de inicio de rango:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaInicio\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Hora de inicio de rango:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"horaInicio\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class='fa fa-calendar'></i> Fecha de finalización de rango:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"fechaFin\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\"><i class=\"fa fa-clock-o\"></i> Hora de finalización de rango:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"horaFin\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Abarca día completo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"diaCompleto\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Descripción:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"descripcion\"></td>
                            </tr>
                            <tr>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Bloqueo para radiólogo / tecnólogo:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idRadiologoBloqueo\"></td>
                                <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Bloqueo para modalidad:</span></th>
                                <td class=\"col-md-4\" data-render-info=\"idAreaServicioDiagnostico\"></td>
                            </tr>
                        </table>

                    </div>
                </div>
                
            </div>

            <div class=\"modal-footer\">
                <button class='btn btn-element-v2' data-toggle='modal' href='#blAgdRecord-ShowModal' id='btn-blAgd-record'><i class=\"fa fa-search-plus\"></i> Consulta </button>
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"> <i class=\"fa fa-times\"></i> Cerrar </button>
            </div>
\t</div><!-- /.modal-content -->
    </div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_container_fullEntity:blAgd_total_info_modal_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  172 => 131,  162 => 121,  145 => 106,  127 => 89,  95 => 59,  83 => 57,  78 => 56,  71 => 51,  310 => 218,  300 => 208,  247 => 159,  237 => 151,  217 => 132,  197 => 125,  193 => 124,  186 => 119,  155 => 89,  135 => 71,  132 => 69,  123 => 61,  105 => 58,  97 => 56,  85 => 54,  80 => 53,  112 => 66,  106 => 69,  69 => 30,  55 => 20,  30 => 7,  22 => 4,  94 => 68,  79 => 54,  75 => 52,  73 => 52,  24 => 4,  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 49,  49 => 18,  43 => 15,  35 => 19,  31 => 12,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 193,  278 => 116,  274 => 115,  270 => 114,  265 => 176,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 157,  238 => 104,  233 => 101,  228 => 100,  223 => 137,  218 => 96,  212 => 93,  210 => 127,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 87,  141 => 64,  133 => 63,  114 => 48,  111 => 59,  103 => 58,  98 => 50,  92 => 38,  86 => 44,  81 => 41,  76 => 33,  70 => 51,  64 => 25,  61 => 24,  56 => 21,  54 => 37,  52 => 20,  50 => 19,  48 => 17,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
