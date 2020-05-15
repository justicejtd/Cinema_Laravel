# Cinema_Laravel_Justice_Denitsa

   This application about a cinema where the user should be to see the available movies, purchase a ticket, create a profile, export      tickets and the admin account should be able to upload/delete/update movies
   
   There are three types of user, visitor, admin and user.
   To access the admin account use for email admin@hotmail.com and for password "secret".
   Admin is able to export all the users to exel file and upload/delete movies with watermark.
   When opening the exel file rember to enable the editing
   
   When reseting the password, Mail username and password are required in the env file
   MAIL_USERNAME=621240f8717157
   MAIL_PASSWORD=d5433bb3a502d1
   MAIL_ENCRYPTION=tls
   
   To recieve the reset link go to https://mailtrap.io and login with the following credentials
   email: sweettourweb1@gmail.com, password: 01234Sweet (Fake email - https://mailtrap.io)
   
   The web application can also be found on the hera server http://i407172.hera.fhict.nl/ (import of profile image is not working)
   
To make connection to the database (in the .env file)   
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cinema
DB_USERNAME=root
DB_PASSWORD=
   
