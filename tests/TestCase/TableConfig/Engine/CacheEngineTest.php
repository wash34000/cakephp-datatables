<?php
/**
 * Copyright (c) Allan Carvalho 2019.
 * Under Mit License
 * php version 7.2
 *
 * @category CakePHP
 * @package  DataRenderer\Core
 * @author   Allan Carvalho <allan.m.carvalho@outlook.com>
 * @license  MIT License https://github.com/allanmcarvalho/cakephp-data-renderer/blob/master/LICENSE
 * @link     https://github.com/allanmcarvalho/cakephp-data-renderer
 */

namespace DataTables\Test\TestCase\TableConfig\Engine;

use Cake\TestSuite\TestCase;
use DataTables\TableConfig\Engine\CacheEngine;
use DataTables\TableConfig\TableConfig;

class CacheEngineTest extends TestCase {

	/**
	 * @var string|null
	 */
	private $randomKeyName = null;

	/**
	 * CacheEngineTest constructor.
	 *
	 * @param string|null $name
	 * @param array $data
	 * @param string $dataName
	 */
	public function __construct($name = null, array $data = [], $dataName = '') {
		parent::__construct($name, $data, $dataName);
		$this->randomKeyName = str_pad(rand(0, 99999), 5, 0, STR_PAD_LEFT);
	}

	/**
	 * @return void
	 */
	public function testSave() {
		$cacheEngine = new CacheEngine();
		$tableConfig = new TableConfig();
		$tableConfig->setConfigName($this->randomKeyName);
		$this->assertEquals(true, $cacheEngine->save($tableConfig));
	}

	/**
	 * @return void
	 */
	public function testCheck() {
		$cacheEngine = new CacheEngine();
	    $tableConfig = new TableConfig();
	    $tableConfig->setConfigName($this->randomKeyName);
		$cacheEngine->save($tableConfig);
		$this->assertEquals(true, $cacheEngine->exists($this->randomKeyName));
	}

	/**
	 * @return void
	 */
	public function testRead() {
		$cacheEngine = new CacheEngine();
	    $tableConfig = new TableConfig();
	    $tableConfig->setConfigName($this->randomKeyName);
		$cacheEngine->save($tableConfig);
		$this->assertInstanceOf(TableConfig::class, $cacheEngine->read($this->randomKeyName));
	}

	/**
	 * @return void
	 */
	public function testDelete() {
		$cacheEngine = new CacheEngine();
		$tableConfig = new TableConfig();
		$tableConfig->setConfigName($this->randomKeyName);
		$cacheEngine->save($tableConfig);
		$exist = $cacheEngine->exists($this->randomKeyName);
		$deleted = $cacheEngine->delete($this->randomKeyName);
		$this->assertEquals($exist, $deleted);
	}

}
