<?php

include_once($_SERVER['DOCUMENT_ROOT']."/config.php");

use App\units;
$_unit= new units();
$unit= $_unit->edit();

?>
<?php ob_start(); session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-5">Edit</h1>
            <form method="post" action="update.php">

            <div class="mb-3 ">
                <input type="hidden" class="form-control" name="id" value="<?= $unit['id']; ?>" id="inputID">
            </div>

                <div class="mb-3">
                    <label for="inputColor" class="form-label">Unit</label>
                    <input type="text" class="form-control" name="unit" value="<?= $unit['unit'];?>" id="inputColor">
                </div>

                <div class="mb-3 row form-check">
                  <div class="col-sm-10">
                     <?php if ($unit['is_active'] == 0): ?>
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        name="is_active" 
                        value="1" 
                        id="inputIsActive">
                    <?php else: ?>
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        name="is_active" 
                        value="1" 
                        checked 
                        id="inputIsActive">
                    <?php endif; ?>             
                  </div>
                    <label for="inputIsActive" class="col-sm-3 form-check-label">Active</label>
                </div>

                <button type="submit" class="btn btn-secondary">Submit</button>

            </form>
        </div>
    </div>
</div>

    <?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>
