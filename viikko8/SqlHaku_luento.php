<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Haetut asiakkaat</title>
</head>

<body>

<?php
	require_once("db.inc");
	
	// tehdään sql-lause
	$query = "Select avain, nimi, osoite, postinro, postitmp, asty_avain from asiakas";
  
  
	
	// suoritetaan kysely
	$tulos = mysqli_query($conn, $query);
	
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
		// Ao 2 riviä tulostetaan vain TESTI-mielessä!
		echo "<p>Haettiin seuraavat asiakkaat, yhteensä " . mysqli_num_rows($tulos) .  " kpl</p>\n";
		echo "<p>Kenttiä oli " . mysqli_num_fields($tulos) . "<p>\n";
		
		//käydään tavarat läpi 
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
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
