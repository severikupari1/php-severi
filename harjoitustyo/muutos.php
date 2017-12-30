<?php session_start();
if(!isset($_SESSION["kirjautuminen"])){
	header('Location: Login.php?takaisin');
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

function Tulostaja($muuttuja){
	$testiarray = array();
	$testiarray = $_SESSION["kayttajatiedot"];
	
	echo $testiarray["$muuttuja"];
}

function Asuntotyyppi($tarkastettava){
	if(isset($_SESSION["kayttajatiedot"]["apartment_type"])){
	if($_SESSION["kayttajatiedot"]["apartment_type"] == "$tarkastettava"){echo "selected";}
}
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
	$keyid = array();
	$keyid = $_SESSION["kayttajatiedot"]["key_id"];
	
//	UPDATE `customer` SET `key_id`=[value-1],`username`=[value-2],`password`=[value-3],`name`=[value-4],`address`=[value-5],`billing_address`=[value-6],`phone_number`=[value-7],`email`=[value-8],`apartment_type`=[value-9],`apartment_area`=[value-10],`property`=[value-11] WHERE 1
	
	$updatequery = "UPDATE `customer` SET `name`='$nimi',`address`='$kayntiosoite',`billing_address`='$laskutusosoite',`phone_number`='$puhelinnumero',`email`='$email',`apartment_type`='$asuntotyyppi',`apartment_area`='$asuntopintala',`property`='$tonttipintala' WHERE `customer`.`key_id` = $keyid";
	
	//echo $updatequery;
	
	
	if(!mysqli_query($conn, $updatequery)){
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else{
		echo "onnistu";
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
        
		echo "haetaan kannasta";
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
<!--	$_SESSION["kayttajatiedot"]
kayttajatunnus

nimi
kayntiosoite
laskutusosoite
puhelinnumero
email
asuntopintala
tonttipintala
rekisteroi

-->
<?php 
	//var_dump($_SESSION["kayttajatiedot"]);
	//print_r($_SESSION);
	
	
	?>
	<form action="muutos.php" method="get">
		
		Nimesi : <input type="text" name="nimi" value="<?php Tulostaja("name") ?>"><br>
		Osoite : <input type="text" name="kayntiosoite" value="<?php Tulostaja("address") ?>"><br>
		Laskutusosoite : <input type="text" name="laskutusosoite" value="<?php Tulostaja("billing_address") ?>"><br>
		Puhelinnumero : <input type="text" name="puhelinnumero" value="<?php Tulostaja("phone_number") ?>"><br>
		Sähköposti : <input type="text" name="email" value="<?php Tulostaja("email") ?>"><br>
		
		Asuntotyyppi : <select name="asuntotyyppi" id="">
        	<option value=""></option>
        	<option value="omakotitalo" <?php Asuntotyyppi("omakotitalo");
 ?> >omakotitalo</option>
        	<option value="vapaa-ajan-asunto" <?php Asuntotyyppi("vapaa-ajan-asunto"); ?> >vapaa-ajan-asunto</option>
        	<option value="maatila" <?php Asuntotyyppi("maatila");
					 ?> >maatila</option>
        </select>
        <br>
		
		Asunnon pinta-ala : <input type="text" name="asuntopintala" value="<?php Tulostaja("apartment_area") ?>"><br>
		Tonttisi koko : <input type="text" name="tonttipintala" value="<?php Tulostaja("property") ?>"><br>
		<input type="submit" value="Muuta tietojasi" name="muutos">
	</form>
	<a href="Homepage.php">Takaisin päänäyttöön</a>
</body>
</html>