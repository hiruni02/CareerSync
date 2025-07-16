<?php
    #put <?=ROOT in the beginning when referencing using absolute path
    if($_SERVER['SERVER_NAME']=='localhost'){
        define('ROOT','http://localhost/CareerSync/MVC/public/');
    }
    else{
        define('ROOT','http://the website name once you launch the dite to the internet');
    }
