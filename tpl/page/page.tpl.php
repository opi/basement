<?php
/**
 * @file page.tpl.php
 * See http://api.drupal.org/api/drupal/modules!system!page.tpl.php/7
 *
 * Theme suggestions:
 * - page.tpl.php
 * - page--front.tpl.php
 * - page--PATH.tpl.php (ex: page--node.tpl, page--node--123.tpl ...
 * - page--node--NODE_TYPE.tpl.php (by basement)
 *
 * See http://drupal.org/node/1089656#page-suggestion
 */
?><div id="page" class="<?php print $classes; ?>" <?php print $attributes;?>>

  <header id="header">

    <?php if ($logo): ?>
    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
      <img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" />
    </a>
    <?php endif; ?>

    <?php if ($site_name): ?>
      <?php $tag = ($is_front) ? 'h1' : 'strong'; ?>
      <<?php print $tag; ?> id="site-name">
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
      </<?php print $tag; ?>>
    <?php endif; ?>

    <?php if ($site_slogan): ?>
    <p id="site-slogan"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <?php if ($main_menu || $secondary_menu): ?>
    <nav id="navigation" role="navigation">
      <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Main menu'))); ?>
      <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Secondary menu'))); ?>
    </nav><!-- #navigation -->
    <?php endif; ?>

  </header><!-- #header -->

  <div id="main">
    <?php if ($breadcrumb): ?>
    <div id="breadcrumb" role="navigation"><?php print $breadcrumb; ?></div>
    <?php endif; ?>

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

    <?php if (!empty($tabs['#primary'])): ?>
    <div id="tabs"><?php print render($tabs); ?></div>
    <?php endif; ?>

    <?php if ($page['help']): ?>
    <div id="help"><?php print render($page['help']); ?></div>
    <?php endif; ?>

    <?php if ($action_links): ?>
    <ul class="action-links"><?php print render($action_links); ?></ul>
    <?php endif; ?>

    <?php if ($page['content']): ?>
    <div id="content">
    <?php print render($page['content']); ?>
    </div>
    <?php endif; ?>

  </div><!-- #main -->

  <?php if ($page['aside']): ?>
  <aside id="aside" role="complementary">
  <?php print render($page['aside']); ?>
  </aside><!-- #aside -->
  <?php endif; ?>

  <?php if ($page['footer']): ?>
  <footer id="footer">
    <?php print render($page['footer']); ?>
  </footer><!-- #footer -->
  <?php endif; ?>

</div> <!-- #page -->
