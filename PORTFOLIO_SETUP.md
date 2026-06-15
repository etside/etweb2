# Portfolio Feature Implementation

## Overview
A complete portfolio management system for engineersTech built with Laravel, Vite, Tailwind CSS, and Alpine.js, following the same tech stack as the rest of the application.

## Features

✅ **Filterable Portfolio Grid**
- Category-based filtering with smooth transitions
- Responsive grid layout (1 column on mobile, 2 on tablet, 3 on desktop)
- Hover effects with scale animation and arrow indicators

✅ **Portfolio Management**
- Database models for portfolio items and categories
- Admin-ready structure for CRUD operations
- Support for featured items and custom sorting

✅ **Portfolio Details Page**
- Individual project showcase with full descriptions
- Project metadata (client, category, completion date)
- Related projects from same category
- Logo display and external links

✅ **Statistics Section**
- Display key metrics (projects completed, happy clients, countries served)
- Customizable stats in controller

✅ **SEO & Metadata**
- Dynamic page titles
- URL slugs for clean routing
- Description fields for each project

## Files Created

### Database
- **Migrations**: `2026_06_15_000001_create_portfolio_items_table.php`
  - `portfolio_items` table with all project information
  - `portfolio_categories` table for category management

### Models
- **PortfolioItem** (`app/Models/PortfolioItem.php`)
  - Query scopes for filtering and sorting
  - Category grouping methods
- **PortfolioCategory** (`app/Models/PortfolioCategory.php`)

### Controllers
- **PortfolioController** (`app/Http/Controllers/PortfolioController.php`)
  - `index()` - Display portfolio with optional category filter
  - `show()` - Display individual project details
  - JSON response support for API integration

### Views
- **Portfolio Index** (`resources/views/portfolio/index.blade.php`)
  - Hero section with stats
  - Filter buttons with Alpine.js
  - Portfolio grid with cards
  - CTA section
- **Portfolio Show** (`resources/views/portfolio/show.blade.php`)
  - Project hero section
  - Full project details
  - Related projects sidebar
  - Client information

### Routes
- `GET /portfolio` → Portfolio listing page
- `GET /portfolio?category=web-development` → Filtered portfolio
- `GET /portfolio/{slug}` → Individual project page

### Seeder
- **PortfolioItemSeeder** (`database/seeders/PortfolioItemSeeder.php`)
  - 15 sample portfolio items across different categories
  - Includes all major service categories

## Installation & Setup

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Seed Sample Data
```bash
php artisan db:seed --class=PortfolioItemSeeder
```

Or seed all data (including portfolio):
```bash
php artisan db:seed
```

### 3. Build Frontend Assets
```bash
npm run build
```

### 4. Access Portfolio
- **Portfolio Listing**: `http://localhost:8000/portfolio`
- **Specific Category**: `http://localhost:8000/portfolio?category=web-development`
- **Project Detail**: `http://localhost:8000/portfolio/symlex-vpn`

## Customization

### Update Stats
Edit `PortfolioController@index()` to modify the stats array:
```php
$stats = [
    ['label' => 'Your Label', 'value' => 'Your Value'],
    // ...
];
```

### Add Categories
Categories are auto-detected from portfolio items based on the `category` field. Add new portfolio items with new categories to automatically expand the filter options.

### Styling
The portfolio uses Tailwind CSS classes. Modify color schemes in `resources/views/portfolio/` files:
- Primary color: `blue-600` (change to your brand color)
- Backgrounds: `gray-50`, `white`
- Hover states: `hover:scale-105`, `hover:shadow-2xl`

### Update Placeholder Images
Replace `https://via.placeholder.com/` URLs in the seeder with actual image paths:
```php
'image_url' => 'storage/portfolio/project-1.jpg',
'logo_url' => 'storage/logos/client-logo.png',
```

## API Integration

The controller supports JSON responses for frontend API calls:

```bash
# Get all portfolio items
curl http://localhost:8000/portfolio?Accept=application/json

# Get filtered items
curl http://localhost:8000/portfolio?category=web-development&Accept=application/json
```

Response:
```json
{
  "items": [...],
  "categories": [...]
}
```

## Future Enhancements

- [ ] Admin dashboard for portfolio management
- [ ] Image upload & optimization
- [ ] Testimonials per project
- [ ] Project tags and search
- [ ] Pagination for large portfolios
- [ ] Analytics tracking
- [ ] Social sharing buttons
- [ ] Project comparison feature

## Tech Stack Used

- **Backend**: Laravel 12
- **Frontend**: Vite 7 + Tailwind CSS 3
- **Interactivity**: Alpine.js 3
- **Database**: Laravel migrations & Eloquent ORM
- **Styling**: Tailwind utility classes with custom transitions

## Notes

- All images currently use placeholder URLs; replace with actual project images
- The portfolio uses Alpine.js for category filtering (no page reload)
- Responsive design works seamlessly across all devices
- Related projects query is limited to 3 items for performance
