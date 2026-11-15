# Night City Dispatch

Een simpel klassiek WordPress thema voor een fanmagazine over Night City. Witte kaarten met een grijze rand, één blauwe accentkleur en gewone systeemletters. Geen webfonts, geen effecten, geen page builder.

![Night City Dispatch](screenshot.png)

Gemaakt voor de module **WordPress Custom 1**. Het thema gebruikt de templatehiërarchie van WordPress, haalt alle inhoud dynamisch op met de Loop en heeft een herbruikbare header, footer en een `functions.php`.

## Wat zit erin

| Onderdeel | Bestand |
| --- | --- |
| Voorpagina | `front-page.php` — uitgelicht bericht, nieuwste berichten, categorieen |
| Enkel bericht | `single.php` — afbeelding, meta, inhoud, tags, vorige/volgende, reacties |
| Pagina | `page.php` |
| 404 | `404.php` — zoekformulier en link terug |
| Filteren en archieven | `archive.php`, `author.php`, `search.php` en een filterbalk met categorieen, tags en auteurs |
| Header en footer | `header.php`, `footer.php` |
| `functions.php` | theme supports, menu's, image sizes, CSS en JS laden, archiefquery |

Extra bestanden: `home.php` (blogoverzicht), `searchform.php`, `comments.php` en de map `template-parts/` met de kaart, de filterbalk en de lege staat.

## Templatehiërarchie

| URL | Template |
| --- | --- |
| `/` | `front-page.php` |
| `/blog/` (berichtenpagina) | `home.php` |
| `/de-metro-rijdt-weer/` | `single.php` |
| `/over-ons/` | `page.php` |
| `/category/nieuws/` | `archive.php` |
| `/tag/watson/` | `archive.php` |
| `/author/yiming/` | `author.php` |
| `/?s=metro` | `search.php` |
| pagina die niet bestaat | `404.php` |
| alles wat niet matcht | `index.php` |

`category.php` en `tag.php` heb ik niet gemaakt. Die vallen terug op `archive.php`, dat is hoe de hiërarchie werkt en dat scheelt dubbele code.

## Installeren

1. Pak `night-city-dispatch.zip` uit of upload hem via **Weergave → Thema's → Nieuwe toevoegen**.
2. Activeer het thema.
3. **Weergave → Menu's**: maak een menu en zet het op **Hoofdmenu**. Zonder menu toont het thema automatisch de pagina's.
4. **Instellingen → Permalinks** op "Berichtnaam" zetten, dan werken de archieven en de filterlinks.
5. Optioneel: een footer menu aanmaken voor de derde kolom in de footer.

Er zit geen demo-inhoud in het thema. Op een lege installatie zie je de lege staten en de filterbalk met alleen wat er bestaat.

## Hoe het werkt

- **De Loop** — `front-page.php`, `home.php`, `archive.php`, `author.php`, `search.php` en `index.php` gebruiken allemaal `while ( have_posts() ) : the_post();`. De kaart zelf staat in `template-parts/content-card.php`, zodat de opmaak maar op één plek staat.
- **Eigen query** — op de voorpagina staat een `WP_Query` voor het uitgelichte bericht en de nieuwste berichten. Daarna roep ik `wp_reset_postdata()` aan, anders klopt de rest van de pagina niet meer.
- **Dynamische inhoud** — `the_title()`, `the_content()`, `the_permalink()`, `the_post_thumbnail()`, `get_the_category()`, `get_the_tags()`, `get_the_date()`, `get_the_author()`, `the_archive_description()`.
- **Filteren** — de knoppen in `inc/template-tags.php` zijn gewone links naar de categorie-, tag- en auteursarchieven. Het werkt dus zonder JavaScript, elke filter heeft een eigen URL en de actieve filter krijgt `aria-current="page"`.
- **`functions.php`** — zet `title-tag` en post thumbnails aan, maakt twee menu's en twee image sizes, laadt `assets/css/main.css` en `assets/js/main.js` met `wp_enqueue_style()` en `wp_enqueue_script()`, zet zes berichten per pagina op archieven en regelt de excerpt-lengte.
- **Herbruikbare delen** — `header.php` (doctype, head, site titel, menu, zoeken), `footer.php` (drie kolommen en een regel met copyright) en `template-parts/`.
- **Toegankelijkheid** — skip link, zichtbare focus, `aria-expanded` op de menuknop, alt-tekst bij afbeeldingen, en op mobiel een knop om het menu open te klappen.
- **Simpel gehouden** — één stylesheet voor alle opmaak, één klein script voor het menu op mobiel, geen jQuery en geen externe bestanden.

## Bestandsstructuur

```
night-city-dispatch/
├── style.css               theme header (verplicht voor WordPress)
├── functions.php           theme setup, assets, query, helpers
├── index.php               verplichte fallback
├── front-page.php          voorpagina
├── home.php                blogoverzicht
├── single.php              enkel bericht
├── page.php                pagina
├── archive.php             categorie, tag en datum
├── author.php              auteurspagina
├── search.php              zoekresultaten
├── 404.php                 niet gevonden
├── header.php              head, site titel, menu
├── footer.php              footer
├── comments.php            reacties
├── searchform.php          zoekformulier
├── inc/template-tags.php   meta, archieftitel, paginering, filters
├── template-parts/         content-card, filters, content-none
├── assets/css/main.css     alle opmaak
├── assets/js/main.js       menu op mobiel
├── readme.txt              readme voor WordPress
└── screenshot.png          preview van het thema
```

## Over dit project

Schoolproject voor de module **WordPress Custom 1** (ROC Nijmegen, 2026), gemaakt door Yiming Cao.

Ik heb AI gebruikt om dingen uit te zoeken, bijvoorbeeld hoe de templatehiërarchie werkt en hoe je een eigen query op de voorpagina zet. De code heb ik daarna zelf aangepast, vereenvoudigd en nagelopen, zodat ik alles tijdens het interview kan uitleggen en kan veranderen.

## Credits

- Cyberpunk 2077 en Night City zijn handelsmerken van CD Projekt Red. Dit is een niet-commercieel schoolproject en heeft niets met CD Projekt Red te maken.
- De afbeeldingen in de demo zijn zelf gemaakt voor dit project.

## Licentie

GPL-2.0-or-later, dezelfde licentie als WordPress.
