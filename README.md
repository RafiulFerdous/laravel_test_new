<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Api Documentation

<a href="https://documenter.getpostman.com/view/15204749/2s9YCARAgf">PostMan Documentation Link</a>


Registration:

first migrate the data base
used Token based- sanctum for Role based authentication system 


default role 1

curl --location 'http://127.0.0.1:8000/api/registration' \
--header 'Accept: application/json' \
--form 'name="testuser"' \
--form 'email="test3@gmail.com"' \
--form 'password="12345678"' \
--form 'password_confirmation="12345678"'

Login:
curl --location 'http://127.0.0.1:8000/api/login' \
--header 'Accept: application/json' \
--form 'email="test@gmail.com"' \
--form 'password="12345678"'

<p>This System is designed in Repository Pattern.
Having table </br>
=>brand </br>
=>category </br>
=>Department </br>
=>Invoices </br>
=>products </br>
    =>id
    =>name
    =>sku
    =>brand_id
    =>category_id
    =>department_id
    =>challan_um
    =>quantity
    =>description
    =>invoice_id </br>
=>role </br>
=>users </br>
</p>




