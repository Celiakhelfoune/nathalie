
<?php get_header(); ?>
  <section class="site-container">
  <div class="mon-hero">
    <div class="photographe">
      <h1 class="titreImage">PHOTOGRAPHE EVENT</h1>
      <?php
      // Récupérer toutes les images du catalogue WordPress
      $images = get_posts(array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => -1,
      ));

      // Vérifier s'il y a des images disponibles
      if ($images) {
        // Générer un nombre aléatoire pour sélectionner une image
        $random_number = rand(0, count($images) - 1);

        // Récupérer l'URL de l'image sélectionnée
        $image_url = wp_get_attachment_image_src($images[$random_number]->ID, 'full')[0];

        // Afficher le hero avec l'image aléatoire en arrière-plan
        echo '<div class="hero" style="background-image: url(' . $image_url . ');">';

        echo '</div>';
      }
      ?>
    </div>
  </div>

  <!-- Les filtres -->
  <div class="mes-filtres">
  <section class="listes">
<div class="format-class">
    <select name="categorie" class="format-btn">
      <option value="" class="default-option">CATÉGORIES</option>
      <?php
      //Récuperer tous les termes de taxonomie de categorie
      $categories = get_terms('categorie');
      foreach ($categories as $category) {
        $optionClass = '';
        //Afficher chaque option pour le terme de taxonomie actuel
        echo '<option value="' . $category->slug  . '">'  . $category->name . '</option>';
      }
      ?>
    </select>
    </div>
    <div class="arrow1">
    <select name="format" class="format-btn">
      <option value="" class="default-option">FORMATS</option>
      <?php
      //Récuperer tous les termes de taxonomie de Fotmat
      $formats = get_terms('format');
      foreach ($formats as $format) {
        $optionClass = '';

        echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
      }
      ?>

    </select>
    </div>
    <div class="custom-select">
      <select id="mySelect" name="tri" class="format-btn">
        <?php
        // Récuperer les métadonnées associées à chaque photo
        $year = get_post_meta('year');
        foreach ($years as $year) {
          echo '<option value="' . $year->slug . '">' . $year->name . '</option>';
        }
        ?>
        <option value="">TRIER PAR</option>
        <option value="2023">2023</option>
        <option value="2022">2022</option>
        <option value="2021">2021</option>
        <option value="2020">2020</option>
        <option value="2019">2019</option>
      </select>
    </div>
  </section>
  </div>
<div class="mes-photos">
  <section class="photos" id="photo-section">
    <?php
    //Tableau des paramètres  de la requette de la base de donnée
    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 12,
      'paged' => isset($_GET['page']) ? $_GET['page'] : 1
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        //Récuperer les images attachées à l'article courant 
        $images = get_attached_media('image', get_the_ID(), 'forme1');
        // Récuperer les catégories attachées à l'article courant 
        $categories = get_the_terms(get_the_ID(), 'categorie');
        $category_names = wp_list_pluck($categories, 'name');
        // Récuperer les références attachées à l'article courant 
        $references = get_post_meta(get_the_ID(), 'reference', true);
        // Afficher chaqueimage avec avec ses informations
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
    ?>
  </section>
  </div>
  <div class="load-more-button">
    <a href="#" class="voirPlusbtn" data-page="1">Charger plus</a>
  </div>

  <?php get_footer(); ?>
  </div>
