# BWS Sulawesi III Palu - Official Website

<div align="center">
  <img src="public/assets/images/logo.png" alt="BWS Sulawesi III Palu Logo" width="300">
  
  **Website Resmi Balai Wilayah Sungai Sulawesi III Palu**
  
  *Mengelola Air untuk Negeri*
</div>

## 📋 Deskripsi Proyek

Website resmi Balai Wilayah Sungai (BWS) Sulawesi III Palu yang berfungsi sebagai portal informasi publik untuk menyediakan berita, publikasi, layanan, dan informasi terkait pengelolaan sumber daya air di wilayah Sulawesi Tengah.

## ✨ Fitur Utama

### 🎯 **Frontend Features**
- **Homepage dengan Hero Carousel** - Slider gambar utama dengan navigasi
- **Sistem Berita Terintegrasi** - Artikel internal dan eksternal
- **Gallery & Publikasi** - Koleksi foto dan dokumen
- **Partner Logos Carousel** - Responsive partner showcase dengan clickable links
- **Mobile-First Design** - Fully responsive untuk semua device
- **Advanced Search** - Pencarian artikel dengan filter
- **Social Media Integration** - Sharing ke platform media sosial

### ⚙️ **Admin Panel (Filament)**
- **Content Management System** - Kelola artikel, kategori, tag
- **Media Management** - Upload dan kelola gambar/dokumen
- **User Management** - Sistem role dan permission
- **Settings Management** - Konfigurasi website dengan limit karakter
- **Analytics Dashboard** - Statistik pengunjung dan konten

### 🔧 **Technical Features**
- **SEO Optimized** - Meta tags, structured data
- **Performance Optimized** - Image optimization, caching
- **Security Features** - CSRF protection, XSS prevention
- **API Ready** - RESTful API untuk integrasi
- **Responsive Navigation** - Adaptive navbar untuk mobile/tablet/desktop

## 🚀 Tech Stack

- **Framework**: Laravel 10.x
- **Frontend**: Blade Templates + Tailwind CSS
- **Admin Panel**: Filament 3.x
- **Database**: MySQL/PostgreSQL
- **Storage**: Local/S3 Compatible
- **Cache**: Redis (optional)
- **Search**: Full-text search + filtering

## 📦 Installation

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & npm
- MySQL/PostgreSQL
- Web Server (Apache/Nginx)

### Step 1: Clone Repository
```bash
git clone https://github.com/your-username/bwssul3-news.git
cd bwssul3-news
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Configuration
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bwssul3_news
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 5: Database Migration & Seeding
```bash
# Run migrations
php artisan migrate

# Seed initial data
php artisan db:seed
```

### Step 6: Storage & Assets
```bash
# Create storage symlink
php artisan storage:link

# Compile assets
npm run build
```

### Step 7: Admin User Creation
```bash
# Create admin user for Filament
php artisan make:filament-user
```

## 🎮 Usage

### Development Server
```bash
# Start Laravel development server
php artisan serve

# Watch for asset changes (separate terminal)
npm run dev
```

Access the application:
- **Website**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin

### Production Deployment
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build production assets
npm run build
```

## 📁 Project Structure

```
bwssul3-news/
├── app/
│   ├── Filament/           # Admin panel resources
│   ├── Http/Controllers/   # Web controllers
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── public/
│   └── assets/           # Static assets
├── resources/
│   ├── views/            # Blade templates
│   │   ├── components/   # Reusable components
│   │   ├── layouts/      # Layout templates
│   │   └── sections/     # Page sections
│   └── css/              # Stylesheets
└── routes/               # Application routes
```

## 🎨 Design System

### Color Palette
- **Primary Blue**: `#1E40AF` (blue-sda)
- **Yellow Accent**: `#FCD34D` (yellow-accent)
- **Gray Tones**: Various shades for text and backgrounds

### Typography
- **Headings**: Inter/System fonts
- **Body**: Optimized for readability
- **Responsive**: Scales across all devices

### Components
- Responsive navigation with mobile hamburger menu
- Card-based content layout
- Interactive carousels and sliders
- Form components with validation
- Modal dialogs and overlays

## 📱 Responsive Breakpoints

- **Mobile**: < 640px (Logo kiri, hamburger kanan, search dalam menu)
- **Tablet**: 640px - 1024px (Logo kiri, search tengah, hamburger kanan)
- **Desktop**: > 1024px (Logo kiri, full navigation, search kanan)

## 🔐 Security Features

- CSRF Protection
- XSS Prevention
- SQL Injection Protection
- File Upload Validation
- Rate Limiting
- Secure Headers

## 🧪 Testing

```bash
# Run PHP tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 📈 Performance

- **Image Optimization**: WebP format support
- **Lazy Loading**: Images and content
- **Caching**: Redis/File-based caching
- **CDN Ready**: Asset optimization
- **Database**: Query optimization

## 🔧 Key Features Implementation

### Partner Logos Carousel
- Responsive breakpoints: 2 logos (mobile), 4 logos (tablet), 7 logos (desktop)
- Clickable logos with `website_url` field
- Navigation arrows and indicators
- Auto-play functionality

### Article System
- Related articles with customizable thumbnail heights
- Category and tag management
- Featured images and galleries
- Social media sharing

### Admin Panel Optimizations
- Character limits for long content fields
- Intuitive content management
- Media library integration

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

### Coding Standards
- Follow PSR-12 coding standards
- Use meaningful variable/function names
- Write tests for new features
- Update documentation

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Team

**BWS Sulawesi III Palu - IT Team**
- Website development and maintenance
- Content management
- Technical support

## 📞 Contact & Support

- **Website**: [https://bwssulawesi3.pu.go.id](https://bwssulawesi3.pu.go.id)
- **Email**: admin@bwssulawesi3.pu.go.id
- **Phone**: (0451) 482147
- **Address**: Jl. Abdurachman Saleh No. 230 Palu, Sulawesi Tengah

## 🔄 Changelog

### Version 2.0.0 (Current)
- ✅ Responsive redesign dengan breakpoint optimal
- ✅ Filament admin panel integration
- ✅ Enhanced content management
- ✅ Performance improvements
- ✅ Mobile-first approach
- ✅ Partner logos dengan clickable links
- ✅ Navbar responsive untuk semua device
- ✅ Admin panel optimizations

### Version 1.0.0
- ✅ Initial website launch
- ✅ Basic CMS functionality
- ✅ News and publication system

---

<div align="center">
  <p><strong>Balai Wilayah Sungai Sulawesi III Palu</strong></p>
  <p><em>Kementerian Pekerjaan Umum dan Perumahan Rakyat</em></p>
  <p>Copyright © 2024. All Rights Reserved.</p>
</div>
