<?php

/* SonataUserBundle:Security:base_login.html.twig */
class __TwigTemplate_37b6fa754ed6deb2d398912665f4fc507a749a13b455743abba6f0ddb11a74ad extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataUserBundle::layout.html.twig");

        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
            'sonata_user_login' => array($this, 'block_sonata_user_login'),
            'sonata_user_login_error' => array($this, 'block_sonata_user_login_error'),
            'sonata_user_login_form' => array($this, 'block_sonata_user_login_form'),
            'sonata_user_registration' => array($this, 'block_sonata_user_registration'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 15
        echo "    <div class=\"row\">
        <div class=\"col-sm-6\">
            ";
        // line 17
        $this->displayBlock('sonata_user_login', $context, $blocks);
        // line 83
        echo "        </div>
        <div class=\"col-sm-6\">
            ";
        // line 85
        $this->displayBlock('sonata_user_registration', $context, $blocks);
        // line 88
        echo "        </div>
    </div>
";
    }

    // line 17
    public function block_sonata_user_login($context, array $blocks = array())
    {
        // line 18
        echo "                <div class=\"panel panel-info\">

                <div class=\"panel-heading\">
                    <h2 class=\"panel-title\">";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_user_authentication", array(), "SonataUserBundle"), "html", null, true);
        echo "</h2>
                </div>

                <div class=\"panel-body\">

                    ";
        // line 26
        $this->displayBlock('sonata_user_login_error', $context, $blocks);
        // line 31
        echo "
                    ";
        // line 32
        $this->displayBlock('sonata_user_login_form', $context, $blocks);
        // line 80
        echo "                </div>
            </div>
            ";
    }

    // line 26
    public function block_sonata_user_login_error($context, array $blocks = array())
    {
        // line 27
        echo "                        ";
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 28
            echo "                            <div class=\"alert alert-danger alert-error\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), array(), "FOSUserBundle"), "html", null, true);
            echo "</div>
                        ";
        }
        // line 30
        echo "                    ";
    }

    // line 32
    public function block_sonata_user_login_form($context, array $blocks = array())
    {
        // line 33
        echo "                        <form action=\"";
        echo $this->env->getExtension('routing')->getPath("fos_user_security_check");
        echo "\" method=\"post\" role=\"form\"
                              class=\"form-horizontal\">
                            <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\"/>

                            <div class=\"form-group\">
                                <label for=\"username\"
                                       class=\"col-sm-4 control-label\">";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "SonataUserBundle"), "html", null, true);
        echo "</label>

                                <div class=\"col-sm-8\"><input type=\"text\" class=\"form-control\" id=\"username\"
                                                                      name=\"_username\" value=\"";
        // line 42
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\"
                                                                      required=\"required\"/></div>
                            </div>


                            <div class=\"form-group control-group\">
                                <label for=\"password\"
                                       class=\"col-sm-4 control-label\">";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "SonataUserBundle"), "html", null, true);
        echo "</label>

                                <div class=\"col-sm-8\"><input type=\"password\" class=\"form-control\" id=\"password\"
                                                                      name=\"_password\" required=\"required\"/></div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-sm-offset-4 col-sm-8\">
                                    <div class=\"checkbox control-group\">
                                        <label for=\"remember_me\">
                                            <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"/>
                                            ";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class=\"form-group control-group\">
                                <div class=\"controls col-sm-offset-4 col-sm-8\">
                                    <a href=\"";
        // line 68
        echo $this->env->getExtension('routing')->getPath("fos_user_resetting_request");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("forgotten_password", array(), "SonataUserBundle"), "html", null, true);
        echo "</a>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-sm-offset-4 col-sm-8\">
                                    <input type=\"submit\" id=\"_submit\" name=\"_submit\" class=\"btn btn-primary\"
                                           value=\"";
        // line 75
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\"/>
                                </div>
                            </div>
                        </form>
                    ";
    }

    // line 85
    public function block_sonata_user_registration($context, array $blocks = array())
    {
        // line 86
        echo "                ";
        echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('http_kernel')->controller("SonataUserBundle:RegistrationFOSUser1:register"), array());
        // line 87
        echo "            ";
    }

    public function getTemplateName()
    {
        return "SonataUserBundle:Security:base_login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  542 => 180,  538 => 178,  527 => 173,  509 => 161,  499 => 157,  493 => 155,  479 => 154,  473 => 152,  414 => 137,  406 => 134,  280 => 75,  223 => 133,  585 => 224,  551 => 208,  546 => 206,  506 => 194,  503 => 193,  488 => 168,  485 => 167,  478 => 165,  475 => 164,  471 => 157,  448 => 123,  386 => 127,  378 => 91,  375 => 90,  306 => 109,  291 => 87,  286 => 85,  392 => 107,  332 => 145,  318 => 83,  276 => 67,  190 => 54,  12 => 36,  195 => 55,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 275,  890 => 274,  887 => 273,  885 => 272,  875 => 268,  861 => 256,  858 => 255,  853 => 294,  850 => 255,  847 => 254,  842 => 335,  827 => 252,  805 => 239,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 213,  706 => 212,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 202,  665 => 201,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 246,  613 => 232,  610 => 198,  608 => 197,  605 => 196,  602 => 230,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 167,  496 => 156,  441 => 141,  438 => 140,  432 => 123,  428 => 172,  422 => 150,  416 => 123,  395 => 118,  391 => 109,  382 => 106,  372 => 89,  364 => 98,  353 => 96,  335 => 92,  333 => 93,  297 => 84,  292 => 82,  205 => 59,  200 => 94,  184 => 87,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 275,  897 => 274,  891 => 271,  884 => 267,  881 => 270,  879 => 264,  876 => 263,  869 => 265,  867 => 258,  840 => 299,  837 => 253,  835 => 296,  833 => 254,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 232,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 182,  701 => 180,  699 => 179,  696 => 178,  690 => 174,  687 => 173,  681 => 205,  673 => 165,  671 => 164,  668 => 163,  663 => 160,  658 => 158,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 144,  629 => 141,  627 => 140,  624 => 139,  620 => 182,  614 => 133,  599 => 181,  594 => 127,  592 => 126,  589 => 124,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 195,  567 => 110,  554 => 185,  552 => 164,  544 => 181,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 159,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 148,  446 => 143,  443 => 142,  429 => 116,  425 => 64,  410 => 59,  397 => 55,  394 => 54,  389 => 128,  357 => 37,  342 => 149,  334 => 26,  330 => 92,  328 => 103,  290 => 7,  287 => 71,  263 => 58,  255 => 284,  245 => 270,  194 => 66,  76 => 80,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 257,  860 => 280,  856 => 279,  852 => 278,  848 => 277,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 251,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 246,  758 => 226,  756 => 244,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 217,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 213,  617 => 135,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 229,  595 => 205,  586 => 200,  582 => 198,  580 => 197,  572 => 218,  568 => 173,  562 => 190,  556 => 186,  550 => 183,  535 => 186,  526 => 147,  521 => 171,  515 => 178,  497 => 191,  492 => 182,  481 => 166,  476 => 163,  467 => 156,  451 => 155,  424 => 115,  418 => 148,  412 => 136,  399 => 112,  396 => 135,  390 => 133,  388 => 132,  383 => 104,  377 => 104,  373 => 46,  370 => 100,  367 => 102,  352 => 155,  349 => 101,  346 => 95,  329 => 111,  326 => 86,  313 => 126,  303 => 103,  300 => 13,  234 => 58,  218 => 75,  207 => 216,  178 => 184,  321 => 90,  295 => 11,  274 => 79,  242 => 110,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 154,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 226,  583 => 334,  579 => 222,  577 => 221,  575 => 252,  569 => 178,  565 => 109,  548 => 207,  540 => 205,  536 => 95,  529 => 174,  524 => 172,  516 => 143,  510 => 196,  504 => 292,  500 => 192,  490 => 138,  486 => 136,  482 => 285,  470 => 131,  464 => 155,  459 => 125,  452 => 145,  434 => 256,  421 => 114,  417 => 138,  385 => 107,  361 => 97,  344 => 94,  339 => 28,  324 => 142,  310 => 171,  302 => 131,  296 => 89,  282 => 83,  259 => 118,  244 => 111,  231 => 57,  226 => 131,  114 => 39,  104 => 18,  288 => 107,  284 => 70,  279 => 82,  275 => 330,  256 => 65,  250 => 113,  237 => 59,  232 => 249,  222 => 44,  215 => 131,  191 => 196,  153 => 55,  563 => 176,  560 => 187,  558 => 186,  555 => 210,  553 => 168,  549 => 182,  543 => 189,  537 => 204,  532 => 175,  528 => 173,  525 => 201,  523 => 181,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 175,  491 => 157,  487 => 156,  460 => 147,  455 => 156,  449 => 138,  442 => 153,  439 => 71,  436 => 151,  433 => 117,  426 => 126,  420 => 123,  415 => 144,  411 => 120,  405 => 114,  403 => 133,  400 => 233,  380 => 112,  366 => 169,  354 => 158,  331 => 105,  325 => 93,  320 => 91,  317 => 90,  311 => 85,  308 => 123,  304 => 85,  272 => 134,  267 => 90,  249 => 63,  216 => 99,  155 => 68,  152 => 62,  146 => 34,  126 => 29,  181 => 48,  161 => 53,  110 => 42,  188 => 194,  186 => 88,  170 => 44,  150 => 35,  124 => 57,  358 => 96,  351 => 102,  347 => 134,  343 => 116,  338 => 112,  327 => 143,  323 => 92,  319 => 124,  315 => 82,  301 => 106,  299 => 90,  293 => 88,  289 => 81,  281 => 94,  277 => 74,  271 => 78,  265 => 76,  262 => 76,  260 => 293,  257 => 56,  251 => 64,  248 => 71,  239 => 68,  228 => 81,  225 => 162,  213 => 69,  211 => 128,  197 => 72,  174 => 85,  148 => 49,  134 => 55,  127 => 59,  20 => 1,  53 => 17,  270 => 70,  253 => 71,  233 => 107,  212 => 58,  210 => 97,  206 => 74,  202 => 58,  198 => 56,  192 => 90,  185 => 61,  180 => 50,  175 => 74,  172 => 42,  167 => 75,  165 => 40,  160 => 50,  137 => 63,  113 => 23,  100 => 40,  90 => 17,  81 => 26,  129 => 26,  84 => 19,  77 => 25,  34 => 5,  118 => 46,  97 => 20,  70 => 11,  65 => 29,  58 => 8,  23 => 13,  480 => 134,  474 => 80,  469 => 150,  461 => 157,  457 => 153,  453 => 151,  444 => 122,  440 => 148,  437 => 118,  435 => 139,  430 => 149,  427 => 65,  423 => 63,  413 => 241,  409 => 135,  407 => 238,  402 => 113,  398 => 92,  393 => 117,  387 => 110,  384 => 110,  381 => 109,  379 => 119,  374 => 103,  368 => 99,  365 => 98,  362 => 97,  360 => 38,  355 => 95,  341 => 93,  337 => 90,  322 => 109,  314 => 86,  312 => 149,  309 => 79,  305 => 77,  298 => 12,  294 => 98,  285 => 79,  283 => 76,  278 => 331,  268 => 77,  264 => 68,  258 => 66,  252 => 53,  247 => 273,  241 => 60,  229 => 105,  220 => 128,  214 => 62,  177 => 86,  169 => 33,  140 => 51,  132 => 27,  128 => 47,  107 => 35,  61 => 21,  273 => 71,  269 => 91,  254 => 85,  243 => 89,  240 => 263,  238 => 84,  235 => 108,  230 => 61,  227 => 104,  224 => 103,  221 => 79,  219 => 64,  217 => 63,  208 => 96,  204 => 53,  179 => 86,  159 => 77,  143 => 59,  135 => 31,  119 => 54,  102 => 44,  71 => 31,  67 => 31,  63 => 22,  59 => 17,  38 => 7,  94 => 30,  89 => 33,  85 => 27,  75 => 32,  68 => 31,  56 => 18,  201 => 57,  196 => 56,  183 => 49,  171 => 43,  166 => 32,  163 => 32,  158 => 37,  156 => 64,  151 => 36,  142 => 33,  138 => 32,  136 => 58,  121 => 50,  117 => 53,  105 => 21,  91 => 38,  62 => 9,  49 => 5,  28 => 3,  26 => 2,  87 => 16,  31 => 4,  25 => 3,  21 => 1,  24 => 6,  19 => 1,  93 => 39,  88 => 28,  78 => 34,  46 => 19,  44 => 4,  27 => 4,  79 => 31,  72 => 31,  69 => 26,  47 => 88,  40 => 6,  37 => 17,  22 => 1,  246 => 68,  157 => 51,  145 => 68,  139 => 59,  131 => 60,  123 => 52,  120 => 42,  115 => 24,  111 => 22,  108 => 42,  101 => 33,  98 => 32,  96 => 37,  83 => 31,  74 => 32,  66 => 10,  55 => 18,  52 => 17,  50 => 19,  43 => 18,  41 => 83,  35 => 15,  32 => 14,  29 => 2,  209 => 127,  203 => 72,  199 => 57,  193 => 55,  189 => 51,  187 => 48,  182 => 87,  176 => 85,  173 => 35,  168 => 41,  164 => 79,  162 => 38,  154 => 36,  149 => 62,  147 => 52,  144 => 60,  141 => 58,  133 => 61,  130 => 49,  125 => 46,  122 => 28,  116 => 44,  112 => 70,  109 => 19,  106 => 26,  103 => 38,  99 => 30,  95 => 41,  92 => 38,  86 => 36,  82 => 26,  80 => 13,  73 => 24,  64 => 21,  60 => 26,  57 => 20,  54 => 7,  51 => 12,  48 => 11,  45 => 85,  42 => 8,  39 => 17,  36 => 14,  33 => 6,  30 => 1,);
    }
}
