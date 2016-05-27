<?php

/* MinsalSimagdBundle:ImgLecturaAdmin:lct_addDiagnosisAsPattern_modal.html.twig */
class __TwigTemplate_53392eafb9fc8b01187874d2ea7bc8cc309da0a2b59a95f277c110600a7a5995 extends Twig_Template
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
<div id=\"bsmodal_addDiagnosisAsPattern-modal\" class=\"modal fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\" aria-labelledby=\"mySmallModalLabel\" data-width=\"760\">
    <div class=\"modal-content panel-element-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-user-md\"></i> <i class=\"fa fa-microphone\"></i> Agregar diagnóstico como patrón</h4>
        </div>

        <div class=\"modal-body\">
            <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">

                <form id=\"bsform_addDiagnosisAsPattern-form\" action=\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("simagd_patron_diagnostico_addDiagnosisAsPattern");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\" data-clientside-validation=\"modal\"
                    data-fv-framework=\"bootstrap\"
                    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
                    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
                    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

                    data-fv-message=\"El valor introducido no es válido\">

                    <input type=\"hidden\" id=\"form_diagAsPattern_id\" name=\"form_diagAsPattern_id\" value=\"\" />

                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label\">Hallazgos</label>
                        <div class=\"col-xs-8\">
                            <p class=\"form-control-static\" id=\"form_diagAsPattern_hallazgos-static-label\"></p>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label\">Conclusión</label>
                        <div class=\"col-xs-8\">
                            <p class=\"form-control-static\" id=\"form_diagAsPattern_conclusion-static-label\"></p>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label\">Recomendaciones</label>
                        <div class=\"col-xs-8\">
                            <p class=\"form-control-static\" id=\"form_diagAsPattern_recomendaciones-static-label\"></p>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"col-sm-4 control-label required\">Nombre</label>
                        <div class=\"col-sm-8\">
                            <input type=\"text\" class=\"form-control\" id=\"form_diagAsPattern_nombre\" name=\"form_diagAsPattern_nombre\" placeholder=\"Nombre del patrón de resultados\" maxlength=\"255\"
                                      ";
        // line 47
        echo "
                                      data-fv-notempty=\"true\"
                                      data-fv-notempty-message=\"Este campo es requerido\"

                                      data-fv-stringlength=\"true\"
                                      data-fv-stringlength-min=\"5\"
                                      data-fv-stringlength-max=\"255\"
                                      data-fv-stringlength-message=\"5 caracteres mínimo\"

                                      data-fv-regexp=\"true\"
                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"col-sm-4 control-label\">Código</label>
                        <div class=\"col-sm-8\">
                            <input type=\"text\" class=\"form-control\" id=\"form_diagAsPattern_codigo\" name=\"form_diagAsPattern_codigo\" placeholder=\"Código del patrón de resultados\" maxlength=\"6\"
                                      ";
        // line 67
        echo "
                                      data-fv-stringlength=\"true\"
                                      data-fv-stringlength-min=\"4\"
                                      data-fv-stringlength-max=\"6\"
                                      data-fv-stringlength-message=\"4 caracteres mínimo\"

                                      data-fv-regexp=\"true\"
                                      data-fv-regexp-regexp=\"^[a-zA-Z0-9]+\$\"
                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" />
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label required\">Modalidad</label>
                        <div class=\"col-xs-8\">
                            <select id=\"form_diagAsPattern_idAreaServicioDiagnostico\" name=\"form_diagAsPattern_idAreaServicioDiagnostico\" class=\"form-control select2-select\" data-default=\"";
        // line 82
        echo twig_escape_filter($this->env, (((!(null === (isset($context["form_currentstudy_mldRx"]) ? $context["form_currentstudy_mldRx"] : $this->getContext($context, "form_currentstudy_mldRx"))))) ? ($this->getAttribute((isset($context["form_currentstudy_mldRx"]) ? $context["form_currentstudy_mldRx"] : $this->getContext($context, "form_currentstudy_mldRx")), "getId", array(), "method")) : (null)), "html", null, true);
        echo "\" data-apply-formatter=\"mld\"
                                      ";
        // line 84
        echo "
                                      data-fv-notempty=\"true\"
                                      data-fv-notempty-message=\"Seleccione un elemento\"

                                      data-fv-callback=\"true\"
                                      data-fv-callback-message=\"Debe seleccionar al menos una proyección\"
                                      data-fv-callback-callback=\"checkProyeccionesModalidad\" >
                                <option value=\"\"></option>
                                <optgroup label=\"Servicio de Diagnóstico por imagen\">
                                    ";
        // line 93
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_modalidades"]) ? $context["collection_modalidades"] : $this->getContext($context, "collection_modalidades")));
        foreach ($context['_seq'] as $context["_key"] => $context["modalidad"]) {
            // line 94
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id"), "html", null, true);
            echo "\" ";
            if (((!(null === (isset($context["form_currentstudy_mldRx"]) ? $context["form_currentstudy_mldRx"] : $this->getContext($context, "form_currentstudy_mldRx")))) && ($this->getAttribute((isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "id") == $this->getAttribute((isset($context["form_currentstudy_mldRx"]) ? $context["form_currentstudy_mldRx"] : $this->getContext($context, "form_currentstudy_mldRx")), "getId", array(), "method")))) {
                echo " selected ";
            }
            echo ">";
            echo twig_escape_filter($this->env, (isset($context["modalidad"]) ? $context["modalidad"] : $this->getContext($context, "modalidad")), "html", null, true);
            echo "</option>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modalidad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <label class=\"col-xs-4 control-label required\">Tipo de resultado</label>
                        <div class=\"col-xs-8\">
                            <select id=\"form_diagAsPattern_idTipoResultado\" name=\"form_diagAsPattern_idTipoResultado\" class=\"form-control select2-select\" data-default=\"";
        // line 104
        echo twig_escape_filter($this->env, (((!(null === (isset($context["form_currentdiagnosis_tipoResult"]) ? $context["form_currentdiagnosis_tipoResult"] : $this->getContext($context, "form_currentdiagnosis_tipoResult"))))) ? ($this->getAttribute((isset($context["form_currentdiagnosis_tipoResult"]) ? $context["form_currentdiagnosis_tipoResult"] : $this->getContext($context, "form_currentdiagnosis_tipoResult")), "getId", array(), "method")) : (null)), "html", null, true);
        echo "\"
                                      ";
        // line 106
        echo "
                                      data-fv-notempty=\"true\"
                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                <option value=\"\"></option>
                                <optgroup label=\"Determinado\">
                                    ";
        // line 111
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_tiposResultado"]) ? $context["collection_tiposResultado"] : $this->getContext($context, "collection_tiposResultado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipoResultado"]) {
            if (($this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "getIndeterminado") == false)) {
                // line 112
                echo "                                        <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "id"), "html", null, true);
                echo "\" ";
                if (((!(null === (isset($context["form_currentdiagnosis_tipoResult"]) ? $context["form_currentdiagnosis_tipoResult"] : $this->getContext($context, "form_currentdiagnosis_tipoResult")))) && ($this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "id") == $this->getAttribute((isset($context["form_currentdiagnosis_tipoResult"]) ? $context["form_currentdiagnosis_tipoResult"] : $this->getContext($context, "form_currentdiagnosis_tipoResult")), "getId", array(), "method")))) {
                    echo " selected ";
                }
                echo ">";
                echo twig_escape_filter($this->env, (isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "html", null, true);
                echo "</option>
                                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipoResultado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 114
        echo "                                </optgroup>
                                <optgroup label=\"Indeterminado\">
                                    ";
        // line 116
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["collection_tiposResultado"]) ? $context["collection_tiposResultado"] : $this->getContext($context, "collection_tiposResultado")));
        foreach ($context['_seq'] as $context["_key"] => $context["tipoResultado"]) {
            if (($this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "getIndeterminado") != false)) {
                // line 117
                echo "                                        <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "id"), "html", null, true);
                echo "\" ";
                if (((!(null === (isset($context["form_currentdiagnosis_tipoResult"]) ? $context["form_currentdiagnosis_tipoResult"] : $this->getContext($context, "form_currentdiagnosis_tipoResult")))) && ($this->getAttribute((isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "id") == $this->getAttribute((isset($context["form_currentdiagnosis_tipoResult"]) ? $context["form_currentdiagnosis_tipoResult"] : $this->getContext($context, "form_currentdiagnosis_tipoResult")), "getId", array(), "method")))) {
                    echo " selected ";
                }
                echo ">";
                echo twig_escape_filter($this->env, (isset($context["tipoResultado"]) ? $context["tipoResultado"] : $this->getContext($context, "tipoResultado")), "html", null, true);
                echo "</option>
                                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipoResultado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 119
        echo "                                </optgroup>
                            </select>
                        </div>
                    </div>

                </form>
                
            </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_agregar_diagAsPattern\" name=\"btn_agregar_diagAsPattern\" data-submit=\"create\" class=\"btn btn-element-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
            <button type=\"submit\" id=\"btn_editar_diagAsPattern\" name=\"btn_editar_diagAsPattern\" data-submit=\"edit\" class=\"btn btn-element-v2\" style=\"display: none;\" ><i class=\"fa fa-check-square-o\"></i> Si, Editar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgLecturaAdmin:lct_addDiagnosisAsPattern_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  207 => 119,  191 => 117,  186 => 116,  182 => 114,  166 => 112,  161 => 111,  154 => 106,  150 => 104,  140 => 96,  125 => 94,  121 => 93,  106 => 82,  89 => 67,  68 => 47,  32 => 13,  19 => 2,  585 => 340,  582 => 339,  579 => 338,  576 => 337,  567 => 334,  564 => 333,  559 => 332,  557 => 331,  554 => 330,  548 => 326,  544 => 325,  542 => 324,  537 => 323,  535 => 322,  532 => 321,  530 => 320,  528 => 317,  524 => 315,  521 => 314,  518 => 313,  515 => 312,  506 => 309,  503 => 308,  498 => 307,  496 => 306,  493 => 305,  487 => 301,  483 => 300,  481 => 299,  476 => 298,  474 => 297,  471 => 296,  463 => 294,  461 => 293,  458 => 292,  451 => 290,  446 => 289,  444 => 288,  441 => 287,  437 => 282,  434 => 281,  428 => 278,  424 => 276,  421 => 275,  418 => 274,  412 => 272,  406 => 270,  403 => 269,  401 => 268,  398 => 267,  395 => 266,  390 => 263,  387 => 262,  379 => 260,  377 => 259,  373 => 257,  370 => 256,  362 => 254,  360 => 253,  356 => 251,  353 => 250,  348 => 248,  345 => 247,  342 => 246,  337 => 243,  334 => 236,  331 => 235,  326 => 190,  323 => 189,  315 => 188,  313 => 187,  310 => 186,  307 => 185,  302 => 231,  295 => 196,  290 => 192,  288 => 185,  284 => 183,  281 => 181,  279 => 174,  277 => 170,  274 => 169,  263 => 160,  260 => 159,  251 => 152,  244 => 147,  241 => 146,  237 => 144,  234 => 143,  225 => 139,  222 => 138,  219 => 137,  213 => 133,  209 => 132,  204 => 131,  202 => 130,  199 => 129,  194 => 125,  189 => 122,  185 => 121,  180 => 119,  175 => 116,  172 => 115,  169 => 114,  164 => 113,  162 => 112,  158 => 111,  145 => 101,  134 => 93,  124 => 85,  110 => 84,  101 => 38,  97 => 37,  93 => 35,  87 => 30,  81 => 26,  76 => 23,  72 => 22,  67 => 21,  61 => 18,  58 => 17,  51 => 14,  45 => 11,  42 => 10,  37 => 6,  35 => 5,);
    }
}
