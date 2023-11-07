<?php

// Déclarer les emplacements des menus
function motaphoto_register_menus() {
    register_nav_menus(array(
        'menu-header' => 'Menu Principal',
        'menu-footer' => 'Menu Footer',
    ));
}
add_action('init', 'motaphoto_register_menus');

// Désenregistrer la version de jQuery incluse par WordPress
function remove_default_jquery() {
    wp_deregister_script('jquery');
}
add_action('wp_enqueue_scripts', 'remove_default_jquery');

// Enregistrer et charger les scripts et les styles
function theme_enqueue_scripts() {
    // Enregistrer et charger votre propre version de jQuery
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', array(), null, true);

    // Charger le fichier scripts.js
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);

    // Charger la feuille de style
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');















