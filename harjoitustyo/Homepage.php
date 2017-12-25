<?php session_start();
if(!isset($_SESSION["kirjautuminen"])){
	//header('Location: Login.php?takaisin');
} 
require_once("db.inc"); 

function Tarkaste($conn,$muuttuja){
       
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

$tyonkuvaus = Tarkaste($conn, "tyonkuvaus");
$aloitusaika = Tarkaste($conn, "aloitusaika");
$kommentti = Tarkaste($conn, "kommentti");
$tunnit = Tarkaste($conn, "tunnit");
$tarvikkeet = Tarkaste($conn, "tarvikkeet");
$hinta = Tarkaste($conn, "hinta");
$tilaus = Tarkaste($conn, "tilaus");
$unixaika = time();
$tilausaika = date("Y-m-d",$unixaika);
echo $tilausaika;
$status = "TILATTU";
if($tilaus != ""){
			$tilausarray = array();
			$tilausarray["kayttajaid"] = $_SESSION["kayttajatiedot"]["key_id"];
			//echo $tilausarray["kayttajaid"];
			//INSERT INTO `orders`(`customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost`) VALUES ([value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
				
				
				$tilausquery = "INSERT INTO `orders`(`customer_id`, `description`, `order_date`, `start_date`, `status`, `comment`, `workhours`, `supplement`, `cost`) VALUES ('" . $tilausarray["kayttajaid"] . "','$tyonkuvaus','$tilausaika','$aloitusaika','$status','$kommentti','$tunnit','$tarvikkeet','$hinta')";
	
	echo $tilausquery;
	
	if(mysqli_query($conn,$tilausquery))
	{
		echo "onnistu";
	}
	else
	{
		echo "feilas";
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Päänäyttö </title>
</head>
<body>
		<a href="muutos.php">Hei <?php echo $_SESSION["kayttajatiedot"]["name"]; ?>   tästä pääset  muuttamaan tietojasi</a>
		
		
<!--		INSERT INTO `orders`(`id`, `customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])--> 
		<h1>Tilaa työ</h1>
		<form action="Homepage.php" method="get">
			Työnkuvaus : <input type="text" name="tyonkuvaus"  ><br>
			Aloitusaika : <input type="text" name="aloitusaika"  ><br>
			Kommentit : <input type="text" name="kommentti"  ><br>
			Tunnit : <input type="text" name="tunnit"  ><br>
			Tarvikkeet <input type="text" name="tarvikkeet"  > <br>
			Hinta : <input type="text" name="hinta"  ><br>
			
			<input type="submit" value="Tee työtilaus" name="tilaus">
		</form>
		
		<h2>Tilauksesi</h2>
		
		<?php $sql = "SELECT `id`, `customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost` FROM `orders` WHERE `customer_id` = " . $_SESSION["kayttajatiedot"]["key_id"] . " "; 
		
	//echo $sql;
	$tulos = mysqli_query($conn, $sql);
	   
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
        
		
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { echo <<<EOT

EOT;
  			}
		} 
    
		
	
	?>
		
		
		
		<table>
			<tr>
				<th>Työnkuvaus</th>
				<th>Tilausaika</th>
				<th>Aloitusaika</th>
				<th>Status</th>
				<th>Kommentti</th>
				<th>Tunnit</th>
				<th>Tarvikkeet</th>
				<th>Hinta</th>
				
			</tr>
		</table>
		
</body>
</html>