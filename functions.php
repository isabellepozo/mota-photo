<?php

// Enregistrer et charger les scripts et les styles
function theme_enqueue_scripts() {
    // Enregistrer et charger votre propre version de jQuery
    // wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', array(), null, true);
    
    // Charger la feuille de style
    wp_enqueue_style('style', get_stylesheet_uri());

    // Charger le fichier scripts.js
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
    wp_script_add_data('custom-scripts', 'defer', true);

    // Charger le fichier lightbox.js
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), null, true);
    // wp_script_add_data('lightbox', 'type', 'module');
    wp_script_add_data('lightbox', 'defer', true);

    // Charger le fichier more_photos.js
    wp_enqueue_script('more_photos', get_template_directory_uri() . '/assets/js/more_photos.js', array('jquery'), null, true);
    // wp_script_add_data('more_photos', 'type', 'module');
    wp_script_add_data('more_photos', 'defer', true);

    // Passer l'URL de l'endpoint AJAX à JavaScript
    wp_localize_script('more_photos', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
  }
 
 add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// Ajouter des tailles d'images personnalisées
add_image_size('thumbnail_80x70', 80, 70, true); // Changez les dimensions selon vos besoins

// Fonction pour effectuer une requête AJAX à l'API de WordPress et récupérer les photos supplémentaires
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos() {
    // Récupérer les IDs des photos déjà affichées sur la page d'accueil
    $loaded_photo_ids = isset($_POST['loaded_photo_ids']) ? $_POST['loaded_photo_ids'] : array();

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'offset' => intval($_POST['offset']),
        'post__not_in' => $loaded_photo_ids, // Exclure les IDs des photos déjà affichées
    );

    $query = new WP_Query($args);

    $photos = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $photos[] = array(
                'id' => get_the_ID(), // Ajouter l'ID de la photo
                'title' => get_the_title(),
                'permalink' => get_permalink(), // Ajouter le permalien de la photo
                'image' => get_the_post_thumbnail_url(),
                'icon_eye' => get_template_directory_uri() . '/assets/images/icon_eye.png', // Ajouter l'URL de l'icône de l'oeil
                'icon_fullscreen' => get_template_directory_uri() . '/assets/images/icon_fullscreen.png', // Ajouter l'URL de l'icône du plein écran
            );
        }
    }

    wp_reset_postdata();

    wp_send_json($photos);
    wp_die();
}

// Déclarer les emplacements des menus
function motaphoto_register_menus() {
    register_nav_menus(array(
        'menu-header' => 'Menu Principal',
        'menu-footer' => 'Menu Footer',
    ));
}
add_action('init', 'motaphoto_register_menus');













