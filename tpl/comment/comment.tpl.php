<?php
/**
 * @file comment.tpl.php
 * See http://api.drupal.org/api/drupal/modules%21comment%21comment.tpl.php/7
 *
 * Theme suggestions:
 * - comment.tpl.php
 * - comment--node-TYPE.tpl.php
 *
 * See http://drupal.org/node/1089656#comment-suggestion
 */
?><article class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <header>
    <?php print $picture ?>

    <?php if ($new): ?>
      <span class="new"><?php print $new ?></span>
    <?php endif; ?>

    <?php print render($title_prefix); ?>
    <h3<?php print $title_attributes; ?>><?php print $title ?></h3>
    <?php print render($title_suffix); ?>

    <p class="submitted">
      <?php print $permalink; ?>
      <?php
        print t('Submitted by !username on !datetime.',
          array('!username' => $author, '!datetime' => $created));
      ?>
    </p>
  </header>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the links now so that we can render them later.
      hide($content['links']);
      print render($content);
    ?>
    <?php if ($signature): ?>
      <div class="user-signature clearfix">
        <?php print $signature ?>
      </div> <!-- /.user-signature -->
    <?php endif; ?>
  </div> <!-- /.content -->

  <?php if (!empty($content['links'])): ?>
    <footer>
      <?php print render($content['links']) ?>
    </footer>
  <?php endif; ?>

</article> <!-- /.comment -->
