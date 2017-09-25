<?php

namespace Admin\Model;

/**
 * 执行sql对象的一个规则
 * @package Admin\Model
 */
interface  DbMysqlInterfaceModel {
	/**
	 * DB connect
	 *
	 * @access public
	 *
	 * @return resource connection link
	 */
	public function connect();

	/**
	 * Disconnect from DB
	 *
	 * @access public
	 *
	 * @return viod
	 */
	public function disconnect();

	/**
	 * Free result
	 *
	 * @access public
	 * @param resource $result query resourse
	 *
	 * @return viod
	 */
	public function free($result);

	/**
	 * Execute simple query
	 *
	 * @access public
	 * @param string $sql SQL query
	 * @param array $args query arguments
	 *
	 * @return resource|bool query result
	 */
	public function query($sql, array $args = array());

	/**
	 * Insert query method
	 *
	 * @access public
	 * @param string $sql SQL query
	 * @param array $args query arguments
	 *
	 * @return int|false last insert id
	 */
	public function insert($sql, array $args = array());

	/**
	 * Update query method
	 *
	 * @access public
	 * @param string $sql SQL query
	 * @param array $args query arguments
	 *
	 * @return int|false affected rows
	 */
	public function update($sql, array $args = array());

	/**
	 * Get all query result rows as associated array
	 *
	 * @access public
	 * @param string $sql SQL query
	 * @param array $args query arguments
	 *
	 * @return array associated data array (two level array)
	 */
	public function getAll($sql, array $args = array());

	/**
	 * Get all query result rows as associated array with first field as row key
	 *
	 * @access public
	 * @param string $sql SQL query
	 * @param array $args query arguments
	 *
	 * @return array associated data array (two level array)
	 */
	public function getAssoc($sql, array $args = array());

	/**
	 * Get only first row from query
	 *
	 * @access public
	 * @param string $sql SQL query
	 * @param array $args query arguments
	 *
	 * @return array associated data array
	 */
	public function getRow($sql, array $args = array());

	/**
	 * Get first column of query result
	 *
	 * @access public
	 * @param string $sql SQL query
	 * @param array $args query arguments
	 *
	 * @return array one level data array
	 */
	public function getCol($sql, array $args = array());

	/**
	 * Get one first field value from query result
	 *
	 * @access public
	 * @param string $sql SQL query
	 * @param array $args query arguments
	 *
	 * @return string field value
	 */
	public function getOne($sql, array $args = array());
}
