# INITIAL
```bash
npm install
composer install
npm run tailwind # 1
npm run dev # 2
php -S localhost:8000 # 3
```

# วิธีการใช้งาน
- Amazon EC2 เปิด Instance (TEMPLATE) (OPEN IPV4)
- Amazon S3 ใส่ไฟล์ .env (S3)
- Amazon Cognito แก้ IP address
- แก้ index.html (ip), config.php (redirect_url)
- แก้ userdata.sh
- รัน .sh แบบ Root role

# SET ENVIRONMENTS
```
VITE_LONGDO_MAP_API_KEY=
HOST_DATABASE=
USERNAME_DATABASE=
PASSWORD_DATABASE=
```