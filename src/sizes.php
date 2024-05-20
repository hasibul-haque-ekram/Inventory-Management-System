<?php
namespace App;

use PDO;

class sizes
{
    public $id = null;
    public $size = null;
    public $conn = null;

    public function __construct()
    {
        // Connection to database

        $servername = "localhost";
        $username = "root";
        $password = "";

        $this->conn = new PDO("mysql:host=$servername; dbname=inv", $username, $password);
        // set the PDO error mode to exception

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";

    }

    public function store()
    {
         print_r($_POST);

        $_size = $_POST['size'];

        // var_dump($_size);

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_created_at = date("Y-m-d H:i:s");

        // Insert Query

        $query = "INSERT INTO `sizes`(`size`, `is_active`, `created_at`) VALUES (:size, :is_active, :created_at)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':size', $_size);
        $stmt->bindParam(':is_active', $_is_active);
        $stmt->bindParam(':created_at', $_created_at);

        $result = $stmt->execute();

        var_dump($result);

        // PHP link
        header('location:index.php');
    }
    public function index()
    {

        //Insert Query
        $query = "SELECT * FROM `sizes` where is_deleted = 0";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $sizes = $stmt->fetchAll();

        return $sizes;
    }
    public function show()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `sizes` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $size = $stmt->fetch();
        return $size;

        //var_dump($size);
    }
    public function edit()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `sizes` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $size = $stmt->fetch();
        return $size;

        // var_dump($size);
    }
    public function update()
    {

        $_id = $_POST['id'];
        $_size = $_POST['size'];

        if (array_key_exists('is_active', $_POST)) {
            $_is_active = $_POST['is_active'];
        } else {
            $_is_active = 0;
        }

        $_modified_at = date("Y-m-d H:i:s");


        // Insert Query

        $query = "UPDATE `sizes` SET `size`= :size, `is_active`= :is_active WHERE `sizes`.`id`= :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':size', $_size);
        $stmt->bindParam(':is_active', $_is_active);
        $result = $stmt->execute();



        header('location:index.php');
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `sizes` WHERE `sizes`. `id` = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:trash_index.php');
    }
    public function trash()
    {
        $_id = $_GET['id'];
        $_is_deleted = 1;

        $query = "UPDATE `sizes` SET `is_deleted`= :is_deleted WHERE `sizes`.`id`= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':is_deleted', $_is_deleted);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');
    }
    public function trash_index(){

        //Insert Query
    $query= "SELECT * FROM `sizes` where is_deleted = 1";

    $stmt= $this->conn->prepare($query);

    $result= $stmt->execute();
    $sizes= $stmt->fetchAll();
    return $sizes;
    }
    public function restore(){
        
    $_id = $_GET['id'];
    $_is_deleted = 0;

    $query = "UPDATE `sizes` SET `is_deleted`= :is_deleted WHERE `sizes`.`id`= :id";

    $stmt = $this->conn->prepare($query);  

    $stmt->bindParam(':id', $_id);
    $stmt->bindParam(':is_deleted', $_is_deleted);

$result = $stmt->execute();
// var_dump( $result );

header('location:index.php');

    }

    public function paginate($limit, $offset) {
        // Pagination query to fetch a subset of sizes
        $query = "SELECT * FROM `sizes` WHERE is_deleted = 0 LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $sizes = $stmt->fetchAll();
        return $sizes;
    }

    public function countTotalSizes() {
        // Query to count total sizes
        $query = "SELECT COUNT(*) as total FROM `sizes` WHERE is_deleted = 0";
        $stmt = $this->conn->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}