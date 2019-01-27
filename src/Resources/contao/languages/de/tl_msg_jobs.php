<?php

/**
 * Extension for Contao 4
 *
 * @copyright  Softleister 2018
 * @author     Softleister <info@softleister.de>
 * @package    contao-message-jobs-bundle
 * @licence    LGPL-3.0+
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_msg_jobs']['title']           = array('Titel des Message-Job', 'Titel des Benachrichtigungs-Message-Jobs');
$GLOBALS['TL_LANG']['tl_msg_jobs']['alias']           = array('Alias', 'Eindeutige Kennung für den Message-Job. Lassen Sie das Feld leer um den Alias automatisch aus dem Titel erzeugen zu lassen.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['einzelmail']      = array('Benachrichtigungen', 'Sie können eine LISTE der Fundstellen als Benachrichtigung senden oder eine Benachrichtigung je Fundstelle.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['list_separator']  = array('Trennzeichen', 'Wählen Sie das Trennzeichen bei Ausgabe der Fundstellen als Liste.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_expert']      = array('SQL-Eingabemodus', 'Wählen Sie zwischen einfacher Abfrage einer Tabelle und der komplexen Abfragemöglichkeit');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_query']       = array('SQL-Abfragebefehl', 'Kompletter SQL-Befehl zur Abfrage der Daten, Die <strong>id</strong> sollte immer mit abgefragt werden!');
$GLOBALS['TL_LANG']['tl_msg_jobs']['published']       = array('Aktivieren', 'Der Message-Job kann nur gestartet werden, wenn er aktiviert ist.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['notiz']           = array('Notiz', 'Bemerkungen zum Message-Job');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_table']       = array('Tabelle', 'Bitte wählen Sie die Quelltabelle.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_fields']      = array('Felder', 'Bitte geben Sie eine kommagetrennte Liste der Felder ein, die Sie auflisten möchten.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_where']       = array('Bedingung', 'Hier können Sie eine Bedingung eingeben, um die Ergebnisse zu filtern (z.B. <em>published=1</em> oder <em>type!="admin"</em>).');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_sort']        = array('Sortieren nach', 'Hier können Sie eine kommagetrennte Liste der Felder eingeben, nach denen die Ergebnisse sortiert werden sollen.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['pre_on']          = array('SQL-Vorverarbeitung aktivieren', 'Der SQL-Befehl wird vor der Hauptabfrage ausgeführt');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_pre']         = array('SQL-Befehl', 'Auszuführen vor der Abfrage.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['post_on']         = array('SQL-Nachverarbeitung aktivieren', 'Der SQL-Befehl wird nach der Abfrage und nach den Benachrichtigungen ausgeführt');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_post']        = array('SQL-Befehl', 'Auszuführen für jeden Datensatz nach Abfrage und Benachrichtigung. <em>id=##id##</em> wird durch die aktuelle ID ersetzt, auch bei Listen-Benachrichtigung.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['postbed']         = array('Wann ausführen?', 'Geben Sie an, ob die Nachbearbeitung immer oder nur nach erfolgreichen Benachrichtigungen ausgeführt werden soll.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['nc_notification'] = array('Benachrichtigung', 'Wählen Sie hier Ihre Benachrichtigung aus dem Notification-Center aus.');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_msg_jobs']['new']        = array('Neuer Message-Job', 'Neuen Benachrichtigungs-Message-Job hinzufügen');
$GLOBALS['TL_LANG']['tl_msg_jobs']['edit']       = array('Message-Jobs verwalten', 'Message-Job ID %s verwalten');
$GLOBALS['TL_LANG']['tl_msg_jobs']['editheader'] = array('Message-Job bearbeiten', 'Message-Job ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_msg_jobs']['copy']       = array('Message-Job kopieren', 'Message-Job ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_msg_jobs']['delete']     = array('Message-Job löschen', 'Message-Job ID %s löschen');
$GLOBALS['TL_LANG']['tl_msg_jobs']['show']       = array('Details zum Message-Job', 'Details zum Message-Job ID %s');
$GLOBALS['TL_LANG']['tl_msg_jobs']['history']    = array('Historie', 'Historie des Message-Jobs ID %s');
$GLOBALS['TL_LANG']['tl_msg_jobs']['run']        = array('Starten', 'Message-Job ID %s starten');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_msg_jobs']['liste']     = 'LISTE: Eine Benachrichtigung mit Auflistung der Fundstellen';
$GLOBALS['TL_LANG']['tl_msg_jobs']['einzel']    = 'EINZELMAILS: Für jede Fundstelle eine einzelne Benachrichtigung senden';
 
$GLOBALS['TL_LANG']['tl_msg_jobs']['normal']    = 'Einfache Abfrage aus einer Datenbanktabelle';
$GLOBALS['TL_LANG']['tl_msg_jobs']['expert']    = 'Expertenabfrage (gute SQL-Kenntnisse erforderlich)';

$GLOBALS['TL_LANG']['tl_msg_jobs']['immer']     = 'immer ausführen';
$GLOBALS['TL_LANG']['tl_msg_jobs']['erfolg']    = 'nur nach erfolgreichen Benachrichtigugen ausführen';

$GLOBALS['TL_LANG']['tl_msg_jobs']['Komma']     = 'Komma';
$GLOBALS['TL_LANG']['tl_msg_jobs']['Semikolon'] = 'Semikolon';
$GLOBALS['TL_LANG']['tl_msg_jobs']['Tab']       = 'Tabulator';
$GLOBALS['TL_LANG']['tl_msg_jobs']['Pipe']      = 'Pipe';
$GLOBALS['TL_LANG']['tl_msg_jobs']['CRLF']      = 'Zeilenumbruch';


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_msg_jobs']['message_legend']  = 'Benachrichtigungs-Message-Job';
$GLOBALS['TL_LANG']['tl_msg_jobs']['config_legend']   = 'Datenbankabfrage';
$GLOBALS['TL_LANG']['tl_msg_jobs']['prepost_legend']  = 'Experteneinstellungen';
$GLOBALS['TL_LANG']['tl_msg_jobs']['send_legend']     = 'Versand';
$GLOBALS['TL_LANG']['tl_msg_jobs']['publish_legend']  = 'Aktivierung';
$GLOBALS['TL_LANG']['tl_msg_jobs']['notiz_legend']    = 'Randnotizen';
