# Pitch in het Nederlands / 荷兰语口试讲稿

## 1-minuut pitch (voor het interview)

> Dit is Night City Dispatch, een WordPress-thema dat ik zelf heb ontworpen en gebouwd. Het is een online magazine in de wereld van Cyberpunk 2077.
>
> Het thema werkt volgens de templatehiërarchie. De homepage is `front-page.php`: een uitgelicht bericht, de laatste zes berichten en een overzicht van de vier rubrieken. Een bericht gebruikt `single.php`, een pagina `page.php`. Voor categorieën en tags heb ik `archive.php`, voor auteurs `author.php`. En `search.php`, `404.php` en `index.php` als fallback.
>
> Alle content komt dynamisch uit WordPress via de Loop. Voor de uitgelichte en de gerelateerde berichten gebruik ik `WP_Query`, en daarna `wp_reset_postdata()`.
>
> De header en footer zijn herbruikbaar met `get_header()` en `get_footer()`. In `functions.php` staan de menu's, de afbeeldingsformaten en de stylesheets. De filterbalk en de leestijd staan in `inc/template-tags.php`.
>
> De filterbalk linkt naar echte archieven, dus filteren werkt ook zonder JavaScript.
>
> Qua ontwerp: signaalgeel op zwart, Chakra Petch voor de koppen, en de tekst op een papierkleurige achtergrond zodat lange artikelen prettig lezen. Alles is responsive.

## 30-seconden versie (als je maar kort de tijd hebt)

> Night City Dispatch is een zelfgebouwd WordPress-thema voor een fanmagazine over Cyberpunk 2077. Het volgt de templatehiërarchie: `front-page.php`, `single.php`, `page.php`, `archive.php`, `author.php`, `search.php` en `404.php`. Alle content komt via de Loop uit WordPress, en voor extra lijsten gebruik ik `WP_Query`. `header.php` en `footer.php` zijn herbruikbaar, en in `functions.php` staan de menu's, de beeldformaten en de assets. De filterbalk werkt met echte archieflinks, dus zonder JavaScript.

## Demovolgorde (wat je klikt)

1. Homepage — wijs de lead, de laatste zes en de rubrieken aan.
2. Klik de lead → single page: metadata, uitgelichte afbeelding, auteur, gerelateerde berichten.
3. Menu → Districts (categorie) — laat de filterbalk zien en klik een tag.
4. Klik een auteur → auteurarchief met profiel.
5. Zoekveld → zoek “relic”.
6. Typ een niet-bestaande URL → 404.
7. Laat eventueel de code zien: `front-page.php` → `single.php` → `inc/template-tags.php` → `functions.php`.

## Waarschijnlijke vragen (korte antwoorden)

**Wat is de templatehiërarchie?**
WordPress kiest per URL het meest specifieke template. Eerst `front-page.php`, anders `home.php`, `page.php`, `single.php`, `category.php`/`archive.php`, en als laatste `index.php`.

**Wat doet de Loop?**
`while ( have_posts() ) : the_post();` zet elk bericht als het huidige bericht, zodat `the_title()`, `the_content()` en `the_permalink()` werken zonder dat je een ID hoeft mee te geven.

**Waarom `WP_Query` en niet `query_posts()`?**
`query_posts()` overschrijft de hoofdquery en breekt de paginering. `WP_Query` is een aparte query; daarna roep je `wp_reset_postdata()` aan.

**Wat staat er in `functions.php`?**
`add_theme_support()` (title-tag, thumbnails, custom logo, html5), `register_nav_menus()`, `add_image_size()`, `wp_enqueue_style/script()`, `pre_get_posts` voor zes berichten per archief, en de includes naar `inc/template-tags.php`.

**Hoe werkt filteren?**
De chips linken naar `get_category_link()`, `get_tag_link()` en `get_author_posts_url()`. Het zijn dus echte archief-URL's; geen JavaScript nodig. De actieve chip krijgt `aria-current="page"`.

**Hoe is de header/footer herbruikbaar?**
`get_header()` en `get_footer()` laden `header.php` en `footer.php`. De header bevat `wp_head()`, de navigatie en de ticker; de footer bevat de kolommen en `wp_footer()`.

**Waarom deze vormgeving?**
De kleuren en typografie komen uit de signage van Night City: signaalgeel op zwart, Chakra Petch, en mono-labels voor metadata. De artikelen staan op een papierkleurige achtergrond voor contrast en leesbaarheid.

## Als de docent je iets laat aanpassen

| Opdracht | Wat je doet |
|---|---|
| Meer berichten per archief | In `functions.php` bij `ncd_archive_query()` het getal `6` wijzigen. |
| Andere lead op de homepage | In `front-page.php` `$ncd_lead_query->posts[0]` naar `[1]` zetten en de `array_slice` aanpassen. |
| Menu-item toevoegen | Dashboard → Weergave → Menu's. Geen code nodig. |
| Leestijd verbergen | In `single.php` de regel met `ncd_reading_time()` weghalen. |
| Andere kleur | In `assets/css/main.css` de variabele `--hazard` aanpassen. |

## Uitspraak-hulp

- templatehiërarchie → *tem-plaat-hi-e-rar-chie*
- uitgelicht → *uit-ge-ligt*
- rubrieken → *ru-brie-ken*
- archieven → *ar-chie-ven* (g van *ch*)
- weergave → *weer-ga-ve*
