A comprehensive full-stack web application for managing the Haarlem Festival, featuring event ticketing, restaurant reservations, payment processing, and a custom CMS for content management.

## ✨ Features

### For Visitors/Customers
- 🎭 **Event Discovery**: Browse dance performances, history tours, and restaurant options
- 🎫 **Ticket Booking**: Reserve tickets for multiple event types with real-time availability
- 🍽️ **Restaurant Reservations**: Book tables at festival partner restaurants
- 🛒 **Shopping Cart**: Multi-event ticket management with quantity updates
- 💳 **Secure Payments**: Mollie payment gateway integration
- 📧 **Automated Emails**: Invoice delivery and booking confirmations via SendGrid
- 📱 **Digital Tickets**: QR code generation for easy validation
- 👤 **User Profiles**: Account management with order history
- 🔒 **Password Recovery**: Token-based password reset functionality

### For Administrators
- 📊 **Content Management System**: Full CRUD operations for all festival content
- 🎪 **Event Management**: Create and manage dance events, history tours, and venues
- 🏢 **Venue Administration**: Manage locations and capacity
- 👥 **User Management**: Role-based access control (Admin/Employee/Customer)
- 📦 **Order Management**: View and process all customer orders
- 🍴 **Restaurant Management**: Manage restaurant partners and reservations
- 🎨 **Media Management**: Upload and manage event images
- 📈 **Tour Scheduling**: Configure history tour times, guides, and languages

### For Employees
- ✅ **QR Code Validation**: Scan and validate customer tickets
- 📋 **Event Oversight**: Monitor event bookings and attendance

---

## 🛠 Technology Stack

### Backend
- **PHP 8+** - Server-side scripting
- **MySQL/MariaDB** - Relational database
- **Custom MVC Framework** - Pattern-based routing and architecture

### Frontend
- **HTML5/CSS3** - Markup and styling
- **JavaScript** - Client-side interactivity
- **Bootstrap 5** - Responsive UI framework

### Infrastructure
- **Docker** - Containerization
- **Docker Compose** - Multi-container orchestration
- **Nginx** - Web server and reverse proxy
- **Heroku** - Cloud deployment platform

### Third-Party Integrations
- **Mollie API** (v2.65) - Payment processing
- **SendGrid API** (v8.1) - Email delivery service
- **Endroid QR Code** (v5.0) - QR code generation
- **DomPDF** (v2.0) - PDF invoice generation
- **Ramsey UUID** (v4.7) - Unique identifier generation

### Development Tools
- **Composer** - PHP dependency management
- **phpMyAdmin** - Database administration
- **Git** - Version control

---

## 🏗 Architecture

The application follows a clean **MVC (Model-View-Controller)** architecture with additional service and repository layers:

```
┌─────────────┐
│   Router    │  ← Custom Pattern-Based Router
└──────┬──────┘
       │
┌──────▼──────┐
│ Controllers │  ← Handle HTTP requests
└──────┬──────┘
       │
┌──────▼──────┐
│  Services   │  ← Business logic layer
└──────┬──────┘
       │
┌──────▼──────┐
│ Repositories│  ← Data access layer
└──────┬──────┘
       │
┌──────▼──────┐
│   Models    │  ← Domain entities
└──────┬──────┘
       │
┌──────▼──────┐
│   Database  │  ← MySQL/MariaDB
└─────────────┘
```

### Key Design Patterns
- **MVC Pattern**: Separation of concerns
- **Repository Pattern**: Data access abstraction
- **Service Layer**: Business logic encapsulation
- **Dependency Injection**: Loose coupling between components
- **Front Controller**: Single entry point routing

---

## 🚀 Installation

### Prerequisites
- **Docker** (v20.10+)
- **Docker Compose** (v2.0+)
- **Git**

### Local Development Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/AchilleasB/HaarlemFestival.git
   cd HaarlemFestival
   ```

2. **Create configuration files**
   
   Copy and configure the following files in `app/config/`:
   
   **dbconfig.php**
   ```php
   <?php
   $host = 'mysql';
   $dbname = 'haarlem_festival';
   $username = 'developer';
   $password = 'your_database_password_here';
   ```

   **mollieConfig.php**
   ```php
   <?php
   $mollieKey = 'your_mollie_api_key_here';
   ```

   **mailconfig.php**
   ```php
   <?php
   $apiKey = 'your_sendgrid_api_key_here';
   ```

   **urlconfig.php**
   ```php
   <?php
   $baseUrl = 'http://localhost';
   ```

   **imgconfig.php**
   ```php
   <?php
   $imgBasePath = '/images/';
   ```

3. **Install PHP dependencies**
   ```bash
   cd app
   composer install
   cd ..
   ```

4. **Start Docker containers**
   ```bash
   docker-compose up -d
   ```

5. **Access the application**
   - **Website**: http://localhost
   - **phpMyAdmin**: http://localhost:8080
   - **Database**: localhost:3306

6. **Import the database**
   
   The database schema will be automatically imported from `sql/haarlem_festival.sql` on first run.

## 📁 Project Structure

```
HaarlemFestival/
├── app/
│   ├── api/                    # API controllers
│   ├── config/                 # Configuration files
│   ├── controllers/            # MVC controllers
│   ├── exceptions/             # Custom exception classes
│   ├── models/                 # Domain models
│   ├── public/                 # Public assets & entry point
│   │   ├── index.php          # Application entry point
│   │   ├── icons/
│   │   ├── images/
│   │   ├── invoices/          # Generated PDF invoices
│   │   ├── payment/           # Payment handling scripts
│   │   ├── scripts/
│   │   ├── styles/
│   │   └── tickets/           # Generated QR codes
│   ├── repositories/          # Data access layer
│   ├── router/                # Custom routing system
│   ├── services/              # Business logic layer
│   ├── vendor/                # Composer dependencies
│   ├── views/                 # View templates
│   └── composer.json          # PHP dependencies
├── sql/
│   └── haarlem_festival.sql   # Database schema
├── docker-compose.yml         # Docker orchestration
├── nginx.conf                 # Nginx configuration
├── PHP.Dockerfile             # PHP container definition
└── README.md                  # This file
```

### Key Directories

- **controllers/**: Handle HTTP requests and coordinate responses
- **services/**: Contain business logic and orchestrate data operations
- **repositories/**: Manage database interactions and queries
- **models/**: Define domain entities and data structures
- **views/**: Render HTML templates for each module


## 🔐 Security Features

- **Password Hashing**: Bcrypt hashing for user passwords
- **Session Management**: Secure session handling for authentication
- **CSRF Protection**: Token-based form validation
- **SQL Injection Prevention**: PDO prepared statements
- **Role-Based Access Control**: Admin/Employee/Customer permissions
- **Payment Security**: PCI-compliant Mollie integration
- **Token-Based Password Reset**: Secure password recovery

## 📝 License

This project is developed for educational purposes as part of InHolland University curriculum.
