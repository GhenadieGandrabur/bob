<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary</title>
    <style>
table, td, th {  
  border: 1px solid blue;
  text-align: left;
}

th{background-color: aqua; text-align: center;}

table {
  border-collapse: collapse;
  width: 30%;
  margin: auto;
}

th, td {
  padding: 2px;
}
</style>
</head>
<body>
    
    <h3 style="text-align:center ;"><a href="insertword.php">Insert word</a></h3>
    <?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=dictionary;
    charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM `words` ORDER BY en ASC';
    $result = $pdo->query($sql);
    $n = 0;
    // foreach($result as $row)
    // {
    //     echo $row['en']." ". $row['rus']."<br>";
    // }
    
} catch (PDOException $e) {
    $error = 'Unable to connect to the database server: ' .
    $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
}

?>
    <table>
        <tr><th>ID</th><th>En</th><th>Rus</th><th>Delete</th></tr>
<?php foreach($result as $row):?>
<tr>
    <td><?=$n=$n+1?></td>
    <td><?=ucfirst($row['en'])?></td>
    <td><?=mb_convert_case($row['rus'], MB_CASE_TITLE, 'UTF-8')?></td>
    

    <td>
        <form action="deleteword.php" method="post">
        <input type="hidden" name="id" value="<?=$row['id']?>">
        <input type="submit" value="❌">
    </form>

    </td>
</tr>
<?php endforeach; ?>
    </table>

</body>
</html>