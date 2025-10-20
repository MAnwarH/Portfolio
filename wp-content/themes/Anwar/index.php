<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package Anwar
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php
                if (is_home()) {
                    echo esc_html(get_the_title(get_option('page_for_posts')));
                } elseif (is_archive()) {
                    the_archive_title();
                } elseif (is_search()) {
                    printf(esc_html__('Search Results for: %s', 'anwar'), '<span>' . get_search_query() . '</span>');
                } else {
                    esc_html_e('Blog', 'anwar');
                }
                ?>
            </h1>
            <?php
            if (is_archive()) {
                the_archive_description('<div class="page-description">', '</div>');
            }
            ?>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="blog-section section">
        <div class="container">
            <div class="blog-layout">

                <!-- Main Content -->
                <div class="blog-main">
                    <?php if (have_posts()) : ?>

                        <div class="blog-grid">
                            <?php
                            while (have_posts()) :
                                the_post();
                            ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="blog-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium_large', array('alt' => get_the_title())); ?>
                                            </a>
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) :
                                            ?>
                                                <span class="blog-category">
                                                    <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                                                        <?php echo esc_html($categories[0]->name); ?>
                                                    </a>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <span class="blog-date">
                                                <i class="fas fa-calendar"></i>
                                                <?php echo get_the_date(); ?>
                                            </span>
                                            <span class="blog-author">
                                                <i class="fas fa-user"></i>
                                                <?php the_author(); ?>
                                            </span>
                                            <span class="blog-comments">
                                                <i class="fas fa-comment"></i>
                                                <?php comments_number('0', '1', '%'); ?>
                                            </span>
                                        </div>

                                        <h2 class="blog-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>

                                        <div class="blog-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>

                                        <a href="<?php the_permalink(); ?>" class="read-more">
                                            <?php esc_html_e('Read More', 'anwar'); ?>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            <?php
                            endwhile;
                            ?>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-wrapper">
                            <?php
                            the_posts_pagination(array(
                                'mid_size'  => 2,
                                'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'anwar'),
                                'next_text' => __('Next', 'anwar') . ' <i class="fas fa-chevron-right"></i>',
                            ));
                            ?>
                        </div>

                    <?php else : ?>

                        <div class="no-posts">
                            <i class="fas fa-inbox"></i>
                            <h3><?php esc_html_e('Nothing Found', 'anwar'); ?></h3>
                            <p>
                                <?php
                                if (is_search()) {
                                    esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'anwar');
                                } else {
                                    esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'anwar');
                                }
                                ?>
                            </p>
                            <?php get_search_form(); ?>
                        </div>

                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <?php if (is_active_sidebar('sidebar-1')) : ?>
                    <aside id="secondary" class="blog-sidebar">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </aside>
                <?php endif; ?>

            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php
get_footer();