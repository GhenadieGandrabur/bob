<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Income print</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .totals {
            margin-top: 30px;
            text-align: right;
        }

        @media print {
            .noprint {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Income Receipt</h2>
    <p>Date: <?= date('d.m.Y', strtotime($income->created)) ?></p>
</div>

<table>
    <thead>
        <tr>
            <th>Currency</th>
            <th>Rate</th>
            <th>Denomination</th>
            <th>QTY</th>
            <th>Amount</th>
            <th>MDL</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($facevalues as $fv): ?>
            <tr>
                <td><?= $currenciesById[$fv->currency_id] ?? 'N/A' ?></td>
                <td><?= $fv->rate ?></td>
                <td><?= $fv->facevalue ?></td>
                <td><?= $fv->quantity ?></td>
                <td><?= $fv->amount ?></td>
                <td><?= $fv->summ ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="totals">
    <strong>Total: <?= number_format($income->total_amount, 2, '.', ' ') ?> MDL</strong>
</div>

<div class="noprint" style="margin-top:20px;">
    <button onclick="window.print()">🖨️ Print</button>
    <a href="/income/list" style="margin-left: 10px;">⬅️ Back to list</a>
</div>

</body>
</html>
