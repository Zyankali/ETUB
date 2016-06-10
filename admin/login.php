<?php
session_start();


include "../css/mainstyle.css";


/*
Login und Logout berreich
*/



// Login Variable einen wert zuweisen GET wird ausen vor gelassen und ergibt einen INDEX hinweis. So OK!
if (!isset($logout) OR empty($logout)) {
	
	$logout = "login";
	
}


$logout = $_GET["logout"];



// Bei aktivem versuch sich einzuloggen per ?logout=login URL zusatz wird das Anmeldeformular angezeigt.
if ($logout == "login") {
	
?>

	<h1>Login</h1>
<br>
<br>
<form action="logincontroll.php" method="post">
<fieldset>
<legend>Logindaten:</legend>
Benutzer:<br>
<input type = "text" name="user"><br><br>
Passwort:<br>
<input type = "password" name="password"><br><br>
<input type = "submit" value="Login">
</fieldset>
</form>

<?php
	
}



if ($logout == "1") {
	
	
	// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
?>

<!-- Sichtbarer Seitentitel... dots so many DOTS! -->
	<h1>Ausgelogt</h1>
	<br><br>
	<div style="text-align: left;">
	
	<?php
    die ("Logout war erfolgreich!
		<br>
		<a class=\"normallink\" href=\"login.php?logout=login\">Neu einloggen?</a>
		<br>
		<a class=\"normallink\" href=\"../index.php\">Zur Hauptseite?</a>");

	
}
?>
