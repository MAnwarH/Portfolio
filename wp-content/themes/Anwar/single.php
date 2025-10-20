<?php
/**
 * The template for displaying all single posts
 *
 * @package Anwar
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
    ?>

        <!-- Page Header -->
        <section class="page-header">
            <div class="container">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                ?>
                    <div class="post-categories">
                        <?php foreach ($categories as $category) : ?>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="post-category">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <h1 class="page-title"><?php the_title(); ?></h1>

                <div class="post-meta">
                    <span class="post-date">
                        <i class="fas fa-calendar"></i>
                        <?php echo get_the_date(); ?>
                    </span>
                    <span class="post-author">
                        <i class="fas fa-user"></i>
                        <?php the_author(); ?>
                    </span>
                    <span class="post-comments">
                        <i class="fas fa-comment"></i>
                        <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                    </span>
                    <?php if (function_exists('anwar_reading_time')) : ?>
                        <span class="post-reading-time">
                            <i class="fas fa-clock"></i>
                            <?php echo anwar_reading_time(); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Post Content -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('post-content-section section'); ?>>
            <div class="container">
                <div class="post-content-wrapper">

                    <!-- Main Content -->
                    <div class="post-main-content">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'anwar'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <?php
                        $tags = get_the_tags();
                        if ($tags) :
                        ?>
                            <div class="post-tags">
                                <i class="fas fa-tags"></i>
                                <?php the_tags('', ' ', ''); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Share Buttons -->
                        <div class="post-share">
                            <h4><?php esc_html_e('Share This Post', 'anwar'); ?></h4>
                            <div class="share-buttons">
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="share-btn twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="share-btn facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="share-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="share-btn email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <?php if (is_active_sidebar('sidebar-1')) : ?>
                        <aside class="post-sidebar">
                            <?php dynamic_sidebar('sidebar-1'); ?>
                        </aside>
                    <?php endif; ?>

                </div>
            </div>
        </article>

        <!-- Author Bio -->
        <?php if (get_the_author_meta('description')) : ?>
            <section class="author-bio section">
                <div class="container">
                    <div class="author-bio-content">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 120); ?>
                        </div>
                        <div class="author-info">
                            <h3><?php esc_html_e('About', 'anwar'); ?> <?php the_author(); ?></h3>
                            <p><?php the_author_meta('description'); ?></p>
                            <div class="author-links">
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="btn btn-secondary">
                                    <?php esc_html_e('View All Posts', 'anwar'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Post Navigation -->
        <nav class="post-navigation">
            <div class="container">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>

                    <?php if ($prev_post) : ?>
                        <div class="nav-previous">
                            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                <span class="nav-subtitle">
                                    <i class="fas fa-arrow-left"></i>
                                    <?php esc_html_e('Previous Post', 'anwar'); ?>
                                </span>
                                <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                <span class="nav-subtitle">
                                    <?php esc_html_e('Next Post', 'anwar'); ?>
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!-- Comments -->
        <?php
        if (comments_open() || get_comments_number()) :
        ?>
            <section class="comments-section section">
                <div class="container">
                    <?php comments_template(); ?>
                </div>
            </section>
        <?php endif; ?>

    <?php endwhile; ?>

</main><!-- #primary -->

<?php
get_footer();