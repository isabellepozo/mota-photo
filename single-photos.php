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

    <!-- Nouvelle section pour le milieu -->
<div class="photo-milieu">
    <div id="texte-bouton">  
        <div class="texte-gauche">
            <p>Cette photo vous intéresse ?</p>
        </div>
        <div class="bouton-contact">
            <a href="#">Contact</a>
        </div>
    </div>

    <!-- <div class="arrow-container"> -->
    <div class="photo-fleches">
        <div class="image-container">
            <?php
            $current_post = get_post();
            echo '<div class="current-thumbnail">' . get_the_post_thumbnail($current_post->ID, 'thumbnail') . '</div>';
            ?>
        </div>
        <div class="fleches">
            <div class="fleche-gauche">
                <?php
                $previous_post = get_previous_post();
                if ($previous_post) {
                    $previous_post_link = get_permalink($previous_post);
                    echo '<a href="' . $previous_post_link . '"><img src="' . get_template_directory_uri() . '/assets/images/line6.png" alt="Précédent"></a>';
                }
                ?>
            </div>
            <div class="fleche-droite">
                <?php
                $next_post = get_next_post();
                if ($next_post) {
                    $next_post_link = get_permalink($next_post);
                    echo '<a href="' . $next_post_link . '"><img src="' . get_template_directory_uri() . '/assets/images/line7.png" alt="Suivant"></a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

 











        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>





