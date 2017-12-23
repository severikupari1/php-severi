<?php session_start();
if(!isset($_SESSION["kirjautuminen"])){
	//header('Location: Login.php?takaisin');
} 
require_once("db.inc"); 



?>


<?php 
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
//	SELECT `key_id`,`name`,`address`,`billing_address`,`phone_number`,`email`,`apartment_type`,`apartment_area`,`property` FROM `customer` WHERE 1

//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Päänäyttö </title>
</head>
<body>
		<a href="muutos.php">Hei <?php echo $_SESSION["kayttajatiedot"]["name"]; ?>   pääset tästä muuttamaan tietojasi</a>
</body>
</html>