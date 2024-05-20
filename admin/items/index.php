<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\items;
$_item = new items();
$items = $_item->index();


// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$itemsPerPage = 5; // Number of items per page
$offset = ($page - 1) * $itemsPerPage; // Offset for fetching items

// Fetch items for the current page
$items = $_item->paginate($itemsPerPage, $offset);

// Fetch total number of items
$totalItems = $_item->countTotalItems();

?>

<?php ob_start(); 
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}


?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6 mb-3">
            <h4>Manage Items</h4>
        </div>
        <div class="col-2 offset-4 text-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Items</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <a href="create.php" class="btn btn-success m-1">Add Items</a>
            <?php if ($_SESSION['role_id'] === 1) { ?>
            <a href="trash_index.php" class="btn btn-danger m-1">Trashed Items</a>
            <?php } ?>
        </div>
    </div>
    </div>

    <div class="col-4 mb-3"> <!-- Adjust column width and add margin-bottom -->
    <input type="text"  
        class="form-control" 
        id="searchInput" style="width:300px;" 
        placeholder="Search items..."> <!-- Add inline style for width -->
    </div>


    <section class="content mt-4">

        <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th scope="col" style="border-bottom: 2px solid black;">Items</th>
                    <th scope="col" style="border-bottom: 2px solid black;">Status</th>
                    <th scope="col" style="border-bottom: 2px solid black;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['item']; ?></td>
                        <td><?php echo $item['is_active'] ? "Active" : " Inactive"; ?></td>
                        <td>
                            <a href="show.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Show</a>
                            <a href="edit.php?id=<?= $item['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <?php if ($_SESSION['role_id'] === 1) { ?>
                            <a href="trash.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Trash</a>
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
                    <?php for ($i = 1; $i <= ceil($totalItems / $itemsPerPage); $i++): ?>
                        <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $page >= ceil($totalItems / $itemsPerPage) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                </ul>
        </nav>

    </section>

</div>

<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>


<!-- JavaScript for instant search -->
<script>
    // Get the search input field
    var searchInput = document.getElementById('searchInput');

    // Add event listener for input changes
    searchInput.addEventListener('input', function() {
        // Get the search query from the input field
        var searchQuery = searchInput.value.trim().toLowerCase();

        // Get all rows in the table body
        var rows = document.querySelectorAll('tbody tr');

        // Loop through each row
        rows.forEach(function(row) {
            // Get the item name from the row
            var itemName = row.querySelector('td:first-child').textContent.toLowerCase();

            // Check if the item name contains the search query
            if (itemName.includes(searchQuery)) {
                // If the item name contains the search query, display the row
                row.style.display = '';
            } else {
                // If the item name does not contain the search query, hide the row
                row.style.display = 'none';
            }
        });
    });
</script>
