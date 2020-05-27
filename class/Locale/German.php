<?php

namespace XoopsModules\Amreviews\Locale;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @since           3.23
 * @author          Xoops Development Team
 */
class German
{
    // $moduleDirName = basename(dirname(dirname(__DIR__)));
    //$moduleDirNameUpper = mb_strtoupper($moduleDirName);

    //    public const ERROR_BAD_DEL_PATH2 = 'Es ist ja fantastich';

    public const ERROR_BAD_DEL_PATH2 = '%s Verzeichnis konnte nicht gelöscht werden';
    public const GDLIBSTATUS = 'Unterstützung der GD-Bibliothek:';
    public const GDLIBVERSION = 'Version der GD-Bibliothek:';
    public const GDOFF = "<span style = 'Schriftgröße: fett;'> Deaktiviert </span> (Keine Miniaturansichten verfügbar)";
    public const GDON = "<span style = 'Schriftgröße: fett;'> Aktiviert </span> (Thumbsnails verfügbar)";
    public const IMAGEINFO = 'Serverstatus';
    public const MAXPOSTSIZE = 'Maximal zulässige Postgröße (Direktive post_max_size in php.ini):';
    public const MAXUPLOADSIZE = 'Maximal zulässige Upload-Größe (Anweisung upload_max_filesize in php.ini):';
    public const MEMORYLIMIT = 'Speicherlimit (memory_limit-Direktive in php.ini):';
    public const METAVERSION = "<span style = 'Schriftgröße: fett;'> Metaversion herunterladen: </span>";
    public const OFF = "<span style = 'Schriftgröße: fett;'> OFF </span>";
    public const ON = "<span style = 'Schriftgröße: fett;'> ON </span>";
    public const SERVERPATH = 'Serverpfad zum XOOPS-Stammverzeichnis:';
    public const SERVERUPLOADSTATUS = 'Server lädt Status hoch:';
    public const SPHPINI = "<span style = 'font-weight: fett;'> Informationen aus der PHP-INI-Datei: </span>";
    public const UPLOADPATHDSC = 'Hinweis. Upload-Pfad * MUSS * den vollständigen Serverpfad Ihres Upload-Ordners enthalten. ';
    public const PRINT = "<span style = 'Schriftgröße: fett;'> Drucken </span>";
    public const PDF = "<span style = 'Schriftgröße: fett;'> PDF erstellen </span>";
    public const UPGRADEFAILED0 = "Aktualisierung fehlgeschlagen - Feld '% s' konnte nicht umbenannt werden";
    public const UPGRADEFAILED1 = 'Aktualisierung fehlgeschlagen - neue Felder konnten nicht hinzugefügt werden';
    public const UPGRADEFAILED2 = "Aktualisierung fehlgeschlagen - Tabelle '% s' konnte nicht umbenannt werden";
    public const ERROR_COLUMN = 'Spalte in Datenbank konnte nicht erstellt werden:% s';
    public const ERROR_BAD_XOOPS = 'Dieses Modul erfordert XOOPS% s + (% s installiert)';
    public const ERROR_BAD_PHP = 'Dieses Modul erfordert die PHP-Version% s + (% s installiert)';
    public const ERROR_TAG_REMOVAL = 'Tags konnten nicht aus dem Tag-Modul entfernt werden';
    public const FOLDERS_DELETED_OK = 'Upload-Ordner wurden gelöscht';
    // Fehlermeldungen
    public const ERROR_BAD_DEL_PATH = '% s Verzeichnis konnte nicht gelöscht werden';
    public const ERROR_BAD_REMOVE = '% s konnte nicht gelöscht werden';
    public const ERROR_NO_PLUGIN = 'Plugin konnte nicht geladen werden';
    //Hilfe
    // public const DIRNAME = \ basename (\ dirname (\ dirname (__ DIR__)));
    public const HELP_HEADER = __DIR__ . '/help/helpheader.tpl';
    public const BACK_2_ADMIN = 'Zurück zur Administration von';
    public const OVERVIEW = 'Übersicht';
    // define ('HELP_DIR', __DIR__);

    // Hilfe mehrseitig
    public const DISCLAIMER = 'Haftungsausschluss';
    public const LICENSE = 'Lizenz';
    public const SUPPORT = 'Unterstützung';
    //Beispieldaten
    public const ADD_SAMPLEDATA = 'Beispieldaten importieren (löscht ALLE aktuellen Daten)';
    public const SAMPLEDATA_SUCCESS = 'Beispieldatum erfolgreich hochgeladen';
    public const SAVE_SAMPLEDATA = 'Tabellen nach YAML exportieren';
    public const SHOW_SAMPLE_BUTTON = 'Beispielschaltfläche anzeigen?';
    public const SHOW_SAMPLE_BUTTON_DESC = 'Wenn ja, ist die Schaltfläche "Beispieldaten hinzufügen" für den Administrator sichtbar. Bei der Erstinstallation ist dies standardmäßig Ja. ';
    public const EXPORT_SCHEMA = 'DB-Schema nach YAML exportieren';
    public const EXPORT_SCHEMA_SUCCESS = 'DB-Schema nach YAML exportieren war ein Erfolg';
    public const EXPORT_SCHEMA_ERROR = 'FEHLER: Export des DB-Schemas nach YAML fehlgeschlagen';
    public const ADD_SAMPLEDATA_OK = 'Sind Sie sicher, Beispieldaten zu importieren? (Es werden ALLE aktuellen Daten gelöscht) ';
    public const HIDE_SAMPLEDATA_BUTTONS = 'Importschaltflächen ausblenden)';
    public const SHOW_SAMPLEDATA_BUTTONS = 'Importschaltflächen anzeigen)';
    public const CONFIRM = 'Bestätigen';
    // Buchstabenwahl
    public const BROWSETOTOPIC = "<span style = 'font-weight: fett;'> Elemente alphabetisch durchsuchen </span>";
    public const OTHER = 'Andere';
    public const ALL = 'All';
    // Block definiert
    public const ACCESSRIGHTS = 'Zugriffsrechte';
    public const ACTION = 'Aktion';
    public const ACTIVERIGHTS = 'Aktive Rechte';
    public const BADMIN = 'Blockverwaltung';
    public const BLKDESC = 'Beschreibung';
    public const CBCENTER = 'Center Middle';
    public const CBLEFT = 'Mitte links';
    public const CBRIGHT = 'Mitte rechts';
    public const SBLEFT = 'Links';
    public const SBRIGHT = 'Richtig';
    public const SIDE = 'Ausrichtung';
    public const TITLE = 'Titel';
    public const VISIBLE = 'Sichtbar';
    public const VISIBLEIN = 'Sichtbar in';
    public const WEIGHT = 'Weight';
    public const PERMISSIONS = 'Berechtigungen';
    public const BLOCKS = 'Blocks Admin';
    public const BLOCKS_DESC = 'Blöcke / Gruppenadministrator';
    public const BLOCKS_MANAGMENT = 'Verwalten';
    public const BLOCKS_ADDBLOCK = 'Neuen Block hinzufügen';
    public const BLOCKS_EDITBLOCK = 'Block bearbeiten';
    public const BLOCKS_CLONEBLOCK = 'Block klonen';
    // myblocksadmin
    public const AGDS = 'Admin Groups';
    public const BCACHETIME = 'Cache-Zeit';
    public const BLOCKS_ADMIN = 'Blockiert den Administrator';
    // Template Admin
    public const TPLSETS = 'Vorlagenverwaltung';
    public const GENERATE = 'Generieren';
    public const FILENAME = 'Dateiname';
    //Speisekarte
    public const ADMENU_MIGRATE = 'Migrieren';
    public const FOLDER_YES = 'Ordner "% s" existiert';
    public const FOLDER_NO = 'Ordner "% s" existiert nicht. Erstellen Sie den angegebenen Ordner mit CHMOD 777. ';
    public const SHOW_DEV_TOOLS = 'Schaltfläche "Entwicklungswerkzeuge anzeigen?"';
    public const SHOW_DEV_TOOLS_DESC = 'Wenn ja, sind die Registerkarte "Migrieren" und andere Entwicklungstools für den Administrator sichtbar.';
    public const ADMENU_FEEDBACK = 'Feedback';
    // Letzte Versionsprüfung
    public const NEW_VERSION = 'Neue Version:';
}
