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
 * Table tl_msg_jobs
 */
$GLOBALS['TL_DCA']['tl_msg_jobs'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ctable'                      => 'tl_msg_log',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
			'flag'                    => 1,
            'fields'                  => array('title'),
			'panelLayout'             => 'filter;sort,search,limit',
        ),
        'label' => array
        (
            'fields'                  => array('title'),
            'format'                  => '<span style="display:inline-block;width:350px">%s</span> <span style="display:inline-block;width:200px;color:#aaa"></span>',
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
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_msg_jobs']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'edit.svg',
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_msg_jobs']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.svg',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_msg_jobs']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSG']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
            'toggle' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_msg_jobs']['toggle'],
                'icon'                => 'visible.svg',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('tl_msg_jobs', 'toggleIcon')
            ),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_msg_jobs']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			),
			'history' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_msg_jobs']['history'],
                'href'                => 'table=tl_msg_log',
                'icon'                => 'bundles/softleistermessagejobs/history.svg'
			),
            'run' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_msg_jobs']['run'],
                'href'                => 'key=runJob',
                'icon'                => 'bundles/softleistermessagejobs/start.svg'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
		'__selector__'                => array('protocol', 'sql_expert', 'pre_on', 'post_on'),

        'default'                     => '{message_legend},title,alias,einzel,list_separator;'
                                        .'{config_legend},sql_expert,sql_table,sql_fields,sql_where,sql_sort;'
                                        .'{send_legend},nc_notification,published;'
                                        .'{notiz_legend},notiz;',

        'expert'                      => '{message_legend},title,alias,einzel,list_separator;'
                                        .'{prepost_legend},sql_expert,pre_on,sql_query,post_on;'
                                        .'{send_legend},nc_notification,published;'
                                        .'{notiz_legend},notiz;'
    ),

	// Subpalettes
	'subpalettes' => array
	(
		'protocol'                   => 'singleSRC',
        'pre_on'                     => 'sql_pre',
        'post_on'                    => 'sql_post,postbed'
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
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'sorting'                 => true,
            'eval'                    => array('mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['alias'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
 			'save_callback' => array
			(
				array('tl_msg_jobs', 'generateAlias')
			),
			'sql'                     => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
		),
        'einzel' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['einzelmail'],
            'exclude'                 => true,
            'default'                 => 'liste',
            'inputType'               => 'radio',
            'options'                 => array('einzel', 'liste'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_msg_jobs'],
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(8) NOT NULL default ''"
        ),
        'list_separator' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['list_separator'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array('Komma', 'Semikolon', 'Tab', 'Pipe', 'CRLF'),
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_msg_jobs'],
            'sql'                     => "varchar(12) NOT NULL default ''"
        ),
        //-------
        'sql_expert' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_expert'],
            'exclude'                 => true,
            'default'                 => 'normal',
            'inputType'               => 'select',
            'options'                 => array('normal', 'expert'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_msg_jobs'],
            'eval'                    => array('tl_class'=>'w50', 'submitOnChange'=>true),
            'sql'                     => "varchar(8) NOT NULL default ''"
        ),
        'sql_table' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_table'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_msg_jobs', 'getAllTables'),
            'eval'                    => array('chosen'=>true, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'sql_fields' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_fields'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'sql_where' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_where'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('preserveTags'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'sql_sort' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_sort'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'sql_query' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_query'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>true, 'style'=>'height:60px', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
        ),
//-------
		'pre_on' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['pre_on'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'clr w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
        'sql_pre' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_pre'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
			'eval'                    => array('style'=>'height:60px', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
        ),
//-------
		'post_on' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['post_on'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
        'sql_post' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['sql_post'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
			'eval'                    => array('style'=>'height:60px', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
        ),
        'postbed' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['postbed'],
            'exclude'                 => true,
            'default'                 => 'immer',
            'inputType'               => 'select',
            'options'                 => array('immer', 'erfolg'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_msg_jobs'],
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(8) NOT NULL default ''"
        ),
//-------        
        'nc_notification' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['nc_notification'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_msg_jobs', 'getNotificationChoices'),
            'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'clr w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'m12 w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
//-------        
		'notiz' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_msg_jobs']['notiz'],
			'exclude'                 => true,
			'search'                  => true,
			'flag'                    => 1,
			'inputType'               => 'textarea',
			'eval'                    => array('maxlength'=>255),
			'sql'                     => "text NULL"
		),
    )
);


/**
 * Class tl_msg_jobs
 */
class tl_msg_jobs extends Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    //-----------------------------------------------------------------
    //    Veröffentlichung umschalten
    //-----------------------------------------------------------------
    public function toggleIcon( $row, $href, $label, $title, $icon, $attributes )
    {
        if( strlen(Input::get('tid')) ) {
            $this->toggleVisibility( Input::get('tid'), (Input::get('state') == 1) );
            $this->redirect( $this->getReferer() );
        }

        $href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

        if( !$row['published'] ) {
            $icon = 'invisible.svg';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
    }


    //-----------------------------------------------------------------
    //    Veröffentlichung umschalten
    //-----------------------------------------------------------------
    public function toggleVisibility( $intId, $blnVisible )
    {
        $objVersions = new Versions( 'tl_msg_jobs', $intId );
        $objVersions->initialize( );

        // Trigger the save_callback
        if( is_array($GLOBALS['TL_DCA']['tl_msg_jobs']['fields']['published']['save_callback']) ) {
            foreach( $GLOBALS['TL_DCA']['tl_msg_jobs']['fields']['published']['save_callback'] as $callback ) {
                if( is_array( $callback ) ) {
                    $this->import( $callback[0] );
                    $blnVisible = $this->$callback[0]->$callback[1]( $blnVisible, $this );
                }
                else if( is_callable( $callback ) ) {
                    $blnVisible = $callback( $blnVisible, $this );
                }
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_msg_jobs SET tstamp=". time() .", published='" . $blnVisible . "' WHERE id=?")->execute( $intId );

        $objVersions->create();
        $this->log( 'A new version of record "tl_msg_jobs.id='.$intId.'" has been created'.$this->getParentEntries('tl_msg_jobs', $intId ), __METHOD__, TL_GENERAL);
    }


    //-----------------------------------------------------------------
	/**
	 * Auto-generate an article alias if it has not been set yet
	 *
	 * @param mixed         $varValue
	 * @param DataContainer $dc
	 *
	 * @return string
	 *
	 * @throws Exception
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate an alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = StringUtil::generateAlias($dc->activeRecord->title);
		}

		// Add a prefix to reserved names (see #6066)
		if (\in_array($varValue, array('top', 'wrapper', 'header', 'container', 'main', 'left', 'right', 'footer')))
		{
			$varValue = 'msg-' . $varValue;
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_msg_jobs WHERE id=? OR alias=?")
								   ->execute($dc->id, $varValue);

		// Check whether the page alias exists
		if ($objAlias->numRows > 1)
		{
			if (!$autoAlias)
			{
				throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
			}

			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}

    //-----------------------------------------------------------------
	public function getAllTables()
	{
		return $this->Database->listTables();
	}

    //-----------------------------------------------------------------
    /**
     * Get notification choices
     *
     * @return array
     */
    public function getNotificationChoices()
    {
        $arrChoices = array();
        if( class_exists( 'NotificationCenter\tl_form' ) ) {
            $objNotifications = \Database::getInstance()->execute("SELECT id,title FROM tl_nc_notification WHERE type='msg_jobs_transmit' ORDER BY title");
    
            while ($objNotifications->next()) {
                $arrChoices[$objNotifications->id] = $objNotifications->title;
            }
        }
        return $arrChoices;
    }

    
    
//-----------------------------------------------------------------
}
