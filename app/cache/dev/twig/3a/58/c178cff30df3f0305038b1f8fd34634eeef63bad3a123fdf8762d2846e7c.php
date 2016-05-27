<?php

/* MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_listarBloqueos.html.twig */
class __TwigTemplate_3a58c178cff30df3f0305038b1f8fd34634eeef63bad3a123fdf8762d2846e7c extends Twig_Template
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
    <!-- toolbar table-lista-bloqueos -->
    ";
        // line 4
        try {
            $this->env->loadTemplate("MinsalSimagdBundle:Menu:simagd_bstable_toolbar.html.twig")->display(array_merge($context, array("code_entity" => "blAgd")));
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 5
        echo "    <!-- END --| toolbar table-lista-bloqueos -->

    <div id=\"div-resultado-bloqueos-agenda\" style=\"display: none;\" class=\"menu-vistas-agenda\" data-refresh-url=\"";
        // line 7
        echo $this->env->getExtension('routing')->getPath("simagd_bloqueo_agenda_listarBloqueos");
        echo "\">
\t<table class=\"table table-condensed\" id=\"table-lista-bloqueos\"
\t\tdata-toggle=\"table\"
\t\tdata-id-field=\"blAgd_id\"
\t\tdata-url=\"\"
                data-backup-url=\"simagd_bloqueo_agenda_listarBloqueos\"
                data-toolbar=\"#bs_blAgd_toolbar\"
\t\tdata-cache=\"false\"
\t\tdata-show-refresh=\"true\"
\t\tdata-show-toggle=\"true\"
\t\tdata-show-columns=\"true\"
\t\tdata-search=\"true\"
\t\tdata-select-item-name=\"listaBloqueosToolbar\"
\t\tdata-pagination=\"true\"
\t\tdata-page-list=\"[5, 10, 15, 25, 50, 75, 100";
        // line 21
        echo "]\"
\t\t";
        // line 24
        echo "\t\tdata-classes=\"table table-hover table-condensed table-no-bordered\"
\t\tdata-height=\"760\">
            <thead>
                <tr style=\"background-color: #31708f; color: #fff;\">
                    ";
        // line 29
        echo "\t\t    <th data-field=\"blAgd_id\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"number\" class=\"col-md-1\" data-visible=\"false\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">ID</th>
\t\t    <th data-field=\"blAgd_titulo\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"text\" data-switchable=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Título</th>
\t\t    <th data-field=\"blAgd_fechaInicio\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Inicia</th>
\t\t    <th data-field=\"blAgd_fechaFin\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-formatter=\"simagdDateFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Finaliza</th>
\t\t    <th data-field=\"blAgd_horaInicio\" ";
        // line 33
        echo " data-formatter=\"simagdTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Rango Inicio</th>
\t\t    <th data-field=\"blAgd_horaFin\" ";
        // line 34
        echo " data-formatter=\"simagdTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Rango Fin</th>
\t\t    <th data-field=\"blAgd_diaCompleto\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"boolean\" data-filter-bstable-data-source=\"getDiaCompletoSourceData\" data-formatter=\"diaCompletoBloqueoFormatter\" data-visible=\"false\" class=\"col-md-1\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Día completo</th>
\t\t    <th data-field=\"blAgd_color\" data-formatter=\"colorBloqueoFormatter\" class=\"col-md-1\" data-align=\"center\" data-halign=\"center\" data-sortable=\"true\">Color</th>
\t\t    <th data-field=\"blAgd_modalidad\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"m_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Modalidad</th>
\t\t    <th data-field=\"blAgd_radiologo\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"radx_id\" data-filter-bstable-type=\"select2\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Radiólogo</th>
\t\t    <th data-field=\"blAgd_empleado\" data-filter-bstable-apply=\"true\" data-filter-bstable-by=\"empblAgd_id\" data-filter-bstable-type=\"select2\" data-visible=\"false\" class=\"col-md-2\" data-align=\"left\" data-halign=\"center\" data-sortable=\"true\">Registró</th>
\t\t    <th data-field=\"blAgd_fechaCreacion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-visible=\"false\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se creó</th>
\t\t    <th data-field=\"blAgd_fechaUltimaEdicion\" data-filter-bstable-apply=\"true\" data-filter-bstable-type=\"combodate\" data-visible=\"false\" data-formatter=\"simagdDateTimeFormatter\" class=\"col-md-1\" data-align=\"right\" data-halign=\"center\" data-sortable=\"true\">Se modificó</th>
\t\t    <th data-field=\"action\" data-formatter=\"actionBloqueoFormatter\" data-events=\"actionBloqueoEvents\" class=\"col-md-1\"></th>
\t\t</tr>
            </thead>
        </table>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_listarBloqueos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 33,  60 => 29,  51 => 21,  172 => 131,  162 => 121,  145 => 106,  127 => 89,  95 => 59,  83 => 57,  78 => 56,  71 => 51,  310 => 218,  300 => 208,  247 => 159,  237 => 151,  217 => 132,  197 => 125,  193 => 124,  186 => 119,  155 => 89,  135 => 71,  132 => 69,  123 => 61,  105 => 58,  97 => 56,  85 => 54,  80 => 53,  112 => 66,  106 => 69,  69 => 34,  55 => 20,  30 => 5,  22 => 4,  94 => 68,  79 => 54,  75 => 52,  73 => 52,  24 => 4,  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 49,  49 => 18,  43 => 15,  35 => 19,  31 => 12,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 193,  278 => 116,  274 => 115,  270 => 114,  265 => 176,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 157,  238 => 104,  233 => 101,  228 => 100,  223 => 137,  218 => 96,  212 => 93,  210 => 127,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 87,  141 => 64,  133 => 63,  114 => 48,  111 => 59,  103 => 58,  98 => 50,  92 => 38,  86 => 44,  81 => 41,  76 => 33,  70 => 51,  64 => 25,  61 => 24,  56 => 21,  54 => 24,  52 => 20,  50 => 19,  48 => 17,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 7,  32 => 6,);
    }
}
