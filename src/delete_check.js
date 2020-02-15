'use strict'
function areYouSure(){
    
    var result = confirm("Voulez-vous vraiment supprimer ce livre?");
    if(result ==true){

        document.location.href= "supprimer.php?id="+ variableRecuperee;
        
    }else{
        document.location.href = "admin.php";
        
    }
}