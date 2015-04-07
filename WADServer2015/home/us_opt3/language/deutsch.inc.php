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

/*basic data*/
define('BD_LANG_SHORTCUT',"de"); // used for the php function setlocale() (http://www.php.net/setlocale)
define('BD_DATE_FORMAT',"%d.%m.%Y %H:%M Uhr"); // used for the php function strftime() (http://www.php.net/strftime)

/*functions.inc.php*/
define('F_START',"Start");
define('F_CONFIG',"Konfiguration");
define('F_IMPORT',"Import");
define('F_BACKUP',"Backup");
define('F_SCHEDULE',"Backup planen");
define('F_DB_INFO',"Datenbankinfo");
define('F_SQL_QUERY',"Datenbankabfragen");
define('F_HELP',"Hilfe");
define('F_LOGOUT',"Abmelden");
define('F_FOOTER',"Besuchen Sie die %sphpMyBackupPro Webseiten%s für neue Versionen oder Neuigkeiten.");
define('F_NOW_AVAILABLE',"Eine neue Version von phpMyBackupPro steht jetzt unter  %s".PMBP_WEBSITE."%s zum Donwload bereit");
define('F_SELECT_DB',"Datenbank zum sichern auswählen");
define('F_SELECT_ALL',"alle auswählen");
define('F_COMMENTS',"Kommentar");
define('F_EX_TABLES',"Tabellen sichern");
define('F_EX_DATA',"Daten sichern");
define('F_EX_DROP',"'drop table' hinzufügen");
define('F_FTP_1',"FTP Verbindung schlug fehl mit Server");
define('F_FTP_2',"Fehler beim Login mit Benutzer");
define('F_FTP_3',"FTP Upload fehlgeschlagen");
define('F_FTP_4',"Datei erfolgreich hochgeladen als");
define('F_MAIL_1',"Eine E-Mail-Adresse ist falsch");
define('F_MAIL_2',"Diese E-Mail wurde mit phpMyBackupPro ".PMBP_VERSION." ".PMBP_WEBSITE." versendet. Server:");
define('F_MAIL_3',"konnte nicht gelesen werden");
define('F_MAIL_4',"MySQL Backup von");
define('F_MAIL_5',"E-Mail konnte nicht gesendet werden");
define('F_MAIL_6',"Dateien wurden per E-Mail erfolgreich gesendet an");
define('F_YES',"ja");
define('F_NO',"nein");
define('F_DURATION',"Dauer");
define('F_SECONDS',"Sekunden");
define('F_EX_COMP',"Kompression");
define('F_EX_OFF',"keine");
define('F_EX_GZIP',"gzip");
define('F_EX_ZIP',"zip");
define('F_FTP_5',"Löschend der Datei '%s' auf FTP Server fehgeschlagen");
define('F_FTP_6',"Datei '%s' erfolgreich vom FTP Server gelöscht");
define('F_FTP_7',"Datei '%s' existiert nicht auf dem FTP Server");
define('F_DEL_FAILED',"Backup %s konnte nicht gelöscht werden");

/*index.php*/
define('I_SQL_ERROR',"FEHLER: Bitte geben Sie Ihre richtigen MySQL-Daten unter 'Konfiguration' ein!");
define('I_NAME',"Willkommen bei phpMyBackupPro");
define('I_WELCOME',"phpMyBackupPro ist freie Software, lizensiert unter der GNU GPL.<br>
Falls Sie Hilfe brauchen, schauen Sie bitte in die Onlinehilfe oder besuchen Sie %s.<br><br>
Bitte wählen Sie aus obigem Menü aus, was Sie als nächstes tun möchten!
Sollten Sie phpMyBackupPro zum ersten Mal benutzen, gehen Sie bitte zuerst zur Konfiguration.
Die Rechte für den Ordner 'export' sowie die Datei 'global_conf.php' müssen 0777 lauten (schreiben und lesen für alle).");
define('I_CONF_ERROR',"In die Datei ".PMBP_GLOBAL_CONF." konnte nicht geschrieben werden!");
define('I_DIR_ERROR',"In das Verzeichnis ".PMBP_EXPORT_DIR." konnte nicht geschrieben werden!");
define('PMBP_I_INFO',"System information");
define('PMBP_I_SERVER',"Server");
define('PMBP_I_TIME',"Serverzeit");
define('PMBP_I_PHP_VERS',"PHP Version");
define('PMBP_I_MEM_LIMIT',"PHP Memory Limit");
define('PMBP_I_FTP',"FTP Transfer möglich");
define('PMBP_I_MAIL',"E-Mails versendbar");
define('PMBP_I_GZIP',"gzip Kompression möglich");
define('PMBP_I_SQL_SERVER',"MySQL Server");
define('PMBP_I_SQL_CLIENT',"MySQL Client");
define('PMBP_I_NO_RES',"*Wert nicht verfügbar*");
define('PMBP_I_LAST_SCHEDULED',"Letztes automatisches Backup");
define('PMBP_I_LAST_LOGIN',"Letzter Login");
define('PMBP_I_LAST_LOGIN_ERROR',"Letzter fehlerhafte Login");

/*config.php*/
define('C_SITENAME',"Seitenname");
define('C_LANG',"Sprache");
define('C_SQL_HOST',"MySQL Hostname");
define('C_SQL_USER',"MySQL Benutzername");
define('C_SQL_PASSWD',"MySQL Passwort");
define('C_SQL_DB',"Nur diese Datenbank");
define('C_FTP_USE',"FTP verwenden?");
define('C_FTP_SERVER',"FTP Server (URL oder IP)");
define('C_FTP_USER',"FTP Benutzername");
define('C_FTP_PASSWD',"FTP Passwort");
define('C_FTP_PATH',"FTP Verzeichnispfad");
define('C_FTP_PASV',"Benutze passives FTP?");
define('C_FTP_PORT',"FTP Port");
define('C_FTP_DEL',"Dateien auf FTP Server auch löschen");
define('C_EMAIL_USE',"Benutze E-Mail?");
define('C_EMAIL',"E-Mail-Adresse");
define('C_STYLESHEET',"Design");
define('C_DATE',"Datumsformat");
define('C_DEL_TIME',"Lösche lokale Backups nach x Tagen?");
define('C_DEL_NUMBER',"Max. x Backups pro Datenbank speichern");
define('C_TIMELIMIT',"PHP Zeitlimit");
define('C_IMPORT_ERROR',"DB Importfehler anzeigen?");
define('C_LOGIN',"HTTP Authentifikation?");
define('C_DIR_BACKUP',"Verzeichnisbackups aktivieren?");
define('C_DIR_REC',"Verzeichnisbackups mit Unterverzeichnissen?");
define('C_NO_LOGIN',"Loginfunktion deaktiveren?");
define('C_CONFIRM',"Bestätigungslevel");
define('C_CONFIRM_1',"leeren, löschen, importieren");
define('C_CONFIRM_2',"alle leeren, alle löschen");
define('C_CONFIRM_3',"ALLE leeren, ALLE löschen");
define('C_CONFIRM_4',"nichts bestätigen");

define('C_BASIC_VAL',"Grundkonfiguration");
define('C_EXT_VAL',"Erweiterte Konfiguration");
define('PMBP_C_SYSTEM_VAL',"Systemvariablen");
define('PMBP_C_SYS_WARNING',"Diese Systemvariablen werden von phpMyBackupPro verwaltet. Ändern Sie sie nicht, solange sie nicht wissen was Sie damit bewirken!");
define('C_TITLE_SQL',"SQL Daten");
define('C_TITLE_FTP',"FTP Einstellungen");
define('C_TITLE_EMAIL',"Backup per E-Mail");
define('C_TITLE_STYLE',"Darstellung");
define('C_TITLE_DELETE',"Backups automatisch löschen");
define('C_TITLE_CONFIG',"Sonstige Konfigurationen");
define('C_WRONG_TYPE',"ist falsch!");
define('C_WRONG_SQL',"MySQL Daten sind falsch!");
define('C_WRONG_DB',"MySQL Datenbankname ist falsch!");
define('C_WRONG_FTP',"FTP Daten sind falsch!");
define('C_OPEN',"Öffnen nicht möglich von Datei");
define('C_WRITE',"Schreiben nicht möglich in Datei");
define('C_SAVED',"Änderungen gespeichert");
define('C_WRITEABLE',"ist nicht beschreibbar");
define('C_SAVE',"Speichern");

/*import.php*/
define('IM_ERROR',"%d Fehler sind aufgetreten. Wählen Sie 'leere Datenbank' um sicherzustellen, dass die Datenbank keine Tabellen enthält");
define('IM_SUCCESS',"Erfolgreich importiert");
define('IM_TABLES',"Tabellen und");
define('IM_ROWS',"Datensätze");

define('B_EMPTIED_ALL',"Alle Datenbanken wurden erfolgreich geleert");
define('B_EMPTIED',"Die Datenbank wurde erfolgreich geleert");
define('B_DELETED',"Die Datei wurde erfolgreich gelöscht");
define('B_DELETED_ALL',"Alle Dateien wurden erfolgreich gelöscht");
define('B_NO_FILES',"Keine Backups vorhanden");
define('B_DELETE_ALL_2',"ALLE Backups löschen");
define('B_EMPTY_ALL',"ALLE Datenbanken leeren");
define('B_EMPTY_DB',"leere Datenbank");
define('B_DELETE_ALL',"alle Backups löschen");
define('B_INFO',"Info");
define('B_VIEW',"anschauen");
define('B_DOWNLOAD',"herunterladen");
define('B_IMPORT',"importieren");
define('B_IMPORT_FRAG',"fragmentiert");
define('B_DELETE',"löschen");
define('B_IMPORT_ALL',"ALLE neuesten Backups importieren");
define('B_CONF_EMPTY_DB',"Wollen Sie die Datenbank wirklich leeren?");
define('B_CONF_DEL_ALL',"Wollen Sie wirklich alle Backups dieser Datenbank löschen?");
define('B_CONF_IMP',"Wollen Sie dieses Backup wirklich importieren?");
define('B_CONF_DEL',"Wollen Sie dieses Backup wirklich löschen?");
define('B_CONF_EMPT_ALL',"Wollen Sie wirklich ALL Datenbanken leeren?");
define('B_CONF_IMP_ALL',"Wollen Sie wirklich alle neusten Backups importieren?");
define('B_CONF_DEL_ALL_2',"Wollen Sie wirklich alle Backups löschen?");
define('B_LAST_BACKUP',"Letztes Backup erstellt am");
define('B_SIZE_SUM',"Gesamtgröße aller Backups");

/*backup.php*/
define('EX_SAVED',"Datei erfolgreich gespeichert als");
define('EX_NO_DB',"Keine Datenbank ausgewählt");
define('EX_EXPORT',"Backup");
define('EX_NOT_SAVED',"Backup der Datenbank %s kann nicht in '%s' gesichert werden");
define('EX_DIRS',"Wählen Sie die Verzeichnise zum kopieren auf den FTP Server");
define('EX_DIRS_MAN',"Geben Sie weitere Verzeichnispfade, getrennt mit \"|\",<br>relativ zum phpMyBackupPro Verzeichnis ein.");
define('EX_PACKED',"alles in eine ZIP-Datei packen");
define('PMBP_EX_NO_AVAILABLE',"Auf Datenbank '%s' kann nicht zugegriffen werden");
define('PMBP_EX_NO_ARGV',"Beispiel:\n$ php backup.php db1,db2,db3\nFuer weitere Funktionen lesen Sie bitte 'SHELL_MODE.txt' im Verzeichnis 'documentation'");

/*scheduled.php*/
define('EXS_PERIOD',"Häufigkeit des Backups auswählen");
define('EXS_PATH',"Wählen Sie das Verzeichnis in dem die Datei gesichert wird");
define('EXS_BACK',"zurück");
define("PMBP_EXS_ALWAYS",'Bei jedem Aufruf');
define('EXS_HOUR',"Stunde");
define('EXS_HOURS',"Stunden");
define('EXS_DAY',"Tag");
define('EXS_DAYS',"Tage");
define('EXS_WEEK',"Woche");
define('EXS_WEEKS',"Wochen");
define('EXS_MONTH',"Monat");
define('EXS_SHOW',"Zeige Script");
define('PMBP_EXS_INCL',"Fügen Sie dieses Script in die PHP Datei (%s) ein, die das Backup für Sie ausführen soll");
define('PMBP_EXS_SAVE',"oder speichern Sie das Script in eine neuen Datei (überschreibt diese Datei, falls sie existiert!)");
define('PMBP_EXS_UPDATE_DIRS',"Verzeichnislisten updaten");

/*file_info.php*/
define('INF_INFO',"Info");
define('INF_DATE',"Erstellungsdatum");
define('INF_DB',"Datenbank");
define('INF_SIZE',"Backupgrösse");
define('INF_DROP',"Beinhaltet 'drop table'");
define('INF_TABLES',"Beinhaltet Tabellen");
define('INF_DATA',"Beinhaltet Daten");
define('INF_COMMENT',"Kommentar");
define('INF_NO_FILE',"Keine Datei ausgewählt");
define('INF_COMP',"Ist komprimiert");

/*db_status.php*/
define('DB_NAME',"Datenbankname");
define('DB_NUM_TABLES',"Tabellenanzahl");
define('DB_NUM_ROWS',"Datensatzanzahl");
define('DB_SIZE',"Größe");
define('DB_DIFF',"Die Größen der Datenbanken können sich von den Größen der Backups unterscheiden!");
define('DB_NO_DB',"Keine Datenbanken vorhanden");
define('DB_TABLES',"Tabelleninfo");
define('DB_TAB_TITLE',"Tabellen der Datenbank ");
define('DB_TAB_NAME',"Tabellenname");
define('DB_TAB_COLS',"Felderanzahl");

/*sql_query.php*/
define('SQ_ERROR',"Fehler in Abfrage Nummer");
define('SQ_SUCCESS',"Erfolgreich ausgeführt");
define('SQ_RESULT',"Abfrageergebnis");
define('SQ_AFFECTED',"Anzahl betroffener Datensätze");
define('SQ_WARNING',"Achtung: Diese Seite wurde erstellt um einfache Datenbankabfragen zu senden. Unvorsichtigkeit kann zum Verlust Ihrer Daten führen!");
define('SQ_SELECT_DB',"Datenbank auswählen");
define('SQ_INSERT',"Datenbankabfrage(n) eingeben");
define('SQ_FILE',"SQL Datei hochladen");
define('SQ_SEND',"Ausführen");

/*login.php*/
define('LI_MSG',"Bitte einloggen (MySQL Username und Passwort)");
define('LI_USER',"Username");
define('LI_PASSWD',"Passwort");
define('LI_LOGIN',"Login");
define('LI_LOGED_OUT',"Sicher ausgeloggt!");
define('LI_NOT_LOGED_OUT',"Nicht sicher ausgeloggt!<br>Geben Sie zum sicheren ausloggen ein FALSCHES Passwort ein!");

/*big_import.php*/
define('BI_IMPORTING_FILE',"Datei wird importiert");
define('BI_INTO_DB',"In Datenbank");
define('BI_SESSION_NO',"Session Nummer");
define('BI_STARTING_LINE',"Von Zeile ");
define('BI_STOPPING_LINE',"Bis Zeile ");
define('BI_QUERY_NO',"Anzahl der ausgeführten SQL-Abfragen");
define('BI_BYTE_NO',"Anzahl verarbeiteter Bytes");
define('BI_DURATION',"Dauer der letzten Session");
define('BI_THIS_LAST',"aktuelle Session/Gesamt");
define('BI_END',"Ende der Datei erreicht. Import scheint erfolgreich zu sein!");
define('BI_RESTART',"Neuen Import der Datei ");
define('BI_SCRIPT_RUNNING',"Das Skript läuft noch!<br>Bitte warten Sie bis das Ende der Datei erreicht ist.");
define('BI_CONTINUE',"Weiter ab Zeile");
define('BI_ENABLE_JS',"Aktivieren Sie JavaScript um automatisch fortzufahren");
define('BI_BROKEN_ZIP',"Das ZIP-Archiv scheint bechädigt zu sein.");
define('BI_WRONG_FILE',"Angehalten in Zeile %s.<br>Die Aktuelle Abfrage enthält mehr als %s Zeilen. Dies kommt vor, wenn das Backup
mit eime Tool erstellt wurde, das kein Semikolon und einen Zeilenumbruch ans Ende jedes SQL-Befehls schreibt oder wenn das Backup 'extended' Insert-Befehle enthält!");

/*get_file.php*/
define("GF_INVALID_EXT","Es können nur Dateien mit einer der folgenden Endungen angeschaut werden: .php, .php3, .html, .htm, .sql, .sql.zip, .sql.gz");

?>