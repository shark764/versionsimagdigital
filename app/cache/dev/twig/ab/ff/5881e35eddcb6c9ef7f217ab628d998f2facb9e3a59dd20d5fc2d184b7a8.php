<?php

/* MinsalSiapsBundle:Form:form_admin_fields.html.twig */
class __TwigTemplate_abff5881e35eddcb6c9ef7f217ab628d998f2facb9e3a59dd20d5fc2d184b7a8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig");

        $this->blocks = array(
            'field_row' => array($this, 'block_field_row'),
            'label' => array($this, 'block_label'),
            'repeated_row' => array($this, 'block_repeated_row'),
            'sonata_admin_orm_one_to_many_widget' => array($this, 'block_sonata_admin_orm_one_to_many_widget'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_field_row($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if ((((!array_key_exists("sonata_admin", $context)) || (!(isset($context["sonata_admin_enabled"]) ? $context["sonata_admin_enabled"] : $this->getContext($context, "sonata_admin_enabled")))) || (!$this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description")))) {
            // line 5
            echo "        ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
            echo "
        ";
            // line 6
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
        ";
            // line 7
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
            echo "
    ";
        } else {
            // line 9
            echo "        <div class=\"control-group";
            if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
                echo " error";
            }
            echo "\" id=\"sonata-ba-field-container-";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "\">
            ";
            // line 10
            $this->displayBlock('label', $context, $blocks);
            // line 17
            echo "
            <div class=\"controls sonata-ba-field sonata-ba-field-";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit"), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "inline"), "html", null, true);
            echo " ";
            if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
                echo "sonata-ba-field-error";
            }
            echo "\">
                ";
            // line 19
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
            echo "

                ";
            // line 21
            if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
                echo "                                        
                    <i class=\"ui-icon ui-icon-alert\" data-title=\"";
                // line 22
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("error"), "html", null, true);
                echo "\" data-content=\"";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "\" style=\"display: inline-block\"></i>
                ";
            }
            // line 24
            echo "
                ";
            // line 25
            if ($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help")) {
                // line 26
                echo "                    <span class=\"help-block sonata-ba-field-help\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help"), "html", null, true);
                echo "</span>
                ";
            }
            // line 28
            echo "            </div>
        </div>
    ";
        }
    }

    // line 10
    public function block_label($context, array $blocks = array())
    {
        // line 11
        echo "                ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "options", array(), "any", false, true), "name", array(), "any", true, true)) {
            // line 12
            echo "                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', array("attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "options"), "name")) ? array() : array("label" => $_label_)));
            echo "
                ";
        } else {
            // line 14
            echo "                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', array("attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
            echo "
                ";
        }
        // line 16
        echo "            ";
    }

    // line 34
    public function block_repeated_row($context, array $blocks = array())
    {
        // line 35
        echo "    <div class=\"control-group";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            echo " error";
        }
        echo "\" id=\"sonata-ba-field-container-";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\">
        ";
        // line 36
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "first"), 'label', array("attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "

        <div class=\"controls sonata-ba-field sonata-ba-field-";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit"), "html", null, true);
        echo "-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "inline"), "html", null, true);
        echo " ";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            echo "sonata-ba-field-error";
        }
        echo "\">

            ";
        // line 40
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "first"), 'widget');
        echo "

            ";
        // line 42
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            // line 43
            echo "                <div class=\"help-inline sonata-ba-field-error-messages\">
                    ";
            // line 44
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "first"), 'errors');
            echo "
                </div>
            ";
        }
        // line 47
        echo "
            ";
        // line 48
        if ($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help")) {
            // line 49
            echo "                <span class=\"help-block sonata-ba-field-help\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help"), "html", null, true);
            echo "</span>
            ";
        }
        // line 51
        echo "        </div>
    </div>
    <div class=\"control-group";
        // line 53
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            echo " error";
        }
        echo "\" id=\"sonata-ba-field-container-";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\">
        ";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second"), 'label', array("attr" => array("class" => "control-label")) + (twig_test_empty($_label_ = (($this->getAttribute((isset($context["label"]) ? $context["label"] : null), "second", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label"]) ? $context["label"] : null), "second"), null)) : (null))) ? array() : array("label" => $_label_)));
        echo "

        <div class=\"controls sonata-ba-field sonata-ba-field-";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit"), "html", null, true);
        echo "-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "inline"), "html", null, true);
        echo " ";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            echo "sonata-ba-field-error";
        }
        echo "\">

            ";
        // line 58
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second"), 'widget');
        echo "

            ";
        // line 60
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            // line 61
            echo "                <div class=\"help-inline sonata-ba-field-error-messages\">
                    ";
            // line 62
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second"), 'errors');
            echo "
                </div>
            ";
        }
        // line 65
        echo "
            ";
        // line 66
        if ($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help")) {
            // line 67
            echo "                <span class=\"help-block sonata-ba-field-help\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description"), "help"), "html", null, true);
            echo "</span>
            ";
        }
        // line 69
        echo "        </div>
    </div>
";
    }

    // line 72
    public function block_sonata_admin_orm_one_to_many_widget($context, array $blocks = array())
    {
        // line 73
        echo "    ";
        $this->env->loadTemplate("MinsalSiapsBundle:CRUD:edit_orm_one_to_many.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:Form:form_admin_fields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  221 => 61,  198 => 54,  148 => 38,  143 => 36,  127 => 16,  60 => 10,  37 => 5,  31 => 3,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 331,  1030 => 324,  1022 => 321,  1020 => 320,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 302,  954 => 300,  946 => 296,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 275,  897 => 274,  891 => 271,  884 => 267,  881 => 265,  879 => 264,  876 => 263,  869 => 259,  867 => 258,  840 => 255,  837 => 253,  835 => 252,  833 => 251,  830 => 250,  822 => 245,  815 => 239,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  793 => 227,  786 => 224,  779 => 216,  754 => 208,  748 => 205,  737 => 199,  735 => 198,  732 => 197,  719 => 187,  717 => 186,  714 => 185,  701 => 180,  699 => 179,  692 => 175,  690 => 174,  687 => 173,  681 => 169,  658 => 158,  654 => 155,  649 => 153,  645 => 150,  636 => 145,  633 => 144,  629 => 141,  627 => 140,  624 => 139,  620 => 136,  614 => 133,  599 => 128,  594 => 127,  592 => 126,  587 => 123,  584 => 122,  579 => 118,  574 => 113,  570 => 112,  567 => 110,  565 => 109,  554 => 103,  552 => 102,  548 => 100,  541 => 97,  539 => 96,  536 => 95,  505 => 88,  477 => 82,  472 => 79,  446 => 75,  435 => 69,  425 => 64,  410 => 59,  334 => 26,  330 => 23,  314 => 16,  298 => 12,  290 => 7,  275 => 330,  273 => 317,  255 => 284,  247 => 72,  245 => 270,  237 => 262,  232 => 249,  204 => 215,  199 => 212,  196 => 211,  188 => 194,  169 => 44,  159 => 40,  156 => 157,  154 => 153,  131 => 34,  114 => 91,  101 => 73,  94 => 25,  91 => 24,  89 => 37,  84 => 22,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 344,  980 => 323,  975 => 305,  959 => 310,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  902 => 276,  896 => 296,  888 => 270,  873 => 284,  868 => 282,  864 => 281,  856 => 279,  848 => 277,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 244,  814 => 265,  811 => 264,  809 => 263,  806 => 234,  800 => 258,  794 => 255,  791 => 226,  789 => 225,  785 => 251,  782 => 221,  770 => 249,  767 => 248,  764 => 247,  761 => 246,  758 => 245,  756 => 244,  751 => 206,  739 => 200,  733 => 238,  725 => 233,  722 => 232,  705 => 230,  688 => 229,  683 => 170,  678 => 168,  675 => 225,  672 => 224,  662 => 218,  660 => 217,  638 => 214,  617 => 135,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 206,  595 => 205,  582 => 198,  580 => 197,  577 => 116,  575 => 114,  572 => 194,  562 => 108,  550 => 101,  543 => 189,  537 => 187,  535 => 186,  526 => 182,  523 => 181,  521 => 180,  518 => 179,  515 => 178,  492 => 174,  490 => 167,  470 => 78,  467 => 159,  464 => 158,  461 => 157,  444 => 154,  442 => 153,  439 => 71,  436 => 151,  433 => 150,  430 => 149,  427 => 65,  415 => 144,  412 => 60,  390 => 133,  380 => 130,  367 => 123,  360 => 38,  346 => 33,  343 => 116,  329 => 111,  313 => 106,  308 => 105,  303 => 103,  300 => 13,  294 => 98,  281 => 94,  278 => 331,  254 => 85,  239 => 84,  234 => 83,  231 => 82,  228 => 81,  212 => 224,  207 => 216,  186 => 51,  183 => 189,  173 => 177,  157 => 58,  149 => 148,  135 => 50,  121 => 14,  109 => 10,  103 => 38,  64 => 3,  44 => 14,  513 => 189,  502 => 87,  498 => 182,  495 => 175,  483 => 180,  480 => 179,  478 => 176,  476 => 163,  459 => 171,  456 => 170,  449 => 148,  424 => 147,  416 => 161,  407 => 157,  402 => 58,  399 => 56,  396 => 135,  376 => 150,  373 => 46,  371 => 142,  357 => 37,  351 => 135,  348 => 134,  345 => 133,  325 => 129,  323 => 19,  296 => 111,  280 => 106,  270 => 316,  267 => 90,  264 => 89,  262 => 97,  259 => 86,  249 => 94,  243 => 92,  240 => 263,  226 => 86,  223 => 85,  217 => 232,  202 => 79,  191 => 196,  181 => 185,  178 => 48,  175 => 47,  171 => 173,  166 => 43,  161 => 162,  151 => 152,  142 => 54,  124 => 108,  113 => 45,  85 => 39,  82 => 38,  77 => 27,  71 => 15,  327 => 154,  321 => 18,  283 => 138,  277 => 105,  272 => 134,  265 => 299,  248 => 116,  236 => 89,  216 => 100,  214 => 58,  209 => 223,  203 => 56,  192 => 88,  187 => 87,  185 => 86,  182 => 85,  170 => 79,  165 => 77,  158 => 75,  153 => 72,  147 => 69,  138 => 51,  136 => 138,  132 => 49,  120 => 56,  104 => 74,  98 => 47,  72 => 37,  54 => 28,  51 => 9,  141 => 143,  107 => 44,  28 => 4,  39 => 11,  33 => 15,  29 => 6,  26 => 5,  22 => 3,  19 => 2,  118 => 44,  86 => 36,  67 => 23,  63 => 13,  57 => 29,  48 => 26,  40 => 3,  35 => 16,  21 => 1,  392 => 107,  389 => 51,  383 => 49,  377 => 47,  368 => 99,  365 => 41,  362 => 39,  354 => 95,  349 => 34,  335 => 89,  332 => 130,  324 => 85,  309 => 118,  305 => 104,  302 => 76,  276 => 67,  257 => 291,  252 => 283,  233 => 66,  230 => 65,  224 => 62,  222 => 238,  194 => 197,  167 => 36,  150 => 35,  146 => 147,  144 => 144,  140 => 53,  134 => 35,  129 => 122,  126 => 121,  119 => 95,  116 => 94,  110 => 51,  102 => 28,  97 => 36,  95 => 35,  90 => 33,  78 => 40,  76 => 25,  69 => 11,  59 => 30,  55 => 12,  41 => 18,  30 => 2,  24 => 4,  115 => 12,  106 => 86,  96 => 26,  92 => 34,  80 => 21,  73 => 26,  62 => 17,  53 => 17,  45 => 24,  12 => 36,  1002 => 387,  999 => 386,  996 => 385,  994 => 384,  992 => 381,  988 => 379,  985 => 378,  982 => 377,  974 => 375,  972 => 374,  969 => 318,  962 => 371,  957 => 301,  955 => 369,  952 => 368,  948 => 363,  945 => 362,  939 => 294,  935 => 357,  932 => 356,  929 => 355,  923 => 353,  917 => 351,  914 => 350,  912 => 349,  909 => 348,  906 => 300,  901 => 342,  898 => 341,  893 => 338,  887 => 336,  882 => 290,  863 => 328,  860 => 280,  854 => 325,  852 => 278,  841 => 321,  824 => 246,  820 => 318,  795 => 228,  778 => 315,  774 => 212,  772 => 312,  769 => 311,  766 => 309,  763 => 308,  760 => 307,  755 => 304,  752 => 303,  745 => 203,  742 => 202,  738 => 389,  736 => 239,  731 => 345,  728 => 192,  726 => 191,  723 => 190,  721 => 307,  718 => 306,  715 => 303,  709 => 296,  706 => 295,  704 => 182,  700 => 292,  696 => 178,  689 => 289,  685 => 287,  682 => 285,  676 => 282,  673 => 165,  671 => 164,  668 => 163,  666 => 220,  663 => 160,  661 => 159,  655 => 216,  652 => 154,  646 => 251,  643 => 149,  640 => 148,  635 => 268,  626 => 260,  621 => 213,  618 => 254,  616 => 249,  596 => 231,  593 => 230,  589 => 124,  586 => 200,  583 => 224,  578 => 270,  576 => 115,  571 => 228,  568 => 173,  566 => 224,  563 => 223,  560 => 222,  556 => 104,  553 => 168,  549 => 206,  547 => 205,  544 => 99,  540 => 202,  534 => 200,  532 => 185,  527 => 197,  524 => 196,  522 => 92,  519 => 91,  510 => 185,  507 => 186,  504 => 185,  499 => 188,  497 => 176,  488 => 176,  485 => 175,  481 => 166,  474 => 80,  471 => 173,  465 => 77,  463 => 76,  460 => 207,  458 => 204,  455 => 156,  453 => 169,  447 => 190,  440 => 172,  429 => 66,  426 => 170,  419 => 166,  413 => 160,  408 => 161,  403 => 160,  398 => 157,  393 => 156,  379 => 151,  374 => 101,  370 => 45,  356 => 142,  352 => 119,  337 => 27,  326 => 21,  322 => 109,  317 => 17,  307 => 124,  301 => 144,  295 => 11,  284 => 95,  279 => 68,  274 => 92,  269 => 91,  263 => 294,  258 => 101,  246 => 93,  242 => 269,  227 => 243,  219 => 60,  211 => 41,  200 => 78,  190 => 53,  145 => 56,  139 => 139,  133 => 52,  128 => 58,  123 => 57,  117 => 45,  111 => 90,  105 => 65,  99 => 54,  93 => 33,  87 => 32,  81 => 32,  75 => 19,  70 => 33,  66 => 10,  61 => 2,  56 => 18,  50 => 14,  47 => 15,  42 => 6,  451 => 155,  448 => 217,  445 => 175,  443 => 74,  441 => 212,  437 => 70,  434 => 143,  431 => 142,  423 => 63,  421 => 62,  418 => 145,  411 => 202,  406 => 201,  404 => 156,  401 => 199,  397 => 55,  394 => 54,  388 => 132,  384 => 152,  381 => 48,  378 => 151,  372 => 184,  366 => 146,  363 => 181,  361 => 145,  358 => 179,  355 => 178,  350 => 175,  347 => 140,  342 => 30,  339 => 28,  336 => 131,  331 => 133,  328 => 22,  320 => 108,  318 => 121,  315 => 120,  312 => 119,  304 => 152,  299 => 112,  297 => 141,  293 => 110,  291 => 129,  289 => 140,  287 => 5,  285 => 4,  282 => 3,  271 => 62,  268 => 300,  260 => 293,  253 => 93,  250 => 73,  241 => 69,  238 => 92,  235 => 67,  229 => 82,  225 => 81,  220 => 80,  218 => 75,  215 => 78,  210 => 81,  205 => 80,  201 => 213,  197 => 77,  193 => 68,  189 => 67,  184 => 65,  180 => 49,  176 => 178,  172 => 62,  168 => 61,  164 => 42,  160 => 76,  155 => 57,  152 => 56,  137 => 29,  122 => 53,  112 => 11,  100 => 37,  88 => 40,  83 => 20,  79 => 26,  74 => 16,  68 => 33,  65 => 18,  58 => 17,  52 => 6,  46 => 7,  43 => 19,  38 => 17,  36 => 16,  34 => 4,);
    }
}
