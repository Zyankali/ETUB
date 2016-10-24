<?php

session_start();

include "../css/mainstyle.css";

$status = $_SESSION["status"];
$user =	$_SESSION["user"];
$clearance = $_SESSION["clearance"];


?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php


if (!$clearance OR empty($clearance)){
	
		// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
	die("<div style=\"text-align: left\;\">ZUGRIFF VERWEIGERT!!! Keine Berechtigung! Verd&auml;chtiges Verhalten entdeckt! Laden Sie die Hauptseite neu!<br>Geben Sie die URL neu ein oder gehen Sie per Zur&uuml;ück Funktion ihres Browsers zur Startseite bzw. Hauptseite.");
	
}

// Überprüfen der zugangsberechtigung  des Nutzers.

if ($status > "1" OR !isset($status)){
	
		// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
	die("<div style=\"text-align: left\;\">ZUGRIFF VERWEIGERT!!! Keine Berechtigung! Verd&auml;chtiges Verhalten entdeckt! Laden Sie die Hauptseite neu!<br>Geben Sie die URL neu ein oder gehen Sie per Zur&uuml;ck Funktion ihres Browsers zur Startseite bzw. Hauptseite.");
	
}


$editid = $_GET["editid"];


 if (!ctype_digit($editid)) {
	
			// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
 die("<div style=\"text-align: left\;\">Unzul&auml;ssige eingabe!");
 
 }

// die zu editierenden eintrag in eine Session eintragen
$_SESSION["seteditid"] = $editid; 
 

 if (!ctype_digit($status)) {
	
			// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
 die("<div style=\"text-align: left\;\">Unzul&auml;ssige eingabe!");
 
 }

if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
} 



$sql = "SELECT titel, inhalt FROM kontent WHERE id = '" . $editid . "' ";

// Sichtbarer Seitentitel
?>

<h1>Eintrag Editieren</h1>

<?php

$ereg = mysqli_query($db_link, $sql);
$row = mysqli_fetch_assoc($ereg);
{
?>
<br>
<br>
<form action="edit.php"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" method="post">
<fieldset>
<legend>zu editierender Eintrag</legend>
Titel<br>
<textarea name="titel" rows="1" cols="60"><?php 

$row['titel'] = strip_tags($row['titel']);
$row['titel'] = stripslashes($row['titel']);



echo $row['titel'];

?>

</textarea><br><br>
Hapteintrag<br>
<textarea name="inhalt" rows="15" cols="60"><?php


$row['inhalt'] = strip_tags($row['inhalt']);
$row['inhalt'] = stripslashes($row['inhalt']);

echo $row['inhalt'];



?></textarea><br><br>
<input type = "submit" value="Eintragen"><h4><a class="normallink" href="kern.php" name="kern" title="Abrechen">Abrechen</a></h4>
</fieldset>
</form>	
<?php	
} 
?>

</div>