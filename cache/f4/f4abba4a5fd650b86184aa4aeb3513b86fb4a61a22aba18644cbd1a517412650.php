<?php
    use Twig\Environment;
    use Twig\Error\LoaderError;
    use Twig\Error\RuntimeError;
    use Twig\Extension\SandboxExtension;
    use Twig\Markup;
    use Twig\Sandbox\SecurityError;
    use Twig\Sandbox\SecurityNotAllowedTagError;
    use Twig\Sandbox\SecurityNotAllowedFilterError;
    use Twig\Sandbox\SecurityNotAllowedFunctionError;
    use Twig\Source;
    use Twig\Template;

    /* base.html.twig */

    class __TwigTemplate_4945873b03867521a5eb72ae1eccca20affb7222c062e183d95fdc1cd6122c07 extends Template
    {
        private $source;
        private $macros = [];

        public function __construct(Environment $env)
        {
            parent::__construct($env);

            $this->source = $this->getSourceContext();

            $this->parent = false;

            $this->blocks = [];
        }

        protected function doDisplay(array $context, array $blocks = [])
        {
            $macros = $this->macros;
            // line 1
            echo "<!doctype html>

    <html lang=\"fr\">
        <head>
            <meta charset=\"utf-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

            <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF\" crossorigin=\"anonymous\">

            <title>Logiciel - ";
            // line 10
            echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
            echo "</title>
        </head>

        <body>
            <center>
                <h1>Logiciel - ";
            // line 15
            echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
            echo "</h1>

                <p>Voici une page HTML, complétée par le texte : ";
            // line 17
            echo twig_escape_filter($this->env, ($context["text"] ?? null), "html", null, true);
            echo "</p>

                <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ\" crossorigin=\"anonymous\"></script>
            </center>
        </body>
    </html>";
        }

        public function getTemplateName()
        {
            return "base.html.twig";
        }

        public function isTraitable()
        {
            return false;
        }

        public function getDebugInfo()
        {
            return array(61 => 17,  56 => 15,  48 => 10,  37 => 1,);
        }

        public function getSourceContext()
        {
            return new Source("", "base.html.twig", "C:\\Users\\PC\\Desktop\\Célien\\Travail\\composer_twig-tp\\templates\\base.html.twig");
        }
    }
?>