<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=dictionary;charset=utf8',
        'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

    $sql = 'DELETE FROM `words` WHERE `id` = :id';

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();

    header('location: dictionary.php');
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in '
    . $e->getFile() . ':' . $e->getLine();
}


