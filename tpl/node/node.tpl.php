<?php
/**
 * @file node.tpl.php
 * See http://api.drupal.org/api/drupal/modules!node!node.tpl.php/7
 *
 * Theme suggestions:
 * - node.tpl.php
 * - node--TYPE.tpl.php
 * - node--ID.tpl.php
 * - node--VIEW_MODE.tpl.php
 * - node--TYPE--VIEW_MODE.tpl.php
 *
 * See http://drupal.org/node/1089656#node-suggestion
 *
 * Differences with default node.tpl.php
 * - $title is always printed out in node.tpl, and not in page.tpl (on node-full pages)
 * - We remove $user_picture.
 * - $submitted is already with good markup, empty if disallowed.
 */
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php else: ?>
    <h1<?php print $title_attributes; ?>><?php print $title; ?></h1>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <?php print $submitted; ?>
  </header>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // Hide the comments and links, and render them in footer.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <footer>
    <?php print render($content['links']); ?>
    <?php print render($content['comments']); ?>
  </footer>
</article>
