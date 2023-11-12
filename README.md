<h4 align="center">Made by <a href="https://laravel.com/" target="_blank">Laravel Framework 8.76.2</a></h4> 

### Application configurations
- Timezone => Asia/Dushanbe
- Default Locale => ru
- Main Font => Roboto

### Installed Fonts, CSS & Javascript libraries
- [Roboto Google Fonts](https://fonts.google.com/specimen/Roboto)
- [Material Icons](https://fonts.google.com/icons)
- [JQuery 3.6.0](https://jquery.com/)
- [Owl Carousel](https://owlcarousel2.github.io/OwlCarousel2/)
- [Google Maps](https://developers.google.com/maps/documentation/javascript/overview)
- [Selectric](https://www.jqueryscript.net/form/Minimal-jQuery-Html-Select-Replacement-Plugin-Selectric.html)
- [Selectize](https://selectize.dev/)
- [Json Viewer](https://www.jqueryscript.net/other/Beautiful-JSON-Viewer-Editor.html)

### Installed PHP libraries
- [Laravel Breeze](https://laravel.com/docs/8.x/starter-kits)
- [Intervention Image](https://image.intervention.io/v2)

### Localization
1. Created Middleware "Language", that will change applications locale into sessions stored locale on app boot
2. "Language" Middleware added into App/Http/KerneL

### For adding new locale
1. You have to include it into Helper class language constants.
2. Create new fields in database tables
3. Add new tab item and new fields in dashboard forms
4. Add it into locales table and upload its image