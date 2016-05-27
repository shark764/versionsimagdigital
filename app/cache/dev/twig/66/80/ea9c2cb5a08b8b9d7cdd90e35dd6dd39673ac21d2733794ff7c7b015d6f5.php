<?php

/* MinsalSimagdBundle:ImgCitaAdmin:cit_editarCita_modal.html.twig */
class __TwigTemplate_6680ea9c2cb5a08b8b9d7cdd90e35dd6dd39673ac21d2733794ff7c7b015d6f5 extends Twig_Template
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
        echo "<div id=\"editarCita-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-calendar\"></i> Cita Programada</h4>
        </div>

\t    <div class=\"modal-body\">

\t\t<div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t    ";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span class=\"label label-element-v2\"> Formulario para edición </span>
\t\t\t</h4>
\t\t\t<br/>

                            <form id=\"editarCitaForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_cita_editarCita");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
                                data-fv-framework=\"bootstrap\"
                                data-fv-icon-valid=\"glyphicon glyphicon-ok\"
                                data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
                                data-fv-icon-validating=\"glyphicon glyphicon-refresh\">

                                <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
                                    <!-- Nav tabs -->
                                    <li class=\"active\"><a href=\"#programacionTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-time\"></span> Programación <i class=\"fa\"></i></a></li>
                                    ";
        // line 37
        echo "                                </ul>

                                <!-- Tab panes -->
                                <div class=\"tab-content col-md-9 col-xs-9\">
                                    <div class=\"tab-pane fade in active\" id=\"programacionTab\" >

                                        <input type=\"hidden\" id=\"formCitId\" name=\"formCitId\" value=\"\" />
                                        <input type=\"hidden\" id=\"formCitFechaProximaConsulta\" name=\"formCitFechaProximaConsulta\" value=\"\" />

                                        <div class=\"form-group\">
                                            <label class=\"col-xs-4 control-label\">Radiólogo</label>
                                            <div class=\"col-xs-8\">
                                                <select id=\"formCitIdTecnologoProgramado\" name=\"formCitIdTecnologoProgramado\" class=\"form-control select2-select\" data-apply-formatter=\"user\" >
                                                    <option value=\"\"></option>
                                                    ";
        // line 51
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if ((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY"))) {
                // line 52
                echo "                                                        <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                        ";
                // line 53
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
                foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
                    if (((!(null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 54
                        echo "                                                            <option value=\"";
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
                // line 56
                echo "                                                        </optgroup>
                                                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "                                                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["radiologos"]) ? $context["radiologos"] : $this->getContext($context, "radiologos")));
        foreach ($context['_seq'] as $context["_key"] => $context["radiologo"]) {
            if ((null === $this->getAttribute((isset($context["radiologo"]) ? $context["radiologo"] : $this->getContext($context, "radiologo")), "idTipoEmpleado"))) {
                // line 59
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
        // line 61
        echo "                                                </select>
                                            </div>
                                        </div>

                                        <div class=\"form-group\">
                                            <div class=\"col-xs-4 col-xs-offset-4\">
                                                <input type=\"text\" class=\"form-control\"  id=\"formCitFechaHoraInicio\" name=\"formCitFechaHoraInicio\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD h:m A\"
                                                          ";
        // line 69
        echo "
                                                          ";
        // line 71
        echo "
                                                          data-fv-notempty=\"true\"
                                                          data-fv-notempty-message=\"Este campo es requerido\"

                                                          data-fv-date=\"true\"
                                                          data-fv-date-format=\"YYYY-MM-DD h:m A\"
                                                          data-fv-date-max=\"formCitFechaHoraFin\"
                                                          data-fv-date-message=\"Fecha no válida\"

                                                          data-fv-callback=\"true\"
                                                          data-fv-callback-message=\"Fecha no permitida\"
                                                          data-fv-callback-callback=\"checkValidFechaHora\" />
                                            </div>
                                            <div class=\"col-xs-4\">
                                                <input type=\"text\" class=\"form-control\"  id=\"formCitFechaHoraFin\" name=\"formCitFechaHoraFin\" readonly=\"readonly\" aria-describedby=\"basic-addon1\" placeholder=\"YYYY-MM-DD h:m A\"
                                                          ";
        // line 87
        echo "
                                                          ";
        // line 89
        echo "
                                                          data-fv-notempty=\"true\"
                                                          data-fv-notempty-message=\"Este campo es requerido\"

                                                          data-fv-date=\"true\"
                                                          data-fv-date-format=\"YYYY-MM-DD h:m A\"
                                                          data-fv-date-min=\"formCitFechaHoraInicio\"
                                                          data-fv-date-message=\"Fecha no válida\"

                                                          data-fv-callback=\"true\"
                                                          data-fv-callback-message=\"Fecha no permitida\"
                                                          data-fv-callback-callback=\"checkValidFechaHora\" />
                                            </div>
                                        </div>

                                        <div class=\"form-group\">
                                            <div class=\"col-xs-8 col-xs-offset-4\">
                                                <div class=\"checkbox\">
                                                    <label>
                                                        <input type=\"checkbox\" value=\"1\" name=\"formCitDiaCompleto\" id=\"formCitDiaCompleto\" checked=\"checked\" /> Día completo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=\"form-group\">
                                            <label class=\"col-xs-4 control-label required\">Estado</label>
                                            <div class=\"col-xs-8\">
                                                <select id=\"formCitIdEstadoCita\" name=\"formCitIdEstadoCita\" class=\"form-control select2-select\" data-select2-formatter=\"dateStatus\"
                                                          ";
        // line 119
        echo "
                                                          data-fv-notempty=\"true\"
                                                          data-fv-notempty-message=\"Seleccione un elemento\" >
                                                    <option value=\"\"></option>
                                                    <optgroup label=\"Estados posibles\">
                                                    ";
        // line 124
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["estados"]) ? $context["estados"] : $this->getContext($context, "estados")));
        foreach ($context['_seq'] as $context["_key"] => $context["estado"]) {
            // line 125
            echo "                                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "id"), "html", null, true);
            echo "\" data-codigo=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "codigo"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "html", null, true);
            echo "</option>
                                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 127
        echo "                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=\"form-group\" ";
        // line 132
        echo " id=\"divformCitRazonAnulada\" data-razon-previa=\"\">
                                            <label class=\"col-xs-4 control-label\">Razón</label>
                                            <div class=\"col-xs-8\">
                                                <textarea rows=\"2\" class=\"form-control\" name=\"formCitRazonAnulada\" id=\"formCitRazonAnulada\" placeholder=\"Digite la razón de cancelación/anulación\" maxlength=\"150\" style=\"resize: none\" readonly=\"readonly\"
                                                          ";
        // line 137
        echo "
                                                          data-fv-stringlength=\"true\"
                                                          data-fv-stringlength-min=\"15\"
                                                          data-fv-stringlength-max=\"150\"
                                                          data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                          data-fv-regexp=\"true\"
                                                          data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                          data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                            </div>
                                        </div>

                                    ";
        // line 151
        echo "
                                        <div class=\"form-group\">
                                            <label class=\"col-xs-4 control-label\">Color</label>
                                            <div class=\"col-xs-8\">
                                                <input type=\"text\" class=\"form-control\" placeholder=\"Color de fondo\" id=\"formCitColor\" name=\"formCitColor\"
                                                          ";
        // line 157
        echo "
                                                          ";
        // line 159
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
                                            <label class=\"col-xs-4 control-label\">Incidencias</label>
                                            <div class=\"col-xs-8\">
                                                <textarea rows=\"3\" class=\"form-control\" name=\"formCitIncidencias\" id=\"formCitIncidencias\" placeholder=\"Digite incidencias ocurridas\" maxlength=\"255\" style=\"resize: none\"
                                                          ";
        // line 176
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

                                        <div class=\"form-group\">
                                            <label class=\"col-xs-4 control-label\">Observaciones</label>
                                            <div class=\"col-xs-8\">
                                                <textarea rows=\"2\" class=\"form-control\" name=\"formCitObservaciones\" id=\"formCitObservaciones\" placeholder=\"Digite observaciones acerca de la cita\" maxlength=\"255\" style=\"resize: none\"
                                                          ";
        // line 193
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
        // line 208
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>
                
\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 218
        echo "\t    </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_cit\" name=\"btn_agregar_cit\" class=\"btn btn-primary-v2\" style=\"display: none;\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_cit\" name=\"btn_editar_cit\" class=\"btn btn-element-v2\" ><i class=\"fa fa-check-square-o\"></i> Si, Continuar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCitaAdmin:cit_editarCita_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  310 => 218,  300 => 208,  247 => 159,  237 => 151,  217 => 132,  197 => 125,  193 => 124,  186 => 119,  155 => 89,  135 => 71,  132 => 69,  123 => 61,  105 => 58,  97 => 56,  85 => 54,  80 => 53,  112 => 66,  106 => 61,  69 => 30,  55 => 20,  30 => 7,  22 => 4,  94 => 68,  79 => 54,  75 => 52,  73 => 52,  24 => 4,  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 28,  49 => 18,  43 => 15,  35 => 19,  31 => 12,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 193,  278 => 116,  274 => 115,  270 => 114,  265 => 176,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 157,  238 => 104,  233 => 101,  228 => 100,  223 => 137,  218 => 96,  212 => 93,  210 => 127,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 87,  141 => 64,  133 => 63,  114 => 48,  111 => 59,  103 => 58,  98 => 50,  92 => 38,  86 => 44,  81 => 41,  76 => 33,  70 => 51,  64 => 25,  61 => 24,  56 => 21,  54 => 37,  52 => 20,  50 => 19,  48 => 17,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
