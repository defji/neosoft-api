# Demonstration API for NeoSoft

The task was to create a rest api, without any php framework.

## Install

```bash
git clone git@github.com:defji/neosoft-api.git
composer install
# set database credentials on app/Database/Database.php
# import database/database.sql 
composer install
php -S localhost:8000 -t public
```

## Endpoints

- api/users/auth

```http request
POST http://127.0.0.1:8000/api/users/auth
Accept: application/json

    {
      "username": "user",
      "password": "supersecret"
    },
```

response will be:

````json
{
  "token": "aadb1ce8e10739f51866c181b4c9cbd4fef6b027ad72460a2e13d7a1aae4b82917d308e962475d5a9ca08bf21286db6c5157780ee20224dec81866bb7463ae9d"
}
````

- api/users  (accessible via bearer token)

```http request
GET http://127.0.0.1:8000/api/users HTTP/1.1
Authorization: Bearer aadb1ce8e10739f51866c181b4c9cbd4fef6b027ad72460a2e13d7a1aae4b82917d308e962475d5a9ca08bf21286db6c5157780ee20224dec81866bb7463ae9d
```

response will be:

```json
[
  {
    "id": 2,
    "first_name": "Jakab",
    "last_name": "Teszt",
    "username": "user",
    "email": "user@example.com",
    "date_of_birth": "1980-01-01",
    "zip": "1000",
    "city": "Budapest",
    "address": "Clark Ádám tér 1. "
  },
  {
    ...
  }
]
```

Or use included postman collection 







