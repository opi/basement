<?php
/**
 * @file taxonomy-term.tpl.php
 * See http://api.drupal.org/api/drupal/modules!taxonomy!taxonomy-term.tpl.php/7
 *
 * Theme suggestions:
 * - taxonomy-term.tpl.php
 * - taxonomy-term--VOCABULARY_MACHINE_NAME.tpl.php
 * - taxonomy-term--TID.tpl.php
 *
 * See http://drupal.org/node/1089656#taxonomy-term-suggestion
 */
?><article id="taxonomy-term-<?php print $term->tid; ?>" class="<?php print $classes; ?>">
  <?php if (!$page): ?>
  <h2><a href="<?php print $term_url; ?>"><?php print $term_name; ?></a></h2>
  <?php endif; ?>
  <div class="content">
    <?php print render($content); ?>
  </div>
</article>
