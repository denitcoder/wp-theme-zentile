[English](https://github.com/denitcoder/wp-theme-zentile#zentile) • Русский

# Zentile

![GitHub release (latest by date)](https://img.shields.io/github/v/release/denitcoder/wp-theme-zentile?style=flat-square)
![GitHub All Releases](https://img.shields.io/github/downloads/denitcoder/wp-theme-zentile/total?style=flat-square)
![GitHub](https://img.shields.io/github/license/denitcoder/wp-theme-zentile?style=flat-square)

Zentile - легковесная тема вдохновленная сервисом Yandex.Zen.

**[Скачать v1.7.1](https://github.com/denitcoder/wp-theme-zentile/releases/download/v1.7.1/zentile-1.7.1.zip)** • **[Changelog](https://github.com/denitcoder/wp-theme-zentile/releases)**

![Screenshot](screenshot.png)

## Функции

- **Браузеры:** Edge, Chrome, Firefox, Safari, Opera
- **Языки:**:
    - English
    - [Portuguese (Brazil)](https://translate.wordpress.org/locale/pt-br/default/wp-themes/zentile/) by [Jeferson Nunes](https://www.linkedin.com/in/jeferson-nunes/) / [@JEFERSONANUNES](https://github.com/JEFERSONANUNES)
    - Russian
    - [Spanish](https://translate.wordpress.org/locale/es/default/wp-themes/zentile/) by [@ruudhesp](https://twitter.com/ruudhesp)
- Тема адаптирована под мобильные устройства
- Поддержка редактора Gutenberg
- Тема готова для перевода на другой язык
- Встроенный просмотрщик изображений
- Встроенный виджет с похожими постами
- Вывод кол-ва просмотров (необходим плагин *Post Views Counter*)
- Расположение блоков: 1, 2 и 3 колонки
- 3 зоны для виджетов (левый сайдбар, правый сайдбар и подвал)
- Настройки темы
    - Изменяемый логотип
    - Изменяемый фон
    - Показать/скрыть изображение-обложку в начале поста
    - Показать/скрыть информацию об авторе в конце поста
    - Показать/скрыть навигацию по постам
    - Показать/скрыть просмотры в списке постов
    - Показать/скрыть похожие посты ПЕРЕД комментариями
    - Показать/скрыть похожие посты ПОСЛЕ комментариев
    - Всегда показывать сайдбар
- Уникальные виджеты
    - Zentile: Рубрики
    - Zentile: Последние комментарии
    - Zentile: Последние посты

## Требования

- PHP >= 5.6
- Wordpress >= 5.3.x

## Установка

- Перейдите в раздел **Внешний вид > Темы > Добавить** и введите **zentile** в поле поиска.
- Нажмите **Установить** и затем **Активировать**.

## Ручная установка

- Скачайте архив с темой с гитхаба из раздела **[releases](https://github.com/denitcoder/wp-theme-zentile/releases)**  (**zentile-x.y.zip**).
- Перейдите в раздел **Внешний вид > Темы > Добавить > Загрузить тему** и загрузите скачанный архив с темой (**WP version < 5.5**: Для обновления темы нужно будет установить плагин [Easy Theme and Plugin Upgrades](https://wordpress.org/plugins/easy-theme-and-plugin-upgrades/)).
- **ИЛИ** разархивируйте архив в директорию `/wp-content/themes/`.
- Перейдите в раздел **Внешний вид > Темы** и активируйте тему.

## После установки

- Перейдите в раздел **Настройки > Чтение** и установите **На страницах блога отображать не более** равным 5n (например: 5, 10, ...).
- Перейдите в раздел **Внешний вид > Виджеты** и добавьте виджеты **Zentile: Рубрики**, **Zentile: Последние комментарии** и **Zentile: Последние посты**.
- Перейдите в раздел **Внешний вид > Настроить** и настройте тему на свое усмотрение.

## Рекомендуемые плагины

### **[Color Palette Generator](https://wordpress.org/plugins/color-palette-generator/)**

Если вы хотите чтобы цвет градиента в плитках совпадал с картинкой-превью:

- Установите и активируйте плагин [Color Palette Generator](https://wordpress.org/plugins/color-palette-generator/).
- Перейдите в раздел **Медиафайлы > Color Palette Generator** и измените настройки:
    - **Number of colors to generate**: 1
    - **Automatically generate palettes on upload?**: включено
- Нажмите **Сохранить изменения**.
- Нажмите **Generate palettes**.

**Внимание:** Плагин генерирует палитры для изображения автоматом только если вы загружаете их на странице **Медиафайлы > Добавить новый**, в противном случае их придется генерировать вручную.

### **[Post Views Counter](https://wordpress.org/plugins/post-views-counter/)**

Этот плагин позволяет выводить кол-во просмотров у постов.

- Установите и активируйте плагин [Post Views Counter](https://wordpress.org/plugins/post-views-counter/).
- Перейдите в раздел **Настройки > Post Views Counter > Display** и уберите все галочки.
- Нажмите **Save Changes**.

## Разработка

**Требования:** Node.js >= 12.x, Git, Docker and Docker Compose (опционально)

Первоначальная установка:

```bash
# Если вы не используете docker, то склонируйте репозиторий в директорию <wordpress>/wp-content/themes/
git clone https://github.com/denitcoder/wp-theme-zentile.git zentile
cd zentile

# Установка зависимостей
npm install

# Скомпилировать и минифицировать все ассеты
npm run build

# (опционально) Запустить docker-compose, вордпресс станет доступен по адресу http://localhost:8000
npm start
```
Другие доступные команды:

```bash
# Остановить docker-compose
npm stop

# Наблюдать за измененями ассетов
npm run watch

# Скомпилировать все ассеты и создать архив с темой (<zentile>/releases/zentile-x.y.zip)
npm run release
```

## Структура темы

```
Zentile
├── assets - Исходники ассетов (js, css)
├── dist - Скомпилированные и минифицированные ассеты
├── releases - Архивы с темой готовые для публикации
├── components - HTML компоненты (buttons, alerts и т.д.)
├── inc - Классы и утилиты
├── widgets - Классы с виджетами
└── languages - Переводы
```