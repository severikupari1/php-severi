<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Haetut asiakkaat</title>
</head>

<body>

<?php
	require_once("db.inc");
	
	// tehd��n sql-lause
	$query = "Select avain, nimi, osoite, postinro, postitmp, asty_avain from asiakas";
  
  
	
	// suoritetaan kysely
	$tulos = mysqli_query($conn, $query);
	
	if ( !$tulos )
	{
		echo "Kysely ep�onnistui " . mysqli_error($conn);
	}
	else
	{
		// Ao 2 rivi� tulostetaan vain TESTI-mieless�!
		echo "<p>Haettiin seuraavat asiakkaat, yhteens� " . mysqli_num_rows($tulos) .  " kpl</p>\n";
		echo "<p>Kentti� oli " . mysqli_num_fields($tulos) . "<p>\n";
		
		//k�yd��n tavarat l�pi 
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja m��r� muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,</p>";
		} 
	}
	
	echo "No niin, sql-kyselyt on sitten tehty";
?>
</body>
</html>
