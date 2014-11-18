<?php
/**
 * @file maintenance-page--offline.tpl.php
 * See http://api.drupal.org/api/drupal/modules!system!maintenance-page.tpl.php/7
 *
 * See http://drupal.org/node/1089656#maintenance-suggestion
 *
 */

  // Default variable
  $head_title = 'mysite.com :: Site-offline';
  $logo = 'sites/all/files/customLogo.png';
  $site_name = 'Your Site Name';
  $site_slogan = 'My Site Slogan';
  $content = '<p>The site is currently not available due to technical problems. Please try again later. Thank you for your understanding.</p><hr /><p>If you are the maintainer of this site, please check your database settings.</p>';

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

        <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php endif; ?>

        <div id="content">
        <?php print $content; ?>
        </div>

      </div><!-- #main -->

    </div> <!-- #page -->
  </body>
</html>
