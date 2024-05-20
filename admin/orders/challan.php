<?php
session_start();
// var_dump($_SESSION);
// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: ./signin.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challan Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            max-width: 900px;
        }
        .section {
            flex-basis: 48%; /* Adjust the width of each section */
        }
        .section h2 {
            margin-top: 0;
        }
        .invoice-table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f2f2f2;
        }
        .section-content {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        /* Add CSS to change the order of sections */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .section {
                width: 100%;
                margin-bottom: 20px;
            }
        }
        @media (min-width: 768px) {
            .container {
                flex-direction: row;
            }
            .section {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }
            .section:nth-child(2) {
                align-items: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="section" id="toSection">
            <h2>To</h2>
            <div class="section-content">
                <label for="clientName">Client Name:</label>
                <input type="text" id="clientName" name="clientName" required>
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="2" required></textarea>
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" required>
            </div>
        </div>
        <div class="section">
            <h2>From</h2>
            <div class="section-content">
                <p>Turnago Enterprise</p>
                <p>Address: Gulshan 1</p>
            </div>
        </div>
    </div>

    <h2>Challan</h2>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <!-- Add rows for invoice items here -->
            <tr>
                <td>Product 1</td>
                <td>2</td>
                <td>$20</td>
            </tr>
            <tr>
                <td>Product 2</td>
                <td>1</td>
                <td>$15</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>
</html>
