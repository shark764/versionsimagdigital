<?php

/* MinsalSimagdBundle:ImgCitaAdmin:cit_cancelarCita_modal.html.twig */
class __TwigTemplate_4b2d2fef0effb895d4bb748607cd451846aabed35b8651a845c5c37699941065 extends Twig_Template
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
        echo "<div id=\"cancelarCita-modal\" class=\"modal container fade justify-bootstrap-div-container simagd-full-form-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\">
    <div class=\"modal-content panel-danger\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-times-circle\"></i> <i class=\"fa fa-trash-o\"></i> Cita Programada</h4>
        </div>

        <div class=\"modal-body\">

\t    <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">
\t\t";
        // line 21
        echo "\t\t    
\t\t\t<h4 class=\"\" style=\"padding-left: 15px;\">
\t\t\t    <span class=\"label label-danger\"> Formulario para cancelación </span>
\t\t\t</h4>
\t\t\t<br/>

\t\t\t<form id=\"cancelarCitaForm\" action=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("simagd_cita_cancelarCita");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
\t\t\t    data-fv-framework=\"bootstrap\"
\t\t\t    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
\t\t\t    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
\t\t\t    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

\t\t\t    data-fv-message=\"El valor introducido no es válido\">

\t\t\t    <ul class=\"nav nav-pills nav-stacked col-md-3 col-xs-3\" style=\"padding-left: 15px;\"> <!-- required for floating -->
\t\t\t\t<!-- Nav tabs -->
                                <li class=\"active\"><a href=\"#cancelacionTab\" data-toggle=\"pill\"> <span class=\"glyphicon glyphicon-remove-circle\"></span> Cita <i class=\"fa\"></i></a></li>
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class=\"tab-content col-md-9 col-xs-9\">
                                <div class=\"tab-pane fade in active\" id=\"cancelacionTab\" >

                                    <input type=\"hidden\" id=\"formCancelCitId\" name=\"formCancelCitId\" value=\"\" />

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Estado</label>
                                        <div class=\"col-xs-8\">
                                            <select id=\"formCancelCitIdEstadoCita\" name=\"formCancelCitIdEstadoCita\" class=\"form-control select2-select\" data-default=\"";
        // line 49
        echo twig_escape_filter($this->env, (isset($context["default_statusCancelCit"]) ? $context["default_statusCancelCit"] : $this->getContext($context, "default_statusCancelCit")), "html", null, true);
        echo "\" data-select2-formatter=\"dateStatus\"
                                                      ";
        // line 51
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Seleccione un elemento\" >
                                                <option value=\"\"></option>
                                                <optgroup label=\"Estados posibles\">
                                                ";
        // line 56
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["estados"]) ? $context["estados"] : $this->getContext($context, "estados")));
        foreach ($context['_seq'] as $context["_key"] => $context["estado"]) {
            if ((($this->getAttribute((isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "codigo") == "CNL") || ($this->getAttribute((isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "codigo") == "ANL"))) {
                // line 57
                echo "                                                    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["estado"]) ? $context["estado"] : $this->getContext($context, "estado")), "html", null, true);
                echo "</option>
                                                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estado'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label required\">Razón</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formCancelCitRazonAnulada\" id=\"formCancelCitRazonAnulada\" placeholder=\"Digite la razón de cancelación/anulación\" maxlength=\"150\" style=\"resize: none\"
                                                      ";
        // line 69
        echo "
                                                      data-fv-notempty=\"true\"
                                                      data-fv-notempty-message=\"Este campo es requerido\"

                                                      data-fv-stringlength=\"true\"
                                                      data-fv-stringlength-min=\"15\"
                                                      data-fv-stringlength-max=\"150\"
                                                      data-fv-stringlength-message=\"15 caracteres mínimo\"

                                                      data-fv-regexp=\"true\"
                                                      data-fv-regexp-regexp=\"^[a-zA-ZüÜñÑáéíóúÁÉÍÓÚ0-9¿!¡;,:\\.\\?#@()_-\\s]+\$\"
                                                      data-fv-regexp-message=\"Texto contiene caracteres no permitidos\" /></textarea>
                                        </div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label class=\"col-xs-4 control-label\">Incidencias</label>
                                        <div class=\"col-xs-8\">
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formCancelCitIncidencias\" id=\"formCancelCitIncidencias\" placeholder=\"Desea agregar incidencias\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 89
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
                                            <textarea rows=\"3\" class=\"form-control\" name=\"formCancelCitObservaciones\" id=\"formCancelCitObservaciones\" placeholder=\"Desea agregar observaciones\" maxlength=\"255\" style=\"resize: none\"
                                                      ";
        // line 106
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
        // line 121
        echo " visibility: hidden;\">
                                <div class=\"col-xs-8 col-xs-offset-4\">
                                    <button type=\"submit\" class=\"btn btn-danger btn-xs\"><i class=\"glyphicon glyphicon-ok\"></i> Enviar</button>
                                </div>
                            </div>

\t\t\t</form>
\t\t\t\t
\t\t    ";
        // line 131
        echo "\t    </div>

        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-danger\"><span class=\"glyphicon glyphicon-warning-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_cancel_cita\" name=\"btn_cancel_cita\" class=\"btn btn-danger\" ><i class=\"fa fa-trash-o\"></i> Si, Continuar</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImgCitaAdmin:cit_cancelarCita_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 131,  162 => 121,  145 => 106,  127 => 89,  95 => 59,  83 => 57,  78 => 56,  71 => 51,  310 => 218,  300 => 208,  247 => 159,  237 => 151,  217 => 132,  197 => 125,  193 => 124,  186 => 119,  155 => 89,  135 => 71,  132 => 69,  123 => 61,  105 => 58,  97 => 56,  85 => 54,  80 => 53,  112 => 66,  106 => 69,  69 => 30,  55 => 20,  30 => 7,  22 => 4,  94 => 68,  79 => 54,  75 => 52,  73 => 52,  24 => 4,  120 => 67,  110 => 59,  104 => 54,  101 => 51,  67 => 49,  49 => 18,  43 => 15,  35 => 19,  31 => 12,  25 => 5,  19 => 2,  29 => 4,  23 => 4,  20 => 2,  969 => 423,  966 => 422,  964 => 421,  956 => 420,  954 => 419,  946 => 418,  944 => 417,  941 => 416,  938 => 415,  934 => 414,  932 => 413,  929 => 412,  926 => 411,  922 => 410,  920 => 409,  915 => 406,  912 => 405,  904 => 403,  896 => 401,  894 => 400,  891 => 399,  888 => 398,  884 => 397,  882 => 396,  879 => 395,  876 => 394,  872 => 393,  870 => 392,  867 => 391,  864 => 390,  862 => 389,  854 => 388,  851 => 387,  848 => 386,  844 => 385,  841 => 384,  838 => 383,  834 => 382,  831 => 381,  828 => 380,  824 => 379,  822 => 378,  819 => 377,  817 => 376,  809 => 375,  805 => 374,  802 => 373,  796 => 369,  792 => 367,  789 => 366,  775 => 354,  772 => 353,  768 => 352,  766 => 351,  763 => 350,  758 => 346,  747 => 340,  738 => 332,  729 => 327,  723 => 326,  714 => 322,  708 => 321,  698 => 313,  677 => 293,  673 => 291,  669 => 289,  650 => 272,  645 => 269,  636 => 264,  630 => 263,  620 => 258,  614 => 257,  605 => 253,  599 => 252,  589 => 247,  583 => 246,  574 => 242,  568 => 241,  558 => 236,  552 => 235,  542 => 230,  531 => 224,  526 => 222,  523 => 221,  520 => 215,  508 => 208,  500 => 206,  490 => 201,  484 => 200,  479 => 197,  477 => 196,  474 => 195,  467 => 190,  455 => 188,  449 => 187,  441 => 185,  429 => 183,  424 => 182,  419 => 181,  414 => 180,  406 => 174,  395 => 172,  391 => 171,  375 => 157,  370 => 154,  367 => 153,  356 => 147,  349 => 145,  340 => 141,  332 => 139,  329 => 138,  324 => 135,  321 => 134,  317 => 131,  311 => 129,  308 => 128,  301 => 124,  296 => 122,  292 => 121,  288 => 120,  283 => 193,  278 => 116,  274 => 115,  270 => 114,  265 => 176,  261 => 111,  257 => 110,  253 => 109,  249 => 108,  244 => 157,  238 => 104,  233 => 101,  228 => 100,  223 => 137,  218 => 96,  212 => 93,  210 => 127,  205 => 89,  201 => 88,  196 => 87,  188 => 81,  177 => 72,  163 => 70,  156 => 69,  152 => 87,  141 => 64,  133 => 63,  114 => 48,  111 => 59,  103 => 58,  98 => 50,  92 => 38,  86 => 44,  81 => 41,  76 => 33,  70 => 51,  64 => 25,  61 => 24,  56 => 21,  54 => 37,  52 => 20,  50 => 19,  48 => 17,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 21,  32 => 6,);
    }
}
