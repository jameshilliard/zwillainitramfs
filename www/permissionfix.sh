#!/bin/bash
# cryptoGlance permission fix script for most linux setups
# http://cryptoglance.info
# it will not work on antminer (zwilla mod)
chown www-data:www-data /media/card/zwilla/www/*
echo 1
chmod -R 777 /config/user_data
