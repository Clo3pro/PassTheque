<?php
if(isset($_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['mail'],$_POST['phone'])){
                $mrequest = $pdo->prepare('
                INSERT INTO membre
                VALUES( "'.$_POST['nom'].'",
                        "'.$_POST['prenom'].'",
                        "'.$_POST['password'].'",
                        "'.$_POST['mail'].'",
                        "'.$_POST['phone'].'")
                ');
                $mrequest->execute(array($_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['mail'],$_POST['phone'])) ;  
                var_dump($membrerequest);}
?>
