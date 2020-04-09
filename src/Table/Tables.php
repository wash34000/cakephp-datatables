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
declare(strict_types = 1);

namespace DataTables\Table;

use Cake\Error\FatalErrorException;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use DataTables\Tools\Tools;

abstract class Tables {

	/**
	 * The database table name that will be used to load the DataTables ORM table.
	 *
	 * @var string
	 */
	protected $_ormTableName;

	/**
	 * @var \Cake\ORM\Table
	 */
	private $_ormTable;

	public function __construct() {
		$className = get_called_class();
		$classShortName = explode('\\', get_called_class());
		$classShortName = array_pop($classShortName);
		if (substr($classShortName, -6, 6) !== 'Tables') {
			throw new FatalErrorException("The class '$className' must have the name ending with 'Tables'");
		}
		if (empty($this->_ormTableName)) {
			$this->_ormTableName = substr_replace($classShortName, '', -6, 6);
		}
		$this->_ormTable = TableRegistry::getTableLocator()->get($this->_ormTableName);
	}

	/**
	 * @return \Cake\ORM\Table
	 */
	public function getOrmTable(): Table {
		return $this->_ormTable;
	}

}
