# Rade Banking Services Portal

A Laravel-based fintech utility portal inspired by **my.rade.ir**, built to provide banking-related inquiry services such as **bank card information lookup**, and designed to integrate with the **api.ir** service platform.

This project follows a clean and maintainable architecture using Laravel best practices, with a strong focus on **security**, **separation of concerns**, and **safe handling of sensitive financial data**.

---

## Features

- User authentication with **Laravel Breeze**
- Bank card information inquiry via **api.ir**
- Service-oriented architecture for external API integrations
- Thin controllers and dedicated business logic services
- Form Request validation for secure input handling
- Safe error handling for third-party API failures
- Inquiry logging with masking of sensitive data
- Blade + Tailwind based dashboard-style UI

---

## Tech Stack

- **Backend:** Laravel 11 / PHP 8.2+
- **Frontend:** Blade, Tailwind CSS, Vite
- **Database:** MySQL / MariaDB
- **Authentication:** Laravel Breeze
- **HTTP Client:** Laravel HTTP Client
- **Development Environment:** Cursor IDE

---

## Project Goal

The goal of this project is to build a banking utility dashboard similar to `my.rade.ir`, where authenticated users can access banking-related services such as:

- Bank card information lookup
- Card-to-IBAN conversion
- IBAN validation and inquiry
- Future financial utility services

The first implemented module is **Bank Card Info Inquiry**.

---

## Prerequisites

Make sure the following tools are installed on your system:

- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 20
- npm
- MySQL or MariaDB

> For Windows, using **Laragon** is recommended for a simpler local setup.

---

## Installation

Clone the repository and install dependencies:
```bash
composer install
npm install
Create the environment file:

bash
cp .env.example .env
Generate the application key:

bash
php artisan key:generate
Environment Configuration
Update your .env file with your database credentials:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rade_bank
DB_USERNAME=root
DB_PASSWORD=
Add your api.ir credentials:

env
API_IR_BASE_URL=https://s.api.ir/api
API_IR_TOKEN=your_api_ir_token
API Configuration
The project reads external API settings from config/services.php.

Make sure this section exists:

php
'api_ir' => [
'base_url' => env('API_IR_BASE_URL', 'https://s.api.ir/api'),
'token' => env('API_IR_TOKEN'),
],
After updating environment variables, clear the config cache if needed:

bash
php artisan optimize:clear
Database Setup
Create your database manually, then run migrations:

bash
php artisan migrate
If authentication scaffolding is not installed yet, install Breeze:

bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
php artisan migrate
Running the Project Locally
Start the Laravel development server:

bash
php artisan serve
In another terminal, run Vite:

bash
npm run dev
Then open:

text
http://127.0.0.1:8000
Register a user account and access the banking feature page:

text
http://127.0.0.1:8000/banking/card-info
Implemented Module: Bank Card Info Inquiry
The first feature of the project allows authenticated users to submit a 16-digit bank card number and retrieve card-related information through the api.ir service.

Flow
User submits a card number
Request is validated through a dedicated Form Request
Controller delegates the logic to a service class
Service uses a dedicated API client to call api.ir
Result is displayed back to the user
Inquiry can be logged securely without storing raw sensitive input
Architecture
This project is structured to keep responsibilities clearly separated.

Main structure
text
app/
├── Http/
│   ├── Controllers/
│   │   └── Banking/
│   │       └── BankCardInfoController.php
│   └── Requests/
│       └── Banking/
│           └── BankCardInfoRequest.php
├── Services/
│   └── ApiIr/
│       ├── ApiIrClient.php
│       └── BankCardService.php
├── Models/
│   └── InquiryLog.php
database/
├── migrations/
resources/
├── views/
│   └── banking/
│       └── card-info.blade.php
routes/
└── web.php
Design principles
Thin Controllers
Form Request Validation
Service Layer for Business Logic
Dedicated External API Client
Dependency Injection
Safe Exception Handling
PSR-12 compatible code
Security Considerations
Because this project handles financial data, security is a core concern.

Rules followed in this project
API tokens are stored in .env, never hardcoded
Full card numbers must never be logged or stored in plaintext
Sensitive values should be masked before persistence
Raw third-party API errors should not be shown to end users
External API communication should use:
timeout
retry strategy
safe exception wrapping
Example of masked card storage
text
603799******0000
Logging
The project is designed to support secure inquiry logging for both successful and failed requests.

Suggested log fields:

user_id
service_name
masked_input
status
http_status
response_payload
Sensitive input must always be masked before being stored.

UI
The frontend uses:

Laravel Blade components
Tailwind CSS
RTL-friendly structure where needed
Authenticated dashboard-like layout
This makes it easy to expand the project into a larger banking services panel.

Development Notes
If config values do not update correctly after editing .env, run:

bash
php artisan optimize:clear
If frontend assets do not load correctly, rebuild them:

bash
npm run build
For development mode:

bash
npm run dev
Example Git Workflow
bash
git init
git add .
git commit -m "Initial Laravel banking services setup"
After implementing the first banking feature:

bash
git add .
git commit -m "Add api.ir bank card info inquiry feature"
Roadmap
[x] Laravel project setup
[x] Authentication with Breeze
[x] api.ir base client integration
[x] Bank card information inquiry
[ ] Secure inquiry logging
[ ] Card to IBAN conversion
[ ] IBAN inquiry and validation
[ ] Additional banking utility services
[ ] Improved dashboard and user history
[ ] Admin monitoring tools
Disclaimer
This project is intended for development and educational use unless all legal, banking, compliance, and security requirements are properly reviewed and implemented for production deployment.

Do not deploy financial-service software to production without:

proper security review
rate limiting
audit logging
encryption strategy
compliance checks
infrastructure hardening