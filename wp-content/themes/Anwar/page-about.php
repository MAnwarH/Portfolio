<?php
/**
 * Template Name: About Page
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
                <?php echo esc_html(get_theme_mod('anwar_about_subtitle', 'Learn more about my journey and expertise')); ?>
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-section section">
        <div class="container">
            <div class="about-content-wrapper">
                <!-- Profile Image -->
                <div class="about-image" data-aos="fade-right">
                    <?php
                    $profile_image = get_theme_mod('anwar_profile_image', '');
                    if ($profile_image) :
                    ?>
                        <img src="<?php echo esc_url($profile_image); ?>" alt="<?php esc_attr_e('Profile Photo', 'anwar'); ?>" class="profile-photo">
                    <?php elseif (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', array('class' => 'profile-photo', 'alt' => get_the_title())); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/profile-placeholder.jpg'); ?>" alt="<?php esc_attr_e('Profile Photo', 'anwar'); ?>" class="profile-photo">
                    <?php endif; ?>

                    <!-- Decorative Elements -->
                    <div class="about-decoration">
                        <div class="decoration-circle"></div>
                        <div class="decoration-dots"></div>
                    </div>
                </div>

                <!-- About Text -->
                <div class="about-text" data-aos="fade-left">
                    <h2><?php echo esc_html(get_theme_mod('anwar_about_title', 'Professional WordPress Developer')); ?></h2>

                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            the_content();
                        endwhile;
                    else :
                    ?>
                        <p><?php esc_html_e('Hello! I\'m a passionate WordPress developer with years of experience creating beautiful, functional websites.', 'anwar'); ?></p>
                        <p><?php esc_html_e('My expertise spans custom theme development, plugin customization, performance optimization, and everything in between. I love turning complex problems into elegant solutions.', 'anwar'); ?></p>
                        <p><?php esc_html_e('When I\'m not coding, you\'ll find me learning new technologies, contributing to open source, or sharing my knowledge with the developer community.', 'anwar'); ?></p>
                    <?php endif; ?>

                    <div class="about-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-check-circle"></i>
                            <span><?php esc_html_e('5+ Years Experience', 'anwar'); ?></span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-check-circle"></i>
                            <span><?php esc_html_e('150+ Projects Completed', 'anwar'); ?></span>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-check-circle"></i>
                            <span><?php esc_html_e('100% Client Satisfaction', 'anwar'); ?></span>
                        </div>
                    </div>

                    <?php
                    $resume_url = get_theme_mod('anwar_resume_url', '');
                    if ($resume_url) :
                    ?>
                        <a href="<?php echo esc_url($resume_url); ?>" class="btn btn-primary" download>
                            <i class="fas fa-download"></i>
                            <?php esc_html_e('Download Resume', 'anwar'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills-section section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('My Skills', 'anwar'); ?></h2>
                <p><?php esc_html_e('Technologies and tools I work with', 'anwar'); ?></p>
            </div>

            <div class="skills-content">
                <!-- Technical Skills -->
                <div class="skills-group" data-aos="fade-up">
                    <h3><?php esc_html_e('Technical Skills', 'anwar'); ?></h3>
                    <div class="skill-bars">
                        <?php
                        $technical_skills = array(
                            array('name' => 'WordPress', 'level' => 95),
                            array('name' => 'PHP', 'level' => 90),
                            array('name' => 'JavaScript/jQuery', 'level' => 85),
                            array('name' => 'HTML/CSS', 'level' => 95),
                            array('name' => 'MySQL', 'level' => 80),
                            array('name' => 'React', 'level' => 75),
                        );

                        foreach ($technical_skills as $skill) :
                        ?>
                            <div class="skill-bar">
                                <div class="skill-info">
                                    <span class="skill-name"><?php echo esc_html($skill['name']); ?></span>
                                    <span class="skill-percentage"><?php echo esc_html($skill['level']); ?>%</span>
                                </div>
                                <div class="skill-progress">
                                    <div class="skill-progress-bar" data-progress="<?php echo esc_attr($skill['level']); ?>"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Tools & Platforms -->
                <div class="skills-group" data-aos="fade-up" data-aos-delay="100">
                    <h3><?php esc_html_e('Tools & Platforms', 'anwar'); ?></h3>
                    <div class="skill-tags">
                        <?php
                        $tools = array(
                            'Elementor', 'Divi', 'Gutenberg', 'WooCommerce',
                            'ACF', 'Git', 'Docker', 'Webpack',
                            'REST API', 'GraphQL', 'npm', 'Composer'
                        );

                        foreach ($tools as $tool) :
                        ?>
                            <span class="skill-tag"><?php echo esc_html($tool); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Timeline -->
    <section class="timeline-section section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('My Journey', 'anwar'); ?></h2>
                <p><?php esc_html_e('Career milestones and achievements', 'anwar'); ?></p>
            </div>

            <div class="timeline">
                <?php
                $timeline_items = array(
                    array(
                        'year' => '2025',
                        'title' => 'Senior WordPress Developer',
                        'company' => 'Freelance',
                        'description' => 'Providing expert WordPress development services to clients worldwide.',
                    ),
                    array(
                        'year' => '2023',
                        'title' => 'WordPress Developer',
                        'company' => 'Digital Agency',
                        'description' => 'Led multiple high-profile WordPress projects for enterprise clients.',
                    ),
                    array(
                        'year' => '2021',
                        'title' => 'Junior Developer',
                        'company' => 'Tech Startup',
                        'description' => 'Developed custom WordPress themes and plugins for startup clients.',
                    ),
                    array(
                        'year' => '2020',
                        'title' => 'Started WordPress Journey',
                        'company' => 'Self-taught',
                        'description' => 'Began learning WordPress development and built first client projects.',
                    ),
                );

                foreach ($timeline_items as $index => $item) :
                    $position = $index % 2 == 0 ? 'left' : 'right';
                ?>
                    <div class="timeline-item timeline-<?php echo esc_attr($position); ?>" data-aos="fade-<?php echo $position == 'left' ? 'right' : 'left'; ?>">
                        <div class="timeline-content">
                            <span class="timeline-year"><?php echo esc_html($item['year']); ?></span>
                            <h3 class="timeline-title"><?php echo esc_html($item['title']); ?></h3>
                            <h4 class="timeline-company"><?php echo esc_html($item['company']); ?></h4>
                            <p class="timeline-description"><?php echo esc_html($item['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Tech Stack Section -->
    <section class="tech-stack-section section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2><?php esc_html_e('Tech Stack', 'anwar'); ?></h2>
                <p><?php esc_html_e('Technologies I use to build amazing websites', 'anwar'); ?></p>
            </div>

            <div class="tech-stack-grid">
                <?php
                $tech_stack = array(
                    array('name' => 'WordPress', 'icon' => 'fab fa-wordpress'),
                    array('name' => 'PHP', 'icon' => 'fab fa-php'),
                    array('name' => 'JavaScript', 'icon' => 'fab fa-js'),
                    array('name' => 'React', 'icon' => 'fab fa-react'),
                    array('name' => 'HTML5', 'icon' => 'fab fa-html5'),
                    array('name' => 'CSS3', 'icon' => 'fab fa-css3-alt'),
                    array('name' => 'Git', 'icon' => 'fab fa-git-alt'),
                    array('name' => 'Docker', 'icon' => 'fab fa-docker'),
                    array('name' => 'Node.js', 'icon' => 'fab fa-node-js'),
                    array('name' => 'npm', 'icon' => 'fab fa-npm'),
                    array('name' => 'Sass', 'icon' => 'fab fa-sass'),
                    array('name' => 'GitHub', 'icon' => 'fab fa-github'),
                );

                foreach ($tech_stack as $index => $tech) :
                ?>
                    <div class="tech-item" data-aos="zoom-in" data-aos-delay="<?php echo $index * 50; ?>">
                        <i class="<?php echo esc_attr($tech['icon']); ?>"></i>
                        <span><?php echo esc_html($tech['name']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2><?php esc_html_e('Let\'s Work Together!', 'anwar'); ?></h2>
                <p><?php esc_html_e('Have a project in mind? Let\'s discuss how I can help bring your vision to life.', 'anwar'); ?></p>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-envelope"></i>
                    <?php esc_html_e('Get In Touch', 'anwar'); ?>
                </a>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php
get_footer();