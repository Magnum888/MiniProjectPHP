<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $admin;
    public $task_id;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
    // check if given name exist in the database
    function nameExists(){
    
        // query to check if name exists
        $query = "SELECT id, name, email, password, admin, task_id FROM users WHERE name = ? LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
    
        // bind given name value
        $stmt->bindParam(1, $this->name);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if name exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->admin = $row['admin'];
            $this->task_id = $row['task_id'];
    
            // return true because name exists in the database
            return true;
        }
    
        // return false if email does not exist in the database
        return false;
    }

    // check if given email exist in the database
    function emailExists(){
    
        // query to check if email exists
        $query = "SELECT id, name, email, password, admin, task_id FROM users WHERE name = ? LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
    
        // bind given email value
        $stmt->bindParam(1, $this->email);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->admin = $row['admin'];
            $this->task_id = $row['task_id'];
    
            // return true because email exists in the database
            return true;
        }
        // return false if email does not exist in the database
        return false;
    }

    // create new user record
    function create(){
    
        // insert query
        $query = "INSERT INTO users SET name = :name, email = :email, password = :password, admin = :admin, task_id = :task_id";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->admin=htmlspecialchars(strip_tags($this->admin));
        $this->task_id=htmlspecialchars(strip_tags($this->task_id));

        // bind the values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':admin', $this->admin);
        $stmt->bindParam(':task_id', $this->task_id);
    
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    
    }
}