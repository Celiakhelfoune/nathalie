<?php
function theme_scripts(){
    wp_enqueue_script('scripts',get_template_directory_uri().'/js/scripts.js',array(),'1.0',true);
}
add_action('wp_enqueue_scripts','theme_scripts');
// Gestion des menus
function enregistre_mon_menu() {
        register_nav_menu( 'header', __( 'Menu principal' ) );}

add_action( 'init', 'enregistre_mon_menu' );

function enregistre_mon_menu_mobile() {
    register_nav_menu( 'menu_mobile', __( 'Menu mobile' ) );}
    add_action( 'init', 'enregistre_mon_menu_mobile' );
function montheme_support(){
    add_theme_support('menus');
    add_image_size('forme',560,500);
    add_image_size('forme1',560,850);
    register_nav_menu('header','En tete du menu');   
    }
    add_action('after_setup_theme','montheme_support');
function theme_setup() {
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'theme_setup' );
function theme_enqueue_scripts() {
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );



add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos() {
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $images = get_attached_media('image', get_the_ID(), 'forme1');
            foreach ($images as $image) {
                echo '<a href="' . get_permalink() . '">' . wp_get_attachment_image($image->ID, 'forme1') . '</a>';
            }
        }
    }

    wp_reset_postdata();

    die();
}
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js', array('jquery'), '1.0', true);
    wp_localize_script('custom-scripts', 'custom_scripts_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
