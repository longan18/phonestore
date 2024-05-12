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

Open .env file and set the following:
```bash
vi .env
```
Edit content as below:
```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=phonestore
DB_USERNAME=root
DB_PASSWORD=root
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

    
