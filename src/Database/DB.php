<?php
namespace System\Database;

use Config\Config;
use PDO;
use PDOException;
use stdClass;

class DB
{

	/** @var array<string> */
	protected $config;

	/** @var PDO */
	protected $connection;

	/**
	 * @var DB
	 */
	protected static $instance;

	/**
	 * Create instance DB
	 * @param array<string> $config
	 */
	public function __construct($config = null)
	{
		if (is_array($config)) {
			$this->setConfig($config);
		}
	}

	/**
	 * get configuration
	 *
	 * @param ?string $field
	 * @return \stdClass|null
	 */
	protected function getConfig($field = null)
	{
		$config = new stdClass();
		foreach ($this->config as $key => $value) {
			$config->$key = $value;
		}

		if (is_null($field)) {
			return $config;
		}

		return isset($config->$field) ? $config->$field : null;
	}


	/**
	 * set PDO connection
	 *
	 * @param PDO $connection
	 * @return void
	 */
	protected function setConnection($connection)
	{
		if ($connection instanceof PDO) {
			$this->connection = $connection;
		}
	}

	/**
	 * Test PDO connection
	 *
	 * @throws \PDOException
	 * @return void
	 */
	protected function testConnection()
	{
		$config = $this->getConfig();
		try {
			$pdo = new PDO("mysql:host=$config->host;dbname=$config->database;", $config->user, $config->password);
			$this->setConnection($pdo);

		}
		catch (PDOException $e) {
			throw new PDOException($e->getMessage(), $e->getCode(), $e->getPrevious());
		}
	}


	/**
	 * set configuration
	 *
	 * @param array<string> $config
	 * @return void
	 */
	protected function setConfig($config)
	{
		$this->config = $config;
	}

	/**
	 * get instance PDO connection
	 * @return PDO
	 */
	public function getConnection()
	{
		return $this->connection;
	}

	/**
	 * @param array<string>|null $config
	 * @throws PDOException
	 * @return PDO
	 */
	public static function connect($config = null)
	{
		$config = (is_null($config)) ? Config::$config['connection'] : $config;
		if (isset(self::$instance)) {
			return self::$instance->getConnection();
		} else {
			self::$instance = new self($config);
			try {
				self::$instance->testConnection();
				return self::$instance->getConnection();
			}
			catch (PDOException $e) {
				throw new PDOException($e->getMessage(), $e->getCode(), $e->getPrevious());
			}
		}
	}
}
