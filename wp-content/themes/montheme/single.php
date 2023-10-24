<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage mon theme
 */

 get_header();
 $id = get_the_ID();
?>
<section></section>
<div class="single">
  
    <?php
 // Récupérer les valeurs des champs personnalisés
 $titres = get_post_meta($id, 'titre', true);
 $references = get_post_meta($id, 'reference', true);
 $types = get_post_meta($id, 'type', true);
 $year = get_post_meta($id, 'year', true);

 // Récupérer les termes de la taxonomie "catégorie"
 $categories = get_the_terms($id, 'categorie');
 $category_names = wp_list_pluck($categories, 'name');

 // Récupérer les termes de la taxonomie "format"
 $formats = get_the_terms($id, 'format');
 $format_names = wp_list_pluck($formats, 'name');

 
 ?>
 <div class="container">
    <div class="content-container">
    <?php
    // Afficher les valeurs des champs personnalisés et taxonomie "format" et "catégorie"
 echo '<h2>' . $titres . '<h2>';
 echo '<p>REFERENCE : ' . $references . '</p>';
 echo '<p>CATEGORIE : ' . implode(',', $category_names) . '</p>';
 echo '<p>FORMAT : ' . implode(', ', $format_names) . '</p>';
 echo '<p>TYPE : ' . $types . '</p>';
 echo '<p>ANNEE : ' . $year . '</p>';

 ?>
  </div>
  <div class="image-container">
 <?php
 // Récupérer les images attachées au post
$images = get_attached_media('image', $id );

// Afficher les images
foreach ($images as $image) {
    echo wp_get_attachment_image($image->ID,'forme');
}
 ?>
 
 </div>
 </div>
 </section>
 <section>
 <div class="sup">
 <div class="btncnt">
    <p>Cette photo vous interesse ?</p>
<a href="#openModal" class="contact-button">Contact</a>
</div> 

<!-- lightbox -->
<div class="row">
  <div class="column hover-shadow image-container1">
  <?php
    $next_post = get_next_post();
    if ($next_post) {
        $next_post_id = $next_post->ID;
        $next_post_images = get_attached_media('image', $next_post_id);
        foreach ($next_post_images as $index => $image) {
          echo '<img src="' . wp_get_attachment_image_src($image->ID)[0]  . '" />';

        }
      }else {
        // le dernier article, afficher l'image précédente
        $previous_post = get_previous_post();
        $previous_post_images = get_attached_media('image', $previous_post->ID);
        foreach ($previous_post_images as $index => $image) {
          echo '<img src="' . wp_get_attachment_image_src($image->ID)[0]  . '" />';
        }
      }
      ?>
      
    <div class="arrows">
    <?php
      previous_post_link('%link','<i class="fa-solid fa-arrow-left arrow"></i>');
      next_post_link('%link','<i class="fa-solid fa-arrow-right arrow"></i>');
    ?>
    </div>
  </div>
</div>
</div>
</div>
</section>
<section class="similaires">
<!--les articles similaires -->
<div class="articleSimilaire">
<p>VOUS AIMEZ AUSSI ?</p>
<div class="imgsemilaire">
<?php
// récupérer les articles similaires
$args = array(
    'post__not_in' => array($id), // Exclure l'article actuel
    'post_type' => 'photo',
    'posts_per_page' => 2,
    'tax_query' => array(
      'relation' => 'OR',
      array(
        'taxonomy' => 'categorie',
        'field' => 'term_id',
        'terms' => wp_get_post_terms($id, 'categorie', array('fields' => 'ids')),
      ),
    ),
  );
  
  // Exécuter la requête WP_Query
  $query = new WP_Query($args);
  
  // Afficher les articles similaires
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
  
      // Afficher les images attachées aux articles similaires
      $images = get_attached_media('image', get_the_ID());
      foreach ($images as $image) {
        echo '<div class="image-link">';
        echo '<a>'. wp_get_attachment_image($image->ID,'forme1');
        echo '<div class="overlay-content">';
        echo '<img src="' . get_stylesheet_directory_uri() . '/images/PhotosNMota/Icon_fullscreen.png" class="square fullscreen-btn"/>';
        echo '<a href="' .get_permalink() . '"><span id="icone" class="icone"><i class="fa fa-eye"></i></span></a>';
        echo '<div class="overlay-infos">';
        echo '<h5 class="title">' . get_the_title() . '</h5>';
        echo '<p class="category">' . implode(',', $category_names) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    }
  }
  
  // Réinitialiser la requête WP_Query
  wp_reset_postdata();
  ?>
  
  </div>
  <div class="load-more-button">
        <a href="#" class="voirPlusbtn ">toutes les photos</a>
    </div>
  </div>
  </div>
  </section>
  
 <?php get_footer(); ?>