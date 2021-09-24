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

        // if ($con) {
        //     echo 'connected';
        // } else {
        //     echo 'failed to connect' . mysqli_connect_error($con);
        // }
    }
}

// class dbconfig
// {
//     public $connection;

//     public function __construct()
//     {
//         $this->db_connect();
//     }
//     public function db_connect()
//     {
//         $this->connection = mysqli_connect('localhost', 'root', '', 'lte_oops');
//         if (mysqli_connect_error()) {
//             die("Connection Failed");
//         }
//     }
//     public function check($a)
//     {
//         $return = mysqli_real_escape_string($this->connection, $a);
//         return $return;
//     }
// }