<footer>
        <div class='footer'>
            
            <?php wp_nav_menu( array( 
                'theme_location' => 'menu-footer' )) ?>
        </div>
        </footer>
        <?php get_template_part('templates_part/modal-contact');?>
        <?php get_template_part('templates_part/lightbox-template'); ?>
<?php wp_footer(); ?>
    </body>
</html>