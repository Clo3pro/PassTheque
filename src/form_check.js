"use strict";
function checkForm(){
    var a= document.forms['addBook']['titre'].value;
    var b= document.forms['addBook']['isbn'].value;
    var c= document.forms['addBook']['annee'].value;
    var d= document.forms['addBook']['nbPages'].value;
    var nbErreurs=0;
    if(a == ""){
        document.getElementById('titre').style.borderColor = "red";
        document.getElementById('verif_titre').innerHTML ="Vous devez renseigner un titre!";
        nbErreurs++;
    }else{
        document.getElementById('titre').style.borderColor = "";
    }
    if(b==""){
        document.getElementById('isbn').style.borderColor = "red";
        document.getElementById('verif_isbn').innerHTML ="Vous devez renseigner un isbn!";
        nbErreurs++;
    }else{
        document.getElementById('titre').style.borderColor = "";
    }
    if(c=="" ||( c<1500 && c>2020)){
        document.getElementById('annee').style.borderColor = "red";
        document.getElementById('verif_annee').innerHTML ="Vous devez renseigner une année!";
        nbErreurs++;
    }else{
        document.getElementById('titre').style.borderColor = "";
    }
    if(d<4){
        document.getElementById('nbPages').style.borderColor = "red";
        document.getElementById('verif_nbPages').innerHTML ="Il faut au moins 4 pages! (sinon rien)";
        nbErreurs++;
    }else{
        document.getElementById('titre').style.borderColor = "";
    }
    if(nbErreurs ==0){
        return true;
    }else{
        return false;
    }




}