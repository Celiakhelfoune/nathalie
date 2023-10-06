<?php get_header(); ?>
<div class="photographe">
    <h1 class="titreImage">PHOTOGRAPHE EVENT</h1>
    <img src="<?php echo get_stylesheet_directory_uri() . '/images/PhotosNMota/nathalie-11.jpeg' ?>" alt="logo" class="imgheader">
</div>
<!-- les filtres -->
<section class="listeImg">
    <div class="listes">
        <select class="format-btn">
            <option class="color1" value="catégorie">Catégories</option>
            <option class="color2" value="reception">Réception</option>
            <option class="color3" value="television">Télévision</option>
            <option class="color1" value="concert">Concert</option>
            <option class="color2" value="mariage">Mariage</option>
        </select>
        <select class="format-btn">
            <option class="color1" value="format">Format</option>
            <option class="color2" value="reception">Paysage</option>
            <option class="color3" value="television">Portrait</option>
        </select>
        <select class="format-btn">
            <option class="color1" value="tous">TRIER PAR</option>
            <option class="color2" value="reception">2020</option>
            <option class="color3" value="television">2021</option>
            <option class="color1" value="concert">2022</option>
            <option class="color2" value="concert">2023</option>

        </select>
    </div>
</section>

<section class="photos" id="photo-section">
    <?php
    
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => isset($_GET['page']) ? $_GET['page'] : 1
      );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Afficher les images attachées au post
            $images = get_attached_media('image', get_the_ID(),'forme1');
            foreach ($images as $image) {
                echo '<a href="' . get_permalink() . '">' . wp_get_attachment_image($image->ID,'forme1') . '</a>';
            }
        }
    }
    wp_reset_postdata();
    ?>
</section>
<div class="load-more-button">
    <a href="#" class="voirPlusbtn" data-page="1">Voir plus</a>
</div>
<?php get_footer(); ?>