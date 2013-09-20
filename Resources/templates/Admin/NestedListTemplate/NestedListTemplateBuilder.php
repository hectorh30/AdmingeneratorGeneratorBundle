{% use '../Admin/NestedListTemplate/modal.php.twig' %}
{% use '../Admin/ListTemplate/scopes.php.twig' %}
{% use '../Admin/stylesheets.php.twig' %}
{% use '../Admin/javascripts.php.twig' %}
{% use '../Admin/title.php.twig' %}

{{ echo_extends( builder.getBaseAdminTemplate ) }}

{{ echo_block("javascripts") }}
    {{- block('complementary_javascripts') -}}
    <script type="text/javascript" src="{{ echo_twig('asset("bundles/admingeneratorgenerator/js/treeTable/jquery.treeTable-extended.js")') }}"></script>
    <script type="text/javascript" src="{{ echo_twig('asset("bundles/admingeneratorgenerator/js/admingenerator/nestedset.js")') }}"></script>
{{ echo_endblock() }}

{{ echo_block("stylesheets") }}
    {{- block('complementary_stylesheets') -}}
{{ echo_endblock() }}

{{- block('site_title') -}}

{{ echo_block("body") }}
    {{- block('title') -}}

    <div class="row-fluid">
        <div class="{% if builder.filterColumns|length == 0 %} span12 {% else %} span9 {% endif %}">
            {{ block('list_scopes') -}}

            {{ echo_include(
                builder.getDefinedOrGeneratedTemplateName(
                    builder.namespacePrefixForTemplate ~ bundle_name,
                    builder.BaseGeneratorName,
                    "list/results.html.twig"
                )
            ) }}
        </div>
        
        {{ echo_block("filters") }}
        {% if builder.filterColumns|length > 0 %}
            <div class="span3">
                {{ echo_include(
                    builder.getDefinedOrGeneratedTemplateName(
                        builder.namespacePrefixForTemplate ~ bundle_name,
                        builder.BaseGeneratorName,
                        "list/filters.html.twig"
                    )
                ) }}
            </div>
        {% endif %}
        {{ echo_endblock() }}
    </div>
    {{- block('nestedset_modal') -}}
{{ echo_endblock() }}
