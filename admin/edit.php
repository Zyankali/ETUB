<?php

session_start();

include "../css/mainstyle.css";

$status = $_SESSION["status"];
$user =	$_SESSION["user"];
$clearance = $_SESSION["clearance"];
$editid = $_SESSION["seteditid"]; 


if (!$clearance OR empty($clearance)){
	
		// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
	die("<div style=\"text-align: left\;\">ZUGRIFF VERWEIGERT!!! Keine Berechtigung! Verd&auml;chtiges Verhalten entdeckt! Laden Sie die Hauptseite neu!<br>Geben Sie die URL neu ein oder gehen Sie per Zur&uuml;ck Funktion ihres Browsers zur Startseite bzw. Hauptseite.");
	
}

// Überprüfen der zugangsberechtigung  des Nutzers.

if ($status > "1" OR !isset($status)){
	
		// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
	die("<div style=\"text-align: left\;\">ZUGRIFF VERWEIGERT!!! Keine Berechtigung! Verd&auml;chtiges Verhalten entdeckt! Laden Sie die Hauptseite neu!<br>Geben Sie die URL neu ein oder gehen Sie per Zur&uuml;ck Funktion ihres Browsers zur Startseite bzw. Hauptseite.");
	
}





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

$titel = $_POST['titel']; 
$inhalt = $_POST['inhalt'];



// entfernt HTML Tags aus dem Titel
$titel = strip_tags($titel);
// Wandelt Sonderzeichen in HTML Code um
$titel = htmlentities($titel);
// entfernt Backslashes aus dem Titel
$titel = stripslashes($titel);
// Ersetzt \n durch HTML Titel
$titel = nl2br($titel);



// entfernt HTML Tags aus Inhalt
$inhalt = strip_tags($inhalt);
// Wandelt Sonderzeichen in HTML Code um
$inhalt = htmlentities($inhalt);
// entfernt Backslashes aus dem inhalt
$inhalt = stripslashes($inhalt);
// Ersetzt \n durch HTML umbruchzeichen
$inhalt = nl2br($inhalt); 


//Zeitzone und Zeit ermitteln in UNIX formation

date_default_timezone_set("Europe/Berlin");
$timestamp = time();

// Uhrzeit in var eintragen

$zeit = date("H:i:s",$timestamp);

$datum = date("Y-m-d",$timestamp);

//Titel der Seite
?>
<h1>Eintrag Editiert!</h1>

<?php

// Editierter Eintrag in Datenbank an Spezifischen Punkt aktuallisieren und eintragen
$sql = "UPDATE kontent SET titel  = '" . $titel . "', inhalt = '" . $inhalt . "', zeit = '" . $zeit . "', datum = '" . $datum . "' WHERE id= '" . $editid ."'";

if (mysqli_query($db_link, $sql)) {
    echo "Eintrag erfolgreich editiert.";
} else {
    echo "Fehler beim Editieren des Eintrags: " . mysqli_error($db_link);
}
?>

<h4><a class="normallink" href="kern.php" name="mainpage" title="Zurueck">Zur&uuml;ck</a></h4>

</div>