<?php

/* MinsalSimagdBundle::simagd_flash_notice.html.twig */
class __TwigTemplate_032f2293765ec424938b57c337d0899764302bafacf69fa15a8a97e77fda4cfd extends Twig_Template
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
    <script type=\"text/javascript\">
        jQuery(document).ready(function() {
            
            var toastMsg = [];

            ";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getExtension('sonata_core_flashmessage')->getFlashMessagesTypes());
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 9
            echo "
                var typeAlert = '";
            // line 10
            echo twig_escape_filter($this->env, $this->env->getExtension('sonata_core_status')->statusClass((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type"))), "html", null, true);
            echo "';
                var typeMessage = 'Información';

                switch( typeAlert ) {
                    case 'success':
                        typeMessage = 'Éxito';
                        break;
                    case 'danger':
                        typeMessage = 'Error';
                        typeAlert = 'error';
                        break;
                    case 'warning':
                        typeMessage = 'Advertencia';
                        break;
                    default:
                        typeAlert = 'notice';
                        break;
                }

                ";
            // line 29
            $context["domain"] = ((array_key_exists("domain", $context)) ? ((isset($context["domain"]) ? $context["domain"] : $this->getContext($context, "domain"))) : (null));
            // line 30
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->env->getExtension('sonata_core_flashmessage')->getFlashMessages((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), (isset($context["domain"]) ? $context["domain"] : $this->getContext($context, "domain"))));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 31
                echo "                    
                    toastMsg.push({ type: typeAlert, message: jQuery.trim('";
                // line 32
                echo (isset($context["message"]) ? $context["message"] : $this->getContext($context, "message"));
                echo "'), title: typeMessage } );

                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "        
            \$.each(toastMsg, function (index, valMsgToast) {
                setTimeout(function() {
                  // Do something after 2 seconds
                    generarMensajeToast(valMsgToast.type, valMsgToast.message, valMsgToast.title );
                }, index * 1500);
            });

        });

    </script>";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle::simagd_flash_notice.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 30,  27 => 8,  19 => 2,  217 => 87,  214 => 86,  207 => 90,  204 => 89,  199 => 85,  196 => 84,  190 => 81,  185 => 80,  180 => 77,  175 => 76,  172 => 74,  170 => 72,  165 => 69,  161 => 68,  141 => 60,  136 => 59,  133 => 57,  122 => 52,  113 => 48,  106 => 45,  100 => 42,  95 => 39,  90 => 38,  84 => 35,  81 => 36,  75 => 35,  69 => 26,  63 => 31,  57 => 20,  34 => 10,  416 => 173,  413 => 172,  400 => 162,  397 => 161,  384 => 151,  381 => 150,  368 => 140,  365 => 139,  361 => 183,  358 => 172,  355 => 161,  352 => 150,  349 => 139,  346 => 138,  342 => 131,  340 => 130,  337 => 129,  333 => 127,  331 => 126,  328 => 125,  324 => 123,  322 => 122,  319 => 121,  314 => 113,  303 => 132,  301 => 129,  298 => 128,  296 => 125,  293 => 124,  291 => 121,  283 => 115,  281 => 112,  268 => 101,  265 => 100,  260 => 184,  258 => 138,  255 => 137,  253 => 100,  250 => 98,  239 => 91,  234 => 88,  225 => 86,  220 => 88,  216 => 82,  212 => 81,  208 => 80,  203 => 79,  198 => 76,  193 => 75,  184 => 71,  179 => 70,  169 => 66,  157 => 60,  151 => 64,  146 => 63,  134 => 48,  126 => 47,  118 => 46,  107 => 41,  103 => 40,  99 => 39,  83 => 27,  80 => 26,  72 => 22,  66 => 32,  60 => 16,  54 => 18,  51 => 11,  49 => 13,  43 => 6,  40 => 11,  651 => 437,  648 => 436,  640 => 434,  638 => 433,  610 => 407,  607 => 404,  595 => 394,  587 => 388,  580 => 387,  552 => 361,  541 => 359,  536 => 358,  525 => 356,  520 => 355,  509 => 353,  505 => 352,  492 => 341,  483 => 333,  458 => 309,  437 => 289,  404 => 257,  382 => 236,  357 => 212,  336 => 192,  311 => 112,  290 => 148,  269 => 128,  257 => 117,  249 => 115,  245 => 95,  236 => 112,  230 => 87,  223 => 109,  215 => 107,  211 => 105,  202 => 86,  197 => 103,  192 => 102,  188 => 73,  178 => 93,  174 => 67,  166 => 85,  163 => 63,  156 => 67,  153 => 74,  148 => 55,  138 => 63,  128 => 55,  124 => 58,  121 => 57,  116 => 49,  111 => 42,  108 => 50,  101 => 46,  97 => 45,  92 => 44,  86 => 41,  77 => 34,  56 => 29,  53 => 16,  45 => 12,  42 => 11,  37 => 9,  35 => 8,  33 => 7,  31 => 9,);
    }
}
