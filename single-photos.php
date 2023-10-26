<?php get_header(); ?>

<div class="photo-contenu">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
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
                    $categorie = get_field('categorie');
                    if ($categorie) :
                    ?>
                    <p>Catégorie : <?php echo $categorie; ?></p>
                    <?php endif; ?>

                    <?php 
                    $format = get_field('format');
                    if ($format) :
                    ?>
                    <p>Format : <?php echo $format; ?></p>
                    <?php endif; ?>

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
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>





