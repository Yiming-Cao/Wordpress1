=== Night City Dispatch ===
Contributors: yimingcao
Requires at least: 6.2
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: one-column, two-columns, custom-menu, featured-images, threaded-comments, translation-ready

Een simpel klassiek WordPress thema voor een fanmagazine over Night City.

== Description ==

Night City Dispatch is een klassiek thema met een vaste header, een voorpagina met een uitgelicht bericht, een raster met kaarten en een footer met drie kolommen. Alles is wit met een grijze rand en een blauwe accentkleur. Er worden geen webfonts of externe bestanden geladen.

Het thema gebruikt de templatehiërarchie en heeft deze templates:

* `index.php` (verplichte fallback)
* `front-page.php` (voorpagina)
* `home.php` (blogoverzicht)
* `single.php` (enkel bericht)
* `page.php` (pagina)
* `archive.php` (categorie, tag en datum)
* `author.php` (auteurspagina)
* `search.php` (zoekresultaten)
* `404.php` (niet gevonden)

Verder zitten er `header.php`, `footer.php`, `comments.php`, `searchform.php`, `inc/template-tags.php` en de map `template-parts/` in.

Functies:

* twee menu's (hoofdmenu en footer)
* uitgelichte afbeeldingen met twee image sizes
* filteren op categorie, tag en auteur via gewone links naar de archieven
* paginering op de overzichten
* reageren op berichten en pagina's

== Installation ==

1. Upload de map `night-city-dispatch` naar `/wp-content/themes/` of upload de zip via Weergave > Thema's > Nieuwe toevoegen.
2. Activeer het thema onder Weergave > Thema's.
3. Ga naar Weergave > Menu's en maak een menu aan voor de locatie Hoofdmenu.
4. Zet de permalinks op "Berichtnaam" onder Instellingen > Permalinks.

== Frequently Asked Questions ==

= Waarom is er geen category.php of tag.php? =

Die vallen terug op `archive.php`. Dat is de standaard templatehiërarchie van WordPress, dus dubbele bestanden zijn niet nodig.

= Werkt filteren zonder JavaScript? =

Ja. De knoppen in de filterbalk zijn gewone links naar de archiefpagina's.

== Changelog ==

= 1.1.0 =
* Thema vereenvoudigd: eigen kleuren en opmaak eruit, systeemletters, een blauwe accentkleur en witte kaarten.
* Webletters en losse CSS voor de editor verwijderd.
* Filterbalk met categorieen, tags en auteurs toegevoegd.

= 1.0.0 =
* Eerste versie van het thema.

== Credits ==

* Cyberpunk 2077 en Night City zijn handelsmerken van CD Projekt Red. Dit thema is een niet-commercieel schoolproject en is niet verbonden aan CD Projekt Red.
