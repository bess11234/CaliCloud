#! /bin/bash
sudo dnf update -y
sudo dnf install -y mariadb105
sudo aws s3 cp s3://calicloud/calicloud.sql calicloud.sql
mysql -h calicloud.coxfpw5fib1g.us-east-1.rds.amazonaws.com -u admin -p calicloud < calicloud.sql