<?php
session_start();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>etub_install</title>
<meta name="description" content="Installation des ETUBs">
<meta name="keywords" content="install_etub">
<meta name="author" content="silen">
<meta name="editor" content="html-editor phase 5">
</head>
<body text="#000000" bgcolor="#F4F8F4" link="#FF0000" alink="#FF0000" vlink="#FF0000">

<fieldset>
<legend>ETUB Installationsprotokoll</legend>

<p align="left">Es wird nun versucht eine Verbindung zur Datenbank her zu stellen!</p>

<?php

$servername = "localhost";
$datenbankbenutzer = $_SESSION["datenbankbenutzer"];
$datenbankpasswort = $_SESSION["datenbankpasswort"];

// Create connection
$conn = mysqli_connect($servername, $datenbankbenutzer, $datenbankpasswort);

// Check connection
if (!$conn) {
    die("Konnte keine Verbindung zur Datenbank herstellen: " . mysqli_connect_error());
    ?>
     <br> <h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>
    <?php

}
echo "Erfolgreich verbunden";
?>




</fieldset>


</body>
</html>