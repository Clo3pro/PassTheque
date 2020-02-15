'use strict'
function areYouSure(){
    var result = confirm("Voulez-vous vraiment supprimer ce livre?");
    if(result ==true){
        location.href = "supprimer.php";
        
    }else{
        location.href = "admin.php";
        
    }
}