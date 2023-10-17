<?php
// Gestion des images mises en avant
add_theme_support("post-thumbnails");
// set_post_thumbnail_size( 258, 145, true );

// Déclarer les emplacements des menus
function motaphoto_register_menus() {
    register_nav_menus(array(
        'menu-header' => 'Menu Principal',
        'menu-footer' => 'Menu Footer',
    ));
}

 add_action('init', 'motaphoto_register_menus');

// Lier la feuille de style
function ajouter_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'ajouter_scripts' );