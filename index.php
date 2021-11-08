<?php

header('http://localhost:8000/index.php');

require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);

$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();

$friends = $statement->fetchAll();

foreach ($friends as $friend) {
    echo $friend->firstname . ' ' . $friend->lastname;
}
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
    <ul>
        <li>Ross Geller</li>
        <li>Monica Geller</li>
        <li>Phoebe Buffay</li>
        <li>Joey Tribbiani</li>
    </ul>
    <form action="" method="post">
        <ul>
            <li>
                <label for="firstname">Firstname:</label>
                <input type="text" id="firstsname" name="firstname" required>
            </li>
            <li>
                <label for="lastname">Lastname:</label>
                <input type="text" id="lastsname" name="lastname" required>
            </li>
            <li class="button">
                <button type="submit">Submit</button>
            </li>
        </ul>
    </form>

</body>

</html>