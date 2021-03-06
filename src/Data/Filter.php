<?php

namespace BlueSpice\Data;

abstract class Filter {
	const COMPARISON_EQUALS = 'eq';
	const COMPARISON_NOT_EQUALS = 'neq';

	const KEY_TYPE = 'type';
	const KEY_COMPARISON = 'comparison';
	const KEY_OPERATOR = 'operator';
	const KEY_FIELD = 'field';
	const KEY_PROPERTY = 'property';
	const KEY_VALUE = 'value';

	/**
	 *
	 * @var string
	 */
	protected $field = '';

	/**
	 *
	 * @var mixed
	 */
	protected $value = null;

	/**
	 *
	 * @var string
	 */
	protected $comparison = '';

	/**
	 *
	 * @var boolean
	 */
	protected $applied = false;

	/**
	 *
	 * @param array $params
	 */
	public function __construct( $params ) {
		$this->field = !isset( $params[self::KEY_FIELD] ) && isset( $params[self::KEY_PROPERTY] )
			? $params[self::KEY_PROPERTY]
			: $params[self::KEY_FIELD];
		$this->value = $params[self::KEY_VALUE];
		$this->comparison = $params[self::KEY_COMPARISON];
	}

	/**
	 *
	 * @return string
	 */
	public function getField() {
		return $this->field;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 *
	 * @return string
	 */
	public function getComparison() {
		return $this->comparison;
	}

	/**
	 *
	 * @param \BlueSpice\Data\Record $dataSet
	 * @return boolean
	 */
	public function matches( $dataSet ) {
		if( $this->applied ) {
			return true;
		}
		return $this->doesMatch( $dataSet );
	}

	/**
	 *
	 * @param boolean $applied
	 */
	public function setAppied( $applied = true ) {
		$this->applied = $applied;
	}

	/**
	 *
	 * @param stdClass[]|array[] $filters
	 * @return Filter[]
	 */
	public static function newCollectionFromArray( $filters ) {
		$filterObjects = [];
		foreach( $filters as $filter ) {
			if( is_object(  $filter ) ) {
				$filter = (array) $filter;
			}
			$filterObjects[] = static::makeFilter( $filter );
		}

		return $filterObjects;
	}

	protected static function makeFilter( $filter ) {
		return FilterFactory::newFromArray( $filter );
	}

	protected abstract function doesMatch( $dataSet );
}
