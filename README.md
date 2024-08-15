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
```bash
import file phonestore.sql
```

Setup docker
```bash
docker-compose bulid
./run.sh
```

*IF ENOSPC: System limit for number of file watchers reached
```bash
sudo sysctl -w fs.inotify.max_user_watches=524288
```

Exec container
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

Make link storage
```bash
php artisan storage:link
```
## Hướng phát triển
Lưu ý: cần xác nhận thông qua giáo viên bộ môn hoặc giáo viên hướng dẫn.

Thiết kế database để phát triển bán nhiều loại sản phẩm
```bash
1 products - 1 product_smartphone 
Thực hiện:
  - Thêm cột attr_product vào bảng products
  - Chuyển data bảng product_smartphone thành JSON và thêm vào products.attr_product
  - update lại luồng thêm sản phẩm, cập nhật sản phẩm:
     - Thêm mới sản phẩm: chuyển thuộc tính thành JSON và thêm vào products.attr_product
     - Show sản phẩm: chuyển JSON thành chuỗi và đọc ra
     - Cập nhật sản phẩm: chuyển JSON thành chuỗi, cập nhật lại và chuyển lại thành JSON rồi lưu lại
  * Như vậy các ta không cần quan tâm đến sản phẩm có bao nhiêu thuộc tính.
  
1 products - n product_smartphone_price
Thực hiện:
  - Bỏ bảng product_smartphone_price thay bằng bảng product_price
  - table product_price:
      - product_id (bigInt)
      - option_attr (JSON)
      - price (decimal)
      - quantity (bigInt)
      - status (tinyInt)
      - created_at (timestamp)
      - updated_at (timestamp)
      - deleted_at (timestamp)
  * Như vậy các ta không cần quan tâm đến các thuộc tính phân định giá tiền sản phẩm có bao nhiêu thuộc tính.

ERD: Bỏ thực thể ram, color, storage_capacity vì nó được tính là thuộc tính của sản phẩm
```


    
