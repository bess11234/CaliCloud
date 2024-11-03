# Project Initialization

To set up the project, execute the following commands:

```bash
# Install Node.js dependencies specified in package.json
npm install

# Install PHP dependencies specified in composer.json
composer install

# Start the Vite development server, allowing you to develop the frontend with live reloading
npm run dev 

# Start the PHP built-in server on localhost at port 8000 for the backend
php -S localhost:8000

```

# Usage Instructions

1. **Amazon EC2 Instance**  
   Launch an EC2 instance using the appropriate template and ensure that IPv4 access is enabled.

2. **Amazon S3 Configuration**  
   Upload your `.env` file to Amazon S3.

3. **Amazon Cognito Configuration**  
   Update the IP address in your Amazon Cognito settings as required.

4. **File Modifications**
    - Update the `index.html` file with the necessary IP address.
    - Modify `config.php` to include the correct `redirect_url`.

5. **User Data Script**  
   Edit the `userdata.sh` script as needed.

6. **Execute the Script**  
   Run the `userdata.sh` script with root privileges.

# Environment Variables

Ensure the following environment variables are set in your `.env` file:

```
VITE_LONGDO_MAP_API_KEY=
HOST_DATABASE=
USERNAME_DATABASE=
PASSWORD_DATABASE=
```

---