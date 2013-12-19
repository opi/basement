<?php
/**
 * @file block.tpl.php
 * See http://api.drupal.org/api/drupal/modules!block!block.tpl.php/7
 * 
 * Theme suggestions:
 * - block.tpl.php
 * - block--REGION.tpl.php
 * - block--MODULE.tpl.php
 * - block--MODULE--DELTA.tpl.php
 * 
 * See http://drupal.org/node/1089656#block-suggestion
 */
?>
<?php 
  $tag = $block->subject ? 'section' : 'div';
  $title_tag = isset($block->title_tag) ? $block->title_tag : 'h2';
  
?><<?php print $tag; ?> id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if ($block->subject): ?>
    <<?php print $title_tag; ?><?php print $title_attributes; ?>><?php print $block->subject ?></<?php print $title_tag; ?>>
  <?php endif;?>
  <?php print render($title_suffix); ?>

  <div class="content<?php print $content_classes; ?>"<?php print $content_attributes; ?>>
    <?php print $content ?>
  </div> <!-- /.content -->

</<?php print $tag; ?>> <!-- /.block -->
