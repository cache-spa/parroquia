<?php

/* TwigBundle:Exception:traces.txt.twig */
class __TwigTemplate_b5c4ededd383c0eb6139a5bcd452a5152ff65565168d5c15d52a146356e1ac7a extends Twig_Template
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
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "trace"))) {
            // line 2
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "trace"));
            foreach ($context['_seq'] as $context["_key"] => $context["trace"]) {
                // line 3
                $this->env->loadTemplate("TwigBundle:Exception:trace.txt.twig")->display(array("trace" => (isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace"))));
                // line 4
                echo "
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trace'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:traces.txt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 14,  38 => 13,  26 => 5,  87 => 20,  55 => 13,  25 => 3,  21 => 2,  94 => 22,  89 => 20,  85 => 19,  79 => 18,  75 => 17,  68 => 14,  64 => 12,  56 => 9,  41 => 9,  24 => 4,  201 => 92,  199 => 91,  196 => 90,  187 => 84,  183 => 82,  173 => 74,  171 => 73,  168 => 72,  166 => 71,  163 => 70,  158 => 67,  156 => 66,  151 => 63,  142 => 59,  138 => 57,  136 => 56,  133 => 55,  121 => 46,  117 => 44,  115 => 43,  112 => 42,  105 => 40,  91 => 31,  86 => 28,  69 => 25,  62 => 23,  51 => 15,  49 => 19,  39 => 6,  19 => 1,  93 => 9,  78 => 40,  46 => 7,  36 => 7,  32 => 12,  27 => 4,  22 => 2,  57 => 16,  43 => 8,  30 => 3,  123 => 47,  113 => 6,  107 => 5,  101 => 24,  99 => 43,  74 => 21,  70 => 20,  61 => 17,  54 => 21,  50 => 8,  44 => 10,  40 => 8,  35 => 4,  33 => 10,  29 => 5,  23 => 1,  154 => 60,  147 => 55,  135 => 49,  129 => 46,  122 => 42,  118 => 17,  114 => 40,  110 => 39,  106 => 38,  102 => 37,  98 => 40,  92 => 21,  88 => 6,  84 => 33,  80 => 19,  76 => 31,  72 => 16,  66 => 15,  63 => 18,  59 => 27,  34 => 5,  31 => 5,  28 => 3,);
    }
}
