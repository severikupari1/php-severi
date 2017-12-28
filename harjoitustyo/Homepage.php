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

$poista = Tarkaste($conn, "poista");

if($poista != ""){

		 $sql = "DELETE FROM `orders` WHERE `orders`.`id` = $poista";
		//echo $sql;
		if(mysqli_query($conn, $sql))
		{
			header('Location: Homepage.php?poisto_ok=1');
			
		}
		else{
			header('Location: Homepage.php?poisto_feilas');
		}
	}


$muokattavaid = Tarkaste($conn, "muokattavaid");
$poisto_ok = Tarkaste($conn, "poisto_ok");




$muokkaa = Tarkaste($conn, "muokkaa");
//echo $_SESSION["muokattavaid"];
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

$kommentti = Tarkaste($conn, "kommentti");
$tunnit = Tarkaste($conn, "tunnit");
$tarvikkeet = Tarkaste($conn, "tarvikkeet");
$hinta = Tarkaste($conn, "hinta");
$tilaus = Tarkaste($conn, "tilaus");
$unixaika = time();
$tilausaika = date("Y-m-d",$unixaika);
echo $tilausaika;
$status = "TILATTU";
$hyvaksytty  = Tarkaste($conn, "hyvaksytty");
$hylatty = Tarkaste($conn, "hylatty");



if($tilaus != "" && $tyonkuvaus != ""){
			$tilausarray = array();
			$tilausarray["kayttajaid"] = $_SESSION["kayttajatiedot"]["key_id"];
			//echo $tilausarray["kayttajaid"];
			//INSERT INTO `orders`(`customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost`) VALUES ([value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
				
				
				$tilausquery = "INSERT INTO `orders`(`customer_id`, `description`,`status`,`order_date`) VALUES ('" . $tilausarray["kayttajaid"] . "','$tyonkuvaus','$status','$tilausaika')";
	
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
			
<!--
			Kommentit : <input type="text" name="kommentti"  ><br>
			Tunnit : <input type="text" name="tunnit"  ><br>
			Tarvikkeet <input type="text" name="tarvikkeet"  > <br>
			Hinta : <input type="text" name="hinta"  ><br>
-->
			
			<input type="submit" value="Tee työtilaus" name="tilaus">
		</form>
		
		<h2>Tilauksesi</h2>
		<table>
			<tr>
				<th>Työnkuvaus</th>
				<th>Tilausaika</th>
				<th>Työaloitettu</th>
				<th>Työvalmis</th>			
				<th>Status</th>
				<th>Kommentti</th>
				<th>Tunnit</th>
				<th>Tarvikkeet</th>
				<th>Hinta</th>	
				<th>Hyväksytty</th>
				<th>Hylätty</th>	
			</tr>
		<?php $sql = "SELECT `id`, `customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost`,`finished_time` FROM `orders` WHERE `customer_id` = " . $_SESSION["kayttajatiedot"]["key_id"] . " "; 
		
	//echo $sql;
	$tulos = mysqli_query($conn, $sql);
	   
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
        
		
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { echo <<<EOT
<tr>
				<td>$rivi[description]</td>
				<td>$rivi[order_date]</td>
				<td>$rivi[start_date]</td>
				<td>$rivi[finished_time]</td>
				<td>$rivi[status]</td>
				<td>$rivi[comment]</td>
				<td>$rivi[workhours]</td>
				<td>$rivi[supplement]</td>
				<td>$rivi[cost]</td>
				<td>$rivi[acception_date]</td>
				<td>$rivi[rejection_date]</td>
			
EOT;
		if($rivi["status"] == "ALOITETTU"){
			
		 $unixaika = time();
         $aloitusaika = date("Y-m-d",$unixaika);
				
			
			
		$lisaysquery = "UPDATE `orders` SET `start_date` = '$aloitusaika' WHERE `orders`.`id` = $rivi[id]";	
		//echo $lisaysquery;
			if(mysqli_query($conn,$lisaysquery)){
				echo "aloitusaika onnistu";
			}
			else{
				echo "aloitusaika feilas";
			}
			
	}
		
	if($rivi["status"] == "VALMIS"){
			
		 $unixaika = time();
         $valmisaika = date("Y-m-d",$unixaika);
		
		$valmissquery = "UPDATE `orders` SET `finished_time` = '$valmisaika' WHERE `orders`.`id` = $rivi[id]";	
		echo $valmissquery;
			if(mysqli_query($conn,$valmissquery)){
				echo "valmis onnistu";
			}
			else{
				echo "valmis feilas";
			}
		echo "<td><a href=\"Homepage.php?hyvaksytty=$rivi[id]\">hyväksy</a></td>";
		echo "<td><a href=\"Homepage.php?hylatty=$rivi[id]\">hylkää</a></td>";
				
	}
															
	if($rivi["status"] == "TILATTU"){
		echo "<td><a href=\"Homepage.php?muokattavaid=$rivi[id]\">Muokkaa</a> </td>";
		
		echo "<td><a href=\"Homepage.php?poista=$rivi[id]\">Poista</a> </td>";
	}
					
	
															
															
		echo "</tr>";
  			}
		} 
    
	
	
	
	?>
			
		</table>
		
	<?php
	
//	if($muokattavaid != ""){
//		$sql  = 
//		"SELECT `id`, `customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost` FROM `orders` WHERE `customer_id` = " . $_SESSION["kayttajatiedot"]["key_id"] . " AND id = $muokattavaid"; 
//		echo $sql;
//		
//		$tulos = mysqli_query($conn, $sql);
//	if ( !$tulos )
//	{
//		echo "Kysely epäonnistui " . mysqli_error($conn);
//	}
//	else
//	{
//        
//		
//		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) {
//			echo "
//			<h1></h1>
//			<form action=\"Homepage.php?muokataan\" method=\"get\">
//			Työnkuvaus : <input type=\"text\" name=\"tyonkuvaus\" value=\"$rivi[description]\"><br>
//			
//			Aloitussaika : <input type=\"text\" name=\"aloitusaika\" value=\"$rivi[order_date]\"><br>
//			
//			Kommentti : <input type=\"text\" name=\"kommentti\" value=\"$rivi[comment]\"><br>
//			
//			Tunnit : <input type=\"text\" name=\"tunnit\" value=\"$rivi[workhours]\"><br>
//			
//			Tarvikkeet : <input type=\"text\" name=\"tarvikkeet\" value=\"$rivi[supplement]\"><br>
//			
//			Hinta : <input type=\"text\" name=\"hinta\" value=\"$rivi[cost]\"><br>
//			
//			<input type=\"submit\" value=\"Muokkaa\" name =\"muokkaa\">
//	
//	      <input type=\"submit\" value=\"Peruuta\" name =\"\">
//		</form>	";
//		}
//	} 
//		
//	}//ison Iffin
	
	/*
				$rivi[description]</td>
				$rivi[order_date]</td>
				$rivi[start_date]</td>
				$rivi[status]</td>
				$rivi[comment]</td>
				$rivi[workhours]</td>
				$rivi[supplement]</td>
				$rivi[cost]
	*/
	
	
		if($muokattavaid != ""){
		$sql  = 
		"SELECT `id`, `customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost` FROM `orders` WHERE `customer_id` = " . $_SESSION["kayttajatiedot"]["key_id"] . " AND id = $muokattavaid"; 
		//echo $sql;
		$_SESSION["muokattavaid"] = $muokattavaid;
			
			
		$tulos = mysqli_query($conn, $sql);
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
        
		
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) {
			echo "
			<h1>Muokkaa </h1>
			<form action=\"Homepage.php?muokataan\" method=\"get\">
			Työnkuvaus : <input type=\"text\" name=\"tyonkuvaus\" value=\"$rivi[description]\"><br>
	
			<input type=\"submit\" value=\"Muokkaa\" name =\"muokkaa\">
	
	      <input type=\"submit\" value=\"Peruuta\" name =\"\">
		</form>	";
		}
	} 
		
	}//ison Iffin
	
	if($muokkaa != ""){
		$muokkausid = $_SESSION["muokattavaid"];
		
		
		 $sql = "UPDATE `orders` SET `description` = '$tyonkuvaus' WHERE `orders`.`id` = $muokkausid ";
		echo $sql;
		if(mysqli_query($conn, $sql))
		{
			echo "päivitys onnistui!";
		}
		else{
			echo "päivittäminen ei onnistunut";
		}
	}
	
	if($poisto_ok != ""){
		echo "<p>poisto onnistui</p>";
	}
		
	
	
	
	
	?>	
	
		
		
		
</body>
</html>