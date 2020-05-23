   <div id="header-banner">
        <div id="header">
            <div id="logo">
                <div classe="imglogo"><img src="images/logo3.PNG" width="200" height="200" alt="" /></div>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="exploration.php">Explorer</a></li>
                    <li><a href="ajouter_livre.php">Ajouter</a></li>
                    <li><a href="admin.php">Admin</a></li>
                    <li><a href="#">Achat</a></li>
                    <?php if($_SESSION['id'] != NULL){
                    echo "<li><a href=''>Connexion</a></li>";
                    }else{
                     echo "<li><a href=''>Déconnexion</a></li>";
                    }
                    ?>

                    
                </ul>
            </div>
        </div>
    </div>