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
 * Table tl_msg_log
 */
$GLOBALS['TL_DCA']['tl_msg_log'] = array
(

	// Config
	'config' => array
	(
        'dataContainer'               => 'Table',
        'ptable'                      => 'tl_msg_jobs',
		'closed'                      => true,
		'notEditable'                 => true,
		'notCopyable'                 => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list'  => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'flag'                    => 6,
			'fields'                  => array('tstamp DESC', 'id'),
			'panelLayout'             => 'filter;limit'
		),
		'label' => array
		(
			'fields'                  => array('tstamp', 'pid', 'member'),
			'format'                  => '<span style="color:#999;padding-right:3px">[%s]</span> %s %s',
			'label_callback'          => array('tl_msg_log', 'getlabel')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_msg_log']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_msg_log']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			)
		)
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['tstamp'],
			'filter'                  => true,
			'flag'                    => 6,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'pid' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['pid'],
			'filter'                  => true,
			'reference'               => &$GLOBALS['TL_LANG']['tl_msg_jobs'],
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'member' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['member'],
			'filter'                  => true,
			// 'inputType'               => 'select',
			'foreignKey'              => 'tl_user.name',
			'sorting'                 => true,
			'reference'               => &$GLOBALS['TL_LANG']['tl_member'],
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy')
		),
        'einzel' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['einzelmail'],
            'exclude'                 => true,
            'inputType'               => 'radio',
			'reference'               => &$GLOBALS['TL_LANG']['tl_msg_log'],
            'sql'                     => "varchar(8) NOT NULL default ''"
        ),
        'notification' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['notification'],
            'exclude'                 => true,
			'foreignKey'              => 'tl_nc_notification.title',
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
		'email' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['email'],
			'exclude'                 => true,
			'search'                  => true,
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'sql_pre' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['sql_pre'],
            'exclude'                 => true,
			'sql'                     => "text NULL"
        ),
        'sql_query' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['sql_query'],
            'exclude'                 => true,
			'sql'                     => "text NULL"
        ),
        'sql_post' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['sql_post'],
            'exclude'                 => true,
			'sql'                     => "text NULL"
        ),
		'num' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_log']['num'],
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
	)
);


class tl_msg_log extends Backend
{
	public function getlabel( $row, $label )
	{
		$result  = '<span style="color:#999;padding-right:3px;display:inline-block;width:145px">[' . date( $GLOBALS['TL_CONFIG']['datimFormat'], $row['tstamp']) . ']</span> ';
		$result .= '<span style="display:inline-block;width:180px">' . \UserModel::findById($row['member'])->username . '</span> ';
		if( $row['einzel'] ) {
			if( $row['email'] == '' ) {
			  	$result .= '1 Mail';
			}
			else {
			  	$result .= "Mail to '" . $row['email'] . "'";
			}
		}
		else {
			$result .= $row['num'] . ' Mail' . ($row['num'] != 1 ?: 's');
		}

		return '<div class="ellipsis">' . $result . '</div>';
	}
}
