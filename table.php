<?php

require_once "config.php";
//$db = new Connect;

class Favorite
{
    //database conn and table name 
    public $conn;
    private $table = "api.my_favorite";

    //properties
    public $id;
    public $title;
    public $image;
    public $description;
    public $published;
    public $publishedEst;

    //$db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
 
    // Insert Record in the Database
    public function Create($db)
    {
    
        if(isset($_POST['submit']))
        {
            $title = $db->check($_POST['title']);
            $image = $db->check($_POST['image']);
            $description = $db->check($_POST['description']);
            $published = $db->check($_POST['published']);
            $publishedEst = $db->check($_POST['publishedEst']);

            if($this->insert($title,$image,$description,$published,$publishedEst))
            {
                echo '<div class="alert alert-success"> Your Record Has Been Saved :) </div>';
            }
            else
            {
                echo '<div class="alert alert-danger"> Failed </div>';
            }
        }
    }

    // Insert Record in the Database Using Query    
    function insert($a,$b,$c,$d,$e)
    {
        global $db;
        $sql = "INSERT INTO api.my_favorite (title,image,description,published,publishedEst) values('$a','$b','$c','$d','$e')";
        $stmt= mysqli_query($db->conn,$sql);

        if($stmt)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    //read from sql
    function read()
    {   
        $sql = "SELECT * FROM api.my_favorite";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    function insert_db()
    { 

        $sql = "INSERT INTO
                " . $this->table . "
            SET
                title=:title, image=:image, description=:description, published=:published, publishedEst=:publishedEst";
  
    // prepare query
    $stmt = $this->conn->prepare($sql);
  
    // sanitize
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->image=htmlspecialchars(strip_tags($this->image));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->published=htmlspecialchars(strip_tags($this->published));
    $this->publishedEst=htmlspecialchars(strip_tags($this->publishedEst));
  
    // bind values
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":image", $this->image);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":published", $this->published);
    $stmt->bindParam(":publishedESt", $this->publishedEst);
  
    // execute query
    if($stmt->execute())
    {
        return true;
    }
    return false;
    }

    // used when filling up the update product form
    function readOne()
    {
    // query to read single record
        $sql = "SELECT * FROM 
                " . $this->table . " 
                WHERE title = :title";
  
    // prepare query statement
        $stmt = $this->conn->prepare( $sql );
  
    // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
  
    // execute query
        $stmt->execute();
  
    // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
        $this->title = $row['title'];
        $this->image = $row['image'];
        $this->description = $row['description'];
        $this->published = $row['published'];
        $this->publishedEst = $row['publishedEst'];
    }
    // update the product
function update(){
  
    // update query
    $sql = "UPDATE
                " . $this->table . "
            SET
                title = :title,
                image = :image,
                description = :description,
                published = :published,
                publishedEst = :publishedEst
            WHERE
                id = :id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($sql);
  
    // sanitize
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->image=htmlspecialchars(strip_tags($this->image));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->published=htmlspecialchars(strip_tags($this->published));
    $this->publishedEst=htmlspecialchars(strip_tags($this->publishedEst));
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind new values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':image', $this->image);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':published', $this->published);
    $stmt->bindParam(':publishedEst', $this->publishedEst);
    $stmt->bindParam(':id', $this->id);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
    return false;
    }

    // delete the product
function delete(){
  
    // delete query
    $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($sql);
  
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}




    
} 

?>