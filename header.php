<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title><?php bloginfo("name") ?> - <?php bloginfo("description") ?></title>
    <?php wp_head(); ?>
</head>
<body>
<header class="header">   
    <div class="nav-header">
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(bloginfo('template_directory') . '/assets/images/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>">
            </a>
        </div>
        <div class="burger-menu">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/menu_burger_icon.png" alt="Menu Burger">
        </div>
        <div class="close-menu hidden">
            <i class="fas fa-times"></i>
        </div> <!-- Ajout de la balise pour la croix -->
        <?php wp_nav_menu(array( 'theme_location' => 'menu-header' )) ?>
    </div>
</header>






