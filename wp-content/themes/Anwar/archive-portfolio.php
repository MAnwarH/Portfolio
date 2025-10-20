<?php
/**
 * Portfolio Archive Template
 *
 * @package Anwar
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title" data-aos="fade-up"><?php esc_html_e('Portfolio', 'anwar'); ?></h1>
            <p class="page-description" data-aos="fade-up" data-aos-delay="100">
                <?php esc_html_e('Browse through my latest WordPress projects and case studies', 'anwar'); ?>
            </p>
        </div>
    </section>

    <!-- Portfolio Filter -->
    <section class="portfolio-filter-section">
        <div class="container">
            <div class="portfolio-filter" data-aos="fade-up">
                <button class="filter-btn active" data-filter="*"><?php esc_html_e('All Projects', 'anwar'); ?></button>
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'portfolio_category',
                    'hide_empty' => true,
                ));

                if (!is_wp_error($categories) && !empty($categories)) :
                    foreach ($categories as $category) :
                ?>
                        <button class="filter-btn" data-filter=".category-<?php echo esc_attr($category->slug); ?>">
                            <?php echo esc_html($category->name); ?>
                        </button>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="portfolio-archive-section section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="portfolio-masonry-grid">
                    <?php
                    while (have_posts()) : the_post();
                        $technologies = get_post_meta(get_the_ID(), '_anwar_portfolio_technologies', true);
                        $project_url = get_post_meta(get_the_ID(), '_anwar_portfolio_url', true);
                        $client = get_post_meta(get_the_ID(), '_anwar_portfolio_client', true);

                        // Get category classes for filtering
                        $terms = get_the_terms(get_the_ID(), 'portfolio_category');
                        $category_classes = '';
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                $category_classes .= ' category-' . $term->slug;
                            }
                        }
                    ?>
                        <div class="portfolio-masonry-item<?php echo esc_attr($category_classes); ?>" data-aos="fade-up">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-card'); ?>>
                                <div class="portfolio-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('anwar-portfolio-thumb', array('alt' => get_the_title())); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/portfolio-placeholder.jpg'); ?>" alt="<?php the_title_attribute(); ?>">
                                        </a>
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

                                <div class="portfolio-content">
                                    <div class="portfolio-meta">
                                        <?php
                                        if ($terms && !is_wp_error($terms)) :
                                            $term_list = array();
                                            foreach ($terms as $term) {
                                                $term_list[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                                            }
                                            echo '<span class="portfolio-categories">' . implode(', ', $term_list) . '</span>';
                                        endif;
                                        ?>
                                        <?php if ($client) : ?>
                                            <span class="portfolio-client"><i class="fas fa-user"></i> <?php echo esc_html($client); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <h2 class="portfolio-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <?php if (has_excerpt()) : ?>
                                        <div class="portfolio-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php endif; ?>

                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        <?php esc_html_e('View Case Study', 'anwar'); ?>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    <?php
                    endwhile;
                    ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper" data-aos="fade-up">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'anwar'),
                        'next_text' => __('Next', 'anwar') . ' <i class="fas fa-chevron-right"></i>',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="no-portfolio" data-aos="fade-up">
                    <i class="fas fa-folder-open"></i>
                    <h3><?php esc_html_e('No Portfolio Items Found', 'anwar'); ?></h3>
                    <p><?php esc_html_e('Check back soon for new projects!', 'anwar'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2><?php esc_html_e('Like What You See?', 'anwar'); ?></h2>
                <p><?php esc_html_e('Let\'s create something amazing together!', 'anwar'); ?></p>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-envelope"></i>
                    <?php esc_html_e('Start Your Project', 'anwar'); ?>
                </a>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php
get_footer();