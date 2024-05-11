## Phonestore
A website that sells phones and technology products

### Required
**php** |^8.1

**laravel** |^10.0

**node** |v21.7.1

## Tech Stack

**Server Side:** Laravel

**Database:** MySql

**Web server:** Nginx

### Setup Project

Download project by git clone
```bash
git clone https://github.com/longan18/phonestore.git
```
```bash
cd phonestore
```

Setup docker
```bash
docker-compose bulid
docker-compose up -d
```

```bash
docker exec -it phonestore bash
```

Install all the dependencies using composer and npm
```bash
composer install
```

Copy the `.env.example` file and make the required configuration changes in the .env file

```bash
cp .env.example .env
```

Generate a new application key
```bash
php artisan key:generate
```

Create database
```bash
php artisan migrate
php artisan db:seed
```

Make link storage
```bash
php artisan storage:link
```

    
