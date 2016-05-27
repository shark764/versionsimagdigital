<?php

/* MinsalSimagdBundle:show_entity_block:lct_entity_block.html.twig */
class __TwigTemplate_3c00ed647b3bb925c6e7fb55a4db0a2cd954b36f5bf5cf023f2abceb47fba6f9 extends Twig_Template
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
    <div class=\"tab-pane fade ";
        // line 3
        if (((isset($context["tab_active"]) ? $context["tab_active"] : $this->getContext($context, "tab_active")) != false)) {
            echo "in active";
        }
        echo "\" id=\"lct_lecturaTab\" >
        <div class=\"box box-";
        // line 4
        echo twig_escape_filter($this->env, ((array_key_exists("box_style", $context)) ? (_twig_default_filter((isset($context["box_style"]) ? $context["box_style"] : $this->getContext($context, "box_style")), "primary-v2")) : ("primary-v2")), "html", null, true);
        echo " non-titled-sonata-box\">
            <div class=\"box-body\">
\t\t<table class=\"table table-condensed table-responsive table-borderless non-top-bordered-table full-collapse-bordered-table\">
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "id"), "html", null, true);
        echo "</span></td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Radiólogo:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "idEmpleado"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Usuario:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "idUserReg"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha de lectura:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 19
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "fechaLectura"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "fechaLectura"), "H:i:s A")), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "idEstadoLectura"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Tipo de resultado:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "idTipoResultado"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Indicaciones:</span></th>
\t\t\t<td class=\"col-md-3\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "indicaciones"), "html", null, true);
        echo "</pre>
                        </td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Correlativo:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "correlativo"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "observaciones"), "html", null, true);
        echo "</pre>
                        </td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Aprobación por:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "idRadiologoDesignadoAprobacion"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Patrón a utilizar:</span></th>
\t\t\t<td colspan=\"3\" class=\"col-md-9\" >";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "idPatronAsociado"), "html", null, true);
        echo "</td>
\t\t    </tr>
\t\t    <tr>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Agregada por radiólogo:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "solicitadaPorRadiologo"), "html", null, true);
        echo "</td>
\t\t\t<th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Agregó a cola:</span></th>
\t\t\t<td class=\"col-md-3\" >";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_rxresult"]) ? $context["object_rxresult"] : $this->getContext($context, "object_rxresult")), "idRadiologoSolicita"), "html", null, true);
        echo "</td>
\t\t    </tr>
                    
                    <tr>
                        <td colspan=\"4\" class=\"col-md-12\" ><span class=\"label label-primary-v2\">Transcripción de diagnóstico</span></td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">id (Transcripción):</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" ><span class=\"badge\">";
        // line 61
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "id"), "html", null, true);
        }
        echo "</span></td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Transcribe:</span></th>
                        <td class=\"col-md-3\" >";
        // line 65
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "idEmpleado"), "html", null, true);
        }
        echo "</td>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Usuario:</span></th>
                        <td class=\"col-md-3\" >";
        // line 67
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "idUserReg"), "html", null, true);
        }
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Fecha de registro:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 71
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "fechaRegistro"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "fechaRegistro"), "H:i:s A")), "html", null, true);
        }
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Estado:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 75
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "idEstadoDiagnostico"), "html", null, true);
        }
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Patrón aplicado:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 79
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "idPatronAplicado"), "html", null, true);
        }
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Hallazgos:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >
                            ";
        // line 84
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "hallazgos");
        }
        // line 85
        echo "                        </td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Conclusión:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >
                            ";
        // line 90
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "conclusion");
        }
        // line 91
        echo "                        </td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Recomendaciones:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >
                            ";
        // line 96
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "recomendaciones");
        }
        // line 97
        echo "                        </td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Errores de transcripción:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 102
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "errores"), "html", null, true);
        }
        echo "</pre>
                        </td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Transcripción finalizó:</span></th>
                        <td class=\"col-md-3\" >
                            ";
        // line 108
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            // line 109
            echo "                                ";
            if ((!(null === $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "fechaTranscrito")))) {
                // line 110
                echo "                                    ";
                echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "fechaTranscrito"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "fechaTranscrito"), "H:i:s A")), "html", null, true);
                echo "
                                ";
            }
            // line 112
            echo "                            ";
        }
        // line 113
        echo "                        </td>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Diagnóstico se aprobó:</span></th>
                        <td class=\"col-md-3\" >
                            ";
        // line 116
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            // line 117
            echo "                                ";
            if ((!(null === $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "fechaAprobado")))) {
                // line 118
                echo "                                    ";
                echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "fechaAprobado"), "EEEE, MMMM d, yyyy", "es_ES") . " ") . twig_date_format_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "fechaAprobado"), "H:i:s A")), "html", null, true);
                echo "
                                ";
            }
            // line 120
            echo "                            ";
        }
        // line 121
        echo "                        </td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Aprobó:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >";
        // line 125
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "idRadiologoAprueba"), "html", null, true);
        }
        echo "</td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Incidencias:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 130
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "incidencias"), "html", null, true);
        }
        echo "</pre>
                        </td>
                    </tr>
                    <tr>
                        <th class=\"col-md-3 simagd-th-text-primary\"><span class=\"simagd-text-primary\">Observaciones:</span></th>
                        <td colspan=\"3\" class=\"col-md-9\" >
                            <pre class=\"pre-display-code-natural\">";
        // line 136
        if ((!(null === (isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic"))))) {
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object_diagnostic"]) ? $context["object_diagnostic"] : $this->getContext($context, "object_diagnostic")), "observaciones"), "html", null, true);
        }
        echo "</pre>
                        </td>
                    </tr>
\t\t</table>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:show_entity_block:lct_entity_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  284 => 136,  273 => 130,  248 => 118,  245 => 117,  243 => 116,  238 => 113,  235 => 112,  229 => 110,  226 => 109,  213 => 102,  206 => 97,  202 => 96,  191 => 90,  184 => 85,  180 => 84,  170 => 79,  161 => 75,  152 => 71,  143 => 67,  136 => 65,  127 => 61,  116 => 53,  111 => 51,  104 => 47,  89 => 38,  75 => 30,  62 => 23,  55 => 19,  48 => 15,  43 => 13,  36 => 9,  28 => 4,  22 => 3,  19 => 2,  541 => 321,  538 => 320,  535 => 319,  532 => 318,  523 => 315,  520 => 314,  515 => 313,  513 => 312,  510 => 311,  504 => 307,  500 => 306,  498 => 305,  493 => 304,  491 => 303,  488 => 302,  486 => 301,  484 => 298,  480 => 296,  477 => 295,  474 => 294,  471 => 293,  462 => 290,  459 => 289,  454 => 288,  452 => 287,  449 => 286,  443 => 282,  439 => 281,  437 => 280,  432 => 279,  430 => 278,  427 => 277,  419 => 275,  417 => 274,  414 => 273,  407 => 271,  402 => 270,  400 => 269,  397 => 268,  393 => 263,  390 => 262,  384 => 259,  380 => 257,  377 => 256,  374 => 255,  368 => 253,  362 => 251,  359 => 250,  357 => 249,  354 => 248,  351 => 247,  346 => 244,  343 => 243,  335 => 241,  333 => 240,  329 => 238,  326 => 237,  321 => 235,  318 => 234,  315 => 233,  310 => 230,  307 => 223,  304 => 222,  299 => 177,  296 => 176,  288 => 175,  286 => 174,  283 => 173,  280 => 172,  275 => 218,  268 => 183,  263 => 125,  261 => 172,  257 => 121,  254 => 120,  252 => 161,  250 => 157,  247 => 156,  236 => 147,  233 => 146,  224 => 108,  217 => 134,  214 => 133,  210 => 131,  207 => 130,  198 => 126,  195 => 91,  192 => 124,  186 => 120,  182 => 119,  177 => 118,  175 => 117,  172 => 116,  167 => 112,  162 => 109,  158 => 108,  153 => 106,  145 => 101,  134 => 93,  124 => 85,  110 => 44,  101 => 38,  97 => 43,  93 => 35,  87 => 30,  81 => 33,  76 => 23,  72 => 22,  67 => 25,  61 => 18,  58 => 17,  51 => 14,  45 => 11,  42 => 10,  37 => 6,  35 => 5,);
    }
}
