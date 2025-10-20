<?php
/**
 * Single Portfolio Template (Case Study)
 *
 * @package Anwar
 */

get_header();

while (have_posts()) : the_post();

    $client = get_post_meta(get_the_ID(), '_anwar_portfolio_client', true);
    $project_url = get_post_meta(get_the_ID(), '_anwar_portfolio_url', true);
    $technologies = get_post_meta(get_the_ID(), '_anwar_portfolio_technologies', true);
    $completion_date = get_post_meta(get_the_ID(), '_anwar_portfolio_date', true);
?>

<main id="primary" class="site-main single-portfolio">

    <!-- Project Header -->
    <section class="project-header">
        <div class="container">
            <div class="project-header-content">
                <div class="project-header-text" data-aos="fade-right">
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'portfolio_category');
                    if ($terms && !is_wp_error($terms)) :
                    ?>
                        <div class="project-categories">
                            <?php foreach ($terms as $term) : ?>
                                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="project-category">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="project-title"><?php the_title(); ?></h1>

                    <?php if (has_excerpt()) : ?>
                        <div class="project-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>

                    <div class="project-meta-list">
                        <?php if ($client) : ?>
                            <div class="project-meta-item">
                                <i class="fas fa-user"></i>
                                <div>
                                    <span class="meta-label"><?php esc_html_e('Client', 'anwar'); ?></span>
                                    <span class="meta-value"><?php echo esc_html($client); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($completion_date) : ?>
                            <div class="project-meta-item">
                                <i class="fas fa-calendar"></i>
                                <div>
                                    <span class="meta-label"><?php esc_html_e('Completed', 'anwar'); ?></span>
                                    <span class="meta-value"><?php echo esc_html($completion_date); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($technologies) : ?>
                            <div class="project-meta-item">
                                <i class="fas fa-code"></i>
                                <div>
                                    <span class="meta-label"><?php esc_html_e('Technologies', 'anwar'); ?></span>
                                    <span class="meta-value"><?php echo esc_html($technologies); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($project_url) : ?>
                        <div class="project-actions">
                            <a href="<?php echo esc_url($project_url); ?>" target="_blank" rel="noopener" class="btn btn-primary">
                                <i class="fas fa-external-link-alt"></i>
                                <?php esc_html_e('View Live Site', 'anwar'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="project-header-image" data-aos="fade-left">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Content -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('project-content-section section'); ?>>
        <div class="container">
            <div class="project-content-wrapper">

                <!-- Main Content -->
                <div class="project-main-content" data-aos="fade-up">
                    <?php the_content(); ?>
                </div>

                <!-- Project Sidebar -->
                <aside class="project-sidebar" data-aos="fade-up" data-aos-delay="100">
                    <!-- Project Info Box -->
                    <div class="sidebar-box project-info-box">
                        <h3><?php esc_html_e('Project Information', 'anwar'); ?></h3>
                        <ul class="project-info-list">
                            <?php if ($client) : ?>
                                <li>
                                    <strong><?php esc_html_e('Client:', 'anwar'); ?></strong>
                                    <span><?php echo esc_html($client); ?></span>
                                </li>
                            <?php endif; ?>

                            <?php if ($completion_date) : ?>
                                <li>
                                    <strong><?php esc_html_e('Date:', 'anwar'); ?></strong>
                                    <span><?php echo esc_html($completion_date); ?></span>
                                </li>
                            <?php endif; ?>

                            <?php
                            if ($terms && !is_wp_error($terms)) :
                            ?>
                                <li>
                                    <strong><?php esc_html_e('Category:', 'anwar'); ?></strong>
                                    <span>
                                        <?php
                                        $term_names = array();
                                        foreach ($terms as $term) {
                                            $term_names[] = $term->name;
                                        }
                                        echo esc_html(implode(', ', $term_names));
                                        ?>
                                    </span>
                                </li>
                            <?php endif; ?>

                            <?php if ($project_url) : ?>
                                <li>
                                    <strong><?php esc_html_e('Website:', 'anwar'); ?></strong>
                                    <span><a href="<?php echo esc_url($project_url); ?>" target="_blank" rel="noopener"><?php esc_html_e('Visit Site', 'anwar'); ?></a></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Technologies Box -->
                    <?php if ($technologies) : ?>
                        <div class="sidebar-box technologies-box">
                            <h3><?php esc_html_e('Technologies Used', 'anwar'); ?></h3>
                            <div class="tech-tags">
                                <?php
                                $tech_array = array_map('trim', explode(',', $technologies));
                                foreach ($tech_array as $tech) :
                                ?>
                                    <span class="tech-tag"><?php echo esc_html($tech); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Share Box -->
                    <div class="sidebar-box share-box">
                        <h3><?php esc_html_e('Share This Project', 'anwar'); ?></h3>
                        <div class="share-buttons">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="share-btn twitter" aria-label="Share on Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="share-btn facebook" aria-label="Share on Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="share-btn linkedin" aria-label="Share on LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="share-btn email" aria-label="Share via Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>

                    <!-- CTA Box -->
                    <div class="sidebar-box cta-box">
                        <h3><?php esc_html_e('Have a Project?', 'anwar'); ?></h3>
                        <p><?php esc_html_e('Let\'s work together to create something amazing!', 'anwar'); ?></p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary btn-block">
                            <?php esc_html_e('Get In Touch', 'anwar'); ?>
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </article>

    <!-- Related Projects -->
    <?php
    $related_args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID()),
        'orderby' => 'rand',
    );

    // Get related by category if available
    if ($terms && !is_wp_error($terms)) {
        $term_ids = array();
        foreach ($terms as $term) {
            $term_ids[] = $term->term_id;
        }
        $related_args['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'term_id',
                'terms' => $term_ids,
            ),
        );
    }

    $related_query = new WP_Query($related_args);

    if ($related_query->have_posts()) :
    ?>
        <section class="related-projects-section section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2><?php esc_html_e('Related Projects', 'anwar'); ?></h2>
                    <p><?php esc_html_e('Check out more of my work', 'anwar'); ?></p>
                </div>

                <div class="related-projects-grid grid grid-3">
                    <?php
                    $delay = 0;
                    while ($related_query->have_posts()) : $related_query->the_post();
                        $related_tech = get_post_meta(get_the_ID(), '_anwar_portfolio_technologies', true);
                        $related_url = get_post_meta(get_the_ID(), '_anwar_portfolio_url', true);
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
                                        <?php if ($related_tech) : ?>
                                            <p class="portfolio-tech"><?php echo esc_html($related_tech); ?></p>
                                        <?php endif; ?>
                                        <div class="portfolio-links">
                                            <a href="<?php the_permalink(); ?>" class="portfolio-link" aria-label="<?php esc_attr_e('View Case Study', 'anwar'); ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if ($related_url) : ?>
                                                <a href="<?php echo esc_url($related_url); ?>" target="_blank" rel="noopener" class="portfolio-link" aria-label="<?php esc_attr_e('View Live Site', 'anwar'); ?>">
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
                    ?>
                </div>

                <div class="section-cta" data-aos="fade-up">
                    <a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>" class="btn btn-secondary">
                        <?php esc_html_e('View All Projects', 'anwar'); ?>
                    </a>
                </div>
            </div>
        </section>
    <?php
    endif;
    ?>

    <!-- Project Navigation -->
    <nav class="project-navigation">
        <div class="container">
            <div class="nav-links">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>

                <?php if ($prev_post) : ?>
                    <div class="nav-previous" data-aos="fade-right">
                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                            <span class="nav-subtitle">
                                <i class="fas fa-arrow-left"></i>
                                <?php esc_html_e('Previous Project', 'anwar'); ?>
                            </span>
                            <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="nav-grid" data-aos="zoom-in">
                    <a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>" class="back-to-portfolio" aria-label="<?php esc_attr_e('Back to Portfolio', 'anwar'); ?>">
                        <i class="fas fa-th"></i>
                    </a>
                </div>

                <?php if ($next_post) : ?>
                    <div class="nav-next" data-aos="fade-left">
                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                            <span class="nav-subtitle">
                                <?php esc_html_e('Next Project', 'anwar'); ?>
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

</main><!-- #primary -->

<?php
endwhile;
get_footer();