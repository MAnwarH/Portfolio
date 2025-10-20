<?php
/**
 * AJAX Handlers
 *
 * @package Anwar
 */

/**
 * Handle contact form submission
 */
function anwar_handle_contact_form() {
    // Verify nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'anwar_contact_form')) {
        wp_send_json_error(array(
            'message' => __('Security check failed. Please refresh the page and try again.', 'anwar')
        ));
    }

    // Sanitize and validate form data
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_send_json_error(array(
            'message' => __('Please fill in all required fields.', 'anwar')
        ));
    }

    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(array(
            'message' => __('Please enter a valid email address.', 'anwar')
        ));
    }

    // Get admin email
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');

    // Subject mapping
    $subject_map = array(
        'general' => __('General Inquiry', 'anwar'),
        'project' => __('New Project', 'anwar'),
        'support' => __('Support Request', 'anwar'),
        'other' => __('Other', 'anwar'),
    );

    $subject_text = isset($subject_map[$subject]) ? $subject_map[$subject] : $subject;

    // Prepare email content
    $email_subject = sprintf('[%s] %s from %s', $site_name, $subject_text, $name);

    $email_body = sprintf(
        __("You have received a new message from the contact form on %s\n\n", 'anwar'),
        $site_name
    );
    $email_body .= "-------------------\n\n";
    $email_body .= sprintf(__("Name: %s\n", 'anwar'), $name);
    $email_body .= sprintf(__("Email: %s\n", 'anwar'), $email);

    if (!empty($phone)) {
        $email_body .= sprintf(__("Phone: %s\n", 'anwar'), $phone);
    }

    $email_body .= sprintf(__("Subject: %s\n\n", 'anwar'), $subject_text);
    $email_body .= sprintf(__("Message:\n%s\n\n", 'anwar'), $message);
    $email_body .= "-------------------\n\n";
    $email_body .= sprintf(__("Sent from: %s\n", 'anwar'), home_url());
    $email_body .= sprintf(__("IP Address: %s\n", 'anwar'), $_SERVER['REMOTE_ADDR']);
    $email_body .= sprintf(__("Date: %s\n", 'anwar'), current_time('mysql'));

    // Email headers
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        sprintf('From: %s <%s>', $site_name, $admin_email),
        sprintf('Reply-To: %s <%s>', $name, $email),
    );

    // Send email
    $mail_sent = wp_mail($admin_email, $email_subject, $email_body, $headers);

    if ($mail_sent) {
        // Optionally save to database
        anwar_save_contact_submission($name, $email, $phone, $subject, $message);

        // Send auto-reply to user
        anwar_send_auto_reply($name, $email, $subject_text);

        wp_send_json_success(array(
            'message' => __('Thank you for your message! I\'ll get back to you as soon as possible.', 'anwar')
        ));
    } else {
        wp_send_json_error(array(
            'message' => __('Sorry, there was an error sending your message. Please try again or contact me directly via email.', 'anwar')
        ));
    }
}
add_action('wp_ajax_anwar_contact_form', 'anwar_handle_contact_form');
add_action('wp_ajax_nopriv_anwar_contact_form', 'anwar_handle_contact_form');

/**
 * Save contact form submission to database (optional)
 */
function anwar_save_contact_submission($name, $email, $phone, $subject, $message) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'anwar_contacts';

    // Create table if it doesn't exist
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20),
        subject varchar(100) NOT NULL,
        message text NOT NULL,
        ip_address varchar(45),
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Insert submission
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
        ),
        array(
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        )
    );
}

/**
 * Send auto-reply email to user
 */
function anwar_send_auto_reply($name, $email, $subject) {
    $site_name = get_bloginfo('name');
    $admin_email = get_option('admin_email');

    $reply_subject = sprintf('[%s] Thank you for contacting us', $site_name);

    $reply_body = sprintf(__("Hi %s,\n\n", 'anwar'), $name);
    $reply_body .= __("Thank you for reaching out to me! I've received your message and will get back to you as soon as possible.\n\n", 'anwar');
    $reply_body .= sprintf(__("Your message regarding: %s\n\n", 'anwar'), $subject);
    $reply_body .= __("In the meantime, feel free to check out my portfolio and recent projects on my website.\n\n", 'anwar');
    $reply_body .= __("Best regards,\n", 'anwar');
    $reply_body .= $site_name . "\n";
    $reply_body .= home_url() . "\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        sprintf('From: %s <%s>', $site_name, $admin_email),
    );

    wp_mail($email, $reply_subject, $reply_body, $headers);
}

/**
 * Handle newsletter subscription
 */
function anwar_handle_newsletter_subscription() {
    // Verify nonce
    check_ajax_referer('anwar-nonce', 'nonce');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array(
            'message' => __('Please enter a valid email address.', 'anwar')
        ));
    }

    // Save to database or integrate with email service
    // This is a basic example - you should integrate with your email service provider
    $subscribers = get_option('anwar_newsletter_subscribers', array());

    if (in_array($email, $subscribers)) {
        wp_send_json_error(array(
            'message' => __('This email is already subscribed.', 'anwar')
        ));
    }

    $subscribers[] = $email;
    update_option('anwar_newsletter_subscribers', $subscribers);

    // Send notification to admin
    $admin_email = get_option('admin_email');
    $subject = sprintf('[%s] New Newsletter Subscription', get_bloginfo('name'));
    $message = sprintf(__("New newsletter subscription:\n\nEmail: %s\nDate: %s", 'anwar'), $email, current_time('mysql'));

    wp_mail($admin_email, $subject, $message);

    wp_send_json_success(array(
        'message' => __('Thank you for subscribing to our newsletter!', 'anwar')
    ));
}
add_action('wp_ajax_anwar_newsletter', 'anwar_handle_newsletter_subscription');
add_action('wp_ajax_nopriv_anwar_newsletter', 'anwar_handle_newsletter_subscription');

/**
 * Load more portfolio items (for infinite scroll or load more button)
 */
function anwar_load_more_portfolio() {
    check_ajax_referer('anwar-nonce', 'nonce');

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 6;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
    );

    if (!empty($category) && $category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();

        while ($query->have_posts()) : $query->the_post();
            // Include portfolio item template
            get_template_part('template-parts/content', 'portfolio');
        endwhile;

        $html = ob_get_clean();
        wp_reset_postdata();

        wp_send_json_success(array(
            'html' => $html,
            'max_pages' => $query->max_num_pages,
            'current_page' => $paged,
        ));
    } else {
        wp_send_json_error(array(
            'message' => __('No more items to load.', 'anwar')
        ));
    }
}
add_action('wp_ajax_anwar_load_more_portfolio', 'anwar_load_more_portfolio');
add_action('wp_ajax_nopriv_anwar_load_more_portfolio', 'anwar_load_more_portfolio');

/**
 * Like/Unlike portfolio item (optional feature)
 */
function anwar_like_portfolio() {
    check_ajax_referer('anwar-nonce', 'nonce');

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

    if ($post_id === 0) {
        wp_send_json_error(array(
            'message' => __('Invalid post ID.', 'anwar')
        ));
    }

    $likes = get_post_meta($post_id, 'anwar_likes', true);
    $likes = $likes ? intval($likes) : 0;
    $likes++;

    update_post_meta($post_id, 'anwar_likes', $likes);

    wp_send_json_success(array(
        'likes' => $likes,
        'message' => __('Thank you for liking this project!', 'anwar')
    ));
}
add_action('wp_ajax_anwar_like_portfolio', 'anwar_like_portfolio');
add_action('wp_ajax_nopriv_anwar_like_portfolio', 'anwar_like_portfolio');

/**
 * Search functionality
 */
function anwar_ajax_search() {
    check_ajax_referer('anwar-nonce', 'nonce');

    $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    if (empty($search_query)) {
        wp_send_json_error(array(
            'message' => __('Please enter a search term.', 'anwar')
        ));
    }

    $args = array(
        's' => $search_query,
        'post_type' => array('post', 'page', 'portfolio'),
        'posts_per_page' => 10,
    );

    $query = new WP_Query($args);
    $results = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            $results[] = array(
                'title' => get_the_title(),
                'url' => get_permalink(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 15),
                'type' => get_post_type(),
            );
        endwhile;
        wp_reset_postdata();

        wp_send_json_success(array(
            'results' => $results,
        ));
    } else {
        wp_send_json_error(array(
            'message' => __('No results found.', 'anwar')
        ));
    }
}
add_action('wp_ajax_anwar_search', 'anwar_ajax_search');
add_action('wp_ajax_nopriv_anwar_search', 'anwar_ajax_search');