# KDK Minimal (v1.0.0 / Jan 2020)

A minimal starter theme for WordPress, inspired by Joomla's templating model.

Instead of choking your theme folder with dozens of PHP and CSS files, everything is routed from the main theme file (index.php) and organized in logical subfolders, as well as override sub-template groups, per entity type (e.g. post, category and so on).

The result is less file clutter, easier debugging and more flexible theme styling and section skinning (without requiring child themes etc.).

This is clearly work in progress.


## To Do
- Define widget areas in a widgets.ini file
- Secure includes
- Add missing sub-templates (e.g. for attachment)
- Enrich each sub-template with all available default fields
- Allow switching to a different set of overrides (besides "default") - adjust "require" paths to be dynamic
- Add options page for basic stuff like Google Analytics, custom code injected in the `<head>` or `<body>` elements
- Integrate with Customizer


## License & Credits

Licensed under the GNU/GPL license (https://www.gnu.org/copyleft/gpl.html).

Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
