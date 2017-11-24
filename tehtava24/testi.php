<!--24. Tee sivu (HMTL), jolla käyttäjä syöttää yhteystiedot (nimi, osoite, puhnro) ja kolmen omistamansa kirjan nimen. Tiedot lähetetään PHP-sivulle, joka kokoaa tiedot ”nätisti” taulukkoon. Jos kirjoja annettiinkin vähemmän kuin 3, tulostetaan lisäksi linkki, josta käyttäjä pääsee jonkun kirjaston sivulle …
-->
<html> 
<head><title>tehtava 24</title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body class="body1">
    
    
    <?php

   print_r($_GET);
    
    function Tulostaja(){
    
     if(isset($_GET["nimi"]) != null){
            echo  $_GET["nimi"];
        } 
        if(isset($_GET["osoite"]) != null)
       {
        echo $_GET["osoite"];
       }
    
       if(isset($_GET["puhelinnumero"]) != null)
      {
       echo $_GET["puhelinnumero"];
      }
    }
    function laskuri(){
        echo "<table>";
        if (!empty($_GET["kirja1"]))
        {
            $kirjat[] = $_GET["kirja1"];
            echo "<tr><th>Kirja1</th> <td>" . $kirjat[0] . "</td> </tr>";
        }
        if (!empty($_GET["kirja2"]))
        {
            $kirjat[] = $_GET["kirja2"];
            
        }
        if (!empty($_GET["kirja3"]))
        {
            $kirjat[] = $_GET["kirja3"];
            
        }
        
        
   
        if  (count($kirjat)< 3){
            echo "<p>Annoit kirjoja vahemman kuin 3</p>";
            $linkki = "https://savonia.finna.fi/";
            echo "<a href=$linkki>Linkki kirjastoon!</a>";
        }
        else {
            echo "<tr><th>Kirja1</th><td>" . $kirjat[0] . "</td></tr>" . 
                "<tr><th>Kirja2</th><td>" . $kirjat[1] . "</td></tr>" . 
                "<tr><th>Kirja3</th><td>" . $kirjat[2] . "</td></tr></table>";
        }
    }
    
    
    Tulostaja();
    
    laskuri();
    
    
    
    ?>
    
    
    </body>
    
</html>
