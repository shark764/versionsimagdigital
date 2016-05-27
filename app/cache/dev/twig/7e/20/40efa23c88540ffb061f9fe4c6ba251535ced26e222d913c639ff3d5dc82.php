<?php

/* MinsalSimagdBundle::simagd_layout.html.twig */
class __TwigTemplate_7e2040efa23c88540ffb061f9fe4c6ba251535ced26e222d913c639ff3d5dc82 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
            'notice' => array($this, 'block_notice'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    
    ";
        // line 11
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-styles.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-form-styles.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-table.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 18
        echo "    
    ";
        // line 20
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/jquery-ui-1.11.2.custom/jquery-ui.theme.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 23
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 26
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/iCheck-master/skins/minimal/blue.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 29
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/simagd-ckeditor.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 33
        echo "    
    ";
        // line 35
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/toastmessage-plugin/src/main/resources/css/jquery.toastmessage.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 38
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/css/bootstrap-modal-bs3patch.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/css/bootstrap-modal.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 42
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    
    ";
        // line 45
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/css/select2-bootstrap.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
";
    }

    // line 48
    public function block_javascripts($context, array $blocks = array())
    {
        // line 49
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    ";
        // line 52
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/sonataadmin/vendor/select2/select2_locale_es.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 55
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/iCheck-master/icheck.js"), "html", null, true);
        echo "\" ></script>
    ";
        // line 57
        echo "    
    ";
        // line 59
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/jquery-ui-1.11.2.custom/jquery-ui.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_highlight_error_ui.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 63
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/moment-master/min/moment-with-locales.min.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 67
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_trim_datos.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_html5_novalidate.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_validate_number.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 72
        echo "    ";
        // line 74
        echo "    
    ";
        // line 76
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/toastmessage-plugin/src/main/javascript/jquery.toastmessage.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/js/simagd_generar_mensaje_toast.js"), "html", null, true);
        echo "\" ></script>
    
    ";
        // line 80
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/js/bootstrap-modalmanager.js"), "html", null, true);
        echo "\" ></script>
    <script type=\"text/javascript\" src=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsimagd/bootstrap-modal-master/js/bootstrap-modal.js"), "html", null, true);
        echo "\" ></script>
";
    }

    // line 84
    public function block_content($context, array $blocks = array())
    {
        // line 85
        echo "    
    ";
        // line 86
        $this->displayBlock('notice', $context, $blocks);
        // line 89
        echo "    
    ";
        // line 90
        $this->displayParentBlock("content", $context, $blocks);
        echo "
    
";
    }

    // line 86
    public function block_notice($context, array $blocks = array())
    {
        // line 87
        echo "        ";
        $this->env->loadTemplate("MinsalSimagdBundle::simagd_flash_notice.html.twig")->display($context);
        // line 88
        echo "    ";
    }

    public function getTemplateName()
    {
        return "MinsalSimagdBundle::simagd_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 87,  214 => 86,  207 => 90,  204 => 89,  199 => 85,  196 => 84,  190 => 81,  185 => 80,  180 => 77,  175 => 76,  172 => 74,  170 => 72,  165 => 69,  161 => 68,  141 => 60,  136 => 59,  133 => 57,  122 => 52,  113 => 48,  106 => 45,  100 => 42,  95 => 39,  90 => 38,  84 => 35,  81 => 33,  75 => 29,  69 => 26,  63 => 23,  57 => 20,  34 => 8,  416 => 173,  413 => 172,  400 => 162,  397 => 161,  384 => 151,  381 => 150,  368 => 140,  365 => 139,  361 => 183,  358 => 172,  355 => 161,  352 => 150,  349 => 139,  346 => 138,  342 => 131,  340 => 130,  337 => 129,  333 => 127,  331 => 126,  328 => 125,  324 => 123,  322 => 122,  319 => 121,  314 => 113,  303 => 132,  301 => 129,  298 => 128,  296 => 125,  293 => 124,  291 => 121,  283 => 115,  281 => 112,  268 => 101,  265 => 100,  260 => 184,  258 => 138,  255 => 137,  253 => 100,  250 => 98,  239 => 91,  234 => 88,  225 => 86,  220 => 88,  216 => 82,  212 => 81,  208 => 80,  203 => 79,  198 => 76,  193 => 75,  184 => 71,  179 => 70,  169 => 66,  157 => 60,  151 => 64,  146 => 63,  134 => 48,  126 => 47,  118 => 46,  107 => 41,  103 => 40,  99 => 39,  83 => 27,  80 => 26,  72 => 22,  66 => 19,  60 => 16,  54 => 18,  51 => 11,  49 => 13,  43 => 6,  40 => 11,  651 => 437,  648 => 436,  640 => 434,  638 => 433,  610 => 407,  607 => 404,  595 => 394,  587 => 388,  580 => 387,  552 => 361,  541 => 359,  536 => 358,  525 => 356,  520 => 355,  509 => 353,  505 => 352,  492 => 341,  483 => 333,  458 => 309,  437 => 289,  404 => 257,  382 => 236,  357 => 212,  336 => 192,  311 => 112,  290 => 148,  269 => 128,  257 => 117,  249 => 115,  245 => 95,  236 => 112,  230 => 87,  223 => 109,  215 => 107,  211 => 105,  202 => 86,  197 => 103,  192 => 102,  188 => 73,  178 => 93,  174 => 67,  166 => 85,  163 => 63,  156 => 67,  153 => 74,  148 => 55,  138 => 63,  128 => 55,  124 => 58,  121 => 57,  116 => 49,  111 => 42,  108 => 50,  101 => 46,  97 => 45,  92 => 44,  86 => 41,  77 => 34,  56 => 17,  53 => 16,  45 => 12,  42 => 11,  37 => 9,  35 => 8,  33 => 7,  31 => 7,);
    }
}
