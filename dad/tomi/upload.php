<?php

/*
$my=mysqli_connect("localhost","data15","aJrHfybLxsLU76rV","data15");
if($my->mysql_errno){
	die("MySQL, virhe (#".$my->mysql_errno.") yhteyden luonnissa:".$my->connect_error);
}
$my->set_charset("utf8");
$sql = 'SELECT MAX(KID) FROM 581D_Kuva'; 
if($KID=$my->query($sql)){
	echo '<p>Nimi tallennettu!</p>'.$KID;
}
else {
	echo "Virhe SQL-kyselyssä!";
}
$my->close();
 
*/

/*
Server-side PHP file upload code for HTML5 File Drag & Drop demonstration
Featured on SitePoint.com
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/

$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
$title = $_POST["title"];
$description = $_POST["description"];
if ($fn) {

	// AJAX call
	file_put_contents(
		'uploads/' . $fn,
		file_get_contents('php://input')
	);
	echo "$fn uploaded";
	exit();

}
else {

	// form submit
	$files = $_FILES['fileselect'];

	foreach ($files['error'] as $id => $err) {
		if ($err == UPLOAD_ERR_OK) {
			$fn = $files['name'][$id];
			move_uploaded_file(
				$files['tmp_name'][$id],
				'uploads/' . $fn
			);
			echo "<p>File $fn uploaded.</p>";
			
			
			$directory = "http://cosmo.kpedu.fi/~tomijylha/SoMETT-1.0/dad/tomi/uploads/";
			$my=mysqli_connect("localhost","data15","aJrHfybLxsLU76rV","data15");
			if($my->mysql_errno){
				die("MySQL, virhe (#".$my->mysql_errno.") yhteyden luonnissa:".$my->connect_error);
			}
			$my->set_charset("utf8");
			
			$filu = $directory.$fn;
			$sql = 'INSERT INTO 581D_Kuva(KuvaID,URL,UID,Title,Description,PublishDate)VALUES(" ","'.$filu.'","1204","'.$title.'","'.$description.'"," ")';
			
			if($tulos=$my->query($sql)){
				echo '<p>Nimi tallennettu!</p>';
			}
			else {
				echo "Virhe SQL-kyselyssä!";
			}
			$my->close();



			header("Location:index.php?upl=1");
		}

	}

}