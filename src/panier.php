<?php include "header.php"?>
<!-- Panier -->
<?php 
    if(isset($_GET['id']) && isset($_GET['action'])){
        // echo "id: ". $_GET['id'];
        if($_GET['action']=="add"){
            $_SESSION['panier'][$_GET['id']]++;
        }
        else if($_GET['action']=="del"){
            if($_SESSION['panier'][$_GET['id']] ==1){
                //supprimer du panier
                unset($_SESSION['panier'][$_GET['id']]);
            }else{
                //décrémenter l'article
                $_SESSION['panier'][$_GET['id']]--;
            }
        }
    }
    $date= date('Y-m-j');
    $goodEndDate = date('j/m/Y',strtotime("+ 30 days"));
    $datefin=  date('Y-m-j',strtotime("+ 30 days"));
    if(isset($_GET['reserve'])){
         foreach ($_SESSION["panier"] as $key =>$value){
            for($i = 0;$i<$value;$i++){
                $query = $pdo ->prepare('
                INSERT INTO Reservation (idMembre,isbn,dateDebut,dateFin)
                VALUES (?,?,?,?)
                ');
                $query -> execute(array($_SESSION['id'],$key,$date,$datefin));
            }  
        }
        $_SESSION['panier']= array();
        echo '<h2 class="title">Votre réservation est confirmée! vous avez jusqu\'au '.$goodEndDate.' Pour rendre vos livres!</h2>';
   }
    

   
?>
<article class="grid">
    <?php 
   // var_dump($_SESSION['panier']);
        foreach ($_SESSION["panier"] as $key =>$value){
            // Requete de récupération du livre numéro $key (isbn)
            $query = $pdo ->prepare('
                        SELECT titre
                        FROM Livre
                        WHERE isbn=?');
            $query -> execute(array($key));
            $row = $query->fetch();
            echo "<section class='articles'>";
            echo $row[0] . " | " . $value . " exemplaires";
            echo "<a href='?id=".$key."&action=add'>[+]</a>";
            echo "<a href='?id=".$key."&action=del'>[-]</a>";
            echo "</section>";
        }
        if(isset($_SESSION['panier']) && $_SESSION['panier'] != NULL){
            echo "<a href='panier.php?id=".$_SESSION['id']."&reserve='true''><input type='button' name='validation' value='Valider le panier'></a>";
        }

    ?>
   
</article>
<?php include "bas.php"?>