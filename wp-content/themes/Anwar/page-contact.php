<?php
/**
 * Template Name: Contact Page
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
                <?php echo esc_html(get_theme_mod('anwar_contact_subtitle', 'Let\'s discuss your project and turn your ideas into reality')); ?>
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section section">
        <div class="container">
            <div class="contact-wrapper">

                <!-- Contact Form -->
                <div class="contact-form-wrapper" data-aos="fade-right">
                    <h2><?php esc_html_e('Send Me a Message', 'anwar'); ?></h2>
                    <p><?php esc_html_e('Fill out the form below and I\'ll get back to you within 24 hours.', 'anwar'); ?></p>

                    <form id="contact-form" class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-name"><?php esc_html_e('Your Name', 'anwar'); ?> <span class="required">*</span></label>
                                <input type="text" id="contact-name" name="name" required placeholder="<?php esc_attr_e('John Doe', 'anwar'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="contact-email"><?php esc_html_e('Your Email', 'anwar'); ?> <span class="required">*</span></label>
                                <input type="email" id="contact-email" name="email" required placeholder="<?php esc_attr_e('john@example.com', 'anwar'); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-phone"><?php esc_html_e('Phone Number', 'anwar'); ?></label>
                                <input type="tel" id="contact-phone" name="phone" placeholder="<?php esc_attr_e('+1 234 567 8900', 'anwar'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="contact-subject"><?php esc_html_e('Subject', 'anwar'); ?> <span class="required">*</span></label>
                                <select id="contact-subject" name="subject" required>
                                    <option value=""><?php esc_html_e('Select a subject', 'anwar'); ?></option>
                                    <option value="general"><?php esc_html_e('General Inquiry', 'anwar'); ?></option>
                                    <option value="project"><?php esc_html_e('New Project', 'anwar'); ?></option>
                                    <option value="support"><?php esc_html_e('Support', 'anwar'); ?></option>
                                    <option value="other"><?php esc_html_e('Other', 'anwar'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact-message"><?php esc_html_e('Your Message', 'anwar'); ?> <span class="required">*</span></label>
                            <textarea id="contact-message" name="message" rows="6" required placeholder="<?php esc_attr_e('Tell me about your project...', 'anwar'); ?>"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="agree" required>
                                <span><?php esc_html_e('I agree to the privacy policy', 'anwar'); ?></span>
                            </label>
                        </div>

                        <input type="hidden" name="action" value="anwar_contact_form">
                        <?php wp_nonce_field('anwar_contact_form', 'contact_nonce'); ?>

                        <button type="submit" class="btn btn-primary btn-lg">
                            <span class="btn-text">
                                <i class="fas fa-paper-plane"></i>
                                <?php esc_html_e('Send Message', 'anwar'); ?>
                            </span>
                            <span class="btn-loading" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>
                                <?php esc_html_e('Sending...', 'anwar'); ?>
                            </span>
                        </button>

                        <div class="form-message" id="form-message"></div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info-wrapper" data-aos="fade-left">
                    <h2><?php esc_html_e('Contact Information', 'anwar'); ?></h2>
                    <p><?php esc_html_e('Feel free to reach out through any of these channels.', 'anwar'); ?></p>

                    <div class="contact-info-items">
                        <?php
                        $contact_email = get_theme_mod('anwar_contact_email', '');
                        $contact_phone = get_theme_mod('anwar_contact_phone', '');
                        $contact_address = get_theme_mod('anwar_contact_address', '');
                        $contact_whatsapp = get_theme_mod('anwar_whatsapp_number', '');
                        $contact_telegram = get_theme_mod('anwar_telegram_username', '');

                        if ($contact_email) :
                        ?>
                            <div class="contact-info-item">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <h4><?php esc_html_e('Email', 'anwar'); ?></h4>
                                    <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($contact_phone) : ?>
                            <div class="contact-info-item">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <h4><?php esc_html_e('Phone', 'anwar'); ?></h4>
                                    <a href="tel:<?php echo esc_attr(str_replace(' ', '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($contact_address) : ?>
                            <div class="contact-info-item">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4><?php esc_html_e('Location', 'anwar'); ?></h4>
                                    <p><?php echo esc_html($contact_address); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($contact_whatsapp) : ?>
                            <div class="contact-info-item">
                                <div class="info-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <div class="info-content">
                                    <h4><?php esc_html_e('WhatsApp', 'anwar'); ?></h4>
                                    <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $contact_whatsapp)); ?>" target="_blank" rel="noopener"><?php echo esc_html($contact_whatsapp); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($contact_telegram) : ?>
                            <div class="contact-info-item">
                                <div class="info-icon">
                                    <i class="fab fa-telegram"></i>
                                </div>
                                <div class="info-content">
                                    <h4><?php esc_html_e('Telegram', 'anwar'); ?></h4>
                                    <a href="https://t.me/<?php echo esc_attr($contact_telegram); ?>" target="_blank" rel="noopener">@<?php echo esc_html($contact_telegram); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Social Links -->
                    <div class="contact-social">
                        <h3><?php esc_html_e('Follow Me', 'anwar'); ?></h3>
                        <div class="social-links">
                            <?php
                            $social_links = array(
                                'github' => array('url' => get_theme_mod('anwar_github_url', ''), 'icon' => 'fab fa-github'),
                                'linkedin' => array('url' => get_theme_mod('anwar_linkedin_url', ''), 'icon' => 'fab fa-linkedin'),
                                'twitter' => array('url' => get_theme_mod('anwar_twitter_url', ''), 'icon' => 'fab fa-twitter'),
                                'instagram' => array('url' => get_theme_mod('anwar_instagram_url', ''), 'icon' => 'fab fa-instagram'),
                                'facebook' => array('url' => get_theme_mod('anwar_facebook_url', ''), 'icon' => 'fab fa-facebook'),
                            );

                            foreach ($social_links as $platform => $data) :
                                if ($data['url']) :
                            ?>
                                <a href="<?php echo esc_url($data['url']); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="<?php echo esc_attr(ucfirst($platform)); ?>">
                                    <i class="<?php echo esc_attr($data['icon']); ?>"></i>
                                </a>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>

                    <!-- Availability Badge -->
                    <div class="availability-badge">
                        <i class="fas fa-circle"></i>
                        <span><?php echo esc_html(get_theme_mod('anwar_availability_text', 'Available for new projects')); ?></span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Map Section (Optional) -->
    <?php
    $google_maps_embed = get_theme_mod('anwar_google_maps_embed', '');
    if ($google_maps_embed) :
    ?>
        <section class="map-section">
            <div class="map-container" data-aos="fade-up">
                <?php echo wp_kses_post($google_maps_embed); ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- FAQ Section -->
    <section class="faq-section section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('Frequently Asked Questions', 'anwar'); ?></h2>
                <p><?php esc_html_e('Common questions about working with me', 'anwar'); ?></p>
            </div>

            <div class="faq-wrapper">
                <?php
                $faqs = array(
                    array(
                        'question' => __('What is your typical project timeline?', 'anwar'),
                        'answer' => __('Project timelines vary based on complexity, but most projects take 2-6 weeks from start to finish. I\'ll provide a detailed timeline after discussing your requirements.', 'anwar'),
                    ),
                    array(
                        'question' => __('Do you offer ongoing support?', 'anwar'),
                        'answer' => __('Yes! All projects include a support period, and I offer monthly maintenance packages for ongoing updates, security, and support.', 'anwar'),
                    ),
                    array(
                        'question' => __('What information do you need to get started?', 'anwar'),
                        'answer' => __('I\'ll need details about your business, design preferences, required features, content, and any existing branding materials. We\'ll discuss everything in detail during our initial consultation.', 'anwar'),
                    ),
                    array(
                        'question' => __('Do you work with existing websites?', 'anwar'),
                        'answer' => __('Absolutely! I can work with your existing WordPress site to add features, fix issues, improve performance, or give it a complete redesign.', 'anwar'),
                    ),
                    array(
                        'question' => __('What payment methods do you accept?', 'anwar'),
                        'answer' => __('I accept payments via bank transfer, PayPal, and major credit cards. Payment is typically split into milestones: 50% upfront and 50% upon completion.', 'anwar'),
                    ),
                );

                foreach ($faqs as $index => $faq) :
                ?>
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <button class="faq-question">
                            <span><?php echo esc_html($faq['question']); ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <p><?php echo esc_html($faq['answer']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php
get_footer();