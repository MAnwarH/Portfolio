    </div><!-- #content -->

    <!-- Footer -->
    <footer id="colophon" class="site-footer">

        <!-- Footer Widgets -->
        <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) : ?>
        <div class="footer-widgets">
            <div class="container">
                <div class="footer-widgets-grid">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-4'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Footer Main -->
        <div class="footer-main">
            <div class="container">
                <div class="footer-content">

                    <!-- Footer Info -->
                    <div class="footer-info">
                        <?php if (has_custom_logo()) : ?>
                            <div class="footer-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <h3 class="footer-site-title"><?php bloginfo('name'); ?></h3>
                        <?php endif; ?>

                        <p class="footer-description">
                            <?php
                            $description = get_bloginfo('description', 'display');
                            echo $description ? esc_html($description) : esc_html__('Professional WordPress Developer & Designer', 'anwar');
                            ?>
                        </p>

                        <!-- Social Links -->
                        <div class="footer-social">
                            <?php
                            $social_links = array(
                                'github' => get_theme_mod('anwar_github_url', '#'),
                                'linkedin' => get_theme_mod('anwar_linkedin_url', '#'),
                                'twitter' => get_theme_mod('anwar_twitter_url', '#'),
                                'instagram' => get_theme_mod('anwar_instagram_url', '#'),
                                'facebook' => get_theme_mod('anwar_facebook_url', '#'),
                            );

                            foreach ($social_links as $platform => $url) :
                                if ($url && $url !== '#') :
                            ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(ucfirst($platform)); ?>">
                                    <i class="fab fa-<?php echo esc_attr($platform); ?>"></i>
                                </a>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>

                    <!-- Footer Quick Links -->
                    <div class="footer-links">
                        <h4><?php esc_html_e('Quick Links', 'anwar'); ?></h4>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'depth'          => 1,
                        ));
                        ?>
                    </div>

                    <!-- Footer Contact -->
                    <div class="footer-contact">
                        <h4><?php esc_html_e('Get In Touch', 'anwar'); ?></h4>
                        <ul class="contact-list">
                            <?php
                            $email = get_theme_mod('anwar_contact_email', '');
                            $phone = get_theme_mod('anwar_contact_phone', '');
                            $address = get_theme_mod('anwar_contact_address', '');

                            if ($email) :
                            ?>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if ($phone) : ?>
                                <li>
                                    <i class="fas fa-phone"></i>
                                    <a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if ($address) : ?>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo esc_html($address); ?></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Newsletter Signup (Optional) -->
                    <?php if (get_theme_mod('anwar_show_newsletter', false)) : ?>
                    <div class="footer-newsletter">
                        <h4><?php esc_html_e('Newsletter', 'anwar'); ?></h4>
                        <p><?php esc_html_e('Subscribe to get latest updates', 'anwar'); ?></p>
                        <form class="newsletter-form" id="newsletter-form">
                            <input type="email" placeholder="<?php esc_attr_e('Your email', 'anwar'); ?>" required>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p class="copyright">
                        <?php
                        printf(
                            esc_html__('&copy; %1$s %2$s. All rights reserved.', 'anwar'),
                            date('Y'),
                            get_bloginfo('name')
                        );
                        ?>
                    </p>
                    <p class="credits">
                        <?php
                        printf(
                            esc_html__('Built with %s using WordPress', 'anwar'),
                            '<i class="fas fa-heart" style="color: #e74c3c;"></i>'
                        );
                        ?>
                    </p>
                </div>
            </div>
        </div>

    </footer><!-- #colophon -->

</div><!-- #page -->

<!-- Back to Top Button -->
<button id="back-to-top" class="back-to-top" aria-label="Back to top">
    <i class="fas fa-arrow-up"></i>
</button>

<?php wp_footer(); ?>

</body>
</html>