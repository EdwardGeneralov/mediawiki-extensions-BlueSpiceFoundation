<?php
/**
 * Special page for BsSpecialPage for MediaWiki
 *
 * Part of BlueSpice for MediaWiki
 *
 * @author     Stephan Muggli <muggli@hallowelt.biz>
 * @version    $Id: BsSpecialPage.class.php 9719 2013-06-13 08:32:52Z rvogel $
 * @package    BlueSpice_Extensions
 * @subpackage BlueSpice
 * @copyright  Copyright (C) 2013 Hallo Welt! - Medienwerkstatt GmbH, All rights reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License v2 or later
 * @filesource
 */

class BsSpecialPage extends SpecialPage {

	/**
	 * Constructor of BsSpecialPage class
	 */
	function __construct( $name = '', $restriction = '', $listed = true,
		$function = false, $file = 'default', $includable = false ) {
		parent::__construct( $name, $restriction, $listed, $function, $file, $includable );
	}

	/**
	 * Actually render the page content.
	 * @param string $sParameter URL parameters to special page.
	 * @return string Rendered HTML output.
	 */
	function execute( $sParameter ) {
		$this->setHeaders();
		$this->checkPermissions();
		$this->outputHeader();
	}

}