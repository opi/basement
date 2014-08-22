<?php
/**
 * @file
 * This drush script creates a sub-theme for Basement.
 * Heavily inspired from the great Sasson theme.
 * Usage: drush basement-construct --name=Theme Name --machine_name=themename
 *
 */

/**
 * Implementation of hook_drush_command().
 */
function basement_drush_command() {
  $items = array();

  $items['basement-construct'] = array(
    'description' => 'Build up a new basement theme',
    'aliases' => array('bc'),
    'arguments' => array(
      'name' => 'A name for your theme.',
    ),
    'options' => array(
      'machine-name' => '(optional)[a-z, 0-9] A machine-readable name for your theme.',
      'destination' => 'Path to which the project will be copied, relative to the drupal root',
    ),
    'examples' => array(
      'example[1]' => 'drush basement-construct "My theme name" --machine-name=mythemename',
      'example[2]' => 'drush basement-construct "My theme name" --destination=sites/all/themes/custom',
    ),
  );

  return $items;
}

/**
 * Implements hook_drush_help().
 */
function basement_drush_help($section) {
  switch ($section) {
    case 'drush:basement-construct':
      return dt('Build up a new basement theme');
  }
}


/**
 * Command: Set up a Basement theme.
 */
function drush_basement_construct($name = NULL) {
  if (empty($name)) {
    drush_print(dt("\nWe can't create a basement with no name. \nPlease provide a name for the basement.\nEx. drush basement-construct \"Theme Name\"\n"));
    return;
  }

  $machine_name = drush_get_option('machine-name');
  $machine_name = !empty($machine_name) ? preg_replace('/[^a-z0-9_]+/', '', strtolower($machine_name)) : preg_replace('/[^a-z0-9_]+/', '', strtolower($name));
  $basement_path = drush_locate_root() . '/' . drupal_get_path('theme', 'basement');

  $destination = drush_get_option('destination');
  if (!empty($destination)) {
    $newtheme_path = drush_locate_root() . '/' . $destination . '/' . $machine_name;
  }
  else {
    // From Basement's location, we move up one directory and construct the path where
    // our sub theme will be created.
    $themes_path = explode('/', $basement_path);
    array_pop($themes_path);
    $newtheme_path = implode('/', $themes_path) . '/' . $machine_name;
  }

  // Make a fresh copy of the original starter kit.
  $s = drush_copy_dir("$basement_path/", $newtheme_path);
  if (empty($s)) {
    return;
  }

  // Remove drush file from the new theme
  drush_op('unlink', "$newtheme_path/basement.drush.inc");

  // Rename the info file and fill in the theme name.
  drush_op('rename', "$newtheme_path/basement.info", "$newtheme_path/$machine_name.info");
  drush_op('basement_file_str_replace', "$newtheme_path/$machine_name.info", 'Basement', "$name");
  drush_op('basement_file_str_replace', "$newtheme_path/$machine_name.info", 'basement', "$machine_name");
  drush_op('basement_file_str_replace', "$newtheme_path/$machine_name.info", 'the right tools', "Basement theme");

  // Template.php
  drush_op('basement_file_str_replace', "$newtheme_path/template.php", 'basement', "$machine_name");

  // JS file
  drush_op('rename', "$newtheme_path/js/basement.js", "$newtheme_path/js/$machine_name.js");
  drush_op('basement_file_str_replace', "$newtheme_path/js/$machine_name.js", 'basement', "$machine_name");


  // Notify user of the newly created theme.
  drush_print(dt("\n!name theme was created in !path. \n",
    array(
      '!name' => $name,
      '!path' => $newtheme_path,
    )
  ));

  drush_pm_enable($machine_name);
  drush_op('system_rebuild_theme_data');
  drush_op('drupal_theme_rebuild');

  if (drush_confirm(dt("\nWould you like to set !name as your default theme?", array('!name' => $name)))) {
    drush_op('theme_enable', array($machine_name));
    drush_op('variable_set', 'theme_default', $machine_name);
    drush_print(dt("!name was set as your default theme. \n", array('!name' => $name)));
  }

}


/**
 * Internal helper: Replace strings in a file.
 */
function basement_file_str_replace($file_path, $find, $replace) {
  $file_contents = file_get_contents($file_path);
  $file_contents = str_replace($find, $replace, $file_contents);
  file_put_contents($file_path, $file_contents);
}
