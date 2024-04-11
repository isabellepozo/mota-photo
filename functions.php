<?php

/**************** Enregistrer et charger les scripts et les styles ********************/
function theme_enqueue_scripts() {
    // Enregistrer et charger votre propre version de jQuery
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', array(), null, true);
    
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

    // Charger le fichier filters.js
    wp_enqueue_script('filters', get_template_directory_uri() . '/assets/js/filters.js', array('jquery'), null, true);
    // wp_script_add_data('filters', 'type', 'module');
    wp_script_add_data('filters', 'defer', true);

    // Passer l'URL de l'endpoint AJAX à JavaScript pour more_photos.js
    wp_localize_script('more_photos', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));

    // Passer l'URL de l'endpoint AJAX à JavaScript pour filters.js
    wp_localize_script('filters', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));

    // Passer l'URL de l'endpoint AJAX à JavaScript pour lightbox.js
    wp_localize_script('lightbox', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));

  }
 
 add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


 /******************** Ajouter des tailles d'images personnalisées ********************/
add_image_size('thumbnail_80x70', 80, 70, true); // Changez les dimensions selon vos besoins


/******************** Déclarer les emplacements des menus **********************/
function motaphoto_register_menus() {
    register_nav_menus(array(
        'menu-header' => 'Menu Principal',
        'menu-footer' => 'Menu Footer',
    ));
}
add_action('init', 'motaphoto_register_menus');


/******* Fonction requête AJAX à l'API de WordPress pour récupérer plus de photos ********/
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


/************** Fonction requête AJAX à l'API de WordPress pour filtrer les photos *********/
// Fonction pour filtrer les photos par catégorie
add_action('wp_ajax_filter_photos_by_category', 'filter_photos_by_category');
add_action('wp_ajax_nopriv_filter_photos_by_category', 'filter_photos_by_category');

function filter_photos_by_category() {
    // Récupérer la catégorie sélectionnée depuis la requête POST
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    // Définir les arguments de requête WP_Query
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1, // Récupérer toutes les photos
    );

    // Vérifier si une catégorie a été sélectionnée
    if ($category !== 'all') {
        // Ajouter des arguments de requête supplémentaires en fonction de la catégorie sélectionnée
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'categorie', // Taxonomie des catégories de photos
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    // Exécuter la requête WP_Query avec les arguments définis
    $query = new WP_Query($args);

    // Initialiser un tableau pour stocker les informations sur les photos filtrées
    $photos = array();

    // Vérifier si des photos ont été trouvées
    if ($query->have_posts()) {
        // Boucler à travers chaque photo trouvée
        while ($query->have_posts()) {
            $query->the_post();
            // Ajouter les informations de la photo au tableau
            $photos[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'image' => get_the_post_thumbnail_url(),
                'icon_eye' => get_template_directory_uri() . '/assets/images/icon_eye.png',
                'icon_fullscreen' => get_template_directory_uri() . '/assets/images/icon_fullscreen.png',
            );
        }
    }

    // Réinitialiser les données de la requête WordPress
    wp_reset_postdata();

    // Renvoyer les informations sur les photos sous forme de réponse JSON
    wp_send_json($photos);

    // Terminer le processus WordPress
    wp_die();
}


// Fonction pour filtrer les photos par format
add_action('wp_ajax_filter_photos_by_format', 'filter_photos_by_format');
add_action('wp_ajax_nopriv_filter_photos_by_format', 'filter_photos_by_format');

function filter_photos_by_format() {
    // Récupérer le format sélectionné depuis la requête POST
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';

    // Définir les arguments de requête WP_Query
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1, // Récupérer toutes les photos
    );

    // Vérifier si un format a été sélectionné
    if ($format !== 'all') {
        // Ajouter des arguments de requête supplémentaires en fonction du format sélectionné
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'format', // Taxonomie des formats de photos
                'field'    => 'slug',
                'terms'    => $format,
            ),
        );
    }

    // Exécuter la requête WP_Query avec les arguments définis
    $query = new WP_Query($args);

    // Initialiser un tableau pour stocker les informations sur les photos filtrées
    $photos = array();

    // Vérifier si des photos ont été trouvées
    if ($query->have_posts()) {
        // Boucler à travers chaque photo trouvée
        while ($query->have_posts()) {
            $query->the_post();
            // Ajouter les informations de la photo au tableau
            $photos[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'image' => get_the_post_thumbnail_url(),
                'icon_eye' => get_template_directory_uri() . '/assets/images/icon_eye.png',
                'icon_fullscreen' => get_template_directory_uri() . '/assets/images/icon_fullscreen.png',
            );
        }
    }

    // Réinitialiser les données de la requête WordPress
    wp_reset_postdata();

    // Renvoyer les informations sur les photos sous forme de réponse JSON
    wp_send_json($photos);

    // Terminer le processus WordPress
    wp_die();
}

// Fonction pour filtrer les photos par année
add_action('wp_ajax_filter_photos_by_year', 'filter_photos_by_year');
add_action('wp_ajax_nopriv_filter_photos_by_year', 'filter_photos_by_year');

function filter_photos_by_year() {
    // Récupérer l'option de tri sélectionnée depuis la requête POST
    $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : '';

    // Définir les arguments de requête WP_Query
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1, // Récupérer toutes les photos
        'orderby' => 'meta_value_num', // Trier par valeur numérique (année)
        'meta_key' => 'annee', // Clé du champ personnalisé contenant l'année
    );

    // Vérifier l'option de tri sélectionnée
    if ($sort === 'newest') {
        // Trier par ordre décroissant (du plus récent au plus ancien)
        $args['order'] = 'DESC';
    } elseif ($sort === 'oldest') {
        // Trier par ordre croissant (du plus ancien au plus récent)
        $args['order'] = 'ASC';
    }

    // Exécuter la requête WP_Query avec les arguments définis
    $query = new WP_Query($args);

    // Initialiser un tableau pour stocker les informations sur les photos filtrées
    $photos = array();

    // Vérifier si des photos ont été trouvées
    if ($query->have_posts()) {
        // Boucler à travers chaque photo trouvée
        while ($query->have_posts()) {
            $query->the_post();
            // Récupérer l'année de la photo à partir du champ personnalisé 'annee'
            $annee = get_post_meta(get_the_ID(), 'annee', true);
            // Ajouter les informations de la photo au tableau
            $photos[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'image' => get_the_post_thumbnail_url(),
                'icon_eye' => get_template_directory_uri() . '/assets/images/icon_eye.png',
                'icon_fullscreen' => get_template_directory_uri() . '/assets/images/icon_fullscreen.png',
                'year' => $annee, // Ajouter l'année de la photo aux données
                'lightbox_image' => get_the_post_thumbnail_url(get_the_ID(), 'full'), // URL de l'image en taille réelle pour la lightbox
            );
        }
    }

    // Réinitialiser les données de la requête WordPress
    wp_reset_postdata();

    // Renvoyer les informations sur les photos sous forme de réponse JSON
    wp_send_json($photos);

    // Terminer le processus WordPress
    wp_die();
}

