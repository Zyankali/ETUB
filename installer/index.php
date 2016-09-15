<?php



session_start();

// sicherheitshalber alle vorhandenen Sessions zerstören!

session_unset();


session_destroy();



?>

<!DOCTYPE html>
<html>
<head>
<title>index</title>
<meta name="description" content="installer index">
<meta name="keywords" content="installer">
<meta name="author" content="silentsands">

</head>
<body text="#000000" bgcolor="#F4F8F4" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<font size="+4" face="VERDANA,ARIAL,HELVETICA"><p align="center">Installer</p></font>
<form action="edit.php" method="post">
<fieldset>
<legend>Hineweise und Infos</legend>
<br>

<!-- Hinweistext, letzte Infos und Lizensierung -->

<textarea name="titel" rows="20" cols="60" value="TESTTEXT lalala tralalala lalalala" readonly>EasyToUseBlog
ETUB

Experimental Version V_0.8.2
Erstveröffentlichung der Testversion.

Letzte Anmerkungen und Hinweise.

Dies ist der EasyToUseBlog kurz auch ETUB genannt.
Dieser Blog wurde für Menschen entwickelt welche sich nicht mit umständlichen oder gar komplizierten Prozessen auseinander setzen wollen oder können, die aber dennoch gerne einen eigenen Blog betreiben möchten und einsetzen möchten.

Auch verwendet das ETUB selber kein Java oder JavaScript. Da Ich der Ersteller und Entwickler der Meinung bin das Java für Blogs schlicht weg unnötig und gar ein Sicherheitsrisiko darstellen kann das man nicht unterschätzen sollte. 


Hinweis – Bitte Lesen! :

Dies ist aktuell eine experimentelle Version des ETUB. 
Dies bedeutet das dieser Blog bereits eingeschränkt nutzbar ist jedoch sind folgende punkte zu beachten!

1. Der Code des ETUBs ist nicht optimiert!
2. Der Code des ETUBs hat sich primär auf Funktionalität ausgerichtet weniger an Sicherheit Standards. Diese werden in einer Späteren Version erweitert und hinzugefügt.
3. Es ist aktuell noch nicht möglich Bilder mit in die eigenen Einträge im Editor mit ein zu fügen. Dies wird in einer Späteren Version aber möglich sein.
4. Es handelt sich hierbei derzeit noch um eine Experimentelle Version des ETUBs! Dies bedeutet das auf Nichts eine Garantie gegeben werden kann und wird, es noch nicht für der Produktiven Einsatz zugelassen ist und lediglich zum austesten gedacht ist. Daher behalten Sie im Hinterkopf immer stets das dieser Blog nur Minimale Sicherheit Standards erfüllt und somit noch derzeit leicht die Sicherheitsmaßnahmen umgangen werden könnten. Benutzung auf eigene Gefahr!

Weitere zukünftige geplante Implementierungen und Verbesserungen sind als folgt.

- Einsetzen von Bildern in den Einträgen. ( URL Einsetzung & Lokale Einsetzung )

- Mehrnutzer Anwendung, so das mehrere den Blog benutzen können. Zum Beispiel Familienmitglieder.

-  Moderation System, Moderatoren die sich ggf. mit um geringere dinge in ihrem Blog kümmern können.

- Kommentar Funktion der Einträge (? Wird derzeit aber noch überprüft. ?)

- API Funktionalität zur Erweiterung der Funktionalität des Blogs durch Dritte (? Wird derzeit aber noch überprüft. ?)

Lizenzierung:

Jeder darf und kann diese Software im IST ZUSTAND verwenden.
Veränderungen oder das Kopieren des Codes und dessen internen Bestandteile sind untersagt und werden ggf. weiter geahndet! 
Die Software, der Code und die Logos EasyToUseBlog, ETUB und Sonictechnologic sind Kopiergeschützte Elemente und dürfen nicht als Eigentum behandelt oder betrachtet werden!

Es ist jedoch ausdrücklichst erlaubt das dass Logo der Hauptseite im oberen Anzeigenbereich nach eigenem Ermessen angepasst werden darf. 
Ebenfalls ist es erlaubt die Stylesheet Datei „mainstyle.css im CSS Ordner nach eigenem Belieben an zu passen. Diese beiden Dateien und Elemente sind von der Untersagung zur Veränderung ausgenommen.

Viel Spaß mit dem Easy To Use Blog

wünscht ihnen

Ihr Florin B.

Sonictechnologic©
 </textarea><br><br>
 <h4><a class="normallink" href="installer_user.php" name="installer" title="Weiter">Zustimmen und Weiter</a></h4>
<h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>
</fieldset>
</form>



</body>
</html>