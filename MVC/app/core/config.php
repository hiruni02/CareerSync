<?php
#put <?=ROOT in the beginning when referencing using absolute path
if ($_SERVER['SERVER_NAME'] == 'localhost') {

    #database config
    define('DBNAME', 'CareerSync');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');

    define('ROOT', 'http://localhost/CareerSync/MVC/public/');
} else {
    #database config
    define('DBNAME', 'CareerSync');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');

    define('ROOT', '/CareerSync/MVC/public/');
}
