<?php
/**
 * Front Page Template
 *
 * @package Anwar
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="hero-greeting" data-aos="fade-up">
                        <?php echo esc_html(get_theme_mod('anwar_hero_greeting', 'Hi, I\'m Anwar')); ?>
                    </span>
                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                        <?php echo wp_kses_post(get_theme_mod('anwar_hero_title', 'I Build Fast, Secure & Scalable <span class="highlight">WordPress Websites</span>')); ?>
                    </h1>
                    <p class="hero-description" data-aos="fade-up" data-aos-delay="200">
                        <?php echo esc_html(get_theme_mod('anwar_hero_description', 'Full-stack WordPress developer with 5+ years of experience creating custom themes, plugins, and high-performance websites.')); ?>
                    </p>

                    <div class="hero-cta" data-aos="fade-up" data-aos-delay="300">
                        <a href="#portfolio" class="btn btn-primary">
                            <i class="fas fa-briefcase"></i>
                            <?php esc_html_e('View My Work', 'anwar'); ?>
                        </a>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-secondary">
                            <i class="fas fa-envelope"></i>
                            <?php esc_html_e('Get a Quote', 'anwar'); ?>
                        </a>
                    </div>

                    <!-- Trust Elements -->
                    <div class="hero-trust" data-aos="fade-up" data-aos-delay="400">
                        <div class="trust-item">
                            <i class="fas fa-check-circle"></i>
                            <span><?php echo esc_html(get_theme_mod('anwar_trust_text', 'Worked with 50+ clients worldwide')); ?></span>
                        </div>
                    </div>
                </div>

                <div class="hero-image" data-aos="fade-left" data-aos-delay="200">
                    <?php
                    $hero_image = get_theme_mod('anwar_hero_image', get_template_directory_uri() . '/assets/images/me.jpg');
                    ?>
                    <div class="hero-image-wrapper">
                        <img src="<?php echo esc_url($hero_image); ?>" alt="<?php esc_attr_e('Hero Image', 'anwar'); ?>">
                        <!-- Floating elements -->
                        <div class="floating-element element-1">
                            <i class="fab fa-wordpress"></i>
                        </div>
                        <div class="floating-element element-2">
                            <i class="fab fa-php"></i>
                        </div>
                        <div class="floating-element element-3">
                            <i class="fab fa-js"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="scroll-indicator">
            <a href="#stats" class="scroll-down">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section" id="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item" data-aos="fade-up">
                    <div class="stat-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <div class="stat-number" data-count="<?php echo esc_attr(get_theme_mod('anwar_stat_websites', '150')); ?>">0</div>
                    <div class="stat-label"><?php esc_html_e('Websites Built', 'anwar'); ?></div>
                </div>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" data-count="<?php echo esc_attr(get_theme_mod('anwar_stat_clients', '50')); ?>">0</div>
                    <div class="stat-label"><?php esc_html_e('Happy Clients', 'anwar'); ?></div>
                </div>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="stat-number" data-count="<?php echo esc_attr(get_theme_mod('anwar_stat_plugins', '25')); ?>">0</div>
                    <div class="stat-label"><?php esc_html_e('Plugins Customized', 'anwar'); ?></div>
                </div>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-number" data-count="<?php echo esc_attr(get_theme_mod('anwar_stat_years', '5')); ?>">0</div>
                    <div class="stat-label"><?php esc_html_e('Years Experience', 'anwar'); ?></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview Section -->
    <section class="services-preview section" id="services">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('What I Do', 'anwar'); ?></h2>
                <p><?php esc_html_e('Professional WordPress development services tailored to your needs', 'anwar'); ?></p>
            </div>

            <div class="services-grid grid grid-3">
                <?php
                $services = array(
                    array(
                        'icon' => 'fas fa-code',
                        'title' => __('Custom WordPress Development', 'anwar'),
                        'description' => __('Building custom WordPress themes and plugins from scratch tailored to your specific requirements.', 'anwar'),
                    ),
                    array(
                        'icon' => 'fas fa-paint-brush',
                        'title' => __('Theme & Plugin Customization', 'anwar'),
                        'description' => __('Customizing existing themes and plugins to match your brand and functionality needs.', 'anwar'),
                    ),
                    array(
                        'icon' => 'fas fa-rocket',
                        'title' => __('Website Speed Optimization', 'anwar'),
                        'description' => __('Optimizing your WordPress site for lightning-fast loading times and better user experience.', 'anwar'),
                    ),
                    array(
                        'icon' => 'fas fa-search',
                        'title' => __('SEO Setup & Optimization', 'anwar'),
                        'description' => __('Implementing SEO best practices to help your website rank higher in search engines.', 'anwar'),
                    ),
                    array(
                        'icon' => 'fas fa-shopping-cart',
                        'title' => __('eCommerce (WooCommerce)', 'anwar'),
                        'description' => __('Creating powerful online stores with WooCommerce, payment gateways, and custom features.', 'anwar'),
                    ),
                    array(
                        'icon' => 'fas fa-tools',
                        'title' => __('Website Maintenance & Fixes', 'anwar'),
                        'description' => __('Providing ongoing maintenance, updates, security patches, and quick bug fixes.', 'anwar'),
                    ),
                );

                foreach ($services as $index => $service) :
                ?>
                    <div class="service-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <div class="service-icon">
                            <i class="<?php echo esc_attr($service['icon']); ?>"></i>
                        </div>
                        <h3 class="service-title"><?php echo esc_html($service['title']); ?></h3>
                        <p class="service-description"><?php echo esc_html($service['description']); ?></p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('services'))); ?>" class="service-link">
                            <?php esc_html_e('Learn More', 'anwar'); ?>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="section-cta" data-aos="fade-up">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary">
                    <?php esc_html_e('Hire Me for Your Project', 'anwar'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Portfolio Preview Section -->
    <section class="portfolio-preview section" id="portfolio">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('Recent Projects', 'anwar'); ?></h2>
                <p><?php esc_html_e('Check out some of my latest WordPress projects', 'anwar'); ?></p>
            </div>

            <div class="portfolio-grid grid grid-3">
                <?php
                $portfolio_query = new WP_Query(array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                if ($portfolio_query->have_posts()) :
                    $delay = 0;
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        $technologies = get_post_meta(get_the_ID(), '_anwar_portfolio_technologies', true);
                        $project_url = get_post_meta(get_the_ID(), '_anwar_portfolio_url', true);
                ?>
                    <div class="portfolio-item" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <div class="portfolio-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('anwar-portfolio-thumb', array('alt' => get_the_title())); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/portfolio-placeholder.jpg'); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-content">
                                    <h3><?php the_title(); ?></h3>
                                    <?php if ($technologies) : ?>
                                        <p class="portfolio-tech"><?php echo esc_html($technologies); ?></p>
                                    <?php endif; ?>
                                    <div class="portfolio-links">
                                        <a href="<?php the_permalink(); ?>" class="portfolio-link" aria-label="<?php esc_attr_e('View Case Study', 'anwar'); ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if ($project_url) : ?>
                                            <a href="<?php echo esc_url($project_url); ?>" target="_blank" rel="noopener" class="portfolio-link" aria-label="<?php esc_attr_e('View Live Site', 'anwar'); ?>">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                        $delay += 100;
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p><?php esc_html_e('No portfolio items found. Add some to showcase your work!', 'anwar'); ?></p>
                <?php endif; ?>
            </div>

            <div class="section-cta" data-aos="fade-up">
                <a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>" class="btn btn-secondary">
                    <?php esc_html_e('View All Projects', 'anwar'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('Client Testimonials', 'anwar'); ?></h2>
                <p><?php esc_html_e('What my clients say about working with me', 'anwar'); ?></p>
            </div>

            <div class="testimonials-slider">
                <?php
                $testimonials_query = new WP_Query(array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                if ($testimonials_query->have_posts()) :
                ?>
                    <div class="testimonials-grid grid grid-3">
                        <?php
                        $delay = 0;
                        while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
                            $company = get_post_meta(get_the_ID(), '_anwar_testimonial_company', true);
                            $position = get_post_meta(get_the_ID(), '_anwar_testimonial_position', true);
                            $rating = get_post_meta(get_the_ID(), '_anwar_testimonial_rating', true);
                        ?>
                            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                                <div class="testimonial-rating">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fas fa-star"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="testimonial-content">
                                    <?php the_content(); ?>
                                </div>
                                <div class="testimonial-author">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="author-image">
                                            <?php the_post_thumbnail('anwar-testimonial', array('alt' => get_the_title())); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="author-info">
                                        <h4 class="author-name"><?php the_title(); ?></h4>
                                        <?php if ($position || $company) : ?>
                                            <p class="author-position">
                                                <?php
                                                if ($position && $company) {
                                                    echo esc_html($position . ' at ' . $company);
                                                } elseif ($position) {
                                                    echo esc_html($position);
                                                } else {
                                                    echo esc_html($company);
                                                }
                                                ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $delay += 100;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                <?php
                else :
                ?>
                    <p class="text-center"><?php esc_html_e('No testimonials yet. Add client feedback to build trust!', 'anwar'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2><?php echo esc_html(get_theme_mod('anwar_cta_title', 'Ready to Start Your Project?')); ?></h2>
                <p><?php echo esc_html(get_theme_mod('anwar_cta_description', 'Let\'s work together to bring your WordPress project to life!')); ?></p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-envelope"></i>
                        <?php esc_html_e('Get In Touch', 'anwar'); ?>
                    </a>
                    <?php
                    $resume_url = get_theme_mod('anwar_resume_url', '');
                    if ($resume_url) :
                    ?>
                        <a href="<?php echo esc_url($resume_url); ?>" class="btn btn-secondary btn-lg" download>
                            <i class="fas fa-download"></i>
                            <?php esc_html_e('Download Resume', 'anwar'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php
get_footer();