# Sistem Informasi Manajemen Pelabuhan
## Port Management Information System

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <strong>OASIST ISTANA LAUT</strong><br>
  <em>Optimalisasi Sistem Informasi Terintegrasi Dan Sistem Tiket Manajemen Pelabuhan Laut</em>
</p>

<p align="center">
  A comprehensive web-based information system for managing port operations at Pelabuhan Serangan, Bali, Indonesia.
</p>

## 📋 About This System

This is an integrated port management system designed to streamline operations at **Pelabuhan Serangan** (Serangan Port) in Denpasar, Bali. The system, known as **OASIST ISTANA LAUT** (Integrated Information System Optimization and Sea Port Management Ticketing System), provides a centralized platform for managing passengers, vessels, operators, routes, and port retributions.

### Location
📍 **Pelabuhan Serangan, Denpasar, Bali, Indonesia**

## ✨ Key Features

### Public Features
- **Vessel Information**: Browse available boats and ships with detailed information
- **Operator Directory**: View port operators and their contact details  
- **Booking System**: Online reservation and booking functionality
- **Customer Reviews**: Public review and rating system
- **Facility Information**: Comprehensive port facilities overview
- **Weather Information**: Integration with meteorological services

### Administrative Features
- **Passenger Management**: Complete CRUD operations for passenger data
- **Vessel Management**: Manage ship and boat information with images
- **Operator Management**: Operator profiles and contact management
- **Route Management**: Departure and arrival route configuration
- **Retribution System**: Port fee collection and target tracking
- **User Management**: Role-based access control system
- **Review Moderation**: Approve and manage customer reviews
- **Data Export**: Excel and PDF export capabilities
- **Dashboard Analytics**: Comprehensive statistics and reporting

## 🛠️ Technology Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Bootstrap 5 + Blade Templates
- **Database**: MySQL
- **Key Libraries**:
  - `barryvdh/laravel-dompdf` - PDF generation
  - `maatwebsite/excel` - Excel import/export
  - `yajra/laravel-datatables-oracle` - DataTables integration
  - `pestphp/pest` - Testing framework

## 👥 User Roles & Permissions

### Guest (Public)
- View vessel information and operators
- Submit reviews and ratings
- Access public information pages

### Operator
- Manage passenger data and bookings
- Export passenger reports (PDF/Excel)
- View and update operator profile
- Access vessel information

### Master (Administrator)
- Full CRUD operations on all entities
- Manage users and permissions
- Configure system settings
- Access comprehensive dashboard
- Export all reports and analytics
- Approve reviews and moderate content

### Admin
- View all system data
- Monitor operations
- Access reporting features
- Limited administrative functions

## 🚀 Installation

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Web Server (Apache/Nginx) or PHP built-in server

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd sistem-informasi-manajemen-pelabuhan
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistem_informasi_manajemen_pelabuhan
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   php artisan db:seed  # if seeders are available
   ```

6. **Create storage link**
   ```bash
   php artisan storage:link
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   - URL: `http://localhost:8000`
   - Login: `/login`

## 📊 Database Structure

### Core Models
- **Passenger**: Passenger information and travel details
- **Ship**: Vessel information with images and specifications
- **ShipImage**: Ship photo gallery
- **Operator**: Port operator profiles and contacts
- **Route**: Departure and arrival routes
- **Retribution**: Port fee collection and targets
- **Review**: Customer reviews and ratings
- **User**: System users with role-based access

## 🎯 Recent Updates

### Latest Features (Based on Git History)
- ✅ Excel export functionality for dashboard analytics
- ✅ Retribution (fee) export capabilities  
- ✅ Passenger data Excel export feature
- ✅ Bug fixes for pagination in passenger and retribution modules
- ✅ Enhanced dashboard with export options

## 📞 Contact Information

**Pelabuhan Serangan, Denpasar**
- 📍 Address: Pelabuhan Serangan, Denpasar, Bali, Indonesia
- 📞 Telephone: (0361) 456-7890
- 📱 Mobile: (081) 23456-7890  
- 📧 Email: istanalaut@denpasarkota.go.id
- 🕐 Office Hours: Daily 8:00 AM - 6:00 PM

## 🏢 About Pelabuhan Serangan

Pelabuhan Serangan is a strategic port facility in Denpasar, Bali, serving as a gateway for marine transportation and tourism. The port supports both passenger and cargo operations, connecting Bali to neighboring islands and supporting the local marine tourism industry.

The name "ISTANA LAUT" (Sea Palace) refers to the Hindu deity Baruna, the God of the ocean who controls the laws of nature and all waters, symbolizing the port's connection to Balinese culture and maritime heritage.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Thank you for considering contributing to the Port Management Information System! Please feel free to submit pull requests or create issues for bug reports and feature requests.

## 🔒 Security

If you discover any security vulnerabilities, please report them immediately to the system administrators through the proper channels.

---

**Built with ❤️ using Laravel Framework**