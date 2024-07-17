#!/bin/bash

# Chạy docker-compose up ở chế độ detached
docker-compose up -d

# Lấy tên container PHP (thay 'your-php-service' bằng tên service trong docker-compose.yml)
CONTAINER_NAME=$(docker-compose ps -q app)

# Chạy lệnh queue:work ẩn với nohup
nohup docker exec -it $CONTAINER_NAME php artisan queue:work > /dev/null 2>&1 &
nohup npm run dev > /dev/null 2>&1 &
