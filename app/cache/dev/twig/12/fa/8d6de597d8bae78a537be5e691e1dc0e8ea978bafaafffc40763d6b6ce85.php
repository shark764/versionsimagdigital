<?php

/* @WebProfiler/Profiler/base_js.html.twig */
class __TwigTemplate_12fa8d6de597d8bae78a537be5e691e1dc0e8ea978bafaafffc40763d6b6ce85 extends Twig_Template
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
        // line 1
        echo "<script>/*<![CDATA[*/
    Sfjs = (function() {
        \"use strict\";

        var noop = function() {},

            profilerStorageKey = 'sf2/profiler/',

            request = function(url, onSuccess, onError, payload, options) {
                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                options = options || {};
                options.maxTries = options.maxTries || 0;
                xhr.open(options.method || 'GET', url, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onreadystatechange = function(state) {
                    if (4 !== xhr.readyState) {
                        return null;
                    }

                    if (xhr.status == 404 && options.maxTries > 1) {
                        setTimeout(function(){
                            options.maxTries--;
                            request(url, onSuccess, onError, payload, options);
                        }, 500);

                        return null;
                    }

                    if (200 === xhr.status) {
                        (onSuccess || noop)(xhr);
                    } else {
                        (onError || noop)(xhr);
                    }
                };
                xhr.send(payload || '');
            },

            hasClass = function(el, klass) {
                return el.className && el.className.match(new RegExp('\\\\b' + klass + '\\\\b'));
            },

            removeClass = function(el, klass) {
                if (el.className) {
                    el.className = el.className.replace(new RegExp('\\\\b' + klass + '\\\\b'), ' ');
                }
            },

            addClass = function(el, klass) {
                if (!hasClass(el, klass)) {
                    el.className += \" \" + klass;
                }
            },

            getPreference = function(name) {
                if (!window.localStorage) {
                    return null;
                }

                return localStorage.getItem(profilerStorageKey + name);
            },

            setPreference = function(name, value) {
                if (!window.localStorage) {
                    return null;
                }

                localStorage.setItem(profilerStorageKey + name, value);
            };

        return {
            hasClass: hasClass,

            removeClass: removeClass,

            addClass: addClass,

            getPreference: getPreference,

            setPreference: setPreference,

            request: request,

            load: function(selector, url, onSuccess, onError, options) {
                var el = document.getElementById(selector);

                if (el && el.getAttribute('data-sfurl') !== url) {
                    request(
                        url,
                        function(xhr) {
                            el.innerHTML = xhr.responseText;
                            el.setAttribute('data-sfurl', url);
                            removeClass(el, 'loading');
                            (onSuccess || noop)(xhr, el);
                        },
                        function(xhr) { (onError || noop)(xhr, el); },
                        '',
                        options
                    );
                }

                return this;
            },

            toggle: function(selector, elOn, elOff) {
                var i,
                    style,
                    tmp = elOn.style.display,
                    el = document.getElementById(selector);

                elOn.style.display = elOff.style.display;
                elOff.style.display = tmp;

                if (el) {
                    el.style.display = 'none' === tmp ? 'none' : 'block';
                }

                return this;
            }
        }
    })();
/*]]>*/</script>
";
    }

    public function getTemplateName()
    {
        return "@WebProfiler/Profiler/base_js.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  91 => 35,  83 => 30,  75 => 28,  42 => 12,  32 => 6,  30 => 5,  26 => 3,  24 => 2,  19 => 1,  1062 => 303,  1059 => 302,  1056 => 301,  1052 => 334,  1048 => 332,  1042 => 329,  1039 => 328,  1037 => 327,  1031 => 324,  1023 => 323,  1020 => 322,  1018 => 321,  1015 => 320,  1009 => 318,  1007 => 317,  1004 => 316,  998 => 314,  996 => 313,  993 => 312,  987 => 310,  985 => 309,  982 => 308,  976 => 306,  974 => 305,  971 => 304,  969 => 301,  966 => 300,  963 => 299,  959 => 264,  953 => 261,  950 => 260,  947 => 259,  944 => 258,  940 => 293,  935 => 290,  927 => 285,  922 => 283,  918 => 281,  916 => 280,  913 => 279,  909 => 277,  894 => 275,  890 => 274,  887 => 273,  885 => 272,  881 => 270,  875 => 268,  873 => 267,  869 => 265,  867 => 258,  864 => 257,  861 => 256,  858 => 255,  853 => 294,  850 => 255,  847 => 254,  842 => 335,  840 => 299,  835 => 296,  833 => 254,  830 => 253,  827 => 252,  822 => 244,  819 => 243,  815 => 242,  811 => 240,  805 => 239,  800 => 236,  794 => 235,  782 => 233,  779 => 232,  775 => 231,  769 => 230,  762 => 227,  758 => 226,  750 => 224,  744 => 223,  741 => 222,  738 => 221,  735 => 220,  730 => 219,  727 => 218,  725 => 217,  722 => 216,  719 => 215,  712 => 214,  709 => 213,  706 => 212,  703 => 211,  697 => 210,  694 => 209,  691 => 208,  688 => 206,  681 => 205,  678 => 204,  672 => 203,  669 => 202,  665 => 201,  662 => 200,  659 => 199,  656 => 198,  650 => 197,  646 => 195,  632 => 186,  626 => 184,  623 => 183,  620 => 182,  616 => 246,  613 => 243,  610 => 198,  608 => 197,  605 => 196,  602 => 182,  599 => 181,  593 => 247,  591 => 181,  587 => 179,  584 => 178,  577 => 337,  575 => 252,  571 => 250,  569 => 178,  566 => 177,  563 => 176,  555 => 165,  552 => 164,  541 => 157,  533 => 151,  530 => 150,  526 => 147,  522 => 145,  516 => 143,  510 => 141,  490 => 138,  486 => 136,  480 => 134,  472 => 132,  470 => 131,  467 => 130,  464 => 129,  432 => 123,  428 => 172,  424 => 170,  422 => 150,  418 => 148,  416 => 123,  405 => 114,  402 => 113,  399 => 112,  391 => 109,  385 => 107,  382 => 106,  372 => 103,  367 => 102,  353 => 96,  338 => 112,  333 => 93,  330 => 92,  327 => 91,  321 => 90,  314 => 86,  311 => 85,  297 => 84,  292 => 82,  289 => 81,  285 => 79,  282 => 78,  279 => 77,  262 => 76,  259 => 75,  248 => 71,  242 => 69,  239 => 68,  219 => 58,  214 => 57,  208 => 55,  196 => 51,  192 => 50,  185 => 46,  175 => 43,  167 => 42,  155 => 39,  152 => 38,  147 => 35,  134 => 32,  131 => 31,  119 => 25,  113 => 23,  107 => 341,  102 => 175,  100 => 91,  96 => 90,  92 => 88,  86 => 66,  84 => 38,  81 => 37,  79 => 29,  76 => 29,  69 => 23,  64 => 21,  60 => 19,  56 => 17,  52 => 15,  48 => 13,  46 => 14,  570 => 195,  562 => 190,  556 => 186,  554 => 185,  550 => 183,  544 => 158,  542 => 180,  538 => 178,  532 => 175,  529 => 174,  527 => 173,  524 => 172,  521 => 171,  518 => 170,  513 => 142,  509 => 161,  505 => 159,  499 => 157,  496 => 140,  493 => 155,  479 => 154,  473 => 152,  469 => 150,  463 => 148,  460 => 147,  452 => 145,  446 => 128,  443 => 127,  441 => 126,  438 => 125,  435 => 124,  417 => 138,  414 => 137,  412 => 136,  409 => 135,  406 => 134,  403 => 133,  395 => 111,  393 => 117,  384 => 110,  381 => 109,  377 => 104,  374 => 104,  370 => 100,  364 => 101,  361 => 100,  358 => 96,  355 => 95,  351 => 102,  349 => 94,  346 => 93,  344 => 94,  341 => 173,  335 => 100,  331 => 105,  328 => 103,  325 => 93,  323 => 92,  320 => 91,  317 => 87,  313 => 126,  308 => 123,  306 => 109,  301 => 106,  299 => 90,  283 => 76,  280 => 75,  277 => 74,  273 => 71,  270 => 70,  264 => 68,  258 => 66,  256 => 74,  251 => 64,  249 => 63,  241 => 60,  234 => 64,  231 => 63,  225 => 61,  223 => 133,  215 => 131,  211 => 56,  209 => 127,  206 => 74,  203 => 72,  201 => 57,  198 => 56,  189 => 51,  183 => 49,  181 => 44,  172 => 42,  162 => 38,  158 => 37,  154 => 36,  146 => 34,  142 => 33,  126 => 29,  122 => 26,  115 => 24,  111 => 22,  105 => 176,  94 => 19,  90 => 68,  87 => 16,  80 => 13,  74 => 25,  70 => 26,  66 => 25,  62 => 24,  58 => 18,  54 => 16,  49 => 5,  41 => 3,  272 => 89,  266 => 87,  263 => 86,  260 => 85,  250 => 72,  246 => 122,  237 => 59,  229 => 111,  222 => 60,  212 => 98,  205 => 53,  202 => 95,  200 => 94,  195 => 55,  191 => 91,  188 => 90,  186 => 85,  180 => 83,  177 => 82,  171 => 128,  168 => 41,  166 => 82,  163 => 81,  159 => 41,  156 => 78,  150 => 35,  145 => 73,  138 => 33,  135 => 31,  130 => 70,  128 => 30,  124 => 65,  121 => 64,  116 => 61,  110 => 57,  104 => 54,  99 => 51,  97 => 20,  53 => 10,  50 => 15,  44 => 11,  38 => 4,  35 => 3,);
    }
}
