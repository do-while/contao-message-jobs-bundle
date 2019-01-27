<?php

/**
 * Extension for Contao 4
 *
 * @copyright  Softleister 2018
 * @author     Softleister <info@softleister.de>
 * @package    contao-message-jobs-bundle
 * @licence    LGPL-3.0+
 */

namespace Softleister\Messagejobs;

//-----------------------------------------------------------------
//  runMessageJob:    Message-Job starten
//-----------------------------------------------------------------
class runMessageJob extends \Backend
{
	//-----------------------------------------------------------------------------------
    //  Job starten
    //-----------------------------------------------------------------------------------
    public function runJob( )
    {
        if( \Input::get('key') !== 'runJob' ) return '';           // Falscher Aufruf

        $db = \Database::getInstance();
        $objJob = $db->prepare("SELECT * FROM tl_msg_jobs WHERE id=?")
                     ->limit(1)
                     ->execute( \Input::get('id') );
        
        if( ($objJob->numRows < 1) || ($objJob->published != '1') ) return false;       // ID nicht vorhanden oder inaktiv
				
        $einzelmails = $objJob->einzel === 'einzel';         	// binary
		$expert = $objJob->sql_expert === 'expert';     		// binary
		$postbed = $objJob->postbed;
		if( !$expert ) $postbed = 'none';						// $postbed: immer | erfolg | none
				
		//  Permissions prüfen (todo)

        if( $expert ) {
            if( $objJob->sql_query == '' ) {
                return '';
            }

            $sqlpre   = $objJob->pre_on === '1' ? \StringUtil::decodeEntities($this->replaceInsertTags($objJob->sql_pre, false)) : '';
            $strQuery = \StringUtil::decodeEntities( $this->replaceInsertTags($objJob->sql_query, false) );
            $sqlpost  = $objJob->post_on === '1' ? \StringUtil::decodeEntities($this->replaceInsertTags($objJob->sql_post, false)) : '';
            $strWhere = $strOrder = '';
        }
        else {
            // Return if the table or the fields have not been set
            if( ($objJob->sql_table == '') || ($objJob->sql_fields == '') ) {
                return '';
            }

            $sqlpre = $sqlpost = '';				// nur im Experten-Modus
            $arrFields = \StringUtil::trimsplit(',', $objJob->sql_fields);
            $strWhere = $this->replaceInsertTags($objJob->sql_where, false);
            $strOrder = $this->replaceInsertTags($objJob->sql_sort, false);
    
            // Query aufbauen
            $strQuery  = "SELECT " . \Database::quoteIdentifier( 'id' ) . ", " . implode(', ', array_map('Database::quoteIdentifier', $arrFields));
            $strQuery .= " FROM " . \Database::quoteIdentifier( $objJob->sql_table );
            if( !empty($strWhere) ) $strQuery .= " WHERE (" .  $strWhere . ")";
            if( !empty($strOrder) ) $strQuery .= " ORDER BY " .  $strOrder;
        }

		if( $expert && !empty($sqlpre) ) {												// IF( SQL vor ausführung angegeben )
			$this->Database->execute( $sqlpre );										//   SQL-Pre ausführen			
		}																				// ENDIF

        // SQL-Abfrage
		$objDataStmt = $this->Database->prepare( $strQuery )->execute();				// SQL-Hauptabfrage ausführen
		if( ($postbed === 'erfolg') && ($objDataStmt->numRows < 1) ) {					// IF( kein Datensatz gefunden AND nur bei Erfolg)
			$postbed = 'none';															//   SQL-Post abschalten
		}																				// ENDIF

		// Auswertung, Aufbau der Tokenliste
        $arrTokens = array();
        $arrTokens['admin_email'] = \Config::get('adminEmail');

        $arrTokens['mjob_title']  = $objJob->title;										// Informations-Tokens
        $arrTokens['mjob_pre']    = $sqlpre ? $sqlpre : '';
        $arrTokens['mjob_query']  = $strQuery;
        $arrTokens['mjob_post']   = ($postbed !== 'none') && !empty($sqlpost) ? $sqlpost : '';
        $arrTokens['mjob_num']    = $objDataStmt->numRows;
		
		//==== Einzelne Benachrichtigungen erzeugen ===
		if( $einzelmails ) {														    // IF einzelne Mails je Fundstelle
			$backupTokens = $arrTokens;													//   Grundeinstellung der Tokens merken

			while( $objDataStmt->next() ) {												//   WHILE Abfrage-Ergebnisse in Tokens eintragen
				$arrTokens = array();													//     Tokens ohen Datensatz wieder herstellen
				$arrTokens = $backupTokens;

				// $result .= '<pre>' . print_r( $objDataStmt->row(), 1 ) . '</pre>';
				
				$arrFields = $objDataStmt->row();										//     Spalten in Array umwandeln
				foreach( $arrFields as $field=>$content ) {								//     FOREACH
					$arrTokens['mjob_' . $field] = $content;							//       Felder in Tokens eintragen
				}																		//     END FOREACH

				$arrTokens['mjob_post'] = str_replace( '##id##', $objDataStmt->id, $sqlpost );	//     Post-SQL aufbereiten

				// Benachrichtigungen senden
				if( class_exists('\NotificationCenter\Model\Notification') ) {
					$objNotification = \NotificationCenter\Model\Notification::findByPk( $objJob->nc_notification );	// gewünschte Benachrichtigung suchen
					if( null !== $objNotification ) {
						$objNotification->send( $arrTokens, $GLOBALS['TL_LANGUAGE'] );									// Benachrichtigung absenden

						// Notify the user
						\Message::addInfo("Benachrichtigung an '" . $arrTokens['mjob_email'] . "' versandt.");
						
						// Zum Abschluss einen Datenbankbefehl abarbeiten?
						if( ($postbed !== 'none') && !empty($arrTokens['mjob_post']) ) {	// IF( SQL-Post aktiv )
							$this->Database->execute( $arrTokens['mjob_post'] );
						}
						// Log-Entry
						$this->addLogEntry( $objJob, $objDataStmt, $strQuery, $arrTokens );
					}
					else {
						\System::log('No notification "msg_jobs_transmit" found!', __METHOD__, TL_EMAIL);
						return;
					}
				}
				else {
					\System::log('Notification Center not found!', __METHOD__, TL_EMAIL);
					return;
				}
			}																			//   END WHILE
		}
		
		//==== Eine zusammenfassende Benachrichtigung erzeugen ===
		else {																			// ELSE eine zusammengefaßte Mail
			// Abfrage-Listen in Tokens eintragen
			switch( $objJob->list_separator ) {											//   Trennzeichen setzen
				case 'Semikolon':	$separator = ';';	break;
				case 'Tab':			$separator = "\t";	break;
				case 'Pipe':		$separator = '|';	break;
				case 'CRLF':		$separator = "\n";	break;
				default:			$separator = ',';
			}

			$arrLists = array();														//   Listen leeren
			$count = 0;																	//   Zähler rücksetzen
			while( $objDataStmt->next() ) {												//   WHILE Datensätze
				$arrFields = $objDataStmt->row();										//     Spalten als Array
				foreach( $arrFields as $field=>$content ) {								//     FOREACH
					$arrTokens['mjob_' . $count . '_' . $field] = $content;				//       Felder als Token mit Datensatznummer
					$arrLists[$field][] = $content;										//       Felder in Listen sammeln
				}																		//     END FOREACH
				$count++;																//     Datensatzzähler erhöhen
			}																			//   END WHILE
			
			foreach( $arrLists as $field=>$content ) {									//   FOREACH Liste
				$arrTokens['mjob_list_' . $field] = implode( $separator, $content );	//     Sammeltoken erzeugen
			}																			//   END FOREACH

			$arrTokens['mjob_post'] = str_replace( '=##id##', ' IN(' . implode(',', $arrLists['id']) . ')', $sqlpost );		//     Post-SQL aufbereiten

			// Benachrichtigung senden
			if( class_exists('\NotificationCenter\Model\Notification') ) {
				$objNotification = \NotificationCenter\Model\Notification::findByPk( $objJob->nc_notification );	// Benachrichtigung suchen
				if (null !== $objNotification) {
					$objNotification->send( $arrTokens, $GLOBALS['TL_LANGUAGE'] );									// Benachrichtigung absenden
					$this->addLogEntry( $objJob, $objDataStmt, $strQuery, $arrTokens );

					// Zum Abschluss einen Datenbankbefehl abarbeiten?
					if( ($postbed !== 'none') && !empty($arrTokens['mjob_post']) ) {	// IF( SQL-Post aktiv )
						$this->Database->execute( $arrTokens['mjob_post'] );
					}

					// Log-Entry
					\Message::addInfo('Benachrichtigung versandt.');
				}
				else {
					\System::log('No notification "msg_jobs_transmit" found!', __METHOD__, TL_EMAIL);
					return;
				}
			}
			else {
				\System::log('Notification Center not found!', __METHOD__, TL_EMAIL);
				return;
			}
		}

		$arrUrl = trimsplit( '?', \Environment::get('request') );

		$this->redirect( $arrUrl[0] . '?do=msg_jobs' );
	}
    
    //-----------------------------------------------------------------
	public function addLogEntry( $jobdata, $data, $query, $arrTok )
	{
		$arrSet = array();
		$arrSet['tstamp']		= time();
		$arrSet['pid']          = $jobdata->id;
		$arrSet['member']       = \BackendUser::getInstance()->id;
		$arrSet['einzel']       = $jobdata->einzel;
		$arrSet['notification'] = $jobdata->nc_notification;
		$arrSet['email']        = $arrSet['einzel'] === 'liste' ? '' : $data->email;
		$arrSet['sql_pre']      = $arrTok['mjob_pre'];
		$arrSet['sql_query']    = $query;
		$arrSet['sql_post']     = $arrTok['mjob_post'];
		$arrSet['num']          = $arrTok['mjob_num'];

		$this->Database->prepare("INSERT INTO tl_msg_log %s")->set( $arrSet )->execute();
	}
	
    //-----------------------------------------------------------------
}
