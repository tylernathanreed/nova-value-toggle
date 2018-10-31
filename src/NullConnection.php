<?php

namespace NovaComponents\ValueToggle;

use Closure;
use Illuminate\Database\Connection;

class NullConnection extends Connection
{
    /**
     * Indicates if the connection is in a "dry run".
     *
     * @var boolean
     */
    protected $pretending = true;

    /**
     * Create a new database connection instance.
     *
     * @param  \PDO|\Closure  $pdo
     * @param  string         $database
     * @param  string         $tablePrefix
     * @param  array          $config
     *
     * @return void
     */
    public function __construct($pdo = null, $database = '', $tablePrefix = '', array $config = [])
    {
    	parent::__construct($pdo, $database, $tablePrefix, $config);
    }

    /**
     * Begin a fluent query against a database table.
     *
     * @param  string  $table
     *
     * @return \NovaComponents\ValueToggle\ToggleBuilder
     */
    public function table($table)
    {
    	return $this->query();
    }

    /**
     * Get a new query builder instance.
     *
     * @return \NovaComponents\ValueToggle\ToggleBuilder
     */
    public function query()
    {
        return new ToggleBuilder(
            $this, $this->getQueryGrammar(), $this->getPostProcessor()
        );
    }

    /**
     * Run a select statement and return a single result.
     *
     * @param  string   $query
     * @param  array    $bindings
     * @param  boolean  $useReadPdo
     *
     * @return mixed
     */
    public function selectOne($query, $bindings = [], $useReadPdo = true)
    {
    	return null;
    }

    /**
     * Run a select statement against the database.
     *
     * @param  string   $query
     * @param  array    $bindings
     * @param  boolean  $useReadPdo
     *
     * @return array
     */
    public function select($query, $bindings = [], $useReadPdo = true)
    {
    	return [];
    }

    /**
     * Run a select statement against the database and returns a generator.
     *
     * @param  string   $query
     * @param  array    $bindings
     * @param  boolean  $useReadPdo
     *
     * @return \Generator
     */
    public function cursor($query, $bindings = [], $useReadPdo = true)
    {
    	return null;
    }

    /**
     * Run an insert statement against the database.
     *
     * @param  string  $query
     * @param  array   $bindings
     *
     * @return boolean
     */
    public function insert($query, $bindings = [])
    {
    	return false;
    }

    /**
     * Run an update statement against the database.
     *
     * @param  string  $query
     * @param  array   $bindings
     *
     * @return integer
     */
    public function update($query, $bindings = [])
    {
    	return 0;
    }

    /**
     * Run a delete statement against the database.
     *
     * @param  string  $query
     * @param  array   $bindings
     *
     * @return integer
     */
    public function delete($query, $bindings = [])
    {
    	return 0;
    }

    /**
     * Execute an SQL statement and return the boolean result.
     *
     * @param  string  $query
     * @param  array   $bindings
     *
     * @return boolean
     */
    public function statement($query, $bindings = [])
    {
    	return false;
    }

    /**
     * Run an SQL statement and get the number of rows affected.
     *
     * @param  string  $query
     * @param  array   $bindings
     *
     * @return integer
     */
    public function affectingStatement($query, $bindings = [])
    {
    	return 0;
    }

    /**
     * Run a raw, unprepared query against the PDO connection.
     *
     * @param  string  $query
     *
     * @return boolean
     */
    public function unprepared($query)
    {
    	return false;
    }

    /**
     * Prepare the query bindings for execution.
     *
     * @param  array  $bindings
     *
     * @return array
     */
    public function prepareBindings(array $bindings)
    {
    	return parent::prepareBindings($bindings);
    }

    /**
     * Execute a Closure within a transaction.
     *
     * @param  \Closure  $callback
     * @param  integer   $attempts
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function transaction(Closure $callback, $attempts = 1)
    {
    	return null;
    }

    /**
     * Start a new database transaction.
     *
     * @return void
     */
    public function beginTransaction()
    {
    	return;
    }

    /**
     * Commit the active database transaction.
     *
     * @return void
     */
    public function commit()
    {
    	return;
    }

    /**
     * Rollback the active database transaction.
     *
     * @return void
     */
    public function rollBack()
    {
    	return;
    }

    /**
     * Get the number of active transactions.
     *
     * @return integer
     */
    public function transactionLevel()
    {
    	return 0;
    }

    /**
     * Execute the given callback in "dry run" mode.
     *
     * @param  \Closure  $callback
     *
     * @return array
     */
    public function pretend(Closure $callback)
    {
    	return [];
    }
}