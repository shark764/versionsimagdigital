<?php

/* MinsalSimagdBundle:ImgCitaAdmin:cit_popover_contentwrapper.html.twig */
class __TwigTemplate_d2714a908c9c83ef17e040db4af3cf6c0284b2b1e8d808459d712f9c438ec582 extends Twig_Template
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
        // line 1
        echo "

    <div class=\"prc_container_contentwrapper\" style=\"display: none;\"> <!-- data-contentwrapper selector-->
\t";
        // line 5
        echo "\t    <table class=\"table table-hover table-condensed table-responsive table-borderless\">
\t\t<tr>
\t\t    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Origen:</span></th>
\t\t    <td class=\"col-md-10\" colspan=\"3\" data-render-info=\"idEstablecimiento\"></td>
\t\t</tr>
\t\t<tr>
\t\t    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Procedencia:</span></th>
\t\t    <td class=\"col-md-4\" data-render-info=\"idAreaAtencion\"></td>
\t\t    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Servicio:</span></th>
\t\t    <td class=\"col-md-4\" data-render-info=\"idAtencion\"></td>
\t\t</tr>
\t\t<tr>
\t\t    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Solicitante:</span></th>
\t\t    <td class=\"col-md-10\" colspan=\"3\" data-render-info=\"idEmpleado\"></td>
\t\t</tr>
\t\t<tr>
\t\t    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Creada:</span></th>
\t\t    <td class=\"col-md-10\" colspan=\"3\" data-render-info=\"fechaCreacion\"></td>
\t\t</tr>
\t\t<tr>
\t\t    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Modalidad:</span></th>
\t\t    <td class=\"col-md-10\" colspan=\"3\" data-render-info=\"idAreaServicioDiagnostico\"></td>
\t\t</tr>
\t\t<tr>
                    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Proyecciones:</span></th>
\t\t    <td class=\"col-md-10\" colspan=\"3\" data-render-info=\"\"></td>
\t\t</tr>
\t\t<tr>
                    <td class=\"col-md-12\" style=\"border-top: 0px solid #fff !important;\" colspan=\"4\" data-render-info=\"solicitudEstudioProyeccion\"></td>
\t\t</tr>
\t\t<tr>
\t\t    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Próxima consulta:</span></th>
\t\t    <td class=\"col-md-4\" data-render-info=\"fechaProximaConsulta\"></td>
\t\t    <th class=\"col-md-2\"><span class=\"simagd-text-primary\">Prioridad:</span></th>
\t\t    <td class=\"col-md-4\" data-render-info=\"idPrioridadAtencion\"></td>
\t\t</tr>
\t\t<tr>
\t\t    <td colspan=\"4\" class=\"col-md-12\">
\t\t\t<div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
\t\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t\t<button type=\"button\" class=\"btn btn-primary-v2 btn-sm editable-submit show-solicitud-action\" title=\"Mostrar solicitud detallada\"><i class=\"glyphicon glyphicon-info-sign\"></i></button>
\t\t\t    </div>
\t\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t\t<a class=\"btn btn-primary-v2 btn-sm editable-submit edit-solicitud-action\" href=\"javascript:void(0)\" target=\"_blank\" title=\"Editar solicitud de estudio\"><i class=\"glyphicon glyphicon-repeat\"></i></a>
\t\t\t    </div>
\t\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t\t<button type=\"button\" class=\"btn btn-primary-v2 btn-sm editable-submit radx-ind-solicitud-action\" title=\"Agregar indicaciones del Médico radiólogo\"
\t\t\t\t";
        // line 52
        if ((!(($this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_LECTURA_CREATE") || $this->env->getExtension('security')->isGranted("ROLE_MINSAL_SIMAGD_ADMIN_IMG_CITA_CREATE")) || $this->env->getExtension('security')->isGranted("ROLE_ADMIN")))) {
            // line 53
            echo "\t\t\t\t    disabled=\"disabled\"
\t\t\t\t";
        }
        // line 54
        echo "><i class=\"glyphicon glyphicon-log-in\"></i></button>
\t\t\t    </div>
\t\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t\t<button type=\"button\" class=\"btn btn-element-v2 btn-sm editable-submit sin-cita-solicitud-action\" title=\"Enviar a lista de trabajo\"><i class=\"glyphicon glyphicon-circle-arrow-right\"></i></button>
\t\t\t    </div>
\t\t\t    <div class=\"btn-group\" role=\"group\">
\t\t\t\t<button type=\"button\" class=\"btn btn-default btn-sm editable-cancel close-solicitud-action\" title=\"Cerrar\"><i class=\"glyphicon glyphicon-remove\"></i></button>
\t\t\t    </div>
\t\t\t</div>
\t\t    </td>
\t\t</tr>
\t\t
\t    </table>
\t";
        // line 68
        echo "    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCitaAdmin:cit_popover_contentwrapper.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 68,  79 => 54,  75 => 53,  73 => 52,  24 => 5,  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 28,  49 => 18,  43 => 15,  35 => 10,  31 => 8,  25 => 5,  19 => 1,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 119,  278 => 116,  274 => 115,  270 => 114,  265 => 113,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 107,  238 => 104,  233 => 101,  228 => 100,  223 => 97,  218 => 96,  212 => 93,  210 => 92,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 68,  141 => 64,  133 => 63,  114 => 48,  111 => 47,  103 => 43,  98 => 50,  92 => 38,  86 => 35,  81 => 36,  76 => 33,  70 => 28,  64 => 25,  61 => 24,  56 => 21,  54 => 21,  52 => 20,  50 => 19,  48 => 16,  46 => 15,  44 => 14,  42 => 13,  40 => 12,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
