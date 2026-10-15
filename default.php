<?php
// require the connection file
require __DIR__ . '/db_connect.php';
/** @var PDO $pdo */
/**
 * @return string
 * @var string $dbStatus
 */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Home</title>
</head>
<body>
<?php require __DIR__ . '/nav.php';?>
<h1>Home</h1>
<p>A simple database and web interface to test and manipulate storing accounts with usernames, and passwords</p>

<h2><?php echo($dbStatus.'<br><br>');?></h2>

</body>
</html>