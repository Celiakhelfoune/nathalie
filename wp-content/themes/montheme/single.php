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
 <div class="sup">
 <div class="btncnt">
    <p>Cette photo vous interesse ?</p>
<a href="#openModal" class="contact-button">Contact</a>
</div> 
</div>
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
        echo '<a href="' . get_permalink() . '">' . wp_get_attachment_image($image->ID,'forme1') . '</a>';
      }
    }
  }
  
  // Réinitialiser la requête WP_Query
  wp_reset_postdata();
  ?>
  
  </div>
  <div class="load-more-button">
        <a href="<?php echo home_url();?>" class="voirPlusbtn ">toutes les photos</a>
    </div>
  </div>
  </div>
 <?php get_footer(); ?>