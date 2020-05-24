<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'Sketch');
define('DB_PASSWORD', 'abdel996');
define('DB_NAME', 'task_manager');


 

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>


<!--       _
       .__(.)< (SKETCH)
        \___)   
 ~~~~~~~~~~~~~~~~~~-->