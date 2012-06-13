<?php
/**
 * @file comment.tpl.php
 * See http://api.drupal.org/api/drupal/modules%21comment%21comment-wrapper.tpl.php/7
 * 
 * Theme suggestions:
 * - comment-wrapper.tpl.php
 * - comment-wrapper--node-TYPE.tpl.php
 * 
 * See http://drupal.org/node/1089656#comment-wrapper-suggestion
 */
?><section id="comments" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if ($content['comments'] && $node->type != 'forum'): ?>
    <?php print render($title_prefix); ?>
    <h2 class="title"><?php print t('Comments'); ?></h2>
    <?php print render($title_suffix); ?>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

  <?php if ($content['comment_form']): ?>
    <section id="comment-form-wrapper">
      <h2 class="title"><?php print t('Add new comment'); ?></h2>
      <?php print render($content['comment_form']); ?>
    </section> <!-- /#comment-form -->
  <?php endif; ?>
</section> <!-- /#comments -->
