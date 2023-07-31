<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include   __DIR__ . '/../classes/Ninja/DatabaseTable.php';
include   __DIR__ . '/../classes/Ninja/Authentication.php';
include   __DIR__ . '/../classes/Ijdb/Entity/Author.php';

$jokesTable = new  \Ninja\DatabaseTable($pdo, 'joke', 'id');
$authorTable = new  \Ninja\DatabaseTable($pdo, 'author', 'id');
$author = new \Ijdb\Entity\Author($authorTable);
$authentication = new  \Ninja\Authentication($authorTable, 'authorId', 'password');




    $authorObject = new \Ijdb\Entity\Author($authorTable);

    $joke = $_POST['joke'];
    $joke['jokedate'] = new \DateTime();

    $authorObject->addJoke($joke);

    header('location: /joke/list');

