<?php


class database
{
    private $host;
    private $dbusername;
    private $dbpassword;
    private $dbname;

    protected function connect()
    {
        $this->host = 'localhost';
        $this->dbusername = 'root';
        $this->dbpassword = '';
        $this->dbname = 'lte_oops';
        $con = new mysqli($this->host, $this->dbusername, $this->dbpassword, $this->dbname);

        return $con;
    }
}
