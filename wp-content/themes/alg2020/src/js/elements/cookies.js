// https://github.com/orestbida/cookieconsent
import "vanilla-cookieconsent";
import "vanilla-cookieconsent/dist/cookieconsent.css";
import "./cookie-custom.css";

const cookieconsent = initCookieConsent();

cookieconsent.run({
  current_lang: "de_inf_norej",
  autoclear_cookies: true, // default: false
  page_scripts: true, // default: false

  mode: "opt-in",
  delay: 0,
  // auto_language: null                     // default: null; could also be 'browser' or 'document'
  // autorun: true,                          // default: true
  // force_consent: false,                   // default: false
  // hide_from_bots: false,                  // default: false
  // remove_cookie_tables: false             // default: false
  // cookie_name: 'cc_cookie',               // default: 'cc_cookie'
  // cookie_expiration: 182,                 // default: 182 (days)
  // cookie_necessary_only_expiration: 182   // default: disabled
  // cookie_domain: location.hostname,       // default: current domain
  // cookie_path: '/',                       // default: root
  // cookie_same_site: 'Lax',                // default: 'Lax'
  // use_rfc_cookie: false,                  // default: false
  revision: 1, // default: 0

  onFirstAction: function (user_preferences, cookie) {
    // callback triggered only once
  },

  onAccept: function (cookie) {
    // ...
  },

  onChange: function (cookie, changed_preferences) {
    // ...
  },
  gui_options: {
    consent_modal: {
      layout: "cloud", // box/cloud/bar
      position: "bottom right", // bottom/middle/top + left/right/center
      transition: "slide", // zoom/slide
      swap_buttons: true, // enable to invert buttons
    },
    settings_modal: {
      layout: "bar", // box/bar
      // position: 'left',           // left/right
      transition: "zoom", // zoom/slide
    },
  },

  languages: {
    de_inf_norej: {
      consent_modal: {
        title: "Wir verwenden Cookies!",
        description:
          "Diese Webseite verwendet essentielle Cookies, welche das optimale Funktionieren der Seite garantieren dein Verhalten auf unserer Webseite aufzeichnen. Letztere werden erst mit deiner Zustimmung gesetzt.",
        primary_btn: {
          text: "Alle akzeptieren",
          role: "accept_all",
        },
        secondary_btn: {
          text: "Einstellungen",
          role: "settings",
        },
      },
      settings_modal: {
        title: "Cookie Einstellungen",
        save_settings_btn: "Speichern",
        accept_all_btn: "Alle akzeptieren",
        reject_all_btn: "Alle ablehnen",
        close_btn_label: "Schließen",
        cookie_table_headers: [
          { col1: "Zeichen" },
          { col2: "Domain" },
          { col3: "Beschreibung" },
        ],
        blocks: [
          {
            title: "Verwendung von Cookies 📢",
            description:
              'Wir verwnden Cookies um deinen Aufenthalt auf der Webseite zu verbessern und dein Verhalten auf unserer Webseite aufzuzeichnen. Du kannst deine Einstellungen jederzeit anpassen. Mehr Informationen zu sensiblen Daten findest du <a href="" class="cc-link">in unseren Datenschutzbestimmungen.</a>',
          },
          {
            title: "Erforderliche Cookies",
            description:
              "Diese Cookies sind erforderlich, damit diese Webseite richtig funktioniert. Ohne sie würde die Seite nicht funktionieren.",
            toggle: {
              value: "necessary",
              enabled: true,
              readonly: true,
            },
          },
          {
            title: "Tracking und Analyse Cookies",
            description:
              "Diese Cookies erlauben es uns, dein Verhalten auf unserer Webseite zu analysieren und zu verfolgen.",
            toggle: {
              value: "analytics", // your cookie category
              enabled: false,
              readonly: false,
            },
            cookie_table: [
              {
                col1: "_pk_ses",
                col2: window.location.hostname,
                col3: "Session-ID für Matomo Analytics",
              },
              {
                col1: "_pk_id",
                col2: window.location.hostname,
                col3: "User-ID für Matomo Analytics",
              },
              {
                col1: "mtm_consent",
                col2: window.location.hostname,
                col3: "Zustimmungserklärung zum Tracking durch Matomo Analytics",
              },
            ],
          },
          {
            title: "Mehr Informationen",
            description:
              'Für irgendwelche weiteren Fragen betreffend unserer Cookie Verwendungen, <a href="" class="cc-link">kontaktiere uns bitte.</a>',
          },
        ],
      },
    },
    de_inf: {
      consent_modal: {
        title: "Wir verwenden Cookies!",
        description:
          "Diese Webseite verwendet essentielle Cookies, welche das optimale Funktionieren der Seite garantieren dein Verhalten auf unserer Webseite aufzeichnen. Letztere werden erst mit deiner Zustimmung gesetzt. <button class='cc-link' data-cc='c-settings'>Einstellungen</button>",
        primary_btn: {
          text: "Alle akzeptieren",
          role: "accept_all",
        },
        secondary_btn: {
          text: "Alle ablehnen",
          role: "accept_necessary",
        },
      },
      settings_modal: {
        title: "Cookie Einstellungen",
        save_settings_btn: "Einstellungen speichern",
        accept_all_btn: "Alle akzeptieren",
        reject_all_btn: "Alle ablehnen",
        close_btn_label: "Schließen",
        cookie_table_headers: [
          { col1: "Name" },
          { col2: "Domain" },
          { col3: "Gültigkeit" },
          { col4: "Beschreibung" },
        ],
        blocks: [
          {
            title: "Verwendung von Cookies 📢",
            description:
              'Wir verwnden Cookies um deinen Aufenthalt auf der Webseite zu verbessern und dein Verhalten auf unserer Webseite aufzuzeichnen. Du kannst deine Einstellungen jederzeit anpassen. Mehr Informationen zu sensiblen Daten findest du <a href="" class="cc-link">in unseren Datenschutzbestimmungen.</a>',
          },
          {
            title: "Erforderliche Cookies",
            description:
              "Diese Cookies sind erforderlich, damit diese Webseite richtig funktioniert. Ohne sie würde die Seite nicht funktionieren.",
            toggle: {
              value: "necessary",
              enabled: true,
              readonly: true,
            },
          },
          {
            title: "Tracking und Analyse Cookies",
            description:
              "Diese Cookies erlauben es uns, dein Verhalten auf unserer Webseite zu analysieren und zu verfolgen.",
            toggle: {
              value: "analytics", // your cookie category
              enabled: false,
              readonly: false,
            },
            cookie_table: [
              {
                col1: "_pk_ses",
                col2: window.location.hostname,
                col3: "30 Minuten",
                col4: "Session-ID für Matomo Analytics",
              },
              {
                col1: "_pk_id",
                col2: window.location.hostname,
                col3: "1 Jahr",
                col4: "User-ID für Matomo Analytics",
              },
              {
                col1: "mtm_consent",
                col2: window.location.hostname,
                col3: "30 Jahr",
                col4: "Zustimmungserklärung zum Tracking durch Matomo Analytics",
              },
            ],
          },
          {
            title: "Mehr Informationen",
            description:
              'Für irgendwelche weiteren Fragen betreffend unserer Cookie Verwendungen, <a href="" class="cc-link">kontaktiere uns bitte.</a>',
          },
        ],
      },
    },
  },
});
