<?php get_header(); ?>

<div class="photo-details">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="photo-details-content">
                <!-- Div contenant le titre et les informations de la photo -->
                <div class="photo-info">
                    <h1><?php the_title(); ?></h1>
                    <p><?php echo get_field_object('reference')['label']; ?> :
                        <span class="ref-contact"><?php the_field('reference'); ?></span>
                    </p>
                    <p><?php echo get_field_object('categorie')['label']; ?> :
                        <?php the_field('categorie'); ?>
                    </p>
                    <p><?php echo get_field_object('format')['label']; ?> :
                        <?php the_field('format'); ?>
                    </p>
                    <p><?php echo get_field_object('type')['label']; ?> :
                        <?php the_field('type'); ?>
                    </p>
                    <p><?php echo get_field_object('annee')['label']; ?> :
                        <?php the_field('annee'); ?>
                    </p>
                </div>
                <!-- Div contenant la photo -->
                <div class="photo-image">
                    <?php the_post_thumbnail(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>



