# INITIAL
```bash
npm install
composer install
npm run tailwind # 1
npm run dev # 2
php -S localhost:8000 # 3
```

# วิธีการใช้งาน
EC2 เปิด Instance
แก้ .env SIGNOUT, SIGNIN (IP ADDRESS)
ใส่ไฟล์ .env (S3)
แก้ index.html (sign_in_path, sign_out_path)
Cognito แก้ IP address
แก้ userdata.sh