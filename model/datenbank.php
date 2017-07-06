<?php

class Database
{
    private static $instance;

    private $host      = "localhost";
    private $user      = "root";
    private $pass      = "";
    private $dbname    = "dreimaleins";
    private $dbh;
    private $error;
    private $stmt;

    private function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT         => true,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );

        // Create a new PDO instanace and catch any errors
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    private function __clone(){

    }

    public static function getInstance( )
    {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self( );
        }
        return self::$instance;
    }

    // Prepare
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Binding
    public function bind($param, $value, $type = null)
    {
        if (is_null($type))
        {
            switch (true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Set result
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Return a single record
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Counting rows
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    // Get last insertId
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    // Open transaction
    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    // Commit transaction
    public function endTransaction()
    {
        return $this->dbh->commit();
    }

    // Rollback transaction
    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }

    // Debuging
    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }
}











