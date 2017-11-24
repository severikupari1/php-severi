<!--31. Tee php-sivu, jolla käyttäjä syöttää sukupuolen (mies/nainen, radiobutton), koulutus (peruskoulu, lukio, ammattikoulu, ammattikorkeakoulu; checkbox) ja nimen. Kun käyttäjä painaa ”Talleta”-nappia, tarkistetaan ensin tiedot: Jos nimi on tyhjä tai koulutusta ei ole valittu, tulostetaan sivulle tieto puutteista. Jos tiedot ovat oikein, tulostetaan ne sivulle <table>-elementtiin. Tässä sovelluksessa saa olla VAIN YKSI php-sivu. Käyttäjän syöttämät arvot eivät saa hävitä tehtäessä tarkistuksia. -->
<?php $sukupuoli = Tarkastus("sukupuoli");
$koulutus      = Tarkastus("koulutus");
$nimi      = Tarkastus("nimi");
$talleta = Tarkastus("talleta"); 

?>

<form action="tehtava31.php">
    Mies :<input type="radio" name="sukupuoli" value="mies" checked="<?php
if($talleta != "" && $sukupuoli == "mies")
{
    echo "checked";
}
?>"> 
 
    
    Nainen : <input type="radio" name="sukupuoli" value="nainen" <?php
if($talleta != "" && $sukupuoli == "nainen")
{
    echo "checked";
}
?>><br>
    
    
    
    Peruskoulu :<input type="checkbox" name="koulutus[]" value="peruskoulu" >                <br> 
    lukio :<input type="checkbox" name="koulutus[]" value="lukio" <?php   if($koulutus  && $talleta != ""){
    if(in_array("lukio",$koulutus)){
        echo "checked";
    }
}   
                       ?>>                  <br> 
    ammattikoulu :<input type="checkbox" name="koulutus[]" value="ammattikoulu" <?php   if($koulutus  && $talleta != ""){
    if(in_array("ammattikoulu",$koulutus)){
        echo "checked";
    }
}   
                       ?>>            <br> 
    ammattikorkeakoulu :<input type="checkbox" name="koulutus[]" value="ammattikorkeakoulu" <?php   if($koulutus  && $talleta != ""){
    if(in_array("ammattikorkeakoulu",$koulutus)){
        echo "checked";
    }
}   
                       ?>>                  <br> 
    Nimesi : <input type="text" name="nimi" value="<?php
    if($talleta != "" && $nimi != ""){
        echo $nimi;
    }
    ?>"><br>

    <input type="submit" name="talleta" value="talleta">
</form>
<?php
//
  function Tarkastus($parametri){
        if(isset($_GET[$parametri]) )
        {
            return $_GET[$parametri];
        }
        else {
           return "";
        }
    }
      

if ($talleta != "")
{
    if($nimi == "")
    {
        echo "et antanut nimeä<br>";
    }
    else
    {
        echo "<table><tr><td>Nimesi on {$nimi}<td></tr></table>";
    }
    if($koulutus == "")
    {
        echo "et antanut koulutusta<br>";
    }
    else
    {
        foreach($koulutus as $x)
        {
            echo "<table><tr><td>Koulutus {$x}</td></tr></table>";
        }
    }
}

?>