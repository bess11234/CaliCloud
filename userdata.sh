sudo yum -y update
sudo yum install -y git
sudo rm -rf ~/app
sudo git clone https://github.com/bess11234/CaliCloud.git app
cd app
sudo yum install -y nginx
sudo cp nginx.conf /etc/nginx/
sudo mkdir /etc/pki/nginx
sudo cp ssl/calicloud.crt /etc/pki/nginx/
sudo mkdir /etc/pki/nginx/private
sudo cp ssl/calicloud.key /etc/pki/nginx/private/
sudo systemctl restart nginx
sudo yum install curl
curl -fsSL https://rpm.nodesource.com/setup_20.x | sudo bash -
sudo yum install -y nodejs
sudo yum install -y php-cli php-zip wget unzip
sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
sudo npm install
sudo composer install
sudo npm run build
sudo cp -r dist/* /usr/share/nginx/html/
php -S localhost:8000