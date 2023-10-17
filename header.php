<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php bloginfo("name") ?> - <?php bloginfo("description") ?></title>
    <?php wp_head(); ?>
</head>
<body>
<header class="header">   
    <div class="nav-header">
        <img src="<?php echo esc_url(bloginfo('template_directory') . '/assets/images/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>">
        <?php wp_nav_menu(array( 'theme_location' => 'menu-header' )) ?>
         <h1><?php bloginfo("name") ?></h1>
    </div>
</header>