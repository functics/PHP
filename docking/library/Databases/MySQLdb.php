<?php
/**
 * SQL functions library for PHP5
 *
 * @author David Cramer <dcramer@gmail.com
 * @package phpdatabase
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright 2008 David Cramer
 * @version 0.1
 */
namespace Library\Databases;

class MySQLdb extends Database
{
    /**
     * Connect to the MySQL Server
     *
     * @return boolean
     */
    function connect($force=false)
    {
        parent::connect($force);
        if (!$this->__password)
        {
            $this->link_id = @mysqli_connect($this->__server, $this->__username);
        }
        else
        {
            $this->link_id = @mysqli_connect($this->__server, $this->__username, $this->__password);
        }

        if (!$this->link_id)
        {
            $this->error('Connection to database failed' . mysqli_connect_error());
            return false;
        }

        if(!$this->select_db($this->__database))
        {
            $this->close();
            return false;
        }

        return true;
    }

    /**
     * Selects the Database
     *
     * @param string $database
     * @return boolean
     */
    function select_db($database)
    {
        parent::select_db($database);
        if(empty($this->__database)) return true;
        if (@mysqli_select_db($this->link_id, $this->__database))
            return true;
        $this->error('Cannot use database ' . $this->__database);
        return false;
    }

    function execute($sql)
    {
        parent::execute($sql);

        $result = mysqli_query($this->link_id, $sql);
        if($result) return $result;
        $this->error('Invalid SQL1: ' . $sql);

        return false;
    }

    function multi_query($sql)
    {
        $params = func_get_args();
        $params = array_slice($params, 1);

        if (count($params))
        {
            foreach ($params as $key=>$value)
                $params[$key] = $this->prepare_param($value);
            $sql = vsprintf($sql, $params) or $this->error('Invalid sprintf: ' . $sql ."\n".'Arguments: '. implode(', ', $params));
        }

        parent::execute($sql);

        if(mysqli_multi_query($this->link_id, $sql))
        {
            $result = mysqli_use_result($this->link_id);
            if($result)
                return $result;
            return true;
        }

        $this->error_num = mysqli_errno($this->link_id);
        if($this->error_num)
        {
            $this->error_desc = mysqli_error($this->link_id);
            logx("SQL ERROR: $sql code {$this->error_num} msg {$this->error_desc}", 'error');
        }

        while(@mysqli_more_results($this->link_id))
        {
            if(@mysqli_next_result($this->link_id))
            {
                $result = @mysqli_store_result($this->link_id);
                if($result)
                    @mysqli_free_result($result);
            }
        }

        return NULL;
    }

    function next_result($id)
    {
        parent::free_result($id);

        @mysqli_free_result($id);

        if(@mysqli_more_results($this->link_id))
        {
            if(@mysqli_next_result($this->link_id))
            {
                $result = @mysqli_store_result($this->link_id);
                if($result)
                    return $result;
            }
        }

        return NULL;
    }

    function fetch_array($id)
    {
        parent::fetch_array($id);
        return mysqli_fetch_array($id, MYSQLI_ASSOC);
    }

    function fetch_object($id)
    {
        parent::fetch_array($id);
        return mysqli_fetch_object($id);
    }

    function free_result($id)
    {
        parent::free_result($id);

        @mysqli_free_result($id);
        while(@mysqli_more_results($this->link_id))
        {
            if(@mysqli_next_result($this->link_id))
            {
                $result = @mysqli_store_result($this->link_id);
                if($result)
                    @mysqli_free_result($result);
            }
            else
            {
                break;
            }
        }
    }

    function num_rows($id)
    {
        parent::num_rows($id);
        return mysqli_num_rows($id);
    }

    function num_fields($id)
    {
        parent::num_fields($id);
        return mysqli_num_fields($id);
    }

    function field_name($id, $num)
    {
        parent::field_name($id);
        return mysqli_fetch_field_direct($id, $num);
    }

    function insert_id()
    {
        parent::insert_id($id);
        return mysqli_insert_id($this->link_id);
    }

    function close()
    {
        parent::close();
        return mysqli_close($this->link_id);
    }

    function escape_string($string)
    {
        parent::escape_string($string);
        return mysqli_real_escape_string($this->link_id, $string);
    }

    function ping()
    {
        return mysqli_ping($this->link_id);
    }

    function error($message)
    {
        if($this->link_id)
        {
            $this->error_num = mysqli_errno($this->link_id);
            $this->error_desc = mysqli_error($this->link_id);

            $message .= "\t code: " . $this->error_num . ' msg:' . $this->error_desc;
        }
        parent::error($message);
    }

}
