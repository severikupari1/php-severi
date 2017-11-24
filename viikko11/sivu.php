<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>tehtävä 42</title>

		<style>
			.taul
			{
				text-align: left;
				border-style: solid;
				border-width: 0.1em;
				border-color: black;
				border-collapse: collapse;
				padding: 5px;
			}
		</style>

	</head>
	<body>
		<?php // INSERT INTO Asiakas (avain, nimi, osoite, postinro, postitmp, luontipvm, asty_avain) VALUES (3, 'Kalle', 'teku', '70100', 'kuopio', '7.11.2017', 3)
			require_once("db1.inc");

			$nimi = "";
			$osoite = "";
			$postinro = "";
			$postitmp = "";
			$asty = "";
			$haku = "style=display:block";
			$lisays = "style=display:none";
			$muokkaus = "style=display:none";
			$viesti = "";

			if (isset($_GET["nimi"])) 		{ $nimi = $_GET["nimi"]; }
			if (isset($_GET["osoite"])) 	{ $osoite = $_GET["osoite"]; }
			if (isset($_GET["postinro"])) 	{ $postinro = $_GET["postinro"]; }
			if (isset($_GET["tyyppi"])) 	{ $asty = $_GET["tyyppi"]; }
			if (isset($_GET["postitmp"]))	{ $postitmp = $_GET["postitmp"]; }
			if (isset($_GET["lisaa"])) 		{ $haku = "style=display:none"; $lisays = "style=display:block"; }
			if (isset($_GET["v"])) 			{ $viesti = $_GET["v"]; }
			if (isset($_GET["muok"])) 		{ $haku = "style=display:none"; $muokkaus = "style=display:block"; }
			
			
			if (isset($_GET["poista"]))
			{
				$avain = $_GET["poista"];
				$query = "DELETE FROM asiakas WHERE avain = '$avain'";
				$tulos = mysqli_query($conn, $query);
				
				if (!$tulos)
				{
					$viesti = "Poisto epäonnistui " . mysqli_error($conn);
				}
				else
				{
					$viesti = "Poisto onnistui";
				}
				
				if (isset($_SESSION["nimi"])) { $nimi = $_SESSION["nimi"]; }
				if (isset($_SESSION["osoite"])) { $osoite = $_SESSION["osoite"]; }
				if (isset($_SESSION["postinro"])) { $postinro = $_SESSION["postinro"]; }
				if (isset($_SESSION["asty"])) { $asty = $_SESSION["asty"]; }
				
				$hakuosoite = "sivu.php?nimi=$nimi&osoite=$osoite&postinro=$postinro&tyyppi=$asty&hae&v=$viesti";
				
				echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=$hakuosoite\">";
			}
			
			if (isset($_GET["tallmuok"]))
			{
				$avain = $_GET["avain"];
				$query = "UPDATE asiakas SET nimi='$nimi', osoite='$osoite', postinro='$postinro', postitmp='$postitmp', asty_avain='$asty' WHERE Avain=$avain";
				$tulos = mysqli_query($conn, $query);
				
				if (!$tulos)
				{
					$viesti = "Muokkaus epäonnistui " . mysqli_error($conn);
				}
				else
				{
					$viesti = "Muokkaus onnistui";
				}
				
				if (isset($_SESSION["nimi"])) { $nimi = $_SESSION["nimi"]; }
				if (isset($_SESSION["osoite"])) { $osoite = $_SESSION["osoite"]; }
				if (isset($_SESSION["postinro"])) { $postinro = $_SESSION["postinro"]; }
				if (isset($_SESSION["asty"])) { $asty = $_SESSION["asty"]; }
				
				$hakuosoite = "sivu.php?nimi=$nimi&osoite=$osoite&postinro=$postinro&tyyppi=$asty&hae&v=$viesti";
				
				echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=$hakuosoite\">";
			}
		?>
		
		<form action="sivu.php" method="get" <?php echo $haku ?>><br>
		
			<p>Hakuehdot</p>
			<table>
			<tr><td>Nimi</td> <td><input type="text" name="nimi" value=<?php echo $nimi; ?>></td></tr>
			<tr><td>Osoite</td> <td><input type="text" name="osoite" value=<?php echo $osoite; ?>></td></tr>
			<tr><td>Postinumero</td> <td><input type="text" name="postinro" value=<?php echo $postinro; ?>></td></tr>
			
				<?php
					$haku = "SELECT avain, selite FROM asiakastyyppi";
					$atyyppi = mysqli_query($conn, $haku);
					
					if (!$atyyppi)
					{
						echo "virhe asiakastyypissä " . mysqli_error($conn);
					}
					else
					{
						echo "<tr><td>Asiakastyyppi</td> <td><select name = 'tyyppi'><option value=0>Kaikki</option>";
						while ($rivi = mysqli_fetch_array($atyyppi, MYSQLI_ASSOC))
						{
							$x = $rivi["avain"];
							$y = $rivi["selite"];
							$z = "";
							if ($x == $asty) { $z = "selected='selected'"; }
							echo "<option $z value='$x'>$y</option>";
						}
						echo "</select><td></tr>";
					}
				?>
				
			<tr><td><input type="submit" name="hae" value="Hae tiedot"></td>
			</table>
			<br><input type="button" name="button" value="Lisää asiakas" onclick="window.location.href='sivu.php?lisaa'">
			<?php echo "<br><br>$viesti";?>
		</form>
		
		<form action="sivu.php" method="get" <?php echo $lisays ?>><br>
		
			<p>Lisää asiakas</p>
			<table>
			<tr><td>Nimi</td> <td><input type="text" name="nimi" value=""></td></tr>
			<tr><td>Osoite</td> <td><input type="text" name="osoite" value=""></td></tr>
			<tr><td>Postinumero</td> <td><input type="text" name="postinro" value=""></td></tr>
			<tr><td>Postitoimipaikka</td> <td><input type="text" name="postitmp" value=""></td></tr>
			
				<?php
					$haku = "SELECT avain, selite FROM asiakastyyppi";
					$atyyppi = mysqli_query($conn, $haku);
					
					if (!$atyyppi)
					{
						echo "virhe asiakastyypissä " . mysqli_error($conn);
					}
					else
					{
						echo "<tr><td>Asiakastyyppi</td> <td><select name = 'tyyppi'>";
						while ($rivi = mysqli_fetch_array($atyyppi, MYSQLI_ASSOC))
						{
							$x = $rivi["avain"];
							$y = $rivi["selite"];
							$z = "";
							if ($x == $asty) { $z = "selected='selected'"; }
							echo "<option $z value='$x'>$y</option>";
						}
						echo "</select><td></tr>";
					}
				?>
				
			<tr><td><input type="submit" name="lisaa" value="Ok"></td>
			</table>
			
			<input type="button" name="button" value="Peruuta" onclick="window.location.href='sivu.php'">
			
		</form>
		
		<form action="sivu.php?" method="get" <?php echo $muokkaus ?>><br>
		
			<p>Muokkaa asiakasta</p>
			<table>
			<tr><td>Nimi</td> <td><input type="text" name="nimi" value=<?php echo $nimi?>></td></tr>
			<tr><td>Osoite</td> <td><input type="text" name="osoite" value=<?php echo $osoite?>></td></tr>
			<tr><td>Postinumero</td> <td><input type="text" name="postinro" value=<?php echo $postinro?>></td></tr>
			<tr><td>Postitoimipaikka</td> <td><input type="text" name="postitmp" value=<?php echo $postitmp?>></td></tr>
			<tr><td>Avain</td> <td><input type="text" name="avain" value=<?php if (isset($_GET["muok"])) { echo $_GET["muok"]; }?>></td></tr>
			
				<?php
					$haku = "SELECT avain, selite FROM asiakastyyppi";
					$atyyppi = mysqli_query($conn, $haku);
					
					if (!$atyyppi)
					{
						echo "virhe asiakastyypissä " . mysqli_error($conn);
					}
					else
					{
						echo "<tr><td>Asiakastyyppi</td> <td><select name = 'tyyppi'>";
						while ($rivi = mysqli_fetch_array($atyyppi, MYSQLI_ASSOC))
						{
							$x = $rivi["avain"];
							$y = $rivi["selite"];
							$z = "";
							if ($x == $asty) { $z = "selected='selected'"; }
							echo "<option $z value='$x'>$y</option>";
						}
						echo "</select><td></tr>";
					}
				?>
				
			<tr><td><input type="submit" name="tallmuok" value="Ok"></td>
			</table>
			
			<input type="button" name="button" value="Peruuta" onclick="window.location.href='sivu.php'">
			
		</form>

		<?php
			if (isset($_GET["lisaa"]))
			{
				if ($nimi != "" && $osoite != "" && $postinro != "" && $postitmp != "" && $asty != "")
				{
					$pvm = date("Y") . "-" . date("m") . "-" . date("d");
					$query = "INSERT INTO Asiakas (nimi, osoite, postinro, postitmp, asty_avain, luontipvm) VALUES ('$nimi', '$osoite', '$postinro', '$postitmp', $asty,  '$pvm')";
					$tulos = mysqli_query($conn, $query);
					
					if (!$tulos)
					{
						echo "<br>Lisäys epäonnistui " . mysqli_error($conn);
					}
					else
					{
						echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=sivu.php\">";
					}
				}
				else
				{
					if ($nimi != "" || $osoite != "" || $postinro != "" || $postitmp != "" || $asty != "")
					{
						echo "<br>Kaikkia tietoja ei annettu" . mysqli_error($conn);
					}
				}
			}
		
			if(isset($_GET["hae"]))
			{
				if ($asty != 0)
				{
					// $query = "SELECT a.avain, a.nimi, a.osoite, a.postinro, a.asty_avain FROM asiakas a WHERE nimi LIKE '$nimi%' && osoite LIKE '$osoite%' && postinro LIKE '$postinro%' && asty_avain = $asty";
					$query = "SELECT a.avain, a.nimi, a.osoite, a.postinro, a.postitmp, a.asty_avain, lyhenne FROM asiakas a INNER JOIN asiakastyyppi at ON a.asty_avain = at.avain WHERE a.nimi LIKE '$nimi%' && a.osoite LIKE '$osoite%' && a.postinro LIKE '$postinro%' && a.asty_avain = $asty";
				}
				else
				{
					$query = "SELECT a.avain, a.nimi, a.osoite, a.postinro, a.postitmp, a.asty_avain, lyhenne FROM asiakas a INNER JOIN asiakastyyppi at ON a.asty_avain = at.avain WHERE a.nimi LIKE '$nimi%' && a.osoite LIKE '$osoite%' && a.postinro LIKE '$postinro%'";
				}
				
				$_SESSION["nimi"] = $nimi;
				$_SESSION["osoite"] = $osoite;
				$_SESSION["postinro"] = $postinro;
				$_SESSION["asty"] = $asty;
				
				
				
				$tulos = mysqli_query($conn, $query);
				
				if (!$tulos)
				{
					echo "kysely epäonnistui " . mysqli_error($conn);
				}
				else
				{
					echo "<br><table class = 'taul'>";
						while ($rivi = mysqli_fetch_array($tulos, MYSQLI_ASSOC))
						{
							$avain = $rivi["avain"];
							$nimi = $rivi["nimi"];
							$osoite = $rivi["osoite"];
							$postinro = $rivi["postinro"];
							$postitmp = $rivi["postitmp"];
							$asty = $rivi["asty_avain"];
							$lyh = $rivi["lyhenne"];
							echo "<tr>
								<td class = 'taul'>$nimi </td>
								<td class = 'taul'>$osoite </td> 
								<td class = 'taul'>$postinro </td>
								<td class = 'taul'>$lyh </td>
								<td class = 'taul'> <a href='sivu.php?poista=$avain'>Poista</a> </td>
								<td class = 'taul'> <a href='sivu.php?muok=$avain&nimi=$nimi&osoite=$osoite&postinro=$postinro&postitmp=$postitmp&tyyppi=$asty'>Muokkaa</a></td>
								</tr>";
						}
					echo "</table>";
				}
			}
		?>

	</body>
</html>