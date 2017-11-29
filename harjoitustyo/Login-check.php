<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarkastele</title>
</head>
<body>
    
 <?php 
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
        //alempiform
        $kayttajatunnuscheck = Tarkaste("kayttajatunnuscheck",$conn);
        $salasanacheck = Tarkaste("salasanacheck",$conn);
    
    ?>
</body>
</html>