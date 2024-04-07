<?php
if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'user' ) {
        require_once("config/database.config.php");
    }else {
        require_once("../config/database.config.php");
    }
} else {
    require_once("config/database.config.php");
}
class Database
{
    private $host = HOST;
    private $db = DATABASE;
    private $user = USER;
    private $pwd = PASSWORD;
    private $commander;
    private $command;

    public function __construct()
    {
        $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db;
        $this->commander = new PDO($connection, $this->user, $this->pwd);
        if (!$this->commander) {
            echo "Connection Failed";
        }
    }
    //end of construct
    public function Query($query = '')
    {
        $this->command = $this->commander->prepare($query);
    }
    //end of query function
    public function Bind($placeholder = '', $value = '')
    {
        $this->command->bindValue($placeholder, $value);
    }
    //end of data passing/binding
    public function Run()
    {
        return $this->command->execute();
    }
    //end of Execution
    public function Single()
    {
        $this->Run();
        return $this->command->fetch();
    }
    //end of read single recored
    public function All()
    {
        $this->Run();
        return $this->command->fetchAll();
    }
    //end of read All recored
    public function Total()
    {
        $this->Run();
        return $this->command->rowCount();
    }
    public function getlastId()
    {
        return $this->commander->lastInsertId();
    }
}
