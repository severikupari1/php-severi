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

    $nimi = Tarkastus("nimi");

    echo "Kiitoksia sivun käyttämisestä {$nimi}";
?>
