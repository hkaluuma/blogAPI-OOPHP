<?php
class Category{
//DB stuff
private $conn;
private $table = 'categories';

//Post Properties
public $id;
public $name;
public $created_at;

// Constructor with DB
public function __construct($db){
    $this->conn = $db;
}

//Method Get Posts
public function read(){
    //create query
    $query = 'SELECT name, id, created_at
FROM
' . $this->table . '
ORDER BY
created_at DESC';

//Prepare statement
$stmt = $this->conn->prepare($query);

//execute query
$stmt->execute();

return $stmt;
}//end method

//get single category
public function read_single(){
     //create query
     $query = 'SELECT
    id,
    name,
    created_at
    FROM
    ' . $this->table . '
    WHERE 
    id = ?
    LIMIT 0,1';

    //Prepare statement
    $stmt = $this->conn->prepare($query);
    //Bind ID
    $stmt->bindParam(1, $this->id);
    //execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //Set properties
    $this->id = $row['id'];
    $this->name = $row['name'];
}

//create category method
public function create(){
    //create query
    $query = 'INSERT INTO ' . $this->table . '
    SET 
    name = :name,
    id = :id';

    //prepare statement
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id= htmlspecialchars(strip_tags($this->id));

    //Bind data
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);

    //execute query
    if($stmt->execute()){
        return true;
    }
    //print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}



//update category method
public function update(){
    //create query
    $query = 'UPDATE ' . $this->table . '
    SET 
    name = :name,
    id = :id
    WHERE
    id = :id';

    //prepare statement
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id= htmlspecialchars(strip_tags($this->id));

    //Bind data
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);


    //execute query
    if($stmt->execute()){
        return true;
    }
    //print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}


//delete category method
public function delete(){
    //create query
    $query = 'DELETE FROM ' . $this->table . '
    WHERE
    id = :id';

    //prepare statement
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->id= htmlspecialchars(strip_tags($this->id));
    
    //Bind data
    $stmt->bindParam(':id', $this->id);

    //execute query
    if($stmt->execute()){
        return true;
    }
    //print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}

}//end class post

