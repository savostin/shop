# Shop

Build a simple eCommerce application using Laravel.

The solution uses Docker to deploy.
To start the app use

``cp .env.example .env``

``docker compose up -d``

and open http://127.0.0.1:8000/

## Features implemented:
* User Authentication
* Product Catalogue
* Product Variations
* Shopping Cart
* Dummy checkout process
* Order History

## Future improvements:
* Paging and sorting in product catalogue
* Ability to change quantity and delete item in the cart
* Use AJAX when add to cart
* More detailed shipping address form
* Shipping costs and VAT
* Control the stock availability - update in stock availability after order complete
* When guest is forced to login during checkout redirect to the cart, not to the catalogue
* Improve UI/UX. Show number of items available in stock
* Code comments
* Tests
