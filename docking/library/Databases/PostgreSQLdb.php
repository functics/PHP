<?php

namespace Library\Databases;

class PostgreSQLdb extends Database
{
    /**
     * Connect to the PostgreSQL Server
     *
     * @return boolean
     */
    function connect($force=false)
    {
        parent::connect();
        $params = array(
            'host='.$this->__server,
            'user='.$this->__username,
            'dbname='.$this->__database,
        );
        if ($this->__password)
            $params[] = 'password='.$this->__password;

        if ($this->__pconnect == 1)
            $this->link_id = @pg_connect(implode(' ', $params));
        else
            $this->link_id = @pg_pconnect(implode(' ', $params));
        if (!$this->link_id)
        {
            $this->error('Connection to database failed');
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
        pg_close($this->link_id);
        $this->__database = $database;
        $this->connect();
        return true;
    }

    function execute($sql)
    {
        parent::execute($sql);
        $result_id = pg_query($this->link_id, $sql);
        if (!$result_id) $this->error('Invalid SQL: '.$sql);
        return $result_id;
    }

    function fetch_array($id)
    {
        parent::fetch_array($id);
        return @pg_fetch_array($id);
    }

    function free_result($id)
    {
        parent::free_result($id);
        return @pg_free_result($id);
    }

    function num_rows($id)
    {
        parent::num_rows($id);
        return pg_num_rows($id);
    }

    function num_fields($id)
    {
        parent::num_fields($id);
        return pg_num_fields($id);
    }

    function field_name($id, $num)
    {
        parent::field_name($id, $num);
        return pg_field_name($id, $num);
    }

    function insert_id()
    {
        throw new FatalError("This method does not work under PostgreSQL");
    }

    function close()
    {
        parent::close();
        return pg_close($this->link_id);
    }


    function escape_string($string)
    {
        parent::escape_string($string);
        return pg_escape_string($string);
    }

    function error($message)
    {
        if ($this->link_id)
        {
            $message .= "\t" . pg_last_error($this->link_id);
        }
        parent::error($message);
    }
}