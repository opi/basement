<?php
/**
 * @file book-all-books-block.tpl.php
 * See http://api.drupal.org/api/drupal/modules%21book%21book-all-books-block.tpl.php/7
 *
 * Theme suggestions: None by default.
 */
?>
<?php foreach ($book_menus as $book_id => $menu): ?>
<nav id="book-block-menu-<?php print $book_id; ?>" class="book-block-menu">
  <?php print render($menu); ?>
</nav>
<?php endforeach; ?>
