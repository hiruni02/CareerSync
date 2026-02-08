<?php
#put <?=ROOT in the beginning when referencing using absolute path
if ($_SERVER['SERVER_NAME'] == 'localhost') {

    #database config
    define('DBNAME', 'CareerSync');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');

    define('ROOT', 'http://localhost/CareerSync/MVC/public/');

// } else if ($_SERVER['SERVER_NAME'] == '2c0f9c49573c.ngrok-free.app') {
//     #database config
//     define('DBNAME', 'CareerSync');
//     define('DBHOST', '2c0f9c49573c.ngrok-free.app');
//     define('DBUSER', 'root');
//     define('DBPASS', '');

//     define('ROOT', 'https://2c0f9c49573c.ngrok-free.app/CareerSync/MVC/public/');

} else {
    #database config
    define('DBNAME', 'CareerSync');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');

    define('ROOT', '/CareerSync/MVC/public/');
}
