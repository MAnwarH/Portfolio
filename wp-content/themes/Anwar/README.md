# Anwar - WordPress Portfolio Theme

A clean, modern WordPress portfolio theme designed specifically for WordPress developers, designers, and freelancers. Built with performance, SEO, and user experience in mind.

## Features

### 🌐 Core Features
- **Modern Portfolio Showcase** - Display your work with beautiful project galleries and case studies
- **Dark/Light Mode Toggle** - Automatic theme switching with user preference storage
- **Fully Responsive Design** - Perfect on all devices from mobile to desktop
- **Custom Post Types** - Portfolio items and Testimonials with custom meta fields
- **Advanced Customizer** - Extensive theme options without touching code
- **SEO Optimized** - Built-in Schema markup and SEO best practices
- **Performance Focused** - Fast loading times with lazy loading and optimized assets

### 📄 Page Templates
1. **Home/Hero Section** - Eye-catching landing page with animated elements
2. **About Page** - Professional bio with skills, timeline, and tech stack
3. **Services Page** - Detailed service offerings with pricing packages
4. **Portfolio Archive** - Filterable project grid with categories
5. **Single Portfolio** - Case study layout with project details
6. **Contact Page** - Working contact form with AJAX submission

### ✨ Included Sections
- **Stats Counter** - Animated statistics (projects, clients, experience)
- **Services Preview** - Showcase your offerings
- **Testimonials** - Client feedback with ratings
- **Call-to-Action** - Strategic CTAs throughout
- **Blog Support** - Full blog functionality with sidebar
- **FAQ Accordion** - Frequently asked questions section

### 🎨 Design Features
- Clean, minimal aesthetic
- Professional color scheme (customizable)
- Google Fonts integration (Inter & Poppins)
- Font Awesome icons
- Smooth animations with AOS (Animate on Scroll)
- Hover effects and transitions
- Mobile-first approach

### 🛠️ Technical Features
- Custom Widget Areas (Sidebar + 4 Footer widgets)
- Navigation Menus (Primary + Footer)
- AJAX Contact Form
- Portfolio Filtering
- Social Media Integration
- Newsletter Signup
- Custom Logo Support
- Mobile Menu
- Sticky Header
- Back to Top Button
- Floating Hire Me Button

## Installation

### Requirements
- WordPress 5.8 or higher
- PHP 7.4 or higher
- Modern web browser

### Installation Steps

1. **Download the theme**
   - Download the Anwar theme folder

2. **Upload to WordPress**
   - Go to WordPress Admin → Appearance → Themes → Add New → Upload Theme
   - Choose the theme ZIP file and click "Install Now"
   - Activate the theme

3. **Install Recommended Plugins** (Optional but recommended)
   - Contact Form 7 (for enhanced forms)
   - Yoast SEO (for advanced SEO)
   - WP Super Cache (for caching)

## Setup Guide

### 1. Initial Configuration

After activating the theme, go to **Appearance → Customize** to configure:

#### Hero Section
- Set your greeting text
- Add hero title and description
- Upload hero image
- Configure trust element text

#### Stats Section
- Set numbers for websites built, clients, plugins, and years of experience

#### Contact Information
- Add your email, phone, and address
- Configure WhatsApp and Telegram
- Add Google Maps embed code
- Set availability status

#### Social Media
- Add URLs for GitHub, LinkedIn, Twitter, Instagram, Facebook

#### Colors & Branding
- Upload your logo
- Customize colors (uses CSS variables for easy theming)

### 2. Create Essential Pages

Create the following pages with their respective templates:

**Home Page:**
1. Create a new page called "Home"
2. In Settings → Reading, set "A static page" and choose "Home" as the Front page

**About Page:**
1. Create page titled "About"
2. Select template: "About Page"
3. Add content and upload profile photo

**Services Page:**
1. Create page titled "Services"
2. Select template: "Services Page"
3. Add service descriptions

**Contact Page:**
1. Create page titled "Contact"
2. Select template: "Contact Page"
3. Form will work automatically with AJAX

### 3. Setup Menus

Go to **Appearance → Menus**:

1. Create a Primary Menu:
   - Add Home, About, Services, Portfolio, Contact
   - Assign to "Primary Menu" location

2. Create a Footer Menu (optional):
   - Add quick links
   - Assign to "Footer Menu" location

### 4. Add Portfolio Items

1. Go to **Portfolio → Add New**
2. Add title, content, and featured image
3. Fill in portfolio details:
   - Client Name
   - Project URL
   - Technologies Used
   - Completion Date
4. Assign portfolio categories
5. Publish

### 5. Add Testimonials

1. Go to **Testimonials → Add New**
2. Add client name as title
3. Add testimonial text in content
4. Upload client photo (featured image)
5. Fill in testimonial details:
   - Company Name
   - Position/Role
   - Rating (1-5 stars)
6. Publish

### 6. Configure Widgets

Go to **Appearance → Widgets**:

**Sidebar Widget:**
- Add Search, Recent Posts, Categories widgets

**Footer Widgets:**
- Footer 1: About text
- Footer 2: Quick Links menu
- Footer 3: Contact info
- Footer 4: Newsletter or Social

## Customization

### CSS Variables

The theme uses CSS variables for easy customization. Edit `assets/css/custom.css`:

```css
:root {
    --primary-color: #2563eb;    /* Main brand color */
    --accent-color: #10b981;     /* Accent color */
    --text-primary: #1f2937;     /* Main text color */
    --text-secondary: #6b7280;   /* Secondary text */
    --background: #ffffff;       /* Background color */
}
```

### Adding Custom Styles

Add custom CSS in **Appearance → Customize → Additional CSS**

### Child Theme

For extensive customizations, create a child theme:

1. Create a new folder: `Anwar-child`
2. Create `style.css`:

```css
/*
Theme Name: Anwar Child
Template: Anwar
*/
```

3. Create `functions.php`:

```php
<?php
function anwar_child_enqueue_styles() {
    wp_enqueue_style('anwar-parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'anwar_child_enqueue_styles');
```

## Contact Form Setup

The theme includes a working AJAX contact form. Messages are sent to the admin email.

### Email Configuration

If emails aren't working:

1. Install **WP Mail SMTP** plugin
2. Configure SMTP settings
3. Test email sending

### Custom Email Recipient

Add this to `functions.php`:

```php
add_filter('anwar_contact_form_recipient', function() {
    return 'your-email@example.com';
});
```

## Performance Optimization

### Recommended Settings

1. **Install Caching Plugin**
   - WP Super Cache or W3 Total Cache

2. **Image Optimization**
   - Use WebP format
   - Install image optimization plugin

3. **Enable Lazy Loading**
   - Built into WordPress 5.5+

4. **Minify Assets**
   - Use Autoptimize plugin

### Speed Tips

- Keep plugins to a minimum
- Use a good hosting provider
- Enable CDN for static assets
- Optimize database regularly

## Troubleshooting

### Portfolio Not Showing

1. Go to **Settings → Permalinks**
2. Click "Save Changes" (this flushes rewrite rules)

### Contact Form Not Working

1. Check spam folder
2. Install WP Mail SMTP
3. Test with different email addresses

### Menu Not Appearing

1. Create a menu in Appearance → Menus
2. Assign it to "Primary Menu" location

### Styles Not Loading

1. Clear browser cache
2. Clear WordPress cache
3. Check file permissions
4. Regenerate assets

## Browser Support

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Credits

### Frameworks & Libraries
- WordPress - CMS Platform
- AOS - Animate On Scroll Library
- Font Awesome - Icon Library
- Google Fonts - Typography

### Inspiration
Built with best practices from WordPress Codex and modern web development standards.

## Support

For questions, issues, or feature requests:

- **Documentation**: Check this README
- **WordPress Support**: WordPress.org forums
- **Custom Development**: Contact the theme author

## Changelog

### Version 1.0.0 (2025-01-13)
- Initial release
- Hero section with animations
- Portfolio custom post type
- Testimonials custom post type
- About, Services, Contact page templates
- Dark/Light mode toggle
- AJAX contact form
- Customizer options
- Responsive design
- SEO optimization
- Performance optimization

## License

This theme is licensed under the GNU General Public License v2 or later.

## Author

Built with ❤️ for WordPress developers and designers.

---

**Enjoy using Anwar Theme! If you find it useful, please consider leaving a review.**