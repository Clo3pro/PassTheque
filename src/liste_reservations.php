<?php 
include('header.php');
$query= $pdo->prepare('
SELECT r.isbn,r.retour,l.titre,r.dateDebut,r.dateFin,r.jourRetard,r.id, m.nom, m.prenom
FROM Reservation r
JOIN Livre l ON l.isbn = r.isbn
JOIN Membre m ON m.id = r.idMembre
WHERE idMembre = ?
');
$query -> execute(array($_SESSION['id']));
$row= $query-> fetchAll();
//var_dump($row);

$date= date('Y-m-j');
    if(isset($_GET['id']) && isset($_GET['return'])){
        $query = $pdo->prepare('
                    UPDATE Reservation
                    SET retour =1,
                        dateFin=?
                    WHERE id=?
                    ');
        $query->execute(array($date,$_GET['id']));
        header('Refresh: 1;URL=liste_reservations.php');
                
    }
    echo'
    <section class="admin">
    <table class="tableau_admin">
    <thead>
        <tr><th colspan="6" class="title">Réservations en cours</th></tr>
        <tr class="ligne_table">
        <th class="case_table">ISBN</th>
        <th class="case_table">Titre</th>
        <th class="case_table">Date de Réservation</th>
        <th class="case_table">Date maximum de retour</th>
        <th class="case_table"> Jours de retard </th>
    </thead>
    <tbody>';
    foreach($row as $rowliste){
        
    
        if($rowliste['retour']==0){
            
            echo'<tr class="ligne_table">';
           echo' <td class="case_table">'.$rowliste['isbn'].'</td>';
           echo' <td class="case_table">'.$rowliste['titre'].'</td>';
           echo' <td class="case_table">'.$rowliste['dateDebut'].'</td>';
           echo' <td class="case_table">'.$rowliste['dateFin'].'</td>';
           echo' <td class="case_table">'.$rowliste['jourRetard'].'</td>';
           echo "<td class='case_table'><a href='liste_reservations.php?id=".$rowliste['id']."&return=true'><input type='button' name='retour' value='Rendre le livre'></a></td>";
           echo' </tr>';
           
        }
        echo' </tbody>';
    }
  
    echo'
    </table>
    </section>
    <section class="admin2">
    <table class="tableau_admin">
        <thead> 
            <tr ><th colspan="5" id= "title">Historique de réservations</th></tr>
            <tr class="ligne_table">
            <th class="case_table">ISBN</th>
            <th class="case_table">Titre</th>
            <th class="case_table">Date de Réservation</th>
            <th class="case_table">Date effective de retour</th>
            <th class="case_table"> Jours de retard </th>
        </thead>
        <tbody>';
    foreach($row as $rowliste){
       
        if($rowliste['retour']==1){
           
            echo'<tr class="ligne_table">';
            echo' <td class="case_table">'.$rowliste['isbn'].'</td>';
            echo' <td class="case_table">'.$rowliste['titre'].'</td>';
            echo' <td class="case_table">'.$rowliste['dateDebut'].'</td>';
            echo' <td class="case_table">'.$rowliste['dateFin'].'</td>';
            echo' <td class="case_table">'.$rowliste['jourRetard'].'</td>';
            echo' </tr>';
            
            }
            echo' </tbody>';
        }
?>

      
    
</table>
 </section>
<?php 
include('bas.php');?>