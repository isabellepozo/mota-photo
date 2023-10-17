<?php get_header() ?>

    <main id="accueil">
        <?php while (have_posts()) : the_post() ?>

        <article>
            <a href="<?php the_permalink() ?>">
                <?php the_post_thumbnail("medium") ?>
                 <!-- <?php the_post_thumbnail(array(258, 145)) ?> -->
                <h2 class="titre-page"><?php the_title() ?></h2>
            </a>

            <?php the_excerpt() ?>
        </article>

        <?php endwhile ?>
    </main>
    
<?php get_footer() ?>