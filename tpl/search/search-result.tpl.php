<?php
/**
 * @file search-result.tpl.php
 * See http://api.drupal.org/api/drupal/modules!search!search-result.tpl.php/7
 * 
 * Theme suggestions:
 * - search-result.tpl.php
 * - search-result--SEARCH_TYPE.tpl.php
 * 
 * See http://drupal.org/node/1089656#search-result-suggestion
 */
?><li class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <h3 class="title"<?php print $title_attributes; ?>>
    <a href="<?php print $url; ?>"><?php print $title; ?></a>
  </h3>
  <?php print render($title_suffix); ?>
  <div class="search-snippet-info">
    <?php if ($snippet): ?>
      <p class="search-snippet"<?php print $content_attributes; ?>><?php print $snippet; ?></p>
    <?php endif; ?>
    <?php if ($info): ?>
      <p class="search-info"><?php print $info; ?></p>
    <?php endif; ?>
  </div>
</li>
