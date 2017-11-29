<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarkastele</title>
</head>
<body>
    
 <?php 
    require_once("db.inc");
    $conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWD);
    
    function Tarkaste($muuttuja,$conn){
       
   if(isset($_GET[$muuttuja]))
     {
       
    $palautus= mysqli_real_escape_string($conn,$_GET[$muuttuja]);    
    }
    else
    {
           $palautus = "";
    }
    return $palautus;
}
    
    $kayttajatunnus = Tarkaste("kayttajatunnus",$conn);
    echo $kayttajatunnus
    
        
        
        
        kayttjatunnuscheck
        salasanacheck
        
        
    
    ?>
</body>
</html>