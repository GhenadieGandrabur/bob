<?php
// create short variable names
$tireqty = (int) $_POST['tireqty'];
$oilqty = (int) $_POST['oilqty'];
$sparkqty = (int) $_POST['sparkqty'];
$address = preg_replace('/\t|\R/', ' ', $_POST['address']);
$document_root = $_SERVER['DOCUMENT_ROOT'];
$date = date('H:i, jS F Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    <h1>Welcome to Bob's Auto Parts. </h1>
    <p>What would you like to order today&</p>
<h1>Bob's Auto Parts</h1>
<h2>Orders Results</h2>

<form action="" method="post">
    <table style="border: 0px;">
    <tr style="background:#cccccc">    
        <td style="width:150px; text-align:center;">Item</td>
        <td style="width:15px; text-align:center;">Quantity</td>    
    </tr>
    <tr>
        <td>Tires</td>
        <td><input type="text" name="tireqty" size="3" maxlength="3"></td>
    </tr>
    
    <tr>
        <td>Oil</td>
        <td><input type="text" name="oilqty" size="3" maxlength="3"></td>
    </tr>
    <tr>
        <td>Spark Plugs</td>
        <td><input type="text" name="sparkqty" size="3" maxlength="3"></td>
    </tr>
    <tr>
        <td>Addres</td>
        <td><input type="text" name="address" size="50" ></td></td>
    <tr>
        <td colspan="2" style="text-align:center ;"><input type="submit" value="Submit Order"></td>    
    </tr>
</form>
</tr>
</table>
 <?php
 
echo "<p>Order processed at " . date('H:i, jS F Y') . "</p>";
echo "<p>Your order is as follows: </p>";
$totalqty = 0;
$totalamount = 0.00;
define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);
$totalqty = $tireqty + $oilqty + $sparkqty;
echo "<p>Items ordered: " . $totalqty . "<br />";
if ($totalqty == 0) {
    echo "You did not order anything on the previous page!<br />";
} else {
    if ($tireqty > 0) {
        echo htmlspecialchars($tireqty) . ' tires<br />';
    }
    if ($oilqty > 0) {
        echo htmlspecialchars($oilqty) . ' bottles of oil<br />';
    }
    if ($sparkqty > 0) {
        echo htmlspecialchars($sparkqty) . ' spark plugs<br />';
    }
}
$totalamount = $tireqty * TIREPRICE
     + $oilqty * OILPRICE
     + $sparkqty * SPARKPRICE;
echo "Subtotal: $" . number_format($totalamount, 2) . "<br />";
$taxrate = 0.10; // local sales tax is 10%
$totalamount = $totalamount * (1 + $taxrate);
echo "Total including tax: $" . number_format($totalamount, 2) . "</p>";
echo "<p>Address to ship to is " . htmlspecialchars($address) . "</p>";
$outputstring = $date . "\t" . $tireqty . " tires \t" . $oilqty . " oil\t"
    . $sparkqty . " spark plugs\t\$" . $totalamount
    . "\t" . $address . "\n";
// open file for appending
@$fp = fopen("$document_root/../orders/orders.txt", 'ab');
if (!$fp) {
    echo "<p><strong> Your order could not be processed at this time.
Please try again later.</strong></p>";
    exit;
}
flock($fp, LOCK_EX);

fwrite($fp, $outputstring, strlen($outputstring));
flock($fp, LOCK_UN);
fclose($fp);
echo "<p>Order written.</p>";
?>
 </body>
</html>
