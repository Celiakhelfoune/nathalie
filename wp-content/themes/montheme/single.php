
<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage mon theme
 */
?>

<div class="global-single"> 
  <?php
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
      $images = get_attached_media('image', $id);

      // Afficher les images
      foreach ($images as $image) {
        echo wp_get_attachment_image($image->ID, 'forme');
      }
      ?>

    </div>
  </div>
 
  <section class="bloc2">
  <div class="sup">
    <div class="btncnt">
      <p>Cette photo vous intéresse ?</p>
      <div class="btncntt">
      <a href="#openModal" class="contact-button">Contact</a>
      </div>
    </div>
    <!-- La liste des miniatures -->
    <div class="row">
      <div class="column hover-shadow image-container1">
        <?php
          // Récupérer l'article suivant de l'article actuel
          $next_post = get_next_post();
          
          if ($next_post) {
            $next_post_id = $next_post->ID;
            // Récupérer les images attachées à l'article suivant
            $next_post_images = get_attached_media('image', $next_post_id);
            
            foreach ($next_post_images as $index => $image) {
              // Afficher l'image avec une classe pour le survol
              echo '<img src="' . wp_get_attachment_image_src($image->ID)[0]  . '" class="zoom-image"/>';
            }
          } else {
            // Le dernier article, afficher l'image précédente
            $previous_post = get_previous_post();
            $previous_post_images = get_attached_media('image', $previous_post->ID);
            
            foreach ($previous_post_images as $index => $image) {
              // Afficher l'image avec une classe pour le survol
              echo '<img src="' . wp_get_attachment_image_src($image->ID)[0]  . '" class="zoom-image"/>';
            }
          }
        ?>
        
        <div class="arrows">
          <?php
            // Les flèches de navigation vers la photo suivante ou précédente
            previous_post_link('%link', '<i class="fa-solid fa-arrow-left arrow"></i>');
            next_post_link('%link', '<i class="fa-solid fa-arrow-right arrow"></i>');
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
  <section class="similaires">
   
    <!--Les articles similaires (photos apparentées )-->
    <div class="articleSimilaire">
      <p>VOUS AIMEZ AUSSI ?
      </p>
      <div class="imgsemilaire">
        <?php
        // Récupérer les articles similaires
        $args = array(
          'post__not_in' => array($id), // Exclure l'article actuel
          'post_type' => 'photo',
          'posts_per_page' => 2, //nombre d'articles similaires
          'tax_query' => array( //filtrer les articles similaires en fonction de leurs catégorie
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
        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
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

        // Réinitialiser la requête WP_Query
        wp_reset_postdata();
        ?>

      </div>

     
    </div>
</div>
</section>
<div class="btn-toutes-les-photos">
        <a href="#">toutes les photos</a>
      </div>
<section>
<?php get_footer();?>
</section>
</div>