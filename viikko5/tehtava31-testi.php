<!--31. Tee php-sivu, jolla käyttäjä syöttää sukupuolen (mies/nainen, radiobutton), koulutus (peruskoulu, lukio, ammattikoulu, ammattikorkeakoulu; checkbox) ja nimen. Kun käyttäjä painaa ”Talleta”-nappia, tarkistetaan ensin tiedot: Jos nimi on tyhjä tai koulutusta ei ole valittu, tulostetaan sivulle tieto puutteista. Jos tiedot ovat oikein, tulostetaan ne sivulle <table>-elementtiin. Tässä sovelluksessa saa olla VAIN YKSI php-sivu. Käyttäjän syöttämät arvot eivät saa hävitä tehtäessä tarkistuksia. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
  
<?php
   print_r($_GET);
  function Tarkastus($parametri){
        if(isset($_GET[$parametri]) )
        {
            return $_GET[$parametri];
        }
        else {
           return "";
        }
    }
    $sukupuoli = Tarkastus("sukupuoli");
    $peruskoulu = Tarkastus("peruskoulu");
    $lukio = Tarkastus("lukio");
    $ammattikoulu = Tarkastus("ammattikoulu");
    $ammattikorkeakoulu = Tarkastus("ammattikorkeakoulu");
    $talleta = Tarkastus("talleta");
    $nimi = Tarkastus("nimi")
    
    
  ?> 
   
   
   
    <form action="tehtava31-testi.php" method="get">
    Sukupuoli : <br>
             Nainen :<input type="radio" name="sukupuoli" value="nainen"><br>
             Mies   :<input type="radio" name="sukupuoli" value="mies"><br>   
    Koulutus : <br>
    
    
    Peruskoulu         <input type="checkbox" name="peruskoulu"<?php 
                              if($peruskoulu == "peruskoulu")
            {
                    echo "checked";
            }
        ?> 
                               value="peruskoulu"><br>
    
    Lukio              <input type="checkbox" name="lukio"<?php 
                              if($lukio == "lukio")
            {
                    echo "checked";
            }
        ?> value="lukio"> <br>
    
    Ammattikoulu       <input type="checkbox" name="ammattikoulu"<?php 
                              if($ammattikoulu == "ammattikoulu")
            {
                    echo "checked";
            }
        ?> value="ammattikoulu"><br> 
    
    Ammattikorkeakoulu <input type="checkbox" name="ammattikorkeakoulu"
    <?php 
                              if($ammattikorkeakoulu == "ammattikorkeakoulu")
            {
                    echo "checked";
            }
        ?> value="ammattikorkeakoulu"><br>
    
    Nimesi  <input type="text" name="nimi"><br>
       <input type="submit" value="talleta" name="talleta">

                
</form>    
    <?php if($talleta == "talleta")
    {
        if($nimi != ""){
             echo "<table><tr><td>Nimesi on {$nimi}</td></tr></table>";
        }
        else
        {
            echo "Et antanut nimeä";
        }
    }
    
    $taulukko = array($peruskoulu, $lukio,$ammattikoulu,$ammattikorkeakoulu);
    
        if($talleta == "talleta")
        {
            if(array_key_exists('peruskoulu',$taulukko)){
                echo "testi";
            }
        }
        
    
        ?>

</body>
</html>
