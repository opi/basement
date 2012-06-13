<?php 
/**
 * @file html.tpl.php
 * See http://api.drupal.org/api/drupal/modules%21system%21html.tpl.php/7
 * 
 * Theme suggestions: None by default.
 */
?><!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js lt-ie9 lt-ie8" lang="<?php print $language->language; ?>"  dir="<?php print $language->dir; ?>"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="<?php print $language->language; ?>"  dir="<?php print $language->dir; ?>"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="<?php print $language->language; ?>"  dir="<?php print $language->dir; ?>"><!--<![endif]-->
  <head>
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>

    <!-- CSS Styles -->
    <?php print $styles; ?>

    <!-- IE Stuff. Important ones, must be printed as soon as possible -->
    <?php print render($respond); ?>
    
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php print $icon_path; ?>/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php print $icon_path; ?>/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="<?php print $icon_path; ?>/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php print $icon_path; ?>/apple-touch-icon-114x114.png" />
  </head>
  <body class="<?php print $classes; ?>"<?php print $attributes;?>>
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
    <?php print $scripts; ?>
    
    <!-- IE Stuff. Less important -->
    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
         chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 8 ]>
      <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
      <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->
    <?php print render($placeholder); ?>
  </body>
</html>
