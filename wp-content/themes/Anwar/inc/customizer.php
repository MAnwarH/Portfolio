<?php
/**
 * Anwar Theme Customizer
 *
 * @package Anwar
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer
 */
function anwar_customize_register($wp_customize) {
    // Add custom panels and sections

    /**
     * Hero Section Settings
     */
    $wp_customize->add_section('anwar_hero_section', array(
        'title'    => __('Hero Section', 'anwar'),
        'priority' => 30,
    ));

    // Hero Greeting
    $wp_customize->add_setting('anwar_hero_greeting', array(
        'default'           => 'Hi, I\'m Anwar',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('anwar_hero_greeting', array(
        'label'    => __('Hero Greeting', 'anwar'),
        'section'  => 'anwar_hero_section',
        'type'     => 'text',
    ));

    // Hero Title
    $wp_customize->add_setting('anwar_hero_title', array(
        'default'           => 'I Build Fast, Secure & Scalable <span class="highlight">WordPress Websites</span>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('anwar_hero_title', array(
        'label'       => __('Hero Title', 'anwar'),
        'description' => __('HTML allowed. Use <span class="highlight"> for colored text.', 'anwar'),
        'section'     => 'anwar_hero_section',
        'type'        => 'textarea',
    ));

    // Hero Description
    $wp_customize->add_setting('anwar_hero_description', array(
        'default'           => 'Full-stack WordPress developer with 5+ years of experience creating custom themes, plugins, and high-performance websites.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('anwar_hero_description', array(
        'label'    => __('Hero Description', 'anwar'),
        'section'  => 'anwar_hero_section',
        'type'     => 'textarea',
    ));

    // Hero Image
    $wp_customize->add_setting('anwar_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'anwar_hero_image', array(
        'label'    => __('Hero Image', 'anwar'),
        'section'  => 'anwar_hero_section',
    )));

    // Trust Text
    $wp_customize->add_setting('anwar_trust_text', array(
        'default'           => 'Worked with 50+ clients worldwide',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_trust_text', array(
        'label'    => __('Trust Element Text', 'anwar'),
        'section'  => 'anwar_hero_section',
        'type'     => 'text',
    ));

    /**
     * Stats Section
     */
    $wp_customize->add_section('anwar_stats_section', array(
        'title'    => __('Stats Section', 'anwar'),
        'priority' => 35,
    ));

    // Websites Built
    $wp_customize->add_setting('anwar_stat_websites', array(
        'default'           => '150',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('anwar_stat_websites', array(
        'label'    => __('Websites Built', 'anwar'),
        'section'  => 'anwar_stats_section',
        'type'     => 'number',
    ));

    // Happy Clients
    $wp_customize->add_setting('anwar_stat_clients', array(
        'default'           => '50',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('anwar_stat_clients', array(
        'label'    => __('Happy Clients', 'anwar'),
        'section'  => 'anwar_stats_section',
        'type'     => 'number',
    ));

    // Plugins Customized
    $wp_customize->add_setting('anwar_stat_plugins', array(
        'default'           => '25',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('anwar_stat_plugins', array(
        'label'    => __('Plugins Customized', 'anwar'),
        'section'  => 'anwar_stats_section',
        'type'     => 'number',
    ));

    // Years Experience
    $wp_customize->add_setting('anwar_stat_years', array(
        'default'           => '5',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('anwar_stat_years', array(
        'label'    => __('Years Experience', 'anwar'),
        'section'  => 'anwar_stats_section',
        'type'     => 'number',
    ));

    /**
     * About Section
     */
    $wp_customize->add_section('anwar_about_section', array(
        'title'    => __('About Section', 'anwar'),
        'priority' => 40,
    ));

    // Profile Image
    $wp_customize->add_setting('anwar_profile_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'anwar_profile_image', array(
        'label'    => __('Profile Photo', 'anwar'),
        'section'  => 'anwar_about_section',
    )));

    // About Title
    $wp_customize->add_setting('anwar_about_title', array(
        'default'           => 'Professional WordPress Developer',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_about_title', array(
        'label'    => __('About Section Title', 'anwar'),
        'section'  => 'anwar_about_section',
        'type'     => 'text',
    ));

    // About Subtitle
    $wp_customize->add_setting('anwar_about_subtitle', array(
        'default'           => 'Learn more about my journey and expertise',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_about_subtitle', array(
        'label'    => __('About Page Subtitle', 'anwar'),
        'section'  => 'anwar_about_section',
        'type'     => 'text',
    ));

    /**
     * Services Section
     */
    $wp_customize->add_section('anwar_services_section', array(
        'title'    => __('Services Section', 'anwar'),
        'priority' => 45,
    ));

    // Services Subtitle
    $wp_customize->add_setting('anwar_services_subtitle', array(
        'default'           => 'Professional WordPress development services tailored to your needs',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_services_subtitle', array(
        'label'    => __('Services Page Subtitle', 'anwar'),
        'section'  => 'anwar_services_section',
        'type'     => 'text',
    ));

    /**
     * Contact Information
     */
    $wp_customize->add_section('anwar_contact_section', array(
        'title'    => __('Contact Information', 'anwar'),
        'priority' => 50,
    ));

    // Contact Subtitle
    $wp_customize->add_setting('anwar_contact_subtitle', array(
        'default'           => 'Let\'s discuss your project and turn your ideas into reality',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_contact_subtitle', array(
        'label'    => __('Contact Page Subtitle', 'anwar'),
        'section'  => 'anwar_contact_section',
        'type'     => 'text',
    ));

    // Email
    $wp_customize->add_setting('anwar_contact_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('anwar_contact_email', array(
        'label'    => __('Contact Email', 'anwar'),
        'section'  => 'anwar_contact_section',
        'type'     => 'email',
    ));

    // Phone
    $wp_customize->add_setting('anwar_contact_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_contact_phone', array(
        'label'    => __('Contact Phone', 'anwar'),
        'section'  => 'anwar_contact_section',
        'type'     => 'text',
    ));

    // Address
    $wp_customize->add_setting('anwar_contact_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_contact_address', array(
        'label'    => __('Contact Address', 'anwar'),
        'section'  => 'anwar_contact_section',
        'type'     => 'text',
    ));

    // WhatsApp
    $wp_customize->add_setting('anwar_whatsapp_number', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_whatsapp_number', array(
        'label'       => __('WhatsApp Number', 'anwar'),
        'description' => __('Include country code (e.g., +1234567890)', 'anwar'),
        'section'     => 'anwar_contact_section',
        'type'        => 'text',
    ));

    // Telegram
    $wp_customize->add_setting('anwar_telegram_username', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_telegram_username', array(
        'label'       => __('Telegram Username', 'anwar'),
        'description' => __('Without @ symbol', 'anwar'),
        'section'     => 'anwar_contact_section',
        'type'        => 'text',
    ));

    // Google Maps Embed
    $wp_customize->add_setting('anwar_google_maps_embed', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('anwar_google_maps_embed', array(
        'label'       => __('Google Maps Embed Code', 'anwar'),
        'description' => __('Paste the entire iframe code from Google Maps', 'anwar'),
        'section'     => 'anwar_contact_section',
        'type'        => 'textarea',
    ));

    // Availability Text
    $wp_customize->add_setting('anwar_availability_text', array(
        'default'           => 'Available for new projects',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_availability_text', array(
        'label'    => __('Availability Status', 'anwar'),
        'section'  => 'anwar_contact_section',
        'type'     => 'text',
    ));

    /**
     * Social Media Links
     */
    $wp_customize->add_section('anwar_social_section', array(
        'title'    => __('Social Media', 'anwar'),
        'priority' => 55,
    ));

    $social_platforms = array(
        'github'    => 'GitHub',
        'linkedin'  => 'LinkedIn',
        'twitter'   => 'Twitter',
        'instagram' => 'Instagram',
        'facebook'  => 'Facebook',
    );

    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting('anwar_' . $platform . '_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('anwar_' . $platform . '_url', array(
            'label'    => $label . ' ' . __('URL', 'anwar'),
            'section'  => 'anwar_social_section',
            'type'     => 'url',
        ));
    }

    /**
     * CTA Section
     */
    $wp_customize->add_section('anwar_cta_section', array(
        'title'    => __('CTA Section', 'anwar'),
        'priority' => 60,
    ));

    // CTA Title
    $wp_customize->add_setting('anwar_cta_title', array(
        'default'           => 'Ready to Start Your Project?',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_cta_title', array(
        'label'    => __('CTA Title', 'anwar'),
        'section'  => 'anwar_cta_section',
        'type'     => 'text',
    ));

    // CTA Description
    $wp_customize->add_setting('anwar_cta_description', array(
        'default'           => 'Let\'s work together to bring your WordPress project to life!',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('anwar_cta_description', array(
        'label'    => __('CTA Description', 'anwar'),
        'section'  => 'anwar_cta_section',
        'type'     => 'text',
    ));

    // Resume URL
    $wp_customize->add_setting('anwar_resume_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('anwar_resume_url', array(
        'label'       => __('Resume/CV URL', 'anwar'),
        'description' => __('Upload your resume to Media Library and paste the URL here', 'anwar'),
        'section'     => 'anwar_cta_section',
        'type'        => 'url',
    ));

    /**
     * Footer Options
     */
    $wp_customize->add_section('anwar_footer_section', array(
        'title'    => __('Footer Options', 'anwar'),
        'priority' => 65,
    ));

    // Show Newsletter
    $wp_customize->add_setting('anwar_show_newsletter', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('anwar_show_newsletter', array(
        'label'    => __('Show Newsletter Signup', 'anwar'),
        'section'  => 'anwar_footer_section',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'anwar_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously
 */
function anwar_customize_preview_js() {
    wp_enqueue_script('anwar-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), ANWAR_VERSION, true);
}
add_action('customize_preview_init', 'anwar_customize_preview_js');