<?php ob_start();
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./signin.php");
    exit();
}

include_once ($_SERVER['DOCUMENT_ROOT'] . "/config.php");

use App\salesReport;

$_salesReports = new salesReport();
$salesReports = $_salesReports->index();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    $_salesReport = new salesReport();
    $salesReports = $_salesReport->filteringData($_POST);
    // var_dump($salesReports);
}

?>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="card card-report">
                    <div class="card-head">
                        <h3 class="m-4">Sales Report</h3>
                        <div class="mt-4 me-3 text-right">
                            <a class="btn btn-primary" href="sales-report-download.php" role="button">Download Pdf</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="salesReportTable" class="table table-responsive text-center">
                            <thead>
                                <tr>
                                    <th colspan="7">
                                        <form action="./sales-report.php" method="POST">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                echo $_POST['start_date'];
                                            } ?>">

                                            <label for="end_date">End Date:</label>
                                            <input type="date" id="end_date" name="end_date" value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                echo $_POST['end_date'];
                                            } ?>">

                                            <button type="submit">Apply Filter</button>
                                        </form>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Purchasing Price</th>
                                    <th>Selling Price</th>
                                    <th>Sold Qty</th>
                                    <th>Sold Price</th>
                                    <th>Profit</th>
                                    <!-- <th>Monthly Profit</th>
                                    <th>Yearly Profit</th> -->
                                    <th>Provided Vat</th>
                                    <!-- <th>Ratio</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$salesReports) { ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;">No Record Found</td>
                                    </tr>
                                <?php } else { ?>
                                    <?php foreach ($salesReports as $salesReport) { ?>
                                        <tr>
                                            <td><?php echo $salesReport['product_name'] ?></td>
                                            <td><?php echo $salesReport['purchasing_price'] ?></td>
                                            <td><?php echo $salesReport['selling_price'] ?></td>
                                            <td><?php echo $salesReport['total_sold_quantity'] ?></td>
                                            <td><?php echo $salesReport['total_sold_price'] ?></td>
                                            <td><?php echo $salesReport['profit'] ?></td>
                                            <td><?php echo $salesReport['vat'] ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="mt-4 text-right">
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                ?>
                                <a class="btn btn-primary"
                                    href="<?php echo "sales-report-download.php?" . "start_date=" . $_POST['start_date'] . "&end_date=" . $_POST['end_date'] ?>"
                                    role="button">Download Pdf</a>
                            <?php } else { ?>
                                <a class="btn btn-primary" href="sales-report-download.php" role="button">Download Pdf</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<?php $content = ob_get_clean(); ?>

<?php include '../components/master-design.php'; ?>