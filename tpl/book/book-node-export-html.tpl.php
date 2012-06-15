<?php

/**
 * @file book-node-export-html.tpl.php
 * See http://api.drupal.org/api/drupal/modules%21book%21book-node-export-html.tpl.php/7
 * 
 * Theme suggestions: None by default.
 */
?><article id="node-<?php print $node->nid; ?>" class="section-<?php print $depth; ?>">
  <h1 class="book-heading"><?php print $title; ?></h1>
  <?php print $content; ?>
  <?php print $children; ?>
</article>
