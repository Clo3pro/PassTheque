
<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=passTheque;charset=utf8', 'root', '');
}
catch(Exception $e){
    die('Error :' .$e->getMessage());
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PassThèque - Explorer</title>
    <link href="css/modification.css" rel="stylesheet" type="text/css" media="all" />


</head>
    
<body>
<?php include("nav.php"); ?>
    
<?php $donnees = $reponse = $bdd->query('SELECT Personne.nom, Personne.prenom, Livre.titre,Livre.annee,Livre.isbn
FROM Livre
JOIN Auteur ON Livre.isbn = Auteur.idLivre
JOIN Personne ON Auteur.idPersonne = Personne.id
ORDER BY Personne.nom

');


while($donnees = $reponse->fetch()){
   

?>
<div id="bloc_Livre">
    <div id= "image_Livre">
<?php

$image = "images/"."$donnees[isbn]".".jpg";

print '<img src="'.$image.'" alt="texte alternatif" />';

?>
</div>
<div id = "text_Livre">
    <p id="affich_Liv"><strong>Livre</strong> : <?php echo $donnees['titre']; ?><br />
    écrit par : <?php echo $donnees['prenom']; ?> <?php echo $donnees['nom']; ?>
    en : <?php echo $donnees['annee'];?>
   </p>
    
</div>
</div>
<?php 
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>
<?php include("bas.php");?>
</body>
    
    
</html>