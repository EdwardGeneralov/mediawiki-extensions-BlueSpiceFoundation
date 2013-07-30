<?php
/**
 * Description of HTMLMultiSelectSortList
 *
 * @author Patric Wirth <wirth@hallowelt.biz>
 */
class HTMLMultiSelectSortList extends HTMLMultiSelectEx {

	function getInputHTML( $value ) {
		
		$aValidated = $this->reValidate($value, $this->mParams['options']);
		
		$aOptions = array();
		foreach( $aValidated as $aOption ) {
			$aOptions[] = $aOption['key'];
		}
		
		$html = $this->formatOptions( $aOptions, $value, 'multiselectsort' );
		$sHTMLList = '<ul class="multiselectsortlist">';
		
		foreach( $aValidated as $aOption ) {
			$sHTMLList .= '<li class="multiselectsortlistitem" data-value="'.$aOption['key'].'">'.$aOption['title'].'</li>';
		}
		
		$sHTMLList .= '</ul>';

		return $sHTMLList.$html;
	}
	
	
	private function reValidate( $value, $aOptions) {
		$aValidated = array();
		
		foreach( $value as $sValue ) {
			if( isset($aOptions[$sValue]) ) {
				$aValidated[] = array('key' => $sValue, 'title' => $aOptions[$sValue]);
				unset($aOptions[$sValue]);
			}
		}
		
		if(!empty($aOptions)) {
			foreach( $aOptions as $key => $sOption ) {
				$aValidated[] = array('key' => $key, 'title' => $sOption);
			}
		}
		
		return $aValidated;
	}

}