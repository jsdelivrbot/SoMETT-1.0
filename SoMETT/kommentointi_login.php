<?php
session_start();
//$kuvaid = 0;
$kuvaid = $_GET['KID'];
$ohjaus = $_GET['ohjaus'];
$my = mysqli_connect("localhost", "data15", "aJrHfybLxsLU76rV", "data15");
if ($my->mysqli_errno) {
  die("MySQL, virhe yhteyden luonnissa:" . $my->connect_error);
}
$my->set_charset("utf8");
?>
<!DOCTYPE HTML>
<html lang="fi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kirjaudu</title>
    <?php include('styles.php');?>
  </head>
        <body>
            <?php include('nav.php');?>
            <section class="secondary">
                <div class="wrap">
  <script>
  function openWin() {
    window.location.href = "kommentointi_login.php?KID =' . $kuvaid . '";
  }
  </script>

            <form id="login" method="POST">
                <h1>Kirjaudu sisään</h1>
                    <fieldset id="inputs">
                        <input name="KEmail" type="text" placeholder="Email" autofocus required>
                        <input name="KSSana" type="password" placeholder="Salasana" required>
                    </fieldset>

                    <fieldset id="actions">
                        <input type="submit" name="submit" value="Kirjaudu">
                        <a href="<?php
						    if (isset($_GET['KID'])) {
        echo 'fblogin/fbconfig.php?KID='.$kuvaid.'';
    } elseif (isset($_GET['ohjaus'])) {
        echo 'fblogin/fbconfig.php?ohjaus='.$ohjaus.'';
		} else {
        echo 'fblogin/fbconfig.php';
    }
						?>">Login with Facebook</a></div>
                    </fieldset>
            </form>
            <?
            if (isset ($_POST['submit']))
{
            $login = "1";

            $KEmail = $_POST['KEmail'];
            $KSSana = $_POST['KSSana'];

            $sql ="SELECT * FROM 581D_Kayttaja WHERE Sposti='$KEmail' AND SSana='$KSSana'";

            $query = mysqli_query($my,$sql);
            $test = mysqli_num_rows($query);
            if($test == 1){
            echo "Kirjaudu";
            $_SESSION['login_user']=$KEmail;
            $login = $_GET['login'];
          
	if (isset($_GET['KID'])) {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=kommentointi.php?KID=' . $kuvaid . '">'; 
} elseif (isset($_GET['ohjaus'])) {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=lahetyspalvelu.php">'; 
} else {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
}
		  
             //header("Location:kommentointi.php?KID=".$kuvaid);
            }
            }
            $my->close();
            ?>
            </div>
            </section>
            </div>
            </div>
            <?php include('footer.php')?>
        </body>
</html>
