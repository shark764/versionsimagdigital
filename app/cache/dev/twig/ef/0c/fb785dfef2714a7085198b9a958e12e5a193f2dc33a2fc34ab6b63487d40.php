<?php

/* MinsalSimagdBundle:ImgNotaDiagnosticoAdmin:notdiag_crearNota_modal.html.twig */
class __TwigTemplate_ef0cfb785dfef2714a7085198b9a958e12e5a193f2dc33a2fc34ab6b63487d40 extends Twig_Template
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
";
        // line 4
        echo "<div id=\"crearNota-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-comments\"></i> <i class=\"fa fa-reply-all\"></i> <span id=\"formNotaTitle\">Crear nota a diagnóstico radiológico</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formNotaLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearNotaForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_nota_crearNota");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#notaTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-comment\"></span> Contenido <i class=\"fa\"></i></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"notaTab\" >

                                    <input type=\"hidden\" id=\"formNotaId\" name=\"formNotaId\" value=\"\" />
                                    <input type=\"hidden\" id=\"formNotaIdDiagnostico\" name=\"formNotaIdDiagnostico\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label required\">Realiza</label>
                                        <div class=\"col-xs-10\">
                                            <select id=\"formNotaIdEmpleado\" name=\"formNotaIdEmpleado\" class=\"form-control select2-select\" data-default=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"user\"
                                                      ";
        // line 50
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 54
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 55
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 56
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 57
                        echo "                                                        <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                        echo "</option>
                                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 59
                echo "                                                    </optgroup>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 62
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radiologo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label required\">Tipo</label>
                                        <div class=\"col-xs-10\">
                                            <select id=\"formNotaIdTipoNotaDiagnostico\" name=\"formNotaIdTipoNotaDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 71
        echo twig_escape_filter($this->env, (isset($context["tipoNotaDefault"]) ? $context["tipoNotaDefault"] : $this->getContext($context, "tipoNotaDefault")), "html", null, true);
        echo "\"
                                                      ";
        // line 73
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Tipos de nota\">
                                                ";
        // line 78
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tipos"]) ? $context["tipos"] : $this->getContext($context, "tipos")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            // line 79
            echo "                                                    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
            echo "</option>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label required\">Nota sobre el diagnóstico</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"8\" class=\"form-control summernote\" name=\"formNotaContenido\" id=\"formNotaContenido\" ";
        // line 98
        echo "
                                                      data-summernote-validators=\"true\"
                                                      data-summernote-notempty=\"true\"

                                                      data-fv-callback=\"true\"
                                                      data-fv-callback-message=\"Contenido de la nota es requerido\"
                                                      data-fv-callback-callback=\"check_contenidoNotaDiagnostico\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Observaciones</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formNotaObservaciones\" id=\"formNotaObservaciones\" placeholder=\"Digite sus observaciones adicionales\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 113
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"255\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"form-group\" style=\"";
        // line 128
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>

\t\t\t</form>

\t\t    ";
        // line 138
        echo "\t    </div>

        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_notdiag\" name=\"btn_agregar_notdiag\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Agregar</button>
            <button type=\"submit\" id=\"btn_editar_notdiag\" name=\"btn_editar_notdiag\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal -->
";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgNotaDiagnosticoAdmin:notdiag_crearNota_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 138,  207 => 128,  190 => 113,  174 => 98,  164 => 81,  153 => 79,  149 => 78,  142 => 73,  138 => 71,  117 => 62,  111 => 61,  103 => 59,  91 => 57,  86 => 56,  22 => 4,  19 => 2,  1261 => 745,  1258 => 744,  1255 => 743,  1253 => 738,  1250 => 736,  1247 => 728,  1244 => 727,  1240 => 726,  1237 => 725,  1234 => 724,  1230 => 723,  1227 => 722,  1224 => 721,  1220 => 720,  1218 => 719,  1215 => 718,  1212 => 717,  1204 => 715,  1201 => 714,  1198 => 713,  1190 => 711,  1188 => 710,  1185 => 709,  1182 => 708,  1174 => 706,  1172 => 705,  1168 => 703,  1165 => 702,  1157 => 700,  1155 => 699,  1151 => 697,  1148 => 696,  1140 => 694,  1138 => 693,  1134 => 691,  1131 => 690,  1129 => 689,  1122 => 688,  1117 => 685,  1102 => 673,  1095 => 670,  1089 => 667,  1081 => 662,  1077 => 660,  1071 => 657,  1069 => 656,  1066 => 655,  1064 => 654,  1061 => 653,  1038 => 632,  1032 => 627,  1029 => 624,  1012 => 610,  1008 => 608,  1001 => 607,  998 => 606,  996 => 605,  993 => 604,  969 => 582,  963 => 577,  960 => 574,  947 => 564,  940 => 560,  935 => 557,  920 => 545,  913 => 542,  907 => 539,  899 => 534,  895 => 532,  889 => 529,  887 => 528,  884 => 527,  882 => 526,  879 => 525,  858 => 506,  852 => 501,  849 => 498,  832 => 484,  828 => 482,  821 => 481,  818 => 480,  816 => 479,  813 => 478,  791 => 458,  785 => 453,  782 => 450,  769 => 440,  762 => 436,  757 => 433,  742 => 421,  735 => 418,  729 => 415,  721 => 410,  717 => 408,  711 => 405,  709 => 404,  706 => 403,  704 => 402,  701 => 401,  672 => 374,  666 => 369,  663 => 366,  646 => 352,  642 => 350,  635 => 349,  632 => 348,  630 => 347,  627 => 346,  624 => 345,  622 => 344,  598 => 322,  592 => 317,  589 => 314,  572 => 300,  568 => 298,  561 => 297,  558 => 296,  556 => 295,  553 => 294,  527 => 270,  524 => 269,  518 => 264,  516 => 262,  513 => 259,  500 => 249,  493 => 245,  489 => 243,  482 => 242,  479 => 241,  477 => 240,  471 => 238,  469 => 237,  466 => 234,  446 => 219,  439 => 217,  429 => 212,  422 => 210,  413 => 206,  406 => 204,  396 => 199,  389 => 197,  380 => 193,  373 => 191,  368 => 188,  365 => 187,  357 => 181,  350 => 176,  347 => 175,  334 => 167,  327 => 165,  317 => 160,  310 => 158,  300 => 153,  293 => 151,  288 => 148,  285 => 147,  280 => 144,  277 => 143,  272 => 140,  269 => 139,  266 => 138,  264 => 137,  258 => 135,  255 => 134,  248 => 130,  244 => 129,  239 => 128,  233 => 125,  229 => 123,  224 => 122,  218 => 119,  214 => 117,  209 => 116,  203 => 113,  198 => 111,  193 => 109,  187 => 106,  182 => 103,  178 => 102,  173 => 101,  137 => 71,  129 => 64,  121 => 69,  101 => 53,  98 => 52,  90 => 48,  84 => 45,  81 => 55,  76 => 54,  74 => 41,  72 => 40,  70 => 50,  68 => 34,  66 => 48,  64 => 32,  62 => 29,  60 => 26,  58 => 25,  56 => 24,  54 => 21,  52 => 20,  50 => 19,  48 => 18,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 9,  36 => 8,  34 => 21,  32 => 6,);
    }
}
