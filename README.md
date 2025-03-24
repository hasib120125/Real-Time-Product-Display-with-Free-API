# Laravel Real-Time Product Display App

This Laravel application fetches product data from a public API and updates the UI in real-time using Pusher.

## Features:
✅ Fetches products from FakeStoreAPI  
✅ Displays products in a clean, responsive UI  
✅ Uses Pusher for real-time updates  

## 🚀 Installation Guide

1️⃣ Clone the repository  
```sh
git clone https://github.com/hasib120125/Real-Time-Product-Display-with-Free-API.git
cd Real-Time-Product-Display-with-Free-API

2️⃣ Install dependencies
composer install
npm install

3️⃣ Configure the .env file
cp .env.example .env
php artisan key:generate

Edit .env and add your database credentials and Pusher keys:
BROADCAST_CONNECTION=pusher

PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=your_pusher_cluster

4️⃣ Run migrations and seed database
php artisan migrate --seed

5️⃣ Run Laravel 
php artisan serve


🔴 Real-Time Updates with Pusher
How Pusher Works:
When a new product is fetched or added to the database, Laravel broadcasts an event (ProductUpdated).

The Pusher service sends this event to all connected users.

JavaScript on the frontend listens for updates and dynamically inserts new products into the page without a refresh.

File References:

app/Events/ProductUpdated.php → Defines the event

routes/web.php → Handles product fetching

resources/views/products/index.blade.php → Displays products & listens for updates



