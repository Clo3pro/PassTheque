<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=passTheque;charset=utf8', 'root', 'root');
}
catch(Exception $e){
    die('Error :' .$e->getMessage());
}

?>