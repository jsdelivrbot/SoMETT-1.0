<?php
/*$my=mysqli_connect("localhost","data15","aJrHfybLxsLU76rV","data15");
if($my->mysql_error){
  die("MySQL, virhe yhteyden luonnissa:" . $my->connect_error);
}
$my->set_charset('utf8');*/
include("config.php");
$sql="SELECT * FROM 581D_Kuva;";
$sql2="UPDATE";
  if($result=$my->query($sql)){
    while($d = $result->fetch_object()){
      if($d->Suosituin > 0){
        $i = $d->Suosituin;
        $f = $d->KuvaID;
        $i = $i - 1;
        //echo "<p>$i</p>";
        $sql2='UPDATE 581D_Kuva SET Suosituin = "'.$i.'" WHERE KuvaID= "'.$f.'";';
        if($result2 = $my->query($sql2)){
        }
      }//else{echo "<p>pienempi kuin nolla</p>";}
    }
  }/*
echo "<p>$sql</p>";
echo "<p>$sql2</p>";*/
$my->close();
?>