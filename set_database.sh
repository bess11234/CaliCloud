sudo dnf update -y
sudo dnf install -y mariadb105
mysql -h calicloud.coxfpw5fib1g.us-east-1.rds.amazonaws.com -u admin --password=<password> calicloud < dump.sql