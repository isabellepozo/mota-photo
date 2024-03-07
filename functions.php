<?php

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
    // Enregistrer et charger votre propre version de jQuery
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', array(), null, true);
    
    // Charger la feuille de style
    wp_enqueue_style('style', get_stylesheet_uri());

    // Charger le fichier scripts.js
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
    wp_script_add_data('custom-scripts', 'defer', true);

    // Charger le fichier lightbox.js en tant que module avec l'attribut defer
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), null, true);
    wp_script_add_data('lightbox', 'type', 'module');
    wp_script_add_data('lightbox', 'defer', true);
 }
 
 add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// Ajoutez des tailles d'images personnalisées
add_image_size('thumbnail_80x70', 80, 70, true); // Changez les dimensions selon vos besoins
















