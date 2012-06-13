<?php
/**
 * @file search-results.tpl.php
 * See http://api.drupal.org/api/drupal/modules!search!search-results.tpl.php/7
 * 
 * Theme suggestions:
 * - search-results.tpl.php
 * - search-results--SEARCH_TYPE.tpl.php
 * 
 * See http://drupal.org/node/1089656#search-results-suggestion
 */
?><?php if ($search_results): ?>
  <h2><?php print t('Search results');?></h2>
  <ol class="search-results <?php print $module; ?>-results">
    <?php print $search_results; ?>
  </ol>
  <?php print $pager; ?>
<?php else : ?>
  <h2><?php print t('Your search yielded no results');?></h2>
  <?php print search_help('search#noresults', drupal_help_arg()); ?>
<?php endif; ?>
