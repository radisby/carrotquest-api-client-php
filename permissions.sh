#!/bin/bash

sudo chown -R ilyasavitski:www-data $PWD
echo All files are now owned ilyasavitski:www-data.
sudo find . -type f -exec chmod 664 {} +
echo All files are 664. 
sudo find . -type d -exec chmod 775 {} +
echo All folders are 775.
sudo chmod +x $PWD/permissions.sh
