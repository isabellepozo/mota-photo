<?php
/**
 * Template Name: Page d'accueil
 */

get_header(); ?>

<body>
    <main>

    <section class="hero">
        <div class="image-banner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/image-banner.jpeg');"></div>
        
        <div class="hero-content">
            <h1 class="hero-title">PHOTOGRAPHE EVENT</h1>
        </div>
    </section>

    <!-- Ajout des champs de filtre -->
<section class="filter-section">
    <div class="filter-category-style">
        <select id="category-filter" name="category">
            <option value="all">CATÉGORIE</option>
            <!-- Les options de catégorie seront ajoutées dynamiquement ici -->
        </select>
    </div>
    <div class="filter-format-style">
        <select id="format-filter" name="format">
            <option value="all">FORMAT</option>
            <!-- Les options de format seront ajoutées dynamiquement ici -->
        </select>
    </div>
    <div class="filter-sort-style">
        <select id="sort-filter" name="sort">
            <option value="newest">TRIER PAR</option>
            <option value="oldest">TRIER PAR</option>
        </select>
    </div>
</section>




<section class="accueil-contenu">
    <div class="related-photos-grid">
        <?php
        // Obtenez l'index de page actuel, en commençant par 1
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        // Définir les arguments de la requête pour obtenir des photos paginées
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 8, // Nombre de photos à afficher par page
            'paged' => $page, // Pagination
        );

        // Exécuter la requête
        $photos_query = new WP_Query($args);

        // Vérifier si des photos sont disponibles
        if ($photos_query->have_posts()) {
            // Boucle sur chaque photo
            while ($photos_query->have_posts()) {
                $photos_query->the_post();
        ?>
        <div class="related-photo">
            <!-- Lien vers la page de la photo -->
            <a href="<?php the_permalink(); ?>" class="related-photo-link">
                <?php
                // Récupérer l'URL de l'image en taille réelle
                $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                // Afficher l'image
                echo '<img src="' . esc_url($full_image_url[0]) . '" class="related-photo-thumbnail" alt="' . get_the_title() . '">';
                ?>
            </a>
            <div class="related-photo-overlay">
                <!-- Lien vers les infos détaillées de la photo -->
                <a href="<?php the_permalink(); ?>" class="related-photo-info"><img src="<?php echo esc_url(bloginfo('template_directory') . '/assets/images/icon_eye.png'); ?>" class="icon_eye" alt="Icon en forme d'oeil"></a>
                <!-- Lien pour ouvrir la photo dans une lightbox -->
                <a href="#" class="open-lightbox related-photo-lightbox" data-image-url="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>"><img src="<?php echo esc_url(bloginfo('template_directory') . '/assets/images/icon_fullscreen.png'); ?>" class="icon_fullscreen" alt="Icon plein écran"></a>
            </div>
        </div>
        <?php
            }
            wp_reset_postdata(); // Réinitialise les données des requêtes WordPress
        }
        ?>
    </div>
    <div class="load-more-container">
        <button class="load-more-button" data-page="<?php echo esc_attr($page + 1); ?>">Charger plus</button>
    </div>
</section>


</main><!-- #primary -->
</body>
<?php get_footer(); ?>
