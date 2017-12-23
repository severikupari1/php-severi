<?php session_start();
if(!isset($_SESSION["kirjautuminen"])){
	//header('Location: Login.php?takaisin');
} 
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


?>


<?php 

$muutos = Tarkaste("muutos",$conn);

if($muutos != ""){
	
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
	
	
//	UPDATE `customer` SET `key_id`=[value-1],`username`=[value-2],`password`=[value-3],`name`=[value-4],`address`=[value-5],`billing_address`=[value-6],`phone_number`=[value-7],`email`=[value-8],`apartment_type`=[value-9],`apartment_area`=[value-10],`property`=[value-11] WHERE 1
	
	$updatequery = "UPDATE `customer` SET `name`='$nimi',`address`='$kayntiosoite',`billing_address`='$laskutusosoite',`phone_number`='$puhelinnumero',`email`='$email',`apartment_type`='$asuntotyyppi',`apartment_area`='$asuntopintala',`property`='$tonttipintala' WHERE 1";
	
}




if(isset($_SESSION["kayttajatiedot"])){

$kayttajatunnus = array();
$kayttajatunnus =$_SESSION["kayttajatiedot"]["kayttajatunnus"];



$kayttajatiedothaku = "SELECT `key_id`,`name`,`address`,`billing_address`,`phone_number`,`email`,`apartment_type`,`apartment_area`,`property` FROM `customer` WHERE  `username` = '$kayttajatunnus'
";     

//	SELECT `key_id`,`name`,`address`,`billing_address`,`phone_number`,`email`,`apartment_type`,`apartment_area`,`property` FROM `customer` WHERE 1


    $tulos = mysqli_query($conn, $kayttajatiedothaku);
	   
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
        
		
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			
			$_SESSION["kayttajatiedot"]["key_id"] = $rivi["key_id"];
				
			$_SESSION["kayttajatiedot"]["name"] = $rivi["name"];
			
			$_SESSION["kayttajatiedot"]["address"] = $rivi["address"];
			
			
			$_SESSION["kayttajatiedot"]["billing_address"] = $rivi["billing_address"];
			
			$_SESSION["kayttajatiedot"]["phone_number"] = $rivi["phone_number"];
			
			$_SESSION["kayttajatiedot"]["email"] = $rivi["email"];
			
			$_SESSION["kayttajatiedot"]["apartment_type"] = $rivi["apartment_type"];
			
			$_SESSION["kayttajatiedot"]["apartment_area"] = $rivi["apartment_area"];
			
			$_SESSION["kayttajatiedot"]["property"] = $rivi["property"];
		
  			}
		} 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Käyttäjäntietojen muutos</title>
</head>
<body>
	<h1>Tietosi</h1>
	
	<form action="muutos.php" method="get">
		
		Nimesi : <input type="text" name="" value=""><br>
		Osoite : <input type="text" name="" value=""><br>
		Laskutusosoite : <input type="text" name="" value=""><br>
		Puhelinnumero : <input type="text" name="" value=""><br>
		Sähköposti : <input type="text" name="" value=""><br>
		
		Asuntotyyppi : <select name="asuntotyyppi" id="">
        	<option value=""></option>
        	<option value="omakotitalo" <?php if(isset($_SESSION["kayttajatiedot"]["apartment_type"])){
	if($_SESSION["kayttajatiedot"]["apartment_type"] == "omakotitalo"){echo "selected";}
} ?> >omakotitalo</option>
        	<option value="vapaa-ajan-asunto" <?php if(isset($_SESSION["kayttajatiedot"]["apartment_type"])){
	if($_SESSION["kayttajatiedot"]["apartment_type"] == "vapaa-ajan-asunto"){echo "selected";}
} ?> >vapaa-ajan-asunto</option>
        	<option value="maatila" <?php if(isset($_SESSION["kayttajatiedot"]["apartment_type"])){
	if($_SESSION["kayttajatiedot"]["apartment_type"] == "maatila"){echo "selected";}
} ?> >maatila</option>
        </select>
        <br>
		
		Asunnon pinta-ala : <input type="text" name="" value=""><br>
		Tonttisi koko : <input type="text" name="" value=""><br>
		<input type="submit" value="Muuta tietojasi" name="muutos">
	</form>
	
</body>
</html>