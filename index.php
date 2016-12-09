<?php

include "css/mainstyle.css";

?>

<!DOCTYPE html>
<head>
<html lang="de">
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php

if (file_exists("admin/connect.php")) {
require_once ('admin/connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

//Blogeinstellungen einladen
$blogeinstellungen = mysqli_query($db_link, "SELECT blogtitel, eintragszahl FROM settings");
while($row = mysqli_fetch_object($blogeinstellungen))
{
$blogtitel = $row->blogtitel;
$eintragszahl = $row->eintragszahl;
}

echo "<title>".$blogtitel."</title>";
?>
</head>

<body>



<?php
// Der Haupttitel
echo "<h1>".$blogtitel."</h1>";

?>

<br><br>
<ul>
  <li><a  id="linker"  href="index.php" >Start</a></li>
  <li><a id="linker" href="admin/login.php?logout=login" name="Login" title="Login">Login</a></li>
</ul>

<div>
<?php



/* Seitenermittelung der anzuzeigenden Einträge. Hierbei sind es Pro Seite 20 einträge.*/

if (!isset($_GET['seite']) or empty ($_GET['seite']))

        {

                $_GET['seite'] = 1;

        }

if (!isset($seite))

        {

                $seite = 1;

        }


if ($resultat = mysqli_query($db_link, "SELECT inhalt FROM kontent ORDER BY id")) {

    // Bestimme wie viele eintraege in der Datenbank "kontent" vorhanden ist
    $row_cnt = mysqli_num_rows($resultat);

        $a = $row_cnt;
    // Schließe und gebe Variable $resultat frei
    mysqli_free_result($resultat);
}

$seite = $_GET['seite'];

if (!is_numeric ($seite))

{

        die ("Fehler! Bitte Laden Sie die Seite neu.");

}

// Bestimmen wie viele Einträge auf einmal angezeigt werden sollen.
// Sollte später noch einstellbar sein.
$seitenanzahl = $a / $eintragszahl;


// Wenn mehr übermittelt wurde als errechnet oder möglich ist oder keine Zahl ermittelt wurde, die "seite" Variable resetten auf eins! Sollte vor den meisten beabischtigten und unbeabsichtigten crashes in dem Fall schützen
        if (is_int($seite))
                {

                        $seite = 1;

                }

if ($seite >= $seitenanzahl + 1)
        {

                $seite = 1;


        }


// Wenn nur eine Seite ermittelt wurde dann zeige auch nur eine Seite an
if ($seitenanzahl == "1")
{

        echo '<a href="index.php">1</a>';

}

// Wenn mehere Seiten ermittelt wurden dann Zeige Links zu den anderen Seiten an und ermittle den eigenen Seitenzählstand.
if ($seitenanzahl > "1")

        {

        $seitenunten = $seite;

        $counta = 1;
        while($counta < $seite)
                {
                echo '<a href="index.php?seite=';
                echo $counta;
                echo '"> ';
                echo $counta;
                echo ' |</a>';
                $counta++;
                }

        echo " ";
        echo $seite;
        echo " ";

        $seitenoben = $seite + 1;

        while ($seitenoben < $seitenanzahl + 1)

                {
                echo '<a href="index.php?seite=';
                echo $seitenoben;
                echo '">| ';
                echo $seitenoben;
                echo ' </a>';
                $seitenoben++;
                }

}



if ($seite != "1")
{
$eintragsoffset = $seite * $eintragszahl - $eintragszahl;
}
else
{

        $eintragsoffset = 0;

}

/* Ende der Seiten und Eintragsermittelung*/
$sql = "SELECT id, titel, inhalt, authoren, zeit, datum FROM kontent ORDER BY id DESC LIMIT 20 OFFSET $eintragsoffset";

// den query an mysql übertragen und anschließend abfragen.

$ereg = mysqli_query($db_link, $sql);
while($row = mysqli_fetch_object($ereg))
{
$inhalt = $row->inhalt;

// URLs aus BBCode [url][/url] erstellen
$suchmustera = '/(?!\[img\])\[url\]+\b((http|https|ftp|ftps):\/\/[\w]+.*)\b\[\/url\](?!\[\/img\])/';
$ersetzunga = '<a href="$1" target="_blank">$1</a>';
$inhalt = preg_replace($suchmustera, $ersetzunga, $inhalt);

// Bilder anzeigen lassen mit der Hilfe von URLs aus BBCode [img][/img] erstellen. !! Es werden nur JPG, PNG und GIF Bilder unterstuetzt.
$suchmusterb = '/(?!\[url\])\[img\]+\b((http|https|ftp|ftps):\/\/[\w]+.*(png|jpg|gif))\b\[\/img\](?!\[\/url\])/';
$ersetzungb = '<img src="$1" alt="Bild" border="0">';
$inhalt = preg_replace($suchmusterb, $ersetzungb, $inhalt);

// Bilder anzeigen lassen und als Link einfuegen mit der Hilfe von URLs aus BBCode [uri][/uri] erstellen. !! Es werden nur JPG, PNG und GIF Bilder unterstuetzt.
$suchmusterc = '/[\[uri\]]+\b((http|https|ftp|ftps):\/\/[\w]+.*(png|jpg|gif))\b\[\/uri\]/i';
$ersetzungc = '<a href="$1" target="_blank"><img src="$1" alt="Bild" border="1"></a>';
$inhalt = preg_replace($suchmusterc, $ersetzungc, $inhalt);

// Bilder als !unechten! Thumbnail anzeigen lassen und anklickbar machen.  !! Es werden nur JPG, PNG und GIF Bilder unterstuetzt.
$suchmusterd = '/[\[thumb\]]+\b((http|https|ftp|ftps):\/\/[\w]+.*(png|jpg|gif))\b\[\/thumb\]/i';
$ersetzungd = '<a href="$1" target="_blank"><img src="$1" alt="Bild" border="1" width="250"></a>';
$inhalt = preg_replace($suchmusterd, $ersetzungd, $inhalt);

// Youtube Videos einfuegen.
$suchmustere = '/\[youtube\]+\b(http|https):\/\/.*\/(watch\?v=|embed\/|)([\w]+)\b\[\/youtube\]/i';
$ersetzunge = '<iframe width="560" height="315" src="https://www.youtube.com/embed/$3" frameborder="0" allowfullscreen></iframe>';
$inhalt = preg_replace($suchmustere, $ersetzunge, $inhalt);

echo "<table>";
echo "<tr>";
echo "<th id=\"smalltext\" colspan=\"2\">Author: " . $row->authoren . " | <img src=\"icons/clok.png\" alt=\"time\" border=\"0\" width=\"14\" height=\"14\"> " . $row->zeit . " | <img src=\"icons/date.png\" alt=\"date\" border=\"0\" width=\"14\" height=\"14\"> " . $row->datum . "</th>";
echo "</tr>";
echo "<tr>";
echo "<th class=\"titel\" colspan=\"2\"><idler>" . $row->id . " |</idler> <titel>" . $row->titel . "</titel></td>";
echo "</tr>";
echo "<tr>";
echo "<th class=\"inhalt\" colspan=\"2\">" . $inhalt . "</th>";

echo "</tr>";
echo "</table>";

}

?>
</div>

</body>
</html>