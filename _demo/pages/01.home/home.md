---
title: Home
banner:
    blurb: 'Arcana: _A responsive site template freebie by [HTML5 UP](http://html5up.net)_'
    # background: blades.jpg
    cta:
        enabled: true
        target: '#'
        text: 'Learn More'

forms:
    contact-form:
        keep_alive: true
        title: Get in touch
        xhr_submit: true
        fields:
            - name: name
              label: Name
              display_label: false
              id: name
              placeholder: Name
              autocomplete: name
              type: text
              outerclasses: col-6 col-12-mobilep
              validate:
                required: true

            - name: email
              label: Email
              display_label: false
              placeholder: Email
              id: email
              autocomplete: email
              type: email
              outerclasses: col-6 col-12-mobilep
              validate:
                required: true

            - name: message
              label: Message
              display_label: false
              placeholder: Message
              id: message
              outerclasses: col-12
              type: textarea
              rows: 4
              validate:
                required: true

        buttons:
            - type: submit
              classes: button alt
              value: Send Message

        process:
            - ip:
                label: User IP Address
            # *** Add email actions here ***
            - save:
                fileprefix: contact-
                dateformat: Ymd-His-u
                extension: txt
                body: "{% include 'forms/data.txt.twig' %}"
            - message: Thanks for getting in touch. You should see a receipt in your inbox. We'll get back to you soon.
            - reset: true # NB: needs to be last or emailing won't have a recipient

---