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

### Working footer contact forms

Arcana's contact form in its footer is hardcoded HTML by default so that the theme will work without the Form plugin. Adding a plugin dependency would limit developers' ability to remove or replace the contact form entirely.

However, if the Form plugin is installed and enabled _and_ you have defined **at least one form on the homepage** (or another page that you specify), the _first one defined_ (or another that you specify) will be used as a working contact form.

To make this form render like the parent theme, add the `layout: footer` form property to your form. This ensures that Arcana uses the custom templates it provides:

```yaml
forms:
    contact-form: # this can be any name if it's the first form defined, otherwise you'll have to pass its name as a parameter (`form_name`) in templates/partials/footer.html.twig
        keep_alive: true
        title: Get in touch # you can change this to your liking, too
        layout: footer
        …
        fields:
            …
```

> Arcana's demo homepage frontmatter includes an example form, which will work as long as the Form plugin is enabled.

Arcana's custom Form plugin templates are in the `templates/forms` folder, so you could easily override or extend these.

#### AJAX contact form in footer example

Aracana's demo content features a working AJAX contact form in the footer, specified in the homepage.

`pages/01.home/home.md` contains two additional lines to the form definition:

```yaml
forms:
    contact-form:
        …
        layout: footer # included again as a reminder to use it!
        xhr_submit: true
        # action: ''
        fields:
            …
```
There's not much more to this. Doublecheck the [official documentation on AJAX forms](https://learn.getgrav.org/forms/forms/how-to-ajax-submission) for essential settings.

#### Submitting the footer contact form server side

If you want to direct users to something more useful than a popup acknowledgement after completing the footer's contact form, you can submit the contact form to another page. The page does not need to be in your navigation or indexed by search crawlers, but it could. You might target your existing contact page, which might contain a copy or a variation of this form.

So to begin, let's create a page that:

* holds the contact form's frontmatter, _and that_
* we can use to show a response when the form doesn't submit successfully.

We will make it "hidden" because the site is still pretty basic and we don't have a generic contact page (yet), it's all about the footer right now.

`pages/contact/form.md`:

```yaml
title: Contact
metadata:
    robots: noindex, nofollow # stay away ye nasties

forms:
    contact:
        keep_alive: true
        layout: footer
        action: '/contact' # MUST specify an absolute path here, as this form will be used in every page path context
        client_side_validation: false # this is useful for testing, then turn it off
        fields:
            …
```

Now you've created a form that _isn't_ defined on the homepage. _(You don't need to do this for server side forms by the way, it doesn't matter.)_ So you need to pass through your alternative contact form path to the contact form template. In a subtheme, this override template works:

`templates/partials/footer.html.twig`:

```twig
{% extends '@arcana/partials/footer.html.twig' %}

{% block contact_form %}
    {{ include('partials/contact-form.html.twig', {'form_page_path': '/contact'} ) }}
{% endblock %}
```

We overrode the `contact_form` block and passed the `form_page_path` parameter as custom submission target. We _didn't need to pass_ the `form_name` parameter because our form is the first and only one defined on the page.

Test and tweak the contact form response page by submitting from the footer.

If you want to provide a better successful response (thank you) page at a different URL, you can make use of the Form plugin's formdata page template.

`pages/contact/thanks/formdata.md`:

```
---
title: Chur bro
metadata:
    robots: noindex, nofollow

---
You did the thing.
```

To make this work on your form, add this as the last process action:

```yaml
            - redirect: '/contact/thanks'
```

Play around with that now. You have:

* a placeholder for successful and unsuccesful form submissions, _and_
* a prototype of a full detail contact page with form.
