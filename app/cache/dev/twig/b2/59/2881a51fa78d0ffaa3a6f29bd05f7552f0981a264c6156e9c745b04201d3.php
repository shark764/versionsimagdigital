<?php

/* MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_asignarNuevoExpediente_modal.html.twig */
class __TwigTemplate_b2592881a51fa78d0ffaa3a6f29bd05f7552f0981a264c6156e9c745b04201d3 extends Twig_Template
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
<div id=\"asignarNuevoExpediente-modal\" class=\"modal fade justify-bootstrap-div-container\" role=\"dialog\" tabindex=\"-1\" style=\"display: none;\" data-backdrop=\"static\" data-keyboard=\"false\" data-focus-on=\"input:first\" aria-labelledby=\"mySmallModalLabel\" data-width=\"760\">
    <div class=\"modal-content panel-element-v2\">
        <div class=\"modal-header panel-heading\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"> <i class=\"fa fa-times\"></i> </button>
            <h4 class=\"modal-title\"><i class=\"fa fa-wheelchair\"></i> Asignar registros a nuevo expediente</h4>
        </div>

        <div class=\"modal-body\">
            <div class=\"row outer\" style=\"padding-left: 15px; padding-right: 15px;\">

                <form id=\"asignarNuevoExpedienteForm\" action=\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("simagd_imagenologia_digital_asignarNuevoExpediente");
        echo "\" method=\"post\" class=\"form-horizontal simagd-form-custom-class\"
                    data-fv-framework=\"bootstrap\"
                    data-fv-icon-valid=\"glyphicon glyphicon-ok\"
                    data-fv-icon-invalid=\"glyphicon glyphicon-remove\"
                    data-fv-icon-validating=\"glyphicon glyphicon-refresh\"

                    data-fv-message=\"El valor introducido no es válido\">

                    ";
        // line 27
        echo "
                    <div class=\"form-group has-feedback\">
                        <label class=\"col-xs-4 control-label required\">Nuevo expediente</label>
                        <div class=\"col-xs-8\">
                        <input type=\"text\" class=\"typeahead explocal_formAssignNewRegister_typeahead form-control\" autocomplete=\"off\" placeholder=\"expediente\" id=\"explocal_formAssignNewRegister_typeahead\" name=\"explocal_formAssignNewRegister_typeahead\"
                                      ";
        // line 33
        echo "
                                      data-fv-notempty=\"true\"
                                      data-fv-notempty-message=\"Este campo es requerido\" />
                        <i class=\"glyphicon glyphicon-remove-circle form-control-feedback typeahead-custom-clear\" id=\"clear-typeahead-formAssignNewRegister\"></i>
                        </div>
                    </div>

                </form>
                
            </div>
            
        </div>

        <div class=\"modal-footer\" style=\"margin-top: 0px;\">
            <span class=\"text-info\"><span class=\"glyphicon glyphicon-question-sign\"></span> ¿Está seguro que desea continuar? &nbsp;</span>
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary-v2\"><i class=\"fa fa-times\"></i> No, Cerrar</button>
            <button type=\"submit\" id=\"btn_asignar_newPatientRecord\" name=\"btn_asignar_newPatientRecord\" class=\"btn btn-element-v2\" ><i class=\"fa fa-check-circle\"></i> Si, Continuar</button>
        </div>
        
    </div><!-- /.modal-content -->
</div><!-- /.modal -->";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle:ImagenologiaDigitalAdmin:simagd_asignarNuevoExpediente_modal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 27,  35 => 19,  31 => 12,  158 => 97,  148 => 87,  139 => 80,  130 => 65,  112 => 62,  104 => 60,  92 => 58,  87 => 57,  82 => 56,  77 => 55,  71 => 51,  67 => 49,  22 => 4,  19 => 2,  787 => 404,  784 => 403,  776 => 401,  774 => 400,  770 => 398,  767 => 397,  763 => 396,  761 => 395,  758 => 394,  755 => 393,  751 => 392,  748 => 391,  745 => 390,  741 => 389,  738 => 388,  735 => 387,  733 => 386,  725 => 385,  722 => 384,  719 => 383,  717 => 382,  709 => 381,  706 => 380,  703 => 379,  699 => 378,  697 => 377,  694 => 376,  691 => 375,  683 => 373,  681 => 372,  678 => 371,  663 => 361,  648 => 348,  642 => 343,  639 => 340,  636 => 339,  620 => 325,  616 => 323,  609 => 322,  606 => 321,  604 => 320,  601 => 319,  579 => 299,  573 => 294,  570 => 291,  567 => 290,  551 => 276,  547 => 274,  540 => 273,  537 => 272,  535 => 271,  532 => 270,  515 => 258,  505 => 250,  497 => 243,  494 => 240,  491 => 239,  477 => 229,  470 => 225,  465 => 222,  449 => 210,  437 => 203,  425 => 195,  418 => 192,  412 => 189,  404 => 184,  400 => 182,  394 => 179,  392 => 178,  389 => 177,  387 => 176,  384 => 175,  381 => 173,  377 => 169,  374 => 168,  369 => 165,  355 => 156,  349 => 155,  339 => 147,  331 => 141,  328 => 140,  315 => 132,  308 => 130,  298 => 125,  291 => 123,  281 => 118,  274 => 116,  269 => 113,  266 => 112,  261 => 109,  258 => 108,  254 => 105,  248 => 103,  245 => 102,  237 => 98,  232 => 96,  228 => 94,  223 => 93,  217 => 90,  215 => 89,  210 => 86,  205 => 85,  200 => 82,  196 => 81,  191 => 80,  183 => 74,  170 => 63,  156 => 61,  149 => 60,  145 => 59,  134 => 55,  126 => 54,  118 => 63,  110 => 52,  102 => 51,  79 => 32,  76 => 31,  68 => 27,  62 => 24,  59 => 23,  54 => 21,  52 => 20,  50 => 33,  48 => 18,  46 => 15,  44 => 14,  42 => 27,  40 => 12,  38 => 20,  36 => 8,  34 => 21,  32 => 13,);
    }
}
