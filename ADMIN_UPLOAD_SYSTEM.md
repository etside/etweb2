# Admin Panel - Image & File Upload System

## Overview
Complete admin management system with image and logo upload capabilities for all content entities: Products, Services, Testimonials, and Portfolio Items.

## Files Created/Modified

### Database Migrations (New)
- `2026_06_15_000002_add_image_fields_to_products_table.php`
- `2026_06_15_000003_add_image_fields_to_services_table.php`
- `2026_06_15_000004_add_logo_to_testimonials_table.php`

### Models (Updated)
- **Product.php** - Added `image_url`, `logo_url` fields
- **Service.php** - Added `image_url`, `logo_url` fields
- **Testimonial.php** - Added `logo_url` field
- **PortfolioItem.php** - Already supports image_url, logo_url

### Controllers (New/Updated)
1. **ProductController.php** (Updated)
   - Added file upload handling for product image and logo
   - Uses HandleFileUploads trait

2. **ServiceController.php** (Updated)
   - Added file upload handling for service image and logo
   - Uses HandleFileUploads trait

3. **TestimonialController.php** (Updated)
   - Added company logo upload support
   - Uses HandleFileUploads trait

4. **PortfolioItemController.php** (New)
   - Complete CRUD operations for portfolio items
   - Image (up to 5MB) and logo (up to 2MB) uploads
   - Category management
   - Featured project flag
   - Sort order control

### Traits (New)
- **HandleFileUploads.php** - Reusable trait for file upload handling
  - `uploadFile()` - Single file upload
  - `uploadFiles()` - Multiple file uploads

### Views (New/Updated)

#### Admin Portfolio Management
- `admin/portfolio/index.blade.php` - Portfolio listing with thumbnails
- `admin/portfolio/form.blade.php` - Create/edit portfolio items

#### Admin Product Management (Updated)
- `admin/products/form.blade.php` - Added image and logo upload fields

#### Admin Service Management (Updated)
- `admin/services/form.blade.php` - Added image and logo upload fields

#### Admin Testimonial Management (Updated)
- `admin/testimonials/form.blade.php` - Added company logo upload field

### Routes (Updated)
- Added portfolio resource route to admin routes group
- Route: `/admin/portfolio` - Full REST resource

## Setup Instructions

### 1. Run Migrations
```bash
php artisan migrate
```

This will add the new columns to existing tables and create any new required tables.

### 2. File Storage Configuration
Make sure the storage directory is publicly accessible:

```bash
php artisan storage:link
```

This creates a symlink from `public/storage` to `storage/app/public`.

### 3. Ensure Permissions
Make sure the storage directory is writable:

```bash
chmod -R 775 storage/app/public
```

## Admin Panel Access

### Portfolio Management
- **List**: `/admin/portfolio`
- **Create**: `/admin/portfolio/create`
- **Edit**: `/admin/portfolio/{id}/edit`
- **Delete**: `/admin/portfolio/{id}` (POST with DELETE method)

### Other Entity Management
- **Products**: `/admin/products`
- **Services**: `/admin/services`
- **Testimonials**: `/admin/testimonials`

## Features

### Portfolio Items
✅ Title, description, client name
✅ Category system with custom categories
✅ Project image upload (up to 5MB)
✅ Project logo upload (up to 2MB)
✅ External link support
✅ Featured flag for showcase items
✅ Sort order control
✅ Active/Inactive status

### Products
✅ Product name, description, icon
✅ Product image upload (up to 2MB)
✅ Product logo upload (up to 2MB)
✅ External URL
✅ Display order
✅ Active/Inactive status

### Services
✅ Service title, description, icon
✅ Service image upload (up to 2MB)
✅ Service logo upload (up to 2MB)
✅ Display order
✅ Active/Inactive status

### Testimonials
✅ Person name, role, company
✅ Quote/testimonial text
✅ Profile photo upload (up to 2MB)
✅ Company logo upload (up to 2MB)
✅ Rating (1-5 stars)
✅ Display order
✅ Active/Inactive status

## File Upload Details

### Storage Location
- Products images: `storage/app/public/products/`
- Services images: `storage/app/public/services/`
- Portfolio images: `storage/app/public/portfolio/`
- Testimonials images: `storage/app/public/testimonials/`

### File Access URLs
All uploaded files are accessible via:
```
/storage/{folder}/{filename}
```

Example: `/storage/products/product-image.jpg`

### Upload Limits
- Images: 2MB maximum (5MB for portfolio project images)
- Allowed formats: jpg, jpeg, png, gif, webp, svg

### Image Optimization
For production, consider adding image compression/optimization using a package like `spatie/image`.

## Frontend Integration

### Display Portfolio Item with Image
```blade
<img src="{{ asset($portfolioItem->image_url) }}" alt="{{ $portfolioItem->title }}">
```

### Display Product with Logo
```blade
<img src="{{ asset($product->logo_url) }}" alt="{{ $product->name }}">
```

### Display Testimonial Photo and Company Logo
```blade
<img src="{{ asset($testimonial->photo_url) }}" alt="{{ $testimonial->name }}">
<img src="{{ asset($testimonial->logo_url) }}" alt="{{ $testimonial->company }}">
```

## Database Schema Changes

### Products Table
```sql
ALTER TABLE products ADD COLUMN image_url VARCHAR(255) NULL;
ALTER TABLE products ADD COLUMN logo_url VARCHAR(255) NULL;
```

### Services Table
```sql
ALTER TABLE services ADD COLUMN image_url VARCHAR(255) NULL;
ALTER TABLE services ADD COLUMN logo_url VARCHAR(255) NULL;
```

### Testimonials Table
```sql
ALTER TABLE testimonials ADD COLUMN logo_url VARCHAR(255) NULL;
```

## Error Handling

The forms include basic validation:
- File type validation (images only)
- File size limits
- Required field validation
- URL validation for external links

For production, consider adding:
- Advanced image validation
- Malware scanning
- CDN integration
- Automatic backup

## Performance Considerations

1. **Image Lazy Loading**: Add `loading="lazy"` to image tags
2. **Image Optimization**: Compress images before upload or use Laravel media package
3. **Database Indexing**: Consider indexing the `category` field in portfolio items

## Maintenance

### Clean Up Unused Files
To remove orphaned uploaded files, create an artisan command:

```bash
php artisan make:command CleanupOrphanedFiles
```

### Backup Uploaded Files
Ensure the `storage/app/public` directory is included in your backup strategy.

## Future Enhancements

- [ ] Bulk upload functionality
- [ ] Image cropping/editing in admin
- [ ] Automatic image optimization
- [ ] CDN integration
- [ ] Image versioning
- [ ] Gallery support (multiple images per item)
