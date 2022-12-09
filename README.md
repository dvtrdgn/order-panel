

# Demo Dealer Order Panel with Laravel 9 and livewire

It is a demo project for an admin panel for dealer orders. 


## Main features

- Authentication with Laravel Jetstream
- CRUD for products and  nested category management
- Manage waiting and completed order
- PDF output for completed order list for every dealer
- Filter orders, all tables with pagination
- Product stock management
- Alert for minimum products quantity with chart.js bar chart
- Assing multiple users to any dealer
- Real-time validation with livewire

Notice: This panel allows you to edit ordered products. The product order section is not yet complete.




## Screenshots

![App Screenshot](http://www.incele.web.tr/wp-content/uploads/demo-order-panel.png)


## Installation

- Clone the repository with git clone
- Copy .env.example file to .env and edit database credentials there

```bash
  composer install
  php artisan key:generate
  npm install && npm run dev
  php artisan migrate --seed  
  php artisan serve
```
- That's it: launch the main URL or go to /register and create new account


    