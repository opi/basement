Basement
========

Build your Drupal theme from scratch with the right tools !


Philosophy
----------

Basement is not a base theme.
Basement is a tool to help you build your theme from scratch.

Of course, you can download basement and rename every file and function, but who have time for this? Hopefully, there's a drush command for that!


Using drush
-----------

First, you need to have basement theme enabled on your site:
```
drush dl basement
drush en -y basement
```

Then you can execute the `basement-construct` (or `bc`) command to create your
shinny new theme

```
drush basement-construct "My theme name" --machine-name=mythemename
```

### Required argument ###

Theme name


### Available options ###

--machine-name=mythemename

--destination=sites/all/themes/custom

See `drush basement-contstruct --help` for more informations.

