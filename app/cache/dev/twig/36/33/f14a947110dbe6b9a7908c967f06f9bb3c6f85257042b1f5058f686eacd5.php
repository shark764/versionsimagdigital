<?php

/* MinsalSiapsBundle::ServicioMedicoEstablecimiento.html.twig */
class __TwigTemplate_3633f14a947110dbe6b9a7908c967f06f9bb3c6f85257042b1f5058f686eacd5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_side_nav' => array($this, 'block_sonata_side_nav'),
            'content' => array($this, 'block_content'),
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

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "\t";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 7
    public function block_javascripts($context, array $blocks = array())
    {
        // line 8
        echo "\t";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

\t<script type=\"text/javascript\">
\t\tjQuery(document).ready(function(\$) {
\t\t\t\$field = \$('#_id-especialidad');
\t\t\t\$field.prepend('<option/>').val(function(){return \$('[selected]',this).val() ;})

\t\t\t\$field.select2({
\t\t\t\tplaceholder: 'Seleccionar Especialidad...',
\t\t\t\tallowClear: true
\t\t\t});

\t\t\t";
        // line 20
        if ((isset($context["empEspecialidades"]) ? $context["empEspecialidades"] : $this->getContext($context, "empEspecialidades"))) {
            // line 21
            echo "\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["empEspecialidades"]) ? $context["empEspecialidades"] : $this->getContext($context, "empEspecialidades")));
            foreach ($context['_seq'] as $context["_key"] => $context["especialidad"]) {
                // line 22
                echo "\t\t\t\t\t\$field.append(\$('<option>', {value: ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidad"]) ? $context["especialidad"] : $this->getContext($context, "especialidad")), "getId", array(), "method"), "html", null, true);
                echo ", text: '";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidad"]) ? $context["especialidad"] : $this->getContext($context, "especialidad")), "getNombreConsulta", array(), "method"), "html", null, true);
                echo "' }));
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['especialidad'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "\t\t\t";
        }
        // line 25
        echo "
\t\t\t\$field.on('change', function(e){
\t\t\t\tif(e.val) {

\t\t\t\t\t\$('#_nombre-especialidad').val(\$('#_id-especialidad option:selected').text());
\t\t\t\t}
\t\t\t});

            \$(document).on('submit','form',function(e){

               if(\$('#_id-especialidad option:selected').val() == \"\") {
               \t\tif(\$('div#dialog-message').length == 0) {
                        \$('body').append('<div id=\"dialog-message\"></div>');
                    } else {
                        \$('#dialog-message').empty();
                    }

                    \$(\"#dialog-message\").append('<p><i class=\"icon-warning-sign\" style=\"margin-right:7px;\"></i>\\
                                         La especialidad no ha sido seleccionada, por favor seleccione una especialidad \\
                                         antes de continuar.</p>');

                    \$(\"#dialog-message\").dialog({
                        dialogClass: \"dialog-error\",
                        modal: true,
                        title: 'Especialidad no seleccionada!!!',
                        buttons: {
                            Cerrar: function() {
                                    \$( this ).dialog( \"close\" );
                            }
                        }
                    });

                \te.preventDefault();
               }
            });
\t\t});
\t</script>
";
    }

    // line 64
    public function block_sonata_side_nav($context, array $blocks = array())
    {
    }

    // line 66
    public function block_content($context, array $blocks = array())
    {
        // line 67
        echo "\t<form action=\"";
        echo $this->env->getExtension('routing')->getUrl("set_emp_especialidad_estab");
        echo "\" method=\"POST\">
\t\t<center>
\t\t\t<label>Seleccion una especialidad: *</label><br />
\t\t\t<select id=\"_id-especialidad\" name=\"_id-especialidad\" style=\"width:300px;\"></select>
\t\t\t<input type=\"hidden\" id=\"_nombre-especialidad\" name=\"_nombre-especialidad\" value=\"\" />
\t\t\t<br /><br />
\t\t\t";
        // line 73
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array(), "any", false, true), "get", array(0 => "_secured_token"), "method", true, true) && (!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_secured_token"), "method"))))) {
            // line 74
            echo "\t\t\t\t<input type=\"hidden\" name=\"_provided_token\" id=\"_provided_token\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_secured_token"), "method"), "html", null, true);
            echo "\" />
\t\t\t\t<input type=\"hidden\" name=\"previous_url\" id=\"previous_url\" value=\"";
            // line 75
            echo twig_escape_filter($this->env, (isset($context["previous_url"]) ? $context["previous_url"] : $this->getContext($context, "previous_url")), "html", null, true);
            echo "\" />
\t\t\t";
        }
        // line 77
        echo "\t\t\t<button type=\"submit\" id=\"_enviar-especialida\" name=\"_enviar-especialida\" class=\"btn btn-primary\" formaction=\"";
        echo $this->env->getExtension('routing')->getUrl("set_emp_especialidad_estab");
        echo "\"><span class=\"label\">Ingresar</span></button>
\t\t</center>
\t</form>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle::ServicioMedicoEstablecimiento.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 77,  147 => 75,  142 => 74,  140 => 73,  130 => 67,  127 => 66,  122 => 64,  81 => 25,  78 => 24,  67 => 22,  62 => 21,  60 => 20,  44 => 8,  41 => 7,  34 => 4,  31 => 3,);
    }
}
