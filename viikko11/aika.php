<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ajankäsittelyn funktioita</title>
</head>

<body>
<?php

	//phpinfo();

	$aika_unix = time();
	tulosta("Unix_aika", $aika_unix);
	
	$mk_time = mktime(22, 5, 00, 4, 15, 2013);
	tulosta("mk_time", $mk_time);
	
	$aika_taulukko = getdate();
	print_r($aika_taulukko);

	$aika_taulukko = getdate($aika_unix);//getdate($mk_time);
	print_r($aika_taulukko);
	
	$result = checkdate(9, 23, 2008);
	var_dump($result);
	$result = checkdate(14, 23, 2008);
	var_dump($result);
	
	$data = date("D", $mk_time);
	tulosta("D", $data);

	$data = date("d", $mk_time);
	tulosta("d", $data);
	
	$data = date("m (M),", $mk_time) . "jossa päiviä " . date("t", $mk_time);
	tulosta("m ", $data);
	
	$data = date("K\e\l\l\o \o\\n \\n\y\\t H:i:s", $mk_time);
	tulosta("kello:", $data);

	$data = date("d", $mk_time);
	tulosta("d", $data);

	$huomenna = date("l", mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
	tulosta("Huomenna on ", $huomenna);

	$edellinenkuukausi = date("M", mktime(0, 0, 0, date("m")-1, date("d"), date("Y")));
	tulosta("Viime kuukausi oli ", $edellinenkuukausi);	
	
	$loc = setlocale(LC_ALL, 'fi_FI', 'fin_FIN');
	//$loc = setlocale(LC_ALL,"");
	tulosta("lokale oli ", $loc);
	// muotoillaan päivämäärän tulostusta locale-asetuksen mukaisesti
	$data = strftime("Kello on nyt %H:%M:%S");
	tulosta("Aika on : " , $data);
	
	$data = strftime("Tänään on %A %Bn %d päivä", $mk_time);
	tulosta("Aika on : " , $data);
	
	$data = date('d.m.Y \k\l\o H:i:s', strtotime("23.9.2008"));
	tulosta("Aika on : " , $data);

	$data = date('d.m.Y \k\l\o H:i:s', strtotime("20080923102018"));
	tulosta("Aika on : " , $data);
	
?>

<?php
	function tulosta($title, $data)
	{
		echo "<p>$title:$data</p>";
	} 
?>
</body>
</html>
