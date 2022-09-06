English • [Русский](https://github.com/denitcoder/wp-theme-zentile/blob/master/README.ru.md)

# Zentile

![GitHub release (latest by date)](https://img.shields.io/github/v/release/denitcoder/wp-theme-zentile?style=flat-square)
![GitHub All Releases](https://img.shields.io/github/downloads/denitcoder/wp-theme-zentile/total?style=flat-square)
![GitHub](https://img.shields.io/github/license/denitcoder/wp-theme-zentile?style=flat-square)

Zentile is a lightweight magazine theme inspired by Yandex.Zen.

**[Download v1.7.1](https://github.com/denitcoder/wp-theme-zentile/releases/download/v1.7.1/zentile-1.7.1.zip)** • **[Changelog](https://github.com/denitcoder/wp-theme-zentile/releases)**

![Screenshot](screenshot.png)

## Features

- Browsers: Edge, Chrome, Firefox, Safari, Opera
- Languages:
    - English
    - [Portuguese (Brazil)](https://translate.wordpress.org/locale/pt-br/default/wp-themes/zentile/) by [Jeferson Nunes](https://www.linkedin.com/in/jeferson-nunes/) / [@JEFERSONANUNES](https://github.com/JEFERSONANUNES)
    - Russian
    - [Spanish](https://translate.wordpress.org/locale/es/default/wp-themes/zentile/) by [@ruudhesp](https://twitter.com/ruudhesp)
- Responsive design
- Gutenberg-ready
- Translation-ready
- Built-in image light box
- Related posts
- Post views (*Post Views Counter* plugin required)
- 1, 2 and 3 column layouts
- 3 widget areas (left sidebar, right sidebar and footer)
- Theme settings
    - Customizable logo
    - Customizable background
    - Show/hide featured image at the top of the post
    - Show/hide author bio at the end of the post
    - Show/hide post navigation
    - Show/hide views in the post list
    - Show/hide related posts BEFORE comments
    - Show/hide related posts AFTER comments
    - Always show sidebar
- Custom widgets
    - Zentile: Categories
    - Zentile: Recent comments
    - Zentile: Recent posts

## Requirements

- PHP >= 5.6
- Wordpress >= 5.3.x

## Installation

- Go to **Appearance > Themes > Add New** and type **zentile** in the search box.
- Click **Install** and then **Activate**.

## Manual installation

- Download the theme from the **[releases](https://github.com/denitcoder/wp-theme-zentile/releases)** page on GitHub (**zentile-x.y.zip**).
- Go to **Appearance > Themes > Add New > Upload Theme** and upload the downloaded archive with the theme (**WP version < 5.5**: In order to update the theme in the future you need to install [Easy Theme and Plugin Upgrades](https://wordpress.org/plugins/easy-theme-and-plugin-upgrades/) plugin).
- **OR** Unzip the archive to the `/wp-content/themes/` directory.
- Go to **Appearance > Themes** and activate it.

## Post installation

- Go to **Settings > Reading** and set **Blog pages show at most** to 5n (e.g. 5, 10, ...).
- Go to **Appearance > Widgets** and add widgets **Zentile: Categories**, **Zentile: Recent Comments** and **Zentile: Recent Posts**.
- Go to **Appearance > Customize** and customize theme as you need.

## Recommended plugins

### **[Color Palette Generator](https://wordpress.org/plugins/color-palette-generator/)**

If you want the post card's gradients to match its featured image dominant color, follow the steps below:

- Install and activate plugin [Color Palette Generator](https://wordpress.org/plugins/color-palette-generator/).
- Go to **Media > Color Palette Generator** and set:
    - **Number of colors to generate**: 1
    - **Automatically generate palettes on upload?**: checked
- Click **Save Changes**.
- Click **Generate**.

**Notice:** The plugin automatically generate palettes for the images only if you upload them via the **Media > Add New** page, otherwise you need to generate it manually.

### **[Post Views Counter](https://wordpress.org/plugins/post-views-counter/)**

This plugin allows you to display how many times a post, page or custom post type had been viewed.

- Install and activate plugin [Post Views Counter](https://wordpress.org/plugins/post-views-counter/).
- Go to **Settings > Post Views Counter > Display** and uncheck all post and page types.
- Click **Save Changes**.

## Development

**Requirements:** Node.js >= 12.x, Git, Docker and Docker Compose (optional)

Installation:

```bash
# If you are not using docker then clone the repository to <wordpress>/wp-content/themes/ directory
git clone https://github.com/denitcoder/wp-theme-zentile.git zentile
cd zentile

# Install dependencies
npm install

# Compile and minify all theme assets
npm run build

# (optional) Run docker-compose, the wordpress instance will be available at http://localhost:8000
npm start
```
Other available commands:

```bash
# Stop docker-compose
npm stop

# Watch for changes
npm run watch

# Compile all assets and create the archive with the theme (e.g. <zentile>/releases/zentile-x.y.zip)
npm run release
```

## Structure

```
Zentile
├── assets - Uncompiled assets (js, css)
├── dist - Compiled and minified assets
├── releases - Zipped builds ready to publish
├── components - HTML components (buttons, alerts etc)
├── inc - Classes and utils
├── widgets - Custom widget classes
└── languages - Translations
```
