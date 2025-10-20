/**
 * Anwar Theme Main JavaScript
 *
 * @package Anwar
 */

(function($) {
    'use strict';

    // Initialize AOS (Animate on Scroll) if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    }

    /**
     * Dark/Light Mode Toggle
     */
    const themeToggle = $('#theme-toggle');
    const darkIcon = $('#theme-toggle-dark-icon');
    const lightIcon = $('#theme-toggle-light-icon');

    // Check for saved theme preference or default to 'light'
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.body.setAttribute('data-theme', currentTheme);

    if (currentTheme === 'dark') {
        darkIcon.hide();
        lightIcon.show();
    }

    themeToggle.on('click', function() {
        const theme = document.body.getAttribute('data-theme');
        const newTheme = theme === 'light' ? 'dark' : 'light';

        document.body.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);

        if (newTheme === 'dark') {
            darkIcon.hide();
            lightIcon.show();
        } else {
            darkIcon.show();
            lightIcon.hide();
        }
    });

    /**
     * Mobile Menu Toggle
     */
    const mobileMenuToggle = $('.mobile-menu-toggle');
    const mobileMenu = $('#mobile-menu');

    mobileMenuToggle.on('click', function() {
        $(this).toggleClass('active');
        mobileMenu.toggleClass('active');
        $('body').toggleClass('menu-open');

        // Animate hamburger lines
        const lines = $(this).find('.hamburger-line');
        if ($(this).hasClass('active')) {
            lines.eq(0).css('transform', 'rotate(45deg) translate(5px, 5px)');
            lines.eq(1).css('opacity', '0');
            lines.eq(2).css('transform', 'rotate(-45deg) translate(7px, -6px)');
        } else {
            lines.css('transform', '');
            lines.eq(1).css('opacity', '1');
        }
    });

    // Close mobile menu when clicking on a link
    $('.mobile-nav-menu a').on('click', function() {
        mobileMenuToggle.removeClass('active');
        mobileMenu.removeClass('active');
        $('body').removeClass('menu-open');
        $('.hamburger-line').css('transform', '');
        $('.hamburger-line').eq(1).css('opacity', '1');
    });

    /**
     * Sticky Header on Scroll
     */
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 100) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
    });

    /**
     * Back to Top Button
     */
    const backToTop = $('#back-to-top');

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            backToTop.addClass('visible');
        } else {
            backToTop.removeClass('visible');
        }
    });

    backToTop.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 600);
    });

    /**
     * Smooth Scrolling for Anchor Links
     */
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));

        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 600);
        }
    });

    /**
     * Stats Counter Animation
     */
    function animateCounter(element) {
        const target = parseInt($(element).attr('data-count'));
        const duration = 2000;
        const steps = 60;
        const increment = target / steps;
        const stepDuration = duration / steps;
        let current = 0;

        const timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            $(element).text(Math.floor(current) + '+');
        }, stepDuration);
    }

    // Trigger counter animation when visible
    if ($('.stat-number').length) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !$(entry.target).hasClass('animated')) {
                    animateCounter(entry.target);
                    $(entry.target).addClass('animated');
                }
            });
        }, {
            threshold: 0.5
        });

        $('.stat-number').each(function() {
            observer.observe(this);
        });
    }

    /**
     * Skills Progress Bar Animation
     */
    if ($('.skill-progress-bar').length) {
        const skillObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !$(entry.target).hasClass('animated')) {
                    const progress = $(entry.target).attr('data-progress');
                    $(entry.target).css('width', progress + '%');
                    $(entry.target).addClass('animated');
                }
            });
        }, {
            threshold: 0.5
        });

        $('.skill-progress-bar').each(function() {
            skillObserver.observe(this);
        });
    }

    /**
     * Portfolio Filter
     */
    $('.filter-btn').on('click', function() {
        const filter = $(this).attr('data-filter');

        $('.filter-btn').removeClass('active');
        $(this).addClass('active');

        if (filter === '*') {
            $('.portfolio-masonry-item').fadeIn();
        } else {
            $('.portfolio-masonry-item').fadeOut(300, function() {
                $(filter).fadeIn();
            });
        }
    });

    /**
     * FAQ Accordion
     */
    $('.faq-question').on('click', function() {
        const faqItem = $(this).closest('.faq-item');
        const isActive = faqItem.hasClass('active');

        // Close all FAQ items
        $('.faq-item').removeClass('active');

        // Open clicked item if it wasn't active
        if (!isActive) {
            faqItem.addClass('active');
        }
    });

    /**
     * Contact Form Submission
     */
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const btnText = submitBtn.find('.btn-text');
        const btnLoading = submitBtn.find('.btn-loading');
        const formMessage = $('#form-message');

        // Disable submit button
        submitBtn.prop('disabled', true);
        btnText.hide();
        btnLoading.show();

        // Get form data
        const formData = {
            action: 'anwar_contact_form',
            name: form.find('input[name="name"]').val(),
            email: form.find('input[name="email"]').val(),
            phone: form.find('input[name="phone"]').val(),
            subject: form.find('select[name="subject"]').val(),
            message: form.find('textarea[name="message"]').val(),
            contact_nonce: form.find('input[name="contact_nonce"]').val()
        };

        // Send AJAX request
        $.ajax({
            url: anwarData.ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    formMessage.removeClass('error').addClass('success');
                    formMessage.html('<i class="fas fa-check-circle"></i> ' + response.data.message);
                    form[0].reset();
                } else {
                    formMessage.removeClass('success').addClass('error');
                    formMessage.html('<i class="fas fa-exclamation-circle"></i> ' + response.data.message);
                }
            },
            error: function() {
                formMessage.removeClass('success').addClass('error');
                formMessage.html('<i class="fas fa-exclamation-circle"></i> An error occurred. Please try again.');
            },
            complete: function() {
                submitBtn.prop('disabled', false);
                btnText.show();
                btnLoading.hide();

                // Hide message after 5 seconds
                setTimeout(function() {
                    formMessage.fadeOut(function() {
                        formMessage.removeClass('success error').show();
                    });
                }, 5000);
            }
        });
    });

    /**
     * Newsletter Form Submission
     */
    $('#newsletter-form').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const email = form.find('input[type="email"]').val();

        // Add your newsletter subscription logic here
        console.log('Newsletter subscription for:', email);

        // Show success message
        alert('Thank you for subscribing to our newsletter!');
        form[0].reset();
    });

    /**
     * Lazy Load Images
     */
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(function(img) {
            imageObserver.observe(img);
        });
    }

    /**
     * Portfolio Masonry Layout (if using Isotope or Masonry)
     */
    if (typeof $.fn.isotope !== 'undefined' && $('.portfolio-masonry-grid').length) {
        const $grid = $('.portfolio-masonry-grid').isotope({
            itemSelector: '.portfolio-masonry-item',
            layoutMode: 'masonry',
            masonry: {
                columnWidth: '.portfolio-masonry-item',
                gutter: 20
            }
        });

        // Filter items on button click
        $('.filter-btn').on('click', function() {
            const filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
    }

    /**
     * Preloader (optional)
     */
    $(window).on('load', function() {
        $('.preloader').fadeOut('slow');
    });

    /**
     * Typing Effect for Hero Section (optional)
     */
    if ($('.typing-text').length && typeof Typed !== 'undefined') {
        new Typed('.typing-text', {
            strings: [
                'WordPress Developer',
                'Theme Designer',
                'Plugin Expert',
                'Performance Optimizer'
            ],
            typeSpeed: 80,
            backSpeed: 40,
            backDelay: 2000,
            loop: true
        });
    }

    /**
     * Social Share Buttons
     */
    $('.share-btn').on('click', function(e) {
        const url = $(this).attr('href');
        if (url.includes('twitter.com') || url.includes('facebook.com') || url.includes('linkedin.com')) {
            e.preventDefault();
            window.open(url, 'share', 'width=600,height=400');
        }
    });

    /**
     * Form Validation
     */
    $('form input, form textarea, form select').on('blur', function() {
        const $this = $(this);
        if ($this.prop('required') && !$this.val()) {
            $this.addClass('error');
        } else {
            $this.removeClass('error');
        }
    });

    /**
     * Active Menu Item on Scroll
     */
    if ($('.nav-menu a[href^="#"]').length) {
        $(window).on('scroll', function() {
            let scrollPos = $(window).scrollTop() + 100;

            $('.nav-menu a[href^="#"]').each(function() {
                const target = $($(this).attr('href'));
                if (target.length) {
                    if (target.offset().top <= scrollPos && target.offset().top + target.outerHeight() > scrollPos) {
                        $('.nav-menu a').removeClass('active');
                        $(this).addClass('active');
                    }
                }
            });
        });
    }

    /**
     * Parallax Effect for Hero Section
     */
    if ($('.hero-section').length) {
        $(window).on('scroll', function() {
            const scrolled = $(window).scrollTop();
            $('.hero-image-wrapper').css('transform', 'translateY(' + (scrolled * 0.3) + 'px)');
        });
    }

    /**
     * Copy to Clipboard
     */
    $('.copy-btn').on('click', function() {
        const text = $(this).data('copy');
        navigator.clipboard.writeText(text).then(function() {
            alert('Copied to clipboard!');
        });
    });

    /**
     * Read More / Read Less Toggle
     */
    $('.read-more-btn').on('click', function(e) {
        e.preventDefault();
        const $content = $(this).prev('.read-more-content');
        $content.toggleClass('expanded');

        if ($content.hasClass('expanded')) {
            $(this).text('Read Less');
        } else {
            $(this).text('Read More');
        }
    });

    /**
     * Tooltip Initialization (if using Bootstrap or similar)
     */
    if (typeof $.fn.tooltip !== 'undefined') {
        $('[data-toggle="tooltip"]').tooltip();
    }

    /**
     * Detect mobile device
     */
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if (isMobile) {
        $('body').addClass('mobile-device');
    }

    /**
     * Cookie Consent (optional)
     */
    if (!localStorage.getItem('cookieConsent')) {
        // Show cookie consent banner
        // Implementation depends on your specific needs
    }

    /**
     * Console Welcome Message
     */
    console.log('%c👋 Welcome to Anwar Theme!', 'color: #2563eb; font-size: 16px; font-weight: bold;');
    console.log('%cBuilt with ❤️ using WordPress', 'color: #6b7280; font-size: 12px;');

})(jQuery);

/**
 * Load AOS Library (Animate on Scroll)
 * Add this before your closing </body> tag if not already included
 */
if (typeof AOS === 'undefined') {
    const aosScript = document.createElement('script');
    aosScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js';
    aosScript.onload = function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    };
    document.head.appendChild(aosScript);

    const aosStyle = document.createElement('link');
    aosStyle.rel = 'stylesheet';
    aosStyle.href = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css';
    document.head.appendChild(aosStyle);
}