<?php
namespace Tiny\Db;

class Pdo extends \PDO
{
    /**
     * Define the default fetch mode
     * @var int
     */
    protected $defaultFetchMode = \PDO::FETCH_OBJ;

    /**
     * Constructor
     *
     * @param string $dsn
     * @param string $username
     * @param string $password
     * @param string $options
     */
    public function __construct($dsn, $username = null, $password = null, array $options = null)
    {
        // default driver options
        if (null === $options) {
            $options = array(
                // persistent connection
                \PDO::ATTR_PERSISTENT       => true,
                // Return the number of found (matched) rows, not the number of changed rows
                \PDO::MYSQL_ATTR_FOUND_ROWS => true
            );
        }

        // parent's constructor
        parent::__construct($dsn, $username, $password, $options);

        /**
         * Currently, it can't be used with persistent \PDO instances
         * @todo
         */
        // $this->setAttribute(\PDO::ATTR_STATEMENT_CLASS, array('Ebd\Db\PDOStatment', array()));

        // set the default error mode
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // set the default fetch mode
        $this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, $this->defaultFetchMode);
    }

    /**
     * Override the parent method
     *
     * Return the number of found (matched) rows, not the number of changed rows
     * or FALSE on failure
     *
     * @param string $sql
     * @return int|false
     */
    public function exec($sql)
    {
        // Only pass the simple sql, don't have other parameters
        if (1 === func_num_args()) {
            // Return the number of found (matched) rows, not the number of changed rows,
            // or FALSE on failure
            return parent::exec($sql);
        } // Also pass some parameters
        else {
            $stmt = call_user_func_array(array($this, 'prepareParams'), func_get_args());
            if (!$stmt) {
                return false;
            }
        }

        // Return the number of found (matched) rows, not the number of changed rows
        return $stmt->rowCount();
    }

    /**
     * Return a single string
     *
     * @param string $sql
     * @return string|false
     * @example
     *  Pdo::getOne($sql)
     *  Pdo::getOne($sql, array($first, $second));
     *  Pdo::getOne($sql, array('key1' => $first, 'key2' => $second)
     *  Pdo::getOne($sql, $first, $second, $third);
     */
    public function getOne($sql)
    {
        // Only pass the simple sql, don't have other parameters
        if (1 === func_num_args()) {
            // \PDO::query() returns a \PDOStatement object, or FALSE on failure.
            $stmt = $this->query($sql);
            if (false === $stmt) {
                return false;
            }
        } // Also pass some parameters
        else {
            $stmt = call_user_func_array(array($this, 'prepareParams'), func_get_args());
            if (!$stmt) {
                return false;
            }
        }

        // fetch & return
        $value = $stmt->fetchColumn();
        $stmt->closeCursor();
        return $value;
    }

    /**
     * Return a row
     *
     * @param string $sql
     * @return array|false
     * @example
     *  Pdo::getRow($sql)
     *  Pdo::getRow($sql, array($first, $second));
     *  Pdo::getRow($sql, array('key1' => $first, 'key2' => $second)
     *  Pdo::getRow($sql, $first, $second, $third);
     */
    public function getRow($sql, $args = null)
    {
        // Only pass the simple sql, don't have other parameters
        if (1 === func_num_args()) {
            // \PDO::query() returns a \PDOStatement object, or FALSE on failure.
            $stmt = $this->query($sql);
            if (false === $stmt) {
                return false;
            }
        } // Also pass some parameters
        else {
            $stmt = call_user_func_array(array($this, 'prepareParams'), func_get_args());
            if (!$stmt) {
                return false;
            }
        }

        // fetch & return
        $row = $stmt->fetch();
        $stmt->closeCursor();
        return $row;
    }

    /**
     * Return all rows
     *
     * @param string $sql
     * @return array
     * @example
     *  Pdo::getAll($sql)
     *  Pdo::getAll($sql, array($first, $second));
     *  Pdo::getAll($sql, array('key1' => $first, 'key2' => $second)
     *  Pdo::getAll($sql, $first, $second, $third);
     */
    public function getAll($sql, $args = null)
    {
        // Only pass the simple sql, don't have other parameters
        if (1 === func_num_args()) {
            // \PDO::query() returns a \PDOStatement object, or FALSE on failure.
            $stmt = $this->query($sql);
            if (false === $stmt) {
                return false;
            }
        } // Also pass some parameters
        else {
            $stmt = call_user_func_array(array($this, 'prepareParams'), func_get_args());
            if (!$stmt) {
                return false;
            }
        }

        // fetch & return
        return $stmt->fetchAll();
    }

    /**
     * Return the key&value pair array
     *
     * @param string $sql
     * @return array
     * @example
     *  Pdo::getPairs($sql)
     *  Pdo::getPairs($sql, array($first, $second));
     *  Pdo::getPairs($sql, array('key1' => $first, 'key2' => $second)
     *  Pdo::getPairs($sql, $first, $second, $third);
     */
    public function getPairs($sql)
    {
        // Only pass the simple sql, don't have other parameters
        if (1 === func_num_args()) {
            // \PDO::query() returns a \PDOStatement object, or FALSE on failure.
            $stmt = $this->query($sql);
            if (false === $stmt) {
                return false;
            }
        } // Also pass some parameters
        else {
            $stmt = call_user_func_array(array($this, 'prepareParams'), func_get_args());
            if (!$stmt) {
                return false;
            }
        }

        // fetch & return
        return $stmt->fetchAll(\PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }

    /**
     * Return the first column data
     *
     * @param string $sql
     * @return array
     * @example
     *  Pdo::getColumn($sql)
     *  Pdo::getColumn($sql, array($first, $second));
     *  Pdo::getColumn($sql, array('key1' => $first, 'key2' => $second)
     *  Pdo::getColumn($sql, $first, $second, $third);
     */
    public function getColumn($sql)
    {
        // Only pass the simple sql, don't have other parameters
        if (1 === func_num_args()) {
            // \PDO::query() returns a \PDOStatement object, or FALSE on failure.
            $stmt = $this->query($sql);
            if (false === $stmt) {
                return false;
            }
        } // Also pass some parameters
        else {
            $stmt = call_user_func_array(array($this, 'prepareParams'), func_get_args());
            if (!$stmt) {
                return false;
            }
        }

        // fetch & return
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Prepare a SQL and execute it
     * It will return FALSE on failure
     *
     * @param string $sql
     * @param mixed $params Maybe it is an array, stdClass, ArrayObject and so on
     * @return \PDOStatement|false
     */
    protected function prepareParams($sql, $params)
    {
        // like: prepareParams($sql, $param1, $param2, $param3)
        if (is_scalar($params) || null === $params) {
            $params = func_get_args();
            array_shift($params);
        }

        // prepare & execute
        $stmt = $this->prepare($sql);
        if (!$stmt->execute((array)$params)) {
            return false;
        }

        // return
        return $stmt;
    }
}