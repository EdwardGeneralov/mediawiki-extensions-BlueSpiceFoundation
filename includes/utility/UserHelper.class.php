<?php

class BsUserHelper {

	/**
	 * Returns an array of user ids of users in the given group
	 * @param String $sRight
	 * @param Int $iLimit
	 * @param Int $iOffset
	 * @return array array of user ids
	 */
	public static function getUserIdsByRight( $sRight, $iLimit = 0, $iOffset = 0 ) {
		$aReturn = array();
		$aGroups = BsGroupHelper::getGroupsByRight( $sRight );
		if ( count( $aGroups ) < 1 ) {
			return $aReturn;
		}
		$oDBr = wfGetDB( DB_REPLICA );
		$aCond = array(
			'ug_group' => $aGroups
		);
		$aOptions = array();
		if ( $iLimit !== 0 ) {
			$aOptions ['LIMIT'] = $iLimit;
		}
		if ( $iOffset !== 0 ) {
			$aOptions ['OFFSET'] = $iOffset;
		}
		$oRes = $oDBr->select( 'user_groups', array( 'DISTINCT(ug_user)' ), $aCond, __METHOD__, $aOptions );
		if ( !$oRes ) {
			return $aReturn;
		}
		while ( $oRow = $oRes->fetchObject() ) {
			$aReturn [] = (int) $oRow->ug_user;
		}
		return $aReturn;
	}

	/**
	 * Returns the displayed name for the given user
	 * @param User $oUser
	 * @return mixed username, else false
	 */
	public static function getUserDisplayName( $oUser = null ) {
		if ( $oUser === null ) {
			$oUser = RequestContext::getMain()->getUser();
		}
		if ( !( $oUser instanceof User ) ) {
			return false;
		}
		$sRealname = $oUser->getRealName();
		if ( $sRealname ) {
			return $sRealname;
		} else {
			return $oUser->getName();
		}
	}

}
