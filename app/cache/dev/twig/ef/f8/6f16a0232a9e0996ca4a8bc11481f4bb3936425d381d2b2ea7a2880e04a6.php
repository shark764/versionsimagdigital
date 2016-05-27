<?php

/* SonataAdminBundle:Block:block_admin_list.html.twig */
class __TwigTemplate_eff86f16a0232a9e0996ca4a8bc11481f4bb3936425d381d2b2ea7a2880e04a6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates"), "block_base"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["groups"]) ? $context["groups"] : $this->getContext($context, "groups")));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 16
            echo "        ";
            $context["display"] = (twig_test_empty($this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "roles")) || $this->env->getExtension('security')->isGranted("ROLE_SUPER_ADMIN"));
            // line 17
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "roles"));
            foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
                if ((!(isset($context["display"]) ? $context["display"] : $this->getContext($context, "display")))) {
                    // line 18
                    echo "            ";
                    $context["display"] = $this->env->getExtension('security')->isGranted((isset($context["role"]) ? $context["role"] : $this->getContext($context, "role")));
                    // line 19
                    echo "        ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            echo "
        ";
            // line 21
            if ((isset($context["display"]) ? $context["display"] : $this->getContext($context, "display"))) {
                // line 22
                echo "            <div class=\"box\">
                <div class=\"box-header\">
                    <h3 class=\"box-title\">";
                // line 24
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "label"), array(), $this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "label_catalogue")), "html", null, true);
                echo "</h3>
                </div>
                <div class=\"box-body\">
                    <table class=\"table table-hover\">
                        <tbody>
                            ";
                // line 29
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "items"));
                foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
                    // line 30
                    echo "                                ";
                    if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "create"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CREATE"), "method")) || ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method")))) {
                        // line 31
                        echo "                                            <tr>
                                                <td class=\"sonata-ba-list-label\" width=\"40%\">
                                                    ";
                        // line 33
                        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "label"), array(), $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "translationdomain")), "html", null, true);
                        echo "
                                                </td>
                                                <td>
                                                    <div class=\"btn-group\">
                                                        ";
                        // line 37
                        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "create"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CREATE"), "method"))) {
                            // line 38
                            echo "                                                            ";
                            if (twig_test_empty($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "subClasses"))) {
                                // line 39
                                echo "                                                                <a class=\"btn btn-link btn-flat\" href=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
                                echo "\">
                                                                    <i class=\"fa fa-plus-circle\"></i>
                                                                    ";
                                // line 41
                                echo $this->env->getExtension('translator')->getTranslator()->trans("link_add", array(), "SonataAdminBundle");
                                // line 42
                                echo "                                                                </a>
                                                            ";
                            } else {
                                // line 44
                                echo "                                                                <a class=\"btn btn-link btn-flat dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                                                                    <i class=\"fa fa-plus-circle\"></i>
                                                                    ";
                                // line 46
                                echo $this->env->getExtension('translator')->getTranslator()->trans("link_add", array(), "SonataAdminBundle");
                                // line 47
                                echo "                                                                    <span class=\"caret\"></span>
                                                                </a>
                                                                <ul class=\"dropdown-menu\">
                                                                    ";
                                // line 50
                                $context['_parent'] = (array) $context;
                                $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "subclasses")));
                                foreach ($context['_seq'] as $context["_key"] => $context["subclass"]) {
                                    // line 51
                                    echo "                                                                        <li>
                                                                            <a href=\"";
                                    // line 52
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create", 1 => array("subclass" => (isset($context["subclass"]) ? $context["subclass"] : $this->getContext($context, "subclass")))), "method"), "html", null, true);
                                    echo "\">";
                                    echo twig_escape_filter($this->env, (isset($context["subclass"]) ? $context["subclass"] : $this->getContext($context, "subclass")), "html", null, true);
                                    echo "</a>
                                                                        </li>
                                                                    ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subclass'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 55
                                echo "                                                                </ul>
                                                            ";
                            }
                            // line 57
                            echo "                                                        ";
                        }
                        // line 58
                        echo "                                                        ";
                        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                            // line 59
                            echo "                                                            <a class=\"btn btn-link btn-flat\" href=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
                            echo "\">
                                                                <i class=\"glyphicon glyphicon-list\"></i>
                                                                ";
                            // line 61
                            echo $this->env->getExtension('translator')->getTranslator()->trans("link_list", array(), "SonataAdminBundle");
                            // line 62
                            echo "</a>
                                                        ";
                        }
                        // line 64
                        echo "                                                    </div>
                                                </td>
                                            </tr>
                                ";
                    }
                    // line 68
                    echo "                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['admin'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 69
                echo "                        </tbody>
                    </table>
                </div>
            </div>
        ";
            }
            // line 74
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Block:block_admin_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  585 => 224,  551 => 208,  546 => 206,  506 => 194,  503 => 193,  488 => 168,  485 => 167,  478 => 165,  475 => 164,  471 => 157,  448 => 123,  386 => 127,  378 => 91,  375 => 90,  306 => 133,  291 => 87,  286 => 85,  392 => 107,  332 => 145,  318 => 83,  276 => 67,  190 => 54,  12 => 36,  195 => 51,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1018 => 321,  1015 => 320,  1009 => 318,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  966 => 300,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  913 => 279,  909 => 277,  894 => 275,  890 => 274,  887 => 273,  885 => 272,  875 => 268,  861 => 256,  858 => 255,  853 => 294,  850 => 255,  847 => 254,  842 => 335,  827 => 252,  805 => 239,  775 => 231,  769 => 230,  762 => 227,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  730 => 219,  727 => 218,  712 => 214,  709 => 213,  706 => 212,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  669 => 202,  665 => 201,  659 => 199,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  616 => 246,  613 => 232,  610 => 198,  608 => 197,  605 => 196,  602 => 230,  593 => 247,  591 => 181,  571 => 250,  566 => 177,  533 => 203,  530 => 150,  513 => 142,  496 => 140,  441 => 126,  438 => 125,  432 => 123,  428 => 172,  422 => 150,  416 => 123,  395 => 91,  391 => 109,  382 => 106,  372 => 89,  364 => 164,  353 => 96,  335 => 89,  333 => 93,  297 => 84,  292 => 82,  205 => 59,  200 => 94,  184 => 87,  1074 => 338,  1068 => 336,  1066 => 335,  1064 => 334,  1060 => 333,  1051 => 332,  1048 => 332,  1030 => 324,  1022 => 321,  1020 => 322,  1016 => 319,  1010 => 318,  1007 => 317,  995 => 312,  989 => 310,  983 => 308,  981 => 307,  979 => 306,  971 => 304,  967 => 303,  963 => 299,  957 => 301,  954 => 300,  946 => 296,  939 => 294,  930 => 287,  928 => 286,  924 => 285,  921 => 284,  908 => 278,  904 => 277,  900 => 275,  897 => 274,  891 => 271,  884 => 267,  881 => 270,  879 => 264,  876 => 263,  869 => 265,  867 => 258,  840 => 299,  837 => 253,  835 => 296,  833 => 254,  830 => 253,  824 => 246,  822 => 244,  815 => 242,  812 => 238,  808 => 235,  804 => 233,  801 => 232,  797 => 229,  795 => 228,  793 => 227,  786 => 224,  779 => 232,  774 => 212,  754 => 208,  748 => 205,  745 => 203,  742 => 202,  737 => 199,  735 => 220,  732 => 197,  728 => 192,  726 => 191,  723 => 190,  719 => 215,  717 => 186,  714 => 185,  704 => 182,  701 => 180,  699 => 179,  696 => 178,  690 => 174,  687 => 173,  681 => 205,  673 => 165,  671 => 164,  668 => 163,  663 => 160,  658 => 158,  654 => 155,  649 => 153,  643 => 149,  640 => 148,  636 => 145,  633 => 144,  629 => 141,  627 => 140,  624 => 139,  620 => 182,  614 => 133,  599 => 181,  594 => 127,  592 => 126,  589 => 124,  587 => 179,  584 => 178,  576 => 115,  574 => 113,  570 => 112,  567 => 110,  554 => 103,  552 => 164,  544 => 158,  541 => 157,  539 => 96,  522 => 145,  519 => 200,  505 => 88,  502 => 87,  477 => 82,  472 => 132,  465 => 77,  463 => 76,  446 => 128,  443 => 127,  429 => 116,  425 => 64,  410 => 59,  397 => 55,  394 => 54,  389 => 128,  357 => 37,  342 => 149,  334 => 26,  330 => 92,  328 => 22,  290 => 7,  287 => 71,  263 => 58,  255 => 284,  245 => 270,  194 => 66,  76 => 27,  1145 => 401,  1132 => 392,  1127 => 390,  1123 => 389,  1119 => 387,  1117 => 386,  1112 => 385,  1109 => 384,  1103 => 321,  1097 => 318,  1087 => 376,  1080 => 340,  1077 => 372,  1061 => 370,  1055 => 369,  1038 => 368,  1036 => 326,  1034 => 366,  1024 => 322,  1004 => 316,  980 => 323,  975 => 305,  969 => 301,  959 => 264,  942 => 295,  936 => 306,  919 => 305,  916 => 280,  910 => 301,  906 => 300,  902 => 276,  896 => 296,  888 => 270,  882 => 290,  873 => 267,  868 => 282,  864 => 257,  860 => 280,  856 => 279,  852 => 278,  848 => 277,  843 => 257,  838 => 272,  832 => 271,  826 => 247,  823 => 268,  819 => 243,  814 => 265,  811 => 240,  809 => 263,  806 => 234,  800 => 236,  794 => 235,  791 => 226,  789 => 225,  785 => 251,  782 => 233,  770 => 249,  767 => 248,  764 => 247,  761 => 246,  758 => 226,  756 => 244,  751 => 206,  739 => 200,  736 => 239,  733 => 238,  725 => 217,  722 => 216,  705 => 230,  688 => 206,  675 => 225,  672 => 203,  662 => 200,  660 => 217,  655 => 216,  638 => 214,  621 => 213,  617 => 135,  612 => 211,  609 => 129,  606 => 209,  603 => 208,  600 => 207,  598 => 229,  595 => 205,  586 => 200,  582 => 198,  580 => 197,  572 => 218,  568 => 173,  562 => 214,  556 => 104,  550 => 101,  535 => 186,  526 => 147,  521 => 180,  515 => 178,  497 => 191,  492 => 182,  481 => 166,  476 => 163,  467 => 156,  451 => 155,  424 => 115,  418 => 148,  412 => 60,  399 => 112,  396 => 135,  390 => 133,  388 => 132,  383 => 104,  377 => 102,  373 => 46,  370 => 45,  367 => 102,  352 => 155,  349 => 154,  346 => 93,  329 => 111,  326 => 86,  313 => 137,  303 => 103,  300 => 13,  234 => 64,  218 => 75,  207 => 216,  178 => 184,  321 => 90,  295 => 11,  274 => 79,  242 => 110,  236 => 109,  692 => 175,  683 => 170,  678 => 204,  676 => 385,  666 => 220,  661 => 159,  656 => 198,  652 => 154,  645 => 150,  641 => 368,  635 => 365,  631 => 364,  625 => 361,  615 => 354,  607 => 349,  597 => 342,  590 => 226,  583 => 334,  579 => 222,  577 => 221,  575 => 252,  569 => 178,  565 => 109,  548 => 207,  540 => 205,  536 => 95,  529 => 202,  524 => 297,  516 => 143,  510 => 196,  504 => 292,  500 => 192,  490 => 138,  486 => 136,  482 => 285,  470 => 131,  464 => 155,  459 => 125,  452 => 268,  434 => 256,  421 => 114,  417 => 243,  385 => 107,  361 => 100,  344 => 193,  339 => 28,  324 => 142,  310 => 171,  302 => 131,  296 => 89,  282 => 83,  259 => 118,  244 => 111,  231 => 106,  226 => 131,  114 => 51,  104 => 45,  288 => 107,  284 => 70,  279 => 82,  275 => 330,  256 => 74,  250 => 113,  237 => 109,  232 => 249,  222 => 44,  215 => 126,  191 => 196,  153 => 55,  563 => 176,  560 => 187,  558 => 186,  555 => 210,  553 => 168,  549 => 182,  543 => 189,  537 => 204,  532 => 185,  528 => 173,  525 => 201,  523 => 181,  518 => 179,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  495 => 175,  491 => 157,  487 => 156,  460 => 143,  455 => 156,  449 => 138,  442 => 153,  439 => 71,  436 => 151,  433 => 117,  426 => 126,  420 => 123,  415 => 144,  411 => 120,  405 => 114,  403 => 117,  400 => 233,  380 => 112,  366 => 169,  354 => 158,  331 => 96,  325 => 94,  320 => 141,  317 => 87,  311 => 85,  308 => 134,  304 => 85,  272 => 134,  267 => 90,  249 => 74,  216 => 99,  155 => 29,  152 => 62,  146 => 43,  126 => 55,  181 => 46,  161 => 53,  110 => 22,  188 => 194,  186 => 88,  170 => 44,  150 => 61,  124 => 57,  358 => 160,  351 => 135,  347 => 134,  343 => 116,  338 => 112,  327 => 143,  323 => 19,  319 => 124,  315 => 82,  301 => 144,  299 => 130,  293 => 88,  289 => 81,  281 => 94,  277 => 136,  271 => 78,  265 => 76,  262 => 76,  260 => 293,  257 => 56,  251 => 101,  248 => 71,  239 => 68,  228 => 81,  225 => 61,  213 => 69,  211 => 61,  197 => 72,  174 => 85,  148 => 49,  134 => 55,  127 => 59,  20 => 1,  53 => 20,  270 => 316,  253 => 71,  233 => 107,  212 => 58,  210 => 97,  206 => 54,  202 => 58,  198 => 66,  192 => 90,  185 => 61,  180 => 50,  175 => 74,  172 => 51,  167 => 41,  165 => 40,  160 => 50,  137 => 63,  113 => 23,  100 => 43,  90 => 38,  81 => 33,  129 => 26,  84 => 19,  77 => 31,  34 => 16,  118 => 46,  97 => 41,  70 => 29,  65 => 29,  58 => 22,  23 => 12,  480 => 134,  474 => 80,  469 => 158,  461 => 157,  457 => 153,  453 => 151,  444 => 122,  440 => 148,  437 => 118,  435 => 124,  430 => 149,  427 => 65,  423 => 63,  413 => 241,  409 => 132,  407 => 238,  402 => 113,  398 => 92,  393 => 230,  387 => 110,  384 => 114,  381 => 48,  379 => 119,  374 => 101,  368 => 99,  365 => 98,  362 => 97,  360 => 38,  355 => 106,  341 => 173,  337 => 90,  322 => 109,  314 => 86,  312 => 149,  309 => 79,  305 => 77,  298 => 12,  294 => 98,  285 => 79,  283 => 138,  278 => 331,  268 => 77,  264 => 89,  258 => 81,  252 => 53,  247 => 273,  241 => 77,  229 => 105,  220 => 128,  214 => 62,  177 => 86,  169 => 33,  140 => 51,  132 => 27,  128 => 42,  107 => 47,  61 => 28,  273 => 317,  269 => 91,  254 => 85,  243 => 89,  240 => 263,  238 => 84,  235 => 108,  230 => 61,  227 => 104,  224 => 103,  221 => 79,  219 => 64,  217 => 63,  208 => 96,  204 => 53,  179 => 37,  159 => 77,  143 => 59,  135 => 50,  119 => 54,  102 => 44,  71 => 32,  67 => 22,  63 => 59,  59 => 17,  38 => 5,  94 => 39,  89 => 36,  85 => 48,  75 => 34,  68 => 31,  56 => 21,  201 => 52,  196 => 56,  183 => 59,  171 => 43,  166 => 32,  163 => 32,  158 => 56,  156 => 64,  151 => 36,  142 => 31,  138 => 57,  136 => 58,  121 => 50,  117 => 53,  105 => 44,  91 => 38,  62 => 24,  49 => 22,  28 => 14,  26 => 14,  87 => 35,  31 => 19,  25 => 13,  21 => 1,  24 => 13,  19 => 11,  93 => 39,  88 => 37,  78 => 28,  46 => 19,  44 => 8,  27 => 14,  79 => 35,  72 => 25,  69 => 23,  47 => 25,  40 => 6,  37 => 17,  22 => 11,  246 => 68,  157 => 51,  145 => 68,  139 => 59,  131 => 60,  123 => 52,  120 => 51,  115 => 45,  111 => 47,  108 => 42,  101 => 42,  98 => 39,  96 => 37,  83 => 31,  74 => 30,  66 => 30,  55 => 15,  52 => 21,  50 => 9,  43 => 18,  41 => 23,  35 => 5,  32 => 4,  29 => 15,  209 => 223,  203 => 95,  199 => 57,  193 => 55,  189 => 63,  187 => 48,  182 => 51,  176 => 58,  173 => 35,  168 => 69,  164 => 79,  162 => 68,  154 => 37,  149 => 62,  147 => 34,  144 => 59,  141 => 58,  133 => 61,  130 => 57,  125 => 21,  122 => 56,  116 => 50,  112 => 70,  109 => 46,  106 => 26,  103 => 41,  99 => 41,  95 => 41,  92 => 38,  86 => 33,  82 => 36,  80 => 29,  73 => 27,  64 => 21,  60 => 28,  57 => 26,  54 => 23,  51 => 12,  48 => 10,  45 => 8,  42 => 7,  39 => 16,  36 => 4,  33 => 3,  30 => 15,);
    }
}
