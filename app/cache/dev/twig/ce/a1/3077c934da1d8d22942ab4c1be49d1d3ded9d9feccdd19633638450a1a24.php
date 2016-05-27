<?php

/* MinsalSimagdBundle:ImgCitaAdmin:cit_listarPacientesSinCita_v2.html.twig */
class __TwigTemplate_cea13077c934da1d8d22942ab4c1be49d1d3ded9d9feccdd19633638450a1a24 extends Twig_Template
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
    <!-- toolbar for table-lista-solicitudes -->
    ";
        // line 4
        $context["code_entity"] = "prc";
        // line 5
        echo "    <div id=\"bs_";
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_toolbar\" class=\"table_bsTable_toolbar\"> <!-- toolbar for table-lista-entity -->

        ";
        // line 8
        echo "            <!-- Single button -->
            <div class=\"btn-group\">
                <button type=\"button\" id=\"btn_";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_display\" class=\"btn btn-primary-v2 dropdown-toggle btn_filter_display\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" title=\"Filtrar datos\" disabled=\"disabled\">
                    <i class=\"glyphicon glyphicon-filter\"></i>
                    Filtrar <span class=\"caret\"></span>
                </button>
                <!-- Menu -->
                <ul class=\"dropdown-menu table_bsTable_toolbar_menuFilter\" id=\"bs_";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_menuFilter\" >
                </ul>
            </div>
            <button id=\"btn_";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_send\" class=\"btn btn-primary-v2 btn_toolbar_filter_send\" title=\"Filtrar\" ";
        echo ">
                <i class=\"glyphicon glyphicon-repeat\"></i>
            </button>
            <button id=\"btn_";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["code_entity"]) ? $context["code_entity"] : $this->getContext($context, "code_entity")), "html", null, true);
        echo "_filter_remove\" class=\"btn btn-default btn_toolbar_filter_clear\" title=\"Restablecer\" ";
        echo ">
                <i class=\"glyphicon glyphicon-trash\"></i>
            </button>

            <!-- --| custom buttons for toolbar -->
            <span class=\"btn-separator\"></span>

            <button id=\"panel_patient_btn_default_view\" class=\"btn btn-element-v2 btn_panel_patient_default_view\" title=\"Regresar a vista predeterminada\" style=\"margin-left: 15px\" ";
        // line 28
        if (((isset($context["_PRC_ALLOW_VIEW"]) ? $context["_PRC_ALLOW_VIEW"] : $this->getContext($context, "_PRC_ALLOW_VIEW")) == false)) {
            echo " disabled=\"disabled\" ";
        }
        echo ">
                <i class=\"glyphicon glyphicon-resize-small \"></i>
            </button>
            <!-- END --| custom buttons for toolbar -->
        ";
        // line 33
        echo "
    </div> <!-- END --| toolbar for table-lista-solicitudes -->

    <div id=\"div-resultado-pacientes-sin-cita\" style=\"display: none;\" class=\"";
        // line 36
        echo " bstable-patiens-nodated\" data-refresh-url=\"";
        echo $this->env->getExtension('routing')->getPath("simagd_solicitud_estudio_listarPacientesSinCita");
        echo "\">
\t<table class=\"table table-condensed\" id=\"table-lista-pacientes-sin-cita\"
\t\tdata-toggle=\"table\"
\t\t  data-id-field=\"prc_id\"
\t\t  data-url=\"\"
\t\t  data-backup-url=\"simagd_solicitud_estudio_listarPacientesSinCita\"
\t\t  data-toolbar=\"#bs_prc_toolbar\"
\t\t  data-cache=\"false\"
\t\t  data-show-refresh=\"true\"
\t\t  data-show-toggle=\"true\"
\t\t  data-show-columns=\"true\"
\t\t  data-search=\"true\"
\t\t  data-select-item-name=\"listaSolicitudesToolbar\"
\t\t  ";
        // line 50
        echo "\t\t  data-pagination=\"true\"
\t\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 51
        echo "]\"
\t\t  ";
        // line 54
        echo "\t\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t\t  data-height=\"760\">
\t\t<thead>
\t\t    <tr style=\"background-color: #31708f !important; color: #fff !important;\">
\t\t\t";
        // line 59
        echo "\t\t\t<th data-field=\"prc_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t\t<th data-field=\"prc_empleado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t\t<th data-field=\"prc_referido\" data-visible=\"false\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido a</th>
\t\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t\t<th data-field=\"prAtn_nombre\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"prAtn_id\" data-filter-bstable-type=\"select2\" ";
        // line 67
        if ((((isset($context["_PRC_ALLOW_CREATE"]) ? $context["_PRC_ALLOW_CREATE"] : $this->getContext($context, "_PRC_ALLOW_CREATE")) == false) && ((isset($context["_PRC_ALLOW_EDIT"]) ? $context["_PRC_ALLOW_EDIT"] : $this->getContext($context, "_PRC_ALLOW_EDIT")) == false))) {
            echo " data-formatter=\"simagdPrioridadAtencionFormatter\" ";
        }
        echo " class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Prioridad</th>
\t\t\t<th data-field=\"prc_diagnosticante\" data-formatter=\"simagdDiagnosticanteFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Diagnosticar en</th>
\t\t\t<th data-field=\"prc_fechaCreacion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se creó</th>
\t\t\t<th data-field=\"prc_fechaProximaConsulta\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Próxima consulta</th>
\t\t\t<th data-field=\"statusSc_nombreEstado\" data-visible=\"false\" data-formatter=\"estadoSolicitudFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t\t<th data-field=\"action\" data-formatter=\"actionSolEstudioFormatter\" data-events=\"actionSolEstudioEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
\t\t    </tr>
\t\t</thead>
\t    </table>
        </table>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCitaAdmin:cit_listarPacientesSinCita_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 28,  49 => 18,  43 => 15,  35 => 10,  31 => 8,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 119,  278 => 116,  274 => 115,  270 => 114,  265 => 113,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 107,  238 => 104,  233 => 101,  228 => 100,  223 => 97,  218 => 96,  212 => 93,  210 => 92,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 68,  141 => 64,  133 => 63,  114 => 48,  111 => 47,  103 => 43,  98 => 50,  92 => 38,  86 => 35,  81 => 36,  76 => 33,  70 => 28,  64 => 25,  61 => 24,  56 => 21,  54 => 21,  52 => 20,  50 => 19,  48 => 16,  46 => 15,  44 => 14,  42 => 13,  40 => 12,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
