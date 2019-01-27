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
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['notification_center'], 100, array
(
    'msg_jobs' => array
    (
        'tables'      => array('tl_msg_jobs', 'tl_msg_log'),
    	'runJob'      => array('Softleister\Messagejobs\runMessageJob', 'runJob'),
    )
));


//-------------------------------------------------------------------
// Notification Center
//-------------------------------------------------------------------
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['msg_jobs'] = array
(
    'msg_jobs_transmit' => array(
            'recipients'            => array('admin_email', 'mjob_*'),      // Empfänger
            'email_subject'         => array('mjob_*', 'admin_email'),      // Betreff
            'email_text'            => array('mjob_*'),
            'email_html'            => array('mjob_*'),
            'file_name'             => array('mjob_*', 'admin_email'),
            'file_content'          => array('mjob_*', 'admin_email'),
            'email_recipient_cc'    => array('admin_email', 'mjob_*'),      // Kopie an
            'email_recipient_bcc'   => array('admin_email', 'mjob_*'),      // Blindkopie an
            'email_replyTo'         => array('admin_email', 'mjob_*'),      // Antwortadresse
            'attachment_tokens'     => array('mjob_*'),
    ),
);
