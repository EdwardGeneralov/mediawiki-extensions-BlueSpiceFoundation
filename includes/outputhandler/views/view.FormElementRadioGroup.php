<?php
/**
 * This file is part of BlueSpice MediaWiki.
 *
 * @abstract
 * @copyright Copyright (C) 2016 Hallo Welt! GmbH, All rights reserved.
 * @author Markus Glaser, Sebastian Ulbricht
 *
 * $LastChangedDate: 2010-07-18 01:13:04 +0200 (So, 18 Jul 2010) $
 * $LastChangedBy: mglaser $
 * $Rev: 314 $

 */

// Last review MRG20100816

// TODO MRG20100816: Man sollte in CheckboxGroup hinterlegen (per Kommentar), dass das auch die Basis von RadioGroup ist.
class ViewFormElementRadioGroup extends ViewFormElementCommonGroup {
	public function addItem($label, $value = false, $state = false) {
		$item = new ViewFormElementRadiobutton();
		$item->setLabel($label);
		$item->setValue($value);
		$item->setChecked($state);
		$item->setName($this->_mName);
		parent::addItem($item);
		return $item;
	}
}
