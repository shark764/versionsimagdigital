<?php

/* MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_crearBloqueo_modal.html.twig */
class __TwigTemplate_dcbdb00ab49e0d1603b9ae04018a559b95b4e99aa8e131cb5e0612d27a4d113d extends Twig_Template
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
        echo "<div id=\"crearBloqueo-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-unlock-alt\"></i> <span id=\"formBlAgdTitle\">Nuevo Bloqueo</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formBlAgdLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"crearBloqueoForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_bloqueo_agenda_nuevoBloqueo");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#bloqueoTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-lock\"></span> Bloqueo <i class=\"fa\"></i></a></li>
";
        // line 39
        echo "                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"bloqueoTab\" >

                                    <input type=\"hidden\" id=\"formBlAgdId\" name=\"formBlAgdId\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Modalidad</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formBlAgdIdAreaServicioDiagnostico\" name=\"formBlAgdIdAreaServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["default_mldRx"]) ? $context["default_mldRx"] : $this->getContext($context, "default_mldRx")), "html", null, true);
        echo "\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Imagenología\">
                                                ";
        // line 53
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 54
            echo "                                                    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "html", null, true);
            echo "</option>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modalidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Radiólogo</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formBlAgdIdRadiologoBloqueo\" name=\"formBlAgdIdRadiologoBloqueo\" class=\"form-control select2-select\" data-apply-formatter=\"user\" >
                                                <option value=\"\"></option>
                                                ";
        // line 66
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 67
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 68
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 69
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
                // line 71
                echo "                                                    </optgroup>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 74
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
        // line 76
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Rangos</label>
                                        <div class=\"col-xs-4\">
                                            <input type=\"text\" class=\"form-control\" placeholder=\"Fecha inicio\" id=\"formBlAgdFechaInicio\" name=\"formBlAgdFechaInicio\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\"
                                                      ";
        // line 85
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-date=\"true\"
                                                      data-fv-date-format=\"YYYY-MM-DD\"
                                                      data-fv-date-max=\"formBlAgdFechaFin\"
                                                      data-fv-date-message=\"Fecha no válida\" />
                                        </div>
                                        <div class=\"col-xs-4\">
                                            <input type=\"text\" class=\"form-control\" placeholder=\"Fecha fin\" id=\"formBlAgdFechaFin\" name=\"formBlAgdFechaFin\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD\"
                                                      ";
        // line 97
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-date=\"true\"
                                                      data-fv-date-format=\"YYYY-MM-DD\"
                                                      data-fv-date-min=\"formBlAgdFechaInicio\"
                                                      data-fv-date-message=\"Fecha no válida\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-4 col-xs-offset-4\">
                                            <input type=\"text\" class=\"form-control\" placeholder=\"Hora inicio\" id=\"formBlAgdHoraInicio\" name=\"formBlAgdHoraInicio\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"HH:mm\"
                                                      ";
        // line 112
        echo "
                                                      data-fv-verbose=\"false\"

                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^(0?[0-9]|1[0-9]|2[0-3])(:[0-5]\\d)\$\"
                                                      data-fv-regexp-message=\"Hora inicio < Hora fin\"

                                                      data-fv-callback=\"true\"
                                                      data-fv-callback-message=\"Hora inicio < Hora fin\"
                                                      data-fv-callback-callback=\"checkHoraInicio\" />
                                        </div>
                                        <div class=\"col-xs-4\">
                                            <input type=\"text\" class=\"form-control\" placeholder=\"Hora fin\" id=\"formBlAgdHoraFin\" name=\"formBlAgdHoraFin\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"HH:mm\"
                                                      ";
        // line 129
        echo "
                                                      data-fv-verbose=\"false\"

                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^(0?[0-9]|1[0-9]|2[0-3])(:[0-5]\\d)\$\"
                                                      data-fv-regexp-message=\"Hora fin > Hora inicio\"

                                                      data-fv-callback=\"true\"
                                                      data-fv-callback-message=\"Hora fin > Hora inicio\"
                                                      data-fv-callback-callback=\"checkHoraFin\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <div class=\"col-xs-8 col-xs-offset-4\">
                                            <div class=\"checkbox\">
                                                <label>
                                                    <input type=\"checkbox\" value=\"1\" name=\"formBlAgdDiaCompleto\" id=\"formBlAgdDiaCompleto\" checked=\"checked\" /> Día completo
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                ";
        // line 157
        echo "
                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Título</label>
                                        <div class=\"col-xs-8\">
                                            <input type=\"text\" class=\"form-control\" placeholder=\"Digite un título\" id=\"formBlAgdTitulo\" name=\"formBlAgdTitulo\" maxlength=\"75\"
                                                      ";
        // line 163
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"75\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Color</label>
                                        <div class=\"col-xs-8\">
                                            <input type=\"text\" class=\"form-control\" placeholder=\"Color de fondo\" id=\"formBlAgdColor\" name=\"formBlAgdColor\"
                                                      ";
        // line 183
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"1\"
                                                      data-fv-stringlength-max=\"15\"
                                                      data-fv-stringlength-message=\"1 caracter mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-Z0-9,:\\.#()_-]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" >
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Descripción</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formBlAgdDescripcion\" id=\"formBlAgdDescripcion\" placeholder=\"Digite una descripción sobre el bloqueo\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 200
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
        // line 215
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>

\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 225
        echo "\t    </div>

        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_blAgd\" name=\"btn_agregar_blAgd\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_blAgd\" name=\"btn_editar_blAgd\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgBloqueoAgendaAdmin:blAgd_crearBloqueo_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  313 => 225,  303 => 215,  286 => 200,  268 => 183,  240 => 157,  194 => 112,  178 => 97,  165 => 85,  143 => 74,  137 => 73,  129 => 71,  117 => 69,  107 => 67,  102 => 66,  90 => 56,  66 => 33,  60 => 29,  51 => 21,  172 => 131,  162 => 121,  145 => 106,  127 => 89,  95 => 59,  83 => 57,  78 => 56,  71 => 51,  310 => 218,  300 => 208,  247 => 163,  237 => 151,  217 => 132,  197 => 125,  193 => 124,  186 => 119,  155 => 76,  135 => 71,  132 => 69,  123 => 61,  105 => 58,  97 => 56,  85 => 54,  80 => 53,  112 => 68,  106 => 69,  69 => 50,  55 => 20,  30 => 5,  22 => 4,  94 => 68,  79 => 54,  75 => 53,  73 => 52,  24 => 4,  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 49,  49 => 18,  43 => 15,  35 => 19,  31 => 12,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 193,  278 => 116,  274 => 115,  270 => 114,  265 => 176,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 157,  238 => 104,  233 => 101,  228 => 100,  223 => 137,  218 => 96,  212 => 129,  210 => 127,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 87,  141 => 64,  133 => 63,  114 => 48,  111 => 59,  103 => 58,  98 => 50,  92 => 38,  86 => 44,  81 => 41,  76 => 33,  70 => 51,  64 => 25,  61 => 24,  56 => 39,  54 => 24,  52 => 20,  50 => 19,  48 => 17,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
