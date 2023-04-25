<?php
namespace App\Models;

use PDO;
use stdClass;
use System\Database\DB;

class User
{

	/** @var PDO */
	protected PDO $connection;

	/**
	 * Constructor class
	 * Buat koneksi database menggunakan class DB
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->connection = DB::connect();
	}

	/**
	 * Mengambil data user berdasarkan kolum yang di tentukan
	 *
	 * @param string $column
	 * @param string $value
	 * @return stdClass|null
	 */
	public function getUserByColumn(string $column, string $value) : ?stdClass
	{
		$statement = $this->connection->prepare("SELECT * FROM users WHERE $column = ?");
		$statement->execute([$value]);

		if ($statement->rowCount() <= 0) {
			return null;
		}

		return $statement->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Buat sebuah user baru.
	 *
	 * @param array $attributes attributes berupa array assosiatif yang mereprentasikan kolum dan nilainya
	 *
	 * @return object|false
	 */
	public function create(array $attributes) : object|false
	{
		$columnString      = rtrim(implode(', ', array_keys($attributes)), ',');
		$columnPlaceholder = ':' . rtrim(implode(', :', array_keys($attributes)), ',');
		$querySQL          = 'INSERT INTO users (' . $columnString . ')' . ' VALUES (' . $columnPlaceholder . ')';

		// prepare sql
		$stmt = $this->connection->prepare($querySQL);

		if ($stmt->execute($attributes)) {
			return (object) $attributes;
		}

		return false;
	}

	/**
	 * Hapus data user berdasarkan ID
	 *
	 * @param int $id
	 *
	 * @return bool
	 */
	public function delete(int $id) : bool
	{
		$result = $this->connection->query('SELECT id FROM users')->rowCount();

		if ($result <= 1) {
			return false;
		}

		$stmt = $this->connection->prepare('DELETE FROM users WHERE id = ?')->execute([$id]);
		return $stmt;
	}

	/**
	 * Perbaharui User
	 *
	 * @param int $id target ID users
	 * @param array $attributes attributes berupa array assosiatif yang mereprentasikan kolum dan nilainya
	 * @return stdClass|false
	 */
	public function update(int $id, array $attributes) : stdClass|false
	{
		// generate column placeholder
		$generatePlaceholder = function (array $attributes) {
			$columnPlaceholder = '';
			foreach ($attributes as $index => $column) {
				if ($index === 0) {
					$columnPlaceholder = 'SET ' . $column . ' = :' . $column;
					continue;
				}
				$columnPlaceholder .= ', ' . $column . ' = :' . $column;
			}
			return $columnPlaceholder;
		};

		$result = $this->getUserByColumn('id', $id);
		if ($result === null) {
			return false;
		}

		$columnPlaceholder = $generatePlaceholder(array_keys($attributes));
		$values            = array_merge($attributes, ['id' => $id]);
		$querySQL          = 'UPDATE users ' . $columnPlaceholder . ' WHERE id = :id';
		$stmt              = $this->connection->prepare($querySQL);

		if ($stmt->execute($values)) {
			return (object) $values;
		}

		return false;
	}

	/**
	 * Mengembalikan data user berdasarkan ID tertentu
	 *
	 * @param int $id
	 * @return stdClass|null
	 */
	public function findById(int $id) : ?stdClass
	{
		return $this->getUserByColumn('id', $id);
	}

	/**
	 * Tampilkan semua data user
	 *
	 * @param int $limit jumlah user yang ingin di tampilkan
	 * @return array|null
	 */
	public function findAll(int $limit = 100) : ?array
	{
		$querySQL = "SELECT * FROM users ORDER BY id DESC LIMIT {$limit}";
		$stmt     = $this->connection->query($querySQL);
		$result   = $stmt->fetchAll(PDO::FETCH_OBJ);

		if (count($result) > 0) {
			return $result;
		}

		return null;
	}
}
