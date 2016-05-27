<?php

/* MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_transcribirDiagnostico_modal.html.twig */
class __TwigTemplate_62b04b6764adce8e0e56a83ce0060076ee462267806c57f2afb12ac2790f88ae extends Twig_Template
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
        echo "<div id=\"transcribirDiagnostico-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-primary-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-clipboard\"></i> <span id=\"formDiagTitle\">Transcribir diagnóstico</span></h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span id=\"formDiagLabel\" class=\"label label-primary-v2\"> Formulario para registro </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"transcribirDiagnosticoForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_diagnostico_transcribirDiagnostico");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#generalesTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-user\"></span> Datos generales <i class=\"fa\"></i></a></li>
                                <li><a href=\"#resultadoTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-paperclip\"></span> Diagnóstico <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"generalesTab\" >

                                    <input type=\"hidden\" id=\"formDiagId\" name=\"formDiagId\" value=\"\" />
                                    <input type=\"hidden\" id=\"formDiagIdLectura\" name=\"formDiagIdLectura\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Transcribe</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formDiagIdEmpleado\" name=\"formDiagIdEmpleado\" class=\"form-control select2-select\" data-default=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["default_empLogged"]) ? $context["default_empLogged"] : $this->getContext($context, "default_empLogged")), "id"), "html", null, true);
        echo "\" data-apply-formatter=\"user\"
                                                      ";
        // line 53
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                ";
        // line 57
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tiposEmpleado"]) ? $context["tiposEmpleado"] : $this->getContext($context, "tiposEmpleado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            if (((($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "MED") || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "TRY")) || ($this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "codigo") == "ACL"))) {
                // line 58
                echo "                                                    <optgroup label=\"";
                echo twig_escape_filter($this->env, (isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "html", null, true);
                echo "\">
                                                    ";
                // line 59
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")));
                foreach ($context['_seq'] as $context["_key"] => $context["transcriptor"]) {
                    if (((!(null === $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"))) && ($this->getAttribute($this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"), "id") == $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")), "id")))) {
                        // line 60
                        echo "                                                        <option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "id"), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "html", null, true);
                        echo "</option>
                                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transcriptor'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 62
                echo "                                                    </optgroup>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "                                                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["transcriptores"]) ? $context["transcriptores"] : $this->getContext($context, "transcriptores")));
        foreach ($context['_seq'] as $context["_key"] => $context["transcriptor"]) {
            if ((null === $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "idTipoEmpleado"))) {
                // line 65
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["transcriptor"]) ? $context["transcriptor"] : $this->getContext($context, "transcriptor")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['transcriptor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Estado</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formDiagIdEstado\" name=\"formDiagIdEstado\" class=\"form-control select2-select\" data-default=\"";
        // line 74
        echo twig_escape_filter($this->env, (isset($context["estadoDiagDefault"]) ? $context["estadoDiagDefault"] : $this->getContext($context, "estadoDiagDefault")), "html", null, true);
        echo "\" data-select2-formatter=\"diagnosticStatus\"
                                                      ";
        // line 76
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Estados posibles\">
                                                ";
        // line 81
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["estados"]) ? $context["estados"] : $this->getContext($context, "estados")));
        foreach ($context['_seq'] as $context["_key"] => $context["estado"]) {
            // line 82
            echo "                                                    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "html", null, true);
            echo "</option>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Incidencias ocurridas</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formDiagIncidencias\" id=\"formDiagIncidencias\" placeholder=\"Incidencias ocurridas durante la transcripción\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 94
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
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formDiagObservaciones\" id=\"formDiagObservaciones\" placeholder=\"Digite sus observaciones adicionales\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 111
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
                                        <label class=\"col-xs-4 control-label\">Errores encontrados</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"4\" class=\"form-control\" name=\"formDiagErrores\" id=\"formDiagErrores\" placeholder=\"Errores encontrados en la transcripción\" style=\"resize: none\"
                                                      ";
        // line 128
        echo "
                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"5\"
                                                      data-fv-stringlength-message=\"5 caracteres mínimo\" /></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class=\"tab-pane fade\" id=\"resultadoTab\" >

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Aplicar patrón</label>
                                        <div class=\"col-xs-10\">
                                            <select id=\"formDiagIdPatronAplicado\" name=\"formDiagIdPatronAplicado\" class=\"form-control select2-select\" data-apply-formatter=\"patternDiag\" >
                                                <option value=\"\"></option>
                                                ";
        // line 143
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modalidades"]) ? $context["modalidades"] : $this->getContext($context, "modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 144
            echo "                                                    <optgroup label=\"";
            echo twig_escape_filter($this->env, (isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "html", null, true);
            echo "\">
                                                    ";
            // line 145
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["patronesDiag"]) ? $context["patronesDiag"] : $this->getContext($context, "patronesDiag")));
            foreach ($context['_seq'] as $context["_key"] => $context["patronDiag"]) {
                if (($this->getAttribute($this->getAttribute((isset($context["patronDiag"]) ? $context["patronDiag"] : $this->getContext($context, "patronDiag")), "idAreaServicioDiagnostico"), "id") == $this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id"))) {
                    // line 146
                    echo "                                                        <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["patronDiag"]) ? $context["patronDiag"] : $this->getContext($context, "patronDiag")), "id"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, (isset($context["patronDiag"]) ? $context["patronDiag"] : $this->getContext($context, "patronDiag")), "html", null, true);
                    echo "</option>
                                                    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['patronDiag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 148
            echo "                                                    </optgroup>
                                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modalidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 150
        echo "                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Hallazgos</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"4\" class=\"form-control summernote\" name=\"formDiagHallazgos\" id=\"formDiagHallazgos\" ";
        // line 165
        echo " /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Conclusión</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"3\" class=\"form-control summernote\" name=\"formDiagConclusion\" id=\"formDiagConclusion\" ";
        // line 180
        echo " /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-2 control-label\">Recomendaciones</label>
                                        <div class=\"col-xs-10\">
                                            <textarea rows=\"4\" class=\"form-control summernote\" name=\"formDiagRecomendaciones\" id=\"formDiagRecomendaciones\" ";
        // line 193
        echo " /></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"form-group\" style=\"";
        // line 200
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-primary-v2 btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>
                
\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 210
        echo "\t    </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_diag\" name=\"btn_agregar_diag\" class=\"btn btn-primary-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_diag\" name=\"btn_editar_diag\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgDiagnosticoAdmin:diag_transcribirDiagnostico_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  310 => 210,  300 => 200,  282 => 180,  264 => 150,  257 => 148,  245 => 146,  240 => 145,  235 => 144,  231 => 143,  214 => 128,  196 => 111,  178 => 94,  167 => 84,  156 => 82,  152 => 81,  145 => 76,  141 => 74,  132 => 67,  120 => 65,  114 => 64,  106 => 62,  94 => 60,  89 => 59,  84 => 58,  79 => 57,  73 => 53,  54 => 28,  47 => 22,  41 => 17,  22 => 4,  19 => 2,  29 => 4,  23 => 3,  20 => 2,  627 => 335,  624 => 334,  616 => 332,  614 => 331,  610 => 329,  607 => 328,  599 => 326,  597 => 325,  593 => 323,  590 => 322,  587 => 321,  584 => 320,  580 => 319,  577 => 318,  574 => 317,  570 => 316,  568 => 315,  565 => 314,  562 => 313,  554 => 311,  552 => 310,  549 => 309,  546 => 308,  544 => 307,  537 => 306,  532 => 303,  517 => 291,  510 => 288,  504 => 285,  496 => 280,  492 => 278,  486 => 275,  484 => 274,  481 => 273,  479 => 272,  476 => 271,  455 => 252,  449 => 247,  446 => 244,  429 => 230,  425 => 228,  418 => 227,  415 => 226,  413 => 225,  410 => 224,  388 => 204,  382 => 199,  379 => 196,  366 => 186,  359 => 182,  354 => 179,  339 => 167,  332 => 164,  326 => 161,  318 => 156,  314 => 154,  308 => 151,  306 => 150,  303 => 149,  301 => 148,  298 => 147,  294 => 145,  291 => 193,  273 => 165,  265 => 129,  262 => 128,  254 => 122,  247 => 117,  244 => 116,  233 => 110,  226 => 108,  217 => 104,  209 => 102,  206 => 101,  201 => 98,  198 => 97,  193 => 94,  190 => 93,  188 => 92,  182 => 90,  179 => 89,  172 => 85,  168 => 84,  163 => 83,  158 => 81,  154 => 79,  149 => 78,  143 => 75,  138 => 72,  134 => 71,  129 => 70,  97 => 44,  88 => 42,  69 => 51,  66 => 26,  58 => 22,  52 => 19,  49 => 24,  44 => 20,  42 => 27,  40 => 14,  38 => 11,  36 => 8,  34 => 21,  32 => 6,);
    }
}
