<?php

/* MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_list_v2.html.twig */
class __TwigTemplate_6bd9147194068e8f71f30fa5c0ad4862b1b2a92773a19a46a40fe2beb708d11d extends Twig_Template
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
<div id=\"div-resultado-sin-validar\" style=\"display: none;\" class=\"";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["view_menu_class"]) ? $context["view_menu_class"] : $this->getContext($context, "view_menu_class")), "html", null, true);
        echo "\" data-refresh-url=\"";
        echo $this->env->getExtension('routing')->getPath("simagd_sin_validar_listarPendientesValidacion");
        echo "\">
    <table class=\"table table-condensed\" id=\"table-lista-pendientes-validacion\"
\t  data-toggle=\"table\"
\t  data-id-field=\"pndV_id\"
\t  data-url=\"\"
          data-backup-url=\"simagd_sin_validar_listarPendientesValidacion\"
\t  data-toolbar=\"#bs_pndV_toolbar\"
\t  data-cache=\"false\"
\t  data-show-refresh=\"true\"
\t  data-show-toggle=\"true\"
\t  data-show-columns=\"true\"
\t  data-search=\"true\"
\t  data-select-item-name=\"listaPendientesValidacionToolbar\"
\t  data-pagination=\"true\"
\t  data-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 17
        echo "]\"
\t  ";
        // line 20
        echo "\t  data-classes=\"table table-hover table-condensed table-no-bordered\"
\t  ";
        // line 22
        echo "\t  ";
        // line 24
        echo "\t  data-height=\"760\">
\t<thead>
\t    <tr style=\"background-color: #31708f; color: #fff;\">
\t\t";
        // line 28
        echo "\t\t<th data-field=\"pndV_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t<th data-field=\"prc_origen\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdroot_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdOrigenFormatter\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Referido desde</th>
\t\t<th data-field=\"prc_paciente\" data-filter-bstable-apply=\"false\" data-filter-bstable-by=\"pct_id\" data-filter-bstable-type=\"select2\" data-filter-bstable-remote-data-source=\"true\" data-formatter=\"simagdPacienteFormatter\" data-switchable=\"false\" class=\"col-md-3\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Paciente</th>
\t\t<th data-field=\"prc_solicitante\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empprc_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Solicitó</th>
\t\t<th data-field=\"prc_areaAtencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"ar_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdAreaAtencionFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Procedencia</th>
\t\t<th data-field=\"prc_atencion\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"atn_id\" data-filter-bstable-type=\"select2\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Servicio clínico</th>
\t\t<th data-field=\"prc_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t<th data-field=\"prc_referido\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"stdref_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdReferidoFormatter\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizado en</th>
\t\t<th data-field=\"prz_tecnologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"tcnlprz_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Realizó</th>
\t\t<th data-field=\"diag_transcriptor\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empdiag_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Transcribió</th>
\t\t<th data-field=\"diag_estado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"statusdiag_id\" data-filter-bstable-type=\"select2\" data-formatter=\"simagdEstadoDiagnosticoFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Estado</th>
\t\t<th data-field=\"diag_fechaTranscrito\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se transcribió</th>
\t\t<th data-field=\"lct_radiologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"emplct_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Interpretó</th>
\t\t<th data-field=\"lct_correlativo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Correlativo</th>
\t\t<th data-field=\"lct_fechaLectura\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se interpretó</th>
\t\t<th data-field=\"pndV_fechaIngresoLista\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-2\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Ingresó en lista</th>
\t\t<th data-field=\"pndV_fueCorregido\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"boolean\" data-formatter=\"corregidoFormatter\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Desde corrección</th>
\t\t<th data-field=\"action\" data-formatter=\"pendienteValidacion_actionFormatter\" data-events=\"pendienteValidacion_actionEvents\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\"><span class=\"glyphicon glyphicon-cog\"></span></th>
                <th data-field=\"pndV_chk\" data-checkbox=\"true\" data-formatter=\"selectableRowFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-valign=\"middle\"></th>
\t    </tr>
\t</thead>
    </table>
</div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgPendienteValidacionAdmin:pndV_list_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 28,  47 => 22,  41 => 17,  22 => 3,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  627 => 335,  624 => 334,  616 => 332,  614 => 331,  610 => 329,  607 => 328,  599 => 326,  597 => 325,  593 => 323,  590 => 322,  587 => 321,  584 => 320,  580 => 319,  577 => 318,  574 => 317,  570 => 316,  568 => 315,  565 => 314,  562 => 313,  554 => 311,  552 => 310,  549 => 309,  546 => 308,  544 => 307,  537 => 306,  532 => 303,  517 => 291,  510 => 288,  504 => 285,  496 => 280,  492 => 278,  486 => 275,  484 => 274,  481 => 273,  479 => 272,  476 => 271,  455 => 252,  449 => 247,  446 => 244,  429 => 230,  425 => 228,  418 => 227,  415 => 226,  413 => 225,  410 => 224,  388 => 204,  382 => 199,  379 => 196,  366 => 186,  359 => 182,  354 => 179,  339 => 167,  332 => 164,  326 => 161,  318 => 156,  314 => 154,  308 => 151,  306 => 150,  303 => 149,  301 => 148,  298 => 147,  294 => 145,  291 => 144,  273 => 131,  265 => 129,  262 => 128,  254 => 122,  247 => 117,  244 => 116,  233 => 110,  226 => 108,  217 => 104,  209 => 102,  206 => 101,  201 => 98,  198 => 97,  193 => 94,  190 => 93,  188 => 92,  182 => 90,  179 => 89,  172 => 85,  168 => 84,  163 => 83,  158 => 81,  154 => 79,  149 => 78,  143 => 75,  138 => 72,  134 => 71,  129 => 70,  97 => 44,  88 => 42,  69 => 27,  66 => 26,  58 => 22,  52 => 19,  49 => 24,  44 => 20,  42 => 15,  40 => 14,  38 => 11,  36 => 8,  34 => 7,  32 => 6,);
    }
}
