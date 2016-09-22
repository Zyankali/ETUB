<?php
session_start();

include "../css/mainstyle.css";

$status = $_SESSION["status"];

$clearance = $_SESSION["clearance"];


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





?>

<h1>Neuer Eintrag</h1>

<br>
<br>
<form action="eintragen.php"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" method="post">
<fieldset>
<legend>Ihr Eintrag</legend>
Titel<br>
<textarea name="titel" rows="1" cols="60" placeholder="Titel"></textarea><br><br>
Hapteintrag<br>
<textarea name="inhalt" rows="15" cols="60" placeholder="Inhalt"></textarea><br><br>
<input type = "submit" value="Eintragen"><h4><a class="normallink" href="kern.php" name="kern" title="Abrechen">Abrechen</a></h4>
</fieldset>
</form>

</div>