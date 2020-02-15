<?php
            if(isset($_POST['isbn'],$_POST['titre'],$_POST['editeur'],$_POST['annee'],$_POST['genre'],$_POST['langue'],$_POST['nbPages'])){
                $livreRequestSupp = $pdo->prepare('
                DELETE FROM Livre
                WHERE( "'.$_POST['isbn'].'",
                        "'.$_POST['titre'].'",
                        "'.$_POST['editeur'].'",
                        "'.$_POST['annee'].'",
                        "'.$_POST['genre'].'",
                        "'.$_POST['langue'].'",
                        "'.$_POST['nbPages'].'")');
                $livreRequestSupp->execute(array($_POST['isnb'],$_POST['titre'],$_POST['editeur'],$_POST['annee'],$_POST['genre'],$_POST['langue'],$_POST['nbPages'])) ;  
            }
?>  