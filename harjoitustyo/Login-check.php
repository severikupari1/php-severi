<?php session_start();  
require_once("db.inc");
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWD);
    
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
    $inserquery = "INSERT INTO `customer`(`username`, `password`, `name`, `address`, `billing_address`, `phone_number`, `email`, `apartment_type`, `apartment_area`, `property`) VALUES ('$kayttajatunnus','$salasana','$nimi','$kayntiosoite','$laskutusosoite','$puhelinnumero','$email','$asuntotyyppi','$asuntopintala','$tonttipintala')";
    
    if(mysqli_query($conn, $insertquery)){
               echo "<p>Lisäys onnistui</p>";
           }
           else 
           {
               echo "lisäys epaonnistui ";
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