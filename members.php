<?php
// require the connection file
require __DIR__ . '/db_connect.php';
/** @var PDO $pdo */
/**
 * @return string
 * @var string $dbStatus
 */

// LOGIN CHECK TO USE ON EVERY PAGE THAT REQUIRES AUTHENTIFICATION
if(!isset($_SESSION['loginStatus']) || !$_SESSION['loginStatus']){
    header("Location:default.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Members</title>
</head>
<body>
<?php require __DIR__ . '/nav.php'; ?>

<h1>Members</h1>
<?php echo("You are signed in");?>

</body>
</html>
