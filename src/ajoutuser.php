
<?php
include("connexion_db.php");
if(isset($_POST)){
                $mrequest = $pdo->prepare('
                INSERT INTO Membre (nom,prenom,motDePasse,email,telephone)
                VALUES( ?,
                        ?,
                        ?,
                        ?,
                        ?)
                ');
                $mrequest->execute(array($_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['mail'],$_POST['phone'])) ;  
                var_dump($mrequest);}

                header("Location: connexion.php");
?>
