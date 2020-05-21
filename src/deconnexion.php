<?php
session_start();
$_SESSION = array();
session_destroy();
unset($_SESSION);
include('header.php');
?>
<h2 class='title'> Session terminée! retournez à l'<a href='accueil.php'>Accueil</a></h2>

<?php
include('bas.php');
?>
