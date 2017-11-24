<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tehtävä 30</title>
</head>
<!--
  Tehtävät (luento ti 3.10.2017), valmiina ti 10.10.2017
  30. Tee PHP-sivu, jolla käyttäjä voi syöttää etunimen, sukunimen, postinumeron ja iän. Kaikki arvot ovat pakollisia tietoja, ja postinumerossa saa olla vain 5 merkkiä ja ikä täytyy olla välillä 1-100 vuotta. Ko. sivu kutsuu itseään (sovelluksessa on siis vain YKSI php-sivu) ja tulostaa arvot sivun alalaitaan taulukossa, jos ne olivat oikein. Sivun ylälaidassa näkyy siis koko ajan form:n kentät. Virhetilanteessa tulostetaan sivun alalaitaan virheviesti. Käyttäjän syöttämät arvot eivät saa hävitä tehtäessä tarkistuksia. 
-->

<body>
   
    
   <form action="tehtava30.php" method="get">
     Nimi : <input type="text" name="nimi" value="<?php if(isset($nimi)){
	echo $nimi;}?>"><br>
     
     Sukunimi : <input type="text" name="snimi" value="<?php if(isset($snimi)){
	echo $snimi;}?>"><br>
     
     Postinumero : <input type="text" name="posti" value="<?php if(isset($posti)){
	echo $posti;}?>"><br>
     
     Ikäsi : <input type="text" name="ika" value="<?php if(isset($ika)){
	echo $ika; }?>"><br>
     
     <input type="submit" name="laheta">
   </form>
   <?php
function Tarkastus($parametri){
        if(isset($_GET[$parametri]) )
        {
            return $_GET[$parametri];
        }
        else {
           return "";
        }
    }
	print_r($_GET);
	$nimi = Tarkastus("nimi");
	$snimi = Tarkastus("snimi");
	$posti = Tarkastus("posti");
	$ika = Tarkastus("ika");
	
	echo "<table>";
	if ($posti != "" && strlen($posti) == 5)
	{
		echo "<tr><td>Postinumerosi on : {$posti}</td></tr>";
	}
	else{
		echo "virhe! et antanut tarpeeksi pitkää postinumeroa<br>";
	}
	if ($ika != "" && $ika > 1 && $ika < 100){
		echo "<tr><td>ikäsi on : {$ika}</td></tr>";
	}
	else{
		echo "Et antanut ikää 1-100<br>";
	}
	
	if ($nimi == "")
	{
		echo "Et antanut nimeä";
	}
	else
	{
		echo "<tr><td>Etunimesi on {$nimi}</td></tr>";
	}
	
	if ($snimi == ""){
		echo "Et antanut Sukunimeä<br>";
	}
	else{
		echo "<tr><td>Sukunimesi on {$snimi}</td></tr>";
	}
		echo "</table>";

    ?>
 
</body>

</html>