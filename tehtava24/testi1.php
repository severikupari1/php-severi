<!--24. Tee sivu (HMTL), jolla käyttäjä syöttää yhteystiedot (nimi, osoite, puhnro) ja kolmen omistamansa kirjan nimen. Tiedot lähetetään PHP-sivulle, joka kokoaa tiedot ”nätisti” taulukkoon. Jos kirjoja annettiinkin vähemmän kuin 3, tulostetaan lisäksi linkki, josta käyttäjä pääsee jonkun kirjaston sivulle …
-->
<html> 
<head><title>tehtava 24</title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body class="body1">
    
    
    <?php

   print_r($_GET);
    
    
    if(!empty($_GET["nimi"]) != null)
    {
        $taulukko[] = $_GET["nimi"];
    }
    if(!empty($_GET["osoite"]) != null)
    {
        $taulukko[] = $_GET["osoite"];
    }
    if(!empty($_GET["puhelinnumero"]) != null)
    {
        $taulukko[] = $_GET["puhelinnumero"];
    }
   
    
    if (count($taulukko) == 3){
        echo "<table><tr><th>Nimesi = </th><td>" . $taulukko[0] . "</td></tr>" . 
            "<tr><th>Osoitteesi = </th><td>" . $taulukko[1] . "</td></tr>" .  
            "<tr><th>Puhelinnumerosi = </th><td>" . $taulukko[2] . "</td></tr></table>"  ;
        }
    else{
        echo "Et antanut kaikkia yhteystietojasi!!!!";
    }
    
    if(!empty($_GET["kirja1"]) != 0){
        
        $kirja[0] = $_GET["kirja1"];
    }
    if(!empty($_GET["kirja2"]) != 0){
        
        $kirja[1] = $_GET["kirja2"];
    }
    if(!empty($_GET["kirja3"]) != 0){
        
        $kirja[2] = $_GET["kirja3"];
    }
    
    if (count($kirja) < 3){
        $linkki = "https://savonia.finna.fi/";
        echo "annoit alle 3 kirjaa tässä olisi linkki <a href=" . $linkki . ">kirjastoon</a>";
    }    
    
    
    
    
    ?>
    
    
    </body>
    
</html>
