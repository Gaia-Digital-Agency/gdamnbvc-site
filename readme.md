# Rob Peetom School Of Life Site

## Table of Contents

- [Project Overview](#project-overview)
- [Repository Structure](#repository-structure)
- [WordPress File Structure](#wordpress-file-structure)
- [Getting Started](#getting-started)
- [Development Workflow](#development-workflow)
- [Deployment](#deployment)
- [Configuration](#configuration)
- [Backup & Recovery](#backup--recovery)
- [Contributing](#contributing)

## Project Overview

**Client:** GDAMNBVC  
**Agency:** [Gaia Digital Agency](https://github.com/Gaia-Digital-Agency)  
**Platform:** WordPress  
**Status:** Ongoing Development  

This repository contains the WordPress installation for the GDAMNBVC website, including custom themes, plugins, and configurations managed by the Gaia Digital Agency development team.

### Tech Stack

| Component | Technology |
|-----------|------------|
| CMS | WordPress 6.x |
| Backend | PHP 8.x |
| Database | MySQL 8.0 / MariaDB 10.6+ |
| Frontend | HTML5, CSS3, JavaScript |
| Server | Apache / Nginx |

## Repository Structure

```
gdamnbvc-site/
├── repo/
│   └── test/
│       └── wordpress/          # Test/staging WordPress instance
├── wp-content/                 # WordPress content directory (tracked)
│   ├── themes/                 # Custom and child themes
│   ├── plugins/                # Installed plugins
│   ├── uploads/                # Media uploads (typically gitignored)
│   ├── languages/              # Translation files
│   └── mu-plugins/             # Must-use plugins
├── .backup_log                 # Backup operation logs
├── .gitignore                  # Git ignore rules
├── license.txt                 # WordPress GPL license
├── readme.html                 # WordPress default readme
├── wp-config-sample.php        # Sample configuration file
└── README.md                   # This file
```

## WordPress File Structure

Below is the complete WordPress file structure for reference. Files/folders marked with `[tracked]` are version controlled; those marked `[ignored]` are excluded via `.gitignore`.

```
wordpress/
│
├── wp-admin/                       [ignored] # WordPress admin dashboard
│   ├── css/                        # Admin stylesheets
│   ├── images/                     # Admin images
│   ├── includes/                   # Admin PHP includes
│   ├── js/                         # Admin JavaScript
│   ├── maint/                      # Maintenance mode files
│   ├── network/                    # Multisite network admin
│   └── user/                       # User profile pages
│
├── wp-includes/                    [ignored] # WordPress core includes
│   ├── blocks/                     # Gutenberg block definitions
│   ├── certificates/               # SSL certificates
│   ├── css/                        # Core stylesheets
│   ├── fonts/                      # Core fonts
│   ├── images/                     # Core images
│   ├── js/                         # Core JavaScript
│   ├── rest-api/                   # REST API classes
│   ├── theme-compat/               # Theme compatibility
│   ├── widgets/                    # Widget classes
│   └── *.php                       # Core PHP files
│
├── wp-content/                     [tracked]  # CUSTOMIZATIONS GO HERE
│   │
│   ├── themes/                     [tracked]  # Theme files
│   │   ├── theme-name/             # Active theme
│   │   │   ├── assets/             # Theme assets (css, js, images)
│   │   │   │   ├── css/
│   │   │   │   ├── js/
│   │   │   │   └── images/
│   │   │   ├── inc/                # PHP includes
│   │   │   ├── template-parts/     # Reusable template parts
│   │   │   ├── templates/          # Page templates
│   │   │   ├── functions.php       # Theme functions
│   │   │   ├── style.css           # Main stylesheet (required)
│   │   │   ├── index.php           # Main template (required)
│   │   │   ├── header.php          # Header template
│   │   │   ├── footer.php          # Footer template
│   │   │   ├── sidebar.php         # Sidebar template
│   │   │   ├── single.php          # Single post template
│   │   │   ├── page.php            # Page template
│   │   │   ├── archive.php         # Archive template
│   │   │   ├── search.php          # Search results template
│   │   │   ├── 404.php             # 404 error template
│   │   │   ├── comments.php        # Comments template
│   │   │   └── screenshot.png      # Theme screenshot
│   │   │
│   │   └── theme-name-child/       # Child theme (if applicable)
│   │       ├── style.css
│   │       └── functions.php
│   │
│   ├── plugins/                    [tracked]  # Plugin files
│   │   ├── plugin-name/
│   │   │   ├── assets/
│   │   │   ├── includes/
│   │   │   ├── languages/
│   │   │   ├── templates/
│   │   │   └── plugin-name.php     # Main plugin file
│   │   └── ...
│   │
│   ├── mu-plugins/                 [tracked]  # Must-use plugins
│   │   └── *.php                   # Auto-loaded plugins
│   │
│   ├── uploads/                    [ignored]  # Media library
│   │   ├── 2024/                   # Year-based folders
│   │   │   ├── 01/                 # Month-based folders
│   │   │   └── ...
│   │   └── ...
│   │
│   ├── languages/                  [tracked]  # Translation files
│   │   ├── plugins/                # Plugin translations
│   │   ├── themes/                 # Theme translations
│   │   └── *.mo, *.po              # Core translations
│   │
│   ├── upgrade/                    [ignored]  # Upgrade working directory
│   ├── cache/                      [ignored]  # Cache files
│   ├── debug.log                   [ignored]  # Debug log file
│   └── index.php                   # Security index file
│
├── .htaccess                       [ignored]  # Apache configuration
├── index.php                       [ignored]  # WordPress entry point
├── license.txt                     [tracked]  # GPL license
├── readme.html                     [tracked]  # WordPress readme
├── wp-activate.php                 [ignored]  # Account activation
├── wp-blog-header.php              [ignored]  # Blog header loader
├── wp-comments-post.php            [ignored]  # Comment handler
├── wp-config.php                   [ignored]  # Configuration (SENSITIVE)
├── wp-config-sample.php            [tracked]  # Sample configuration
├── wp-cron.php                     [ignored]  # Scheduled tasks
├── wp-links-opml.php               [ignored]  # OPML export
├── wp-load.php                     [ignored]  # WordPress loader
├── wp-login.php                    [ignored]  # Login page
├── wp-mail.php                     [ignored]  # Email handler
├── wp-settings.php                 [ignored]  # Core settings
├── wp-signup.php                   [ignored]  # User signup
├── wp-trackback.php                [ignored]  # Trackback handler
└── xmlrpc.php                      [ignored]  # XML-RPC interface
```

## Getting Started

### Prerequisites

- PHP 8.0+ (recommended: 8.3)
- MySQL 8.0+ or MariaDB 10.6+
- Apache with `mod_rewrite` or Nginx
- Composer (optional, for dependency management)
- Git
- Local development environment (LocalWP, XAMPP, MAMP, Docker, etc.)

### Local Development Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Gaia-Digital-Agency/gdamnbvc-site.git
   cd gdamnbvc-site
   ```

2. **Set up local WordPress:**
   - Download WordPress core files (not tracked in repo)
   - Place them in the project root

3. **Configure the database:**
   ```bash
   cp wp-config-sample.php wp-config.php
   ```
   Edit `wp-config.php` with your local database credentials:
   ```php
   define('DB_NAME', 'gdamnbvc_local');
   define('DB_USER', 'root');
   define('DB_PASSWORD', 'your_password');
   define('DB_HOST', 'localhost');
   ```

4. **Generate security keys:**
   Visit [WordPress Salt Generator](https://api.wordpress.org/secret-key/1.1/salt/) and paste the generated keys into `wp-config.php`.

5. **Import the database:**
   ```bash
   mysql -u root -p gdamnbvc_local < database_backup.sql
   ```

6. **Update site URLs (if needed):**
   ```sql
   UPDATE wp_options SET option_value = 'http://localhost/gdamnbvc' 
   WHERE option_name IN ('siteurl', 'home');
   ```

7. **Access the site:**
   - Frontend: `http://localhost/gdamnbvc`
   - Admin: `http://localhost/gdamnbvc/wp-admin`

## Development Workflow

### Branch Strategy

| Branch | Purpose |
|--------|---------|
| `main` | Production-ready code |
| `staging` | Pre-production testing |
| `develop` | Active development |
| `feature/*` | New features |
| `hotfix/*` | Emergency fixes |

### Workflow Steps

1. **Create a feature branch:**
   ```bash
   git checkout develop
   git pull origin develop
   git checkout -b feature/your-feature-name
   ```

2. **Make changes and commit:**
   ```bash
   git add .
   git commit -m "feat: add new feature description"
   ```

3. **Push and create PR:**
   ```bash
   git push origin feature/your-feature-name
   ```

4. **Create Pull Request** on GitHub for code review.

### Commit Message Convention

Follow [Conventional Commits](https://www.conventionalcommits.org/):

```
feat:     New feature
fix:      Bug fix
docs:     Documentation only
style:    Formatting, missing semicolons, etc.
refactor: Code refactoring
test:     Adding tests
chore:    Maintenance tasks
```

## Deployment

### Production Deployment Checklist

- [ ] Backup current production database and files
- [ ] Test all changes on staging environment
- [ ] Update `wp-config.php` for production settings
- [ ] Disable debug mode (`WP_DEBUG` = false)
- [ ] Clear all caches
- [ ] Run database migrations if needed
- [ ] Verify SSL certificate
- [ ] Test critical functionality

### Deployment Methods

**Option 1: Git Pull (Recommended)**
```bash
ssh user@server
cd /var/www/gdamnbvc
git pull origin main
```

**Option 2: Manual Upload**
- Upload changed files via SFTP/FTP
- Ensure file permissions are correct (755 for directories, 644 for files)

**Option 3: CI/CD Pipeline**
- Configure GitHub Actions for automated deployment
- See `.github/workflows/` for pipeline configuration

## Configuration

### Environment-Specific Settings

Add to `wp-config.php`:

```php
// Environment detection
define('WP_ENVIRONMENT_TYPE', 'production'); // local, development, staging, production

// Debug settings (disable in production)
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Performance
define('WP_CACHE', true);
define('COMPRESS_CSS', true);
define('COMPRESS_SCRIPTS', true);

// Security
define('DISALLOW_FILE_EDIT', true);
define('FORCE_SSL_ADMIN', true);

// Memory limits
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');
```

### Recommended .gitignore

```gitignore
# WordPress Core (downloaded separately)
/wp-admin/
/wp-includes/
/index.php
/wp-*.php
!wp-config-sample.php
/xmlrpc.php
/.htaccess

# Configuration (contains sensitive data)
/wp-config.php

# Uploads (too large for git)
/wp-content/uploads/
/wp-content/upgrade/
/wp-content/cache/
/wp-content/w3tc-config/

# Logs
*.log
/wp-content/debug.log

# OS files
.DS_Store
Thumbs.db

# IDE
.idea/
.vscode/
*.sublime-*

# Dependencies
/node_modules/
/vendor/
```

## Backup & Recovery

### Backup Strategy

| Component | Frequency | Method |
|-----------|-----------|--------|
| Database | Daily | Automated mysqldump |
| wp-content | Daily | File sync |
| Full site | Weekly | Complete archive |

### Manual Backup Commands

**Database:**
```bash
mysqldump -u user -p database_name > backup_$(date +%Y%m%d).sql
```

**Files:**
```bash
tar -czvf wp-content_$(date +%Y%m%d).tar.gz wp-content/
```

### Recovery

1. Restore database:
   ```bash
   mysql -u user -p database_name < backup_file.sql
   ```

2. Restore files:
   ```bash
   tar -xzvf wp-content_backup.tar.gz
   ```

## Contributing

### Team Members

| Role | Responsibility |
|------|----------------|
| Project Lead | Overall project management |
| Frontend Dev | Theme development, CSS, JS |
| Backend Dev | Plugin development, PHP |
| QA | Testing and quality assurance |

### Code Standards

- Follow [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- Use meaningful variable and function names
- Comment complex logic
- Test thoroughly before committing

### Pull Request Process

1. Ensure code follows WordPress coding standards
2. Update documentation if needed
3. Test on local and staging environments
4. Request review from at least one team member
5. Merge only after approval
