<?php
/**
 * @file maintenance-page.tpl.php
 * See http://api.drupal.org/api/drupal/modules!system!maintenance-page.tpl.php/7
 *
 * Theme suggestions:
 * - maintenance-page.tpl.php
 * - maintenance-page--offline.tpl.php Used when no access to database.
 *
 * See http://drupal.org/node/1089656#maintenance-suggestion
 */
?><!DOCTYPE html>
<html class="no-js" lang="<?php print $language->language; ?>"  dir="<?php print $language->dir; ?>">
  <head>
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>

    <!-- CSS Styles -->
    <?php print $styles; ?>

    <!-- IE Stuff. Important ones, must be printed as soon as possible -->
    <?php print render($respond); ?>
  </head>

  <body class="<?php print $classes; ?>"<?php print $attributes;?>>
    <div id="page">

      <header id="header">

        <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" />
        </a>
        <?php endif; ?>

        <?php if ($site_name): ?>
        <h1 id="site-name"><?php print $site_name; ?></h1>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
        <p id="site-slogan"><?php print $site_slogan; ?></p>
        <?php endif; ?>

      </header><!-- #header -->

      <div id="main">

        <?php if ($messages): ?>
        <div id="messages"><?php print $messages; ?></div>
        <?php endif; ?>

        <?php if ($display_title): ?>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php endif; ?>

        <?php if ($help): ?>
        <div id="help"><?php print render($page['help']); ?></div>
        <?php endif; ?>

        <?php if ($page['content']): ?>
        <div id="content">
        <?php print render($page['content']); ?>
        </div>
        <?php endif; ?>

      </div><!-- #main -->

    </div> <!-- #page -->
  </body>
</html>
