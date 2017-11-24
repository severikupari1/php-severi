<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Haetut asiakkaat</title>
</head>

<body>

<?php
	require_once("db.inc");
	
	// tehdään sql-lause
	$query = "Select avain, nimi, osoite, postinro from asiakas";

	// suoritetaan kysely
	$tulos = mysqli_query($conn, $query);
	
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
		
		
		//käydään tavarat läpi 
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		} 
	}
	
	
?>
</body>
</html>
