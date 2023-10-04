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
