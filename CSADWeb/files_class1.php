<?php

class files {
    private $id;
    private $name;
    private $type;
    private $size;
    private $uploadedDate;
    public $dbConn;

    function setId($id) { $this->id = $id; }
    function getId() { return $this->id; }
    function setName($name) { $this->name = $name; }
    function getName() { return $this->name; }
    function setType($type) { $this->type = $type; }
    function getType() { return $this->type; }
    function setSize($size) { $this->size = $size; }
    function getSize() { return $this->size; }
    function setUploadedDate($uploadedDate) { $this->uploadedDate = $uploadedDate; }
    function getUploadedDate() { return $this->uploadedDate; }
    
    function __construct() {
        require 'dbconnect.php';
        $db = new dbconnect();
        $this->dbConn = $db->connect();
    }
    
    public function insert() {
        $stmt = $this->dbConn->prepare("INSERT INTO imagefiles_class1 values(null, :name, :type, :size, :udate)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':size', $this->size);
        $stmt->bindParam(':udate', $this->uploadedDate);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getFiles() {
        $stmt = $this->dbConn->prepare("SELECT * FROM imagefiles_class1");
        $stmt->execute();
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $files;
    }
}

