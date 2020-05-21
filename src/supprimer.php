  <?php include('header.php')?>
  <?php 
        //   requêtes de suppression d'un livre et de ses auteurs à partir de l'isbn récupéré dans l'url
            if(isset($_GET['id'])){
                $livreRequestSupp = $pdo->prepare('
                DELETE FROM Livre
                WHERE  isbn = ?   
                ');
                $auteurRequestSupp = $pdo->prepare('
                DELETE FROM Auteur
                WHERE idLivre = ?');
                $livreRequestSupp->execute(array($_GET['id'])) ;  
                $auteurRequestSupp->execute(array($_GET['id'])) ;
            }
?>   


    <a href="admin.php"><h1> Livre supprimé ! cliquez pour revenir sur la page admin.</h1></a>
<?php include('bas.php');?>