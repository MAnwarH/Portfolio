<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Anwar
 */

/**
 * Adds custom classes to the array of body classes
 */
function anwar_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'anwar_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments
 */
function anwar_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'anwar_pingback_header');

/**
 * Custom excerpt length
 */
function anwar_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'anwar_excerpt_length');

/**
 * Custom excerpt more
 */
function anwar_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'anwar_excerpt_more');

/**
 * Add custom meta tags to head
 */
function anwar_custom_meta_tags() {
    ?>
    <meta name="theme-color" content="#2563eb">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <?php
}
add_action('wp_head', 'anwar_custom_meta_tags');

/**
 * Add Schema.org markup for better SEO
 */
function anwar_add_schema_markup() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => get_bloginfo('name'),
        'url' => home_url(),
        'sameAs' => array(),
    );

    // Add social profiles
    $social_platforms = array('github', 'linkedin', 'twitter', 'instagram', 'facebook');
    foreach ($social_platforms as $platform) {
        $url = get_theme_mod('anwar_' . $platform . '_url', '');
        if ($url) {
            $schema['sameAs'][] = $url;
        }
    }

    // Add email
    $email = get_theme_mod('anwar_contact_email', '');
    if ($email) {
        $schema['email'] = $email;
    }

    // Add job title
    $schema['jobTitle'] = 'WordPress Developer';
    ?>
    <script type="application/ld+json">
    <?php echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES); ?>
    </script>
    <?php
}
add_action('wp_head', 'anwar_add_schema_markup');

/**
 * Custom portfolio query for pagination
 */
function anwar_modify_portfolio_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('portfolio')) {
        $query->set('posts_per_page', 12);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'anwar_modify_portfolio_query');

/**
 * Add custom class to navigation menu items
 */
function anwar_nav_menu_css_class($classes, $item, $args) {
    if ($args->theme_location == 'primary') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'anwar_nav_menu_css_class', 10, 3);

/**
 * Add custom class to navigation menu links
 */
function anwar_nav_menu_link_attributes($atts, $item, $args) {
    if ($args->theme_location == 'primary') {
        $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'anwar_nav_menu_link_attributes', 10, 3);

/**
 * Custom comment list
 */
function anwar_comment($comment, $args, $depth) {
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <?php endif; ?>

    <div class="comment-author vcard">
        <?php
        if ($args['avatar_size'] != 0) {
            echo get_avatar($comment, $args['avatar_size']);
        }
        ?>
        <?php
        printf(
            __('<cite class="fn">%s</cite> <span class="says">says:</span>', 'anwar'),
            get_comment_author_link()
        );
        ?>
    </div>

    <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'anwar'); ?></em>
        <br/>
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
            <?php
            printf(
                __('%1$s at %2$s', 'anwar'),
                get_comment_date(),
                get_comment_time()
            );
            ?>
        </a>
        <?php edit_comment_link(__('(Edit)', 'anwar'), '  ', ''); ?>
    </div>

    <div class="comment-content">
        <?php comment_text(); ?>
    </div>

    <div class="reply">
        <?php
        comment_reply_link(
            array_merge(
                $args,
                array(
                    'add_below' => $add_below,
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth']
                )
            )
        );
        ?>
    </div>

    <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}

/**
 * Get reading time for posts
 */
function anwar_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);

    return $reading_time . ' ' . __('min read', 'anwar');
}

/**
 * Get related posts
 */
function anwar_get_related_posts($post_id, $number = 3) {
    $categories = get_the_category($post_id);
    $category_ids = array();

    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }

    $args = array(
        'category__in' => $category_ids,
        'post__not_in' => array($post_id),
        'posts_per_page' => $number,
        'orderby' => 'rand',
    );

    return new WP_Query($args);
}

/**
 * Custom breadcrumbs
 */
function anwar_breadcrumbs() {
    $separator = '<i class="fas fa-chevron-right"></i>';
    $home_title = __('Home', 'anwar');

    // Get the current page URL
    $current_url = home_url(add_query_arg(array(), $_SERVER['REQUEST_URI']));

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<ol class="breadcrumb-list">';

    // Home page
    echo '<li class="breadcrumb-item"><a href="' . home_url() . '">' . $home_title . '</a></li>';

    if (is_category() || is_single()) {
        echo '<li class="breadcrumb-separator">' . $separator . '</li>';

        $categories = get_the_category();
        if ($categories) {
            $category = $categories[0];
            echo '<li class="breadcrumb-item"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
        }

        if (is_single()) {
            echo '<li class="breadcrumb-separator">' . $separator . '</li>';
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
        }
    } elseif (is_page()) {
        if ($post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();

            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }

            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo '<li class="breadcrumb-separator">' . $separator . '</li>';
                echo $crumb;
            }
        }

        echo '<li class="breadcrumb-separator">' . $separator . '</li>';
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_search()) {
        echo '<li class="breadcrumb-separator">' . $separator . '</li>';
        echo '<li class="breadcrumb-item active" aria-current="page">' . __('Search results for: ', 'anwar') . get_search_query() . '</li>';
    } elseif (is_404()) {
        echo '<li class="breadcrumb-separator">' . $separator . '</li>';
        echo '<li class="breadcrumb-item active" aria-current="page">' . __('Error 404', 'anwar') . '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Add async/defer to scripts
 */
function anwar_add_async_defer_attribute($tag, $handle, $src) {
    // Add script handles to the array below to defer them
    $defer_scripts = array(
        'anwar-main',
    );

    // Add script handles to the array below to make them async
    $async_scripts = array();

    if (in_array($handle, $defer_scripts)) {
        return '<script src="' . $src . '" defer></script>' . "\n";
    }

    if (in_array($handle, $async_scripts)) {
        return '<script src="' . $src . '" async></script>' . "\n";
    }

    return $tag;
}
add_filter('script_loader_tag', 'anwar_add_async_defer_attribute', 10, 3);

/**
 * Flush rewrite rules on theme activation
 */
function anwar_rewrite_flush() {
    anwar_register_portfolio_post_type();
    anwar_register_portfolio_taxonomy();
    anwar_register_testimonials_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'anwar_rewrite_flush');

/**
 * Remove emoji scripts
 */
function anwar_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'anwar_disable_emojis');

/**
 * Custom logo size
 */
function anwar_custom_logo() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

    if (has_custom_logo()) {
        echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link" rel="home">';
        echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="custom-logo">';
        echo '</a>';
    }
}