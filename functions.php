<?php

// Gestion des images mises en avant
add_theme_support("post-thumbnails");
// set_post_thumbnail_size( 258, 145, true );

// Ajouter une taille d'image personnalisée pour une grande image
add_image_size( 'large-size', 800, 600, true );

// Ajouter une taille d'image personnalisée pour une miniature
add_image_size( 'thumbnail-size', 150, 150, true );

// Ajouter une autre taille d'image personnalisée
add_image_size( 'custom-size', 500, 300, true );


// Déclarer les emplacements des menus
function motaphoto_register_menus() {
    register_nav_menus(array(
        'menu-header' => 'Menu Principal',
        'menu-footer' => 'Menu Footer',
    ));
}
add_action('init', 'motaphoto_register_menus');

// Enregistrer et charger les scripts et les styles
function theme_enqueue_scripts() {
    // Charger le fichier scripts.js
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), null, true);

    // Charger la feuille de style
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');



