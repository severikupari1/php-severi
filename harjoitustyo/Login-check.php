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
        
        $kayttajatunnus = Tarkaste("kayttajatunnus",$conn);
        $salasana = Tarkaste("salasana",$conn);
        $salasanauudelleen = Tarkaste("salasanauudelleen",$conn);
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
        $login = Tarkaste("login",$conn);

if($rekisteroi != ""){
    // TOIMII!
    $_SESSION["asiakastiedot"]["kayttajatunnus"] = $kayttajatunnus;
        $_SESSION["asiakastiedot"]["nimi"] = $nimi;
        $_SESSION["asiakastiedot"]["kayntiosoite"] = $kayntiosoite;
        $_SESSION["asiakastiedot"]["laskutusosoite"] = $laskutusosoite;
        $_SESSION["asiakastiedot"]["puhelinnumero"] = $puhelinnumero;
        $_SESSION["asiakastiedot"]["email"] = $email;
        $_SESSION["asiakastiedot"]["asuntotyyppi"] = $asuntotyyppi;
        $_SESSION["asiakastiedot"]["asuntopintala"] = $asuntopintala;
        $_SESSION["asiakastiedot"]["tonttipintala"] = $tonttipintala;

//    if($kayttajatunnus != "" && $salasana != "" && $nimi != "" && $kayntiosoite !="" &&  $laskutusosoite != "" && $puhelinnumero != "" && $email != "" && $asuntotyyppi != "" && $asuntopintala != "" && $tonttipintala != "")
    
    
    
    if($kayttajatunnus != "" && $salasana != "" && $nimi != "" && $kayntiosoite !="" &&  $laskutusosoite != "" && $puhelinnumero != "" && $email != "" && $asuntotyyppi != "" && $asuntopintala != "" && $tonttipintala != ""){

        $checkquery = "SELECT `username` FROM `customer` WHERE `username` = '$kayttajatunnus'";
        
        if(strcmp($salasana,$salasanauudelleen) !== 0 ){
            
            
            echo "Salasanat eivät täsmänneet";
           // header('Location: Login.php?salasanaeitasmaa');  
        }
        else{
           $insertquery = "INSERT INTO `customer`(`username`, `password`, `name`, `address`, `billing_address`, `phone_number`, `email`, `apartment_type`, `apartment_area`, `property`) VALUES ('$kayttajatunnus','$salasana','$nimi','$kayntiosoite','$laskutusosoite','$puhelinnumero','$email','$asuntotyyppi','$asuntopintala','$tonttipintala')";
    
    // Debugging echo $insertquery;
    echo $insertquery;
                if(mysqli_query($conn, $checkquery)){ //tarksitus onko kayttajatunnus
                    echo "Kayttajatunnus on varattu!";
                    //header('Location: Login.php?kayttajatunnusvarattu');
                }
                else{
                    if(mysqli_query($conn, $insertquery)){
                       echo "<p>Lisäys onnistui</p>";
                        //header('Location: Login.php?lisaysonnistui');
                   }
                   else 
                   {
                       echo "lisäys epaonnistui ";
                    //   header('Location: Login.php?lisaysepaonnistui');
                   }      
                    
                }       
           }
        }//Check jos kaikki on annettu!
    else   
    {
        echo "Et antanut kaikkia kenttia!";
       // header('Location: Login.php?kenttatyhja');
    } 
}
else{
  //  header('Location: Login.php?takaisin');
    
    //muista uncommenttaa
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