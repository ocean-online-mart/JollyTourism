<?php
$invoiceNumber = "INV-20250610";
$invoiceDate = date("F d, Y");
$customerName = "John Doe";
$customerEmail = "john.doe@example.com";
$customerAddress = "123 Customer Street, Springfield, USA";
$items = [
    ["description" => "UI/UX Design", "quantity" => 1, "price" => 800.00],
    ["description" => "Web Development", "quantity" => 1, "price" => 1500.00],
    ["description" => "SEO Optimization", "quantity" => 1, "price" => 300.00],
];
$subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $items));
$tax = $subtotal * 0.10;
$total = $subtotal + $tax;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice <?= $invoiceNumber ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 750px;
            margin: auto;
            padding: 30px;
            background: #fff;
            border: 1px solid #eee;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #00aaff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            width: 140px;
        }

        .company-info {
            margin-top: -60px;
            margin-left: auto;
            text-align: right;
        }
        .text-right
        {
            margin-top: -40px;
            margin-left: auto;
            text-align: right;
        }
        .section-title {
            font-size: 16px;
            color: #00aaff;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .two-column {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .two-column div {
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f0f8ff;
        }

        .total-row td {
            font-weight: bold;
        }

        .thank-you {
            text-align: center;
            font-size: 16px;
            margin-top: 30px;
            color: #00aaff;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="header">
        <img src="https://jollytourism.com/assets/img/logo/logo.png" class="logo" alt="Logo">
        <div class="company-info">
            <strong>Jolly Tourism</strong><br>
             Pondicherry – 605007<br>
            support@jollytourism.com
        </div>
    </div>

    <div class="two-column">
        <div>
            <div class="section-title">Bill To</div>
            <?= $customerName ?><br>
            <?= $customerEmail ?><br>
            <?= $customerAddress ?>
        </div>
        <div class="text-right">
            <strong>Invoice #:</strong> <?= $invoiceNumber ?><br>
            <strong>Date:</strong> <?= $invoiceDate ?><br>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th style="text-align:center;">Qty</th>
                <th style="text-align:right;">Unit Price</th>
                <th style="text-align:right;">Line Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= $item['description'] ?></td>
                    <td style="text-align:center;"><?= $item['quantity'] ?></td>
                    <td style="text-align:right;">$<?= number_format($item['price'], 2) ?></td>
                    <td style="text-align:right;">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Subtotal</td>
                <td style="text-align:right;">$<?= number_format($subtotal, 2) ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Tax (10%)</td>
                <td style="text-align:right;">$<?= number_format($tax, 2) ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Total</td>
                <td style="text-align:right;">$<?= number_format($total, 2) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="thank-you">Thank you for your booking!</div>
    <div class="footer">This is an auto generated invoice no signature required.</div>
</div>
</body>
</html>
