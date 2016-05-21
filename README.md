# Simple Shop application powered by Laravel

### About

Simple application for simulating shop cart, customer and admin roles

**Admin** users ( *edites products, orders* )

**Loged** users ( *purchases products, edits their own cart* )

**Anonymous** users ( *just see products* )


---
### Getting started

1. Download project to your machine `git clone https://github.com/Hellsos/laravel_simple_shop.git`

2. Install dependecies via composer `composer install`

3. Rename .env_example to .env

4. Generate application key `php artisan key:generate`

5. Change DB credentials in .env file

6. Generate tables into your DB `php artisan migrate`

7. Insert first `php artisan db:seed` (optional, if you can not insert into user's table **admin** user)
 
  *Example admin user has email:* **admin@example.com** * and password: * **admin123** 

8. Enjoy Website :) 

---
## Changes in Laravel

##### Added/modified Files "Migrations DB" in (database/migrations)


```````
products.php
orders.php
order_lists.php
users.php
```````

##### Modified Files in (database/seeds)


``````````
DatabaseSeeder.php
``````````

##### Modified Files in (app/Http)


``````````
routes.php
``````````



##### Added Files "Controllers" in (app/Http/Controllers)


```````
CreateController.php
EditController.php
HomeController.php
IndexController.php
OrderController.php
ShowController.php

```````


##### Added Files "Views and layouts" in (resources/views)

`````````
layouts/app.blade.php
parts/orderList.blade.php
parts/productList.blade.php
adminPerm.blade.php
create.blade.php
edit.blade.php
home.blade.php
order.blade.php
show.blade.php
welcome.blade.php
`````````



