<?php

/* MinsalSimagdBundle:show_entity_block:pct_bloque_informacion_v2.html.twig */
class __TwigTemplate_57802ce67e3b30239b35496281e3406e7bb62fcf616cfc1fc0b906c2d2c22528 extends Twig_Template
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
    <table class=\"table table-condensed\">
\t<tr>
\t    <th class=\"col-md-2\">Posee expediente:</th>
\t    <td class=\"col-md-4\" data-render-info=\"idExpediente\"></td>
\t    <th class=\"col-md-2\">Creado:</th>
\t    <td class=\"col-md-4\" data-render-info=\"fechaCreacion\"></td>
\t</tr>
\t<tr>
\t    <th class=\"col-md-2\">Expediente:</th>
\t    <td class=\"col-md-4\" data-render-info=\"numero\"></td>
\t    <th class=\"col-md-2\">Habilitado:</th>
\t    <td class=\"col-md-4\" data-render-info=\"habilitado\"></td>
\t</tr>
\t<tr>
\t    <th class=\"col-md-2\">Nombre:</th>
\t    <td class=\"col-md-4\" data-render-info=\"nombreCompleto\"></td>
\t    <th class=\"col-md-2\">Registrado:</th>
\t    <td class=\"col-md-4\" data-render-info=\"fechaRegistro\"></td>
\t</tr>
\t<tr>
\t    <th class=\"col-md-2\">Nació:</th>
\t    <td class=\"col-md-4\" data-render-info=\"fechaNacimiento\"></td>
\t    <th class=\"col-md-2\">Ocupación:</th>
\t    <td class=\"col-md-4\" data-render-info=\"idOcupacion\"></td>
\t</tr>
\t<tr>
\t    <th class=\"col-md-2\">Identificación:</th>
\t    <td class=\"col-md-4\" data-render-info=\"numeroDocIdePaciente\"></td>
\t    <th class=\"col-md-2\">Nacionalidad:</th>
\t    <td class=\"col-md-4\" data-render-info=\"idNacionalidad\"></td>
\t</tr>
\t<tr>
\t    <th class=\"col-md-2\">Sexo:</th>
\t    <td class=\"col-md-4\" data-render-info=\"idSexo\"></td>
\t    <th class=\"col-md-2\">Estado civil:</th>
\t    <td class=\"col-md-4\" data-render-info=\"idEstadoCivil\"></td>
\t</tr>
\t
\t<tr>
\t    <td colspan=\"4\" class=\"col-md-12\">
\t\t<div class=\"alert alert-info alert-dismissible\" role=\"alert\">
\t\t    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">
\t\t\t<span aria-hidden=\"true\">&times;</span>
\t\t\t<span class=\"sr-only\"> Cerrar </span>
\t\t    </button>
\t\t    <strong>Detalle del paciente!</strong> Haga click para ver datos del paciente.
\t\t</div>
\t    </td>
\t</tr>
\t<tr>
\t    <td colspan=\"4\" class=\"col-md-12\">
\t\t<button class=\"btn btn-primary-v2 btn-block\" ";
        // line 54
        echo "data-toggle=\"modal\" href=\"#pacienteFullData-showModalContainer\" id=\"btn_ver_pct_total_info\">
\t\t    <i class=\"fa fa-plus-circle\"></i> Abrir detalle
\t\t</button>
\t    </td>
\t</tr>
\t
    </table>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:pct_bloque_informacion_v2.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  224 => 185,  218 => 180,  215 => 177,  178 => 143,  175 => 140,  139 => 106,  133 => 101,  130 => 98,  100 => 70,  94 => 65,  73 => 54,  69 => 46,  64 => 43,  61 => 42,  35 => 17,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  580 => 365,  577 => 364,  575 => 363,  567 => 362,  564 => 361,  561 => 360,  557 => 359,  555 => 358,  551 => 356,  549 => 355,  526 => 334,  523 => 331,  511 => 321,  501 => 313,  492 => 308,  480 => 301,  468 => 293,  461 => 290,  455 => 287,  447 => 282,  443 => 280,  437 => 277,  435 => 276,  407 => 250,  396 => 248,  391 => 247,  380 => 245,  375 => 244,  364 => 242,  360 => 241,  324 => 207,  306 => 190,  285 => 170,  268 => 154,  247 => 134,  230 => 118,  213 => 102,  202 => 92,  199 => 90,  192 => 82,  189 => 81,  184 => 148,  168 => 69,  164 => 67,  161 => 66,  156 => 63,  151 => 60,  148 => 59,  144 => 56,  138 => 54,  135 => 53,  128 => 49,  124 => 48,  120 => 47,  115 => 46,  110 => 43,  105 => 42,  99 => 39,  91 => 62,  75 => 48,  67 => 45,  57 => 17,  54 => 16,  46 => 12,  43 => 11,  38 => 9,  36 => 8,  34 => 7,  32 => 6,);
    }
}
