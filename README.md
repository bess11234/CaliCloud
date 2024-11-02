# INITIAL
```bash
npm install
composer install
npm run tailwind # 1
npm run dev # 2
php -S localhost:8000 # 3
```

# วิธีการใช้งาน
EC2 เปิด Instance (TEMPLATE) (OPEN IPV4)
ใส่ไฟล์ .env (S3)
แก้ index.html (ip), config.php (redirect_url)
Cognito แก้ IP address
แก้ userdata.sh