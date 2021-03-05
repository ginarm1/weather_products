# Products for a particular weather

The project is a test project for applying for a job position as a PHP developer at Adeo Web, using Laravel API.
On this website, a user can check what products would be suitible for a particular weather, by entering the city name in URL section. When the city request is made, the JSON form data will be shown, were the weather for a particular day, SKU, a product and the cost will appear. The clasess `weather` and `products` have M:N realationship.

# Instalation

```

$ git clone https://github.com/ginarm1/Parabrace

php artisan serve

```
# How to use it

In URL section, enter this address: `/api/products/recommended/` and also add city name in it, for example, `vilnius` and see the magic happening ;)

MySQL data can be found in file:
## weather_products.sql


