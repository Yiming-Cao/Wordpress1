=== Night City Dispatch ===
Contributors: Yiming Cao
Requires at least: 6.5
Tested up to: 6.8
Requires PHP: 7.4
Version: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A dark editorial theme for an in-world Night City fan magazine.

== Description ==

Night City Dispatch is a classic WordPress theme built around the template
hierarchy. It ships with a front page, single post, static page, category, tag,
author, search and 404 templates, a reusable header and footer, and a
functions.php that registers menus, image sizes, widget-ready excerpts and the
archive filter bar.

The visual language uses hazard yellow on ink, condensed display type, mono data
labels and clipped panel corners. Content is read on an off-white "paper"
surface so long articles stay comfortable.

== Installation ==

1. In the dashboard go to Appearance > Themes > Add New > Upload Theme.
2. Upload night-city-dispatch.zip and activate.
3. Create a menu under Appearance > Menus and assign it to "Primary menu".
4. Optional: upload a logo under Appearance > Customize > Site Identity.

== Template files ==

style.css          Theme header and metadata.
functions.php      Theme supports, menus, assets, queries, helpers include.
index.php          Required fallback template.
front-page.php     Front page: lead story, latest files, districts, desk note.
home.php           Blog index when a static front page is used.
single.php         Single post with file data, author box, related files.
page.php           Static page.
archive.php        Category, tag and date archives with the filter bar.
author.php         Writer archive with profile block.
search.php         Search results.
404.php            Not found page with search and recent files.
header.php         Document head, masthead, navigation, ticker.
footer.php         Footer columns and legal line.
comments.php       Comment list and form.
searchform.php     Reusable search form.
inc/template-tags.php  Reading time, meta, filters, related posts, pagination.
template-parts/    Card, empty state and filter bar partials.
assets/            CSS, JS and bundled webfonts.

== Credits ==

Fonts: Chakra Petch and IBM Plex (SIL Open Font License), bundled locally.
Imagery: generated for this project.
Night City and Cyberpunk 2077 are trademarks of CD Projekt Red. This is a
non-commercial student fan project.
