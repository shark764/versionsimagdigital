<?php

/* SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_association_script.html.twig */
class __TwigTemplate_005a6cb16684c1382a6e867b76a8cb9d26520a82f56d466eb36b30f82cf124c6 extends Twig_Template
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
        // line 11
        echo "

";
        // line 18
        echo "
";
        // line 20
        echo "
<!-- edit one association -->

<script type=\"text/javascript\">

    // handle the add link
    var field_add_";
        // line 26
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = function(event) {

        event.preventDefault();
        event.stopPropagation();

        var form = jQuery(this).closest('form');

        // the ajax post
        jQuery(form).ajaxSubmit({
            url: '";
        // line 35
        echo $this->env->getExtension('routing')->getUrl("sonata_admin_append_form_element", (array("code" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"), "root"), "code"), "elementId" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "objectId" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"), "root"), "id", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"), "root"), "subject")), "method"), "uniqid" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin"), "root"), "uniqid")) + $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "getOption", array(0 => "link_parameters", 1 => array()), "method")));
        // line 40
        echo "',
            type: \"POST\",
            dataType: 'html',
            data: { _xml_http_request: true },
            success: function(html) {
                if (!html.length) {
                    return;
                }

                jQuery('#field_container_";
        // line 49
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "').replaceWith(html); // replace the html

                Admin.shared_setup(jQuery('#field_container_";
        // line 51
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "'));

                if(jQuery('input[type=\"file\"]', form).length > 0) {
                    jQuery(form).attr('enctype', 'multipart/form-data');
                    jQuery(form).attr('encoding', 'multipart/form-data');
                }
                jQuery('#sonata-ba-field-container-";
        // line 57
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "').trigger('sonata.add_element');
                jQuery('#field_container_";
        // line 58
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "').trigger('sonata.add_element');
            }
        });

        return false;
    };

    var field_widget_";
        // line 65
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = false;

    // this function initialize the popup
    // this can be only done this way has popup can be cascaded
    function start_field_retrieve_";
        // line 69
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "(link) {

        link.onclick = null;

        // initialize component
        field_widget_";
        // line 74
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = jQuery(\"#field_widget_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "\");

        // add the jQuery event to the a element
        jQuery(link)
            .click(field_add_";
        // line 78
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ")
            .trigger('click')
        ;

        return false;
    }
</script>

<!-- / edit one association -->

";
    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_association_script.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 49,  48 => 40,  46 => 35,  34 => 26,  23 => 18,  563 => 188,  560 => 187,  558 => 186,  555 => 185,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 158,  491 => 157,  487 => 156,  474 => 150,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  400 => 116,  398 => 115,  393 => 112,  387 => 110,  384 => 109,  380 => 107,  366 => 106,  360 => 104,  354 => 101,  331 => 96,  325 => 94,  320 => 92,  317 => 91,  314 => 88,  311 => 87,  308 => 86,  289 => 82,  267 => 78,  249 => 74,  233 => 71,  216 => 70,  213 => 69,  192 => 66,  189 => 65,  186 => 64,  181 => 61,  167 => 57,  152 => 51,  146 => 49,  137 => 46,  126 => 42,  124 => 41,  105 => 39,  102 => 74,  98 => 37,  81 => 30,  73 => 57,  67 => 27,  64 => 51,  60 => 25,  55 => 22,  52 => 21,  49 => 20,  39 => 17,  36 => 16,  21 => 12,  122 => 39,  119 => 38,  111 => 78,  109 => 40,  106 => 35,  103 => 34,  95 => 33,  93 => 34,  90 => 31,  87 => 65,  79 => 29,  77 => 58,  74 => 27,  71 => 26,  63 => 25,  61 => 24,  50 => 17,  43 => 18,  35 => 9,  32 => 8,  30 => 7,  28 => 6,  26 => 20,  24 => 4,  22 => 3,  19 => 11,  364 => 166,  361 => 165,  358 => 103,  349 => 161,  346 => 160,  344 => 157,  340 => 156,  337 => 97,  335 => 154,  333 => 151,  330 => 150,  326 => 148,  322 => 93,  319 => 145,  316 => 144,  313 => 143,  304 => 85,  301 => 139,  299 => 136,  295 => 135,  292 => 134,  283 => 130,  279 => 129,  277 => 128,  272 => 81,  268 => 126,  265 => 125,  257 => 123,  255 => 122,  252 => 121,  245 => 119,  240 => 72,  238 => 117,  235 => 116,  232 => 112,  228 => 110,  224 => 108,  221 => 107,  218 => 106,  212 => 103,  208 => 101,  205 => 100,  202 => 99,  196 => 68,  190 => 95,  187 => 94,  185 => 93,  182 => 92,  179 => 91,  174 => 59,  171 => 67,  163 => 66,  161 => 54,  158 => 53,  155 => 52,  147 => 74,  142 => 70,  140 => 47,  136 => 61,  134 => 45,  132 => 44,  129 => 52,  120 => 48,  117 => 47,  114 => 46,  108 => 42,  104 => 41,  99 => 40,  97 => 39,  94 => 69,  89 => 34,  84 => 31,  80 => 30,  68 => 25,  57 => 18,  54 => 19,  47 => 19,  41 => 13,  38 => 10,  33 => 6,  31 => 5,);
    }
}
