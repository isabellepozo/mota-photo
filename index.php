<?php get_header() ?>

    <main id="accueil">
        <?php while (have_posts()) : the_post() ?>

        <article>
            <h2><?php the_title() ?></h2>
            <?php the_excerpt() ?>
        </article>

        <?php endwhile ?>
    </main>
    
<?php get_footer() ?>