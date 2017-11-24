<?php
    function GetValue($param)
	{
		if ( isset($_GET[$param]) )
			return $_GET[$param];
		else 
			return "";
	}

    
    
    $rekkari = GetValue("rekkari");
    $haltija = GetValue("haltija");
    $varaa = GetValue("varaa");
    $ehdota = GetValue("ehdota");
    
    

    if(strlen($rekkari))
    {
        $muuttuja = $rekkari[4];
        $muuttuja1 = $rekkari[0];
    }
    else{
        echo "Rekkarisi oli liian lyhyt tai pitkä <a href=\"tehtava29html.html\">Takaisin aloitus sivulle</a>";
    }
    
    if(isset($muuttuja)){
        if($muuttuja <= 5 && $varaa != "" && $rekkari != ""){
        echo  "Rekisteri numerolle {$rekkari} on varattu aika 1.5.2018";
    }
    else if($muuttuja >= 5 && $varaa != "" && $rekkari != ""){
        echo  "Rekisteri numerolle {$rekkari} on varattu aika 1.9.2018";
    }
    }
    
    if(isset($muuttuja1) && $ehdota != "")
    {
        // 65 < muuttuja1 < 75
        if('A' <= $muuttuja1 && $muuttuja1 <= 'H'){
            echo "<a href=\"tehtava29ehdotus.php?rekkari={$rekkari}&aika=1.2.2018\">Varaa aika 1.2.2018</a><br>";
            
            echo "<a href=\"tehtava29ehdotus.php?rekkari={$rekkari}&aika=2.2.2018\">Varaa aika 2.2.2018</a><br>";
            
            echo "<a href=\"tehtava29ehdotus.php?rekkari={$rekkari}&aika=3.2.2018\">Varaa aika 3.2.2018</a><br>";
        }
        else
        {
        echo "<a href=\"tehtava29ehdotus.php?rekkari={$rekkari}&aika=1.9.2018\">Varaa aika 1.9.2018</a><br>";
            
            echo "<a href=\"tehtava29ehdotus.php?rekkari={$rekkari}&aika=2.9.2018\">Varaa aika 2.9.2018</a><br>";
            
        echo "<a href=\"tehtava29ehdotus.php?rekkari={$rekkari}&aika=3.9.2018\">Varaa aika 3.9.2018</a><br>";    
        }
    }
    
?>