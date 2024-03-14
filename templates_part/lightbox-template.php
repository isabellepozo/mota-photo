<div id="lightbox">
    <!-- Bouton de fermeture de la lightbox -->
    <button class="lightbox__close"></button>

    <?php
    // Bouton de navigation vers l'image précédente
    $previous_post = get_previous_post();
    if ($previous_post) {
        $previous_post_link = get_permalink($previous_post);
        $previous_image_id = get_post_thumbnail_id($previous_post->ID);
        $previous_image_url = wp_get_attachment_image_src($previous_image_id, 'full')[0];
        echo '<button class="lightbox__prev" data-image-url="' . $previous_image_url . '"></button>';
    }
    ?>

    <?php
    // Bouton de navigation vers l'image suivante
    $next_post = get_next_post();
    if ($next_post) {
        $next_post_link = get_permalink($next_post);
        $next_image_id = get_post_thumbnail_id($next_post->ID);
        $next_image_url = wp_get_attachment_image_src($next_image_id, 'full')[0];
        echo '<button class="lightbox__next" data-image-url="' . $next_image_url . '"></button>';
    }
    ?>



    <!-- Conteneur de l'image -->
    <div class="lightbox__container">
        <img alt="">
    </div>
</div>

<?php
// Récupérer les URLs des images en taille d'origine à partir du custom post type "photos"
$args = array(
    'post_type' => 'photos',
    'posts_per_page' => -1, // Récupérer toutes les images
    // Ajoutez d'autres arguments de requête si nécessaire
);

$query = new WP_Query($args);

$image_urls = array();
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
        $image_urls[] = $image_url;
    }

// Ajoute l'instruction var_dump ici pour afficher les URLs récupérées
// var_dump($image_urls);

}

wp_reset_postdata();
?>

<script>
    // Stocker les URLs des images dans un tableau JavaScript
    const imageUrls = <?php echo json_encode($image_urls); ?>;
</script>


