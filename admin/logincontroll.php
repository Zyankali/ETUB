<?php
session_start();
// css laden und datenbankverbindung herstellen.
include "../css/mainstyle.css";
if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte Datenbankverbindungsdatei nicht finden! Bitte &uuml;berpr&uuml;fen Sie ihre einstellungen in der config.php im Ordner admin.";
}



$sql = "SELECT id, user, password, status FROM users";
$result = mysqli_query($db_link, $sql);

// Vorbereitung der Eigentlichen Abfrage der Datenbank Daten und der eingegeben Daten.
$row = mysqli_fetch_assoc($result);

$benutzer = $_POST['user'];
$passwort = $_POST['password'];

if (preg_match("/(?:--)/", $benutzer)) {
	?>
	<!-- Sichtbarer Seitentitel... dots so many DOTS! -->
	<h1>-_-</h1>
	<br><br>
	<div style="text-align: left;">
	<?php
   die ("So so wer versucht denn da mit unlauteren Mitteln weiter zu kommen?");
}

if (preg_match("/(?:--)/", $passwort)) {
   ?>
	<!-- Sichtbarer Seitentitel... dots so many DOTS! -->
	<h1>-_-</h1>
	<br><br>
	<div style="text-align: left;">
	<?php
   die ("So so wer versucht denn da mit unlauteren Mitteln weiter zu kommen?");
}

if (!isset($benutzer) OR empty($benutzer)){
	?>
	<!-- Sichtbarer Seitentitel... dots so many DOTS! -->
	<h1>Das nichts....</h1>
	<br><br>
	<div style="text-align: left;">
	<?php
	echo "Fehlerhafte Eingabe... Wirklich kein Benutzer vorhanden?";
	?>
	<h4><a class="normallink" href="../index.php" name="mainpage" title="Zurueck">Zurück</a></h4>
	<?php
	exit;
}

	
if (!isset($passwort) OR empty($passwort)){	
	?>
	<!-- Sichtbarer Seitentitel... dots so many DOTS! -->
	<h1>Passwort?</h1>
	<br><br>
	<div style="text-align: left;">
	Fehler bei der Passworteingabe. Ein leeres Passwort sollte nie gesetzt sein!!!
	<h4><a class="normallink" href="../index.php" name="mainpage" title="Zurueck">Zurück</a></h4>
	<?php
	exit;
}	

if ($row['user'] == $benutzer)
{

	if( password_verify($passwort, $row['password']) )
	{
	// Passwort stimmt!
		if( password_needs_rehash($row['password'], PASSWORD_DEFAULT) )
		{
		// Passwort neu hashen
		$hash = password_hash($passwort, PASSWORD_DEFAULT);
		
		
		$aendern = "UPDATE users Set password = '" . $hash . "' WHERE user = '" . $benutzer . "'";
                                // den alten gespeicherten Hash durch den neuen ersetzen
                                $update = mysqli_query($db_link, $aendern);

								echo "<br> New record created successfully";
		} 
		if( !password_needs_rehash($row['password'], PASSWORD_DEFAULT) )
		{
			
								echo "";
			
		}
		else
		{
								echo "" . mysqli_error($db_link);
		}
	?>
	<!-- Sichtbarer Seitentitel... dots so many DOTS! -->
	<h1>Eingelogt</h1>
	<br><br>
	<div style="text-align: left;">
	<?php
	echo 'Klicken Sie auf den Verweis unten und Sie sind im Kern.';
	// Set die Sessions mit den notwendigen Daten zusammen.
	$_SESSION["status"] = $row['status'];
	$_SESSION["user"] = $row['user'];
	$_SESSION["clearance"] = TRUE;
	?>
	<h4><a class="normallink" href="kern.php" name="Adminarea" title="Administration">Adminbereich</a></h4>
	<?php
	}
	else
	{
	?>
	<!-- Sichtbarer Seitentitel... dots so many DOTS! -->
	<h1>Passwort...?!</h1>
	<br><br>
	<div style="text-align: left;">
	<?php
	echo 'Passwort ist falsch!';
	?>
	<h4><a class="normallink" href="../index.php" name="mainpage" title="Zurueck">Zurück</a></h4>
	<?php
	}
	
}
else
{

?>
	<!-- Sichtbarer Seitentitel... dots so many DOTS! -->
	<h1>Benutzer...!?</h1>
	<br><br>
	<div style="text-align: left;">
	<?php
	
echo "Falscher Benutzer... Vertipt?";	


// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
?>
<h4><a class="normallink" href="../index.php" name="mainpage" title="Zurueck">Zurück</a></h4>
<?php

	
}	
	

?>
</div>