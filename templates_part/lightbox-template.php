<!-- Lightbox-template -->
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
        $next_image_url = wp_get_attachment_image_src($next_image_id, 'full');
        if ($next_image_url) {
            $next_image_url = $next_image_url[0];
        }
        
        echo '<button class="lightbox__next" data-image-url="' . $next_image_url . '"></button>';
    }
    ?>


    <!-- Conteneur de l'image -->
    <div class="lightbox__container">
        <img alt="">
        <!-- Div pour afficher les métadonnées -->
        <div class="lightbox__metadata">
            <p class="lightbox__reference"></p>
            <p class="lightbox__category"></p>
        </div>
    </div>
</div>

<?php
// Récupérer les données des images à partir du custom post type "photos"
$args = array(
    'post_type' => 'photos',
    'posts_per_page' => -1, // Récupérer toutes les images
);

$query = new WP_Query($args);

$image_data = array(); // Initialisation du tableau pour stocker les données des images
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
        $reference = get_post_meta(get_the_ID(), 'reference', true); // Récupérer la référence de la photo
        $categories = get_the_terms(get_the_ID(), 'categorie'); // Récupérer les catégories de la photo

        // Stocker les données dans le tableau pour chaque image
        $image_data[] = array(
            'url' => $image_url,
            'reference' => $reference,
            'categories' => $categories,
        );
    }
}

wp_reset_postdata();
?>

<script>
    // Stocker les données des images dans un tableau JavaScript
    const imageData = <?php echo json_encode($image_data); ?>;
</script>
