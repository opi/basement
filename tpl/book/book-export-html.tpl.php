<?php
/**
 * @file book-export-html.tpl.php
 * See http://api.drupal.org/api/drupal/modules%21book%21book-export-html.tpl.php/7
 *
 * Theme suggestions: None by default.
 */
?><!DOCTYPE html>
<html lang="<?php print $language->language; ?>"  dir="<?php print $language->dir; ?>">
  <head>
    <?php print $head; ?>
    <title><?php print $title; ?></title>
    <base href="<?php print $base_url; ?>" />
    <link type="text/css" rel="stylesheet" href="misc/print.css" />
    <?php if ($language_rtl): ?>
    <link type="text/css" rel="stylesheet" href="misc/print-rtl.css" />
    <?php endif; ?>
  </head>
  <body>
    <?php
    /**
     * The given node is /embedded to its absolute depth in a top level
     * section/. For example, a child node with depth 2 in the hierarchy is
     * contained in (otherwise empty) &lt;div&gt; elements corresponding to
     * depth 0 and depth 1. This is intended to support WYSIWYG output - e.g.,
     * level 3 sections always look like level 3 sections, no matter their
     * depth relative to the node selected to be exported as printer-friendly
     * HTML.
     */
    $div_close = '';
    ?>
    <?php for ($i = 1; $i < $depth; $i++): ?>
      <div class="section-<?php print $i; ?>">
      <?php $div_close .= '</div>'; ?>
    <?php endfor; ?>
    <?php print $contents; ?>
    <?php print $div_close; ?>
  </body>
</html>
