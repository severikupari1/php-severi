<?php session_start();
if(!isset($_SESSION["kirjautuminen"])){
	header('Location: Login.php?takaisin');
} 
require_once("db.inc");
$kirjaudu_ulos = Tarkaste($conn, "kirjaudu_ulos");

if($kirjaudu_ulos != ""){
		
unset($_SESSION['kirjautuminen']);
	header('Location: Login.php?kirjauduit_ulos');
}

 

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
$tarjouspoista = Tarkaste($conn, "tarjouspoista");
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
if($tarjouspoista != ""){

		 $sql = "DELETE FROM `requestorder` WHERE `requestorder`.`id` = $tarjouspoista";
		//echo $sql;
		if(mysqli_query($conn, $sql))
		{
			header('Location: Homepage.php?tarjouspoisto_ok=1');
			
		}
		else{
			header('Location: Homepage.php?tarjouspoisto_feilas');
		}
	}

$muokattavaid = Tarkaste($conn, "muokattavaid");
$poisto_ok = Tarkaste($conn, "poisto_ok");
$tarjouspyynto_kuvaus = Tarkaste($conn, "tarjouspyynto_kuvaus");
$tarjouspyynto = Tarkaste($conn, "tarjouspyynto");

$muokkaa = Tarkaste($conn, "muokkaa");

?>


<?php 
if(isset($_SESSION["kayttajatiedot"])){

$kayttajatunnus = array();
$kayttajatunnus =$_SESSION["kayttajatiedot"]["kayttajatunnus"];



$kayttajatiedothaku = "SELECT `key_id`,`name`,`address`,`billing_address`,`phone_number`,`email`,`apartment_type`,`apartment_area`,`property` FROM `customer` WHERE  `username` = '$kayttajatunnus'
";     


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


if($hyvaksytty != ""){
	$unixaika = time();
    $hyvaksyttyaika = date("Y-m-d",$unixaika);
		
	$sql = "	UPDATE `orders` SET `status` = 'HYVAKSYTTY', `acception_date` = '$hyvaksyttyaika' WHERE `orders`.`id` = $hyvaksytty";
	
	
	if(mysqli_query($conn,$sql)){
		echo "onnistu";
	}
	else{
		echo "feilas";
	}
	
}

if($hylatty != ""){
	$unixaika = time();
    $hylattyaika = date("Y-m-d",$unixaika);
		
	$sql = "	UPDATE `orders` SET `status` = 'HYLATTY', `rejection_date` = '$hylattyaika' WHERE `orders`.`id` = $hylatty";
	
	mysqli_query($conn,$sql);
	
}

if($tilaus != "" && $tyonkuvaus != ""){
			$tilausarray = array();
			$tilausarray["kayttajaid"] = $_SESSION["kayttajatiedot"]["key_id"];
		
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
		<a href="muutos.php">Hei <?php echo $_SESSION["kayttajatiedot"]["name"]; ?>   tästä pääset  muuttamaan tietojasi</a><br><br>
		
		<a href="Homepage.php?kirjaudu_ulos=1">Kirjaudu ulos</a>
		<h1>Tilaa työ</h1>
		<form action="Homepage.php" method="get">
			Työnkuvaus : <input type="text" name="tyonkuvaus"  ><br>
		
			<input type="submit" value="Tee työtilaus" name="tilaus">
		</form>
		
		<h1>Tee tarjouspyyntö</h1>
		<form action="Homepage.php" method="get">
			Tarjouspyyntö : <input type="text" name="tarjouspyynto_kuvaus"  ><br>
	
			<input type="submit" value="Tee tarjouspyyntö" name="tarjouspyynto">
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
		
		$valmissquery = "UPDATE `orders` SET `finished_time` = '$valmisaika' WHERE `orders`.`id` = ";	
		
		
		$valmissquery = "UPDATE `orders` SET `status` = 'VALMIS', `comment` = 'Hienosti meni', `workhours` = '2', `supplement` = 'tarvikkeita meni 10e', `cost` = '300e',`finished_time` = '$valmisaika' WHERE `orders`.`id` = $rivi[id]"; 
		
		
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	<?php
$tarjousmuokataan = Tarkaste($conn, "tarjousmuokataan");
$tarjous_tyonkuvaus = Tarkaste($conn, "tarjous_tyonkuvaus");
$tarjous_muokkaa = Tarkaste($conn, "tarjous_muokkaa");
$tarjousmuokattavaid = Tarkaste($conn, "tarjousmuokattavaid");

	?>
	
	<h2>Tarjouspyynnöt</h2>
		<table>
			<tr>
				<th>Tarjouspyyntö</th>
				<th>jättöpvm</th>		
				<th>vastaamispvm</th>			
				<th>Status</th>		
				<th>Kommentti</th>	
				<th>Hinta</th>
				<th>Hyväksytty</th>
				<th>Hylätty</th>			
			</tr>
		<?php $sql = "SELECT `id`, `customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost`,`finished_time` FROM `requestorder` WHERE `customer_id` = " . $_SESSION["kayttajatiedot"]["key_id"] . " "; 
		
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
				
				<td>$rivi[finished_time]</td>
				<td>$rivi[status]</td>
				<td>$rivi[comment]</td>				
				<td>$rivi[cost]</td>
				<td>$rivi[acception_date]</td>
				<td>$rivi[rejection_date]</td>
			
EOT;
		if($rivi["status"] == "ALOITETTU"){
			
		 $unixaika = time();
         $aloitusaika = date("Y-m-d",$unixaika);
				
			
			
		$lisaysquery = "UPDATE `requestorder` SET `start_date` = '$aloitusaika' WHERE `requestorder`.`id` = $rivi[id]";	
					
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
		
		$valmissquery = "UPDATE `requestorder` SET `finished_time` = '$valmisaika' WHERE `requestorder`.`id` = ";	
		
		
		$valmissquery = "UPDATE `requestorder` SET `status` = 'VALMIS', `comment` = 'Hienosti meni', `workhours` = '2', `supplement` = 'tarvikkeita meni 10e', `cost` = '300e',`finished_time` = '$valmisaika' WHERE `requestorder`.`id` = $rivi[id]"; 
		
		
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
		echo "<td><a href=\"Homepage.php?tarjousmuokattavaid=$rivi[id]\">Muokkaa</a> </td>";
		
		echo "<td><a href=\"Homepage.php?tarjouspoista=$rivi[id]\">Poista</a> </td>";
	}
					
	
															
															
		echo "</tr>";
  			}
		} 
    
	
	
	
	?>
			
		</table>
		
	<?php
	
	
	
	
		if($tarjousmuokattavaid != ""){
		$sql  = 
		"SELECT `id`, `customer_id`, `description`, `order_date`, `start_date`, `status`, `acception_date`, `rejection_date`, `comment`, `workhours`, `supplement`, `cost` FROM `requestorder` WHERE `customer_id` = " . $_SESSION["kayttajatiedot"]["key_id"] . " AND id = $tarjousmuokattavaid"; 
		//echo $sql;
		$_SESSION["tarjous_muokattavaid"] = $tarjousmuokattavaid;
			
			
		$tulos = mysqli_query($conn, $sql);
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
        
		
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) {
			echo "
			<h1>Muokkaa tarjouspyyntöä</h1>
			<form action=\"Homepage.php?tarjousmuokataan\" method=\"get\">
			Työnkuvaus : <input type=\"text\" name=\"tarjous_tyonkuvaus\" value=\"$rivi[description]\"><br>
	
			<input type=\"submit\" value=\"Muokkaa\" name =\"tarjous_muokkaa\">
	
	      <input type=\"submit\" value=\"Peruuta\" name =\"\">
		</form>	";
		}
	} 
		
	}//ison Iffin
	
	if($tarjous_muokkaa != ""){
		$tarjousmuokataan = $_SESSION["muokattavaid"];
		
		
		 $sql = "UPDATE `orders` SET `description` = '$tarjous_tyonkuvaus' WHERE `requestorder`.`id` = $tarjousmuokataan ";
		echo $sql;
		if(mysqli_query($conn, $sql))
		{
			echo "päivitys onnistui!";
		}
		else{
			echo "päivittäminen ei onnistunut";
		}
	}
	
	if($tarjouspoista != ""){
		echo "<p>poisto onnistui</p>";
	}
	
	?>
		
		
		
</body>
</html>