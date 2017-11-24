

<?php
        if(isset($_GET['postinumero']) &&isset($_GET['kotikunta'])){
            $kotikunta = $_GET['kotikunta'];
   
    
        
        $postinumero = $_GET['postinumero'];
        }
        
   
    
if(isset($_GET['postinumero'])){
    if(strlen($_GET['postinumero']) == 5 ){
        echo "Kotikuntasi on : $kotikunta<br>";
        echo "Postinumerosi on $postinumero<br>";
    }else{
    echo "Postinumerosi oli väärin, palaa takaisin <a href='index.php?virhe'>tästä</a> antamaan oikeat tiedot";
}
    
}

?>