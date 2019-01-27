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
$GLOBALS['TL_LANG']['tl_msg_jobs']['title']           = array('Title of message job', 'Title of notification message job');
$GLOBALS['TL_LANG']['tl_msg_jobs']['alias']           = array('Alias', 'Unique ID for the message job. Leave the field empty to automatically generate the alias from the title.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['einzelmail']      = array('Notifications', 'You can send a LIST of references as a notification or one notification per occurrence.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['list_separator']  = array('Separator', 'Select the separator character when outputting the occurrences as a listing.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_expert']      = array('SQL input mode', 'Choose between a simple query of a table and the complex query option.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_query']       = array('SQL query command', 'Complete SQL command to query the data, The <strong>id</strong> should always be queried with!');
$GLOBALS['TL_LANG']['tl_msg_jobs']['published']       = array('Activate', 'The message job can only be started if it is activated.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['notiz']           = array('Memo', 'Remarks on the message job');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_table']       = array('Table', 'Please select the source table.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_fields']      = array('Fields', 'Please enter a comma-separated list of the fields you want to list.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_where']       = array('Condition', 'Here you can enter a condition to filter the results (e.g. <em>published=1</em> or <em>type!="admin"</em>).');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_sort']        = array('Order by', 'Here you can enter a comma-separated list of the fields by which the results are to be sorted.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['pre_on']          = array('Activating SQL Preprocessing', 'The SQL command is executed before the main query.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_pre']         = array('SQL command', 'Execute before query.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['post_on']         = array('Activating SQL Postprocessing', 'The SQL command is executed after the query and after the notifications.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_post']        = array('SQL command', 'Execute for each record after query and notification. <em>id=###id##</em> is replaced by the current ID, even for list notification.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['postbed']         = array('When to run?', 'Specify whether postprocessing should always be performed or only after successful notifications.');
$GLOBALS['TL_LANG']['tl_msg_jobs']['nc_notification'] = array('Notification', 'Select your notification from the Notification Center here.');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_msg_jobs']['new']        = array('New message job', 'Add a new notification message job');
$GLOBALS['TL_LANG']['tl_msg_jobs']['edit']       = array('Managing message jobs', 'Managing message job ID %s');
$GLOBALS['TL_LANG']['tl_msg_jobs']['editheader'] = array('Edit message job', 'Edit message job ID %s');
$GLOBALS['TL_LANG']['tl_msg_jobs']['copy']       = array('Copy message job', 'Copy message job ID %s');
$GLOBALS['TL_LANG']['tl_msg_jobs']['delete']     = array('Delete message job', 'Delete message job ID %s');
$GLOBALS['TL_LANG']['tl_msg_jobs']['show']       = array('Details of message job', 'Details of message job ID %s');
$GLOBALS['TL_LANG']['tl_msg_jobs']['history']    = array('History', 'History of message jobs ID %s');
$GLOBALS['TL_LANG']['tl_msg_jobs']['run']        = array('Start', 'Start message job ID %s');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_msg_jobs']['liste']     = 'LISTING: A notification with a list of occurrences found';
$GLOBALS['TL_LANG']['tl_msg_jobs']['einzel']    = 'SINGLE MAILS: Send a single notification for each occurrence';
 
$GLOBALS['TL_LANG']['tl_msg_jobs']['normal']    = 'Simple query from a database table';
$GLOBALS['TL_LANG']['tl_msg_jobs']['expert']    = 'Expert query (good SQL knowledge required)';

$GLOBALS['TL_LANG']['tl_msg_jobs']['immer']     = 'execute always';
$GLOBALS['TL_LANG']['tl_msg_jobs']['erfolg']    = 'Execute only after successful notifications';

$GLOBALS['TL_LANG']['tl_msg_jobs']['Komma']     = 'Comma';
$GLOBALS['TL_LANG']['tl_msg_jobs']['Semikolon'] = 'Semicolon';
$GLOBALS['TL_LANG']['tl_msg_jobs']['Tab']       = 'Tabulator';
$GLOBALS['TL_LANG']['tl_msg_jobs']['Pipe']      = 'Pipe';
$GLOBALS['TL_LANG']['tl_msg_jobs']['CRLF']      = 'Carriage return';


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_msg_jobs']['message_legend']  = 'Notification message job';
$GLOBALS['TL_LANG']['tl_msg_jobs']['config_legend']   = 'Database query';
$GLOBALS['TL_LANG']['tl_msg_jobs']['prepost_legend']  = 'Expert settings';
$GLOBALS['TL_LANG']['tl_msg_jobs']['send_legend']     = 'Send notification';
$GLOBALS['TL_LANG']['tl_msg_jobs']['publish_legend']  = 'Activation';
$GLOBALS['TL_LANG']['tl_msg_jobs']['notiz_legend']    = 'Side notes';
