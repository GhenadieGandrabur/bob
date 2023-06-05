<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert word</title>
</head>
<body>
    <h1 style="text-align: center;"> Insert words</h1>
    <fieldset style="border:3px solid #cccccc; width:30%; margin:auto">
    <form action="" method="post">
        <p><label for="en">English </label><input type="text" name="en" id="en"></p>
        <p><label for="rus">Russian </label><input type="text" name="rus" id="rus"></p>
        <p><input type="submit" value="Submit"></p>
    </form>
    </fieldset>
    <?php 
    try {
    $pdo = new PDO('mysql:host=localhost;dbname=dictionary; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!empty($_POST)) {

    if(!empty($_POST['en']) && !empty($_POST['rus']))
    {
        $sql = 'INSERT INTO `words` SET
        `en` = "' . $_POST['en'] . '",
        `rus` ="'. $_POST['rus']. '" ';
        $affectedRows = $pdo->exec($sql);
      //  echo "Was affected + ". $affectedRows;
        header('Location:dictionary.php');
    }else{
        echo "Nothing to insert!";
    }
    }
//$output = 'Joke table successfully created.';
} catch (PDOException $e) {
    $output = 'Database error:' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
}


    ?>
</body>
</html>
