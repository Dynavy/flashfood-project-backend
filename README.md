![banner](https://github.com/user-attachments/assets/8d3c7486-6093-497d-ba91-bb31d1a89bfa)

<div align="center">
  <h1>FLASHFOOD PROJECT 🍔🍣</h1>
</div>

## Description:
A web application designed to help users discover and interact with food establishments using the Google Maps API.  
The system includes robust filtering options for different food categories such as fast food, Japanese, Chinese, and Korean cuisine. Users can register, log in, save their favorite locations, and access a personalized map view of their favorites. Additionally, the app enables users to add and share information about current promotions at food establishments, which others can validate or comment on.

<div style="margin: 20px 0; border: 1px solid #ccc; padding: 10px;">

## Table of Contents:

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Contact](#contact)
- [Contributions](#contributions)
- [License](#license)
- [Status](#status)
</div>

## Features:
- **Food Establishment Filters**: Search for establishments by category (fast food, Japanese, Chinese, etc.).
- **Favorites System**: Add and view favorite establishments on a personalized map.
- **Promotion Sharing**: Users can share and view promotions, with options to like, dislike, or comment on the validity of promotions.
- **User Authentication**: Secure user registration and login system.
- **Google Maps API Integration**: Interactive map interface for enhanced user experience.
- **Frontend-Backend Separation**: Independent repositories for efficient development and maintenance.

## Requirements:
- **Backend**:
  - PHP 8.0 or higher with Composer installed.
  - MySQL 8.0 or compatible version.
  - Laravel 11 Framework.
- **Frontend**:
  - Node.js and npm/yarn for dependency management.
  - Vue.js framework.

## Installation:

### Backend:
1. Clone the backend repository:
```
git clone https://github.com/Dynavy/flashfood-project-backend
```
2. Navigate to the project directory:
```
cd flashfood-project-backend
```
3. Install dependencies using Composer:
```
composer install
```
4. Ensure `php.ini` has ZIP extension enabled for proper dependency installation:
   
    <br>
     - Path example: `C:\xampp\php\php.ini` (adjust based on your setup).
<br>
       
6. Configure the `.env` file with your database credentials and other required environment variables:
```
cp .env.example .env

php artisan key:generate
```
6. Run migrations to set up the database structure:
```
php artisan migrate
```

### Frontend:
*(The frontend repository is under development and will be shared soon.)*

## Usage:
1. Start the backend server:
```
php artisan serve
```
2. *(Once the frontend repository is ready)* Clone and set up the frontend project, ensuring it points to the correct backend URL.

3. Access the application from your browser localhost.

## Contact:
For questions or suggestions, feel free to reach out:
- Email: [flfoodproject@gmail.com](mailto:flfoodproject@gmail.com)

## Contributions:
Contributions are welcome! To contribute:
1. Fork the repository.
2. Create a new branch for your feature/bugfix.
3. Submit a pull request with a detailed explanation.

## License:
This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

## Status:
- Backend: Currently in active development.
- Frontend: Development in progress, repository pending release.

