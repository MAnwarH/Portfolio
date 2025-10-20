<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-theme="light">

<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'anwar'); ?></a>

    <!-- Header -->
    <header id="masthead" class="site-header">
        <nav class="main-navigation">
            <div class="container">
                <div class="nav-wrapper">
                    <!-- Logo -->
                    <div class="site-branding">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Primary Navigation -->
                    <div class="nav-menu-wrapper">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'nav-menu',
                            'container'      => false,
                            'fallback_cb'    => false,
                        ));
                        ?>
                    </div>

                    <!-- Header Actions -->
                    <div class="header-actions">
                        <!-- Dark Mode Toggle -->
                        <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode">
                            <i class="fas fa-moon" id="theme-toggle-dark-icon"></i>
                            <i class="fas fa-sun" id="theme-toggle-light-icon" style="display: none;"></i>
                        </button>

                        <!-- CTA Button -->
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary hire-me-btn">
                            <?php esc_html_e('Hire Me', 'anwar'); ?>
                        </a>

                        <!-- Mobile Menu Toggle -->
                        <button class="mobile-menu-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <div class="mobile-menu-inner">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-primary-menu',
                    'menu_class'     => 'mobile-nav-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
                <div class="mobile-menu-cta">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary btn-block">
                        <?php esc_html_e('Hire Me', 'anwar'); ?>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Floating Hire Me Button -->
    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="floating-hire-btn" aria-label="Hire Me">
        <i class="fas fa-envelope"></i>
        <span><?php esc_html_e("Let's Talk", 'anwar'); ?></span>
    </a>

    <div id="content" class="site-content">