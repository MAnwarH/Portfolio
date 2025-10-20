<?php
/**
 * Template Name: Services Page
 *
 * @package Anwar
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title" data-aos="fade-up"><?php the_title(); ?></h1>
            <p class="page-description" data-aos="fade-up" data-aos-delay="100">
                <?php echo esc_html(get_theme_mod('anwar_services_subtitle', 'Professional WordPress development services tailored to your needs')); ?>
            </p>
        </div>
    </section>

    <!-- Services Content -->
    <section class="services-section section">
        <div class="container">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    if (get_the_content()) :
            ?>
                <div class="page-content" data-aos="fade-up">
                    <?php the_content(); ?>
                </div>
            <?php
                    endif;
                endwhile;
            endif;
            ?>

            <div class="services-detailed-grid">
                <?php
                $services = array(
                    array(
                        'icon' => 'fas fa-code',
                        'title' => __('Custom WordPress Development', 'anwar'),
                        'description' => __('Building custom WordPress themes and plugins from scratch, tailored to your specific business requirements and brand identity.', 'anwar'),
                        'features' => array(
                            __('Custom theme development', 'anwar'),
                            __('Plugin development', 'anwar'),
                            __('Custom post types & taxonomies', 'anwar'),
                            __('Advanced Custom Fields integration', 'anwar'),
                        ),
                    ),
                    array(
                        'icon' => 'fas fa-paint-brush',
                        'title' => __('Theme & Plugin Customization', 'anwar'),
                        'description' => __('Customizing existing WordPress themes and plugins to perfectly match your needs and enhance functionality.', 'anwar'),
                        'features' => array(
                            __('Theme customization', 'anwar'),
                            __('Plugin modifications', 'anwar'),
                            __('Design implementation', 'anwar'),
                            __('Feature additions', 'anwar'),
                        ),
                    ),
                    array(
                        'icon' => 'fas fa-rocket',
                        'title' => __('Website Speed Optimization', 'anwar'),
                        'description' => __('Optimizing your WordPress website for lightning-fast loading times, better SEO rankings, and improved user experience.', 'anwar'),
                        'features' => array(
                            __('Performance audits', 'anwar'),
                            __('Image optimization', 'anwar'),
                            __('Caching implementation', 'anwar'),
                            __('Database optimization', 'anwar'),
                        ),
                    ),
                    array(
                        'icon' => 'fas fa-search',
                        'title' => __('SEO Setup & Optimization', 'anwar'),
                        'description' => __('Implementing SEO best practices to help your website rank higher in search engines and attract more organic traffic.', 'anwar'),
                        'features' => array(
                            __('On-page SEO optimization', 'anwar'),
                            __('Schema markup implementation', 'anwar'),
                            __('SEO plugin configuration', 'anwar'),
                            __('Site structure optimization', 'anwar'),
                        ),
                    ),
                    array(
                        'icon' => 'fas fa-shopping-cart',
                        'title' => __('eCommerce (WooCommerce)', 'anwar'),
                        'description' => __('Creating powerful online stores with WooCommerce, payment gateway integration, and custom eCommerce features.', 'anwar'),
                        'features' => array(
                            __('WooCommerce setup', 'anwar'),
                            __('Payment gateway integration', 'anwar'),
                            __('Custom product types', 'anwar'),
                            __('Checkout customization', 'anwar'),
                        ),
                    ),
                    array(
                        'icon' => 'fas fa-tools',
                        'title' => __('Website Maintenance & Fixes', 'anwar'),
                        'description' => __('Providing ongoing maintenance, regular updates, security patches, and quick bug fixes to keep your site running smoothly.', 'anwar'),
                        'features' => array(
                            __('Regular updates', 'anwar'),
                            __('Security monitoring', 'anwar'),
                            __('Bug fixes', 'anwar'),
                            __('Backup management', 'anwar'),
                        ),
                    ),
                );

                foreach ($services as $index => $service) :
                ?>
                    <div class="service-detailed-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <div class="service-icon-wrapper">
                            <i class="<?php echo esc_attr($service['icon']); ?>"></i>
                        </div>
                        <div class="service-content">
                            <h3 class="service-title"><?php echo esc_html($service['title']); ?></h3>
                            <p class="service-description"><?php echo esc_html($service['description']); ?></p>
                            <ul class="service-features">
                                <?php foreach ($service['features'] as $feature) : ?>
                                    <li><i class="fas fa-check"></i> <?php echo esc_html($feature); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-secondary">
                                <?php esc_html_e('Get Started', 'anwar'); ?>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('My Work Process', 'anwar'); ?></h2>
                <p><?php esc_html_e('How I bring your WordPress project to life', 'anwar'); ?></p>
            </div>

            <div class="process-grid">
                <?php
                $process_steps = array(
                    array(
                        'number' => '01',
                        'title' => __('Discovery', 'anwar'),
                        'description' => __('Understanding your requirements, goals, and target audience.', 'anwar'),
                        'icon' => 'fas fa-comments',
                    ),
                    array(
                        'number' => '02',
                        'title' => __('Planning', 'anwar'),
                        'description' => __('Creating a detailed project plan with timelines and deliverables.', 'anwar'),
                        'icon' => 'fas fa-tasks',
                    ),
                    array(
                        'number' => '03',
                        'title' => __('Development', 'anwar'),
                        'description' => __('Building your website with clean code and best practices.', 'anwar'),
                        'icon' => 'fas fa-laptop-code',
                    ),
                    array(
                        'number' => '04',
                        'title' => __('Testing', 'anwar'),
                        'description' => __('Thoroughly testing functionality, performance, and compatibility.', 'anwar'),
                        'icon' => 'fas fa-check-double',
                    ),
                    array(
                        'number' => '05',
                        'title' => __('Launch', 'anwar'),
                        'description' => __('Deploying your website and ensuring everything works perfectly.', 'anwar'),
                        'icon' => 'fas fa-rocket',
                    ),
                    array(
                        'number' => '06',
                        'title' => __('Support', 'anwar'),
                        'description' => __('Providing ongoing support and maintenance as needed.', 'anwar'),
                        'icon' => 'fas fa-headset',
                    ),
                );

                foreach ($process_steps as $index => $step) :
                ?>
                    <div class="process-step" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <div class="step-number"><?php echo esc_html($step['number']); ?></div>
                        <div class="step-icon">
                            <i class="<?php echo esc_attr($step['icon']); ?>"></i>
                        </div>
                        <h3 class="step-title"><?php echo esc_html($step['title']); ?></h3>
                        <p class="step-description"><?php echo esc_html($step['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Pricing / Packages Section -->
    <section class="packages-section section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('Service Packages', 'anwar'); ?></h2>
                <p><?php esc_html_e('Choose the package that fits your needs', 'anwar'); ?></p>
            </div>

            <div class="packages-grid">
                <?php
                $packages = array(
                    array(
                        'name' => __('Starter', 'anwar'),
                        'price' => '$500',
                        'period' => __('per project', 'anwar'),
                        'features' => array(
                            __('Basic WordPress setup', 'anwar'),
                            __('Theme installation & customization', 'anwar'),
                            __('Up to 5 pages', 'anwar'),
                            __('Responsive design', 'anwar'),
                            __('Basic SEO setup', 'anwar'),
                            __('1 month support', 'anwar'),
                        ),
                        'popular' => false,
                    ),
                    array(
                        'name' => __('Professional', 'anwar'),
                        'price' => '$1,500',
                        'period' => __('per project', 'anwar'),
                        'features' => array(
                            __('Custom theme development', 'anwar'),
                            __('Up to 15 pages', 'anwar'),
                            __('Advanced functionality', 'anwar'),
                            __('Performance optimization', 'anwar'),
                            __('SEO optimization', 'anwar'),
                            __('3 months support', 'anwar'),
                        ),
                        'popular' => true,
                    ),
                    array(
                        'name' => __('Enterprise', 'anwar'),
                        'price' => '$3,000+',
                        'period' => __('per project', 'anwar'),
                        'features' => array(
                            __('Custom theme & plugin development', 'anwar'),
                            __('Unlimited pages', 'anwar'),
                            __('eCommerce integration', 'anwar'),
                            __('Advanced features', 'anwar'),
                            __('Full SEO & performance optimization', 'anwar'),
                            __('6 months support', 'anwar'),
                        ),
                        'popular' => false,
                    ),
                );

                foreach ($packages as $index => $package) :
                ?>
                    <div class="package-card <?php echo $package['popular'] ? 'popular' : ''; ?>" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <?php if ($package['popular']) : ?>
                            <span class="package-badge"><?php esc_html_e('Most Popular', 'anwar'); ?></span>
                        <?php endif; ?>
                        <h3 class="package-name"><?php echo esc_html($package['name']); ?></h3>
                        <div class="package-price">
                            <span class="price"><?php echo esc_html($package['price']); ?></span>
                            <span class="period"><?php echo esc_html($package['period']); ?></span>
                        </div>
                        <ul class="package-features">
                            <?php foreach ($package['features'] as $feature) : ?>
                                <li><i class="fas fa-check"></i> <?php echo esc_html($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn <?php echo $package['popular'] ? 'btn-primary' : 'btn-secondary'; ?> btn-block">
                            <?php esc_html_e('Get Started', 'anwar'); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <p class="packages-note" data-aos="fade-up">
                <?php esc_html_e('*Prices are indicative and may vary based on project complexity. Contact me for a custom quote.', 'anwar'); ?>
            </p>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2><?php esc_html_e('Ready to Start Your Project?', 'anwar'); ?></h2>
                <p><?php esc_html_e('Let\'s discuss your requirements and bring your vision to life!', 'anwar'); ?></p>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-envelope"></i>
                    <?php esc_html_e('Get In Touch', 'anwar'); ?>
                </a>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php
get_footer();