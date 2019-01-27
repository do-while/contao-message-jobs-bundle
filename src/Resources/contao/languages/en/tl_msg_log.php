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
$GLOBALS['TL_LANG']['tl_msg_log']['tstamp']       = array('Timestamp', 'Time of notification');
$GLOBALS['TL_LANG']['tl_msg_log']['pid']          = array('Message job', 'ID of message job');
$GLOBALS['TL_LANG']['tl_msg_log']['member']       = array('Backend user', 'User who started the message job');
$GLOBALS['TL_LANG']['tl_msg_log']['einzel']       = array('Single', 'Single notifications or as a list.');
$GLOBALS['TL_LANG']['tl_msg_log']['notification'] = array('Notification', 'Triggered notification');
$GLOBALS['TL_LANG']['tl_msg_log']['email']        = array('Target email', 'E-mail address to which the notification was sent');
$GLOBALS['TL_LANG']['tl_msg_log']['sql_pre']      = array('SQL before the query', 'The SQL command was executed before the query SQL.');
$GLOBALS['TL_LANG']['tl_msg_log']['sql_query']    = array('SQL query', 'SQL query to fetch the data');
$GLOBALS['TL_LANG']['tl_msg_log']['sql_post']     = array('SQL after the query', 'The SQL command was executed as a completion');
$GLOBALS['TL_LANG']['tl_msg_log']['num']          = array('Number of occurrences', 'Number of occurrences');
