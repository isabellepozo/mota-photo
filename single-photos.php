<?php get_header(); ?>

<div class="photo-contenu">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="photo-section">       
                <article class="photo-contenu-infos">
                    <!-- Titre et informations sur la photo -->
                    <div class="photo-infos">
                        <h2><?php the_title(); ?></h2>

                        <?php 
                        $reference = get_field('reference');
                        if ($reference) :
                        ?>
                        <p>Référence : <?php echo $reference; ?></p>
                        <?php endif; ?>

                        <?php 
                        $categories = get_the_terms(get_the_ID(), 'categorie');
                        if ($categories) {
                            $categorie = reset($categories);
                            echo '<p>Catégorie : ' . $categorie->name . '</p>';
                        } else {
                            echo '<p>Catégorie : Non défini</p>';
                        }
                        ?>

                        <?php 
                        $formats = get_the_terms(get_the_ID(), 'format');
                        if ($formats) {
                            $format = reset($formats);
                            echo '<p>Format : ' . $format->name . '</p>';
                        } else {
                            echo '<p>Format : Non défini</p>';
                        }
                        ?>       
                        
                        <?php 
                        $type = get_field('type');
                        if ($type) :
                        ?>
                        <p>Type : <?php echo $type; ?></p>
                        <?php endif; ?>

                        <?php 
                        $annee = get_field('annee');
                        if ($annee) :
                        ?>
                        <p>Année : <?php echo $annee; ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Photo -->
                    <div class="image-photo">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </article>

<!-- *********************************** Partie milieu ********************************** -->
<div class="photo-milieu">
    <div id="texte-bouton">  
        <div class="texte-gauche">
            <p>Cette photo vous intéresse ?</p>
        </div>
        <div class="bouton-contact">
            <a href="#contactForm">Contact</a>
        </div>
    </div>
    
    <div class="photo-fleches">
        <div class="image-container">
        </div>
        <div class="fleches">
            <div class="fleche-gauche">
            <?php
            $previous_post = get_previous_post();
            if ($previous_post) {
                $previous_post_link = get_permalink($previous_post);
                $previous_image_url = get_the_post_thumbnail_url($previous_post->ID, 'thumbnail_80x70');
                echo '<a class="lien-image-precedente" href="' . $previous_post_link . '" data-image-url="' . $previous_image_url . '"><img src="http://localhost/motaphoto/wp-content/themes/mota-photo/assets/images/line6.png" alt="Précédent"></a>';
            }
            ?>
            </div>

            <div class="fleche-droite">
            <?php
            $next_post = get_next_post();
            if ($next_post) {
                $next_post_link = get_permalink($next_post);
                $next_image_url = get_the_post_thumbnail_url($next_post->ID, 'thumbnail_80x70');
                echo '<a class="lien-image-suivante" href="' . $next_post_link . '" data-image-url="' . $next_image_url . '"><img src="http://localhost/motaphoto/wp-content/themes/mota-photo/assets/images/line7.png" alt="Suivant"></a>';
            }
            ?>
            </div>   
        </div>
    </div>

    <?php endwhile; ?>
    <?php endif; ?>
</div>

 <!-- *********************************** Partie du bas *********************************** -->
<div class="related-photos-container">
    <p class="related-photos-title">Vous aimerez aussi</p>
    <div class="related-photos-grid">
        <?php
            // Récupérer les catégories de la photo courante
            $categories = get_the_terms(get_the_ID(), 'categorie');
            if ($categories && !is_wp_error($categories)) {
                $category_ids = wp_list_pluck($categories, 'term_id');

                // Définir les arguments de la requête pour obtenir des photos similaires
                $args = array(
                    'post_type' => 'photos',
                    'posts_per_page' => 2,
                    'orderby' => 'rand',
                    'post__not_in' => array(get_the_ID()), // Exclure la photo courante
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categorie',
                            'field' => 'term_id',
                            'terms' => $category_ids,
                        ),
                    ),
                );

                // Exécuter la requête
                $photos_query = new WP_Query($args);

                if ($photos_query->have_posts()) {
                    while ($photos_query->have_posts()) {
                        $photos_query->the_post();
                        ?>
                        <div class="related-photo">
                            <!-- Lien vers la page de la photo -->
                            <a href="<?php the_permalink(); ?>" class="related-photo-link">
                                <?php the_post_thumbnail('thumbnail', array('class' => 'related-photo-thumbnail')); ?>
                            </a>
                            <div class="related-photo-overlay">
                                <!-- Lien vers les infos détaillées de la photo -->
                                <a href="<?php the_permalink(); ?>" class="related-photo-info"><i class="fa fa-eye"></i></a>
                                <!-- Lien pour ouvrir la photo dans une lightbox -->
                                <a href="#" class="open-lightbox related-photo-lightbox" data-image-url="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata(); // Réinitialise les données des requêtes WordPress
                }
            }
        ?>
    </div>
</div>

<?php get_footer(); ?>



