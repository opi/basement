<?php
/**
 * @file field.tpl.php
 * See http://api.drupal.org/api/drupal/modules!field!theme!field.tpl.php/7
 *
 * Theme suggestions:
 * - field.tpl.php
 * - field--TYPE.tpl.php
 * - field--NAME.tpl.php
 * - field--CONTENT_TYPE.tpl.php
 * - field--NAME--CONTENT_TYPE.tpl.php
 *
 * See http://drupal.org/node/1089656#field-suggestion
 */
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
  <?php endif; ?>
  <?php foreach ($items as $delta => $item): ?>
    <?php print render($item); ?>
  <?php endforeach; ?>
</div>
