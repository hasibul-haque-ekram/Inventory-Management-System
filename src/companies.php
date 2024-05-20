<?php
namespace App;

use PDO;

class companies
{
    public $id = null;
    public $company_name = null;
    public $charge_amount = null;
    public $vat_charge = null;
    public $address = null;
    public $phone = null;
    public $country = null;
    public $message = null;
    public $currency = null;
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

         $_company_name = $_POST['company_name'];
         $_charge_amount = $_POST['charge_amount'];
         $_vat_charge = $_POST['vat_charge'];
         $_address = $_POST['address'];
         $_phone = $_POST['phone'];
         $_country = $_POST['country'];
         $_message = $_POST['message'];
         $_currency = $_POST['currency'];

        // var_dump($_company);

        // if (array_key_exists('is_active', $_POST)) {
        //     $_is_active = $_POST['is_active'];
        // } else {
        //     $_is_active = 0;
        // }

        // $_created_at = date("Y-m-d H:i:s");

        // $_status = $_POST['status'];

        // Insert Query

        $query = "INSERT INTO companies (`company_name`, `charge_amount`, `vat_charge`, `address`, `phone`, `country`, `message`, `currency`) VALUES (:company_name, :charge_amount, :vat_charge, :address, :phone, :country, :message, :currency)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':company_name', $_company_name);
        $stmt->bindParam(':charge_amount', $_charge_amount);
        $stmt->bindParam(':vat_charge', $_vat_charge);
        $stmt->bindParam(':address', $_address);
        $stmt->bindParam(':phone', $_phone);
        $stmt->bindParam(':country', $_country);
        $stmt->bindParam(':message', $_message);
        $stmt->bindParam(':currency', $_currency);

        $result = $stmt->execute();

        var_dump($result);

        // PHP link
        header('location:index.php');
    }
    public function index()
    {

        //Insert Query
        $query = "SELECT * FROM `companies`";

        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();
        $companies = $stmt->fetchAll();

        return $companies;
    }
    public function edit()
    {
        $_id = $_GET['id'];

        $query = "SELECT * FROM `companies` WHERE id= :id";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();

        $company = $stmt->fetch();
        return $company;

        // var_dump($category);
    }
    public function update()
    {

        $_id = $_POST['id'];
        $_company_name = $_POST['company_name'];
        $_charge_amount = $_POST['charge_amount'];
        $_vat_charge = $_POST['vat_charge'];
        $_address = $_POST['address'];
        $_phone = $_POST['phone'];
        $_country = $_POST['country'];
        $_message = $_POST['message'];
        $_currency = $_POST['currency'];
        
        // Insert Query

        $query = "UPDATE `companies` SET `company_name`= :company_name, `charge_amount`= :charge_amount,`vat_charge`= :vat_charge,`address`= :address,`phone`= :phone,`country`= :country, `message`= :message,`currency`= :currency WHERE `companies`.`id`= :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $_id);
        $stmt->bindParam(':company_name', $_company_name);
        $stmt->bindParam(':charge_amount', $_charge_amount);
        $stmt->bindParam(':vat_charge', $_vat_charge);
        $stmt->bindParam(':address', $_address);
        $stmt->bindParam(':phone', $_phone);
        $stmt->bindParam(':country', $_country);
        $stmt->bindParam(':message', $_message);
        $stmt->bindParam(':currency', $_currency);
        
        $result = $stmt->execute();



        header('location:index.php');
    }
    public function delete()
    {
        $_id = $_GET['id'];

        $query = "DELETE FROM `companies` WHERE `companies`. `id` = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $_id);

        $result = $stmt->execute();
        // var_dump( $result );

        header('location:index.php');
    }
}