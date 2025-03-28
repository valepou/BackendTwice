<?php 
    ob_start();
    session_start();
    date_default_timezone_set('America/Mazatlan');

    define('LOCALHOST','127.0.0.1');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','app_ventas');
    define('SITEURL','http://localhost/Twice/backend');

    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

    if(!$conn){
        echo "Error: no se puede conectar a Mysql ".PHP_EOL;
        echo "Error # de depuración" . mysqli_connect_errno().PHP_EOL;
        echo "Error de depuración" . mysqli_connect_error().PHP_EOL;
        exit;
    }

?>