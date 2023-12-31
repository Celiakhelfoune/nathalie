<?php


add_action('wp_enqueue_scripts', 'my_plugin_assets');
function my_plugin_assets()
{
  wp_enqueue_script('script-name', get_stylesheet_directory_uri() . '/js/scripts.js', array(), '1.0.0');

  wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array(), '1.0');
  wp_localize_script('custom-scripts', 'custom_scripts_vars', array(
    'ajaxurl' => admin_url('admin-ajax.php')
  ));
}


// Gestion des menus
function enregistre_mon_menu()
{
  register_nav_menu('header', __('Menu principal'));
}

add_action('init', 'enregistre_mon_menu');

function enregistre_mon_menu_mobile()
{
  register_nav_menu('menu_mobile', __('Menu mobile'));
}
add_action('init', 'enregistre_mon_menu_mobile');

function montheme_support()
{
  add_theme_support('menus');
  add_image_size('forme', 564, 495);
  add_image_size('forme1', 563, 844);
  register_nav_menu('header', 'En tete du menu');
}
add_action('after_setup_theme', 'montheme_support');
function theme_setup()
{
  add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'theme_setup');
function theme_enqueue_scripts()
{
  wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
add_action('wp_ajax_load_more_photos', 'load_more_photos');


function load_more_photos()
{
  $categorie = $_POST['categorie'];
  $format = $_POST['format'];
  $tri = $_POST['tri'];
  $page = $_POST['page'];

  $args = array(
    'post_type' => 'photo',
    'posts_per_page' => 12,
    'paged' => $page,
    'tax_query' => array(),
    'meta_query' => array(),

  );

  // Ajouter la taxonomie "categorie" à la requête si une catégorie est sélectionnée
  if (!empty($categorie)) {
    $args['tax_query'][] = array(
      'taxonomy' => 'categorie',
      'field' => 'slug',
      'terms' => $categorie
    );
  }

  // Ajouter la taxonomie "format" à la requête si un format est sélectionné
  if (!empty($format)) {
    $args['tax_query'][] = array(
      'taxonomy' => 'format',
      'field' => 'slug',
      'terms' => $format
    );
  }

  // Ajouter le champ personnalisé "year" à la requête si une année est sélectionnée
  if (!empty($tri)) {
    $args['meta_query'][] = array(
      'key' => 'year',
      'value' => $tri,
      'compare' => '='
    );
  }


  $query = new WP_Query($args);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      // Afficher les images attachées au post
      $images = get_attached_media('image', get_the_ID(), 'forme1');
      $categories = get_the_terms(get_the_ID(), 'categorie');
      $category_names = wp_list_pluck($categories, 'name');
      $references = get_post_meta(get_the_ID(), 'reference', true);
      foreach ($images as $image) {
        echo '<div class="image-link" data-reference="' . $references . '"data-categorie="' . implode(',', $category_names) . '">';
        echo '<a>' . wp_get_attachment_image($image->ID, 'forme1');
        echo '<div class="overlay-content">';
        echo '<img src="' . get_stylesheet_directory_uri() . '/images/PhotosNMota/Icon_fullscreen.png" class="square fullscreen-btn"/>';
        echo '<a href="' . get_permalink() . '"><span id="icone" class="icone"><i class="fa fa-eye"></i></span></a>';
        echo '<div class="overlay-infos">';
        echo '<p class="title">' . get_the_title() . '</p>';
        echo '<p class="category">' . implode(',', $category_names) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    }
  }

  wp_reset_postdata();
  die();
}



// Fonction pour récupérer les termes de taxonomie
function get_taxonomy_terms()
{
  $taxonomy = $_POST['taxonomy'];
  $terms = get_terms($taxonomy);
  $response = array();
  foreach ($terms as $term) {
    $response[] = array(
      'name' => $term->name,
      'slug' => $term->slug
    );
  }
  wp_send_json($response);
}
add_action('wp_ajax_get_taxonomy_terms', 'get_taxonomy_terms');
add_action('wp_ajax_nopriv_get_taxonomy_terms', 'get_taxonomy_terms');

function get_custom_field_values()
{
  $post_id = $_POST['post_id'];
  $value = get_post_meta($post_id, 'photos', true);
  echo $value;


  wp_die();
}

add_action('wp_ajax_get_custom_field_values', 'get_custom_field_values');
add_action('wp_ajax_nopriv_get_custom_field_values', 'get_custom_field_values');
