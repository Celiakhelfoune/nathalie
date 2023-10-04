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
 
 <div class="btncnt">
    <p>Cette photo vous interesse ?</p>
<a href="#openModal" class="contact-button">Contact</a>
</div> 


<?php get_footer(); ?>