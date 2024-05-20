<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\warehouses;
$_warehouse= new warehouses();
$warehouses= $_warehouse->index();


// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$warehousesPerPage = 5; // Number of warehouses per page
$offset = ($page - 1) * $warehousesPerPage; // Offset for fetching warehouses

// Fetch warehouses for the current page
$warehouses = $_warehouse->paginate($warehousesPerPage, $offset);

// Fetch total number of warehouses
$totalWarehouses = $_warehouse->countTotalWarehouses();
?>

<?php ob_start(); session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}?>

<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h4>Manage Warehouses</h4>
        </div>
        <div class="col-2 offset-4 text-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                    <?php if ($_SESSION['role_id'] === 1) { ?>
                    <li class="breadcrumb-item active" aria-current="page">Warehouse</li>
                <?php } ?>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <a href="create.php" class="btn btn-success m-1">Add Warehouse</a>
            <?php if ($_SESSION['role_id'] === 1) { ?>
            <a href="trash_index.php" class="btn btn-danger m-1">Trashed Warehouses</a>
            <?php } ?>
        </div>
    </div>

    
<section class="content mt-5">

<table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th scope="col" style="border-bottom: 2px solid black;">Warehouses</th>
            <th scope="col" style="border-bottom: 2px solid black;">Status</th>
            <th scope="col" style="border-bottom: 2px solid black;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($warehouses as $warehouse): ?>
            <tr>
                <td><?php echo $warehouse['warehouse']; ?></td>
                <td><?php echo $warehouse['is_active'] ? "Active" : " Inactive"; ?></td>
                <td>
                    <a href="show.php?id=<?= $warehouse['id'] ?>" class="btn btn-success btn-sm">Show</a>
                    <a href="edit.php?id=<?= $warehouse['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <?php if ($_SESSION['role_id'] === 1) { ?>
                    <a href="trash.php?id=<?= $warehouse['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Trash</a>
                <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= ceil($totalWarehouses / $warehousesPerPage); $i++) : ?>
                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php echo $page >= ceil($totalWarehouses / $warehousesPerPage) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
</section>



<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>