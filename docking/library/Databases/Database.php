<?php

namespace Library\Databases;

/**
 * The base Database class -- this must be extended.
 * <pre>
 *     $db = new db('localhost', 'root', 'mysupersecretpassword');
 *     $db->query_result("SELECT field FROM database WHERE name = %s", 'my name');
 * </pre>
 * @abstract
 */
abstract class Database
{
    /**
     * Link ID
     */
    public $link_id = 0;

    //public $queries = array();

    public $debug = false;

    protected $__server;
    protected $__user;
    protected $__pass;
    protected $__pconnect;
    protected $__database;

    /**
     * Class constructor
     * <pre>
     *     $db = new db('localhost', 'root', 'mysupersecretpassword');
     * </pre>
     *
     * @param string $server MySQL host or path.
     * @param string $username Username.
     * @param string $password Password.
     * @param boolean $pconnect Use persistent connections.
     * @param string $database Database name.
     */
    function __construct($server, $username, $password='', $pconnect=false, $database='')
    {
        $this->__server = $server;
        $this->__username = $username;
        $this->__password = $password;
        $this->__pconnect = $pconnect;
        $this->__database = $database;
    }

    function get_server()
    {
        return $this->__server;
    }

    /**
     * Connect to the MySQL Server.
     *
     * @abstract
     * @return boolean
     */
    function connect($force=false)
    {
        if ($this->link_id && !$force) return true;
    }

    /**
     * Selects the Database
     *
     * @abstract
     * @param string $database
     * @return boolean
     */
    function select_db($database)
    {
        if (!$this->link_id) return false;

        $this->__database = $database;
        return true;
    }

    /**
     * @abstract
     */
    function execute($sql)
    {
        if (!$this->link_id)
            $this->connect();
    }

    /**
     * Queries the SQL server. Allows you to use sprintf-like
     * format and automatically escapes variables.
     * <pre>
     *    $db->query('SELECT %s FROM %s WHERE myfield = %s, 'field_name', 'table_name', 5);
     * </pre>
     *
     * @param string $string
     * @param {string | integer} $param1 first parameter
     * @param {string | integer} $param2 second parameter
     * @param {string | integer} $param3 ...
     * @return unknown Resource ID
     */
    function query($string, $params=null)
    {
        if (!is_array($params))
        {
            $params = func_get_args();
            $params = array_slice($params, 1);
        }
        if (count($params))
        {
            foreach ($params as $key=>$value)
            {
                $params[$key] = $this->prepare_param($value);
            }
            $string = vsprintf($string, $params) or $this->error('Invalid sprintf: ' . $string ."\n".'Arguments: '. implode(', ', $params));
        }
        $timing = microtime(true);
        $id = $this->execute($string, $this->link_id);
        $timing = (int)((microtime(true)-$timing)*1000);

        $this->lastquery = $string;
        //$this->queries[] = array($timing, $string);

        return $id;
    }

    /**
     * Internal handler for parameters. Returns an
     * escaped parameter.
     *
     * @param {string | integer} $param
     * @return {string | integer} Escaped parameter.
     */
    function prepare_param($param)
    {
        if ($param === null) return 'NULL';
        elseif (is_integer($param)) return $param;
        elseif (is_bool($param)) return $param ? 1 : 0;
        return "'".$this->escape_string($param)."'";
    }

    /**
     * Returns an array from the given Result ID
     *
     * @abstract
     * @param integer $id
     * @return unknown
     */
    function fetch_array($id) { }

    /**
     * Frees a Result from memory
     *
     * @param integer $id
     * @return unknown
     */
    function free_result($id) { }

    /**
     * Queries the SQL server, returning a single row
     *
     * @param string $string SQL Query.
     * @return unknown
     */
    function query_result($string)
    {
        $params = func_get_args();
        $id = call_user_func_array(array($this, 'query'), $params);
        $result = $this->fetch_array($id);
        $this->free_result($id);
        $this->lastquery = $string;
        return $result;
    }

    /**
     * Queries the SQL server, returning the defined (or first) select value
     * from the first row.
     *
     * @param string $string SQL Query.
     * @param string $value Optional select field name to return.
     * @return unknown
     */
    function query_result_single($string, $def = false)
    {
        $params = func_get_args();
        $result = call_user_func_array(array($this, 'query_result'), $params);
        if (!$result) return $def;
        return array_shift($result);
    }

    /**
     * Returns the number of rows
     *
     * @abstract
     * @param unknown $id
     * @return unknown
     */
    function num_rows($id) { }

    /**
     * Returns the number of fields
     *
     * @abstract
     * @param integer $id
     * @return unknown
     */
    function num_fields($id) { }

    /**
     * Returns the field name
     *
     * @abstract
     * @param integer $id
     * @param integer $num
     * @return unknown
     */
    function field_name($id, $num) { }

    /**
     * Returns the Row ID of the last inserted row
     *
     * @abstract
     * @return integer
     */
    function insert_id() { }

    /**
     * Close the connection
     *
     * @abstract
     * @return boolean
     */
    function close() { }

    /**
     * Runs mysql_escape_string to stop SQL injection
     *
     * @abstract
     * @param string $string
     * @return string
     */
    function escape_string($string) { }

    /**
     * Output the error
     *
     * @param string $string
     */
    function error($string)
    {
        logx("SQL ERROR: $string", 'error');
    }

    function error_code()
    {
        return $this->error_num;
    }

    function error_msg()
    {
        return @$this->error_desc;
    }
}