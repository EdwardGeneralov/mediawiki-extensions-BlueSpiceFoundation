<?php

/**
 * @group medium
 *
 * Class BSApiTitleQueryStoreTest
 */
class BSApiTitleQueryStoreTest extends BSApiExtJSStoreTestBase {
	protected function getStoreSchema() {
		return [
			'page_id' => [
				'type' => 'numeric'
			],
			'page_namespace' => [
				'type' => 'numeric'
			],
			'page_title' => [
				'type' => 'string'
			],
			'prefixedText' => [
				'type' => 'string'
			],
			'displayText' => [
				'type' => 'string'
			],
			'type' => [
				'type' => 'string'
			]
		];
	}

	protected function createStoreFixtureData() {
		$oPageFixtures = new BSPageFixturesProvider();
		$aFixtures = $oPageFixtures->getFixtureData();
		foreach( $aFixtures as $aFixture ) {
			$this->insertPage( $aFixture[0], $aFixture[1] );
		}
	}

	protected function getModuleName() {
		return 'bs-titlequery-store';
	}

	protected function makeRequestParams() {
		$aParams =  parent::makeRequestParams();
		$aParams['options'] = FormatJson::encode([
			'namespaces' => [ NS_MAIN, NS_TEMPLATE ]
		]);

		return $aParams;
	}

	public function provideSingleFilterData() {
		return [
			'Filter by page_id' => [ 'numeric', 'eq', 'page_id', -1, 0 ]
		];
	}

	public function provideMultipleFilterData() {
		return [
			'Filter by page_name and page_namespace' => [
				[

				],
				0
			]
		];
	}

}