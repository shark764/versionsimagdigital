<?php

/* MinsalSimagdBundle:ImgCitaAdmin:cit_listarCitas_v2.html.twig */
class __TwigTemplate_b5fb64deef0deefc2c6d8cc58f17a4d92b8239a65916d24fc771101723392090 extends Twig_Template
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
        echo "    <!-- toolbar table-lista-citas -->
    ";
        // line 3
        $context["code_entity"] = "cit";
        // line 4
        echo "    <div id=\"bs_";
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

        ";
        // line 7
        echo "            <!-- Single button -->
            <div class=\"btn-group\">
                <button type=\"button\" id=\"btn_";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                    <i class=\"glyphicon glyphicon-filter\"></i>
                    Filtrar <span class=\"caret\"></span>
                </button>
                <!-- Menu -->
                <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_menuFilter\" >
                </ul>
            </div>
            <button id=\"btn_";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
        echo ">
                <i class=\"glyphicon glyphicon-repeat\"></i>
            </button>
            <button id=\"btn_";
        // line 20
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
        echo ">
                <i class=\"glyphicon glyphicon-trash\"></i>
            </button>

            <!-- --| custom buttons for toolbar -->
            <span class=\"btn-separator\"></span>

            <button id=\"btn_toolbar_send_patient_to_list\" class=\"btn btn-element-v2 btn_toolbar_send_patient_to_list\" title=\"Confirmar estas citas\" style=\"margin-left: 15px\" disabled=\"disabled\">
                <i class=\"glyphicon glyphicon-circle-arrow-right\"></i>
            </button>
            <button id=\"btn_toolbar_cancel_patient_date\" class=\"btn btn-danger btn_toolbar_cancel_patient_date\" title=\"Cancelar estas citas\" style=\"";
        // line 30
        echo "\" disabled=\"disabled\">
                <i class=\"glyphicon glyphicon-trash\"></i>
            </button>

            <span class=\"btn-separator\"></span>

            <button id=\"btn_toolbar_assign_patient_date\" class=\"btn btn-element-v2 btn_toolbar_assign_patient_date\" title=\"Asignar estas citas\" style=\"margin-left: 15px\" disabled=\"disabled\">
                <i class=\"glyphicon glyphicon-user\"></i>
            </button>
            <!-- END --| custom buttons for toolbar -->
        ";
        // line 41
        echo "
    </div> <!-- END --| toolbar table-lista-citas -->

    <div id=\"div-resultado-citas-programadas\" style=\"display: none;\" class=\"menu-vistas-agenda\" data-refresh-url=\"";
        // line 44
        echo $this->env->getExtension('routing')->getPath("simagd_cita_listarCitasProgramadas");
        echo "\">
    \t<table class=\"table table-condensed\" id=\"table-lista-citas\"
    \t\tdata-toggle=\"table\"
    \t\tdata-id-field=\"cit_id\"
    \t\tdata-url=\"\"
            data-backup-url=\"simagd_cita_listarCitasProgramadas\"
            data-toolbar=\"#bs_cit_toolbar\"
    \t\tdata-cache=\"false\"
    \t\tdata-show-refresh=\"true\"
    \t\tdata-show-toggle=\"true\"
    \t\tdata-show-columns=\"true\"
    \t\tdata-search=\"true\"
    \t\tdata-select-item-name=\"listaCitasToolbar\"
    \t\tdata-pagination=\"true\"
    \t\tdata-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 58
        echo "]\"
    \t\t";
        // line 61
        echo "    \t\tdata-classes=\"table table-hover table-condensed table-no-bordered\"
    \t\tdata-height=\"760\">
                <thead>
                    <tr style=\"background-color: #31708f; color: #fff;\">
                        ";
        // line 66
        echo "            \t\t    <th data-field=\"cit_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
            \t\t    <th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
            \t\t    <th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\"  data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
            \t\t    <th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\"  data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Remitió</th>
            \t\t    <th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\"  data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
            \t\t    <th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\"  data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
            \t\t    <th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\"  class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
            \t\t    <th data-field=\"prc_fechaCreacion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\"  data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se solicitó</th>
            \t\t    <th data-field=\"cit_fechaHoraInicio\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Inicia</th>
            \t\t    <th data-field=\"cit_fechaHoraFin\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Finaliza</th>
            \t\t    <th data-field=\"cit_diaCompleto\" data-formatter=\"diaCompletoCitaFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Día completo</th>
            \t\t    <th data-field=\"cit_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statuscit_id\" data-filter-bstable-type=\"select2\"  data-formatter=\"simagdEstadoCitaFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
            \t\t    <th data-field=\"cit_reprogramada\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"boolean\" data-filter-bstable-data-source=\"getReprogramadaSourceData\" data-formatter=\"reprogramadaFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Reprogramada</th>
            \t\t    <th data-field=\"cit_fechaHoraInicioAnterior\" data-visible=\"false\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Inicia (Anterior)</th>
            \t\t    <th data-field=\"cit_fechaHoraFinAnterior\" data-visible=\"false\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Finaliza (Anterior)</th>
            \t\t    <th data-field=\"cit_color\" data-formatter=\"colorCitaFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">Color</th>
            \t\t    <th data-field=\"cit_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlcit_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Será atendido por</th>
            \t\t    <th data-field=\"cit_empleado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empcit_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Programó</th>
            \t\t    <th data-field=\"cit_fechaCreacion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-visible=\"false\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se creó</th>
            \t\t    <th data-field=\"action\" data-formatter=\"actionCitaFormatter\" data-events=\"actionCitaEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
    \t\t        </tr>
                </thead>
        </table>
    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCitaAdmin:cit_listarCitas_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 66,  106 => 61,  69 => 30,  55 => 20,  30 => 7,  22 => 3,  94 => 68,  79 => 54,  75 => 53,  73 => 52,  24 => 4,  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 28,  49 => 18,  43 => 15,  35 => 19,  31 => 12,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 119,  278 => 116,  274 => 115,  270 => 114,  265 => 113,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 107,  238 => 104,  233 => 101,  228 => 100,  223 => 97,  218 => 96,  212 => 93,  210 => 92,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 68,  141 => 64,  133 => 63,  114 => 48,  111 => 47,  103 => 58,  98 => 50,  92 => 38,  86 => 44,  81 => 41,  76 => 33,  70 => 28,  64 => 25,  61 => 24,  56 => 21,  54 => 21,  52 => 20,  50 => 19,  48 => 17,  46 => 15,  44 => 14,  42 => 14,  40 => 12,  38 => 20,  36 => 8,  34 => 9,  32 => 6,);
    }
}
