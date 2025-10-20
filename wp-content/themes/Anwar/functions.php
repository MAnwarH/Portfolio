<?php
/**
 * Anwar Theme Functions
 *
 * @package Anwar
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Theme version
define('ANWAR_VERSION', '1.0.0');

/**
 * Theme Setup
 */
function anwar_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true);

    // Add custom image sizes
    add_image_size('anwar-portfolio-thumb', 600, 450, true);
    add_image_size('anwar-hero', 1920, 1080, true);
    add_image_size('anwar-testimonial', 150, 150, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'anwar'),
        'footer' => esc_html__('Footer Menu', 'anwar'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for block styles
    add_theme_support('wp-block-styles');

    // Add support for wide alignment
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'anwar_theme_setup');

/**
 * Set the content width in pixels
 */
function anwar_content_width() {
    $GLOBALS['content_width'] = apply_filters('anwar_content_width', 1200);
}
add_action('after_setup_theme', 'anwar_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function anwar_scripts() {
    // Google Fonts
    wp_enqueue_style('anwar-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap', array(), null);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');

    // Main stylesheet
    wp_enqueue_style('anwar-style', get_stylesheet_uri(), array(), ANWAR_VERSION);

    // Custom styles
    wp_enqueue_style('anwar-custom', get_template_directory_uri() . '/assets/css/custom.css', array('anwar-style'), ANWAR_VERSION);

    // Main JavaScript
    wp_enqueue_script('anwar-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), ANWAR_VERSION, true);

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Localize script for AJAX
    wp_localize_script('anwar-main', 'anwarData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('anwar-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'anwar_scripts');

/**
 * Register widget areas
 */
function anwar_widgets_init() {
    // Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'anwar'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'anwar'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer widgets
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer Widget Area %d', 'anwar'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Footer widget area %d', 'anwar'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'anwar_widgets_init');

/**
 * Register Custom Post Type: Portfolio
 */
function anwar_register_portfolio_post_type() {
    $labels = array(
        'name'                  => _x('Portfolio', 'Post Type General Name', 'anwar'),
        'singular_name'         => _x('Portfolio Item', 'Post Type Singular Name', 'anwar'),
        'menu_name'            => __('Portfolio', 'anwar'),
        'name_admin_bar'       => __('Portfolio Item', 'anwar'),
        'archives'             => __('Portfolio Archives', 'anwar'),
        'attributes'           => __('Portfolio Attributes', 'anwar'),
        'all_items'            => __('All Portfolio', 'anwar'),
        'add_new_item'         => __('Add New Portfolio Item', 'anwar'),
        'add_new'              => __('Add New', 'anwar'),
        'new_item'             => __('New Portfolio Item', 'anwar'),
        'edit_item'            => __('Edit Portfolio Item', 'anwar'),
        'update_item'          => __('Update Portfolio Item', 'anwar'),
        'view_item'            => __('View Portfolio Item', 'anwar'),
        'view_items'           => __('View Portfolio', 'anwar'),
        'search_items'         => __('Search Portfolio', 'anwar'),
    );

    $args = array(
        'label'                => __('Portfolio Item', 'anwar'),
        'labels'               => $labels,
        'supports'             => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'public'               => true,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'menu_position'        => 5,
        'menu_icon'            => 'dashicons-portfolio',
        'show_in_admin_bar'    => true,
        'show_in_nav_menus'    => true,
        'can_export'           => true,
        'has_archive'          => true,
        'hierarchical'         => false,
        'exclude_from_search'  => false,
        'show_in_rest'         => true,
        'publicly_queryable'   => true,
        'capability_type'      => 'post',
        'rewrite'              => array('slug' => 'portfolio'),
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'anwar_register_portfolio_post_type', 0);

/**
 * Register Taxonomy: Portfolio Categories
 */
function anwar_register_portfolio_taxonomy() {
    $labels = array(
        'name'              => _x('Portfolio Categories', 'taxonomy general name', 'anwar'),
        'singular_name'     => _x('Portfolio Category', 'taxonomy singular name', 'anwar'),
        'search_items'      => __('Search Categories', 'anwar'),
        'all_items'         => __('All Categories', 'anwar'),
        'parent_item'       => __('Parent Category', 'anwar'),
        'parent_item_colon' => __('Parent Category:', 'anwar'),
        'edit_item'         => __('Edit Category', 'anwar'),
        'update_item'       => __('Update Category', 'anwar'),
        'add_new_item'      => __('Add New Category', 'anwar'),
        'new_item_name'     => __('New Category Name', 'anwar'),
        'menu_name'         => __('Categories', 'anwar'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'portfolio-category'),
    );

    register_taxonomy('portfolio_category', array('portfolio'), $args);
}
add_action('init', 'anwar_register_portfolio_taxonomy', 0);

/**
 * Register Custom Post Type: Testimonials
 */
function anwar_register_testimonials_post_type() {
    $labels = array(
        'name'                  => _x('Testimonials', 'Post Type General Name', 'anwar'),
        'singular_name'         => _x('Testimonial', 'Post Type Singular Name', 'anwar'),
        'menu_name'            => __('Testimonials', 'anwar'),
        'all_items'            => __('All Testimonials', 'anwar'),
        'add_new_item'         => __('Add New Testimonial', 'anwar'),
        'add_new'              => __('Add New', 'anwar'),
        'new_item'             => __('New Testimonial', 'anwar'),
        'edit_item'            => __('Edit Testimonial', 'anwar'),
        'update_item'          => __('Update Testimonial', 'anwar'),
        'view_item'            => __('View Testimonial', 'anwar'),
    );

    $args = array(
        'label'                => __('Testimonial', 'anwar'),
        'labels'               => $labels,
        'supports'             => array('title', 'editor', 'thumbnail'),
        'public'               => true,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'menu_position'        => 6,
        'menu_icon'            => 'dashicons-testimonial',
        'show_in_admin_bar'    => true,
        'can_export'           => true,
        'has_archive'          => false,
        'hierarchical'         => false,
        'show_in_rest'         => true,
        'publicly_queryable'   => false,
        'capability_type'      => 'post',
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'anwar_register_testimonials_post_type', 0);

/**
 * Add custom meta boxes for portfolio items
 */
function anwar_add_portfolio_meta_boxes() {
    add_meta_box(
        'anwar_portfolio_details',
        __('Portfolio Details', 'anwar'),
        'anwar_portfolio_details_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'anwar_add_portfolio_meta_boxes');

/**
 * Portfolio meta box callback
 */
function anwar_portfolio_details_callback($post) {
    wp_nonce_field('anwar_save_portfolio_details', 'anwar_portfolio_details_nonce');

    $client = get_post_meta($post->ID, '_anwar_portfolio_client', true);
    $url = get_post_meta($post->ID, '_anwar_portfolio_url', true);
    $technologies = get_post_meta($post->ID, '_anwar_portfolio_technologies', true);
    $date = get_post_meta($post->ID, '_anwar_portfolio_date', true);
    ?>
    <p>
        <label for="anwar_portfolio_client"><?php _e('Client Name:', 'anwar'); ?></label><br>
        <input type="text" id="anwar_portfolio_client" name="anwar_portfolio_client" value="<?php echo esc_attr($client); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="anwar_portfolio_url"><?php _e('Project URL:', 'anwar'); ?></label><br>
        <input type="url" id="anwar_portfolio_url" name="anwar_portfolio_url" value="<?php echo esc_url($url); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="anwar_portfolio_technologies"><?php _e('Technologies Used:', 'anwar'); ?></label><br>
        <input type="text" id="anwar_portfolio_technologies" name="anwar_portfolio_technologies" value="<?php echo esc_attr($technologies); ?>" style="width: 100%;">
        <span class="description"><?php _e('Separate with commas (e.g., WordPress, PHP, JavaScript)', 'anwar'); ?></span>
    </p>
    <p>
        <label for="anwar_portfolio_date"><?php _e('Completion Date:', 'anwar'); ?></label><br>
        <input type="text" id="anwar_portfolio_date" name="anwar_portfolio_date" value="<?php echo esc_attr($date); ?>" style="width: 100%;">
    </p>
    <?php
}

/**
 * Save portfolio meta box data
 */
function anwar_save_portfolio_details($post_id) {
    if (!isset($_POST['anwar_portfolio_details_nonce']) || !wp_verify_nonce($_POST['anwar_portfolio_details_nonce'], 'anwar_save_portfolio_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['anwar_portfolio_client'])) {
        update_post_meta($post_id, '_anwar_portfolio_client', sanitize_text_field($_POST['anwar_portfolio_client']));
    }

    if (isset($_POST['anwar_portfolio_url'])) {
        update_post_meta($post_id, '_anwar_portfolio_url', esc_url_raw($_POST['anwar_portfolio_url']));
    }

    if (isset($_POST['anwar_portfolio_technologies'])) {
        update_post_meta($post_id, '_anwar_portfolio_technologies', sanitize_text_field($_POST['anwar_portfolio_technologies']));
    }

    if (isset($_POST['anwar_portfolio_date'])) {
        update_post_meta($post_id, '_anwar_portfolio_date', sanitize_text_field($_POST['anwar_portfolio_date']));
    }
}
add_action('save_post', 'anwar_save_portfolio_details');

/**
 * Add testimonial meta boxes
 */
function anwar_add_testimonial_meta_boxes() {
    add_meta_box(
        'anwar_testimonial_details',
        __('Testimonial Details', 'anwar'),
        'anwar_testimonial_details_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'anwar_add_testimonial_meta_boxes');

/**
 * Testimonial meta box callback
 */
function anwar_testimonial_details_callback($post) {
    wp_nonce_field('anwar_save_testimonial_details', 'anwar_testimonial_details_nonce');

    $company = get_post_meta($post->ID, '_anwar_testimonial_company', true);
    $position = get_post_meta($post->ID, '_anwar_testimonial_position', true);
    $rating = get_post_meta($post->ID, '_anwar_testimonial_rating', true);
    ?>
    <p>
        <label for="anwar_testimonial_company"><?php _e('Company Name:', 'anwar'); ?></label><br>
        <input type="text" id="anwar_testimonial_company" name="anwar_testimonial_company" value="<?php echo esc_attr($company); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="anwar_testimonial_position"><?php _e('Position/Role:', 'anwar'); ?></label><br>
        <input type="text" id="anwar_testimonial_position" name="anwar_testimonial_position" value="<?php echo esc_attr($position); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="anwar_testimonial_rating"><?php _e('Rating (1-5):', 'anwar'); ?></label><br>
        <select id="anwar_testimonial_rating" name="anwar_testimonial_rating">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?> Star<?php echo $i > 1 ? 's' : ''; ?></option>
            <?php endfor; ?>
        </select>
    </p>
    <?php
}

/**
 * Save testimonial meta box data
 */
function anwar_save_testimonial_details($post_id) {
    if (!isset($_POST['anwar_testimonial_details_nonce']) || !wp_verify_nonce($_POST['anwar_testimonial_details_nonce'], 'anwar_save_testimonial_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['anwar_testimonial_company'])) {
        update_post_meta($post_id, '_anwar_testimonial_company', sanitize_text_field($_POST['anwar_testimonial_company']));
    }

    if (isset($_POST['anwar_testimonial_position'])) {
        update_post_meta($post_id, '_anwar_testimonial_position', sanitize_text_field($_POST['anwar_testimonial_position']));
    }

    if (isset($_POST['anwar_testimonial_rating'])) {
        update_post_meta($post_id, '_anwar_testimonial_rating', absint($_POST['anwar_testimonial_rating']));
    }
}
add_action('save_post', 'anwar_save_testimonial_details');

/**
 * Load theme customizer options
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load custom functions
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load AJAX handlers
 */
require get_template_directory() . '/inc/ajax-handlers.php';