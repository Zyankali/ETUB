<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
<title>etub_install</title>
<meta name="description" content="Installation des ETUBs">
<meta name="keywords" content="install_etub">
<meta name="author" content="silentsands">
</head>
<body text="#000000" bgcolor="#F4F8F4" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<font size="+4" face="VERDANA,ARIAL,HELVETICA"><p align="center">Installer</p></font>
<fieldset>
<legend>ETUB Installationsprotokoll</legend>

<p align="left">Es wird nun versucht eine Verbindung zur Datenbankverwaltung her zu stellen!</p>

<?php

$servername = "localhost";
$datenbankbenutzer = $_SESSION["datenbankbenutzer"];
$datenbankpasswort = $_SESSION["datenbankpasswort"];

// Create connection
$conn = mysqli_connect($servername, $datenbankbenutzer, $datenbankpasswort);

// Check connection
if (!$conn) {
    die("Konnte keine Verbindung zur Datenbankverwaltung herstellen: " . mysqli_connect_error());
    ?>
     <br> <h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>
    <?php

}
echo "Erfolgreich verbunden";

?>
<p align="left">Es wird nun versucht die Datenbank <?php echo $_SESSION['datenbankname']; ?> zu erstellen:</p>

<?php


//Datenbankname in variable einladen
$datenbankname = $_SESSION['datenbankname'];

// Datenbank erstellen
$sql = "CREATE DATABASE IF NOT EXISTS $datenbankname ";
if (mysqli_query($conn, $sql)) {
    echo "Datenbank erfolgreich erstellt!";
	echo "<br>";
} else {
    echo "Fehler, beim erstellen der Datenbank: " . $datenbankname . ". " . mysqli_error($conn);
	die("Bitte &Uuml;berpr&uuml;fen Sie ihre eingaben. Wiederholen Sie die Installationsroutine!");
}

?>

<p align="left">Es wird nun versucht die users Tabelle zu erstellen:</p>

<?php

// sql zur Tabellengenerierung
$sql = "CREATE TABLE IF NOT EXISTS $datenbankname . users (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user VARCHAR(150) NOT NULL,
password VARCHAR(150) NOT NULL,
status INT(1) NOT NULL
)
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin";

if (mysqli_query($conn, $sql)) {
    echo "Tabelle users erfolgreich erstellt.";
	echo "<br>";
} else {
    echo "Fehler bei der Tabellenerstellung: " . mysqli_error($conn);
}

?>

<p align="left">Es wird nun versucht die kontent Tabelle zu erstellen:</p>

<?php

// sql zur Tabellengenerierung
$sql = "CREATE TABLE IF NOT EXISTS $datenbankname . kontent (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
titel TEXT NOT NULL,
inhalt LONGTEXT NOT NULL,
authoren TEXT NOT NULL,
zeit VARCHAR(10) NOT NULL,
datum VARCHAR(10) NOT NULL
)
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_bin";

if (mysqli_query($conn, $sql)) {
    echo "Tabelle kontent konnte erfolgreich erstellt werden.";
	echo "<br>";
} else {
    echo "Fehler bei der Tabellenerstellung: " . mysqli_error($conn);
}

?>

<p align="left">Es wird nun versucht die Benutzer und Passworteingaben in die users Tabelle einzutragen:</p>


<?php

$benutzer = $_SESSION['benutzer'];
$passwort = $_SESSION['passwort'];


// das passwort des Benutzers hashen und in einer Variable einspeichern
$passwortsecure = $passwort;
$hash = password_hash($passwortsecure, PASSWORD_DEFAULT);

// Nun die Nutzerdaten Benutzer und Passwort eintragen
$sql = "INSERT INTO $datenbankname . users (user, password, status)
VALUES ('$benutzer', '$hash', '1')";

if (mysqli_query($conn, $sql)) {
    echo "Benutzer und Passwort erfolgreich eingetragen.";
	echo "<br>";
} else {
    echo "Fehler: " . $sql . "<br>" . mysqli_error($conn);
	die();
}


?>

<p align="left">Es wird nun versucht die Konfigurationsdatei zu erstellen und zu schreiben:</p>

<?php

//datensatz zuzsammensammeln

$datei = fopen("../admin/konfiguration.php", "w") or die("Konfigurationsdatei konnte nicht erstellt werden!");

fwrite($datei, "<?php");
fwrite($datei, "\n// die Konstanten auslagern in eigene Datei");
fwrite($datei, "\n// die dann per require_once ('konfiguration.php');"); 
fwrite($datei, "\n// geladen wird.");
fwrite($datei, "\n"); 
fwrite($datei, "\n// Damit alle Fehler angezeigt werden");
fwrite($datei, "\nerror_reporting(E_ALL);");
fwrite($datei, "\n"); 
fwrite($datei, "\n// Zum Aufbau der Verbindung zur Datenbank");
fwrite($datei, "\n// die Daten erhalten Sie von Ihrem Provider/Anbieter");
fwrite($datei, "\ndefine ( 'MYSQL_HOST',      'localhost' );");
fwrite($datei, "\n"); 
fwrite($datei, "\n// bei XAMPP ist der MYSQL_Benutzer: root");
fwrite($datei, "\ndefine ( 'MYSQL_BENUTZER',  '".$datenbankbenutzer."' );");
fwrite($datei, "\ndefine ( 'MYSQL_KENNWORT',  '".$datenbankpasswort."' );");
fwrite($datei, "\n// Ihre Datenbank");
fwrite($datei, "\ndefine ( 'MYSQL_DATENBANK', '".$datenbankname."' );");
fwrite($datei, "\n?>");
fclose($datei);

echo "<br>";

?>

<p align="left">Es wird nun versucht einen ersten informellen Eintrag in die kontent Tabelle ein zu tragen.</p>



<?php

//Einen ersten Eintrag in die kontent Tabelle mit ein par Infos erstellen

$titelk = "Willkommen zu ihrem EasyToUseBlog";

$inhaltk = "Herzlich willkommen zu ihrem neuen Blog.<br> 
<br>
Dieser Eintrag hier gibt ihnen noch letzte Informationen im Umgang mit ihrem Blog.
Es ist nicht m&ouml;glich Bilder ein zu f&uuml;gen, diese M&ouml;glichkeit nebst weiteren wird aber sp&auml;ter noch implementiert werden.<br>
Aktuell k&ouml;nnen Sie lediglich Texte schreiben. Allerdings k&ouml;nnen Sie dennoch die komplette URL einer Seite oder Datei schreiben. Diese m&uuml;ssen dann Sie und ihre Besucher leider erstmals selber kopieren und in die Adressleiste des Browsers einf&uuml;gen um zur URL zu gelangen. Ob dies eine Seite, Datei oder Bild ist, ist egal.<br>
<br>
Des weiteren sollten Sie den Ordner &quot;installer&quot;  aus ihrem Hauptverzeichnis l&ouml;schen.<br>
Sollten Sie dabei Probleme haben, k&ouml;nnen Sie sich dabei von einer weiteren Person Assistieren lassen.<br>
<br>
Des weiteren k&ouml;nnen Sie H&auml;ndisch die &quot;konfiguration.php&quot; Datei editieren und anpassen falls n&ouml;tig, welches sich im Ordner &quot;admin&quot; befindet. Auch hierbei k&ouml;nnen Sie sich von einer weiteren Person Assistieren lassen.<br>
<br>
Sollten Sie Fragen oder Anregungen haben so k&ouml;nnen Sie dies auf der ETUB Projektseite auf GitHub eintragen oder schicken Sie mir eine E-Mail an sonictechnologic@gmail.com.<br>
<br>
Viel Spa&szlig; w&uuml;nscht ihnen,<br>
<br>
Florin B.<br>
alias<br> 
Silentsands";

$authorenk = "Silentsands";

$zeitk = "13:30:00";

$datumk = "2016-09-22";

$sql = "INSERT INTO $datenbankname . kontent (titel, inhalt, authoren, zeit, datum)
VALUES ('$titelk', '$inhaltk', '$authorenk', '$zeitk', '$datumk')";

if (mysqli_query($conn, $sql)) {
    echo "Ersteintrag erfolgreich eingetragen";
	echo "<br>";
} else {
    echo "Fehler: " . $sql . "<br>" . mysqli_error($conn);
	die();
}

echo "Ende der Protokolldatei <br>";

?>

<p align="left">Sollten keine Fehler auf zu finden sein. So klicken Sie bitte auf den Verweis/Link &quot;Abschluss&quot;.<br>
Ansonsten wiederholen Sie die Installationsroutine und beachten Sie ihre eintr&auml;ge und die hinweise. <br>
Dazu rufen sie einfach den Link &quot;Wiederholen&quot; auf.</p>

<br>
<h4><a class="normallink" href="installer_ende.php" name="installer" title="Abschluss">Abschluss</a></h4>
<h4><a class="normallink" href="index.php" name="installer" title="Wiederholen">Wiederholen</a></h4>

</fieldset>


</body>
</html>