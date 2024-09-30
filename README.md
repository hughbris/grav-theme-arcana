# Arcana Theme

The **Arcana** Theme is for [Grav CMS](http://github.com/getgrav/grav).  This README.md file should be modified to describe the features, installation, configuration, and general usage of this theme.

## Description

Grav port of Arcana theme by HTML5UP

## Customising

### Logo heading override suggestion

The source HTML5UP theme uses a consistent `h1` element heading whose contents are the site title. This theme implements this too, but you may want a more dynamic heading related to the page. In these cases, use a custom `partials/logo.html.twig` something like:

```twig
<!-- Logo -->
	<h1><a href="{{ home_url }}" id="logo">{{ config.site.title|e }}{% if not page.home() %} :: <em>{{ page.title|e }}</em>{% endif %}</a></h1>
```

### Working AJAX contact form in footer

Arcana's contact form in its footer is hardcoded by default so that the theme will work without the Form plugin. Adding this requirement would limit developers' ability to remove or replace the contact form entirely.

However, if the Form plugin is installed and enabled _and_ the **homepage frontmatter has at least one form**, the _first one defined_ will be used as a working AJAX contact form. The only restriction on this form to make it render like the parent theme, is that it includes these top-level elements:

```yaml
forms:
    contact-form: # this can be any name as long as it is the first form defined
        keep_alive: true
        title: Get in touch # you can change this to your liking, too
        layout: footer
        xhr_submit: true
        action: /#contact
        fields:
            …
```

The `layout: footer` form property is the most important here. This ensures that Arcana uses the custom templates it provides.

> Arcana's demo homepage frontmatter includes an example form, which will work as long as the Form plugin is enabled.

Arcana's custom Form plugin templates are in the `templates/forms` folder, so you could easily override or extend these.
