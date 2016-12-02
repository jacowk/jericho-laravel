#!/bin/bash
#Deploy the application
echo "Removing existing application..."
cd /var/www/html
if [ -d "jericho" ]; then
        rm -rf jericho
fi
mkdir jericho

echo "Deploying..."
cd /home/jaco/workspace/jericho
cp -R * /var/www/html/jericho
cp .env /var/www/html/jericho

#Serve the application
echo "Serving..."
cd /var/www/html/jericho
sudo php artisan serve
