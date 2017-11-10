<?php

namespace BlueSpice\Data\Settings;

use \BlueSpice\Data\IPrimaryDataProvider;

class PrimaryDataProvider implements IPrimaryDataProvider {

	/**
	 *
	 * @var \BlueSpice\Data\Record[]
	 */
	protected $data = [];

	/**
	 *
	 * @var \Wikimedia\Rdbms\IDatabase
	 */
	protected $db = null;

	/**
	 *
	 * @param \Wikimedia\Rdbms\IDatabase $db
	 */
	public function __construct( $db ) {
		$this->db = $db;
	}

	/**
	 *
	 * @param string $query
	 * @param type $preFilters
	 */
	public function makeData( $query = '', $preFilters = [] ) {
		$res = $this->db->select( 'bs_settings3', '*' );

		$this->data = [];
		foreach( $res as $row ) {
			$this->appendRowToData( $row );
		}

		return $this->data;
	}

	protected function appendRowToData( $row ) {
		$this->data[] = new Record( (object) [
			Record::NAME => $row->s_name,
			Record::VALUE => \FormatJson::decode( $row->s_value )
		]);
	}
}