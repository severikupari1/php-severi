<!--
(linkkiä klikkaamalla mennään jollekin php-sivulle, joka tulostaa varmistustekstin ”Rekisterinumerolle XXX-YYY on varattu aika dd.mm.yyyy”.-->
<?php
function GetValue($param)
	{
		if ( isset($_GET[$param]) )
			return $_GET[$param];
		else 
			return "";
	}

    $rekkari = GetValue("rekkari");
    $aika = GetValue("aika");

    echo "Rekisteri numerolle {$rekkari} on varattu aika {$aika}";
?>
