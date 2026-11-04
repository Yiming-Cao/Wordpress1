# 答辩速查 / Interview cheat sheet

老师会在课堂演示里让你**讲代码并现场改**。这份文件按“老师会问什么 → 怎么答 → 代码在哪”整理。
（Taal van het gesprek is Nederlands; de kernwoorden staan erbij.)

## 1. 一分钟总览

主题名 **Night City Dispatch**，一个赛博朋克 2077 世界观里的独立小报网站。
所有内容都来自 WordPress 后台（文章、分类、标签、作者、页面、菜单），没有任何写死的内容。
CSS 只负责视觉，PHP 模板只负责“取数据 + 输出”。

一句话版本：
> Een klassiek WordPress-thema dat de templatehiërarchie volgt: front-page, single, page, archieven, zoeken en 404. Alle content komt dynamisch uit WordPress via de Loop.

## 2. 模板层级（最常考）

按 URL 顺序讲：

| URL | 用的文件 | 为什么 |
|---|---|---|
| `/` | `front-page.php` | 静态首页优先于 `home.php` 和 `page.php` |
| `/index/` | `home.php` | 后台“文章页”指定的页面 |
| `/relic-job/` | `single.php` | 单篇文章 |
| `/about/` | `page.php` | 固定页面 |
| `/category/districts/` | `archive.php` | 没有 `category.php` 时回落到 `archive.php` |
| `/tag/watson/` | `archive.php` | 同上 |
| `/author/judy/` | `author.php` | 作者归档有独立模板 |
| `/?s=relic` | `search.php` | 搜索 |
| 不存在的地址 | `404.php` | 找不到 |
| 最后的兜底 | `index.php` | WordPress 强制要求 |

可以补一句：**“WordPress 先按 URL 找最具体的模板，找不到才往下回落，`index.php` 是最后一道。”**

## 3. 每个文件讲什么

- **header.php** — `<!doctype>`、`wp_head()`、站点标题/自定义 logo、`wp_nav_menu()` 主菜单、搜索框、`wp_body_open()`。顶部还有一条 ticker，用 `WP_Query` 取最新 4 篇标题。
- **footer.php** — 分类列表（`wp_list_categories`）、标签云（`wp_tag_cloud`）、页脚菜单、版权行，最后 `wp_footer()`。
- **front-page.php** — 用 `WP_Query` 取最新 4 篇：第 1 篇做 lead，后 3 篇做侧栏；“Latest transmissions” 再取 6 篇（offset 4）；下面用 `get_categories()` 生成栏目卡片。
- **single.php** — `the_post()` 后输出标题、`ncd_post_meta()`、特色图、`the_content()`；侧栏是“File data”（分类、日期、作者、字数、阅读时间、评论数）；底部作者卡、上一篇/下一篇、`ncd_related_posts()` 相关文章、`comments_template()`。
- **page.php** — 固定页面，内容放在纸面（paper）面板里。
- **archive.php** — 分类/标签/日期共用；标题用 `ncd_archive_title()` 去掉 “Category:” 前缀；`the_archive_description()` 输出分类描述；下面是筛选条 + 文章网格 + 分页。
- **author.php** — 作者头像（`get_avatar`）、简介（`$author->description`）、文章数（`count_user_posts`）。
- **search.php** — 搜索结果数 + `get_search_query()` + 搜索框 + 结果网格。
- **404.php** — 大号 404、搜索框、最新 3 篇。
- **index.php** — 兜底循环。
- **functions.php** — 见下一节。
- **inc/template-tags.php** — 所有可复用的“小函数”：阅读时间、文章 meta、筛选 chips、相关文章、分页、归档标题。

## 4. functions.php 里有什么（老师最爱问）

1. `after_setup_theme` → `add_theme_support()`：`title-tag`、`post-thumbnails`、`custom-logo`、`html5`、`automatic-feed-links`；`register_nav_menus()`；`add_image_size()` 三种尺寸。
2. `wp_enqueue_scripts` → 引入字体 CSS、`main.css`（用 `filemtime()` 做版本号，避免缓存）、`main.js`。
3. `pre_get_posts` → 归档和搜索每页 6 篇。
4. `excerpt_length` / `excerpt_more` → 摘要长度和结尾符号。
5. `body_class` → 加 `ncd` / `ncd-single`，方便 CSS 精确命中。
6. `require inc/template-tags.php` → 把模板函数拆出去，functions.php 保持短。

**必答点**：`functions.php` 不是拿来输出 HTML 的，它只负责“注册能力、挂勾子（hooks）、改查询”。

## 5. 现场可能让你改的地方（提前想好）

- **每页显示 3 篇** → 改 `ncd_archive_query()` 里的 `posts_per_page`，或后台 设置→阅读。
- **首页 lead 换成第 2 篇** → `$ncd_lead = $ncd_lead_query->posts[1];` 并把 side 的 `array_slice` 改一下。
- **加一个“Gear”菜单项** → 后台 外观→菜单 直接加，或 `wp_nav_menu` 不用改。
- **把作者名换成链接** → `ncd_post_meta()` 里已经有 `get_author_posts_url()`。
- **single 页加阅读时间** → 已有 `ncd_reading_time()`，在 `single.php` 调即可。
- **改每页文章数只影响归档不影响首页** → 因为首页用的是自定义 `WP_Query`，`pre_get_posts` 只改主查询。
- **为什么用 `WP_Query` 而不是 `query_posts()`** → `query_posts()` 会破坏主查询和分页，`WP_Query` + `wp_reset_postdata()` 才是正确做法。
- **`the_post()` 做了什么** → 把当前文章设为全局 `$post`，让 `the_title()` 这类模板函数不用传 ID。

## 6. 安全与规范（能加分）

- 输出一律转义：`esc_html()`、`esc_url()`、`esc_attr()`。
- 文本用 `__()` / `esc_html_e()`，带 text domain `night-city-dispatch`（可翻译）。
- 自定义查询后 `wp_reset_postdata()`。
- 没有直接写 SQL；没有用 `query_posts()`。
- 缩进用 WordPress 风格（tab），函数前缀 `ncd_` 避免和插件冲突。

## 7. 设计说明（30 秒）

- 配色取自游戏里的市政/警用视觉：**hazard yellow (#F4E600) + ink (#0A0A0B)**，红色只做警示，避免“黑底霓虹渐变”的通用赛博朋克套路。
- 字体：Chakra Petch（标题，工业感）+ IBM Plex Sans（正文）+ IBM Plex Mono（编号/元数据），全部本地打包。
- 记忆点：**切角面板 + 文件编号/监控画面式的图片**；正文放在米白“纸张”上保证长文可读。
- 响应式：3 列 → 2 列 → 1 列；移动端菜单是抽屉；`prefers-reduced-motion` 下关闭动画。

## 8. 交付清单（交之前逐条打勾）

- [ ] GitHub 仓库是 **public**，老师能打开
- [ ] 仓库里有完整主题代码 + README
- [ ] `night-city-dispatch.zip` 能直接在 外观→主题→上传 安装
- [ ] 本地站点能打开：首页 / 单篇 / 页面 / 分类 / 标签 / 作者 / 搜索 / 404
- [ ] 能现场解释 `front-page.php`、`single.php`、`functions.php`、`archive.php`
- [ ] 能现场做一个小改动（比如每页文章数、换 lead 文章）

## 9. 荷兰语关键词

| 中文 | Nederlands |
|---|---|
| 模板层级 | templatehiërarchie |
| 循环 | de Loop |
| 自定义查询 | aangepaste query / `WP_Query` |
| 固定页面 | pagina |
| 文章 | bericht |
| 分类 / 标签 | categorie / tag |
| 作者归档 | auteurarchief |
| 特色图片 | uitgelichte afbeelding |
| 菜单 | menu |
| 小工具 | widget |
| 转义 | escapen / ontsnappen |
| 钩子 | hook |
