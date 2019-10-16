<?php
include '../config/config.php';

/**
 * Class Database
 */
class Database
{
    /**
     * @var string
     */
    public $host   = DB_HOST;
    /**
     * @var string
     */
    public $user   = DB_USER;
    /**
     * @var string
     */
    public $pass   = DB_PASS;
    /**
     * @var string
     */
    public $dbname = DB_NAME;
    /**
     * @var $link
     */
    public $link;
    /**
     * @var $error
     */
    public $error;

    /**
     * Database constructor.
     */
    public function __construct(){
        $this->connectDB();
    }

    /**
     * Connect to database
     * @return bool
     */
    private function connectDB(){
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if(!$this->link){
            $this->error ="Connection fail".$this->link->connect_error;
            return false;
        }
    }

    /**
     * Select or Read data
     * @param $query
     * @return bool
     */
    public function select($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result->num_rows > 0){
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Insert data
     * @param $query
     * @return bool
     */
    public function insert($query){
        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($insert_row){
            return $insert_row;
        } else {
            return false;
        }
    }

    /**
     * Update data
     * @param $query
     * @return bool
     */
    public function update($query){
        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($update_row){
            return $update_row;
        } else {
            return false;
        }
    }

    /**
     * Delete data
     * @param $query
     * @return bool
     */
    public function delete($query){
        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($delete_row){
            return $delete_row;
        } else {
            return false;
        }
    }
}
