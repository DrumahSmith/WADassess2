<?php
/*
 +--------------------------------------------------------------------------+
 | phpMyBackupPro                                                           |
 +--------------------------------------------------------------------------+
 | Copyright (c) 2004-2013 by Dirk Randhahn                                 |
 | http://www.phpMyBackupPro.net                                            |
 | version information can be found in definitions.php.                     |
 |                                                                          |
 | This program is free software; you can redistribute it and/or            |
 | modify it under the terms of the GNU General Public License              |
 | as published by the Free Software Foundation; either version 2           |
 | of the License, or (at your option) any later version.                   |
 |                                                                          |
 | This program is distributed in the hope that it will be useful,          |
 | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            |
 | GNU General Public License for more details.                             |
 |                                                                          |
 | You should have received a copy of the GNU General Public License        |
 | along with this program; if not, write to the Free Software              |
 | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,USA.|
 +--------------------------------------------------------------------------+
*/
/*
 +--------------------------------------------------------------------------+
 | phpMyBackupPro German translation                                        |
 +--------------------------------------------------------------------------+
 | German translation 2.4                                                   |
 | 2004-2013 by Dirk Randhahn http://www.phpMyBackupPro.net                 | 
 | and July 2004 by Corsin "CoCaman" Camichel, cocaman@users.sourceforge.net|
 +--------------------------------------------------------------------------+
*/

chdir("..");
require_once("definitions.php");

echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\"
   \"http://www.w3.org/TR/html4/loose.dtd\">
<html".ARABIC_HTML.">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\">
<link rel=\"stylesheet\" href=\"./../".PMBP_STYLESHEET_DIR.$CONF['stylesheet'].".css\" type=\"text/css\">
<title>phpMyBackupPro - ".F_HELP."</title>
</head>
<body>
<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" width=\"100%\">\n
<tr><th colspan=\"2\" class=\"active\">";
echo PMBP_image_tag("../".PMBP_IMAGE_DIR."logo.png","phpMyBackupPro ".PMBP_WEBSITE,PMBP_WEBSITE);
echo "</th></tr>\n";

// choose help text
switch(preg_replace("'^.*/'","",$_GET['script'])) {
    case 'index.php': $filename=F_START;
    $html="Auf der Startseite finden Sie Informationen über das System auf dem diese phpMyBackupPro Installation läuft.<br><br>
    ".PMBP_I_SERVER.": Die Bezeichnung des verwendeten Webservers sund die Serverzeit.<br>
    "."PHP".": Die PHP-Version und Inofrmationen über ausgewählte PHP Module und Funktionen.
    Sie sehen den PHP Speicherlimit, ob gzip-Kompressionen möglich sind
    and ob Sie auf diesem Server per PHP E-Mails versenden und FTP nutzen können.<br>
    "."MySQL".": Die Version des MySQL Servers und des MySQL Clients.<br>    
    ".F_BACKUP.": Hier steht der durch die gespeicherten Backups belegten Speicherplatz,
    wann das letzte Backup erstellt wurde und wann das letzte Backup automatisiert erstellt wurde.<br>
    ".LI_LOGIN.": Hier steht, wann und von welcher IP Sie sich das letzte mal angemeldet haben.";
    break;
    case 'config.php': $filename=F_CONFIG;
    $html="Es gibt zwei Seiten zur Konfigurations: die Grundkonfiguration und die erweiterte Konfiguration. Um die erweiterte Konfiguration müssen Sie sich nicht kümmern, wenn Sie nicht wollen.
	Das Zeichen * markiert die Felder, die nicht leer bleiben dürfen.<br><br>
	Grundkonfiguration:<br>
	".C_SITENAME.": Geben Sie dem System einen Namen wie z.B. 'Produktionsserver'.<br>
	".C_LANG.": Ändern Sie die Sprache von phpMyBackupPro. Auf der phpMyBackupPro Projektseite stehen mehrer Sprachdateien zur Verfügung.<br>
	".C_SQL_HOST.": Geben Sie Ihren MySQL Server ein. Z.B. 'localhost' oder mit Port-Nummer 'localhost:3306'.<br>
	".C_SQL_USER.": Geben Sie Ihren MySQL Usernamen ein.<br>
	".C_SQL_PASSWD.": Geben Sie Ihr MySQL Passwort ein.<br>
	".C_SQL_DB.": Wenn Sie nur auf eine einzige Datenbank zugreifen wollen, geben Sie hier deren Namen an.<br>
	".C_FTP_USE.": Markieren Sie dies, um den automatischen Upload der Backups zu einem FTP Server zu aktivieren.<br>
	".C_FTP_BACKUP.": Hiermit ermöglichen Sie Backups von Ordnern auf FTP Server.<br>
	".C_FTP_REC.": Hiermit ermöglichen Sie Backups von Ordnern inklusive aller untergeordneter Ordner.<br>
	".C_FTP_SERVER.": Geben Sie die IP oder URL Ihres FTP Servers ein.<br>
	".C_FTP_USER.": Geben Sie Ihren FTP Loginname ein.<br>
	".C_FTP_PASSWD.": Geben Sie Ihren FTP Passwort ein.<br>
	".C_FTP_PATH.": Geben Sie den Pfad zu dem Verzeichnis auf dem FTP Server an, in dem die Backups gespeichert werden sollen.<br>
	".C_FTP_PASV.": Markieren sie dies um passives FTP zu verwenden.<br>
	".C_FTP_PORT.": Hier können Sie den Port eingeben, auf den Ihr FTP Server hört. Der Standard Port ist 21.<br>
	".C_FTP_DEL.": Markieren Sie dies, um Backups auf dem FTP Server automazisch löschen zu lassen, wenn Sie auch lokal gelöscht werden.<br>
	".C_EMAIL_USE.": Markieren Sie dies, um Ihre Backups automatisch per E-Mail versenden zu lassen.<br>
	".C_EMAIL.": Geben Sie die E-Mail-Adresse ein, an die die Backups geschickt werden sollen.<br><br>
	Erweiterte Konfiguration:<br>
	".C_STYLESHEET.": Wählen Sie ein Stylesheet für phpMyBackupPro. Auf der phpMyBackupPro Projektseite stehen mehrer Stylesheets zur Verfügung.<br>
	".C_DATE.": Wählen Sie Ihr bevorzugtes Datumsformat.<br>
	".C_LOGIN.": Sie können HTTP Authentifikation wählen als Alternaive zum HTML Login.<br>
	".C_DEL_TIME.": Geben Sie ein Anzahl an Tagen an, nach welchen die Backups automatisch gelöscht werden sollen. Setzten Sie den Wert auf 0, um diese Funktion zu deaktivieren.<br>
	".C_DEL_NUMBER.": Geben Sie ein maximale Anzahl an Backups ein, die pro Datenbank gespeichert bleiben sollen.<br>
	".C_TIMELIMIT.": Erhöhen Sie das PHP Timelimit wenn Sie Probleme beim Erstellen von backups oder importieren haben.<br>
	".C_CONFIRM.": Wählen Sie hier die Aktionen, die auf der Import-Seite bestätigt werden muessen.<br>
	".C_IMPORT_ERROR.": Falls aktiviert bekommen Sie eine Liste der der aufgetretenen Fehler beim Import angezeigt.<br>
	".C_DIR_BACKUP.": Hier können Sie den Verzeichnisbackups aktivieren. Gültige FTP Daten sind Vorraussetzung für diese Funktion.<br>
	".C_DIR_REC.": Falls aktiviert werden auch alle Unterverzeichnisse der ausgewählten Ordner gespeichert beim Verzeichnisbackup.<br>
	".C_NO_LOGIN.": Hier können Sie die Loginfunktion deaktivieren. Dies ist nicht empfohlen, da somit jederman Zugriff auf Ihre Datenbank erhalten kann!<br><br>
	Systemvariablen:<br>
	Hier können sie die aktuellen Werte der internen Variablen von phpMyBackupPro ändern. Ändern Sie diese nur, wenn sie genau wissen was Sie tun.
	Weiter Informationen dazu finden Sie in 'SYSTEM_VARIABLES.txt' im Dokumentationsordner.";
    break;
    case 'import.php': $filename=F_IMPORT;
    $html="Hier sehen Sie alle gerade lokal gesicherten Bakups.<br>
    Sie bekommen mehr Informationen beim klicken auf 'Info'.<br>
    Wenn Sie auf 'anschauen' klicken können Sie das Backup einsehen.<br>
	Um das Backup herunterzuladen klicken Sie auf '".B_DOWNLOAD."'.<br>
    Klicken Sie auf 'import' um die Backupdatei in die Datenbank zu laden. Zuvor können Sie die Datenbank mit 'Datenbank leeren' leeren.<br>
    Große Backups können Sie über den Link '".B_IMPORT_FRAG."' importieren. Dadurch wird das Backup Stück für Stück importiert.<br>
    Ein Backupfile löschen Sie mit 'löschen'. Sie können alle Backups einer Datenbank löschen wenn Sie auf 'alle Backups löschen' klicken.<br>
    Klicken Sie auf 'ALLE Datenabanken leeren' um alle verfügbaren Datenbanken zu leeren, klicken Sie auf 'ALLE neusten Backups imporieren' um das letzte Backup jeder Datenbank zu importieren,
    klicken Sie auf 'ALLE Backups löschen' um alle bestehenden Backups zu löschen.";
    break;
    case 'backup.php': $filename=F_BACKUP;
    $html="Hier können Sie auswählen, welche Datenbanken Sie sichern möchten.<br>
    Ein Kommentar kann zu jedem Backup gesichert werden.<br>
    Sie können auswählen, ob Sie nur die Tabellenstruktur, die Daten oder beides sichern wollen.<br>
    Fügen Sie 'drop table if exists ...' zu jeder Tabellenstruktur hinzu durch aktivieren von 'drop table hinzufügen'<br>
    Wenn Sie 'gzip Datei' wählen wird die Backupdatei als gzip-File gepackt. Diese Funktion steht Ihnen nur zur Verfügung, wenn die PHP gzip-Funktionen auf Ihrem System verfügbar sind.<br><br>
	Wenn Sie FTP Backup aktiviert haben können Sie auch ganze Verzeichnisse auf ihren FTP Server sichern.<br>
	Die hier ausgewählten Verzeichnisse und alle Dateien darin werden nach '".C_FTP_PATH."', eingestellt auf der '".F_CONFIG."' Seite, kopiert.<br>
	Es ist nicht möglich Verzeichnisse zu komprimieren oder per E-Mail zu versenden aber Sie können '".EXS_PACKED."' aktivieren um alle Dateien in eine ZIP-Datei zu packen. (Benötigt mehr Zeit als ein normales Backup!)<br>
	Die Verzeichnisliste wird nur beim Login geladen und dann nach Möglichkeit widerverwendet. Wollen Sie die Liste aktualisieren, klicken Sie auf '".PMBP_EXS_UPDATE_DIRS."'.";
    break;
    case 'scheduled.php': $filename=F_SCHEDULE;
    $html="Um ein Datenbankbackup zu automatisieren, können Sie hier ein Script zum Einbinden in eine bestehende php-Seite erzeugen lassen.<br>
    Wenn dieses Script dann geladen wird, wird automatisch das Backup gestartet. Sie können wählen wie häufig das Backup statt finden soll.<br><br>
    Als nächstes müssen Sie auswählen, wo in welchem Verzeichnis das Skript platziert werden soll. Der phpMyBackupPro-Ordner darf anschließend nicht mehr verschoben werden.<br>
    Mit einem Klick auf '".EXS_SHOW."' wird Ihnen das Skript für die automatischen Backups angezeigt. Kopieren Sie den Code in eine existierende Datei,
	oder sichern Sie das Skrip mit einem Klick auf '".C_SAVE."' unter dem von Ihnen angegebenen Dateinamen. Eine bestehende Datei mit dem selben Namen wird gegebenenfalls überschrieben!<br><br>
    Achtung: Das Skript mus auf jeden Fall im angegeneben Verzeichnis platziert werden. Das Backup wird allerdings nur gestartet wenn auch jemand die Seite aufruft! Eine Realisisierungsmöglichkeit ist das Verwenden eines unsichtbaren HTML-Frames.<br><br>
    Alle Konfigurationen, die Sie unter 'Konfiguration' gemacht haben, behalten ihre Gültigkeit! Sie bekommen weiter Infos zu den Backupmöglichkeiten in der 'Backup' Hilfe.<br><br>
    Wenn Sie eine längere Liste an Verzeichnissen zum Abspeichern des Skriptes zur Auswahl bekommen möchten, ändern Sie auf der Seite '".F_CONFIG."' den Wert der System-Variable 'dir_lists' auf 2!";
    break;
    case 'db_info.php': $filename=F_DB_INFO;
    $html="Hier sehen Sie eine kurze Zusammenfassung Ihrer Datenbanken.<br><br>
    Die Spalte 'Datensatzanzahl' enthält die Summe der Anzahl der Datensätze in allen Tabellen.<br>
    Wenn eine Datenbank Tabellen enthält, können Sie 'Tabelleninfo' anklicken um die Tabellennamen, Anzahl der Spalten, Anzahl der Datensätze und Größen aller Tabellen der jeweiligen Datenbank angezeigt zu bekommen.<br>
    Die Größe kann sich, auf Grund zusätzlicher Einträge in den Backups, von der der Backups, unterscheiden.";
    break;
    case 'sql_query.php': $filename=F_SQL_QUERY;
    $html="Diese Seite wurde erstellt um einfache Datenbankabfragen an die Datenbank zu senden.<br><br>
    Zuerst müssen Sie die Datenbank auswählen an die Sie die Abfrage richtigen wollen.<br>
    Dann können Sie einen oder mehrere MySQL Befehle in das Textfeld eingeben.<br>
    Abfragen wie 'select ...' liefern eine Ergebnistabelle zurück.<br>
    Einige Abfragen wie 'delete ...' liefern lediglich '".SQ_SUCCESS."' zurück.<br>
    Zu jedem erfolgreich ausgeführten Befehl wird die Anzahl der Betroffenen Datensätze angeben.<br><br>
    Wenn Sie eine Datei mit SQL Befehlen hochladen werden Sie eine Fehlermeldung für jeden aufgetretenen Fehler bekommen! (und das können viele sein!)<br>
    Die letzte Fehlermeldung wird eine Liste aller nicht erfolgreich ausgeführten Anfragen enthalten. Ein 'F' vor einer Nummer gibt an, das die Anfrage aus der Datei stammt.<br>
    Die Funtkionen sind noch nicht ausgereift! Es gibt keine Garantie, das alle richtigen SQL Anfragen auch erfolgreich ausgeführt werden können!";
    break;
    default: $html="Keine Hilfe für diese Seite verfügbar.";
}

echo "<tr>\n<td>\n";
if ($filename) echo "<br><div class=\"bold_left\">Hilfe für ".$filename.":</div><br>\n";
echo $html;
echo "</td>\n</tr>\n</table>\n</body>\n</html>";
?>

