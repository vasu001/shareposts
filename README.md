# Sharepost APP

A small PHP OOP App Blog which lets you have CRUD functionality.

## Steps

1. Go to app/config->config.php
2. Put your DB_NAME, DB_USER, DB_PASSWORD, DB_HOST, URLROOT.
3. Put the directory into htdocs folder of XAMPP, WAMP, MAMP, etc.
4. Go to public/db and import the db file to phpmyadmin directly. No need to create new database.
5. Go to http://localhost/shareposts/ to run the app.

## Note

You will have to edit .htaccess file in public folder if you're deploying it anywhere else. Currently, Rewrite is /shareposts/public which means it is accessing shareposts/public folder of htdocs. Change it according to your server.
