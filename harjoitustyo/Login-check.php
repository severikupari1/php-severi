<?php session_start();  
require_once("db.inc");
    
    
    function Tarkaste($muuttuja,$conn){
       
   if(isset($_GET[$muuttuja]))
     {
       
    $palautus= mysqli_real_escape_string($conn,$_GET[$muuttuja]);    
    }
    else
    {
           $palautus = "";
    }
    return $palautus;
}
    

        //ylempiform
        $login = Tarkaste("login",$conn);
        $kayttajatunnus = Tarkaste("kayttajatunnus",$conn);
        $salasana = Tarkaste("salasana",$conn);
        $nimi = Tarkaste("nimi",$conn);
        $kayntiosoite = Tarkaste("kayntiosoite",$conn);
        $laskutusosoite = Tarkaste("laskutusosoite",$conn);
        $puhelinnumero = Tarkaste("puhelinnumero",$conn);
        $email = Tarkaste("email",$conn);
        $rekisteroi = Tarkaste("rekisteroi",$conn);
        $salasanauudelleen = Tarkaste("salasanauudelleen",$conn);
        $asuntotyyppi= Tarkaste("asuntotyyppi",$conn);
        $asuntopintala   = Tarkaste("asuntopintala",$conn);
        $tonttipintala = Tarkaste("tonttipintala",$conn);

        //alempiform
        $kayttajatunnuscheck = Tarkaste("kayttajatunnuscheck",$conn);
        $salasanacheck = Tarkaste("salasanacheck",$conn);

if($rekisteroi != ""){
    // TOIMII!
    if($kayttajatunnus != "" && $salasana != "" && $nimi != "" && $kayntiosoite !="" &&  $laskutusosoite != "" && $puhelinnumero != "" && $email != "" && $asuntotyyppi != "" && $asuntopintala != "" && $tonttipintala != ""){
        
        
        $checkquery = "SELECT `username` FROM `customer` WHERE `username` = '$kayttajatunnus' ";
        
        
        $insertquery = "INSERT INTO `customer`(`username`, `password`, `name`, `address`, `billing_address`, `phone_number`, `email`, `apartment_type`, `apartment_area`, `property`) VALUES ('$kayttajatunnus','$salasana','$nimi','$kayntiosoite','$laskutusosoite','$puhelinnumero','$email','$asuntotyyppi','$asuntopintala','$tonttipintala')";
    
    // Debugging echo $insertquery;
    
        if(mysqli_query($conn, $checkquery)){
            if(mysqli_query($conn, $insertquery)){
               echo "<p>Lisäys onnistui</p>";
           }
           else 
           {
               echo "lisäys epaonnistui ";
           }
        }
          
        
        
        
        
        
        
        
        }//Check jos kaikki on annettu!
    else    {
        echo "Et antanut kaikkia kenttia!";
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarkastele</title>
</head>
<body>
    
 <?php 
    
    
    ?>
</body>
</html>