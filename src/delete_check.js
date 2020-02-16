'use strict'
function areYouSure(){
    
    var result = confirm("Voulez-vous vraiment supprimer ce livre?");
    if(result ==true){
       
       return true;
        
    }else{
       document.location.href = "admin.php";
        return false;
    }
}