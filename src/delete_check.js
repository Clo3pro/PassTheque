'use strict'
function areYouSure(){
    var other= document.write("<a id='link_details' href= ''>")
    var result = confirm("Voulez-vous vraiment supprimer ce livre?");
    if(result ==true){
       
       
        //document.getElementById('link_detail').isContentEditable;
        //document.getElementById('link_details').href="supprimer.php?id='<?=HtmlSpecialChars($donnees['isbn'])?>'";
       // document.getElementById('options_livre').submit();
        // document.location.href= "supprimer.php";
        //document.getElementById("link_details").removeAttribute("disabled");
    }else{
        document.getElementById('link_details').replaceWith(other);
        //document.getElementById("link_details").setAttribute("disabled","true");
       // document.getElementById('link_details').href="admin.php";
        
       //document.location.href = "admin.php";
        
    }
}