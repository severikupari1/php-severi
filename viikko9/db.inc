<?php
	// tietokannan nimi
	define("DB_NAME", "ruokalista");
	define("DB_USER", "root");
	define("DB_PASSWD", "");
	define("DB_HOST", "localhost");

	// tehdään connect tietokantapalvelimelle
	$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWD); 
	
	if ( mysqli_connect_errno() )
	{
		// Lopettaa tämän skriptin suorituksen ja tulostaa parametrina tulleen tekstin
		die ("Tietokantapalvelinta ei löydy, syy: " . mysqli_connect_error());
	}

	// valitaan tietokanta -> Ei välttämätöntä, jos kanta annettu mysqli_connect:ssa
	mysqli_select_db($conn, DB_NAME) or die ("Tietokantaan " . DB_NAME . " ei saada yhteyttä");
?>