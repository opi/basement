<?php


/**
 * Implements hook_html_head_alter().
 */
function basement_html_head_alter(&$head_elements) {
  
  // HTML5 style charset
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8',
  );
  
  foreach($head_elements as $k => $head_element) {
    // Remove default favicon. We manage that directly in page.tpl, and 
    // in the 'icon' folder of the theme.
    // Theme settings page allow us to change favicon but not apple icon. 
    if (strpos($k, 'drupal_add_html_head_link:shortcut icon') === 0) {
      unset($head_elements[$k]);
    }
  }
  
} // basement_html_head_alter


/**
 * Implements hook_process_html_tag().
 * Remove useless attributes (HTML5)
 */
function basement_process_html_tag(&$vars) {
  $tag = &$vars['element'];
  if ($tag['#tag'] == 'style' || $tag['#tag'] == 'script') {
    // Remove redundant type attribute and CDATA comments.
    unset($tag['#attributes']['type'], $tag['#value_prefix'], $tag['#value_suffix']);

    // Remove media="all" but leave others unaffected.
    if (isset($tag['#attributes']['media']) && $tag['#attributes']['media'] === 'all') {
      unset($tag['#attributes']['media']);
    }
  }
}


/**
 * Implements hook_preprocess_html().
 */
function basement_preprocess_html(&$vars) {
  $path_to_theme = base_path() . drupal_get_path('theme', 'basement');
  
  // (fav)icon path
  $vars['icon_path'] = $path_to_theme . '/icon';

  // Viewport
  $viewport = array(
    '#tag' => "meta",
    '#attributes' => array(
      'name' => "viewport",
      'content' => "width=device-width,initial-scale=1"
    ),
  );
  drupal_add_html_head($viewport, 'viewport');
  
  // HTML5 Shiv
  // Must be printed 
  $html5shiv = array(
    '#type' => 'html_tag',
    '#tag' => "script",
    '#prefix' => "<!--[if lt IE 9]>",
    '#value' => "",
    '#suffix' => "<![endif]-->",
    '#attributes' => array(
      'src' => "//html5shiv.googlecode.com/svn/trunk/html5.js",
    ),
  );
  drupal_add_html_head($html5shiv, 'html5shiv');
  
  // Respond.js
  // Could not use drupal_add_html_head() because respond.js must be 
  // references after all CSS, but not in footer.
  // use render($respond);
  $vars['respond'] = array(
    '#type' => 'html_tag',
    '#tag' => "script",
    '#prefix' => "<!--[if lt IE 9]>",
    '#value' => "",
    '#suffix' => "<![endif]-->",
    '#attributes' => array(
      'src' => $path_to_theme . "/js/lib/respond.min.js",
    ),
  );
  
  // jQuery Placeholder
  // Could not use drupal_add_js because we target IE9- only. 
  // use render($placeholder);
  $vars['placeholder'] = array(
    '#type' => 'html_tag',
    '#tag' => "script",
    '#prefix' => "<!--[if lt IE 10]>",
    '#value' => "",
    '#suffix' => "<![endif]-->",
    '#attributes' => array(
      'src' => $path_to_theme . "/js/lib/jquery.placeholder.min.js",
    ),
  );


  // Force latest IE rendering engine (even in intranet) & Chrome Frame
  if (is_null(drupal_get_http_header('X-UA-Compatible'))) {
    drupal_add_http_header('X-UA-Compatible', 'IE=edge,chrome=1');
  }
  
  // <body> classes
  if (arg(0) == 'node') {
    if (arg(1) == 'add') {
      $vars['classes_array'][] = 'section-node-add';
    } 
    elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
      $vars['classes_array'][] = 'section-node-' . arg(2); 
    }
  }

} // basement_preprocess_html


/**
 * Implements hook_preprocess_page().
 */
function basement_preprocess_page(&$vars) {

  // Remove contexutal links class from page (it makes every CL appears on page hover)
  // @TODO : check if needed.
  foreach($vars['classes_array'] as $k => $v) {
    if ($v == 'contextual-links-region') {
      unset($vars['classes_array'][$k]);
    }
  }

  // Add more template suggestions
  if (isset($vars['node'])) {
    $vars['theme_hook_suggestions'][] = 'page__node__' . $vars['node']->type;
  }

  // Tabs
  if (!empty($vars['tabs']['#primary'])) {
    $vars['classes_array'][] = 'with-tabs';
  }

  // Title (h1)
  // Do not display on page.tpl if we're viewing a node
  if (isset($vars['node']) && !isset($vars['display_title'])) {
    $vars['display_title'] = FALSE;
  }
  $vars['display_title'] = isset($vars['display_title']) ? $vars['display_title'] : TRUE;

  // Work-around a stupid bug in Drupal 7
  if (arg(0) == 'user' && arg(1) == 'login') {
    drupal_set_title(t('User login'));
  }
  if (arg(0) == 'user' && arg(1) == 'password') {
    drupal_set_title(t('Request new password'));
  }
  if (arg(0) == 'user' && arg(1) == 'register') {
    drupal_set_title(t('Create new account'));
  }

} // basement_preprocess_page


/**
 * Implements hook_preprocess_node().
 */
function basement_preprocess_node(&$vars) {
  $node = $vars['node'];
  
  // Add view-mode & type template suggestions and classes
  $vars['theme_hook_suggestions'][] = 'node__' . $vars['view_mode'];
  $vars['theme_hook_suggestions'][] = 'node__' . $node->type . '__' . $vars['view_mode'];
  $vars['classes_array'][] = 'node-' . $vars['view_mode'];
  $vars['classes_array'][] = 'node-' . $node-type . '-' . $vars['view_mode'];

  // HTML5 submitted info
  $vars['datetime'] = format_date($node->created, 'custom', 'c');
  if ($vars['display_submitted']) {
    $vars['submitted'] = t("Submitted by !username on !datetime",
      array(
        '!username' => $vars['name'],
        '!datetime' => '<time datetime="' . $vars['datetime'] . '" pubdate="pubdate">' . $vars['date'] . '</time>',
      )
    );
  }
  else {
    $vars['submitted'] = '';
  }
  
  // h1 title is displayed on node.tpl, duplicate page.tpl id & class
  if ($vars['view_mode'] == 'full') {
    $vars['title_attributes_array']['id'] = 'page-title';
    $vars['title_attributes_array']['class'] = 'title';
  }
    
} // basement_preprocess_node


/**
 * Implements hook_preprocess_block().
 */
function basement_preprocess_block(&$vars) {
  $block = $vars['block'];

  // Add more classes
  $vars['classes_array'][] = 'block-'.$vars['block_zebra'];
  $vars['classes_array'][] = 'block-'.$vars['block_id'];

  // Block title
  if(empty($vars['block']->subject)) {
    // Add a class to provide CSS for blocks without titles.
    $vars['attributes_array']['class'][] = 'block-without-title';
  }
  else {
    // Adding a class to the title attributes
    $vars['title_attributes_array']['class'][] = 'title';
  }
  
  // @TODO add aria role support (see zen and adaptivetheme)

} // basement_preprocess_block


/**
 * Implements template_preprocess_field().
 */
function basement_preprocess_field(&$vars) {
  /*
   * theme_hook_suggestion:
   *  $variables['theme_hook_suggestions'] = array(
        'field__' . $element['#field_type'],
        'field__' . $element['#field_name'],
        'field__' . $element['#bundle'],
        'field__' . $element['#field_name'] . '__' . $element['#bundle'],
  );
   * ex: field__field_faq_question
   * ex: field__field_faq_question__field_faq (here, bundle = field_collection field
   * ex: field__field_faq_answer

   */

  // @TODO : need more theme suggestions ?
  
} // basement_preprocess_field


/**
 * Implements template_preprocess_search_block_form().
 * Changes the search form to use the HTML5 "search" input attribute
 */
function basement_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
}


/**
 * Implements theme_breadcrumb().
 */
function basement_breadcrumb($vars) {
  // @TODO : is there something (html5 related) to do ?
}
