# Intranet for Discord Server

This is a **Laravel** web application using **Inertia.js** and **Vue 3** that serves as an intranet for a Discord server. The application includes features for managing polls and a card-making system specifically designed for the tabletop simulator game **Last Retort**.

## Features

### Polls
- Create, edit, and delete polls.
- Allow server members to participate in polls and view real-time results.
- Support for multiple-choice and single-choice questions.

### Card-Making System
- Create and manage game cards for **Last Retort**.
- Organize cards into categories for better accessibility.
- Export cards to formats compatible with tabletop simulators.

### Discord Integration
- Authenticate users using their Discord accounts.
- Role-based access control tied to Discord server roles.

### Other Features
- Responsive UI built with Vue 3.
- Notifications for important updates and new polls.
- Lightweight and fast thanks to Laravel and Vite.

## Tech Stack

### Backend
- [Laravel](https://laravel.com/) - PHP framework for web artisans.
- [Inertia.js](https://inertiajs.com/) - Seamless integration between Laravel and Vue 3.

### Frontend
- [Vue 3](https://vuejs.org/) - Modern JavaScript framework for building UI components.
- [Vite](https://vitejs.dev/) - Lightning-fast development and build tool.

### Additional Tools
- [Discord OAuth2](https://discord.com/developers/docs/topics/oauth2) - Authentication.

## Installation

### Prerequisites
Ensure you have the following installed:
- PHP >= 8.2
- Composer
- Node.js (latest LTS version)
- NPM
- MySQL or PostgreSQL

### Steps
1. Clone the repository.


2. Install backend dependencies:
   ```bash
   composer install
   ```

3. Install frontend dependencies:
   ```bash
   npm install
   ```

4. Set up your `.env` file:
   ```bash
   cp .env.example .env
   ```
   Configure your database, Discord OAuth2 credentials, and other settings in the `.env` file.

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

7. Build the frontend assets:
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

8. Serve the application:
   ```bash
   php artisan serve
   ```

The application should now be running at [http://localhost:8000](http://localhost:8000).

## Usage

### Discord Authentication
Users can log in using their Discord accounts. Ensure that the Discord Bot and OAuth2 application are properly configured to use this feature.

### Managing Polls
Admins can create and manage polls from the admin panel. Server members can participate in active polls and view real-time results.

### Card Creation
Use the card-making system to create and categorize cards for Last Retort. Export options are available in the tools section.

## Acknowledgments
- [Laravel Community](https://laravel.com/) for extensive documentation and support.
- [Last Retort](https://example.com) for inspiration and game mechanics.

---
For any questions or issues, feel free to open an [issue](https://github.com/Habier/web4discord/issues).
