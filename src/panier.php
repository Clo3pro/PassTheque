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
?>
<article class="grid">
    <?php 
        foreach ($_SESSION["panier"] as $key =>$value){
            // Requete de récupération du produit numéro $key (idProduit)
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
    ?>
   
</article>
<?php include "bas.php"?>