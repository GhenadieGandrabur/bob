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
        <td>How did you find Bob's?</td>
        <td><select name='find'>
            <option value = "a"> I'm a regular customer</option>
            <option value = "b">TV advertising</option>
            <option value = "c">Phone directory</option>
            <option value = "d">Word of mouth</option>
        </select>    
    </td>
    <tr>
        <td colspan="2" style="text-align:center ;"><input type="submit" value="Submit Order"></td>    
    </tr>
</form>
</tr>
</table>
<?php
echo '<p>Order prossed at' . date('H:i, jS F Y') . '</p>';
echo '<p>Your order is a follows:<br>';

$tireqty = $_POST['tireqty']?? 0;
$oilqty = $_POST['oilqty']?? 0;
$sparkqty = $_POST['sparkqty']?? 0;

echo htmlspecialchars($tireqty). ' tires <br>';
echo htmlspecialchars($oilqty). ' butle of oils <br>';
echo htmlspecialchars($sparkqty). ' sparcks plugs<br>';

$titalqty = 0;
$totalqty = $tireqty + $oilqty + $sparkqty;
echo "<p>Items ordered: ". $totalqty."<br />";
$totalamount = 0.00;

define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);

$totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;
echo "Subtotal: $ ".number_format($totalamount,2)."<br/>";

$taxrate = 0.10;
$totalamount = $totalamount * (1 + $taxrate);

echo "Total including tax: $".number_format($totalamount,2)."<p>";
?>
<?php require('test.php')  ?>
</body>
</html>
