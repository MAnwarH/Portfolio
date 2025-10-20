# Anwar Portfolio - WordPress Website

A modern, professional WordPress portfolio website built with a custom theme designed for developers, designers, and creative professionals.

![WordPress](https://img.shields.io/badge/WordPress-6.7-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.4+-purple.svg)
![License](https://img.shields.io/badge/License-GPL%20v2-green.svg)

## 🌟 About This Project

This repository contains a complete WordPress installation featuring the **Anwar Theme** - a custom-built portfolio theme with modern design principles, dark/light mode, and extensive customization options.

## ✨ Key Features

### 🎨 Custom Portfolio Theme
- **Modern & Clean Design** - Professional aesthetic with smooth animations
- **Dark/Light Mode Toggle** - Automatic theme switching with user preference memory
- **Fully Responsive** - Perfect display on all devices (mobile, tablet, desktop)
- **Custom Post Types** - Portfolio projects and Testimonials with meta fields
- **SEO Optimized** - Built-in Schema markup and best practices

### 📱 Page Templates
- **Hero/Landing Page** - Eye-catching animated hero section
- **About Page** - Professional bio with skills and tech stack
- **Services Page** - Detailed service offerings
- **Portfolio Archive** - Filterable project showcase
- **Single Portfolio** - Case study layout with project details
- **Contact Page** - Working AJAX contact form

### 🛠️ Technical Features
- Custom navigation menus (Primary + Footer)
- Widget-ready areas (Sidebar + 4 Footer widgets)
- AJAX-powered contact form
- Portfolio filtering system
- Social media integration
- Newsletter signup
- Mobile-optimized menu
- Sticky header
- Back to top button
- Google Fonts (Inter & Poppins)
- Font Awesome icons
- AOS (Animate on Scroll)

### 📊 Included Sections
- Stats counter with animations
- Services showcase
- Client testimonials with ratings
- Call-to-action areas
- FAQ accordion
- Blog with sidebar
- Footer with multiple widget areas

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7+ or MariaDB 10.2+
- WordPress 5.8+
- Modern web server (Apache/Nginx)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/MAnwarH/Portfolio.git
   cd Portfolio
   ```

2. **Setup WordPress**
   - Import your database or run WordPress installation
   - Configure `wp-config.php` with your database credentials
   - Set proper file permissions

3. **Activate the Theme**
   - Go to WordPress Admin → Appearance → Themes
   - Activate "Anwar" theme

4. **Configure the Theme**
   - Go to Appearance → Customize
   - Configure hero section, contact info, social links, and colors
   - Create pages using the provided templates

5. **Setup Content**
   - Create essential pages (Home, About, Services, Contact)
   - Add portfolio items via Portfolio → Add New
   - Add testimonials via Testimonials → Add New
   - Configure menus in Appearance → Menus

## 📁 Theme Structure

```
wp-content/themes/Anwar/
├── assets/
│   ├── css/          # Stylesheets
│   ├── js/           # JavaScript files
│   └── images/       # Theme images
├── inc/              # Theme includes
│   ├── customizer.php
│   ├── post-types.php
│   └── widgets.php
├── template-parts/   # Reusable template components
├── front-page.php    # Homepage template
├── page-about.php    # About page template
├── page-services.php # Services page template
├── page-contact.php  # Contact page template
├── archive-portfolio.php
├── single-portfolio.php
├── functions.php
├── header.php
├── footer.php
└── style.css
```

## 🎨 Customization

### Color Scheme
The theme uses CSS variables for easy customization. Edit in Customizer or add to Additional CSS:

```css
:root {
    --primary-color: #2563eb;
    --accent-color: #10b981;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --background: #ffffff;
}
```

### Child Theme
For extensive customizations, create a child theme:

```php
// anwar-child/style.css
/*
Theme Name: Anwar Child
Template: Anwar
*/

// anwar-child/functions.php
<?php
function anwar_child_enqueue_styles() {
    wp_enqueue_style('anwar-parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'anwar_child_enqueue_styles');
```

## 📝 Configuration

### Theme Options (via Customizer)

1. **Hero Section**
   - Greeting text, title, description
   - Hero image upload
   - Trust element text

2. **Stats Section**
   - Websites built, clients served
   - Plugins created, years of experience

3. **Contact Information**
   - Email, phone, address
   - WhatsApp & Telegram
   - Google Maps embed
   - Availability status

4. **Social Media**
   - GitHub, LinkedIn, Twitter
   - Instagram, Facebook links

5. **Branding**
   - Logo upload
   - Color customization

## 🔧 Recommended Plugins

- **Contact Form 7** - Enhanced form functionality
- **Yoast SEO** - Advanced SEO features
- **WP Super Cache** - Performance caching
- **WP Mail SMTP** - Reliable email delivery
- **Autoptimize** - Asset minification

## 🌐 Browser Support

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- iOS Safari & Chrome Mobile

## 📄 License

This project is licensed under the GNU General Public License v2 or later - see the [LICENSE](license.txt) file for details.

## 👨‍💻 Author

**MD Anwar Hossain**
- GitHub: [@MAnwarH](https://github.com/MAnwarH)
- Email: md7anwarhossain@gmail.com

## 🙏 Credits

- WordPress - CMS Platform
- AOS Library - Scroll animations
- Font Awesome - Icon library
- Google Fonts - Typography (Inter & Poppins)

## 📞 Support

For issues, questions, or feature requests:
- Check the [theme README](wp-content/themes/Anwar/README.md) for detailed documentation
- Open an issue on GitHub
- Contact the theme author

## 📊 Version

**Current Version:** 1.0.0

### Changelog

#### v1.0.0 (2025-01-13)
- Initial release
- Custom Anwar portfolio theme
- Portfolio and Testimonials custom post types
- Multiple page templates
- Dark/Light mode toggle
- AJAX contact form
- Responsive design
- SEO optimization

---

**Built with ❤️ using WordPress**
