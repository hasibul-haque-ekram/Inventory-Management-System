<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\products;

$_product = new products();
$products = $_product->index();
$normal_products = $_product->normalStockProducts();
$low_stock_products = $_product->lowStockProducts();
$out_of_stock_products = $_product->stockOutProducts();



// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$productsPerPage = 12; // Number of products per page
$offset = ($page - 1) * $productsPerPage; // Offset for fetching products

// Fetch products for the current page
// $products = $_product->paginateForCards($productsPerPage, $offset);

// Fetch total number of products
$totalProducts = $_product->countTotalProducts();
?>

<?php ob_start();
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}?>


<div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <h4>Manage Products</h4>
    </div>
    <div class="col-2 offset-4 text-right">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-6">
      <a href="create.php" class="btn btn-success m-1">Add Product</a>
      <a href="index.php" class="btn btn-danger m-1">Managed Products</a>
    </div>
  </div>


  <section class="content mt-5">

    <div class="row g-4 my-4">
      <h3>Stocked Out Products</h3>
      <?php foreach ($out_of_stock_products as $out_of_stock_product) { ?>
        <div class="col-md-2">
          <div class="card card-pink h-100 w-100">
            <!-- Applying the background color to the fourth card -->
            <div class="card-header">
              <b><?php echo $out_of_stock_product['product'] ?></b>
            </div>
            <div class="card-body">
              <span class="custom-card-text"><?php echo $out_of_stock_product['quantity']; ?></span>
            </div>
            <a href="show.php?id=<?=$out_of_stock_product['id']?>" class="card-footer text-right text-none">More Info &rarr;</a>
          </div>


        </div>
      <?php } ?>

    </div>

    <div class="row g-4 my-4">
      <h3>Low Stocked Products</h3>
      <?php foreach ($low_stock_products as $low_stock_product) { ?>
        <div class="col-md-2">
          <div class="card card-yellow h-100 w-100">
            <!-- Applying the background color to the third card -->
            <div class="card-header">
              <b><?php echo $low_stock_product['product'] ?></b>
            </div>
            <div class="card-body">
              <span class="custom-card-text"><?php echo $low_stock_product['quantity']; ?></span>
            </div>
            <a href="show.php?id=<?=$low_stock_product['id']?>" class="card-footer text-right text-none">More Info &rarr;</a>
          </div>
        </div>
      <?php } ?>
    </div>

    <div class="row g-4 my-4">
      <h3>Full Stocked Products</h3>
      <?php foreach ($normal_products as $normal_product) { ?>
        <div class="col-md-2">
          <div class="card card-green h-100 w-100">
            <!-- Applying the background color to the second card -->
            <div class="card-header">
              <b><?php echo $normal_product['product'] ?></b>
            </div>
            <div class="card-body">
              <span class="custom-card-text"><?php echo $normal_product['quantity'] ?></span>
            </div>
            <a href="show.php?id=<?=$normal_product['id']?>" class="card-footer text-right text-none">More Info &rarr;</a>
          </div>
        </div>
      <?php } ?>
    </div>


</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>