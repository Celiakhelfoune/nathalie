<div id="myModal" class="modal">
    <span class="close cursor">&times;</span>
    <div class="modal-content">
        <?php
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => -1, // Récupérer tous les articles
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $images = get_attached_media('image', get_the_ID());
                foreach ($images as $index => $image) {
                    $image_url = wp_get_attachment_image_src($image->ID, 'forme1'); // Récupérer l'URL de l'image
                    echo '<div class="image-container3" data-article-id="' . get_the_ID() . '">';
                    echo '<img src="' . $image_url[0] . '" />';
                    echo '</div>';
                }
             
            }
            wp_reset_postdata();
        }
        ?>
        <div>
            <a class="prev" onclick="plusSlides(-1)"><i class="fa-solid fa-arrow-left"></i> Précédente</a>
            <a class="next" onclick="plusSlides(1)">Suivante<i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</div>