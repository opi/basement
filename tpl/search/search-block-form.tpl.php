<?php
/**
 * @file search-block-form.tpl.php
 * See http://api.drupal.org/api/drupal/modules!search!search-block-form.tpl.php/7
 * 
 * Theme suggestions: none by default.
 */
?><div class="container-inline">
  <?php if (empty($variables['form']['#block']->subject)): ?>
  <h2 class="element-invisible"><?php print t('Search form'); ?></h2>
  <?php endif; ?>
  <?php print $search_form; ?>
</div>
